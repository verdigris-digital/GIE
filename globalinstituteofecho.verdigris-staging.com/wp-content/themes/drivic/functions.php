<?php 
/**
 * drivic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Drivic
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
*/

if(!function_exists( "drivic_setup" )){
	function drivic_setup(){

		// laod theme text domain
		load_theme_textdomain( 'drivic', get_template_directory() . '/languages' );

		// theme support 
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add image size
		add_image_size( 'drivic-blog-thumbnail', 450, 472, true );
		add_image_size( 'drivic-blog-thumbnail-2', 350, 255, true );
		add_image_size( 'drivic-blog-thumbnail-3', 460, 450, true );
		add_image_size( 'drivic-testimonial-grid-thumbnail', 60, 60, true );
		add_image_size( 'drivic-testimonial-slider-thumbnail', 90, 90, true );
		add_image_size( 'drivic-course-grid-thumbnail', 450, 210, true );
		add_image_size( 'drivic-course-list-thumbnail', 330, 236, true );
		add_image_size( 'drivic-widget-recent-post-thumb', 100, 100, true );
		add_image_size( 'drivic-instructor-thumbnail', 330, 255, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 750;

		register_nav_menus( array( 
        	'main_menu'			=> esc_html__( 'Main Menu', 'drivic' ),
		) );

		// This theme styles the visual editor to resemble the theme style
		add_editor_style( 'css/custom-editor-style.css' );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );

		/** custom log **/
	    add_theme_support( 'custom-logo', array(
	        'width'       => 110,
			'height'      => 35,
			'flex-width'  => true,
	    ) );

	}
}
add_action('after_setup_theme', 'drivic_setup');


if(!function_exists("drivic_scripts")){
	function drivic_scripts(){

		//All style here
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), false, 'all' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all' );
		wp_enqueue_style( 'magnific', get_template_directory_uri() . '/assets/css/magnific.min.css', array(), false, 'all' );
		wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/assets/css/nice-select.min.css', array(), false, 'all' );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.min.css', array(), false, 'all' );
		wp_enqueue_style( 'line-awesome', get_template_directory_uri() . '/assets/css/line-awesome.min.css', array(), false, 'all' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), false, 'all' );
		wp_enqueue_style( 'drivic-main', get_template_directory_uri() . '/assets/css/main.css', array(), false, 'all' );
		wp_enqueue_style( 'drivic-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), false, 'all' );
		wp_enqueue_style( 'drivic-style', get_stylesheet_uri(), array(), false, 'all' );

		//All script here
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), false, 'all');
		wp_enqueue_script('counter', get_template_directory_uri() . '/assets/js/counter.js', array(), false, 'all');
		wp_enqueue_script('owl-slider', get_template_directory_uri() . '/assets/js/owl.min.js', array(), false, 'all');
		wp_enqueue_script('mignific', get_template_directory_uri() . '/assets/js/mignific.min.js', array(), false, 'all');
		wp_enqueue_script('nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array(), false, 'all');
		wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array(), false, 'all');
		wp_enqueue_script('drivic-custom', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), false, 'all');

		// comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'drivic_scripts');


/*------------------------------------------------ 
	drivic web fonts
-------------------------------------------------*/
if(!function_exists('drivic_web_fonts_url')) {
	function drivic_web_fonts_url($font) {
		$font_url = '';

		if ( 'off' !== _x( 'on', 'Google font: on or off', 'drivic' ) ) {
			$font_url = add_query_arg( 'family', urlencode($font), "//fonts.googleapis.com/css" );
		}
		return $font_url;
	}
}	
if(!function_exists('drivic_font_scripts')) {
	function drivic_font_scripts() {
		wp_enqueue_style( 'drivic-web-font', drivic_web_fonts_url('Work Sans:400,400i,500,600,700'), array());
	}
}
add_action( 'wp_enqueue_scripts', 'drivic_font_scripts' );


/*------------------------------------------------ 
	drivic post class
-------------------------------------------------*/
if(!function_exists('drivic_post_class')){
	function drivic_post_class($classes){
		if(is_single()){
			$classes[] = 'blog-details-page-content';
		} else {
			$classes[] = 'single-blog-inner';
		}
		return $classes;
	}
}
add_filter( 'post_class', 'drivic_post_class' );


/*------------------------------------------------ 
	drivic widget refister
-------------------------------------------------*/
if(!function_exists('drivic_widget')){
	function drivic_widget(){

	  	/****** Main Sidebar ******/
		register_sidebar( array(
			'name'          => esc_html__( 'Blog Sidebar', 'drivic' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar', 'drivic' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );

		/****** Course Sidebar ******/
		register_sidebar( array(
			'name'          => esc_html__( 'Course Sidebar', 'drivic' ),
			'id'            => 'course-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar', 'drivic' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );

		/****** Footer Sidebar ******/
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets', 'drivic' ),
			'id'            => 'footer-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your footer', 'drivic' ),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-sm-6"><div class="footer-widget widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
	}
}
add_action( 'widgets_init', 'drivic_widget' );

/*------------------------------------------------ 
	Require file
-------------------------------------------------*/
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/drivic_functions.php';
require_once get_template_directory() . '/inc/drivic_option.php';