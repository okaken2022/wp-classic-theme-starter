<?php
/**
 * カスタム投稿タイプ・タクソノミー
 *
 * 必要になったら下のサンプルのコメントを外し、'works' をプロジェクトの名前に置き換える。
 * 追加後は 管理画面 > 設定 > パーマリンク で「変更を保存」してリライトルールを更新する。
 */

if (!defined('ABSPATH')) {
    exit;
}

/*
function starter_theme_register_post_types() {
    register_post_type('works', array(
        'labels' => array(
            'name'          => '実績',
            'singular_name' => '実績',
            'add_new_item'  => '実績を追加',
            'edit_item'     => '実績を編集',
            'all_items'     => '実績一覧',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-portfolio',
        'rewrite'       => array('slug' => 'works', 'with_front' => false),
        'supports'      => array('title', 'editor', 'thumbnail'),
        'show_in_rest'  => false,
    ));
}
add_action('init', 'starter_theme_register_post_types');
*/
