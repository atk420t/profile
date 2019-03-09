<?php
/*
Template Name:ランディングページ
*/
?>
<?php get_header(); ?>
<div class="lp-containar">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if ( has_post_thumbnail()) :?>
<figure class="eyecatch lp">
<?php the_post_thumbnail(); ?>
</figure>
<h1 class="page-title catchcopy" itemprop="headline"><?php the_title(); ?></h1>
<?php endif; ?>
<div id="content" class="lp-wrap">
<div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-all cf" role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
<?php if ( !has_post_thumbnail()) :?>
<header class="article-header">
<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
</header>
<?php endif; ?>
<section class="entry-content cf">
<?php the_content(); ?>
</section> <?php // end article section ?>
</article>
</main>
</div>
</div>
<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>