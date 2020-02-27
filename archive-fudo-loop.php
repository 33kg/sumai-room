<?php 
//会員
$kaiin = 0;
if( !is_user_logged_in() && get_post_meta($meta_id, 'kaiin', true) == 1 ) $kaiin = 1;
//ユーザー別会員物件リスト
//$kaiin2 = users_kaiin_bukkenlist($meta_id,$kaiin_users_rains_register, get_post_meta($meta_id, 'kaiin', true) );
$kaiin2 = $show_bukken;
$post_id = $meta_data->ID;
$syubetu = FudoUtil::getSyubetu( $post_id );

?>
<?php //echo $wpdb->num_queries;exit;?>
<?php //$imgs = FudoUtil::thumb($meta_id, $kaiin, $kaiin2) ?>
<?php $imgs = FudoUtil::fudoimgurls($meta_id, $img_infos, $attachment_data) ?>

<a href="<?php echo get_permalink( $meta_data->ID ); ?>">
	<h2><?php echo FudoUtil::bukkennmei( $meta_id ); ?></h2>
	<ul class="room-detail">
	<li><img src="<?php echo $imgs[1]['img_url']; ?>"></li>
	<li>
		<?php if( $imgs[2] != "" ) :?><img src="<?php echo $imgs[2]['img_url']; ?>"><? endif; ?>
		<?php if( $imgs[3] != "" ) :?><img src="<?php echo $imgs[3]['img_url']; ?>"><? endif; ?>
		<?php if( $imgs[4] != "" ) :?><img src="<?php echo $imgs[4]['img_url']; ?>"><? endif; ?>
		<?php if( $imgs[0] != "" ) :?><img src="<?php echo $imgs[0]['img_url']; ?>"><? endif; ?>
	</li>
	<li>
		<p class="copy"><?php echo get_post_field( 'post_content', $meta_id ); ?></p>
		<?php if( $syubetu == SYUBETU_CHINTAI ): ?>
			<p class="price"><span class="price1">家賃</span><?php echo FudoUtil::kakaku($meta_id, $kaiin, $kaiin2); ?><span class="price2">（共益費　<?php echo FudoUtil::kyoueki_kannrihi( $meta_id );?>）</span></p>
		<?php else: ?>
			<p class="price"><span class="price1">価格</span><?php echo FudoUtil::kakaku($meta_id, $kaiin, $kaiin2)?></p>
		<?php endif; ?>
		<?php if($syubetu == SYUBETU_CHINTAI):?>
			<?php include("inc/bukken/inc-fudoinfo-chintai.php"); ?>
		<?php elseif($syubetu == SYUBETU_URICHI):?>
			<?php include("inc/bukken/inc-fudoinfo-urichi.php"); ?>
		<?php elseif($syubetu == SYUBETU_URIKODATE):?>
			<?php include("inc/bukken/inc-fudoinfo-urikodate.php");	?>
		<?php elseif($syubetu == SYUBETU_URIMANSION):?>
			<?php include("inc/bukken/inc-fudoinfo-urimansion.php"); ?>
		<?php elseif($syubetu == SYUBETU_URITATEMONO_ICHIBU):?>
			<?php include("inc/bukken/inc-fudoinfo-uritatemono-ichibu.php"); ?>
		<?php elseif($syubetu == SYUBETU_URITATEMONO_ZENBU):?>
			<?php include("inc/bukken/inc-fudoinfo-uritatemono-zenbu.php");	?>
		<?php endif?>
	</li>
	</ul>
</a>