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

<div class="content-area" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>category/topics">トピックス</a></li>
	</ul>

	<div class="column-wrap">
		<h2>TOPICS<span>住まいるーむ情報</span></h2>
		<div class="colum2-main">
			<section class="wrap-block">
				
				<ul class="topics">
				<li><?php include("inc_topics.php"); ?></li>
				<?php //繰り返し部分  ?>
				<li><?php include("inc_topics.php"); ?></li>
				<li><?php include("inc_topics.php"); ?></li>
				<li><?php include("inc_topics.php"); ?></li>
				<li><?php include("inc_topics.php"); ?></li>
				<?php // ./繰り返し部分  ?>
				</ul>
			</section>
		</div>
		<div class="colum2-sub">
<?php include("inc_topics_side.php"); ?>

		</div>
	</div>
	

</div><!-- .content-area -->

<?php get_footer(); ?>
