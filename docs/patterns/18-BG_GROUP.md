# 18: 背景グループ（複数セクションにまたがる背景）

## 概要
複数のセクションが同じ背景色を共有し、グループの上下に波装飾がつくパターン。
ラッパーdivで背景と波装飾を管理し、中のセクションは個別にコーディングする。

## 適用場面
- 2つ以上のセクションが同じ背景色を共有している
- 背景グループの上下に波・曲線の装飾がある
- page-layout.md の「背景グループ」に記録されている

## パターン12 (BG_DECORATION) との使い分け

| 条件 | 適用パターン |
|------|-------------|
| 1セクションだけの背景 + 波装飾 | パターン12 (擬似要素) |
| 2セクション以上が同じ背景を共有 | **パターン18 (ラッパーdiv)** |
| 2セクション以上 + 波装飾 | **パターン18 (ラッパー + 擬似要素)** |

---

## 構造

```
┌─────────────────────────────────┐
│ .l-bg-group                     │
│  ::before（上部波装飾）           │
│  ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─  │
│                                 │
│  ┌───────────────────────────┐  │
│  │ section.p-room            │  │ ← 個別にコーディング + pixeldiff
│  │   └── .p-room__inner      │  │
│  └───────────────────────────┘  │
│                                 │
│  ┌───────────────────────────┐  │
│  │ section.p-facility        │  │ ← 個別にコーディング + pixeldiff
│  │   └── .p-facility__inner  │  │
│  └───────────────────────────┘  │
│                                 │
│  ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─  │
│  ::after（下部波装飾）           │
└─────────────────────────────────┘
```

---

## HTML

```html
<!-- ラッパー: 背景色 + 波装飾を担当 -->
<div class="l-bg-group l-bg-group--beige">
  <!-- セクション1: コンテンツのみ担当 -->
  <section class="p-room">
    <div class="p-room__inner l-inner">
      <!-- room のコンテンツ -->
    </div>
  </section>
  <!-- セクション2: コンテンツのみ担当 -->
  <section class="p-facility">
    <div class="p-facility__inner l-inner">
      <!-- facility のコンテンツ -->
    </div>
  </section>
</div>
```

ラッパーの命名規則: `l-bg-group` (layout層)。色修飾子は `--{色名}` で付与。

---

## SCSS

### ラッパー（背景 + 波装飾）

```scss
@use "foundation" as *;

.l-bg-group {
  position: relative;

  // 色修飾子
  &--beige {
    background-color: #F5F0E8;
  }

  &--blue {
    background-color: #4F8196;
  }

  // 上部波装飾 — コンテナの外側（上）に配置
  // ⚠️ top: -2px ではなく bottom: 100% を使う
  // 理由: 波色とコンテナ背景色が同色の場合、コンテナ内側に置くと見えない
  // 外側（白背景の上）に配置することで波形が視認できる
  &::before {
    position: absolute;
    content: '';
    bottom: 100%;
    margin-bottom: -2px;
    left: 0;
    width: 100%;
    height: auto;
    aspect-ratio: 1920 / 89;
    background: url(../img/common/wave-top.png) center center / cover no-repeat;
    z-index: 1;

    @include mq("md") {
      background: url(../img/common/wave-top-sp.png) center center / cover no-repeat;
      aspect-ratio: 375 / 30;
    }
  }

  // 下部波装飾 — コンテナの外側（下）に配置
  &::after {
    position: absolute;
    content: '';
    top: 100%;
    margin-top: -2px;
    left: 0;
    width: 100%;
    height: auto;
    aspect-ratio: 1920 / 87;
    background: url(../img/common/wave-bottom.png) center center / cover no-repeat;
    z-index: 1;

    @include mq("md") {
      background: url(../img/common/wave-bottom-sp.png) center center / cover no-repeat;
      aspect-ratio: 375 / 30;
    }
  }
}
```

### 各セクション（コンテンツのみ）

```scss
// グループ先頭セクション: 波の高さ分 padding-top を追加
.p-room {
  padding-top: calc(4.64vw + 4.625rem);
  padding-bottom: rem(80);

  @include mq("md") {
    padding-top: calc(8vw + 3rem);
    padding-bottom: rem(40);
  }
}

// グループ末尾セクション: 波の高さ分 padding-bottom を追加
.p-facility {
  padding-top: rem(80);
  padding-bottom: calc(4.53vw + 4.75rem);

  @include mq("md") {
    padding-top: rem(40);
    padding-bottom: calc(8vw + 3rem);
  }
}

// グループ中間セクション: 波スペース不要
.p-middle-section {
  padding-block: rem(80);

  @include mq("md") {
    padding-block: rem(40);
  }
}
```

### calc() の計算方法 (パターン12と同じ)

```
波の vw = 元画像の高さ ÷ 元画像の幅 × 100
例: 1920 × 89 → 89 ÷ 1920 × 100 = 4.64vw
padding = calc(4.64vw + 固定余白rem)
```

---

## 波装飾なしの場合

背景色だけを共有するパターン（波なし）。

```html
<div class="l-bg-group l-bg-group--beige">
  <section class="p-room">...</section>
  <section class="p-facility">...</section>
</div>
```

```scss
.l-bg-group {
  &--beige {
    background-color: #F5F0E8;
  }
  // ::before / ::after なし
}
```

---

## pixeldiff との関係

セクション単位でpixeldiffする際、ラッパーの背景色は**自動的にセクションのスクリーンショットに映り込む**。
セクション自体に背景色を指定する必要はない。

```
ラッパー (背景: ベージュ)
  ├── .p-room (背景: transparent) → pixeldiff撮影時にベージュ背景が映る ✓
  └── .p-facility (背景: transparent) → 同上 ✓
```

---

## blueprint での計画方法

page-layout.md に背景グループが記録されている場合、blueprint (plan.md) に以下を記載:

```markdown
## 背景グループ
- このセクションは背景グループ #1 に属する (room + facility)
- ラッパー: .l-bg-group.l-bg-group--beige
- グループ内の位置: 先頭 / 中間 / 末尾
- 波装飾: ラッパーの ::before/::after で実装 (パターン18)
- padding 調整: 先頭セクション → padding-top に波スペース追加
```

---

## 実装時の注意

- **ラッパーは l- 層** (layout) に配置。p- 層 (project) ではない
- **ラッパーの SCSS ファイルは `_l-bg-group.scss`** に記述
- **セクション間の gap はラッパー内のセクションの margin/padding で制御**。ラッパーに gap を設定してもよい
- **波装飾画像は `src/img/common/` に保存** (セクション固有ではなくページ共通)
- **z-index: 1 を擬似要素に設定** してセクションコンテンツの上に波が表示されるようにする
- **`overflow: hidden` をラッパーに設定しない** — 波がコンテナ外に出るため、hidden だと切られる
- **波の配置は `bottom: 100%` / `top: 100%`** — パターン12 の `top: -2px` とは異なる。波色とコンテナ背景色が同色の場合、コンテナ内側に置くと同色同士で見えない。外側の白背景上に配置して初めて波形が視認できる
- **`background-size` は `cover`** — `contain` だと画像と aspect-ratio の微小な比率差で左右に隙間が出る
