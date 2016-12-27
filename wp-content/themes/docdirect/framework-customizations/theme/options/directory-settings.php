<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'directory' => array(
		'title'   => esc_html__( 'Directory Settings', 'docdirect' ),
		'type'    => 'tab',
		'options' => array(
			'general-settings' => array(
				'title'   => esc_html__( 'General Settings', 'docdirect' ),
				'type'    => 'tab',
				'options' => array(
					'user_page_slug' => array(
						'type'  => 'text',
						'value'  => 'user',
                        'label' => esc_html__('User detail page slug', 'docdirect'),
						'desc'  => esc_html__('You can add user detail page slug here. default is : user', 'docdirect'),
                        'help'  => esc_html__('', 'docdirect'),
					),
					'dir_review_status'     => array(
						'label' => esc_html__( 'Review Status', 'docdirect' ),
						'type'  => 'select',
						'desc' => esc_html__('Please select review status when it post.', 'docdirect'),
						'help' => esc_html__('If you want to publish review then select status as Publish, otherwise select Pending to make it draft( Only admin ) can approve it.', 'docdirect'),
						'choices'	=> array(
							'pending'	  => esc_html__( 'Pending', 'docdirect' ),
							'publish'	=> esc_html__( 'Publish', 'docdirect' ),
						)
					),
					'verify_user'     => array(
						'label' => esc_html__( 'Verify User', 'docdirect' ),
						'type'  => 'select',
						'value' => 'none',
						'desc' => esc_html__('Verify user before publicly available. Note: If you select "Need to verify, after registration" then user will not be shown until it will be verified by site owner. If you select "Verify automatically" then user will be published and will be available to website.​', 'docdirect'),
						'choices'	=> array(
							'verified'  => 'Verify automatically',
							'none'	=> 'Need to verify, after registeration',
						)
					),
				)
			),
			'company-box' => array(
				'title'   => esc_html__( 'Company Settings', 'docdirect' ),
				'type'    => 'tab',
				'options' => array(
					'support-section' => array(
						'type' => 'html',
						'html' => 'Support Section',
						'label' => esc_html__('', 'docdirect'),
						'desc' => esc_html__('please note that if you want to show company profile at user dashboard then please do settings which is given below. ', 'docdirect'),
						'help' => esc_html__('', 'docdirect'),
						'images_only' => true,
					),
					'company_profile' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Show Company Profile', 'docdirect'),
						'desc'  => esc_html__('Enable Company Profile section at user dashboard.', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'com_description' => array(
                        'type'  => 'textarea',
                        'label' => esc_html__('Add company description', 'docdirect'),
						'hint' => esc_html__('Leave it empty to hide.', 'docdirect'),
                        'desc'  => esc_html__('', 'docdirect'),
                    ),
					'com_logo' => array(
                        'type'  => 'upload',
                        'label' => esc_html__('Add Logo', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Leave it empty to hide.', 'docdirect'),
                        'images_only' => true,
                    ),
					'support_box' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Show support information', 'docdirect'),
						'desc'  => esc_html__('Enable support information section at user dashboard.', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'support_heading' => array(
                        'type'  => 'text',
                        'label' => esc_html__('Support Heading', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Leave it empty to hide.', 'docdirect'),
                    ),
					'support_address' => array(
                        'type'  => 'text',
                        'label' => esc_html__('Address', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Leave it empty to hide.', 'docdirect'),
                    ),
					'support_phone' => array(
                        'type'  => 'text',
                        'label' => esc_html__('Phone No', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Leave it empty to hide.', 'docdirect'),
                    ),
					'support_email' => array(
                        'type'  => 'text',
                        'label' => esc_html__('Email address', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Leave it empty to hide.', 'docdirect'),
                    ),
					'support_fax' => array(
                        'type'  => 'text',
                        'label' => esc_html__('Fax', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Leave it empty to hide.', 'docdirect'),
                    ),
				),
			),
			'general-box' => array(
				'title'   => esc_html__( 'Directory Settings', 'docdirect' ),
				'type'    => 'tab',
				'options' => array(
					'dir_profile_page'     => array(
						'label' => esc_html__( 'User Profile Page', 'docdirect' ),
						'type'  => 'multi-select',
						'population' => 'posts',
						'source' => 'page',
						'desc' => esc_html__('User Profile Page', 'docdirect'),
						'limit'	=> 1
					),
					'dir_datasize' => array(
                        'type'  => 'text',
						'value' => '5120',
						'attr'  => array(),
						'label' => esc_html__('Uplaod Size', 'docdirect'),
						'desc'  => esc_html__('Maximum Image Uplaod Size. Max 5MB, add in bytes. for example 5MB = 5242880 ( 1024x1024x5 )', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
                    ),
					'directory_prefix' => array(
                        'type'  => 'text',
						'value' => 'DD-',
						'label' => esc_html__('Prefixes for orders.', 'docdirect'),
						'desc'  => esc_html__('', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
                    ),
				),
			),
			'dashboard-box' => array(
				'title'   => esc_html__( 'Dashboard Settings', 'docdirect' ),
				'type'    => 'tab',
				'options' => array(
					'delete_account_text'     => array(
						'label' => esc_html__( 'Account Deletion Description.', 'docdirect' ),
						'type'  => 'textarea',
						'desc' => esc_html__('Add message to show it in security settings, wheb user will go to delete your account.', 'docdirect'),
					),
				),
			),
			'map-box' => array(
				'title'   => esc_html__( 'Map Settings', 'docdirect' ),
				'type'    => 'tab',
				'options' => array(
					'dir_map_type'     => array(
						'label' => esc_html__( 'Map Type', 'docdirect' ),
						'type'  => 'select',
						'desc' => esc_html__('Select Map Type.', 'docdirect'),
						'choices'	=> array(
							'ROADMAP'	  => 'ROADMAP',
							'SATELLITE'	=> 'SATELLITE',
							'HYBRID'	   => 'HYBRID',
							'TERRAIN'	  => 'TERRAIN',
						)
					),
					'map_styles'     => array(
						'label' => esc_html__( 'Map Style', 'docdirect' ),
						'type'  => 'select',
						'desc' => esc_html__('Select map style. It will override map type.', 'docdirect'),
						'choices'	=> array(
							'none'   => esc_html__('NONE', 'docdirect'),
							'view_1' => esc_html__('Default','docdirect'),
							'view_2' => esc_html__('View 2', 'docdirect'),
							'view_3' => esc_html__('View 3', 'docdirect'),
							'view_4' => esc_html__('View 4', 'docdirect'),
							'view_5' => esc_html__('View 5', 'docdirect'),
							'view_6' => esc_html__('View 6', 'docdirect'),
						)
					),
					'dir_map_scroll'     => array(
						'label' => esc_html__( 'Map Scroll', 'docdirect' ),
						'type'  => 'select',
						'desc' => esc_html__('Select Zoom on scroll wheel', 'docdirect'),
						'choices'	=> array(
							'false'	=> esc_html__('No', 'docdirect'),
							'true'	 => esc_html__('Yes', 'docdirect'),
						)
					),
					'dir_cluster_marker' => array(
                        'type'  => 'upload',
                        'label' => esc_html__('Cluster Map Marker', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Default Cluster map marker.', 'docdirect'),
                        'images_only' => true,
                    ),
					'dir_cluster_color' => array(
                        'type'  => 'color-picker',
						'value' => '#505050',
						'attr'  => array(),
						'label' => esc_html__('Map Cluster Color', 'docdirect'),
						'desc'  => esc_html__('', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
                    ),
					'dir_map_marker' => array(
                        'type'  => 'upload',
                        'label' => esc_html__('Map Marker', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Default map marker.', 'docdirect'),
                        'images_only' => true,
                    ),
					'dir_zoom' => array(
                        'type'  => 'slider',
						'value' => 12,
						'properties' => array(
							'min' => 9,
							'max' => 20,
							'step' => 1, // Set slider step. Always > 0. Could be fractional.
						),
                        'label' => esc_html__('Map Zoom', 'docdirect'),
						'hint' => esc_html__('', 'docdirect'),
                        'desc'  => esc_html__('Select map zoom level', 'docdirect'),
                        'images_only' => true,
                    ),
					'dir_longitude' => array(
                        'type'  => 'text',
						'value' => '-0.1262362',
						'attr'  => array(),
						'label' => esc_html__('Longitude', 'docdirect'),
						'desc'  => esc_html__('', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
                    ),
					'dir_latitude' => array(
                        'type'  => 'text',
						'value' => '51.5001524',
						'attr'  => array(),
						'label' => esc_html__('Latitude', 'docdirect'),
						'desc'  => esc_html__('', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
                    ),
				),
			),
			'search-box' => array(
				'title'   => esc_html__( 'Search Settings', 'docdirect' ),
				'type'    => 'tab',
				'options' => array(
					'search_page_map' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Search result map', 'docdirect'),
						'desc'  => esc_html__('Enable/Disble google map at search page.', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'dir_search_view' => array(
                        'type'  => 'select',
						'value' => 'list',
						'attr'  => array(),
						'label' => esc_html__('Search Listing View', 'docdirect'),
						'desc'  => esc_html__('', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
						'choices'  => array(
							'list'	=> esc_html__('List', 'docdirect'),
							'grid'	=> esc_html__('Grid', 'docdirect'),
						),
                    ),
					'dir_listing_type' => array(
                        'type'  => 'select',
						'value' => 'top',
						'attr'  => array(),
						'label' => esc_html__('Search page map position', 'docdirect'),
						'desc'  => esc_html__('Select search page map position.', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
						'choices'  => array(
							'top'	=> esc_html__('Top', 'docdirect'),
							'left'	=> esc_html__('left', 'docdirect'),
						),
                    ),
					'dir_search_pagination' => array(
                        'type'  => 'slider',
						'attr'  => array(),
						'label' => esc_html__('Search Result per page', 'docdirect'),
						'desc'  => esc_html__('', 'docdirect'),
						'help'  => esc_html__('', 'docdirect'),
						'value' => 10,
						'properties' => array(
							'min' => 1,
							'max' => 100,
							'step' => 1, // Set slider step. Always > 0. Could be fractional.
						),
                    ),
					'dir_search_page'     => array(
						'label' => esc_html__( 'Search Page', 'docdirect' ),
						'type'  => 'multi-select',
						'population' => 'posts',
						'source' => 'page',
						'desc' => esc_html__('Search result page.', 'docdirect'),
						'limit'	=> 1
					),
					'dir_keywords' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Keywords Search', 'docdirect'),
						'desc'  => esc_html__('Enable Keywords Search', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'zip_code_search' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Zip Code', 'docdirect'),
						'desc'  => esc_html__('Enable/Disable Zip Code Search', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'dir_location' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Location Search', 'docdirect'),
						'desc'  => esc_html__('Enable Location Search', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'dir_radius' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Radius Search', 'docdirect'),
						'desc'  => esc_html__('Enable Radius Search, Note it will be display when location will be enable.', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					'dir_geo' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Enable geo location', 'docdirect'),
						'desc'  => esc_html__('Enable geo location.', 'docdirect'),
						'left-choice' => array(
							'value' => 'enable',
							'label' => esc_html__('Enable', 'docdirect'),
						),
						'right-choice' => array(
							'value' => 'disable',
							'label' => esc_html__('Disable', 'docdirect'),
						),
					),
					
					'language_search' => array(
						'type'  => 'switch',
						'value' => 'enable',
						'label' => esc_html__('Language search', 'docdirect'),
						'desc'  => esc_html__('Enable or disbale language search.', 'docdirect'),
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
			),
		)
	)
);