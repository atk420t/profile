<?php
set_time_limit(10000);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/4.0.11/css/tableexport.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<style>
body,thead{
  background: #f1f1f1;
}
.table-bordered>tbody>tr>td,.table-bordered>thead>tr>th{
  white-space: nowrap;
}
table{
  table-layout: auto!important;
}
</style>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/2.0.3/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.30.7/js/jquery.tablesorter.min.js"></script>
<h1>WP Post Manager</h1>
<!-- タブ・メニュー -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#post-table" data-toggle="tab">投稿</a></li>
  <li><a href="#page-table" data-toggle="tab">固定ページ</a></li>
</ul>
<!-- タブ内容 -->
<div class="tab-content">
  <div class="tab-pane active" id="post-table">
    <?php

    $wppm1 = get_option('wp-p-m-1');
    $wppm2 = get_option('wp-p-m-2');
    $wppm3 = get_option('wp-p-m-3');
    $wppm4 = get_option('wp-p-m-4');
    $wppm5 = get_option('wp-p-m-5');
    $wppm6 = get_option('wp-p-m-6');
    $wppm7 = get_option('wp-p-m-7');
    $wppm8 = get_option('wp-p-m-8');
    $wppm9 = get_option('wp-p-m-9');
    $wppm10 = get_option('wp-p-m-10');

    if ($wppm4 == "1") {
      $order = "DESC";
      $orderby = "date";
    }elseif ($wppm4 == "2") {
      $order = "ASC";
      $orderby = "date";
    }elseif ($wppm4 == "3") {
      $order = "DESC";
      $orderby = "modified";
    }elseif ($wppm4 == "4") {
      $order = "ASC";
      $orderby = "modified";
    }else{
      $order = "DESC";
      $orderby = "author";
    }

    if ($wppm6 == "1" ) {
      $post_status = "publish,draft";
    }else{
      $post_status = "publish";
    }

    if(!($wppm9 && $wppm9 == 0)){
      $cat = $wppm9;
    }

    if(!($wppm10 && $wppm10 == 0)){
      $link_show = $wppm10;
    }

    $is_jetpack_stats_module_active = class_exists('jetpack') && Jetpack::is_module_active('stats');

    /*SNS関連*/
     if(!(function_exists('get_scc_twitter'))){//SNSカウントキャッシュが有効化されていればスルー
      if ($wppm2 == "1"){
        $HA_URL = "http://api.b.st-hatena.com/entry.count?url=";
        $FA_URL = "http://graph.facebook.com/?id=";
        $TW_URL = "http://jsoon.digitiminimi.com/twitter/count.json?url=";
      }
    }
    /*SNS関連*/

    if($cat){
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => $wppm8,
        'post_status' => $post_status,
        'order'=>$order,
        'orderby'=>$orderby,
        'cat'=>$cat
      );
    }else{
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => $wppm8,
        'post_status' => $post_status,
        'order'=>$order,
        'orderby'=>$orderby  
      );
    }

    ?>
    <?php $query = new WP_Query( $args ); ?>
    <?php if( $query->have_posts() ) : ?>
      <?php
      echo '<table class="table table-bordered table-fixed" id="wp-post-manager">';
      echo "<thead><tr><th>インデックス</th><th>タイトル（H1）</th><th>カテゴリ</th>";

      /*タグ*/
      if ($wppm7 == "1") {
        echo "<th>タグ</th>";
      }
      /*タグ*/

      echo "<th>日付</th>";

      /*PV*/
      if($is_jetpack_stats_module_active){
        echo "<th>全期間</th><th>月</th><th>週</th><th>今日</th>";
      }
      /*PV*/

      /*見出し*/
      if ($wppm1 == "1") {
        echo '<th>H2</th><th>H3</th><th>H4</th>';
      }
      /*見出し*/

      /*SNS関連*/
      if ($wppm2 == "1"){
        echo '<th>Twitter</th><th>Facebook</th><th>Hatena</th>';
      }
      /*SNS関連*/

      /*内部リンク数と外部リンク数*/
      if ($wppm3 == "2" || $wppm3 == "3") {
        echo '<th>内部リンク数</th><th>外部リンク数</th>';
      }
      /*内部リンク数と外部リンク数*/

      /*内部リンク数と外部リンク数*/
      if ($link_show) {
        echo '<th>内部リンクアンカーテキスト</th><th>外部リンクアンカーテキスト</th>';
      }
      /*内部リンク数と外部リンク数*/

      echo "</tr></thead><tbody>";
      $index = 0;
      ?>
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php
        $index++;
        $url = get_the_permalink();
        $post_id = get_the_ID();
        /*SNS関連*/
        if(!(function_exists('get_scc_twitter'))){//SNSカウントキャッシュが有効化されていればスルー
        if ($wppm2 == "1"){
          if ($wppm3 == "3"){
            $sns_url_list = array($TW_URL.$url,$FA_URL.rawurlencode($url),$HA_URL.$url,$url);
          }else{
            $sns_url_list = array($TW_URL.$url,$FA_URL.rawurlencode($url),$HA_URL.$url);
          }
          $sns_return_list = multi_curl_execute($sns_url_list);
        }else if($wppm3 == "3"){
          $sns_url_list = array($url);
          $sns_return_list = multi_curl_execute($sns_url_list);
        }else{}//ここ見直す
      }
        /*SNS関連*/

        echo "<tr>";

        /*インデックス*/
        echo '<td>'.$index.'<br><br><a href="'.get_edit_post_link().'" target="_blank"><button class="button button-primary button-large">編集</button></a></td>';
        /*インデックス*/

        /*タイトル*/
        echo '<td><a href="'.$url.'" target="_blank">'.get_the_title().'</a></td>';
        /*タイトル*/

        /*カテゴリ*/
        echo "<td>";
        $category = get_the_category();
        if ($category) {
          foreach ($category as $c){
            echo $c->cat_name;
            echo "<br>";
          }
          echo "</td>";
        }
        /*カテゴリ*/

        /*タグ*/
        if ($wppm7 == "1") {
          echo "<td>";
          $tag = get_the_tags();
          if ($tag) {
            foreach($tag as $tags) {
              echo $tags->name;
              echo "<br>";
            }
          }
          echo "</td>";
        }
        /*タグ*/

        /*日付*/
        echo "<td>";
        the_time('Y年n月j日');
        echo "</td>";
        /*日付*/

        /*PV*/
        if($is_jetpack_stats_module_active){

          $views_all = 0;
          $views_monthly = 0;
          $views_weekly = 0;
          $views_daily = 0;

          //全体のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => -1, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_all = $jetpack_views[0]['views'];
          }
          //直近30日のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => 30, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_monthly = $jetpack_views[0]['views'];
          }
          //直近7日のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => 7, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_weekly = $jetpack_views[0]['views'];
          }
          //今日のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => 1, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_daily = $jetpack_views[0]['views'];
          }

          echo "<td>".$views_all."</td><td>".$views_monthly."</td><td>".$views_weekly."</td><td>".$views_daily."</td>";
        }
        /*PV*/

        $content = get_the_content();

        /*見出し*/
        if ($wppm1 == "1") {

          /*H2*/
          echo "<td>";
          preg_match_all('/<h2.*?>(.*?)<\/h2>/u', $content, $h2_list);
          foreach ($h2_list[1] as $value) {
            echo $value."<br>";
          }
          echo "</td>";
          /*H2*/

          /*H3*/
          echo "<td>";
          preg_match_all('/<h3.*?>(.*?)<\/h3>/u', $content, $h3_list);
          foreach ($h3_list[1] as $value) {
            echo $value."<br>";
          }
          echo "</td>";
          /*H3*/

          /*H4*/
          echo "<td>";
          preg_match_all('/<h4.*?>(.*?)<\/h4>/u', $content, $h4_list);
          foreach ($h4_list[1] as $value) {
            echo $value."<br>";
          }
          echo "</td>";
          /*H4*/

        }
        /*見出し*/

        /*SNSシェア数*/
        if ($wppm2 == "1") {

          /*ツイッター*/
          echo "<td>";
           if(function_exists('get_scc_twitter')){
            $tw_count = get_scc_twitter();
           }else{
            $tw_count = json_decode($sns_return_list[0],true)["count"];
            if($tw_count == -1)  $tw_count = "0";
           }
          echo $tw_count;
          echo "</td>";
          /*ツイッター*/

          /*フェイスブック*/
          echo "<td>";
          if(function_exists('get_scc_facebook')){
            $fa_count = get_scc_facebook();
          }else{
            $fa_json = json_decode($sns_return_list[1], true);
            if (isset($fa_json['share']['share_count'])){
              $fa_count = $fa_json['share']['share_count'];
            }else {
              $fa_count = 0;
            }
          }
          echo $fa_count;
          echo "</td>";
          /*フェイスブック*/

          /*はてな*/
          echo "<td>";
          if(function_exists('get_scc_hatebu')){
            $hatena_count = get_scc_hatebu();
          }else{
            $hatena_count = $sns_return_list[2];
            if(!$hatena_count) $hatena_count = "0";
          }
          echo $hatena_count;
          echo "</td>";
          /*はてな*/

        }
        /*SNSシェア数*/

        /*内部リンク数と外部リンク数*/
        if ($wppm3 == "2" || $wppm3 == "3") {
          /*内部リンクと外部リンクの数計算処理*/
          preg_match("/(http|https):\/\/([-._a-z\d]+\.[a-z]{2,4})([\w,.:;&=+*%$#!@()~\'\/-]*)\??([\w,.:;&=+*%$#!?@()~\'\/-]*)/",$url,$domain);
          if ($wppm3 == "2"){
            preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $content, $href);
          }else if($wppm2 == "1"){
            preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $sns_return_list[3], $href);
          }else{
            preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $sns_return_list[0], $href);
          }
          $domain = get_bloginfo('url');
          $href_shiwake = $href[0];
          $naibu = 0;
          $gaibu = 0;
          if($href_shiwake){
            foreach($href_shiwake as $value){
              if(substr($value,0,strlen($domain)) === $domain){
                $naibu++;
              }else{
                $gaibu++;
              }
            }
          }
          /*内部リンクと外部リンクの数処理*/

          /*内部リンク数*/
          echo "<td>";
          echo $naibu;
          echo "</td>";
          /*内部リンク数*/

          /*外部リンク数*/
          echo "<td>";
          echo $gaibu;
          echo "</td>";
          /*外部リンク数*/

        }
        /*内部リンク数と外部リンク数*/

        /*アンカーテキスト*/
          if ($link_show) {
            preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $content, $href);
            $domain = get_bloginfo('url');
            $href_shiwake = $href[1];
            $naibu_a = [];
            $gaibu_a = [];
            if($href_shiwake){
              foreach($href_shiwake as $key => $value){
                if(substr($value,0,strlen($domain)) === $domain){
                  $naibu_a[] = $href[0][$key];
                }else{
                  $gaibu_a[] = $href[0][$key];
                }
              }
              if ($naibu_a != []) {
                $naibu_a_text = implode('<br>', $naibu_a);
              }
              if ($gaibu_a != []) {
                $gaibu_a_text = implode('<br>', $gaibu_a);
              }
            }
            /*内部リンクアンカーテキスト*/
            echo "<td>";
            if ($naibu_a_text) {
              echo $naibu_a_text;
            }
            echo "</td>";
            /*内部リンクアンカーテキスト*/
            
            /*外部リンクアンカーテキスト*/
            echo "<td>";
            if ($gaibu_a_text) {
              echo $gaibu_a_text;
            }
            echo "</td>";
            /*外部リンクアンカーテキスト*/
          }
          /*アンカーテキスト*/

        echo "</tr>";
        ?>
      <?php endwhile; wp_reset_postdata(); ?>
      <?php echo "</tbody></table>"; ?>
    <?php else : ?>
      記事はありません
    <?php endif; ?>
  </div>
  <div class="tab-pane" id="page-table">
    <?php if($wppm5 == "1") : ?>
      <?php
      $args = array(
        'post_type' => 'page',
        'posts_per_page' => $wppm8,
        'post_status' => $post_status,
        'order'=>$order,
        'orderby'=>$orderby  
      );
      ?>
      <?php $query = new WP_Query( $args ); ?>
      <?php if( $query->have_posts() ) : ?>
        <?php
        echo '<table class="table table-bordered table-fixed" id="wp-post-manager">';
        echo "<thead><tr><th>インデックス</th><th>タイトル（H1）</th>";
        echo "<th>日付</th>";

        /*PV*/
      	if($is_jetpack_stats_module_active){
      		echo "<th>全期間</th><th>月</th><th>週</th><th>今日</th>";
      	}
      	/*PV*/

        /*見出し*/
        if ($wppm1 == "1") {
          echo '<th>H2</th><th>H3</th><th>H4</th>';
        }
        /*見出し*/

        /*SNS関連*/
        if ($wppm2 == "1"){
          echo '<th>Twitter</th><th>Facebook</th><th>Hatena</th>';
        }
        /*SNS関連*/

        /*内部リンク数と外部リンク数*/
        if ($wppm3 == "2" || $wppm3 == "3") {
          echo '<th>内部リンク数</th><th>外部リンク数</th>';
        }
        /*内部リンク数と外部リンク数*/

        /*内部リンク数と外部リンク数*/
        if ($link_show) {
          echo '<th>内部リンクアンカーテキスト</th><th>外部リンクアンカーテキスト</th>';
        }
        /*内部リンク数と外部リンク数*/

        echo "</tr></thead><tbody>";
        $index = 0;
        ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <?php
          $index++;
          $url = get_the_permalink();
          /*SNS関連*/
          if ($wppm2 == "1"){
            if ($wppm3 == "3"){
              $sns_url_list = array($TW_URL.$url,$FA_URL.rawurlencode($url),$HA_URL.$url,$url);
            }else{
              $sns_url_list = array($TW_URL.$url,$FA_URL.rawurlencode($url),$HA_URL.$url);
            }
            $sns_return_list = multi_curl_execute($sns_url_list);
          }else if($wppm3 == "3"){
            $sns_url_list = array($url);
            $sns_return_list = multi_curl_execute($sns_url_list);
          }else{}
          /*SNS関連*/

          echo "<tr>";

          /*インデックス*/
          echo "<td>".$index."</td>";
          /*インデックス*/

          /*タイトル*/
          echo '<td><a href="'.$url.'" target="_blank">'.get_the_title().'</a></td>';
          /*タイトル*/

          /*日付*/
          echo "<td>";
          the_time('Y年n月j日');
          echo "</td>";
          /*日付*/

          /*PV*/
        if($is_jetpack_stats_module_active){

          $views_all = 0;
          $views_monthly = 0;
          $views_weekly = 0;
          $views_daily = 0;

          //全体のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => -1, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_all = $jetpack_views[0]['views'];
          }
          //直近30日のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => 30, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_monthly = $jetpack_views[0]['views'];
          }
          //直近7日のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => 7, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_weekly = $jetpack_views[0]['views'];
          }
          //今日のPVを取得
          $jetpack_views = stats_get_csv('postviews', array('days' => 1, 'limit' => 1, 'post_id' => $post_id ));
          if (isset($jetpack_views[0]['views'])) {
            $views_daily = $jetpack_views[0]['views'];
          }

          echo "<td>".$views_all."</td><td>".$views_monthly."</td><td>".$views_weekly."</td><td>".$views_daily."</td>";
        }
        /*PV*/
        

          $content = get_the_content();

          /*見出し*/
          if ($wppm1 == "1") {

            /*H2*/
            echo "<td>";
            preg_match_all('/<h2.*?>(.*?)<\/h2>/u', $content, $h2_list);
            foreach ($h2_list[1] as $value) {
              echo $value."<br>";
            }
            echo "</td>";
            /*H2*/

            /*H3*/
            echo "<td>";
            preg_match_all('/<h3.*?>(.*?)<\/h3>/u', $content, $h3_list);
            foreach ($h3_list[1] as $value) {
              echo $value."<br>";
            }
            echo "</td>";
            /*H3*/

            /*H4*/
            echo "<td>";
            preg_match_all('/<h4.*?>(.*?)<\/h4>/u', $content, $h4_list);
            foreach ($h4_list[1] as $value) {
              echo $value."<br>";
            }
            echo "</td>";
            /*H4*/

          }
          /*見出し*/

          /*SNSシェア数*/
          if ($wppm2 == "1") {

            /*ツイッター*/
            echo "<td>";
            $tw_count = json_decode($sns_return_list[0],true)["count"];
            if($tw_count == -1)  $tw_count = "0";
            echo $tw_count;
            echo "</td>";
            /*ツイッター*/

            /*フェイスブック*/
            echo "<td>";
            $fa_json = json_decode($sns_return_list[1], true);
            if (isset($fa_json['share']['share_count'])){
              $fa_count = $fa_json['share']['share_count'];
            }else {
              $fa_count = 0;
            }
            echo $fa_count;
            echo "</td>";
            /*フェイスブック*/

            /*はてな*/
            echo "<td>";
            $hatena_count = $sns_return_list[2];
            if(!$hatena_count)  $hatena_count = "0";
            echo $hatena_count;
            echo "</td>";
            /*はてな*/

          }
          /*SNSシェア数*/

          /*内部リンク数と外部リンク数*/
          if ($wppm3 == "2" || $wppm3 == "3") {
            /*内部リンクと外部リンクの数計算処理*/
            preg_match("/(http|https):\/\/([-._a-z\d]+\.[a-z]{2,4})([\w,.:;&=+*%$#!@()~\'\/-]*)\??([\w,.:;&=+*%$#!?@()~\'\/-]*)/",$url,$domain);
            if ($wppm3 == "2"){
              preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $content, $href);
            }else if($wppm2 == "1"){
              preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $sns_return_list[3], $href);
            }else{
              preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $sns_return_list[0], $href);
            }
            $domain = get_bloginfo('url');
            $href_shiwake = $href[0];
            $naibu = 0;
            $gaibu = 0;
            if($href_shiwake){
              foreach($href_shiwake as $value){
                if(substr($value,0,strlen($domain)) === $domain){
                  $naibu++;
                }else{
                  $gaibu++;
                }
              }
            }
            /*内部リンクと外部リンクの数処理*/

            /*内部リンク数*/
            echo "<td>";
            echo $naibu;
            echo "</td>";
            /*内部リンク数*/

            /*外部リンク数*/
            echo "<td>";
            echo $gaibu;
            echo "</td>";
            /*外部リンク数*/

          }
          /*内部リンク数と外部リンク数*/

          /*アンカーテキスト*/
          if ($link_show) {
            preg_match_all("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?[^>]*>(.*?)<\/a>/ims", $content, $href);
            $domain = get_bloginfo('url');
            $href_shiwake = $href[1];
            $naibu_a_ko = [];
            $gaibu_a_ko = [];
            if($href_shiwake){
              foreach($href_shiwake as $key => $value){
                if(substr($value,0,strlen($domain)) === $domain){
                  $naibu_a_ko[] = $href[0][$key];
                }else{
                  $gaibu_a_ko[] = $href[0][$key];
                }
              }
              if ($naibu_a_ko != []) {
                $naibu_a_text_ko = implode('<br>', $naibu_a_ko);
              }
              if ($gaibu_a != []) {
                $gaibu_a_text_ko = implode('<br>', $gaibu_a_ko);
              }
            }
            /*内部リンクアンカーテキスト*/
            echo "<td>";
            if ($naibu_a_text_ko) {
              echo $naibu_a_text_ko;
            }
            echo "</td>";
            /*内部リンクアンカーテキスト*/
            
            /*外部リンクアンカーテキスト*/
            echo "<td>";
            if ($gaibu_a_text_ko) {
              echo $gaibu_a_text_ko;
            }
            echo "</td>";
            /*外部リンクアンカーテキスト*/
          }
          /*アンカーテキスト*/

          echo "</tr>";
          ?>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php echo "</tbody></table>"; ?>
      <?php else : ?>
        <h3>記事はありません</h3>
      <?php endif; ?>
    <?php else : ?>
      <h3>設定で固定ページの表示を有効化出来ます</h3>
    <?php endif; ?>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.11.13/xlsx.core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/4.0.11/js/tableexport.min.js"></script>
<script>
  $(function(){
    $(".table").tableExport({
      formats: ["xlsx","csv"], 
      bootstrap: true,
      position: "top",
      fileName: "id"
    });
    $(".table").tablesorter();
    $(".table").floatThead({
      top: 32,
      responsiveContainer:function(){
        return $(".table").closest('.table-responsive');
      }});
  });
</script>