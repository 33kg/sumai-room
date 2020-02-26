<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="content-area" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search_buy">売買検索</a></li>
	<li>ブライトヒルズ元町</li>
	</ul>


<div class="wrap-detail">

	<div class="summary">
		<img src="<?php echo get_template_directory_uri(); ?>/_dummy/aed9f95a2b16b96b01a8421fbb5715df-e1439795971398.png">
		<h2><?php wp_title(''); ?></h2>
		<p class="price"><span class="price1">価格</span>2480万円<span class="price2"></span></p>
		<?php include("inc_detailmore_buy.php"); //物件情報追記 ?>
	</div>

	<div class="detail">

	    <div class="wrap-gallery"><!--MV・商品画像-->
		    <div class="swiper-container gallery-single">
		        <div class="swiper-wrapper">
					<div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/35224855.png"></div>
					<div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/35224855.png"></div>
					<div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/35224855.png"></div>
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
					<div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/35224855.png"></div>
					<div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/35224855.png"></div>
					<div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/_dummy/35224855.png"></div>
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

		<p class="copy">ゆったり夜を過ごせる空間<br>追い焚き付きで毎日ぽかぽか</p>
		<p class="copy-body">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>

		<ul class="detail-more2">
		<li><span>土地面積</span>234.94㎡（公簿）</li>
		<li><span>土地権利</span>所有権</li>
		<li><span>用途地域</span>第１種低層住居専</li>
		<li><span>都市計画</span>未線引区域</li>
		<li><span>現状</span>未完成</li>
		<li><span>引渡</span>相談</li>
		<li><span>セットパック</span>なし</li>
		<li><span>接面道路</span>ー</li>
		<li><span>小学校</span>中部小学校</li>
		<li><span>中学校</span>陵南中学校</li>
		</ul>

		<ul class="detail-more4">
		<li><span>間取り</span>１階 LDK16畳　和室6畳　２階 洋室8畳　洋室6畳　洋室6.5畳</li>
		</ul>

		<dl class="detail-more3">
		<dt>設備・条件</dt>
		<dd>
			<ul class="icon-property">
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property01.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property02.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property03.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property04.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property05.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property06.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property07.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property08.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property09.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property10.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property11.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/_dummy/icon-property12.png"></li>
			</ul>
		</dd>
		</dl>
		<dl class="detail-more3">
		<dd>
			<ul class="icon-property2">

			<li>楽器不可</li>
			<li>２人入居可</li>
			<li>ペット対応</li>
			<li>保証人要</li>
			<li>ガスコンロ</li>
			<li>給湯</li>
			<li>追い焚き</li>
			<li>洗髪洗面化粧台</li>
			<li>バス専用</li>
			<li>シャワー</li>
			<li>トイレ専用</li>
			<li>バス・トイレ別</li>
			<li>エアコン</li>
			<li>地デジ対応</li>
			<li>プロパンガス</li>
			<li>排水下水</li>
			<li>エレベータ</li>
			<li>駐車場有</li>
			<li>町内会費別途</li>
			</ul>

		</dd>
		</dl>
		<dl class="detail-more3">
		<dt>備考</dt>
		<dd>
			ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト
		</dd>
		</dl>

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
			<h2>最近見た物件</h2>
			<ul class="recent-search">
			<li><?php include("inc_property_rent.php"); ?></li>
			<li><?php include("inc_property_rent.php"); ?></li>
			<li><?php include("inc_property_rent.php"); ?></li>
			</ul>
			<div class="wrap-link"><a href="#">more</a></div>
		</section>
	</div>
	
</div>





</div><!-- .content-area -->
<?php get_footer(); ?>
