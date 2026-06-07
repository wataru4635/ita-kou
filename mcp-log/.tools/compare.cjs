// ピクセル比較ユーティリティ（独自実装）
// 使い方: node compare.cjs <img1> <img2> [diffOut]
// 出力: { matchRate, mismatchRate, diffPixels, ncc }
const fs = require("fs");
const path = require("path");
module.paths.unshift(path.join(__dirname, "node_modules"));
const { PNG } = require("pngjs");
const pm = require("pixelmatch");
const pixelmatch = pm.default || pm;

function gray(d, i) {
  return (d[i] + d[i + 1] + d[i + 2]) / 3;
}

// 正規化相互相関（-1〜1）。分散ゼロは 0 を返す。
function ncc(a, b) {
  const len = a.data.length;
  const n = len / 4;
  let s1 = 0, s2 = 0;
  for (let i = 0; i < len; i += 4) { s1 += gray(a.data, i); s2 += gray(b.data, i); }
  const m1 = s1 / n, m2 = s2 / n;
  let num = 0, d1 = 0, d2 = 0;
  for (let i = 0; i < len; i += 4) {
    const x = gray(a.data, i) - m1;
    const y = gray(b.data, i) - m2;
    num += x * y; d1 += x * x; d2 += y * y;
  }
  if (d1 === 0 || d2 === 0) return 0;
  return num / Math.sqrt(d1 * d2);
}

const [p1, p2, out = "diff.png"] = process.argv.slice(2);
if (!p1 || !p2) { console.error("Usage: node compare.cjs <img1> <img2> [diffOut]"); process.exit(1); }

const img1 = PNG.sync.read(fs.readFileSync(p1));
const img2 = PNG.sync.read(fs.readFileSync(p2));
const { width, height } = img1;
const diff = new PNG({ width, height });
const diffPixels = pixelmatch(img1.data, img2.data, diff.data, width, height, { threshold: 0.1 });
fs.writeFileSync(out, PNG.sync.write(diff));
const total = width * height;
const mismatchRate = (diffPixels / total) * 100;
console.log(JSON.stringify({
  matchRate: Math.round((100 - mismatchRate) * 100) / 100,
  mismatchRate: Math.round(mismatchRate * 100) / 100,
  diffPixels,
  ncc: parseFloat(ncc(img1, img2).toFixed(4)),
  size: `${width}x${height}`
}));
