<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'headers' => array(
		'title'   => esc_html__( 'Headers', 'docdirect' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => esc_html__( 'Header Settings', 'docdirect' ),
				'type'    => 'box',
				'options' => array(
					'main_logo' => array(
                        'type'  => 'upload',
                        'label' => esc_html__('Main Logo', 'docdirect'),
						'hint' => esc_html__('It will display only  at home pages.', 'docdirect'),
                        'desc'  => esc_html__('Upload Your Logo Here the preferred size is 170 by 30.', 'docdirect'),
                        'images_only' => true,
                    ),
					'registration' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Enable registration', 'docdirect'),
						'desc'  => esc_html__('Enable frontend Registration', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'enable_login' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Enable Login', 'docdirect'),
						'desc'  => esc_html__('Enable frontend Login', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
				),
			)
		)
	)
);