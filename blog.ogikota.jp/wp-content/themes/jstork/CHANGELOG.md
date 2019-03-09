ストークテーマの更新履歴です。

**v1.2.3**
*2019-01-30*

- Gutenbergでキャプション付きの画像を投稿した場合の、画像下の余白の調整（style.css）
- グローバルナビ及びハンバーガーメニューwidgetを設置していなかった場合にスマートフォンのメニューボタンが表示されないように変更（header.php）
- アイコンフォント（fontawesome）をCDN型かサイト設置型かを選べるように変更（functions.php, library/customizer.php）
- 関連記事ショートコードに、固定ページへのリンク設定できるオプションを追加（library/shortcode.php）
- 関連記事ショートコードの呼び出しをWP_Queryに変更（library/shortcode.php）
- 関連記事ショートコードのCSS調整（library/css/shortcode.css）
- その他ショートコードのコードの微調整（library/shortcode.php）
- フッターナビ（ダッシュボード > 外観 > メニュー）を設定しなかった場合にコピーライトが中央表示されるように修正（footer.php, style.css, functions.php）
- その他軽微な修正（functions.php）

*******************************************************************


**v1.2.2**
*2018-10-19*

- CSSの微調整（style.css）

*******************************************************************

**v1.2.1**
*2018-10-18*

- 一部のCSSclassをbodyに出力するように仕様変更（header.php, footer.php, style.css, library/customizer.php）
- ヘッダーとフッターのスタイリング用のclass名を変更（style.css, library/customizer.php）
- フッター内のソースコードを修正（footer.php, style.css）
- サイドバーを右側に表示した際のバグを修正（style.css）
- Gutenberg利用時のeditorスタイルの調整（library/css/editor-style.css）
- Google+ボタンの廃止、LINEボタンの追加（parts_sns.php, parts_sns_short.php, style.css）
- ユーザー > あなたのプロフィール ページで設定できるWEBサービスを追加（functions.php, parts_singlefoot.php, style.css, library/customizer.php）
- functions.phpファイル内のコメントや改行の調整（functions.php, library/customizer.php, library/admin.php）
- 記事一覧ページのカスタマイザーでの設定場所を「記事一覧ページ設定」に変更しました（library/customizer.php）
- FontawesomeをCDNからファイル設置型に変更（functions.php）
- CSSの微調整（library/customizer.php, style.css）

*******************************************************************

**v1.2.0**
*2018-10-01*

- サイドバーウィジェットを設定しなかった場合に、タブレット端末にてワンカラム表示されない不具合を修正（library/admin.php）
- 記事検索結果ページにてワンカラムの表示崩れを修正（style.css）
- Gutenbergの編集画面にてスタイルを一部適用（library/css/editor-style.css, library/admin.php）
- ヘッダー（header.php）内のグローバルナビ周りのコード修正、それに伴うCSSの修正（header.php, style.css）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.9**
*2018-09-14*

- ウィジェットをPHP7に対応 ※PHP5.3以下では動きません。サーバーのコントロールパネルにてPHPのバージョンアップが必要となります。（library/widget.php）
- CSS, JavaScriptの読み込みを get_theme_file_uri() に変更（functions.php）
- noimage画像の読み込みを get_theme_file_uri() に変更（single.php, singleparts_full.php, parts_homeheader.php, parts_singlefoot.php, related-entries.php, yarpp-template-relative.php, parts_archive_card.php, parts_archive_simple.php, library/widget.php）
- パンくずナビをカスタム投稿タイプに対応（BETA）（functions.php）
- パンくずナビの表示オプションで、表示場所を「ページ下部」に表示するオプションを追加（header.php, footer.php, functions.php）
- esc_urlによるエスケープ処理を追加（functions.php, header.php, footer.php, parts_singlefoot.php）
- 各種スタイルシートのコメントやインデントの調整（style.css, library/css/lp.css, library/css/shortcode.css）
- header.phpに読み込まれていた一部classをbodyに付与するように変更（library/admin.php, header.php）
- サイドバーウィジェット（PC:メインサイドバー、PC:スクロール領域）を設定しなかった場合に、アーカイブページがワンカラムに（library/admin.php, style.css）
- その他軽微な調整（parts_sns.php, parts_sns_short.php, parts_homeheader.php）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.8**
*2018-06-21*

- CSSの軽度な修正（style.css, library/customizer.php）

*******************************************************************

**v1.1.7**
*2018-04-04*

- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.6**
*2018-03-26*

- ヘッダーのSearchボタン、グローバルナビ周りのCSS崩れを修正（style.css）
- 検索結果ページのデザイン崩れを修正（parts_archive_big.php）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.5**
*2018-02-02*

- 固定ページにて「ランディングページ」テンプレートが選択できるようになりました。（page-lp.php, header.php, footer.php, functions.php, single-post_lp.php）
- ショートコードでリッチボタンの色数を増やしました。（library/css/shortcode.css）
- トップページスライドショーの軽度な修正（parts_homeheader.php）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.4**
*2017-12-26*

- 投稿者プロフィール欄にInstagramアカウントを追加。【ユーザー > あなたのプロフィール】の「Instagram」にURLを登録することで表示されます。（functions.php, parts_singlefoot.php）
- 記事下広告ウィジェットでPC用のウィジェットがタブレットで表示されていたバグを修正（single.php, singlepartsfull.php）
- class出力用のコードの軽度な修正（header.php, footer.php）
- feedlyボタンの修正
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.3**
*2017-09-25*

- 「box」ショートコード機能の追加（library/shortocde.php、library/css/shortocde.css）
- パンくずナビのバグ修正（functions.php）
- ショートコードのNoticeエラーの解消（library/shortocde.php）
- CSSの軽度な修正（style.css）

*******************************************************************


**v1.1.2**
*2017-03-30*

- YouTubeの埋め込み動画の比率をレスポンシブ対応（style.css）
- ストークデフォルトのfaviconを表示させないように仕様変更（header.php）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.1**
*2017-02-23*

- 固定ページ下にもCTAウィジェットを表示するかどうか選択できるオプションを追加 【外観 > カスタマイズ > 投稿・固定ページ設定 > 固定ページにもCTAウィジェットを表示する より設定可能】（customizer.php, page.php, page-full.php）
- 投稿者情報を表示しないようにするオプションを追加【外観 > カスタマイズ > 投稿・固定ページ設定 > 記事下に投稿者情報を表示しない より設定可能】（parts_singlefoot.php）
- ヘッダー下お知らせリンクを別タブで開くオプションを追加（customizer.php, header.php）
- 記事一覧テンプレートにclass名を出力（parts_archives_simple.php, parts_archives_card.php, parts_archives_magazine.php）
- 英単語が途中で改行されないように仕様変更（style.css）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.1.0**
*2017-01-19*

- ボタン用CSSの修正（library/css/shortcode.css）
- inputタグ（フォームタグ）のCSS修正（style.css）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.0.9**
*2017-01-12*

- カテゴリウィジェットの投稿数が4桁以上になった場合の不具合を修正（library/widget.php）
- SNSボタンのバグを修正（parts_sns_short.php）
- 関連記事部分のバグを修正（related-entries.php, yarpp-template-relative.php）
- 日付部分の構造化データのタグを修正（single.php, singleparts_full.php）
- ショートコードボタンのCSSを修正（library/shortcode.php）
- CSSの軽度な修正（style.css）

*******************************************************************

**v1.0.8**
*2016-11-27*

- 関連記事テンプレートファイルの読み込みをincludeからget_template_partに変更（parts_singlefoot.php）
- post_class()で独自classを追加するように仕様変更（library/admin.php）
- CSSの微調整（style.css）

*******************************************************************

**v1.0.7**
*2016-11-18*

- ショートコードの軽度なバグを修正（library/shortcode.php）

*******************************************************************

**v1.0.6**
*2016-11-17*

- ショートコードの軽度なバグを修正（library/shortcode.php）
- パンくずナビの構造化データのエラーを修正（functions.php）
- CSSの修正:スマートフォンの検索ウィジェットの表示崩れを修正（style.css）

*******************************************************************

**v1.0.5**
*2016-11-09*

- トップページスライダーでアイキャッチが設定されていない場合のラベルがうまく表示されないバグを修正（parts_homeheader.php）
- CSSの微調整（style.css）

*******************************************************************

**v1.0.4**
*2016-10-20*

- ショートコード用CSSの微調整（library/css/shortcode.css）
- SNSボタン「feedly」のリンク先のバグを調整（parts_sns.php）
- CSSの微調整（style.css）

*******************************************************************

**v1.0.3**
*2016-09-28*

- Fontawesome（アイコンフォント）をwp_enqueue_styleで読み込むように変更（functions.php , style.css）
- Googleフォントをwp_enqueue_styleで読み込むように変更（functions.php , style.css）
- サイドバーのスクロール追従ウィジェットのCSSを微調整（sidebar.php , style.css）
- ショートコードに[立体的なボタン](https://open-cage.com/stork/document/shortcode/#i-5)を追加（library/css/shortcode.css）
- 構造化データの一部仕様変更（hentryクラスを投稿ページ以外では出力されないようにしました）（library/admin.php , parts_archive_card.php , parts_archive_simple.php , parts_archive_magazine.php）
- その他CSSの微調整（style.css）

*******************************************************************

**v1.0.2**
*2016-07-17*

- フォントサイズに関する修正
- 小さなバグの修正

*******************************************************************

**v1.0.1**
*2016-07-14*

- 注意説明のショートコード内に別のショートコードを設置した場合の不具合を解消
- フッター部分の余白のバグを修正
- ランディングページのCSS（lp.css）を修正

*******************************************************************

**v1.0.0**
*2016-05-30*

- ロゴを中央配置した場合のグローバルナビの表示崩れを修正
- PICKUPスライダーのちらつきを修正
- ランディングページの表示崩れを修正
- textareaのCSSを修正