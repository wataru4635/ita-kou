module.exports = () => ({
  postcssPlugin: "blank-lines-in-media",
  OnceExit(root) {
    root.walkAtRules("media", (media) => {
      let index = 0;
      media.each((node) => {
        if (index === 0) {
          index += 1;
          return;
        }
        index += 1;
        const before = node.raws.before || "\n  ";
        const trimmed = String(before).replace(/^\n+/, "");
        node.raws.before = "\n\n" + (trimmed || "  ");
      });
    });
  },
});

module.exports.postcss = true;
