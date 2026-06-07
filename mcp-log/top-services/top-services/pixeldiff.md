# top-services pixeldiff
- PC: 92.01% / NCC 0.6739（1440×1012）
- SP: （前回値・構成変更なし）

## company-greeting と同形への調整（2026-06-06）
左テキスト＋右に重ね写真2枚、の余白/位置を company-greeting と同じ要領に統一。
- inner(md): padding-left rem(35)（左35・右0＝画像右端密着）、gap rem(53)（テキスト⇔画像）。flex row・max-width rem(1440)・中央寄せ。
- body(md): width50%廃止 → max-width rem(640) ＋ margin-left:auto（テキストを画像側へ寄せ・左余白35pxが下限）。padding-right/リードのmargin-right相殺/textのpadding-rightは廃止（gapで管理）。
- images(md): width50% → width rem(657) 固定 ＋ flex-shrink:0（拡大せず右端密着。_02=657・_01=328 を維持）。
- 各幅実測（横スクロール全0・画像右端密着・拡大なし・リード2行維持）:
  - 768px : text-left ~21（35下限）/ gap 32 / img 400
  - 1440px: text-left 90 / gap 53 / img 657
  - 2560px: inner中央寄せ(左右560)・画像inner右端 / gap 53 / img 657（拡大せず）
- 密着・はみ出しなし。SP（column-reverse 縦積み）は変更なし。
## 備考: text-left は 90（デザイン117）。さらに寄せたい場合は body の max-width を詰める（例620→約110）。
