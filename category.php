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

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post(); ?>

<div class="news-block">
<h2><?php the_title_attribute(); ?><span class="date"><?php echo get_the_date(); ?></span></h2>
<?php include("inc-module.php"); ?>
</div>

			<?php		// End the loop.
				endwhile; endif;
			?>

<div class="pagination">
    <?php global $wp_rewrite;
    $paginate_base = get_pagenum_link(1);
    if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
        $paginate_format = '';
        $paginate_base = add_query_arg('paged','%#%');
    }
    else{
        $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
        user_trailingslashit('page/%#%/','paged');;
        $paginate_base .= '%_%';
    }
    echo paginate_links(array(
        'base' => $paginate_base,
        'format' => $paginate_format,
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5,
        'current' => ($paged ? $paged : 1),
        'prev_text' => '<',
        'next_text' => '>',
    )); ?>
</div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
