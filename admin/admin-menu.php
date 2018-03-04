<?php
/**
 * Ann Click - Admin Menu
 */

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

 // add top-level administrative menu
function ann_click_add_toplevel_menu() {
	add_menu_page(
		esc_html__('Ann Click Settings', 'ann-click'), // page title
		esc_html__('Ann Click', 'ann-click'), // menu title
		'manage_options', // capability
		'ann-click', // menu slug
		'ann_click_display_settings_page', // callback function
		'dashicons-admin-generic', // icon url
		null // menu position (the higher the number the lower the plugin position)
	);
}
add_action( 'admin_menu', 'ann_click_add_toplevel_menu' );