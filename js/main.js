/**
 * テーマ共通 JS
 *
 * - 機能ごとに initXxx() を作り、末尾の DOMContentLoaded で呼ぶ
 * - ページ固有の処理は対象要素が無ければ即 return する（他ページへの副作用を避ける）
 * - GSAP / ScrollTrigger / Splide は inc/enqueue.php でグローバルに読み込み済み
 */
(() => {
  "use strict";

  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ------------------------------------------------------------------
   * ハンバーガーメニュー
   * ------------------------------------------------------------------ */
  function initNav() {
    const toggle = document.querySelector(".header__toggle");
    const nav = document.getElementById("global-nav");
    if (!toggle || !nav) return;

    const setOpen = (open) => {
      toggle.setAttribute("aria-expanded", String(open));
      toggle.setAttribute("aria-label", open ? "メニューを閉じる" : "メニューを開く");
      nav.classList.toggle("is-open", open);
      document.body.classList.toggle("is-navOpen", open);
    };

    toggle.addEventListener("click", () => {
      setOpen(toggle.getAttribute("aria-expanded") !== "true");
    });

    nav.addEventListener("click", (event) => {
      if (event.target.closest("a")) setOpen(false);
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") setOpen(false);
    });
  }

  /* ------------------------------------------------------------------
   * ヘッダー: スクロールで .is-scrolled
   * ------------------------------------------------------------------ */
  function initHeaderScroll() {
    const header = document.querySelector(".header");
    if (!header) return;

    const update = () => header.classList.toggle("is-scrolled", window.scrollY > 10);
    update();
    window.addEventListener("scroll", update, { passive: true });
  }

  /* ------------------------------------------------------------------
   * ページトップボタン
   * ------------------------------------------------------------------ */
  function initPageTop() {
    const button = document.querySelector(".pageTop");
    if (!button) return;

    const update = () => button.classList.toggle("is-visible", window.scrollY > 400);
    update();
    window.addEventListener("scroll", update, { passive: true });

    button.addEventListener("click", (event) => {
      event.preventDefault();
      window.scrollTo({ top: 0, behavior: prefersReducedMotion ? "auto" : "smooth" });
    });
  }

  /* ------------------------------------------------------------------
   * Splide
   * 種別は .splide--{name} で分岐する。新しい種別はここに追加。
   * breakpoints は max-width 指定。
   * ------------------------------------------------------------------ */
  const SPLIDE_PRESETS = {
    cards: {
      perPage: 3,
      gap: "24px",
      pagination: false,
      breakpoints: {
        1024: { perPage: 2 },
        767: { perPage: 1, gap: "16px" },
      },
    },
    default: {
      type: "loop",
      perPage: 1,
      autoplay: !prefersReducedMotion,
      interval: 5000,
    },
  };

  function getSplidePreset(element) {
    const match = [...element.classList].find((name) => name.startsWith("splide--"));
    const key = match ? match.replace("splide--", "") : "default";
    return SPLIDE_PRESETS[key] || SPLIDE_PRESETS.default;
  }

  function initSliders() {
    if (typeof Splide === "undefined") return;

    document.querySelectorAll(".splide").forEach((element) => {
      new Splide(element, getSplidePreset(element)).mount();
    });
  }

  /* ------------------------------------------------------------------
   * スクロールアニメーション（GSAP）
   * <div class="fade-in-up" data-gsap-delay="0.1">
   * ------------------------------------------------------------------ */
  const FADE_DIRECTIONS = {
    "fade-in-up": { y: 50 },
    "fade-in-down": { y: -50 },
    "fade-in-left": { x: -80 },
    "fade-in-right": { x: 80 },
  };

  function initScrollAnimations() {
    if (prefersReducedMotion || typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") return;

    gsap.registerPlugin(ScrollTrigger);

    Object.entries(FADE_DIRECTIONS).forEach(([className, from]) => {
      document.querySelectorAll(`.${className}`).forEach((element) => {
        gsap.from(element, {
          ...from,
          opacity: 0,
          duration: 0.8,
          delay: Number.parseFloat(element.dataset.gsapDelay || "0"),
          ease: "power2.out",
          scrollTrigger: {
            trigger: element,
            start: "top 85%",
            once: true,
          },
        });
      });
    });
  }

  /* ------------------------------------------------------------------
   * クロップアニメーション（CSS transition + .is-visible）
   * <div class="crop-from-left"><img ...></div>
   * ------------------------------------------------------------------ */
  function initCropAnimations() {
    const elements = document.querySelectorAll('[class*="crop-from-"]');
    if (!elements.length) return;

    if (prefersReducedMotion || typeof ScrollTrigger === "undefined") {
      elements.forEach((element) => element.classList.add("is-visible"));
      return;
    }

    elements.forEach((element) => {
      ScrollTrigger.create({
        trigger: element,
        start: "top 80%",
        once: true,
        onEnter: () => element.classList.add("is-visible"),
      });
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    initNav();
    initHeaderScroll();
    initPageTop();
    initSliders();
    initScrollAnimations();
    initCropAnimations();
  });
})();
