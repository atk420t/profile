<div id="page-top">
	<a href="#header" title="ページトップへ"><i class="fa fa-chevron-up"></i></a>
</div>


<?php
	if(!is_page_template( 'page-lp.php' ) && !is_singular( 'post_lp' )){
		if(get_option('side_options_pannavi', 'pannavi_on') == 'pannavi_on_bottom'){
			breadcrumb();
		}
	}
?>

<footer id="footer" class="footer wow animated fadeIn" role="contentinfo">
	<div id="inner-footer" class="inner wrap cf">

	<?php if(!is_page_template( 'page-lp.php' ) && !is_singular( 'post_lp' )): ?>

		<div id="footer-top" class="cf">
	
			<?php if ( is_mobile() && is_active_sidebar( 'footer-sp' )) : ?>
				<?php dynamic_sidebar( 'footer-sp' ); ?>
			<?php else:?>
				<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
				<div class="m-all t-1of2 d-1of3">
				<?php dynamic_sidebar( 'footer1' ); ?>
				</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
				<div class="m-all t-1of2 d-1of3">
				<?php dynamic_sidebar( 'footer2' ); ?>
				</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'footer3' ) ) : ?>
				<div class="m-all t-1of2 d-1of3">
				<?php dynamic_sidebar( 'footer3' ); ?>
				</div>
				<?php endif; ?>
			<?php endif; ?>

		</div>

		
	<?php endif; ?>

		<div id="footer-bottom">
			<?php if(has_nav_menu('footer-links')):?>
			<nav role="navigation">
				<?php wp_nav_menu(array(
				'container' => 'div',
				'container_class' => 'footer-links cf',
				'menu' => __( 'Footer Links' ),
				'menu_class' => 'footer-nav cf',
				'theme_location' => 'footer-links',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'depth' => 0,
				'fallback_cb' => ''
				)); ?>
			</nav>
			<?php endif;?>
			<p class="source-org copyright">&copy;Copyright<?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url( '/' )); ?>" rel="nofollow"><?php bloginfo( 'name' ); ?></a>.All Rights Reserved.</p>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>