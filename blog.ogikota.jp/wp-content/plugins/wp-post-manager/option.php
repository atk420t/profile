<?php
if (isset($_POST['posted']) && $_POST['posted'] == 'yes') {
  check_admin_referer('wp-p-m-nonce-key');
  for($i=1;$i<3;$i++){
    if (isset($_POST['wp-p-m-'.$i]) && $_POST['wp-p-m-'.$i] == '1') {
      update_option('wp-p-m-'.$i, intval($_POST['wp-p-m-'.$i]));
    }else{
      update_option('wp-p-m-'.$i,'');
    }
  }
  update_option('wp-p-m-3',stripslashes($_POST['wp-p-m-3']));
  update_option('wp-p-m-4',stripslashes($_POST['wp-p-m-4']));
  update_option('wp-p-m-9',stripslashes($_POST['wp-p-m-9']));
  for($i=5;$i<8;$i++){
    if (isset($_POST['wp-p-m-'.$i]) && $_POST['wp-p-m-'.$i] == '1') {
      update_option('wp-p-m-'.$i, intval($_POST['wp-p-m-'.$i]));
    }else{
      update_option('wp-p-m-'.$i,'');
    }
  }
  update_option('wp-p-m-8', wp_unslash($_POST['wp-p-m-8']));
  if (isset($_POST['wp-p-m-10']) && $_POST['wp-p-m-10'] == '1') {
    update_option('wp-p-m-10', intval($_POST['wp-p-m-10']));
  }else{
    update_option('wp-p-m-10','');
  }
}
$wppm1 = get_option('wp-p-m-1');
$wppm2 = get_option('wp-p-m-2');
$wppm3 = get_option('wp-p-m-3');
$wppm4 = get_option('wp-p-m-4');
$wppm5 = get_option('wp-p-m-5');
$wppm6 = get_option('wp-p-m-6');
$wppm7 = get_option('wp-p-m-7');
$wppm8 = get_option('wp-p-m-8');
$wppm9 = get_option('wp-p-m-9');
$wppm10 = get_option('wp-p-m-10');
?>
<h1>WP Post Manager　設定</h1>
<form method="post" action="">
  <?php wp_nonce_field('wp-p-m-nonce-key'); ?>
  <div class="set-box">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="wp-p-m-5" value="1" <?php if($wppm5 =="1"){ echo 'checked="checked"'; } ?>>
        　固定ページを表示する
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="wp-p-m-6" value="1" <?php if($wppm6 =="1"){ echo 'checked="checked"'; } ?>>
        　下書きを表示する
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="wp-p-m-7" value="1" <?php if($wppm7 =="1"){ echo 'checked="checked"'; } ?>>
        　投稿のタグを表示する
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="wp-p-m-1" value="1" <?php if($wppm1 =="1"){ echo 'checked="checked"'; } ?>>
        　見出し(H2、H3、H4)を表示する
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="wp-p-m-2" value="1" <?php if($wppm2 =="1"){ echo 'checked="checked"'; } ?>>
        　SNSシェア数を表示する（読み込みが遅くなります）
      </label>
    </div>
    <div class="checkbox post-all">
      <label>内部リンク数と外部リンク数</label>
      <select name="wp-p-m-3">
        <option value="1" <?php if($wppm3 =="1"){ echo 'selected'; } ?>>表示しない</option>
        <option value="2" <?php if($wppm3 =="2"){ echo 'selected'; } ?>>記事内のみを判定して表示する</option>
        <option value="3" <?php if($wppm3 =="3"){ echo 'selected'; } ?>>ページ全体を判定して表示する（読み込みが遅くなります）</option>
      </select>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="wp-p-m-10" value="1" <?php if($wppm10 =="1"){ echo 'checked="checked"'; } ?>>
        　内部リンクと外部リンクのアンカーテキストを表示する
      </label>
    </div>
    <div class="checkbox post-all">
      <label>テーブルのソートルール</label>
      <select name="wp-p-m-4">
        <option value="1" <?php if($wppm4 =="1"){ echo 'selected'; } ?>>記事投稿日が新しい順</option>
        <option value="2" <?php if($wppm4 =="2"){ echo 'selected'; } ?>>記事投稿日が古い順</option>
        <option value="3" <?php if($wppm4 =="3"){ echo 'selected'; } ?>>記事更新日が新しい順</option>
        <option value="4" <?php if($wppm4 =="4"){ echo 'selected'; } ?>>記事更新日が古い順</option>
        <option value="5" <?php if($wppm4 =="5"){ echo 'selected'; } ?>>著者で並び替える</option>
      </select>
    </div>
    <div class="textkbox">
      <label>
        取得件数
        <input type="text" name="wp-p-m-8" id="wp-p-m-8" value="<?php if($wppm8){ echo $wppm8; } ?>">
        ※"-1"で全件取得、空で10件取得します
      </label>
    </div>
    <div class="checkbox post-all">
      <label>カテゴリの絞り込み</label>
      <select name="wp-p-m-9">
        <option value="0" <?php if($wppm9 =="0"){ echo 'selected'; } ?>>カテゴリを絞らない</option>
        <?php $cats = get_categories(); ?>
        <?php foreach($cats as $cat) : ?>
          <option value="<?php echo $cat->term_id; ?>" <?php if($wppm9 == $cat->term_id){ echo 'selected'; } ?>>
            <?php echo $cat->name; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="save-box">
    <p>
      <input type="hidden" name="posted" value="yes" />
      <input type="submit" value="保存" class="button button-primary button-large">
    </p>
  </div>
</form>