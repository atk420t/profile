<?php get_header(); ?>
  <div id="content"<?php column_class();?>>
    <div id="inner-content" class="wrap cf">
      <main id="main" class="m-all t-2of3 d-5of7 cf">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
           <article id="entry" <?php post_class('cf'); ?>>
              <header class="article-header entry-header">
                <?php if(is_front_page()) ://ホーム固定の場合 ?>
                  <h2 class="page-title"><?php the_title(); //タイトル ?></h2>
                <?php else ://通常の場合 ?>
                  <?php breadcrumb(); ?>
                  <h1 class="page-title"><?php the_title(); //タイトル ?></h1>
                <?php endif; ?>
                <?php if (has_post_thumbnail()): //アイキャッチ ?>
                  <p class="post-thumbnail"><?php the_post_thumbnail('thumb-940');?></p>
                <?php endif; ?>
              </header>
              <section class="entry-content cf">
                <?php
                  the_content();
                  wp_link_pages( array(
                    'before'      => '<div class="page-links dfont">',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                  ) );
                ?>
              </section>
              <footer class="article-footer">
                  <aside>
                    <div class="footer-contents">
                      <?php insert_social_buttons();?>
                    </div>
                  </aside>
               </footer>
               <?php insert_json_ld();//構造化データ ?>
               <?php comments_template();//コメント ?>
            </article>
        <?php endwhile; ?>
        <?php else : ?>
        <?php get_template_part('content', 'not-found'); ?>
        <?php endif; ?>
      </main>
      <?php get_sidebar(); ?>
    </div>
  </div>
<?php get_footer(); ?>
