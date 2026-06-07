"use strict";

/* ===============================================
# スクロールアニメーション
=============================================== */
document.addEventListener("DOMContentLoaded", () => {
  const TRIGGER_RATIO = 0.85;
  const refreshFns = [];
  function observeElements(selector, activeClass = "is-active", options = {}, keepActive = false) {
    const elements = document.querySelectorAll(selector);
    if (!elements.length) return;
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add(activeClass);
          if (!keepActive) obs.unobserve(entry.target);
        } else if (keepActive) {
          entry.target.classList.remove(activeClass);
        }
      });
    }, options);
    const refresh = () => {
      const triggerPoint = window.innerHeight * TRIGGER_RATIO;
      elements.forEach((el) => {
        if (el.classList.contains(activeClass)) return;
        if (el.getBoundingClientRect().top < triggerPoint) {
          el.classList.add(activeClass);
          if (!keepActive) observer.unobserve(el);
        }
      });
    };
    elements.forEach((el) => observer.observe(el));
    refresh();
    refreshFns.push(refresh);
  }
  const getRootMargin = (pc, sp) => window.matchMedia("(min-width: 768px)").matches ? pc : sp;
  const refreshAll = () => refreshFns.forEach((fn) => fn());
  const debounce = (fn, delay = 200) => {
    let timer;
    return () => {
      clearTimeout(timer);
      timer = setTimeout(fn, delay);
    };
  };
  const recover = () => {
    refreshAll();
    requestAnimationFrame(() => {
      requestAnimationFrame(refreshAll);
    });
    setTimeout(refreshAll, 300);
    setTimeout(refreshAll, 1e3);
  };
  [
    { selector: ".js-fade-in", pc: "0px 0px -15% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-fade-up", pc: "0px 0px -15% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-slide-left", pc: "0px 0px -15% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-slide-right", pc: "0px 0px -15% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-scaleImg", pc: "0px 0px -20% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-split-heading", pc: "0px 0px -15% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-top-services-slide-right", pc: "0px 0px -15% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-top-services-scale-img", pc: "0px 0px -30% 0px", sp: "0px 0px -20% 0px" },
    { selector: ".js-top-equipment-scale-img", pc: "0px 0px -30% 0px", sp: "0px 0px -20% 0px" },
    { selector: ".js-top-equipment-slide-right", pc: "0px 0px -15% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-service-scale-img", pc: "0px 0px -20% 0px", sp: "0px 0px -15% 0px" },
    { selector: ".js-service-slide-right", pc: "0px 0px -20% 0px", sp: "0px 0px -15% 0px" }
  ].forEach(({ selector, pc, sp }) => {
    observeElements(selector, "is-active", {
      rootMargin: getRootMargin(pc, sp)
    });
  });
  window.addEventListener("load", recover, { once: true });
  window.addEventListener("pageshow", refreshAll);
  window.addEventListener("resize", debounce(refreshAll, 200));
  let restored = false;
  const onScrollRestore = () => {
    if (restored) return;
    restored = true;
    refreshAll();
    window.removeEventListener("scroll", onScrollRestore);
  };
  window.addEventListener("scroll", onScrollRestore, { passive: true });
  window.addEventListener("load", () => {
    setTimeout(() => {
      restored = true;
      window.removeEventListener("scroll", onScrollRestore);
    }, 3e3);
  }, { once: true });
});
/* ===============================================
# 文字を1文字ずつ <span> に分割
=============================================== */
function wrapTextInSpans(selector) {
  document.querySelectorAll(selector).forEach((element) => {
    const text = element.textContent;
    element.setAttribute("aria-label", text);
    element.setAttribute("role", "text");
    element.textContent = "";
    [...text].forEach((char, index) => {
      const span = document.createElement("span");
      span.textContent = char;
      span.style.setProperty("--index", index);
      span.setAttribute("aria-hidden", "true");
      element.appendChild(span);
    });
  });
}
wrapTextInSpans(".js-text-split");
/* ===============================================
# ハンバーガー / ドロワー開閉
=============================================== */
document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".js-hamburger");
  const drawer = document.querySelector(".js-drawer");
  if (!hamburger || !drawer) return;
  const openDrawer = () => {
    hamburger.classList.add("is-open");
    drawer.classList.add("is-open");
    document.body.classList.add("is-drawer-open");
    hamburger.setAttribute("aria-expanded", "true");
    hamburger.setAttribute("aria-label", "メニューを閉じる");
  };
  const closeDrawer = () => {
    hamburger.classList.remove("is-open");
    drawer.classList.remove("is-open");
    document.body.classList.remove("is-drawer-open");
    hamburger.setAttribute("aria-expanded", "false");
    hamburger.setAttribute("aria-label", "メニューを開く");
  };
  hamburger.addEventListener("click", () => {
    if (hamburger.classList.contains("is-open")) {
      closeDrawer();
    } else {
      openDrawer();
    }
  });
  
  // 閉じる（×）ボタン

  const closeBtn = document.querySelector(".js-drawer-close");
  if (closeBtn) closeBtn.addEventListener("click", closeDrawer);
  
  // ドロワー内リンクのクリックで閉じる

  drawer.querySelectorAll("a[href]").forEach((link) => {
    link.addEventListener("click", closeDrawer);
  });
  
  // Esc キーで閉じる

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && drawer.classList.contains("is-open")) {
      closeDrawer();
    }
  });
  
  // md(768)以上に広げたらドロワーを強制的に閉じる

  const mqlPc = window.matchMedia("(min-width: 768px)");
  mqlPc.addEventListener("change", (e) => {
    if (e.matches) closeDrawer();
  });
});
/* ===============================================
# トップへ戻る（スムーススクロール）
=============================================== */
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".js-to-top").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  });
});
