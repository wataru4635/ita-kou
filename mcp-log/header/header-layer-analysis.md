# header layer-analysis（工程2）

## 基本情報
- PC: グループ138 / id 856bed9a… / bbox 1332.24 × 103.75（ヘッダーコンテンツ bbox。ページ全幅ではない）
- SP: グループ159 / id c4df682e… / bbox 328.94 × 43.45

## レイヤー構造（PC / export_0001）
```
グループ138（header bbox 1332×104）
├─ グループ137（ナビ右側 w772）
│  ├─ 長方形170  rect #003894（ナビ背景バー 772×104, 上端右端フラッシュ）
│  ├─ グループ135（お問い合わせ w104）
│  │  ├─ 長方形171 rect #CCCCCC（104×104）
│  │  └─ グループ125: text「お問い合わせ」(14 Bold 黒) /「COPNTACT」(11 Light 黒)
│  └─ グループ134（ナビ項目群 w585, y9.23, h84.88）
│     ├─ text「TOP」(14 Bold 白, 単一行)
│     ├─ グループ133: 業務内容(14B白)/SERVICES(11L白) + 線91(白0.5px h84.88)
│     ├─ グループ131: 設備紹介/FACILITIES + 線90
│     ├─ グループ129: 会社情報/COMPANY + 線89
│     └─ グループ127: 採用情報/RECRUITMENT + 線88
└─ グループ124（ロゴ w331, y27.40, h62.68）
   ├─ text「有限会社 板岡工作所」(Reisho 35.70 白)
   └─ text「ITAOKA MANUFACTURING」(NotoSans 12 白, ls0.1em)
```

## レイヤー構造（SP / export_0002）
```
グループ159（header bbox 329×44, y21.20）
├─ グループ157（ハンバーガー rel-x287.82, 41×41）
│  ├─ 長方形154 rect #003894（41×41）
│  └─ グループ107: 長方形155 / 156（白 22.47×2.94 ×2本, 中心間隔10.41）
└─ グループ158（ロゴ w211, h40.19）
   ├─ text「有限会社 板岡工作所」(Reisho 22.77 白)
   └─ text「ITAOKA MANUFACTURING」(NotoSans 7.65 白, ls0.1em)
```

## HTML 変換マッピング
| XD | HTML/CSS |
|---|---|
| グループ138/159（ヘッダー） | `<header class="header">` position:absolute |
| ロゴ群（124/158） | `.header__logo > a > img`（白SVG・ユーザー提供） |
| ナビ背景バー＋項目（137/134） | `.header__nav > ul.header__nav-items > li.header__nav-item`（PC, ≥lg） |
| 区切り線（線88-91） | `.header__nav-item` の `border-left`（白 0.5px） or 疑似要素 |
| お問い合わせ（135） | `.header__nav-item--contact`（bg #ccc, 黒文字） |
| ハンバーガー（157） | `<button class="header__hamburger">` (#003894, span×2) < lg |
| ドロワー（XD未提供） | `.header__drawer`（高圧フランジ参考・navy 全画面） |

## 問題レイヤー / 注意
- ナビバーは「上端・右端フラッシュ」配置 → PC は header__nav を flex 末尾、top:0 right:0 相当。
- ロゴは Reisho（筆書体）+ 英字の2段 → **ユーザー提供 SVG 1枚** に置換（フォント再現不要）。
- 区切り線 0.5px は CODING_RULES のボーダー px 直書き方針に合致（rem 化しない）。
- SP ハンバーガーは2本線（3本ではない）。
- 英字 Light(300) → Google Fonts に 300 追加が必要（agent.md #19）。

## 画像リスト
- ロゴ SVG（ユーザー提供予定）: `assets/images/common/logo.svg`
- ドロワー矢印: CSS 描画（画像不要 / agent.md 推奨）

## ユーザー手動エクスポート依頼
- ✅ ロゴ SVG（白）: ユーザーが用意（連絡済み）
