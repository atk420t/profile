<?php
/**
 * head内に出力されるメタタグ系を制御する関数をこのファイルにまとめています。
 * - titleタグに出力されるタイトルの変更
 * - meta robot出力
 * - OGPタグ出力
 * - ページ分割した記事でrel next/prevを表示
 * - head内にタグを挿入（カスタマイザーの詳細設定）
 */

/*********************
 * titleタグを変更
 *********************/

function sng_document_title_separator($sep)
{
  $sep = '|';
  return $sep;
}

//著者ページとアーカイブページのタイトルを変更
function sng_document_title_parts($title_part)
{
  if (is_author()) {
    $title_part['title'] .= 'の書いた記事';
  } elseif (is_archive()) {
    $title_part['title'] = '「' . $title_part['title'] . '」の記事一覧';
  }
  return $title_part;
}

//タイトル全体を書き換え
function sng_pre_get_document_title($title)
{
  global $post;
  if (is_category() && output_archive_title()) {
    $title = output_archive_title();
  } elseif ($post && get_post_meta($post->ID, 'sng_title', true) && is_singular()) { // 修正
    $title = esc_attr(get_post_meta($post->ID, 'sng_title', true));
  }
  return $title;
}

add_theme_support('title-tag');
add_filter('document_title_separator', 'sng_document_title_separator');
add_filter('document_title_parts', 'sng_document_title_parts');
add_filter('pre_get_document_title', 'sng_pre_get_document_title');

/*********************
 * meta robotsを制御
 *********************/
//前提：カスタムフィールド（custom_field.php）で記事ごとに設定する
function sng_meta_robots()
{
  global $post;
  $rogots_tags = '';
  if (is_attachment()) { //メディアページの場合
    $rogots_tags = 'noindex,nofollow';
  } elseif (is_page() || is_single()) { //記事・固定ページの場合
    $robots_r = get_post_meta($post->ID, "noindex_options", true);
    if (is_array($robots_r)) {
        $rogots_tags = (in_array('noindex', $robots_r) && !in_array('nofollow', $robots_r)) ? 'noindex,follow' : implode(",", $robots_r);}
  } elseif (is_paged() || is_tag() || is_date()) { //トップやアーカイブの2ページ目以降はindexせず、followだけ。タグページは1ページ目からnoindex
    $rogots_tags = 'noindex,follow';
  } elseif (is_search()) { //検索結果はインデックスしない
    $rogots_tags = 'noindex,nofollow';
  } elseif (is_category()) { //カテゴリーページ
    //初期設定ではインデックス
    //$rogots_tags = 'noindex,follow';
  }
  if ($rogots_tags) {
    echo '<meta name="robots" content="' . $rogots_tags . '" />';
  }
//出力
} //END meta_robots()
add_action('wp_head', 'sng_meta_robots');

/*********************
 * メタタグ&OGPタグを出力
 *********************/
// og:title
if (!function_exists('sng_set_ogp_title_tag')) {
  function sng_set_ogp_title_tag() {
    global $post;
    $ogp_title = '';
    if (is_front_page() || is_home()) {
      $catchy = (get_bloginfo('description')) ? '｜' . get_bloginfo('description') : ""; //キャッチフレーズ
      $ogp_title = get_bloginfo('name') . $catchy;
    } elseif (is_category()) { //カスタムフィールドにタイトルが入力されているかどうかの場合分け
      $ogp_title = (output_archive_title()) ? output_archive_title() : '「' . single_cat_title('', false) . '」の記事一覧';
    } elseif (is_author()) { //著者ページ
      $ogp_title = get_the_author_meta('display_name') . 'の書いた記事一覧';
    } elseif ($post) { //投稿ページ
      $ogp_title = $post->post_title;
    }
    return $ogp_title;
  }
}

// og:image
if (!function_exists('sng_set_ogp_image')) {
  function sng_set_ogp_image() {
    if( is_singular() ) return featured_image_src('large');
    if( get_option('set_home_ogp_image') ) {
      return get_option('set_home_ogp_image');
    } elseif( get_option('thumb_upload') ){
      return get_option('thumb_upload');
    } elseif( get_option('logo_image_upload') ) {
      return get_option('logo_image_upload');
    } else {
      return get_template_directory_uri() . '/library/images/default.jpg';
    }
  }
}

// og:description
if (!function_exists('sng_set_ogp_description')) {
  function sng_set_ogp_description() {
    global $post;
    if ( is_singular() ) {
      // 投稿ページ
      if( get_post_meta($post->ID, 'sng_meta_description', true) ){
        return get_post_meta($post->ID, 'sng_meta_description', true);
      }
      setup_postdata($post);
      return get_the_excerpt();
      wp_reset_postdata();
    } elseif ( is_front_page() || is_home() ) {
      // トップページ
      if( get_option('home_description') ) return get_option('home_description');
      if( get_bloginfo('description') ) return get_bloginfo('description');
    } elseif ( is_category() ) {
      // カテゴリーページ
      $cat_term = get_term(get_query_var('cat'), "category");
      $cat_meta = get_option($cat_term->taxonomy . '_' . $cat_term->term_id);
      if (!empty($cat_meta['category_description'])) {
        return esc_attr($cat_meta['category_description']);
      } else {
        return get_bloginfo('name') . 'の「' . single_cat_title('', false) . '」についての投稿一覧です。';
      }
    } elseif ( is_tag() ) {
      // タグページ
      return wp_strip_all_tags(term_description());
    } elseif (is_author() && get_the_author_meta('description')) {
      // 著者ページ
      return get_the_author_meta('description');
    }
    return "";
  }
}

// og:url
if (!function_exists('sng_set_ogp_url')) {
  function sng_set_ogp_url() {
    if ( is_front_page() || is_home() ) { //トップページ
      return home_url();
    } elseif ( is_category() ) { //カテゴリーページ
      return get_category_link(get_query_var('cat'));
    } elseif ( is_author() ) { //著者ページ
      return get_author_posts_url(get_the_author_meta('ID'));
    } else { //投稿ページ等
      return get_permalink();
    }
  }
}

// meta description
if (!function_exists('sng_set_meta_description')) {
  function sng_set_meta_description() {
    global $post;
    if( is_singular() && get_post_meta($post->ID, 'sng_meta_description', true) ) {
      // 投稿ページ
      return get_post_meta($post->ID, 'sng_meta_description', true);
    } elseif( is_front_page() || is_home() ) {
      // トップページ
      if( get_option('home_description') ) return get_option('home_description');
      if( get_bloginfo('description') ) return get_bloginfo('description');
    } elseif(is_category()) {
      // カテゴリページ
      $cat_term = get_term(get_query_var('cat'), "category");
      $cat_meta = get_option($cat_term->taxonomy . '_' . $cat_term->term_id); 
      return $cat_meta['category_description'];
    } elseif ( is_tag() ) {
      return wp_strip_all_tags(term_description());
    }
    return false;
    // これ以外のページではメタデスクリプションを出力しない
    // メタデスクリプションは指定しなくても、Googleが自動で説明文を生成してくれるため
  }
}


function sng_meta_ogp()
{
  $insert = '';
  if (sng_set_meta_description()) {
    $insert = '<meta name="description" content="' . esc_attr(sng_set_meta_description()) . '" />';
  }
  $ogp_descr = sng_set_ogp_description();
  $ogp_img = sng_set_ogp_image();
  $ogp_title = sng_set_ogp_title_tag();
  $ogp_url = sng_set_ogp_url();
  $ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

  // 出力するOGPタグをまとめる
  $insert .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '" />' . "\n";
  $insert .= '<meta property="og:description" content="' . esc_attr($ogp_descr) . '" />' . "\n";
  $insert .= '<meta property="og:type" content="' . $ogp_type . '" />' . "\n";
  $insert .= '<meta property="og:url" content="' . esc_url($ogp_url) . '" />' . "\n";
  $insert .= '<meta property="og:image" content="' . esc_url($ogp_img) . '" />' . "\n";
  $insert .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
  $insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";

  // facebookのappdid
  if (get_option('fb_app_id')) {
    $insert .= '<meta property="fb:app_id" content="' . get_option('fb_app_id') . '">';
  }

  // 出力
  if ( is_front_page() || is_home() || is_singular() || is_category() || is_author() || is_tag() ) {
    echo $insert;
  }

} //END sng_meta_ogp
add_action('wp_head', 'sng_meta_ogp');

/*********************
 * 分割した記事でrel next/prevを表示
 *********************/
function rel_next_prev()
{
  if (is_singular()) {
    global $post;
    global $page; //現在のページ番号
    $pages = substr_count($post->post_content, '<!--nextpage-->') + 1; //総ページ数
    if ($pages > 1) { //複数ページあるとき
      if ($page == $pages) { //最後のページの場合
        if ($page == 2) { //2ページ目の場合
          echo '<link rel="prev" href="' . esc_url(get_permalink()) . '">';
        } else { //最後2ページ目以外
          next_prev_permalink("prev", $page);
        }
      } else { //最後ではない場合
        if ($page == 1 || $page == 0) { //1ページ目の場合
          next_prev_permalink("", $page);
        } elseif ($page == 2) { //2ページ目＆最後のページでない
          echo '<link rel="prev" href="' . esc_url(get_permalink()) . '">';
          next_prev_permalink("next", $page);
        } else { //3ページ目以降＆最後のページではないとき
          next_prev_permalink("prev", $page);
          next_prev_permalink("", $page);
        }
      }
    }
  }
}
add_action('wp_head', 'rel_next_prev');
//ページのnext/prevのリンクを出力（上記関数で利用）
function next_prev_permalink($direction, $page)
{
  if ($direction == "prev") {
    $num = $page - 1;
  } else {
    $num = ($page == 0) ? $page + 2 : $page + 1;
  }
  if (get_option('permalink_structure') == '') {
    $url = add_query_arg('page', $num, get_permalink());
  } else {
    $url = trailingslashit(get_permalink()) . user_trailingslashit($num, 'single_paged');
  }
  if ($direction == "prev") {
    $output = '<link rel="prev" href="' . $url . '">';
  } else {
    $output = '<link rel="next" href="' . $url . '">';
  }
  echo $output;
}

//head内にタグを挿入（カスタマイザーの詳細設定）
if (get_option('insert_tag_tohead')) {
  add_action('wp_head', 'sng_insert_tag_tohead');
  function sng_insert_tag_tohead()
  {
    echo get_option('insert_tag_tohead');
  }
}