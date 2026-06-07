# プロジェクト環境設定

このファイルは **あなたのプロジェクト固有の環境情報** を記録します。
AI（Claude Code）が build/scan/blueprint 開始前に必ず読み込み、`CODING_RULES.md` と合わせて
判断材料にします。

**未記入項目がある場合、AI が既存ソースコード（`src/sass/`, `src/scss/`, `src/css/` 配下）を
走査して自動的に埋めます。** 手動で修正しても構いません。

> 検出元: このプロジェクトの `_vite/src/sass/`（記法・関数・mixin・構造）
> ＋ `reference-projects/`（sakura-clinic-hm / sankoubou / hayashikogyo-kk）の実装（命名規則）。
> 3案件とも同一の `_vite` WPスターター・同一規約で一貫している。

---

## 1. CSS 設計手法
**BEM（独自ディレクトリ構造）** ← FLOCSS の `.l-/.p-/.c-/.u-` レイヤー接頭辞は **不使用**（過去3案件で `.p-`/`.c-` は 0 件）。
- block 名はセクション名ベース（例: `.access`, `.company`, `.company-craftsman`）
- element = `__`、modifier = `--`、要素名はケバブケース
- ユーティリティのみ `.u-`（`.u-desktop` / `.u-mobile` 等、`_breakpoints.scss` が提供）、レイアウト系に `.l-` / `.inner`
- ディレクトリは FLOCSS（object/component/project）ではなく **base / global / module / components** 構造

## 2. ディレクトリ構造
```
_vite/src/sass/
├── base/        ← _reset.scss / _base.scss（リキッドレイアウト・リセット）※編集禁止
├── global/      ← _function.scss / _breakpoints.scss / _setting.scss / _index.scss
├── module/      ← セクション単位（_mv.scss / _about.scss / _contact.scss / _inner.scss …）
├── components/  ← 共通UI（_header.scss / _footer.scss / _animation.scss）
└── style.scss   ← エントリ
```
- 各層の `_index.scss` は配下 `_*.scss` を `@forward` する自動生成ファイル（手で編集しない）
- 新規セクションは `module/` に、共通UIは `components/` に追加

## 3. SCSS エントリポイント
- スタイルファイル: `_vite/src/sass/style.scss`
- style.scss の構成: `@use "./base" as *;` → `@use "./global" as *;` → `@use "./module" as *;` → `@use "./components" as *;`
- foundation 読み込み方法: 各部分ファイルの先頭で `@use "../global" as *;` 1 行 → `rem()` / `mq()` / `vw()` / 設定変数がすべて入る

## 4. 命名規則 ★絶対遵守
- 設計: **BEM（ケバブケース）**。FLOCSS 接頭辞 `.p-`/`.c-` は不使用。
- 代表セレクタ例: `.access__info-item` / `.company__info-term--en` / `.bg-circle--01`
- Element 記法: `__`（例: `.company-craftsman__intro-title`）
- Modifier 記法: `--`（例: `.company__info-term--en`）。**状態・色違い・バリエーションは必ず modifier で表現**し、別名クラスを作らない。
- **区切り文字は `__`（要素）と `--`（修飾子）のみ。単一ハイフン `-` を区切りには使わない。**
  - 単語の連結はハイフンで行う（例: `company-craftsman`, `info-item`）。これは「区切り」ではなく「単語連結」なので OK。
  - ❌ `.company_craftsman`（スネークは使わない）／ ❌ `.company-info`（block-element を単一ハイフンで繋がない、必ず `__`）
- ケース: **ケバブケース**（block・要素名・修飾子すべて。キャメルケース／スネークケースは不使用）
- block 名: セクション/コンポーネント名そのまま（FLOCSS 接頭辞なし）。トップページのセクションは先頭に `top-`（例: `.top-news`）
- ※過去3案件（sakura-clinic / sankoubou / hayashikogyo）1139 件すべてこの規則。スネークケース実績は 0 件。

## 5. ユーティリティ関数・Mixin
- rem 関数: `rem($pixels)` → 16px 基準で rem 化（例: `rem(24)` = 1.5rem）。定義: `global/_function.scss`
  - 併設関数: `vw($window_width, $size)`（vw 換算）、`myClamp($min, $max, $min-vp:320, $max-vp:1440)`（clamp 生成）、`strip-unit($number)`
- メディアクエリ mixin: `@include mq("md") { ... }`。定義: `global/_breakpoints.scss`
  - ブレークポイント: `sm:600 / md:768 / lg:1024 / xl:1440`（px）
  - `$startFrom: sp`（**スマホファースト・min-width**。初期値）。`pc` に変更で PC ファースト・max-width に切替
  - 引数省略時の既定は `md`
- 変数ファイル: `global/_setting.scss`
  - **色・フォント・z-index・余白・アニメーションは CSS カスタムプロパティ（`:root`）で定義** → 参照は `var(--main-green)` 等
  - 主な色: `--main-green:#1eaa39` / `--main-green-bright:#39b54a` / `--main-green-deep:#006837` / `--accent-blue:#009fe8` / `--text-black:#444444` / グレー系
  - **新規カラー追加は `_setting.scss` の `:root` に CSS 変数として追加**（`$変数` ではなく `--変数`）
  - SCSS 変数は `$inner:1100px` / `$padding-pc:35px` / `$padding-sp:20px` が併存

## 6. ビルド環境
- ビルドツール: **Vite**（`_vite/` 配下。`theme.config.js` の `themeName` / `PROXY_TARGET` でサイト指定）
- watch モード: `npm run serve` 起動中は常時動作（SCSS/JS/画像/PHP を監視し自動ビルド＆リロード）
- **AI による手動ビルド実行**: 原則 **禁止**（serve 中は自動ビルド。納品前のみ手動 `npm run build`）
- 開発サーバー起動コマンド: `cd _vite && npm run serve`（`http://localhost:5173`、`PROXY_TARGET` をプロキシ表示）
- 本番ビルド: `npm run build`（CSS/JS ＋ 画像圧縮・WebP 変換）／画像のみ: `npm run build:images`
- 編集対象は **`_vite/src/` のみ**。出力は `kimpara-uniform/assets/`（dist 不使用）。`base/` は編集禁止

## 7. JavaScript
- エントリファイル: `_vite/src/js/script.js`
- `_vite/src/js/` 内の各 `.js` が個別ビルドされ `kimpara-uniform/assets/js/` へ出力

## 8. 画像出力先
- ルート: `_vite/src/images/`（serve/build で WebP 変換し `kimpara-uniform/assets/images/` に出力）
- ページ別サブフォルダ規則: `_vite/src/images/{page}/`（共通画像は `common/`）

## 9. HTML ファイル配置
**※ 静的 HTML ではなく WordPress テーマ。マークアップは PHP テンプレートに記述する。**
- テーマ本体: `kimpara-uniform/`（`style.css` / `functions.php` を持つ有効化対象テーマ）
- トップページ: `kimpara-uniform/front-page.php`（共通パーツ: `header.php` / `footer.php`）
- 下層ページ配置ルール: `kimpara-uniform/page-{slug}.php`（固定ページ）/ `single.php`（投稿）/ `404.php` 等の WP テンプレート階層に従う
- 部分テンプレートは `kimpara-uniform/inc/` を利用

## 10. コーディング規約（reference-projects 由来・kimpara 適合済み）

> 出典: `reference-projects/themes_01/CLAUDE.md`（sankoubou 規約正本）の汎用ルールを抽出し、
> kimpara の実定数・実クラス・実値に置き換えたもの。sankoubou 固有値はそのまま流用しない。

### 10-1. 共通クラスとページ固有クラスの使い分け
- 共通コンポーネント（`components/`）は **見た目のみ** 定義し、余白（margin 等）を持たせない。
- ページ固有の余白・配置は **同じ要素に固有クラスを併記** して制御する。ラッパーで囲んで分離しない。
  ```html
  <!-- GOOD --> <div class="cta-banner top-about__cta">
  <!-- BAD  --> <div class="top-about__wrapper"><div class="cta-banner"></div></div>
  ```
- SCSS 配置: 共通パーツ → `_vite/src/sass/components/`、ページ固有セクション → `_vite/src/sass/module/{ページ名}/`。
  ファイル名はフォルダ内でもページ名プレフィックスを付ける（例: `module/top/_top-news.scss` → `.top-news`）。短縮形（`_news.scss`）は使わない。
  `module/_index.scss` は自動更新のため手動編集不要。

### 10-2. リセット / body 既定値の重複記述禁止
- `base/_reset.scss` と `_setting.scss` の `body` で適用済みの値を個別クラスで再記述しない。
- body 既定（再記述しない）: `color: var(--text-black)` / `font-family: var(--font-family-base)` / `background-color: var(--body-bg)`。
- リセット済みの主な値: `box-sizing`, `margin:0`/`padding:0`（`ul,ol,p,h1〜h4,button,figure` 等）, `list-style:none`, `a` の `text-decoration:none`/`color:inherit`, `button/input` の `appearance/border/outline/background` リセット, `img` の `max-width:100%`/`display:block`, `cursor:pointer` 等。→ これらは書かない。

### 10-3. ホバーは `@media (any-hover: hover)` で囲む
- すべての `:hover` を `@media (any-hover: hover) { &:hover { ... } }` で囲む（タッチ端末の誤発火防止）。直書き `:hover` は禁止。

### 10-4. 画像運用
- `<img src>` は常に **`.webp`** を参照（`.png`/`.jpg` 直参照禁止）。
- 元の PNG/JPG は `_vite/src/images/{page}/` に配置 → ビルド（`npm run build`/`serve`）で `kimpara-uniform/assets/images/{page}/` に同名 `.webp` 自動生成。自前変換はしない。SVG は `_vite/src/images/` に置けばそのままコピーされ SVG 参照可。
- 画像パスは **`IMAGEPATH` 定数**（`inc/defines.php`、= `assets/images`）を使用。直書き禁止。
  ```php
  <img src="<?php echo IMAGEPATH; ?>/top/works_01.webp" alt="作品1" loading="lazy">
  ```
- 連番は `_01`,`_02` の2桁ゼロ埋め・アンダーバー区切り（`works_01.webp`）。ファイル名にフォルダ名プレフィックスは付けない。
- **レスポンシブ接尾辞 ★**: PC画像には接尾辞を付けない（`_pc` は付けない）。**SP専用画像のみ `_sp`** を付ける。
  - 例: PC = `mv-hero.webp` ／ SP専用 = `mv-hero-left_sp.webp`
  - PC/SP 出し分け（`<picture>`）の場合、デフォルト（=PC）の `<img>` は接尾辞なし、`<source media="(max-width: 767px)">` が `_sp`。例: `mv-bg.webp`（PC）／ `mv-bg_sp.webp`（SP）。
  - 単一画像（PC/SP共用）も当然接尾辞なし。

### 10-5. 内部リンクは URL 定数を使用
- `inc/defines.php` の URL 定数（`HOME_URL` / `ABOUT_URL` / `DUTIES_URL` / `WORKS_URL` / `COMPANY_URL` / `RECRUIT_URL` / `NEWS_URL` / `CONTACT_URL` / `PRIVACY_POLICY_URL` 等）を使用。URL 直書き禁止。
  ```php
  <a href="<?php echo CONTACT_URL; ?>">お問い合わせ</a>
  ```

### 10-6. ファーストビュー画像の読み込み属性
- FV（初期表示領域）の `<img>` には `loading="eager" fetchpriority="high"`（LCP 改善）。FV 以外は `loading="lazy"`。

### 10-7. aspect-ratio は `<img>` 本体に
- `aspect-ratio` は必ず `<img>` 自身に指定（`<picture>`/`<figure>`/`__media` 等のラッパーに書かない／CLS 対策）。
- `aspect-ratio` 指定時は **`height: auto` をセットで** 必ず書く（HTML の `height` 属性で潰れるのを防ぐ）。`width` を 100% 以外にする画像（アイコン等）も `height: auto`。
- SP/PC で比率が違う場合も `<img>` のクラスに mq で切り替える。

### 10-8. grid-template-columns の方針
- ビューポート追従を優先。inner 内の比率カラムは Figma px を `fr` で（例: `grid-template-columns: 487fr 454fr;`、`rem()` 固定にしない）。
- MV 等の全幅領域は「固定側 = `rem()`／伸縮側 = `1fr`」。全幅領域に `max-width` を付けない（右に余白ができる）。`gap`/`column-gap` は固定 rem で可。

### 10-9. SP インナーの max-width + padding-inline ルール（themes_01 由来・kimpara 適合）

セクションの `__inner` には **SP 用にも必ず `max-width` と `padding-inline` を設定**する。
viewport が SP デザイン幅〜767px（タブレット境界）のとき内容領域が一定幅に固定される構造にし、
ブラウザ幅が広がっても SP 範囲内で内容が間延びしないようにする。

```scss
.{section}__inner {
  margin-inline: auto;
  max-width: rem(500);                  // SP キャップ（kimpara 標準。既存 .inner と同じ）
  padding-inline: var(--padding-inline); // SP=15 / PC=30 自動切替

  @include mq("md") {
    max-width: rem({PC_DESIGN_WIDTH} + 60); // PC: デザイン幅 + 30*2
  }
}
```

- **SP `max-width`**: kimpara 標準は **`rem(500)`**（既存 `.inner` の SP キャップと同値）。
  デザインが特に狭い/広い場合のみ「SP コンテンツ幅 + padding×2」で調整。
- **PC `max-width`**: 「PC デザイン幅 + 60（=30×2）」。非対称配置時は「デザイン幅 + 左padding + 右padding」。
- `--padding-inline` は `_setting.scss` で SP=15px / PC=30px に自動切替されるため、**PC mq 内で `padding-inline` を再指定しない**。
- `padding-inline` を `rem(20)` 等の固定値で書かず必ず **`var(--padding-inline)`** を使う。

**Why**: SP用デザインは 390px viewport 前提だが、SPキャップ無しだと実機SP〜タブレット境界(〜767px)で
内容が 767px まで伸び、間延び・崩れの原因になる。共通パーツ・全セクションでこのパターンに揃える。

```scss
// GOOD
.contact-cta__inner {
  margin-inline: auto;
  max-width: rem(500);
  padding-inline: var(--padding-inline);
  @include mq("md") { max-width: rem(1281); } 
  
  }// 1221(デザイン) + 60

// BAD: SP で max-width を付けない（767px まで伸びる）／padding-inline を固定値で書く
```

#### 非対称PCレイアウトの上書き
PC で左右非対称配置にしたい場合は、SP標準パターンを維持したまま PC 側で
`margin-left: 0` ＋ `padding-inline: rem(L) rem(R)` を上書きする。

#### 画像をSPでビューポート端まで伸ばす場合
inner 内に置いたまま端まで伸ばすには `margin-left: rem(-15)`（SP padding を打ち消し）と
`width: calc(...)` を使う。MV 等の全幅 bleed は inner で囲まず section 直下に配置する（10-8 参照）。

#### 実装後チェック
- [ ] セクションの `__inner` に SP 用 `max-width: rem(500)` ＋ `padding-inline: var(--padding-inline)` があるか
- [ ] PC 側 `max-width` が「デザイン幅 + 60」（非対称は + L + R）になっているか
- [ ] `padding-inline` を固定値でなく `var(--padding-inline)` で書いているか
- [ ] 全幅 bleed したい要素は inner で囲まず section 直下にあるか
- [ ] 375/414/767/1024px で横スクロール 0（CODING_RULES G1）

### 10-10. スクロールアニメーション（kimpara 実装）
- kimpara は `_vite/src/js/script.js` の IntersectionObserver が、付与クラスに `.is-active` を付ける方式。
- 利用可能クラス（`components/_animation.scss` 定義）: `.js-fade-in` / `.js-fade-up` / `.js-fade-down` / `.js-slide-left` / `.js-slide-right` / `.js-scaleImg` / `.js-clip-img`。
- ※sankoubou の `.js-mv-fade-in` 系は kimpara には無いので使わない。フェード演出はこの kimpara 既存クラスを使う。

### 10-11. レスポンシブ画像の出し分けは `<picture>` を使う ★

PC と SP で **異なる画像ファイル** を表示する場合は、`<img>` を `u-desktop` / `u-mobile` で2枚重ねるのではなく、
**`<picture>` + `<source media>`** を使う。**形式は下記に統一する**：

```html
<picture>
  <source srcset="<?php echo IMAGEPATH; ?>/common/slider-arrow-left-sp.svg" media="(max-width: 767px)">
  <img src="<?php echo IMAGEPATH; ?>/common/slider-arrow-left.svg" alt="" aria-hidden="true" width="40" height="8" class="thumb-slider__arrow-img">
</picture>
```

- **`<img>`（デフォルト）= PC画像** / **`<source media="(max-width: 767px)">` = SP画像**。
- **class・`width`/`height`・`alt` は `<img>` 側**に付ける。`<picture>` は素の囲みタグ（class なし）。CSS の位置・サイズも `<img>` のクラスに適用する。
- 絶対配置の場合、基準は祖先の positioned 要素（`<picture>` は `position:static` なので基準にならない）。
- ブレークポイントは **`(max-width: 767px)`**（mq の `md`=768px の直下に揃える）。
- **同一画像** を PC/SP で使い回す場合は `<picture>` 不要（1枚の `<img>` を CSS でサイズ変更するだけ）。
- 表示/非表示だけの単純な出し分け（画像ファイルは同一）は従来どおり `.u-desktop` / `.u-mobile` で可。**画像ファイルが分岐するケースのみ `<picture>` 必須**。

### 10-12. グループ化される要素はラッパーで囲う ★

重なり・並びでひとまとまりになる要素群（MV の人物3名など）は、裸で section / `__inner` 直下に並べず、
意味のあるラッパー（例: `.mv__people`）で囲ってから配置する。

```html
<!-- GOOD -->
<div class="mv__people">
  <img class="mv__person mv__person--left" …>
  <picture class="mv__person mv__person--right">…</picture>
  <img class="mv__person mv__person--center" …>
</div>
<!-- BAD: 人物3枚を __inner 直下に裸で並べる -->
```

- ラッパーを座標系（`position:absolute; inset:0` 等）にし、子はその中で配置する。
- z-index の管理単位が「背景(0) < 人物群ラッパー(1) < テキスト/前面UI(3)」と明確になる。

### 10-13. ビューポート端ブリードは 50cqw を使う（横スクロール防止）★恒久

画面端まで広げるブリード（`margin-left/right: calc(50% - 50vw)` / `width: calc(50vw + …)`）は、
`vw` がスクロールバー幅を含むため **横スクロールが発生する**。これを防ぐため kimpara では以下に統一する：

- 外枠の section（ブリード要素の祖先）に **`container-type: inline-size;`** を付ける。
- ブリードの `vw` を **`cqw`** に置き換える：余白は `calc(50% - 50cqw)`、幅は `calc(50cqw + rem(X))`。
- `cqw` はスクロールバーを除いたコンテナ幅基準なので、端ぴったりまでブリードしても横スクロールが出ない。
- container-type を付けた要素自身の `cqw` は祖先コンテナを参照する（自己循環しない）。

```scss
.{section} { container-type: inline-size; }   // 外枠 section
.{block} {
  margin-left: calc(50% - 50cqw);   // 左端へブリード（旧 50vw は横スクロールの原因）
  margin-right: calc(50% - 50cqw);  // 右端へブリード
  width: calc(50cqw + rem(75));     // 端から内側へ一定量だけ伸ばす場合
}
```

**新規に `calc(50% - 50vw)` を書かない。既存の `50vw` ブリードは `cqw` に直す。**

### 10-14. 行が増減する表・リストの行高は固定しない ★恒久

会社概要・沿革・実績など「将来、行や文章量が増える」箇所は **行高を `height` で固定しない**。
固定すると項目追加・文章増で **はみ出す / 上下余白が消えて詰まる**。

- 最小高さ（デザインの行高）は **`min-height: rem(82)`** 等で担保（`height` は使わない）。
- 内容が増えても詰まらないよう **`padding-block`（上下余白）を併用**（例 `padding-block: rem(16)`、上下非対称も可 `rem(28) rem(16)`）。`box-sizing:border-box` 前提なので短い行は `min-height` のまま見た目不変、増えた分だけ伸びて下余白も残る。
- CSS Grid のトラックで組む場合は固定値 `rem(82)` 単体を使わず **`minmax(rem(82), auto)`**。追加行に備え **`grid-auto-rows: minmax(rem(82), auto)`** も指定。subgrid で2カラムを揃える場合もトラックは minmax にする（揃えたまま内容で伸びる）。

```scss
// GOOD（最小高さ維持＋増えたら下余白付きで伸びる）
.history-row { min-height: rem(82); padding-block: rem(16); }
.company-profile__table {
  grid-template-rows: minmax(rem(82), auto) minmax(rem(125), auto);
  grid-auto-rows: minmax(rem(82), auto);
}
// BAD（固定高さ＝行追加・文章増で破綻）
.history-row { height: rem(82); }
.company-profile__table { grid-template-rows: rem(82) rem(125); }
```

### 10-15. 改行 `<br>` のレスポンシブ出し分け ★

改行は **PC・SP 両方のカンプで位置を確認**し、デバイスで異なる場合はユーティリティ付き `<br>` で出し分ける（`global/_breakpoints.scss` に定義済み・CSS追加不要）。

| 改行箇所 | タグ |
|---|---|
| PC・SP 共通 | `<br>`（クラスなし） |
| **PCのみ**改行 | `<br class="u-desktop-inline">`（SPで `display:none`／PCで `inline`） |
| **SPのみ**改行 | `<br class="u-mobile-inline">`（SPで `inline`／PCで `display:none`） |

PCカンプだけ見て `<br>` を入れない（SPで不要な改行が残る／必要な改行が抜ける）。必ず両カンプを突き合わせる。

---

### 10-16. 色・フォントウェイトはデザイン(XD)で必ず確認して指定する ★恒久

**各テキストの色・font-weight は、推測せず必ず XD JSON の該当 `text` ノードを確認してから指定する。**
- `fontStyle` 無し=Regular(400) / `Medium`=500 / `Bold`=700。`fill.hex` が実際の色。
- 「だいたいこう」「親から継承で十分だろう」で済ませない。選択肢/ラベルが Bold、intro が Regular 等、見落とすと指摘になる。

**本文の主体色は #000（body 既定 `color: var(--black)`）。各要素で #000 を再指定しない（DRY）。**
- `_setting.scss` の `body { color: var(--black) }` が既定。`p`/`span`/`h*`/`dt`/`dd` 等は継承するので `color` 不要。
- `#444`(--text-black) 等、#000 以外が必要な箇所のみ明示する。
- **例外: `input` / `textarea` は body の色を継承しない**（リセットに `color: inherit` 無し）→ これらは `color` を明示。`button` は `color: inherit` 済み。

---

### 10-17. 固定ページテンプレートのヘッダーコメントは Template Name を日本語名にする ★恒久

固定ページテンプレート（`page-{slug}.php` 等）の先頭コメントは、`Template Name:` を **日本語のページ名** にする。
`* 採用情報 RECRUITMENT` のような **説明用の見出しコメント行（日本語/英語併記）は付けない**。

```php
<?php
/*
* Template Name: 採用情報
*/
?>
```

- `Template Name` は WordPress 管理画面（固定ページ編集 → ページ属性 → テンプレート）に表示されるラベル。日本語にすると編集者が選びやすい。
- 英語の併記やセクション見出し的なコメント（`* 〇〇 ENGLISH`）は冗長なので書かない。`Template Name` 1 行で内容が分かる。
- 日本語名の対応: トップページ（`front-page.php`）／業務内容（`page-services.php`）／設備紹介（`page-facilities.php`）／会社情報（`page-company.php`）／採用情報（`page-recruitment.php`）／お問い合わせ（`page-contact.php`）／お問い合わせ確認（`page-contact-confirm.php`）／お問い合わせ完了（`page-contact-thanks.php`）／プライバシーポリシー（`page-privacy-policy.php`）。
- ※ ページとテンプレートの紐付けはファイル名（DB の `_wp_page_template`）で管理されるため、`Template Name` ラベルを変更しても既存ページの割り当ては壊れない。

---

### 10-18. コメントは最小限に（説明コメント禁止・区切りのみ可）★恒久

**コードで自明なことを説明するコメントは書かない。** 値の根拠・実装理由などの説明コメントは残さない（命名と実装で意図を伝える）。

**SCSS**
- 実装意図・値の説明を書く `//` コメントは**書かない／既存も削除**する。
- 残してよいのは**セクション区切りのみ**：
  - ファイル/セクション見出しバナー `/* === ... === */`
  - 罫線区切り `////////` ＋ その見出しラベル行（例: `// 色の指定`）
- 1つの SCSS に複数セクション/ページが含まれる場合の区切り見出しは可（むしろ推奨）。

**PHP**
- 過度な説明コメント（処理の逐次解説・冗長な docブロック等）は書かない。
- **必ず残す機能コメント**: 固定ページテンプレートの `/* Template Name: 〇〇 */`（WordPress が参照するため削除厳禁）。
- セキュリティ/メール送信など**非自明な処理**に限り、簡潔な1行コメントで意図を示すのは可。
- ※ URL 文字列（`https://…`）内の `//` をコメントと誤認して削除しないこと。

---

## CODING_RULES.md との優先関係

`docs/CODING_RULES.md` は **プロジェクト横断の普遍原則**（rem単位主義・letter-spacing は em・
ボーダー線幅は px・padding 方向統一・display:flex の使い方・セマンティック HTML 等）を記述します。

**環境依存の具体値**（foundation のインポート方法・mq mixin の存在・ディレクトリ構造・
ビルドコマンド・命名記法等）は **このファイル（project-env.md）が優先** されます。

両者が矛盾する場合、**project-env.md > CODING_RULES.md** の順で解決してください。

`patterns/` ライブラリのカスタマイズは別途手動で行います（README.md の「パターンライブラリの
カスタマイズ」セクション参照）。

---

## パターン抽出（自動実行）

`docs/patterns-custom/` が空（`.gitkeep` のみ）かつ `reference-projects/` にプロジェクトがある場合、
blueprint 工程で **自動的にパターン抽出** が実行されます。

- `reference-projects/` 内の SCSS を走査し、3ゲートフィルタ（移植可能性・マスター重複・実質性）で選別
- 関連ファイルをテーマごとにマージし、アノテーション付きで `docs/patterns-custom/` に保存（上限15パターン）
- ファイル名の接頭辞（`_p-` / `_c-`）ではなくコード内容で判断する

⚠️ この処理は project-env.md の記入状態とは **独立** して実行されます。
⚠️ patterns-custom/ が空のまま build に進むのは、reference-projects/ も空の場合のみ許可されます。
