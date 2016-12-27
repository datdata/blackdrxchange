<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    'footer' => array(
        'title' => esc_html__('Footer', 'docdirect'),
        'type' => 'tab',
        'options' => array(
            'footer_settings' => array(
                'title' => esc_html__('Footer Settings', 'docdirect'),
                'type' => 'box',
                'options' => array(
                    'enable_widget_area' => array(
                        'type' => 'switch',
                        'value' => 'off',
                        'attr' => array(),
                        'label' => esc_html__('Enable / Disable Widget Area', 'docdirect'),
                        'desc' => esc_html__('', 'docdirect'),
                        'left-choice' => array(
                            'value' => 'off',
                            'label' => esc_html__('Off', 'docdirect'),
                        ),
                        'right-choice' => array(
                            'value' => 'on',
                            'label' => esc_html__('ON', 'docdirect'),
                        ),
                    ),
					
                    'footer_copyright' => array(
                        'type' => 'text',
                        'value' => '2015 All Rights Reserved &copy; DocDirect',
                        'label' => esc_html__('Footer Copyright', 'docdirect'),
                    ),
                )
            ),
        )
    )
);
