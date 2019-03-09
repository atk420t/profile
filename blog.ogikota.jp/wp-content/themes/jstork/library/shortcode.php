<?php


function shortcode_empty_paragraph_fix($content) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
 
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');



// 関連記事を呼び出す
function kanrenFunc($atts , $content = null) {

	$postid = (isset($atts['postid'])) ? esc_attr($atts['postid']) : null;
	$pageid = (isset($atts['pageid'])) ? esc_attr($atts['pageid']) : null;

	if($postid || $pageid) {
		
		$postids = (explode(',',$postid));
		$datenone = (isset($atts['date'])) ? esc_attr($atts['date']) : null;
		$order = (isset($atts['order'])) ? esc_attr($atts['order']) : "DESC";
		$orderby = (isset($atts['orderby'])) ? esc_attr($atts['orderby']) : "post_date";
		$labelclass = isset($atts['label']) ? ' labelnone' : "";
		$target = isset($atts['target']) ? ' target="_blank"' : "";
		
		$echo ="";
	
		$args = array(
			"post_type" => array('post','page'),
		    'posts_per_page' => -1,
			'post__in' => $postids,
			'page_id' => $pageid,
		    'orderby' => $orderby,
		    'order' => $order,
		    'post_status' => 'publish',
		    'suppress_filters' => true,
		    'ignore_sticky_posts' => true,
		    'no_found_rows' => true
		);
	
		$the_query = new WP_Query( $args );
		
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				$post_id ="";
				
				$url = esc_url(get_permalink());
				if(has_post_thumbnail()){ $postimg = '<figure class="eyecatch thum">' .get_the_post_thumbnail($post_id, 'home-thum'). '</figure>';} else { $postimg = ""; }
				if(!$datenone && !$pageid){ $postdate = '<span class="date gf">' . get_the_date() . '</span>';} else { $postdate = null; }
	
				$postttl = '<p class="ttl">' . esc_attr(get_the_title()) . '</p>';
					
				$echo .= '<div class="related_article cf' . $labelclass . '"><a href="' . $url . '"' . $target .'>' .$postimg. '<div class="meta inbox">' . $postttl . $postdate . '</div></a></div>';
			} // LOOP END
			wp_reset_postdata();
		}
	
		return $echo;

	} else {
		return null;
	}

}
add_shortcode('kanren','kanrenFunc');


// 関連記事を呼び出す（ラベル無し）
function kanren2Func($atts , $content = null) {

	$postid = (isset($atts['postid'])) ? esc_attr($atts['postid']) : null;
	$pageid = (isset($atts['pageid'])) ? esc_attr($atts['pageid']) : null;

	if($postid || $pageid) {
		
		$postids = (explode(',',$postid));
		$datenone = (isset($atts['date'])) ? esc_attr($atts['date']) : null;
		$order = (isset($atts['order'])) ? esc_attr($atts['order']) : "DESC";
		$orderby = (isset($atts['orderby'])) ? esc_attr($atts['orderby']) : "post_date";
		$target = isset($atts['target']) ? ' target="_blank"' : "";
		
		$echo ="";
	
		$args = array(
			"post_type" => array('post','page'),
		    'posts_per_page' => -1,
			'post__in' => $postids,
			'page_id' => $pageid,
		    'orderby' => $orderby,
		    'order' => $order,
		    'post_status' => 'publish',
		    'suppress_filters' => true,
		    'ignore_sticky_posts' => true,
		    'no_found_rows' => true
		);
	
		$the_query = new WP_Query( $args );
		
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				$post_id ="";

				$url = esc_url(get_permalink());
				if(has_post_thumbnail()){ $postimg = '<figure class="eyecatch thum">' .get_the_post_thumbnail($post_id, 'home-thum'). '</figure>';} else { $postimg = ""; }
				if(!$datenone && !$pageid){ $postdate = '<span class="date gf">' . get_the_date() . '</span>';} else { $postdate = null; }
	
				$postttl = '<p class="ttl">' . esc_attr(get_the_title()) . '</p>';
					
				$echo .= '<div class="related_article cf labelnone"><a href="' . $url . '"' . $target .'>' .$postimg. '<div class="meta inbox">' . $postttl . $postdate . '</div></a></div>';
			} // LOOP END
			wp_reset_postdata();
		}
	
		return $echo;

	} else {
		return null;
	}
	
}
add_shortcode('kanren2','kanren2Func');




//グリッド　wrap
function colwrapFunc( $atts, $content = null ) {
	$class = (isset($atts['class'])) ? esc_attr($atts['class']) : null;
    
    return '<div class="column-wrap cf ' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('colwrap', 'colwrapFunc');

//グリッド　デスクトップ・ダブレット2カラム 以下1カラム
function col2Func( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => '',
    ), $atts ) );
    
    return '<div class="d-1of2 t-1of2 m-all ' . $class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('col2', 'col2Func');

//グリッド　デスクトップ・タブレット3カラム 以下1カラム
function col3Func( $atts, $content = null ) {
    return '<div class="d-1of3 t-1of3 m-all">' . do_shortcode($content) . '</div>';
}
add_shortcode('col3', 'col3Func');

// CTA
function ctainnerFunc( $atts, $content = null ) {
    return '<div class="cta-inner cf">' . do_shortcode($content) . '</div>';
}
add_shortcode('cta_in', 'ctainnerFunc');

//CTA COPYWRITING
function ctacopyFunc( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'class' => '',
    ), $atts ) );
     
    return '<h2 class="cta_copy"><span>' . $content . '</span></h2>';
}
add_shortcode('cta_ttl', 'ctacopyFunc');


// CTAボタン
function ctabtnFunc( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'link' => '',
    ), $atts ) );
     
    return '<div class="btn-wrap aligncenter big lightning cta_btn"><a href="' . $link . '">' . $content . '</a></div>';
}
add_shortcode('cta_btn', 'ctabtnFunc');

// 補足説明・注意
function asideFunc( $atts, $content = null ) {
	$type = (isset($atts['type'])) ? esc_attr($atts['type']) : null;
     
    return '<div class="supplement '. $type . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('aside', 'asideFunc');


// ボタン
function btnFunc( $atts, $content = null ) {
	$class = (isset($atts['class'])) ? esc_attr($atts['class']) : null;
     
    return '<div class="btn-wrap aligncenter ' . $class. '">' . $content . '</div>';
}
add_shortcode('btn', 'btnFunc');

//吹き出し
function voiceFunc( $atts, $content = null ) {
	$icon = (isset($atts['icon'])) ? esc_attr($atts['icon']) : null;
	$type = (isset($atts['type'])) ? esc_attr($atts['type']) : null;
	$name = (isset($atts['name'])) ? esc_attr($atts['name']) : null;
     
    return '<div class="voice cf ' .$type. '"><figure class="icon"><img src="' . $icon . '"><figcaption class="name">' . $name . '</figcaption></figure><div class="voicecomment">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('voice', 'voiceFunc');

// コンテンツボックス
function contentboxFunc($atts , $content = null) {
	if($atts && $content) {
		$class = (isset($atts['class'])) ? esc_attr($atts['class']) : null;
		$title = (isset($atts['title'])) ? esc_attr($atts['title']) : null;
		if(!$title && $class) {
			return '<div class="c_box ' . $class . '">' . do_shortcode($content) . '</div>';

		} elseif($title && $class) {
			return '<div class="c_box intitle ' . $class . '"><div class="box_title"><span>' . $title . '</span></div>'. do_shortcode($content) .'</div>';
		}
	}
}
add_shortcode('box','contentboxFunc');