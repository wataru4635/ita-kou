# top-slogan 実装計画
- 影響: front-page.php（MV直後にセクション追加）, module/_top-slogan.scss（新規・auto-forward）。新規変数なし（navy/black/white既存）。
- パターン: 全幅背景＋中央テキスト＋画像グリッド。10-9 inner / 10-11 picture（bg・PC/SP別）/ 10-8 grid。
- HTML: section.top-slogan(position:relative,bg白) > picture.top-slogan__bg(img cover,opacity無) + div.top-slogan__inner(max-width500/md1259,padding-inline var) > h2.top-slogan__title(span jp navy / span en) + p.top-slogan__catch + p.top-slogan__text(PC中央/SP左) + ul.top-slogan__images(PC grid3/SP縦) > li>img(aspect 383/369,width100%,height auto,lazy)
- SCSS: 入れ子なし・rem()・ls em・mq("md")でPC値。本文 text-align: left(SP)→center(md)。写真 grid-template-columns:1fr 1fr 1fr;gap rem(25)（md）/ SP block＋margin-top rem(24)。
- 縦余白: section padding-block（上175/下196相当→rem）。要素間 margin-top。
- 画像: 3枚 _sp無し=同一画像（picture不要、1img）。bg は picture(PC/SP別)。
- ボタン: 無し。
