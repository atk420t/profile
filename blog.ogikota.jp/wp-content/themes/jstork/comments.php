<?php
if ( post_password_required() ) {
  return;
}
?>

<?php if ( have_comments() ) : ?>
<h3 id="comments-title" class="h2"><i class="fa fa-comments-o fa-lg"></i>  <?php comments_number( __( 'コメントはまだありません。', 'moaretrotheme' ), __( '<span>1</span> 個のコメント', 'moaretrotheme' ), __( '<span>%</span> 件のコメント', 'moaretrotheme' ) );?></h3>
<section class="commentlist">
<?php
  wp_list_comments( array(
    'reply_text'        => __('返信する', 'moaretrotheme'),
    'reverse_children' => 'true'
  ) );
?>
</section>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav class="navigation comment-navigation" role="navigation">
  <div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; 前のコメント', 'moaretrotheme' ) ); ?></div>
  <div class="comment-nav-next"><?php next_comments_link( __( '次のコメント &rarr;', 'moaretrotheme' ) ); ?></div>
</nav>
<?php endif; ?>
<?php if ( ! comments_open() ) : ?>
<?php endif; ?>
<?php endif; ?>
<?php comment_form(); ?>