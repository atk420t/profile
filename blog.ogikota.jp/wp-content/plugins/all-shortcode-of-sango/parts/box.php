<div class="box">
	<div class="sango-create">
		<div class="sango-short-code"></div>
		<button class="button button-primary button-large ex-btn">例を見る</button>
		<button class="button button-primary button-large back-btn">戻る</button>
		<div class="preview-box">
			<div class="box-list">
				<?php 
				for($i = 1;33 >= $i;$i++){
					echo '<div class="box-child">';
					echo "<h2>ボックス".$i."</h2>";
					echo do_shortcode('[box href="" class="box'.$i.'" title="ボックスのタイトル"]ここに文章を入力します[/box]');
					echo "</div>";
				}
				?>
			</div>
		</div>
		<div class="main-box">
			<h2>ボックスの種類</h2>
			<select id="box-type">
			<?php
			for($i = 1;33 >= $i;$i++){
    			echo '<option value="box'.$i.'">ボックス'.$i.'</option>';
			}
			?>
			</select>
			<h2>タイトル</h2>
			<input type="text" name="box-title" id="box-title">
			<h2>文章</h2>
			<textarea></textarea>
			<div><button class="button button-primary button-large common-btn">適用</button></div>
		</div>
	</div>
	<div class="sango-preview"></div>
</div>