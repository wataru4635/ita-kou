/* ===============================================
# MV スライダー（Swiper・fade）
# CDN の swiper-bundle（グローバル Swiper）を使用
=============================================== */
document.addEventListener("DOMContentLoaded", () => {
  if (typeof Swiper === "undefined") return;
  if (!document.querySelector(".js-mv-swiper")) return;

  new Swiper(".js-mv-swiper", {
    loop: true,
    speed: 2000,
    effect: "fade",
    fadeEffect: { crossFade: true },
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".js-mv-pagination",
      clickable: true,
    },
  });
});
