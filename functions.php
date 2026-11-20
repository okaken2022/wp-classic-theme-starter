<?php
/**
 * Theme functions
 *
 * 処理は inc/ に分割し、ここでは読み込みだけを行う。
 * 関数名・フック名のプレフィックスは starter_theme_ に統一する。
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/post-types.php';
