
<li>
<a href="<?php the_permalink(); ?>">
	<?php if( has_post_thumbnail() ) :?>
		<p class="img"><?php the_post_thumbnail( 'full' ); ?></p>
	<?php else : ?>
		<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/topics/default.png"></p>
	<?php endif; ?>
	<p class="title"><?php the_title(); ?></p>
	<p class="kind"><span>INFORMATION</span></p><?// INFORMATIONとTOWNの出し分けできますか？　?>
	<p class="date"><?php echo date( "Y/m/d", strtotime( $post->post_date ) ); ?></p>
</a>
</li>
