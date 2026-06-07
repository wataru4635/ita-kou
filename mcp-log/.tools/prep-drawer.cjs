// ドロワー pixeldiff 用：実装/XD を白背景合成して同寸(375x667)に揃える
const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");

const THEME = path.resolve(__dirname, "../..");
const XD = path.join(THEME, "xd-file/drawer/0001_001__1_1_13ef3d0a-4655-4129-a44c-3bff87ae6060.png");
const TOOLS = __dirname;

function read(p) { return PNG.sync.read(fs.readFileSync(p)); }
function write(p, png) { fs.writeFileSync(p, PNG.sync.write(png)); }

function compositeWhite(src, w, h) {
  const out = new PNG({ width: w, height: h });
  for (let y = 0; y < h; y++) for (let x = 0; x < w; x++) {
    const di = (y * w + x) * 4;
    let r = 255, g = 255, b = 255, a = 255;
    if (x < src.width && y < src.height) {
      const si = (y * src.width + x) * 4;
      r = src.data[si]; g = src.data[si + 1]; b = src.data[si + 2]; a = src.data[si + 3];
    } else { a = 0; }
    const al = a / 255;
    out.data[di] = Math.round(r * al + 255 * (1 - al));
    out.data[di + 1] = Math.round(g * al + 255 * (1 - al));
    out.data[di + 2] = Math.round(b * al + 255 * (1 - al));
    out.data[di + 3] = 255;
  }
  return out;
}

const impl = read(path.join(THEME, "drawer-375.png"));
const xd = read(XD);
const W = 375, H = 667;
write(path.join(TOOLS, "impl-drawer.png"), compositeWhite(impl, W, H));
write(path.join(TOOLS, "xd-drawer.png"), compositeWhite(xd, W, H));
console.log(`prepared drawer ${W}x${H} (impl ${impl.width}x${impl.height} / xd ${xd.width}x${xd.height})`);
