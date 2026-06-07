const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");
const OUT = path.resolve(__dirname, "../../screenshots/overlay");
fs.mkdirSync(OUT, { recursive: true });
function blend(a, b, o) {
  const A = PNG.sync.read(fs.readFileSync(path.join(__dirname, a)));
  const B = PNG.sync.read(fs.readFileSync(path.join(__dirname, b)));
  const O = new PNG({ width: A.width, height: A.height });
  for (let i = 0; i < A.data.length; i += 4) {
    O.data[i] = Math.round((A.data[i] + B.data[i]) / 2);
    O.data[i + 1] = Math.round((A.data[i + 1] + B.data[i + 1]) / 2);
    O.data[i + 2] = Math.round((A.data[i + 2] + B.data[i + 2]) / 2);
    O.data[i + 3] = 255;
  }
  fs.writeFileSync(path.join(OUT, o), PNG.sync.write(O));
}
blend("impl-footer-pc.png", "xd-footer-pc.png", "footer-pc-overlay.png");
blend("impl-footer-sp.png", "xd-footer-sp.png", "footer-sp-overlay.png");
console.log("footer overlays written");
