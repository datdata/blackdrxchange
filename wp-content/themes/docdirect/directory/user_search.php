<?php
/**
 *  Template Name: Search Page
 * 
 */

$dir_listing_type = 'top';
if (function_exists('fw_get_db_post_option')) {
	$dir_listing_type = fw_get_db_settings_option('dir_listing_type');
}

//Demo user Only
if( isset( $_GET['view'] ) && ( $_GET['view'] === 'grid-left' || $_GET['view'] === 'list-left' ) ){
	$dir_listing_type	= 'left';
}

if( isset( $dir_listing_type ) && $dir_listing_type === 'left' ){
	get_template_part('directory/templates/map-search','left');
} else{
	get_template_part('directory/templates/map-search','top');
}