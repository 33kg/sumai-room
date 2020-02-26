<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">


<div class="news-block">
<h2><?php the_title_attribute(); ?><span class="date"><?php echo get_the_date(); ?></span></h2>
<?php include("inc-module.php"); ?>
</div>

	</main><!-- .site-main -->


</div><!-- .content-area -->
<?php get_footer(); ?>
