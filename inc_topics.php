<?php
	$args = array(
		'posts_per_page' => 5,
		'post_type' => 'post',
		'category' => array('newstopics', 'news'),

	);
	$topics = get_posts( $args );
	foreach( $topics as $post ) :
		setup_postdata( $post );
?>
<li>
<a href="<?php the_permalink(); ?>">
	<?php if( has_post_thumbnail() ) :?>
		<p class="img"><?php the_post_thumbnail( 'thumbnail' ); ?></p>
	<?php else : ?>
		<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/30564108.png"></p>
	<?php endif; ?>
	<p class="title"><?php the_title(); ?></p>
	<p class="kind"><span>INFORMATION</span></p><?// INFORMATIONとTOWNの出し分けできますか？　?>
	<p class="date"><?php echo date( "Y/m/d", strtotime( $post->post_date ) ); ?></p>
</a>
</li>
<?php
	endforeach;
	wp_reset_postdata();
?>
