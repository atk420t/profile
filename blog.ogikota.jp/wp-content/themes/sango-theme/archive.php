<?php get_header(); ?>
  <div id="content">
    <div id="inner-content" class="wrap cf">
      <main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
        <?php 
          get_template_part('parts/archive/archive-header');//ヘッダー
          get_template_part('parts/post-grid');//記事一覧
        ?>
      </main>
      <?php get_sidebar(); ?>
    </div>
  </div>
<?php get_footer(); ?>