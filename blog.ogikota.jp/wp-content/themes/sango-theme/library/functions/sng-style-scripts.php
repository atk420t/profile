<?php
/**
 * このファイルでは各種CSSやJSファイルを読み込むための関数を記載しています。
 * 各種CSS/JS
 * Google Font
 * Font Awesome
 * Classic Editorのスタイル
 * Gutenberg用のスタイルはSANGO Gutenbergプラグインを導入することで読み込まれるようになります。
 */

// 基本的なスタイルの読み込み
add_action('wp_enqueue_scripts', 'sng_basic_scripts_and_styles', 1 );
if (!function_exists('sng_basic_scripts_and_styles')) {
  function sng_basic_scripts_and_styles() {
    if (!is_admin()) {
      $theme_ver = wp_get_theme('sango-theme')->Version;
      //メイン
      wp_enqueue_style(
        'sng-stylesheet',
        get_template_directory_uri() . '/style.css?ver' . $theme_ver,
        array(),
        '',
        'all'
      );
      //投稿
      wp_enqueue_style(
        'sng-option',
        get_template_directory_uri() . '/entry-option.css?ver' . $theme_ver,
        array('sng-stylesheet'),
        '',
        'all'
      );
      // jQuery
      wp_deregister_script('jquery');
      wp_enqueue_script(
        'jquery',
        'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', 
        array(),
        '',
        false
      );
      // コメント用
      if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
        wp_enqueue_script('comment-reply');
      }
      // GutenbergのデフォルトCSS読み込み解除オプション
      if (get_option('no_gutenberg_default_style')) {
        wp_deregister_style('wp-block-library');
        wp_dequeue_style('wp-block-library');
      }
    } //endif isAdmin
  } 
}//END sng_basic_scripts_and_styles

// Google Font
add_action('wp_enqueue_scripts', 'sng_google_font', 1 );
if (!function_exists('sng_google_font')) {
  function sng_google_font() {
    wp_enqueue_style(
      'sng-googlefonts',
      '//fonts.googleapis.com/css?family=Quicksand:500,700',
      array(),
      '',
      'all'
    );
  }
}

// FontAwesome
add_action('wp_enqueue_scripts', 'sng_font_awesome', 1 );
if (!function_exists('sng_font_awesome')) {
  function sng_font_awesome() {
    if (get_option('use_fontawesome4')) {
      wp_enqueue_style(
        'sng-fontawesome4',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        array()
      );
    } else {
      wp_enqueue_style(
        'sng-fontawesome5',
        get_template_directory_uri() . '/library/fontawesome5/css/all.min.css?ver5.7.2',
        array()
      );
    }
  }
}

// Classic Editor style
add_editor_style(get_template_directory_uri() . '/library/css/editor-style.css');