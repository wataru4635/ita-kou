# 12: 背景装飾（波・半円・三角）

## 概要
セクションの上下に波形・半円・三角などの装飾的な背景画像を擬似要素で配置するパターン。
画面幅が変化しても装飾の形状と位置がデザインカンプ通りに保たれるよう、`calc(vw + rem)` + `aspect-ratio` で制御する。

## 適用場面
- セクション境界に波形（naminami）の装飾がある
- セクション上部/下部に半円・三角・曲線の背景画像がある
- 装飾画像がセクション外にはみ出す（negative position）

## Figmaでの特徴
- セクションの上端・下端に装飾レイヤーが配置されている
- 装飾画像がセクション境界をまたいでいる
- PC用とSP用で別の装飾画像が用意されていることが多い

---

## 構造

```
┌─────────────────────────────┐
│  ::before（上部装飾）         │ ← aspect-ratio で形状維持
│  ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─  │
│                             │
│  padding-top: calc(vw+rem)  │ ← 装飾の高さに連動
│                             │
│  ┌───────────────────────┐  │
│  │    コンテンツ領域       │  │
│  └───────────────────────┘  │
│                             │
│  padding-bottom: calc(vw+rem)│ ← 装飾の高さに連動
│                             │
│  ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─  │
│  ::after（下部装飾）         │ ← aspect-ratio で形状維持
└─────────────────────────────┘
```

---

## HTML

```html
<section class="p-section">
    <div class="p-section__inner l-inner">
        <!-- コンテンツ -->
    </div>
</section>
```

装飾は擬似要素で実装するため、HTML に装飾用の要素は不要。

---

## SCSS

### 基本パターン（推奨: calc方式）

```scss
@use "foundation" as *;

.p-section {
  position: relative;
  background-color: #FAF6F2;

  // ① padding を装飾の高さ（vw）+ 固定余白（rem）で算出
  //    装飾の vw = 元画像の高さ ÷ 元画像の幅 × 100
  //    例: 1475×105 の場合 → 105 ÷ 1475 × 100 ≈ 7.12vw
  padding-top: calc(7.12vw + 4.625rem);
  padding-bottom: calc(7.12vw + 4.75rem);

  @include mq("md") {
    // SP は装飾画像の比率が異なるので別計算
    // 例: 380×30 の場合 → 30 ÷ 380 × 100 ≈ 7.89vw
    padding-top: calc(7.89vw + 3rem);
    padding-bottom: calc(7.89vw + 3rem);
  }

  // ② 上部装飾（擬似要素）
  &::before {
    position: absolute;
    content: '';
    top: -2px;
    left: 0;
    width: 100%;
    height: auto;
    aspect-ratio: 1475 / 105;
    background: url(../img/deco-top.png) center center / contain no-repeat;

    @include mq("md") {
      background: url(../img/deco-top-sp.png) center center / cover no-repeat;
      aspect-ratio: 380 / 30;
    }
  }

  // ③ 下部装飾（擬似要素）
  &::after {
    position: absolute;
    content: '';
    left: 0;
    bottom: -2px;
    width: 100%;
    height: auto;
    aspect-ratio: 1475 / 105;
    background: url(../img/deco-bottom.png) center center / contain no-repeat;

    @include mq("md") {
      background: url(../img/deco-bottom-sp.png) center center / cover no-repeat;
      aspect-ratio: 380 / 30;
    }
  }
}
```

---

## 核心技術: calc(vw + rem) で装飾とpaddingを連動させる

### なぜ calc が clamp より優れるか

装飾画像は `aspect-ratio` により画面幅に比例して高さが変化する。
padding も同じ比率（vw）で変化させれば、**どの画面幅でも装飾とコンテンツの間隔が一定**になる。

```
clamp() の問題:
  padding は上限値で頭打ち → 装飾は比例で伸び続ける → いつか追い越す
  例: 2560px幅で波がタイトルに食い込む

calc(vw + rem) の利点:
  padding が装飾と同じ比率で伸びる → 間隔が常に一定 → 破綻しない
```

| ビューポート | 波の高さ (7.12vw) | padding-top (7.12vw + 4.625rem) | 余白 |
|---|---|---|---|
| 375px | 27px | 101px | 74px |
| 768px | 55px | 129px | 74px |
| 1475px | 105px | 179px | 74px |
| 2560px | 182px | 256px | 74px |
| 4000px | 285px | 359px | 74px |

→ 余白は常に74px（4.625rem）で一定。

### calc() の計算方法

**Step 1: 装飾画像の vw 値を算出**

```
装飾の vw = 元画像の高さ ÷ 元画像の幅 × 100

例: 画像サイズ 1475 × 105
    105 ÷ 1475 × 100 = 7.12vw
```

**Step 2: 固定余白を決定**

Figma のデザインカンプから、装飾の下端〜コンテンツまでの距離を測定し、rem で指定する。

```
padding = calc(7.12vw + 固定余白rem)
```

**Step 3: SP 用は SP 画像の比率で再計算**

SP 用の装飾画像は比率が異なることが多いので、別途算出する。

```
例: SP画像サイズ 380 × 30
    30 ÷ 380 × 100 = 7.89vw
```

---

## 擬似要素の設定ルール

| プロパティ | 値 | 理由 |
|-----------|-----|------|
| `position` | `absolute` | セクション基準で配置 |
| `width` | `100%` | 画面幅いっぱいに |
| `height` | `auto` | aspect-ratio に任せる（固定値にしない） |
| `aspect-ratio` | `元画像の幅 / 高さ` | 形状を常に維持 |
| `background` | `url(...) center center / contain no-repeat` | 画像を比率維持で表示 |
| `top` / `bottom` | `-2px` 程度 | 境界の隙間を埋める微調整 |

---

## バリエーション

### 上部のみ装飾

```scss
.p-section {
  position: relative;
  padding-top: calc(7.12vw + 4rem);

  &::before {
    /* 上部装飾のみ */
  }
}
```

### SP で別の装飾画像に切り替え

```scss
&::before {
  background: url(../img/deco-pc.png) center center / contain no-repeat;
  aspect-ratio: 1475 / 105;

  @include mq("md") {
    background: url(../img/deco-sp.png) center center / cover no-repeat;
    aspect-ratio: 380 / 30;
  }
}
```

### SP で装飾を非表示

```scss
&::after {
  /* PC装飾 */

  @include mq("md") {
    display: none;
  }
}
```

---

## 実装時の注意

- **`height: auto` は必須** — `height` を固定値にすると画面幅が変わったとき形状が崩れる
- **`aspect-ratio` の値は元画像のサイズから取得** — Figma のエクスポート時に確認
- **`contain` と `cover` の使い分け** — PC は `contain`（装飾全体を表示）、SP は `cover` でもOK
- **親要素に `position: relative`** — 擬似要素の absolute 配置の基準
- **SP の padding も calc で算出** — SP 画像の aspect-ratio が PC と異なる場合は vw 値を再計算
- **`max-height` は使わない** — 波の形が不自然に切れるため。calc 方式なら不要

---

## 実コード参照

### sunayoku プロジェクト（calc方式・推奨）

```scss
// _p-top.scss — イベントセクション
.p-topEvent {
  padding-top: calc(7.12vw + 4.625rem);
  padding-bottom: calc(7.12vw + 4.75rem);
  position: relative;
  background: #FAF6F2;

  &::before {
    position: absolute;
    content: '';
    width: 100%;
    height: auto;
    aspect-ratio: 1475 / 105;
    left: 0;
    top: -2px;
    background: url(../img/map/nami3.png) center center / contain no-repeat;

    @include mq("md") {
      background: url(../img/map/nami_sp3.png) center center / cover no-repeat;
      aspect-ratio: 380 / 30;
    }
  }

  &::after {
    position: absolute;
    content: '';
    width: 100%;
    height: auto;
    aspect-ratio: 1475 / 105;
    left: 0;
    bottom: -2px;
    background: url(../img/map/nami5.png) center center / contain no-repeat;

    @include mq("md") {
      background: url(../img/map/nami_sp5.png) center center / cover no-repeat;
      aspect-ratio: 380 / 30;
    }
  }
}
```

### Project Beta（clamp方式・旧）

```scss
// _bg.scss — 参考：clamp方式は広い画面幅で破綻する可能性がある
.p-section {
  position: relative;
  z-index: 1;
  background-color: #f8f4f4;
  padding-top: clamp(8.125rem, 3.571rem + 9.487vw, 18.75rem);
  padding-bottom: clamp(20.5rem, -0.5rem + 10.938vw, 27.5rem);

  &::before {
    position: absolute;
    content: '';
    top: rem(-5);
    left: 0;
    right: 0;
    width: 100%;
    height: auto;
    aspect-ratio: 1920 / 165;
    background: url(../img/bg_curve01.png) center center / contain no-repeat;
    z-index: -1;

    @include mq("md") {
      background: url(../img/bg_curve01Sp.png) center center / contain no-repeat;
      aspect-ratio: 375 / 122;
    }
  }
}
```
