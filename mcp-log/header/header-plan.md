# header 実装計画（工程3 / blueprint）

## Plan Mode 調査結果サマリ
- **影響範囲**: `ita-kou/header.php`（マークアップ刷新）, `_vite/src/sass/components/_header.scss`（全実装）, `_vite/src/sass/global/_setting.scss`（`--main-navy:#003894` 追加）, `_vite/src/js/script.js`（ドロワー開閉・スクロールロック追加）, `ita-kou/inc/setup.php`（Google Fonts に weight 300 追加）。
- **既存パターンとの照合**: パターン02(ヘッダー)＋03(ハンバーガー・ドロワー)。さらに**ユーザー指定の参考案件「高圧フランジ」`module/_header.scss` ＋ `page/_top-header.scss` の構造を正本**とする（クラス構成 `.header__inner/__logo/__nav/__nav-item/__hamburger/__drawer` をそのまま踏襲、命名は ita-kou=BEMケバブ無接頭辞で一致）。
- **リスク・検討事項**:
  - 英字 Light(300) フォント未読込 → 400化（agent.md #19）→ setup.php に 300 追加。
  - `img{width:100%}` リセット → ロゴ/ハンバーガー span は img でないため影響小だが、ロゴ img は width 明示。
  - position:absolute ヘッダーは MV と重なる（front-page MV 未実装 → 現時点は白背景上に白ロゴで視認不可だが、設計通り）。pixeldiff は背景を当てて検証。
  - ドロワーは XD 未提供 → 高圧フランジ参考に navy 全画面で新規設計（推測実装の旨を計画に明記）。
- **代替設計案比較**:
  - ドロワー表示: jQuery fadeIn（高圧フランジ） vs vanilla `visibility/opacity`+`.is-open`。→ ita-kou は jQuery 非使用・バニラJS（script.js）のため **`.is-open` トグル＋ CSS transition(opacity/visibility)** を採用。
  - 区切り線: 疑似要素 vs `border-left`。→ `border-left`（白 0.5px）採用（シンプル・px直書きは罫線につき規約OK）。
  - 矢印（ドロワー）: 画像 vs CSS描画。→ CSS描画（agent.md 推奨・アセット欠落回避）。

## 適用パターン
- 02 ヘッダー・ナビ（非固定 / position:absolute）
- 03 ハンバーガー・ドロワー（SP・< lg）
- 参考正本: reference-projects/高圧フランジ（header 構造・ドロワー形状）

## HTML 構造（header.php）
```
header.header  (position:absolute, MV と重なる)
└ div.header__inner  (flex / space-between / align-items 調整)
  ├ {h1|div}.header__logo > a.header__logo-link > img.header__logo-img  (白SVG, ユーザー提供 logo.svg)
  ├ nav.header__nav  (PC ≥lg のみ)
  │ └ ul.header__nav-items
  │   ├ li.header__nav-item            > a > p.header__nav-jp「TOP」                       (HOME_URL)
  │   ├ li.header__nav-item            > a > .header__nav-title(p.jp「業務内容」/ p.en「SERVICES」)   (SERVICES_URL)
  │   ├ li.header__nav-item            > a > .header__nav-title(設備紹介 / FACILITIES)        (FACILITIES_URL)
  │   ├ li.header__nav-item            > a > .header__nav-title(会社情報 / COMPANY)           (COMPANY_URL)
  │   ├ li.header__nav-item            > a > .header__nav-title(採用情報 / RECRUITMENT)        (RECRUITMENT_URL)
  │   └ li.header__nav-item--contact   > a > .header__nav-title(お問い合わせ / CONTACT)        (CONTACT_URL)
  ├ button.header__hamburger.js-hamburger  > span ×2          (SP <lg)
  └ div.header__drawer.js-drawer
    └ nav.header__drawer-nav > ul.header__drawer-items
      └ li.header__drawer-item > a (.header__drawer-text「○○」+ span「EN」 / i.header__drawer-arrow CSS矢印) ×7
        (トップページ/TOP, 業務内容/SERVICES, 設備紹介/FACILITIES, 会社情報/COMPANY,
         採用情報/RECRUITMENT, お問い合わせ/CONTACT, プライバシーポリシー/PRIVACY POLICY)
```

## SCSS 方針（components/_header.scss・入れ子禁止・rem()・ホバーは any-hover）
- `.header`: `position: absolute; top:0; left:0; width:100%; z-index: var(--z-index-header);`
- `.header__inner`: `display:flex; justify-content:space-between; align-items:flex-start;`
  - SP: `padding: rem(20) var(--padding-inline) 0;`（上20・左右はサイト標準）/ align-items:center
  - PC(≥lg): `padding:0; padding-left: rem(40);` ナビは右上フラッシュ（inner に padding-right:0、ナビ自身が右端）。ロゴは `margin-top: rem(27);`
- `.header__logo-img`: SP `width: rem(211);` PC `width: rem(331);` + `height:auto`（aspect はユーザーSVG準拠 / リセットの width:100% を上書き）
- `.header__nav`: `display:none;` → `@include mq("lg"){ display:block; }`
- `.header__nav-items`: `display:flex;`（バー背景 #003894 はこの ul に付与、高さ rem(104)）
- `.header__nav-item`: 幅 `rem(133.5)` 目安、中身 `<a>` を `height:100%;display:flex;flex-direction:column;justify-content:center;align-items:center;` 白文字。2〜5番目に `border-left: 0.5px solid var(--white);`（上下マージンを擬似で 9.4px ≒ height:rem(85) 罫線）→ 罫線高さ調整は border ではなく **疑似要素 or item に縦 padding** ではなく、`.header__nav-item:not(:first-child) > a::before`（白0.5px・高さrem(85)・絶対配置左）で再現。
- `.header__nav-jp`: `font-size: rem(14); font-weight:700; line-height:1.75; color:var(--white);`
- `.header__nav-en`: `font-size: rem(11); font-weight:300; line-height:1.2; color:var(--white); margin-top: rem(2);`
- `.header__nav-item--contact`: `background-color: var(--gray);` 文字色 `var(--black)`（jp/en とも）幅 `rem(104)`。
- `.header__hamburger`: `width:rem(41);height:rem(41);background-color:var(--main-navy);position:relative;z-index:var(--z-index-hamburger);` span 白 `width:rem(22);height:rem(3);` 中央配置・間隔 rem(10)。`@include mq("lg"){display:none;}`。`.is-open` で span を X 化。
- `.header__drawer`: `position:fixed; inset:0; width:100vw; height:100dvh; background-color:var(--main-navy); z-index:var(--z-index-drawer); padding-block:rem(110) rem(40); padding-inline:var(--padding-inline); overflow-y:auto; overscroll-behavior:none;` 既定 `opacity:0;visibility:hidden;transition`。`.is-open`で表示。`@include mq("lg"){display:none;}`
- `.header__drawer-item a`: `display:flex;justify-content:space-between;align-items:center;padding-block:rem(20);border-bottom:1px solid rgba(255,255,255,.4);` 白文字。
- `.header__drawer-text`: `font-size:rem(16);` `span`(en) `font-size:rem(12);margin-left:rem(12);color: rgba(255,255,255,.6);`
- `.header__drawer-arrow`: CSS 描画（白 ›）`width:rem(8);height:rem(8);border-top/right:2px solid var(--white);transform:rotate(45deg);`
- ホバー: 全て `@media (any-hover:hover)` 内。nav-item:hover → bg反転 or opacity; contact:hover → 白背景; drawer-item:hover → opacity .7。
- 縦余白は margin-top（gap/flex-column-gap 不使用方針に従う）。

## セクション境界 margin-top
- ヘッダーは position:absolute の独立コンポーネント → セクション境界 margin-top なし（page-layout.md 通り、縦積みセクション対象外）。

## 画像リスト
| 用途 | ファイル | 形式 | 取得 |
|---|---|---|---|
| ロゴ（白） | `assets/images/common/logo.svg` | SVG | ユーザー提供（連絡済み）。配置先 `_vite/src/images/common/logo.svg` → ビルドで assets へコピー |
| ドロワー矢印 | なし | CSS描画 | - |
| ハンバーガー線 | なし | span 2本 | - |

## リスク対処
- ロゴ未配置時はリンク切れ画像になる → `alt="有限会社 板岡工作所"` を付与、width/height で CLS 防止。ユーザーが logo.svg を置けば表示。
- 英字 300 未読込 → setup.php の Google Fonts URL を `wght@300;400;500;600;700` に更新（preload と stylesheet 両方）。
- position:absolute で MV 未実装時 pixeldiff は背景を別途当てて検証（白背景に白ロゴは不可視のため、ナビ部分中心に検証）。

## 主要要素 XD 座標リスト（rem は ÷16）
| 要素 | PC(px) | SP(px) | gap/備考 |
|---|---|---|---|
| ナビバー高さ | h:103.75 → rem(104) | - | 上端右端フラッシュ |
| ナビセル幅 | 133.5 → rem(133.5) | - | 5項目均等 |
| お問い合わせ幅 | 104.20 → rem(104) | - | bg #ccc |
| 区切り線 | 0.5px × h84.88→rem(85) | - | 4本（項目間） |
| jp テキスト | fs14/700/lh1.75 | - | 白 |
| en テキスト | fs11/300/lh1.2 | - | 白 |
| ロゴ | 331×62.68 | 211×40.19 | y:27(PC)/上端(SP) |
| ハンバーガー | - | 41.13×41.13, バー22.47×2.94 ×2, 中心間隔10.41 | bg navy |
| ヘッダー上余白 | 27(ロゴ) | 20(全体) | 高圧フランジ準拠補完 |
