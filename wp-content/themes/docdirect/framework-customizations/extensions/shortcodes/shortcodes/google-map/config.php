<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array(
	'page_builder' => array(
		'title' => esc_html__('Map', 'docdirect'),
		'description' => esc_html__('Display Map', 'docdirect'),
		'tab' => esc_html__('Doctor Directory', 'docdirect'),
		'popup_size' => 'small' // can be large, medium or small
	)
);