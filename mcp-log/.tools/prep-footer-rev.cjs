// フッター修正版 pixeldiff 用：実装/XD(修正後) を #333 背景でXD寸に揃える
// PC=フッター全体(1440x167)。SP=修正画像がナビ無しの部分図(375x332)のため、
// 実装SPはロゴ上端を基準に自動整合クロップしてから合成する。
const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");

const THEME = path.resolve(__dirname, "../..");
const XD = path.join(THEME, "xd-file", "footer", "修正");
const TOOLS = __dirname;
const BG = { r: 51, g: 51, b: 51 }; // #333

function read(p) { return PNG.sync.read(fs.readFileSync(p)); }
function write(p, png) { fs.writeFileSync(p, PNG.sync.write(png)); }

// src を (w,h) キャンバスに (ox,oy) からの矩形で左上配置、欠け/透明は #333 で埋める
function fit(src, w, h, ox = 0, oy = 0) {
  const out = new PNG({ width: w, height: h });
  for (let y = 0; y < h; y++) for (let x = 0; x < w; x++) {
    const di = (y * w + x) * 4;
    let r = BG.r, g = BG.g, b = BG.b, a = 255;
    const sx = x + ox, sy = y + oy;
    if (sx >= 0 && sy >= 0 && sx < src.width && sy < src.height) {
      const si = (sy * src.width + sx) * 4;
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

// 上端から(または startY 以降で)最初に白系コンテンツが現れる行を返す
function firstContentRow(src, startY = 0) {
  for (let y = startY; y < src.height; y++) {
    let cnt = 0;
    for (let x = 0; x < src.width; x++) {
      const i = (y * src.width + x) * 4;
      const gray = (src.data[i] + src.data[i + 1] + src.data[i + 2]) / 3;
      if (gray > 128) cnt++;
    }
    if (cnt > 20) return y;
  }
  return startY;
}

// PC 1440x167（全体）
const implPc = read(path.join(THEME, "footer-pc.png"));
const xdPc = read(path.join(XD, "0001_001__20_a8306ede-45a3-4176-8f60-d64191370662.png"));
write(path.join(TOOLS, "impl-footer-rev-pc.png"), fit(implPc, 1440, 167));
write(path.join(TOOLS, "xd-footer-rev-pc.png"), fit(xdPc, 1440, 167));

// SP 375x332（ロゴ上端で整合）
const implSp = read(path.join(THEME, "footer-sp.png"));   // 360x552 全体（ナビ含む）
const xdSp = read(path.join(XD, "0002_001__28_60f42231-97eb-4a15-8ef6-be4b98a07341.png")); // 375x332 部分
const xdLogoTop = firstContentRow(xdSp, 0);
const implLogoTop = firstContentRow(implSp, 240); // ナビ帯(〜230)を飛ばしロゴから探す
const cropY = Math.max(0, implLogoTop - xdLogoTop);
write(path.join(TOOLS, "impl-footer-rev-sp.png"), fit(implSp, 375, 332, 0, cropY));
write(path.join(TOOLS, "xd-footer-rev-sp.png"), fit(xdSp, 375, 332));

console.log(JSON.stringify({ xdLogoTop, implLogoTop, cropY, msg: "footer-rev prepared (PC 1440x167 / SP 375x332)" }));
