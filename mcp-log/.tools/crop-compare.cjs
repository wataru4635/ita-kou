// fullPage png を (x,y,w,h) で切り出し、XD を白合成して同寸にし compare
// node crop-compare.cjs <fullpng> <ox> <oy> <xd> <outImpl> <outXd> <W> <H>
const fs=require("fs"),path=require("path");
module.paths.unshift(path.join(__dirname,"node_modules"));
const {PNG}=require("pngjs");
const [full,ox,oy,xd,outI,outX,W,H]=process.argv.slice(2);
const w=+W,h=+H,X=+ox,Y=+oy;
const src=PNG.sync.read(fs.readFileSync(full));
const xi=PNG.sync.read(fs.readFileSync(xd));
function crop(s,x0,y0,w,h){const o=new PNG({width:w,height:h});for(let y=0;y<h;y++)for(let x=0;x<w;x++){const di=(y*w+x)*4;const sx=x0+x,sy=y0+y;let r=255,g=255,b=255,a=255;if(sx<s.width&&sy<s.height){const si=(sy*s.width+sx)*4;r=s.data[si];g=s.data[si+1];b=s.data[si+2];a=s.data[si+3];}const al=a/255;o.data[di]=Math.round(r*al+255*(1-al));o.data[di+1]=Math.round(g*al+255*(1-al));o.data[di+2]=Math.round(b*al+255*(1-al));o.data[di+3]=255;}return o;}
fs.writeFileSync(outI,PNG.sync.write(crop(src,X,Y,w,h)));
fs.writeFileSync(outX,PNG.sync.write(crop(xi,0,0,w,h)));
console.log("cropped",w+"x"+h);
