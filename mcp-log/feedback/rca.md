# フィードバック16項目 RCA＋修正＋検証（2回目）

| # | 箇所 | 原因 | 修正 | 検証(実測) |
|---|---|---|---|---|
| 1 | PC top-slogan__inner 上下余白 | section padding-block(md)が175/196で設計とズレ | md padding-block→192/195 | padTop192/padBottom195 ✓ |
| 2 | PC top-slogan__catch 上余白 | catch margin-top(md)=58 | →65 | 65 ✓ |
| 3 | PC top-services img--top 前面 | img--bottom(DOM後)が前面描画 | img--top に position:relative;z-index:1 | z-index1/前面 ✓ |
| 4 | PC top-services__text 右余白 | text自身にpadding-right無し | md padding-right:30 | 30 ✓ |
| 5 | PC top-services__lead 折返し | **スクロールバー15px→実効1440=1425、body(50%)−pr44≈608px<リード2行目612px→折返し** | body md padding-right→0(リード幅確保) | lead 2行(108px) ✓ |
| 6 | PC top-services__btn 上余白 | btn margin-top(md)=40 | →47 | 47 ✓ |
| 7 | PC top-equipment__btn 上余白 | btn margin-top(md)=36 | →79 | text→btn 79 ✓ |
| 8 | SP top-slogan__title-jp 折返し | **見出し11字×29px=319px が実環境(スクロールバー込み)content≈313px超で2行** | font-size SP→28px(308px・実機/376で1行) | 1行(h39)/overflowX0 ✓ |
| 9 | SP top-services img--top 前面 | [3]と同根 | [3]のz-index:1で共通対応 | z1/前面 ✓ |
| 10 | SP top-services__images 重なり | 上セクションへ食い込む指定無し | images margin-top:-33.5＋section overflow:visible(SP) | 上へ34px重なり ✓ |
| 11 | SP top-services__inner gap | inner gap=36 | SP→46 | 46 ✓ |
| 12 | SP top-services__lead 余白 | lead margin-top(SP)=26 | →36 | 36 ✓ |
| 13 | SP top-services__btn 上余白 | btn margin-top(SP)=36 | →42 | 42 ✓ |
| 14 | SP top-equipment__machines 下余白 | margin-bottom(SP)=22 | →28 | 28 ✓ |
| 15 | SP top-equipment__btn 上余白 | btn margin-top(SP)=16 | →44 | 44 ✓ |
| 16 | SP page-links__list padding | padding-inline=var(26)でカード323px(設計315) | SP→rem(30) | padding30/カード315 ✓ |

## 全項目、ブラウザ(PC1440/SP376)で表示・スクリーンショット確認済み。横スクロール(overflowX)全0。

## pixeldiff（修正前→修正後）
| セクション | PC | SP |
|---|---|---|
| top-slogan | 84.26→**90.13%** | 72.18→71.83%※ |
| top-services | 86.35→**89.42%** | 85.97→85.62% |
| top-equipment | 85.93→**87.22%** | 78.61→**82.69%** |
| page-links | 96.05%(変更なし) | 82.08→**95.88%** |
※top-slogan SP: [8]で見出しを28pxに微縮(設計29)したぶんグリフ差で僅か低下。ユーザー環境での1行化(要件)を優先。残差は背景/写真の画像内容＋font AAが主。
