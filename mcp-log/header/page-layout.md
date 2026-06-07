# header page-layout（コンポーネント単位）

ヘッダーは共通コンポーネント（`components/_header.scss`）。ページ内セクションの縦並びを持たないため、
セクション間 gap ではなく「ヘッダー内ブロックの配置」を記録する。

## ブロック構成（PC）
- header（position: absolute / top:0 / left:0 / 幅100% / MV と重なる）
  - header__inner（左右 space-between）
    - header__logo（左・白ロゴSVG / 上端から約27px）
    - header__nav（右・ネイビーバー #003894・上端右端フラッシュ・高さ約104px）
      - header__nav-item ×5（TOP / 業務内容 / 設備紹介 / 会社情報 / 採用情報、白罫線で区切り）
      - header__nav-item--contact（#CCCCCC・黒文字・最右）

## ブロック構成（SP, < lg 1024px）
- header（position: absolute / top:約20px / 左右 padding-inline）
  - header__inner（左右 space-between）
    - header__logo（左・白ロゴSVG / SP幅 約211px）
    - header__hamburger（右・#003894 正方形 約41px・白バー2本）
  - header__drawer（position: fixed・全画面オーバーレイ・is-open で表示）

## 縦余白（gap）
ヘッダー内は flex 横並びのみ。縦方向の積み上げセクションなし → セクション間 gap 計算は対象外。
ドロワー項目リストは項目間を border-bottom（区切り線）＋ padding で表現。

## 整合性チェック
- ✅ PC: ナビバー右端 rel-x 1332.24 = bbox 右端（フラッシュ）一致
- ✅ PC: 5セル(≈133.5)×5 + contact(104.20) = 771.7 ≒ ナビバー幅 772.06 一致
- ✅ SP: ハンバーガー右端 rel-x 328.95 ≒ bbox 右端 328.94 一致
- ⚠️ PNG はヘッダー bbox のみ（ページ全幅・端余白は非出力）→ ページ端の padding は参考案件「高圧フランジ」準拠で補完
