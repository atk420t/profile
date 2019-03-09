<?php
$main_c = get_theme_mod( 'main_color', '#6bb6ff');
$accent_c = get_theme_mod( 'accent_color', '#ffb36b');
?>
<style>
.main-bc {background-color: <?php echo $main_c; ?>;}
.main-bdr {border-color:  <?php echo $main_c; ?>;}
.accent-bc {background-color: <?php echo $accent_c; ?>;}
.cubic1.text3d.main-bc,.cubic1.text3d.main-bc:hover,.btn.btntext.main-bc{color : <?php echo $main_c; ?>;}
.cubic1.text3d.accent-bc,.cubic1.text3d.accent-bc:hover,.btn.btntext.accent-bc{color : <?php echo $accent_c; ?>;}
</style>
<div class="sango-modal-box">
	<div class="sango-modal wp-core-ui">
		<button type="button" class="sango-modal-close">
			<span class="sango-modal-icon">
				<span class="screen-reader-text">メディアパネルを閉じる</span>
			</span>
		</button>
		<div class="sango-modal-content">
			<div class="sango-left-menu">
				<div class="sango-menu">
					<a class="sango-menu-item active">アコーディオン</a>
					<a class="sango-menu-item">タイムライン</a>
					<a class="sango-menu-item">関連記事</a>
					<a class="sango-menu-item">他サイトへのリンク</a>
					<a class="sango-menu-item">線・点線を引く</a>
					<a class="sango-menu-item">補足説明</a>
					<a class="sango-menu-item">注意書き</a>
					<a class="sango-menu-item">ソースコードボックス</a>
					<a class="sango-menu-item">吹き出し</a>
					<a class="sango-menu-item">横並び2列</a>
					<a class="sango-menu-item">横並び3列</a>
					<!--<a class="sango-menu-item">YouTubeの埋め込み</a>-->
					<a class="sango-menu-item">表示分岐</a>
					<a class="sango-menu-item">指定のカテゴリー記事を表示</a>
					<a class="sango-menu-item">指定のタグを持つ記事を表示</a>
					<a class="sango-menu-item">画像上に文字をのせる</a>
					<a class="sango-menu-item">新着記事を好きな数だけ出力</a>
					<a class="sango-menu-item">レビューボックス</a>
					<a class="sango-menu-item">ボタン</a>
					<a class="sango-menu-item">ボックス</a>
				</div>
			</div>
			<div class="sango-frame-title">
				<h1>アコーディオン</h1>
			</div>
			<div class="sango-frame-router">
				<div class="sango-router">
					<a href="#" class="sango-menu-item sango-create active">ショートコードを作る</a>
					<a href="#" class="sango-menu-item sango-preview">ショートコードのプレビュー</a>
				</div>
			</div>
			<div class="sango-frame-content">
				<?php sango_modal_parts(); ?>
			</div>
			<div class="sango-frame-toolbar">
				<div class="sango-toolbar">
					<div class="sango-toolbar-primary">
						<button class="button sango-button button-primary button-large sango-button-insert">投稿に挿入</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="sango-modal-backdrop"></div>