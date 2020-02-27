<?php

class FudoMailUtil {

	//条件種別
	public static function fudou_registration_form_syubetsu($user_mail_ID) {
		global $wpdb, $work_bukkenshubetsu;
		asort($work_bukkenshubetsu);
		//表示設定
		$kaiin_users_mail_shu = maybe_unserialize(get_option('kaiin_users_mail_shu'));
		//個人設定
		$user_mail_shu = maybe_unserialize(get_user_meta($user_mail_ID, 'user_mail_shu', true));
		$ret = array();
		if (is_array($kaiin_users_mail_shu)) {
			foreach ($work_bukkenshubetsu as $meta_box) {
				$tmp = array(
					'id' => '',
					'name' => '',
					'checked' => '',
				);
				$bukkenshubetsu_id = $meta_box['id'];


				if (is_array($kaiin_users_mail_shu)) {
					$i = 0;
					foreach ($kaiin_users_mail_shu as $meta_box2) {
						if ($kaiin_users_mail_shu[$i] == $bukkenshubetsu_id) {
							if (is_array($user_mail_shu)) {
								$k = 0;
								foreach ($user_mail_shu as $meta_box2) {
									if ($user_mail_shu[$k] == $bukkenshubetsu_id) {
										$tmp['checked'] = 'checked';
									}
									$k++;
								}
							}
							$tmp['id'] = $bukkenshubetsu_id;
							$tmp['name'] = $meta_box['name'];
							$ret[] = $tmp;
						}
						$i++;
					}
				}
			}
		}
		return $ret;
	}

	/**
	 * 
	 * @global type $wpdb
	 * @return array
	 * example return
	 * array(  
	 * 	array('tokyo' => array(
	 * 								'id' => '1111', 'name' => '新宿区', 'checked' => 'checked'),
	 * 								'id' => '1111', 'name' => '江東区', 'checked' => ''),
	 * 							);
	 * 	array('saitama' => array('id' => '222', 'name' => '埼玉区', 'checked' => 'checked'));
	 * )
	 */
	public static function fudou_registration_form_area($user_mail_ID) {
		global $wpdb;
		$ret = array();
		//表示設定
		$kaiin_users_mail_sik = maybe_unserialize(get_option('kaiin_users_mail_sik'));
		if (is_array($kaiin_users_mail_sik))
			asort($kaiin_users_mail_sik);

		//個人設定
		$user_mail_sik = maybe_unserialize(get_user_meta($user_mail_ID, 'user_mail_sik', true));

		if (is_array($kaiin_users_mail_sik)) {
			for ($i = 1; $i < 48; $i++) {
				$eigyouken_data = get_option('ken' . $i);
				$j = 0;
				$ken_data = '';
				$shiku_in_data = '';
				foreach ($kaiin_users_mail_sik as $meta_set) {

					if ($i < 10) {
						$ken_data = myLeft($kaiin_users_mail_sik[$j], 1);
						$shiku_data = myLeft($kaiin_users_mail_sik[$j], 4);
						$shiku_data = myRight($shiku_data, 3);
					} else {
						$ken_data = myLeft($kaiin_users_mail_sik[$j], 2);
						$shiku_data = myLeft($kaiin_users_mail_sik[$j], 5);
						$shiku_data = myRight($shiku_data, 3);
					}

					if ($eigyouken_data == $ken_data) {
						$shiku_in_data .= ',' . $shiku_data . '';
					}

					$j++;
				}

				if ($shiku_in_data != '') {
					$shiku_in_data = ' IN ( 0 ' . $shiku_in_data . ') ';

					//営業県表示
					$sql = "SELECT middle_area_id, middle_area_name FROM " . $wpdb->prefix . "area_middle_area WHERE middle_area_id = $eigyouken_data";
					$sql = $wpdb->prepare($sql, '');
					$metas = $wpdb->get_row($sql);
					$middle_area_name = $metas->middle_area_name;
					$ret[$middle_area_name] = array();

					//市区
					$sql = "SELECT narrow_area_id,narrow_area_name";
					$sql .= " FROM " . $wpdb->prefix . "area_narrow_area";
					$sql .= " WHERE middle_area_id = " . $eigyouken_data . "";
					$sql .= " AND narrow_area_id " . $shiku_in_data . "";
					$sql .= " ORDER BY narrow_area_id ASC";

					$sql = $wpdb->prepare($sql, '');
					$metas2 = $wpdb->get_results($sql, ARRAY_A);
					if (!empty($metas2)) {
						foreach ($metas2 as $meta2) {
							$tmp = array(
								'id' => '',
								'name' => '',
								'checked' => '',
							);
							$shozaichicode = $eigyouken_data . $meta2['narrow_area_id'] . '000000';
							if (is_array($user_mail_sik)) {
								$k = 0;
								foreach ($user_mail_sik as $meta_box3) {
									if ($user_mail_sik[$k] == $shozaichicode) {
										$tmp['checked'] = 'checked';
									}
									$k++;
								}
							}
							$tmp['id'] = $shozaichicode;
							$tmp['name'] = $meta2['narrow_area_name'];
							$ret[$middle_area_name][] = $tmp;
						}
					}
				}
			}
		}
		return $ret;
	}

	//条件路線駅
	/**
	 * 
	 * @global type $wpdb
	 * @param type $user_mail_ID
	 * @return type
	 * example return
	 * array(  
	 * 	array('つくばエクスプレス' => array(
	 * 								'id' => '1111', 'name' => '秋葉原', 'checked' => 'checked'),
	 * 								'id' => '1111', 'name' => 'つくば', 'checked' => ''),
	 * 							);
	 * 	array('総武線' => array('id' => '222', 'name' => '浅草橋', 'checked' => 'checked'));
	 */
	public static function fudou_registration_form_roseneki($user_mail_ID) {
		global $wpdb;
		$ret = array();
		//表示設定
		$kaiin_users_mail_eki = maybe_unserialize(get_option('kaiin_users_mail_eki'));
		//個人設定
		$user_mail_eki = maybe_unserialize(get_user_meta($user_mail_ID, 'user_mail_eki', true));


		if (is_array($kaiin_users_mail_eki)) {
			//営業県
			$shozaichiken_data = '';
			if ($shozaichiken_data == "") {
				$shozaichiken_data = '0';
				for ($i = 1; $i < 48; $i++) {
					if (get_option('ken' . $i) != '') {
						$shozaichiken_data .= ',' . get_option('ken' . $i);
					}
				}
			}

			$sql = "SELECT DISTINCT DTR.rosen_id, DTR.rosen_name";
			$sql = $sql . " FROM " . $wpdb->prefix . "train_area_rosen AS DTAR";
			$sql = $sql . " INNER JOIN " . $wpdb->prefix . "train_rosen AS DTR ON DTAR.rosen_id = DTR.rosen_id";
			$sql = $sql . " WHERE DTAR.middle_area_id in (" . $shozaichiken_data . ") ";
			$sql = $sql . " ORDER BY DTR.rosen_name";

			$sql = $wpdb->prepare($sql, '');
			$metas = $wpdb->get_results($sql, ARRAY_A);
			if (!empty($metas)) {
				//路線
				foreach ($metas as $meta) {
					$tmp_rosen = 0;

					//	$meta_id = $meta['rosen_id'];
					$meta_id = sprintf('%06d', $meta['rosen_id']);

					$meta_valu = $meta['rosen_name'];
					$i = 0;
					foreach ($kaiin_users_mail_eki as $meta_set) {
						$rosen_data = myLeft($kaiin_users_mail_eki[$i], 6);
						//	$eki_data = myRight($kaiin_users_mail_eki[$i],6);
						if ($meta_id == $rosen_data) {
							$ret[$meta_valu] = array();
							$tmp_rosen = 1;
							break;
						}
						$i++;
					}

					//駅
					$sql = "SELECT DTS.station_id, DTS.station_name";
					$sql = $sql . " FROM " . $wpdb->prefix . "train_station AS DTS";
					$sql = $sql . " WHERE DTS.rosen_id=" . $meta['rosen_id'] . " AND DTS.middle_area_id in (" . $shozaichiken_data . ")";
					$sql = $sql . " ORDER BY DTS.station_ranking";

					$sql = $wpdb->prepare($sql, '');
					$metas2 = $wpdb->get_results($sql, ARRAY_A);
					if (!empty($metas2)) {
						foreach ($metas2 as $meta2) {
							$tmp = array();
							$i = 0;
							foreach ($kaiin_users_mail_eki as $meta_set) {
								$rosen_data = myLeft($kaiin_users_mail_eki[$i], 6);
								$eki_data = myRight($kaiin_users_mail_eki[$i], 6);
								if ($meta_id == $rosen_data && $meta2['station_id'] == $eki_data) {
									$station_id = $meta_id . '' . sprintf('%06d', $meta2['station_id']);
									if (is_array($user_mail_eki)) {
										$k = 0;
										foreach ($user_mail_eki as $meta_box2) {
											$value = $user_mail_eki[$k];
											$k++;

											if ($value == $station_id) {
												$tmp['checked'] = 'checked';
											}
										}
									}
									$tmp['id'] = $station_id;
									$tmp['name'] = $meta2['station_name'];
									$ret[$rosenName][] = $tmp;
									break;
								}
								$i++;
							}
						}
					}
				}
			}
		}
		return $ret;
	}

	//条件価格
	public static function fudou_registration_form_kakaku($user_mail_ID) {
		fudou_registration_form_kakaku($user_mail_ID);
	}

	public static function fudou_registration_form_memseki_senyuu($user_mail_ID) {
		//個人設定
		$tatemo_l_data = get_user_meta($user_mail_ID, 'user_mail_tatemonomenseki_l', true);
		$tatemo_h_data = get_user_meta($user_mail_ID, 'user_mail_tatemonomenseki_h', true);

		if (get_option('kaiin_users_mail_tatemonomenseki') == 1) {
			echo "\n";
			echo '<p>';
			echo '専有面積<br />';
			echo '<select name="tatemo_l" id="tatemo_l">';
			echo '<option value="0">下限なし</option>';
			echo '<option value="10"';
			if ($tatemo_l_data == '10')
				echo ' selected="selected"'; echo '>10m&sup2;</option>';
			echo '<option value="15"';
			if ($tatemo_l_data == '15')
				echo ' selected="selected"'; echo '>15m&sup2;</option>';
			echo '<option value="20"';
			if ($tatemo_l_data == '20')
				echo ' selected="selected"'; echo '>20m&sup2;</option>';
			echo '<option value="25"';
			if ($tatemo_l_data == '25')
				echo ' selected="selected"'; echo '>25m&sup2;</option>';
			echo '<option value="30"';
			if ($tatemo_l_data == '30')
				echo ' selected="selected"'; echo '>30m&sup2;</option>';
			echo '<option value="35"';
			if ($tatemo_l_data == '35')
				echo ' selected="selected"'; echo '>35m&sup2;</option>';
			echo '<option value="40"';
			if ($tatemo_l_data == '40')
				echo ' selected="selected"'; echo '>40m&sup2;</option>';
			echo '<option value="50"';
			if ($tatemo_l_data == '50')
				echo ' selected="selected"'; echo '>50m&sup2;</option>';
			echo '<option value="60"';
			if ($tatemo_l_data == '60')
				echo ' selected="selected"'; echo '>60m&sup2;</option>';
			echo '<option value="70"';
			if ($tatemo_l_data == '70')
				echo ' selected="selected"'; echo '>70m&sup2;</option>';
			echo '<option value="80"';
			if ($tatemo_l_data == '80')
				echo ' selected="selected"'; echo '>80m&sup2;</option>';
			echo '<option value="90"';
			if ($tatemo_l_data == '90')
				echo ' selected="selected"'; echo '>90m&sup2;</option>';
			echo '<option value="100"';
			if ($tatemo_l_data == '100')
				echo ' selected="selected"'; echo '>100m&sup2;</option>';
			echo '<option value="150"';
			if ($tatemo_l_data == '150')
				echo ' selected="selected"'; echo '>150m&sup2;</option>';
			echo '<option value="200"';
			if ($tatemo_l_data == '200')
				echo ' selected="selected"'; echo '>200m&sup2;</option>';
			echo '<option value="250"';
			if ($tatemo_l_data == '250')
				echo ' selected="selected"'; echo '>250m&sup2;</option>';
			echo '<option value="300"';
			if ($tatemo_l_data == '300')
				echo ' selected="selected"'; echo '>300m&sup2;</option>';
			echo '<option value="350"';
			if ($tatemo_l_data == '350')
				echo ' selected="selected"'; echo '>350m&sup2;</option>';
			echo '<option value="400"';
			if ($tatemo_l_data == '400')
				echo ' selected="selected"'; echo '>400m&sup2;</option>';
			echo '<option value="450"';
			if ($tatemo_l_data == '450')
				echo ' selected="selected"'; echo '>450m&sup2;</option>';
			echo '<option value="500"';
			if ($tatemo_l_data == '500')
				echo ' selected="selected"'; echo '>500m&sup2;</option>';
			echo '</select>～';
			echo '<select name="tatemo_h" id="tatemo_h">';
			echo '<option value="10"';
			if ($tatemo_h_data == '10')
				echo ' selected="selected"'; echo '>10m&sup2;</option>';
			echo '<option value="15"';
			if ($tatemo_h_data == '15')
				echo ' selected="selected"'; echo '>15m&sup2;</option>';
			echo '<option value="20"';
			if ($tatemo_h_data == '20')
				echo ' selected="selected"'; echo '>20m&sup2;</option>';
			echo '<option value="25"';
			if ($tatemo_h_data == '25')
				echo ' selected="selected"'; echo '>25m&sup2;</option>';
			echo '<option value="30"';
			if ($tatemo_h_data == '30')
				echo ' selected="selected"'; echo '>30m&sup2;</option>';
			echo '<option value="35"';
			if ($tatemo_h_data == '35')
				echo ' selected="selected"'; echo '>35m&sup2;</option>';
			echo '<option value="40"';
			if ($tatemo_h_data == '40')
				echo ' selected="selected"'; echo '>40m&sup2;</option>';
			echo '<option value="50"';
			if ($tatemo_h_data == '50')
				echo ' selected="selected"'; echo '>50m&sup2;</option>';
			echo '<option value="60"';
			if ($tatemo_h_data == '60')
				echo ' selected="selected"'; echo '>60m&sup2;</option>';
			echo '<option value="70"';
			if ($tatemo_h_data == '70')
				echo ' selected="selected"'; echo '>70m&sup2;</option>';
			echo '<option value="80"';
			if ($tatemo_h_data == '80')
				echo ' selected="selected"'; echo '>80m&sup2;</option>';
			echo '<option value="90"';
			if ($tatemo_h_data == '90')
				echo ' selected="selected"'; echo '>90m&sup2;</option>';
			echo '<option value="100"';
			if ($tatemo_h_data == '100')
				echo ' selected="selected"'; echo '>100m&sup2;</option>';
			echo '<option value="150"';
			if ($tatemo_h_data == '150')
				echo ' selected="selected"'; echo '>150m&sup2;</option>';
			echo '<option value="200"';
			if ($tatemo_h_data == '200')
				echo ' selected="selected"'; echo '>200m&sup2;</option>';
			echo '<option value="250"';
			if ($tatemo_h_data == '250')
				echo ' selected="selected"'; echo '>250m&sup2;</option>';
			echo '<option value="300"';
			if ($tatemo_h_data == '300')
				echo ' selected="selected"'; echo '>300m&sup2;</option>';
			echo '<option value="350"';
			if ($tatemo_h_data == '350')
				echo ' selected="selected"'; echo '>350m&sup2;</option>';
			echo '<option value="400"';
			if ($tatemo_h_data == '400')
				echo ' selected="selected"'; echo '>400m&sup2;</option>';
			echo '<option value="450"';
			if ($tatemo_h_data == '450')
				echo ' selected="selected"'; echo '>450m&sup2;</option>';
			echo '<option value="500"';
			if ($tatemo_h_data == '500')
				echo ' selected="selected"'; echo '>500m&sup2;</option>';
			echo '<option value="0"';
			if ($tatemo_h_data == '0' || $tatemo_h_data == '')
				echo ' selected="selected"'; echo '>上限なし</option>';
			echo '</select>';
			echo '</p>';
		}
	}
	public static function fudou_registration_form_memseki_kukaku($user_mail_ID) {
		//個人設定
		$tochim_l_data = get_user_meta($user_mail_ID, 'user_mail_tochikukaku_l', true);
		$tochim_h_data = get_user_meta($user_mail_ID, 'user_mail_tochikukaku_h', true);
		
		if (get_option('kaiin_users_mail_tochikukaku') == 1) {
			echo "\n";
			echo '<p>';
			echo '<select name="tochim_l" id="tochim_l">';
			echo '<option value="0">下限なし</option>';
			echo '<option value="30"';
			if ($tochim_l_data == '30')
				echo ' selected="selected"'; echo '>30m&sup2;</option>';
			echo '<option value="35"';
			if ($tochim_l_data == '35')
				echo ' selected="selected"'; echo '>35m&sup2;</option>';
			echo '<option value="40"';
			if ($tochim_l_data == '40')
				echo ' selected="selected"'; echo '>40m&sup2;</option>';
			echo '<option value="50"';
			if ($tochim_l_data == '50')
				echo ' selected="selected"'; echo '>50m&sup2;</option>';
			echo '<option value="60"';
			if ($tochim_l_data == '60')
				echo ' selected="selected"'; echo '>60m&sup2;</option>';
			echo '<option value="70"';
			if ($tochim_l_data == '70')
				echo ' selected="selected"'; echo '>70m&sup2;</option>';
			echo '<option value="80"';
			if ($tochim_l_data == '80')
				echo ' selected="selected"'; echo '>80m&sup2;</option>';
			echo '<option value="90"';
			if ($tochim_l_data == '90')
				echo ' selected="selected"'; echo '>90m&sup2;</option>';
			echo '<option value="100"';
			if ($tochim_l_data == '100')
				echo ' selected="selected"'; echo '>100m&sup2;</option>';
			echo '<option value="150"';
			if ($tochim_l_data == '150')
				echo ' selected="selected"'; echo '>150m&sup2;</option>';
			echo '<option value="200"';
			if ($tochim_l_data == '200')
				echo ' selected="selected"'; echo '>200m&sup2;</option>';
			echo '<option value="250"';
			if ($tochim_l_data == '250')
				echo ' selected="selected"'; echo '>250m&sup2;</option>';
			echo '<option value="300"';
			if ($tochim_l_data == '300')
				echo ' selected="selected"'; echo '>300m&sup2;</option>';
			echo '<option value="350"';
			if ($tochim_l_data == '350')
				echo ' selected="selected"'; echo '>350m&sup2;</option>';
			echo '<option value="400"';
			if ($tochim_l_data == '400')
				echo ' selected="selected"'; echo '>400m&sup2;</option>';
			echo '<option value="450"';
			if ($tochim_l_data == '450')
				echo ' selected="selected"'; echo '>450m&sup2;</option>';
			echo '<option value="500"';
			if ($tochim_l_data == '500')
				echo ' selected="selected"'; echo '>500m&sup2;</option>';
			echo '<option value="600"';
			if ($tochim_l_data == '600')
				echo ' selected="selected"'; echo '>600m&sup2;</option>';
			echo '<option value="700"';
			if ($tochim_l_data == '700')
				echo ' selected="selected"'; echo '>700m&sup2;</option>';
			echo '<option value="800"';
			if ($tochim_l_data == '800')
				echo ' selected="selected"'; echo '>800m&sup2;</option>';
			echo '<option value="900"';
			if ($tochim_l_data == '900')
				echo ' selected="selected"'; echo '>900m&sup2;</option>';
			echo '<option value="1000"';
			if ($tochim_l_data == '1000')
				echo ' selected="selected"'; echo '>1000m&sup2;</option>';
			echo '</select>～';
			echo '<select name="tochim_h" id="tochim_h">';
			echo '<option value="30"';
			if ($tochim_h_data == '30')
				echo ' selected="selected"'; echo '>30m&sup2;</option>';
			echo '<option value="35"';
			if ($tochim_h_data == '35')
				echo ' selected="selected"'; echo '>35m&sup2;</option>';
			echo '<option value="40"';
			if ($tochim_h_data == '40')
				echo ' selected="selected"'; echo '>40m&sup2;</option>';
			echo '<option value="50"';
			if ($tochim_h_data == '50')
				echo ' selected="selected"'; echo '>50m&sup2;</option>';
			echo '<option value="60"';
			if ($tochim_h_data == '60')
				echo ' selected="selected"'; echo '>60m&sup2;</option>';
			echo '<option value="70"';
			if ($tochim_h_data == '70')
				echo ' selected="selected"'; echo '>70m&sup2;</option>';
			echo '<option value="80"';
			if ($tochim_h_data == '80')
				echo ' selected="selected"'; echo '>80m&sup2;</option>';
			echo '<option value="90"';
			if ($tochim_h_data == '90')
				echo ' selected="selected"'; echo '>90m&sup2;</option>';
			echo '<option value="100"';
			if ($tochim_h_data == '100')
				echo ' selected="selected"'; echo '>100m&sup2;</option>';
			echo '<option value="150"';
			if ($tochim_h_data == '150')
				echo ' selected="selected"'; echo '>150m&sup2;</option>';
			echo '<option value="200"';
			if ($tochim_h_data == '200')
				echo ' selected="selected"'; echo '>200m&sup2;</option>';
			echo '<option value="250"';
			if ($tochim_h_data == '250')
				echo ' selected="selected"'; echo '>250m&sup2;</option>';
			echo '<option value="300"';
			if ($tochim_h_data == '300')
				echo ' selected="selected"'; echo '>300m&sup2;</option>';
			echo '<option value="350"';
			if ($tochim_h_data == '350')
				echo ' selected="selected"'; echo '>350m&sup2;</option>';
			echo '<option value="400"';
			if ($tochim_h_data == '400')
				echo ' selected="selected"'; echo '>400m&sup2;</option>';
			echo '<option value="450"';
			if ($tochim_h_data == '450')
				echo ' selected="selected"'; echo '>450m&sup2;</option>';
			echo '<option value="500"';
			if ($tochim_h_data == '500')
				echo ' selected="selected"'; echo '>500m&sup2;</option>';
			echo '<option value="600"';
			if ($tochim_h_data == '600')
				echo ' selected="selected"'; echo '>600m&sup2;</option>';
			echo '<option value="700"';
			if ($tochim_h_data == '700')
				echo ' selected="selected"'; echo '>700m&sup2;</option>';
			echo '<option value="800"';
			if ($tochim_h_data == '800')
				echo ' selected="selected"'; echo '>800m&sup2;</option>';
			echo '<option value="900"';
			if ($tochim_h_data == '900')
				echo ' selected="selected"'; echo '>900m&sup2;</option>';
			echo '<option value="1000"';
			if ($tochim_h_data == '1000')
				echo ' selected="selected"'; echo '>1000m&sup2;</option>';
			echo '<option value="0"';
			if ($tochim_h_data == '0' || $tochim_h_data == '')
				echo ' selected="selected"'; echo '>上限なし</option>';
			echo '</select>';
			echo '</p>';
		}
	}
	//条件間取り
	public static function fudou_registration_form_madori($user_mail_ID) {
		global $work_madori;
		$ret = array();
		//表示設定
		$kaiin_users_mail_madori = maybe_unserialize( get_option('kaiin_users_mail_madori') );

		//個人設定
		$user_mail_madori = maybe_unserialize( get_user_meta( $user_mail_ID, 'user_mail_madori', true) );

		if (is_array($kaiin_users_mail_madori)) {

			for( $madorisu_data = 1; $madorisu_data < 6; $madorisu_data++ ){
				foreach( $work_madori as $meta_box ){
					$madori_code = $meta_box['code'] ;
					$tmp_madori = $madorisu_data.$madori_code;
					if(is_array($kaiin_users_mail_madori)) {
						$i=0;
						foreach( $kaiin_users_mail_madori as $meta_box2 ){
							if( $kaiin_users_mail_madori[$i] == $tmp_madori){
								if(is_array($user_mail_madori)) {
									$k=0;
									foreach( $user_mail_madori as $meta_box2 ){
										if( $user_mail_madori[$k] == $tmp_madori ){
											$tmp['checked'] = 'checked';
										}
										$k++;
									}
								}
								$tmp['id'] = $tmp_madori;
								$tmp['name'] = $madorisu_data . $meta_box['name'];
								$ret[] = $tmp;
							}
							$i++;
						}
					}
				}
			}
		}
		return $ret;
	}
	public static function fudou_registration_form_hofun($user_mail_ID){
		global $tohohunHash;
		$ret = array();
		$hof_data = get_user_meta( $user_mail_ID, 'user_mail_hohun', true);
		foreach($tohohunHash as $key => $value){
			$tmp = array(
				'id' => '',
				'name' => '',
				'selected' => '',
			);
			if($hof_data == $key){
				$tmp['selected'] = 'selected';
			}
			$tmp['id'] = $key;
			$tmp['name'] = $value;
			$ret[] = $tmp;
		}
		return $ret;
	}
	/**
	 * 条件設備 
	 * @global type $work_setsubi
	 * @param type $user_mail_ID
	 * @return array
	 * array(array(
	 *	'id' => '11',
	 *	'name' => 'namae',
	 *	'checked' => 'checked',
	 * ))
	 */
	public static function fudou_registration_form_setsubi($user_mail_ID) {
		global $work_setsubi;
		$ret = array();
		//表示設定
		$kaiin_users_mail_setsubi = maybe_unserialize( get_option('kaiin_users_mail_setsubi') );
		//個人設定
		$user_mail_setsubi = maybe_unserialize( get_user_meta( $user_mail_ID, 'user_mail_setsubi', true) );
		$value = '';

		foreach($work_setsubi as $meta_box){
			if(is_array($kaiin_users_mail_setsubi)) {

				$i=0;
				foreach($kaiin_users_mail_setsubi as $meta_box2){
					if($kaiin_users_mail_setsubi[$i] == $meta_box['code']){
						$tmp = array(
							'id' => '',
							'name' => '',
							'checked' => '',
						);
						if(is_array($user_mail_setsubi)) {
							$k=0;
							foreach($user_mail_setsubi as $meta_box3){
								if($user_mail_setsubi[$k] == $meta_box['code']){
									$value .= ' checked="checked"';
									$tmp['checked'] = 'checked';
								}
								$k++;
							}
						}
						$tmp['id'] = $meta_box['code'];
						$tmp['name'] = $meta_box['name'];
						$ret[] = $tmp;
					}
					$i++;
				}
			}
		}
		return $ret;
	}
	public static function validate_fudou_mail_update_profile(&$errors){
		if(isset($_POST['shu']) && count($_POST['shu']) == 0){
			$errors[] = "<span style='color:#ff0000'>物件種別を選択して下さい</span>";
		}
		return count($errors) == 0 ? true : false;
	}
	//フォームを更新したときのアクション
	public static function fudou_mail_update_profile(&$errors){
		global $user_ID;
		global $wpdb;
		$user_mail_ID = $user_ID;
		if(isset($_POST['user_id'])) $user_mail_ID = $_POST['user_id'];

//		if(isset($_POST['action'])){


			if(isset($_POST['user_mail_name'])) $user_mail_name = $_POST['user_mail_name'];
			if(isset($_POST['user_mail_name2'])) $user_mail_name2 = $_POST['user_mail_name2'];



			if( !empty($user_mail_name) && !empty($user_mail_ID) ){

				if( $user_mail_name == $user_mail_name2 ){
					$wpdb->update( $wpdb->users, array( 'user_email' => $user_mail_name ), array( 'ID' => $user_mail_ID ), array( '%s' ), array( '%d' ) );
					//wp_update_user( array ('ID' => $user_mail_ID, 'user_email' => $user_mail_name) ) ;
				}else{
					$errors[] = '<font color="#FF2200">もう一度、メールアドレスの設定をお願いします。</font>';
				}
			}


			//配信可否
			update_user_meta($user_mail_ID, "user_mail", isset($_POST["user_mail"]) ? $_POST["user_mail"] : '');

			//種別
			update_user_meta($user_mail_ID, "user_mail_shu", isset($_POST["shu"]) ? maybe_serialize($_POST["shu"]) : '' );

			//市区
			update_user_meta($user_mail_ID, "user_mail_sik", isset($_POST["sik"]) ? maybe_serialize($_POST["sik"]) : '' );

			//駅
			update_user_meta($user_mail_ID, "user_mail_eki", isset($_POST["eki"]) ? maybe_serialize($_POST["eki"]) : '' );


			//条件価格
			update_user_meta($user_mail_ID, "user_mail_kalb", isset($_POST["kalb"]) ? $_POST["kalb"] : '' );
			update_user_meta($user_mail_ID, "user_mail_kahb", isset($_POST["kahb"]) ? $_POST["kahb"] : '' );
			update_user_meta($user_mail_ID, "user_mail_kalc", isset($_POST["kalc"]) ? $_POST["kalc"] : '' );
			update_user_meta($user_mail_ID, "user_mail_kahc", isset($_POST["kahc"]) ? $_POST["kahc"] : '' );


			//面積
			update_user_meta($user_mail_ID, "user_mail_tatemonomenseki_l", isset($_POST["tatemo_l"]) ? $_POST["tatemo_l"] : '' );
			update_user_meta($user_mail_ID, "user_mail_tatemonomenseki_h", isset($_POST["tatemo_h"]) ? $_POST["tatemo_h"] : '' );
			update_user_meta($user_mail_ID, "user_mail_tochikukaku_l",     isset($_POST["tochim_l"]) ? $_POST["tochim_l"] : '' );
			update_user_meta($user_mail_ID, "user_mail_tochikukaku_h",     isset($_POST["tochim_h"]) ? $_POST["tochim_h"] : '' );


			//間取り
			update_user_meta($user_mail_ID, "user_mail_madori", isset($_POST["mad"]) ? maybe_serialize($_POST["mad"]) : '' );

			//歩分
			update_user_meta($user_mail_ID, "user_mail_hohun", isset($_POST["hof"]) ? $_POST["hof"] : '' );

			//条件設備
			update_user_meta($user_mail_ID, "user_mail_setsubi", isset($_POST["set"]) ? maybe_serialize($_POST["set"]) : '' );


			//メール日付リセット
			$user_mail_reset = get_option('user_mail_reset');
			if($user_mail_reset != 1)
				update_user_meta( $user_mail_ID, 'mail_date', '' );


			//手動で登録した場合
			$today = date("Y/m/d");	// 2011/04/01

			if(get_user_meta( $user_mail_ID, 'login_count', true) == '')
				update_user_meta( $user_mail_ID, 'login_count', '0' );

			if(get_user_meta( $user_mail_ID, 'login_date', true) == '')
				update_user_meta( $user_mail_ID, 'login_date', $today );
//		}
		return (count($errors) == 0);
		
	}
	public static function kaiin_users_mail_kakaku_name(){
		if( get_option('kaiin_users_mail_kakaku') == 1 ){
			return '価格(売買)';
		}elseif(get_option('kaiin_users_mail_kakaku') == 2){
			return '賃料(賃貸)';
		}
	}
}