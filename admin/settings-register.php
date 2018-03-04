<?php
/**
 * Ann Click - Settings Register
 */

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

// register plugin settings
function ann_click_register_settings() {
	register_setting( 
		'ann_click_options', // option group
		'ann_click_options', // option name
		'ann_click_callback_validate_options' // callback validation
    );
	
	/**
	 * Create sections for different areas of admnistration
	 */
	add_settings_section( 
		'ann_click_section_types', // id
		esc_html__('Ann Click', 'ann-click'), // title
		'ann_click_callback_section_type', // callback
		'ann-click' // menu slug from add_menu_page
	);




	// add_settings_section( 
	// 	'ann_click_section_types', // id
	// 	esc_html__('Enable Types', 'ann-click'), // title
	// 	'ann_click_callback_section_type', // callback
	// 	'ann-click' // menu slug from add_menu_page
	// );

	// add_settings_field(
	// 	'type_phone', // id
	// 	esc_html__('Phone Number', 'ann-click'), // title
	// 	'ann_click_callback_field_checkbox', // callback
	// 	'ann-click', // menu slug from add_menu_page
	// 	'ann_click_section_types', // section id from add_settings_section()
	// 	[ 'id' => 'type_phone', 'label' => esc_html__('SHORTCODE [ann_click type="phone"]', 'ann-click') ]
	// );

	// add_settings_field(
	// 	'type_website',
	// 	esc_html__('Website', 'ann-click'), // title
	// 	'ann_click_callback_field_checkbox',
	// 	'ann-click',
	// 	'ann_click_section_types',
	// 	[ 'id' => 'type_website', 'label' => esc_html__('SHORTCODE [ann_click type="website"]', 'ann-click') ]
	// );

	// add_settings_field(
	// 	'type_email',
	// 	esc_html__('Email', 'ann-click'), // title
	// 	'ann_click_callback_field_checkbox',
	// 	'ann-click',
	// 	'ann_click_section_types',
	// 	[ 'id' => 'type_email', 'label' => esc_html__('SHORTCODE [ann_click type="email"]', 'ann-click') ]
	// );

	// add_settings_field(
	// 	'type_fb',
	// 	esc_html__('Facebook', 'ann-click'), // title
	// 	'ann_click_callback_field_checkbox',
	// 	'ann-click',
	// 	'ann_click_section_types',
	// 	[ 'id' => 'type_fb', 'label' => esc_html__('SHORTCODE [ann_click type="fb"]', 'ann-click') ]
	// );

	// add_settings_field(
	// 	'type_twitter',
	// 	'Twitter',
	// 	esc_html__('Twitter', 'ann-click'), // title
	// 	'ann_click_callback_field_checkbox',
	// 	'ann-click',
	// 	'ann_click_section_types',
	// 	[ 'id' => 'type_twitter', 'label' => esc_html__('SHORTCODE [ann_click type="twitter"]', 'ann-click') ]
	// );

	// add_settings_field(
	// 	'type_ig',
	// 	esc_html__('Instagram', 'ann-click'), // title
	// 	'ann_click_callback_field_checkbox',
	// 	'ann-click',
	// 	'ann_click_section_types',
	// 	[ 'id' => 'type_ig', 'label' => esc_html__('SHORTCODE [ann_click type="ig"]', 'ann-click') ]
	// );

	// add_settings_field(
	// 	'type_in',
	// 	esc_html__('Linkedin', 'ann-click'), // title
	// 	'ann_click_callback_field_checkbox',
	// 	'ann-click',
	// 	'ann_click_section_types',
	// 	[ 'id' => 'type_in', 'label' => esc_html__('SHORTCODE [ann_click type="in"]', 'ann-click') ]
	// );
}
add_action( 'admin_init', 'ann_click_register_settings' );
