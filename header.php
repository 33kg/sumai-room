<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if(is_front_page()) : ?><?php bloginfo('name'); ?><?php elseif(is_page()): ?><?php wp_title(''); ?>｜<?php bloginfo('name'); ?><?php else : ?><?php wp_title(''); ?>｜<?php bloginfo('name'); ?><?php endif; ?></title>
	

    <!-- OGP -->
    <meta property="og:title" content="AVIOT" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="日本のサウンドを熟知した日本人オーディオエキスパートが携わる日本発のオーディオビジュアルブランド。" />
    <meta property="og:url" content="https://aviot.jp/" />
    <meta property="og:image" content="https://aviot.jp/images/user/ogp.png" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125783995-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-125783995-1');
    </script>

	<link href="<?php echo get_template_directory_uri(); ?>/css/module.css?20200213" rel="stylesheet" type="text/css">
	<link href="<?php echo get_template_directory_uri(); ?>/css/menu.css?20200213" rel="stylesheet" type="text/css">
<?php if( is_page()): //固定ページのみの読み込み ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/pages.css" rel="stylesheet" type="text/css">
<?php endif; ?>


	<link href="<?php echo get_template_directory_uri(); ?>/css/smt.css" rel="stylesheet" type="text/css">

	<? /*GoogleFonts*/ ?>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Anton|Noto+Sans+JP&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/23832af4f8.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<? /*SmoothScroll*/ ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/smoothScroll.js"></script>

	<!-- Slider -->
	<script src="<?php echo get_template_directory_uri(); ?>/swiper/swiper.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/swiper/swiper.css" rel="stylesheet">

	<!-- Modale -->
	<script src="<?php echo get_template_directory_uri(); ?>/modaal/modaal.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/modaal/modal.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/modaal/modaal.min.css" rel="stylesheet">

	<link href="<?php echo get_template_directory_uri(); ?>/css/pages.css" rel="stylesheet" type="text/css">
<?php if(is_front_page()) : ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/top.css" rel="stylesheet" type="text/css">
<?php endif; ?>



	<style>

	</style>



</head>

<body <?php my_body_id(); ?> <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php include("inc_header.php"); ?>
