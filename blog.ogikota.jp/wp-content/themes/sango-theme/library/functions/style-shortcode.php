<?php
/**
 *このファイルではショートコードの登録を行います
 */

 //ウィジェットでショートコードを有効に
add_filter('widget_text', 'do_shortcode');

//登録
add_shortcode('rate', 'sng_rate_box'); //評価ボックス
add_shortcode('value', 'sng_rate_inner'); //評価ボックスの中身
add_shortcode('kanren', 'sng_entry_link'); //横長の関連記事を出力
add_shortcode('card', 'sng_card_link'); //カードタイプの関連記事を出力
add_shortcode('card2', 'sng_longcard_link'); //カードタイプ（横長）の関連記事を出力
add_shortcode('catpost', 'output_cards_by'); //特定のカテゴリーの記事を好きな数だけ出力
add_shortcode('tagpost', 'output_cards_bytag'); //特定のタグの記事を好きな数だけ出力
add_shortcode('sanko', 'sng_othersite_link'); //他サイトへのリンクを出力
add_shortcode('sen', 'sen'); //線を引く
add_shortcode('tensen', 'tensen'); //点線を引く
add_shortcode('memo', 'memo_box'); //補足説明
add_shortcode('alert', 'alert_box'); //注意書き
add_shortcode('codebox', 'code_withtag'); //コード用のBOX
add_shortcode('say', 'say_what'); //会話形式の吹き出し
add_shortcode('cell', 'table_cell'); //横並び表示の中身
add_shortcode('yoko2', 'table_two'); //2列表示
add_shortcode('yoko3', 'table_three'); //3列表示
add_shortcode('mobile', 'only_mobile'); //モバイルでのみ表示
add_shortcode('pc', 'only_pc'); //PCでのみ表示
add_shortcode('category', 'only_cat'); //特定のカテゴリーでのみ表示
add_shortcode('onlytag', 'only_tag'); //特定のタグでのみ表示
add_shortcode('center', 'text_align_center'); //中身を中央寄せ
add_shortcode('box', 'sng_insert_box'); //ボックスを挿入
add_shortcode('btn', 'sng_insert_btn'); //ボタンを挿入
add_shortcode('list', 'sng_insert_list'); //ul,ol,liを装飾
add_shortcode('youtube', 'responsive_youtube'); //YouTubeをレスポンシブで挿入
add_shortcode('texton', 'text_on_image'); //画像の上に文字をのせる
add_shortcode('open', 'sng_insert_accordion'); //アコーディオン
add_shortcode('timeline', 'sng_insert_timeline'); //タイムライン全体を囲む
add_shortcode('tl', 'sng_insert_tl_parts'); //タイムライン個々の要素

/*********************
評価ボックス
 *********************/
//ボックス全体
function sng_rate_box($atts, $content = null)
{
  $title = isset($atts['title']) ? '<div class="rate-title has-fa-before dfont main-c-b">' . esc_attr($atts['title']) . '</div>' : '';
  $content = do_shortcode(shortcode_unautop($content));
  if ($content) {
    return $title . '<div class="rate-box">' . $content . '</div>';
  }
}
//行
function sng_rate_inner($atts, $content = null)
{
  if (isset($atts[0])) {
    $value = ($atts[0]);
    $s = '<i class="fa fa-star"></i>';
    $h = get_option('use_fontawesome4') ? '<i class="fa fa-star-half-o"></i>' : '<i class="fas fa-star-half-alt"></i>';
    $n = get_option('use_fontawesome4') ? '<i class="fa fa-star-o"></i>' : '<i class="fas fa-star rate-star-empty"></i>';
    if ($value == '5' || $value == '5.0') {
      $star = $s . $s . $s . $s . $s . ' (5.0)';
    } elseif ($value == '4.5') {
      $star = $s . $s . $s . $s . $h . ' (4.5)';
    } elseif ($value == '4' || $value == '4.0') {
      $star = $s . $s . $s . $s . $n . ' (4.0)';
    } elseif ($value == '3.5') {
      $star = $s . $s . $s . $h . $n . ' (3.5)';
    } elseif ($value == '3' || $value == '3.0') {
      $star = $s . $s . $s . $n . $n . ' (3.0)';
    } elseif ($value == '2.5') {
      $star = $s . $s . $h . $n . $n . ' (2.5)';
    } elseif ($value == '2' || $value == '2.0') {
      $star = $s . $s . $n . $n . $n . ' (2.0)';
    } elseif ($value == '1.5') {
      $star = $s . $h . $n . $n . $n . ' (1.5)';
    } else {
      $star = $s . $n . $n . $n . $n . ' (1.0)';
    }
    $endl = (isset($atts[1])) ? ' end-rate' : '';
    if ($content) {
      return '<div class="rateline' . $endl . '"><div class="rate-thing">' . $content . '</div><div class="rate-star dfont">' . $star . '</div></div>';
    }
  }
}

/*********************
関連記事
 *********************/
function sng_entry_link($atts)
{
  $output = '';
  $id = isset($atts['id']) ? esc_attr($atts['id']) : null;
  if ($id) {
    $ids = (explode(',', $id)); //一旦配列に
  }
  $target = isset($atts['target']) ? ' target="_blank"' : "";
  if (isset($ids)) {
    foreach ($ids as $eachid) {
      $img = (get_the_post_thumbnail($eachid)) ? get_the_post_thumbnail($eachid, 'thumb-160') : '<img src="' . featured_image_src('thumb-160', $eachid) . '">';
      $url = esc_url(get_permalink($eachid)); //URL
      $title = esc_attr(get_the_title($eachid));
      if ($url && $title) {
        $output .= <<<EOF
<a class="linkto table" href="{$url}"{$target}><span class="tbcell tbimg">{$img}</span><span class="tbcell tbtext">{$title}</span></a>
EOF;
      }
    } //endforeach
  } else { $output = '関連記事のIDを正しく入力してください';}
  return $output;
} //END get_entry_link

/*********************
カードタイプの関連記事
 *********************/
function sng_card_link($atts)
{
  $id = isset($atts['id']) ? esc_attr($atts['id']) : null;
  $output = '';
  if ($id) {
    $ids = (explode(',', $id)); //一旦配列に
  }
  $target = isset($atts['target']) ? ' target="_blank"' : "";
  if (isset($ids)) {
    foreach ($ids as $eachid) {
      $img = (get_the_post_thumbnail($eachid)) ? get_the_post_thumbnail($eachid, 'thumb-520') : '<img src="' . featured_image_src('thumb-520', $eachid) . '">';
      $url = esc_url(get_permalink($eachid)); //URL
      $title = esc_attr(get_the_title($eachid));
      if ($url && $title) {
          $output .= <<<EOF
      <a class="c_linkto" href="{$url}"{$target}>
        <span>{$img}</span>
        <span class="c_linkto_text">{$title}</span>
      </a>
EOF;
      } //endif
    } //endforeach
  } else { $output = '関連記事のIDを正しく入力してください';}
  return $output;
} //END get_entry_link

/*********************
カードタイプの関連記事（横長）
 *********************/
function sng_longcard_link($atts)
{
  $id = isset($atts['id']) ? esc_attr($atts['id']) : null;
  $output = '';
  if ($id) {
    $ids = (explode(',', $id)); //一旦配列に
  }
  $target = isset($atts['target']) ? ' target="_blank"' : "";
  if (isset($ids)) {
    foreach ($ids as $eachid) {
      $img = (get_the_post_thumbnail($eachid)) ? get_the_post_thumbnail($eachid, 'thumb-520') : '<img src="' . featured_image_src('thumb-520', $eachid) . '">';
      $url = esc_url(get_permalink($eachid)); //URL
      $title = esc_attr(get_the_title($eachid));
      $time = get_the_time('Y.m.d', $eachid);
      $icon_name = get_option('use_fontawesome4') ? '<i class="fa fa-clock-o"></i>' : '<i class="fas fa-clock"></i>';
      if ($url && $title) {
        $output .= <<<EOF
      <a class="c_linkto longc_linkto" href="{$url}"{$target}>
        <span class="longc_img">{$img}</span>
        <span class="longc_content c_linkto_text"><time class="longc_time dfont">{$icon_name} {$time}</time><span class="longc_title">{$title}</span></span>
      </a>
EOF;
      } //endif
    } //endforeach
  } else { $output = '関連記事のIDを正しく入力してください';}
  return $output;
} //END get_entry_link

/*********************
特定のカテゴリーの記事を好きな数だけ出力
 *********************/
function output_cards_by($atts)
{
  $num = isset($atts['num']) ? esc_attr($atts['num']) : '4'; //出力数。入力なしなら4
  $catid = isset($atts['catid']) ? explode(',', $atts['catid']) : null; //どのカテゴリーの記事を出力するか（複数指定を配列に）
  $notin = isset($atts['notin']) ? explode(',', $atts['notin']) : null; //除外するカテゴリー
  $orderby = isset($atts['orderby']) ? $atts['orderby'] : 'date';
  $order = isset($atts['order']) ? ($atts['order']) : "DESC";

  $type = 'kanren';
  if (isset($atts['type'])) {
    if ($atts['type'] == 'card') {
      $type = 'card';
    } elseif ($atts['type'] == 'card2') {
      $type = 'card2';
    }
  }
  if ($catid) {
    $output_posts = get_posts(array(
      'category__in' => $catid,
      'numberposts' => $num,
      'orderby' => $orderby,
      'order' => $order
    ));
  } else {
    $output_posts = get_posts(array(
      'category__not_in' => $notin,
      'numberposts' => $num,
      'orderby' => $orderby,
      'order' => $order
    ));
  }
  $output = "";
  if ($output_posts && $type == "card") {
    foreach ($output_posts as $post) {
      $output .= sng_card_link(array('id' => $post->ID));
    }
    $output = '<div class="catpost-cards flex flex-wrap space-between">'.$output.'</div>';
  } elseif ($output_posts && $type == "card2") {
    foreach ($output_posts as $post) {
      $output .= sng_longcard_link(array('id' => $post->ID));
    }
  } elseif ($output_posts && $type == "kanren") {
    foreach ($output_posts as $post) {
      $output .= sng_entry_link(array('id' => $post->ID));
    }
  } //endif output_posts
  return $output;
}

/*********************
特定のタグの記事を好きな数だけ出力
 *********************/
function output_cards_bytag($atts)
{
  $num = isset($atts['num']) ? esc_attr($atts['num']) : '4'; //出力数。入力なしなら4
  $tagid = isset($atts['id']) ? explode(',', $atts['id']) : null; //どのタグの記事を出力するか（複数指定を配列に）
  $postid = get_the_ID();
  $orderby = isset($atts['orderby']) ? $atts['orderby'] : 'date';
  $order = isset($atts['order']) ? ($atts['order']) : "DESC";

  $type = 'kanren';
  if (isset($atts['type'])) {
    if ($atts['type'] == 'card') {
      $type = 'card';
    } elseif ($atts['type'] == 'card2') {
      $type = 'card2';
    }
  }
  if ($tagid) {
    $output_posts = get_posts(array(
      'tag__in' => $tagid,
      'numberposts' => $num,
      'orderby' => $orderby,
      'exclude' => $postid,
      'order' => $order
    ));
    $output = "";
    if ($output_posts && $type == "card") {
      foreach ($output_posts as $post) {
        $output .= sng_card_link(array('id' => $post->ID));
      }
      $output = '<div class="catpost-cards flex flex-wrap space-between">'.$output.'</div>';
    } elseif ($output_posts && $type == "card2") {
      foreach ($output_posts as $post) {
        $output .= sng_longcard_link(array('id' => $post->ID));
      }
    } elseif ($output_posts && $type == "kanren") {
      foreach ($output_posts as $post) {
        $output .= sng_entry_link(array('id' => $post->ID));
      }
    } //endif output_posts
    return $output;
  } //endif num && tagid
}

/*********************
他サイトへのリンクカード
 *********************/
function sng_othersite_link($atts)
{
  $href = isset($atts['href']) ? esc_url($atts['href']) : null;
  $title = isset($atts['title']) ? esc_attr($atts['title']) : null;
  $site = isset($atts['site']) ? '<span>' . esc_attr($atts['site']) . '</span>' : "";
  $target = isset($atts['target']) ? 'target="_blank"' : "";
  $rel = isset($atts['rel']) ? ' rel="nofollow noopener noreferrer"' : ' rel="noopener noreferrer"';
  if ($href && $title) { //タイトルとURLがある場合のみ出力
      $output = <<<EOF
  <a class="reference table" href="{$href}" {$target}{$rel}>
    <span class="tbcell refttl">参考</span>
    <span class="tbcell refcite">{$title}{$site}</span>
  </a>
EOF;
    return $output;
  } else {
    return '<span class="red">参考記事のタイトルとURLを入力してください</span>';
  }
} //END sng_othersite_link

/*********************
線・点線を出力
 *********************/
function sen($atts) { return '<hr>'; }
function tensen($atts){ return '<hr class="dotted">'; }

/*********************
補足説明（メモ）
 *********************/
function memo_box($atts, $content = null)
{
  $title = isset($atts['title']) ? '<div class="memo_ttl dfont"> ' . esc_attr($atts['title']) . '</div>' : '';
  $class = isset($atts['class']) ? esc_attr($atts['class']) : null;
  if ($content) {
    $content = do_shortcode(shortcode_unautop($content));
    $output = <<<EOF
<div class="memo {$class}">{$title}{$content}</div>
EOF;
    return $output;
  }
}

/*********************
注意書き
 *********************/
function alert_box($atts, $content = null)
{
  $title = isset($atts['title']) ? '<div class="memo_ttl dfont"> ' . esc_attr($atts['title']) . '</div>' : '';
  if ($content) {
    $content = do_shortcode(shortcode_unautop($content));
    $output = <<<EOF
<div class="memo alert">{$title}{$content}</div>
EOF;
    return $output;
  }
}

/*********************
タグ付きのソースコード枠
 *********************/
function code_withtag($atts, $content = null)
{
  $title = isset($atts['title']) ? '<span><i class="fa fa-code"></i> ' . esc_attr($atts['title']) . '</span>' : '';
  if ($content) {
    $output = <<<EOF
  <div class="pre_tag">{$title}{$content}</div>
EOF;
    return $output;
  }
}
/*********************
会話ふきだし
 *********************/
function say_what($atts, $content = null)
{
  $img = (isset($atts['img'])) ? esc_url($atts['img']) : esc_url(get_option('say_image_upload'));
  $name = (isset($atts['name'])) ? esc_attr($atts['name']) : esc_attr(get_option('say_name'));
  if (isset($atts['from'])) {
    $from = ($atts['from'] == "right") ? "right" : "left"; //入力が無ければleftに
  } else {
    $from = "left";
  }
  if ($from == "right") { //右に吹き出し
    $output = <<<EOF
    <div class="say {$from}">
      <div class="chatting"><div class="sc">{$content}</div></div>
      <p class="faceicon"><img src="{$img}"><span>{$name}</span></p>
    </div>
EOF;
  } else { //左に吹き出し
    $output = <<<EOF
    <div class="say {$from}">
      <p class="faceicon"><img src="{$img}"><span>{$name}</span></p>
      <div class="chatting"><div class="sc">{$content}</div></div>
    </div>
EOF;
  } //endif
  return $output;
}

/*********************
テーブルのセル(後述の関数で利用)
 *********************/
function table_cell($atts, $content = null)
{
  $content = do_shortcode(shortcode_unautop($content));
  if ($content) {
    return '<div class="cell">' . $content . '</div>';
  }
}

/*********************
2列横並び
 *********************/
function table_two($atts, $content = null)
{
  $layout = ($atts && $atts[0] == "responsive") ? "tbrsp" : "";
  $content = do_shortcode(shortcode_unautop($content));
  if ($content) {
    return '<div class="shtb2 ' . $layout . '">' . $content . '</div>';
  }
}

/*********************
3列横並び
 *********************/
function table_three($atts, $content = null)
{
  $layout = ($atts && $atts[0] == "responsive") ? "tbrsp" : "";
  $content = do_shortcode(shortcode_unautop($content));
  if ($content) {
    return '<div class="shtb3 ' . $layout . '">' . $content . '</div>';
  }
}

/*********************
モバイルでのみ表示
 *********************/
function only_mobile($atts, $content = null)
{
  if ($content && wp_is_mobile()) {
    $content = do_shortcode(shortcode_unautop($content));
    return $content;
  }
}

/*********************
PCでのみ表示
 *********************/
function only_pc($atts, $content = null)
{
  if ($content && !wp_is_mobile()) {
    $content = do_shortcode(shortcode_unautop($content));
    return $content;
  }
}
/*********************
特定のカテゴリーでのみ表示
 *********************/
function only_cat($atts, $content = null)
{
  $cat_id = (isset($atts['id'])) ? $atts['id'] : null;
  $cat_id = explode(',', $cat_id);
  if ($content && in_category($cat_id)) {
    $content = do_shortcode(shortcode_unautop($content));
    return $content;
  }
}
/*********************
特定のタグでのみ表示
 *********************/
function only_tag($atts, $content = null)
{
  $tag_id = (isset($atts['id'])) ? $atts['id'] : null;
  $tag_id = explode(',', $tag_id);
  if ($content && has_tag($tag_id)) {
    $content = do_shortcode(shortcode_unautop($content));
    return $content;
  }
}

/*********************
中身を中央寄せにするコード
 *********************/
function text_align_center($atts, $content = null)
{
  if ($content) {
    $content = do_shortcode(shortcode_unautop($content));
    return '<div class="center">' . $content . '</div>';
  }
}

/*********************
ボックスデザインのショートコード
 *********************/
function sng_insert_box($atts, $content = null)
{
  if (isset($atts) && $content) {
    $class = (isset($atts['class'])) ? esc_attr($atts['class']) : null;
    $title = (isset($atts['title'])) ? $atts['title'] : null;
    $content = do_shortcode(shortcode_unautop($content));
    $output = '';
    if (!$title && $class) { //タイトルが無いとき
      $output = <<<EOF
  <div class="sng-box {$class}">{$content}</div>
EOF;
    } elseif ($title && $class) { //タイトルがあるとき
      $output = <<<EOF
  <div class="sng-box {$class}"><div class="box-title">{$title}</div><div class="box-content">{$content}</div></div>
EOF;
    }
    return $output;
  } //end if atts && content
}

/*********************
ボタンデザインのショートコード
 *********************/
function sng_insert_btn($atts, $content = null)
{
  if (isset($atts) && $content) {
    $href = (isset($atts['href'])) ? 'href="' . esc_url($atts['href']) . '"' : null;
    $class = (isset($atts['class'])) ? esc_attr($atts['class']) : null;
    $target = '';
    if (isset($atts['target'])) {
      $target = ($atts['target'] == "_blank") ? ' target="_blank"' : "";
    }
    $rel = '';
    if (isset($atts['rel'])) {
      $rel = ($atts['rel'] == "nofollow") ? ' rel="nofollow noopener noreferrer"' : ' rel="noopener noreferrer"';
    }
    $yoko = '';
    if (isset($atts['0'])) {
      $yoko = ($atts['0'] == "yoko") ? "yoko" : null; //横並びさせるか
    }
    if ($class) {
      $output = (!$yoko) ? '<p>' : ''; //横並びならpなし
      $output .= <<<EOF
<a {$href} class="btn {$class}"{$target}{$rel}>{$content}</a>
EOF;
      if (!$yoko) {$output .= '</p>';} //横並びならpなし
      return $output;
    } //end if class
  } //end if atts && content
}

/*********************
ul ol liのショートコード
 *********************/
function sng_insert_list($atts, $content = null)
{
  if ($content) {
    //ul内にpタグが入ってしまう場合に以下のコメントアウトを解除
    //$search = array('<p>','</p>');
    //$content = str_replace($search,'',$content);
    $class = (isset($atts['class'])) ? esc_attr($atts['class']) : null;
    $title = (isset($atts['title'])) ? '<div class="list-title">' . esc_attr($atts['title']) . '</div>' : null;
    return '<div class="' . $class . '">' . $title . $content . '</div>';
  } //endif content
}
/*********************
YouTubeをレスポンシブに
 *********************/
function responsive_youtube($atts, $content = null)
{
  if ($content) {
    return '<div class="youtube">' . $content . '</div>';
  }

}

/*********************
画像の上に文字をのせる
 *********************/
function text_on_image($atts, $content = null)
{
  $src = (isset($atts['img'])) ? esc_url($atts['img']) : null;
  $title = (isset($atts['title'])) ? esc_attr($atts['title']) : "";
  if ($src) {
    $output = <<<EOF
<div class="textimg"><p class="dfont">{$title}</p><img src="{$src}"></div>
EOF;
    return $output;
  }
}
/*********************
アコーディオン
 *********************/
function sng_insert_accordion($atts, $content = null)
{
  $title = isset($atts['title']) ? $atts['title'] : null;
  $content = do_shortcode(shortcode_unautop($content));
  $randid = mt_rand(1, 99999);
  if ($title) {
    return '<div class="accordion main_c"><input type="checkbox" id="label' . $randid . '" class="accordion_input" /><label for="label' . $randid . '">' . $title . '</label><div class="accordion_content">' . $content . '</div></div>';
  } else {
    return '<span class="red">アコーディオンにtitleを入力してください</span>';
  }
}
/*********************
タイムライン
 *********************/
function sng_insert_timeline($atts, $content = null)
{
  if ($content) {
    $content = do_shortcode(shortcode_unautop($content));
    $output = '<div class="tl">' . $content . '</div>';
    return $output;
  }
}
function sng_insert_tl_parts($atts, $content = null)
{
  $label = isset($atts['label']) ? '<div class="tl_label">' . $atts['label'] . '</div>' : null;
  $title = isset($atts['title']) ? '<div class="tl_title">' . $atts['title'] . '</div>' : null;
  if ($content) {
    $content = do_shortcode(shortcode_unautop($content));
    $content = '<div class="tl_main">' . $content . '</div>';
  }
  $marker = '<div class="tl_marker main-bdr main-bc"></div>';
  return '<div class="tl-content main-bdr">' . $label . $title . $content . $marker . '</div>';
}
