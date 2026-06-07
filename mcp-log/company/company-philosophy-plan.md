# company-philosophy 計画
出典: PC 1440×1187 / SP 375×928。画像なし。順序: スローガン → (区切り) → 基本方針（共通）。
## PC / SP 差異
- PC: 白地・角丸枠箱(border 1px #000・radius20・padding 51/65・65)・区切り線1本(スローガン/基本方針間)。3項目に個別区切り無し。
- SP: 灰地(#E6E6E6≒--bg-gray)・枠なし・区切り線4本(スローガン/基本方針間＋品質/納期/環境の各下・0.5px ink)。
## 要素・フォント
- 見出し(スローガン/基本方針): navy PC36px/SP18px。
- slogan title(職人の技術と最新設備の融合): Bold黒 PC27px/SP21px。
- lead(受け継がれる…): Bold黒 PC16px lh26/SP14px。
- 本文/方針文/item desc: Medium黒 PC14-16px/SP12px lh。
- 3項目 term(品質/納期/環境): Bold黒 PC24px/SP19px、desc下。
- 基本方針: 見出し→品質/納期/環境(各 term＋desc)→方針文(人と技術…)。
## 実装
- section bg: SP --bg-gray / md white。inner=箱: SP padding-inline var / md max-width1204・border・radius20・padding。
- .philosophy-item: SP border-bottom 0.5px ink / md none。スローガン/基本方針 間は区切り要素(共通)。
- 本文 \n→<br>、\n\n→<br><br>。
