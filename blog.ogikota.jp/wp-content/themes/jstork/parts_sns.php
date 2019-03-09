<?php
  $url_encode=urlencode(get_permalink());
  $site_title_encode=urlencode(get_home_url());
  $title_encode=urlencode(get_the_title());
  $tw_url = get_the_author_meta( 'twitter' );
  $tw_domain = array("http://twitter.com/"=>"","https://twitter.com/"=>"","//twitter.com/"=>"");
  $tw_user = '&via=' . strtr($tw_url , $tw_domain);
  $rssencode = urlencode(get_bloginfo('rss2_url'));
  $fdly_url = array("http%3A%2F%2F"=>"","https%3A%2F%2F"=>"");
  $plainurl= strtr( $rssencode, $fdly_url );
?>

<div class="share">
<div class="sns">
<ul class="cf">

<li class="twitter"> 
<a target="blank" href="//twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo urlencode( the_title( "" , "" , 0 ) ) ?><?php if(get_the_author_meta('twitter')) : ?><?php echo $tw_user ;?><?php endif ;?>&tw_p=tweetbutton" onclick="window.open(this.href, 'tweetwindow', 'width=550, height=450,personalbar=0,toolbar=0,scrollbars=1,resizable=1'); return false;"><i class="fa fa-twitter"></i><span class="text">ツイート</span><span class="count"><?php if(function_exists('scc_get_share_twitter')) echo (scc_get_share_twitter()==0)?'':scc_get_share_twitter(); ?></span></a>
</li>

<li class="facebook">
<a href="//www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-facebook"></i>
<span class="text">シェア</span><span class="count"><?php if(function_exists('scc_get_share_facebook')) echo (scc_get_share_facebook()==0)?'':scc_get_share_facebook(); ?></span></a>
</li>

<li class="hatebu">       
<a href="//b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink() ?>&title=<?php echo urlencode( the_title( "" , "" , 0 ) ) ?>" onclick="window.open(this.href, 'HBwindow', 'width=600, height=400, menubar=no, toolbar=no, scrollbars=yes'); return false;" target="_blank"><span class="text">はてブ</span><span class="count"><?php if(function_exists('scc_get_share_hatebu')) echo (scc_get_share_hatebu()==0)?'':scc_get_share_hatebu(); ?></span></a>
</li>

<li class="line">
<a href="//line.me/R/msg/text/?<?php echo $title_encode . '%0A' . $url_encode;?>" target="_blank"><span>LINE</span></a>
</li>

<li class="pocket">
<a href="//getpocket.com/edit?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" onclick="window.open(this.href, 'FBwindow', 'width=550, height=350, menubar=no, toolbar=no, scrollbars=yes'); return false;"><i class="fa fa-get-pocket"></i><span class="text">Pocket</span><span class="count"><?php if(function_exists('scc_get_share_pocket')) echo (scc_get_share_pocket()==0)?'':scc_get_share_pocket(); ?></span></a></li>

<li class="feedly">
<a href="https://feedly.com/i/subscription/feed/<?php echo urlencode(bloginfo('rss2_url')) ;?>"  target="blank"><i class="fa fa-rss"></i><span class="text">feedly</span><span class="count"><?php if(function_exists('scc_get_follow_feedly')) echo (scc_get_follow_feedly()==0)?'':scc_get_follow_feedly(); ?></span></a></li>    
</ul>
</div>
</div>