<?php
/**
 * Description of NrTermRelationshipsModel
 *
 * @author nagomi
 */
class NrTermRelationshipsModel extends NrModel{
	//put your code here
	protected function __construct() {
		parent::__construct("term_relationships");
	}
	/**
	 *
	 * @staticvar boolean $instance
	 * @return NrTermRelationshipsModel
	 */
	public static function getInstance() {
		static $instance = false;
		if(!$instance){
			$instance = new self();
		}
		return $instance;
	}
	public function getEstateCount($sql,$shub){
		$wpdb = $this->wpdb;
		if ($shub == '1' || $shub == '2'){
			//検索物件の数
			/////////////////////////////////////////////////////////////
			$str = ' (';
			$str .= 1;
			$str .= ') AND ';
			$tmps = explode("WHERE", $sql, 2);
			
			$sql = $tmps[0] . ' WHERE ' . $str. '(' . $tmps[1] . ')';
		}
		
		$metas = $wpdb->get_row( $sql );
		$metas_co = $metas->co;	
		$tmps = explode("INNER JOIN", $sql, 2);
		$kaiin_str = " INNER JOIN {$wpdb->postmeta} ON ({$wpdb->postmeta}.post_id = P.ID AND {$wpdb->postmeta}.meta_key = 'kaiin' AND {$wpdb->postmeta}.meta_value = 1) ";
		
		$sql_kaiin = $tmps[0] . $kaiin_str . 'INNER JOIN' . $tmps[1];
		$metas_kaiin = $wpdb->get_row( $sql_kaiin );
		$estate_kaiin_count = $metas_kaiin->co;	
		return array(
			'metas_co' => $metas_co,
			'estate_kaiin_count' => $estate_kaiin_count,
			);
	}
}
