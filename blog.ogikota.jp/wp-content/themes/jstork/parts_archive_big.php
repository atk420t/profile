<div class="post-list-big cf">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
<header class="entry-header article-header">
<p class="byline entry-meta vcard">
<?php
$cat = get_the_category();
$cat = $cat[0];
?>
<span class="date gf updated"><?php the_time('Y.m.d'); ?></span>
<span class="cat-name cat-id-<?php echo $cat->cat_ID;?>"><?php echo $cat->name; ?></span>
<span class="author" style="display: none;"><?php the_author(); ?></span>
</p>
<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
<?php if ( has_post_thumbnail()) : ?>
<figure class="eyecatch">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
</figure>
<?php endif; ?>
</header>

<section class="entry-content cf">
<?php the_excerpt(); ?>
<div class="readmore">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">続きを読む</a>
</div>
</section>
</article>
<?php endwhile; ?>

<?php elseif(is_search()): ?>
<article id="post-not-found" class="hentry cf">
<header class="article-header">
<h1>記事が見つかりませんでした。</h1>
</header>

<section class="entry-content">

<p>お探しのキーワードで記事が見つかりませんでした。別のキーワードで再度お探しいただくか、カテゴリ一覧からお探し下さい。</p>

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

<?php else : ?>
<article id="post-not-found" class="hentry cf">
<header class="article-header">
<h1>まだ投稿がありません。</h1>
</header>
<section class="entry-content">
<p>表示する記事がみつかりませんでした。</p>
</section>
</article>
<?php endif; ?>
</div>