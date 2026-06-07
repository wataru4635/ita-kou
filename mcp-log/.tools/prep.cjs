// pixeldiff 用に画像をクロップ＆白背景合成して同寸に揃える
const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");

const THEME = path.resolve(__dirname, "../..");
const XD = path.join(THEME, "xd-file/header");
const TOOLS = __dirname;

function read(p) { return PNG.sync.read(fs.readFileSync(p)); }
function write(p, png) { fs.writeFileSync(p, PNG.sync.write(png)); }

// src の (sx,sy,w,h) を切り出し、白背景に合成して返す
function cropComposite(src, sx, sy, w, h) {
  const out = new PNG({ width: w, height: h });
  for (let y = 0; y < h; y++) {
    for (let x = 0; x < w; x++) {
      const di = (y * w + x) * 4;
      const ssx = sx + x, ssy = sy + y;
      let r = 255, g = 255, b = 255, a = 255;
      if (ssx >= 0 && ssx < src.width && ssy >= 0 && ssy < src.height) {
        const si = (ssy * src.width + ssx) * 4;
        r = src.data[si]; g = src.data[si + 1]; b = src.data[si + 2]; a = src.data[si + 3];
      } else { a = 0; }
      const al = a / 255;
      out.data[di]     = Math.round(r * al + 255 * (1 - al));
      out.data[di + 1] = Math.round(g * al + 255 * (1 - al));
      out.data[di + 2] = Math.round(b * al + 255 * (1 - al));
      out.data[di + 3] = 255;
    }
  }
  return out;
}

// ---- PC（XD bbox 1333x104・navy バーは右端フラッシュ）----
// 実装: 1440幅スクショの右端 1333px を切出し（navy バーが XD と右揃え）
const implPc = read(path.join(THEME, "header-pc-1440.png")); // 1440x104
write(path.join(TOOLS, "impl-pc.png"), cropComposite(implPc, implPc.width - 1333, 0, 1333, 104));
// XD: そのまま白合成
const xdPc = read(path.join(XD, "0001_001__138_856bed9a-d6e7-4429-af9a-03b6ee64e806.png")); // 1333x104
write(path.join(TOOLS, "xd-pc.png"), cropComposite(xdPc, 0, 0, 1333, 104));

// ---- SP（XD bbox 329x44・ハンバーガー右端フラッシュ）----
// 実装: 375幅スクショ。ハンバーガー右端 x=360 を XD 右端(329)に合わせ x:31..360、y:17..61
const implSp = read(path.join(THEME, "header-sp-375-closed.png")); // 375x61
write(path.join(TOOLS, "impl-sp.png"), cropComposite(implSp, 31, 17, 329, 44));
const xdSp = read(path.join(XD, "0002_001__159_c4df682e-8c16-4d6a-8c77-79d96db89722.png")); // 329x44
write(path.join(TOOLS, "xd-sp.png"), cropComposite(xdSp, 0, 0, 329, 44));

console.log("prepared: impl-pc/xd-pc (1333x104), impl-sp/xd-sp (329x44)");
