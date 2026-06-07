# footer 実装計画（工程3 / blueprint）

## Plan Mode 調査結果サマリ
- **影響範囲**: `ita-kou/footer.php`（全面実装）, `_vite/src/sass/components/_footer.scss`（全実装）, `_setting.scss`（`--footer-bg:#333333` 追加）, `_vite/src/js/script.js`（トップへ戻るスムーススクロール）。
- **既存パターン**: 09 フッター + 08 ボタン。参考正本=高圧フランジ footer（`.footer__contact-btn span` 矢印・hover 反転）。
- **リスク**: PC/SP でナビ構成が異なる（PC=横4項目TOP無/SP=縦5項目TOP有・白丸矢印）→ 同一 `ul` を CSS 出し分け。to-top は PC丸/SP角で別要素。お問い合わせ hover の白矢印は青SVGを `filter: brightness(0) invert(1)` で白化。
- **代替**: ナビを PC/SP 別マークアップにせず、1つの ul＋CSS（TOP/矢印/縦罫線を PC 非表示、PC inline）に統一（DRY）。to-top は PC/SP で SVG・位置が違うため 2 要素（u-desktop/u-mobile 相当）。

## 適用パターン
- 09 フッター / 08 ボタン / 高圧フランジ footer（構造・hover）

## HTML 構造（footer.php）
```
footer.footer  (bg var(--footer-bg))
└ div.footer__inner  (max-width + padding-inline)
  ├ div.footer__main  (PC:flex横 / SP:flex縦＋order)
  │ ├ a.footer__logo > img(logo.svg)                          [SP order2・中央]
  │ ├ div.footer__info                                         [SP order4]
  │ │ ├ p.footer__name 有限会社 板岡工作所
  │ │ ├ p.footer__address 〒651-2114 兵庫県神戸市西区今寺36-11
  │ │ └ a.footer__map Google Map（下線・地図リンク）
  │ ├ span.footer__divider  (PC縦罫線・SP非表示)
  │ ├ nav.footer__nav > ul.footer__nav-items                   [SP order1]
  │ │ └ li.footer__nav-item ×5 > a (text + span.footer__nav-arrow[SP白丸→・CSS])
  │ │    (TOP/業務内容/設備紹介/会社情報/採用情報。PCは TOP と矢印を非表示・inline)
  │ ├ div.footer__contact > a.footer__contact-btn              [SP order3・中央]
  │ │   「お問い合わせフォーム」+ span.footer__contact-arrow(img btn-arrow-blue.svg)
  │ └ a.footer__to-top.js-to-top > img(to-top.svg)             [PCのみ・上段右]
  └ div.footer__bottom
    ├ a.footer__privacy プライバシーポリシー
    ├ small.footer__copyright Copyright © ITAOKA KOSAKUSHO CO., LTD.
    └ a.footer__to-top-sp.js-to-top > img(to-top_sp.svg)       [SPのみ・右下]
```

## SCSS 方針（入れ子なし・rem()・ls em・hover any-hover・縦余白 margin-top）
- `.footer { background-color: var(--footer-bg); color: var(--white); }`
- `.footer__inner { max-width: rem(1320); margin-inline: auto; padding-block: rem(33) rem(16); padding-inline: var(--padding-inline); }`（PC上段y37〜下段・SP は縦積み）
- `.footer__main`:
  - SP: `display:flex; flex-direction:column;`（order で nav1/logo2/contact3/info4）。logo/contact は `margin-inline:auto`（中央）。
  - PC(md): `flex-direction:row; align-items:flex-start; justify-content:space-between; gap:rem(?)`。order 解除。
- `.footer__logo img { width: rem(283); }`（PC・SP 同寸。白SVG）
- `.footer__info` 12px Medium 白 lh22。`.footer__map` 下線（border-bottom 1px 白）。
- `.footer__divider` PC: 幅1px 高さ rem(51) 白0.3相当（`background: rgba(255,255,255,.6)` 近似）。SP: display none。
- ナビ:
  - `.footer__nav-item a` 13px(PC)/12px(SP) Bold 白。
  - SP: 縦並び・各 li `border-bottom: 1px solid rgba(255,255,255,.3)`（白0.3px罫線）・行高 rem(40)・`.footer__nav-arrow`（白丸 border + CSS chevron 白）右端表示。
  - PC: `.footer__nav-items{display:flex; gap:rem(24);}`・`li:first-child(TOP){display:none;}`・`.footer__nav-arrow{display:none;}`・border 無し。
- お問い合わせ pill（高圧フランジ準拠）:
  - `.footer__contact-btn{ background:var(--white); color:var(--main-navy); font-weight:700; border-radius:rem(70); padding:rem(13) rem(40) rem(13) rem(28); position:relative; display:inline-block; transition: all var(--duration-base); }`
  - `.footer__contact-arrow{ position:absolute; right:rem(15); top:50%; transform:translateY(-50%); width:rem(14); height:rem(14); }` img btn-arrow-blue。
  - hover（md）: `&:hover{ background:var(--main-navy); color:var(--white);}` ＋ `&:hover .footer__contact-arrow img{ filter: brightness(0) invert(1);}`（青矢印→白）。
  - SP は文字14.72px・幅広め（中央 max-width rem(221)）。
- `.footer__to-top img{ width:rem(40);}`（PC丸）/`.footer__to-top-sp img{ width:rem(23);}`（SP角）。`.footer__to-top{ @include mq down? }`→ PCのみ表示（SP display none）、`.footer__to-top-sp` は SPのみ。
- `.footer__bottom`: `border-top:1px solid rgba(255,255,255,.3); margin-top:rem(?); padding-top:rem(12);` PC: flex space-between（privacy左 / copyright右）。SP: privacy/copyright 左積み＋to-top-sp 右下（position 又は flex）。
- Copyright 10px Light ls0.04em。

## セクション境界 margin-top
- フッターは独立コンポーネント。内部 SP 縦間隔は page-layout.md の gap（ナビ末→ロゴ36 / ロゴ→ボタン27 / ボタン→住所22 / 住所→罫線14）を margin-top で再現。

## 画像リスト
| 用途 | ファイル |
|---|---|
| ロゴ白 | logo.svg |
| ボタン矢印 | btn-arrow-blue.svg（hover白化はCSS filter）|
| トップへ戻る PC | to-top.svg |
| トップへ戻る SP | to-top_sp.svg |
| SPナビ矢印 | CSS描画（白丸+白chevron）|

## リスク対処
- ナビ PC/SP 出し分け: TOP=`li:first-child`、矢印=`.footer__nav-arrow` を PC `display:none`。
- hover 白矢印: `filter: brightness(0) invert(1)`。
- to-top スムーススクロール: js-to-top に scroll-to-top（script.js）。
- bg #333 新規変数 `--footer-bg`。

## 主要要素 XD 座標（rem=px÷16）
| 要素 | PC rel-x/y | SP rel-x/y | 備考 |
|---|---|---|---|
| ロゴ | 120.9/36.8 w283 | 58.3/243.2 中央 w283 | logo.svg |
| 会社情報 | 428/45.8 | 30.4/393.6 | 12px Medium 白 |
| 縦罫線 | 764/45.4 h51 | – | PCのみ |
| ナビ | 797/56.5（横4・13px）| 29.5/17.7（縦5・12px・行40・白丸→）| TOP は SPのみ |
| お問い合わせ pill | 1116.8/43.9 w197.9 h43 r21.3 | 76.8/323.9 w221.4 h48.2 r23.8 中央 | btn-arrow-blue |
| to-top | 1356.7/45.2 丸39.3 | 321.4/476.4 角22.6 | PC=to-top / SP=to-top_sp |
| 横罫線 | /117 | /449.2 | 白0.3px |
| プライバシー | 119/129.3（12px）| 30.4/464（10px）| 白 |
| Copyright | 右/131.9（10px Light ls0.1em）| 29.6/482.4（10px Light ls0.04em）| 白 |
