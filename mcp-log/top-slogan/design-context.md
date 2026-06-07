# top-slogan design-context（XD抽出値）

> 出典: xd-file/top/top-slogan/ export_0001(PC 1440×1515), export_0002(SP 375×1565)
> 画像: assets/images/top/（top-slogan-bg[_sp], top-slogan_01/02/03 ※_sp無し=SP共通）
> **背景画像は透明度込みで書き出し済み → CSSの opacity 指定は不要**（白背景に画像をそのまま敷く）。

## 構成
- 全幅背景画像（top-slogan-bg / SP: top-slogan-bg_sp）。section は白背景。
- 中央テキスト群: 見出し「板岡工作所のスローガン」＋「SLOGAN」＋キャッチ「「職人の技術と最新設備の融合」」＋本文。
- 写真3枚（top-slogan_01/02/03）: PC=横3列 / SP=縦3積み。

## 配色・フォント
| 要素 | PC | SP | 色 |
|---|---|---|---|
| 見出し jp「板岡工作所のスローガン」 | 55px Bold | 29px Bold | #003894 (--main-navy) |
| SLOGAN | 36px Light | 13px Light | #000 (--black) |
| キャッチ「職人の技術と最新設備の融合」 | 36px Bold center | 18px Bold center | #000 |
| 本文 | 16px Medium center lh29(=1.81) | 12px Medium **左寄せ** lh22(=1.83) | #000 |

本文テキスト（共通）:
「受け継がれる職人の技。進化を続ける最新設備。その融合が、常識を超える品質を生み出します。／一つひとつの工程に宿る熟練の技術と、精度を極限まで高めるテクノロジー。その両輪が支え合うことで、私たちは常に安定した高品質と、時代のニーズに応える柔軟なものづくりを実現してきました。／私たちは、人の手だからこそ生まれる繊細さと、機械だからこそ実現できる正確さ、そのどちらも欠かすことなく追求し続けています。目に見える品質だけでなく、その先にある安心や信頼までも提供すること。それが、私たちの使命です。／人と技術の可能性を最大限に引き出し、新たな価値を創造し続ける。これからも私たちは、伝統と革新を融合させながら、次の時代へとつながるものづくりに挑戦し続けます。」
（PCは段落間に空行あり・中央寄せ。SPは左寄せ・段落改行）

## レイアウト（rel座標）
### PC（content 1199幅・1440中央＝左右padding約120）
- content top rel-y 175。見出し→SLOGAN→キャッチ(rel-y370)→本文(rel-y451)→写真3枚(rel-y950)。
- 写真3枚: 各 383×369、横並び、gap 25px、content幅1199。section高1515。
### SP（content 約323幅）
- 見出し rel-y55 → SLOGAN95 → キャッチ142 → 本文191(左寄せ) → 写真3枚 縦積み（各315×304・gap24・rel-y 529/856/1183）。
- bg画像はSPでは上部約803pxまで（下は白）。実装は白section＋bg画像で近似。

## インナー（project-env 10-9）
- `.top-slogan__inner`: max-width rem(500) / `@include mq("md") max-width rem(1259)`(=1199+60)、padding-inline var(--padding-inline)。
- 写真: PC=`display:grid; grid-template-columns: 1fr 1fr 1fr; gap:rem(25)`（or flex）、SP=縦積み（margin-top gap24）。img は width100%/height auto/aspect-ratio 383/369。

## 注意
- 背景: picture(PC=top-slogan-bg.webp / SP=top-slogan-bg_sp.webp)・object-fit cover・**opacity指定なし**（透明度焼込済）。
- 本文 PC中央／SP左。
- ボタンは無し（このセクションにCTAボタンは無い）。
