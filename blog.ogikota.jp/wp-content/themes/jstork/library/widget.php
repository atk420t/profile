<?php
add_action( 'widgets_init', 'theme_register_sidebars' );
function theme_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'PC：メインサイドバー', 'storktheme' ),
		'description' => __( 'メインのサイドバーです。', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'sp-contentfoot',
		'name' => __( 'SP：メインサイドバー（コンテンツ下）', 'storktheme' ),
		'description' => __( 'スマホのコンテンツ下には、通常は「メインサイドバー」のものが表示されますがこちらのウィジェットを入力した場合は、こちらの「スマホ用コンテンツ下」ウィジェットが優先されます。', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'sidebar-sp',
		'name' => __( 'SP：ハンバーガーメニュー', 'storktheme' ),
		'description' => __( 'スマートフォンのヘッダー部分のハンバーガーボタン（menu）を押したときに表示されるウィジェット', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'side-fixed',
		'name' => __( 'PC：スクロール領域', 'storktheme' ),
		'description' => __( '「テキスト」や「WordPress Popular Posts」などを追加してバナーや読んで欲しい記事を設定できる （スマートフォン・タブレットでは表示されない）', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	
	register_sidebar(array(
		'id' => 'addbanner-titletop',
		'name' => __( '共通：記事タイトル上', 'storktheme' ),
		'description' => __( '記事タイトル上にテキストウィジェットを使って、イベントなどのお知らせなどを表示します。', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'addbanner-sp-titleunder',
		'name' => __( 'SP：[広告]記事タイトル下', 'storktheme' ),
		'description' => __( '記事タイトル下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはスマートフォン用！【推奨サイズ】レスポンシブ', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));


	register_sidebar(array(
		'id' => 'addbanner-pc-titleunder',
		'name' => __( 'PC：[広告]記事タイトル下', 'storktheme' ),
		'description' => __( '記事タイトル下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはパソコン用！【推奨サイズ】468×60 or レスポンシブ', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'addbanner-sp-contentfoot',
		'name' => __( 'SP：[広告]記事コンテンツ下', 'storktheme' ),
		'description' => __( '記事コンテンツ下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはスマートフォン用！【推奨サイズ】300×250', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));


	register_sidebar(array(
		'id' => 'addbanner-pc-contentfoot',
		'name' => __( 'PC：[広告]記事コンテンツ下', 'storktheme' ),
		'description' => __( '記事コンテンツ下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはパソコン用！【推奨サイズ】336×280', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'home-top',
		'name' => __( 'PC：トップページ上部', 'storktheme' ),
		'description' => __( 'トップページ（PC/Tablet）のヘッダー下 最大サイズ：728px', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'id' => 'home-top_mobile',
		'name' => __( 'SP：トップページ上部', 'storktheme' ),
		'description' => __( 'トップページ（スマートフォン）のヘッダー下', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'home-bottom',
		'name' => __( 'PC：トップページ下部', 'storktheme' ),
		'description' => __( 'トップページ（PC/Tablet）のフッター上 最大サイズ：728px', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'id' => 'home-bottom_mobile',
		'name' => __( 'SP：トップページ下部', 'storktheme' ),
		'description' => __( 'トップページ（スマートフォン）の記事一覧下', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));


	register_sidebar(array(
		'id' => 'footer1',
		'name' => __( 'PC：フッター（左）', 'storktheme' ),
		'description' => __( 'フッターの左端', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));
	
	register_sidebar(array(
		'id' => 'footer2',
		'name' => __( 'PC：フッター（真ん中）', 'storktheme' ),
		'description' => __( 'フッターの真ん中', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));
	
	register_sidebar(array(
		'id' => 'footer3',
		'name' => __( 'PC：フッター（右）', 'storktheme' ),
		'description' => __( 'フッターの右端', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'footer-sp',
		'name' => __( 'SP：フッター', 'storktheme' ),
		'description' => __( 'スマートフォン用のフッターウィジェットです。通常はPC版で設定したフッターウィジェットが表示されますが、こちらのスマートフォン用を設定した場合は、こちらで置き換えられます。', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'cta',
		'name' => __( '共通：CTA設定', 'storktheme' ),
		'description' => __( '記事（single）の一番下にColl To Actionを設置できます。「テキスト」を追加してテキストやコードを貼るか、「Black Studio TinyMCE Widget（プラグイン）」などのビジュアルエディタを追加してもOKです。※固定ページには表示されません。', 'storktheme' ),
		'before_widget' => '<div id="%1$s" class="ctawidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));

}


//ウィジェット内でショートコードを使用可能に
add_filter('widget_text', 'do_shortcode');


// カテゴリの投稿数をaタグの中に
add_filter( 'wp_list_categories', 'my_list_categories', 10, 2 );
function my_list_categories( $output, $args ) {
  $output = preg_replace('/<\/a>\s*\((\b\d{1,3}(,\d{3})*\b)\)/',' <span class="count">($1)</span></a>',$output);
  return $output;
}

// アーカイブの投稿数をaタグの中に
add_filter( 'get_archives_link', 'my_archives_link' );
function my_archives_link( $output ) {
  $output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' ($2)</a>',$output);
  return $output;
}

// 新着記事のフォーマットを変更
class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
	function widget($args, $instance) {
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			echo $before_widget;
			if( $title ) echo $before_title . $title . $after_title; ?>
			<ul>
				<?php while( $r->have_posts() ) : $r->the_post(); ?>				
				<li>
					<a class="cf" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
						<?php if ( $show_date ) : ?><span class="date gf"><?php the_time('Y.m.d'); ?></span><?php endif; ?>
					</a>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php
			echo $after_widget;
		wp_reset_postdata();
		endif;
	}
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');


//画像付き新着記事ウィジェット追加
///////////////////////////////////
class NewEntryImageWidget extends WP_Widget {
    public function __construct() {
         parent::__construct(false, $name = '[画像付き]最新の投稿');
    }
    function widget($args, $instance) {
        extract( $args );
        $title_new = apply_filters( 'widget_title_new', $instance['title_new'] );
        $entry_count = apply_filters( 'widget_entry_count', $instance['entry_count'] );
        global $g_entry_count; 
        $g_entry_count = 5;//表示数が設定されていない時は5にする
        if ($entry_count) {//表示数が設定されているときは表示数をグローバル変数に代入
          $g_entry_count = $entry_count;
        }
        ?>
          <div id="new-entries" class="widget widget_recent_entries widget_new_img_post cf">
            <h4 class="widgettitle"><span><?php if ($title_new) {
              echo $title_new;//タイトルが設定されている場合は使用する
            } else {
              echo '新着エントリー';
            }
            ?></span></h4>
			<ul>
			<?php global $g_entry_count; ?>
			<?php query_posts('posts_per_page='.$g_entry_count); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<li>
			<a class="cf" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php if ( has_post_thumbnail()) : ?>
			<figure class="eyecatch">
			<?php the_post_thumbnail('home-thum'); ?>
			</figure>
			<?php else: ?>
			<figure class="eyecatch noimg">
			<img src="<?php echo get_theme_file_uri('/library/images/noimg.png'); ?>">
			</figure>
			<?php endif; ?>
			<?php the_title(); ?>
			<span class="date gf"><?php the_time('Y.m.d'); ?></span>
			</a>
			</li><!-- /.new-entry -->
			<?php endwhile; 
			else :
			  echo '<p>新着記事はありません。</p>';
			endif; ?>
			<?php wp_reset_query(); ?>
			</ul>
          </div><!-- /#new-entries -->
        <?php
    }
    function update($new_instance, $old_instance) {
     $instance = $old_instance;
     $instance['title_new'] = strip_tags($new_instance['title_new']);
     $instance['entry_count'] = strip_tags($new_instance['entry_count']);
        return $instance;
    }
    function form($instance) {
        $title_new = esc_attr($instance['title_new']);
        $entry_count = esc_attr($instance['entry_count']);
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title_new'); ?>">
          <?php _e('新着エントリーのタイトル'); ?>
          </label>
          <input class="widefat" id="<?php echo $this->get_field_id('title_new'); ?>" name="<?php echo $this->get_field_name('title_new'); ?>" type="text" value="<?php echo $title_new; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('entry_count'); ?>">
          <?php _e('表示数（半角数字）'); ?>
          </label>
          <input class="widefat" id="<?php echo $this->get_field_id('entry_count'); ?>" name="<?php echo $this->get_field_name('entry_count'); ?>" type="text" value="<?php echo $entry_count; ?>" />
        </p>
        <?php
    }
}
add_action('widgets_init', function(){ register_widget('NewEntryImageWidget'); });