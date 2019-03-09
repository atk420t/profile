<?php
$is_rakuten = $this->is_search_from_rakuten( $this->array_get( $meta_datas, self::SEARCH_SHOP_VALUE, '') );

$image_class = $this->getImageClass( $atts[ 'size' ] );
?>
<div class="yyi-rinker-contents yyi-rinker-postid-<?php echo esc_attr( $post_id )?> <?php echo esc_attr( $image_class ) ?>">
	<div class="yyi-rinker-box">
		<div class="yyi-rinker-image">
			<?php if ( $is_rakuten ) { ?>
				<?php echo  isset( $rakuten_image_link ) ? $rakuten_image_link : '';?>
			<?php } else { ?>
				<?php echo  isset( $amazon_image_link ) ? $amazon_image_link : '';?>
			<?php } ?>
		</div>
		<div class="yyi-rinker-info">
			<div class="yyi-rinker-title">
				<?php if ( $is_rakuten ) { ?>
					<?php echo  isset( $rakuten_title_link ) ? $rakuten_title_link : '';?>
				<?php } else { ?>
					<?php echo  isset( $amazon_title_link ) ? $amazon_title_link : '';?>
				<?php } ?>
			</div>
			<div class="yyi-rinker-detail">
				<?php if ( isset( $credit) ) { ?>
					<div class="credit"><?php echo $credit ?></div>
				<?php } ?>
				<?php if ( strlen( $meta_datas[ 'brand' ] ) > 0 ) { ?>
					<div class="brand"><?php echo esc_html( $meta_datas[ 'brand' ] ); ?></div>
				<?php } ?>
					<div class="price-box">
				<?php if ( strlen( $meta_datas[ 'price' ] ) > 0 && intval( $meta_datas[ 'price' ] ) > 0) { ?>
					<span title="" class="price"><?php echo esc_html( '¥' . number_format( intval( $meta_datas[ 'price' ] ) ) ); ?></span>
					<?php if ( strlen( $meta_datas[ 'price_at' ] ) > 0 ) { ?>
						<?php if ( $is_rakuten ) { ?>
							<span class="price_at">(<?php echo esc_html( $meta_datas[ 'price_at' ] ); ?>時点&nbsp;楽天市場調べ-</span><span title="このサイトで掲載されている情報は当サイトの作成者により運営されています。価格、販売可能情報は、変更される場合があります。購入時に楽天市場店舗（www.rakuten.co.jp）に表示されている価格がその商品の販売に適用されます。">詳細)</span>
							<?php } else { ?>
							<span class="price_at">(<?php echo esc_html( $meta_datas[ 'price_at' ] ); ?>時点&nbsp;Amazon調べ-</span><span title="価格および発送可能時期は表示された日付/時刻の時点のものであり、変更される場合があります。本商品の購入においては、購入の時点でAmazon.co.jpに表示されている価格および発送可能時期の情報が適用されます。">詳細)</span>
							<?php } ?>
					<?php } ?>
				<?php } ?>
					</div>
			</div>
			<ul class="yyi-rinker-links">
				<?php if( isset( $meta_datas[ self::FREE_URL_1_COLUMN ] ) &&  strlen( $meta_datas[ self::FREE_URL_1_COLUMN ] ) > 0 ) { ?>
					<li class="freelink1">
						<?php echo ($meta_datas[ self::FREE_URL_1_COLUMN ]) ?>
					</li>
				<?php } ?>
				<?php if ( isset( $meta_datas[ 'amazon_url' ] ) &&  strlen( $meta_datas[ 'amazon_url' ] ) > 0 ) { ?>
					<li class="amazonlink">
						<?php echo isset( $amazon_link ) ? $amazon_link : ''; ?>
					</li>
				<?php } ?>
				<?php if ( isset( $meta_datas[ 'rakuten_url' ] ) &&  strlen( $meta_datas[ 'rakuten_url' ] ) > 0 ) { ?>
					<li class="rakutenlink">
						<?php echo  isset( $rakuten_link ) ? $rakuten_link : '';?>
					</li>
				<?php } ?>
				<?php if ( isset( $meta_datas[ 'yahoo_url' ] ) && strlen( $meta_datas[ 'yahoo_url' ] ) > 0 ) { ?>
					<li class="yahoolink">
						<?php echo  isset( $yahoo_link ) ? $yahoo_link : '';?>
					</li>
				<?php } ?>
				<?php if ( isset( $meta_datas[ self::FREE_URL_2_COLUMN ] ) &&  strlen( $meta_datas[  self::FREE_URL_2_COLUMN ] ) > 0 ) { ?>
					<li class="freelink2">
						<?php echo $meta_datas[ self::FREE_URL_2_COLUMN ] ?>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
