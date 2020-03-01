<?php
	// 不動産プラグイン 物件表示ウィジェットよりSQLを取得
	// 賃貸物件一覧の取得
	$sql = "SELECT DISTINCT P.ID,P.post_title,P.post_modified,P.post_date FROM ((((((((wp_posts AS P INNER JOIN wp_postmeta AS PM ON P.ID = PM.post_id) INNER JOIN wp_postmeta AS PM_1 ON P.ID = PM_1.post_id) ) ) ) ) INNER JOIN wp_term_relationships AS TR ON P.ID = TR.object_id) INNER JOIN wp_term_taxonomy AS TT ON TR.term_taxonomy_id = TT.term_taxonomy_id) WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' AND PM_1.meta_key='bukkenshubetsu' AND (PM.meta_key='fudoimg1' OR PM.meta_key='fudoimg2') AND PM.meta_value !='' AND TT.term_id = 16 AND CAST( PM_1.meta_value AS SIGNED )>3000 ORDER BY P.post_date DESC limit 5";

	$metas = $wpdb->get_results( $sql, ARRAY_A );

	foreach( $metas as $meta ) :
		// 不動産情報取得
		$post_id	= $meta['ID'];
		$post_title	= $meta['post_title'];
		$post_url	= get_permalink($post_id);

		//物件画像取得
		$fudoimg_data = get_post_meta( $post_id, 'fudoimg2', true );
		$image_sql = "";
		$image_sql .= "SELECT P.ID,P.guid";
		$image_sql .= " FROM $wpdb->posts AS P";
		$image_sql .= " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
		$image_metas = $wpdb->get_row($image_sql);

		$attachmentid = '';
		if(!empty($image_metas)) {
			$attachmentid  =  $image_metas->ID;
		}
		if ($attachmentid != '') {
			$fudoimg_data1 = wp_get_attachment_image_src($attachmentid, 'thumbnail');
			$fudoimg_url = $fudoimg_data1[0];
		}

		//所在地から余計なものをなくす
		$shozaichi = FudoUtil::shozaichi( $post_id );
		$shozaichi = str_replace( '山形県', '', $shozaichi );
		$shozaichi = str_replace( '西村山郡', '', $shozaichi );
?>
<div class="swiper-slide">
<div class="property"><?php //賃貸用表示 ?>
	<a href="<?php the_permalink( $post_id ); ?>">
	<?php if( $fudoimg_url != "" ):?>
		<p class="img"><img src="<?php echo $fudoimg_url; ?>">
	<?php else:?>
		<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/33677989.png">
	<?php endif;?>
	<span class="msg"><?php echo ltl_get_the_excerpt( $post_id, 13 ); ?></span>
	<span class="kind">RENT</span></p>
	<p class="price">月<?php echo FudoUtil::kakaku( $post_id, 0, 1 ); ?><span class="year">(共益費<?php echo FudoUtil::kyoueki_kannrihi( $post_id );?>)</span></p>
	<ul class="info1">
	<li><?php echo $shozaichi; ?>　<?php echo FudoUtil::madori( $post_id );?></li>
	<li>築年：<?php echo FudoUtil::chikunenn( $post_id ); ?></li>
	</ul>
	<ul class="info2">
	<li>敷金：<?php echo FudoUtil::shikikin( $post_id ); ?></li>
	<li>礼金：<?php echo FudoUtil::reikin( $post_id ); ?></li>
	</ul>
	</a>
</div>
</div>
<?php endforeach; ?>