<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1 ,viewport-fit=cover"/>
  <meta name="msapplication-TileColor" content="<?php echo get_theme_mod( 'main_color', '#6bb6ff');?>">
  <meta name="theme-color" content="<?php echo get_theme_mod( 'main_color', '#6bb6ff');?>">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php wp_head(); //削除禁止 ?>
</head>
<body <?php body_class(); ?>>
  <div id="container">
    <header class="header<?php if(get_option('center_logo_checkbox')) echo ' header--center'; ?>">
    <?php if(wp_is_mobile() && is_active_sidebar( 'nav_drawer' )): //ナビドロワー ?>
      <div id="drawer">
        <input type="checkbox" id="drawer__input" class="drawer--unshown" >
        <label id="drawer__open" for="drawer__input"><?php fa_tag("bars","bars",false) ?></label>
        <label class="drawer--unshown" id="drawer__close-cover" for="drawer__input"></label>
        <div id="drawer__content">
          <div class="drawer__title dfont">MENU<label class="close" for="drawer__input"><span></span></label></div>
          <?php dynamic_sidebar('nav_drawer'); ?>
        </div>
      </div>
    <?php endif; //END ナビドロワー ?>
    <div id="inner-header" class="wrap cf">
      <?php $title_tag = (is_home() || is_front_page()) ? 'h1' : 'p'; //トップページのみタイトルをh1に ?>
      <<?php echo $title_tag; ?> id="logo" class="h1 dfont">
        <a href="<?php echo home_url(); ?>">
          <?php if(get_option('logo_image_upload')) : ?>
            <img src="<?php echo esc_url(get_option('logo_image_upload')); ?>" alt="<?php bloginfo('name'); ?>">
          <?php endif; ?>
          <?php if(!get_option('onlylogo_checkbox')) bloginfo('name'); ?>
        </a>
      </<?php echo $title_tag; ?>>
      <?php
        //PC用ヘッダーナビ
        if(has_nav_menu('desktop-nav')) {
          echo '<nav class="desktop-nav clearfix">';
          wp_nav_menu(array(
            'container' => false,
            'theme_location' => 'desktop-nav',
            'depth' => 2,
            'fallback_cb' => ''
          ));
          echo '</nav>';
        } //END PC用ヘッダーナビ
      ?>
    </div>
    <?php
      //モバイル用ナビ
      if(wp_is_mobile() && has_nav_menu('mobile-nav')) {
        echo '<nav class="mobile-nav">';
        wp_nav_menu(array(
          'container' => false,
          'theme_location' => 'mobile-nav',
          'depth' => 1,
          'fallback_cb' => ''
        ));
        echo '</nav>';
      } //END モバイル用ナビ
    ?>
  </header>
  <?php
    if(get_option('header_info_text')){
      //お知らせ欄
      echo '<div class="header-info"><a href="'.get_option('header_info_url').'">'.get_option('header_info_text').'</a></div>';
    }
  ?>