<?php

// include Classic editor css
add_editor_style( 'library/css/editor-style.css' );

// include Gutenberg editor css
add_action( 'enqueue_block_editor_assets', 'gutenberg_stylesheets_custom' );
function gutenberg_stylesheets_custom() {
  $editor_style_url = get_theme_file_uri('/library/css/editor-style.css');
  wp_enqueue_style( 'theme-editor-style', $editor_style_url );
}

// Remove Admin Bar
if(is_mobile()){
add_filter( 'show_admin_bar', '__return_false' );
}

// Remove .hentry
function remove_hentry( $classes ) {
    if (!is_single()) $classes = array_diff($classes, array('hentry'));
    return $classes;
}
add_filter('post_class', 'remove_hentry');

// Add Class post_class
function add_class_article( $classes ) {
    $classes[] = 'article cf';
    return $classes;
}
add_filter('post_class', 'add_class_article');

// Add Class body
add_filter( 'body_class', 'oc_custom_class' );
function oc_custom_class( $classes ) {
	if (!is_active_sidebar('sidebar1') && !is_active_sidebar('side-fixed')){
		$classes[] = 'sidebar_none';
	}
	$classes[] = get_option('side_options_headerbg','bgnormal');
	$classes[] = get_option('side_options_pannavi','pannavi_on');
	$classes[] = get_option('post_options_ttl', 'h_default');
	$classes[] = get_option('side_options_sidebarlayout', 'sidebarright');
	$classes[] = get_option('post_options_date', 'undo_off');
	return $classes;		
}

// Remove Version
if (!function_exists('vc_remove_wp_ver_css_js')) {
	function vc_remove_wp_ver_css_js( $src ) {
	    if ( strpos( $src, 'ver=' ) )
	        $src = remove_query_arg( 'ver', $src );
	    return $src;
	}
	add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
	add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
}

/************* ORIGINAL CUSTOM FIELD *******************/

// 投稿ページへ表示するカスタムボックスを定義する
add_action('admin_menu', 'add_cf_single_fullview');
// 入力したデータの更新処理
add_action('save_post', 'save_custom_postdata');
 
// 投稿ページ用
function add_cf_single_fullview() {
    add_meta_box( 'singlepostlayout','記事レイアウト', 'singlepostlayout_custom_field', 'post', 'side' );
}
 
// 投稿ページに表示されるカスタムフィールド
function singlepostlayout_custom_field(){
       $id = get_the_ID();
       //カスタムフィールドの値を取得
        $singlepostlayout_radio = get_post_meta($id,'singlepostlayout_radio',true);
        $data = array(
             array("デフォルト（2カラム）","デフォルト（2カラム）",""),
	         array("フルサイズ（1カラム）","フルサイズ（1カラム）",""),
	         array("バイラル風（1カラム）","バイラル風（1カラム）",""),
         );
 
        foreach($data as $d){
        if($d[1]==$singlepostlayout_radio) $d[2] ="checked";
        echo <<<EOS
        <label style="display:block; padding:.3em 0;"><input type="radio" name="singlepostlayout_radio" value="{$d[1]}" {$d[2]}>{$d[0]}</label>
EOS;
    }
       echo <<<EOS
 
EOS;
}
// データ更新・保存
function save_custom_postdata($post_id){
    $singlepostlayout_radio=isset($_POST['singlepostlayout_radio']) ? $_POST['singlepostlayout_radio']: null;
    $singlepostlayout_radio_ex = get_post_meta($post_id, 'singlepostlayout_radio', true);
    if($singlepostlayout_radio){
      update_post_meta($post_id, 'singlepostlayout_radio',$singlepostlayout_radio);
    }else{
      delete_post_meta($post_id, 'singlepostlayout_radio',$singlepostlayout_radio_ex);
    }
}