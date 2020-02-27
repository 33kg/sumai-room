<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own twentysixteen_setup() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function twentysixteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on Twenty Sixteen, use a find and replace
		 * to change 'twentysixteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'twentysixteen' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Twenty Sixteen 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'twentysixteen' ),
				'social'  => __( 'Social Links Menu', 'twentysixteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Dark Gray', 'twentysixteen' ),
					'slug'  => 'dark-gray',
					'color' => '#1a1a1a',
				),
				array(
					'name'  => __( 'Medium Gray', 'twentysixteen' ),
					'slug'  => 'medium-gray',
					'color' => '#686868',
				),
				array(
					'name'  => __( 'Light Gray', 'twentysixteen' ),
					'slug'  => 'light-gray',
					'color' => '#e5e5e5',
				),
				array(
					'name'  => __( 'White', 'twentysixteen' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
				array(
					'name'  => __( 'Blue Gray', 'twentysixteen' ),
					'slug'  => 'blue-gray',
					'color' => '#4d545c',
				),
				array(
					'name'  => __( 'Bright Blue', 'twentysixteen' ),
					'slug'  => 'bright-blue',
					'color' => '#007acc',
				),
				array(
					'name'  => __( 'Light Blue', 'twentysixteen' ),
					'slug'  => 'light-blue',
					'color' => '#9adffd',
				),
				array(
					'name'  => __( 'Dark Brown', 'twentysixteen' ),
					'slug'  => 'dark-brown',
					'color' => '#402b30',
				),
				array(
					'name'  => __( 'Medium Brown', 'twentysixteen' ),
					'slug'  => 'medium-brown',
					'color' => '#774e24',
				),
				array(
					'name'  => __( 'Dark Red', 'twentysixteen' ),
					'slug'  => 'dark-red',
					'color' => '#640c1f',
				),
				array(
					'name'  => __( 'Bright Red', 'twentysixteen' ),
					'slug'  => 'bright-red',
					'color' => '#ff675f',
				),
				array(
					'name'  => __( 'Yellow', 'twentysixteen' ),
					'slug'  => 'yellow',
					'color' => '#ffef8e',
				),
			)
		);

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Sixteen 1.6
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentysixteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentysixteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentysixteen_resource_hints', 10, 2 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'twentysixteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own twentysixteen_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentysixteen_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Inconsolata:400';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentysixteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentysixteen-style' ), '20181230' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20181230', true );

	wp_localize_script(
		'twentysixteen-script',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'twentysixteen' ),
			'collapse' => __( 'collapse child menu', 'twentysixteen' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Sixteen 1.6
 */
function twentysixteen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentysixteen-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20181230' );
	// Add custom fonts.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentysixteen_block_editor_styles' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

/*
* スラッグ名が日本語だったら自動的に投稿タイプ＋id付与へ変更（スラッグを設定した場合は適用しない）
*/
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );

/*
* スラッグ名をIDとして出力
*/
function my_body_id() {
  $post_obj =  $GLOBALS['wp_the_query']->get_queried_object();
  $slug = '';
  if(is_front_page()) {
    $slug = 'top';
    if(is_page() && get_post( get_the_ID() )->post_name) {
      $slug = $post_obj->post_name;
    }
  } elseif (is_category()) {
    $slug = $post_obj->category_nicename;
  }  elseif (is_tag()) {
    $slug = $post_obj->slug;
  } elseif ( is_singular() ) {
    $slug = $post_obj->post_name;
  } elseif (is_search()) {
    $slug  = $GLOBALS['wp_the_query']->posts ? 'search-results' : 'search-no-results';
  } elseif ( is_404() ) {
    $slug = 'error404';
  } 
  $body_id = esc_attr($slug);
  echo ( $body_id ) ? 'id="' . $body_id . '"' : '' ;
}

/*
* ループ外から記事の抜粋を取得する
*/
function ltl_get_the_excerpt($post_id='', $length=120){
	global $post; $post_bu = '';

	if(!$post_id){
		$post_id = get_the_ID();
	} else {
		$post_bu = $post;
		$post = get_post($post_id);
	}
	$mojionly = strip_tags($post->post_content);
	if(mb_strlen($mojionly ) > $length) $t = '..';
	$content =  mb_substr($mojionly, 0, $length);
	$content .= $t;
	if($post_bu) $post = $post_bu;
	return $content;
}

/*
* 不動産プラグインsingle-fudo.php読み込みフィルタの解除
*/
remove_filter( 'template_include', 'get_post_type_single_template_fudou' );

/* 
* 不動産プラグインarchive-fudo.phpとarchive-fudo-loop.phpの読み込みフィルタの解除 
*/
remove_filter( 'template_include', 'get_post_type_archive_template_fudou' , 11);
//オリジナルテーマ内 archive-fudo.php を読み込むように再設定。
function fudo_body_org_class( $class ) {
   $class[0] = 'archive archive-fudo';
   return $class;
}
function get_post_type_archive_org_template( $template = '' ) {
   global $wp_query;
   $cat = $wp_query->get_queried_object();
   $cat_name = isset( $cat->taxonomy ) ? $cat->taxonomy : '';
 
   if ( isset( $_GET['bukken'] ) || isset( $_GET['bukken_tag'] ) 
         || $cat_name == 'bukken' || $cat_name =='bukken_tag' ) {
      status_header( 200 );
      $template = locate_template( array('archive-fudo.php', 'archive.php') );
      add_filter( 'body_class', 'fudo_body_org_class' );
    }
   return $template;
}
add_filter( 'template_include', 'get_post_type_archive_org_template' , 11 );

// 物件投稿画面で必要な情報のみ表示するように変更
function custom_post_supports() {
    //作成者の項目を削除
    remove_post_type_support( 'fudo', 'author' );
    // 抜粋の項目を削除
    remove_post_type_support( 'fudo', 'excerpt' );
    // CSVtypeのフィールドを削除
    remove_action( 'admin_menu','my_custom_csvtype' );
    remove_action( 'save_post', 'custom_save_csvtype' );
    // metaフィールドを削除
    remove_action('admin_menu', 'my_custom_meta');
    remove_action('save_post', 'custom_save_meta');
    // 社内用メモを削除
    remove_action('admin_menu', 'my_custom_shanaimemo');
    remove_action('save_post', 'custom_save_shanaimemo');
    // 交通その他の項目を削除
    remove_action('admin_menu', 'my_custom_koutsusonota');
    remove_action('save_post', 'custom_save_koutsusonota');
    // 物件番号・掲載期限日の削除
    remove_action('admin_menu', 'my_custom_shikibesu');
    remove_action('save_post', 'custom_save_shikibesu');
    //金銭面の削除
    remove_action('admin_menu', 'my_custom_kinsenmen');
    remove_action('save_post', 'custom_save_kakaku');


}
add_action( 'init', 'custom_post_supports' );



// 社内用メモの項目を変更する
function fudo_custom_shanaimemo() {
    add_meta_box('my_custom_shanaimemo_area', '社内用メモ(非公開)', 'fudo_custom_shanaimemo_in', 'fudo', 'normal', 'high' );
}
function fudo_custom_shanaimemo_in() {
    global $post;
    echo '<input type="hidden" name="mycustom_shanaimemo_name" id="mycustom_shanaimemo_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

    echo '<label for="shanaimemo">社内用メモ</label> ';
    echo '<textarea rows="4" cols="60" name="shanaimemo" id="shanaimemo" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'shanaimemo',true)) .'</textarea>';
}
function fudo_custom_save_shanaimemo ( $post_id ) {
    if ( isset($_POST['mycustom_shanaimemo_name']) ){
        if ( !wp_verify_nonce( $_POST['mycustom_shanaimemo_name'], plugin_basename(__FILE__) )) {
            return $post_id;
        }
        if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
        } else {
            if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
        }

        // 社内用メモ
        $my_custom_shanaimemo_data = isset($_POST['shanaimemo']) ? $_POST['shanaimemo'] : '';
        if( strcmp($my_custom_shanaimemo_data,get_post_meta($post_id, 'shanaimemo', true)) != 0 )
            update_post_meta($post_id, 'shanaimemo',$my_custom_shanaimemo_data);
        elseif($my_custom_shanaimemo_data == "")
            delete_post_meta($post_id, 'shanaimemo',get_post_meta($post_id,'shanaimemo',true));
    }else{
        return $post_id;
    }
}
add_action( 'admin_menu', 'fudo_custom_shanaimemo' );
add_action( 'save_post' , 'fudo_custom_save_shanaimemo' );

// 物件番号の表示
function fudo_custom_shikibesu() {
    add_meta_box('my_custom_shikibesu_area', '物件', 'fudo_custom_shikibesu_in', 'fudo', 'advanced' );
}
function fudo_custom_shikibesu_in() {
    global $post;
    echo '<input type="hidden" name="mycustom_shikibesu_name" id="mycustom_shikibesu_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

    echo '<table><tr>';

    // 物件番号
    echo '<td>';
    echo '<label for="shikibesu">物件番号</label> ';
    echo '</td>';
    echo '<td>';
    echo '<input type="text" name="shikibesu" value="'.get_post_meta($post->ID,'shikibesu',true).'" size="25" />';
    echo ' <font color="#ff0000">*必須</font>';
    echo '</td>';
    echo '</tr></table>';
}
function fudo_custom_save_shikibesu( $post_id ) {
    if ( isset($_POST['mycustom_shikibesu_name']) ){
        if ( !wp_verify_nonce( $_POST['mycustom_shikibesu_name'], plugin_basename(__FILE__) )) {
            return $post_id;
        }
        if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
        } else {
            if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
        }

        // 自社管理物件番号
        $my_custom_shikibesu_data = isset($_POST['shikibesu']) ? $_POST['shikibesu'] : '';
        if( strcmp($my_custom_shikibesu_data,get_post_meta($post_id, 'shikibesu', true)) != 0 )
            update_post_meta($post_id, 'shikibesu', $my_custom_shikibesu_data);

        elseif($my_custom_shikibesu_data=="")
            delete_post_meta($post_id, 'shikibesu',get_post_meta($post_id,'shikibesu',true));

    }else{
        return $post_id;
    }
}
add_action('admin_menu', 'fudo_custom_shikibesu');
add_action('save_post', 'fudo_custom_save_shikibesu');



// 金銭面の項目ID追加
function fudo_custom_kinsenmen() {
    add_meta_box('my_custom_kinsenmen_area', '金銭面', 'fudo_custom_kinsenmen_in', 'fudo', 'advanced' );
}

function fudo_custom_kinsenmen_in() {
    global $post;
    echo '<input type="hidden" name="mycustom_kakaku_name" id="mycustom_kakaku_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

    echo '<table><tr id="kakaku">';

    // 賃料・価格 ※ 単位：円
    echo '<td>';
    echo '<label for="kakaku">賃料・価格</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakaku" value="'.get_post_meta($post->ID,'kakaku',true).'" size="15" /> 円 (半角数値)';
    echo ' <font color="#ff0000">*</font><br />';
    echo '</td>';


    echo '</tr><tr id="kakakukoukai">';


    // 税額 ※ 単位：円
    //echo '<label for="kakakuzei">税額</label> ';
    //echo '<input type="text" name="kakakuzei" value="'.get_post_meta($post->ID,'kakakuzei',true).'" size="15" /> 円 (半角数値)<br />';


    // 価格公開	0:非公開 1:公開 (投資用物件以外では、常に公開される)
    echo '<td>';
    echo '<label for="kakakukoukai">価格公開</label> ';
    echo '</td>';

    echo '<td>';
    echo '<select name="kakakukoukai">';
    echo '<option value="">価格公開</option>';
    echo '<option value="1"';  if(get_post_meta($post->ID,'kakakukoukai',true)=="1"){  	 echo ' selected="selected"';  }
    echo '">公開</option>';
    echo '<option value="0"';  if(get_post_meta($post->ID,'kakakukoukai',true)=="0"){  	 echo ' selected="selected"';  }
    echo '">非公開</option>';
    echo '</select><br />';
    echo '</td>';


    echo '</tr><tr id="kakakujoutai">';


    // 価格状態	1:相談 2:確定 3:入札(投資用物件のみ)
    echo '<td>';
    echo '<label for="kakakujoutai">価格状態</label> ';
    echo '</td>';

    echo '<td>';
    echo '<select name="kakakujoutai">';
    echo '<option value="">価格状態(非公開の場合)</option>';
    echo '<option value="1"';  if(get_post_meta($post->ID,'kakakujoutai',true)=="1"){  	 echo ' selected="selected"';  }
    echo '">相談</option>';
    echo '<option value="2"';  if(get_post_meta($post->ID,'kakakujoutai',true)=="2"){  	 echo ' selected="selected"';  }
    echo '">確定</option>';
    echo '<option value="3"';  if(get_post_meta($post->ID,'kakakujoutai',true)=="3"){  	 echo ' selected="selected"';  }
    echo '">入札</option>';
    echo '</select><br />';
    echo '</td>';


    echo '</tr><tr id="kakakutsubo">';


    // 坪単価 単位：円
    echo '<td>';
    echo '<label for="kakakutsubo">坪単価</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakutsubo" value="'.get_post_meta($post->ID,'kakakutsubo',true).'" size="15" /> 円 (半角数値)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakukyouekihi">';


    // 共益費・管理費 単位：円
    echo '<td>';
    echo '<label for="kakakukyouekihi">共益費・管理費</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakukyouekihi" value="'.get_post_meta($post->ID,'kakakukyouekihi',true).'" size="15" /> 円 (半角数値)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakureikin">';


    // 礼金・月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月"
    echo '<td>';
    echo '<label for="kakakureikin">礼金・月数</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakureikin" value="'.get_post_meta($post->ID,'kakakureikin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakushikikin">';


    // 敷金・月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月"
    echo '<td>';
    echo '<label for="kakakushikikin">敷金・月数</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakushikikin" value="'.get_post_meta($post->ID,'kakakushikikin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakuhoshoukin">';


    // 保証金・月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月"
    echo '<td>';
    echo '<label for="kakakuhoshoukin">保証金・月数</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakuhoshoukin" value="'.get_post_meta($post->ID,'kakakuhoshoukin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakukenrikin">';

    // 権利金 100以上の場合は単位は"円"、それ以外は"ヶ月"
    echo '<td>';
    echo '<label for="kakakukenrikin">権利金</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakukenrikin" value="'.get_post_meta($post->ID,'kakakukenrikin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakushikibiki">';


    // 償却・敷引金 1～99:"ヶ月"、101～200:100を引いて"%" 201以上の場合単位は"円"
    echo '<td>';
    echo '<label for="kakakushikibiki">償却・敷引金</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakushikibiki" value="'.get_post_meta($post->ID,'kakakushikibiki',true).'" size="10" /> (1～99:ヶ月、101～200:100を引いて % 、201以上の場合単位は円)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakukoushin">';


    // 更新料	月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月"
    echo '<td>';
    echo '<label for="kakakukoushin">更新料</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakukoushin" value="'.get_post_meta($post->ID,'kakakukoushin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakuhyorimawari">';


    // 満室時表面利回り
    echo '<td>';
    echo '<label for="kakakuhyorimawari">満室時表面利回り</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakuhyorimawari" value="'.get_post_meta($post->ID,'kakakuhyorimawari',true).'" size="10" /> %　　';
    echo '</td>';


    echo '</tr><tr id="kakakurimawari">';

    // 現行利回り
    echo '<td>';
    echo '<label for="kakakurimawari">現行利回り</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakurimawari" value="'.get_post_meta($post->ID,'kakakurimawari',true).'" size="10" /> %<br />';
    echo '</td>';


    echo '</tr><tr id="kakakuhoken">';

    // 住宅保険料
    echo '<td>';
    echo '<label for="kakakuhoken">住宅保険料</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakuhoken" value="'.get_post_meta($post->ID,'kakakuhoken',true).'" size="10" /> 円 (半角数値)  (HOMES 9:不要)<br />';
    echo '</td>';


    echo '</tr><tr id="kakakuhokenkikan">';

    // 住宅保険期間
    echo '<td>';
    echo '<label for="kakakuhokenkikan">住宅保険期間</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakuhokenkikan" value="'.get_post_meta($post->ID,'kakakuhokenkikan',true).'" size="10" /> 年<br />';
    echo '</td>';


    echo '</tr><tr id="kakakutsumitate">';


    // 修繕積立金 売買：マンションのみ　単位：円/
    echo '<td>';
    echo '<label for="kakakutsumitate">修繕積立金</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="kakakutsumitate" value="'.get_post_meta($post->ID,'kakakutsumitate',true).'" size="10" /> 円 (売買：マンションのみ) (半角数値)<br />';
    echo '</td>';


    echo '</tr><tr id="shakuchiryo">';

    // 借地料
    echo '<td>';
    echo '<label for="shakuchiryo">借地料</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="shakuchiryo" value="'.get_post_meta($post->ID,'shakuchiryo',true).'" size="10" /> 円　';
    echo '</td>';


    echo '</tr><tr id="shakuchikikan">';

    // 借地契約期間(年)
    // 借地契約期間(月)
    echo '<td>';
    echo '<label for="shakuchikikan">借地契約年月</label> ';
    echo '</td>';

    echo '<td>';
    echo '<input type="text" name="shakuchikikan" value="'.get_post_meta($post->ID,'shakuchikikan',true).'" size="10" /> 年/月<br />';
    echo '</td>';


    echo '</tr><tr id="shakuchikubun">';

    // 契約期間(区分)
    echo '<td>';
    echo '<label for="shakuchikubun">借地契約(区分)</label> ';
    echo '</td>';

    echo '<td>';
    echo '<select name="shakuchikubun">';
    echo '<option value="">区分選択</option>';
    echo '<option value="1"';  if(get_post_meta($post->ID,'shakuchikubun',true)=="1"){  	 echo ' selected="selected"';  }
    echo '">期限</option>';
    echo '<option value="2"';  if(get_post_meta($post->ID,'shakuchikubun',true)=="2"){  	 echo ' selected="selected"';  }
    echo '">期間</option>';
    //text
    if(get_post_meta($post->ID,'shakuchikubun',true) !='' &&  !is_numeric(get_post_meta($post->ID,'shakuchikubun',true)) ){
        echo '<option value="'.get_post_meta($post->ID,'shakuchikubun',true).'" selected="selected">'.get_post_meta($post->ID,'shakuchikubun',true).'</option>';
    }
    echo '</select><br />';
    echo '</td>';



    echo '</tr></table>';
}
function fudo_custom_save_kakaku ( $post_id ) {
    if ( isset($_POST['mycustom_kakaku_name']) ){
        if ( !wp_verify_nonce( $_POST['mycustom_kakaku_name'], plugin_basename(__FILE__) )) {
            return $post_id;
        }
        if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
        } else {
            if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
        }


        // 賃料・価格
        $my_custom_kakaku_data = isset($_POST['kakaku']) ? $_POST['kakaku'] : '';
        $my_custom_kakaku_data = mb_convert_kana($my_custom_kakaku_data,"a","UTF-8" );
        $my_custom_kakaku_data = str_replace(",","",$my_custom_kakaku_data);
        $my_custom_kakaku_data = str_replace("\\","",$my_custom_kakaku_data);
        $my_custom_kakaku_data = str_replace("￥","",$my_custom_kakaku_data);
        if($my_custom_kakaku_data !=get_post_meta($post_id, 'kakaku', true))
            update_post_meta($post_id, 'kakaku',$my_custom_kakaku_data);
        elseif($my_custom_kakaku_data == "")
            update_post_meta($post_id, 'kakaku','');

        // 価格公開
        $my_custom_kakakukoukai_data = isset($_POST['kakakukoukai']) ? $_POST['kakakukoukai'] : '';
        if($my_custom_kakakukoukai_data !=get_post_meta($post_id, 'kakakukoukai', true))
            update_post_meta($post_id, 'kakakukoukai',$my_custom_kakakukoukai_data);
        elseif($my_custom_kakakukoukai_data == "")
            delete_post_meta($post_id, 'kakakukoukai',get_post_meta($post_id,'kakakukoukai',true));

        // 価格状態
        $my_custom_kakakujoutai_data = isset($_POST['kakakujoutai']) ? $_POST['kakakujoutai'] : '';
        if($my_custom_kakakujoutai_data !=get_post_meta($post_id, 'kakakujoutai', true))
            update_post_meta($post_id, 'kakakujoutai',$my_custom_kakakujoutai_data);
        elseif($my_custom_kakakujoutai_data == "")
            delete_post_meta($post_id, 'kakakujoutai',get_post_meta($post_id,'kakakujoutai',true));

        // 税額
        $my_custom_kakakuzei_data = isset($_POST['kakakuzei']) ? $_POST['kakakuzei'] : '';
        $my_custom_kakakuzei_data = mb_convert_kana($my_custom_kakakuzei_data,"a","UTF-8" );
        $my_custom_kakakuzei_data = str_replace(",","",$my_custom_kakakuzei_data);
        $my_custom_kakakuzei_data = str_replace("\\","",$my_custom_kakakuzei_data);
        $my_custom_kakakuzei_data = str_replace("￥","",$my_custom_kakakuzei_data);
        if($my_custom_kakakuzei_data !=get_post_meta($post_id, 'kakakuzei', true))
            update_post_meta($post_id, 'kakakuzei',$my_custom_kakakuzei_data);
        elseif($my_custom_kakakuzei_data == "")
            delete_post_meta($post_id, 'kakakuzei',get_post_meta($post_id,'kakakuzei',true));

        // 坪単価
        $my_custom_kakakutsubo_data = isset($_POST['kakakutsubo']) ? $_POST['kakakutsubo'] : '';
        $my_custom_kakakutsubo_data = mb_convert_kana($my_custom_kakakutsubo_data,"a","UTF-8" );
        $my_custom_kakakutsubo_data = str_replace(",","",$my_custom_kakakutsubo_data);
        $my_custom_kakakutsubo_data = str_replace("\\","",$my_custom_kakakutsubo_data);
        $my_custom_kakakutsubo_data = str_replace("￥","",$my_custom_kakakutsubo_data);
        if($my_custom_kakakutsubo_data !=get_post_meta($post_id, 'kakakutsubo', true))
            update_post_meta($post_id, 'kakakutsubo',$my_custom_kakakutsubo_data);
        elseif($my_custom_kakakutsubo_data == "")
            delete_post_meta($post_id, 'kakakutsubo',get_post_meta($post_id,'kakakutsubo',true));

        // 共益費・管理費
        $my_custom_kakakukyouekihi_data = isset($_POST['kakakukyouekihi']) ? $_POST['kakakukyouekihi'] : '';
        $my_custom_kakakukyouekihi_data = mb_convert_kana($my_custom_kakakukyouekihi_data,"a","UTF-8" );
        $my_custom_kakakukyouekihi_data = str_replace(",","",$my_custom_kakakukyouekihi_data);
        $my_custom_kakakukyouekihi_data = str_replace("\\","",$my_custom_kakakukyouekihi_data);
        $my_custom_kakakukyouekihi_data = str_replace("￥","",$my_custom_kakakukyouekihi_data);
        if($my_custom_kakakukyouekihi_data !=get_post_meta($post_id, 'kakakukyouekihi', true))
            update_post_meta($post_id, 'kakakukyouekihi',$my_custom_kakakukyouekihi_data);
        elseif($my_custom_kakakukyouekihi_data == "")
            delete_post_meta($post_id, 'kakakukyouekihi',get_post_meta($post_id,'kakakukyouekihi',true));

        // 礼金
        $my_custom_kakakureikin_data = isset($_POST['kakakureikin']) ? $_POST['kakakureikin'] : '';
        $my_custom_kakakureikin_data = mb_convert_kana($my_custom_kakakureikin_data,"a","UTF-8" );
        $my_custom_kakakureikin_data = str_replace(",","",$my_custom_kakakureikin_data);
        $my_custom_kakakureikin_data = str_replace("\\","",$my_custom_kakakureikin_data);
        $my_custom_kakakureikin_data = str_replace("￥","",$my_custom_kakakureikin_data);
        if($my_custom_kakakureikin_data !=get_post_meta($post_id, 'kakakureikin', true))
            update_post_meta($post_id, 'kakakureikin',$my_custom_kakakureikin_data);
        elseif($my_custom_kakakureikin_data == "")
            delete_post_meta($post_id, 'kakakureikin',get_post_meta($post_id,'kakakureikin',true));

        // 敷金
        $my_custom_kakakushikikin_data = isset($_POST['kakakushikikin']) ? $_POST['kakakushikikin'] : '';
        $my_custom_kakakushikikin_data = mb_convert_kana($my_custom_kakakushikikin_data,"a","UTF-8" );
        $my_custom_kakakushikikin_data = str_replace(",","",$my_custom_kakakushikikin_data);
        $my_custom_kakakushikikin_data = str_replace("\\","",$my_custom_kakakushikikin_data);
        $my_custom_kakakushikikin_data = str_replace("￥","",$my_custom_kakakushikikin_data);
        if($my_custom_kakakushikikin_data !=get_post_meta($post_id, 'kakakushikikin', true))
            update_post_meta($post_id, 'kakakushikikin',$my_custom_kakakushikikin_data);
        elseif($my_custom_kakakushikikin_data == "")
            delete_post_meta($post_id, 'kakakushikikin',get_post_meta($post_id,'kakakushikikin',true));

        // 保証金
        $my_custom_kakakuhoshoukin_data = isset($_POST['kakakuhoshoukin']) ? $_POST['kakakuhoshoukin'] : '';
        $my_custom_kakakuhoshoukin_data = mb_convert_kana($my_custom_kakakuhoshoukin_data,"a","UTF-8" );
        $my_custom_kakakuhoshoukin_data = str_replace(",","",$my_custom_kakakuhoshoukin_data);
        $my_custom_kakakuhoshoukin_data = str_replace("\\","",$my_custom_kakakuhoshoukin_data);
        $my_custom_kakakuhoshoukin_data = str_replace("￥","",$my_custom_kakakuhoshoukin_data);
        if($my_custom_kakakuhoshoukin_data !=get_post_meta($post_id, 'kakakuhoshoukin', true))
            update_post_meta($post_id, 'kakakuhoshoukin',$my_custom_kakakuhoshoukin_data);
        elseif($my_custom_kakakuhoshoukin_data == "")
            delete_post_meta($post_id, 'kakakuhoshoukin',get_post_meta($post_id,'kakakuhoshoukin',true));

        // 権利金
        $my_custom_kakakukenrikin_data = isset($_POST['kakakukenrikin']) ? $_POST['kakakukenrikin'] : '';
        $my_custom_kakakukenrikin_data = mb_convert_kana($my_custom_kakakukenrikin_data,"a","UTF-8" );
        $my_custom_kakakukenrikin_data = str_replace(",","",$my_custom_kakakukenrikin_data);
        $my_custom_kakakukenrikin_data = str_replace("\\","",$my_custom_kakakukenrikin_data);
        $my_custom_kakakukenrikin_data = str_replace("￥","",$my_custom_kakakukenrikin_data);
        if($my_custom_kakakukenrikin_data !=get_post_meta($post_id, 'kakakukenrikin', true))
            update_post_meta($post_id, 'kakakukenrikin',$my_custom_kakakukenrikin_data);
        elseif($my_custom_kakakukenrikin_data == "")
            delete_post_meta($post_id, 'kakakukenrikin',get_post_meta($post_id,'kakakukenrikin',true));


        // 償却・敷引金
        $my_custom_kakakushikibiki_data = isset($_POST['kakakushikibiki']) ? $_POST['kakakushikibiki'] : '';
        $my_custom_kakakushikibiki_data = mb_convert_kana($my_custom_kakakushikibiki_data,"a","UTF-8" );
        $my_custom_kakakushikibiki_data = str_replace(",","",$my_custom_kakakushikibiki_data);
        $my_custom_kakakushikibiki_data = str_replace("\\","",$my_custom_kakakushikibiki_data);
        $my_custom_kakakushikibiki_data = str_replace("￥","",$my_custom_kakakushikibiki_data);
        if($my_custom_kakakushikibiki_data !=get_post_meta($post_id, 'kakakushikibiki', true))
            update_post_meta($post_id, 'kakakushikibiki',$my_custom_kakakushikibiki_data);
        elseif($my_custom_kakakushikibiki_data == "")
            delete_post_meta($post_id, 'kakakushikibiki',get_post_meta($post_id,'kakakushikibiki',true));


        // 更新料
        $my_custom_kakakukoushin_data = isset($_POST['kakakukoushin']) ? $_POST['kakakukoushin'] : '';
        $my_custom_kakakukoushin_data = mb_convert_kana($my_custom_kakakukoushin_data,"a","UTF-8" );
        $my_custom_kakakukoushin_data = str_replace(",","",$my_custom_kakakukoushin_data);
        $my_custom_kakakukoushin_data = str_replace("\\","",$my_custom_kakakukoushin_data);
        $my_custom_kakakukoushin_data = str_replace("￥","",$my_custom_kakakukoushin_data);
        if($my_custom_kakakukoushin_data !=get_post_meta($post_id, 'kakakukoushin', true))
            update_post_meta($post_id, 'kakakukoushin',$my_custom_kakakukoushin_data);
        elseif($my_custom_kakakukoushin_data == "")
            delete_post_meta($post_id, 'kakakukoushin',get_post_meta($post_id,'kakakukoushin',true));


        // 満室時表面利回り
        $my_custom_kakakuhyorimawari_data =isset($_POST['kakakuhyorimawari']) ? $_POST['kakakuhyorimawari'] : '';
        $my_custom_kakakuhyorimawari_data = mb_convert_kana($my_custom_kakakuhyorimawari_data,"a","UTF-8" );
        if($my_custom_kakakuhyorimawari_data !=get_post_meta($post_id, 'kakakuhyorimawari', true))
            update_post_meta($post_id, 'kakakuhyorimawari',$my_custom_kakakuhyorimawari_data);
        elseif($my_custom_kakakuhyorimawari_data == "")
            delete_post_meta($post_id, 'kakakuhyorimawari',get_post_meta($post_id,'kakakuhyorimawari',true));

        // 現行利回り
        $my_custom_kakakurimawari_data = isset($_POST['kakakurimawari']) ? $_POST['kakakurimawari'] : '';
        $my_custom_kakakurimawari_data = mb_convert_kana($my_custom_kakakurimawari_data,"a","UTF-8" );
        if($my_custom_kakakurimawari_data !=get_post_meta($post_id, 'kakakurimawari', true))
            update_post_meta($post_id, 'kakakurimawari',$my_custom_kakakurimawari_data);
        elseif($my_custom_kakakurimawari_data == "")
            delete_post_meta($post_id, 'kakakurimawari',get_post_meta($post_id,'kakakurimawari',true));

        // 住宅保険料
        $my_custom_kakakuhoken_data = isset($_POST['kakakuhoken']) ? $_POST['kakakuhoken'] : '';
        $my_custom_kakakuhoken_data = mb_convert_kana($my_custom_kakakuhoken_data,"a","UTF-8" );
        $my_custom_kakakuhoken_data = str_replace(",","",$my_custom_kakakuhoken_data);
        $my_custom_kakakuhoken_data = str_replace("\\","",$my_custom_kakakuhoken_data);
        $my_custom_kakakuhoken_data = str_replace("￥","",$my_custom_kakakuhoken_data);
        if($my_custom_kakakuhoken_data !=get_post_meta($post_id, 'kakakuhoken', true))
            update_post_meta($post_id, 'kakakuhoken',$my_custom_kakakuhoken_data);
        elseif($my_custom_kakakuhoken_data == "")
            delete_post_meta($post_id, 'kakakuhoken',get_post_meta($post_id,'kakakuhoken',true));

        // 住宅保険期間
        $my_custom_kakakuhokenkikan_data = isset($_POST['kakakuhokenkikan']) ? $_POST['kakakuhokenkikan'] : '';
        if($my_custom_kakakuhokenkikan_data !=get_post_meta($post_id, 'kakakuhokenkikan', true))
            update_post_meta($post_id, 'kakakuhokenkikan',$my_custom_kakakuhokenkikan_data);
        elseif($my_custom_kakakuhokenkikan_data == "")
            delete_post_meta($post_id, 'kakakuhokenkikan',get_post_meta($post_id,'kakakuhokenkikan',true));

        // 借地料
        $my_custom_shakuchiryo_data = isset($_POST['shakuchiryo']) ? $_POST['shakuchiryo'] : '';
        $my_custom_shakuchiryo_data = mb_convert_kana($my_custom_shakuchiryo_data,"a","UTF-8" );
        $my_custom_shakuchiryo_data = str_replace(",","",$my_custom_shakuchiryo_data);
        $my_custom_shakuchiryo_data = str_replace("\\","",$my_custom_shakuchiryo_data);
        $my_custom_shakuchiryo_data = str_replace("￥","",$my_custom_shakuchiryo_data);
        if($my_custom_shakuchiryo_data !=get_post_meta($post_id, 'shakuchiryo', true))
            update_post_meta($post_id, 'shakuchiryo',$my_custom_shakuchiryo_data);
        elseif($my_custom_shakuchiryo_data == "")
            delete_post_meta($post_id, 'shakuchiryo',get_post_meta($post_id,'shakuchiryo',true));

        // 契約期間(年)
        // 契約期間(月)
        $my_custom_shakuchikikan_data = isset($_POST['shakuchikikan']) ? $_POST['shakuchikikan'] : '';
        if( strcmp($my_custom_shakuchikikan_data,get_post_meta($post_id, 'shakuchikikan', true)) != 0 )
            update_post_meta($post_id, 'shakuchikikan',$my_custom_shakuchikikan_data);
        elseif($my_custom_shakuchikikan_data == "")
            delete_post_meta($post_id, 'shakuchikikan',get_post_meta($post_id,'shakuchikikan',true));

        // 契約期間(区分)
        $my_custom_shakuchikubun_data = isset($_POST['shakuchikubun']) ? $_POST['shakuchikubun'] : '';
        if($my_custom_shakuchikubun_data !=get_post_meta($post_id, 'shakuchikubun', true))
            update_post_meta($post_id, 'shakuchikubun',$my_custom_shakuchikubun_data);
        elseif($my_custom_shakuchikubun_data == "")
            delete_post_meta($post_id, 'shakuchikubun',get_post_meta($post_id,'shakuchikubun',true));

        // 修繕積立金
        $my_custom_kakakutsumitate_data = isset($_POST['kakakutsumitate']) ? $_POST['kakakutsumitate'] : '';
        $my_custom_kakakutsumitate_data = mb_convert_kana($my_custom_kakakutsumitate_data,"a","UTF-8" );
        $my_custom_kakakutsumitate_data = str_replace(",","",$my_custom_kakakutsumitate_data);
        $my_custom_kakakutsumitate_data = str_replace("\\","",$my_custom_kakakutsumitate_data);
        $my_custom_kakakutsumitate_data = str_replace("￥","",$my_custom_kakakutsumitate_data);
        if($my_custom_kakakutsumitate_data !=get_post_meta($post_id, 'kakakutsumitate', true))
            update_post_meta($post_id, 'kakakutsumitate',$my_custom_kakakutsumitate_data);
        elseif($my_custom_kakakutsumitate_data == "")
            delete_post_meta($post_id, 'kakakutsumitate',get_post_meta($post_id,'kakakutsumitate',true));
    }else{
        return $post_id;
    }
}
add_action('admin_menu', 'fudo_custom_kinsenmen');
add_action('save_post', 'fudo_custom_save_kakaku');


// 物件カテゴリごとの投稿ページ表示する
function add_custom_fudo_edit_menu() {

    // 売買
    add_submenu_page( 'edit.php?post_type=fudo', '売買物件一覧', '売買物件一覧', 'publish_posts', 'edit.php?post_type=fudo&bukken=baibai' );
    // 賃貸
    add_submenu_page( 'edit.php?post_type=fudo', '賃貸物件一覧', '賃貸物件一覧', 'publish_posts', 'edit.php?post_type=fudo&bukken=chintai' );
	// 事務所
    add_submenu_page( 'edit.php?post_type=fudo', '事務所物件一覧', '事務所物件一覧', 'publish_posts', 'edit.php?s=事務所&post_status=all&post_type=fudo&action=-1&m=0&shubetsu=1&paged=1&action2=-1' );
}
add_action( 'admin_menu', 'add_custom_fudo_edit_menu' );

// 投稿画面で表示をカスタマイズするJavaScriptのコードを挿入する
function fudo_post_custom_script($hook) {
    if (in_array($hook, array("post.php", "post-new.php"))) {
        global $post;
        if ('fudo' === $post->post_type) {
            wp_enqueue_script("fudo_admin_cusomize", get_bloginfo('template_url').'/js/fudo_field_customize.js', ['jquery']);
        }
    }
}

add_action('admin_enqueue_scripts', 'fudo_post_custom_script');