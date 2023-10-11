<?php
/**
 * finalassignment functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package finalassignment
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function finalassignment_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on finalassignment, use a find and replace
		* to change 'finalassignment' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'finalassignment', get_template_directory() . '/languages' );

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
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'finalassignment' ),
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
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'finalassignment_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	// add_theme_support(
	// 	'custom-logo',
	// 	array(
	// 		'height'      => 250,
	// 		'width'       => 250,
	// 		'flex-width'  => true,
	// 		'flex-height' => true,
	// 	)
	// );
}
add_action( 'after_setup_theme', 'finalassignment_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function finalassignment_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'finalassignment_content_width', 640 );
}
add_action( 'after_setup_theme', 'finalassignment_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function finalassignment_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'finalassignment' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'finalassignment' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'finalassignment_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function finalassignment_scripts() {
	// wp_style_add_data( 'finalassignment-style', 'rtl', 'replace' );
	
	//animate.css file enqueue
	wp_register_style('animatecss',get_template_directory_uri().'/assets/css/animate.css',array(),'3.7.0','all');
	// footawosme
	wp_register_style('bootstrapcss',get_template_directory_uri().'/assets/css/bootstrap.min.css',array(),'5.0.0','all');
	
	//fontawesome css file calling
	wp_register_style('fontawesome',get_template_directory_uri().'/assets/css/fontawesome.all.min.css',array(),'5.15.1','all');

	//magnific popup css file calling
	wp_register_style('magnific-popup',get_template_directory_uri().'/assets/css/magnific-popup.css',array(),'1.0.0','all');

	//normalize css file calling here
	wp_register_style('normalizecss',get_template_directory_uri().'/assets/css/normalize.css',array(),'7.0.0','all');

	//owlcarosoul css file calling here
	wp_register_style('owlcarosoul-min',get_template_directory_uri().'/assets/css/owl.carousel.min.css',array(),'2.3.4','all');

	//owlcarosoul theme css file calling here
	wp_register_style('owlcarosoul-theme',get_template_directory_uri().'/assets/css/owl.theme.default.min.css',array(),'2.3.4','all');

	// responsive css file enqueue register
	wp_register_style('responsivecss',get_template_directory_uri().'/assets/css/responsive.css',array(),'1.0.0','all');
	
	//animate enqueue style file call here
	wp_enqueue_style('animatecss');
	//fontawsome enqueue style file call here
	wp_enqueue_style('fontawesome');
	//magnific popup enqueue style file call here
	wp_enqueue_style('magnific-popup');
	//normalize enqueue style file call here
	wp_enqueue_style('normalizecss');
	//owlcarosoul enqueue style file call here
	wp_enqueue_style('owlcarosoul-min');
	//owlcarosoul theme enqueue style file call here
	wp_enqueue_style('owlcarosoul-theme');
	// bootstrap file calling
	wp_enqueue_style('bootstrapcss');
	// bootstrap file calling
	wp_enqueue_style('responsivecss');
	//default style css file
	wp_enqueue_style( 'finalassignment-style', get_stylesheet_uri(), array(), _S_VERSION );


	// wp_enqueue_script( 'finalassignment-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	//calling jquery file
	wp_enqueue_script('jquery');

	//bootstrap js file calling
	wp_enqueue_script('bootstrapjs',get_template_directory_uri() . '/assets/js/bootstrap.min.js',array(),'5.0.0',true);
	//counterup js file calling
	wp_enqueue_script('counterupjs',get_template_directory_uri() . '/assets/js/jquery.counterup.min.js',array(),_S_VERSION,true);
	//maginifier js file calling
	wp_enqueue_script('meginifierjs',get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js',array(),'1.1.0',true);
	//waypointjs js file calling
	wp_enqueue_script('waypointjs',get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js',array(),'4.0.0',true);
	//waypointjs js file calling
	wp_enqueue_script('mixtupjs',get_template_directory_uri() . '/assets/js/mixitup.min.js',array(),'3.3.1',true);
	//mobilemenu js file calling
	wp_enqueue_script('mobilemenujs',get_template_directory_uri() . '/assets/js/mobile-menu.js',array(),_S_VERSION,true);
	//modernizer js file calling
	wp_enqueue_script('mordernizer',get_template_directory_uri() . '/assets/js/modernizr.min.js',array(),_S_VERSION,true);
	// owlcarusoul js file calling
	wp_enqueue_script('owlcarusouljs',get_template_directory_uri() . '/assets/js/owl.carousel.min.js',array(),'2.3.4',true);
	// poppermin js file calling
	wp_enqueue_script('popperjs',get_template_directory_uri() . '/assets/js/popper.min.js',array(),'2.5.4',true);
	// script js file calling
	wp_enqueue_script('popperjs',get_template_directory_uri() . '/assets/js/popper.min.js',array(),_S_VERSION,true);
	// wow js file calling
	wp_enqueue_script('wowjs',get_template_directory_uri() . '/assets/js/wow.min.js',array(),_S_VERSION,true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'finalassignment_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

