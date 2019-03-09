<?php
/*
Plugin Name:WP Post Manager
Description:WP Post Managerは投稿した記事、固定ページのパフォーマンスを確認したりサジェストキーワードの取得や記事中のキーワード検索などの機能を持っています。
Version:1.0.1
Author:Fwww ⚡️ふうや
Author URI:https://fwww.me
License: GPL2
*/

/*  Copyright 2017 Fwww (email : huuya1234fwww@gmail.com)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
     published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function wp_post_manager_admin() {
  add_menu_page(
    'WP Post Manager',
    'WP Post Manager',
    'administrator',
    'post_manager',
    'wp_post_manager',
    'dashicons-list-view'
  );
  add_submenu_page(
    'post_manager', 
    'キーワード検索',
    'キーワード検索',
    'administrator',
    'post_manager_keyword_search',
    'wp_post_manager_keyword_search'
  );
  add_submenu_page(
    'post_manager', 
    'キーワード取得',
    'キーワード取得',
    'administrator',
    'post_manager_keyword_get',
    'wp_post_manager_keyword_get'
  );
  add_submenu_page(
    'post_manager', 
    '設定',
    '設定',
    'administrator',
    'post_manager_option',
    'wp_post_manager_option'
  );
}
add_action('admin_menu','wp_post_manager_admin');

define('WP_POST_MANAGER_PLUGIN_DIR',plugin_dir_path(__FILE__));

function wp_post_manager(){
   include(WP_POST_MANAGER_PLUGIN_DIR.'index.php');
}

function wp_post_manager_asp(){
   include(WP_POST_MANAGER_PLUGIN_DIR.'asp.php');
}

function wp_post_manager_keyword_search(){
   include(WP_POST_MANAGER_PLUGIN_DIR.'keyword-search.php');
}

function wp_post_manager_keyword_get(){
   include(WP_POST_MANAGER_PLUGIN_DIR.'keyword-get.php');
}

function wp_post_manager_option(){
   include(WP_POST_MANAGER_PLUGIN_DIR.'option.php');
}

function wppm_activation_hook(){
  update_option('wp-p-m-1',1);
  update_option('wp-p-m-2',0);
  update_option('wp-p-m-3',1);
  update_option('wp-p-m-4',1);
  update_option('wp-p-m-5',1);
  update_option('wp-p-m-6',0);
  update_option('wp-p-m-7',0);
  update_option('wp-p-m-8',20);
  update_option('wp-p-m-9',0);
  update_option('wp-p-m-10',0);
}
register_activation_hook(__FILE__,'wppm_activation_hook');

function scraping($s_url){
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL,$s_url);
  curl_setopt( $ch, CURLOPT_HEADER, false );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_TIMEOUT, 120 );
  $s_html = curl_exec( $ch );
  curl_close( $ch );
  return $s_html;
}

function multi_curl_execute($urlList, $timeout = 200){
  if (empty($urlList)) {
    return false;
  }
  $chList = [];
  foreach($urlList as $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $chList[] = $ch;
  }
  if (empty($chList)) {
    return false;
  }
  $mh = curl_multi_init();
  foreach($chList as $ch) {
    curl_multi_add_handle($mh,$ch);
  }
  $running=null;
  do {
    curl_multi_exec($mh, $running);
    usleep(1000);
  } while ($running > 0);
  $returnList = [];
  foreach($chList as $key => $ch) {
    $returnText = curl_multi_getcontent($ch);
    $returnList[] = $returnText;
  }
  foreach($chList as $ch) {
    curl_multi_remove_handle($mh, $ch);
  }
  curl_multi_close($mh);
  return $returnList;
}

function search_keyword(){
  check_ajax_referer('search_keyword_ajax','secure');
  if(isset($_REQUEST['keyword'])){
    $keyword = $_REQUEST['keyword'];
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => -1
    );
    $query = new WP_Query($args);
    if($query->have_posts()){
      echo '<h2>'.$keyword.'を含むページの検索結果</h2>';
      echo '<div class="match-box-out">';
      $index = 0;
      while($query->have_posts()){
        $query->the_post();
        $content = get_the_content();
        if(strstr($content,$keyword)){
          preg_match_all("/<h1.*?>(.*?)<\/h1>/u", $content,$h1matches);
          preg_match_all("/<h2.*?>(.*?)<\/h2>/u", $content,$h2matches);
          preg_match_all("/<h3.*?>(.*?)<\/h3>/u", $content,$h3matches);
          preg_match_all("/<h4.*?>(.*?)<\/h4>/u", $content,$h4matches);
          preg_match_all("/<h5.*?>(.*?)<\/h5>/u", $content,$h5matches);
          preg_match_all("/<h6.*?>(.*?)<\/h6>/u", $content,$h6matches);
          $h1_count = 0;
          for($i = 0;$i < count($h1matches[1]);$i++){
            if(strstr($h1matches[1][$i],$keyword)){
              $h1_count++;
            }
          }
          if(strstr(get_the_title(),$keyword)){
            $h1_count++;
          }
          $h2_count = 0;
          for($i = 0;$i < count($h2matches[1]);$i++){
            if(strstr($h2matches[1][$i],$keyword)){
              $h2_count++;
            }
          }
          $h3_count = 0;
          for($i = 0;$i < count($h3matches[1]);$i++){
            if(strstr($h3matches[1][$i],$keyword)){
              $h3_count++;
            }
          }
          $h4_count = 0;
          for($i = 0;$i < count($h4matches[1]);$i++){
            if(strstr($h4matches[1][$i],$keyword)){
              $h4_count++;
            }
          }
          $h5_count = 0;
          for($i = 0;$i < count($h5matches[1]);$i++){
            if(strstr($h5matches[1][$i],$keyword)){
              $h5_count++;
            }
          }
          $h6_count = 0;
          for($i = 0;$i < count($h6matches[1]);$i++){
            if(strstr($h6matches[1][$i],$keyword)){
              $h6_count++;
            }
          }
          $index++;
          $all_count = substr_count($content, $keyword);
          $other_count = $all_count - $h1_count - $h2_count - $h3_count - $h4_count - $h5_count - $h6_count;
          if($all_count > 0){
            echo '<div class="match-box">';
            echo '<a href="'.get_the_permalink().'" target="_blank"><h3>'.get_the_title().'</h3></a>';
            echo '<h5>'.get_the_time('Y年n月j日').'</h5>';
            if($h1_count > 0){
              echo "<h4>見出し1に".$h1_count."個含まれています</h4>";
            }
            if($h2_count > 0){
              echo "<h4>見出し2に".$h2_count."個含まれています</h4>";
            }
            if($h3_count > 0){
              echo "<h4>見出し3に".$h3_count."個含まれています</h4>";
            }
            if($h4_count > 0){
              echo "<h4>見出し4に".$h4_count."個含まれています</h4>";
            }
            if($h5_count > 0){
              echo "<h4>見出し5に".$h5_count."個含まれています</h4>";
            }
            if($h6_count > 0){
              echo "<h4>見出し6に".$h6_count."個含まれています</h4>";
            }
            if($other_count > 0){
              echo "<h4>見出し以外に".$other_count."個含まれています</h4>";
            }
            echo '<a class="edit-button" href="'.get_edit_post_link().'" target="_blank"><button class="button button-primary button-large">編集</button></a>';
            echo "</div>";
          }
        }
      }
      wp_reset_postdata();
      echo "</div>";
      die();
    }else{
      echo "<h2>ページはありませんでした</h2>";
      die();
    }
  }
}
add_action('wp_ajax_search_keyword','search_keyword');

function keyword_get_tool(){
  check_ajax_referer('keyword_get_ajax','secure');
  if(isset($_REQUEST['keyword'])){
    $keyword = htmlspecialchars(strip_tags($_REQUEST['keyword']));
    $php_version = phpversion();
    if ($php_version < 5.5) {
      require_once(WP_POST_MANAGER_PLUGIN_DIR.'lib/goutte.phar');
    }else{
      require_once(WP_POST_MANAGER_PLUGIN_DIR.'lib/vendor/autoload.php');
    }
    $client = new \Goutte\Client();
    $crawler = $client->request('GET',"https://goodkeyword.net/");
    $form = $crawler->filter('form')->first()->form();
    $form['formquery'] = $keyword;
    $crawler = $client->submit($form);
    $crawler->html();
    $crawler->filter('#column3-result-copy-g textarea')->each(function ($node){
      echo $node->html() . "\n";
    });
  }
  die();
}
add_action('wp_ajax_keyword_get_tool','keyword_get_tool');

require 'plugin-update-checker/plugin-update-checker.php';
$wp_rankinger_pro_update_checker = Puc_v4_Factory::buildUpdateChecker(
  'https://fwww.me/json/wp-post-manager.json',
  __FILE__,
  'wp-post-manager'
);