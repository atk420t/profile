<?php if ( is_front_page() ) : ?>
<?php if ( is_active_sidebar( 'home-bottom_mobile' ) && is_mobile() ) : ?>
<div class="home_widget bottom mobile cf"><?php dynamic_sidebar( 'home-bottom_mobile' ); ?></div>
<?php endif; ?>
<?php if ( is_active_sidebar( 'home-bottom' ) && !is_mobile() ) : ?>
<div class="home_widget bottom cf"><?php dynamic_sidebar( 'home-bottom' ); ?></div>
<?php endif; ?>
<?php endif; ?>