<div id="<?php echo( $this->prefix ); ?>">
	<div id="yyi-link-add-media-button" class="wp-media-buttons">
		<a id="yyirinker-media-button" href="<?php echo esc_attr( $src ); ?>" class="button thickbox add_media" title="商品情報を取得"><span class="yyirinker-buttons-icon"></span>商品情報を取得</a>
	</div>
	<div id="yyi-link-custom-fields">
		<?php foreach($this->custom_field_params AS $index => $values) { ?>
			<div class="yyi-link-custom-field-item <?php echo $values[ 'is_link' ] ?  'relink' : ''; ?>">
				<label class="linklabel" for="<?php echo esc_attr( $values[ 'key' ] ); ?>">
					<?php echo esc_html( $values[ 'label' ] ); ?>
				</label>
				<?php if ( self::SEARCH_SHOP_VALUE === $values[ 'key' ]) {
					$value = intval( get_post_meta( $post->ID, $this->custom_field_column_name( $values[ 'key' ] ), true ) );
					foreach( $this->search_shops AS $index => $shop_name ) {
						if ( $value === $index || ( $value === 0 && $index == 10 ) ) {
							$checked = 'checked="checked"';
						} else {
							$checked = '';
						}
						?>
						<input id="<?php echo esc_attr( $values[ 'key' ] . $index); ?>" type="radio" name="<?php echo esc_attr( $values[ 'key' ] ); ?>" value="<?php echo esc_attr( $index ) ?>" <?php echo $checked ?> />
						<label for="<?php echo esc_attr( $values[ 'key' ] . $index); ?>"><?php echo esc_html( $shop_name )?></label>
					<?php } ?>
				<?php } elseif ( self::IS_AMAZON_NO_EXIST === $values[ 'key' ] || self::IS_RAKUTEN_NO_EXIST === $values[ 'key' ] ) { ?>
					<?php $checked =  !!get_post_meta($post->ID, $this->custom_field_column_name( $values[ 'key' ] ), true) ? 'checked="checked"' : ''; ?>
					<input id="<?php echo esc_attr( $values[ 'key' ] ); ?>" type="checkbox" name="<?php echo esc_attr( $values[ 'key' ] ); ?>" value="1" <?php echo $checked ?> />
				<?php } else { ?>
				<input id="<?php echo esc_attr( $values[ 'key' ] ); ?>" type="text" name="<?php echo esc_attr( $values[ 'key' ] ); ?>" value="<?php echo esc_attr( get_post_meta($post->ID, $this->custom_field_column_name( $values[ 'key' ] ), true) ) ?>" />

				<?php } ?>
				<?php if ( $values[ 'is_link' ] ) { ?>
				<a class="yyi-rinker-confirm-link">確認</a>
				<?php } elseif ( $values[ 'key' ] === self::KEYWORD_COLUMN ) { ?>
					で以下のURLを<a class="yyi-rinker-relink">更新</a><span class="yyi-relink-message"></span>
				<?php }?>

			</div>
		<?php }?>

		<input id="yyi_rinker_from_page" type="hidden" name="yyi_rinker_from_page" value="main"/>

		<input id="yyi_post_contents" type="hidden" name="content" value=""/></div>

		<div id="yyi-loading">
			<img src="<?php echo esc_attr( $this->loading_img_url ); ?>">
		</div>
	</div>


<script type="text/javascript">
	(function ($) {
		$(document).ready(function(){
			yyi_add_shortcode_content();
		});
		$('#submitdiv').click(function() {
			yyi_add_shortcode_content();
		});

		$('input[name=post_title]').change(function() {
			yyi_add_shortcode_content();
		});

		$('div#yyi_afilinks_middle_link input').change(function() {
			yyi_add_shortcode_content();
		});

		yyi_add_shortcode_content = function() {
			var title = $('input[name=post_title]').val();
			title = title.replace('[', '【');
			title = title.replace(']', '】');
			var shortcode = '[itemlink title="'+ title +  '"]';
			$('#yyi_post_contents').val(shortcode);
		}

		//URLを貼り直す
		$('a.yyi-rinker-relink').click(function() {
			var element = $(this);
			var keywords = element.parent().find('input[name="<?php echo self::KEYWORD_COLUMN ?>"]').val();
			var message = $('.yyi-relink-message');

			var params = {
				action: 'yyi_rinker_relink',
				keywords: keywords,
			};

			$('div#yyi-loading img').show();
			$('.yyi-message').text('');

			$.ajax({
				url: '<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php',
				method: 'GET',
				dataType: 'json',
				data: params,
			}).done(function (data, textStatus, jqXHR) {
				$('#amazon_url').val(data.amazon_url);
				$('#rakuten_url').val(data.rakuten_url);
				$("#yahoo_url").val(data.yahoo_url);
				message.text('リンクを更新をしました');
			}).fail(function(jqXHR, textStatus, errorThrown){
				message.text('通信エラーで更新できませんでした');
			}).always(function (jqXHR, textStatus) {
				$('div#yyi-loading img').hide();
			});
		});
	})(jQuery);
</script>

