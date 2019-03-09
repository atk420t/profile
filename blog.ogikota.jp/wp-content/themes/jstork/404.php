<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all t-all d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<article id="post-not-found" class="hentry cf">
							<header class="article-header">
								<h1>ページが見つかりませんでした。</h1>
							</header>
							<section class="entry-content">
								<p>お探しのページが見つかりませんでした。下記カテゴリーから記事をお探しになるか、キーワードで検索してみてください。</p>
							<div class="search">
								<h2>キーワード検索</h2>
								<?php get_search_form(); ?>
							</div>
							<div class="cat-list cf">
								<h2>カテゴリーから探す</h2>
							<ul>
							<?php $args = array(
								'title_li' => '',
							); ?>
							<?php wp_list_categories($args); ?>
							</ul>
							</div>
							</section>
						</article>
					</main>
					<?php get_sidebar(); ?>
				</div>
			</div>
<?php get_footer(); ?>
