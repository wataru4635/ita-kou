# recruitment-guideline pixeldiff
- PC: 91.37% / NCC 0.2037（1440×1551）※NCC低は白地大半・マッチ率が有効
- SP: 87.56% / NCC 0.1935（375×1028）
## 配置/検証
- 見出し「募集要項」PC48px navy中央/SP18px左。エントリーボタン navy 共通.button（→CONTACT_URL）中央。
- テーブル: 応募職種ヘッダー行（ink#231815セル＋navyセル・白字16px/SP9px）。9項目（用語Bold＋説明Medium・#999罫線）。
  - PC: 枠線箱(#707070 1px)・2列[用語227|説明]・term/desc左298/525。box padding 95/109・182/128。
  - SP: 枠線なし・行は縦積み（用語→説明）。
- 実測: titleTop60・term301≒298・header ink241≒238・boxW1205・section1512≒1551(PC)。SP 縦積み・枠線0・overflowX 全0。
## 残差: 説明テキストの折返し・font AA・ヘッダーセル背景位置の微差。
