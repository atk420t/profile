<?php
/**
 * このファイルではクラシックエディターのスタイル設定を行っています
 */
function sng_editor_setting($init)
{
  //ビジュアルエディターの選択肢からh1見出しを削除（h1は記事本文では使用しない）
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Preformatted=pre';
  
  $style_formats_image = array(
    'title' => '画像のスタイル',
    'items' => array(
      array(
        'title' => '画像を小さく',
        'selector' => 'img',
        'classes' => 'img_so_small',
      ),
      array(
        'title' => '画像を少し小さく',
        'selector' => 'img',
        'classes' => 'img_small',
      ),
      array(
        'title' => '画像を線で囲む',
        'selector' => 'img',
        'classes' => 'img_border',
      ),
      array(
        'title' => '画像に影をつける',
        'selector' => 'img',
        'classes' => 'shadow',
      ),
      array(
        'title' => '画像に大きめの影',
        'selector' => 'img',
        'classes' => 'bigshadow',
      ),
    )
  );

  $style_formats_typography = array(
    'title' => '文字のスタイル',
    'items' => array(
      array(
        'title' => '文字小さめ',
        'inline' => 'span',
        'classes' => 'small',
      ),
      array(
        'title' => '文字大きめ',
        'inline' => 'span',
        'classes' => 'big',
      ),
      array(
        'title' => '文字特大',
        'inline' => 'span',
        'classes' => 'sobig',
      ),
      array(
        'title' => '文字（赤）',
        'inline' => 'span',
        'classes' => 'red',
      ),
      array(
        'title' => '文字（青）',
        'inline' => 'span',
        'classes' => 'blue',
      ),
      array(
        'title' => '文字（緑）',
        'inline' => 'span',
        'classes' => 'green',
      ),
      array(
        'title' => '文字（オレンジ）',
        'inline' => 'span',
        'classes' => 'orange',
      ),
      array(
        'title' => '文字（シルバー）',
        'inline' => 'span',
        'classes' => 'silver',
      ),
      array(
        'title' => '文字（メインカラー）',
        'inline' => 'span',
        'classes' => 'main-c',
      ),
      array(
        'title' => '文字（アクセントカラー）',
        'inline' => 'span',
        'classes' => 'accent-c',
      ),
      array(
        'title' => '蛍光ペン（青）',
        'inline' => 'span',
        'classes' => 'keiko_blue',
      ),
      array(
        'title' => '蛍光ペン（黄）',
        'inline' => 'span',
        'classes' => 'keiko_yellow',
      ),
      array(
        'title' => '蛍光ペン（緑）',
        'inline' => 'span',
        'classes' => 'keiko_green',
      ),
      array(
        'title' => '蛍光ペン（赤）',
        'inline' => 'span',
        'classes' => 'keiko_red',
      ),
      array(
        'title' => 'ラベル（メインカラー）',
        'inline' => 'span',
        'classes' => 'labeltext main-bc',
      ),
      array(
        'title' => 'ラベル（アクセントカラー）',
        'inline' => 'span',
        'classes' => 'labeltext accent-bc',
      ),
      array(
        'title' => '背景をうっすら灰色に',
        'inline' => 'span',
        'classes' => 'haiiro',
      ),
    )
  );

  $style_formats_headlines = array(
    'title' => '見出し',
    'items' => array(
      array(
        'title' => 'Q&Aの「Q」',
        'block' => 'p',
        'classes' => 'hh hhq',
      ),
      array(
        'title' => 'Q&Aの「A」',
        'block' => 'p',
        'classes' => 'hh hha',
      ),
      array(
        'title' => '見出し1：下線',
        'block' => 'p',
        'classes' => 'hh hh1',
      ),
      array(
        'title' => '見出し2：点線下線',
        'block' => 'p',
        'classes' => 'hh hh2 main-c main-bdr',
      ),
      array(
        'title' => '見出し3：二重線下線',
        'block' => 'p',
        'classes' => 'hh hh3 main-bdr',
      ),
      array(
        'title' => '見出し4：上下線',
        'block' => 'p',
        'classes' => 'hh hh4 main-bdr main-c',
      ),
      array(
        'title' => '見出し5：塗りつぶし',
        'block' => 'p',
        'classes' => 'hh hh5 pastel-bc',
      ),
      array(
        'title' => '見出し6：囲い枠',
        'block' => 'p',
        'classes' => 'hh hh6 main-c main-bdr',
      ),
      array(
        'title' => '見出し7：背景塗りと下線',
        'block' => 'p',
        'classes' => 'hh hh7 pastel-bc main-bdr',
      ),
      array(
        'title' => '見出し8：オレンジ見出し',
        'block' => 'p',
        'classes' => 'hh hh8',
      ),
      array(
        'title' => '見出し9：影付き塗りつぶし',
        'block' => 'p',
        'classes' => 'hh hh9 pastel-bc',
      ),
      array(
        'title' => '見出し10：タグ風',
        'block' => 'p',
        'classes' => 'hh hh10 pastel-bc',
      ),
      array(
        'title' => '見出し11：吹き出し風',
        'block' => 'p',
        'classes' => 'hh hh11',
      ),
      array(
        'title' => '見出し12：ステッチ風',
        'block' => 'p',
        'classes' => 'hh hh12',
      ),
      array(
        'title' => '見出し13：ステッチ白',
        'block' => 'p',
        'classes' => 'hh hh13',
      ),
      array(
        'title' => '見出し14：角がはがれかけ',
        'block' => 'p',
        'classes' => 'hh hh14',
      ),
      array(
        'title' => '見出し15：片側折れ',
        'block' => 'p',
        'classes' => 'hh hh15',
      ),
      array(
        'title' => '見出し16：片側折れ（別色）',
        'block' => 'p',
        'classes' => 'hh hh16',
      ),
      array(
        'title' => '見出し17：色が変わる下線',
        'block' => 'p',
        'classes' => 'hh hh17',
      ),
      array(
        'title' => '見出し18：色が変わる下線2',
        'block' => 'p',
        'classes' => 'hh hh18',
      ),
      array(
        'title' => '見出し19：下線やじるし',
        'block' => 'p',
        'classes' => 'hh hh19',
      ),
      array(
        'title' => '見出し20：背景ストライプ',
        'block' => 'p',
        'classes' => 'hh hh20',
      ),
      array(
        'title' => '見出し21：背景ストライプ2',
        'block' => 'p',
        'classes' => 'hh hh21',
      ),
      array(
        'title' => '見出し22：ストライプ＋上下線',
        'block' => 'p',
        'classes' => 'hh hh22',
      ),
      array(
        'title' => '見出し23：ストライプの下線',
        'block' => 'p',
        'classes' => 'hh hh23',
      ),
      array(
        'title' => '見出し24：両端線のばし',
        'block' => 'p',
        'classes' => 'hh hh24',
      ),
      array(
        'title' => '見出し25：線を交差',
        'block' => 'p',
        'classes' => 'hh hh25',
      ),
      array(
        'title' => '見出し26：大カッコで囲う',
        'block' => 'p',
        'classes' => 'hh hh26',
      ),
      array(
        'title' => '見出し27：一文字目だけ特大',
        'block' => 'p',
        'classes' => 'hh hh27',
      ),
      array(
        'title' => '見出し28：消えていく下線',
        'block' => 'p',
        'classes' => 'hh hh28',
      ),
      array(
        'title' => '見出し29：背景グラデーション',
        'block' => 'p',
        'classes' => 'hh hh29',
      ),
      array(
        'title' => '見出し30：チェックマーク',
        'block' => 'p',
        'classes' => 'hh hh30',
      ),
      array(
        'title' => '見出し31：シェブロンマーク',
        'block' => 'p',
        'classes' => 'hh hh31',
      ),
      array(
        'title' => '見出し32：フラット塗りつぶし',
        'block' => 'p',
        'classes' => 'hh hh32',
      ),
      array(
        'title' => '見出し33：角丸ぬりつぶし',
        'block' => 'p',
        'classes' => 'hh hh33',
      ),
      array(
        'title' => '見出し34：肉球',
        'block' => 'p',
        'classes' => 'hh hh34',
      ),
      array(
        'title' => '見出し35：リボン（1行のみ）',
        'block' => 'p',
        'classes' => 'hh hh35',
      ),
      array(
        'title' => '見出し36：片側リボン（1行のみ）',
        'block' => 'p',
        'classes' => 'hh hh36',
      ),
    )
  );

  $style_formats_boxes = array(
    'title' => 'ボックス',
    'items' => array(
      array(
        'title' => '1.黒の囲み線',
        'block' => 'div',
        'classes' => 'sng-box box1',
        'wrapper' => true,
      ),
      array(
        'title' => '2.グレイの囲み線',
        'block' => 'div',
        'classes' => 'sng-box box2',
        'wrapper' => true,
      ),
      array(
        'title' => '3.薄い水色の背景',
        'block' => 'div',
        'classes' => 'sng-box box3',
        'wrapper' => true,
      ),
      array(
        'title' => '4.薄い水色＋上下線',
        'block' => 'div',
        'classes' => 'sng-box box4',
        'wrapper' => true,
      ),
      array(
        'title' => '5.二重線囲み',
        'block' => 'div',
        'classes' => 'sng-box box5',
        'wrapper' => true,
      ),
      array(
        'title' => '6.青の点線囲み',
        'block' => 'div',
        'classes' => 'sng-box box6',
        'wrapper' => true,
      ),
      array(
        'title' => '7.背景グレイ＋両端二重線',
        'block' => 'div',
        'classes' => 'sng-box box7',
        'wrapper' => true,
      ),
      array(
        'title' => '8.橙色の背景+左線',
        'block' => 'div',
        'classes' => 'sng-box box8',
        'wrapper' => true,
      ),
      array(
        'title' => '9.赤の背景+上線',
        'block' => 'div',
        'classes' => 'sng-box box9',
        'wrapper' => true,
      ),
      array(
        'title' => '10.ミントカラー+上線',
        'block' => 'div',
        'classes' => 'sng-box box10',
        'wrapper' => true,
      ),
      array(
        'title' => '11.影＋ネイビー上線',
        'block' => 'div',
        'classes' => 'sng-box box11',
        'wrapper' => true,
      ),
      array(
        'title' => '12.水色立体',
        'block' => 'div',
        'classes' => 'sng-box box12',
        'wrapper' => true,
      ),
      array(
        'title' => '13.青の立体',
        'block' => 'div',
        'classes' => 'sng-box box13',
        'wrapper' => true,
      ),
      array(
        'title' => '14.水色ステッチ',
        'block' => 'div',
        'classes' => 'sng-box box14',
        'wrapper' => true,
      ),
      array(
        'title' => '15.ピンクステッチ',
        'block' => 'div',
        'classes' => 'sng-box box15',
        'wrapper' => true,
      ),
      array(
        'title' => '16.水色ストライプ',
        'block' => 'div',
        'classes' => 'sng-box box16',
        'wrapper' => true,
      ),
      array(
        'title' => '17.シャープ型',
        'block' => 'div',
        'classes' => 'sng-box box17',
        'wrapper' => true,
      ),
      array(
        'title' => '18.左上と右下くるん',
        'block' => 'div',
        'classes' => 'sng-box box18',
        'wrapper' => true,
      ),
      array(
        'title' => '19.カギカッコ',
        'block' => 'div',
        'classes' => 'sng-box box19',
        'wrapper' => true,
      ),
      array(
        'title' => '20.両端ドット点線囲み',
        'block' => 'div',
        'classes' => 'sng-box box20',
        'wrapper' => true,
      ),
      array(
        'title' => '21.グラデーション',
        'block' => 'div',
        'classes' => 'sng-box box21',
        'wrapper' => true,
      ),
      array(
        'title' => '22.影付き+左に青線',
        'block' => 'div',
        'classes' => 'sng-box box22',
        'wrapper' => true,
      ),
      array(
        'title' => '23.丸い吹き出し',
        'block' => 'div',
        'classes' => 'sng-box box23',
        'wrapper' => true,
      ),
      array(
        'title' => '24.吹き出し水色',
        'block' => 'div',
        'classes' => 'sng-box box24',
        'wrapper' => true,
      ),
      array(
        'title' => '25.右上に折り目',
        'block' => 'div',
        'classes' => 'sng-box box25',
        'wrapper' => true,
      )
    )
  );
  
  $style_formats_buttons = array(
    'title' => 'ボタン',
    'items' => array(
      array(
        'title' => '浮き出し（メインカラー）',
        'selector' => 'a',
        'classes' => 'btn raised main-bc strong',
      ),
      array(
        'title' => '浮き出し（アクセントカラー）',
        'selector' => 'a',
        'classes' => 'btn raised accent-bc strong',
      ),
      array(
        'title' => '浮き出し（赤）',
        'selector' => 'a',
        'classes' => 'btn raised red-bc strong',
      ),
      array(
        'title' => '浮き出し（青）',
        'selector' => 'a',
        'classes' => 'btn raised blue-bc strong',
      ),
      array(
        'title' => '浮き出し（緑）',
        'selector' => 'a',
        'classes' => 'btn raised green-bc strong',
      ),
      array(
        'title' => 'フラット塗りつぶし',
        'selector' => 'a',
        'classes' => 'btn flat1',
      ),
      array(
        'title' => '水色の枠',
        'selector' => 'a',
        'classes' => 'btn flat2',
      ),
      array(
        'title' => '水色の枠（二重線）',
        'selector' => 'a',
        'classes' => 'btn flat3',
      ),
      array(
        'title' => '水色の枠（破線）',
        'selector' => 'a',
        'classes' => 'btn flat4',
      ),
      array(
        'title' => '両端線ボタン（青&紺）',
        'selector' => 'a',
        'classes' => 'btn flat6',
      ),
      array(
        'title' => '水色下線',
        'selector' => 'a',
        'classes' => 'btn flat7',
      ),
      array(
        'title' => '右側まるみ',
        'selector' => 'a',
        'classes' => 'btn flat8',
      ),
      array(
        'title' => '青緑の塗りつぶし',
        'selector' => 'a',
        'classes' => 'btn flat9',
      ),
      array(
        'title' => '上まるみオレンジ',
        'selector' => 'a',
        'classes' => 'btn flat10',
      ),
      array(
        'title' => 'ストライプ両端線',
        'selector' => 'a',
        'classes' => 'btn flat11',
      ),
      array(
        'title' => 'グラデーション青',
        'selector' => 'a',
        'classes' => 'btn grad1',
      ),
      array(
        'title' => 'グラデーション赤・橙',
        'selector' => 'a',
        'classes' => 'btn grad2',
      ),
      array(
        'title' => 'グラデーション橙 丸',
        'selector' => 'a',
        'classes' => 'btn grad3',
      ),
      array(
        'title' => 'グラデーション青 丸みなし',
        'selector' => 'a',
        'classes' => 'btn grad4',
      ),
      array(
        'title' => '立体（メインカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic1 main-bc',
      ),
      array(
        'title' => '立体（アクセントカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic1 accent-bc',
      ),
      array(
        'title' => '立体（赤）',
        'selector' => 'a',
        'classes' => 'btn cubic1 red-bc',
      ),
      array(
        'title' => '立体（青）',
        'selector' => 'a',
        'classes' => 'btn cubic1 blue-bc',
      ),
      array(
        'title' => '立体（緑）',
        'selector' => 'a',
        'classes' => 'btn cubic1 green-bc',
      ),
      array(
        'title' => '立体+影（メインカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic1 main-bc shadow',
      ),
      array(
        'title' => '立体+影（アクセントカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic1 accent-bc shadow',
      ),
      array(
        'title' => '立体+影（赤）',
        'selector' => 'a',
        'classes' => 'btn cubic1 red-bc shadow',
      ),
      array(
        'title' => '立体+影（青）',
        'selector' => 'a',
        'classes' => 'btn cubic1 blue-bc shadow',
      ),
      array(
        'title' => '立体+影（緑）',
        'selector' => 'a',
        'classes' => 'btn cubic1 green-bc shadow',
      ),
      array(
        'title' => 'カクカク（メインカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic2 main-bc',
      ),
      array(
        'title' => 'カクカク（アクセントカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic2 accent-bc',
      ),
      array(
        'title' => 'カクカク（赤）',
        'selector' => 'a',
        'classes' => 'btn cubic2 red-bc',
      ),
      array(
        'title' => 'カクカク（青）',
        'selector' => 'a',
        'classes' => 'btn cubic2 blue-bc',
      ),
      array(
        'title' => 'カクカク（緑）',
        'selector' => 'a',
        'classes' => 'btn cubic2 green-bc',
      ),
      array(
        'title' => 'ポップ（メインカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic3 main-bc',
      ),
      array(
        'title' => 'ポップ（アクセントカラー）',
        'selector' => 'a',
        'classes' => 'btn cubic3 accent-bc',
      ),
      array(
        'title' => 'ポップ（赤）',
        'selector' => 'a',
        'classes' => 'btn cubic3 red-bc',
      ),
      array(
        'title' => 'ポップ（青）',
        'selector' => 'a',
        'classes' => 'btn cubic3 blue-bc',
      ),
      array(
        'title' => 'ポップ（緑）',
        'selector' => 'a',
        'classes' => 'btn cubic3 green-bc',
      ),
    )
  );
  $style_formats_table = array(
    'title' => '表をレスポンシブに変える',
    'selector' => 'table',
    'classes' => 'tb-responsive',
  );
  $style_formats_blockquote = array(
    'title' => '“シンプルな引用ボックス',
    'block' => 'blockquote',
    'classes' => 'quote_silver',
    'wrapper' => true,
  );
  
  $style_formats = array(
    $style_formats_image,
    $style_formats_typography,
    $style_formats_headlines,
    $style_formats_boxes,
    $style_formats_buttons,
    $style_formats_table,
    $style_formats_blockquote
  );

  $init['style_formats'] = json_encode($style_formats);
  return $init;
}
add_filter('tiny_mce_before_init', 'sng_editor_setting');

function add_sng_style($buttons)
{
  array_splice($buttons, 1, 0, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons', 'add_sng_style');
