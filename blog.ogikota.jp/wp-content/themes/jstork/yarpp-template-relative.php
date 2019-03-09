<?php if(have_posts()): ?>
<div class="related-box tmp-yarpp wow animated fadeIn cf">
    <div class="inbox">
	    <h2 class="related-h h_ttl"><span class="gf">RECOMMEND</span>こちらの記事も人気です。</h2>
	    <div class="related-post">
	    <ul class="related-list cf">
	<?php 
	    global $previousday;
	    $cnt = 1;
	    $class = "";
	 
	    while(have_posts()) : the_post();
	        $previousday = '';
	        if(($cnt % 2) == 0) {
	            $class="related-rightlist";
	        } else {
	            $class="related-leftlist";
	        }
	         
	        $cnt++;
	?>
	 
	        <li rel="bookmark" title="<?php the_title_attribute(); ?>">
		        <a href="<?php the_permalink(); ?>" rel=\"bookmark" title="<?php the_title_attribute(); ?>" class="title">
		        	<figure class="eyecatch">
	        <?php if(has_post_thumbnail()) { ?>
	                <?php the_post_thumbnail('post-thum'); ?>
	        <?php } else { ?>
	                <img src="<?php echo get_theme_file_uri('/library/images/noimg.png'); ?>" />
	        <?php } ?>
	        		<span class="cat-name"><?php $cat = get_the_category(); ?><?php $cat = $cat[0]; ?><?php echo get_cat_name($cat->term_id); ?></span>
		            </figure>
					<time class="date gf"><?php the_time( 'Y.n.j' ); ?></time>
					<h3 class="ttl">
						<?php if(mb_strlen($post->post_title)>35) { $title= mb_substr($post->post_title,0,35) ; echo $title. "…" ;
						} else {echo $post->post_title;}?>
					</h3>
				</a>
	        </li>
	         
	    <?php endwhile; ?>
	    </ul>
	    </div>
    </div>
</div>
<?php else: ?>
<div class="related-box cf">
    <div class="inbox">
	    <h2 class="related-h h_ttl"><span class="gf">Recommend</span>関連記事</h2>
	    <p class="related-none-h">関連記事は見つかりませんでした。</p>
	</div>
</div>
<?php endif; ?>