// フッター pixeldiff 用：実装/XD を #333 背景でXD寸に揃える
const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");

const THEME = path.resolve(__dirname, "../..");
const XD = path.join(THEME, "xd-file/footer");
const TOOLS = __dirname;
const BG = { r: 51, g: 51, b: 51 }; // #333

function read(p) { return PNG.sync.read(fs.readFileSync(p)); }
function write(p, png) { fs.writeFileSync(p, PNG.sync.write(png)); }

// src を (w,h) キャンバスに左上配置し、欠け/透明は #333 で埋める
function fit(src, w, h) {
  const out = new PNG({ width: w, height: h });
  for (let y = 0; y < h; y++) for (let x = 0; x < w; x++) {
    const di = (y * w + x) * 4;
    let r = BG.r, g = BG.g, b = BG.b, a = 255;
    if (x < src.width && y < src.height) {
      const si = (y * src.width + x) * 4;
      r = src.data[si]; g = src.data[si + 1]; b = src.data[si + 2]; a = src.data[si + 3];
    } else { a = 0; }
    const al = a / 255;
    out.data[di] = Math.round(r * al + BG.r * (1 - al));
    out.data[di + 1] = Math.round(g * al + BG.g * (1 - al));
    out.data[di + 2] = Math.round(b * al + BG.b * (1 - al));
    out.data[di + 3] = 255;
  }
  return out;
}

// PC 1440x167
write(path.join(TOOLS, "impl-footer-pc.png"), fit(read(path.join(THEME, "footer-pc.png")), 1440, 167));
write(path.join(TOOLS, "xd-footer-pc.png"), fit(read(path.join(XD, "0001_001__556_922e1170-093c-4309-a7bc-22dd634d06f5.png")), 1440, 167));
// SP 375x518
write(path.join(TOOLS, "impl-footer-sp.png"), fit(read(path.join(THEME, "footer-sp.png")), 375, 518));
write(path.join(TOOLS, "xd-footer-sp.png"), fit(read(path.join(XD, "0002_001__179_b12e49cb-334c-4b3f-904b-a69734647c58.png")), 375, 518));
console.log("footer prepared (PC 1440x167 / SP 375x518)");
