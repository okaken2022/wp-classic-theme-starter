<?php get_header(); ?>

<main class="notFound">
  <?php get_template_part('template-parts/page-head', null, array('title' => 'ページが見つかりません', 'en' => '404 Not Found')); ?>

  <section class="l-section">
    <div class="l-wrapper">
      <p>お探しのページは移動または削除された可能性があります。</p>
      <p><a href="<?php echo esc_url(home_url('/')); ?>" class="button">トップページへ</a></p>
    </div>
  </section>
</main>

<?php get_footer(); ?>
