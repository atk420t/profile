<?php
/**
* Template Name: トップページ用 1カラム（タイトルなど出力無し）
* Template Post Type: page
*/
get_header(); ?>
<style>
#container { background: #FFF; }
@media only screen and (min-width: 1030px) {
  .maximg { max-width: 1182px; }
}
</style>
  <div class="bg-white">
    <?php if(is_home() || is_front_page()) {get_template_part('parts/home/featured-header');} ?>
  </div>
  <div id="content" class="page-forfront">
    <div id="inner-content" class="wrap cf">
      <main id="main">
        <div class="entry-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php
            the_content();
          ?>
        <?php endwhile; ?>
        <?php else : ?>
          <?php get_template_part('content', 'not-found'); ?>
        <?php endif; ?>
        </div>
      </main>
    </div>
  </div>
<?php get_footer(); ?>
