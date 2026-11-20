---
paths:
  - "js/**/*.js"
---

# JavaScript ルール

- `js/main.js` の IIFE の中に `initXxx()` を追加し、末尾の `DOMContentLoaded` から呼ぶ
- 対象要素が無ければ最初に `return`（全ページで読み込まれるため）
- 状態クラスは `.is-*`（`is-open`, `is-visible`, `is-scrolled`）。CSS 側も同名で書く
- 開閉 UI は `aria-expanded` / `aria-controls` を更新する
- `prefers-reduced-motion` が有効なときはアニメーションを省略する（`prefersReducedMotion` を参照）
- Splide の新しい種別は `SPLIDE_PRESETS` にキーを足し、HTML 側は `.splide.splide--{key}`。`breakpoints` は max-width
- 外部ライブラリを増やすときは `inc/enqueue.php` でバージョン固定して読み込み、`main.js` の依存に追加する
- `console.log` を残さない
