# JavaScript

`js/main.js` 1 ファイル。機能ごとに `initXxx()` を作り、末尾の `DOMContentLoaded` で呼ぶ。
ライブラリは `inc/enqueue.php` で CDN からバージョン固定で読み込む（GSAP 3.12.5 / Splide 4.1.4）。

## 用意済みの機能

| 関数 | 内容 |
|---|---|
| `initNav()` | ハンバーガー（`aria-expanded` 連動、リンククリック・Esc で閉じる） |
| `initHeaderScroll()` | スクロールで `.header.is-scrolled` |
| `initPageTop()` | `.pageTop.is-visible` とスクロールトップ |
| `initSliders()` | `.splide` を `SPLIDE_PRESETS` の設定で初期化 |
| `initScrollAnimations()` | `fade-in-*` |
| `initCropAnimations()` | `crop-from-*` に `.is-visible` |

`prefers-reduced-motion: reduce` のときはアニメーションを省略する。

## スクロールアニメーション

```html
<div class="fade-in-up">...</div>
<li class="fade-in-up" data-gsap-delay="0.1">...</li>
<div class="crop-from-left" style="--crop-color: #eaf6fd"><img src="..." alt=""></div>
```

| クラス | 動き |
|---|---|
| `fade-in-up` / `down` / `left` / `right` | その方向からフェードイン |
| `crop-from-left` / `right` / `top` / `bottom` | 幕が開いて画像が現れる |

CSS 側で `opacity: 0` にしないため、JS が動かなくても内容は表示される。

## Splide

```html
<div class="splide splide--cards" aria-label="施工実績">
  <div class="splide__track">
    <ul class="splide__list">
      <li class="splide__slide">...</li>
    </ul>
  </div>
</div>
```

種別は `.splide--{key}` で切り替え、`SPLIDE_PRESETS` に同じキーで設定を書く。修飾クラスが無いものは `default`。`breakpoints` は **max-width**。
