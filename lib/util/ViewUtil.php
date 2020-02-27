<?php

class ViewUtil {
//
//	/**
//	 * @var Core 
//	 */
//	public static $core;
//
//	public static function setCore($core) {
//		self::$core = $core;
//	}
//
	public static function load($filepath, $dataHash = array()) {
		extract($dataHash);
		ob_start();
		include get_template_directory() . '/views/' . $filepath;
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}
//
//	public static function render($filepath, $dataHash = array(), $layoutfile = 'l_default.php') {
//		ob_start();
////		$boardNav = self::$core->createNav("BoardNav");
//		extract(self::$core->getParams());
//		//viewに変数を割り当てる
//		extract($dataHash);
//		/* @var $boardNav BoardNav */
//		//読み込み命令
//		include BASE_PATH . '/views/' . $filepath;
//		$content = ob_get_contents();
//		ob_end_clean();
//		$dataHash['content_for_layout'] = $content;
//		ob_start();
//		//viewに変数を割り当てる
//		extract($dataHash);
//		//読み込み命令
//		include BASE_PATH . '/views/layouts/' . $layoutfile;
//		$body = ob_get_contents();
//		ob_end_clean();
//		echo $body;
//	}

	public static function pagination($pages, $paged=1, $range = 2, $link='') {
		$showitems = ($range * 2) + 1;

		if (empty($paged))
			$paged = 1;

		ob_start();
		if (1 != $pages) {
			echo "<div class='pagenavi'>";
//			if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
//				echo "<a href='" . $link . 'paged=1' . "'>◀先頭へ</a>";
			if ($paged != 1)
				echo "<a href='" . $link . 'paged='. ($paged - 1)  . "'>◀前へ</a>";
//			if ($paged > 1 && $showitems < $pages)
//				echo "<span class='pagination_box'><a href='" . $link . 'paged=' . ($paged - 1) . "'>&lsaquo;</a></span>";

			for ($i = 1; $i <= $pages; $i++) {
				if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
					echo ($paged == $i) ? "<a class='current'>" . $i . "</a>" : "<a href='" . $link . 'paged=' . $i . "'>" . $i . "</a>";
				}
			}

//			if ($paged < $pages && $showitems < $pages)
//				echo "<a href='" . $link . 'paged=' . ($paged + 1) . "'>&rsaquo;</a>";
//			if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
//				echo "<a href='" . $link . 'paged=' . $pages . "'>最後へ▶</a>";
			if ($paged != ($pages) )
				echo "<a href='" . $link . 'paged=' . ($paged + 1) . "'>次へ▶</a>";
			echo "</div>\n";
		}
		$html = ob_get_contents();
		ob_clean();
		return $html;
	}
	public static function getPaged(){
		if(isset($_GET['paged'])){
			$paged = $_GET['paged'];
		}else{
			$paged = 1;
		}
		return $paged;
	}
	public static function getUrl($exarray = array('paged')){
		if(!isset($_GET))return site_url();
		$str = site_url() . '/?';
		foreach($_GET as $key => $value){
			if(in_array($key, $exarray) !== false)continue;
//			if($key === 'paged')continue;
			if(is_array($value)){
				foreach($value as $_value){
					$str .= "{$key}[]={$_value}&";
				}
			}else{
				$str .= "{$key}={$value}&";
			}
		}
		return $str;
	}
//	public static function extructParams($key, $param){
//		if(!is_array($key)){
//			return "{$key}={$value}&";
//		}
//		$ret = '';
//		foreach($key as $_key => $_value){
//			$ret .= self::extructParams($_key, $_value);
//		}
//		return $ret;
//	}
	public static function detailUrl($meta_data){
		return "?post_type=fudo&p={$meta_data->ID}";
	}
	public static function detailUrlByPostId($post_id){
		return "?post_type=fudo&p={$post_id}";
	}
}
