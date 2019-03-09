<style>
	img{
		display: none;
		position: absolute;
		top: 35%;
		left: 35%;
		width: 20%;
	}
	.match-box-out{
		display: flex;
    	flex-wrap: wrap;
    	justify-content: space-evenly;
	}
	.match-box{
		width: 49%;
    	border: dotted;
    	box-sizing: border-box;
    	padding: 1%;
    	margin-bottom: 1%;
	}
</style>
<h1>キーワード検索</h1>
<input type="text" name="keyword" id="keyword">
<button class="button button-primary button-large" id="search-keyword">検索</button>
<div class="result-box"></div>
<img src="<?php echo '' . plugins_url( 'img/loading.svg', __FILE__ ) . '';?>">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
	var admin_ajax_url  = '<?php echo admin_url('admin-ajax.php', __FILE__); ?>';
	$( 'input' ).keypress( function ( e ) {
		if ( e.which == 13 ) {
			$("#search-keyword").click();
			return false;
		}
	});
	$('#search-keyword').click(function(){
		var keyword = $('input[name=keyword]').val();
		$("img").show();
		$.ajax({
			dataType: "text",
			url: admin_ajax_url,
			data: {
				'action': 'search_keyword',
				'keyword': keyword,
				'secure': '<?php echo wp_create_nonce('search_keyword_ajax') ?>'
			},
			success: function (data){
				data = data.replace(/\n/g, '<br>');
				var array = data.split("<br>");
				array.shift();
				array.pop();
				array.pop();
				$("img").hide();
				$(".result-box").html(data);
			},
		});
	});
</script>