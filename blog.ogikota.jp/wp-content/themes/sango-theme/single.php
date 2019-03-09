<?php get_header(); ?>
  <div id="content"<?php column_class();?>>
    <div id="inner-content" class="wrap cf">
      <main id="main" class="m-all t-2of3 d-5of7 cf">
        <?php if (have_posts()) :
          while (have_posts()) :
          the_post();
        ?>
          <article id="entry" <?php post_class('cf'); ?>>
            <?php
              get_template_part('parts/single/entry-header');//タイトルまわり
              get_template_part('parts/single/entry-content');//本文まわり
              get_template_part('parts/single/entry-footer');//記事フッターまわり
              comments_template();//コメント
              insert_json_ld();//構造化データ
            ?>
            </article>
            <?php get_template_part('parts/single/prev-next-entry');//前後の記事へのリンク?>
          <?php endwhile; ?>
        <?php else : ?>
          <?php get_template_part('content', 'not-found'); //コンテンツが見つからない場合?>
        <?php endif; ?>
      </main>
      <?php get_sidebar();?>
    </div>
  </div>
<?php get_footer(); ?>
<?php //アクセス数をカウント：人気記事ウィジェットのため
  if( !is_bot() && !is_user_logged_in() ) {
    sng_set_post_views(get_the_ID());
  } ?>
