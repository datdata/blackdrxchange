<?php
/**
 *  Contants
 */
 
if (!function_exists('docdirect_prepare_constants')) {
    function docdirect_prepare_constants() {
		
		$user_status = 'false';	
		if ( is_user_logged_in() ){ 
			$user_status = 'true';	
		}
		
		if (function_exists('fw_get_db_settings_option')) {
			$site_key = fw_get_db_settings_option('site_key');
			$dir_cluster_marker = fw_get_db_settings_option('dir_cluster_marker');
			$dir_map_marker = fw_get_db_settings_option('dir_map_marker');
			$dir_cluster_color = fw_get_db_settings_option('dir_cluster_color');
			$dir_map_type = fw_get_db_settings_option('dir_map_type');
			$dir_zoom = fw_get_db_settings_option('dir_zoom');
			$dir_longitude = fw_get_db_settings_option('dir_longitude');
			$dir_latitude = fw_get_db_settings_option('dir_latitude');
			$dir_datasize = fw_get_db_settings_option('dir_datasize');
			$dir_map_scroll = fw_get_db_settings_option('dir_map_scroll');
			$map_styles = fw_get_db_settings_option('map_styles');
			$dir_close_marker = get_template_directory_uri().'/images/close.png';
			
			if( !empty( $dir_cluster_marker ) ){
				$dir_cluster_marker = $dir_cluster_marker['url'];
			} else{
				$dir_cluster_marker = get_template_directory_uri().'/images/cluster.png';
			}
			
			if( empty( $dir_map_marker ) ){
				$dir_map_marker = get_template_directory_uri().'/images/masrker.png';
			}
			
			if( empty( $dir_cluster_color ) ){
				$dir_cluster_color = '#7dbb00';
			}
			
			if( empty( $dir_map_type ) ){
				$dir_map_type = 'ROADMAP';
			}
			
			if( empty( $dir_zoom ) ){
				$dir_zoom = '12';
			}
			
			if( empty( $dir_longitude ) ){
				$dir_longitude = '-0.1262362';
			}
			
			if( empty( $dir_latitude ) ){
				$dir_latitude = '51.5001524';
			}
			
			if( empty( $dir_datasize ) ){
				$dir_datasize = '5242880';
			} 
			
			if( empty( $dir_map_scroll ) ){
				$dir_map_scroll = 'false';
			}      
			
		} else{
			$site_key = '';
			$dir_cluster_marker = get_template_directory_uri().'/images/cluster.png';
			$dir_map_marker = get_template_directory_uri().'/images/marker.png';
			$dir_cluster_color = '#7dbb00';
			$dir_map_type = 'ROADMAP';
			$dir_zoom = '12';
			$dir_longitude = '-0.1262362';
			$dir_latitude = '51.5001524';
			$dir_datasize = '5242880';
			$dir_map_scroll = 'false';
			$map_styles = 'none';
			$dir_close_marker = get_template_directory_uri().'/images/close.png';
		}
		
		$data_size_in_kb	= $dir_datasize / 1024;
		wp_localize_script('docdirect_user_profile', 'scripts_vars', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'award_name' => esc_html__('Award Name','docdirect'),
			'award_date' => esc_html__('Award Date','docdirect'),
			'award_description' => esc_html__('Award Description','docdirect'),
			'file_upload_title' => esc_html__('Avatar Upload','docdirect'),
			'delete_message' => esc_html__('Are you sure you want to delete your account?','docdirect'),
			'deactivate' => esc_html__('Are you sure you want to deactivate your account?','docdirect'),
			'delete_title' => esc_html__('Delete account?','docdirect'),
			'deactivate_title' => esc_html__('Deactivate account?','docdirect'),
			'file_upload_title' => esc_html__('Avatar Upload','docdirect'),
			'docdirect_upload_nounce' => wp_create_nonce ( 'docdirect_upload_nounce' ),
			
			'dir_close_marker' => $dir_close_marker,
			'dir_cluster_marker' => $dir_cluster_marker,
			'dir_map_marker' => $dir_map_marker,
			'dir_cluster_color' => $dir_cluster_color,
			'dir_map_type' => $dir_map_type,
			'dir_zoom' => $dir_zoom,
			'dir_longitude' => $dir_longitude,
			'dir_latitude' => $dir_latitude,
			'dir_datasize' => $dir_datasize,
			'data_size_in_kb' => $data_size_in_kb.'kb',
			'dir_map_scroll' => $dir_map_scroll,
			'map_styles' => $map_styles,
			'site_key' => $site_key,
			
			'rating_1' => esc_html__('Not Satisfied','docdirect'),
			'rating_2' => esc_html__('Satisfied','docdirect'),
			'rating_3' => esc_html__('Good','docdirect'),
			'rating_4' => esc_html__('Very Good','docdirect'),
			'rating_5' => esc_html__('Excellent','docdirect'),
			
			'delete_award' => esc_html__('Delete Award','docdirect'),
			'delete_award_message' => esc_html__('Are you sure, you want to delete this award?','docdirect'),
			'delete_education' => esc_html__('Delete Degree','docdirect'),
			'delete_education_message' => esc_html__('Are you sure, you want to delete this Degree?','docdirect'),
			
			'delete_experience' => esc_html__('Delete Experience','docdirect'),
			'delete_experience_message' => esc_html__('Are you sure, you want to delete this experience?','docdirect'),
			
			'delete_category' => esc_html__('Delete Category','docdirect'),
			'delete_category_message' => esc_html__('Are you sure, you want to delete this category?','docdirect'),
			
			'delete_service' => esc_html__('Delete Service','docdirect'),
			'delete_service_message' => esc_html__('Are you sure, you want to delete this service?','docdirect'),
			
			'delete_slot' => esc_html__('Delete Slot','docdirect'),
			'delete_slot_message' => esc_html__('Are you sure, you want to delete this slot?','docdirect'),
			
			'delete_slot_date' => esc_html__('Delete Slot Date','docdirect'),
			'delete_slot_date_message' => esc_html__('Are you sure, you want to delete this slot date?','docdirect'),
			
			'approve_appointment' => esc_html__('Approve Appointment?','docdirect'),
			'approve_appointment_message' => esc_html__('Are you sure, you want to approve this appointment?','docdirect'),
			'cancel_appointment' => esc_html__('Cancel Appointment?','docdirect'),
			'cancel_appointment_message' => esc_html__('Are you sure, you want to cancel this appointment?','docdirect'),
			
			'booking_time' => esc_html__('Please select booking time.','docdirect'),
			'gmap_norecod' => esc_html__('No Record Found.','docdirect'),
			'fav_message' => esc_html__('Please login first.','docdirect'),
			'fav_nothing' => esc_html__('Nothing found.','docdirect'),
			'empty_category' => esc_html__('Please add category name.','docdirect'),
			'complete_fields' => esc_html__('Please fill all the fields.','docdirect'),
			'system_error' => esc_html__('Some error occur, please try again later.','docdirect'),
			'valid_email' => esc_html__('Please add valid email address.','docdirect'),
			'user_status' => $user_status,
			'custom_slots_dates' => esc_html__('Atleast one date! start or end date is required.','docdirect'),
			
			
		));
	}
	add_action('wp_enqueue_scripts', 'docdirect_prepare_constants');
}