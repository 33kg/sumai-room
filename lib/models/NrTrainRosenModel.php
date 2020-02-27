<?php
/**
 * Description of NrPostModel
 *
 * @author nagomi
 */
class NrTrainRosenModel extends NrModel{
	//put your code here
	protected function __construct() {
		parent::__construct("train_rosen");
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
//	public function getRosens($post_id_array){
//		$wpdb = $this->wpdb;
//		$add_sql = '';
//		foreach($post_id_array as $post_id){
//			$koutsurosen_data = get_post_meta($post_id, 'koutsurosen1', true);
//			$add_sql .= " `rosen_id` = {$koutsurosen_data} OR";
//		}
//		$add_sql = rtrim($add_sql, 'OR');
//		if(!$add_sql)$add_sql = 1;
//		$sql = "SELECT `rosen_name` FROM `".$wpdb->prefix."train_rosen` WHERE {$add_sql}";
//		$sql = $wpdb->prepare($sql,'');
//		$metas = $wpdb->get_results( $sql );
//		$ret = array();
//		foreach($metas as $meta){
//			$meta->rosen_name;
//		}
//		if(!empty($metas)) $rosen_name = $metas->rosen_name;
//		echo "".$rosen_name;
//	}
//	public function getRosenStation($post_id_array, $getting_imgid_array=array(1)){
//		$wpdb = $this->wpdb;
//		$ret = array();
//		$rosen_str = '';
//		$add_sql = '';
//		foreach($post_id_array as $post_id){
//			$rosen = get_post_meta($post_id, 'koutsurosen1', true);
//			$station = get_post_meta($post_id, 'koutsueki1', true);
//			$add_sql .= " (DTS.rosen_id=" . $rosen . ' AND ' . 'DTS.station_id='  . $station . ') OR';
////			$koutsueki_data = "DTS.station_id="  . get_post_meta($post_id, 'koutsueki1', true);
//		}
//		$add_sql = rtrim($add_sql, 'OR');
//		if($koutsurosen_data !="" && $koutsueki_data !=""){
//			$sql = "SELECT DTS.station_name, DTR.rosen_name";
//			$sql .=  " FROM ".$wpdb->prefix."train_rosen AS DTR";
//			$sql .=  " INNER JOIN ".$wpdb->prefix."train_station as DTS ON DTR.rosen_id = DTS.rosen_id";
////			$sql .=  " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
//			$sql .=  " WHERE {$add_sql}";
//			$sql = $wpdb->prepare($sql,'');
//			$metas = $wpdb->get_row( $sql );
////			if(!empty($metas)) {
////				if($metas->station_name != '＊＊＊＊') 	echo $metas->station_name.'駅';
////			}
//		}	
//		
//		return $ret;
//	}
}
