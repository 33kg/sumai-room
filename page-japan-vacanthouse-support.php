<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="content-area japan_vacant" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><?php wp_title(''); ?></li>
	</ul>

	<div class="column-wrap">
		<h2>JAPAN VACANT HOUSE SUPPORT<span>日本空き家サポート</span></h2>
		<section class="wrap-block">
			<img src="<?php echo get_template_directory_uri(); ?>/images/top/slide_akiya_PC.png">
		</section>


		<section class="wrap-block">
			<img src="<?php echo get_template_directory_uri(); ?>/images/japan-vacant/fig1.png">
		</section>
<?php /*/ ?>
		<section class="wrap-block">
			<img src="<?php echo get_template_directory_uri(); ?>/images/japan-vacant/fig2.png">
		</section>
<?php /*/ ?>
		<section class="wrap-block">
			<img src="<?php echo get_template_directory_uri(); ?>/images/japan-vacant/fig3.png">
		</section>

		<section class="wrap-block">
			<h3 class="double">POINT<span>メリット1</span></h3>
			<div class="wrap-inner">
				<strong>「日本空き家サポート」の空き家管理サービスは、こんなに安心！</strong>
				<p class="tex">日本空き家サポート運営会社の厳正な審査に基づいて提供している「空き家サポーター」は、建物維持管理業務に定評のある不動産関連企業ばかりです。住宅管理の専門家が、あなたの大切な資産をお守りします！</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3 class="double">POINT<span>メリット2</span></h3>
			<div class="wrap-inner">
				<strong>動画・写真が豊富な管理レポート! 紙のレポートとはココが違います！</strong>
				<p class="tex">「日本空き家サポート」の管理レポートは、ホームページ上のお客様専用「マイページ」にてご覧いただきますので、インターネットに接続できる環境さえあれば世界中どこにいても空き家の様子をご確認いただけます。また、管理作業の様子を撮影した動画、画像（写真）も豊富に含まれているため、紙のレポートでは伝わりにくい、空き家の「実際」の様子をご覧いただけます!</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3 class="double">POINT<span>メリット3</span></h3>
			<div class="wrap-inner">
				<strong>緊急時も安心！緊急時無料巡回点検！</strong>
				<p class="tex">河川の氾濫による浸水や台風による被害など、空き家周辺で緊急点検を要する事態が発生した場合の無料点検(※)を実施しているため、遠くに住んでいても安心です!緊急時の場合も、管理レポートにて空き家の様子をご確認いただけます。<br>
					※緊急時の判断は日本空き家サポート運営会社の基準によりますので、お客様のご指示にて点検を行うものではございません。</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3 class="double">POINT<span>メリット4</span></h3>
			<div class="wrap-inner">
				<strong>売買・賃貸など、空き家に関するあらゆるご相談にお応えします！</strong>
				<p class="tex">空き家サポーターは、空き家(住宅)に関するあらゆるご要望にお応えできるよう体制を整えています。売買・賃貸・リフォームなどのご相談を始め、空き家(住宅)の総合アドバイザーとして、是非ご活用ください!</p>
			</div>
		</section>

	</div>
	

</div><!-- .content-area -->

<?php get_footer(); ?>
