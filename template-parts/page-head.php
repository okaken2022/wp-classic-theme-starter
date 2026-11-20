<?php
/**
 * 下層ページの見出し
 *
 * get_template_part('template-parts/page-head', null, array(
 *   'title' => '会社概要',   // 必須
 *   'en'    => 'Company',    // 任意
 * ));
 */
$title = isset($args['title']) ? $args['title'] : get_the_title();
$en    = isset($args['en']) ? $args['en'] : '';
?>
<div class="pageHead">
  <div class="pageHead__inner l-wrapper">
    <?php if ($en) : ?>
      <p class="pageHead__en fade-in-up"><?php echo esc_html($en); ?></p>
    <?php endif; ?>
    <h1 class="pageHead__title fade-in-up"><?php echo esc_html($title); ?></h1>
  </div>
</div>
