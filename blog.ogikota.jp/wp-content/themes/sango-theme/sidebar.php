<?php if((is_singular() && wp_is_mobile() && get_option('no_sidebar_mobile')) //カスタマイザーでモバイルでは非表示に設定してるとき
    || (is_single() && get_post_meta( $post->ID, 'one_column_options', true ) )//記事ページで1カラム表示を選択してるとき
    || !is_active_sidebar( 'sidebar1' ) ) ://そもそもサイドバーがアクティブでは無いとき
    //サイドバーを表示しない
?>
<?php else: ?>
  <div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
    <aside>
      <div class="insidesp">
        <div id="notfix">
          <?php dynamic_sidebar( 'sidebar1' ); ?>
        </div>
        <?php if(is_singular() && !wp_is_mobile() && is_active_sidebar( 'fixed_sidebar' )) ://追尾のサイドバー ?>
          <div id="fixed_sidebar">
            <?php dynamic_sidebar( 'fixed_sidebar' ); ?>
          </div>
        <?php endif;?>
      </div>
    </aside>
  </div>
<?php endif; ?>