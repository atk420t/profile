<?php

function opencage_customize_register($wp_customize) {
    $wp_customize->add_section( 'colors', array(
    'title' => __( '> サイトカラー設定', 'opencage' ),
    'priority' => 30,
    'description' => 'サイトの色変更が可能です。<br>※「背景色」を適用させたい場合は、【カスタマイズ > 背景画像】から背景画像を削除しておく必要があります。',
    ));

	$wp_customize->add_setting( 'opencage_color_maintext', array( 'default' => '#3E3E3E', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_maintext', array(
    'label' => __( 'メインテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_maintext',
    )));

	$wp_customize->add_setting( 'opencage_color_mainlink', array( 'default' => '#1BB4D3', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_mainlink', array(
    'label' => __( 'リンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_mainlink',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_mainlink_hover', array( 'default' => '#E69B9B', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_mainlink_hover', array(
    'label' => __( 'リンク（マウスオン時）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_mainlink_hover',
    ) ) );
	  
	$wp_customize->add_setting( 'opencage_color_headerbg', array( 'default' => '#1bb4d3', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerbg', array(
    'label' => __( 'ヘッダー背景（メインカラー）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerbg',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headertext', array( 'default' => '#ffffff', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headertext', array(
    'label' => __( 'ヘッダーテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headertext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headerlogo', array( 'default' => '#eeee22', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerlogo', array(
    'label' => __( 'ヘッダーロゴ', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerlogo',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headerlink', array( 'default' => '#edf9fc', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerlink', array(
    'label' => __( 'ヘッダーリンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerlink',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headerlink_hover', array( 'default' => '#eeeeee', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerlink_hover', array(
    'label' => __( 'ヘッダーリンク（マウスオン時）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerlink_hover',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_contentbg', array( 'default' => '#ffffff', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_contentbg', array(
    'label' => __( 'メインコンテンツ背景', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_contentbg',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_labelbg', array( 'default' => '#fcee21', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_labelbg', array(
    'label' => __( 'ラベル背景', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_labelbg',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_labeltext', array( 'default' => '#444444', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_labeltext', array(
    'label' => __( 'ラベルテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_labeltext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_formbg', array( 'default' => '#ffffff', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_formbg', array(
    'label' => __( '入力フォーム背景', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_formbg',
    ) ) );
    
    $wp_customize->add_setting( 'opencage_color_ttlbg', array( 'default' => '#1bb4d3', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_ttlbg', array(
    'label' => __( '記事ページ見出し(H2)背景', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_ttlbg',
    ) ) );

    $wp_customize->add_setting( 'opencage_color_ttltext', array( 'default' => '#ffffff', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_ttltext', array(
    'label' => __( '記事ページ見出し(H2)文字色', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_ttltext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_sidetext', array( 'default' => '#444444', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_sidetext', array(
    'label' => __( 'サイドバーテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_sidetext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_sidelink', array( 'default' => '#666666', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_sidelink', array(
    'label' => __( 'サイドバーリンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_sidelink',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_sidelink_hover', array( 'default' => '#999999', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_sidelink_hover', array(
    'label' => __( 'サイドバーリンク（マウスオン時）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_sidelink_hover',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_footerbg', array( 'default' => '#666666', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_footerbg', array(
    'label' => __( 'フッター背景', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_footerbg',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_footertext', array( 'default' => '#CACACA', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_footertext', array(
    'label' => __( 'フッターテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_footertext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_footerlink', array( 'default' => '#f7f7f7', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_footerlink', array(
    'label' => __( 'フッターリンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_footerlink',
    ) ) );

	  
         }
    add_action('customize_register', 'opencage_customize_register');
    
    function opencage_customize_css()
    {
    //初期カラー
    $maintext = get_theme_mod( 'opencage_color_maintext', '#3E3E3E');
    $mainlink = get_theme_mod( 'opencage_color_mainlink', '#1BB4D3');
    $mainlinkhover = get_theme_mod( 'opencage_color_mainlink_hover', '#E69B9B');
    $mainformbg = get_theme_mod( 'opencage_color_formbg', '#ffffff');
    $mainttlbg = get_theme_mod( 'opencage_color_ttlbg', '#1bb4d3');
    $mainttltext = get_theme_mod( 'opencage_color_ttltext', '#ffffff');
    $headerbg = get_theme_mod( 'opencage_color_headerbg', '#1bb4d3');
    $headertext = get_theme_mod( 'opencage_color_headertext', '#ffffff');
    $headerlogo = get_theme_mod( 'opencage_color_headerlogo', '#eeee22');
    $headerlink = get_theme_mod( 'opencage_color_headerlink', '#edf9fc');
    $headerlinkhover = get_theme_mod( 'opencage_color_headerlink_hover', '#eeeeee');
    $contentbg = get_theme_mod( 'opencage_color_contentbg', '#ffffff');
    $labelbg = get_theme_mod( 'opencage_color_labelbg', '#fcee21');
    $labeltext = get_theme_mod( 'opencage_color_labeltext', '#444444');
    $sidetext = get_theme_mod( 'opencage_color_sidetext', '#444444');
    $sidelink = get_theme_mod( 'opencage_color_sidelink', '#666666');
    $sidelinkhover = get_theme_mod( 'opencage_color_sidelink_hover', '#999999');
    $footerbg = get_theme_mod( 'opencage_color_footerbg', '#666666');
    $footertext = get_theme_mod( 'opencage_color_footertext', '#CACACA');
    $footerlink = get_theme_mod( 'opencage_color_footerlink', '#f7f7f7');
    ?>
<style type="text/css">
body{color: <?php echo $maintext; ?>;}
a, #breadcrumb li.bc_homelink a::before, .authorbox .author_sns li a::before{color: <?php echo $mainlink; ?>;}
a:hover{color: <?php echo $mainlinkhover; ?>;}
.article-footer .post-categories li a,.article-footer .tags a{  background: <?php echo $mainlink; ?>;  border:1px solid <?php echo $mainlink; ?>;}
.article-footer .tags a{color:<?php echo $mainlink; ?>; background: none;}
.article-footer .post-categories li a:hover,.article-footer .tags a:hover{ background:<?php echo $mainlinkhover; ?>;  border-color:<?php echo $mainlinkhover; ?>;}
input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"],select,textarea,.field { background-color: <?php echo $mainformbg; ?>;}
.header{color: <?php echo $headertext; ?>;}
.bgfull .header,.header.bg,.header #inner-header,.menu-sp{background: <?php echo $headerbg; ?>;}
#logo a{color: <?php echo $headerlogo; ?>;}
#g_nav .nav li a,.nav_btn,.menu-sp a,.menu-sp a,.menu-sp > ul:after{color: <?php echo $headerlink; ?>;}
#logo a:hover,#g_nav .nav li a:hover,.nav_btn:hover{color:<?php echo $headerlinkhover; ?>;}
@media only screen and (min-width: 768px) {
.nav > li > a:after{background: <?php echo $headerlinkhover; ?>;}
.nav ul {background: <?php echo $footerbg; ?>;}
#g_nav .nav li ul.sub-menu li a{color: <?php echo $footerlink; ?>;}
}
@media only screen and (max-width: 1165px) {
.site_description{background: <?php echo $headerbg; ?>; color: <?php echo $headertext; ?>;}
}
#inner-content, #breadcrumb, .entry-content blockquote:before, .entry-content blockquote:after{background: <?php echo $contentbg; ?>}
.top-post-list .post-list:before{background: <?php echo $mainlink; ?>;}
.widget li a:after{color: <?php echo $mainlink; ?>;}
.entry-content h2,.widgettitle{background: <?php echo $mainttlbg; ?>; color: <?php echo $mainttltext; ?>;}
.entry-content h3{border-color: <?php echo $mainttlbg; ?>;}
.h_boader .entry-content h2{border-color: <?php echo $mainttlbg; ?>; color: <?php echo $maintext; ?>;}
.h_balloon .entry-content h2:after{border-top-color: <?php echo $mainttlbg; ?>;}
.entry-content ul li:before{ background: <?php echo $mainttlbg; ?>;}
.entry-content ol li:before{ background: <?php echo $mainttlbg; ?>;}
.post-list-card .post-list .eyecatch .cat-name,.top-post-list .post-list .eyecatch .cat-name,.byline .cat-name,.single .authorbox .author-newpost li .cat-name,.related-box li .cat-name,.carouselwrap .cat-name,.eyecatch .cat-name{background: <?php echo $labelbg; ?>; color:  <?php echo $labeltext; ?>;}
ul.wpp-list li a:before{background: <?php echo $mainttlbg; ?>; color: <?php echo $mainttltext; ?>;}
.readmore a{border:1px solid <?php echo $mainlink; ?>;color:<?php echo $mainlink; ?>;}
.readmore a:hover{background:<?php echo $mainlink; ?>;color:#fff;}
.btn-wrap a{background: <?php echo $mainlink; ?>;border: 1px solid <?php echo $mainlink; ?>;}
.btn-wrap a:hover{background: <?php echo $mainlinkhover; ?>;border-color: <?php echo $mainlinkhover; ?>;}
.btn-wrap.simple a{border:1px solid <?php echo $mainlink; ?>;color:<?php echo $mainlink; ?>;}
.btn-wrap.simple a:hover{background:<?php echo $mainlink; ?>;}
.blue-btn, .comment-reply-link, #submit { background-color: <?php echo $mainlink; ?>; }
.blue-btn:hover, .comment-reply-link:hover, #submit:hover, .blue-btn:focus, .comment-reply-link:focus, #submit:focus {background-color: <?php echo $mainlinkhover; ?>; }
#sidebar1{color: <?php echo $sidetext; ?>;}
.widget:not(.widget_text) a{color:<?php echo $sidelink; ?>;}
.widget:not(.widget_text) a:hover{color:<?php echo $sidelinkhover; ?>;}
.bgfull #footer-top,#footer-top .inner,.cta-inner{background-color: <?php echo $footerbg; ?>; color: <?php echo $footertext; ?>;}
.footer a,#footer-top a{color: <?php echo $footerlink; ?>;}
#footer-top .widgettitle{color: <?php echo $footertext; ?>;}
.bgfull .footer,.footer.bg,.footer .inner {background-color: <?php echo $footerbg; ?>;color: <?php echo $footertext; ?>;}
.footer-links li a:before{ color: <?php echo $headerbg; ?>;}
.pagination a, .pagination span,.page-links a{border-color: <?php echo $mainlink; ?>; color: <?php echo $mainlink; ?>;}
.pagination .current,.pagination .current:hover,.page-links ul > li > span{background-color: <?php echo $mainlink; ?>; border-color: <?php echo $mainlink; ?>;}
.pagination a:hover, .pagination a:focus,.page-links a:hover, .page-links a:focus{background-color: <?php echo $mainlink; ?>; color: #fff;}
</style>
<?php
    }
    add_action( 'wp_head', 'opencage_customize_css');



//カスタムロゴ
function opencage_logo_theme_customizer( $wp_customize ) {
    // Logo upload
    $wp_customize->add_section( 'opencage_logo_section' , array(
	    'title'       => __( '> サイトロゴ・アイコン', 'opencage_logo' ),
	    'priority'    => 30,
	));
	
	$wp_customize->add_setting( 'opencage_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_logo', array(
		'label'        => __( 'ロゴ画像をアップロード', 'opencage_logo' ),
		'description' => '<span style="font-size:10px;">ロゴ画像を利用する場合はこちらからアップロードしてください。画像の推奨サイズはロゴのレイアウトにより異なります。</span>',
		'section'    => 'opencage_logo_section',
		'settings'   => 'opencage_logo',
		)
	));

	$wp_customize->add_setting( 'opencage_favicon' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_favicon', array(
		'label'        => __( 'ファビコン（.png）をアップロード', 'opencage_favicon' ),
		'description' => '<span style="font-size:10px;">推奨：32×32px</span>',
		'section'    => 'opencage_logo_section',
		'settings'   => 'opencage_favicon',
		)
	));

	$wp_customize->add_setting( 'opencage_favicon_ie' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_favicon_ie', array(
		'label'        => __( 'IE用ファビコン（.ico）をアップロード', 'opencage_favicon_ie' ),
		'description' => '<span style="font-size:10px;">推奨：16×16px</span>',
		'section'    => 'opencage_logo_section',
		'settings'   => 'opencage_favicon_ie',
		)
	));
	
	$wp_customize->add_setting( 'opencage_appleicon' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_appleicon', array(
		'label'        => __( 'アップルタッチアイコンをアップロード', 'opencage_appleicon' ),
		'description' => '<span style="font-size:10px;">推奨：144 x 144px</span>',
		'section'    => 'opencage_logo_section',
		'settings'   => 'opencage_appleicon',
		)
	));
	
}
add_action('customize_register', 'opencage_logo_theme_customizer');



function opencage_global_customizer($wp_customize) {
    $wp_customize->add_section( 'global_section', array(
        'title'          =>'> グローバル設定',
        'priority'       => 30,
    ));

    $wp_customize->add_setting('other_options_headerundertext', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'other_options_headerundertext', array(
	    'label' =>'ヘッダー下お知らせテキスト',
		'description' => '<span style="font-size:10px;">ヘッダー下にお知らせを表示できます。イベントの告知や読んで欲しい記事などへのリンクを設置したりと、使い方は様々！※下の「<b>ヘッダー下お知らせリンク</b>」を設定しないと表示されません</span>',
	    'settings' => 'other_options_headerundertext',
	    'section' => 'global_section',
	));

    $wp_customize->add_setting('other_options_headerunderlink', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'other_options_headerunderlink', array(
	    'label' =>'ヘッダー下お知らせリンク',
		'description' => '<span style="font-size:10px;">ヘッダー下のお知らせにリンクを設置可能です。<br>例）https://open-cage.com</span>',
	    'settings' => 'other_options_headerunderlink',
	    'section' => 'global_section',
	));
	$wp_customize->add_setting( 'other_options_headerunderlink_bgcolor', array(
		'default' => '#f55e5e', 
	));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'other_options_headerunderlink_bgcolor', array(
	    'label' => __( 'お知らせ背景色', 'opencage' ),
	    'section' => 'global_section',
	    'settings' => 'other_options_headerunderlink_bgcolor',
    )));
    $wp_customize->add_setting('other_options_headerunderlink_target', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'other_options_headerunderlink_target', array(
	    'label' =>'リンクを別タブで開く（_target設定）',
		'description' => '<span style="font-size:10px;">上で設定したお知らせリンクを別タブで開きたい場合にチェック<br><br></span>',
	    'settings' => 'other_options_headerunderlink_target',
	    'section' => 'global_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('side_options_header_search', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'side_options_header_search', array(
	    'settings' => 'side_options_header_search',
	    'label' =>'[ヘッダー]サイト内検索ボタンを非表示にする',
	    'section' => 'global_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('side_options_description', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'side_options_description', array(
	    'label' =>'[ヘッダー]サイトディスクリプションを表示する',
		'description' => '<span style="font-size:10px;">「サイトの簡単な説明」をヘッダー上に表示します。</span>',
	    'settings' => 'side_options_description',
	    'section' => 'global_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('opencage_logo_size', array(
	   'type'  => 'option',
	   'default' => 'fs_m',
	));
	$wp_customize->add_control( 'opencage_logo_size', array(
	    'settings' => 'opencage_logo_size',
	    'label' =>'[ヘッダー]テキストロゴサイズ',
		'description' => '<span style="font-size:10px;">ロゴのフォントサイズを変更できます。<b>※ロゴをテキストにしている場合のみ有効です。ロゴ画像を設定している場合は機能しません。</b></span>',
	    'section' => 'global_section',
	    'type' => 'radio',
	    'choices' => array(
            'fs_s' => '小さめ',
            'fs_m' => '標準',
            'fs_l' => '大きめ',
        ),
	));

    $wp_customize->add_setting('side_options_headercenter', array(
	   'type'  => 'option',
	   'default' => 'headerleft',
	));
	$wp_customize->add_control( 'side_options_headercenter', array(
	    'settings' => 'side_options_headercenter',
	    'label' =>'[ヘッダー]ロゴレイアウト',
		'description' => '<span style="font-size:10px;">ロゴの位置を変更することが可能です。（※PC表示）</span>',
	    'section' => 'global_section',
	    'type' => 'radio',
	    'choices' => array(
            'headerleft' => '左側に配置',
            'headercenter' => '中央に配置',
        ),
	));

    $wp_customize->add_setting('side_options_headerbg', array(
	   'type'  => 'option',
	   'default' => 'bgnormal',
	));
	$wp_customize->add_control( 'side_options_headerbg', array(
	    'settings' => 'side_options_headerbg',
	    'label' =>'[ヘッダー]背景設定',
		'description' => '<span style="font-size:10px;">ヘッダー背景を横幅いっぱいに表示することができます。（※PC表示）</span>',
	    'section' => 'global_section',
	    'type' => 'radio',
	    'choices' => array(
            'bgnormal' => 'コンテンツ幅',
            'bgfull' => 'フルサイズ（横幅いっぱい）',
        ),
	));

    $wp_customize->add_setting('side_options_sidebarlayout', array(
	   'type'  => 'option',
	   'default' => 'sidebarright',
	));
	$wp_customize->add_control( 'side_options_sidebarlayout', array(
	    'settings' => 'side_options_sidebarlayout',
	    'label' =>'[全体]メインカラム表示位置',
	    'section' => 'global_section',
	    'type' => 'radio',
	    'choices' => array(
            'sidebarright' => 'メインカラム左側（デフォルト）',
            'sidebarleft' => 'メインカラム右側',
        ),
	));

    $wp_customize->add_setting('side_options_animatenone', array(
	   'type'  => 'option',
	   'default' => 'ani_on',
	));
	$wp_customize->add_control( 'side_options_animatenone', array(
	    'settings' => 'side_options_animatenone',
	    'label' =>'[全体]アニメーション機能',
		'description' => '<span style="font-size:10px;">サイト全体のアニメーション機能を切り替えることができます。※トップページのみ適用するなどの機能はありません。</span>',
	    'section' => 'global_section',
	    'type' => 'radio',
	    'choices' => array(
            'ani_on' => 'アニメーションON',
            'ani_off' => 'アニメーションOFF',
        ),
	));

    $wp_customize->add_setting('side_options_pannavi', array(
	   'type'  => 'option',
	   'default' => 'pannavi_on',
	));
	$wp_customize->add_control( 'side_options_pannavi', array(
	    'settings' => 'side_options_pannavi',
	    'label' =>'パンくずナビ表示設定',
		'description' => '<span style="font-size:10px;">パンくずナビの表示位置のコントロールができます。</span>',
	    'section' => 'global_section',
	    'type' => 'radio',
	    'choices' => array(
            'pannavi_on' => 'パンくずナビを「サイト上部」に表示する',
            'pannavi_on_bottom' => 'パンくずナビを「サイト下部」に表示する',
            'pannavi_off' => 'パンくずナビを表示しない',
        ),
	));

    $wp_customize->add_setting('side_options_fontawesomeinclude', array(
	   'type'  => 'option',
	   'default' => 'fonta_cdn',
	));
	$wp_customize->add_control( 'side_options_fontawesomeinclude', array(
	    'settings' => 'side_options_fontawesomeinclude',
	    'label' =>'アイコンフォント（Fontawesome）の読み込み設定',
		'description' => '<span style="font-size:10px;"><b style="color:red;">※1</b>「Fontawesomeを読み込まない」を選択するとアイコンが表示されなくなる可能性がございます。プラグインや独自にファイルを読み込んている場合のみ選択してください。</span>',
	    'section' => 'global_section',
	    'type' => 'radio',
	    'choices' => array(
            'fonta_cdn' => 'CDN版（デフォルト）',
            'fonta_download' => 'ダウンロード版',
            'fonta_off' => 'Fontawesomeを読み込まない（※1）',
        ),
	));

}
add_action( 'customize_register', 'opencage_global_customizer' );



//トップページ
function opencage_toppage_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'opencage_toppage_section' , array(
	    'title'       => __( '> トップページ設定', 'opencage_toppage' ),
	    'priority'    => 30,
	    'description' => 'トップページの設定全般。ヘッダー画像やリンクの設置などができます。<a href="//open-cage.com/stork/document/toppage/#i-4" target="_blank">→トップページヘッダーの使い方</a>',
	) );
	
	$wp_customize->add_setting('opencage_toppage_headeregtext', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'opencage_toppage_headeregtext', array(
	    'label' =>'英語表示テキスト（大テキスト）',
		'description' => '<span style="font-size:10px;"><span style="color:red;">【ヘッダー画像を表示するなら必須】</span>推奨はローマ字です。日本語でも表示は可能ですがフォントの見た目が変わります。</span>',
	    'section' => 'opencage_toppage_section',
	    'settings' => 'opencage_toppage_headeregtext',
	));
    $wp_customize->add_setting('opencage_toppage_headerjptext', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'opencage_toppage_headerjptext', array(
	    'label' =>'日本語表示テキスト（小テキスト）',
		'description' => '<span style="font-size:10px;"><span style="color:red;">【ヘッダー画像を表示するなら必須】</span>小さな補足テキストが入ります。</span>',
	    'section' => 'opencage_toppage_section',
	    'type' => 'textarea',
	    'settings' => 'opencage_toppage_headerjptext',
	));

	
	$wp_customize->add_setting( 'opencage_toppage_headerbg' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_toppage_headerbg', array(
		'label'        => __( 'ヘッダー背景画像', 'opencage_toppage_headerbg' ),
		'section'    => 'opencage_toppage_section',
		'settings'   => 'opencage_toppage_headerbg',
	)));

	$wp_customize->add_setting( 'opencage_toppage_headerbgsp' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_toppage_headerbgsp', array(
		'label'        => __( 'ヘッダー背景画像（SP用）', 'opencage_toppage_headerbgsp' ),
		'description' => '<span style="font-size:10px;">スマートフォン用のヘッダー背景画像を設定できます。※設定しなかった場合はPC用が表示されます。</span>',
		'section'    => 'opencage_toppage_section',
		'settings'   => 'opencage_toppage_headerbgsp',
	) ) );


    $wp_customize->add_setting('opencage_toppage_headerbgsize', array(
	   'type'  => 'option',
	   'default' => 'cover',
	));
	$wp_customize->add_control( 'opencage_toppage_headerbgsize', array(
	    'settings' => 'opencage_toppage_headerbgsize',
	    'label' =>'ヘッダー背景サイズ',
	    'section' => 'opencage_toppage_section',
	    'type' => 'radio',
	    'choices' => array(
            'cover' => '縦横AUTO',
            '100% auto' => '横100%',
            'auto 100%' => '縦100%',
            'auto' => 'サイズ調整しない',
        ),
	));
	
    $wp_customize->add_setting('opencage_toppage_headerbgrepeat', array(
	   'type'  => 'option',
	   'default' => 'repeat',
	));
	$wp_customize->add_control( 'opencage_toppage_headerbgrepeat', array(
	    'settings' => 'opencage_toppage_headerbgrepeat',
	    'label' =>'ヘッダー背景繰り返し',
	    'section' => 'opencage_toppage_section',
	    'type' => 'radio',
	    'choices' => array(
            'repeat' => '繰り返し表示',
            'repeat-x' => '横方向に繰り返し',
            'repeat-y' => '縦方向に繰り返し',
            'no-repeat' => '繰り返ししない',
        ),
	));

    $wp_customize->add_setting('opencage_toppage_headerlink', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'opencage_toppage_headerlink', array(
	    'label' =>'ヘッダーボタンURL',
		'description' => '<span style="font-size:10px;">リンクさせたいページやサイトのURLを入力</span>',
	    'section' => 'opencage_toppage_section',
	    'settings' => 'opencage_toppage_headerlink',
	));
    $wp_customize->add_setting('opencage_toppage_headerlinktext', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'opencage_toppage_headerlinktext', array(
	    'label' =>'ヘッダーボタンテキスト',
		'description' => '<span style="font-size:10px;">ここに入力した文字で置き換えます。※上の項目の「ヘッダーボタンURL」を設定していない場合は表示されません。</span>',
	    'section' => 'opencage_toppage_section',
	    'settings' => 'opencage_toppage_headerlinktext',
	));
	$wp_customize->add_setting( 'opencage_toppage_textcolor', array(
		'default' => '#32abc9', 
	));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_toppage_textcolor', array(
	    'label' => __( 'ヘッダーテキストカラー', 'opencage' ),
	    'section' => 'opencage_toppage_section',
	    'settings' => 'opencage_toppage_textcolor',
    )));
	$wp_customize->add_setting( 'opencage_toppage_btncolor', array(
		'default' => '#ffffff', 
	));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_toppage_btncolor', array(
	    'label' => __( 'ヘッダーボタンテキストカラー', 'opencage' ),
	    'section' => 'opencage_toppage_section',
	    'settings' => 'opencage_toppage_btncolor',
    )));
	$wp_customize->add_setting( 'opencage_toppage_btnbgcolor', array(
		'default' => '#1bb4d3', 
	));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_toppage_btnbgcolor', array(
	    'label' => __( 'ヘッダーボタン背景カラー', 'opencage' ),
	    'section' => 'opencage_toppage_section',
	    'settings' => 'opencage_toppage_btnbgcolor',
    )));
    $wp_customize->add_setting('opencage_toppage_textlayout', array(
	   'type'  => 'option',
	   'default' => 'textcenter',
	));
	$wp_customize->add_control( 'opencage_toppage_textlayout', array(
	    'settings' => 'opencage_toppage_textlayout',
	    'label' =>'テキストレイアウト',
		'description' => '<span style="font-size:10px;">PC・タブレットの場合にテキストの配置位置を変更します。※スマートフォンでは全て中央よせとなります。</span>',
	    'section' => 'opencage_toppage_section',
	    'type' => 'radio',
	    'choices' => array(
            'textcenter' => '中央よせ',
            'textleft' => '左よせ',
            'textright' => '右よせ',
        ),
	));

}
add_action('customize_register', 'opencage_toppage_theme_customizer');



// 記事一覧
function opencage_layout_customizer($wp_customize) {
    $wp_customize->add_section( 'archiveslayout_section', array(
        'title'          =>'> 記事一覧ページ設定',
        'priority'       => 30,
	    'description' => '記事一覧ページ（トップページ・カテゴリー・タグのページ等）のレイアウトを変更可能です。',
    ));


    $wp_customize->add_setting('opencage_toppage_archivelayout', array(
	   'type'  => 'option',
	   'default' => 'toplayout-simple',
	));
	$wp_customize->add_control( 'opencage_toppage_archivelayout', array(
	    'settings' => 'opencage_toppage_archivelayout',
	    'label' =>'[PC]トップページ記事レイアウト',
	    'section' => 'archiveslayout_section',
	    'type' => 'radio',
	    'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-magazine' => 'マガジン型',
            'toplayout-big' => 'ビッグ',
        ),
	));

    $wp_customize->add_setting('opencage_toppage_sp_archivelayout', array(
	   'type'  => 'option',
	   'default' => 'toplayout-card',
	));
	$wp_customize->add_control( 'opencage_toppage_sp_archivelayout', array(
	    'settings' => 'opencage_toppage_sp_archivelayout',
	    'label' =>'[SP]トップページ記事レイアウト',
		'description' => '<span style="font-size:10px;">※PC画面では確認できません。実機にてご確認ください。</span>',
	    'section' => 'archiveslayout_section',
	    'type' => 'radio',
	    'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-magazine' => 'マガジン型',
            'toplayout-big' => 'ビッグ',
        ),
	));

    $wp_customize->add_setting('opencage_archivelayout', array(
	   'type'  => 'option',
	   'default' => 'toplayout-simple',
	));
	$wp_customize->add_control( 'opencage_archivelayout', array(
	    'settings' => 'opencage_archivelayout',
	    'label' =>'[PC]その他一覧ページ記事レイアウト',
	    'section' => 'archiveslayout_section',
	    'type' => 'radio',
	    'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-magazine' => 'マガジン型',
            'toplayout-big' => 'ビッグ',
        ),
	));

    $wp_customize->add_setting('opencage_sp_archivelayout', array(
	   'type'  => 'option',
	   'default' => 'toplayout-card',
	));
	$wp_customize->add_control( 'opencage_sp_archivelayout', array(
	    'settings' => 'opencage_sp_archivelayout',
	    'label' =>'[SP]その他一覧ページ記事レイアウト',
		'description' => '<span style="font-size:10px;">※PC画面では確認できません。実機にてご確認ください。</span>',
	    'section' => 'archiveslayout_section',
	    'type' => 'radio',
	    'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-card' => 'カード型',
            'toplayout-magazine' => 'マガジン型',
            'toplayout-big' => 'ビッグ',
        ),
	));

}
add_action( 'customize_register', 'opencage_layout_customizer' );




function opencage_postpage_customizer($wp_customize) {
    $wp_customize->add_section( 'postpage_section', array(
        'title'          =>'> 投稿・固定ページ設定',
        'priority'       => 30,
    ));

    $wp_customize->add_setting('post_options_ttl', array(
	   'type'  => 'option',
	   'default' => 'h_default',
	));
	$wp_customize->add_control( 'post_options_ttl', array(
	    'settings' => 'post_options_ttl',
	    'label' =>'見出しデザイン',
		'description' => '<span style="font-size:10px;">見出しのデザインを変更することが可能です。※CSSで独自カスタマイズする場合はデフォルトを選択してください。</span>',
	    'section' => 'postpage_section',
	    'type' => 'radio',
	    'choices' => array(
            'h_default' => 'シンプル（デフォルト）',
            'h_boader' => 'ボーダー',
            'h_balloon' => '吹き出し風',
        ),
	));
    $wp_customize->add_setting('sns_options_text', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'sns_options_text', array(
	    'settings' => 'sns_options_text',
	    'label' =>'記事下のシェアタイトルを表示',
	    'section' => 'postpage_section',
	));
    $wp_customize->add_setting('sns_options_page', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'sns_options_page', array(
	    'settings' => 'sns_options_page',
	    'label' =>'固定ページでもSNSボタンを表示する',
		'description' => '<span style="font-size:10px;">固定ページにも独自のSNSボタンを表示させたい場合にチェック。</span>',
	    'section' => 'postpage_section',
	    'type' => 'checkbox',
	));
    $wp_customize->add_setting('sns_options_hide', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'sns_options_hide', array(
	    'settings' => 'sns_options_hide',
	    'label' =>'SNSボタンを表示しない',
		'description' => '<span style="font-size:10px;">SNSボタンをプラグインなどで実装する場合に、チェックをいれれば独自のSNSボタンが非表示になります。</span>',
	    'section' => 'postpage_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('post_options_eyecatch', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'post_options_eyecatch', array(
	    'settings' => 'post_options_eyecatch',
	    'label' =>'記事・固定ページでアイキャッチ画像を非表示',
		'description' => '<span style="font-size:10px;">こちらにチェックをいれると記事ページにてアイキャッチ画像を自動出力しないようにします。</span>',
	    'section' => 'postpage_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('post_options_page_cta', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'post_options_page_cta', array(
	    'settings' => 'post_options_page_cta',
	    'label' =>'固定ページにもCTAウィジェットを表示する',
		'description' => '<span style="font-size:10px;">固定ページ下にもCTAウィジェットを表示させたい場合はチェックをいれてください。</span>',
	    'section' => 'postpage_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('post_options_authorbox', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'post_options_authorbox', array(
	    'settings' => 'post_options_authorbox',
	    'label' =>'記事下に投稿者情報を表示しない',
		'description' => '<span style="font-size:10px;">記事下の「この記事をかいた人」を出力したくない場合にチェックをいれてください。（プラグインを利用する場合などに）</span>',
	    'section' => 'postpage_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('post_options_date', array(
	   'type'  => 'option',
	   'default' => 'undo_off',
	));
	$wp_customize->add_control( 'post_options_date', array(
	    'settings' => 'post_options_date',
	    'label' =>'投稿日・更新日表示設定',
		'description' => '<span style="font-size:10px;">投稿日・更新日を非表示にすることができます。※CSSで非表示にするだけなので、ソースは出力されます。</span>',
	    'section' => 'postpage_section',
	    'type' => 'radio',
	    'choices' => array(
            'undo_off' => '投稿日のみ表示する',
            'date_on' => '投稿日・更新日を表示する',
            'date_off' => '投稿日・更新日を非表示にする',
        ),
	));

    $wp_customize->add_setting('fbbox_options_url', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'fbbox_options_url', array(
	    'settings' => 'fbbox_options_url',
	    'label' =>'記事下にfacebookいいねボックスを表示',
		'description' => '<span style="font-size:10px;">facebookページのURLを入力 ※個人ページURLは使用できません。</span>',
	    'section' => 'postpage_section',
	));
}
add_action( 'customize_register', 'opencage_postpage_customizer' );


add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {
    $wp_customize->add_section( 'option_section', array(
        'title'          =>'> アクセス解析コード',
        'priority'       => 30,
    ));
    $wp_customize->add_setting('other_options_ga', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'other_options_ga', array(
	    'label' =>'GoogleAnalytics',
		'description' => '<span style="font-size:10px;">入力例：「UA-xxxxxxxx-xx」<br>※プラグインなどで設定している場合は設定しないようご注意ください。2重でカウントとなる可能性があります。</span>',
	    'settings' => 'other_options_ga',
	    'section' => 'option_section',
	));

    $wp_customize->add_setting('other_options_headcode', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'other_options_headcode', array(
	    'label' =>'headタグ',
		'description' => '<span style="font-size:10px;"><head>タグ内に解析コードなどを入力したい場合はご記入いただけます。※PHPなどのプログラムファイルは動作しません。</span>',
	    'settings' => 'other_options_headcode',
	    'type' => 'textarea',
	    'section' => 'option_section',
	));
}
add_action( 'customize_register', 'theme_customize_register' );