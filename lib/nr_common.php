<?php
////////////////////////////////////////////////////////////////////////
// ini_set
//////////////////////////////////////////////////////////////////////
//ini_set('error_reporting', E_ALL ^ E_NOTICE);
//ini_set('display_errors', '1');

////////////////////////////////////////////////////////////////////////
// Define
////////////////////////////////////////////////////////////////////////
define('SYUBETU_URIMANSION', 1);
define('SYUBETU_URIKODATE', 2);
define('SYUBETU_URITATEMONO_ICHIBU', 3);
define('SYUBETU_URITATEMONO_ZENBU', 4);
define('SYUBETU_URICHI', 5);
define('SYUBETU_CHINTAI', 6);

define('SHUB_BAIBAI', 1);
define('SHUB_CHINTAI', 2);

require_once (dirname(__FILE__) . "/../setting.php");
require_once (dirname(__FILE__) . "/nr_global.php");
require_once (dirname(__FILE__) . "/my_custom_functions.php");
require_once (dirname(__FILE__) . '/vendors/pear/Cache/Lite.php');
//require_once (dirname(__FILE__) . '/vendors/FirePHPCore/fb.php');
function nrwpCommonAutoload($className) {
	if(file_exists(dirname(__FILE__) . "/" . $className . ".php")) {
		require_once (dirname(__FILE__) . "/" . $className . ".php");
	}
	else if(file_exists(dirname(__FILE__) . "/core/" . $className . ".php")) {
		require_once (dirname(__FILE__) . "/core/" . $className . ".php");
	}
	else if(file_exists(dirname(__FILE__) . "/helpers/" . $className . ".php")) {
		require_once (dirname(__FILE__) . "/helpers/" . $className . ".php");
	}
	else if(file_exists(dirname(__FILE__) . "/mains/" . $className . ".php")) {
		require_once (dirname(__FILE__) . "/mains/" . $className . ".php");
	}
	else if(file_exists(dirname(__FILE__) . "/models/" . $className . ".php")) {
		require_once (dirname(__FILE__) . "/models/" . $className . ".php");
	}
	else if(file_exists(dirname(__FILE__) . "/util/" . $className . ".php")) {
		require_once (dirname(__FILE__) . "/util/" . $className . ".php");
	}
}

spl_autoload_register('nrwpCommonAutoload');



if(isset($_GET['debug']) && $_GET['debug'] == 'on'){
	$_SESSION['debug'] = 'on';
}elseif(isset($_GET['debug']) && $_GET['debug'] == 'off'){
	$_SESSION['debug'] = null;
}



function safe_input($name){
	return isset($_POST[$name]) ? $_POST[$name]:'';
}
function safe_array($array, $name){
	return isset($array[$name]) ? $array[$name]:'';
}
function exit_status($str) {
    echo json_encode(array('status' => $str, 'result' => 'FAILED'));
    exit;
}
function safe_post($name){
	return isset($_POST[$name]) ? $_POST[$name] : null;
}
function safe_get($name){
	return isset($_GET[$name]) ? $_GET[$name] : null;
}
function is_active_plugin($path){
	$active_plugins = get_option('active_plugins');
	if(is_array($active_plugins)) {
		foreach($active_plugins as $value){
			if( $value == $path) return true;
		}
	}
	return false;
}


