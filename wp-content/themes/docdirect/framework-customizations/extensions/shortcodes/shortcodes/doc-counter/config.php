<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg = array(
	'page_builder' => array(
		'title' => esc_html__('Counter', 'docdirect'),
		'description' => esc_html__('Display Counter', 'docdirect'),
		'tab' => esc_html__('Doctor Directory', 'docdirect'),
		'popup_size' => 'small' // can be large, medium or small
	)
);