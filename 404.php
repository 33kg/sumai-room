<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header(); ?>

	<div id="content" style="height:50vh;padding:40px;">
		<section id="contents-inner">
			<h2>404 Not Found</h2>
				<p class="pageCopy">お探しのページは、移転したか削除された為、みつかりません。<br>
					トップページより改めてコンテンツをお楽しみください。</p>
				<a href="<?php echo home_url(); ?>" class="btnOrder"><?php wp_title(''); ?>｜トップページ</a>

			<div id="map"></div>

		</section>

<?php get_template_part( 'part-contNav' ); ?>

	</div>

<?php get_footer(); ?>