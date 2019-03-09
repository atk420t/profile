<div class="show-branch">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<h2>〇〇のみで表示させる</h2>
		<div class="show-branch-type sango-radio">
			<label><input type="radio" name="show-branch" value="mobile" checked="">モバイル</label>
			<label><input type="radio" name="show-branch" value="pc">パソコン</label>
		</div>
		<h2>表示分岐コンテンツ</h2>
		<?php wp_editor('表示分岐コンテンツ','show-branch-content',array( 'media_buttons'=>true,'textarea_name'=>'show-branch-content','editor_class'=>'show-branch-content')); ?>
		<button class="button button-primary button-large commmon-btn">適用</button>
	</div>
	<div class="sango-preview"></div>
</div>