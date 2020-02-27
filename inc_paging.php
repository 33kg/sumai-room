	<ul class="paging">
	<?php 
	$paged = ViewUtil::getPaged();
	$pagination = ViewUtil::pagination(ceil($estate_count / $posts_per_page), $paged,  3, ViewUtil::getUrl());
	echo $pagination;
	?>
	</ul>