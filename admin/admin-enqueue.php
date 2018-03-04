<?php
/**
 * Ann Click - Admin Enqueues
 */

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

// call style and js
function ann_click_admin_enqueue() {

    wp_enqueue_style('ann-click', // plugin slug
		plugin_dir_url(dirname(__FILE__)) . 'admin/css/style.css', 
		array(), // include dependencies
		null, // version control
		'screen' // media type
	);

    wp_enqueue_script('ann-click', // plugin slug
		plugin_dir_url(dirname(__FILE__)) . 'admin/js/main.js', 
		array(), // include dependencies
		null, // version control
		true // location (true:footer, false:header)
    );
}
add_action( 'admin_enqueue_scripts', 'ann_click_admin_enqueue');
