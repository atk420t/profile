<?php
/*
Plugin Name: Rinker
Plugin URI: https://oyakosodate.com/rinker/
Description: 商品リンクの管理を楽にするプラグイン『Rinker』1.4.4です
Author: yayoi
Version: 1.4.4
Author URI: https://oyakosodate.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'YYIRINKER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( YYIRINKER_PLUGIN_DIR . 'yyi_rinker_main.php' );

if ( function_exists( 'add_action' ) && class_exists( 'Yyi_Rinker_Plugin' ) ) {
	add_action( 'plugins_loaded', array( 'Yyi_Rinker_Plugin', 'get_object' ) );
}


require 'plugin-updates/plugin-update-checker.php';
$ExampleUpdateChecker = PucFactory::buildUpdateChecker(
	'https://oyakosodate.com/rinker-plugin/update.json',
	__FILE__,
	'yyi-rinker'
);



