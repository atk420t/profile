<?php
require_once 'library/functions/custom-field.php';
require_once 'library/functions/head.php';
require_once 'library/functions/sng-function.php';
require_once 'library/functions/entry-function.php';
require_once 'library/functions/widget-setting.php';
require_once 'library/functions/sng-style-scripts.php';
require_once 'library/functions/customizer.php';
require_once 'library/functions/style-shortcode.php';
require_once 'library/functions/classic-editor-styles.php';

/**
 * セットアップ
 */
function sng_after_setup() {
    //SETUP1) headの不要タグを除去
    add_action('init', 'sng_head_cleanup');

    //SETUP2) RSSからWPのバージョンを削除
    add_filter('the_generator', 'sng_rss_version');

    //SETUP3) 最近のコメントウィジェットに適用されるCSSを削除
    add_filter('wp_head', 'sng_remove_wp_widget_recent_comments_style', 1);
    add_action('wp_head', 'sng_remove_recent_comments_style', 1);

    //SETUP4) ギャラリースタイルに適用されるCSSを削除
    add_filter('gallery_style', 'sng_gallery_style');

    //SETUP5) 各種THEME SUPPORT
    sng_theme_support();

    //SETUP6) ウィジェットを登録
    add_action('widgets_init', 'sng_register_sidebars');

} /* end sng_after_setup */
add_action('after_setup_theme', 'sng_after_setup');

/*****************************
SETUP1) headの不要タグを除去
 ******************************/

function sng_head_cleanup()
{
    // カテゴリ等のフィードを削除
    // * 以下一文をコメントアウトすれば表示されるように
    remove_action('wp_head', 'feed_links_extra', 3);

    // リモート投稿用のリンクの出力は一応残しておきます
    // remove_action( 'wp_head', 'rsd_link' );

    // Windows Live Writer用のリンクを削除（使わないですよね）
    remove_action('wp_head', 'wlwmanifest_link');

    // 前後の記事等へのrel linkを削除
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

    // WPのバージョン表示も削除
    remove_action('wp_head', 'wp_generator');

    //CSSやJSファイルに付与されるWordPressのバージョンを消す
    //下記の関数を指定
    add_filter('style_loader_src', 'sng_remove_wp_ver_css_js', 9999);
    add_filter('script_loader_src', 'sng_remove_wp_ver_css_js', 9999);

} /* end sng head cleanup */

function sng_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}

/*****************************
SETUP2) RSSからWPのバージョンを削除
 ******************************/
function sng_rss_version()
{return '';}

/*****************************
SETUP3) 「最近のコメント」ウィジェットに適用されるCSSを削除
 ******************************/
function sng_remove_wp_widget_recent_comments_style()
{
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
        remove_filter('wp_head', 'wp_widget_recent_comments_style');
    }
}
function sng_remove_recent_comments_style()
{
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    }
}

/*****************************
SETUP4) ギャラリーに適用されるCSSを削除
 ******************************/
function sng_gallery_style($css)
{
    return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/*****************************
SETUP5) THEME SUPPORT
 ******************************/
function sng_theme_support()
{

    // サムネイル画像を使用可能に
    add_theme_support('post-thumbnails');

    // デフォルトのサムネイルサイズ
    set_post_thumbnail_size(125, 125, true);

    add_image_size('thumb-940', 940); //関連記事等で利用
    add_image_size('thumb-520', 520, 300, true); //関連記事等で利用
    add_image_size('thumb-160', 160, 160, true); //サムネイルサイズ

    function sng_custom_image_sizes($sizes)
    {
        return array_merge($sizes, array(
            'thumb-520' => '520 x 300px',
            'thumb-160' => '160 x 160px',
        ));
    }
    add_filter('image_size_names_choose', 'sng_custom_image_sizes');

    //SVGをアップロードできるように
    function enable_svg($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'enable_svg');

    // カスタム背景
    add_theme_support('custom-background',
        array(
            'default-image' => '',
            'default-color' => '',
            'wp-head-callback' => '_custom_background_cb',
            'admin-head-callback' => '',
            'admin-preview-callback' => '',
        )
    );

    // rssリンクをhead内に出力
    add_theme_support('automatic-feed-links');

    // メニューを有効に
    add_theme_support('menus');

    // メニューを登録
    register_nav_menus(
        array(
            'desktop-nav' => 'ヘッダーメニュー（PCでのみ表示）',
            'mobile-nav' => 'スライドメニュー（モバイルのみ）',
            'footer-links' => 'フッターメニュー（ページ最下部）',
            'mobile-fixed' => 'モバイル用フッター固定メニュー',
        )
    );

    // HTML5マークアップをサポート
    add_theme_support('html5', array(
        'comment-list',
        'search-form',
        'comment-form',
    ));

} /* end theme support */

/*********************************
STEP6. サイドバー/ウィジェットの登録
 ***********************************/
function sng_register_sidebars()
{
    //メインのサイドバー
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => 'サイドバー',
        'description' => 'メインのサイドバーです。スマホで見たときにはページ下に配置されます。',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle dfont has-fa-before">',
        'after_title' => '</h4>',
    ));

    //追尾サイドバー
    register_sidebar(array(
        'id' => 'fixed_sidebar',
        'name' => '追尾サイドバー（PCのみ）',
        'description' => 'この中に入れたウィジェットは記事ページのサイドバーで固定されます',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle dfont has-fa-before">',
        'after_title' => '</h4>',
    ));

    //ナビドロワー（ハンバーガーメニュー）
    register_sidebar(array(
        'id' => 'nav_drawer',
        'name' => 'スマホ用ナビドロワー（ハンバーガーメニュー）',
        'description' => 'ハンバーガーメニューで表示されるナビドロワーです',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle has-fa-before">',
        'after_title' => '</h4>',
    ));

    //フッターウィジェット左
    register_sidebar(array(
        'id' => 'footer_left',
        'name' => 'フッターウィジェット左',
        'description' => '画面が小さくなるとフッターウィジェットは縦に並びます。',
        'before_widget' => '<div class="ft_widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="ft_title">',
        'after_title' => '</h4>',
    ));

    //フッターウィジェット中
    register_sidebar(array(
        'id' => 'footer_cent',
        'name' => 'フッターウィジェット中',
        'description' => '画面が小さくなるとフッターウィジェットは縦に並びます。',
        'before_widget' => '<div class="ft_widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="ft_title">',
        'after_title' => '</h4>',
    ));

    //フッターウィジェット右
    register_sidebar(array(
        'id' => 'footer_right',
        'name' => 'フッターウィジェット右',
        'description' => '画面が小さくなるとフッターウィジェットは縦に並びます。',
        'before_widget' => '<div class="ft_widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="ft_title">',
        'after_title' => '</h4>',
    ));

    //トップページ上
    register_sidebar(array(
        'id' => 'home_top',
        'name' => 'トップページ記事一覧上',
        'description' => 'トップページの記事一覧上のスペースに表示されます(モバイル/PC共通)
    。',
        'before_widget' => '<div class="home_top">',
        'after_widget' => '</div>',
        'before_title' => '<p class="strong dfont center">',
        'after_title' => '</p>',
    ));

    //トップページ下
    register_sidebar(array(
        'id' => 'home_bottom',
        'name' => 'トップページ記事一覧下',
        'description' => 'トップページの記事一覧下のスペースに表示されます(モバイル/PC共通)
    。',
        'before_widget' => '<div class="home_bottom">',
        'after_widget' => '</div>',
        'before_title' => '<p class="strong dfont center">',
        'after_title' => '</p>',
    ));

    // 記事タイトル下広告（モバイル）
    register_sidebar(array(
        'id' => 'ads_below_title_mb',
        'name' => '記事タイトル下広告（モバイル）',
        'description' => 'スマホ・タブレットで見たときに記事のタイトル下に表示されます。',
        'before_widget' => '<div class="sponsored">',
        'after_widget' => '</div>',
        'before_title' => '<p class="ads-title dfont">',
        'after_title' => '</p>',
    ));

    //記事タイトル下広告（PC）
    register_sidebar(array(
        'id' => 'ads_below_title_pc',
        'name' => '記事タイトル下広告（PC）',
        'description' => 'PCで見たときに記事のタイトル下に表示されます。',
        'before_widget' => '<div class="sponsored">',
        'after_widget' => '</div>',
        'before_title' => '<p class="ads-title dfont">',
        'after_title' => '</p>',
    ));

    //記事中広告
    register_sidebar(array(
        'id' => 'ads_in_contents',
        'name' => '記事中広告',
        'description' => 'はじめのh2見出しの前に表示されます',
        'before_widget' => '<div class="sponsored">',
        'after_widget' => '</div>',
        'before_title' => '<p class="ads-title dfont">',
        'after_title' => '</p>',
    ));

    //アドセンス 記事下広告（モバイル）
    register_sidebar(array(
        'id' => 'ads_below_contents_mb',
        'name' => '記事コンテンツ後広告（モバイル）',
        'description' => 'スマホ・タブレットで見たときに記事の記事コンテンツの下（シェアボタン前）に表示されます。',
        'before_widget' => '<div class="sponsored dfont">',
        'after_widget' => '</div>',
        'before_title' => '<p class="ads-title">',
        'after_title' => '</p>',
    ));

    //アドセンス 記事下広告（PC）
    register_sidebar(array(
        'id' => 'ads_below_contents_pc',
        'name' => '記事コンテンツ後広告（PC）',
        'description' => 'PCで見たときに記事の記事コンテンツの下（シェアボタン前）に表示されます。',
        'before_widget' => '<div class="sponsored dfont">',
        'after_widget' => '</div>',
        'before_title' => '<p class="ads-title">',
        'after_title' => '</p>',
    ));

    //アドセンス関連記事型広告
    register_sidebar(array(
        'id' => 'ads_footer',
        'name' => 'アドセンス関連記事型広告',
        'description' => '記事下に表示されます。アドセンスの関連記事型広告向けです。コードを貼り付けてご利用ください。',
        'before_widget' => '<div id="related_ads">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="h-undeline related_title">',
        'after_title' => '</h3>',
    ));

} //END sng_register_sidebars

/* ------------------------------Do not touch here------------------------------ */
require 'library/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://quirky-goodall-9f2b7e.netlify.com/wp-sango-theme-update-information-43fadgd.json',
    __FILE__,
    'sango-theme'
);