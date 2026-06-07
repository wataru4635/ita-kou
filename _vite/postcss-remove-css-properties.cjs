/**
 * -moz-fit-content / grid-gap の除去はこのプラグインのみ（Vite ミドルウェア等では二重に扱わない）
 */
module.exports = () => ({
  postcssPlugin: "remove-css-properties",
  OnceExit(root) {
    root.walkDecls((decl) => {
      if (decl.prop === "grid-gap") {
        decl.remove();
        return;
      }
      if (
        (decl.prop === "width" || decl.prop === "height") &&
        /-moz-fit-content/.test(decl.value)
      ) {
        decl.remove();
      }
    });
  },
});

module.exports.postcss = true;
