<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="content-area" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search-rent">賃貸検索</a></li>
	</ul>

	<section class="wrap-block wrap-form">
		<h2>検索結果<span class="result-tex"><strong>10</strong>件中<strong>1〜5件</strong>表示しています</span></h2>
		<?php include("searchform_rent.php"); //賃貸検索フォーム ?>
		<?php include("inc_paging.php"); //ページング ?>
	</section>

	<?php include("inc_search-detail.php"); //検索結果一つ分 ?>

	<?php //繰り返し部分  ?>
	<?php include("inc_search-detail.php"); //検索結果一つ分 ?>
	<?php include("inc_search-detail.php"); //検索結果一つ分 ?>
	<?php include("inc_search-detail.php"); //検索結果一つ分 ?>
	<?php include("inc_search-detail.php"); //検索結果一つ分 ?>
	<?php include("inc_search-detail.php"); //検索結果一つ分 ?>
	<?php // ./繰り返し部分  ?>
	<?php include("inc_paging.php"); //ページング ?>

	<section class="wrap-block wrap-recently_seen">
		<h2>最近見た物件</h2>
		<ul class="recent-search">
		<li><?php include("inc_property_rent.php"); ?></li>
		<li><?php include("inc_property_rent.php"); ?></li>
		<li><?php include("inc_property_rent.php"); ?></li>
		<li><?php include("inc_property_rent.php"); ?></li>
		</ul>
		<div class="wrap-link"><a href="#">more</a></div>
	</section>



</div><!-- .content-area -->
<?php get_footer(); ?>
