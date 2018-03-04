<?php
/**
 * Ann Click - Settings Callback
 */

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

// callback: types section
function ann_click_callback_section_type() {
	echo '<p>' . esc_html__('List of clicks', 'ann-click') . '</p>';
}

// callback: text field
function ann_click_callback_field_text( $args ) {
	$options = get_option( 'ann_click_options', ann_click_options_default() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	echo '<input id="ann_click_options_'. $id .'" name="ann_click_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="ann_click_options_'. $id .'">'. $label .'</label>';
}

// callback: radio field
function ann_click_callback_field_radio( $args ) {
	$options = get_option( 'ann_click_options', ann_click_options_default() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	$radio_options = array(
		'enable'  => esc_html__('Enable custom styles', 'ann-click'),
		'disable' => esc_html__('Disable custom styles', 'ann-click')
	);
	foreach ( $radio_options as $value => $label ) {
		$checked = checked( $selected_option === $value, true, false );
		echo '<label><input name="ann_click_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
	}
}

// callback: textarea field
function ann_click_callback_field_textarea( $args ) {
	$options = get_option( 'ann_click_options', ann_click_options_default() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$allowed_tags = wp_kses_allowed_html( 'post' );
	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	echo '<textarea id="ann_click_options_'. $id .'" name="ann_click_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
	echo '<label for="ann_click_options_'. $id .'">'. $label .'</label>';
}

// callback: checkbox field
function ann_click_callback_field_checkbox( $args ) {
	$options = get_option( 'ann_click_options', ann_click_options_default() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	echo '<input id="ann_click_options_'. $id .'" name="ann_click_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="ann_click_options_'. $id .'">'. $label .'</label>';
}

// // select field options
// function ann_click_options_select() {
// 	return array(
// 	'default'   => esc_html__('Default',   'ann-click'),
// 	'light'     => esc_html__('Light',     'ann-click'),
// 	'blue'      => esc_html__('Blue',      'ann-click'),
// 	'coffee'    => esc_html__('Coffee',    'ann-click'),
// 	'ectoplasm' => esc_html__('Ectoplasm', 'ann-click'),
// 	'midnight'  => esc_html__('Midnight',  'ann-click'),
// 	'ocean'     => esc_html__('Ocean',     'ann-click'),
// 	'sunrise'   => esc_html__('Sunrise',   'ann-click'),
// 	);
// }

// // callback: select field
// function ann_click_callback_field_select( $args ) {
// 	$options = get_option( 'ann_click_options', ann_click_options_default() );
// 	$id    = isset( $args['id'] )    ? $args['id']    : '';
// 	$label = isset( $args['label'] ) ? $args['label'] : '';
// 	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
// 	$select_options = ann_click_options_select();
// 	echo '<select id="ann_click_options_'. $id .'" name="ann_click_options['. $id .']">';
// 	foreach ( $select_options as $value => $option ) {
// 		$selected = selected( $selected_option === $value, true, false );
// 		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
// 	}
// 	echo '</select> <label for="ann_click_options_'. $id .'">'. $label .'</label>';
	
// }