// MV pixeldiff 用：実装/XD を同寸化（黒背景で埋め）
const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");
const THEME = path.resolve(__dirname, "../..");
const XD = path.join(THEME, "xd-file/mv");
const TOOLS = __dirname;

function read(p) { return PNG.sync.read(fs.readFileSync(p)); }
function write(p, png) { fs.writeFileSync(p, PNG.sync.write(png)); }
function fit(src, w, h) {
  const out = new PNG({ width: w, height: h });
  for (let y = 0; y < h; y++) for (let x = 0; x < w; x++) {
    const di = (y * w + x) * 4;
    let r = 0, g = 0, b = 0, a = 255;
    if (x < src.width && y < src.height) {
      const si = (y * src.width + x) * 4;
      r = src.data[si]; g = src.data[si + 1]; b = src.data[si + 2]; a = src.data[si + 3];
    }
    const al = a / 255;
    out.data[di] = Math.round(r * al); out.data[di + 1] = Math.round(g * al); out.data[di + 2] = Math.round(b * al); out.data[di + 3] = 255;
  }
  return out;
}
// PC 1440x900
write(path.join(TOOLS, "impl-mv-pc.png"), fit(read(path.join(THEME, "mv-pc.png")), 1440, 900));
write(path.join(TOOLS, "xd-mv-pc.png"), fit(read(path.join(XD, "0001_001__543_bdf1831d-6e37-4145-85ba-fd9e7477c150.png")), 1440, 900));
// SP 375x667
write(path.join(TOOLS, "impl-mv-sp.png"), fit(read(path.join(THEME, "mv-sp.png")), 375, 667));
write(path.join(TOOLS, "xd-mv-sp.png"), fit(read(path.join(XD, "0003_001__548_94572726-94a0-4ca8-a2c9-bc62aaf13cd8.png")), 375, 667));
console.log("mv prepared (PC 1440x900 / SP 375x667)");
