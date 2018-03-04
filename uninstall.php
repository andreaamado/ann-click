<?php
/**
 * Ann Click - Uninstall
 * Fires when plugin is uninstalled via the Plugins screen
 */

// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// // delete the plugin options
// delete_option( 'ann_click_options' );

// delete database table:
global $wpdb;
$table_click = $wpdb->prefix . 'ann_click';
$table_type = $wpdb->prefix . 'ann_click_type';
$wpdb->query( "DROP TABLE IF EXISTS {$table_click}" );
$wpdb->query( "DROP TABLE IF EXISTS {$table_type}" );

// // delete cron event:
// $timestamp = wp_next_scheduled( 'sfs_cron_cache' );
// wp_unschedule_event( $timestamp, 'sfs_cron_cache' );

// Delete options:   delete_option()
// Delete transient: delete_transient()
// Delete metadata:  delete_metadata()