# drawer 実装計画（工程3 / blueprint）

## Plan Mode 調査結果サマリ
- **影響範囲**: `ita-kou/header.php`（`.header__drawer` 内を全面刷新）, `_vite/src/sass/components/_header.scss`（ドロワー関連を書き換え）, `_vite/src/sass/global/_setting.scss`（`--ink:#231815` `--gray-text:#999999` 追加）, `_vite/src/js/script.js`（閉じる×の click ハンドラ追加）。
- **既存パターン照合**: パターン03（ハンバーガー・ドロワー）。前回の navy 版から **XD 正本（白背景・黒ロゴ・黒jp/灰en・青丸矢印・コピーライト）** へ刷新。
- **リスク**:
  - jp/en 色違いが JSON 非反映（単一 fill #999999）→ PNG 準拠で jp #231815 / en #999999（CODING_RULES「部分色違いは PNG で確認」）。
  - 旧 navy ドロワーは XD 無しの推測実装だったため全面置換。
  - 閉じる×は黒線（白背景に合わせ）。閉時の navy 角丸ハンバーガーは XD ヘッダー由来で残す。開時はドロワー（白・不透明）が覆い、**ドロワー内の黒×が閉じるボタン**。
  - `img{width:100%}` リセット → ロゴ/矢印 img は width 明示。
- **代替設計比較**:
  - 閉じる方式: ①ハンバーガーを×へ変形して上に重ねる（前回方式） vs ②ドロワー内に独立した黒×を置く。→ **②採用**（XDドロワーが黒×を内包・白背景に黒×が正。ドロワーがハンバーガーを覆うため z-index はドロワー>ハンバーガー）。
  - 罫線: #000 0.3px 極細 → `var(--gray)`(#ccc) 1px ハ罫線で近似。
  - 矢印/ロゴ: ユーザー提供 SVG を `<img>` 配置（自作しない）。

## 適用パターン
- 03 ハンバーガー・ドロワー（白背景・リスト型）

## HTML 構造（header.php / `.header__drawer` 内）
```
div.header__drawer.js-drawer        (白・position:fixed・全画面・flex column)
├ div.header__drawer-head           (flex space-between / align center)
│ ├ {div}.header__drawer-logo > img(logo-black.svg)
│ └ button.header__drawer-close.js-drawer-close  (黒×・疑似要素2本)
├ nav.header__drawer-nav            (margin-top で本文へ・約110px)
│ └ ul.header__drawer-items
│   └ li.header__drawer-item > a.header__drawer-link        (×7)
│       ├ span.header__drawer-label
│       │   ├ span.header__drawer-jp（黒700）
│       │   └ span.header__drawer-en（灰500）
│       └ span.header__drawer-arrow > img(arrow-blue.svg)
└ p.header__drawer-copyright        (中央・margin-top:auto で最下部)
   ※項目: トップページ/TOP, 業務内容/SERVICES, 設備紹介/FACILITIES, 会社情報/COMPANY,
     採用情報/RECRUITMENT, お問い合わせ/CONTACT, プライバシーポリシー/PRIVACY POLICY
```

## SCSS 方針（入れ子禁止・rem()・ls em・ホバー any-hover・縦余白 margin-top）
- `.header__drawer`: `position:fixed; inset:0; width:100vw; height:100dvh; background-color:var(--white); z-index:var(--z-index-drawer); display:flex; flex-direction:column; padding-block:rem(19) rem(25); padding-inline:rem(24); overflow-y:auto; overscroll-behavior:none;` 既定 `opacity:0;visibility:hidden;transition`。`.is-open` で表示。`@include mq("lg"){display:none;}`
  - **z-index 調整**: ドロワーがハンバーガーを覆うよう、`.header__hamburger` の z-index を下げ（ドロワー > ハンバーガー）。閉時×変形は廃止。
- `.header__drawer-head`: `display:flex; justify-content:space-between; align-items:center;`
- `.header__drawer-logo img`: `width:rem(211); height:auto;`（logo-black.svg）
- `.header__drawer-close`: `width:rem(26); height:rem(26); position:relative;` ::before/::after で 黒 1.5px 線を rotate(45/-45) クロス（×）。
- `.header__drawer-nav`: `margin-top:rem(110);`（page-layout.md: ロゴ下59.5→最初の罫線169.5 の gap）。`max-width:rem(600); margin-inline:auto; width:100%;` ＋ `padding-inline:rem(12)`（メニュー左右36へ）
- `.header__drawer-item`: `border-top:1px solid var(--gray);`（罫線）。`.header__drawer-items` に `border-bottom:1px solid var(--gray)`（最下罫線＝計8本）
- `.header__drawer-link`: `display:flex; align-items:center; justify-content:space-between; min-height:rem(58);`
- `.header__drawer-label`: `display:flex; align-items:baseline; gap:rem(8);`（jp と en の全角空白を gap で）
- `.header__drawer-jp`: `font-size:rem(12); font-weight:700; letter-spacing:0.04em; color:var(--ink);`
- `.header__drawer-en`: `font-size:rem(12); font-weight:500; letter-spacing:0.04em; color:var(--gray-text);`
- `.header__drawer-arrow img`: `width:rem(15); height:rem(15);`（arrow-blue.svg）
- `.header__drawer-copyright`: `margin-top:auto; padding-top:rem(20); text-align:center; font-size:rem(10); font-weight:300; letter-spacing:0.04em; color:var(--ink);`
- ホバー: `@media (any-hover:hover)` で link / close に opacity。

## セクション境界 margin-top
- ドロワー内ブロック: head→nav 間 `margin-top:rem(110)`（page-layout.md gap）。nav→copyright は `margin-top:auto`（最下部固定、gap≈49〜可変）。

## 画像リスト
| 用途 | ファイル | 形式 | 取得 |
|---|---|---|---|
| ドロワーロゴ（黒） | `assets/images/common/logo-black.svg` | SVG | ユーザー提供済み |
| 矢印（青丸） | `assets/images/common/arrow-blue.svg` | SVG | ユーザー提供済み |

## リスク対処
- jp/en 色違い → span 分離（jp黒/en灰）。
- 罫線 0.3px → var(--gray) 1px 近似。
- × は CSS 疑似要素（SVG 自作回避）。
- z-index: ドロワー(var(--z-index-drawer)=1000) > ハンバーガー（→ 小さい値へ）。

## 主要要素 XD 座標リスト（rem=px÷16、375基準・rel）
| 要素 | rel-x | rel-y | size | gap/備考 |
|---|---:|---:|---|---|
| ロゴ(黒) | 24.40 | 19.34 | 211×40.19 | head 上端 |
| ×(閉) | 319.997 | 27.27 | 25.857² | 黒1.5px |
| メニュー枠 | 35.87 | 169.50 | 304.19×408.61 | head 下から gap≈110 |
| 罫線 ×8 | 35.87 | 169.5/225.7/282.3/342.0/400.7/459.1/518.8/578.1 | #000 0.3px | 行高≈58 |
| jp/en text | 36.80 | 189.37〜 | 12px | jp700黒 / en500灰 ls0.04em |
| 矢印 ×7 | 320.01 | 各行中央 | 15.157² | #03518F |
| コピーライト | 84.50(中央) | 627.83 | 206×15 | 10px 300 中央 #231815、gap→下端24 |
