<?php
/**
 * トップページ
 */
get_header();
?>

<main class="top">
  <section class="topKv">
    <div class="topKv__inner l-wrapper">
      <h2 class="topKv__copy fade-in-up">キャッチコピー</h2>
    </div>
  </section>

  <section class="topNews l-section">
    <div class="l-wrapper">
      <?php get_template_part('template-parts/section-title', null, array('en' => 'News', 'ja' => 'お知らせ')); ?>
      <?php
      $starter_theme_news = new WP_Query(array(
          'post_type'      => 'post',
          'posts_per_page' => 3,
      ));
      ?>
      <?php if ($starter_theme_news->have_posts()) : ?>
        <ul class="topNews__list">
          <?php while ($starter_theme_news->have_posts()) : $starter_theme_news->the_post(); ?>
            <li class="topNews__item fade-in-up">
              <a href="<?php the_permalink(); ?>" class="topNews__link">
                <time class="topNews__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                <span class="topNews__title"><?php the_title(); ?></span>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p class="topNews__empty">お知らせはまだありません。</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
