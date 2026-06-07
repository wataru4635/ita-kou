# drawer layer-analysis（工程2）

## 基本情報
- アートボード「アートボード 1 – 1」 id 13ef3d0a… / 375×667 / fill #FFFFFF

## レイヤー構造
```
artboard 375x667 (#FFF)
├ group539（コンテンツ枠 321.45×623.49, rel 24.40/19.34）
│ ├ group538（メニュー 304.19×408.61, rel 35.87/169.50）
│ │ ├ text 7行「トップページ　TOP … プライバシーポリシー　PRIVACY POLICY」 fs12 Bold ls0.04em lh58.2 #999999
│ │ ├ group150-156（青丸矢印 ×7：楕円#03518F 15.16＋白線/白パス）rel-x 320
│ │ └ line122-134（罫線 ×8：#000 0.3px）rel-y 169.5/225.7/282.3/342.0/400.7/459.1/518.8/578.1
│ └ group161（ヘッダー部 321.45×40.19, rel 24.40/19.34）
│   ├ group149（× 25.857×25.857：線119/120 #000 1.5px クロス）rel-x 320, rel-y 27.27
│   └ group160（ロゴ 211×40.19）
│     ├ text「有限会社 板岡工作所」Reisho 22.77 #231815
│     └ text「ITAOKA MANUFACTURING」NotoSans 7.65 ls0.1em #231815 center
└ text「Copyright © ITAOKA KOSAKUSHO CO., LTD.」fs10 Light ls0.04em center #231815, rel-y 627.83
```

## HTML 変換マッピング
| XD | HTML/CSS |
|---|---|
| artboard | `.header__drawer`（白・position:fixed・全画面・flex column） |
| group161 | `.header__drawer-head`（flex space-between・align center） |
| group160（ロゴ） | `.header__drawer-logo > img`（logo-black.svg） |
| group149（×） | `<button class="header__drawer-close js-drawer-close">`（疑似要素2本クロス #000 1.5px） |
| group538 + line + arrow | `nav.header__drawer-nav > ul > li.header__drawer-item > a`（jp/en span ＋ 矢印 img） |
| text（メニュー） | `.header__drawer-jp`（黒700）＋ `.header__drawer-en`（灰500） |
| line122-134 | `.header__drawer-item` の border-top（＋最終 border-bottom）= `var(--gray)` 1px |
| group150-156（矢印） | `.header__drawer-arrow img`（arrow-blue.svg rem(15)） |
| copyright text | `.header__drawer-copyright`（中央・margin-top:auto で下部固定） |

## 問題レイヤー / 注意
- jp/en 色違い: JSON は単一 fill #999999 だが PNG は jp=黒。**PNG 準拠で jp #231815 / en #999999**。
- 罫線 #000 0.3px は極細 → `var(--gray)`(#ccc) 1px ハ罫線で近似（視覚同等）。
- × は黒線クロス（旧 navy 角丸ハンバーガーは閉時のみ表示。開時はドロワーが覆い、ドロワー内黒×が閉じる）。
- 矢印・ロゴはユーザー提供 SVG（arrow-blue.svg / logo-black.svg）。SVG 自作なし。
- 全角空白（jp と en の区切り）は span 分離で実装（gap で間隔制御）。

## 画像リスト
- `assets/images/common/logo-black.svg`（黒ロゴ・ユーザー提供済み）
- `assets/images/common/arrow-blue.svg`（青丸矢印・ユーザー提供済み）

## ユーザー手動エクスポート依頼
- ✅ logo-black.svg / arrow-blue.svg とも配置済み
