<div class="timeline">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<?php wp_editor("[timeline]\n[tl label='STEP.1' title='タイトル1'] 中身1 [/tl]\n[tl label='STEP.2' title='タイトル2'] 中身2 [/tl]\n[tl label='STEP.3' title='タイトル3'] 中身3 [/tl]\n[tl label='STEP.4' title='タイトル4'] 中身4 [/tl]\n[tl label='STEP.5' title='タイトル5'] 中身5 [/tl]\n[/timeline]",'timeline-content',array( 'media_buttons'=>true,'textarea_name'=>'timeline-content','editor_class'=>'timeline-content')); ?>
		<button class="button button-primary button-large commmon-btn">適用</button>
	</div>
	<div class="sango-preview"></div>
</div>