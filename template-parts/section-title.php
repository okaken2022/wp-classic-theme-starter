<?php
/**
 * セクション見出し
 *
 * get_template_part('template-parts/section-title', null, array(
 *   'en'  => 'News',     // 必須
 *   'ja'  => 'お知らせ', // 任意
 *   'tag' => 'h2',       // 任意（h2 / h3）
 * ));
 */
$en  = isset($args['en']) ? $args['en'] : '';
$ja  = isset($args['ja']) ? $args['ja'] : '';
$tag = (isset($args['tag']) && in_array($args['tag'], array('h2', 'h3'), true)) ? $args['tag'] : 'h2';
?>
<div class="sectionTitle fade-in-up">
  <<?php echo $tag; ?> class="sectionTitle__en"><?php echo esc_html($en); ?></<?php echo $tag; ?>>
  <?php if ($ja) : ?>
    <p class="sectionTitle__ja"><?php echo esc_html($ja); ?></p>
  <?php endif; ?>
</div>
