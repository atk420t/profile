<?php if ( is_front_page() ) : ?>
<?php if ( is_active_sidebar( 'home-top_mobile' ) && is_mobile() ) : ?>
<div class="home_widget top mobile cf"><?php dynamic_sidebar( 'home-top_mobile' ); ?></div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'home-top' ) && !is_mobile() ) : ?>
<div class="home_widget top cf"><?php dynamic_sidebar( 'home-top' ); ?></div>
<?php endif; ?>
<?php endif; ?>