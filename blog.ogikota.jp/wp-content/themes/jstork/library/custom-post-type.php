<?php
if (!function_exists('custom_post_lp')) {
	function custom_post_lp() { 
		register_post_type( 'post_lp',
			array( 'labels' => array(
				'name' => __( 'ランディングページ', 'opencagetheme' ),
				'singular_name' => __( 'ランディングページ', 'opencagetheme' ),
				'all_items' => __( 'すべてのランディングページ', 'opencagetheme' ),
				'add_new' => __( '新規作成', 'opencagetheme' ),
				'add_new_item' => __( 'ランディングページをつくる', 'opencagetheme' ),
				'edit' => __( '編集', 'opencagetheme' ),
				'edit_item' => __( 'ランディングページを編集', 'opencagetheme' ),
				'new_item' => __( 'New Post Type', 'opencagetheme' ),
				'view_item' => __( 'ランディングページを表示', 'opencagetheme' ),
				'search_items' => __( 'ランディングページを検索', 'opencagetheme' ),
				'not_found' =>  __( 'Nothing found in the Database.', 'opencagetheme' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'opencagetheme' ),
				'parent_item_colon' => ''
				),
				'description' => __( 'ランディングページをつくれます。', 'opencagetheme' ),
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 8,
				'menu_icon' => get_theme_file_uri('/library/images/custom-post-icon.png'),
				'rewrite'	=> array( 'slug' => 'post_lp', 'with_front' => false ),
				'has_archive' => 'post_lp',
				'capability_type' => 'post',
				'hierarchical' => true,
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'page-attributes' , 'revisions', 'sticky')
			)
		);
	}
	add_action( 'init', 'custom_post_lp');
}