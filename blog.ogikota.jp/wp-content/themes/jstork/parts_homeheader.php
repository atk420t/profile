<?php
	if ( is_front_page() && !is_paged() ) :
		if ( get_option( 'opencage_toppage_headeregtext' ) || get_option( 'opencage_toppage_headerjptext' ) ) : ?>

<div id="custom_header" class="<?php echo esc_html(get_option('opencage_toppage_textlayout')); ?>" style="color:<?php echo get_theme_mod('opencage_toppage_textcolor');?>; background-image: url(<?php if ( get_theme_mod('opencage_toppage_headerbgsp') && is_mobile()):?><?php echo get_theme_mod('opencage_toppage_headerbgsp');?><?php else:?><?php echo get_theme_mod('opencage_toppage_headerbg');?><?php endif;?>); background-position: center center; background-repeat:<?php echo get_option('opencage_toppage_headerbgrepeat');?>; background-size:<?php echo get_option('opencage_toppage_headerbgsize');?>;">
<script type="text/javascript">
jQuery(function( $ ) {
	$(window).load(function(){
	    $("#custom_header .wrap").css("opacity", "100");
	});
});
</script>

	<div class="wrap cf" style="opacity: 0;">
		<div class="header-text">
			<?php if ( get_option( 'opencage_toppage_headeregtext' )) : ?>
			<h2 class="en gf wow animated fadeInDown" data-wow-delay="0.5s"><?php echo get_option( 'opencage_toppage_headeregtext' ); ?></h2>
			<?php endif; ?>
			<?php if ( get_option( 'opencage_toppage_headerjptext' )) : ?>
			<p class="ja wow animated fadeInUp" data-wow-delay="0.8s"><?php echo get_option( 'opencage_toppage_headerjptext' ); ?></p>
			<?php endif; ?>
			<?php if ( get_option( 'opencage_toppage_headerlink' )) : ?>
			<div class="btn-wrap simple maru wow animated fadeInUp" data-wow-delay="1s"><a style="color:<?php echo get_theme_mod( 'opencage_toppage_btncolor' ); ?>;background:<?php echo get_theme_mod( 'opencage_toppage_btnbgcolor' ); ?>;" href="<?php echo esc_url(get_option( 'opencage_toppage_headerlink' )); ?>"><?php if ( get_option( 'opencage_toppage_headerlinktext' )) : ?><?php echo get_option( 'opencage_toppage_headerlinktext' ); ?><?php else:?>詳しくはこちら<?php endif;?></a></div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
	endif;
endif;
?>

<?php if ( is_front_page() || is_home() ) : ?>
<?php		  
$args = array(
    'posts_per_page' => 16,
    'offset' => 0,
    'tag' => 'pickup',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => array('post','page'),
    'post_status' => 'publish',
    'suppress_filters' => true,
    'ignore_sticky_posts' => true,
    'no_found_rows' => true
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	?>

<script type="text/javascript">
jQuery(function( $ ) {
	$('.slickcar').slick({
		centerMode: true,
		dots: true,
		autoplay: true,
		autoplaySpeed: 3000,
		speed: 260,
		centerPadding: '90px',
		slidesToShow: 4,
		responsive: [
		{
			breakpoint: 1160,
			settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '40px',
			slidesToShow: 4
		}
		},
		{
			breakpoint: 768,
			settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '40px',
			slidesToShow: 3
		}
		},
		{
			breakpoint: 480,
			settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '25px',
			slidesToShow: 1
		}
		}]
	});
	$(window).ready(function(){
	    $(".slickcar").css("opacity", "1.0");
	});
});
</script>

<div id="top_carousel" class="carouselwrap wrap cf">
<ul class="slider slickcar" style="opacity: 0;">

<?php while ( $the_query->have_posts() ) {
$the_query->the_post();
?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
<figure class="eyecatch<?php if ( !has_post_thumbnail()) : echo ' noimg'; endif; ?>">
<?php if ( has_post_thumbnail()) : ?>
<?php the_post_thumbnail('home-thum'); ?>
<?php else : ?>
<img src="<?php echo get_theme_file_uri('/library/images/noimg.png'); ?>">
<?php endif; ?>

<?php
	if(get_post_type() == 'post'):
	$cat = get_the_category();
	$cat = $cat[0];
	$catid = $cat->cat_ID;
	$catname = $cat->name;
	echo '<span class="osusume-label cat-name cat-id-' . $catid . '">' . $catname . '</span>';
	else:
	echo '<span class="osusume-label cat-name cat-id-page"></span>';
	endif;
?>
</figure>
<h2 class="h2 entry-title"><?php the_title(); ?></h2>
</a></li>
<?php } ; ?>
</ul>
</div>
<?php }
wp_reset_postdata();
?>
<?php endif; ?>