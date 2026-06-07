# 15: スワイパー（通常）

## 概要
Swiper.js による基本的なカルーセル。autoplay + 前/次ボタン + ページネーション（ドット）が揃った最も標準的な構成。

## 適用場面
- ヒーローエリアの画像切替
- お知らせバナーの自動切替
- カード型コンテンツの紹介スライド

## Figmaでの特徴
- 同サイズのカードが横一列に並ぶ
- スライダー左右に円形の前/次ボタン
- スライダー下にドット型のページネーション

---

## 現プロジェクト向け実装

### HTML
```html
<div class="card p-swiperBasic__card">
    <div class="card__inner">
        <div class="card__swiper-container">
            <div class="swiper card__swiper">
                <div class="swiper-wrapper card__swiper-wrapper">
                    <div class="swiper-slide card__swiper-slide"><p>Card1</p></div>
                    <div class="swiper-slide card__swiper-slide"><p>Card2</p></div>
                    <div class="swiper-slide card__swiper-slide"><p>Card3</p></div>
                    <div class="swiper-slide card__swiper-slide"><p>Card4</p></div>
                    <div class="swiper-slide card__swiper-slide"><p>Card5</p></div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev">
                <!-- 円形矢印SVG -->
            </div>
            <div class="swiper-button-next">
                <!-- 円形矢印SVG -->
            </div>
        </div>
    </div>
</div>
```

### SCSS
```scss
@use "foundation" as *;

.p-swiperBasic {
  padding-block: rem(80);

  @include mq("md") {
    padding-block: rem(50);
  }
}

.p-swiperBasic__card {
  max-width: rem(900);
  margin-inline: auto;
}

.p-swiperBasic {
  .card__inner {
    position: relative;
    padding-inline: rem(20);
  }

  .card__swiper-slide {
    width: rem(280);
    height: rem(180);
    background: $gray-bg;
    border: 1px solid $gray-border;
    border-radius: rem(8);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* デフォルト位置のreset */
  .swiper-button-prev,
  .swiper-button-next,
  .swiper-pagination-bullets.swiper-pagination-horizontal {
    top: unset; bottom: unset; left: unset; right: unset;
    margin: 0; padding: 0;
  }

  .swiper-button-prev::after,
  .swiper-button-next::after { content: ""; }

  .swiper-button-prev,
  .swiper-button-next {
    top: 50%;
    translate: 0 -50%;
    width: rem(40);
    height: rem(40);
    svg { width: 100%; height: 100%; }
  }
  .swiper-button-prev { left: rem(-20); }
  .swiper-button-next { right: rem(-20); }

  /* ページネーション (bullets) */
  .swiper-pagination-bullets.swiper-pagination-horizontal {
    top: calc(100% + #{rem(29)});
  }
  .swiper-pagination-bullets.swiper-pagination-horizontal .swiper-pagination-bullet {
    opacity: 1;
    width: rem(12); height: auto;
    aspect-ratio: 1;
    border-radius: 50%;
    background: #d9d9d9;
    margin-inline: calc(#{rem(11)} / 2);
  }
  .swiper-pagination-bullets.swiper-pagination-horizontal .swiper-pagination-bullet-active {
    background: $black;
  }
}
```

### JavaScript
```js
new Swiper(".p-swiperBasic .card__swiper", {
    speed: 1000,
    effect: "slide",
    allowTouchMove: true,
    loop: true,
    autoplay: { delay: 3000 },
    slidesPerView: "auto",
    spaceBetween: 30,
    centeredSlides: true,         // SP: 1枚目を中央配置
    breakpoints: {
        768: { centeredSlides: false }, // PC: 左寄せで複数同時表示
    },
    pagination: {
        el: ".p-swiperBasic .swiper-pagination",
        clickable: true,
        type: "bullets",
    },
    navigation: {
        prevEl: ".p-swiperBasic .swiper-button-prev",
        nextEl: ".p-swiperBasic .swiper-button-next",
    },
});
```

---

## 設定値の調整ポイント

### 隣スライドのチラ見幅（SP, centeredSlides:true 時）
公式: `チラ見幅 = (画面幅 − スライド幅) / 2 − spaceBetween`

| 目的 | 設定 |
|---|---|
| チラ見を完全に消す | `spaceBetween` を `(画面幅 − スライド幅) / 2` 以上にする、またはSPでスライド幅100% |
| 薄くチラ見させる（10px程度） | `spaceBetween: 37` |
| しっかり見せる（50px程度） | スライド幅 `rem(240)` + `spaceBetween: 17` |

### autoplay
- `autoplay: { delay: 3000 }` — 3秒ごとに進む
- `autoplay: false` — 自動再生を無効化

### loop
- `loop: true` — 最後 → 最初へ自動でつながる（既定で1セット分のスライドが内部複製される）

---

## 実装時の注意

- **`slidesPerView: "auto"` 使用時はスライド幅をSCSSで明示する**。指定しないとスライドが潰れて見える。
- **`centeredSlides: true` のとき、active スライドの両側余白は `(viewport − slideWidth) / 2`** で決まる。隣スライドが見えてしまう/見えない問題はここから判断する。
- **autoplay とユーザー操作のバランス**: 既定では touchmove 時に autoplay が一時停止するが、`disableOnInteraction: false` を入れると操作後も継続する。
- **`.swiper-button-prev::after` / `::next::after`** はデフォルトで矢印フォントが入るので、独自SVGを使う場合は `content: ""` で初期化する。
- **PC/SP で挙動を分けたいときは `breakpoints`**。`breakpoints.768` 以上は viewport 幅の閾値で、その値以上のときに上書きされる。
