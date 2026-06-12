# footer pixeldiff（修正後デザイン）

## 修正概要
- footer__name（中央「有限会社 板岡工作所」テキスト）を削除
- footer__address を2行化（本社／工場の2住所）
- Google Map を住所ブロック右下の独立リンクに変更（URL: https://maps.app.goo.gl/UQsTydJBx5pnhZ9AA）
- 比較対象デザインを修正後画像（xd-file/footer/修正/）に更新

## サマリ
- **PC マッチ率**: 93.87% / NCC 0.5682（XD 修正0001・1440x167・全体）
- **SP マッチ率**: 90.59% / NCC 0.6134（XD 修正0002・375x332・ロゴ上端で整合クロップ cropY=200）
- **RCA ループ回数**: 0回（初回から90%超で合格）
- **判定**: ○（PC・SP とも 90% 基準クリア）

## 残存差分の内訳と原因
- フォントのアンチエイリアス差（ロゴ筆書体・各テキスト）＝主因。差分は文字エッジのみで構造ずれなし。
- PC: ナビ/ボタン/to-top の横位置が XD の非対称レイアウト（左119/右44）に対し flex space-between 近似のため数px ずれ。住所2行・Google Map の位置は一致。
- SP: 修正画像はナビ帯を含まない部分図（ロゴ〜コピーライト）。実装はロゴ上端基準で整合。XD のロゴ下〜住所の行間が実装よりやや広く、下方要素が数px下方ドリフト（縦の二重像）。内容（本社/工場2行・Google Map）は一致。
- 意図仕様: 文言・住所は XD 修正版通り。

## 目視チェックリスト
- [x] footer__name（中央社名テキスト）が削除されている
- [x] footer__address が「本社」「工場」の2行表示
- [x] Google Map が住所ブロック右下に下線付きリンクで配置（文字幅の下線）
- [x] Google Map の href が https://maps.app.goo.gl/UQsTydJBx5pnhZ9AA
- [x] ロゴ・ナビ・お問い合わせpill・to-top・下段は従来通り維持（PC/SP）

## 計測条件
- pixelmatch(threshold=0.1)+NCC / compare.cjs・prep-footer-rev.cjs
- PC: 1440×167（XD 修正0001・#333合成・実装全体）
- SP: 375×332（XD 修正0002・#333合成・実装はロゴ上端で整合クロップ）
- 差分: mcp-log/.tools/diff-footer-rev-{pc,sp}.png
- 実装スクショ: footer-pc.png(1425×169) / footer-sp.png(360×552) @ http://ita-kou.localtest
