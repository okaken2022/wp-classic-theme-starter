---
paths:
  - "**/*.php"
---

# PHP / テンプレートルール

- 固定ページは `page-{slug}.php`。先頭 `_` のファイルは WP に認識されない
- 骨組み:

```php
<?php get_header(); ?>
<main class="{pageBlock}">
  <?php get_template_part('template-parts/page-head', null, array('title' => 'ページ名', 'en' => 'English')); ?>
  <section class="{pageBlock}Intro l-section" id="intro">
    <div class="l-wrapper">...</div>
  </section>
</main>
<?php get_footer(); ?>
```

- 出力は必ずエスケープ: `esc_html()` / `esc_attr()` / `esc_url()`。`the_title()` `the_content()` などの WP テンプレートタグはそのままでよい
- 画像: `<img src="<?php echo starter_theme_img('company/hero.webp'); ?>" alt="..." width="..." height="..." loading="lazy">`。KV など最初に見える画像は `loading="lazy"` を付けない
- レスポンシブ画像は `<picture>` + `<source media="(min-width: 768px)">`
- 内部リンクは `starter_theme_page_url('company')` を使い、`/company` の直書きを避ける
- `WP_Query` の後は `wp_reset_postdata()`
- `template-parts` へは `get_template_part('template-parts/xxx', null, $args)` で値を渡し、パーツ冒頭のコメントに受け取る `$args` を書く
- 関数・フック・グローバル変数は `starter_theme_` プレフィックス
- グローバルナビへの追加は `inc/setup.php` の `starter_theme_nav_items()` だけで行う（header/footer は自動で反映）
- 見出しは 1 ページに `h1` が 1 つ（page-head が出力）。セクションは `h2` から
