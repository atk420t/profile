<div class="accordion active">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<h2>タイトル</h2>
		<div class="title-box">
			<input type="text" name="accordion-title">
		</div>
		<h2>隠したいコンテンツ</h2>
		<div class="hidden-content">
			<?php wp_editor('隠したいコンテンツ','accordion-hidden-content',array('media_buttons'=>true,'textarea_name'=>'accordion-hidden-content','editor_class'=>'accordion-hidden-content') ); ?>
		</div>
		<button class="button button-primary button-large commmon-btn">適用</button>
	</div>
	<div class="sango-preview"></div>
</div>
<script>
	var admin_ajax_url  = '<?php echo admin_url('admin-ajax.php', __FILE__); ?>';
	function sango_short_code(ele,short_code){
		$.ajax({
			dataType: "text",
			url: admin_ajax_url,
			data: {
				'action': 'sango_short_code_echo',
				'short_code': short_code,
				'secure': '<?php echo wp_create_nonce('echo_sango_short_code') ?>'
			},
			success: function (data){
				$(ele).html(data);
			},
		});
	}
	function escape_html(str){
  		str = str.replace(/&/g, '&amp;');
  		str = str.replace(/>/g, '&gt;');
  		str = str.replace(/</g, '&lt;');
  		str = str.replace(/"/g, '&quot;');
  		str = str.replace(/'/g, '&#x27;');
  		str = str.replace(/`/g, '&#x60;');
  		return str;
	}
	function get_tinymce_content(val){
  		if ($('.'+val+'.wp-editor-area').css('display') == 'none') {
     		return $('*[data-id="'+val+'"]', jQuery('#'+val+'_ifr').contents()).html();
	  	} else {
	    	return $('[name='+val+']').val();
	  	}
	}
</script>