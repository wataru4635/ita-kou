"use strict";

/**
 * facilities ページ: サムネイルをクリックするとメイン画像が切り替わる
 * - 選択中サムネは .is-active（太枠）
 * - 白背景画像のときはメイン枠に .is-white（上下余白を狭く）
 */
const initFacilityGallery = () => {
  const facilities = document.querySelectorAll(".facility");
  facilities.forEach((facility) => {
    const mainBox = facility.querySelector(".facility__main");
    const mainImg = facility.querySelector(".facility__main-img");
    const thumbs = facility.querySelectorAll(".facility__thumb");
    if (!mainBox || !mainImg || thumbs.length === 0) return;
    thumbs.forEach((thumb) => {
      thumb.addEventListener("click", () => {
        const src = thumb.dataset.src;
        if (!src || thumb.classList.contains("is-active")) return;
        mainImg.src = src;
        mainBox.classList.toggle("is-white", thumb.dataset.white === "1");
        thumbs.forEach((t) => t.classList.remove("is-active"));
        thumb.classList.add("is-active");
      });
    });
  });
};
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initFacilityGallery);
} else {
  initFacilityGallery();
}
