<?php
/**
 * Ann Click - Create MySql Tables Page
 */

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

// create mysql tables
function ann_click_create_db() {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_click = $wpdb->prefix . 'ann_click';
    $table_type = $wpdb->prefix . 'ann_click_type';

    $sql = "CREATE TABLE $table_click (
        post_id bigint(10) NOT NULL,
        id_type bigint(10) NOT NULL,
        qty bigint(5) NOT NULL,
        dates date NOT NULL,
        PRIMARY KEY (post_id, id_type)
        ) $charset_collate;
        
        CREATE TABLE $table_type (
        id_type bigint(10) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        PRIMARY KEY (id_type)
        ) $charset_collate;";

    // wp_die($sql);

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
// register_activation_hook( __FILE__, 'ann_click_create_db' );


// create mysql tables
function ann_click_data() {

    global $wpdb;
    $table_type = $wpdb->prefix . 'ann_click_type';
	
    $wpdb->insert( 
        $table_type, 
        array( 'id_type' => 1, 'name' => 'Phone' ) 
    );
    $wpdb->insert( 
        $table_type, 
        array( 'id_type' => 2, 'name' => 'Email' ) 
    );
    $wpdb->insert( 
        $table_type, 
        array( 'id_type' => 3, 'name' => 'Website' ) 
    );
    $wpdb->insert( 
        $table_type, 
        array( 'id_type' => 4, 'name' => 'Facebook' ) 
    );
    $wpdb->insert( 
        $table_type, 
        array( 'id_type' => 5, 'name' => 'Twitter' ) 
    );
    $wpdb->insert( 
        $table_type, 
        array( 'id_type' => 6, 'name' => 'Instagram' ) 
    );
    $wpdb->insert( 
        $table_type, 
        array( 'id_type' => 7, 'name' => 'Linkedin' ) 
    );
    
}
// register_activation_hook( __FILE__, 'ann_click_data' );
