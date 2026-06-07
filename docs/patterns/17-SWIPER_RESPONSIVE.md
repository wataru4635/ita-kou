# 17: レスポンシブスワイパー（PC横並び / SPカルーセル）

## 概要
PC では複数カードを通常の横並びレイアウトで表示し、SP のみ Swiper を起動してカルーセル化する。`matchMedia` で breakpoint を監視し、PC 側では Swiper を完全に `destroy` してマークアップを純粋な flex 横並びに戻すことで、PC では Swiper のラッパーDOMが残らないクリーンな表示にする。

## 適用場面
- レシピ・商品カード一覧（PC 3カラム / SP 1枚ずつめくる）
- ブログ記事一覧（PC グリッド / SP スワイプ）
- ギャラリー（PC 横並び / SP 中央フォーカス + 両側見切れ）

## Figmaでの特徴
- PC: カードが3〜4カラムで横並び、矢印やページネーションなし
- SP: 1枚目が中央に配置され、両側に隣カードが少し見切れて見える
- SP のみ左右にナビ矢印アイコン（24x24px程度）
- カードサイズ: PC 320x240 / SP 240x180 のように切替

---

## 現プロジェクト向け実装

### HTML
```html
<section class="p-swiperResponsive">
    <div class="l-inner">
        <h2 class="p-swiperResponsive__heading">レスポンシブスワイパー</h2>
    </div>

    <div class="p-swiperResponsive__container">
        <div class="swiper p-swiperResponsive__swiper">
            <ul class="swiper-wrapper p-swiperResponsive__list">
                <li class="swiper-slide p-swiperResponsive__item">
                    <div class="p-swiperResponsive__card">
                        <div class="p-swiperResponsive__thumb"></div>
                        <p class="p-swiperResponsive__title">タイトル</p>
                        <p class="p-swiperResponsive__tag">#カテゴリ</p>
                        <p class="p-swiperResponsive__date">2026.02.10</p>
                    </div>
                </li>
                <!-- カード繰り返し -->
            </ul>
        </div>

        <!-- SP 用ナビゲーション（PCでは非表示） -->
        <button class="p-swiperResponsive__prev" type="button" aria-label="前へ">
            <svg width="24" height="24" viewBox="0 0 24 24"><path d="M15 18L9 12L15 6" stroke="#3b320f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </button>
        <button class="p-swiperResponsive__next" type="button" aria-label="次へ">
            <svg width="24" height="24" viewBox="0 0 24 24"><path d="M9 18L15 12L9 6" stroke="#3b320f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </button>
    </div>
</section>
```

### SCSS（要点）
```scss
@use "foundation" as *;

.p-swiperResponsive {
  padding-block: rem(80);
  overflow-x: hidden;  // SP で見切れ部分が横スクロール誘発しないように

  @include mq("md") {
    padding-block: rem(50);
  }
}

.p-swiperResponsive__container {
  position: relative;            // ナビ矢印の絶対配置基準
  max-width: rem(1080);
  margin-inline: auto;

  @include mq("md") {
    max-width: 100%;
  }
}

/* Swiper 未初期化時(PC) は overflow:visible でレイアウトを壊さない */
.p-swiperResponsive__swiper {
  &:not(.swiper-initialized) {
    overflow: visible;
  }

  @include mq("md") {
    &.swiper-initialized {
      overflow: visible;  // 両側見切れを許容
    }
  }
}

.p-swiperResponsive__list {
  list-style: none;
  padding: 0;
  margin: 0;

  /* PC: 通常の flex 横並び */
  display: flex;
  flex-wrap: wrap;
  gap: rem(60);
  justify-content: center;

  @include mq("md") {
    /* SP: Swiper が transform 制御するので flex/gap はリセット */
    flex-wrap: nowrap;
    gap: 0;
    justify-content: flex-start;
  }
}

.p-swiperResponsive__item {
  width: rem(320);

  @include mq("md") {
    width: rem(240);
    flex-shrink: 0;
  }
}

/* ナビ矢印（SP のみ表示） */
.p-swiperResponsive__prev,
.p-swiperResponsive__next {
  display: none;

  @include mq("md") {
    display: flex;
    position: absolute;
    top: rem(90);              // 画像の縦中央に合わせる
    z-index: 2;
    width: rem(24);
    height: rem(24);
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
  }
}
.p-swiperResponsive__prev { @include mq("md") { left: rem(20); } }
.p-swiperResponsive__next { @include mq("md") { right: rem(20); } }
```

### JavaScript
```js
var responsiveEl = document.querySelector(".p-swiperResponsive__swiper");
if (responsiveEl) {
    var mq = window.matchMedia("(max-width: 767px)");
    var responsiveSwiper = null;

    var sync = function () {
        if (mq.matches && !responsiveSwiper) {
            // SP: Swiper 起動
            responsiveSwiper = new Swiper(responsiveEl, {
                slidesPerView: "auto",
                spaceBetween: 40,
                centeredSlides: true,
                loop: true,
                navigation: {
                    prevEl: ".p-swiperResponsive__prev",
                    nextEl: ".p-swiperResponsive__next",
                },
            });
        } else if (!mq.matches && responsiveSwiper) {
            // PC: 完全にdestroy（DOMからswiper関連クラスも除去）
            responsiveSwiper.destroy(true, true);
            responsiveSwiper = null;
        }
    };

    sync();
    mq.addEventListener("change", sync);
}
```

---

## 設計上のポイント

### なぜ Swiper の `breakpoints` ではなく `matchMedia + destroy` を使うか
Swiper の `breakpoints` で PC/SP の設定を切り替えても、Swiper 本体は常に存在し続け、`.swiper-wrapper` などのDOM/クラスが PC でも残る。これだと PC の純粋な flex 横並びレイアウトが Swiper の transform に侵食される。`matchMedia + destroy(true, true)` だと PC では Swiper が完全に消え、ただの `<ul><li></li></ul>` に戻るので、SCSS の flex レイアウトが素直に効く。

### `destroy(true, true)` の引数の意味
- 第1引数: `deleteInstance = true` — Swiper インスタンス自体を破棄
- 第2引数: `cleanStyles = true` — 追加されたCSSクラス・スタイルもクリア

### resize ではなく matchMedia.addEventListener("change") の理由
`window.addEventListener("resize", ...)` だと viewport が変わるたびに発火するので、SP内での縦横変化など過剰な発火がある。`matchMedia` の `change` は **breakpoint をまたぐ瞬間にだけ** 発火するので、init/destroy のような重い処理に向いている。

---

## 実装時の注意

- **PC で `.swiper-wrapper` に `flex-wrap: wrap` を直接指定しない**。Swiper 起動時に transform 計算と競合する。flex 関連の指定は `.p-swiperResponsive__list` や `.swiper:not(.swiper-initialized)` 経由で。
- **`overflow: visible` の効かせ場所**: PC は Swiper未初期化なので `.swiper:not(.swiper-initialized)` に。SP は両側見切れを許容するため `.swiper-initialized` に。両方を別ルールで書く必要がある。
- **`destroy(true, true)` の第2引数 true を忘れない**。falseだと Swiper が付けたクラスが残ってレイアウトが崩れる。
- **`matchMedia.addEventListener("change", ...)`** はモダンブラウザ対応。IE11 を想定する場合は `addListener` を fallback で。
- **ナビ矢印の絶対配置 top 値**は画像の縦中央に合わせる。画像高さが SP 180px なら `top: rem(90)`。Figma の値を直接入れる。
- **SP の `centeredSlides: true` と `loop: true` の併用**で、最初のスライドが中央 + 両側に隣スライドが見切れる構成になる。
