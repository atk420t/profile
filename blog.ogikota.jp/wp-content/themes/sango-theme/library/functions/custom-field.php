<?php
/**
 * このファイルでは投稿ページやカテゴリー設定ページで用いられる
 * カスタムフィールド系の関数をまとめています。
 */

/*****************************
 * 投稿/固定ページのカスタムフィールド
 ******************************/
add_action('admin_menu', 'add_sngmeta_field');
add_action('save_post', 'save_sngmeta_field');

function add_sngmeta_field()
{ //作成
  //投稿ページ
  add_meta_box('sng-meta-description', 'メタデスクリプション', 'show_my_description', 'post', 'normal');
  add_meta_box('sng-title-tag', '【高度な設定】titleタグ', 'show_my_title', 'post', 'normal');
  add_meta_box('sng-meta-roboto', 'メタロボット設定', 'show_noindex_follow', 'post', 'side');
  add_meta_box('sng-one-column', '1カラム（サイドバーを非表示）', 'show_one_column_option', 'post', 'side');
  add_meta_box('sng-no-ads', 'この記事では広告を非表示', 'disable_ads', 'post', 'side');
  //固定ページ
  add_meta_box('sng-meta-description', 'メタデスクリプション', 'show_my_description', 'page', 'normal');
  add_meta_box('sng-title-tag', '【高度な設定】titleタグ', 'show_my_title', 'page', 'normal');
  add_meta_box('sng-meta-roboto', 'メタロボット設定', 'show_noindex_follow', 'page', 'side');
}

//メタデスクリプション
function show_my_description()
{
  global $post;
  echo '<p class="howto">Google検索結果などに表示される記事の要約です（入力は必須ではありません）。100字以内に抑えるのが良いかと思います。</p><textarea name="sng_meta_description" cols="65" rows="4" onkeyup="document.getElementById(\'description_count\').value=this.value.length + \'字\'" style="max-width: 100%">' . get_post_meta($post->ID, 'sng_meta_description', true) . '</textarea><p><strong><input type="text" id="description_count" style="float: none;width: 40px;display: inline;border: none;box-shadow: none;"></strong></p>';
}

//titleタグ
function show_my_title()
{
  global $post;
  echo '<p class="howto">記事タイトルとは別のtitleタグを出力したい場合に入力します。空欄にすると記事タイトルがtitleタグに出力されます。</p><textarea name="sng_title" cols="65" rows="1" style="max-width: 100%">' . get_post_meta($post->ID, 'sng_title', true) . '</textarea>';
}

// noindex,nofollowのチェックボックス（sng-head.phpで出力設定）
function show_noindex_follow()
{
  global $post;
  //カスタムフィールドの値を取得
  $exist_options = get_post_meta($post->ID, 'noindex_options', true);
  //値があればその値をセットし、なければ空の配列array()を設定する
  $noindex_options = $exist_options ? $exist_options : array();
  //チェックボックス用の項目を設定
  $data = array("noindex", "nofollow");

  foreach ($data as $d) {
    $check = (in_array($d, $noindex_options)) ? "checked" : "";
    echo '<div><label><input type="checkbox" name="noindex_options[]" value="' . $d . '" ' . $check . '>' . $d . '</label></div>';
  } //end foreach
}

//1カラムオプション
function show_one_column_option()
{
  global $post;
  //カスタムフィールドの値を取得
  $meta_value = get_post_meta($post->ID, 'one_column_options', true);
  //チェックボックス用の項目を設定
  $data = "1カラムで表示";
  $check = ($meta_value) ? "checked" : "";
  echo '<div><label><input type="checkbox" name="one_column_options" value="' . $data . '" ' . $check . '>' . $data . '</label></div>';
}

//広告を非表示にする
function disable_ads()
{
  global $post;
  //カスタムフィールドの値を取得
  $meta_value = get_post_meta($post->ID, 'disable_ads', true);
  //チェックボックス用の項目を設定
  $data = "この記事では広告を非表示";
  $check = ($meta_value) ? "checked" : "";
  echo '<div><label><input type="checkbox" name="disable_ads" value="' . $data . '" ' . $check . '>' . $data . '</label></div>';
}

//値を保存
function save_sngmeta_field($post_id)
{
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  (isset($_POST['sng_meta_description'])) ? update_post_meta($post_id, 'sng_meta_description', $_POST['sng_meta_description']) : "";
  (isset($_POST['sng_title'])) ? update_post_meta($post_id, 'sng_title', $_POST['sng_title']) : "";

  $sng_fields = array('noindex_options', 'one_column_options', 'disable_ads');
  foreach ($sng_fields as $sng_field) {
    if (isset($_POST[$sng_field])) {
      $value = $_POST[$sng_field];
    } else {
      $value = '';
    }
    update_post_meta($post_id, $sng_field, $value);
  } //endforeach
}
