import chokidar from "chokidar";
import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import { spawn } from "child_process";
import sharp from "sharp";
import { themeName } from "./theme.config.js";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const SRC_IMG = path.join(__dirname, "src", "images");
const DEST_IMG = path.join(__dirname, "..", themeName, "assets", "images");

const CONVERT_EXTS = [".jpg", ".jpeg", ".png", ".gif"];
const COPY_EXTS = [".svg"];

function runInitialBuild() {
  return new Promise((resolve, reject) => {
    const child = spawn("node", ["build-images.js"], {
      cwd: __dirname,
      stdio: "inherit",
      shell: true,
    });
    child.on("close", (code) => (code === 0 ? resolve() : reject(new Error(`exit ${code}`))));
  });
}

async function convertOne(filePath) {
  const relPath = path.relative(SRC_IMG, filePath);
  if (relPath.startsWith("..")) return;
  const ext = path.extname(relPath).toLowerCase();

  if (CONVERT_EXTS.includes(ext)) {
    const webpRel = relPath.slice(0, -ext.length) + ".webp";
    const webpPath = path.join(DEST_IMG, webpRel);
    fs.mkdirSync(path.dirname(webpPath), { recursive: true });
    try {
      await sharp(filePath).webp({ quality: 85 }).toFile(webpPath);
      console.log(`[watch-images] converted: ${relPath} -> ${webpRel}`);
    } catch (e) {
      console.error(`[watch-images] failed: ${relPath}`, e.message);
    }
    return;
  }

  if (COPY_EXTS.includes(ext)) {
    const destPath = path.join(DEST_IMG, relPath);
    fs.mkdirSync(path.dirname(destPath), { recursive: true });
    fs.copyFileSync(filePath, destPath);
    console.log(`[watch-images] copied: ${relPath}`);
  }
}

function removeOne(filePath) {
  const relPath = path.relative(SRC_IMG, filePath);
  if (relPath.startsWith("..")) return;
  const ext = path.extname(relPath).toLowerCase();

  if (CONVERT_EXTS.includes(ext)) {
    const webpRel = relPath.slice(0, -ext.length) + ".webp";
    const webpPath = path.join(DEST_IMG, webpRel);
    if (fs.existsSync(webpPath)) {
      fs.unlinkSync(webpPath);
      console.log(`[watch-images] removed: ${webpRel}`);
    }
    return;
  }

  if (COPY_EXTS.includes(ext)) {
    const destPath = path.join(DEST_IMG, relPath);
    if (fs.existsSync(destPath)) {
      fs.unlinkSync(destPath);
      console.log(`[watch-images] removed: ${relPath}`);
    }
  }
}

// 変更イベントをファイル単位でデバウンス（エディタ保存で複数回発火するのを抑制）
const pendingTimers = new Map();
function scheduleConvert(filePath) {
  const prev = pendingTimers.get(filePath);
  if (prev) clearTimeout(prev);
  const t = setTimeout(() => {
    pendingTimers.delete(filePath);
    convertOne(filePath).catch(() => {});
  }, 150);
  pendingTimers.set(filePath, t);
}

if (!fs.existsSync(SRC_IMG)) {
  fs.mkdirSync(SRC_IMG, { recursive: true });
}

runInitialBuild().then(() => {
  const watcher = chokidar.watch(SRC_IMG, {
    ignoreInitial: true,
    ignored: /(^|[/\\])\../,
  });
  watcher
    .on("add", scheduleConvert)
    .on("change", scheduleConvert)
    .on("unlink", removeOne)
    .on("addDir", (dirPath) => {
      const rel = path.relative(SRC_IMG, dirPath);
      if (rel && !rel.startsWith("..")) {
        const destDir = path.join(DEST_IMG, rel);
        fs.mkdirSync(destDir, { recursive: true });
      }
    });
}).catch(() => {});
