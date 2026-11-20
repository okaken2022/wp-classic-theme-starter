---
paths:
  - "sass/**/*.scss"
---

# Sass ルール

- 各パーシャルの先頭は `@use "../abstracts" as *;`（abstracts 以外）
- 新しいパーシャルを作ったら `sass/style.scss` の該当グループ末尾に `@use` を追加する
- ページ固有のスタイルは `sass/pages/_{pageName}.scss`。ファイル名とブロック名はキャメルケースで揃える（`page-mid-career.php` → `_midCareer.scss` / `.midCareer`）
- 2 ページ以上で使うものは `components/` に切り出し、対応する PHP は `template-parts/` に置く
- 使える mixin / function:
  - `mq(xs|sm|md|lg|xl|xxl)` … min-width
  - `mq-down(key)` … max-width（例外用）
  - `hover` … `@media (any-hover: hover)` 付きの `:hover`
  - `hover-opacity($opacity)` / `line-height(narrow|tight|base|relaxed)` / `visually-hidden`
  - `rem(18)` / `to-vw(60, 1440)` / `z(header)`
- 非推奨 API は使わない: `map-get` → `map.get`、`darken()` → トークン追加、`/` 除算 → `math.div`
- `z-index` は `z(key)` 経由。新しい層は `$z-index` に追加する
- `!important` はユーティリティ（`utility/`）以外で使わない

```scss
// OK
.card__title {
  &:hover { ... }
}

.card__title--large { ... }

// NG（stylelint の scss/selector-no-union-class-name で落ちる）
.card {
  &__title { ... }
  &--large { ... }
}
```
