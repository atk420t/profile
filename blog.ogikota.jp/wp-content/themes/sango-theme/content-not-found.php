<article class="notfound">
  <div class="nofound-title">
    <?php fa_tag("tint","tint",false); ?>
    <?php 
    if( is_search() || is_archive() ) {
      echo '記事が見つかりませんでした。';
    } else {
      echo 'お探しのページが見つかりませんでした。';
    } ?>
  </div>
  <div class="nofound-img"><img src="<?php echo get_template_directory_uri() . '/library/images/notfound.jpg'; ?>"><?php if(is_404())echo '<h2 class="dfont strong">404</h2>'?></div>
  <div class="nofound-contents">
    <?php if(is_search()): ?>
      <p>指定されたキーワードでは記事が見つかりませんでした。別のキーワード、もしくはカテゴリーから記事をお探しください。</p>
    <?php elseif(is_archive()): ?>
      <p>まだ記事が投稿されていません。以下でキーワードやカテゴリーから記事を探すことができます。</p>
    <?php else: ?>
      <p>お探しのページは「すでに削除されている」、「アクセスしたアドレスが異なっている」などの理由で見つかりませんでした。以下でキーワードやカテゴリーから記事を探すことができます。</p>
    <?php endif; ?>
    <?php get_search_form(); ?>
    <p>以下のカテゴリー一覧から記事を探すこともできます。</p>
    <div class="withtag_list">
      <span>カテゴリー</span>
      <ul>
        <?php wp_list_categories('depth=2&title_li=');?>
      </ul>
    </div>
    <div class="ct">
      <a class="raised accent-bc" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php fa_tag("home","home",false) ?> ホームに戻る</a>
    </div>
  </div>
</article>
