"use strict";

/* ===============================================
# MV スライダー（Swiper・fade）
# CDN の swiper-bundle（グローバル Swiper）を使用
=============================================== */
document.addEventListener("DOMContentLoaded", () => {
  if (typeof Swiper === "undefined") return;
  if (!document.querySelector(".js-mv-swiper")) return;
  new Swiper(".js-mv-swiper", {
    loop: true,
    speed: 2e3,
    effect: "fade",
    fadeEffect: { crossFade: true },
    autoplay: {
      delay: 4e3,
      disableOnInteraction: false
    },
    pagination: {
      el: ".js-mv-pagination",
      clickable: true
    }
  });
});
