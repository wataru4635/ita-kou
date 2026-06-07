# company-greeting pixeldiff
- PC: 96.86% / NCC 0.9191（1440×910）✅
- SP: 74.54% / NCC 0.6523（375×850）

## レイアウト（ユーザー調整・確認済 2026-06-06）
- inner: padding-inline: rem(35) 0（左35/右0＝画像右端密着）、column-gap: rem(80)。grid 1fr / rem(680)。max-width rem(1440) 中央寄せ。
- head/body: max-width rem(546) ＋ margin-left: auto（テキストは画像側に右寄せ、左余白35pxが下限）。
- 各幅実測（横スクロール全0・画像は右端密着・拡大なし）:
  - 768px : text-left 21・gap 49・img 414
  - 1024px: text-left 28・gap 65・img 553
  - 1440px: text-left 134・gap 80・img 680
  - 2560px: inner中央寄せ(左右560)・画像inner右端・gap 80・img 680
- 密着・はみ出しともに無し。SP構成は変更なし。

## SP
- 代表挨拶18px → 画像 → タイトル14px → 本文12px → 署名 縦積み。
## 残差: SPは大判写真のクロップ差＋本文折返し＋AA。
