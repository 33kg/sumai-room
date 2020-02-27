<?php
/**
 * Description of NrAreaMiddleAreaModell
 *
 * @author nagomi
 */
class NrAreaMiddleAreaModel extends NrModel{
	//put your code here
	protected function __construct() {
		parent::__construct("area_middle_area");
	}
	/**
	 *
	 * @staticvar boolean $instance
	 * @return NrAreaMiddleAreaModel
	 */
	public static function getInstance() {
		static $instance = false;
		if(!$instance){
			$instance = new self();
		}
		return $instance;
	}
}
