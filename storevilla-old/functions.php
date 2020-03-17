<?php
/**
 * Store Villa functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Store_Villa
 */

if ( ! function_exists( 'storevilla_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function storevilla_pro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Store Villa, use a find and replace
	 * to change 'storevilla-pro' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'storevilla-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('storevilla-cat-image', 275, 370, true);
	add_image_size('storevilla-blog-grid', 255, 160, true);
	add_image_size('storevilla-blog-image', 1170, 470, true);
	add_image_size('storevilla-team', 275, 265, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'topmenu' => esc_html__( 'Top Menu', 'storevilla-pro' ),
		'primary' => esc_html__( 'Primary Menu', 'storevilla-pro' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'storevilla_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * Enable support for custom logo.
	 */
	add_image_size( 'storevilla-logo', 350, 175 );
	add_theme_support( 'custom-logo', array( 'size' => 'storevilla-logo' ) );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif;
add_action( 'after_setup_theme', 'storevilla_pro_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function storevilla_pro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'storevilla_pro_content_width', 640 );
}
add_action( 'after_setup_theme', 'storevilla_pro_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function storevilla_pro_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar Widget Area', 'storevilla-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar Widget Area', 'storevilla-pro' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Top Right Header Widget Area', 'storevilla-pro' ),
		'id'            => 'header-1',
		'description'   => esc_html__( 'Add languages currency widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'SV : Top HomePage Widget Area', 'storevilla-pro' ),
		'id'            => 'topwidgetarea',
		'description'   => esc_html__( 'Add widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar( array(
		'name'          => esc_html__( 'SV : Main HomePage Widget Area', 'storevilla-pro' ),
		'id'            => 'mainwidgetarea',
		'description'   => esc_html__( 'Add widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'SV : Sidebar HomePage Widget', 'storevilla-pro' ),
		'id'            => 'sidebarwidgetarea',
		'description'   => esc_html__( 'Add widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'SV : Buttom HomePage Widget Area', 'storevilla-pro' ),
		'id'            => 'buttomwidgetarea',
		'description'   => esc_html__( 'Add widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	$footer_widget_regions = apply_filters( 'storevilla_footer_widget_regions', 5 );
	
	for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
		
		register_sidebar( array(
			'name' 				=> sprintf( __( 'Footer Widget Area %d', 'storevilla-pro' ), $i ),
			'id' 				=> sprintf( 'footer-%d', $i ),
			'description' 		=> sprintf( __( ' Add Widgetized Footer Region %d.', 'storevilla-pro' ), $i ),
			'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</aside>',
			'before_title' 		=> '<h3 class="widget-title">',
			'after_title' 		=> '</h3>',
		));
	}
	

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Quick Information Area', 'storevilla-pro' ),
		'id'            => 'quick-info',
		'description'   => esc_html__( 'Add quick contact information widgets here.', 'storevilla-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'storevilla_pro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function storevilla_pro_scripts() {

	/*----------------- Google Fonts --------------------------------------*/
	$storevilla_font_args = array(
        'family' => 'Open+Sans:400,300,400,600,600,700|Lato:400,300,300,400,700',
    );
    wp_enqueue_style('google-fonts', add_query_arg( $storevilla_font_args, "//fonts.googleapis.com/css" ) );

	/*------------------- CSS Style ---------------------------------*/
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/fontawesome/css/font-awesome.css');
	
	wp_enqueue_style( 'lightslider', get_template_directory_uri() . '/css/lightslider.css');

	wp_enqueue_style( 'mCustomScrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css');

	wp_enqueue_style( 'storevilla-style', get_stylesheet_uri() );

	wp_enqueue_style( 'storevilla-responsive', get_template_directory_uri() . '/css/responsive.css');
	
	$storevilla_theme = wp_get_theme();
    $theme_version = $storevilla_theme->get( 'Version' );
	
	/*------------------- JavaScript ---------------------------------------*/
	
	wp_enqueue_script( 'lightslider', get_template_directory_uri() . '/js/lightslider.js', array(), esc_attr( $theme_version ), true );

	wp_enqueue_script( 'storevilla-pro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), esc_attr( $theme_version ), true );

	wp_enqueue_script( 'storevilla-pro-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), esc_attr( $theme_version ), true );
	
	wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), esc_attr( $theme_version ), true );

	wp_enqueue_script( 'countdown-time', get_template_directory_uri() . '/js/jquery.countdown.js',array(), esc_attr( $theme_version ), true);

	wp_enqueue_script( 'jquery-mCustomScrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.js',array(), esc_attr( $theme_version ), true);

	wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js',array('jquery'), esc_attr( $theme_version ), true);

	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js',array(), esc_attr( $theme_version ), true);

	wp_enqueue_script( 'storevilla-pro-common', get_template_directory_uri() . '/js/common.js', array('jquery'), esc_attr( $theme_version ), true );
	
	wp_localize_script( 'storevilla-pro-common', 'storevilla_pro_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php') ) );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'storevilla_pro_scripts' );

/**
 * Load Require init file.
*/
require $storevilla_por_file_directory_init_file_path = trailingslashit( get_template_directory() ).'inc/init.php';