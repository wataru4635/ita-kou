# company-greeting 計画
出典: PC 1440×910 / SP 375×850。白bg。画像 company-greeting.webp(1361×1325)。
## レイアウト
- PC: 左テキスト[代表挨拶36px navy / タイトル22px Bold黒 / 本文14px lh31 / 署名16px Bold] ＋ 右に画像(680×662・aspect680/662・object-fit cover・flush-right)。
- SP: 代表挨拶18px navy → 画像(315幅・同aspect) → タイトル14px → 本文12px lh22 → 署名12px（縦積み）。
- DOM: head(代表挨拶) → image → body(タイトル＋本文＋署名)。PC=grid areas "head image"/"body image"・col [1fr][rem(680)]・align start。SP=block。
## 画像「拡大しない・デザイン位置のまま」
- inner max-width rem(1440)・margin auto。画像 col= rem(680)固定（≥1200で680px、768-1200はliquid縮小）。1440超では inner中央寄せで画像は内側右に固定（拡大せず）。
## 値
- text padding-left 116(PC)。body max-width ~559。代表挨拶→タイトル gap~76(PC)/画像 gap。section padding PC 171/57・SP 60/40。
- 本文 \n は <br>。
