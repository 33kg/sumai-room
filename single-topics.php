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

<div class="content-area single-topics" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>category/topics">トピックス</a></li>
	<li><?php wp_title(''); ?></li>
	</ul>

	<div class="column-wrap">
		<h2>TOPICS<span>住まいるーむ情報</span></h2>
		<section class="wrap-block">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/coffee-869203_1920.png"></p>
			<p class="kind"><span>TOWN</span></p><?// INFORMATIONとTOWNの出し分けできますか？　?>
			<p class="date">2019.11.8</p>
			<h3 class="title-topics"><?php wp_title(''); ?></h3>
			<p class="tex">ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト
				ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト
				ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト<br>
				ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキス</p>
		</section>
		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/auther.png"></p>
			<div class="wrap-tex">
				<p class="name"><span class="">この記事を書いた人</span>なまえ</p>
				<p class="tex">テキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキ</p>
			</div>
		</section>

		<ul class="paging_before_after">
		<li><a href="#">前の記事</a></li>
		<li><a href="#">次の記事</a></li>
		</ul>
	</div>
	

</div><!-- .content-area -->

<?php get_footer(); ?>
