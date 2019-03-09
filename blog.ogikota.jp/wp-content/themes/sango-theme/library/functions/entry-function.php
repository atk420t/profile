<?php
/**
 * SANGOの投稿ページで使われる関数をまとめています。
 * - articleに含まれるクラス名を変更
 * - 1カラム設定用のクラス名を出力
 * - 記事下：おすすめ記事
 * - 記事下：CTA
 * - 記事下：フォローボックス
 * - この記事を書いた人
 * - ユーザープロフィールからSNSのURLを登録
 * - 関連記事
 * - 構造化データ
 * - コメント
 * -「前後の記事へ」用にタイトル文字数を制限
 * - シェアボタン
 * - excerpt（要約の末尾の「…」を変更）
 */

/*************************
articleに出力されるクラス名を変更
 **************************/
function no_hentry($classes)
{
  /*アイキャッチ画像なしクラスを出力*/
  global $post;
  if (!has_post_thumbnail($post->ID) && (!get_option('open_fab') || is_page())) {
      $classes[] = 'nothumb';
  }
  /*hentryを出力しない*/
  $classes = array_diff($classes, array('hentry'));
  return $classes;
}
add_filter('post_class', 'no_hentry');

/*********************
1カラム設定のときに特定のクラス名を出力
 *********************/
/* 以下のどちらかの条件で1カラム設定
1) カスタマイザーで「モバイルでサイドバーを表示しない」にチェック
2) 投稿/固定ページで1カラム設定にチェック
どちらかに当てはまれば、one-columnのクラス名を出力
 */
if (!function_exists('column_class')) {
  function column_class()
  {
    global $post;
    if ((wp_is_mobile() && get_option('no_sidebar_mobile')) || get_post_meta($post->ID, 'one_column_options', true)) {
      echo ' class="one-column"';
    }
  }
}

/*********************
記事下に表示するおすすめの記事
（カスタマイザーから4つまで登録可能）
 *********************/
if (!function_exists('sng_recommended_posts')) {
  function sng_recommended_posts()
  {
    if (get_option('enable_recommend')) {
      if (get_option('recommend_title')) {
        echo '<h3 class="h-undeline related_title">' . get_option('recommend_title') . '</h3>';
      }
//タイトル（未入力なら非表示）
      echo '<div class="recommended cf">';
      global $post;
      $i = 0;
      while ($i < 4) {
        $i++;
        $url_option_name = 'recid' . $i; //カスタマイザーに入力されたURLを取得するための名前
        $id = esc_attr(get_option($url_option_name)); //記事のID
        $url = get_permalink($id); //記事のURL
        $title_option_name = 'rectitle' . $i; //カスタマイザーに入力されたタイトルを取得するための名前
        $title = (get_option($title_option_name)) ? get_option($title_option_name) : get_the_title($id); //記事のタイトルを取得：カスタマイザーで未入力の場合、デフォルトのタイトルを取得
        if ($id && ($id != $post->ID)):
        ?>
        <a href="<?php echo esc_attr($url); ?>">
          <figure><?php echo get_the_post_thumbnail($id, 'thumb-160'); ?></figure>
          <div><?php echo esc_attr($title); ?></div>
        </a>
        <?php endif;
      } //endwhile
      echo '</div>';
    } //endif
  } //end function
}

/**************************
記事下CTA
 ***************************/
if (!function_exists('insert_cta')) {
  function insert_cta()
  {
    if (get_option('enable_cta')) {
      $exclude_cat = explode(',', get_option('no_cta_cat')); //CTAを表示しないカテゴリー
      if (!in_category($exclude_cat)) {?>
      <div class="cta" style="background: <?php echo get_theme_mod('cta_background_color', '#c8e4ff'); ?>;">
        <?php if (get_option('cta_big_txt')): ?>
          <h3 style="color: <?php echo get_theme_mod('cta_bigtxt_color', '#333'); ?>;">
            <?php echo get_option('cta_big_txt'); ?>
          </h3>
        <?php endif;
          if (get_option('cta_image_upload')): ?>
          <p class="cta-img">
            <img src="<?php echo esc_url(get_option('cta_image_upload')); ?>" />
          </p>
        <?php endif;
          if (get_option('cta_sml_txt')): ?>
            <p class="cta-descr" style="color: <?php echo get_theme_mod('cta_smltxt_color', '#333'); ?>;"><?php echo get_option('cta_sml_txt'); ?></p>
        <?php endif;
          if (get_option('cta_btn_txt')): ?>
          <p class="cta-btn"><a class="raised" href="<?php echo esc_url(get_option('cta_btn_url')); ?>" style="background: <?php echo get_theme_mod('cta_btn_color', '#ffb36b'); ?>;"><?php echo get_option('cta_btn_txt'); ?></a></p>
        <?php endif;?>
      </div>
<?php }
    }
  }
}
/*********************
フォローボックス（この記事が気に入ったらいいね）
 *********************/
if (!function_exists('insert_like_box')) {
  function insert_like_box()
  {
    if (get_option('enable_like_box')) {
      $user_tw = (get_option('like_box_twitter')) ? esc_attr(get_option('like_box_twitter')) : null;
      $follower = (get_option('follower_count')) ? 'true' : 'false';
      $url_fb = (get_option('like_box_fb')) ? esc_url(get_option('like_box_fb')) : null;
      $url_fdly = (get_option('like_box_feedly')) ? esc_url(get_option('like_box_feedly')) : null;
      $url_insta = (get_option('like_box_insta')) ? esc_url(get_option('like_box_insta')) : null;
      $title = (get_option('like_box_title')) ? '<p class="dfont">' . get_option('like_box_title') . '</p>' : "";
      ?>
      <div class="like_box">
        <div class="like_inside">
          <div class="like_img">
            <img src="<?php echo featured_image_src('thumb-520'); ?>">
            <?php echo $title; ?>
          </div>
          <div class="like_content"><p>この記事が気に入ったらフォローしよう</p>
          <?php
            if ($user_tw): //twitter ?>
            <div><a href="https://twitter.com/<?php echo $user_tw; ?>" class="twitter-follow-button" data-show-count="<?php echo $follower; ?>" data-lang="ja" data-show-screen-name="false" rel="nofollow">フォローする</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
          <?php endif; //END twitter

            if ($url_fdly): //feedly?>
            <div><a href="<?php echo $url_fdly; ?>" target="blank" rel="nofollow"><img src="<?php echo get_template_directory_uri() . '/library/images/feedly.png'; ?>" alt="follow me on feedly" width="66" height="20"></a></div>
          <?php endif; //END Feedly

            if ($url_fb): //facebook?>
            <div><div class="fb-like" data-href="<?php echo $url_fb; ?>" data-layout="button_count" data-action="like" data-share="false"></div></div>
          <?php endif; //END FB
            if ($url_insta): //facebook?>
            <div><a class="like_insta" href="<?php echo $url_insta; ?>" target="blank" rel="nofollow"><?php fa_tag("instagram","instagram",true) ?> フォローする</a></div>
          <?php endif; //END FB
            echo '</div></div></div>';
    }
  } //end function
}

//facebookいいねボタン用のjs。カスタマイザーで登録済みの場合のみ出力
function fb_like_js()
{
  if (is_singular() && get_option('like_box_fb')) {
    echo <<< EOM
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
EOM;
  } //endif
}
add_action('wp_footer', 'fb_like_js', 100);

/*********************
この記事を書いた人
 *********************/
if (!function_exists('insert_author_info')) {
  function insert_author_info()
  {
    $author_descr = get_the_author_meta('description');
    if (!empty($author_descr)): //プロフィール情報が埋まっているときに表示 ?>
	  <div class="author-info pastel-bc">
	    <div class="author-info__inner">
	      <div class="tb">
	        <div class="tb-left">
	        <div class="author_label">
	          <span>この記事を書いた人</span>
	        </div>
	        <div class="author_img"><?php $iconimg = get_avatar(get_the_author_meta('ID'), 100);
            if ($iconimg) {
                echo $iconimg;
            }
            //画像 ?></div>
	          <dl class="aut">
              <dt>
                <a class="dfont" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                  <span><?php esc_attr(the_author_meta('display_name')); //名前 ?></span>
                </a>
              </dt>
              <dd><?php esc_attr(the_author_meta('yourtitle'));?></dd>
	          </dl>
	        </div>
          <div class="tb-right">
            <p><?php the_author_meta('user_description'); //プロフィール文 ?></p>
            <div class="follow_btn dfont">
            <?php
              $socials = array(
                'Twitter' => esc_attr(get_the_author_meta('twitter')),
                'Facebook' => esc_url(get_the_author_meta('facebook')),
                'Instagram' => esc_url(get_the_author_meta('instagram')),
                'Feedly' => esc_url(get_the_author_meta('feedly')),
                'LINE' => esc_url(get_the_author_meta('line')),
                'YouTube' => esc_url(get_the_author_meta('youtube')),
                'Website' => esc_url(get_the_author_meta('url')),
              );
              foreach ($socials as $name => $url) {
                if ($url) { ?>
                  <a class="<?php echo $name; ?>" href="<?php echo esc_url($url); ?>" target="_blank" rel="nofollow noopener noreferrer"><?php echo esc_attr($name); ?></a>
          <?php }
              }?>
            </div>
          </div>
	      </div>
	    </div>
	  </div>
	<?php endif;}
}

/*********************
ユーザー管理画面からfacebookやTwitterを登録
 *********************/
function add_user_contactmethods($user_contactmethods)
{
  return array(
    'yourtitle' => '肩書き（入力するとプロフィールに表示）',
    'twitter' => 'TwitterのURL',
    'facebook' => 'FacebookのURL',
    'instagram' => 'InstagramのURL',
    'feedly' => 'FeedlyのURL',
    'youtube' => 'YouTubeのURL',
    'line' => 'LINEのURL',
  );
}
add_filter('user_contactmethods', 'add_user_contactmethods');

/*************************
関連記事を出力
 **************************/
if (!function_exists('output_sng_related_posts')) {
  function output_sng_related_posts()
  {
    global $post;
    $categories = get_the_category();
    if (!$categories) {
      return false;
    }
    $catid = array();
    $parent_id = (get_option('related_add_parent')) ? $categories[0]->category_parent : null;
    if ($parent_id) { //親カテゴリーが存在する＆親カテゴリーを関連記事から出力する
      $child_catids = get_term_children($parent_id, 'category');
      foreach ($child_catids as $value) {
        $catid[] .= $value; //子カテのIDを配列に追加
      }
      $catid[] .= $parent_id; //親カテのIDを配列に追加
    } else { //親カテゴリがない場合はそのカテゴリだけ
      $catid[] .= $categories[0]->cat_ID;
    }
    $num = (get_option('num_related_posts')) ? esc_attr(get_option('num_related_posts')) : 6; /*出力数*/
    $related_posts = get_posts(array(
      'category__in' => $catid,
      'exclude' => $post->ID,
      'numberposts' => $num,
      'orderby' => 'rand',
    ));
    if ($related_posts) {
      $design = get_theme_mod('related_posts_type') ? esc_attr(get_theme_mod('related_posts_type')) : 'type_a';
      $design .= get_option('related_no_slider') || ($design == 'type_c') ? ' no_slide' : ' slide';
      if (get_option('related_post_title')) {
        echo '<h3 class="h-undeline related_title">' . get_option('related_post_title') . '</h3>';
      }
      echo '<div class="related-posts ' . $design . '" ontouchstart =""><ul>';
        foreach ($related_posts as $related_post):
          $thumbnail = get_post_thumbnail_id($related_post->ID);
          $src_info = wp_get_attachment_image_src($thumbnail, 'thumb-520');
          $src = $src_info[0];
          if (!$src && get_option('thumb_upload')) { //アイキャッチ画像が無い時は登録されたデフォルト画像を探す
            $src = replace_thumbnail_src(esc_url(get_option('thumb_upload')), "thumb-520");
          } elseif (!$src) { //それでも無い場合はテンプレートフォルダから
            $src = get_template_directory_uri() . '/library/images/default_small.jpg';
          }
          $title = $related_post->post_title;
          ?>
          <li>
            <a href="<?php echo get_permalink($related_post->ID); ?>">
              <figure class="rlmg">
                <img src="<?php echo $src; ?>" alt="<?php echo $title; ?>">
              </figure>
              <div class="rep"><p><?php echo $title ?></p></div>
            </a>
          </li>
      <?php
        endforeach;
        wp_reset_postdata();
        echo '</ul></div>';
    }
  } /* end related posts function */
}

/*********************
構造化データ挿入
 *********************/
if (!function_exists('insert_json_ld')) {
  function insert_json_ld()
  {
    $src_info = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    if ($src_info) {
      $src = $src_info[0];
      $width = $src_info[1];
      $height = $src_info[2];
    } else { //アイキャッチ画像が無い場合はデフォルトの登録画像
      $src = featured_image_src('thumb-520');
      $width = '520';
      $height = '300';
    }
    ?>
    <script type="application/ld+json">
      {
      "@context": "http://schema.org",
      "@type": "Article",
      "mainEntityOfPage":"<?php the_permalink();?>",
      "headline": "<?php echo esc_attr(get_the_title()); ?>",

      "image": {
      "@type": "ImageObject",
      "url": "<?php echo $src; ?>",
      "width":<?php echo $width; ?>,
      "height":<?php echo $height; ?>
      },

      "datePublished": "<?php echo get_the_date(DATE_ISO8601); ?>",
      "dateModified": "<?php if (get_the_date() != get_the_modified_time()) {the_modified_date(DATE_ISO8601);} else {echo get_the_date(DATE_ISO8601);}?>",
      "author": {
      "@type": "Person",
      "name": "<?php the_author_meta('display_name');?>"
      },
      "publisher": {
      "@type": "Organization",
      "name": "<?php echo esc_attr(get_option('publisher_name')); ?>",
      "logo": {
      "@type": "ImageObject",
      "url": "<?php echo esc_url(get_option('publisher_img')); ?>"
      }
      },
      "description": "<?php echo esc_attr(get_the_excerpt()); ?>"
      }
    </script>
  <?php
  }
}
/*************************
コメントレイアウト（comments.phpで呼び出し）
 **************************/
if (!function_exists('sng_comments')) {
  function sng_comments($comment, $args, $depth)
  {
    $GLOBALS['comment'] = $comment;?>
    <div id="comment-<?php comment_ID();?>" <?php comment_class('cf');?>>
      <article  class="cf">
        <header class="comment-author vcard">
          <?php $bgauthemail = get_comment_author_email(); ?>
          <?php echo get_avatar($comment, 40); ?>
          <?php printf('<cite class="fn">%1$s</cite> %2$s', get_comment_author_link(), edit_comment_link('(Edit)', '  ', ''))?>
          <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>" rel="nofollow"><?php comment_time('Y年n月j日');?> </a></time>
        </header>
        <?php if ($comment->comment_approved == '0'): ?>
          <div class="alert alert-info">
            <p><?php echo 'あなたのコメントは現在承認待ちです。'; ?></p>
          </div>
        <?php endif;?>
        <section class="comment_content cf">
          <?php comment_text()?>
        </section>
        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))?>
      </article>
  <?php
  } //END sng comments
}

/*********************
文字数を制限しながらタイトルを出力
⇒前の記事/次の記事へのリンクで使用
 *********************/
function lim_title($id)
{
  $raw = esc_attr(get_the_title($id));
  if (mb_strlen($raw, 'UTF-8') > 31) {
    $title = mb_substr($raw, 0, 31, 'UTF-8');
    echo $title . '…';
  } else {
    echo $raw;
  }
}

/*********************
シェアボタン
 *********************/
if (!function_exists('insert_social_buttons')) {
  function insert_social_buttons($type = null) {
    /**
    * $type = fabだとfab用のシェアボタンを出力
    * $type = belowtitleだとタイトル下用のシェアボタンを出力
    * fabだとタイトルの出力無し
    * カスタマイザーで「シェアボタンのデザインを変える」にチェックをつけると、sns-difというクラス名を出力。CSSでデザイン指定
    * ホームでも使えるように
    */
    $share_url = (is_home() || is_front_page()) ? home_url('/') : get_permalink();
    $encode_url = urlencode($share_url);

    $sitename = (is_home() || is_front_page()) ? '' : '｜' . get_bloginfo('name');
    $sitename = urlencode($sitename);

    $raw_title = (is_home() || is_front_page()) ? get_bloginfo('name') . '｜' . get_bloginfo('description') : get_the_title();
    $encode_title = urlencode($raw_title);

    $tw_via = (get_option('include_tweet_via')) ? '&via=' . get_option('include_tweet_via') : ''; //Twitterアカウントを含める
  ?>
  <div class="sns-btn<?php if (get_option('another_social') || $type == 'fab') { echo ' sns-dif'; } ?>">
    <?php if ($type == null) echo '<span class="sns-btn__title dfont">SHARE</span>'; ?>
      <ul>
        <!-- twitter -->
        <li class="tw sns-btn__item">
          <a href="http://twitter.com/share?url=<?php echo $encode_url; ?>&text=<?php echo $encode_title . $sitename . $tw_via; ?>" target="_blank" rel="nofollow noopener noreferrer">
            <?php fa_tag("twitter","twitter",true) ?>
            <span class="share_txt">ツイート</span>
          </a>
          <?php if (function_exists('scc_get_share_twitter')) {
              echo '<span class="scc dfont">' . scc_get_share_twitter() . '</span>';
            } 
          ?>
        </li>
        <!-- facebook -->
        <li class="fb sns-btn__item">
          <a href="http://www.facebook.com/share.php?u=<?php echo $encode_url; ?>&t=<?php echo $encode_title . $sitename; ?>" target="_blank" rel="nofollow noopener noreferrer">
            <?php fa_tag("facebook","facebook",true) ?>
            <span class="share_txt">シェア</span>
          </a>
          <?php if (function_exists('scc_get_share_facebook')) {
              echo '<span class="scc dfont">' . scc_get_share_facebook() . '</span>';
            }
          ?>
        </li>
        <!-- はてなブックマーク -->
        <li class="hatebu sns-btn__item">
          <a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $encode_url; ?>"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;" target="_blank" rel="nofollow noopener noreferrer">
            <i class="fa fa-hatebu"></i>
            <span class="share_txt">はてブ</span>
          </a>
          <?php if (function_exists('scc_get_share_hatebu')) {
            echo '<span class="scc dfont">' . scc_get_share_hatebu() . '</span>';
          }
        ?>
        </li>
        <!-- LINE -->
        <li class="line sns-btn__item">
          <a href="http://line.me/R/msg/text/?<?php echo $encode_url; ?>%0D%0A<?php echo $encode_title . $sitename; ?>" target="_blank" rel="nofollow noopener noreferrer">
            <?php if(get_option('use_fontawesome4')) : ?>
              <img src="<?php echo get_template_directory_uri() . '/library/images/line.svg'; ?>">
            <?php else: ?>
              <i class="fab fa-line"></i>
            <?php endif; ?>
            <span class="share_txt share_txt_line dfont">LINE</span>
          </a>
        </li>
        <!-- Pocket -->
        <li class="pkt sns-btn__item">
          <a href="http://getpocket.com/edit?url=<?php echo $encode_url; ?>&title=<?php echo $encode_title . $sitename; ?>" target="_blank" rel="nofollow noopener noreferrer">
            <?php fa_tag("get-pocket","get-pocket",true) ?>
            <span class="share_txt">Pocket</span>
          </a>
          <?php if (function_exists('scc_get_share_pocket')) {
            echo '<span class="scc dfont">' . scc_get_share_pocket() . '</span>';
          }
        ?>
        </li>
      </ul>
  </div>
  <?php //END シェアボタン
  }
}
/*********************
excerptの…を変更
 *********************/
function sng_excerpt_more($more)
{
  return ' ... ';
}
add_filter('excerpt_more', 'sng_excerpt_more');
?>
