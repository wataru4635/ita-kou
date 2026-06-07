# MV 実装計画（工程3 / blueprint）

## Plan Mode 調査結果サマリ
- **影響範囲**: `ita-kou/front-page.php`（MV マークアップ）, `_vite/src/sass/module/_mv.scss`（全実装）, `_setting.scss`（`--accent-yellow:#FCEE21` 追加）, `_vite/src/js/top.js`（新規・Swiper init）。setup.php は swiper-js + top.js を front-page に enqueue 済み（変更不要）。
- **既存パターン**: 高圧フランジ MV（Swiper fade・スクロールダウン）正本。共有知識: 全幅セクションに max-width 付けない（#15/#20）、img は object-fit cover + width100%。
- **リスク**:
  - キャッチが XD ではベクターパス → CSS 縦書きで近似（字形差は pixeldiff で許容）。
  - Swiper fade で `.swiper-slide` 重なり → height100%・画像 cover。pagination はオーバーレイ上に出す（z 管理）。
  - 黒オーバーレイ 35% を pagination/コピーより下に。
- **代替**: 英字は PC=横（左右2要素）/ SP=縦書き。キャッチ=縦書きテキスト（画像化しない）。

## 適用パターン
- 高圧フランジ MV（Swiper） / 13 ピークスライダーの Swiper 注意点 / scroll-down(parts)

## HTML 構造（front-page.php）
```
section.mv
├ div.mv__slider.swiper.js-mv-swiper
│ └ div.swiper-wrapper
│   └ div.swiper-slide ×3 > picture(source sp / img mv_0X.webp cover)
├ div.swiper-pagination.js-mv-pagination.mv__pagination   (オーバーレイ上)
├ div.mv__copy
│ ├ p.mv__catch  「精度に妥協しない。<br>選ばれるものづくり。」(vertical-rl)
│ ├ p.mv__en.mv__en--left  Precision without compromise.
│ └ p.mv__en.mv__en--right Manufacturing that earns trust.
└ p.mv__scroll  SCROLL（scroll-down 相当）
```

## SCSS 方針（module/_mv.scss・入れ子なし・rem()・ls em・全幅 max-width無し）
- `.mv{ position:relative; width:100%; height:100vh; height:100dvh; overflow:hidden; }`
- `.mv__slider, .swiper-wrapper, .swiper-slide{ height:100%; }` `.swiper-slide img{ width:100%; height:100%; object-fit:cover; }`
- 黒オーバーレイ: `.mv__slider::after{ content:""; position:absolute; inset:0; background:rgba(0,0,0,.35); z-index:2; }`（swiper の上）
- `.mv__copy{ position:absolute; inset:0; z-index:3; }`（コンテナ）
- `.mv__catch{ position:absolute; top:57%; left:50%; transform:translate(-50%,-50%); writing-mode:vertical-rl; color:var(--white); font-weight:700; font-size:rem(52); line-height:1.4; letter-spacing:0.05em; }`（中央・やや下。SP: font rem(30)・位置調整）
- `.mv__en{ position:absolute; top:52%; transform:translateY(-50%); color:var(--white); font-size:rem(25); font-weight:500; letter-spacing:0.02em; }`
  - `--left{ right:calc(50% + rem(120)); text-align:right; }` `--right{ left:calc(50% + rem(120)); }`
  - SP: `writing-mode:vertical-rl; font-size:rem(15);` 位置はキャッチ左に縦並び（top:center / 左寄せ）
- `.mv__pagination{ position:absolute; left:rem(74); bottom:rem(30); z-index:4; width:auto; }`（Swiper default の中央配置を上書き）
  - bullet: `width:rem(8);height:rem(8);background:var(--white);opacity:1;` active: `background:var(--accent-yellow);` 間隔 gap。
- `.mv__scroll`（scroll-down 準拠）: `position:absolute; right:rem(30); bottom:rem(60); z-index:4; writing-mode:vertical-rl; text-transform:uppercase; color:var(--white); font-size:rem(16); padding-bottom:rem(80);` ＋ `::after` 縦線 1px×rem(70) 白 ＋ `@keyframes mv-scroll 2s infinite`。
- レスポンシブ: SP で catch/en サイズ・位置調整、scroll/pagination 位置調整。`@include mq("md")` で PC 値。

## セクション境界 margin-top
- ページ先頭の全画面セクション → margin-top なし（page-layout.md）。

## 画像リスト（配置済み・picture 出し分け）
| slide | img(PC) | source(SP) |
|---|---|---|
| 1 | top/mv_01.webp | top/mv_01_sp.webp |
| 2 | top/mv_02.webp | top/mv_02_sp.webp |
| 3 | top/mv_03.webp | top/mv_03_sp.webp |
- FV のため img は `loading="eager" fetchpriority="high"`（1枚目）。aspect-ratio は付けず cover。

## リスク対処
- Swiper未読込時 init ガード（`if(window.Swiper)`）。
- pagination をオーバーレイ上に（z4）＋ `.swiper` 外配置で `el` 指定。
- 黒オーバーレイ z2 < コピー/UI z3-4。
- `--accent-yellow:#FCEE21` 追加。

## 主要要素 XD 座標（rem=px÷16）
| 要素 | PC | SP |
|---|---|---|
| セクション | 1440×900 全画面 | 375×667 全画面 |
| オーバーレイ | #000 0.35 | 同 |
| キャッチ縦書き | 中央(x720)・縦中心519・≈52px Bold | 中央寄り・≈30px |
| 英字 | 25px Medium・横・中心y467・左右±120 | 15px Medium・縦書き |
| ページネーション | 左下 x74/y862・8px・active #FCEE21 | 左下・active #FCEE21 |
| スクロールダウン | 右下 b60/r30 縦"SCROLL"＋線 | 同（調整可）|
