<?php //検索結果のテンプレートです
  get_header(); 
?>
  <div id="content">
    <div id="inner-content" class="wrap cf">
      <h1 class="search-title"><?php fa_tag("search","search",false) ?>「<?php echo esc_attr(get_search_query()); ?>」の検索結果</h1>
      <main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
        <?php get_template_part('parts/post-grid');//記事一覧?>
      </main>
      <?php get_sidebar(); ?>
    </div>
  </div>
<?php get_footer(); ?>
