<?php 
//会員
$kaiin = 0;
if( !is_user_logged_in() && get_post_meta($meta_id, 'kaiin', true) == 1 ) $kaiin = 1;
//ユーザー別会員物件リスト
//$kaiin2 = users_kaiin_bukkenlist($meta_id,$kaiin_users_rains_register, get_post_meta($meta_id, 'kaiin', true) );
$kaiin2 = $show_bukken;

?>
<?php //echo $wpdb->num_queries;exit;?>
<?php //$imgs = FudoUtil::thumb($meta_id, $kaiin, $kaiin2) ?>
<?php $imgs = FudoUtil::fudoimgurls($meta_id, $img_infos, $attachment_data) ?>
<div class="looptit">
	<?php if(FudoUtil::hasNew($meta_data->post_date)):?>
		<img src="<?php bloginfo('template_url'); ?>/images/loop/new.gif" alt="NEW">
	<?php endif?>
	<a href="?post_type=fudo&p=<?php echo $meta_data->ID?>"><?php echo FudoUtil::bukkennmei($meta_id)?><!--<?php echo FudoUtil::title($meta_id)?>--></a></div>
<div class="loopcontent clearfix">
	<div class="imgarea">
		<a href="<?php echo ViewUtil::detailUrl($meta_data)?>"><img src="<?php echo $imgs[0]['img_url'] ?>" alt="" class="over" width="100" height="100"></a>
		<a href="<?php echo ViewUtil::detailUrl($meta_data)?>"><img src="<?php echo $imgs[1]['img_url'] ?>" alt="" class="over" width="100" height="100"></a>
	</div>

<dl>
<dt>	
<table>
	<tr>
		<th colspan="4" class="hdata">価格<span style="color:red;font-weight:bold;margin:0 10px;"><?php echo FudoUtil::kakaku($meta_id, $kaiin, $kaiin2)?></span><?php echo my_custom_bukkenshubetsu_print($meta_id); ?>　
			<?php if(FudoUtil::isMadoriValue($meta_id)):?>
				間取り
				<span style="color:red;font-weight:bold;margin:0 10px;">
				<?php echo FudoUtil::madori($meta_id, $kaiin, $kaiin2)?>
				</span>
			<?php endif?>
		</th>
	</tr>
	<tr><th>所在地</th><td colspan="3"><?php echo FudoUtil::shozaichi($meta_id)?></td></tr>
	<tr><th>交通</th><td colspan="3"><?php echo FudoUtil::koutsu1($meta_id, true, false)?></td></tr>
    <tr><th>面積</th><td><?php echo FudoUtil::menseki($meta_id, $kaiin, $kaiin2)?></td>
      <th>築年月</th>
      <td><?php echo FudoUtil::chikunenn($meta_id)?></td>
    </tr>

	<tr><th>地積</th><td colspan="3"><?php echo FudoUtil::tochikukaku_menseki($meta_id, $kaiin,$kaiin2)?></td></tr>

</table>
<!--<a href="#"><img src="<?php bloginfo('template_url'); ?>/images/loop/btn_cart.jpg" class="over" alt="お問合せ候補に追加"></a>-->

<a class="addKouho" id="addKouho_<?php echo $meta_id?>">
	<?php if(!FudoUtil::isFavorite($meta_id)):?>
		<img id="kouhoimg_<?php echo $meta_id?>" src="<?php bloginfo('template_url'); ?>/images/loop/btn_cart.png" class="over" alt="お問合せ候補に追加">
	<?php else:?>
		<img id="kouhoimg_<?php echo $meta_id?>" src="<?php bloginfo('template_url'); ?>/images/loop/btn_cartin.png" class="over" alt="お問合せ候補に追加">
	<?php endif?>
</a>
<a href="<?php echo ViewUtil::detailUrl($meta_data)?>">
	<img src='<?php bloginfo('template_url'); ?>/images/loop/btn_syosai.png' alt='物件の詳細を見る' class='btn_syosai'>
</a>
</dt>
</dl>
</div>
