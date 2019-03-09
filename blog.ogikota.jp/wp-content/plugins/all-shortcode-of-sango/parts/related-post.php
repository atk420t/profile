<div class="related-post">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<h2>関連記事の種類</h2>
		<div class="related-post-type sango-radio">
			<label><input type="radio" name="related-post-type" value="kanren" checked="">横長タイプ[kanren]</label>
			<label><input type="radio" name="related-post-type" value="card">カードタイプ[card]</label>
			<label><input type="radio" name="related-post-type" value="card2">別スタイルのタイプ[card2]</label><br>
			<div style="margin-top: 5px;"><label><input type="checkbox" name="newtab-r" id="newtab-r" checked="">新しいタブで開く</label></div>
		</div>
		<h2>関連記事</h2>
		<div class="related-post-select-box">
			<h3>記事選定方法</h3>
			<div class="related-select-type sango-radio">
				<label><input type="radio" name="related-select-type" value="list-or-search-post" checked="">記事一覧またはキーワードで検索</label>
				<label><input type="radio" name="related-select-type" value="sango-post-url">記事URL</label>
				<label><input type="radio" name="related-select-type" value="sango-post-id">投稿ID</label>
			</div>
			<div class="list-or-search-post select-active">
				<?php related_post_list(); ?>
				<div class="search-post-list-box">
					<div class="sango-search-form">
						<input type="text" name="sango-search-keyword">
						<button class="button button-primary button-large" id="sango-search-post">検索</button>
					</div>
					<div class="sango-search-result"></div>
					<img class="loading" src="<?php echo plugins_url('../assets/img/loading.svg', __FILE__ ); ?>">
				</div>
			</div>
			<div class="sango-post-url">
				<input type="text" name="sango-post-url" placeholder="記事のURLを入力">
				<button class="button button-primary button-large">適用</button>
				<div>投稿IDを取得：<span class="sango-url-to-post-id"></span></div>
			</div>
			<div class="sango-post-id">
				<input type="text" name="sango-post-id" placeholder="記事のIDを入力">
			</div>
		</div>
	</div>
	<div class="sango-preview"></div>
</div>
<script>
	$('.sango-search-form input').keypress( function ( e ) {
		if ( e.which == 13 ) {
			$("#sango-search-post").click();
			return false;
		}
	});
	$('#sango-search-post').click(function(){
		var keyword = $('input[name=sango-search-keyword]').val();
		$(".sango-search-result").empty();
		$(".search-post-list-box img").show();
		$.ajax({
			dataType: "text",
			url: admin_ajax_url,
			data: {
				'action': 'sango_search_post',
				'keyword': keyword,
				'secure': '<?php echo wp_create_nonce('sango_search_keyword_ajax') ?>'
			},
			success: function (data){
				$(".search-post-list-box img").hide();
				data = data.replace(/\n/g, '<br>');
				var array = data.split("<br>");
				array.shift();
				array.pop();
				array.pop();
				$(".sango-search-result").html(data);
			},
		});
	});
	$('.sango-post-url button').click(function(){
		var keyword = $('input[name=sango-post-url]').val();
		$.ajax({
			dataType: "text",
			url: admin_ajax_url,
			data: {
				'action': 'sango_url_post',
				'keyword': keyword,
				'secure': '<?php echo wp_create_nonce('sango_url_post_ajax') ?>'
			},
			success: function (id){
				$(".sango-post-url span").text(id);
				var val = $('input[name=related-post-type]:checked').val();
				$(".sango-short-code").text('['+val+' id="'+id+'"]');
			},
		});
	});
</script>