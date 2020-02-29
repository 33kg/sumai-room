<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

// 賃貸物件検索用
the_post();
$find = isset($_GET['find'])? $_GET['find'] : '1' ;
$postModel = NrPostModel::getInstance();
//売買 賃貸
$shub = 2;
$shub_txt = ' (賃貸)';

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
);

$tinryouHighHash = array(
	0=> '上限なし',
	3=> '3万円',
	4=> '4万円',
	5=> '5万円',
	6=> '6万円',
	7=> '7万円',
	8=> '8万円',
	9=> '9万円',
	10=> '10万円',
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
	0=> '上限なし',
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

?>
<div class="content-area" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search-rent">賃貸検索</a></li>
	</ul>

	<section class="wrap-block wrap-form">
		<h2>賃貸物件検索</h2>
		<?php include("searchform_rent.php"); //賃貸検索フォーム ?>
	</section>


</div><!-- .content-area -->
<?php get_footer(); ?>
