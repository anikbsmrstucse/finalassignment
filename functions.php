<?php

/**
 * finalassignment functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package finalassignment
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function finalassignment_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on finalassignment, use a find and replace
		* to change 'finalassignment' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('finalassignment', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	function register_my_menus()
	{
		register_nav_menus(
			array(
				'primary' => esc_html__('Primary Menu', 'finalassignment'),
			)
		);
	}

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
	add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'finalassignment_setup');
add_action('after_setup_theme', 'register_my_menus');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function finalassignment_content_width()
{
	$GLOBALS['content_width'] = apply_filters('finalassignment_content_width', 640);
}
add_action('after_setup_theme', 'finalassignment_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


// widgets registration

class Demo_Widgets extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'demo-wigets',
			'Left Side Footer',
		);
	}

	public $args = array(
		'before_title' => '<h1> class="widget-title">',
		'after_title' => '</h1>',
		'before_widget' => '<div class="widget-wrapper">',
		'after_widget' => '</div>'
	);

	public function widget($args, $instance)
	{
		echo $args['before_widget'];

		echo '<h1 class="demo">';
		if (!empty($instance['title'])) {
			echo apply_filters('widget_title', $instance['title']);
		}
		echo '</h1>';

		echo '<div class="textwidget">';
		if (isset($instance['text'])) { // Check if 'text' key exists
			echo esc_html__($instance['text'], 'finalassignment');
		}
		echo '</div>';

		echo $args['after_widget'];
	}

	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$text = !empty($instance['text']) ? $instance['text'] : '';
?>
		<p>
			<label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('Text')); ?>"><?php echo esc_html__('Text:', 'text_domain'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" type="text" cols="30" rows="10"><?php echo esc_attr($text); ?></textarea>
		</p>
	<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance          = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['text']  = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
		return $instance;
	}
}
// news letter custom widgets
class News_Letter extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'newsletter-wigets',
			'Right Side Footer',
		);
	}

	public $args = array(
		'before_title' => '<h1> class="widget-title">',
		'after_title' => '</h1>',
		'before_widget' => '<div class="widget-wrapper">',
		'after_widget' => '</div>'
	);

	public function widget($args, $instance)
	{
		echo $args['before_widget'];
		$default_email = !empty($instance['email']) ? esc_attr($instance['email']) : '';

		echo '<h2>';
		if (!empty($instance['title'])) {
			echo apply_filters('widget_title', $instance['title']);
		}
		echo '</h2>';

		echo '<div class="textwidget">';
		if (isset($instance['text'])) { // Check if 'text' key exists
			echo esc_html__($instance['text'], 'finalassignment');
		}
		echo '</div>';
	?>
		<form action="#">
			<input type="email" name="email" placeholder="Your Email" value="<?php echo $default_email; ?>">
			<button type="submit">Subscribe Now</button>
		</form>
	<?php
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$text = !empty($instance['text']) ? $instance['text'] : '';
		$email = !empty($instance['email']) ? esc_attr($instance['email']) : '';
	?>
		<p>
			<label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('Text')); ?>"><?php echo esc_html__('Text:', 'text_domain'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" type="text" cols="30" rows="10"><?php echo esc_attr($text); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">Default Email:</label>
			<input type="email" class="widefat" name="<?php echo $this->get_field_name('email'); ?>" id="<?php echo $this->get_field_id('email'); ?>" value="<?php echo $email; ?>">
		</p>
<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance          = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['text']  = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
		$instance['email'] = strip_tags($new_instance['email']);
		return $instance;
	}
}

// sidebar regiser and widgets register function
function anik_widget_registration()
{
	register_sidebar(array(
		'name' => esc_html__('Footer', 'finalassignment'),
		'id' => 'footer',
		'description' => esc_html__('Add Widgets Here', 'finalassignment'),
		'before_widget' => '<div class="col-lg-3 col-md-6 mb-30"><div class="footer-single">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'finalassignment'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'finalassignment'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);


	register_widget('Demo_Widgets');
	register_widget('News_Letter');
}



add_action('widgets_init', 'anik_widget_registration');

add_theme_support('widgets');


// // menu breadcums function
// // helper function to find a menu item in an array of items
// function wpd_get_menu_item( $field, $object_id, $items ){
//     foreach( $items as $item ){
//         if( $item->$field == $object_id ) return $item;
//     }
//     return false;
// }

// function wpd_nav_menu_breadcrumbs( $menu ){
//     // get menu items by menu id, slug, name, or object
//     $items = wp_get_nav_menu_items( $menu );
//     if( false === $items ){
//         echo 'Menu not found';
//         return;
//     }
//     // get the menu item for the current page
//     $item = wpd_get_menu_item( 'object_id', get_queried_object_id(), $items );
//     if( false === $item ){
//         return;
//     }
//     // start an array of objects for the crumbs
//     $menu_item_objects = array( $item );
//     // loop over menu items to get the menu item parents
//     while( 0 != $item->menu_item_parent ){
//         $item = wpd_get_menu_item( 'ID', $item->menu_item_parent, $items );
//         array_unshift( $menu_item_objects, $item );
//     }
//     // output crumbs
//     $crumbs = array(); 
//     foreach( $menu_item_objects as $menu_item ){
//         $link = '<a href="%s">%s</a>';
//         $crumbs[] = sprintf( $link, $menu_item->url, $menu_item->title );
//     }
//     echo join( ' > ', $crumbs );
// }


/**
 * Enqueue scripts and styles.
 */
function finalassignment_scripts()
{
	// wp_style_add_data( 'finalassignment-style', 'rtl', 'replace' );

	//animate.css file enqueue
	wp_register_style('animatecss', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.7.0', 'all');
	// footawosme
	wp_register_style('bootstrapcss', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.0', 'all');

	//fontawesome css file calling
	wp_register_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.all.min.css', array(), '5.15.1', 'all');

	//magnific popup css file calling
	wp_register_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0', 'all');

	//normalize css file calling here
	wp_register_style('normalizecss', get_template_directory_uri() . '/assets/css/normalize.css', array(), '7.0.0', 'all');

	//owlcarosoul css file calling here
	wp_register_style('owlcarosoul-min', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.3.4', 'all');

	//owlcarosoul theme css file calling here
	wp_register_style('owlcarosoul-theme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', array(), '2.3.4', 'all');

	// responsive css file enqueue register
	wp_register_style('responsivecss', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0.0', 'all');


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
	// reposive css file calling
	wp_enqueue_style('responsivecss');
	//animate enqueue style file call here
	wp_enqueue_style('animatecss');
	//default style css file
	wp_enqueue_style('finalassignment-style', get_stylesheet_uri(), array(), _S_VERSION);


	// wp_enqueue_script( 'finalassignment-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	//calling jquery file
	wp_enqueue_script('jquery');

	//bootstrap js file calling
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '5.0.0', true);
	//counterup js file calling
	wp_enqueue_script('counterupjs', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array(), _S_VERSION, true);
	//maginifier js file calling
	wp_enqueue_script('meginifierjs', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), '1.1.0', true);
	//waypointjs js file calling
	wp_enqueue_script('waypointjs', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array(), '4.0.0', true);
	//waypointjs js file calling
	wp_enqueue_script('mixtupjs', get_template_directory_uri() . '/assets/js/mixitup.min.js', array(), '3.3.1', true);
	//mobilemenu js file calling
	wp_enqueue_script('mobilemenujs', get_template_directory_uri() . '/assets/js/mobile-menu.js', array(), _S_VERSION, true);
	//modernizer js file calling
	wp_enqueue_script('mordernizer', get_template_directory_uri() . '/assets/js/modernizr.min.js', array(), _S_VERSION, true);
	// owlcarusoul js file calling
	wp_enqueue_script('owlcarusouljs', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2.3.4', true);
	// poppermin js file calling
	wp_enqueue_script('popperjs', get_template_directory_uri() . '/assets/js/popper.min.js', array(), '2.5.4', true);
	// script js file calling
	wp_enqueue_script('popperjs', get_template_directory_uri() . '/assets/js/popper.min.js', array(), _S_VERSION, true);
	// wow js file calling
	wp_enqueue_script('wowjs', get_template_directory_uri() . '/assets/js/wow.min.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'finalassignment_scripts');

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
require get_template_directory() . '/inc/mj-wp-breadcrumb.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
