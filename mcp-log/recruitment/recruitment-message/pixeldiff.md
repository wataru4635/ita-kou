# recruitment-message pixeldiff
- PC: 96.00% / NCC 0.4026（1440×997）※NCC低は大半が均一グレー地のため・マッチ率96%が有効
- SP: 91.27% / NCC 0.4236（375×478・見出し+本文領域。ボタンは追加分のため対象外）
## 配置/検証
- bg #E9E8E9(--bg-gray)。見出し「求める人物像」PC48px navy中央/SP18px左。本文PC14px中央600幅/SP12px左。
- ボタン2つ（業務内容→SERVICES_URL / 会社情報→COMPANY_URL）navy 共通.button。PC横並びgap34中央。**SPはカンプ欠落のためPCに合わせ追加（縦積み中央）**。
- 実測: PC titleTop175・ボタンrow navy・section1027≒997。SP 見出し/本文 左・ボタン縦積み表示。overflowX 全0。
## 残差: 本文の折返し差・font AA・SP背景の僅差(#E6E6E6→#E9E8E9統一)。
