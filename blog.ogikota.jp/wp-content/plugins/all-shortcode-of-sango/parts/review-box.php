<div class="review-box">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<?php wp_editor("[rate title='この本の評価']\n[value 3.5]読みやすさ[/value]\n[value 4]面白さ[/value]\n[value 5]デザインの美しさ[/value]\n[value 2]値段[/value]\n[value 1.5]コレクション性[/value]\n[value 4.5 end]総合評価[/value]\n[/rate]",'review-content',array( 'media_buttons'=>false,'textarea_name'=>'review-content','editor_class'=>'review-content')); ?>
		<button class="button button-primary button-large commmon-btn">適用</button>
	</div>
	<div class="sango-preview"></div>
</div>