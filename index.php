<?php
/**
 * フォールバック（投稿一覧など）
 */
get_header();
?>

<main class="archive">
  <?php get_template_part('template-parts/page-head', null, array('title' => is_home() ? 'お知らせ' : get_the_archive_title())); ?>

  <section class="l-section">
    <div class="l-wrapper">
      <?php if (have_posts()) : ?>
        <ul class="postList">
          <?php while (have_posts()) : the_post(); ?>
            <li class="postList__item">
              <a href="<?php the_permalink(); ?>" class="postList__link">
                <time class="postList__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                <span class="postList__title"><?php the_title(); ?></span>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
        <?php the_posts_pagination(); ?>
      <?php else : ?>
        <p>記事が見つかりませんでした。</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
