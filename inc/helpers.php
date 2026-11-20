<?php
/**
 * テンプレート用ヘルパー
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * テーマ内画像の URL を返す（エスケープ済み）
 *
 * 例: <img src="<?php echo starter_theme_img('top/kv.webp'); ?>" alt="">
 */
function starter_theme_img($path) {
    return esc_url(get_template_directory_uri() . '/img/' . ltrim($path, '/'));
}

/**
 * 固定ページのスラッグから URL を返す（エスケープ済み）。ページが無ければ home_url('/slug/')。
 */
function starter_theme_page_url($slug) {
    $page = get_page_by_path($slug);
    $url  = $page ? get_permalink($page) : home_url('/' . trim($slug, '/') . '/');
    return esc_url($url);
}

/**
 * 現在表示中のページが $slug かどうか（ナビの current 表示用）
 */
function starter_theme_is_current($slug) {
    return is_page($slug) || is_post_type_archive($slug) || is_singular($slug);
}
