<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

// 売買物件検索用
the_post();
$find = isset($_GET['find'])? $_GET['find'] : '2' ;
$postModel = NrPostModel::getInstance();
//売買 賃貸
$shub = 1;
$shub_txt = ' (売買)';

$site = site_url( '/' ); 
if($shub == 1){
	$shu_data = '< 3000' ;
}else if($shub == 2){
	$shu_data = '> 3000' ;
}
$bukkenSyubetuHash = $postModel->getBukkenSyubetu($shu_data);
$madoriHash = $postModel->getMadoriHash($shu_data);
$setubiHash = $postModel->getSetubi($shu_data);
$shikuHash = $postModel->getShiku($shu_data);
$rosenStationHash = $postModel->getRosenStation($shu_data);

$tikunensuuHash = array(
	0=>'指定なし',
	1=>'1年以内(新築)',
	3=>'3年以内',
	5=>'5年以内',
	10=>'10年以内',
	15=>'15年以内',
	20=>'20年以内',
);
$kakakuLowHash = array(
	0=>'下限なし',
	500=>'500万円',
	1000=>'1000万円',
	1500=>'1500万円',
	2000=>'2000万円',
	2500=>'2500万円',
	3000=>'3000万円',
	3500=>'3500万円',
	4000=>'4000万円',
	4500=>'4500万円',
	5000=>'5000万円',
	5500=>'5500万円',
	6000=>'6000万円',
	7000=>'7000万円',
	8000=>'8000万円',
	9000=>'9000万円',
	10000=>'1億円',
);
$kakakuHighHash = array(
	500=>'500万円',
	1000=>'1000万円',
	1500=>'1500万円',
	2000=>'2000万円',
	2500=>'2500万円',
	3000=>'3000万円',
	3500=>'3500万円',
	4000=>'4000万円',
	4500=>'4500万円',
	5000=>'5000万円',
	5500=>'5500万円',
	6000=>'6000万円',
	7000=> '7000万円',
	8000=> '8000万円',
	9000=> '9000万円',
	10000=> '1億円',
	0=> '上限なし',	
);
$tinryouLowHash = array(
	0=> '下限なし',
	3=> '3万円',
	4=> '4万円',
	5=> '5万円',
	6=> '6万円',
	7=> '7万円',
	8=> '8万円',
	9=> '9万円',
	10=> '10万円',
	11=> '11万円',
	12=> '12万円',
	13=> '13万円',
	14=> '14万円',
	15=> '15万円',
	16=> '16万円',
	17=> '17万円',
	18=> '18万円',
	19=> '19万円',
	20=> '20万円',
	30=> '30万円',
	40=> '40万円',
	50=> '50万円',
	60=> '60万円',
	70=> '70万円',
	80=> '80万円',
	90=> '90万円',
	100=> '100万円',	

);

$tinryouHighHash = array(
	3=> '3万円',
	4=> '4万円',
	5=> '5万円',
	6=> '6万円',
	7=> '7万円',
	8=> '8万円',
	9=> '9万円',
	10=> '10万円',
	11=> '11万円',
	12=> '12万円',
	13=> '13万円',
	14=> '14万円',
	15=> '15万円',
	16=> '16万円',
	17=> '17万円',
	18=> '18万円',
	19=> '19万円',
	20=> '20万円',
	30=> '30万円',
	40=> '40万円',
	50=> '50万円',
	60=> '60万円',
	70=> '70万円',
	80=> '80万円',
	90=> '90万円',
	100=> '100万円',
	0=> '上限なし',

);
$tohohunHash = array(
	0=> '指定なし',
	1=> '1分以内',
	3=> '3分以内',
	5=> '5分以内',
	10=> '10分以内',
	15=> '15分以内',	
);
$mensekiLowHash = array(
	0 =>'下限なし',
	10=> '10m&sup2;',
	15=> '15m&sup2;',
	20=> '20m&sup2;',
	25=> '25m&sup2;',
	30=> '30m&sup2;',
	35=> '35m&sup2;',
	40=> '40m&sup2;',
	50=> '50m&sup2;',
	60=> '60m&sup2;',
	70=> '70m&sup2;',
	80=> '80m&sup2;',
	90=> '90m&sup2;',
	100=> '100m&sup2;',
	120=> '120m&sup2;',
	140=> '140m&sup2;',
	160=> '160m&sup2;',
	180=> '180m&sup2;',
	200=> '200m&sup2;',
	300=> '300m&sup2;',
	400=> '400m&sup2;',
	500=> '500m&sup2;',
	600=> '600m&sup2;',
	700=> '700m&sup2;',
	800=> '800m&sup2;',
	900=> '900m&sup2;',
	1000=> '1000m&sup2;',
);
$mensekiHighHash = array(
	10=> '10m&sup2;',
	15=> '15m&sup2;',
	20=> '20m&sup2;',
	25=> '25m&sup2;',
	30=> '30m&sup2;',
	35=> '35m&sup2;',
	40=> '40m&sup2;',
	50=> '50m&sup2;',
	60=> '60m&sup2;',
	70=> '70m&sup2;',
	80=> '80m&sup2;',
	90=> '90m&sup2;',
	100=> '100m&sup2;',
	120=> '120m&sup2;',
	140=> '140m&sup2;',
	160=> '160m&sup2;',
	180=> '180m&sup2;',
	200=> '200m&sup2;',
	300=> '300m&sup2;',
	400=> '400m&sup2;',
	500=> '500m&sup2;',
	600=> '600m&sup2;',
	700=> '700m&sup2;',
	800=> '800m&sup2;',
	900=> '900m&sup2;',
	1000=> '1000m&sup2;',
	0=> '上限なし',
);

?>
<div class="content-area" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search-buy">売買検索</a></li>
	</ul>

	<section class="wrap-block wrap-form">
		<h2>売買物件検索</h2>
		<?php include("searchform_buy.php"); //売買検索フォーム ?>
	</section>


	<section class="wrap-block wrap-recently_seen">
		<h2>この他の物件</h2>
		<ul class="recent-search">
		<?php include("inc_others_buy.php"); ?>
		</ul>
	</section>



</div><!-- .content-area -->
<?php get_footer(); ?>
