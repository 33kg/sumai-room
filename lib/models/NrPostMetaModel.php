<?php
/**
 * Description of NrPostMetaModel
 *
 * @author nagomi
 */
class NrPostMetaModel extends NrModel{
	//put your code here
	protected function __construct() {
		parent::__construct("postmeta");
	}
	/**
	 *
	 * @staticvar boolean $instance
	 * @return NrPostMetaModel
	 */
	public static function getInstance() {
		static $instance = false;
		if(!$instance){
			$instance = new self();
		}
		return $instance;
	}
	/**
	 * 
	 * @param type $shub 1302
	 * @return type
	 */
	public function getStations($shub=1302, $rosen_id=null, $cache_flg=true){
		if(!$cache_flg){
			return $this->_getStations($shub, $rosen_id);
		}
		$cacheHelper = CacheHelper::getInstance();
		return $cacheHelper->exec(array(
			'key' => $shub . $rosen_id . 'getStations',
			'group' => 'Model',
			'callback' => array($this,'_getStations'),
			'callback_param_array' => array($shub, $rosen_id),
		));
	}
	public function _getStations($shub=null, $rosen_id=null){
		$shu_data_range = FudoUtil::getShuDataRange($shub);
		
		$wpdb = $this->wpdb;
		$sql  = "SELECT DISTINCT DTR.rosen_name,DTR.rosen_id,DTS.station_name, DTS.station_id ,DTS.station_ranking ";
		$sql .= " FROM ((((( $wpdb->posts as P ) ";
		$sql .= " INNER JOIN $wpdb->postmeta as PM ON P.ID = PM.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ) ";
		$sql .= " INNER JOIN ".$wpdb->prefix."train_rosen as DTR ON CAST( PM_1.meta_value AS SIGNED ) = DTR.rosen_id) ";
		$sql .= " INNER JOIN ".$wpdb->prefix."train_station as DTS ON DTS.rosen_id = DTR.rosen_id AND  CAST( PM.meta_value AS SIGNED ) = DTS.station_id";
		$sql .= " WHERE";
		if($rosen_id){
			$sql .= "(DTR.rosen_id = {$rosen_id}) AND";
		}
		$sql .= "  (( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki1' ";
		$sql .= " AND PM_1.meta_key='koutsurosen1' ";
		if($shub !== null){
			$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
			$sql .= " AND (PM_2.meta_value >= {$shu_data_range['begin']} && PM_2.meta_value <= {$shu_data_range['end']} )";
		}
		$sql .= " ) ";
		$sql .= " OR ";
		$sql .= " ( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki2' ";
		$sql .= " AND PM_1.meta_key='koutsurosen2' ";
		if($shub !== null){
			$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
			$sql .= " AND PM_2.meta_value =$shub ";
		}
		$sql .= " ))";

		$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );
		if(!empty($metas)) {

			//ソート
			foreach($metas as $key => $row){
				$foo[$key] = $row["rosen_name"];
				$bar[$key] = $row["station_ranking"];
			}
			array_multisort($foo,SORT_DESC,$bar,SORT_ASC,$metas);
		}
		
		return $metas;
	}
	
}
