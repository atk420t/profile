<div class="category">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<h2>指定するカテゴリー</h2>
		<?php
			echo '<select id="cat-list">';
			$get_cat = get_categories();
  			foreach($get_cat as $val) {
    			echo '<option value="'.$val->cat_ID.'">'.$val->name.'</option>';
			}
			echo '</select>';
		?>
		<h2>表示する記事数</h2>
		<input type="text" name="cat-post-count">
		<button class="button button-primary button-large commmon-btn">適用</button>
	</div>
	<div class="sango-preview"></div>
</div>
