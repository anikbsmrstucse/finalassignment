<?php

/**
 * finalassignment Theme Customizer
 *
 * @package finalassignment
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function finalassignment_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'finalassignment_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'finalassignment_customize_partial_blogdescription',
			)
		);
	}
}
add_action('customize_register', 'finalassignment_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function finalassignment_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function finalassignment_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function finalassignment_customize_preview_js()
{
	wp_enqueue_script('finalassignment-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'finalassignment_customize_preview_js');

// custom customizer for this theme
function anik_finalassignment_customizer_register($wp_customize)
{

	/**Top Header Area customizer**/
	$wp_customize->add_section('top_header_area', array(
		'title' => esc_html__('Top Header Area', 'finalassignment'),
		'description' => esc_html__('If you change anything of top header area,you can it from here', 'finalassignment'),
	));
	$wp_customize->add_setting('header_phone', array(
		'default' => '(+56) 565 5656',
	));
	$wp_customize->add_control('header_phone', array(
		'label' => esc_html__('Phone Number', 'finalassignment'),
		'description' => esc_html__('If you change you phone number,you can just write your phone number', 'finalassignment'),
		'section' => 'top_header_area',
		'setting' => 'header_email'
	));
	// for header email customizer
	$wp_customize->add_setting('header_email', array(
		'default' => 'enfo@mail.com',
	));
	$wp_customize->add_control('header_email', array(
		'label' => esc_html__('Email', 'finalassignment'),
		'description' => esc_html__('If you change you email,you can just write your email', 'finalassignment'),
		'section' => 'top_header_area',
		'setting' => 'header_email'
	));

	// for header social facebook link customizer
	$wp_customize->add_setting('header_social_facebook', array(
		'default' => '',
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('header_social_facebook', array(
		'type' => 'url',
		'label' => esc_html__('Facebook Link', 'finalassignment'),
		'section' => 'top_header_area',
		'setting' => 'header_social_facebook',
		'input_attrs' => array(
			'placeholder' => 'https://www.facebook.com/your-profile',
		),
	));
	// for header social twitter link customizer
	$wp_customize->add_setting('header_social_twitter', array(
		'default' => '',
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('header_social_twitter', array(
		'type' => 'url',
		'label' => esc_html__('Twitter Link', 'finalassignment'),
		'section' => 'top_header_area',
		'setting' => 'header_social_twitter',
		'input_attrs' => array(
			'placeholder' => 'https://www.twitter.com/your-profile',
		),
	));

	// Instagram link control
	$wp_customize->add_setting('header_social_instagram', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control('header_social_instagram', array(
		'type'        => 'url',
		'label'       => esc_html__('Instagram Link', 'finalassignment'),
		'section'     => 'top_header_area',
		'settings'    => 'header_social_instagram',
		'input_attrs' => array(
			'placeholder' => 'https://www.instagram.com/your-profile',
		),
	));

	// LinkedIn link control
	$wp_customize->add_setting('header_social_linkedin', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control('header_social_linkedin', array(
		'type'        => 'url',
		'label'       => esc_html__('LinkedIn Link', 'finalassignment'),
		'section'     => 'top_header_area',
		'settings'    => 'header_social_linkedin',
		'input_attrs' => array(
			'placeholder' => 'https://www.linkedin.com/in/your-profile',
		),
	));

	// Vimeo link control
	$wp_customize->add_setting('header_social_vimeo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control('header_social_vimeo', array(
		'type'        => 'url',
		'label'       => esc_html__('Vimeo Link', 'finalassignment'),
		'section'     => 'top_header_area',
		'settings'    => 'header_social_vimeo',
		'input_attrs' => array(
			'placeholder' => 'https://vimeo.com/your-profile',
		),
	));

	// header logo area
	$wp_customize->add_section('bottom_header_area', array(
		'title' => esc_html__('Bottom Header Area', 'finalassignment'),
	));
	$wp_customize->add_setting('header_logo', array(
		'default' => '',

	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
		'label' => esc_html__('Upload Logo','finalassignment'),
		'section' => 'bottom_header_area',
		'control' => 'header_logo',
	)));
	//bottom header text
	$wp_customize->add_setting('header_button_text', array(
		'default' => esc_html__('Quote Now','finalassignment'),
		'transport' => 'postMessage',

	));
	$wp_customize->add_control('header_button_text', array(
		'label' => esc_html__('Header Button Text','finalassignment'),
		'section' => 'bottom_header_area',
		'control' => 'header_button_text',
	));

}

add_action('customize_register', 'anik_finalassignment_customizer_register');
