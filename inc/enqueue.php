<?php
/**
 * CSS / JS の読み込み
 *
 * 外部ライブラリはバージョンを固定する。header.php / footer.php に直接 <link>/<script> を書かない。
 */

if (!defined('ABSPATH')) {
    exit;
}

define('STARTER_THEME_GSAP_VERSION', '3.12.5');
define('STARTER_THEME_SPLIDE_VERSION', '4.1.4');

/**
 * テーマ内ファイルの更新時刻（キャッシュバスト用）。ファイルが無ければ null。
 */
function starter_theme_asset_version($relative_path) {
    $path = get_template_directory() . $relative_path;
    return file_exists($path) ? (string) filemtime($path) : null;
}

function starter_theme_enqueue_assets() {
    $uri = get_template_directory_uri();

    // Google Fonts
    wp_enqueue_style(
        'starter-theme-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap',
        array(),
        null
    );

    // Splide（CSS / JS）
    wp_enqueue_style(
        'splide',
        'https://cdn.jsdelivr.net/npm/@splidejs/splide@' . STARTER_THEME_SPLIDE_VERSION . '/dist/css/splide.min.css',
        array(),
        STARTER_THEME_SPLIDE_VERSION
    );
    wp_enqueue_script(
        'splide',
        'https://cdn.jsdelivr.net/npm/@splidejs/splide@' . STARTER_THEME_SPLIDE_VERSION . '/dist/js/splide.min.js',
        array(),
        STARTER_THEME_SPLIDE_VERSION,
        true
    );

    // GSAP + ScrollTrigger
    wp_enqueue_script(
        'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@' . STARTER_THEME_GSAP_VERSION . '/dist/gsap.min.js',
        array(),
        STARTER_THEME_GSAP_VERSION,
        true
    );
    wp_enqueue_script(
        'gsap-scroll-trigger',
        'https://cdn.jsdelivr.net/npm/gsap@' . STARTER_THEME_GSAP_VERSION . '/dist/ScrollTrigger.min.js',
        array('gsap'),
        STARTER_THEME_GSAP_VERSION,
        true
    );

    // テーマ本体（css/style.css は npm run build で生成）
    wp_enqueue_style(
        'starter-theme-style',
        $uri . '/css/style.css',
        array('starter-theme-fonts', 'splide'),
        starter_theme_asset_version('/css/style.css')
    );
    wp_enqueue_script(
        'starter-theme-script',
        $uri . '/js/main.js',
        array('gsap', 'gsap-scroll-trigger', 'splide'),
        starter_theme_asset_version('/js/main.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'starter_theme_enqueue_assets');

// Google Fonts の preconnect
function starter_theme_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin');
    }
    return $urls;
}
add_filter('wp_resource_hints', 'starter_theme_resource_hints', 10, 2);
