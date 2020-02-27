<?php
/**
 * Description of NrPostModel
 *
 * @author nagomi
 */
class NrPostModel extends NrModel{
	//put your code here
	private $post_id_array = array();
	protected function __construct() {
		parent::__construct("posts");
	}
	/**
	 *
	 * @staticvar boolean $instance
	 * @return NrPostModel
	 */
	public static function getInstance() {
		static $instance = false;
		if(!$instance){
			$instance = new self();
		}
		return $instance;
	}
	public function getBukkenSyubetu($shu_data){
		global $work_bukkenshubetsu;
		$wpdb = $this->wpdb;
		$sql  =  " SELECT DISTINCT PM.meta_value AS bukkenshubetsu";
		$sql .=  " FROM $wpdb->posts as P ";
		$sql .=  " INNER JOIN $wpdb->postmeta as PM ON P.ID = PM.post_id ";
		$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
		$sql .=  " AND PM.meta_key='bukkenshubetsu' ";
		$sql .=  " AND CAST( PM.meta_value AS SIGNED ) ". $shu_data ;
		$sql .=  " ORDER BY PM.meta_value";
		$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql,  ARRAY_A );
		if(!$metas)$metas = array();
		$ret = array();
		foreach ( $metas as $meta ){
		$bukkenshubetsu_id = $meta['bukkenshubetsu'];
			foreach($work_bukkenshubetsu as $meta_box){
				if( $bukkenshubetsu_id ==  $meta_box['id'] ){
					$ret[ $meta_box['id'] ] = $meta_box['name'];
				}
			}
		}
		return $ret;
	}
	public function getMadoriHash($shu_data){
		global $work_madori;
		$wpdb = $this->wpdb;
		$sql  =  "SELECT DISTINCT PM.meta_value AS madorisu,PM_2.meta_value AS madorisyurui";
		$sql .=  " FROM ((($wpdb->posts as P";
		$sql .=  " INNER JOIN $wpdb->postmeta as PM   ON P.ID = PM.post_id)) ";
		$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
		$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ";
		$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
		$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
		$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
		$sql .=  " AND PM.meta_key='madorisu'";
		$sql .=  " AND PM_2.meta_key='madorisyurui'";

		$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql,  ARRAY_A );
		
		$ret = array();
		if(!empty($metas)) {

			//ソート
			foreach($metas as $key => $row1){
				$foo1[$key] = $row1["madorisu"];
				$bar1[$key] = $row1["madorisyurui"];
			}
			array_multisort($foo1,SORT_ASC,$bar1,SORT_ASC,$metas);

			foreach ( $metas as $meta ) {
				$madorisu_data = $meta['madorisu'];
				$madorisyurui_data = $meta['madorisyurui'];
				if( $madorisu_data == 11 ) break;

				$madori_code = $madorisu_data;
				$madori_code .= $madorisyurui_data;
				
				foreach( $work_madori as $meta_box ){
					if( $madorisyurui_data == $meta_box['code'] ){
						$ret[ $madori_code ] = $madorisu_data . $meta_box['name'];
					}
				}
			}
		}
		return $ret;
	}
	public function getSetubi($shu_data){
		global $work_setsubi;
		$wpdb = $this->wpdb;
		$ret = array();
		$setsubi_dat = '';
		if( $shu_data !='' ){
			$widget_seach_setsubi = maybe_unserialize( get_option('widget_seach_setsubi') );
			$sql  =  "SELECT DISTINCT PM.meta_value as setsubi";
			$sql .=  " FROM (($wpdb->posts as P";
			$sql .=  " INNER JOIN $wpdb->postmeta as PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
			$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
			$sql .=  " AND PM.meta_key='setsubi'";
			$sql .=  " ORDER BY CAST( PM.meta_value AS SIGNED )";

			$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$array_setsubi = array();

			if(!empty($metas)) {
				foreach($work_setsubi as $meta_box){
					foreach ( $metas as $meta ) {
						$setsubi_data = $meta['setsubi'];
						if( strpos($setsubi_data,$meta_box['code']) ){
							$setsubi_code = $meta_box['code'];
							$setsubi_name = $meta_box['name'];
							$data = array( $setsubi_code => array("code" => $setsubi_code,"name" => $setsubi_name));
							foreach($array_setsubi as $meta_box2){
								if ( $setsubi_code == $meta_box2['code'])
									$data = '';
							}
							if(!empty($data))
							$array_setsubi = array_merge( $data , $array_setsubi);
						}
					}
				}
			}
			if(!empty($array_setsubi)) {
				krsort($array_setsubi);
				foreach($array_setsubi as $meta_box3){
					//$widget_seach_setsubi
					if(is_array($widget_seach_setsubi)) {
						$k=0;
						foreach($widget_seach_setsubi as $meta_box5){
							if($widget_seach_setsubi[$k] == $meta_box3['code']){
								$ret[ $meta_box3['code'] ] = $meta_box3['name'];
							}
							$k++;
						}
					}else{
						$ret[ $meta_box3['code'] ] = $meta_box3['name'];
					}
				}
			}
		}
		return $ret;
	}
	public function getShiku($shu_data){
		$ret = array();
		$wpdb = $this->wpdb;
		//営業県
		$ken_id = '';
		for( $i=1; $i<48 ; $i++ ){
			if( get_option('ken'.$i) != ''){
				$ken_id = get_option('ken'.$i);

				$sql  =  "SELECT DISTINCT NA.narrow_area_name, LEFT(PM.meta_value,5) as middle_narrow_area_id";
				$sql .=  " FROM (($wpdb->posts as P";
				$sql .=  " INNER JOIN $wpdb->postmeta as PM   ON P.ID = PM.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
				$sql .=  " INNER JOIN ".$wpdb->prefix."area_narrow_area as NA ON CAST( RIGHT(LEFT(PM.meta_value,5),3) AS SIGNED ) = NA.narrow_area_id";
				$sql .=  " WHERE PM.meta_key='shozaichicode' ";
				$sql .=  " AND P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
				$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
				$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
				$sql .=  " AND CAST( LEFT(PM.meta_value,2) AS SIGNED ) =  ". $ken_id . "";
				$sql .=  " AND NA.middle_area_id = ". $ken_id . "";
				$sql .=  " ORDER BY CAST( PM.meta_value AS SIGNED )";

				$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql,  ARRAY_A );
				if(!empty($metas)) {
					$tmp = array();
					foreach ( $metas as $meta ) {
						$middle_narrow_area_id = $meta['middle_narrow_area_id'];
						$narrow_area_name = $meta['narrow_area_name'];
						$tmp[ $middle_narrow_area_id ] = $narrow_area_name;
					}
					$fudo_ken_name = fudo_ken_name($i);
					$ret[ $fudo_ken_name ] = $tmp;
				}
			}
		}
		return $ret;
	}
	public function getRosenStation(){
		$wpdb = $this->wpdb;
		
		$sql  = "SELECT DISTINCT DTR.rosen_name,DTR.rosen_id,DTS.station_name, DTS.station_id ,DTS.station_ranking ";
		$sql .= " FROM ((((( $wpdb->posts as P ) ";
		$sql .= " INNER JOIN $wpdb->postmeta as PM ON P.ID = PM.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ) ";
		$sql .= " INNER JOIN ".$wpdb->prefix."train_rosen as DTR ON CAST( PM_1.meta_value AS SIGNED ) = DTR.rosen_id) ";
		$sql .= " INNER JOIN ".$wpdb->prefix."train_station as DTS ON DTS.rosen_id = DTR.rosen_id AND  CAST( PM.meta_value AS SIGNED ) = DTS.station_id";
		$sql .= " WHERE";
		$sql .= "  ( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki1' ";
		$sql .= " AND PM_1.meta_key='koutsurosen1' ";
		$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
		$sql .= " AND PM_2.meta_value $shu_data ) ";
		$sql .= " OR ";
		$sql .= " ( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki2' ";
		$sql .= " AND PM_1.meta_key='koutsurosen2' ";
		$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
		$sql .= " AND PM_2.meta_value $shu_data )";

		$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );
		$ret = array();
		if(!empty($metas)) {

			//ソート
			foreach($metas as $key => $row){
				$foo[$key] = $row["rosen_name"];
				$bar[$key] = $row["station_ranking"];
			}
			array_multisort($foo,SORT_DESC,$bar,SORT_ASC,$metas);
			$tmp_rosen_id= '';
			$tmp = array();
			foreach ( $metas as $meta ) {

				$rosen_name =  $meta['rosen_name'];
				$rosen_id   =  $meta['rosen_id'];
				$station_name =  $meta['station_name'];
				$station_id   =  $meta['station_id'];

				$ros_id = sprintf('%06d', $rosen_id );
				if(!isset($ret[$rosen_name])){
					$ret[$rosen_name] = array();
				}
				
				$tmp = array();
				$station_id = $ros_id . ''. sprintf('%06d', $station_id);
				$tmp[$station_id] = $station_name;
				$ret[$rosen_name][$station_id] = $station_name;
			}
		}
		return $ret;
	}
	public function getPosts($post_id_array){
		$wpdb = $this->wpdb;
		$in = "{$wpdb->posts}.ID in(";
		$order = '';
		foreach($post_id_array as $post_id){
			$in .= " {$post_id},";
			$order .= "{$post_id},";
		}
		$res = rtrim($res, 'OR');
		$in = rtrim($in, ',') . ')';
		$order = rtrim($order, ',');
		$sql = "SELECT * from {$wpdb->posts} WHERE {$in} order by field({$wpdb->posts}.ID,{$order})";
		$posts = $wpdb->get_results( $sql );
		if(!$posts)return array();
		return $posts;
	}
	public function getFudoImgs($post_id_array, $getting_imgid_array=array(1)){
		$wpdb = $this->wpdb;
		$res = '';
		foreach($post_id_array as $post_id){
			$res .= " ID = {$post_id} OR";
		}
		$res = rtrim($res, 'OR');
		$sql = "SELECT DISTINCT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key,{$wpdb->postmeta}.meta_value from {$wpdb->posts} 
		INNER JOIN {$wpdb->postmeta} ON ({$wpdb->postmeta}.post_id = {$wpdb->posts}.ID AND {$wpdb->postmeta}.meta_key REGEXP '^fudoimg[0-9]+$')
WHERE {$wpdb->postmeta}.meta_value <> '' AND ({$res})";
		$sql = $wpdb->prepare($sql,'');
		$posts = $wpdb->get_results( $sql );
		if(!$posts)return array();

		$ret = array();
		foreach($posts as $post){
			$number = preg_replace("/[^0-9]/", "", $post->meta_key);
			if(in_array($number, $getting_imgid_array)){
				$post->number = $number;
				$ret[] = $post;
			}
		}
		usort($ret, array($this, 'sort_fudoimg'));
		return $ret;
	}
	function sort_fudoimg($aAry, $bAry){
		$a = str_replace('fudoimg', '', $aAry->meta_key);
		$b = str_replace('fudoimg', '', $bAry->meta_key);
		if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? -1 : 1;
	}
	/**
	 * アタッチメントされている画像のURLを取得する
	 * @param type $post_id_array
	 * @return array
	 * array(post_id => array(画像のURL1,画像のURL2,画像のURL3, ...))
	 * example
	 * array(
	 * '3032' => array('http://localhost/images/shibakoen.jpg',http://localhost/images/shibakoen.jpg)
	 * '4221' => array('http://localhost/images/xxxxxxx.jpg',http://localhost/images/yyyyyyy.jpg)
	 * )
	 */
	public function getAttachimentImgDatas($post_id_array){
		$wpdb = $this->wpdb;
		$res = '';
		foreach($post_id_array as $post_id){
			$res .= "( (post_parent = {$post_id} AND post_type='attachment') OR (ID = {$post_id} AND post_type='fudo') ) OR";
		}
		$res = rtrim($res, 'OR');
		$sql = "SELECT post_type, guid,post_parent,ID as attachment_id  from {$wpdb->posts} 
WHERE {$res}";
		$sql = $wpdb->prepare($sql,'');
		$posts = $wpdb->get_results( $sql );
		if(!$posts)return array();
		$ret = array();
		$fudoArr = array();
		foreach($posts as $post){
			if($post->post_type == 'attachment'){
				$id = $post->post_parent;
			}else if($post->post_type == 'fudo'){
				$id = $post->attachment_id;
			}else{
				throw new Exception("例外エラーです。画像の取得に失敗しました。");
			}
			if(!is_array($ret[ $id ])){
				$ret[ $id ] = array();
			}
			$tmp = array(
				'guid' => '',
				'attachment_id' => '',
			);
			$tmp['guid'] = $post->guid;
			$tmp['attachment_id'] = $post->attachment_id;
			$tmp['post_type'] = $post->post_type;
			if($post->post_type == 'fudo'){
				if(!is_array($fudoArr[ $id ])){
					$fudoArr[ $id ] = array();
				}
				$fudoArr[ $id ][] = $tmp;
			}else{
				$ret[ $id ][] = $tmp;
			}
		}
		foreach($fudoArr as $fudoKey => $fudoValueArr){
			if(count($ret[ $fudoKey ]) > 0){
				//競合したときは処理無し
				
			}else{
				$ret[ $fudoKey ] = $fudoValueArr;
			}
		}
		
		
		return $ret;
	}
	public function getWeekFudoInfo($cache_flg=true){
		if(!$cache_flg){
			return $this->gets(array(
			 'post_status' => 'publish',
			 'AND',
			 'post_password' => '',
			 'AND',
			 'post_type' =>'fudo'
			 ), ' order by post_date desc limit 0, 5');
		}
		$cacheHelper = CacheHelper::getInstance();
		
		$cacheHelper->set_lifetime(600);
		$ret = $cacheHelper->exec(array(
			'key' => 'getWeekFudoInfo',
			'group' => 'Model',
			'callback' => array($this,'gets'),
			'callback_param_array' => 
			array(
				array(
					'post_status' => 'publish',
					'AND',
					'post_password' => '',
					'AND',
					'post_type' =>'fudo'
					), 
				' order by post_date desc limit 0, 5'
			),
		));
		$cacheHelper->set_lifetime(3600 * 24);
		return $ret;
	}
	public function getIDByImgName($filename){
		$wpdb = $this->wpdb;
		$sql = "SELECT ID FROM `{$wpdb->posts}` WHERE guid LIKE  '%/{$filename}%'";
		$data = $wpdb->get_row($sql,  ARRAY_A);
		if(!$data) return false;
		return $data['ID'];
	}
	/**
	 * 一般公開物件数と会員公開物件数の取得
	 * @return array 連想配列
	 * 例 array('public' => 10, 'private' => 30)
	 */
	public function getEstateNumber(){
		$wpdb = $this->wpdb;
		$sql = "SELECT count(DISTINCT P.ID) as co";
		$sql .=  " FROM $wpdb->posts AS P";
		$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";

		$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		$num_posts2 = $metas->co;

		$sql = "SELECT count(DISTINCT P.ID) as co";
		$sql .=  " FROM $wpdb->posts AS P";
		$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ";
		$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
		$sql .=  " AND PM.meta_key='kaiin' AND PM.meta_value = '1'";

		$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );

		$kaiin_co = $metas->co;	
		$ippan_co = $num_posts2 - $kaiin_co;

		return array(
			'public' => $ippan_co,
			'private' => $kaiin_co,
		);
	}
}
