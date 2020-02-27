<?php
class CacheHelper extends Helper{
	private $cache = null;
	/**
	 *
	 * @staticvar boolean $instance
	 * @return CacheHelper
	 */
	public static function getInstance() {
		static $instance = false;
		if(!$instance){
			$instance = new self();
		}
		return $instance;
	}
	private function __construct() {
		$this->cache = new Cache_Lite(array(
			"cacheDir" => "/tmp/",
			"lifeTime" => 3600 * 24
		));
	}
	public function set_lifetime($newLifeTime){
		$this->cache->setLifeTime($newLifeTime);
	}
	public function clean($group=''){
		$this->cache->clean($group);
	}
	/**
	 * 
	 * @param type $option
	 * array(
	 * 'key' => '',
	 * 'group' => '',
	 * 'callback' => '',
	 * 'callback_param_array' => '',
	 * )
	 * @return type
	 */
	public function exec($option){
		$key = safe_array($option, 'key') . $_SERVER['SERVER_NAME'];
		$group = safe_array($option, 'group');
		$callback = safe_array($option, 'callback');
		$callback_param_array = safe_array($option, 'callback_param_array');
		if ($this->cache && ($data = $this->cache->get($key, $group))) {
			return unserialize($data);
		} else {
			$data = call_user_func_array($callback, $callback_param_array);
			$this->cache->save(serialize($data), $key, $group);
			return $data;
		}
		
	}
}