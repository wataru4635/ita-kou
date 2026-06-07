// 実装とXDを50%ブレンドした目視確認用オーバーレイを生成
const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");

const THEME = path.resolve(__dirname, "../..");
const OUT = path.join(THEME, "screenshots/overlay");
fs.mkdirSync(OUT, { recursive: true });

function blend(aPath, bPath, outPath) {
  const a = PNG.sync.read(fs.readFileSync(path.join(__dirname, aPath)));
  const b = PNG.sync.read(fs.readFileSync(path.join(__dirname, bPath)));
  const { width, height } = a;
  const o = new PNG({ width, height });
  for (let i = 0; i < a.data.length; i += 4) {
    o.data[i]     = Math.round((a.data[i] + b.data[i]) / 2);
    o.data[i + 1] = Math.round((a.data[i + 1] + b.data[i + 1]) / 2);
    o.data[i + 2] = Math.round((a.data[i + 2] + b.data[i + 2]) / 2);
    o.data[i + 3] = 255;
  }
  fs.writeFileSync(outPath, PNG.sync.write(o));
}

blend("impl-pc.png", "xd-pc.png", path.join(OUT, "header-pc-overlay.png"));
blend("impl-sp.png", "xd-sp.png", path.join(OUT, "header-sp-overlay.png"));
console.log("overlay written to screenshots/overlay/");
