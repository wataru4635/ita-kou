# 16: 無限スライダー（Swiper marquee）

## 概要
Swiper.js を使って、複数カードが等速・連続で流れ続ける無限スライダー（マーキー）。広告ロゴ表示・お客様の声・実績紹介など、止めずに流したい場面で使う。`allowTouchMove: false` が安定動作のキー。

## 適用場面
- 取引先ロゴの自動流し
- お客様の声カードを延々と表示
- 実績バッジ・受賞歴のループ表示
- 上下2レーンを逆方向に流す装飾

## Figmaでの特徴
- 同サイズのカード（or 画像）が横一列に途切れなく並ぶ
- セクション幅いっぱいまで広がっている（インナー幅で囲わない）
- 矢印・ページネーションは持たない（自動再生のみ）
- 2レーン構成のときは、上下が逆方向に流れる

---

## 現プロジェクト向け実装

### HTML
```html
<section class="p-swiperMarquee">
    <div class="l-inner">
        <h2 class="p-swiperMarquee__heading">無限スライダー</h2>
    </div>

    <!-- レーン1: 逆方向 -->
    <div class="swiper p-swiperMarquee__lane p-swiperMarquee__lane--reverse">
        <ul class="swiper-wrapper p-swiperMarquee__track">
            <li class="swiper-slide p-swiperMarquee__item"><p>card 1</p></li>
            <li class="swiper-slide p-swiperMarquee__item"><p>card 2</p></li>
            <!-- ... 大画面でも余白が出ないよう 15 枚程度入れる -->
            <li class="swiper-slide p-swiperMarquee__item"><p>card 15</p></li>
        </ul>
    </div>

    <!-- レーン2: 順方向 -->
    <div class="swiper p-swiperMarquee__lane">
        <ul class="swiper-wrapper p-swiperMarquee__track">
            <li class="swiper-slide p-swiperMarquee__item"><p>card 1</p></li>
            <!-- ... -->
            <li class="swiper-slide p-swiperMarquee__item"><p>card 15</p></li>
        </ul>
    </div>
</section>
```

### SCSS
```scss
@use "foundation" as *;

.p-swiperMarquee {
  padding-block: rem(80);
  overflow: hidden;

  @include mq("md") {
    padding-block: rem(50);
  }
}

.p-swiperMarquee__heading {
  font-size: rem(28);
  font-weight: $bold;
  margin-bottom: rem(40);
  text-align: center;
}

.p-swiperMarquee__lane {
  width: 100%;

  & + & {
    margin-top: rem(20);
  }

  /* 等速移動の核: linear timing */
  .swiper-wrapper {
    transition-timing-function: linear;
  }
}

.p-swiperMarquee__item {
  width: rem(240);
  height: rem(140);
  background: $gray-bg;
  border: 1px solid $gray-border;
  border-radius: rem(8);
  display: flex;
  align-items: center;
  justify-content: center;

  @include mq("md") {
    width: rem(180);
    height: rem(120);
  }
}
```

### JavaScript
```js
var marqueeBase = {
    loop: true,
    speed: 6000,             // 1スライド送りの時間(ms)。小さいほど速い
    allowTouchMove: false,   // ★ ここがシームレス化の核心。true だと遷移境界でジャンプが発生
    slidesPerView: "auto",
    spaceBetween: 30,
    autoplay: {
        delay: 0,            // 連続流しのため待機0
        disableOnInteraction: false,
    },
};

// 順方向
new Swiper(".p-swiperMarquee__lane:not(.p-swiperMarquee__lane--reverse)", marqueeBase);

// 逆方向（reverseDirection: true を追加するだけ）
new Swiper(".p-swiperMarquee__lane--reverse", Object.assign({}, marqueeBase, {
    autoplay: {
        delay: 0,
        disableOnInteraction: false,
        reverseDirection: true,
    },
}));
```

---

## 設計上のポイント

### なぜ `allowTouchMove: false` が必要か
`true` のとき Swiper はスライダー要素にポインター/タッチ監視を attach し、`transitionEnd` ごとに `loopFix()` という内部関数で wrapper transform を瞬時にリセットする。これが「ガガっ」というジャンプの正体（実測 -247px の瞬間飛び）。`false` にすると監視が attach されず、リセット経路が autoplay 経由のみになり、CSS transition が連続してジャンプが視認できなくなる。

### スライド枚数の決め方
1セットの幅が viewport 幅以上になるように枚数を入れる。
- 240px幅 + 30px間隔 = 270px/枚
- 2560px viewport を埋めるには `2560 / 270 ≈ 10枚` 以上必要
- **15 枚** あれば 2K ディスプレイまで余白なし

### linear timing の指定
`transition-timing-function: linear` を `.swiper-wrapper` に指定しないと、各スライド遷移にイージング（最初遅く・途中速く）が掛かり、流し方が脈打って見える。SCSS で必ず上書きすること。

---

## 実装時の注意

- **`allowTouchMove: false` を必ず指定**。これを忘れると「一周ごとにガガっと動く」現象が発生する。
- **スライド枚数は viewport 幅 / 1スライド幅 の2倍以上を目安**。少ないと大画面で右端に余白が出る。
- **`overflow: hidden` はセクション側に**。スライダー本体に付けると Swiper の内部複製が見えなくなる場合がある。
- **`transition-timing-function: linear` は `.swiper-wrapper` に指定**。スライド要素や `.swiper` に付けても効かない。
- **2レーン逆方向は `reverseDirection: true` だけ追加**。HTMLの並び順を反転させる必要はない。
- **autoplay の余計なオプションを盛らない**。`stopOnLastSlide` などは loop と競合してジャンプを誘発する。基本は `delay: 0` と `disableOnInteraction: false` のみで十分。
- **`speed` は 1スライド送り時間**であって 1周時間ではない。15枚 × 6000ms = 90秒/周 が現在の設定。
