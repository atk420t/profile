<?php
/** このファイルではウィジェットについての設定をしています。
 * 最新記事のウィジェットにアイキャッチ画像を追加
 * カテゴリー/アーカイブウィジェトtなどに表示される「記事数」の出力スタイル変更
 * 人気記事ウィジェットの設定（アクセスカウント＆ウィジェット出力のための関数）
 */
/*********************
 * 最新記事ウィジェットにアイキャッチ画像を追加
 *********************/
class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts
{
  public function widget($args, $instance)
  {
    if (!isset($args['widget_id'])) {
      $args['widget_id'] = $this->id;
    }
    $title = (!empty($instance['title'])) ? $instance['title'] : 'Recent Posts';
    $title = apply_filters('widget_title', $title, $instance, $this->id_base);
    $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
    if (!$number) {
      $number = 5;
    }
    $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
    $getposts = new WP_Query(apply_filters('widget_posts_args', array(
      'posts_per_page' => $number,
      'no_found_rows' => true,
      'post_status' => 'publish',
      'ignore_sticky_posts' => true,
    )));
    if ($getposts->have_posts()) {
      echo $args['before_widget'];
      if ($title) {
        echo $args['before_title'] . $title . $args['after_title'];
      }
    ?>
    <ul class="my-widget">
    <?php while ($getposts->have_posts()): $getposts->the_post();?>
      <li>
        <a href="<?php the_permalink();?>">
          <?php if (has_post_thumbnail()): ?>
            <figure class="my-widget__img"><?php the_post_thumbnail('thumb-160');?></figure>
          <?php endif;?>
          <div class="my-widget__text"><?php get_the_title() ? the_title() : the_ID();?>
          <?php if ($show_date): ?>
            <span class="post-date dfont"><?php echo get_the_date('Y/m/d'); ?></span>
          <?php endif;?></div>
        </a>
      </li>
    <?php endwhile;?>
    </ul>
    <?php echo $args['after_widget']; ?>
    <?php
wp_reset_postdata();
    }
  }
}

function addimg_to_recentposts()
{
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'addimg_to_recentposts');
/*END 最新記事一覧にアイキャッチ画像を追加*/

/*********************
 * サイドバーのカテゴリー/アーカイブの数の表示を変更
 *********************/
/*カテゴリー*/
function optimize_entry_count($default, $args)
{
  $replaced = preg_replace('/<\/a> \(([0-9,]*)\)/', ' <span class="entry-count dfont">${1}</span></a>', $default);
  if ($replaced) {
    return $replaced;
  } else {
    return $default;
  }
}
add_filter('wp_list_categories', 'optimize_entry_count', 10, 2);

/*アーカイブ*/
function optimize_entry_count_archive($default)
{
  $replaced = preg_replace('/<\/a>&nbsp;\(([0-9,]*)\)/', ' <span class="entry-count">${1}</span></a>', $default);
  if ($replaced) {
    return $replaced;
  } else {
    return $default;
  }
}
add_filter('get_archives_link', 'optimize_entry_count_archive', 10, 2);

/*******************************
 * 人気記事ウィジェット
 *******************************/
/* single.phpの最下部でアクセス数のカウントを実行しています。*/

//アクセス数を取得する（PV数を出力したいときにはこの関数を使用）
function sng_get_post_views($postID)
{
  $count_key = 'post_views_count';
  $num = get_post_meta($postID, $count_key, true);
  if ($num == '') {
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
    return "0";
  }
  return $num . '';
}

//アクセス数を保存する
function sng_set_post_views($postID)
{
  $count_key = 'post_views_count';
  $num = get_post_meta($postID, $count_key, true);
  if ($num == '') {
    $num = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  } else {
    $num++;
    update_post_meta($postID, $count_key, $num);
  }
}

//人気記事ウィジェットに
class myPopularPosts extends WP_Widget
{
  public function __construct() {
    parent::__construct(false, $name = '人気記事');
  }
  public function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $entry_num = apply_filters('widget_body', $instance['count']);
    $show_num = apply_filters('widget_checkbox', $instance['show_num']);
    $show_views = apply_filters('widget_checkbox', $instance['show_views']);
    //以下出力されるHTML
    ?>
    <div class="widget my_popular_posts">
    <?php if ($title) echo $before_title . $title . $after_title; ?>
    <?php
      $args = array(
        'post_type' => 'any',
        'numberposts' => $entry_num,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
      );
      $pop_posts = get_posts($args);
      if ($pop_posts): ?>
        <ul class="my-widget <?php if ($show_num) { $i = 1; echo 'show_num';}?>">
          <?php foreach ($pop_posts as $post): ?>
          <li>
            <?php //順位
              if ($show_num) {
                echo '<span class="rank dfont accent-bc">' . $i . '</span>';
                $i++;
              }
            ?>
            <a href="<?php echo get_permalink($post->ID); ?>">
              <?php if (get_the_post_thumbnail($post->ID)): ?>
                <figure class="my-widget__img"><?php echo get_the_post_thumbnail($post->ID, 'thumb-160'); ?></figure>
              <?php endif;?>
              <div class="my-widget__text">
                <?php echo $post->post_title; ?>
                <?php if ($show_views) {
                          echo '<span class="dfont views">' . get_post_meta($post->ID, 'post_views_count', true) . ' views</span>';
                      }
                ?>
              </div>
            </a>
          </li>
          <?php endforeach;?>
          <?php wp_reset_postdata();?>
        </ul>
      <?php endif;?>
    </div>
  <?php } //END出力されるHTML

    //人気記事ウィジェットを出力
    public function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['count'] = $new_instance['count'];
      $instance['show_num'] = $new_instance['show_num'];
      $instance['show_views'] = $new_instance['show_views'];
      return $instance;
    }
    public function form($instance) {
      $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
      $entry_num = isset($instance['count']) ? $instance['count'] : '';
      $show_num = isset($instance['show_num']) ? $instance['show_num'] : '';
      $show_views = isset($instance['show_views']) ? $instance['show_views'] : '';
      ?>
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
        タイトル:
        </label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('count'); ?>">
        表示する記事数
        </label>
        <input class="tiny-text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" step="1" min="1" value="<?php echo $entry_num; ?>" size="3">
      </p>
      <p>
        <input id="<?php echo $this->get_field_id('show_num'); ?>" name="<?php echo $this->get_field_name('show_num'); ?>" type="checkbox" value="1" <?php checked($show_num, 1);?>/>
        <label for="<?php echo $this->get_field_id('show_num'); ?>">順位を表示する</label>
      </p>
      <p>
        <input id="<?php echo $this->get_field_id('show_views'); ?>" name="<?php echo $this->get_field_name('show_views'); ?>" type="checkbox" value="1" <?php checked($show_views, 1);?>/>
        <label for="<?php echo $this->get_field_id('show_views'); ?>">累計閲覧数を表示</label>
      </p>
    <?php
  }
}
add_action('widgets_init', function () {
  register_widget('myPopularPosts');
});
//END 人気記事

//アクセスがBOTかどうか判断する関数
//single.phpでアクセスをカウントする際に実行
if (!function_exists('is_bot')) {
  function is_bot() {
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $bots = array(
      'Googlebot',
      'Yahoo! Slurp',
      'Mediapartners-Google',
      'msnbot',
      'bingbot',
      'MJ12bot',
      'Ezooms',
      'pirst; MSIE 8.0;',
      'Google Web Preview',
      'ia_archiver',
      'Sogou web spider',
      'Googlebot-Mobile',
      'AhrefsBot',
      'YandexBot',
      'Purebot',
      'Baiduspider',
      'UnwindFetchor',
      'TweetmemeBot',
      'MetaURI',
      'PaperLiBot',
      'Showyoubot',
      'JS-Kit',
      'PostRank',
      'Crowsnest',
      'PycURL',
      'bitlybot',
      'Hatena',
      'facebookexternalhit',
      'NINJA bot',
      'YahooCacheSystem',
    );
    foreach ($bots as $bot) {
      if (stripos($ua, $bot) !== false) {return true;}
    }
    return false;
  }
}
?>
