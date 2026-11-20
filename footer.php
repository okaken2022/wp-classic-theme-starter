<footer class="footer">
  <div class="footer__inner l-wrapper">
    <ul class="footer__menu">
      <?php foreach (starter_theme_nav_items() as $item) : ?>
        <li class="footer__menuItem">
          <a href="<?php echo starter_theme_page_url($item['slug']); ?>" class="footer__menuLink"><?php echo esc_html($item['label']); ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
    <p class="footer__copyright">
      <small>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?></small>
    </p>
  </div>
</footer>

<a href="#" class="pageTop" aria-label="ページの先頭へ戻る"></a>

<?php wp_footer(); ?>
</body>
</html>
