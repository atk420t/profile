<style>
	#get-csv{
		margin-left: 1%;
	}
	#get-csv,.array{
		display: none;
	}
	img{
		display: none;
		position: absolute;
		top: 35%;
		left: 35%;
		width: 20%;
	}
	.result-box{
		margin-top:2%;
		display: flex;
    	flex-wrap: wrap;
    	justify-content: space-evenly;
	}
	.match-box{
		width: 31%;
    	border: dotted;
    	box-sizing: border-box;
    	padding: 1%;
    	margin-bottom: 1%;
    	text-align: center;
    	font-size: 18px;
	}
</style>
<h1>キーワード取得</h1>
<input type="text" name="keyword" id="keyword">
<button class="button button-primary button-large" id="get-keyword">取得</button>
<button class="button button-primary button-large" id="get-csv">CSVでダウンロード</button>
<a style="display:none;" id="downloader" href="#"></a>
<div class="array"></div>
<div class="result-box"></div>
<img src="<?php echo '' . plugins_url( 'img/loading.svg', __FILE__ ) . '';?>">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
	var admin_ajax_url  = '<?php echo admin_url('admin-ajax.php', __FILE__); ?>';
	$( 'input' ).keypress( function ( e ) {
		if ( e.which == 13 ) {
			$("#get-keyword").click();
			return false;
		}
	});
	$('#get-keyword').click(function(){
		var keyword = $('input[name=keyword]').val();
		$("#get-csv").hide();
		$("img").show();
		$(".result-box,.array").empty();
		$.ajax({
			dataType: "text",
			url: admin_ajax_url,
			data: {
				'action': 'keyword_get_tool',
				'keyword': keyword,
				'secure': '<?php echo wp_create_nonce('keyword_get_ajax') ?>'
			},
			success: function (data){
				data = data.replace(/\n/g, '<br>');
				var array = data.split("<br>");
				array.shift();
				array.pop();
				array.pop();
				$("img").hide();
				$(".array").html(data);
				$("#get-csv").show();
				$.each(array,function(index,val){
					$(".result-box").append('<div class="match-box">'+val+'</div>');
				});
			},
		});
		$('#get-csv').on('click',function(){
			//配列を取得する
			var data = $(".array").html();
			var array = data.split("<br>");
			array.shift();
			array.pop();
			array.pop();

   			// BOM の用意（文字化け対策）
   			var bom = new Uint8Array([0xEF, 0xBB, 0xBF]);

   			// CSV データの用意
   			var csv_data = array.join(',\r\n');
   			var blob = new Blob([bom, csv_data], { type: 'text/csv' });
   			var url = (window.URL || window.webkitURL).createObjectURL(blob);
   			var a = document.getElementById('downloader');
   			a.download = 'keyword.csv';
   			a.href = url;

    		// ダウンロードリンクをクリックする
    		$('#downloader')[0].click();

  		});
	});
</script>