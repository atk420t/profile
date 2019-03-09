<div id="content">

<?php
	global $wp_query;
	$postid = $wp_query->post->ID;
	$tai = get_post_meta($postid, 'singlepostlayout_radio', true);
?>

<?php if ($tai == 'バイラル風（1カラム）') : ?>

<?php if ( is_active_sidebar( 'addbanner-titletop' )) : ?>
<div class="wrap"><?php dynamic_sidebar( 'addbanner-titletop' ); ?></div>
<?php endif;?>

<header id="viral-header" class="article-header entry-header" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>)">
<div class="wrap cf">

<p class="byline entry-meta vcard cf">
<?php 
	if(is_singular('post')){

	$cat = get_the_category();
	$cat = $cat[0];
	$catid = $cat->cat_ID;
	$catname = $cat->name;
	echo '<span class="cat-name cat-id-' . $catid . '">' . $catname . '</span>';

	}
?>
<?php $post_options_date = get_option('post_options_date'); if ( $post_options_date !== "date_off" ) : ?>
<time class="date gf entry-date updated"<?php if ( get_the_date('Ymd') >= get_the_modified_date('Ymd') ) : ?>  datetime="<?php echo get_the_date('Y-m-d') ?>"<?php endif; ?>><?php echo get_the_date('Y.m.d'); ?></time>
<?php if ( get_the_date('Ymd') < get_the_modified_date('Ymd') ) : ?><time class="date gf entry-date undo updated" datetime="<?php echo get_the_modified_date( 'Y-m-d' ) ?>"><?php echo get_the_modified_date('Y.m.d') ?></time><?php endif; ?>
<?php endif; ?>
<span class="writer name author"><span class="fn"><?php the_author(); ?></span></span>
</p>
<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

</div>
</header>

<?php endif;?>

<div id="inner-content" class="wrap page-full<?php if ($tai == 'フルサイズ（1カラム）') : ?> wide<?php endif;?> cf">

<main id="main" class="m-all t-all d-all cf" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php if ( !get_option( 'sns_options_hide' ) && $tai == 'バイラル風（1カラム）' ) : ?>
<?php get_template_part( 'parts_sns_short' ); ?>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
<?php if ($tai == 'フルサイズ（1カラム）') : ?>
<?php dynamic_sidebar( 'addbanner-titletop' ); ?>
<header class="article-header entry-header">
<p class="byline entry-meta vcard cf">
<?php 
	if(is_singular('post')){

	$cat = get_the_category();
	$cat = $cat[0];
	$catid = $cat->cat_ID;
	$catname = $cat->name;
	echo '<span class="cat-name cat-id-' . $catid . '">' . $catname . '</span>';

	}
?>

<?php $post_options_date = get_option('post_options_date'); if ( $post_options_date !== "date_off" ) : ?>
<time class="date gf entry-date updated"<?php if ( get_the_date('Ymd') >= get_the_modified_date('Ymd') ) : ?>  datetime="<?php echo get_the_date('Y-m-d') ?>"<?php endif; ?>><?php echo get_the_date('Y.m.d'); ?></time>
<?php if ( get_the_date('Ymd') < get_the_modified_date('Ymd') ) : ?><time class="date gf entry-date undo updated" datetime="<?php echo get_the_modified_date( 'Y-m-d' ) ?>"><?php echo get_the_modified_date('Y.m.d') ?></time><?php endif; ?>
<?php endif; ?>

<span class="writer name author"><span class="fn"><?php the_author(); ?></span></span>
</p>

<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

<?php if ( has_post_thumbnail() && !get_option( 'post_options_eyecatch' ) ) :?>
<figure class="eyecatch">
<?php the_post_thumbnail(); ?>
</figure>
<?php endif; ?>
<?php if ( !get_option( 'sns_options_hide' ) ) : ?>
<?php get_template_part( 'parts_sns_short' ); ?>
<?php endif; ?>
</header>
<?php endif;?>

<?php if ( is_active_sidebar( 'addbanner-sp-titleunder' ) ) : ?>
<?php if ( wp_is_mobile() ) : ?>
<div class="add titleunder">
<?php dynamic_sidebar( 'addbanner-sp-titleunder' ); ?>
</div>
<?php endif; ?>
<?php endif; ?>

<section class="entry-content cf">

<?php if ( is_active_sidebar( 'addbanner-pc-titleunder' ) && !wp_is_mobile()) : ?>
<div class="add titleunder">
<?php dynamic_sidebar( 'addbanner-pc-titleunder' ); ?>
</div>
<?php endif; ?>

<?php the_content();
wp_link_pages( array(
'before'      => '<div class="page-links cf"><ul>',
'after'       => '</ul></div>',
'link_before' => '<li><span>',
'link_after'  => '</span></li>',
'nextpagelink'     => __('Next page'),
'previouspagelink' => __('Previous page'),
) );    
?>

<?php if ( is_active_sidebar( 'addbanner-pc-contentfoot' ) && !wp_is_mobile() ) : ?>
<div class="add">
<?php dynamic_sidebar( 'addbanner-pc-contentfoot' ); ?>
</div>
<?php endif; ?>

</section>

<?php if ( is_active_sidebar( 'addbanner-sp-contentfoot' ) && wp_is_mobile() ) : ?>
<div class="add">
<?php dynamic_sidebar( 'addbanner-sp-contentfoot' ); ?>
</div>
<?php endif; ?>

<?php if(is_singular('post')):?>
<footer class="article-footer">
<?php echo get_the_category_list(); ?>
<?php the_tags( '<p class="tags">', '', '</p>' ); ?>
</footer>
<?php endif; ?>

<?php if ( get_option( 'fbbox_options_url' ) ) : ?>
<div class="fb-likebtn wow animated fadeIn cf" data-wow-delay="0.5s">
<?php $fburl = get_option( 'fbbox_options_url' );?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4&appId=271985329478941";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<figure class="eyecatch">
<?php if ( has_post_thumbnail() ): ?>
<?php the_post_thumbnail('home-thum'); ?>
<?php else: ?>
<img src="<?php echo get_theme_file_uri('/library/images/noimg.png'); ?>">
<?php endif; ?>
</figure>
<div class="rightbox"><div class="fb-like fb-button" data-href="<?php echo $fburl;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div><div class="like_text"><p>この記事が気に入ったら<br><i class="fa fa-thumbs-up"></i> いいねしよう！</p>
<?php if( !is_mobile() ): ?><p class="small">最新記事をお届けします。</p><?php endif; ?></div></div></div>
<?php endif; ?>

<?php if ( !get_option( 'sns_options_hide' ) ) : ?>
<div class="sharewrap wow animated fadeIn" data-wow-delay="0.5s">
<?php if ( get_option( 'sns_options_text' ) ) : ?>
<h3><?php echo get_option( 'sns_options_text' ); ?></h3>
<?php endif; ?>
<?php get_template_part( 'parts_sns' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'cta' ) ) : ?>
<div class="cta-wrap wow animated fadeIn" data-wow-delay="0.7s">
<?php dynamic_sidebar( 'cta' ); ?>
</div>
<?php endif; ?>

<?php comments_template(); ?>

</article>

<?php get_template_part( 'parts_singlefoot' ); ?>

<?php endwhile; ?>
<?php endif; ?>
</main>

</div>
</div>
