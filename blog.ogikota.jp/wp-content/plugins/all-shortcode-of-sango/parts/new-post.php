<div class="new-post">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<h2>表示する新着記事数</h2>
		<input type="text" name="new-post-count">
		<!--<h2>除外するカテゴリー</h2>
		<?php
			echo '<select id="cat-list">';
			$get_cat = get_categories();
  			foreach($get_cat as $val) {
    			echo '<option value="'.$val->cat_ID.'">'.$val->name.'</option>';
			}
			echo '</select>';
		?>-->
		<button class="button button-primary button-large commmon-btn">適用</button>
	</div>
	<div class="sango-preview"></div>
</div>
