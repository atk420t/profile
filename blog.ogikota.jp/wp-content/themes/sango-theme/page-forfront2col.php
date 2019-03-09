<?php
/**
* Template Name: トップページ用 サイドバー有（タイトルなど出力無し）
* Template Post Type: page
*/
get_header(); ?>
<style>
#divheader.maximg {
  margin: 0;
}
.entry-content {
  padding-top: 30px;
}
@media only screen and (min-width: 768px) {
  #divheader.maximg,.maximg {
    width: 96%;
    margin: 1.5em auto;
  }
}
@media only screen and (min-width: 1030px) {
  #divheader.maximg,.maximg {
    width: 92%;
    max-width: 1180px;
  }
}
@media only screen and (min-width: 1240px) {
  #divheader.maximg,.maximg {
    width: 1180px;
    max-width: none;
  }
}
</style>
<?php if ( is_home() || is_front_page() ) : ?>
  <?php get_template_part('parts/home/featured-header'); ?>
<?php endif; ?>
  <div id="content"<?php column_class();?>>
    <div id="inner-content" class="wrap cf">
      <main id="main" class="m-all t-2of3 d-5of7 cf">
        <?php
        if (have_posts()) :
          while (have_posts()) :
            the_post(); ?>
            <article id="entry" <?php post_class('cf'); ?>>
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
