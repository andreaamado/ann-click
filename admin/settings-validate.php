<?php
/**
 * Ann Click - Validate Settings
 */

 // exit if file is called directly
 if (!defined('ABSPATH')) {
    exit;
}

// callback: validate options
function ann_click_callback_validate_options( $input ) {
	
	// phone
	if ( !isset( $input['type_phone'] ) ) {
		$input['type_phone'] = null;
	}
	
	// website
	if ( !isset( $input['type_website'] ) ) {
		$input['type_website'] = null;
	}
	
	// email
	if ( !isset( $input['type_email'] ) ) {
		$input['type_email'] = null;
	}
	
	// facebook
	if ( !isset( $input['type_fb'] ) ) {
		$input['type_fb'] = null;
	}
	
	// twitter
	if ( !isset( $input['type_twitter'] ) ) {
		$input['type_twitter'] = null;
	}
	
	// instagram
	if ( !isset( $input['type_ig'] ) ) {
		$input['type_ig'] = null;
	}
	
	// linkedin
	if ( !isset( $input['type_in'] ) ) {
		$input['type_in'] = null;
	}
	
	return $input;
	
}