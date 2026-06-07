# ドロワー design-context（XD 抽出値・正確値）

> 出典: `xd-file/drawer/export_0001.json`（アートボード 375×667・bg #FFFFFF）, PNG 375×667。
> 旧実装（navy 全画面）から **白背景・黒ロゴ・黒jp/灰en・青丸矢印・コピーライト** へ全面刷新。
> 座標はアートボード左上(x=620, y=2058)を 0 とした相対値。

## 配色
| 用途 | HEX | 備考 |
|---|---|---|
| ドロワー背景 | `#FFFFFF` | 白（アートボード fill） |
| ロゴ / jpメニュー文字 / コピーライト | `#231815` | XD: rgba(35,24,21)。`logo-black.svg` も #231815。→ `--ink:#231815` を追加 |
| enメニュー文字 | `#999999` | XD text fill。→ `--gray-text:#999999` を追加 |
| 矢印（丸）| `#03518F` | XD 楕円 fill（`arrow-blue.svg` 内・白矢印つき） |
| 区切り線 | `#000000` 太さ0.3px | → 実装は薄ハ罫線 `var(--gray)`(#ccc) で近似 |
| 閉じる×線 | `#000000` 太さ1.5px | 2本クロス（25.857×25.857） |

## ヘッダー部（group 161 / rel-x 24.40, rel-y 19.34, w 321.45, h 40.19）
### ロゴ（group 160 / rel-x 24.40, rel-y 19.34, w 211, h 40.19）→ `logo-black.svg`
- 「有限会社 板岡工作所」Reisho101Std-Medium fs22.77 #231815 / w211 h31
- 「ITAOKA MANUFACTURING」NotoSansJP-Medium fs7.65 ls100(=0.1em) #231815 center / rel-x 68.84, rel-y 48.53
- → SVG（305.82×49.925）を rem(211) 幅で表示（aspect 維持・ヘッダーSP と同寸）
### 閉じる×（group 149 / rel-x 319.997, rel-y 27.27, 25.857×25.857）
- 線119/120: 黒 #000 stroke 1.5px のクロス（X）。右上。
- ロゴ中心 rel-y≈39.34、×中心 rel-y≈40.2 → ヘッダー内で **上下中央そろえ**（align-items:center, padding-top≈19px）

## メニュー（group 538 / rel-x 35.87, rel-y 169.50, w 304.19, h 408.61）
- テキストノード: fs12 **Bold** textAlign:left ls40(=0.04em) lineHeight58.2 fill#999999、rel-x 36.80, rel-y 189.37, w238
  - 1ノードに7行（jp＋全角空白＋en）。jp は PNG 上で **黒(#231815)**、en は **灰(#999999)**（文字単位の色違いは JSON 非反映 → PNG 準拠）
  - jp/en とも 12px（最長行「プライバシーポリシー　PRIVACY POLICY」幅 ≒ 238 で 12px 検算一致）
  - jp=12px/700/#231815、en=12px/500/#999999（PNG 上 en はやや軽め・灰）
- 区切り線（黒 #000 0.3px）8本 rel-y: **169.50 / 225.73 / 282.30 / 341.98 / 400.67 / 459.14 / 518.77 / 578.11**
  - 行高（ライン間隔）≒ 56〜59px（≒58.2）。7行＝間8本（上端＋各行間＋下端）
- 青丸矢印（group150-156）#03518F 楕円 15.157×15.157、rel-x 320.01、各行の中央に縦そろえ → `arrow-blue.svg` rem(15)

### メニュー項目（7）
| jp（黒700） | en（灰500） | リンク |
|---|---|---|
| トップページ | TOP | HOME_URL |
| 業務内容 | SERVICES | SERVICES_URL |
| 設備紹介 | FACILITIES | FACILITIES_URL |
| 会社情報 | COMPANY | COMPANY_URL |
| 採用情報 | RECRUITMENT | RECRUITMENT_URL |
| お問い合わせ | CONTACT | CONTACT_URL（XD表記 "COPNTACT" タイポ→正しく CONTACT）|
| プライバシーポリシー | PRIVACY POLICY | PRIVACY_POLICY_URL |

## コピーライト（text / rel-x 84.50, rel-y 627.83, w206, h15）
- 「Copyright © ITAOKA KOSAKUSHO CO., LTD.」Noto Sans JP fs10 Light(300) ls40(=0.04em) center #231815、lineHeight12
- 画面下部（artboard 667 のうち rel-y 627.83、下端から約24px）

## 余白・配置（375基準）
- ドロワー padding: 上 ≈19 / 下 ≈25 / 左右 ≈24（ロゴ左24.4・×右余白29）
- メニュー領域は左右 ≈36（罫線 left35.87 / right余白34.94・矢印右余白39.83）→ nav に追加 padding-inline ≈12
- ロゴ下端(≈59.5) → 最初の罫線(169.5)：**約110px の余白**（PNG の大きな白スペース）
- × は黒（旧 navy 角丸ハンバーガーは閉時のみ。開時はドロワーが覆い、ドロワー内の黒×が閉じるボタン）
