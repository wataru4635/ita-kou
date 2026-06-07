# ヘッダー design-context（XD 抽出値・正確値）

> 出典: `xd-file/header/export_0001.json`（PC / グループ138 1333×104）, `export_0002.json`（SP / グループ159 329×44）
> ロゴはユーザー提供の SVG を使用（テキストロゴをラスタ化せず画像化）。

## 配色

| 用途 | HEX | 備考 |
|---|---|---|
| ナビ背景バー / ハンバーガー背景 | `#003894` | XD: rgba(0,56,148) ＝ コーポレートネイビー（`_setting.scss` 未定義 → `--main-navy` を追加） |
| お問い合わせブロック背景 | `#CCCCCC` | 既存 `--gray: #cccccc` |
| ナビテキスト（TOP/業務内容…/英字） | `#FFFFFF` | `--white` |
| お問い合わせテキスト（jp/en） | `#000000` | `--black` |
| 区切り線 | `#FFFFFF` 太さ0.5px | ナビ項目間の縦罫線（高さ84.88px） |
| ロゴ文字 | `#FFFFFF` | SVG 側で白 |

## PC（グループ138 / コンテンツ bbox 1332.24 × 103.75、※ページ全幅ではない）

座標は bbox 左端(x=1635.89)を 0 とした相対値。

### ロゴ（グループ124）rel-x:0, y:27.40, w:331, h:62.68
- 「有限会社 板岡工作所」 Reisho101Std-Medium fs:35.70 lh:62.47(=1.75) 白 / w:331 h:48
- 「ITAOKA MANUFACTURING」 NotoSansJP-Medium fs:12 lh:14.4(=1.2) letterSpacing:100(=0.1em) 白 center / rel-x:70.32 y:73.08 w:168
- → SVG 1枚に統合。PC 表示幅 ≒ rem(331)、縦 62.68（aspect 331/62.68）

### ナビ背景バー（長方形170）#003894 / rel-x:560.18, y:0(top), w:772.06, h:103.75（上端・右端フラッシュ）

### ナビ項目（グループ134）rel-x:611.76, y:9.23, w:584.99, h:84.88（バー内で上下中央）
セル幅 ≒ 各 133.5px（5項目均等）＋ お問い合わせ 104.20px。

| 項目 | jp(14px Bold白) | en(11px Light白) | セル範囲 rel-x | リンク先 |
|---|---|---|---|---|
| TOP | y:44.41（単一行・en無し） | — | 560.18〜694.04 (133.86) | HOME_URL |
| 業務内容 / SERVICES | y:38.74 | y:63.38 | 694.04〜827.31 (133.27) | SERVICES_URL |
| 設備紹介 / FACILITIES | y:38.74 | y:63.38 | 827.31〜960.59 (133.28) | FACILITIES_URL |
| 会社情報 / COMPANY | y:38.74 | y:63.38 | 960.59〜1094.44 (133.85) | COMPANY_URL |
| 採用情報 / RECRUITMENT | y:38.74 | y:63.38 | 1094.44〜1228.04 (133.60) | RECRUITMENT_URL |

- 区切り線（線88〜91）: 白 0.5px、高さ84.88（バー上下中央、上下マージン約9.4px）。**5項目間に4本**（TOP|業務 / 業務|設備 / 設備|会社 / 会社|採用）。お問い合わせ前は色境界のため線なし。

### お問い合わせブロック（グループ135）#CCCCCC / rel-x:1228.04, y:0(top), w:104.20, h:103.75（上端・右端フラッシュ）
- 「お問い合わせ」 Noto Sans JP Bold fs:14 lh:24.5(=1.75) 黒 center / y:38.74 w:84
- 「CONTACT」 Noto Sans JP Light fs:11 lh:13.2(=1.2) 黒 center / y:63.38 w:54（XD表記は "COPNTACT" タイポ → 正しく "CONTACT"）/ リンク先 CONTACT_URL

### jp フォント値（共通）
- jp: font-size rem(14), font-weight 700, line-height 1.75（計算 24.5/14）
- en: font-size rem(11), font-weight 300, line-height 1.2（計算 13.2/11）, letter-spacing なし

## SP（グループ159 / コンテンツ bbox 328.94 × 43.45）

bbox 左端(x=11843.40)を 0 とした相対値。上端 y=21.20。

### ロゴ（グループ158）rel-x:0, y:0, w:211, h:40.19
- 「有限会社 板岡工作所」 Reisho101Std-Medium fs:22.77 lh:39.85(=1.75) 白 / w:211 h:31
- 「ITAOKA MANUFACTURING」 NotoSansJP-Medium fs:7.65 lh:9.19(=1.2) letterSpacing:100(=0.1em) 白 center / rel-x:44.44 y:50.39 w:108
- → SP 表示幅 ≒ rem(211)（aspect 211/40.19）

### ハンバーガー（グループ157）rel-x:287.82, y:2.32, w:41.13, h:41.13
- 背景（長方形154）: #003894 正方形 41.13×41.13
- 白バー2本（長方形155/156）: 各 22.47 × 2.94、ボタン内で上下左右中央、バー中心間隔 10.41px
  - bar1 中心 y:38.88 / bar2 中心 y:49.29

## ポジショニング方針（※XD はヘッダー bbox のみで、ページ端余白は非出力）
ユーザー指示により参考案件「高圧フランジ」に準拠：
- `position: absolute;`（追従なし、MV と重なる）
- PC: ナビバーは右上隅にフラッシュ（top:0 / right:0）。ロゴは左に配置（左 padding はサイト標準）。
- SP: 上 rem(20) 程度、左右 padding-inline。ハンバーガー右、ロゴ左。
- PC ナビ表示 / ハンバーガー切替は **md(768px) を境界**（ユーザー指定 `screen and (min-width:768px)`）。
  - ナビ幅・ロゴは素の `rem()` で記述 → リキッド root font-size（768で1rem≒10.24px、1200で16px）により 768px では約0.64倍に比例縮小して収まる（横スクロールなし）。1200px以上でデザイン実寸。myClamp/px固定は使わない。

## フォント読み込み注意（agent.md #19）
ナビ英字は Light(300)。現状 setup.php の Google Fonts は `400;500;600;700` のみ → **300 を追加**しないと 400 に化ける。
