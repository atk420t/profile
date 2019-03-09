<?php
/*
Plugin Name:All ShortCode of SANGO
Description:SANGOのすべてのショートコードを視覚的にビジュアルエディタに挿入できるプラグインです。
Version:1.0.5
Author:Fwww ⚡️ふうや
Author URI:https://twitter.com/fwww0707
License: GPL2
*/

/*  Copyright 2018 Fwww ⚡️ふうや (email : huuya1234fwww@gmail.com)
 
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

$theme_name_slug = wp_get_theme(get_template())->Name;
if($theme_name_slug == "SANGO"){
define('ALL_SHORTCODE_OF_SANGO',plugin_dir_path(__FILE__));

function sango_editor_button(){
    echo '<button type="button" id="insert-sango-shortcode" class="button">SANGOショートコード</button>';
}
add_action('media_buttons','sango_editor_button');

function sango_editor_style() {
    wp_register_style('sng-fontawesome',get_template_directory_uri().'/library/fontawesome/css/font-awesome.min.css',array(),'','all');
    wp_enqueue_style('sng-fontawesome');
    wp_enqueue_style( 
        'sango_short_code_style',
        get_template_directory_uri()."/entry-option.css"
    );
    wp_enqueue_style( 
        'sango_editor_style',
        plugins_url('assets/css/style.css', __FILE__ )."?ver".time()
    );
}
add_action('admin_print_styles','sango_editor_style');

function sango_editor_script(){
    wp_enqueue_media();
    wp_enqueue_script(
        'sango_editor_script',
        plugins_url('assets/js/script.js', __FILE__ )."?ver".time()
    );
}
add_action('admin_print_scripts','sango_editor_script');

function sango_modal_footer() {
    require_once(ALL_SHORTCODE_OF_SANGO.'inc/modal.php');
}
add_action('admin_footer','sango_modal_footer');

function sango_modal_parts(){
    include_once(ALL_SHORTCODE_OF_SANGO."parts/accordion.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/timeline.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/related-post.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/other-site-link.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/border.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/hosoku-desc.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/attention.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/source-code-box.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/balloon.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/float2.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/float3.php");
    //include_once(ALL_SHORTCODE_OF_SANGO."parts/embed-youtube.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/show-branch.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/category.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/tag.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/string-on-image.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/new-post.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/review-box.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/button.php");
    include_once(ALL_SHORTCODE_OF_SANGO."parts/box.php");
}

function related_post_list(){
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'order'=> 'DESC',
      'orderby'=> 'date' 
    );
    $query = new WP_Query($args);
    if($query->have_posts()){
        echo "<div class='related-post-list'>";
        while($query->have_posts()){
            $query->the_post();
            $post_id = get_the_ID();
            echo '<div class="'.$post_id.'">';
            echo '<div class="related-post-left">'.get_the_post_thumbnail().'</div>';
            echo '<div class="related-post-right"><h4>'.get_the_title().'</h4></div>';
            echo '</div>';
        }
        wp_reset_postdata();
        echo "</div>";
    }else{
        echo "<h2>ページはありませんでした</h2>";
    }
}

function sango_search_post(){
    check_ajax_referer('sango_search_keyword_ajax','secure');
    if(isset($_REQUEST['keyword'])){
        $keyword = $_REQUEST['keyword'];
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => -1
        );
        $query = new WP_Query($args);
        if($query->have_posts()){
            echo '<h2>'.$keyword.'を含むページの検索結果</h2>';
            echo "<div class='search-post-list'>";
            while($query->have_posts()){
                $query->the_post();
                $content = get_the_content();
                $title = get_the_title();
                $post_id = get_the_ID();
                if(strstr($content,$keyword) || strstr($title,$keyword)){
                    echo '<div class="'.$post_id.'">';
                    echo '<div class="related-post-left">'.get_the_post_thumbnail().'</div>';
                    echo '<div class="related-post-right"><h4>'.get_the_title().'</h4></div>';
                    echo '</div>';
                }
            }
            echo "</div>";
        }
        wp_reset_postdata();
        die();
    }
}
add_action('wp_ajax_sango_search_post','sango_search_post');

function sango_short_code_echo(){
    check_ajax_referer('echo_sango_short_code','secure');
    if(isset($_REQUEST['short_code'])){
        $short_code = $_REQUEST['short_code'];
        $short_code = preg_replace('/\\\/u',"",$short_code);
        echo do_shortcode($short_code);
        die;
    }
}
add_action('wp_ajax_sango_short_code_echo','sango_short_code_echo');

function sango_url_post(){
    check_ajax_referer('sango_url_post_ajax','secure');
    if(isset($_REQUEST['keyword'])){
        $keyword = $_REQUEST['keyword'];
        echo url_to_postid($keyword);
        die;
    }
}
add_action('wp_ajax_sango_url_post','sango_url_post');

}

require 'plugin-update-checker/plugin-update-checker.php';
$all_shortcode_of_sango_update_checker = Puc_v4_Factory::buildUpdateChecker(
  'https://fwww.me/json/all-short-code-of-sango.json',
  __FILE__,
  'all-short-code-of-sango'
);
