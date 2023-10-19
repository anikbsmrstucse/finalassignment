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
			'before_widget' => '<section id="%1$s" class="sidebar-widgets">',
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


// pagination or page navigation
function anik_page_nav()
{
	global $wp_query, $wp_rewrite;
	$pages = '';
	$max = $wp_query->max_num_pages;
	if (!$current = get_query_var('paged')) $current = 1;
	$args['base'] = str_replace(90, '%#%', get_pagenum_link(90)); //get_pagenum_link and replace value must be same otherwise function data cannot be fount.
	// $args['base'] = $wp_rewrite->pagination_base . '/%#%';
	$args['current'] = $current;
	$total = 1;
	$args['prev_text'] = '<i class="fa fa-angle-left"></i>';
	$args['next_text'] = '<i class="fa fa-angle-right"></i>';
	if ($max > 1) echo '</pre>
    <div class="blog-pagination text-center">';
	// if($total == 1 && $max > 1) $pages = '<p class="pages"> Page ' . $current .'<span> of </span>' . $max .'</p>';
	echo $pages . paginate_links($args);
	if ($max > 1) echo '</div><pre>';
}

// custom field function creation
function custom_field_creation($fields)
{
	$comments = wp_get_current_commenter();
	$req = get_option('require_name_email');

	$fields['author'] = '<p class="comment-form-author">'  .
		'<input id="author" class="blog-form-input" placeholder="Your Name* " name="author" type="text" value="' . esc_attr($comments['comment_author']) .
		'" size="30"/></p>';
	$fields['email'] =
		'<p class="comment-form-email">' .
		'<input id="email" class="blog-form-input" placeholder="Your Email* " name="email" type="text" value="' . esc_attr($comments['comment_author_email']) .
		'" size="30" "required" /></p>';

	return $fields;
}

add_filter('comment_form_default_fields', 'custom_field_creation');

// add extra field functionality
add_filter('comment_form_defaults', 'change_comment_form_defaults');

function change_comment_form_defaults($default)
{
	$commenter = wp_get_current_commenter();
	$default['fields']['email'] .= '<p class="comment-form-author">
        <input id="subject" placeholder="Subject" name="subject" size="30" type="text" /></p>';
	return $default;
}

// storing the data value from new feild
add_action('comment_post', 'save_comment_meta_data');

function save_comment_meta_data($comment_id)
{
	add_comment_meta($comment_id, 'subject', $_POST['subject']);
}

// retrive comment in comment meta data 
add_filter('get_comment_author_link', 'attach_city_to_author');

function attach_city_to_author($author)
{
	$subject = get_comment_meta(get_comment_ID(), 'subject', true);
	if ($subject)
		$author .= " ($subject)";
	return $author;
}



// comments rearrange feilds
function comment_rearrange($fields)
{

	$finaltheme_comment = $fields['comment'];
	$finaltheme_author = $fields['author'];
	$finaltheme_email = $fields['email'];

	unset($fields['comment']);
	unset($fields['author']);
	unset($fields['email']);
	unset($fields['url']);
	unset($fields['cookies']);

	$fields['author'] = $finaltheme_author;
	$fields['email'] = $finaltheme_email;
	$fields['comment'] = $finaltheme_comment;

	return $fields;
}

add_filter('comment_form_fields', 'comment_rearrange');


// custom post type for recent works

function create_recentwork_posttype_function()
{
	$labels = array(
		'name' => _x('Recent Work', 'post type general name', 'finalassignment'),
		'singular_name' => _x('Recent Work', 'post type Singular name', 'finalassignment'),
		'add_new' => _x('Add Recent Work', '', 'finalassignment'),
		'add_new_item' => __('Add New Recent Work', 'finalassignment'),
		'edit_item' => __('Edit Recent Work', 'finalassignment'),
		'new_item' => __('New Recent Work', 'finalassignment'),
		'all_items' => __('All Recent Work', 'finalassignment'),
		'view_item' => __('View Recent Work', 'finalassignment'),
		'search_items' => __('Search Recent Work', 'finalassignment'),
		'not_found' => __('No Recent Work found', 'finalassignment'),
		'not_found_in_trash' => __('No Recent Work on trash', 'finalassignment'),
		'parent_item_colon' => '',
		'menu_name' => __('Recent Works', 'finalassignment')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'gallery'),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => null,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array('title', 'thumbnail','editor','excerpt'),
	);
	$labels = array(
		'name' => __('Category'),
		'singular_name' => __('Category'),
		'search_items' => __('Search'),
		'popular_items' => __('More Used'),
		'all_items' => __('All Categories'),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __('Add new'),
		'update_item' => __('Update'),
		'add_new_item' => __('Add new Category'),
		'new_item_name' => __('New')
	);
	register_taxonomy(
		'work_category',
		array('recent_work'),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'singular_label' => 'work_category',
			'all_items' => 'Category',
			'query_var' => true,
			'rewrite' => array('slug' => 'cat')
		)
	);
	register_post_type('recent_work', $args);
	flush_rewrite_rules();
}
add_action('init', 'create_recentwork_posttype_function');


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
	// 
	wp_register_style('jqueryuicss', get_template_directory_uri() . '/assets/css/jquery-ui.css', array(), '1.10.4', 'all');



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
	// stylecss
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
	// mainjs
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/script.js', array(), _S_VERSION, true);

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

//breadcrum function calling 
require get_template_directory() . '/inc/mj-wp-breadcrumb.php';

// custom gallery feild crations function file calling
require get_template_directory() . '/inc/custom-gallery.php';
/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
