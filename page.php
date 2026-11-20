<?php
/**
 * 固定ページの共通テンプレート（page-{slug}.php が無いページで使われる）
 */
get_header();
?>

<main class="page">
  <?php get_template_part('template-parts/page-head', null, array('title' => get_the_title())); ?>

  <section class="l-section">
    <div class="l-wrapper">
      <?php while (have_posts()) : the_post(); ?>
        <div class="entryContent">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
