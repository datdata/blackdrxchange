<?php

if (!defined('FW')) {
    die('Forbidden');
}


$options = array(
    'api_settings' => array(
        'type' => 'tab',
        'title' => esc_html__('Api Settings', 'docdirect'),
        'options' => array(
			'flickr' => array(
                'title' => esc_html__('Flickr', 'docdirect'),
                'type' => 'tab',
                'options' => array(
                    'flickr_key' => array(
                        'type' => 'text',
                        'value' => '',
                        'label' => esc_html__('Flickr Key', 'docdirect'),
                        'desc' => esc_html__('Enter flickr key here.', 'docdirect'),
                    ),
					'flickr_secret' => array(
                        'type' => 'text',
                        'value' => '',
                        'label' => esc_html__('Flickr Secret', 'docdirect'),
                        'desc' => esc_html__('Enter your flickr secret here.', 'docdirect'),
                    ),
                )
            ),
			'google' => array(
                'title' => esc_html__('Google', 'docdirect'),
                'type' => 'tab',
                'options' => array(
                    'google_key' => array(
                        'type' => 'text',
                        'value' => '',
                        'label' => esc_html__('Google Map Key', 'docdirect'),
						'desc' => wp_kses( __( 'Enter google map key here. It will be used for google maps. Get and Api key From <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank"> Get API KEY </a>', 'docdirect' ),array(
																		'a' => array(
																			'href' => array(),
																			'title' => array()
																		),
																		'br' => array(),
																		'em' => array(),
																		'strong' => array(),
																	)),
                    ),
                )
            ),
        )
    )
);


