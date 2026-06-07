# 〇〇プロジェクト - コーディングルール

> **このファイルの位置づけ**
>
> - ここに書かれているのは **プロジェクト横断の普遍原則**（rem 単位主義・letter-spacing は em・
>   padding 方向統一・gap の使い方・セマンティック HTML 等）です。
> - **環境依存の具体値**（`@use "foundation" as *;` が使える/使えない、`@include mq("md")` の有無、
>   `.p-*` FLOCSS 記法 / BEM 記法、`rem()` 関数の定義有無、ディレクトリ構造、ビルドコマンド等）は
>   `docs/project-env.md` が上書きします。
> - 本ファイル内のコード例は作者の FLOCSS 環境に合わせた具体値です。あなたの環境で命名規則・
>   ユーティリティ定義が異なる場合は **`project-env.md` の値を優先** してください。
> - 判断に迷った場合は **`project-env.md` > `CODING_RULES.md`** の順で解決し、それでも不明なら
>   `project-env.md` の「参照すべき既存実装」に登録された既存ソースコードを実装の参考にしてください。

## 📋 基本ルール

### ⚠️ 【超重要】SCSSファイルのインポート記述（必読・厳守）

**新規SCSSファイルを作成する際の絶対ルール：**

- **SCSSファイルの先頭には以下の1行のみを記述する**
  ```scss
  @use "foundation" as *;
  ```

- **❌ 絶対にNG：以下のような複数行のインポートは不要**
  ```scss
  // ❌ これは書かない！
  @use "../../foundation/functions" as *;
  @use "../../foundation/variables" as *;
  @use "../../foundation/mixin" as *;
  ```

- **`style.scss`への追記も不要**
  - `style.scss`は既に`@use "./object/project/**";`でワイルドカードインポート済み
  - 新規ファイルを作成すれば自動的に読み込まれる
  - **絶対に手動で追記しないこと**

**理由：**
- プロジェクトの設定により、`foundation`だけで全ての基礎モジュール（functions、variables、mixin）が読み込まれる
- 複数行書くと重複エラーが発生する
- ワイルドカードが機能しているため、`style.scss`への追記は不要

---

### 1. ネーミング規則
- **FLOCSS記法を基本とする**
  ```scss
  // ブロック
  .p-about { } // OK
  
  // エレメント（__の後もキャメルケース）
  .p-about__itemText { } // OK
  .pAbout__item-text { } // NG（ハイフンは使わない）
  
  // モディファイア（--の後もキャメルケース）  
  .p-about__itemText--isActive { } // OK
  .pAbout__itemText--is-active { } // NG（ハイフンは使わない）
  ```

### 2. SCSS記法
- **入れ子構造を使用しない**
- **メディアクエリは積極的に入れ子で記述**
- **メディアクエリは対象クラス内で個別に`@include mq("md")`等を記述し、ファイル末尾にまとめない**
  ```scss
  .p-pageTop {
    position: fixed;
    right: rem(30);
    bottom: rem(30);
    z-index: 50;
    cursor: pointer;

    @include mq("md") {
      right: rem(25);
      bottom: rem(20);
    }
  }

  .p-pageTop__wrap {
    position: relative;
  }

  .p-pageTop__wrap img {
    width: rem(50);
  }
  ```

### 3. 単位指定
- **rem()関数を必ず使用**
- **デザインカンプのpx値をrem()に入れる**
  ```scss
  font-size: rem(16); // デザインカンプで16pxの場合
  margin: rem(20) rem(0) rem(10) rem(0); // デザインカンプで20px 0 10px 0の場合
  ```

#### ⚠️ calc() の中で rem() を使うとき `#{}` は不要

Dart Sass（本プロジェクトの Vite ビルド）は `calc()` 内でもユーザー定義の `rem()` を評価する。
そのため補間 `#{}` で囲む必要はない。**`#{}` は付けない**こと。

```scss
// ✅ OK（calc(50% + 7.5rem) と出力される）
right: calc(50% + rem(120));

// ❌ NG（冗長。#{} は不要）
right: calc(50% + #{rem(120)});
```

※ `#{}`（補間）が必要なのは「文字列の中に値を差し込む」場合のみ（例: `@media` の文字列、`_breakpoints.scss` の `"(min-width: #{...}px)"`）。`calc()` 内の数値計算では不要。

#### ⚠️ 【重要】letter-spacingはem単位で記述（rem()関数は使用禁止）

**letter-spacingは唯一の例外で、必ず`em`単位で記述してください。**

**計算方法:**
```
letter-spacing(px) ÷ font-size(px) = em値
```

**計算例:**

| font-size | letter-spacing (XD) | 計算 | SCSS記述 |
|-----------|------------------------|------|----------|
| 24px | 2.4px | 2.4 ÷ 24 = 0.1 | `letter-spacing: 0.1em;` |
| 16px | 2px | 2 ÷ 16 = 0.125 | `letter-spacing: 0.125em;` |
| 50px | 4px | 4 ÷ 50 = 0.08 | `letter-spacing: 0.08em;` |
| 32px | 3.2px | 3.2 ÷ 32 = 0.1 | `letter-spacing: 0.1em;` |

**コード例:**
```scss
// ✅ OK
.p-hero__title {
  font-size: rem(48);
  letter-spacing: 0.1em;  // XDで4.8pxの場合: 4.8 ÷ 48 = 0.1
}

// ❌ NG
.p-hero__title {
  font-size: rem(48);
  letter-spacing: rem(4.8);  // rem()関数は使用禁止
  letter-spacing: 4.8px;     // px単位も禁止
}
```

**理由:** `em`単位はフォントサイズに対する相対値なので、フォントサイズが変わっても文字間隔の比率が維持されます。

### 4. パディング・マージンの方向統一
- **パディングは上方向と右方向に統一**
  ```scss
  // OK
  padding-top: rem(20);
  padding-right: rem(15);
  
  // NG
  padding-bottom: rem(20); // 下方向は使わない
  padding-left: rem(15);   // 左方向は使わない
  ```

- **パディングは上下方向と左右方向は以下の書き方**
```scss
// OK
padding-block: rem(50);
padding-inline: rem(25);

// NG
padding: rem(80) rem(0) rem(80) rem(0);
padding: rem(0) rem(25) rem(0) rem(25);
```

### 5. パディング・マージンの書き方

```scss
// OK
margin-inline: auto;

// NG
margin: 0 auto;
```
- **ベースリセットで処理済みのため、個別コンポーネントでは`margin: 0;`や`padding: 0;`などのゼロ指定は極力書かない**

### 6. HTMLの構造
pタグが単体の場合はdivで囲わない

```html
<!-- OK -->
<p class="p-topAbout__text">
  texttext
</p>

<!-- NG -->
<div class="p-topAbout__textLabel">
  <p class="p-topAbout__textLabelText">
    texttext
  </p>
</div>
```

但し、以下の場合はdivで囲って良い  
pタグが単体じゃない。またはpタグでも別のclassがついている。

```html
<div class="p-flow__stepContent">
  <h3 class="p-flow__stepTitle">タイトル</h3>
  <p class="p-flow__stepDescription">
    テキストテキストテキストテキスト
  </p>
</div>

<div class="p-flow__stepNumber">
  <p class="p-flow__stepText">STEP</p>
  <p class="p-flow__stepDigit">02</p>
</div>
```

### 6.4 行が増減する表・リストの行高（将来の追加を見据える）

**会社概要・沿革・実績など「将来、行や項目が増える / 各行の文章量が変わる」箇所は、行の高さを `height` で固定しない。**
固定すると、項目が増えたり文章が長くなったときに **内容がはみ出す / 上下余白が消えて詰まる** ため。

| やりたいこと | 書き方 |
|---|---|
| 各行に最小の高さを持たせる（デザインの行高を維持） | `min-height: rem(82);`（`height` は使わない） |
| 内容が増えても詰まらないよう上下余白を確保 | `padding-block: rem(16);`（`min-height` と併用） |
| CSS Grid のトラックで行を組む場合 | `grid-template-rows: minmax(rem(82), auto);`（固定値の `rem(82)` 単体は使わない）。追加行に備え `grid-auto-rows: minmax(rem(82), auto);` も指定 |

```scss
// ✅ OK：最小高さを保ちつつ内容で伸びる（border-box 前提）
.history-row {
  min-height: rem(82);     // デザインの行高（最小）
  padding-block: rem(16);  // 増えても上下に余白が残る
}

// ✅ OK：Grid トラックも固定しない
.profile-table {
  display: grid;
  grid-template-rows: minmax(rem(82), auto) minmax(rem(125), auto);
  grid-auto-rows: minmax(rem(82), auto);
}

// ❌ NG：固定高さ（行が増える / 文章が伸びると破綻）
.history-row { height: rem(82); }
.profile-table { grid-template-rows: rem(82) rem(82) rem(125); }
```

- 現在のコンテンツ量では `min-height`（またはトラックの min）が効いてデザイン通りの行高になり、**内容が増えた分だけ自然に伸びる**。
- `box-sizing: border-box`（ベースで設定済み）のため、`min-height` に `padding` を加えても短い行は `min-height` のまま（見た目は変わらない）。

### 6.5 改行（`<br>`）のレスポンシブ出し分け（PC / SP）

**改行は必ず PC・SP 両方のカンプで位置を確認し、デバイスで異なる場合はユーティリティ付き `<br>` で出し分ける。**

| 改行が入る箇所 | 使用するタグ |
|---|---|
| PC・SP 共通で改行する | `<br>`（クラスなし） |
| **PC のみ**改行する（SP では改行しない） | `<br class="u-desktop-inline">` |
| **SP のみ**改行する（PC では改行しない） | `<br class="u-mobile-inline">` |

- `u-desktop-inline` … SP で `display: none` / PC で `display: inline`（= PC だけ改行が効く）
- `u-mobile-inline` … SP で `display: inline` / PC で `display: none`（= SP だけ改行が効く）
- 上記2クラスは `global/_breakpoints.scss` に定義済み。**新規定義・CSS追加は不要**（HTML 側でクラスを付けるだけ）。

```html
<!-- PC では2行・SP では改行せず1行で流す -->
<p>しっかりとした工程管理の元、<br class="u-desktop-inline">高精度・高品質を実現する加工技術。</p>

<!-- SP でだけ折り返す（PC では改行しない） -->
<p>・TOYOイノベックス株式会社<br class="u-mobile-inline">（旧 東洋機械金属株式会社）</p>

<!-- PC・SP 両方で同じ位置に改行する -->
<p>受け継がれる職人の技。<br>進化を続ける最新設備。</p>
```

> ⚠️ 「PC のカンプだけ見て `<br>` を入れる」のは NG。SP で不要な改行が残る／逆に SP で必要な改行が抜ける原因になる。**必ず両カンプを突き合わせてから** どの `<br>` を使うか決めること。

### 7. Googleフォントの読み込み
- XD JSONで使用フォントが特定できたら、`<head>`内に該当するGoogle Fontsの読み込みタグを必ず追記する
- 追加したフォントは`_variables.scss`に変数として登録し、各コンポーネントはその変数を参照する

### 8. 形状・画像指定に関するルール
- 正円は`border-radius: 100%`で指定する（`9999px`などの値は使用しない）
- `object-fit: contain`は使用禁止。必要な場合は事前に相談する

### 9. ビルド・コンパイルについて
- **コーディング完了後の手動コンパイル（`npm run build`等）は不要**
- 開発環境ではGulpのwatchモードが常時動作しているため、ファイル保存時に自動的にコンパイルされる
- AIはコーディング完了後にビルドコマンドを実行しないこと





## 🎨 変数管理ルール

### 変数定義の原則（コーディング開始前）
**⚠️ コンポーネント実装前に必ず実施すること**

1. **XD JSONからの変数抽出**
   - コーディングを始める前に、必ずXD JSONの `text` ノードからフォント・カラー情報を確認する
   - 確認した色・フォント情報を `_variables.scss` にすべて定義する
   - **推測で変数を定義しない**（必ずXD JSONの値を正解とする）

2. **未知のスタイルへの対処**
   - 実装中に `_variables.scss` にない新しい色やフォントサイズが出てきた場合：
     - ① まずXD JSONを再確認する（見落としがないか）
     - ② 本当に新しいスタイルなら、まず `_variables.scss` に変数を追加する
     - ③ その後でコンポーネントで使用する
   - **その場で直接HEXコードなどを書かないこと**

### 色指定
**_variables.scssに定義されている色変数を必ず使用すること**
- カラーコードを直接記述せず、必ず変数で指定する
- 例: `color: #000000;` ❌ → `color: $black;` ✅

#### ⚠️【超重要】色・フォントウェイトは必ずデザイン(XD)で確認して指定する
- **各テキストの色・font-weight は、XD JSON の該当 `text` ノードの `fill.hex` / `fontStyle` を必ず確認してから指定する。**
  - `fontStyle` 無し=Regular(400) / `Medium`=500 / `Bold`=700。推測・自己流・「だいたいこう」で指定しない。
  - 例: 選択肢テキストやラベルが Bold なのに未指定で継承、intro が Regular なのに Medium にする等は禁止。
- **本文の主体色は #000（=bodyの既定 `color: var(--black)`）。各要素で #000 を再指定しない（DRY）。**
  - `#444`(--text-black) 等、#000以外が必要な箇所のみ明示する。
  - **例外: `input` / `textarea` は body の色を継承しない**（リセットに `color: inherit` が無い）ため、これらは `color` を明示する。
  - `button` はリセットで `color: inherit` 済み。

### フォント設定
**_variables.scssに定義されているフォント変数を必ず使用すること**
- フォントファミリーを直接記述せず、必ず変数で指定する
- 例: `font-family: "游ゴシック", sans-serif;` ❌ → `font-family: $base-font-family;` ✅

### プロジェクト固有フォント変数の必須作成ルール

**`$base-font-family` / `$second-font-family` だけでなく、各フォントの個別変数を `_variables.scss` に必ず作成すること。**

#### 手順

1. デザインデータに出現する全フォントを洗い出す
2. 各フォントに対応するSCSS変数を作成する
3. テンプレートに残っている未使用のフォント変数（`$avenir-font` 等）を削除する
4. コンポーネントではフォント変数のみを使い、フォント名を直接記述しない

#### 命名規則

`${フォント名をkebab-case}-font`

```scss
// _variables.scss
$lexend-font: "Lexend", sans-serif;
$noto-sans-font: "Noto Sans JP", "Yu Gothic", sans-serif;
$yu-gothic-font: "Yu Gothic", "游ゴシック", sans-serif;
```

#### OK / NG 例

```scss
// ✅ OK: 変数を使用
.p-hero__title {
  font-family: $lexend-font;
}

// ❌ NG: フォント名をインラインで直接記述
.p-hero__title {
  font-family: "Lexend", sans-serif;
}
```






### レスポンシブ対応
```scss
// メディアクエリを入れ子で使用
@include mq("md") {
  // タブレット・スマホ対応
}
@include mq("sm") {
  // スマホ対応
}
```

### レスポンシブはみ出し防止ルール

#### 役割 (Mindset)

あなたはプロのフロントエンドコーダーとして、デザイナーがレビューしても誇れる
品質のレスポンシブを実装する。基準は「崩れていない」ではなく「ユーザーが触って
気持ちよく、視覚的に整っている」こと。「とりあえず縦に並べた」は不合格。

#### 絶対ゲート (違反時は完了報告禁止)

##### G1. 水平スクロール = 0
- Playwright で **375 / 414 / 767 / 1024** 各幅にて以下を検証:
  `document.documentElement.scrollWidth <= window.innerWidth`
- 1px でも超過 → **完了不可**。原因要素を Element Inspector で特定して修正

##### G2. overflow-x: hidden での蓋は禁止 (最終手段のみ)
- `html` / `body` / `main` / `.l-*` 等の上位要素に `overflow-x: hidden` を
  最初から書くのは **禁止** (はみ出しを物理的に消すだけで根本原因が残る)
- 手順:
  1. 蓋を外す (上位要素から `overflow-x: hidden` を削除)
  2. はみ出している子要素を特定 (Element Inspector + Playwright)
  3. 原因を修正 (固定幅をフレキシブルに / 余白を縮める / 折り返す等)
  4. それでも装飾の意図的な画面外配置など正当な理由が残れば、
     **当該局所要素にだけ** `overflow: hidden` を付けてよい

##### G3. タップ領域
- ボタン・リンクの実効サイズが **44×44px 以上**
- 視覚サイズが小さくても `padding` でタップ領域を確保すれば OK
- ボタン/リンク間隔 ≥ 8px (推奨 16px)

##### 検証手順 (必須・自動)

```javascript
// Playwright で各 viewport で水平スクロール検証
for (const w of [375, 414, 767, 1024]) {
  await page.setViewportSize({ width: w, height: 800 });
  const overflow = await page.evaluate(() =>
    document.documentElement.scrollWidth - window.innerWidth
  );
  if (overflow > 0) {
    const culprit = await page.evaluate(() => {
      const all = document.querySelectorAll('*');
      return [...all].filter(el => el.getBoundingClientRect().right > window.innerWidth)
                     .map(el => `${el.tagName}.${el.className}`);
    });
    throw new Error(`横スクロール ${overflow}px @${w}px。原因候補: ${culprit.join(', ')}`);
  }
  await page.screenshot({ path: `mcp-log/sp-${w}.png`, fullPage: true });
}
```

**合格基準**: 全ブレークポイントで `scrollWidth <= innerWidth` かつ G2/G3 違反なし

---

#### 発生原因と対策（水平スクロール）
**原因**:
- 固定幅（`width: rem(...)`）がスマホ幅を超える
- `flex`子要素の`min-width: auto`で縮小できない
- 装飾要素の`right: -`や`left: -`が画面外へはみ出す
- `position: absolute`の要素が親の外へ配置される

**対策**:
- 固定幅は`width: 100%`と`max-width`の併用で伸縮可能にする
- `flex`子要素は`min-width: 0`を付与して縮小を許可する
- SPで負のオフセットは`0`に戻す、または非表示にする
- 絶対配置の装飾はSPでサイズと位置を再調整する

#### 0. セクション レスポンシブ実装パターン（PC → SP 切替の基本形）

PCデザインのセクション（写真＋テキスト＋ボタンの複合レイアウト）をSPに対応させる基本パターン。

##### PC: flexbox / grid でレイアウト

```scss
.p-section {
  max-width: rem(1260);
  margin-inline: auto;
}

.p-section__body {
  display: flex;
  gap: rem(40);
}

.p-section__photo {
  width: rem(600);
  max-width: 100%;
}

.p-section__text {
  flex: 1;
  min-width: 0;
}
```

写真が重なり合うデザイン（コラージュ型）など flexbox/grid で表現できない場合のみ、
親要素を `position: relative` にして子を `position: absolute` + **% 座標**で配置する。

##### SP: 自然な縦積みに切替

```scss
.p-section__body {
  @include mq("md") {
    flex-direction: column;   // 縦並びに切替
  }
}

.p-section__photo {
  @include mq("md") {
    width: 100%;              // 画面幅に追従
    height: auto;
  }
}
```

absolute 配置を使った場合は SP で必ず解除する:

```scss
.p-section__sub {
  position: absolute;
  top: 52.8%;     // PC: デザイン座標を % で指定
  left: 11.3%;

  @include mq("md") {
    position: static;       // ← absolute を解除
    width: 100%;
    height: auto;
    margin-top: rem(20);    // 縦方向の間隔
  }
}
```

##### 画像は `<img>` 要素で配置

```scss
.p-section__photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;

  @include mq("md") {
    height: auto;
    aspect-ratio: 1000 / 550;  // PC比率を維持
  }
}
```

##### セクション高さは固定しない

```scss
// ❌ NG
.p-section__inner {
  height: 933px;               // コンテンツ量で自然に決まるべき
}

// ✅ OK
.p-section__inner {
  min-height: rem(933);        // 最小高さのみ指定
  @include mq("md") {
    min-height: 0;             // SP では自然な高さ
  }
}
```

#### 1. Flexアイテムの縮小許可
Flexコンテナの子要素が画面幅に応じて縮小されるように設定する。

```scss
.p-example__item {
  flex-shrink: 1;  // 縮小を許可
  min-width: 0;    // flex子要素の最小幅制限を解除
}
```

**理由**: `min-width: auto`（デフォルト）だとコンテンツ幅より小さくならず、はみ出しの原因になる

#### 2. 固定幅と柔軟性の両立
固定幅を指定する場合は、必ず`max-width: 100%`をセットで指定する。

```scss
// OK
.p-example__card {
  width: rem(500);     // 理想の幅
  max-width: 100%;     // 親要素を超えない
}

// NG
.p-example__card {
  width: rem(500);     // これだけだと親を超えてはみ出す可能性
}
```

#### 3. 装飾要素（アシライ）の非表示タイミング
大きな装飾画像や擬似要素は、コンテンツと重なる前に非表示にする。

```scss
.p-example__decoration {
  position: absolute;
  // ... 装飾のスタイル

  @include mq("xl") {  // lgより早めに非表示
    display: none;
  }
}
```

**基準**:
| 状況 | 非表示タイミング |
|------|-----------------|
| コンテンツに重なる可能性がある | `xl`で非表示 |
| レイアウトが崩れる | `lg`で非表示 |
| スマホで不要 | `md`で非表示 |

#### 4. セクション背景の幅判定 (フル幅 vs 中央寄せ・条件分岐)

セクション背景は **XD デザイン上で背景がカンバス端まで到達しているか** で実装方針を分岐する。
これにより、大画面 (2560px 等) で背景が画面端まで広がるべきセクションと、
中央寄せで広がりすぎないようにすべきセクションを正しく実装する。

##### 判定手順 (機械的に判定可能)

1. XD JSON でセクションの `bounds` (x / width) を確認
2. 以下を **両方** 満たす → 「フル幅セクション」
   - `x === 0` (ページ左端から ±2px 以内)
   - `width >= ページ幅 × 0.99` (ページ全体に広がっている)
3. 上記を満たさない → 「中央寄せセクション」

迷ったら XD スクリーンショットで「背景がカンバスの左端〜右端に届いているか」を視覚確認する。

##### A. フル幅セクション (背景が画面端まで広がっているデザイン)

例: メインビジュアル、フッター帯、画面いっぱいの背景画像を持つセクション。

**`max-width` を指定しない**。背景は画面いっぱいに広げ、コンテンツ inner にだけ `max-width` を付ける。

```scss
.p-mv {
  width: 100%;
  background-image: url("...");
  background-size: cover;
  // max-width: 指定しない (画面端まで広げる)
}

.p-mv__inner {
  max-width: rem(1300);     // コンテンツのインナー幅
  margin-inline: auto;
  padding-inline: rem(20);
}
```

**理由**: 大画面 (2560px 等) で見たときに背景が画面端まで広がり、白い余白 (白帯) が出ない。
`max-width: rem(1920)` などをセクション本体に付けると 2560px で左右に白帯が出てダサくなる。

##### B. 中央寄せセクション (背景が中央配置の装飾としてデザインされている)

例: カード型セクション、囲みデザイン、背景に余白があるセクション。

**XD のセクション幅を `max-width` に設定し、中央配置する**。

```scss
.p-section__bg {
  max-width: rem(1760);  // XD のセクション幅
  margin-inline: auto;   // 中央配置
  background-color: $bg-color;
}
```

**理由**: 大画面で背景が広がりすぎて意図しない見栄えになるのを防ぐ。デザイナーが意図的に
中央寄せで配置している装飾を尊重する。

##### 例 (1920px ページの場合)

| セクション | x | width | 判定 | 実装 |
|---|---:|---:|---|---|
| MV | 0 | 1920 | ✅ フル幅 | `max-width` 指定なし、`__inner` に max-width |
| フッター帯 | 0 | 1920 | ✅ フル幅 | 同上 |
| カード型セクション | 160 | 1600 | B 中央寄せ | `max-width: rem(1600); margin-inline: auto` |

#### 5. スマホでの中央寄せ
PCで左寄せだった要素がスマホで縦並びになる場合、中央寄せにする。

```scss
.p-section__left {
  @include mq("md") {
    width: fit-content;    // 内容に合わせた幅
    margin-inline: auto;   // 中央配置
  }
}
```

**適用条件**:
- テキストブロックが単独で存在する
- PCで横並びだったものがスマホで縦並びになる
- XDのスマホデザインで中央配置されている

#### 6. グリッドの最終行（奇数枚）の中央寄せ
2カラムのグリッドで要素数が奇数になる場合、最後の1枚が左寄りになりやすい。  
スマホ時は最終行を全幅にして中央配置する。

```scss
.p-example__item:last-child {
  @include mq("md") {
    grid-column: 1 / -1; // 最終行を1行全体に広げて中央寄せ
  }
}
```

**適用条件**:
- `grid-template-columns` が2カラムになる
- 要素数が奇数
- XDデザインで最終行が中央配置

#### 7. SPカンプなし時のヨシナ判断 (10原則)

SPデザインカンプがない場合、PCデザインから推察してSPレイアウトを実装する。
判断に迷ったら **「デザイナーが見て恥ずかしくないか」** を自問する。

| # | 原則 | 具体ルール |
|---|------|----------|
| 1 | 縦に畳む | PC横並び flex/grid は SP で縦並び。例外: アイコン+テキスト、ロゴ+ハンバーガー等の小ユニットは横並び維持 |
| 2 | 中央寄せ | PCで左寄せだったブロックが SP で縦並びになる場合は中央寄せ (`text-align: center` + ボタンは `margin-inline: auto`) |
| 3 | 横ガター | 画面端〜コンテンツの最小余白 16〜24px。inner に `padding-inline` で確保 |
| 4 | フォント最小値 | 本文 ≥ 14px、補助 ≥ 12px、見出しは PC の 60〜80% を目安。`clamp()` 可 |
| 5 | 縦余白リズム | セクション間 `padding-block` は PC の 50〜70%、見出し⇄本文は 60〜80%。詰まりすぎ・スカスカ両方NG |
| 6 | **装飾は保持** | PC装飾要素 (波線、イラスト、模様等) は **勝手に消さない** (`display:none` / 削除禁止)。SP で見えにくい場合はサイズ調整・配置調整で対応。**削除はユーザー指示があったときのみ** |
| 7 | 画像 | `width: 100%; height: auto;` で親幅追従。固定幅画像は `max-width: 100%` 必須。`aspect-ratio` でアスペクト維持 |
| 8 | 重なり解除 | PC `position: absolute` の重ね配置は SP で原則外す (または `%` 相対へ)。「PCの素敵な重なり」を SP で再現しない |
| 9 | 階層維持 | 見出し > 本文 > 補助 のサイズ差は維持。全部同サイズに圧縮しない |
| 10 | タップしやすさ | ボタン高 44〜48px、横は内容追従だが最小 120px 程度。ボタン/リンク間隔 ≥ 8px (推奨16px) |

##### よくある不合格例
- ❌ `body { overflow-x: hidden }` を最初から書いて蓋する
- ❌ PC2カラムを SP で縮小しただけで文字が 10px になる
- ❌ PC装飾の大画像を SP で縮小して残し、コンテンツを覆う
- ❌ ボタンを `width: 80px; height: 30px` のまま放置
- ❌ セクション `padding-block` を PC のまま使い、1セクションが画面より大きい
- ❌ 縦並びにしただけで全部左寄せになりブランディングが崩れている
- ❌ **装飾要素を勝手に `display:none` にする** (ユーザー指示なしでの削除は禁止)

##### SPカンプがある場合
SPカンプの数値 (font-size / gap / margin / 配置 / 装飾の有無) を厳密に再現する。
判断はカンプを正とし、上記10原則は SP カンプがない時のみ適用する。

---

## 📝 HTMLセマンティックタグルール（SEO対応）

### 1. セマンティックHTML5タグの使用
- **適切なセマンティックタグを使用する**

```html
<!-- OK: セマンティックタグを使用 -->
<header class="l-header">
  <nav class="p-nav">
    <ul class="p-nav__list">
      <li class="p-nav__item">
        <a href="#" class="p-nav__link">ホーム</a>
      </li>
    </ul>
  </nav>
</header>

<main class="l-main">
  <article class="p-article">
    <section class="p-article__section">
      <h2 class="c-headline1">セクションタイトル</h2>
      <p class="p-article__text">コンテンツ</p>
    </section>
  </article>
</main>

<aside class="p-sidebar">
  <section class="p-sidebar__section">
    <h3 class="p-sidebar__title">関連記事</h3>
  </section>
</aside>

<footer class="l-footer">
  <p class="l-footer__copyright">&copy; 2024 Company</p>
</footer>

<!-- NG: divのみを使用 -->
<div class="l-header">
  <div class="p-nav">
    <div class="p-nav__list">
      <div class="p-nav__item">
        <a href="#" class="p-nav__link">ホーム</a>
      </div>
    </div>
  </div>
</div>
```

### 2. 見出しタグの階層ルール
- **見出しは必ず階層順に使用する（h1→h2→h3）**
- **h1は1ページに1つのみ**

```html
<!-- OK: 階層順に使用 -->
<h1 class="p-page__title">ページタイトル</h1>
<section>
  <h2 class="c-headline1">セクション1</h2>
  <h3 class="p-section__subtitle">サブセクション1-1</h3>
  <h3 class="p-section__subtitle">サブセクション1-2</h3>
</section>
<section>
  <h2 class="c-headline1">セクション2</h2>
</section>

<!-- NG: 階層を飛ばす -->
<h1 class="p-page__title">ページタイトル</h1>
<h3 class="p-section__subtitle">いきなりh3</h3> <!-- h2を飛ばしている -->
```

### 3. リストタグの適切な使用
- **ナビゲーション、項目リストは必ずul/ol/liタグを使用**

```html
<!-- OK: リストにはulタグ -->
<nav class="p-nav">
  <ul class="p-nav__list">
    <li class="p-nav__item">
      <a href="#" class="p-nav__link">ホーム</a>
    </li>
    <li class="p-nav__item">
      <a href="#" class="p-nav__link">サービス</a>
    </li>
  </ul>
</nav>

<!-- NG: divで代用 -->
<nav class="p-nav">
  <div class="p-nav__list">
    <div class="p-nav__item">
      <a href="#" class="p-nav__link">ホーム</a>
    </div>
  </div>
</nav>
```

### 4. 画像のalt属性ルール
- **すべての画像に適切なalt属性を設定**
- **装飾的な画像はalt=""**

```html
<!-- OK: 意味のある画像 -->
<img src="sample.jpg" alt="弊社の外観写真" class="p-company__image">

<!-- OK: 装飾的な画像 -->
<img src="decoration.svg" alt="" class="p-section__decoration">

<!-- NG: alt属性なし -->
<img src="sample.jpg" class="p-company__image">
```

### 5. フォームのアクセシビリティ
- **すべての入力項目にlabel要素を関連付け**

```html
<!-- OK: labelとinputを関連付け -->
<div class="p-form__item">
  <label for="name" class="p-form__label">お名前</label>
  <input type="text" id="name" name="name" class="p-form__input" required>
</div>

<!-- NG: labelなし -->
<div class="p-form__item">
  <input type="text" name="name" class="p-form__input" placeholder="お名前" required>
</div>
```


---

## 🔍 デザイン再現性チェック（XDデザインとの差異を防ぐ）

### 【重要】実装前の確認手順

XDデザインを実装する前に、以下の手順で詳細を確認すること：

1. **XD PNGで視覚的に確認**
   - JSONを解析する前に、必ずPNG画像を確認
   - 全体のレイアウトと細部のスタイルを目視で把握

2. **テキストスタイリングを個別にチェック**
   - 文中の **太字** 箇所を特定
   - 文中の **色違い** 箇所を特定（オレンジ、青など）
   - 同じ行内でも複数のスタイルが混在している可能性を考慮

### よくある見逃しパターン

| 見逃しパターン | 原因 | 対策 |
|--------------|------|------|
| テキストの一部だけ太字 | JSONのテキスト情報にスタイル詳細が含まれない | PNGで確認 |
| テキストの一部だけ色違い | 「強調=オレンジ」と一般化してしまう | 個別に色を確認 |
| 複数スタイルの組み合わせ | `<span>`を1つしか付けない | 各スタイルに対応した`<span>`を入れ子にする |

### 実装時のチェックリスト

- [ ] スクリーンショットを取得したか
- [ ] テキスト内の **太字箇所** を特定したか
- [ ] テキスト内の **色違い箇所** を特定したか
- [ ] 各スタイルに対応した `<span>` クラスを作成したか
- [ ] 実装後にブラウザでスクリーンショットと比較したか

### コード例

```html
<!-- ❌ NG: スタイルの一部しか適用されていない -->
<p>同じ耐震等級3でも<span class="p-quality__textAccent">reco.</span>は最高レベルです。</p>

<!-- ✅ OK: 太字と色を個別に指定 -->
<p>同じ耐震等級3でも<span class="p-quality__textAccent">reco.</span>は<span class="p-quality__textBold">最高レベル</span>です。</p>
```

```scss
// 色のみ（オレンジ + 太字）
.p-quality__textAccent {
  color: #f27d27;
  font-weight: 700;
}

// 太字のみ（黒 + 太字）
.p-quality__textBold {
  font-weight: 700;
  color: $text;
}
```

### 抽象的なルール

> **「XD JSONの情報はあくまで構造の参考であり、スタイリングの詳細は必ずPNG画像で確認すること」**

XD JSONから取得したデータは構造情報が中心であり、以下の情報が不足することがある：
- 文中の部分的なスタイル変化（太字、色）
- 行間・文字間隔の微調整
- ホバー状態や遷移アニメーション

そのため、**XD PNGとの視覚的比較**を実装の最終チェックとして必ず行うこと。


---

## 📦 XD からのエクスポートについて

- XD からエクスポートした JSON ファイルと PNG 画像を使用してコーディングを行います。
- JSON ファイルには、アートボード、テキスト、レイアウト情報などが含まれています。
- PNG 画像は、レイアウト確認や実装後の検証に使用します。

## 注意事項

- 画像パスは`<?php echo get_template_directory_uri(); ?>/img/`を使用
- WordPress の関数を使用（`get_template_directory_uri()`など）
- フォーカス時のアウトラインは`outline: none`で削除済み
- ホバー効果は`@media (any-hover: hover)`で実装

---

