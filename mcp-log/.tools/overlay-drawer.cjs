const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");
const THEME = path.resolve(__dirname, "../..");
const OUT = path.join(THEME, "screenshots/overlay");
fs.mkdirSync(OUT, { recursive: true });
const a = PNG.sync.read(fs.readFileSync(path.join(__dirname, "impl-drawer.png")));
const b = PNG.sync.read(fs.readFileSync(path.join(__dirname, "xd-drawer.png")));
const o = new PNG({ width: a.width, height: a.height });
for (let i = 0; i < a.data.length; i += 4) {
  o.data[i] = Math.round((a.data[i] + b.data[i]) / 2);
  o.data[i + 1] = Math.round((a.data[i + 1] + b.data[i + 1]) / 2);
  o.data[i + 2] = Math.round((a.data[i + 2] + b.data[i + 2]) / 2);
  o.data[i + 3] = 255;
}
fs.writeFileSync(path.join(OUT, "drawer-overlay.png"), PNG.sync.write(o));
console.log("drawer overlay written");
