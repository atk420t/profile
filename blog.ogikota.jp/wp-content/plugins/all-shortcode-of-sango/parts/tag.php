<div class="tag">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<h2>指定するタグ</h2>
		<?php
			echo '<select id="tag-list">';
			$get_tag = get_tags();
  			foreach($get_tag as $val) {
    			echo '<option value="'.$val->term_id.'">'.$val->name.'</option>';
			}
			echo '</select>';
		?>
		<h2>表示する記事数</h2>
		<input type="text" name="tag-post-count">
		<button class="button button-primary button-large commmon-btn">適用</button>
	</div>
	<div class="sango-preview"></div>
</div>
