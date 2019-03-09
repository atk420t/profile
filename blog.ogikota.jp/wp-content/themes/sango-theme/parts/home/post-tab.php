<?php
  //タブ切り替え
  //タブタイトル
  $tab1name = get_option('tab1name');
  $tab2name = get_option('tab2name');
  $tab3name = get_option('tab3name');
  $tab4name = get_option('tab4name');
  //タグIDで指定するか
  $is_tab2tag = (get_theme_mod('tab2cat_or_tag') == 'tag_chosen') ? 'tag' : null;
  $is_tab3tag = (get_theme_mod('tab3cat_or_tag') == 'tag_chosen') ? 'tag' : null;
  $is_tab4tag = (get_theme_mod('tab4cat_or_tag') == 'tag_chosen') ? 'tag' : null;
  //指定ID
  $tab2id = get_option('tab2id');
  $tab3id = get_option('tab3id');
  $tab4id = get_option('tab4id');
  //「もっと見る」のリンク先
  $tab2link = get_option('tab2link');
  $tab3link = get_option('tab3link');
  $tab4link = get_option('tab4link');
  //表示数
  $tab_cat_num = get_option('tab_cat_num');
?>
<!--タブ-->
<div class="post-tab cf">
  <?php if($tab1name): ?>
    <div class="tab1 tab-active">
      <?php echo $tab1name; ?>
    </div>
  <?php endif; ?>
  <?php if($tab2name): ?>
    <div class="tab2<?php if(!$tab1name) echo ' tab-active'; ?>">
      <?php echo $tab2name; ?>
    </div>
  <?php endif; ?>
  <?php if($tab3name): ?>
    <div class="tab3"<?php if(!$tab1name) echo 'style="border-top:none;"'; ?>>
      <?php echo $tab3name; ?>
    </div>
  <?php endif; ?>
  <?php if($tab4name): ?>
    <div class="tab4">
      <?php echo $tab4name; ?>
    </div>
  <?php endif; ?>
</div>
<!--タブの中身-->
<?php if($tab1name) : ?>
  <div class="post-tab__content tab1 tab-active">
    <?php get_template_part('parts/post-grid'); //新着記事一覧 ?>
  </div>
<?php endif; ?>
<?php
  //tab2〜tab4を出力
  $i = 2;
  while($i < 5) {
    if( "${'is_tab'.$i.'tag'}") {
      //タグIDで一覧を取得
      $posts = get_posts(array(
        'posts_per_page' => $tab_cat_num,
        'tag__in' => "${'tab'.$i.'id'}" 
      ));
    } else {
      //カテゴリーIDで一覧を取得
      $posts = get_posts(array(
        'posts_per_page' => $tab_cat_num,
        'category' => "${'tab'.$i.'id'}"
      ));
    }
    if($posts):
      //新着記事を表示しないときは、タブ2をアクティブに
      $tab_active = ( (!$tab1name) && ($i==2) ) ? ' tab-active' : null;
      echo '<div class="post-tab__content tab'.$i.$tab_active.'">';
      if(is_sidelong()) { 
        //(1)横長の場合
        echo '<div class="sidelong cf">';
      } else {
        //(2)通常のカード
        echo '<div class="cardtype cf">';
      }
      foreach($posts as $post):
        setup_postdata($post);
        /*カードの出力*/
        if(is_sidelong()) {
          //(1)横長の場合
          sng_sidelong_card();
        } else {
          //(2)通常のカード
          sng_normal_card();
        }
      endforeach;
      echo '</div>';
      if(${'tab'.$i.'link'}) :
?>
  <div class="post-tab__more ct">
    <a class="raised main-bc strong" href="<?php echo "${'tab'.$i.'link'}"; ?>"><?php fa_tag("caret-right","caret-right",false) ?> <span>もっと見る</span></a>
  </div>
<?php endif; ?>
<?php
  echo '</div>';
  endif;
  wp_reset_postdata();
  $i++;
}/*end while*/
?>
