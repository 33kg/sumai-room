<?php
class FudoUtil{
	public static function koutus_all_view($post_id){
		$ret = '';
		if(FudoUtil::isShowByKaiin($post_id) || get_option('kaiin_kotsu') == 1){
			$ret .= FudoUtil::koutsu1($post_id, false);
			if(FudoUtil::koutsu2($post_id, false)){
				$ret .='<br>';
				$ret .= FudoUtil::koutsu2($post_id, false);
			}
			if(FudoUtil::koutsusonota($post_id)){
				$ret .= '<br>';
				$ret .= FudoUtil::koutsusonota($post_id);
			}
		}else{
			$ret .= '会員限定公開';
		}
		return $ret;
	}
	public static function koutsu1($post_id, $strong=true, $cache_flg=true, $lifetime=30){
		if(!$cache_flg){
			return self::_koutsu1($post_id, $strong);
		}
		$option = array(
			"cacheDir" => "/tmp/",
			"lifeTime" => $lifetime
		);
		$cache = new Cache_Lite($option);
		$key = $post_id . 'koutsu1';
		$group = 'FudoUtil';
		if ($cache && ($data = $cache->get($key, $group))) {
			return unserialize($data);
		} else {
			$data = self::_koutsu1($post_id, $strong);
			$cache->save(serialize($data), $key, $group);
			return $data;
		}
	}
	public static function _koutsu1($post_id, $strong){
		ob_start();
		if(self::isShowByKaiin($post_id) || get_option('kaiin_kotsu') == 1){
			my_custom_koutsu1_print($post_id);
		}else{
			echo '会員限定公開';
		}
		$ret = ob_get_contents();
		ob_end_clean();
		if($strong){
			$tmps = explode(' ', $ret);
			$ret = $tmps[0] . ' <strong>';
			if(count($tmps) > 1){
				for($i=1;$i<count($tmps);$i++){
					$ret .= $tmps[$i] . ' ';
				}
			}
			$ret .=  '</strong>';
		}
		return $ret;
	}
	public static function koutsu2($post_id, $strong=true, $cache_flg=true, $lifetime=60){
		if(!$cache_flg){
			return self::_koutsu2($post_id, $strong);
		}
		$option = array(
			"cacheDir" => "/tmp/",
			"lifeTime" => $lifetime
		);
		$cache = new Cache_Lite($option);
		$key = $post_id . 'koutsu2';
		$group = 'FudoUtil';
		if ($cache && ($data = $cache->get($key, $group))) {
			return unserialize($data);
		} else {
			$data = self::_koutsu2($post_id, $strong);
			$cache->save(serialize($data), $key, $group);
			return $data;
		}
	}
	public static function _koutsu2($post_id, $strong=true){
		ob_start();
		if(self::isShowByKaiin($post_id) || get_option('kaiin_kotsu') == 1){
			my_custom_koutsu2_print($post_id);
		}else{
			echo '';
		}
		$ret = ob_get_contents();
		ob_end_clean();
		$ret = strip_tags($ret);
		if($strong){
			$tmps = explode(' ', $ret);
			if($ret) $ret = $tmps[0] . '<strong>' . $tmps[1] . '</strong>';
		}
		return $ret;
	}
	public static function koutsusonota($meta_id){
		ob_start();
		if(get_post_meta($meta_id, 'koutsusonota', true) !='') {
			echo get_post_meta($meta_id, 'koutsusonota', true).'';
		}
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function shozaichi($post_id, $cache_flg=true, $lifetime=60){
		if(self::isShowByKaiin($post_id) || get_option('kaiin_shozaichi') == 1){
		}else{
			return '会員限定公開';
		}
		if(!$cache_flg){
			return self::_shozaichi($post_id);
		}
		$option = array(
			"cacheDir" => "/tmp/",
			"lifeTime" => $lifetime
		);
		$cache = new Cache_Lite($option);
		$key = $post_id . 'shozaichi';
		$group = 'FudoUtil';
		if ($cache && ($data = $cache->get($key, $group))) {
			return unserialize($data);
		} else {
			$data = self::_shozaichi($post_id);
			$cache->save(serialize($data), $key, $group);
			return $data;
		}
	}
	public static function _shozaichi($meta_id){
		
		ob_start();
		self::my_custom_shozaichi_print($meta_id);
		echo ' ';
		echo get_post_meta($meta_id, 'shozaichimeisho', true);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function kakaku($meta_id, $kaiin=0, $kaiin2=1){
		ob_start();
//		if ( !my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){
//			echo "--";
//		}else{
		if(FudoUtil::isShowByKaiin($meta_id) || get_option('kaiin_kakaku') == 1){
			if( get_post_meta($meta_id, 'seiyakubi', true) != "" ){ echo '-- '; }else{
			self::my_custom_kakaku_print($meta_id); }
		}else{
			echo '会員限定公開';
		}
		
//		}
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function madori($meta_id, $kaiin=0, $kaiin2=1){
		ob_start();
		if(self::isShowByKaiin($meta_id)){
			self::my_custom_madorisu_print($meta_id);
		}else{
			echo '会員限定公開';
		}
//		if( my_custom_kaiin_view('kaiin_madori',$kaiin,$kaiin2) ){
//		}
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function menseki($meta_id, $kaiin=0, $kaiin2=1){
		ob_start();
		if(self::isShowByKaiin($meta_id) || get_option('kaiin_menseki') == 1){
			if(get_post_meta($meta_id, 'bukkenshubetsu', true) < 1200 ){
				if( get_post_meta($meta_id, 'tochikukaku', true) !="" ) echo get_post_meta($meta_id, 'tochikukaku', true).'m&sup2; ';
			}else{
				if( get_post_meta($meta_id, 'tatemonomenseki', true) !="" ) echo get_post_meta($meta_id, 'tatemonomenseki', true).'m&sup2; ';
			}
		}else{
			echo '会員限定公開';
		}
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function nengetu_replace($str){
		$ret = '';
		if(strlen($str) === 6){
			$ret = wordwrap($str, 4, '/', true);
		}else{
			$ret = $str;
		}
		return $ret;
	}
	public static function chikunenn($meta_id){
		$ret = '';
		if(self::isShowByKaiin($meta_id) || get_option('kaiin_tikunen') == 1){
			$ret = get_post_meta($meta_id, 'tatemonochikunenn', true);
			$ret = FudoUtil::nengetu_replace($ret);
		}else{
			$ret = '会員限定公開';
		}
		return $ret;
	}
	public static function bukken_bangou($meta_id,$kaiin,$kaiin2){
		if ( my_custom_kaiin_view('kaiin_shikibesu',$kaiin,$kaiin2) ){
			return get_post_meta($meta_id, 'shikibesu', true);
		}
		return '';
	}
	public static function title($meta_id){
		$shozaichi = self::shozaichi($meta_id);
		ob_start();
		self::my_custom_bukkenshubetsu_print($meta_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $shozaichi  .  ' '  . $ret;
	}
	public static function bukken_shubetu($meta_id){
		ob_start();
		self::my_custom_bukkenshubetsu_print($meta_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	/**
	 * 
	 * @global type $wpdb
	 * @param type $post_id
	 * @param type $options 
	 * example
	 * array(
			array('imgid' => 1,'size' => 'large'),
			array('imgid' => 2,'size' => 'large'),
			array('imgid' => 3,'size' => 'thumbnail'),
			array('imgid' => 4,'size' => 'thumbnail'),
	 * 
	 * )
	 * size full/large/medium/thumbnail
	 * @return string
	 */
	public static function img($post_id, $options, $cache_flg=false, $lifetime=60){
		if(!$cache_flg){
			$data = self::_img($post_id, $options);
			return $data;
		}
		$option = array(
			"cacheDir" => "/tmp/",
			"lifeTime" => $lifetime
		);
		$cache = new Cache_Lite($option);
		$key = $post_id . json_encode($options);
		$group = 'FudoUtil::img';
		if ($cache && ($data = $cache->get($key, $group))) {
			return unserialize($data);
		} else {
			$data = self::_img($post_id, $options);
			$cache->save(serialize($data), $key, $group);
			return $data;
		}
	}
	private static function _img($post_id, $options){
		global $wpdb;
		$ret = array();
		
		foreach($options as $option){
//		for( $imgid=1; $imgid <= $imgmax; $imgid++ ){
			$tmpArray = array();
			$tmpArray['img_url'] =  '';
			$tmpArray['width'] =  '';
			$tmpArray['height'] =  '';
			
			$imgid = $option['imgid'];
			$size = $option['size'];
			$fudoimg_data = get_post_meta($post_id, "fudoimg{$imgid}", true);
			$fudoimgcomment_data = get_post_meta($post_id, "fudoimgcomment{$imgid}", true);
			$fudoimg_alt = $fudoimgcomment_data . my_custom_fudoimgtype_print(get_post_meta($post_id, "fudoimgtype{$imgid}", true));

			if($fudoimg_data !="" ){

					$sql  = "";
					$sql .=  "SELECT P.ID,P.guid";
					$sql .=  " FROM $wpdb->posts as P";
					$sql .=  " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
					$metas = $wpdb->get_row( $sql );
					$attachmentid = '';
					if( !empty($metas) ){
						$attachmentid  =  $metas->ID;
						$guid_url  =  $metas->guid;
					}

					if($attachmentid !=''){
						//thumbnail、medium、large、full 
						$fudoimg_data1 = FudoUtil::wp_get_attachment_image_src( $attachmentid, $size, true);
						$fudoimg_url = $fudoimg_data1[0];

						if($fudoimg_url !=''){
							$tmpArray['img_url'] =  $fudoimg_url;
							$tmpArray['width'] =  'width="' . $fudoimg_data1[1] . '"';
							$tmpArray['height'] =  'height="' . $fudoimg_data1[2] . '"';
						}else{
							$tmpArray['img_url'] =  $guid_url;
						}
					}else{
						$tmpArray['img_url'] =  WP_PLUGIN_URL . '/fudou/img/nowprinting.jpg';
					}

			}else{
				if( $imgid==1 ){
					$tmpArray['img_url'] =  WP_PLUGIN_URL . '/fudou/img/nowprinting.jpg';
				}
			}
			$ret[] = $tmpArray;
		}
		$noimage = ($size === 'thumbnail') ? 'noimg150.gif' : 'noimg460.gif';
		if(count($ret) == 0){
			$ret[0] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
			$ret[1] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
		}
		else if(count($ret) == 1){
			$ret[1] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
		}
		else if(count($ret) <= 2){
			$target = site_url() . '/wp-content/plugins/fudou/img/nowprinting.jpg';
			if($ret[0]['img_url'] == $target || $ret[0]['img_url'] == ''){
				$ret[0]['img_url'] = get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}";
			}
			if($ret[1]['img_url'] == $target || $ret[1]['img_url'] == ''){
				$ret[1]['img_url'] = get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}";
			}
		}
		return $ret;
	}
	/**
	 * 画像URLの取得
	 * @param type $now_post_id
	 * 取得を行いたいpost_id
	 * @param type $img_infos
	 * NrPostModel->getFudoImgsで生成されたデータ
	 * @param type $attachment_data
	 * NrPostModel->getAttachimentImgDatas()で生成されたデータ
	 * array(
	 * '3032' => array('http://localhost/images/shibakoen.jpg',http://localhost/images/shibakoen.jpg)
	 * '4221' => array('http://localhost/images/xxxxxxx.jpg',http://localhost/images/yyyyyyy.jpg)
	 * )
	 * @param type $size full/large/medium/thumbnail
	 * @return type
	 */
	public static function fudoimgurls($now_post_id, $img_infos, $attachment_data, $size='thumbnail'){
		return self::_new_fudoimgurls($now_post_id, $img_infos, $attachment_data, $size);
//		return self::_fudoimgurls($now_post_id, $img_infos, $attachment_data, $size);
	}
	public static function _fudoimgurls($now_post_id, $img_infos, $attachment_data, $size='thumbnail'){
		$ret = array();
		$nrPostModel = NrPostModel::getInstance();
		foreach($img_infos as $img_info){
			if($now_post_id !== $img_info->post_id)continue;
			$post_id = $img_info->post_id;
			if(!$post_id)continue;
			$filename = $img_info->meta_value;
			if(!isset($attachment_data[ $post_id ])){
				continue;
			}
			$cache_life_time = 180;
			foreach($attachment_data[ $post_id ] as $att_data){
				$post_type = $att_data['post_type'];
				$url = $att_data['guid'];
				$attachment_id = $att_data['attachment_id'];
				if($post_type == 'fudo'){
					$attachment_id = $nrPostModel->getIDByImgName($filename);
					$fudoimg_data1 = FudoUtil::wp_get_attachment_image_src( $attachment_id, $size, false ,$cache_life_time);
					$fudoimg_url = $fudoimg_data1[0];

					if($fudoimg_url !=''){
						$tmpArray['img_url'] = $fudoimg_url;
					}else{
						$tmpArray['img_url'] = $url;
					}
					$ret[] = $tmpArray;
					
				}else{
				if(preg_match("#(.?+)/{$filename}#", $url))
				{
						$fudoimg_data1 = FudoUtil::wp_get_attachment_image_src( $attachment_id, $size, false ,$cache_life_time);
						$fudoimg_url = $fudoimg_data1[0];

						if($fudoimg_url !=''){
							$tmpArray['img_url'] = $fudoimg_url;
						}else{
							$tmpArray['img_url'] = $url;
						}
						$ret[] = $tmpArray;
					}
				}
			}
		}
		$noimage = ($size === 'thumbnail') ? 'noimg150.gif' : 'noimg460.gif';
		foreach($ret as &$_img){
			if(!preg_match("/.jpg|.gif|.png|.bmp|.jpeg/i", $_img['img_url'])){
				$_img['img_url'] = get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}";
			}
		}
		if(count($ret) == 0){
			$ret[0] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
			$ret[1] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
		}
		else if(count($ret) == 1){
			$ret[1] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
		}
		return $ret;
	}
	public static function _new_fudoimgurls($now_post_id, $img_infos, $attachment_data, $size){
		global $wpdb;
		$ret = array();
		$noimage = ($size === 'thumbnail') ? 'noimg150.gif' : 'noimg460.gif';
		foreach($img_infos as $img_info){
			if((int)$now_post_id !== (int)$img_info->post_id)continue;
			$post_id = $img_info->post_id;
			$fudoimg_data = get_post_meta($post_id, $img_info->meta_key, true);
//			$fudoimgcomment_data = get_post_meta($post_id, "fudoimgcomment$imgid", true);
//			$fudoimg_alt = $fudoimgcomment_data . my_custom_fudoimgtype_print(get_post_meta($post_id, "fudoimgtype$imgid", true));
			$tmpArray = array();
			if($fudoimg_data !="" ){

					$sql  = "";
					$sql .=  "SELECT P.ID,P.guid";
					$sql .=  " FROM $wpdb->posts as P";
					$sql .=  " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
				//	$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_row( $sql );
					$attachmentid = '';
					if( !empty($metas) ){
						$attachmentid  =  $metas->ID;
						$guid_url  =  $metas->guid;
					}

					if($attachmentid !=''){
						//thumbnail、medium、large、full 
						$fudoimg_data1 = wp_get_attachment_image_src( $attachmentid, $size);
						$fudoimg_url = $fudoimg_data1[0];

						if($fudoimg_url !=''){
							$tmpArray['img_url'] = $fudoimg_url;
						}else{
							$tmpArray['img_url'] = $guid_url;
						}
					}else{
						$tmpArray['img_url'] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
					}

			}else{
				$tmpArray['img_url'] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
			//	if( $imgid==1 )
			//	echo '<img src="'.WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg" alt="" />';
			}
			$ret[] = $tmpArray;
		}
		if(count($ret) == 0){
			$ret[0] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
			$ret[1] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
		}
		else if(count($ret) == 1){
			$ret[1] = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$noimage}");
		}
		return $ret;
	}
	public static function thumb($meta_id, $kaiin,$kaiin2, $imgmax=2){
		global $wpdb;
		$ret = array();
		if ( !my_custom_kaiin_view('kaiin_gazo',$kaiin,$kaiin2) ){
			for( $imgid = 0; $imgid < $imgmax; $imgid++ ){
				$ret[$imgid] = array('img_url' => WP_PLUGIN_URL . '/fudou/img/kaiin.jpg');
			}
		}else{
			//サムネイル画像
			$img_path = get_option('upload_path');
			if ($img_path == '')	$img_path = 'wp-content/uploads';
			
			for( $imgid=1; $imgid <= $imgmax; $imgid++ ){
				$tmpArray = array();
				$fudoimg_data = get_post_meta($meta_id, "fudoimg$imgid", true);
				$fudoimgcomment_data = get_post_meta($meta_id, "fudoimgcomment$imgid", true);
				$fudoimg_alt = $fudoimgcomment_data . my_custom_fudoimgtype_print(get_post_meta($meta_id, "fudoimgtype$imgid", true));

				if($fudoimg_data !="" ){
					$sql  = "";
					$sql .=  "SELECT P.ID,P.guid";
					$sql .=  " FROM $wpdb->posts as P";
					$sql .=  " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
					$metas = $wpdb->get_row( $sql );
					$attachmentid  =  $metas->ID;
					$guid_url  =  $metas->guid;
					if($attachmentid !=''){
						//thumbnail、medium、large、full 
						$fudoimg_data1 = wp_get_attachment_image_src( $attachmentid, 'thumbnail');
						$fudoimg_url = $fudoimg_data1[0];

						if($fudoimg_url !=''){
							$tmpArray['img_url'] = $fudoimg_url;
						}else{
							$tmpArray['img_url'] = $guid_url;
						}
					}else{
						$tmpArray['img_url'] = WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg';
					}
				}else{
					$tmpArray['img_url'] = WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg';
				}
				$ret[] = $tmpArray;
			}
		}
		return $ret;
	}
	public static function post_excerpt($meta_data){
		if(FudoUtil::isShowByKaiin($meta_data->ID) || get_option('kaiin_excerpt') == 1){
			return $meta_data->post_excerpt . '　';
		}
		return '';
	}
	public static function tatemonokaisuu($post_id){
		$ret = '';
		if(self::isShowByKaiin($post_id) || get_option('kaiin_kaisu') == 1){
			if(get_post_meta($post_id, 'tatemonokaisu1', true)!="") $ret .= '地上'.get_post_meta($post_id, 'tatemonokaisu1', true).'階' ;
			if(get_post_meta($post_id, 'tatemonokaisu2', true)!="") $ret .= '(地下'.get_post_meta($post_id, 'tatemonokaisu2', true).'階)';
		}else{
			$ret = '会員限定公開';
		}
		return $ret;
	}
	public static function heyakaisuu($post_id){
		if(self::isShowByKaiin($post_id) || get_option('kaiin_kaisu') == 1){
			$ret = get_post_meta($post_id, 'heyakaisu', true);
			if($ret)$ret .= '階';
		}else{
			echo '会員限定公開';
		}
		return $ret;
	}
	public static function tatemonozentaimenseki($post_id){
		$ret = get_post_meta($post_id, 'tatemonozentaimenseki', true);
		if($ret == '')return '';
		return  $ret . 'm&sup2';
	}
	public static function tatemonokouzou($post_id){
		ob_start();
		if(self::isShowByKaiin($post_id)){
			my_custom_tatemonokozo_print($post_id);
		}else{
			echo '会員限定公開';
		}
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function torihikitaiyo($post_id){
		ob_start();
		if(FudoUtil::isShowByKaiin($post_id)){
			my_custom_torihikitaiyo_print($post_id);
		}else{
			echo '会員限定公開';
		}

		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function getRosens($metas){
		$rosenHash = array();
		foreach($metas as $meta){
			$rosen_name =  $meta['rosen_name'];
			$rosen_id   =  $meta['rosen_id'];
			if(!isset($rosenHash[$rosen_id])){
				$rosenHash[$rosen_id] = $rosen_name;
			}
		}
		return $rosenHash;
	}
	public static function kyoueki_kannrihi($post_id){
		$ret = get_post_meta($post_id, 'kakakukyouekihi', true);
		if($ret)$ret .= '円';
		return $ret;
	}
	public static function balcony_menseki($post_id){
		$ret = get_post_meta($post_id, 'heyabarukoni', true);
		if($ret)$ret .= 'm&sup2;';
		return $ret;
	}
	public static function syuzen_tumitatekin($post_id){
		return get_post_meta($post_id, 'kakakutsumitate', true) . '円';
	}
	public static function muki($post_id){
		ob_start();
		my_custom_heyamuki_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function kanrikeitai($post_id){
		ob_start();
		my_custom_kanrikeitai_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function kanrininn($post_id){
		ob_start();
		my_custom_kanrininn_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function sintiku_minyuukyo_kubun($post_id){
		ob_start();
		my_custom_tatemonoshinchiku_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function genkyou($post_id){
		ob_start();
		my_custom_nyukyogenkyo_print($post_id);		
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function nyuukyojiki($post_id){
		ob_start();
		my_custom_nyukyojiki_print($post_id);		
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function tyuusyajo_kubun($post_id){
		$tmp_data = '';
		$chushajokubun_data = get_post_meta($post_id,'chushajokubun',true);
		if($chushajokubun_data=="1")$tmp_data .=  '空有';
		else if($chushajokubun_data=="2")$tmp_data .=  '空無';
		else if($chushajokubun_data=="3")$tmp_data .=  '近隣';
		else if($chushajokubun_data=="4")$tmp_data .=  '無';
		//text
		if( $chushajokubun_data !='' && !is_numeric($chushajokubun_data) ) $tmp_data .=  $chushajokubun_data;
		return $tmp_data;
	}
	public static function tyuusyajo_ryoukin($post_id){
		$tmp_data = '';
		$chushajoryokin_data = get_post_meta($post_id,'chushajoryokin',true);
		if($chushajoryokin_data !="")$tmp_data .= ' ' . $chushajoryokin_data.'円';
		echo $tmp_data;
	}
	public static function tyuusyajo_bikou($post_id){
		return get_post_meta($post_id,'chushajobiko',true);
	}
	public static function madori_utiwake($post_id){
		ob_start();
		my_custom_madorinaiyo_print($post_id);
		echo '<br>';
		echo get_post_meta($post_id, 'madoribiko', true);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function syuuhen_kankyou($post_id){
		return get_post_meta($post_id, 'shuuhensonota', true);
	}
	public static function syuuhen_setubi($post_id){
		ob_start();
		my_custom_setsubi_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function get_syuuhen_setubi($post_id){
		return my_custom_setsubi_get( $post_id );
	}
	public static function syougakkou($post_id){
		return get_post_meta($post_id, 'shuuhenshougaku', true);
	}
	public static function tyuugakkou($post_id){
		return get_post_meta($post_id, 'shuuhenchuugaku', true);
	}
	public static function keisaikigenbi($post_id){
		return get_post_meta($post_id, 'keisaikigenbi', true);
	}
	public static function bukkennmei($post_id){
		if ( get_post_meta($post_id,'bukkenmeikoukai',true) != '0' ){
			return get_post_meta($post_id,'bukkenmei',true);
		}
		return '';
	}
	public static function heyabangou($post_id){
		if ( get_post_meta($post_id,'bukkenmeikoukai',true) == '1' ){
			return get_post_meta($post_id, 'bukkennaiyo', true);
		}
		return '';
	}
	public static function getSyubetu($post_id){
		$bukkenshubetsu_data = get_post_meta($post_id,'bukkenshubetsu',true);
		switch($bukkenshubetsu_data){
			case "1502"://【売建物一部】店舗
			case "1505"://【売建物一部】事務所
			case "1506"://【売建物一部】店舗・事務所
			case "1507"://【売建物一部】ビル
			case "1509"://【売建物一部】マンション
			case "1599"://【売建物一部】その他
				return SYUBETU_URITATEMONO_ICHIBU;
			case '1401'://【売建物全部】店舗
			case '1403'://【売建物全部】店舗付住宅
			case '1404'://【売建物全部】住宅付店舗
			case '1405'://【売建物全部】事務所
			case '1406'://【売建物全部】店舗・事務所
			case '1407'://【売建物全部】ビル
			case '1408'://【売建物全部】工場
			case '1409'://【売建物全部】マンション
			case '1410'://【売建物全部】倉庫
			case '1411'://【売建物全部】アパート
			case '1412'://【売建物全部】寮
			case '1413'://【売建物全部】旅館
			case '1414'://【売建物全部】ホテル
			case '1415'://【売建物全部】別荘
			case '1416'://【売建物全部】リゾートマン
			case '1420'://【売建物全部】社宅
			case '1421'://【売建物全部】文化住宅
			case '1499'://【売建物全部】その他
				return SYUBETU_URITATEMONO_ZENBU;
			case '1101'://【売地】売地
			case '1102'://【売地】借地権譲渡
			case '1103'://【売地】底地権譲渡
			case '1104'://【売地】建付土地
				return SYUBETU_URICHI;
			case '3101'://【賃貸居住】マンション
			case '3102'://【賃貸居住】アパート
			case '3103'://【賃貸居住】一戸建
			case '3104'://【賃貸居住】テラスハウス
			case '3105'://【賃貸居住】タウンハウス
			case '3106'://【賃貸居住】間借り
			case '3110'://【賃貸居住】寮・下宿
			case '3122'://【賃貸居住】コーポ
			case '3123'://【賃貸居住】ハイツ
			case '3124'://【賃貸居住】文化住宅
			case '3201'://【賃貸事業】店舗(建全部)
			case '3202'://【賃貸事業】店舗(建一部)
			case '3203'://【賃貸事業】事務所
			case '3204'://【賃貸事業】店舗・事務所
			case '3205'://【賃貸事業】工場
			case '3206'://【賃貸事業】倉庫
			case '3207'://【賃貸事業】一戸建
			case '3208'://【賃貸事業】マンション
			case '3209'://【賃貸事業】旅館
			case '3210'://【賃貸事業】寮
			case '3211'://【賃貸事業】別荘
			case '3212'://【賃貸事業】土地
			case '3213'://【賃貸事業】ビル
			case '3214'://【賃貸事業】住宅付店舗(戸建)
			case '3215'://【賃貸事業】住宅付店舗(一部)
			case '3282'://【賃貸事業】駐車場
			case '3299'://【賃貸事業】その他
				return SYUBETU_CHINTAI;
			case '1201'://【売戸建】新築戸建
			case '1202'://【売戸建】中古戸建
			case '1203'://【売戸建】新築テラス
			case '1204'://【売戸建】中古テラス
				return SYUBETU_URIKODATE;
			case '1301'://【売マン】新築マンション
			case '1302'://【売マン】中古マンション
			case '1303'://【売マン】新築公団
			case '1304'://【売マン】中古公団
			case '1305'://【売マン】新築公社
			case '1306'://【売マン】中古公社
			case '1307'://【売マン】新築タウン
			case '1308'://【売マン】中古タウン
			case '1309'://【売マン】リゾートマン
			case '1399'://【売マン】その他
				return SYUBETU_URIMANSION;
		}
		return SYUBETU_URIMANSION;
	}
	public static function tatemononobeyukamenseki($post_id){
		return get_post_meta($post_id, 'tatemononobeyukamenseki', true) . 'm&sup2;';
	}
	public static function youtochiiki($post_id){
		ob_start();
		if(FudoUtil::isShowByKaiin($post_id)){
			my_custom_tochiyouto_print($post_id);
		}else{
			echo '会員限定公開';
		}

		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function tochikeikaku($post_id){
		ob_start();
		my_custom_tochikeikaku_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function hikiwatasi_jiki($post_id){
		ob_start();
		my_custom_nyukyojiki_print($post_id);
		echo FudoUtil::nengetu_replace( get_post_meta($post_id, 'nyukyonengetsu', true) );
		my_custom_nyukyosyun_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function setudou1($post_id){
		ob_start();
		if( get_post_meta($post_id,'tochisetsudohouko1',true)!='' ){
			//接道方向1
			my_custom_tochisetsudohouko1_print($post_id);
			echo " 方向 ";
		}
		if(get_post_meta($post_id,'tochisetsudofukuin1',true) != '' ){
			//接道幅員1
			echo get_post_meta($post_id, 'tochisetsudofukuin1', true) . 'm';
		}

		if( get_post_meta($post_id,'tochisetsudoshurui1',true)!=''){
			//接道種別1
			my_custom_tochisetsudoshurui1_print($post_id) . 'に';
		}
		if(get_post_meta($post_id,'tochisetsudomaguchi1',true)!=''){
			//接道間口1
			echo get_post_meta($post_id, 'tochisetsudomaguchi1', true) . 'm';
		}
		if( get_post_meta($post_id,'tochisetsudoichishitei1',true)!='' ){
			//位置指定道路1
			my_custom_tochisetsudoichishitei1_print($post_id);
		}
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function setudou2($post_id){
		ob_start();
		if( get_post_meta($post_id,'tochisetsudohouko2',true)!='' ){
			//接道方向2
			my_custom_tochisetsudohouko2_print($post_id);
			echo " 方向 ";
		}
		if(get_post_meta($post_id,'tochisetsudofukuin2',true) != '' ){
			//接道幅員2
			echo get_post_meta($post_id, 'tochisetsudofukuin2', true) . 'm';
		}

		if( get_post_meta($post_id,'tochisetsudoshurui2',true)!=''){
			//接道種別2
			my_custom_tochisetsudoshurui2_print($post_id) . 'に';
		}
		if(get_post_meta($post_id,'tochisetsudomaguchi2',true)!=''){
			//接道間口2
			echo get_post_meta($post_id, 'tochisetsudomaguchi2', true) . 'm';
		}
		if( get_post_meta($post_id,'tochisetsudoichishitei2',true)!='' ){
			//位置指定道路2
			my_custom_tochisetsudoichishitei2_print($post_id);
		}
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function tochikukaku_menseki($post_id){
		if(FudoUtil::isShowByKaiin($post_id) || get_option('kaiin_menseki') == 1){
			$ret = get_post_meta($post_id, 'tochikukaku', true);
			if($ret == '')return '';
			return  $ret . 'm&sup2';
		}else{
			return '会員限定公開';
		}
	}
	public static function tochikenri($post_id){
		ob_start();
		if(FudoUtil::isShowByKaiin($post_id)){
			//ログイン時に表示
			self::my_custom_tochikenri_print($post_id);
		}else{
			//会員設定している場合は会員限定表示
			echo '会員限定公開';
		}
	
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function chimoku($post_id){
		ob_start();
		my_custom_tochichimoku_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function chisei($post_id){
		ob_start();
		my_custom_tochichisei_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function tochishido($post_id){
		$tochishido = get_post_meta($post_id, 'tochishido', true);
		if($tochishido){
			$tochishido .= 'm&sup2;';
		}
		return $tochishido;
	}
	public static function setback_setbackryou($post_id){
		$ret = FudoUtil::setback($post_id);
		if($ret){
			$ret .= '(' . FudoUtil::setbackryou($post_id) . ')';
		}
		return $ret;
	}
	public static function setback($post_id){
		ob_start();
		my_custom_tochisetback_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function setbackryou($post_id){
		$ret = get_post_meta($post_id, 'tochisetback2', true);
		if($ret == '')return '';
		return $ret . 'm&sup2;';
	}
	public static function kenpeiritu($post_id){
		if(FudoUtil::isShowByKaiin($post_id)){
			$ret = get_post_meta($post_id, 'tochikenpei', true);
			if($ret == '')return '';
			return $ret . '%';
		}else{
			return '会員限定公開';
		}
	}
	public static function yousekiritu($post_id){
		if(FudoUtil::isShowByKaiin($post_id)){
			$ret = get_post_meta($post_id, 'tochiyoseki', true);
			if($ret == '')return '';
			return $ret . '%';
		}else{
			return '会員限定公開';
		}
	}
	public static function kokudohoutodokede($post_id){
		ob_start();
		my_custom_tochikokudohou_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function setudou_joukyou($post_id){
		ob_start();
		my_custom_tochisetsudo_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function syakutiryou($post_id){
		$shakuchiryo_data = get_post_meta($post_id,'shakuchiryo',true);
		if($shakuchiryo_data != ''){
			return floatval($shakuchiryo_data)/10000 . '万円';
		}
		return '';
	}
	public static function shakuchikubun($post_id){
		$value = get_post_meta($post_id,'shakuchikubun',true);
		$ret = '';
		if($value == 1){
			$ret = '期限';
		}else if($value == 2){
			$ret = '期間';
		}
		return $ret;
	}
	public static function syakuti_keiyaku_nengetu($post_id){
		$shakuchikikan_data = get_post_meta($post_id,'shakuchikikan',true);
		$shakuchikubun_data = get_post_meta($post_id,'shakuchikubun',true);
		if(is_numeric($shakuchikubun_data)){
			if($shakuchikubun_data == '1') {
				return " 借地期限 ".$shakuchikikan_data;
			}elseif($shakuchikubun_data =='2'){
				return " 借地期間 ".$shakuchikikan_data;
			}
		}
		return '';
	}
	public static function keisoku_housiki($post_id){
		ob_start();
		my_custom_tochisokutei_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return "({$ret})";
	}
	public static function tatemono_keisoku_housiki($post_id){
		ob_start();
		if(self::isShowByKaiin($post_id) || get_option('kaiin_menseki') == 1){
			my_custom_tatemonohosiki_print($post_id);		
		}else{
			
		}
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return "({$ret})";
	}
	public static function reikin($post_id){
		ob_start();
		if(get_post_meta($post_id, 'kakakureikin', true) !=""){
			my_custom_kakakureikin_print($post_id);
		}
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return $ret;
	}
	public static function shikikin($post_id){
		ob_start();
		if(get_post_meta($post_id, 'kakakushikikin', true) !=""){
			my_custom_kakakushikikin_print($post_id);
		}
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return $ret;
	}
	public static function hosyoukin($post_id){
		ob_start();
		self::my_custom_kakakuhoshoukin_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return $ret;
	}
	public static function kenrikin($post_id){
		ob_start();
		self::my_custom_kakakukenrikin_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return $ret;
	}
	private static function my_custom_kakakuhoshoukin_print($post_id) {
		$kakakuhoshoukin_data = get_post_meta($post_id,'kakakuhoshoukin',true);
	//	if(is_numeric($kakakuhoshoukin_data)){
			if($kakakuhoshoukin_data >= 100) {
				echo floatval($kakakuhoshoukin_data)/10000;
				echo "万円";
			}else{
				if($kakakuhoshoukin_data){
					echo $kakakuhoshoukin_data;
					echo "ヶ月";
				}
			}
	//	}
	}
	
	private static function my_custom_kakakukenrikin_print($post_id) {
		$kakakukenrikin_data = get_post_meta($post_id,'kakakukenrikin',true);
		if(is_numeric($kakakukenrikin_data)){
			if($kakakukenrikin_data >= 100) {
				echo floatval($kakakukenrikin_data)/10000;
				echo "万円";
			}else{
				if($kakakukenrikin_data){
					echo $kakakukenrikin_data;
					echo "ヶ月";
				}
			}
		}
	}
	public static function syoukyaku_shikibiki($post_id){
		ob_start();
		my_custom_kakakushikibiki_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return $ret;
	}
	public static function koushinryou($post_id){
		ob_start();
		my_custom_kakakukoushin_print($post_id);
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return $ret;
	}
	public static function juutakuhokenryoukikan($post_id){
		ob_start();
		my_custom_kakakuhoken_print($post_id);
		if(get_post_meta($post_id, 'kakakuhokenkikan', true) != ''){
			echo '（' . get_post_meta($post_id, 'kakakuhokenkikan', true) . '年）';
		}
		$ret = ob_get_contents();
		ob_end_clean();
		if($ret == '')return '';
		return $ret;
	}
	public static function hasNew($date1){
		$date2 = date('Y-m-d H:i:s');

		//日付をUNIXタイムスタンプに変換
		$timestamp1 = strtotime($date1);
		$timestamp2 = strtotime($date2);

		//何秒離れているかを計算(絶対値)
		$secondDiff = abs($timestamp2 - $timestamp1);

		//日数に変換
		$dayDiff = $secondDiff / (60 * 60 * 24);

		return (floor($dayDiff) <= 1);
	}
	public static function isFavorite($id){
		if(isset($_COOKIE['estatecart']) && $_COOKIE['estatecart']){
			$array = explode(',', $_COOKIE['estatecart']);
			if(array_search($id,$array) !== FALSE){
				return true;
			}
		}
		return false;
	}
	public static function select_post_per_page($post_per_page){
		$ret = array();
		$selects = array(
			'20' => '20件',
			'50' => '50件',
			'100' => '100件',
		);
		foreach($selects as $key => $value){
			$tmp = array(
				'id' => '',
				'name' => '',
				'selected' => '',
			);
			if($post_per_page == $key)$tmp['selected'] = 'selected';
			$tmp['id'] = $key;
			$tmp['name'] = $value;
			$ret[] = $tmp;
		}
		return $ret;
	}
	public static function select_sort($so, $ord){
		$ret = array();
		$selects = array(
			"date_d" => '登録更新日',
			"tac_d" => '築年数が新しい',
			"tac_a" => '築年数が古い',
			"kak_a" => '価格が安い',
			"kak_d" => '価格が高い',
			"tam_d" => '面積が広い',
//			"tam_d" => '建物面積が広い',
//			"7_d" => '土地面積が広い',
		);
		foreach($selects as $key => $value){
			$tmp = array(
				'id' => '',
				'name' => '',
				'selected' => '',
			);
			if($key == "{$so}_{$ord}")$tmp['selected'] = 'selected';
			$tmp['id'] = $key;
			$tmp['name'] = $value;
			$ret[] = $tmp;
		}
		return $ret;
	}
	public static function wp_get_attachment_image_src($attachment_id, $size, $cache_flg=true, $cache_lifetime=180){
		if(!$cache_flg){
			return wp_get_attachment_image_src( $attachment_id, $size );
		}
		$cache = new Cache_Lite(array(
			"cacheDir" => "/tmp/",
			"lifeTime" => $cache_lifetime
		));
		$key = $attachment_id . $size . 'wp_get_attachment_image_src';
		$group = 'FudoUtil';
		if ($cache && ($data = $cache->get($key, $group))) {
			return unserialize($data);
		} else {
			$data = wp_get_attachment_image_src( $attachment_id, $size );
			$cache->save(serialize($data), $key, $group);
			return $data;
		}
	}
	public static function dynamic_sidebar($index, $cache_flg, $lifetime=60){
		if(!$cache_flg){
			return self::_dynamic_sidebar($index);
		}
		$cacheHelper = CacheHelper::getInstance();
		$cacheHelper->set_lifetime($lifetime);
		$ret = $cacheHelper->exec(array(
			'key' => 'dynamic_sidebar',
			'group' => 'FudoUtil',
			'callback' => array('FudoUtil','_dynamic_sidebar'),
			'callback_param_array' => array($index),
		));
		$cacheHelper->set_lifetime($lifetime);
		return $ret;
	}
	public static function _dynamic_sidebar($index){
		ob_start();
		dynamic_sidebar($index);
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function apply_filters($tag, $value, $cache_flg, $lifetime = 60){
		if(!$cache_flg){
			return apply_filters( $tag, $value );
		}
		$cacheHelper = CacheHelper::getInstance();
		$cacheHelper->set_lifetime($lifetime);
		$ret = $cacheHelper->exec(array(
			'key' => 'apply_filters' . $tag . $value,
			'group' => 'FudoUtil',
			'callback' => 'apply_filters',
			'callback_param_array' => array($tag, $value),
		));
		$cacheHelper->set_lifetime($lifetime);
		return $ret;
	}
	public static function select_rimawari($rimawari){
		$array =array(
			0 =>'指定なし',
			5=>'5％以上',
			6=>'6％以上',
			7=>'7％以上',
			8=>'8％以上',
			9=>'9％以上',
			10=>'10％以上',
			11=>'11％以上',
			12=>'12％以上',
			13=>'13％以上',
			14=>'14％以上',
			15=>'15％以上',
			16=>'16％以上',
			17=>'17％以上',
			18=>'18％以上',
			19=>'19％以上',
			20=>'20％以上',
		);
		$ret = array();
		foreach($array as $key => $value){
			$tmp = array(
				'id' => '',
				'name' => '',
				'selected' => '',
			);
			if($key == $rimawari)$tmp['selected'] = 'selected';
			$tmp['id'] = $key;
			$tmp['name'] = $value;
			$ret[] = $tmp;
		}
		return $ret;
	}
	public static function hyoumen_rimawari($post_id){
		$ret = get_post_meta($post_id, 'kakakuhyorimawari', true);
		if(!$ret)return '';
		return $ret . '%';
	}	
	public static function fudoimgtype($post_id, $key = '', $single = true){
		return my_custom_fudoimgtype_print(get_post_meta($post_id, $key, $single));
	}
	// 139	金銭面	賃料・価格
	public static function my_custom_kakaku_print($post_id) {
		//非公開の場合
		if(get_post_meta($post_id,'kakakukoukai',true) == "0"){

			$kakakujoutai_data = get_post_meta($post_id,'kakakujoutai',true);
			if($kakakujoutai_data=="1")	echo '相談';
			if($kakakujoutai_data=="2")	echo '確定';
			if($kakakujoutai_data=="3")	echo '入札';

		}else{
			$kakaku_data = get_post_meta($post_id,'kakaku',true);
			if(is_numeric($kakaku_data)){
				echo floatval($kakaku_data)/10000;
				echo "万円";
			}
		}
	}
	// 88	間取り	間取部屋数
	// 89	間取り	間取部屋種類
	public static function my_custom_madorisu_print($post_id) {
		$madorisyurui_data = get_post_meta($post_id,'madorisyurui',true);
		echo get_post_meta($post_id,'madorisu',true);
		if($madorisyurui_data=="10")	echo 'R';
		if($madorisyurui_data=="20")	echo 'K';
		if($madorisyurui_data=="25")	echo 'SK';
		if($madorisyurui_data=="30")	echo 'DK';
		if($madorisyurui_data=="35")	echo 'SDK';
		if($madorisyurui_data=="40")	echo 'LK';
		if($madorisyurui_data=="45")	echo 'SLK';
		if($madorisyurui_data=="50")	echo 'LDK';
		if($madorisyurui_data=="55")	echo 'SLDK';
	}
	public static function isMadoriValue($post_id){
		return get_post_meta($post_id,'madorisyurui',true) ? true: false;
	}
	//7 種別 物件種別
	public static function my_custom_bukkenshubetsu_print($post_id) {

		$bukkenshubetsu_data = get_post_meta($post_id,'bukkenshubetsu',true);

		if($bukkenshubetsu_data=="1101")  echo '売地';
		if($bukkenshubetsu_data=="1102")  echo '借地権譲渡';
		if($bukkenshubetsu_data=="1103")  echo '底地権譲渡';
		if($bukkenshubetsu_data=="1201")  echo '新築戸建';
		if($bukkenshubetsu_data=="1202")  echo '中古戸建';
		if($bukkenshubetsu_data=="1203")  echo '新築テラスハウス';
		if($bukkenshubetsu_data=="1204")  echo '中古テラスハウス';
		if($bukkenshubetsu_data=="1301")  echo '新築マンション';
		if($bukkenshubetsu_data=="1302")  echo '中古マンション';
		if($bukkenshubetsu_data=="1303")  echo '新築公団';
		if($bukkenshubetsu_data=="1304")  echo '中古公団';
		if($bukkenshubetsu_data=="1305")  echo '新築公社';
		if($bukkenshubetsu_data=="1306")  echo '中古公社';
		if($bukkenshubetsu_data=="1307")  echo '新築タウン';
		if($bukkenshubetsu_data=="1308")  echo '中古タウン';
		if($bukkenshubetsu_data=="1309")  echo 'リゾートマン';
		if($bukkenshubetsu_data=="1401")  echo '店舗';
		if($bukkenshubetsu_data=="1403")  echo '店舗付住宅';
		if($bukkenshubetsu_data=="1404")  echo '住宅付店舗';
		if($bukkenshubetsu_data=="1405")  echo '事務所';
		if($bukkenshubetsu_data=="1406")  echo '店舗・事務所';
		if($bukkenshubetsu_data=="1407")  echo 'ビル';
		if($bukkenshubetsu_data=="1408")  echo '工場';
		if($bukkenshubetsu_data=="1409")  echo 'マンション';
		if($bukkenshubetsu_data=="1410")  echo '倉庫';
		if($bukkenshubetsu_data=="1411")  echo 'アパート';
		if($bukkenshubetsu_data=="1412")  echo '寮';
		if($bukkenshubetsu_data=="1413")  echo '旅館';
		if($bukkenshubetsu_data=="1414")  echo 'ホテル';
		if($bukkenshubetsu_data=="1415")  echo '別荘';
		if($bukkenshubetsu_data=="1416")  echo 'リゾートマン';
		if($bukkenshubetsu_data=="1420")  echo '社宅';
		if($bukkenshubetsu_data=="1499")  echo 'その他';
		if($bukkenshubetsu_data=="1502")  echo '店舗';
		if($bukkenshubetsu_data=="1505")  echo '事務所';
		if($bukkenshubetsu_data=="1506")  echo '店舗・事務所';
		if($bukkenshubetsu_data=="1507")  echo 'ビル';
		if($bukkenshubetsu_data=="1509")  echo 'マンション';
		if($bukkenshubetsu_data=="1599")  echo 'その他';
		if($bukkenshubetsu_data=="3101")  echo 'マンション';
		if($bukkenshubetsu_data=="3102")  echo 'アパート';
		if($bukkenshubetsu_data=="3103")  echo '一戸建';
		if($bukkenshubetsu_data=="3104")  echo 'テラスハウス';
		if($bukkenshubetsu_data=="3105")  echo 'タウンハウス';
		if($bukkenshubetsu_data=="3106")  echo '間借り';
		if($bukkenshubetsu_data=="3110")  echo '寮・下宿';
		if($bukkenshubetsu_data=="3201")  echo '店舗(建物全部)';
		if($bukkenshubetsu_data=="3202")  echo '店舗(建物一部)';
		if($bukkenshubetsu_data=="3203")  echo '事務所';
		if($bukkenshubetsu_data=="3204")  echo '店舗・事務所';
		if($bukkenshubetsu_data=="3205")  echo '工場';
		if($bukkenshubetsu_data=="3206")  echo '倉庫';
		if($bukkenshubetsu_data=="3207")  echo '一戸建';
		if($bukkenshubetsu_data=="3208")  echo 'マンション';
		if($bukkenshubetsu_data=="3209")  echo '旅館';
		if($bukkenshubetsu_data=="3210")  echo '寮';
		if($bukkenshubetsu_data=="3211")  echo '別荘';
		if($bukkenshubetsu_data=="3212")  echo '土地';
		if($bukkenshubetsu_data=="3213")  echo 'ビル';
		if($bukkenshubetsu_data=="3214")  echo '住宅付店舗(一戸建)';
		if($bukkenshubetsu_data=="3215")  echo '住宅付店舗(建物一部)';
		if($bukkenshubetsu_data=="3282")  echo '駐車場';
		if($bukkenshubetsu_data=="3299")  echo 'その他';

		if($bukkenshubetsu_data=="3122")  echo 'コーポ';
		if($bukkenshubetsu_data=="3123")  echo 'ハイツ';
		if($bukkenshubetsu_data=="3124")  echo '文化住宅';
		if($bukkenshubetsu_data=="1104")  echo '建付土地';

	}
	public static function xls_custom_shakuchikubun_print($post_id) {
		$shakuchikubun_data = get_post_meta($post_id,'shakuchikubun',true);
		if($shakuchikubun_data == '1') {
			return "期限";
		}elseif($shakuchikubun_data=='2'){
			return "期間";
		}
		//text
		if( $shakuchikubun_data !='' && !is_numeric($shakuchikubun_data) ) return $shakuchikubun_data;
	}
	public static function shakuchiryo($post_id){
		$shakuchiryo_data = get_post_meta($post_id,'shakuchiryo',true);
		$ret = '';
		if($shakuchiryo_data != ''){
			$ret .= floatval($shakuchiryo_data)/10000;
			$ret .= '万円';
		}
		return $ret;
	}
	/**
	 * 借地年月
	 * @param type $post_id
	 * @return string
	 */
	public static function shakuchinengetu($post_id){
		return  get_post_meta($post_id,'shakuchikikan',true);
	}
	//68土地	土地権利(借地権種類) 
	public static function my_custom_tochikenri_print($post_id) {
		$tochikenri_data = get_post_meta($post_id,'tochikenri',true);
		if($tochikenri_data=="1")	echo '所有権';
		if($tochikenri_data=="2")	echo '旧法地上';
		if($tochikenri_data=="3")	echo '旧法賃借';
		if($tochikenri_data=="4")	echo '普通地上';
		if($tochikenri_data=="5")	echo '定期地上';
		if($tochikenri_data=="6")	echo '普通賃借';
		if($tochikenri_data=="7")	echo '定期賃借';
		if($tochikenri_data=="8")	echo '一時使用';
		if($tochikenri_data=="21")	echo '地上権';
		if($tochikenri_data=="22")	echo '定期借地';
		if($tochikenri_data=="23")	echo '賃借権';
		if($tochikenri_data=="99")	echo 'その他';
		//text
		if( $tochikenri_data !='' && !is_numeric($tochikenri_data) ) echo $tochikenri_data.'';
	}
	public static function my_custom_kakakuhoken_print($post_id) {
		$kakakuhoken_data = get_post_meta($post_id,'kakakuhoken',true);
		$ret = '';
		if($kakakuhoken_data == '9') $ret .= '不要';
		if(is_numeric($kakakuhoken_data) && $kakakuhoken_data != 9){
			$ret .= $kakakuhoken_data . '円';
		}
		return $ret;
	}
	// 17所在地 所在地コード
	function my_custom_shozaichi_print($post_id) {
		global $wpdb;

		$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
		$shozaichiken_data = myLeft($shozaichiken_data,2);

		if($shozaichiken_data=="")
			$shozaichiken_data = get_post_meta($post_id,'shozaichiken',true);

			$sql = "SELECT `middle_area_name` FROM `".$wpdb->prefix."area_middle_area` WHERE `middle_area_id`=".$shozaichiken_data."";
			$sql = $wpdb->prepare($sql , '');
			$metas = $wpdb->get_row( $sql );
			echo $metas->middle_area_name;

		$shozaichicode_data = get_post_meta($post_id,'shozaichicode',true);
		$shozaichicode_data = myLeft($shozaichicode_data,5);
		$shozaichicode_data = myRight($shozaichicode_data,3);

		if($shozaichiken_data !="" && $shozaichicode_data !=""){
			$sql = "SELECT narrow_area_name FROM ".$wpdb->prefix."area_narrow_area WHERE middle_area_id=".$shozaichiken_data." and narrow_area_id =".$shozaichicode_data."";

			$sql = $wpdb->prepare($sql , '');
			$metas = $wpdb->get_row( $sql );
			echo $metas->narrow_area_name;
		}
	}
	public static function getShuDataRange($shub){
		if($shub == 1){
			return array('begin' => 0, 'end' => 2999);
		}
		if($shub == 2){
			return array('begin' => 3000, 'end' => 9999);
		}
		return null;
	}
	public static function convertKaiinImage(&$imgs, $size, $kaiin1, $kaiin2){
		$memberImage = ($size === 'thumbnail') ? 'member150.gif' : 'member460.gif';
		foreach($imgs as &$_img){
			if( ( $kaiin1 == 1 )  || ( $kaiin1 == 0 && !$kaiin2 ) ) {
				$_img = array('img_url' => get_bloginfo( 'template_directory', 'display' ) . "/images/{$memberImage}");
			}
		}
	}
	public static function getFudoAnnnai(){
		$fudou_ssl_site_url = get_option('fudou_ssl_site_url');
		if( $fudou_ssl_site_url !=''){
			$fudo_annnai = get_option('fudo_annnai');
			$fudo_annnai = apply_filters('the_content', $fudo_annnai);
			$fudo_annnai = str_replace(']]>', ']]&gt;', $fudo_annnai);
			return $fudo_annnai;
		}else{
			return get_option('fudo_annnai');
		}
	}
	// 5公開	自社物フラグ 0:先物　1:自社物
	public static function my_custom_koukaijisha_print($post_id) {
		$koukaijisha_data = get_post_meta($post_id,'koukaijisha',true);
		if($koukaijisha_data=="0")  echo '先物';
		if($koukaijisha_data=="1")  echo '自社物';
	}
	public static function isShowByKaiin($meta_id){
		$show_bukken = users_kaiin_bukkenlist($meta_id, get_option('kaiin_users_rains_register'), get_post_meta($meta_id, 'kaiin', true) );
		
		if((is_user_logged_in() && $show_bukken)
						|| get_post_meta($meta_id, 'kaiin', true) != 1 
						){
			return true;
		}
		return false;
	}
	public static function tatemonokouzou_tatemonomenseki($meta_id, $kaiin=0, $kaiin2=1){
		ob_start();
		if ( my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) ){
			echo get_post_meta($meta_id, 'tatemonomenseki', true).'m&sup2; ';
		}else{
			echo '会員限定公開';
		}
		
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	public static function ippan_koukai_bukkenn_suu(){
		global $wpdb;
		$sql_ippan = "SELECT count(*) FROM 
		{$wpdb->posts} as P
		INNER JOIN {$wpdb->postmeta} AS PM ON (PM.meta_key = 'kaiin' AND  PM.meta_value = '0' AND PM.post_id = P.ID)
		WHERE post_status='publish' AND post_type='fudo'
		";
		return $wpdb->get_var($sql_ippan);
	}
	public static function kaiin_koukai_bukkenn_suu(){
		global $wpdb;
		$sql_kaiin = "SELECT count(*) FROM 
		{$wpdb->posts} as P
		INNER JOIN {$wpdb->postmeta} AS PM ON (meta_key = 'kaiin' AND  meta_value = '1' AND PM.post_id = P.ID)
		WHERE post_status='publish' AND post_type='fudo'
		";
		return $wpdb->get_var($sql_kaiin);
	}
	public static function madorisuu_by_madori_data($madorisu_data){
		return (strlen($madorisu_data) == 4)? myLeft($madorisu_data,2) : myLeft($madorisu_data,1) ;
	}
}