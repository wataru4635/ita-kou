// 汎用: 実装スクショ と XD PNG を白背景合成して同寸(XD寸)に揃え compare 用に出力
// 使い方: node prep-section.cjs <impl.png> <xd.png> <outImpl> <outXd> [W] [H]
const fs=require("fs"),path=require("path");
module.paths.unshift(path.join(__dirname,"node_modules"));
const {PNG}=require("pngjs");
const [impl,xd,outI,outX,W,H]=process.argv.slice(2);
function read(p){return PNG.sync.read(fs.readFileSync(p));}
function fit(src,w,h){const o=new PNG({width:w,height:h});for(let y=0;y<h;y++)for(let x=0;x<w;x++){const di=(y*w+x)*4;let r=255,g=255,b=255,a=255;if(x<src.width&&y<src.height){const si=(y*src.width+x)*4;r=src.data[si];g=src.data[si+1];b=src.data[si+2];a=src.data[si+3];}else a=0;const al=a/255;o.data[di]=Math.round(r*al+255*(1-al));o.data[di+1]=Math.round(g*al+255*(1-al));o.data[di+2]=Math.round(b*al+255*(1-al));o.data[di+3]=255;}return o;}
const xi=read(xd); const w=W?+W:xi.width, h=H?+H:xi.height;
fs.writeFileSync(outI,PNG.sync.write(fit(read(impl),w,h)));
fs.writeFileSync(outX,PNG.sync.write(fit(xi,w,h)));
console.log("prepped",w+"x"+h);
