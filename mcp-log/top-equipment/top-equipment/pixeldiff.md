# top-equipment pixeldiff
- PC: 85.93% / NCC 0.5798（1440×971）
- SP: 78.61% / NCC 0.5166（375×845・スクロールバー除去で計測）
- 判定: △（配置は設計一致。残差は画像内容/AA/SP見出しテキスト差）
## 配置検証（正確）
- PC: section974≒971・機械 x90/y113/589×771・head(title navy)・lead y383≒391・navyボタン。grid areas(machines/head/body)。
- SP: section820≒845・head70≒70・machines155≒159・lead442≒447・btn730(設計753・-23)。overflowX0。
## 配色（JSON準拠・差分で確認）
- 設備紹介=navy / EQUIPMENT・リード・本文=黒 / ボタン=navy。差分はグリフ縁のみ＝色は設計一致。背景は透明度焼込で薄表示（CSS opacity無）。
## 残差: 機械画像(1枚書出)＋背景の内容/クロップ、font AA、SP見出し「技術/設備紹介」→「設備紹介」に統一、btn微オフセット。
