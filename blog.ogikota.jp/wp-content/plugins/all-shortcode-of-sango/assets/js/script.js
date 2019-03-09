$(function(){
	$('#insert-sango-shortcode').on('click',function(){
		$(".sango-modal").show();
		$("body").addClass("modal-open");
		$(".sango-modal-backdrop").show();
	});
	$('.sango-modal-close').on('click',function(){
		$(".sango-modal").hide();
		$("body").removeClass("modal-open");
		$(".sango-modal-backdrop").hide();
	});
	$('.sango-menu a').on('click',function(){
		$(".sango-menu a").removeClass("active");
		$(this).addClass("active");
		$(".sango-frame-title h1").text($(this).text());
		$(".sango-frame-content > div > div").hide();
		var menu_index = $(".sango-menu .active").index();
		var tab_index = $(".sango-router > .active").index();
		$(".sango-frame-content > div:eq("+menu_index+") > div:eq("+tab_index+")").show();
	});
	$('.sango-router .sango-create').on('click',function(){
		$(".sango-router a").removeClass("active");
		$(this).addClass("active");
		$(".sango-frame-content > div > div").hide();
		var index = $(".sango-menu .active").index();
		$(".sango-frame-content > div:eq("+index+") .sango-create").show();
	});
	$('.sango-router .sango-preview').on('click',function(){
		$(".sango-router a").removeClass("active");
		$(this).addClass("active");
		$(".sango-frame-content > div > div").hide();
		var index = $(".sango-menu .active").index();
		$(".sango-frame-content > div:eq("+index+") .sango-preview").show();
		var short_code = $(".sango-frame-content > div:eq("+index+") .sango-short-code").text();
		sango_short_code($(".sango-frame-content > div:eq("+index+") .sango-preview"),short_code);
	});
	$('.sango-button-insert').on('click',function(){
		var index = $(".sango-menu .active").index();
		var short_code = $(".sango-frame-content > div:eq("+index+") .sango-short-code").text();
		send_to_editor(short_code);
		$('.sango-modal-close').click();
	});

	/*アコーディオン*/
	$('.accordion .commmon-btn').on('click',function(){
		var val = $(".accordion .title-box input").val();
		var content = get_tinymce_content("accordion-hidden-content");
		console.log(val);
		if(val && content){
			$(".accordion .sango-short-code").text("[open title='"+val+"']"+content+"[/open]");
		}
	});
	/*アコーディオン*/

	/*タイムライン*/
	$('.timeline .commmon-btn').on('click',function(){
		var content = get_tinymce_content("timeline-content");
		if(content){
			$(".timeline .sango-short-code").text(content);
		}
	});
	/*タイムライン*/

	/*関連記事*/
	$('.related-post').on('click','.related-post-list>div,.search-post-list>div',function(){
		$('.related-post-list>div,.search-post-list>div').removeClass("active");
		$(this).addClass("active");
		var id = $(this)[0].className.split(" ")[0];
		var val = $('input[name=related-post-type]:checked').val();
		var newtab = $(".related-post input#newtab-r:checked").val() ? ' target="_blank"' : "";
		$(".related-post .sango-short-code").text('['+val+' id="'+id+'"'+newtab+']');
	});
	$('.related-post-type input').change(function(){
		var newtab = $(".related-post input#newtab-r:checked").val() ? ' target="_blank"' : "";
		if ($('.related-post-list>div,.search-post-list>div').hasClass("active")){
			var id = $('.related-post-list>div.active,.search-post-list>div.active')[0].className.split(" ")[0];
			var val = $('input[name=related-post-type]:checked').val();
			$(".related-post .sango-short-code").text('['+val+' id="'+id+'"'+newtab+']');
		}else if($(".sango-post-id").hasClass("select-active")){
			var id = $('.sango-post-id input').val();
			if(id){
				var val = $('input[name=related-post-type]:checked').val();
				$(".related-post .sango-short-code").text('['+val+' id="'+id+'"'+newtab+']');
			}
		}else{
			var id = $(".sango-post-url span").text();
			if(id){
				var val = $('input[name=related-post-type]:checked').val();
				$(".related-post .sango-short-code").text('['+val+' id="'+id+'"'+newtab+']');
			}
		}
	});
	$('.related-select-type input').change(function(){
		$('.related-post-list>div,.search-post-list>div').removeClass("active");
		$(".sango-short-code").text('');
		$(".related-post-select-box .select-active").removeClass("select-active").hide();
		var val = $(this).val();
		$(".related-post-select-box ."+val).addClass("select-active").show();
	});
	$('.sango-post-id input').keyup(function(){
		var id = $(this).val();
		var val = $('input[name=related-post-type]:checked').val();
		var newtab = $(".related-post input#newtab-r:checked").val() ? ' target="_blank"' : "";
		$(".related-post .sango-short-code").text('['+val+' id="'+id+'"'+newtab+']');
	});
	/*関連記事*/

	/*他サイトへのリンク*/
	$('.other-site-link button').on('click',function(){
		var link = $("#other-site-link").val();
		var title = $('#post-title').val();
		var name = $('#site-name').val();
		var newtab = $(".other-site-link input#newtab:checked").val() ? ' target="_blank"' : "";
		var nofollow = $(".other-site-link input#nofollow:checked").val() ? ' rel="nofollow"' : "";
		if(link && title && name){
			$(".other-site-link .sango-short-code").text('[sanko href="'+link+'" title="'+title+'" site="'+name+'"'+newtab+nofollow+']');
		}
	});
	/*他サイトへのリンク*/

	/*線・点線*/
	$('.sango-border-type button').on('click',function(){
		var val = $(".sango-border-type input:checked").val();
		$(".sango-border .sango-short-code").text("["+val+"]");
	});
	/*線・点線*/

	/*補足説明*/
	$('.hosoku-desc input').keyup(function(){
		var title = $(this).val();
		var val = $('.hosoku-desc textarea').val();
		if(val){
			$(".hosoku-desc .sango-short-code").text('[memo title="'+title+'"]'+val+'[/memo]');
		}
	});
	$('.hosoku-desc textarea').keyup(function(){
		var val = $(this).val();
		var title = $('.hosoku-desc input').val();
		if(title){
			$(".hosoku-desc .sango-short-code").text('[memo title="'+title+'"]'+val+'[/memo]');
		}
	});
	/*補足説明*/

	/*注意書き*/
	$('.sango-attention input').keyup(function(){
		var title = $(this).val();
		var val = $('.sango-attention textarea').val();
		if(val){
			$(".sango-attention .sango-short-code").text('[alert title="'+title+'"]'+val+'[/alert]');
		}
	});
	$('.sango-attention textarea').keyup(function(){
		var val = $(this).val();
		var title = $('.sango-attention input').val();
		if(title){
			$(".sango-attention .sango-short-code").text('[alert title="'+title+'"]'+val+'[/alert]');
		}
	});
	/*注意書き*/

	/*ソースコードボックス*/
	$('.source-code-box input').keyup(function(){
		var title = $(this).val();
		var val = $('.source-code-box textarea').val();
		if(val){
			val = escape_html(val);
			$(".source-code-box .sango-short-code").text('[codebox title="'+title+'"]<pre><code>'+val+'</code></pre>[/codebox]');
		}
	});
	$('.source-code-box textarea').keyup(function(){
		var val = $(this).val();
		var title = $('.source-code-box input').val();
		if(title){
			val = escape_html(val);
			$(".source-code-box .sango-short-code").text('[codebox title="'+title+'"]<pre><code>'+val+'</code></pre>[/codebox]');
		}
	});
	/*ソースコードボックス*/

	/*吹き出し*/
	$('.balloon .common-btn').on('click',function(){
		var name = $("#balloon-name").val();
		var desc = $(".balloon textarea").val();
		var src = $(".balloon-media img").attr("src");
		if (name && desc && src) {
			if($("#balloon-img").prop('checked')){
				$(".balloon .sango-short-code").text('[say name="'+name+'" img="'+src+'" from="right"]'+desc+'[/say]');
			}else{
				$(".balloon .sango-short-code").text('[say name="'+name+'" img="'+src+'"]'+desc+'[/say]');
			}
		}
	});
	/*吹き出し*/

	/*横並び2列*/
	$('.float2 .commmon-btn').on('click',function(){
		var content = get_tinymce_content("float2-content");
		if(content){
			$(".float2 .sango-short-code").text(content);
		}
	});
	/*横並び2列*/

	/*横並び2列*/
	$('.float3 .commmon-btn').on('click',function(){
		var content = get_tinymce_content("float3-content");
		if(content){
			$(".float3 .sango-short-code").text(content);
		}
	});
	/*横並び2列*/

	/*Youtube動画の埋め込み*/
	$('.embed-youtube button').on('click',function(){
		var val = $(".embed-youtube input").val();
		$(".embed-youtube .sango-short-code").text("[youtube]"+val+"[/youtube]");
	});
	/*Youtube動画の埋め込み*/

	/*表示分岐*/
	$('.show-branch .commmon-btn').on('click',function(){
		var val = $(".show-branch-type input:checked").val();
		var content = get_tinymce_content("show-branch-content");
		if(val && content){
			$(".show-branch .sango-short-code").text("["+val+"]"+content+"[/"+val+"]");
		}
	});
	/*表示分岐*/

	/*カテゴリー指定*/
	$('.category .commmon-btn').on('click',function(){
		var val = $(".category input").val();
		var cat = $(".category #cat-list").val();
		if(val && cat){
			$(".category .sango-short-code").text('[catpost catid="'+cat+'" num="'+val+'"]');
		}
	});
	/*カテゴリー指定*/

	/*タグ指定*/
	$('.tag .commmon-btn').on('click',function(){
		var val = $(".tag input").val();
		var tag = $(".tag #tag-list").val();
		if(val && tag){
			$(".tag .sango-short-code").text('[tagpost id="'+tag+'" num="'+val+'"]');
		}
	});
	/*タグ指定*/

	/*画像上文字*/
	$('.string-on-image .common-btn').on('click',function(){
		var title = $(".string-on-image #string").val();
		var src = $(".string-on-image-media img").attr("src");
		if(title && src){
			$(".string-on-image .sango-short-code").text('[texton img="'+src+'" title="'+title+'"]');
		}
	});
	/*画像上文字*/

	/*新着記事*/
	$('.new-post .commmon-btn').on('click',function(){
		var val = $(".new-post input").val();
		if(val){
			$(".new-post .sango-short-code").text('[catpost num="'+val+'"]');
		}
	});
	/*新着記事*/

	/*レビューボックス*/
	$('.review-box .commmon-btn').on('click',function(){
		var content = get_tinymce_content("review-content");
		if(content){
			$(".review-box .sango-short-code").text(content);
		}
	});
	/*レビューボックス*/

	/*ボタン*/
	$('.sango-button .ex-btn').on('click',function(){
		$(".sango-button .preview-box,.sango-button .back-btn").show();
		$(".sango-button .main-box,.sango-button .ex-btn").hide();
	});
	$('.sango-button .back-btn').on('click',function(){
		$(".sango-button .preview-box,.sango-button .back-btn").hide();
		$(".sango-button .main-box,.sango-button .ex-btn").show();
	});
	$('.sango-button .common-btn').on('click',function(){
		var newtab = $(".sango-button input#newtab-b:checked").val() ? ' target="_blank"' : "";
		var nofollow = $(".sango-button input#nofollow-b:checked").val() ? ' rel="nofollow"' : "";
		var ripple = $(".sango-button input#ripple-b:checked").val() ? ' rippler rippler-inverse' : "";
		var center = $(".sango-button input#center-b:checked").val();
		var type = $(".sango-button #btn-type").val();
		var text = $(".sango-button #btn-text").val();
		var link = $(".sango-button #btn-url").val();
		if(type && link && text){
			if(center){
				$(".sango-button .sango-short-code").text('[center][btn href="'+link+'" class="'+type+ripple+'"'+newtab+nofollow+']'+text+'[/btn][/center]');
			}else{
				$(".sango-button .sango-short-code").text('[btn href="'+link+'" class="'+type+ripple+'"'+newtab+nofollow+']'+text+'[/btn]');
			}
		}
	});
	/*ボタン*/

	/*ボックス*/
	$('.box .ex-btn').on('click',function(){
		$(".box .preview-box,.box .back-btn").show();
		$(".box .main-box,.box .ex-btn").hide();
	});
	$('.box .back-btn').on('click',function(){
		$(".box .preview-box,.box .back-btn").hide();
		$(".box .main-box,.box .ex-btn").show();
	});
	$('.box .common-btn').on('click',function(){
		var title = $(".box input").val();
		var desc = $(".box textarea").val();
		var type = $(".box #box-type").val();
		if(title && desc && type){
			$(".box .sango-short-code").text('[box class="'+type+'" title="'+title+'"]'+desc+'[/box]');
		}
	});
	/*ボックス*/
});

$(function(){
    var custom_uploader;
    $(".balloon button.media-select").click(function(e) {
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media({
            title: "吹き出し画像を指定",
            /* ライブラリの一覧は画像のみにする */
            library: {
                type: "image"
            },
            button: {
                text: "メディアを挿入"
            },
            /* 選択できる画像は 1 つだけにする */
            multiple: false
        });
        custom_uploader.on("select", function() {
            var images = custom_uploader.state().get("selection");
            /* file の中に選択された画像の各種情報が入っている */
            images.each(function(file){
                /* サムネイル画像があればクリア */
                $(".balloon-media").empty();
                /* プレビュー用に選択されたサムネイル画像を表示 */
                $(".balloon-media").append('<img src="'+file.attributes.url+'" />');
            });
        });
        custom_uploader.open();
    });
    /* クリアボタンを押した時の処理 *//*
    $(".balloon button.media-clear").click(function() {
    });*/
});

$(function(){
    var custom_uploader;
    $(".string-on-image button.media-select").click(function(e) {
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media({
            title: "画像を指定",
            /* ライブラリの一覧は画像のみにする */
            library: {
                type: "image"
            },
            button: {
                text: "メディアを挿入"
            },
            /* 選択できる画像は 1 つだけにする */
            multiple: false
        });
        custom_uploader.on("select", function() {
            var images = custom_uploader.state().get("selection");
            /* file の中に選択された画像の各種情報が入っている */
            images.each(function(file){
                /* サムネイル画像があればクリア */
                $(".string-on-image-media").empty();
                /* プレビュー用に選択されたサムネイル画像を表示 */
                $(".string-on-image-media").append('<img src="'+file.attributes.url+'" />');
            });
        });
        custom_uploader.open();
    });
    /* クリアボタンを押した時の処理 *//*
    $(".balloon button.media-clear").click(function() {
    });*/
});