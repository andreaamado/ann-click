<?php
/*
Plugin Name:  Ann Click
Description:  Track when the user clicked on your website custom links
Plugin URI:   http://www.andreaamado.ca/
Author:       Andrea de Cerqueira
Version:      5.0
Text Domain:  ann-click
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

// load text domain
function ann_click_load_textdomain() {
	load_plugin_textdomain( 'ann-click', false, plugin_dir_path( __FILE__ ) . 'languages/' );
}
add_action( 'plugins_loaded', 'ann_click_load_textdomain' );

// include dependencies: admin
if(is_admin()) {
	require_once plugin_dir_path(__FILE__) . 'admin/create-data.php';
	// we need to register the hook here afte include create-tables.php, otherwise it will not work
	register_activation_hook( __FILE__, 'ann_click_create_db' );
	register_activation_hook( __FILE__, 'ann_click_data' );
	
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-register.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-callback.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-validate.php';
	require_once plugin_dir_path(__FILE__) . 'admin/settings-metabox.php';
	require_once plugin_dir_path(__FILE__) . 'admin/admin-enqueue.php';
}

// include dependencies: admin and public
require_once plugin_dir_path(__FILE__) . 'includes/core-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/pagination.php';

// default plugin options
function ann_click_options_default() {
	return array(
		'type_phone' => false,
		'type_website' => false,
		'type_email' => false,
		'type_fb' => false,
		'type_twitter' => false,
		'type_ig' => false,
		'type_in' => false
	);
}