<?php
/**
 * テーマの基本設定
 */

if (!defined('ABSPATH')) {
    exit;
}

// クラシックエディタ（Gutenberg 無効）
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// フロントの管理バーを非表示
add_filter('show_admin_bar', '__return_false');

function starter_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
}
add_action('after_setup_theme', 'starter_theme_setup');

// ブロックエディタ用 CSS をフロントから外す（クラシックテーマのため）
function starter_theme_dequeue_block_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'starter_theme_dequeue_block_styles', 100);

/**
 * グローバルナビの定義（header / footer 共通の唯一の定義元）
 *
 * ページを追加したらここに 1 行足す。
 *
 * @return array<int, array{label: string, slug: string}>
 */
function starter_theme_nav_items() {
    return array(
        array('label' => 'お知らせ', 'slug' => 'news'),
        array('label' => '会社概要', 'slug' => 'company'),
        array('label' => 'お問い合わせ', 'slug' => 'contact'),
    );
}
