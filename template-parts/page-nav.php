<?php
/**
 * ページ内アンカーナビ
 *
 * get_template_part('template-parts/page-nav', null, array(
 *   'items' => array(
 *     array('label' => '会社概要', 'id' => 'outline'),
 *     array('label' => 'アクセス', 'id' => 'access'),
 *   ),
 * ));
 */
$items = isset($args['items']) ? $args['items'] : array();
if (!$items) {
    return;
}
?>
<nav class="pageNav" aria-label="ページ内ナビゲーション">
  <ul class="pageNav__list l-wrapper">
    <?php foreach ($items as $item) : ?>
      <li class="pageNav__item">
        <a href="#<?php echo esc_attr($item['id']); ?>" class="pageNav__link"><?php echo esc_html($item['label']); ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>
