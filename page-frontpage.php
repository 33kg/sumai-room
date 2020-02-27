<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<?php include_once dirname(__FILE__) . '/../lib/nr_common.php'; ?>
<div class="content-area" style="min-height:800px;">

    <div class="wrap-gallery"><!--MV・商品画像-->
	    <div class="swiper-container gallery-top">
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
			<p class="date">更新日：<?php echo date( "Y.m.d", strtotime( get_lastpostmodified('blog') ) ); ?></p>
			<script>
			    var galleryTop = new Swiper('.gallery-top', {
					loop: true,
					slidesPerView: 1.5,
					spaceBetween: 10,
					centeredSlides : true,
					autoplay: {
							delay: 3000,
						},
			        loop: true
			    });
			</script>
	    </div>
    </div>

	<section class="wrap-block">

		<h2>PICK UP<span>住まいコンシェルジュChoice</span>
			<ul class="icon">
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search-rent"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-rent.png" alt=""></a></li>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>search-buy"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-buy.png" alt=""></a></li>
			<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-line.png" alt=""></a></li>
			<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-mail.png" alt=""></a></li>
			</li>
		</h2>
		<h3>RENT</h3>
	    <div class="wrap-gallery"><!--MV・商品画像-->
		    <div class="swiper-container gallery-top2">
		        <div class="swiper-wrapper">
					<?php include("inc_property_rent.php"); ?>
				</div>
				<!-- If we need navigation buttons -->
				<div class="wrap-button">
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
				<script>
				    var galleryTop = new Swiper('.gallery-top2', {
						loop: true,
						slidesPerView: 4,
						spaceBetween: 20,
				        loop: true
				    });
				</script>
		    </div>
	    </div>
		<div class="wrap-link"><a href="#">more</a></div>
	</section>

	<section class="wrap-block">

		<h3>BUY</h3>
	    <div class="wrap-gallery"><!--MV・商品画像-->
		    <div class="swiper-container gallery-top2">
		        <div class="swiper-wrapper">
					<div class="swiper-slide"><?php include("inc_property_buy.php"); ?></div>

					<?php //繰り返し部分  ?>
					<div class="swiper-slide"><?php include("inc_property_buy.php"); ?></div>
					<div class="swiper-slide"><?php include("inc_property_buy.php"); ?></div>
					<div class="swiper-slide"><?php include("inc_property_buy.php"); ?></div>
					<div class="swiper-slide"><?php include("inc_property_buy.php"); ?></div>
					<div class="swiper-slide"><?php include("inc_property_buy.php"); ?></div>
					<?php // ./繰り返し部分  ?>
				</div>
				<!-- If we need navigation buttons -->
				<div class="wrap-button">
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
				<script>
				    var galleryTop = new Swiper('.gallery-top2', {
						loop: true,
						slidesPerView: 4,
						spaceBetween: 20,
				        loop: true
				    });
				</script>
		    </div>
	    </div>
		<div class="wrap-link"><a href="#">more</a></div>

	</section>

	<section class="wrap-block">
		<h2>CONTENTS<span>不動産のお悩み解決します</span></h2>
		<ul class="contents">
		<li><a href="https://fsouzoku.jp/"><img src="<?php echo get_template_directory_uri(); ?>/images/top/pc_bn_souzoku.png"><span>不動産相続の相談窓口</span></a></li>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>management"><img src="<?php echo get_template_directory_uri(); ?>/images/top/pc_bn_akiya.png"><span>空き家管理サービス</span></a></li>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>owner"><img src="<?php echo get_template_directory_uri(); ?>/images/top/pc_bn_owner.png"><span>オーナー様へ</span></a></li>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>assessment"><img src="<?php echo get_template_directory_uri(); ?>/images/top/pc_bn_satei.png"><span>売却査定依頼</span></a></li>
		</ul>
	</section>

	<section class="wrap-block">
		<h2>TOPICS<span>住まいるーむ情報</span></h2>
		<ul class="topics">
			<?php include("inc_topics.php"); ?>
		</ul>
		<div class="wrap-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>topics">more</a></div>
	</section>

	<section class="wrap-block">
		<h2>ACCESS<span>アクセス</span></h2>
		<div class="wrap-access">
			<div class="tex">
				<p class="shop-name">住まいるーむ情報館　本店</p>
				<p class="add">〒991-0041<br>
				山形県寒河江市大字寒河江横道137<br>
				TEL: 0237-86-6396<br>
				FAX: 0237-86-6390<br>
				MAIL: info@sumai-room.com</p>

			</div>
			<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6256.415388225102!2d140.2806388!3d38.3673165!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f8bc6abe7856617%3A0x13c7af56ce6f97f8!2z77yI5pyJ77yJ5L2P44G-44GE44KL44O844KA5oOF5aCx6aSo!5e0!3m2!1sja!2sjp!4v1551350286712" width="350" height="350" frameborder="0" style="border:0" allowfullscreen></iframe></div>		
		</div>
		<div class="wrap-access">
			<div class="tex">
				<p class="shop-name">住まいるーむ情報館　山形店</p>
				<p class="add">〒990-0062<br>
				山形県山形市鈴川町3丁目1-22<br>
				TEL: 023-615-8077<br>
				FAX: 023-615-8078<br>
				MAIL: info@sumai-room.com</p>

			</div>
			<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d783.1051594303631!2d140.35542282919207!3d38.269741051635805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDE2JzExLjEiTiAxNDDCsDIxJzIxLjUiRQ!5e0!3m2!1sja!2sjp!4v1567671498904!5m2!1sja!2sjp" width="350" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>		
		</div>

	</section>

	<section class="wrap-block">
		<h2>OTHERS</h2>
		<ul class="others">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>tought"><img src="<?php echo get_template_directory_uri(); ?>/images/top/others_omoi.png"><span>住まいるーむ情報館の想い</span></a></li>
		<li><a href="https://ameblo.jp/happy-sumairoom/"><img src="<?php echo get_template_directory_uri(); ?>/images/top/others_blog.png"><span>社長の「幸せ・ブログ」</span></a></li>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>presidents-style"><img src="<?php echo get_template_directory_uri(); ?>/images/top/others_president.png"><span>社長の流儀</span></a></li>
		</ul>
	</section>




</div><!-- .content-area -->
<?php get_footer(); ?>
