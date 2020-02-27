<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

// 不動産情報取得用
the_post();
global $post_id;
global $syubetu;
$post_id = $post->ID;
$syubetu = FudoUtil::getSyubetu( $post_id );

//物件画像取得
$postModel = NrPostModel::getInstance();
$thumbOptions = array();
$largeOptions = array();
$length = 30;
for($i=1;$i<=$length;$i++){
	$thumbOptions[$i] = array('imgid' => $i,'size' => 'thumbnail');
	$largeOptions[$i] = array('imgid' => $i,'size' => 'large');
}
$img_infos = $postModel->getFudoImgs(array($post_id), array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30));
$attachment_data = $postModel->getAttachimentImgDatas(array($post_id));
$imgThumbArray = FudoUtil::fudoimgurls($post_id, $img_infos, $attachment_data, 'thumbnail');
$imgLargeArray = FudoUtil::fudoimgurls($post_id, $img_infos, $attachment_data, 'large');
if(my_custom_kaiin_view('kaiin_gazo', 0, 1)){
}else{
	FudoUtil::convertKaiinImage($imgThumbArray, 'thumbnail', 0, 1);
	FudoUtil::convertKaiinImage($imgLargeArray, 'large', 0, 1);
}
?>

<div class="content-area" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<?php if( $syubetu == SYUBETU_CHINTAI ): ?>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search_rent">賃貸検索</a></li>
	<?php else: ?>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search_buy">売買検索</a></li>
	<?php endif; ?>
	<li><a href="<?php the_permalink(); ?>"><?php echo FudoUtil::bukkennmei($post_id); ?></a></li>
	</ul>


<div class="wrap-detail">

	<div class="summary">
		<img src="<?php echo $imgLargeArray[0]['img_url']; ?>">
		<h2><?php echo FudoUtil::bukkennmei($post_id); ?></h2>
		<?php if($syubetu == SYUBETU_CHINTAI):?>
			<?php include("inc/bukken/inc-fudoinfo-chintai.php"); ?>
		<?php elseif($syubetu == SYUBETU_URICHI):?>
			<?php include("inc/bukken/inc-fudoinfo-urichi.php"); ?>
		<?php elseif($syubetu == SYUBETU_URIKODATE):?>
			<?php include("inc/bukken/inc-fudoinfo-urikodate.php");	?>
		<?php elseif($syubetu == SYUBETU_URIMANSION):?>
			<?php include("inc/bukken/inc-fudoinfo-urimansion.php"); ?>
		<?php elseif($syubetu == SYUBETU_URITATEMONO_ICHIBU):?>
			<?php include("inc/bukken/inc-fudoinfo-uritatemono-ichibu.php"); ?>
		<?php elseif($syubetu == SYUBETU_URITATEMONO_ZENBU):?>
			<?php include("inc/bukken/inc-fudoinfo-uritatemono-zenbu.php");	?>
		<?php endif?>
	</div>

	<div class="detail">

	    <div class="wrap-gallery"><!--MV・商品画像-->
		    <div class="swiper-container gallery-single">
		        <div class="swiper-wrapper">
				<?php for( $i=1; $i < count($imgLargeArray); $i++ ): ?>
					<div class="swiper-slide"><img src="<?php echo $imgLargeArray[$i]['img_url']; ?>"></div>
				<?php endfor; ?>
				</div>
				<!-- If we need navigation buttons -->
				<div class="wrap-button">
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
		    </div>
			<!-- サムネイル -->
			<div class="swiper-container gallery-thumbnail">
			    <div class="swiper-wrapper">
				<?php for( $i=1; $i < count($imgLargeArray); $i++ ): ?>
					<div class="swiper-slide"><img src="<?php echo $imgLargeArray[$i]['img_url']; ?>"></div>
				<?php endfor; ?>
			    </div>
			</div>

				<script>
					//サムネイル
					var galleryThumbnail = new Swiper('.gallery-thumbnail', {
						slidesPerView: 5,
						freeMode: true,
						watchSlidesVisibility: true,
						watchSlidesProgress: true,
						spaceBetween: 10,
						centeredSlides : false,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
					});
					//スライダー
				    var galleryTop = new Swiper('.gallery-single', {
						loop: true,
						spaceBetween: 0,
						centeredSlides : true,
						autoplay: {
								delay: 3000,
							},
				        loop: true,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
						thumbs: {
							swiper: galleryThumbnail
						}
				    });
				</script>
	    </div>

		<?php remove_filter('the_content', 'wpautop'); ?>
		<p class="copy"><?php the_content(); ?></p>
		

		<?php if($syubetu == SYUBETU_CHINTAI):?>
			<?php include("inc/bukken/inc-fudodetail-chintai.php"); ?>
		<?php elseif($syubetu == SYUBETU_URICHI):?>
			<?php include("inc/bukken/inc-fudodetail-urichi.php"); ?>
		<?php elseif($syubetu == SYUBETU_URIKODATE):?>
			<?php include("inc/bukken/inc-fudodetail-urikodate.php");	?>
		<?php elseif($syubetu == SYUBETU_URIMANSION):?>
			<?php include("inc/bukken/inc-fudodetail-urimansion.php"); ?>
		<?php elseif($syubetu == SYUBETU_URITATEMONO_ICHIBU):?>
			<?php include("inc/bukken/inc-fudodetail-uritatemono-ichibu.php"); ?>
		<?php elseif($syubetu == SYUBETU_URITATEMONO_ZENBU):?>
			<?php include("inc/bukken/inc-fudodetail-uritatemono-zenbu.php");	?>
		<?php endif?>

		<div class="map">
			<strong>MAP</strong>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d783.1051594303631!2d140.35542282919207!3d38.269741051635805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDE2JzExLjEiTiAxNDDCsDIxJzIxLjUiRQ!5e0!3m2!1sja!2sjp!4v1567671498904!5m2!1sja!2sjp" width="100%" height="220px" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>		

		<div class="wrap-contact">
			<h2>お問い合わせ</h2>

			<ul>
			<li><img src="<?php echo get_template_directory_uri(); ?>/images/logo_line_square.png"></li>
			<li>この物件の<br>お問合わせ</li>
			<li>
				<span class="tex">お電話でもお問い合わせいただけます</span>
				<p class="phone"><img src="<?php echo get_template_directory_uri(); ?>/images/tel-header.png" alt="">0237-86-6396</p>
				<span class="tex2">営業時間　9:30〜18:30　毎週水曜定休</span>
			</li>
			</ul>
		</div>

		<section class="wrap-block wrap-recently_seen">
			<h2>この他の物件</h2>
			<ul class="recent-search">
			<?php if( $syubetu == SYUBETU_CHINTAI ) {
				include("inc_others_rent.php");
			} else {
				include("inc_others_buy.php");
			}		
			?>
			</ul>
			<div class="wrap-link"><a href="#">more</a></div>
		</section>
	</div>
	
</div>





</div><!-- .content-area -->
<?php get_footer(); ?>
