<?php
get_header(); 

$s = isset($_GET['s']) ? $_GET['s'] : '';

$termRelModel = NrTermRelationshipsModel::getInstance();
$postModel = NrPostModel::getInstance();
$posts_per_page = 20;
if(isset($_GET['num']) && $_GET['num'] > 0){
	$posts_per_page = $_GET['num'];
}
if($posts_per_page > 100)$posts_per_page = 100;
$so = 1;
if(isset($_GET['so']) && $_GET['so'] > 0){
	$posts_per_page = $_GET['so'];
}
$so = stripslashes($_GET['so']);
$ord = 'd';
if(isset($_GET['ord']) && $_GET['ord'] > 0){
	$ord = $_GET['ord'];
}
$ord = stripslashes($_GET['ord']);
/**
 * The Template for displaying fudou archive posts.
 *
 * Template Name: archive-fudo.php
 * 
 * @package WordPress3.2
 * @subpackage Fudousan Plugin
 */

	global $wpdb;
	global $work_setsubi;

	//newup_mark
	$newup_mark = get_option('newup_mark');
	if($newup_mark == '') $newup_mark=14;



	//ユーザー別会員物件リスト
	$kaiin_users_rains_register = get_option('kaiin_users_rains_register');


	$mid_id = myIsNum_f($_GET['mid']);	//路線・県ID
	if($mid_id=='')	$mid_id = "999";

	$nor_id = myIsNum_f($_GET['nor']);	//駅・市区ID
	if($nor_id=='')	$nor_id = "999";


	$bukken_slug_data = esc_attr( stripslashes($_GET['bukken']));			//カテゴリ
	$taxonomy_name = 'bukken';


	if($bukken_slug_data ==''){
		$bukken_slug_data = esc_attr( stripslashes($_GET['bukken_tag']));	//投稿タグ
		$taxonomy_name = 'bukken_tag';
	}
	if($bukken_slug_data == 'station'){
		$bukken_slug_data = 'jsearch';
		if(isset($_GET['mid']) && isset($_GET['nor'])){
			$re = sprintf("%06d", $_GET['mid']);
			$re .= sprintf("%06d", $_GET['nor']);
			$_GET['re'] = array($re);
		}
		
	}
	if(isset($_GET['re']) && !is_array($_GET['re'])){
		$_GET['re'] = array($_GET['re']);
	}
	

	$bukken_slug_data = str_replace(" ","",$bukken_slug_data);
	$bukken_slug_data = str_replace(";","",$bukken_slug_data);
	$bukken_slug_data = str_replace(",","",$bukken_slug_data);
	$bukken_slug_data = str_replace("'","",$bukken_slug_data);

	$slug_data = utf8_uri_encode($bukken_slug_data,0);			//エンコード

	//パーマリンク
	if( !isset($_GET['bukken']) ){
		global $wp_query;
		$cat = $wp_query->get_queried_object();

		if( $cat ){
			$cat_name = $cat->taxonomy;
			$cat_name_data = $cat->name;
			$cat_slug_data = $cat->slug;

			if( $cat_name == 'bukken' ){
				$bukken_slug_data = $cat_name_data;
				$slug_data = $cat_slug_data;
				$taxonomy_name = 'bukken';
			}
			if( $cat_name == 'bukken_tag' ){
				$bukken_slug_data = $cat_name_data;
				$slug_data = $cat_slug_data;
				$taxonomy_name = 'bukken_tag';
			}
		}
	}
	

	//物件検索
	$s = esc_sql( esc_attr( $s ) );
	$s = str_replace(" ","",$s);
	$s = str_replace(";","",$s);
	$s = str_replace(",","",$s);
	$s = str_replace("'","",$s);

	$bukken_page_data = myIsNum_f($_GET['paged']);	//ページ
	if($bukken_page_data < 2)
		$bukken_page_data="";


//	$bukken_shubetsu = esc_attr( stripslashes($_GET['shu']));	//種別
	$bukken_shubetsu = $_GET['shu'];	//種別


	$shub = myIsNum_f($_GET['shub']);	//複数種別用 売買・賃貸判別


	//複数種別
	$is_tochi = false;
	if (is_array($bukken_shubetsu)) {

		$i=0;
		$shu_data = ' IN ( 0 ';
		foreach($bukken_shubetsu as $meta_set){
			//土地判定 (土地・戸建)
			$tmp_bs = (int)$bukken_shubetsu[$i];
			if( ($tmp_bs > 1100 && $tmp_bs < 1300) || $tmp_bs == 3212  ){
				$is_tochi = true;
			}
			$shu_data .= ','. $bukken_shubetsu[$i] . '';
			$i++;
		}
		$shu_data .= ') ';

	} else {
		$bukken_shubetsu = myIsNum_f($_GET['shu']);	//種別

		$shu_data = " > 0 ";
		if($bukken_shubetsu == '1') 
			$shu_data = '< 3000' ;	//売買
		if($bukken_shubetsu == '2') 
			$shu_data = '> 3000' ;	//賃貸

		if(intval($bukken_shubetsu) > 3 && $bukken_slug_data == 'jsearch') 
			$shu_data = '= ' .$bukken_shubetsu ;
		//土地判定
		if( ($bukken_shubetsu > 1100 && $bukken_shubetsu < 1300) || $bukken_shubetsu == 3212 || $bukken_shubetsu == 1 ){
			$is_tochi = true;
		}
	} 

	//複数種別用 売買・賃貸判別
	if($bukken_shubetsu == '' && $shub != ''){
		if ($shub == '1' )
			$shu_data = '< 3000' ;	//売買
		if ($shub == '2' )
			$shu_data = '> 3000' ;	//賃貸
	}


	$bukken_sort = esc_attr( stripslashes($_GET['so']));		//ソート項目
	$bukken_order_data = esc_attr( stripslashes($_GET['ord']));	//order


	//ソート
	if($bukken_sort=="tam"){
		$bukken_sort_data = "tatemonomenseki";
	}elseif($bukken_sort=="tac"){
		$bukken_sort_data = "tatemonochikunenn";
	}elseif($bukken_sort=="mad"){
		$bukken_sort_data = "madorisu";
	}elseif($bukken_sort=="sho"){
		$bukken_sort_data = "shozaichicode";
	}
	elseif($bukken_sort=="kak"){
		$bukken_sort_data = "kakaku";
	}	
	else{

	//デフォルト
		$bukken_sort_data = "";
		$bukken_sort = "";
		//更新日順
		$bukken_sort_data2 = "post_modified";
		$bukken_order_data2 = " DESC";


	}


	if($bukken_order_data=="d"){
		$bukken_order_data = " DESC";
		$bukken_order = "";
	}else{
		$bukken_order_data = " ASC";
		$bukken_order = "d";
	}



	//1ページに表示する物件数
	if($bukken_page_data == ""){
		$limit_from = "0";
		$limit_to = $posts_per_page;
	}else{
		$limit_from = $posts_per_page * $bukken_page_data - $posts_per_page;
		$limit_to = $posts_per_page;
	}



	//条件検索用
	if($bukken_slug_data=="jsearch"){

		$s = esc_sql( esc_attr( $s ) );
		$s = str_replace(" ","",$s);
		$s = str_replace(";","",$s);
		$s = str_replace(",","",$s);
		$s = str_replace("'","",$s);
		$ros_id = myIsNum_f($_GET['ros']);		//路線
		$eki_id = myIsNum_f($_GET['eki']);		//駅
		$ken_id = myIsNum_f($_GET['ken']);		//県
		$sik_id = myIsNum_f($_GET['sik']);		//市区

		$ken_id=sprintf("%02d",$ken_id);




		//複数市区
		$ksik_id = $_GET['ksik'];		//県市区
		$ksik_data = '';
		if (is_array($ksik_id)) {
			$i=0;
			$ksik_data = " IN ( '99999' ";
			foreach($ksik_id as $meta_set){
				$ksik_data .= ", '". $ksik_id[$i] . "000000'";
				$i++;
			}
			$ksik_data .= ") ";
		}


		if(isset($_GET['submit-index'])){
			$tmp = sprintf('%06d', $_GET['rosen'] ) . sprintf('%06d', $_GET['ekimei'] );
			$_GET['re'] = array();
			$_GET['re'][] = $tmp;
		}
		//複数駅
		$rosen_eki = $_GET['re'];
		if(is_array( $rosen_eki )  ){
			$i=0;
			$eki_data = ' IN ( ';
			$tmp_eki_data = '';
			foreach($rosen_eki as $meta_set){
				$tmp_eki_data .= ',' . intval(myLeft($rosen_eki[$i],6)) . intval(myRight($rosen_eki[$i],6));
				$i++;
			}
			$eki_data .= ltrim($tmp_eki_data, ',');
			$eki_data .= ') ';
		}

		$set_id = $_GET['set'];		//設備

		//設備条件
		$setsubi_name = '';
		if(!empty($set_id)) {
			$setsubi_name = '設備条件 ';
			$i=0;
			foreach($set_id as $meta_set){
				foreach($work_setsubi as $meta_setsubi){
					if($set_id[$i] == $meta_setsubi['code'] )
						$setsubi_name .= $meta_setsubi['name'] . ' ';
				}
				$i++;
			}
		}


		//間取り
		$madori_id = $_GET['mad'];

		$madori_name = '';
		if(!empty($madori_id)) {
			$madori_name = '間取り';

			$i=0;
			foreach($madori_id as $meta_box){
				$madorisu_data = $madori_id[$i];
				$madorisyurui_data = myRight($madorisu_data,2);

				$madori_name .= FudoUtil::madorisuu_by_madori_data($madorisu_data);
				if($madorisyurui_data=="10")	$madori_name .= 'R ';
				if($madorisyurui_data=="20")	$madori_name .= 'K ';
				if($madorisyurui_data=="25")	$madori_name .= 'SK ';
				if($madorisyurui_data=="30")	$madori_name .= 'DK ';
				if($madorisyurui_data=="35")	$madori_name .= 'SDK ';
				if($madorisyurui_data=="40")	$madori_name .= 'LK ';
				if($madorisyurui_data=="45")	$madori_name .= 'SLK ';
				if($madorisyurui_data=="50")	$madori_name .= 'LDK ';
				if($madorisyurui_data=="55")	$madori_name .= 'SLDK ';
				$i++;
			}
		}



		$kalb_data = myIsNum_f($_GET['kalb']);	//価格下限
		$kahb_data = myIsNum_f($_GET['kahb']);	//価格上限
		$kalc_data = myIsNum_f($_GET['kalc']);	//賃料下限
		$kahc_data = myIsNum_f($_GET['kahc']);	//賃料上限

			//売買
			if($bukken_shubetsu == '1' || ( intval($bukken_shubetsu) < 3000 && intval($bukken_shubetsu) > 1000 ) || $shub == '1') {
				$kal_data =$kalb_data*10000 ;
				$kah_data =$kahb_data*10000 ;

					//価格条件
					if($kalb_data > 0 || $kahb_data > 0 ){
						$kakaku_name = '価格';
						if($kalb_data > 0 )
							$kakaku_name .= number_format($kalb_data).'万円';
						$kakaku_name .= '～';
						if($kahb_data > 0)
							$kakaku_name .= number_format($kahb_data) . '万円 ' ;
					}


			}
			//賃貸
			if($bukken_shubetsu == '2' || intval($bukken_shubetsu) > 3000  || $shub == '2') {
				$kal_data =$kalc_data*10000 ;
				$kah_data =$kahc_data*10000 ;

					//賃料条件
					if($kalc_data > 0 || $kahc_data > 0 ){
						$kakaku_name = '賃料';
						if($kalc_data > 0 )
							$kakaku_name .= $kalc_data.'万円';
						$kakaku_name .= '～';
						if($kahc_data > 0)
							$kakaku_name .= $kahc_data . '万円 ' ;
					}


			}


		$tik_data = myIsNum_f($_GET['tik']);	//築年数
			$tik_data = intval($tik_data);

			//築年数条件
			if($tik_data > 0 )
				$tiku_name = '築'.$tik_data.'年以内 ';



		$hof_data = myIsNum_f($_GET['hof']);	//歩分
			$hof_data = intval($hof_data);

			//歩分条件
			if($hof_data > 0 )
				$hofun_name = '駅徒歩'.$hof_data.'分以内 ';




		$mel_data = myIsNum_f($_GET['mel']);	//面積下限
			$mel_data = intval($mel_data);
		$meh_data = myIsNum_f($_GET['meh']);	//面積上限
			$meh_data = intval($meh_data);

			//面積条件
			if($mel_data > 0 || $meh_data > 0 ){
				$menseki_name = '面積';

				if($mel_data > 0 )
					$menseki_name .= $mel_data.'m&sup2;';

				$menseki_name .= '～';

				if($meh_data > 0)
					$menseki_name .= $meh_data . 'm&sup2; ' ;
			}

	} 	//条件検索用



	//タイトル
	if($s != ''){
		$org_title = '検索: '.$s ;
	}else{
		if ($taxonomy_name !=''){
			$sql  = "SELECT T.name";
			$sql .= " FROM $wpdb->terms AS T ";
			$sql .= " INNER JOIN $wpdb->term_taxonomy as TT ON T.term_id = TT.term_id ";
			$sql .= " WHERE TT.taxonomy  = '".$taxonomy_name."' ";
			$sql .= " AND T.slug   = '".$slug_data."' ";
		//	$sql = $wpdb->prepare($sql);
			$metas = $wpdb->get_row( $sql );
			$org_title = $metas->name;
		}
	}

	if ($org_title =='')
		$org_title = $bukken_slug_data;



	//種別タイトル
		global $work_bukkenshubetsu;

		//複数種別
		if (is_array($bukken_shubetsu)) {

			$i=0;
			$shu_name = '';
			foreach($bukken_shubetsu as $meta_set){

				foreach($work_bukkenshubetsu as $meta_box){
					if( $bukken_shubetsu[$i] ==  $meta_box['id'] ){
						$shu_name .= ' '. $meta_box['name'] . ' ';
					}
				}
				$i++;
			}


		} else {
			$bukken_shubetsu = myIsNum_f($_GET['shu']);	//種別

				foreach($work_bukkenshubetsu as $meta_box){
					if( $bukken_shubetsu ==  $meta_box['id'] ){
						$shu_name = ' '. $meta_box['name'] . ' ';
					}
				}
		} 







	//路線タイトル
	if( ($bukken_slug_data=="rosen" && $mid_id !="") || ($bukken_slug_data=="jsearch" && $ros_id != '' && $eki_id == 0 ) ){
		$rosen_id = $mid_id;
		if($bukken_slug_data=="jsearch" && $ros_id != '')
			$rosen_id = $ros_id;

		$sql = "SELECT `rosen_name` FROM `".$wpdb->prefix."train_rosen` WHERE `rosen_id` =".$rosen_id."";
		$sql = $wpdb->prepare($sql , '');
		$metas = $wpdb->get_row( $sql );
		$org_title = $metas->rosen_name;
		$rosen_name = $org_title;
	}

	//駅タイトル
	if( ($bukken_slug_data=="station" && $mid_id !="" && $nor_id !="") || ($bukken_slug_data=="jsearch" && $ros_id != '' && $eki_id != '' ) ){
		$rosen_id = $mid_id;
		$ekin_id = $nor_id;
		if($bukken_slug_data=="jsearch" && $ros_id != '' && $eki_id != ''){
			$rosen_id = $ros_id;
			$ekin_id = $eki_id;
		}
		$sql = "SELECT DTS.station_name,DTR.rosen_name";
		$sql .=  " FROM ".$wpdb->prefix."train_rosen AS DTR";
		$sql .=  " INNER JOIN ".$wpdb->prefix."train_station AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql .=  " WHERE DTS.rosen_id=".$rosen_id." AND DTS.station_id=".$ekin_id."";
		$sql = $wpdb->prepare($sql , '');
		$metas = $wpdb->get_row( $sql );
		if(!empty($metas)) {
			$org_title = $metas->rosen_name.''.$metas->station_name.'駅';
			$eki_name = $org_title . ' ';
		}
	}

	//複数駅タイトル
	if(is_array( $rosen_eki )  ){
		$i=0;
		foreach($rosen_eki as $meta_set){
			$f_rosen_id =  intval(myLeft($rosen_eki[$i],6));
			$f_eki_id   =  intval(myRight($rosen_eki[$i],6));

			$sql = "SELECT DTS.station_name";
			$sql .=  " FROM ".$wpdb->prefix."train_station AS DTS";
			$sql .=  " WHERE DTS.rosen_id=".$f_rosen_id." AND DTS.station_id=".$f_eki_id."";

			$sql = $wpdb->prepare($sql , '');
			$metas = $wpdb->get_row( $sql );
			$station_name = $metas->station_name;

			$eki_name .= $station_name . '駅 ';

			$i++;
		}
	}

	//県タイトル
	if( ($bukken_slug_data=="ken" && $mid_id !="") || ($bukken_slug_data=="jsearch" && $ken_id != '') ){
		$kenn_id = $mid_id;
		if($bukken_slug_data=="jsearch" && $ken_id != '')
			$kenn_id = $ken_id;

		$sql = "SELECT `middle_area_name` FROM `".$wpdb->prefix."area_middle_area` WHERE `middle_area_id`=".$kenn_id."";
		$sql = $wpdb->prepare($sql , '');
		$metas = $wpdb->get_row( $sql );
		$org_title = $metas->middle_area_name;
		$ken_name = $org_title;
	}

	//市区タイトル
	if( ($bukken_slug_data=="shiku" && $mid_id !="" && $nor_id !="") || ($bukken_slug_data=="jsearch" && $ken_id != '' && $sik_id !='') ){
		$kenn_id = $mid_id;
		$sikn_id = $nor_id;
		if($bukken_slug_data=="jsearch" && $ken_id != '' && $sik_id != ''){
			$kenn_id = $ken_id;
			$sikn_id = $sik_id;
		}

		$sql = "SELECT narrow_area_name FROM ".$wpdb->prefix."area_narrow_area WHERE middle_area_id=".$kenn_id." and narrow_area_id =".$sikn_id."";
		$sql = $wpdb->prepare($sql , '');
		$metas = $wpdb->get_row( $sql );
		$org_title = $metas->narrow_area_name;
		$siku_name = $org_title . ' ';
	}


	//複数市区タイトル $ksik_id = $_GET['ksik']; //県市区
	$ksik_name = '';
	if (is_array($ksik_id)) {
		$sql  = "SELECT narrow_area_name FROM ".$wpdb->prefix."area_narrow_area ";
		$sql .= "WHERE ";
		$i=0;
		$j=0;
		foreach($ksik_id as $meta_set){
			$tmp_kenn_id = $ksik_id[$i];
			$kenn_id = myLeft($tmp_kenn_id,2);
			$sikn_id = myRight($tmp_kenn_id,3);
			if($kenn_id != '' && $sikn_id != ''){
				if($j > 0 ) $sql .= " OR ";
				$sql .= "( middle_area_id=".$kenn_id." and narrow_area_id =".$sikn_id.")";
				$j++;
			}
			$i++;
		}
		if ($j > 0 ){
			$sql = $wpdb->prepare($sql , '');
			$metas = $wpdb->get_results( $sql, ARRAY_A );
			if(!empty($metas)) {

				foreach ( $metas as $meta ) {
					$ksik_name .= '' . $meta['narrow_area_name'] .' ';

				}
			}
		}
	} 


	if($bukken_slug_data=="jsearch"){
		$org_title = '検索 ';
		$org_title .= $shu_name;
		$org_title .= $rosen_name;
		$org_title .= $eki_name;
		$org_title .= $ken_name;
		$org_title .= $siku_name;
		$org_title .= $ksik_name;
		$org_title .= $tiku_name;
		$org_title .= $hofun_name;
		$org_title .= $menseki_name;
		$org_title .= $kakaku_name;
		$org_title .= $setsubi_name;
		$org_title .= $madori_name;
	}

	//title変更
	add_filter('aioseop_title', 'add_post_type_wp_title');
	function add_post_type_wp_title($title = '') {
		global $org_title, $bukken_shubetsu , $shub;
		$title =  $org_title.' ';

		//売買
		if($bukken_shubetsu == '1' || (intval($bukken_shubetsu) < 3000 && intval($bukken_shubetsu) > 1000) || $shub == '1' ) {
			$title =  '売買 > '.$org_title.' ';
		}

		//賃貸
		if($bukken_shubetsu == '2' || intval($bukken_shubetsu) > 3000 || $shub == '2' ) {
			$title =  '賃貸 > '.$org_title.' ';
		}
	    return $title;
	}




	//SQL タクソノミー用(デフォルト)
	if( $s == ''){
		//価格・面積・築年月 ソート用
			$sql = "SELECT count(DISTINCT PT.ID) as co";
			$sql .=  " FROM ($wpdb->postmeta as P";
			$sql .=  " INNER JOIN (($wpdb->terms as T";
			$sql .=  " INNER JOIN $wpdb->term_taxonomy as TT ON T.term_id = TT.term_id) ";
			$sql .=  " INNER JOIN $wpdb->term_relationships as TR ON TT.term_taxonomy_id = TR.term_taxonomy_id) ON P.post_id = TR.object_id)";
			$sql .=  " INNER JOIN $wpdb->posts AS PT ON P.post_id = PT.ID";
			$sql .=  " WHERE T.slug='".$slug_data."'";
			$sql .=  " AND PT.post_password='' ";
			$sql .=  " AND PT.post_status='publish'";
			$sql .=  " AND TT.taxonomy='".$taxonomy_name."'";
//			$sql .=  " AND P.meta_key='".$bukken_sort_data."'";
			if($bukken_sort_data){
				$sql .=  " AND P.meta_key='".$bukken_sort_data."'";
			}


			$sql2 = str_replace("SELECT count(DISTINCT PT.ID) as co","SELECT DISTINCT TR.object_id",$sql);


			//更新日順
			if($bukken_sort_data2 == "post_modified"){
					$sql2 .=  " ORDER BY PT.post_modified ".$bukken_order_data2;

			}else{
				//テキスト
				if($bukken_sort_data== "tatemonochikunenn"){
					$sql2 .=  " ORDER BY P.meta_value ".$bukken_order_data;
				}else{
				//数値
					$sql2 .=  " ORDER BY CAST(P.meta_value AS SIGNED)".$bukken_order_data;
				}
			}


			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";



		//間取・所在地 ソート用
		if($bukken_sort_data== "madorisu" || $bukken_sort_data== "shozaichicode"){

			$sql = "SELECT count(DISTINCT PT.ID) as co";
			$sql .=  " FROM $wpdb->postmeta AS P1 ";
			$sql .=  " INNER JOIN ($wpdb->postmeta as P ";
			$sql .=  " INNER JOIN (($wpdb->terms as T ";
			$sql .=  " INNER JOIN $wpdb->term_taxonomy as TT ON T.term_id = TT.term_id) ";
			$sql .=  " INNER JOIN $wpdb->term_relationships as TR ON TT.term_taxonomy_id = TR.term_taxonomy_id) ON P.post_id = TR.object_id) ON P1.post_id = TR.object_id";
			$sql .=  " INNER JOIN $wpdb->posts AS PT ON P.post_id = PT.ID";
			$sql .=  " WHERE T.slug='".$slug_data."'";
			$sql .=  " AND PT.post_password='' ";
			$sql .=  " AND PT.post_status='publish'";
			$sql .=  " AND TT.taxonomy='".$taxonomy_name."'";
			//数値・数値
			if($bukken_sort_data== "madorisu"){
				$sql .=  " AND P.meta_key='madorisu' ";
				$sql .=  " AND P1.meta_key='madorisyurui' ";
			}
			//数値・テキスト
			if($bukken_sort_data== "shozaichicode"){
				$sql .=  " AND P.meta_key='shozaichicode' ";
				$sql .=  " AND P1.meta_key='shozaichimeisho' ";
			}



			$sql2 = str_replace("SELECT count(DISTINCT PT.ID) as co","SELECT DISTINCT TR.object_id",$sql);
			//数値・数値
			if($bukken_sort_data== "madorisu"){
				$sql2 .=  " ORDER BY CAST(P.meta_value AS SIGNED)".$bukken_order_data.", CAST(P1.meta_value AS SIGNED)".$bukken_order_data."";
			}
			//数値・テキスト
			if($bukken_sort_data== "shozaichicode"){
				$sql2 .=  " ORDER BY CAST(P.meta_value AS SIGNED)".$bukken_order_data.", P1.meta_value".$bukken_order_data."";
			}
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}

	}

	//SQL キーワード $s
	if($bukken_slug_data=="search" && $s !=''){
		$searchtype = $_GET['st'];

		//キーワード検索

		$sql = "SELECT DISTINCT P.ID";
		$sql .=  " FROM $wpdb->posts AS P";
		$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
		$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
		$sql .=  " AND PM_1.meta_key='shikibesu' AND PM_1.meta_value LIKE '%$s%' ";
	//	$sql = $wpdb->prepare($sql);
		$metas = $wpdb->get_results( $sql,  ARRAY_A );
		$id_data1 = '';
		if(!empty($metas)) {
			foreach ( $metas as $meta ) {
					$id_data1 .= ','. $meta['ID'];
			}
		}


		$sql = "SELECT DISTINCT P.ID";
		$sql .=  " FROM $wpdb->posts AS P";
		$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
		$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
		$sql .=  " AND PM_2.meta_key='bukkenmei' AND PM_2.meta_value LIKE '%$s%' ";
	//	$sql = $wpdb->prepare($sql);
		$metas = $wpdb->get_results( $sql,  ARRAY_A );
		$id_data2 = '';
		if(!empty($metas)) {
			foreach ( $metas as $meta ) {
					$id_data2 .= ','. $meta['ID'];
			}
		}


		$sql = "SELECT DISTINCT P.ID";
		$sql .=  " FROM $wpdb->posts AS P";
		$sql .=  " WHERE (P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' )";
		$sql .=  " AND (P.post_content LIKE '%$s%' OR P.post_title LIKE '%$s%' OR  P.post_excerpt LIKE '%$s%')";
	//	$sql = $wpdb->prepare($sql);
		$metas = $wpdb->get_results( $sql,  ARRAY_A );
		$id_data3 = '';
		if(!empty($metas)) {
			foreach ( $metas as $meta ) {
					$id_data3 .= ','. $meta['ID'];
			}
		}

		$id_data = ' AND P.ID IN ( 0 ' .$id_data1. $id_data2 . $id_data3 . ')';


		//価格・面積・築年月ソート用
						$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";

		if($searchtype != ''){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
		}

		$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
		if($bukken_sort_data){
			$sql .=  " AND PM.meta_key='$bukken_sort_data'";

		}
		if($searchtype == ''){
			$sql .= $id_data;
		}

		if($searchtype == 'id'){
			$sql .=  "     AND PM_1.meta_key='shikibesu' AND PM_1.meta_value LIKE '%$s' ";
		}

		if($searchtype == 'chou'){
			$sql .=  "     AND PM_1.meta_key='shozaichimeisho' AND PM_1.meta_value LIKE '%$s%' ";
		}


			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);


			//更新日順
			if($bukken_sort_data2 == "post_modified"){
					$sql2 .=  " ORDER BY P.post_modified ".$bukken_order_data2;
			}else{
				//テキスト
				if($bukken_sort_data== "tatemonochikunenn"){
					$sql2 .=  " ORDER BY PM.meta_value ".$bukken_order_data;
				}else{
				//数値
					$sql2 .=  " ORDER BY CAST(PM.meta_value AS SIGNED)".$bukken_order_data;
				}
			}

			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";





		//間取・所在地 ソート用
		if($bukken_sort_data== "madorisu" || $bukken_sort_data== "shozaichicode"){

			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
		if($searchtype != ''){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
		}else{
			$sql .=  " ) ";
		}
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";


		if($searchtype == ''){
			$sql .= $id_data;
		}

		if($searchtype == 'id'){
			$sql .=  "     AND PM_1.meta_key='shikibesu' AND PM_1.meta_value LIKE '%$s' ";
		}

		if($searchtype == 'chou'){
			$sql .=  "     AND PM_1.meta_key='shozaichimeisho' AND PM_1.meta_value LIKE '%$s%' ";
		}

			//数値・数値
			if($bukken_sort_data== "madorisu"){
				$sql .=  " AND PM.meta_key='madorisu' ";
				$sql .=  " AND PM_3.meta_key='madorisyurui' ";
			}
			//数値・テキスト
			if($bukken_sort_data== "shozaichicode"){
				$sql .=  " AND PM.meta_key='shozaichicode' ";
				$sql .=  " AND PM_3.meta_key='shozaichimeisho' ";
			}

			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			//数値・数値
			if($bukken_sort_data== "madorisu"){
				$sql2 .=  " ORDER BY CAST(PM.meta_value AS SIGNED)".$bukken_order_data.", CAST(PM_3.meta_value AS SIGNED)".$bukken_order_data."";
			}
			//数値・テキスト
			if($bukken_sort_data== "shozaichicode"){
				$sql2 .=  " ORDER BY CAST(PM.meta_value AS SIGNED)".$bukken_order_data.", PM_3.meta_value".$bukken_order_data."";
			}
			if($bukken_sort_data2 == "post_modified" && $bukken_sort_data === ''){
				$sql2 .=  " ORDER BY P.post_modified ".$bukken_order_data2;
			}			
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}
	}





	//SQL 地域(県)
	if($bukken_slug_data=="ken"){

			//地域(県) 数値カウント
			$sql  = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";


			//地域(県) 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			//更新日順
			if($bukken_sort_data2 == "post_modified"){
				$sql2 .=  " ORDER BY P.post_modified ".$bukken_order_data2;
			}else{
				$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			}

			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";



		//面積 ソート用
		if($bukken_sort_data== "tatemonomenseki"){

			//地域(県) 面積カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";

			//地域(県) 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//テキストカウント ソート用
		if($bukken_sort_data== "tatemonochikunenn"){

			//地域(県) テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";


			//地域(県) テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}

		//数値・数値カウント ソート用
		if($bukken_sort_data== "madorisu"){

			//地域(県) 数値・数値カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";


			//地域(県) 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", CAST(PM_3.meta_value AS SIGNED) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

		//数値・テキストカウント ソート用
		if($bukken_sort_data== "shozaichicode"){

			//地域(県) 数値・テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='shozaichicode' ";
			$sql .=  " AND PM_3.meta_key='shozaichimeisho'";

			//地域(県) 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

	}


	//SQL 地域(県・市区)
	if($bukken_slug_data=="shiku"){

			//地域(県・市区) 数値カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";
			//地域(県・市区) 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);

			//更新日順
			if($bukken_sort_data2 == "post_modified"){
				$sql2 .=  " ORDER BY P.post_modified ".$bukken_order_data2;
			}else{
				$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			}
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";


		//面積
		if($bukken_sort_data== "tatemonomenseki"){

			//地域(県・市区) 面積カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";

			//地域(県・市区) 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//テキストカウント
		if($bukken_sort_data== "tatemonochikunenn"){

			//地域(県・市区) テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode'  AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";


			//地域(県・市区) テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}

		//数値・数値カウント
		if($bukken_sort_data== "madorisu"){

			//地域(県・市区) 数値・数値カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";


			//地域(県・市区) 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", CAST(PM_3.meta_value AS SIGNED) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

		//数値・テキストカウント
		if($bukken_sort_data== "shozaichicode"){

			//地域(県・市区) 数値・テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";

			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM_2.meta_key='shozaichicode' AND PM_3.meta_key='shozaichimeisho'";

			//地域(県・市区) 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

	}


	//SQL 路線
	if($bukken_slug_data=="rosen"){

			//路線 数値カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";

			//路線 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);

			//更新日順
			if($bukken_sort_data2 == "post_modified"){
				$sql2 .=  " ORDER BY P.post_modified ".$bukken_order_data2;
			}else{
				$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			}

			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";


		//面積
		if($bukken_sort_data== "tatemonomenseki"){

			//路線 面積カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";

			//路線 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}


		//テキストカウント
		if($bukken_sort_data== "tatemonochikunenn"){

			//路線 テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";

			//路線 テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

		//数値・数値カウント
		if($bukken_sort_data== "madorisu"){

			//路線 数値・数値カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";

			//路線 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", CAST(PM_3.meta_value AS SIGNED) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

		//数値・テキストカウント
		if($bukken_sort_data== "shozaichicode"){

			//路線 数値・テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND  PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='shozaichicode' AND PM_3.meta_key='shozaichimeisho'";

			//路線 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

	}


	//SQL 駅
	if($bukken_slug_data=="station"){

			//駅 数値カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND (PM_3.meta_key='koutsueki1' Or PM_3.meta_key='koutsueki2') ";
			$sql .=  " AND PM_3.meta_value='".$nor_id."'";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";


			//駅 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);

			//更新日順
			if($bukken_sort_data2 == "post_modified"){
				$sql2 .=  " ORDER BY P.post_modified ".$bukken_order_data2;
			}else{
				$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			}
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";



		//面積
		if($bukken_sort_data== "tatemonomenseki"){

			//駅 面積カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED) ".$shu_data."";
			$sql .=  " AND (PM_3.meta_key='koutsueki1' Or PM_3.meta_key='koutsueki2') ";
			$sql .=  " AND PM_3.meta_value='".$nor_id."'";

			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";


			//駅 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}



		//テキストカウント
		if($bukken_sort_data== "tatemonochikunenn"){

			//駅 テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND  PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND (PM_3.meta_key='koutsueki1' Or PM_3.meta_key='koutsueki2') ";
			$sql .=  " AND PM_3.meta_value='".$nor_id."'";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";

			//駅 テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

		//数値・数値カウント
		if($bukken_sort_data== "madorisu"){

			//駅 数値・数値カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND (PM_4.meta_key='koutsueki1' Or PM_4.meta_key='koutsueki2') ";
			$sql .=  " AND PM_4.meta_value='".$nor_id."'";

			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";

			//駅 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", CAST(PM_3.meta_value AS SIGNED) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

		//数値・テキストカウント
		if($bukken_sort_data== "shozaichicode"){

			//駅 数値・テキストカウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND (PM_4.meta_key='koutsueki1' Or PM_4.meta_key='koutsueki2') ";
			$sql .=  " AND PM_4.meta_value='".$nor_id."'";

			$sql .=  " AND PM_2.meta_key='shozaichicode' AND PM_3.meta_key='shozaichimeisho'";

			//駅 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID as object_id",$sql);
			$sql2 .=  " ORDER BY CAST(PM_2.meta_value AS SIGNED) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

	}


	//SQL 条件検索
	if($bukken_slug_data=="jsearch" || $bukken_slug_data=="shiku" || $bukken_slug_data=="station"){
		$nowym= date('Ym');
		$meta_dat = '';
		$next_sql = true;
		if( $s != "" ) { 
			$searchtype = $_GET['st']; 
			if( preg_match( '/[0-9]{5}_*/', $s, $match ) ) {
				
			}
		}
		

		//複数駅
		if( $eki_data != '' ){
			$sql = "SELECT DISTINCT( P.ID )";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE  P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=    $mail_date_data;
			$sql .=    $id_data;

			$sql .=  " AND PM.meta_key='koutsurosen1' AND PM_1.meta_key='koutsueki1' ";
			$sql .=  " AND concat( PM.meta_value,PM_1.meta_value) " . $eki_data . "";

			$sql = $wpdb->prepare($sql , '');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data2 = '';
			if(!empty($metas)) {
				$id_data2 = ' AND P.ID IN ( 0 ';
				foreach ( $metas as $meta ) {
						$id_data2 .= ','. $meta['ID'];
				}
				$id_data2 .= ') ';
			}

			$sql = "SELECT DISTINCT( P.ID )";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE ( P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=    $mail_date_data;
			$sql .=    $id_data;
			$sql .=  " AND PM_2.meta_key='koutsurosen2' AND PM_3.meta_key='koutsueki2' ";
			$sql .=  " AND concat( PM_2.meta_value,PM_3.meta_value) " . $eki_data . ")";
			if($id_data2){
				$sql .=  " OR ( P.ID " . $id_data2 . ")";
			}

			$sql = $wpdb->prepare($sql , '');

			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data = '';
			if(!empty($metas)) {
				$id_data = ' AND P.ID IN ( 0 ';
				foreach ( $metas as $meta ) {
						$id_data .= ','. $meta['ID'];
				}
				$id_data .= ') ';
			}
		}

		// echo $id_data;

		if( $shu_data != '' && ( ($ken_id !='' && $ken_id != 0) || ($ros_id !='' && $ros_id != 0)  || $ksik_data !='' || $eki_data != ''  ) ){
			//地域・路線駅($meta_dat)
			$sql = "SELECT DISTINCT P.ID";
			$sql .=  " FROM (((($wpdb->posts AS P";

			//種別
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";

			//県市区 /県市区複数
			if( $ken_id !='' && $ken_id > 0 || $ksik_data !='' ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_10 ON P.ID = PM_10.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_11 ON P.ID = PM_11.post_id) ";
			}else{
				$sql .=  " )";	
			}

			//路線
			if( $ros_id !='' && $ros_id > 0 ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_12 ON P.ID = PM_12.post_id) ";
			}else{
				$sql .=  " )";	
			}

			//駅
			if( $eki_id !='' && $eki_id > 0 ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_13 ON P.ID = PM_13.post_id ";
			}

			$sql .=  " LEFT JOIN {$wpdb->postmeta} AS PM_KAIIN ON (P.ID = PM_KAIIN.post_id AND PM_KAIIN.meta_key = 'kaiin') ";
				
				
			$sql .=  " WHERE ( ";

			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";

			//種別
			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND CAST(PM.meta_value AS SIGNED)".$shu_data."";

			//県
			if( $ken_id !='' && $ken_id > 0 ){
				$sql .=  " AND PM_10.meta_key='shozaichicode' AND LEFT(PM_10.meta_value,2)='".$ken_id."'";
			}
			//市区
			if( $sik_id !='' && $sik_id > 0 ){
				$sql .=  " AND RIGHT(LEFT(PM_10.meta_value,5),3)='".$sik_id."'";
			}
			//県市区 複数
			if( $ksik_data !='' ){
				$sql .=  " AND PM_10.meta_value ".$ksik_data."";
			}
			//町名検索
			if($s != '' && $searchtype == 'chou'){
				$sql .=  "     AND PM_11.meta_key='shozaichimeisho' AND PM_11.meta_value LIKE '%$s%' ";
			}


			if( $ros_id !='' && $ros_id > 0 ){
				$sql .=  " AND PM_12.meta_key='koutsurosen1' AND PM_12.meta_value='".$ros_id."'";
			}

			if( $eki_id !='' && $eki_id > 0 ){
				$sql .=  " AND PM_13.meta_key='koutsueki1' AND PM_13.meta_value='".$eki_id."'";
			}

			//複数駅
			if( $id_data !='') $sql .=  $id_data;

			$sql .=  " ) OR ( ";



			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";

			//種別
			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND CAST(PM.meta_value AS SIGNED)".$shu_data."";

			//県
			if( $ken_id !='' && $ken_id > 0 ){
				$sql .=  " AND PM_10.meta_key='shozaichicode' AND LEFT(PM_10.meta_value,2)='".$ken_id."'";
			}
			//市区
			if( $sik_id !='' && $sik_id > 0 ){
				$sql .=  " AND RIGHT(LEFT(PM_10.meta_value,5),3)='".$sik_id."'";
			}

			//県市区 複数
			if( $ksik_data !='' ){
				$sql .=  " AND PM_10.meta_value ".$ksik_data."";
			}

			if( $ros_id !='' && $ros_id > 0 ){
				$sql .=  " AND PM_12.meta_key='koutsurosen2' AND PM_12.meta_value='".$ros_id."'";
			}

			if( $eki_id !='' && $eki_id > 0 ){
				$sql .=  " AND PM_13.meta_key='koutsueki2' AND PM_13.meta_value='".$eki_id."'";
			}

			if($s != '' && $searchtype == 'chou'){
				$sql .=  "AND PM_11.meta_key='shozaichimeisho' AND PM_11.meta_value LIKE '%$s%' ";
			}

			//複数駅
			if( $id_data !='') $sql .=  $id_data;

			$sql .=  " ) ";
			// $sql .= ' ORDER BY PM_KAIIN.meta_value ';
			
			// $sql = $wpdb->prepare($sql , '');
			$metas = $wpdb->get_results( $sql, ARRAY_A );
			// echo $sql;exit;
			if(!empty($metas)) {
				$i=0;
				foreach ( $metas as $meta ) {
					if($i!=0) $meta_dat .= ",";
					$meta_dat .= $meta['ID'];
					$i++;
				}
			}else{
				$next_sql = false;
			}

		}


		if($next_sql){

			//カウント
			$sql = "SELECT count(DISTINCT P.ID) as co";
			$sql .=  " FROM ((((((((((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";		//種別
			$sql .=  " LEFT JOIN $wpdb->postmeta AS PM_KAIIN ON (P.ID = PM_KAIIN.post_id AND PM_KAIIN.meta_key = 'kaiin') ) ";	//価格
			//価格
			if($kal_data > 0 || $kah_data > 0 || $bukken_sort_data== "kakaku" ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";	//価格
			}else{
				$sql .=  " )";	
			}

			//歩分
			if($hof_data > 0){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";		//歩分
			}else{
				$sql .=  " )";	
			}

			//面積
			if($mel_data > 0 || $meh_data > 0 || $bukken_sort_data == "tatemonomenseki" ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";		//面積
			}else{
				$sql .=  " )";	
			}


			//築年数
			if($tik_data > 0 || $bukken_sort_data== "tatemonochikunenn" ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id)";		//築年数
			}else{
				$sql .=  " )";	
			}

			//設備
			if(!empty($set_id)) {
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_5 ON P.ID = PM_5.post_id)";		//設備
			}else{
				$sql .=  " )";	
			}

			//間取
			if(!empty($madori_id) || $bukken_sort_data== "madorisu" ) {
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_6 ON P.ID = PM_6.post_id)";		//間取
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_7 ON P.ID = PM_7.post_id)";		//間取
			}else{
				$sql .=  ") )";	
			}

			if( $bukken_sort_data== "shozaichicode" ) {
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_10 ON P.ID = PM_10.post_id)";	//所在地
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_11 ON P.ID = PM_11.post_id)";	//所在地2
			}else{
				$sql .=  "))";	
			}
			if($bukken_slug_data=="shiku" && $nor_id){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_NOR ON P.ID = PM_NOR.post_id";
			}

			$sql .=  " WHERE ( ";

			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";

			//地域・路線駅
			if($meta_dat != ''){
				$sql .=  " AND P.ID IN (".$meta_dat.") ";
			}

			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND CAST(PM.meta_value AS SIGNED)".$shu_data."";	//種別

			//価格
			if($kal_data > 0 || $kah_data > 0 || $bukken_sort_data == "kakaku" ){
				$sql .=  " AND PM_1.meta_key='kakaku' ";
				if( $kal_data > 0 )
					$sql .=  " AND CAST(PM_1.meta_value AS SIGNED) >= $kal_data ";
				if( $kah_data > 0 )
					$sql .=  " AND CAST(PM_1.meta_value AS SIGNED) <= $kah_data ";
			}


			//歩分
			if($hof_data > 0){
				$sql .=  " AND (PM_2.meta_key='koutsutoho1f' OR PM_2.meta_key='koutsutoho2f' )";
				$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) > 0 ";
				$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) <= $hof_data ";
			}

			//面積
			if($mel_data > 0 || $meh_data > 0 || $bukken_sort_data == "tatemonomenseki" ){

				//tatemonomenseki or tochikukaku
				if( ($bukken_shubetsu > 1100 && $bukken_shubetsu < 1300) || $bukken_shubetsu == 3212 || $shu_data == '< 3000'  ){
						$sql .=  " AND  ( PM_3.meta_key='tochikukaku' OR PM_3.meta_key='tatemonomenseki' )";
				//		$sql .=  " AND  PM_3.meta_key='tochikukaku' ";
				}else{
					if( $is_tochi || $shu_data == '< 3000' ){
						$sql .=  " AND  ( PM_3.meta_key='tochikukaku' OR PM_3.meta_key='tatemonomenseki' )";
					}else{
						$sql .=  " AND  PM_3.meta_key='tatemonomenseki' ";
					}
				}


				if( $mel_data > 0 )
					$sql .=  " AND CAST(PM_3.meta_value AS SIGNED) >= $mel_data ";
				if( $meh_data > 0 )
					$sql .=  " AND CAST(PM_3.meta_value AS SIGNED) <= $meh_data ";
				$sql .=  " AND PM_3.meta_value !='' ";
			}


			//築年数
			if($tik_data > 0 || $bukken_sort_data== "tatemonochikunenn" ){
				$sql .=  " AND PM_4.meta_key='tatemonochikunenn' ";
				if( $tik_data > 0 )
				//	$sql .=  " AND ( CAST(LEFT(PM_4.meta_value,4) AS SIGNED)  *100 + CAST(RIGHT(PM_4.meta_value,2) AS SIGNED) ) >= ($nowym- $tik_data * 100) ";
					$sql .=  " AND ( CAST(LEFT(PM_4.meta_value,4) AS SIGNED)  *100 + CASE WHEN LENGTH(PM_4.meta_value)>5 THEN CAST(RIGHT(PM_4.meta_value,2) AS SIGNED) ELSE 0 END ) >= ($nowym- $tik_data * 100) ";
			}


			//設備
			if(!empty($set_id)) {
				$sql .=  " AND (PM_5.meta_key='setsubi' AND ( ";
				$i=0;
				foreach($set_id as $meta_box){
				//	if($i!=0) $sql .= " OR ";
					if($i!=0) $sql .= " AND ";
					$sql .= " PM_5.meta_value LIKE '%".$set_id[$i]."%'";
					$i++;
				}
				$sql .=  " ))";
			}

			//間取
			if(!empty($madori_id)) {
				$sql .=  " AND ( ";
				$i=0;
				foreach($madori_id as $meta_box){
					$madorisu_data = $madori_id[$i];
					if($i!=0) $sql .= " OR ";
					$sql .= " (PM_6.meta_key='madorisu' AND PM_6.meta_value ='".FudoUtil::madorisuu_by_madori_data($madorisu_data)."' ";
					$sql .= " AND PM_7.meta_key='madorisyurui' AND PM_7.meta_value ='".myRight($madorisu_data,2)."')";
					$i++;
				}
				$sql .=  " ) ";
			}else{
				if( $bukken_sort_data== "madorisu" ){
					$sql .= " AND PM_6.meta_key='madorisu'";
					$sql .= " AND PM_7.meta_key='madorisyurui'";
				}
			}

			if( $bukken_sort_data== "shozaichicode" ) {
				$sql .=  " AND PM_10.meta_key='shozaichicode'";
				$sql .=  " AND PM_11.meta_key='shozaichimeisho'";
			}
			
			if($bukken_slug_data=="shiku" && $nor_id){
				$sql .=  " AND PM_NOR.meta_key='shozaichicode'  AND LEFT(PM_NOR.meta_value,2)='".$mid_id."'";
				$sql .=  " AND RIGHT(LEFT(PM_NOR.meta_value,5),3)='".$nor_id."'";
			}


			$sql .=  " ) OR ( ";


			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";

			//地域・路線駅
			if($meta_dat != ''){
				$sql .=  " AND P.ID IN (".$meta_dat.") ";
			}

			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND CAST(PM.meta_value AS SIGNED)".$shu_data."";	//種別

			//価格
			if($kal_data > 0 || $kah_data > 0 || $bukken_sort_data == "kakaku" ){
				$sql .=  " AND PM_1.meta_key='kakaku' ";
				if( $kal_data > 0 )
					$sql .=  " AND CAST(PM_1.meta_value AS SIGNED) >= $kal_data ";
				if( $kah_data > 0 )
					$sql .=  " AND CAST(PM_1.meta_value AS SIGNED) <= $kah_data ";
			}


			//歩分
			if($hof_data > 0){
				$sql .=  " AND (PM_2.meta_key='koutsutoho1f' OR PM_2.meta_key='koutsutoho2f' )";
				$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) > 0 ";
				$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) <= $hof_data ";
			}

			//面積
			//面積
			if($mel_data > 0 || $meh_data > 0 || $bukken_sort_data == "tatemonomenseki" ){

				//tatemonomenseki or tochikukaku
				if( ($bukken_shubetsu > 1100 && $bukken_shubetsu < 1300) || $bukken_shubetsu == 3212 || $shu_data == '< 3000'  ){
						$sql .=  " AND  ( PM_3.meta_key='tochikukaku' OR PM_3.meta_key='tatemonomenseki' )";
				//		$sql .=  " AND  PM_3.meta_key='tochikukaku' ";
				}else{
					if( $is_tochi || $shu_data == '< 3000' ){
						$sql .=  " AND  ( PM_3.meta_key='tochikukaku' OR PM_3.meta_key='tatemonomenseki' )";
					}else{
						$sql .=  " AND  PM_3.meta_key='tatemonomenseki' ";
					}
				}


				if( $mel_data > 0 )
					$sql .=  " AND CAST(PM_3.meta_value AS SIGNED) >= $mel_data ";
				if( $meh_data > 0 )
					$sql .=  " AND CAST(PM_3.meta_value AS SIGNED) <= $meh_data ";
				$sql .=  " AND PM_3.meta_value !='' ";
			}


			//築年数 ( 2010/11 201011 )
			if($tik_data > 0 || $bukken_sort_data== "tatemonochikunenn" ){
				$sql .=  " AND PM_4.meta_key='tatemonochikunenn' ";
				if( $tik_data > 0 )
				//	$sql .=  " AND ( CAST(LEFT(PM_4.meta_value,4) AS SIGNED)  *100 + CAST(RIGHT(PM_4.meta_value,2) AS SIGNED) ) >= ($nowym- $tik_data * 100) ";
					$sql .=  " AND ( CAST(LEFT(PM_4.meta_value,4) AS SIGNED)  *100 + CASE WHEN LENGTH(PM_4.meta_value)>5 THEN CAST(RIGHT(PM_4.meta_value,2) AS SIGNED) ELSE 0 END ) >= ($nowym- $tik_data * 100) ";
			}


			//設備
			if(!empty($set_id)) {
				$sql .=  " AND (PM_5.meta_key='setsubi' AND ( ";
				$i=0;
				foreach($set_id as $meta_box){
				//	if($i!=0) $sql .= " OR ";
					if($i!=0) $sql .= " AND ";
					$sql .= " PM_5.meta_value LIKE '%".$set_id[$i]."%'";
					$i++;
				}
				$sql .=  " ))";
			}

			//間取
			if(!empty($madori_id)) {
				$sql .=  " AND ( ";
				$i=0;
				foreach($madori_id as $meta_box){
					$madorisu_data = $madori_id[$i];
					if($i!=0) $sql .= " OR ";
					$sql .= " (PM_6.meta_key='madorisu' AND PM_6.meta_value ='".FudoUtil::madorisuu_by_madori_data($madorisu_data)."' ";
					$sql .= " AND PM_7.meta_key='madorisyurui' AND PM_7.meta_value ='".myRight($madorisu_data,2)."')";
					$i++;
				}
				$sql .=  " ) ";
			}else{
				if( $bukken_sort_data== "madorisu" ){
					$sql .= " AND PM_6.meta_key='madorisu'";
					$sql .= " AND PM_7.meta_key='madorisyurui'";
				}
			}

			if( $bukken_sort_data== "shozaichicode" ) {
				$sql .=  " AND PM_10.meta_key='shozaichicode'";
				$sql .=  " AND PM_11.meta_key='shozaichimeisho'";
			}
			if($bukken_slug_data=="shiku" && $nor_id){
				$sql .=  " AND PM_NOR.meta_key='shozaichicode'  AND LEFT(PM_NOR.meta_value,2)='".$mid_id."'";
				$sql .=  " AND RIGHT(LEFT(PM_NOR.meta_value,5),3)='".$nor_id."'";
			}


			$sql .=  " ) ";


		}
			
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) as co","SELECT DISTINCT P.ID AS object_id",$sql);
			//更新日順
			if($bukken_sort_data2 == "post_modified"){
				$sql2 .=  " ORDER BY PM_KAIIN.meta_value, P.post_modified ".$bukken_order_data2;
			}else{

				//価格
				if($bukken_sort_data == "kakaku"){
					$sql2 .=  " ORDER BY CAST(PM_1.meta_value AS SIGNED) ".$bukken_order_data;
				}

				//面積
				if($bukken_sort_data == "tatemonomenseki"){
					$sql2 .=  " ORDER BY CAST(PM_3.meta_value AS SIGNED) ".$bukken_order_data;
				}

				//テキストカウント
				if($bukken_sort_data== "tatemonochikunenn"){
					$sql2 .=  " ORDER BY CAST(PM_4.meta_value AS SIGNED) ".$bukken_order_data;
				}

				//数値・数値カウント
				if($bukken_sort_data== "madorisu"){
					$sql2 .=  " ORDER BY CAST(PM_6.meta_value AS SIGNED) ".$bukken_order_data.", CAST(PM_7.meta_value AS SIGNED) ".$bukken_order_data."";

				}

				//数値・テキストカウント
				if($bukken_sort_data== "shozaichicode"){
					$sql2 .=  " ORDER BY CAST(PM_10.meta_value AS SIGNED) ".$bukken_order_data.", PM_11.meta_value ".$bukken_order_data."";
				}
			}

			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";



	}

	//カウント
	if($sql !=''){
		$metas = $wpdb->get_row( $sql );
		$metas_co = $metas->co;	
	}

	$site = site_url( '/' );
	$plugin_url = WP_PLUGIN_URL .'/fudou/';

?>
<?php //echo ViewUtil::getUrl(array('paged', 'so', 'ord'))?>

	<div class="section"><h3>検索結果</h3>
		<div class="in_box">
	

<input type="hidden" id="now_url" value="<?php echo ViewUtil::getUrl(array('paged', 'num'))?>">
<input type="hidden" id="now_url_none_sort" value="<?php echo ViewUtil::getUrl(array('paged', 'so', 'ord'))?>">
<input type="hidden" id="template_url" value="<?php bloginfo('template_url'); ?>">
<!--以下デフォルト-->



			<?php //wp_title( '|', true, 'right' ); ?>


<?php
		//ソート

		if($metas_co != 0 ){
			$kak_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='kak' && $_GET['ord']=='')
				$kak_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='kak' && $_GET['ord']=='d')
				$kak_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			if($bukken_sort_data2 == "post_modified" && $_GET['so'] == '')
				$kak_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';


			$tam_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='tam' && $_GET['ord']=='')
			$tam_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='tam' && $_GET['ord']=='d')
			$tam_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';

			$mad_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='mad' && $_GET['ord']=='')
			$mad_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='mad' && $_GET['ord']=='d')
			$mad_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';

			$sho_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='sho' && $_GET['ord']=='')
			$sho_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='sho' && $_GET['ord']=='d')
			$sho_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';

			$tac_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='tac' && $_GET['ord']=='')
			$tac_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='tac' && $_GET['ord']=='d')
			$tac_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';

			$page_navigation = '<div id="nav-above1" class="navigation">';
			$page_navigation .= '<div class="nav-previous">';


			//条件検索
			if($bukken_slug_data=="jsearch"){

				//url生成

				//間取り
				$madori_url = '';
				if(!empty($madori_id)) {
					$i=0;
					foreach($madori_id as $meta_box){
						$madori_url .= '&amp;mad[]='.$madori_id[$i];
						$i++;
					}
				}


				//設備条件
				$setsubi_url = '';
				if(!empty($set_id)) {
					$i=0;
					foreach($set_id as $meta_box){
						$setsubi_url .= '&amp;set[]='.$set_id[$i];
						$i++;
					}
				}

				$add_url  = '';


				//複数種別

				$add_url  .= '&amp;shub='.$shub;

				if (is_array($bukken_shubetsu)) {
					$i=0;
					foreach($bukken_shubetsu as $meta_set){
						$add_url  .= '&amp;shu[]='.$bukken_shubetsu[$i];
						$i++;
					}

				} else {
					$add_url  .= '&amp;shu='.$bukken_shubetsu;
				} 

				$add_url .= '&amp;ros='.$ros_id;
				$add_url .= '&amp;eki='.$eki_id;
				$add_url .= '&amp;ken='.$ken_id;
				$add_url .= '&amp;sik='.$sik_id;
				$add_url .= '&amp;kalc='.$kalc_data;
				$add_url .= '&amp;kahc='.$kahc_data;
				$add_url .= '&amp;kalb='.$kalb_data;
				$add_url .= '&amp;kahb='.$kahb_data;
				$add_url .= '&amp;hof='.$hof_data;
				$add_url .= $madori_url;
				$add_url .= '&amp;tik='.$tik_data;
				$add_url .= '&amp;mel='.$mel_data;
				$add_url .= '&amp;meh='.$meh_data;
				$add_url .= $setsubi_url;

				if($sikirei_data !="")
					$add_url .= '&amp;skr=0';


				$joken_url  = $site .'?bukken=jsearch';


				//複数市区
				if (is_array($ksik_id)) {
					$i=0;
					foreach($ksik_id as $meta_set){
						$add_url .= '&amp;ksik[]='.$ksik_id[$i];
						$i++;
					}
				}

				//複数駅
				if(is_array( $rosen_eki )  ){
					$i=0;
					foreach($rosen_eki as $meta_set){
						$add_url .= '&amp;re[]='.$rosen_eki[$i];
						$i++;
					}
				}



				$joken_url .=$add_url;

			}else{

				//カテゴリ・タグ

				if($_GET['bukken_tag']!=''){
					$joken_url = $site.'?bukken_tag='.$slug_data.'';
				}else{
					$joken_url = $site.'?bukken='.$slug_data.'';
				}

				$add_url  = '&amp;shu='.$bukken_shubetsu;
				$add_url .= '&amp;mid='.$mid_id;
				$add_url .= '&amp;nor='.$nor_id;

			if( $searchtype !='' )
				$add_url .= '&amp;st='.$searchtype;

				$joken_url .= $add_url;

			}


			$page_navigation .= '</div>';
			$page_navigation .= '<div class="nav-next">';

			if($bukken_order=="d"){
				$bukken_order = "";
			}else{
				$bukken_order = "d";
			}

			//ページナビ
			$page_navigation .= f_page_navi($metas_co,$posts_per_page,$bukken_page_data,$bukken_sort,$bukken_order,$bukken_page_data,$s,$joken_url);

			$page_navigation .= '</div>';
			$page_navigation .= '</div><!-- #nav-above -->';

//			echo $page_navigation;
		}
	//パーマリンクチェック
	$permalink_structure = get_option('permalink_structure');
	if ( $permalink_structure != '' ) {

		$add_url_point = mb_strlen( $add_url, "utf-8" ) ;
		if( $add_url_point > 5 ){
			$add_url_point = $add_url_point - 5;
			$add_url = '?' . myRight( $add_url, $add_url_point ) ;
		}else{
			$add_url = '';
		}
	}		
		

	//カウント
	$estate_kaiin_count = 0;
	$metas_co = 0;
	if($sql !=''){
		$_estateCountHash = $termRelModel->getEstateCount($sql, $shub);
		$metas_co = $_estateCountHash['metas_co'];
		$estate_kaiin_count = $_estateCountHash['estate_kaiin_count'];
	}
?>
<?php $sortArray = FudoUtil::select_sort($so,$ord)?>
<div class="infobox clearfix">
		<div class="sort">
				表示順<select name="sort" id="sort">
				<?php foreach($sortArray as $sort):?>
					<option value="<?php echo $sort['id']?>"<?php echo $sort['selected']?>><?php echo $sort['name']?></option>
				<?php endforeach?>
				</select>	
		</div>
	<?php $postPerPageArray = FudoUtil::select_post_per_page($posts_per_page);?>
		<div class="sort">
			表示順<select name="num" id="post_per_page">
			<?php foreach($postPerPageArray as $ppp):?>
			<option value="<?php echo $ppp['id']?>" <?php echo $ppp['selected']?>><?php echo $ppp['name']?></option>
			<?php endforeach?>
			</select>	
		</div>
		<?php $estate_count = $metas_co?>

	<br>
<?php 
	
	$paged = ViewUtil::getPaged();
	$pagination = ViewUtil::pagination(ceil($estate_count / $posts_per_page), $paged,  3, ViewUtil::getUrl());
	echo $pagination;
?>
</div>

<?php


//	loop SQL
	if($sql !=''){
		//$sql2 = $wpdb->prepare($sql2);
		$metas = $wpdb->get_results( $sql2, ARRAY_A );
//		$tmps = array();
		$tmpIds = array();
		foreach($metas as $meta){
			$tmpIds[] = $meta['object_id'];
//			break;
		}
		if(!empty($metas)) {
			$meta_datas = $postModel->getPosts($tmpIds);
			$img_infos = $postModel->getFudoImgs($tmpIds, array(1,2));
			$attachment_data = $postModel->getAttachimentImgDatas($tmpIds);
//			$postModel->getAttachmentMetaData($tmpIds);
//			var_dump($imgInfos);
//			exit;
//			foreach ( $metas as $meta ) {
			foreach ( $meta_datas as $meta_data ) {
//				$meta_id = $meta['object_id'];	//post_id
//				$meta_data = get_post( $meta_id ); 
				$meta_id = $meta_data->ID;
				$meta_title =  $meta_data->post_title;
				//ユーザー別会員物件リスト
				$show_bukken = users_kaiin_bukkenlist($meta_id,$kaiin_users_rains_register, get_post_meta($meta_id, 'kaiin', true) );
				if((is_user_logged_in() && $show_bukken)
						|| get_post_meta($meta_id, 'kaiin', true) != 1 
						){
					include 'archive-fudo-loop.php';
				}

			}
		}else{
			echo "物件がありませんでした。";
		}
	}else{
		echo "物件がありませんでした。";
	}


//	loop SQL END

?>

		</div><!--.in_box-->
	</div><!--.section-->
 <?php dynamic_sidebar('syousai_widgets'); ?>

			<?php //echo $page_navigation; ?>
			<div class="infobox clearfix">
				<?php echo $pagination;?>
			</div>

<script src="<?php echo site_url()?>/wp-content/themes/<?php echo SN_THEME_DIR?>/js/jquery.cookie.js"></script>
<script src="<?php echo site_url()?>/wp-content/themes/<?php echo SN_THEME_DIR?>/js/cart.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var now_url = $("#now_url").val();
		var template_url = $("#template_url").val();
		$(".addKouho").click(function(){
			var id = $(this).attr("id");
			var key = id.replace("addKouho_", "");
			if(!hasCookie(key)){
				addCookie(key);
				$("#kouhoimg_" + key).attr("src", template_url + "/images/loop/btn_cartin.png");
			}else{
				deleteCookie(key);
				$("#kouhoimg_" + key).attr("src", template_url + "/images/loop/btn_cart.png");
			}
		});
		$('#post_per_page').change(function() {
			var num = $(this).val();
			var url = now_url + "&num=" + num;
			$(location).attr('href',url);
		});
		$('#sort').change(function() {
			var now_url_none_sort = $("#now_url_none_sort").val();
			var tmp = $(this).val();
			var tmps = tmp.split('_')
			var so = tmps[0];
			var ord = tmps[1];
			var url = now_url_none_sort + "&so=" + so + "&ord=" + ord;
			$(location).attr('href',url);
		});
	});
	
</script>
<?php get_footer(); ?>



