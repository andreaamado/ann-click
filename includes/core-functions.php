<?php
/**
 * Ann Click - Core Functionality
 */

 // exit if file is called directly
 if (!defined('ABSPATH')) {
    exit;
}

// call style and js
function ann_click_enqueue() {
    wp_enqueue_style('ann-click', // plugin slug
		plugin_dir_url(dirname(__FILE__)) . 'public/css/style.css', 
		array(), // include dependencies
		null, // version control
		'screen' // media type
	);

    wp_enqueue_style('ann-click-jquery-ui', // jquery id
		plugin_dir_url(dirname(__FILE__)) . 'public/css/jquery-ui.css', 
		array(), // include dependencies
		null, // version control
		'screen' // media type
	);
    
	wp_enqueue_script('ann-click', // plugin slug
		plugin_dir_url(dirname(__FILE__)) . 'public/js/main.js', 
		array(), // include dependencies
		null, // version control
		true // location (true:footer, false:header)
	);

	wp_enqueue_script('ann-click-jquery-ui', // jquery id
		plugin_dir_url(dirname(__FILE__)) . 'public/js/jquery-ui.js', 
		array(), // include dependencies
		null, // version control
		true // location (true:footer, false:header)
	);

    /**
     * Ajax part
     */
    // create nonce
    $nonce = wp_create_nonce( 'ann_click_ajax' );

    // define ajax url
    $ajax_url = admin_url( 'admin-ajax.php' ); //wp default ajax file

    // define script
    $script = array( 'nonce' => $nonce, 'ajaxurl' => $ajax_url );

    // localize script
    wp_localize_script( 'ann-click', 'ann_click_ajax', $script );
}
add_action( 'wp_enqueue_scripts', 'ann_click_enqueue');


// content hook, show the buttons when in a single view
function ann_click_shortcode() {
    
    if ( ! is_single() ) return $content;

    global $post, $typeContent;
	
	$annClick['phone'] = get_post_meta($post->ID, 'ann_click_cf_phone', true);
	if($annClick['phone'] != "") {
		$typeContent .= '<a href="#" class="ajax-ann-click" data-id="' . $post->ID . '" data-type="1">
							<div class="ann-click-btn">
								<img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/icon_phone.png">
							</div>
							<div class="ajax-loading"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/Spinner-1s-32px.gif" /></div>
							<div id="annClickPhone">' . $annClick['phone'] . '</div>
                        </a>';
    }

	$annClick['email'] = get_post_meta($post->ID, 'ann_click_cf_email', true);
	if($annClick['email'] != "") {
		$typeContent .= '<a href="#" class="ajax-ann-click" data-id="' . $post->ID . '" data-type="2">
							<div class="ann-click-btn">
                                <img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/icon_email.png">
							</div>
							<div class="ajax-loading"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/Spinner-1s-32px.gif" /></div>
							<div id="annClickEmail">' . $annClick['email'] . '</div>
                        </a>';
	}
    
    $annClick['website'] = get_post_meta($post->ID, 'ann_click_cf_website', true);
    if($annClick['website'] != "") {
        $typeContent .= '<a href="#" target="_blank" class="ajax-ann-click" data-id="' . $post->ID . '" data-type="3" data-info="' . $annClick['website'] . '">
                            <div class="ann-click-btn">
                                <img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/icon_www.png">
                            </div>
                            <div class="ajax-loading"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/Spinner-1s-32px.gif" /></div>
                        </a>';
    }
	
	$annClick['fb'] = get_post_meta($post->ID, 'ann_click_cf_fb', true);
	if($annClick['fb'] != "") {
		$typeContent .= '<a href="#" target="_blank" class="ajax-ann-click" data-id="' . $post->ID . '" data-type="4" data-info="' . $annClick['fb'] . '">
							<div class="ann-click-btn">
								<img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/icon_fb.png">
							</div>
							<div class="ajax-loading"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/Spinner-1s-32px.gif" /></div>
						</a>';
	}
	
	$annClick['twitter'] = get_post_meta($post->ID, 'ann_click_cf_twitter', true);
	if($annClick['twitter'] != "") {
		$typeContent .= '<a href="#" target="_blank" class="ajax-ann-click" data-id="' . $post->ID . '" data-type="5" data-info="' . $annClick['twitter'] . '">
							<div class="ann-click-btn">
                                <img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/icon_twitter.png">
							</div>
							<div class="ajax-loading"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/Spinner-1s-32px.gif" /></div>
						</a>';
	}
	
	$annClick['ig'] = get_post_meta($post->ID, 'ann_click_cf_ig', true);
	if($annClick['ig'] != "") {
		$typeContent .= '<a href="#" target="_blank" class="ajax-ann-click" data-id="' . $post->ID . '" data-type="6" data-info="' . $annClick['ig'] . '">
							<div class="ann-click-btn">
                                <img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/icon_ig.png">
							</div>
							<div class="ajax-loading"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/Spinner-1s-32px.gif" /></div>
						</a>';
	}
	
	$annClick['in'] = get_post_meta($post->ID, 'ann_click_cf_in', true);
	if($annClick['in'] != "") {
		$typeContent .= '<a href="#" target="_blank" class="ajax-ann-click" data-id="' . $post->ID . '" data-type="7" data-info="' . $annClick['in'] . '">
							<div class="ann-click-btn">
                                <img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/icon_in.png">
							</div>
							<div class="ajax-loading"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'public/images/Spinner-1s-32px.gif" /></div>
						</a>';
	}

    return $typeContent;
}
add_action( 'the_content', 'ann_click_shortcode' );


/**
 * AJAX to get user click and update mysql
 */

// process ajax request
function ann_click_handler() {
	global $wpdb;
	$table_click = $wpdb->prefix . 'ann_click';
    $table_type = $wpdb->prefix . 'ann_click_type';

	// check nonce
	check_ajax_referer( 'ann_click_ajax', 'nonce' );

	// define post id
	$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;
	$type = isset( $_POST['type'] ) ? $_POST['type'] : false;

	// fetch content from post id and type
	$querySel = "SELECT post_id, id_type FROM $table_click WHERE post_id = " . $post_id . " AND id_type = " . $type;
	$item = $wpdb->get_row($querySel, OBJECT); //get_results
	// echo "post_id: " . $item->post_id . " - id_type: " . $item->id_type;

	// check if exists, if exists update and increse qty, if not insert new row
	if ( count($item) == 0 ) {
	    $query = "INSERT INTO $table_click (post_id, id_type, qty, dates) VALUES (" . $post_id . ", " . $type . ", 1, now())";
	    $results = $wpdb->query($query);
	} else {
	    $query = "UPDATE $table_click SET qty = (qty + 1) WHERE post_id = " . $item->post_id . " AND id_type = " . $item->id_type;
	    $results = $wpdb->query($query);
    }

	// end processing
	wp_die();
}
// ajax hook for logged-in users: wp_ajax_{action}
add_action( 'wp_ajax_public_hook', 'ann_click_handler' );

// ajax hook for non-logged-in users: wp_ajax_nopriv_{action}
add_action( 'wp_ajax_nopriv_public_hook', 'ann_click_handler' );







// CREATE TABLE `ann_ann_click` (
// `post_id` bigint(10) NOT NULL,
// `id_type` bigint(10) NOT NULL,
// `qty` bigint(5) NOT NULL,
// `dates` date NOT NULL,
// PRIMARY KEY (`post_id`, `id_type`),
// FOREIGN KEY (`id_type`) REFERENCES `ann_click_type` (`id_type`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
// INSERT INTO `ann_ann_click` (`post_id`, `id_type`, `qty`, `dates`) VALUES (35, 1, 5, '2017-11-11');
// INSERT INTO `ann_ann_click` (`post_id`, `id_type`, `qty`, `dates`) VALUES (33, 1, 9, '2017-11-20');

// CREATE TABLE `ann_ann_click_type` (
// `id_type` bigint(10) NOT NULL AUTO_INCREMENT,
// `name` varchar(100) NOT NULL,
// PRIMARY KEY (`id_type`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
// INSERT INTO `ann_ann_click_type` (`id_type`, `name`) VALUES (1, 'phone');
// INSERT INTO `ann_ann_click_type` (`id_type`, `name`) VALUES (2, 'email');
// INSERT INTO `ann_ann_click_type` (`id_type`, `name`) VALUES (3, 'website');
// INSERT INTO `ann_ann_click_type` (`id_type`, `name`) VALUES (4, 'fb');
// INSERT INTO `ann_ann_click_type` (`id_type`, `name`) VALUES (5, 'twitter');
// INSERT INTO `ann_ann_click_type` (`id_type`, `name`) VALUES (6, 'ig');
// INSERT INTO `ann_ann_click_type` (`id_type`, `name`) VALUES (7, 'in');