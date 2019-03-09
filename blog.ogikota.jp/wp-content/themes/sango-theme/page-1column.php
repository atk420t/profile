<?php
/**
* Template Name: 1カラム表示（サイドバー無し）
* Template Post Type: page
*/
get_header();
?>
<div id="content" class="one-column">
  <div id="inner-content" class="wrap cf">
    <main id="main" class="m-all cf">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article id="entry" <?php post_class('cf'); ?>>
            <header class="article-header entry-header">
              <?php breadcrumb(); //パンくず ?>
                <h1 class="page-title"><?php the_title(); //タイトル ?></h1>
                <?php if (has_post_thumbnail()): ?>
                  <p class="post-thumbnail">
                    <?php the_post_thumbnail('thumb-940');?>
                  </p>
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
          <?php insert_json_ld(); //構造化データ ?>
          <?php comments_template(); //コメント ?>
          </article>
        <?php endwhile; ?>
      <?php else : ?>
        <?php get_template_part('content', 'not-found'); ?>
      <?php endif; ?>
    </main>
  </div>
</div>
<?php get_footer(); ?>
