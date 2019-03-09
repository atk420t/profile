<?php

// include function file
require_once( 'library/customizer.php' );
require_once( 'library/shortcode.php' );
require_once( 'library/widget.php' );
require_once( 'library/custom-post-type.php' );
require_once( 'library/admin.php' );


// title tags
if (!function_exists('rw_title')) {
	add_filter( 'wp_title', 'rw_title', 10, 3 );
	function rw_title( $title, $sep, $seplocation ) {
	  global $page, $paged;
	
	  if ( is_feed() ) return $title;
	
	  $sep = " | ";
	  if ( 'right' == $seplocation ) {
	    $title .= get_bloginfo( 'name' );
	  } elseif ( is_home() || is_front_page() ){
		$title = $title . get_bloginfo( 'name' );  
	  } else {
	    $title = $title . "{$sep}" . get_bloginfo( 'name' );
	  }
	  $site_description = get_bloginfo( 'description', 'display' );
	  if ( $site_description && ( is_home() || is_front_page() ) ) {
	    $title .= "{$sep}{$site_description}";
	  }
	  if ( $paged >= 2 || $page >= 2 ) {
	    $title .= " {$sep} " . sprintf( __( '%sページ目', 'dbt' ), max( $paged, $page ) );
	  }
	  return $title;
	}
}

add_filter( 'the_generator', 'opencage_rss_version' );
function opencage_rss_version() {
	return '';
}

function opencage_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

add_filter( 'wp_head', 'opencage_remove_wp_widget_recent_comments_style', 1 );
function opencage_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

add_action( 'wp_head', 'opencage_remove_recent_comments_style', 1 );
function opencage_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}



// SCRIPTS Include
if (!is_admin()) {
	function register_script(){
	//IE判定
	$ieua = $_SERVER['HTTP_USER_AGENT'];
		wp_deregister_script( 'jquery' );
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), '1.12.4' );
		wp_register_script( 'css-modernizr', get_theme_file_uri('/library/js/libs/modernizr.custom.min.js'), array(), '2.5.3', true );
		wp_register_script( 'slick', get_theme_file_uri('/library/js/libs/slick.min.js'), array('jquery'), '1.5.9', true );
		wp_register_script( 'remodal', get_theme_file_uri('/library/js/libs/remodal.js'), array('jquery'), '1.0.0', true );
		wp_register_script( 'masonry.pkgd.min', get_theme_file_uri('/library/js/libs/masonry.pkgd.min.js'), array('jquery'), '4.0.0', true );
		wp_register_script( 'imagesloaded', get_theme_file_uri('/library/js/libs/imagesloaded.js'), array('jquery'), '4.1.0', true );
		if(!wp_is_mobile() && !strstr($ieua, 'Trident') && !strstr($ieua, 'MSIE') && (get_option('side_options_animatenone') == "ani_on")){
			wp_register_script( 'wow', get_theme_file_uri('/library/js/libs/wow.min.js'), array('jquery'), '', true );
		}
		wp_register_script( 'main-js', get_theme_file_uri('/library/js/scripts.js'), array( 'jquery' ), '', true );
	}
	function add_script() {
		register_script();
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'wow' );
			wp_enqueue_script( 'slick' );
			wp_enqueue_script( 'remodal' );
			wp_enqueue_script( 'masonry.pkgd.min' );
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'main-js' );
			wp_enqueue_script( 'css-modernizr' );
	}
	add_action('wp_enqueue_scripts', 'add_script');
}


// CSS Include
function register_style() {
	wp_register_style('style', get_bloginfo('template_directory').'/style.css');
	wp_register_style('shortcode', get_theme_file_uri('/library/css/shortcode.css'));
	wp_register_style('gf_Concert', '//fonts.googleapis.com/css?family=Concert+One');
	wp_register_style('gf_Lato', '//fonts.googleapis.com/css?family=Lato');
	if((get_option('side_options_fontawesomeinclude', 'fonta_cdn') == "fonta_cdn")){
		wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	} elseif((get_option('side_options_fontawesomeinclude') == "fonta_download")) {
		wp_register_style('fontawesome', get_theme_file_uri('/library/css/font-awesome.min.css'));
	} else {
		null;
	}
	wp_register_style('fontawesome', get_theme_file_uri('/library/css/font-awesome.min.css'));
	wp_register_style('slick', get_theme_file_uri('/library/css/slick.css'));
	wp_register_style('remodal', get_theme_file_uri('/library/css/remodal.css'));
	wp_register_style('animate', get_theme_file_uri('/library/css/animate.min.css'));
	wp_register_style('lp_css', get_theme_file_uri('/library/css/lp.css'));
}
	function add_stylesheet() {
		register_style();
			wp_enqueue_style('style');
			wp_enqueue_style('slick');
			wp_enqueue_style('shortcode');
			wp_enqueue_style('gf_Concert');
			wp_enqueue_style('gf_Lato');
		if(!(get_option('side_options_fontawesomeinclude') == "fonta_off")){
			wp_enqueue_style('fontawesome');
		}
			wp_enqueue_style('remodal');
		if((get_option('side_options_animatenone', 'ani_on') == "ani_on")){
			wp_enqueue_style('animate');
		}
		if(is_page_template( 'page-lp.php' ) || is_singular( 'post_lp' )) {
			wp_enqueue_style('lp_css');
		}
	}
add_action('wp_enqueue_scripts', 'add_stylesheet');


// breadcrumb
if (!function_exists('breadcrumb')) {
	function breadcrumb($divOption = array("id" => "breadcrumb", "class" => "breadcrumb inner wrap cf")){
		global $wp_query;
	    global $post;
	    $str ='';
	    if(get_option('side_options_pannavi', 'pannavi_on') !== 'pannavi_off'){
		    if(!is_home()&&!is_front_page()&&!is_admin() ){
		        $tagAttribute = '';
		        foreach($divOption as $attrName => $attrValue){
		            $tagAttribute .= sprintf(' %s="%s"', $attrName, $attrValue);
		        }
		        $str.= '<div'. $tagAttribute .'>';
		        $str.= '<ul>';
		        $str.= '<li itemscope itemtype="//data-vocabulary.org/Breadcrumb" class="bc_homelink"><a href="'. esc_url(home_url( '/' )) .'" itemprop="url"><span itemprop="title"> HOME</span></a></li>';
		 
		        if(is_category()) {
		            $cat = get_queried_object();
		            if($cat -> parent != 0){
		                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
		                foreach($ancestors as $ancestor){
		                    $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor) .'</span></a></li>';
		                }
		            }
		            $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $cat -> name . '</span></li>';
		        } elseif ( is_post_type_archive() ) {
			        $cpt = get_query_var( 'post_type' );
			        $str.= '<li>' . get_post_type_object( $cpt )->label . '</li>';
			    } elseif ( is_tax() ) {
				    //taxonomy
				    $query_obj = get_queried_object();
					$post_types = get_taxonomy( $query_obj->taxonomy )->object_type;
					$cpt = $post_types[0];
					$str.= '<li><a href="'. get_post_type_archive_link( $cpt ) . '" itemprop="url"><span itemprop="title">'. get_post_type_object( $cpt )->label .'</span></a></li>';
					$taxonomy = get_query_var( 'taxonomy' );
					$term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
					if ( is_taxonomy_hierarchical( $taxonomy ) && $term->parent != 0 ) {
						$ancestors = array_reverse( get_ancestors( $term->term_id, $taxonomy ) );
						foreach ( $ancestors as $ancestor_id ) {
							$ancestor = get_term( $ancestor_id, $taxonomy );
							$str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_term_link( $ancestor, $term->slug ) .'" itemprop="url"><span itemprop="title">'. $ancestor->name .'</span></a></li>';
						}
					}
					$str.='<li>'. $term->name .'</li>';
		        } elseif(is_single()){
			        $post_type = get_post_type( $post->ID );
			        if ( $post_type == 'post' ) {
				        // normal post
			            $categories = get_the_category($post->ID);
			            $cat = $categories[0];
			            if($cat -> parent != 0){
			                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
			                foreach($ancestors as $ancestor){
			                    $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor). '</span></a></li>';
			                }
			            }
			            $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url"><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
			            $str.= '<li>'. $post -> post_title .'</li>';
			        } else {
						// custom post type
						$post_type_object = get_post_type_object( $post->post_type );
						if($post_type_object->has_archive !== false){
							$str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_post_type_archive_link(get_post_type()) .'" itemprop="url"><span itemprop="title">'. $post_type_object->labels->name .'</a></span></li>';
						}
						$str.= '<li>'. $post -> post_title .'</li>';
				    }
		        } elseif(is_page()){
		            if($post -> post_parent != 0 ){
		                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
		                foreach($ancestors as $ancestor){
		                    $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url"><span itemprop="title">'. get_the_title($ancestor) .'</span></a></li>';
		                }
		            }
		            $str.= '<li>'. $post -> post_title .'</li>';
		        } elseif(is_date()){
					if( is_year() ){
						$str.= '<li>' . get_the_time('Y') . '年</li>';
					} else if( is_month() ){
						$str.= '<li><a href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
						$str.= '<li>' . get_the_time('n') . '月</li>';
					} else if( is_day() ){
						$str.= '<li><a href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
						$str.= '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('n') . '月</a></li>';
						$str.= '<li>' . get_the_time('j') . '日</li>';
					}
					if(is_year() && is_month() && is_day() ){
						$str.= '<li>' . wp_title('', false) . '</li>';
					}
		        } elseif(is_search()) {
		            $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">「'. get_search_query() .'」で検索した結果</span></li>';
		        } elseif(is_author()){
		            $str .='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
		        } elseif(is_tag()){
		            $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">タグ : '. single_tag_title( '' , false ). '</span></li>';
		        } elseif(is_attachment()){
		            $str.= '<li><span itemprop="title">'. $post -> post_title .'</span></li>';
		        } elseif(is_404()){
		            $str.='<li>ページがみつかりません。</li>';
		        } else{
		            $str.='<li></li>';
		        }
		        $str.='</ul>';
		        $str.='</div>';
		    }
		}
	    echo $str;
	}
}

// Pagination
if (!function_exists('pagination')) {
	function pagination($pages = '', $range = 2){
	     global $wp_query, $paged;
	
		$big = 999999999;
	
		echo "<nav class=\"pagination cf\">";
	 	echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'current' => max( 1, get_query_var('paged') ),
			'prev_text'    => __('<'),
			'next_text'    => __('>'),
			'type'    => 'list',
			'total' => $wp_query->max_num_pages
		) );
		echo "</nav>\n";
	}
}

// Search Form
if (!function_exists('my_search_form')) {
	function my_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="searchform cf" action="' . esc_url(home_url( '/' )) . '" >
		<input type="search" placeholder="検索する" value="' . get_search_query() . '" name="s" id="s" />
		<button type="submit" id="searchsubmit" ><i class="fa fa-search"></i></button>
		</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'my_search_form' );
}


// Thumbnail Size
if (!function_exists('add_mythumbnail_size')) {
	function add_mythumbnail_size() {
	add_theme_support('post-thumbnails');
	add_image_size( 'home-thum', 486, 290, true );
	add_image_size( 'post-thum', 300, 200, true );
	}
	add_action( 'after_setup_theme', 'add_mythumbnail_size' );
}

// Page inset Tags
function add_tag_to_page() {
 register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tag_to_page');

// Archives HTML
remove_filter( 'pre_term_description', 'wp_filter_kses' );

// Update Post date
function get_mtime($format) {
    $mtime = get_the_modified_time('Ymd');
    $ptime = get_the_time('Ymd');
    if ($ptime > $mtime) {
        return get_the_time($format);
    } elseif ($ptime === $mtime) {
        return null;
    } else {
        return get_the_modified_time($format);
    }
}

// iframe
if ( ! isset( $content_width ) ) {
	$content_width = 728;
}

function wrap_iframe_in_div($the_content) {
if ( is_singular() ) {
// YouTube
$the_content = preg_replace('/<iframe[^>]+?youtube\.com[^<]+?<\/iframe>/is', '<div class="youtube-container">${0}</div>', $the_content);
}
return $the_content;
}
add_filter('the_content','wrap_iframe_in_div');


// Site Search Page unset
if (!function_exists('SearchFilter')) {
	function SearchFilter($query) {
	if ($query->is_search && !is_admin()) {
	$query->set('post_type', 'post');
	}
	return $query;
	}
	add_filter('pre_get_posts','SearchFilter');
}

// UserPage HTML
remove_filter('pre_user_description', 'wp_filter_kses');

// User Profile set_unset
if (!function_exists('update_profile_fields')) {
	function update_profile_fields( $contactmethods ) {
	    //項目の削除
	    unset($contactmethods['aim']);
	    unset($contactmethods['jabber']);
	    unset($contactmethods['yim']);
	    //項目の追加
	    $contactmethods['twitter'] = 'Twitter';
	    $contactmethods['facebook'] = 'Facebook';
	    $contactmethods['googleplus'] = 'Google+';
	    $contactmethods['instagram'] = 'Instagram';
	    $contactmethods['youtube'] = 'YouTube';
	     
	    return $contactmethods;
	}
	add_filter('user_contactmethods','update_profile_fields',10,1);
}

// Self Pingback
function no_self_pingst( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_pingst' );


// Archives P Tags
add_filter( 'the_content', 'opencage_filter_ptags_on_images' );
function opencage_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
// more
if (!function_exists('opencage_excerpt_more')) {
	add_filter( 'excerpt_more', 'opencage_excerpt_more' );
	function opencage_excerpt_more($more) {
		global $post;
		return '...';
	}
}

// is_mobile
function is_mobile(){
$useragents = array(
'iPhone',
'iPod',
'Android.*Mobile',
'Windows.*Phone',
'dream',
'CUPCAKE',
'blackberry9500',
'blackberry9530',
'blackberry9520',
'blackberry9550',
'blackberry9800',
'webOS',
'incognito',
'webmate'
);
$pattern = '/'.implode('|', $useragents).'/i';
return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


// Custom Menu
if (!function_exists('description_in_nav_menu')) {
	add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);
	function description_in_nav_menu($item_output, $item){
		if ( !empty( $item->description ) ) {
			$item_output = preg_replace('/(<a.*?>[^<]*?)</', '$1' . "<span class=\"gf\">{$item->description}</span><", $item_output);
		}
		return $item_output;
	}
}


// THEME SUPPORT
require 'library/theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
'jstork',
'http://open-cage.com/theme-update/stork/update-info.json'
);


// add_theme_support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background',
    array(
    'default-color' => 'f7f7f7',
    'wp-head-callback' => '_custom_background_cb',
    'admin-head-callback' => '',
    'admin-preview-callback' => ''
    )
);
add_theme_support('automatic-feed-links');
add_theme_support( 'menus' );
register_nav_menus(
	array(
		'main-nav' => 'グローバルナビ' ,
		'main-nav-sp' => 'グローバルナビ（スマートフォン）' ,
		'footer-links' => 'フッターナビ',
	)
);

add_theme_support( 'html5', array(
	'comment-list',
	'search-form',
	'comment-form'
) );