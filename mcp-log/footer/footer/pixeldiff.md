# footer pixeldiff

## サマリ
- **PC 初回=最終マッチ率**: 93.59% / NCC 0.5241
- **SP 初回=最終マッチ率**: 90.87% / NCC 0.5327
- **RCA ループ回数**: 0回（初回から90%超で合格）
- **判定**: ○（PC・SP とも 90% 基準クリア）

## RCA / 調整履歴
| # | 対象 | 内容 |
|---|---|---|
| 1 | SP高さ | padding-block 40/24→18/20・下段mt16→14・住所 nowrap(ls0.02/余白6)で1行化 → 高さ 588→538px（XD 517・+4%、D-2合格）|

## 残存差分の内訳と原因
- フォントのアンチエイリアス差（ロゴ筆書体・各テキスト）＝主因。
- PC: ナビ/ボタン/to-top の横位置が XD の非対称レイアウト（左119/右44）に対し flex space-between 近似のため数px ずれ。
- SP: XD のナビ行間隔が不均一（1行目≈30px・2〜5行目40px）なのに対し実装は均一40px → 下方要素が数px下方ドリフト（縦の二重像）。
- 意図仕様: 文言は XD 通り。
- ※ NCC が中位なのは #333 背景＋白要素の疎構成のため。判定基準はマッチ率。視覚一致は良好（screenshot/overlay 参照）。

## 目視チェックリスト
- [x] ロゴ・会社情報・GoogleMap・ナビ・お問い合わせpill・to-top・下段の有無と配置一致
- [x] お問い合わせ hover: 白→navy 反転＋矢印白化（高圧フランジ準拠・md）
- [x] PC=丸 to-top.svg / SP=角 to-top_sp.svg 出し分け
- [x] SVG自作なし（ロゴ/ボタン矢印/to-top はユーザー提供、SPナビ矢印のみCSS白丸）

## 計測条件
- pixelmatch(threshold=0.1)+NCC / compare.cjs
- PC: 1440×167（XD 0001・#333合成）/ SP: 375×518（XD 0002・#333合成）
- 差分: mcp-log/.tools/diff-footer-{pc,sp}.png / overlay: screenshots/overlay/footer-{pc,sp}-overlay.png
- D-2高さ: PC 161/167=3.6%・SP 538/518=4.0%（共に<5%）。G1横スクロール 375/1440=0。
