<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
// ページ側で get_header('', array('theme' => 'light')) のように渡すとヘッダー配色を切り替えられる
$starter_theme_header_theme = isset($args['theme']) ? $args['theme'] : 'dark';
?>
<header class="header header--<?php echo esc_attr($starter_theme_header_theme); ?>">
  <div class="header__inner l-wrapper">
    <?php $starter_theme_logo_tag = is_front_page() ? 'h1' : 'p'; ?>
    <<?php echo $starter_theme_logo_tag; ?> class="header__logo">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logoLink">
        <?php bloginfo('name'); ?>
      </a>
    </<?php echo $starter_theme_logo_tag; ?>>

    <button class="header__toggle" type="button" aria-controls="global-nav" aria-expanded="false" aria-label="メニューを開く">
      <span class="header__toggleLine"></span>
      <span class="header__toggleLine"></span>
      <span class="header__toggleLine"></span>
    </button>

    <nav class="header__nav" id="global-nav" aria-label="グローバルナビゲーション">
      <ul class="header__navList">
        <?php foreach (starter_theme_nav_items() as $item) : ?>
          <li class="header__navItem">
            <a
              href="<?php echo starter_theme_page_url($item['slug']); ?>"
              class="header__navLink<?php echo starter_theme_is_current($item['slug']) ? ' header__navLink--current' : ''; ?>"
              <?php echo starter_theme_is_current($item['slug']) ? 'aria-current="page"' : ''; ?>
            ><?php echo esc_html($item['label']); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</header>
