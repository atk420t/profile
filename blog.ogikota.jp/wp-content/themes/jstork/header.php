<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title(''); ?></title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1"/>

<?php if ( get_theme_mod( 'opencage_appleicon' ) ) : ?><link rel="apple-touch-icon" href="<?php echo get_theme_mod( 'opencage_appleicon' ); ?>"><?php endif; ?>
<?php if ( get_theme_mod( 'opencage_favicon' ) ) : ?><link rel="icon" href="<?php echo get_theme_mod( 'opencage_favicon' ); ?>"><?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!--[if IE]>
<?php if ( get_theme_mod( 'opencage_favicon_ie' ) ) : ?><link rel="shortcut icon" href="<?php echo get_theme_mod( 'opencage_favicon_ie' ); ?>"><?php endif; ?>
<![endif]-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<?php get_template_part( 'head' ); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="container">
<?php if(!is_page_template( 'page-lp.php' ) && !is_singular( 'post_lp' )): ?>

<?php if ( get_option( 'side_options_description' ) ) : ?><p class="site_description"><?php bloginfo('description'); ?></p><?php endif; ?>
<header class="header animated fadeIn <?php if ( wp_is_mobile() ) : ?>headercenter<?php else:?><?php echo get_option( 'side_options_headercenter' ); ?><?php endif; ?>" role="banner">
<div id="inner-header" class="wrap cf">
<div id="logo" class="gf <?php echo esc_html(get_option('opencage_logo_size'));?>">
<?php if ( is_home() || is_front_page() ) : ?>
<?php if ( get_theme_mod( 'opencage_logo' ) ) : ?>
<h1 class="h1 img"><a href="<?php echo esc_url(home_url()); ?>" rel="nofollow"><img src="<?php echo get_theme_mod( 'opencage_logo' ); ?>" alt="<?php bloginfo('name'); ?>"></a></h1>
<?php else : ?>
<h1 class="h1 text"><a href="<?php echo esc_url(home_url()); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>
<?php endif; ?>
<?php else: ?>
<?php if ( get_theme_mod( 'opencage_logo' ) ) : ?>
<p class="h1 img"><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo get_theme_mod( 'opencage_logo' ); ?>" alt="<?php bloginfo('name'); ?>"></a></p>
<?php else : ?>
<p class="h1 text"><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a></p>
<?php endif; ?>
<?php endif; ?>
</div>

<?php if(!get_option('side_options_header_search')):?>
<a href="#searchbox" data-remodal-target="searchbox" class="nav_btn search_btn"><span class="text gf">search</span></a>
<?php endif;?>

<?php if (!is_mobile() && has_nav_menu('main-nav')):?>
<nav id="g_nav" role="navigation">
<?php wp_nav_menu(array(
     'container' => false,
     'container_class' => 'menu cf',
     'menu' => __( 'グローバルナビ' ),
     'menu_class' => 'nav top-nav cf',
     'theme_location' => 'main-nav',
     'before' => '',
     'after' => '',
     'link_before' => '',
     'link_after' => '',
     'depth' => 0,
     'fallback_cb' => ''
)); ?>
</nav>
<?php endif;?>

<?php if (is_active_sidebar('sidebar-sp') || has_nav_menu('main-nav')) :?>
<a href="#spnavi" data-remodal-target="spnavi" class="nav_btn"><span class="text gf">menu</span></a>
<?php endif;?>

<?php if(is_mobile() && has_nav_menu('main-nav-sp')):?>
<div class="g_nav-sp animated fadeIn">
<?php wp_nav_menu(array(
     'container' => 'nav',
     'container_class' => 'menu-sp cf',
     'menu' => __( 'グローバルナビ（スマートフォン）' ),
     'menu_class' => 'top-nav',
     'theme_location' => 'main-nav-sp',
     'before' => '',
     'after' => '',
     'link_before' => '',
     'link_after' => '',
     'depth' => 0,
     'fallback_cb' => ''
)); ?>
</div>
<?php endif;?>


</div>
</header>

<?php if (is_active_sidebar('sidebar-sp')):?>
<div class="remodal" data-remodal-id="spnavi" data-remodal-options="hashTracking:false">
<button data-remodal-action="close" class="remodal-close"><span class="text gf">CLOSE</span></button>
<?php dynamic_sidebar( 'sidebar-sp' ); ?>
<button data-remodal-action="close" class="remodal-close"><span class="text gf">CLOSE</span></button>
</div>

<?php else:?>

<div class="remodal" data-remodal-id="spnavi" data-remodal-options="hashTracking:false">
<button data-remodal-action="close" class="remodal-close"><span class="text gf">CLOSE</span></button>
<?php wp_nav_menu(array(
     'container' => false,
     'container_class' => 'sp_g_nav menu cf',
     'menu' => __( 'グローバルナビ' ),
     'menu_class' => 'sp_g_nav nav top-nav cf',
     'theme_location' => 'main-nav',
     'before' => '',
     'after' => '',
     'link_before' => '',
     'link_after' => '',
     'depth' => 0,
     'fallback_cb' => ''
)); ?>
<button data-remodal-action="close" class="remodal-close"><span class="text gf">CLOSE</span></button>
</div>

<?php endif; ?>



<?php if(!get_option('side_options_header_search')):?>
<div class="remodal searchbox" data-remodal-id="searchbox" data-remodal-options="hashTracking:false">
<div class="search cf"><dl><dt>キーワードで記事を検索</dt><dd><?php get_search_form(); ?></dd></dl></div>
<button data-remodal-action="close" class="remodal-close"><span class="text gf">CLOSE</span></button>
</div>
<?php endif;?>


<?php if ( get_option('other_options_headerunderlink') && get_option('other_options_headerundertext') ) : ?>
<div class="header-info"><a<?php if(get_option('other_options_headerunderlink_target')):?> target="_blank"<?php endif;?>  style="background-color: <?php echo get_theme_mod( 'other_options_headerunderlink_bgcolor'); ?>;" href="<?php echo esc_html(get_option('other_options_headerunderlink'));?>"><?php echo esc_html(get_option('other_options_headerundertext'));?></a></div>
<?php endif;?>


<?php get_template_part( 'parts_homeheader' ); ?>

<?php
	if(get_option('side_options_pannavi', 'pannavi_on') == 'pannavi_on' || !get_option('side_options_pannavi')){
		breadcrumb();
	}
?>
<?php endif; ?>