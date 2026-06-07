import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import chokidar from "chokidar";
import { glob } from "glob";
import sassGlobImports from "vite-plugin-sass-glob-import";
import liveReload from "vite-plugin-live-reload";
import { themeName, PROXY_TARGET } from "./theme.config.js";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const jsDir = path.join(__dirname, "src", "js");
const wpThemeDir = path.resolve(__dirname, "..", themeName);

const VITE_CLIENT_SCRIPT = '<script type="module" src="/@vite/client"></script>';

/** HTML に Vite クライアントを注入し、PHP 変更時に localhost:5173 のブラウザが自動リロードされるようにする */
function injectViteClient() {
  return {
    name: "inject-vite-client",
    configureServer(server) {
      server.middlewares.use(async (req, res, next) => {
        const pathname = req.url?.split("?")[0] || "";
        if (pathname.startsWith("/@") || pathname.startsWith("/node_modules")) {
          return next();
        }
        if (req.headers.upgrade === "websocket") {
          return next();
        }
        try {
          const url = PROXY_TARGET + (req.url || "/");
          const headers = new Headers();
          const targetHost = new URL(PROXY_TARGET).host;
          headers.set("host", targetHost);
          if (req.headers.accept) headers.set("accept", req.headers.accept);
          if (req.headers["accept-language"]) headers.set("accept-language", req.headers["accept-language"]);
          const response = await fetch(url, {
            method: req.method || "GET",
            headers,
          });
          const contentType = response.headers.get("content-type") || "";
          if (contentType.includes("text/html")) {
            let html = await response.text();
            const devOrigin = "http://" + (req.headers.host || "localhost:5173");
            const targetOrigin = PROXY_TARGET.replace(/\/$/, "");
            html = html.split(targetOrigin).join(devOrigin);
            const injected = html.replace(
              /<\/body\s*>/i,
              `${VITE_CLIENT_SCRIPT}$&`
            );
            res.setHeader("content-type", "text/html; charset=utf-8");
            res.end(injected);
          } else if (contentType.includes("text/css")) {
            const css = await response.text();
            res.statusCode = response.status;
            res.setHeader("content-type", "text/css; charset=utf-8");
            res.end(css);
          } else {
            res.statusCode = response.status;
            response.headers.forEach((v, k) => {
              const key = k.toLowerCase();
              if (key !== "content-encoding" && key !== "transfer-encoding") {
                res.setHeader(k, v);
              }
            });
            const buf = await response.arrayBuffer();
            res.end(Buffer.from(buf));
          }
        } catch (e) {
          next(e);
        }
      });
    },
  };
}

const COMMENT_FN = "__VITE_KEEP_COMMENT__";
/** JS のブロックコメントをビルド後も残す（プレースホルダーで保護し、writeBundle で復元） */
function preserveComments() {
  return {
    name: "preserve-js-comments",
    enforce: "pre",
    transform(code, id) {
      const norm = id.replace(/\\/g, "/");
      if (norm.includes("node_modules") || !norm.includes("/src/") || !id.endsWith(".js")) return null;
      let encoded = code.replace(/\/\*[\s\S]*?\*\//g, (m) => {
        const b64 = Buffer.from(m, "utf8").toString("base64");
        return `${COMMENT_FN}("${b64}")`;
      });
      encoded = encoded.replace(/^\s*\/\/[^\n]*\n?/gm, (m) => {
        const b64 = Buffer.from(m, "utf8").toString("base64");
        return `${COMMENT_FN}("${b64}")\n`;
      });
      return { code: encoded, map: null };
    },
    writeBundle(options, bundle) {
      const dir = options.dir || path.dirname(options.file || "");
      for (const [fileName, chunk] of Object.entries(bundle)) {
        if (chunk.type !== "asset" && fileName.endsWith(".js")) {
          const filePath = path.join(dir, fileName);
          if (!fs.existsSync(filePath)) continue;
          let code = fs.readFileSync(filePath, "utf8");
          const re = /__VITE_KEEP_COMMENT__\s*\(\s*"([\s\S]*?)"\s*\)/g;
          let out = code.replace(re, (_, b64) => {
            try {
              return Buffer.from(b64, "base64").toString("utf8");
            } catch {
              return "";
            }
          }).replace(/function\s+__VITE_KEEP_COMMENT__\s*\(\)\s*\{\s*\}\s*\n?/g, "").replace(/\*\/;\s*\n/g, "*/\n").replace(/(\/\/[^\n]*|\*\/)\n\s*;\s*\n/g, "$1\n\n").replace(/\n\n+(?=\s*\/\/)/g, "\n");
          if (!out.startsWith('"use strict";')) {
            out = '"use strict";\n\n' + out;
          }
          if (out !== code) fs.writeFileSync(filePath, out);
        }
      }
    },
  };
}

const sassDir = path.join(__dirname, "src", "sass");
const sassFolders = ["base", "global", "module", "components"];
// global は読み込み順が重要なので固定（他はアルファベット順）
const folderOrder = {
  global: ["function", "setting", "breakpoints"],
};

function collectScssPartials(dirPath, basePath, list = []) {
  if (!fs.existsSync(dirPath)) return list;
  const entries = fs.readdirSync(dirPath, { withFileTypes: true });
  for (const e of entries) {
    const full = path.join(dirPath, e.name);
    if (e.isDirectory()) {
      collectScssPartials(full, basePath, list);
    } else if (e.name.startsWith("_") && e.name.endsWith(".scss") && e.name !== "_index.scss") {
      const rel = path.relative(basePath, full).replace(/\\/g, "/").replace(/\.scss$/i, "");
      const forwardKey = rel.split("/").map((part) => part.replace(/^_/, "")).join("/");
      list.push(forwardKey);
    }
  }
  return list;
}

function writeSassFolderIndex(dirPath, folderName) {
  if (!fs.existsSync(dirPath)) return;
  let partials = collectScssPartials(dirPath, dirPath);
  const order = folderOrder[folderName];
  const sortByDepthThenAlpha = (a, b) => {
    const depthA = (a.match(/\//g) || []).length;
    const depthB = (b.match(/\//g) || []).length;
    if (depthA !== depthB) return depthA - depthB;
    return a.localeCompare(b, "en");
  };
  if (order && order.length) {
    const orderSet = new Set(order);
    const ordered = order.filter((n) => partials.includes(n));
    const rest = partials.filter((n) => !orderSet.has(n)).sort(sortByDepthThenAlpha);
    partials = [...ordered, ...rest];
  } else {
    partials.sort(sortByDepthThenAlpha);
  }
  const content =
    "// 自動生成: " +
    folderName +
    " 内の _*.scss を @forward します（手で編集しないでください）\n" +
    partials.map((name) => `@forward "${name}";`).join("\n") +
    "\n";
  const indexPath = path.join(dirPath, "_index.scss");
  // 内容が同じなら書き込まない（ビルド→書き込み→変更検知→再ビルドのループを防ぐ）
  try {
    if (fs.readFileSync(indexPath, "utf8") === content) return;
  } catch {
    // ファイルが存在しない場合はそのまま書き込む
  }
  fs.writeFileSync(indexPath, content);
}

/** base / global / module / components の _*.scss を検出し _index.scss を自動生成 */
function generateSassIndex() {
  return {
    name: "generate-sass-index",
    buildStart() {
      for (const folder of sassFolders) {
        writeSassFolderIndex(path.join(sassDir, folder), folder);
      }
    },
    configureServer(server) {
      for (const folder of sassFolders) {
        const dirPath = path.join(sassDir, folder);
        if (!fs.existsSync(dirPath)) continue;
        server.watcher.add(dirPath);
      }
      const fileIsInFolder = (filePath, folder) => {
        const rel = path.relative(path.join(sassDir, folder), filePath);
        return rel && !rel.startsWith("..") && !path.isAbsolute(rel);
      };
      server.watcher.on("add", (file) => {
        if (!file.endsWith(".scss") || path.basename(file) === "_index.scss") return;
        for (const folder of sassFolders) {
          if (fileIsInFolder(file, folder) && path.basename(file).startsWith("_")) {
            writeSassFolderIndex(path.join(sassDir, folder), folder);
            break;
          }
        }
      });
      server.watcher.on("unlink", (file) => {
        if (!file.endsWith(".scss")) return;
        for (const folder of sassFolders) {
          if (fileIsInFolder(file, folder) && path.basename(file).startsWith("_")) {
            writeSassFolderIndex(path.join(sassDir, folder), folder);
            break;
          }
        }
      });
    },
  };
}

/**
 * 開発サーバーでは CSS 内の url が /assets/ 絶対パスになりやすい。
 * style.css は assets/css/ にある想定で、テーマ内の相対 URL に寄せる。
 */
function themeCssRelativeAssetUrls() {
  return {
    name: "theme-css-relative-asset-urls",
    enforce: "post",
    transform(code, id) {
      if (typeof code !== "string" || !code.includes("url(")) return null;
      const norm = id.replace(/\\/g, "/");
      if (!norm.includes("style.scss")) return null;
      if (norm.includes("node_modules")) return null;
      let next = code.replace(
        /url\(\s*(["']?)\/assets\/images\/+/g,
        "url($1../images/"
      );
      next = next.replace(/url\(\s*(["']?)\/assets\/+/g, "url($1../");
      return next === code ? null : { code: next, map: null };
    },
  };
}

const editorCssSrc = path.join(__dirname, "src", "css", "editor.css");
const editorCssDest = path.join(wpThemeDir, "assets", "css", "editor.css");

function copyEditorCssFile() {
  if (!fs.existsSync(editorCssSrc)) {
    return;
  }
  fs.mkdirSync(path.dirname(editorCssDest), { recursive: true });
  fs.copyFileSync(editorCssSrc, editorCssDest);
}

let editorCssWatchStarted = false;

/** src/css/editor.css → テーマ assets/css/editor.css（build 完了時コピー + dev / build --watch で監視） */
function copyEditorCss() {
  return {
    name: "copy-editor-css",
    buildStart() {
      if (!this.meta.watchMode || editorCssWatchStarted) {
        return;
      }
      editorCssWatchStarted = true;
      chokidar.watch(editorCssSrc, { ignoreInitial: true }).on("change", () => {
        copyEditorCssFile();
      });
    },
    closeBundle() {
      copyEditorCssFile();
    },
    configureServer(server) {
      const norm = (p) => path.normalize(path.resolve(p));
      const srcNorm = norm(editorCssSrc);
      server.watcher.add(editorCssSrc);
      server.watcher.on("change", (file) => {
        if (norm(file) === srcNorm) {
          copyEditorCssFile();
        }
      });
      copyEditorCssFile();
    },
  };
}

async function buildConfig() {
  const jsEntries = await glob("**/*.js", { cwd: jsDir });
  const input = {};
  for (const f of jsEntries) {
    const name = f.replace(/\.js$/, "").replace(/\\/g, "/") || "script";
    input[name] = path.join(jsDir, f);
  }
  if (Object.keys(input).length === 0) {
    input.script = path.join(jsDir, "script.js");
  }

  return {
  base: "./",
  plugins: [
    generateSassIndex(),
    sassGlobImports(),
    themeCssRelativeAssetUrls(),
    copyEditorCss(),
    liveReload(
      [
        `../${themeName}/**/*.php`,
        `../${themeName}/assets/css/**/*.css`,
        `../${themeName}/assets/js/**/*.js`,
        `../${themeName}/assets/images/**`,
      ],
      { alwaysReload: true }
    ),
    injectViteClient(),
    preserveComments(),
  ],
  root: __dirname,
  publicDir: false,
  build: {
    outDir: wpThemeDir,
    emptyOutDir: false,
    assetsInlineLimit: 0,
    rollupOptions: {
      input,
      output: {
        intro: `"use strict";\nfunction ${COMMENT_FN}(){}`,
        entryFileNames: "assets/js/[name].js",
        chunkFileNames: "assets/js/[name].js",
        assetFileNames: (assetInfo) => {
          const name = assetInfo.name || "";
          if (name.endsWith(".css")) return "assets/css/style.css";
          const candidates = [
            ...(assetInfo.originalFileNames || []),
            assetInfo.originalFileName,
            ...(Array.isArray(assetInfo.names) ? assetInfo.names : []),
            name,
          ].filter(Boolean);
          for (const raw of candidates) {
            const p = String(raw).replace(/\\/g, "/");
            const idx = p.indexOf("/src/images/");
            if (idx !== -1) {
              return `assets/images/${p.slice(idx + "/src/images/".length)}`;
            }
            if (p.startsWith("src/images/")) {
              return `assets/images/${p.slice("src/images/".length)}`;
            }
          }
          const baseName = path.basename(name);
          if (baseName && baseName !== name) {
            const underTop = path.join(__dirname, "src", "images", "top", baseName);
            if (fs.existsSync(underTop)) {
              return `assets/images/top/${baseName}`;
            }
          }
          if (name && !name.includes("/")) {
            const underTop = path.join(__dirname, "src", "images", "top", name);
            if (fs.existsSync(underTop)) {
              return `assets/images/top/${name}`;
            }
          }
          return "assets/[name][extname]";
        },
      },
    },
    sourcemap: false,
    minify: false,
  },
  server: {
    open: "/",
  },
  css: {
    devSourcemap: false,
    preprocessorOptions: {
      scss: {
        silenceDeprecations: ["legacy-js-api"],
      },
    },
  },
  };
}

export default buildConfig();
