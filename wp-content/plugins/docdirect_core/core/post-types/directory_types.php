<?php
/**
 * File Type: Directory Type
 */
if( ! class_exists('TG_DirectoryType') ) {
	
	class TG_DirectoryType {
	
		public function __construct() {
			global $pagenow;
			add_action('init', array(&$this, 'init_directory_type'));			
		}
		
		/**
		 * @Init Post Type
		 * @return {post}
		 */
		public function init_directory_type(){
			$this->prepare_post_type();
		}
		
		/**
		 * @Prepare Post Type
		 * @return {}
		 */
		public function prepare_post_type(){
			$labels = array(
				'name' 				 => esc_html__( 'Directory Types', 'docdirect_core' ),
				'all_items'			 => esc_html__( 'Directory Types', 'docdirect_core' ),
				'singular_name'      => esc_html__( 'Directory Type', 'docdirect_core' ),
				'add_new'            => esc_html__( 'Add Directory Type', 'docdirect_core' ),
				'add_new_item'       => esc_html__( 'Add New Directory Type', 'docdirect_core' ),
				'edit'               => esc_html__( 'Edit', 'docdirect_core' ),
				'edit_item'          => esc_html__( 'Edit Directory Type', 'docdirect_core' ),
				'new_item'           => esc_html__( 'New Directory Type', 'docdirect_core' ),
				'view'               => esc_html__( 'View Directory Type', 'docdirect_core' ),
				'view_item'          => esc_html__( 'View Directory Type', 'docdirect_core' ),
				'search_items'       => esc_html__( 'Search Directory Type', 'docdirect_core' ),
				'not_found'          => esc_html__( 'No Directory Type found', 'docdirect_core' ),
				'not_found_in_trash' => esc_html__( 'No Directory Type found in trash', 'docdirect_core' ),
				'parent'             => esc_html__( 'Parent Directory Type', 'docdirect_core' ),
			);
			$args = array(
				'labels'			  => $labels,
				'description'         => esc_html__( 'This is where you can add new Directory Type', 'docdirect_core' ),
				'public'              => true,
				'supports'            => array( 'title'),
				'show_ui'             => true,
				'capability_type'     => 'post',
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'hierarchical'        => false,
				'menu_position' 	  => 10,
				'rewrite'			  => array('slug' => 'directory_type', 'with_front' => true),
				'query_var'           => false,
				'has_archive'         => 'false',
			); 
			register_post_type( 'directory_type' , $args );
			
			//Locations
			$labels = array(
				'name'              => esc_html__( 'Locations', 'taxonomy general name', 'docdirect_core' ),
				'singular_name'     => esc_html__( 'Locations', 'taxonomy singular name' , 'docdirect_core'),
				'search_items'      => esc_html__( 'Search Location' , 'docdirect_core'),
				'all_items'         => esc_html__( 'All Location' , 'docdirect_core'),
				'parent_item'       => esc_html__( 'Parent Location' , 'docdirect_core'),
				'parent_item_colon' => esc_html__( 'Parent Location:' , 'docdirect_core'),
				'edit_item'         => esc_html__( 'Edit Location' , 'docdirect_core'),
				'update_item'       => esc_html__( 'Update Location' , 'docdirect_core'),
				'add_new_item'      => esc_html__( 'Add New Location' , 'docdirect_core'),
				'new_item_name'     => esc_html__( 'New Location Name', 'docdirect_core' ),
				'menu_name'         => esc_html__( 'Locations', 'docdirect_core' ),
			);
		
			$args = array(
				'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => false,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'locations' ),
			);
			
			//Specialities
			$specialities_labels = array(
				'name'              => esc_html__( 'Specialities', 'taxonomy general name', 'docdirect_core' ),
				'singular_name'     => esc_html__( 'Specialities', 'taxonomy singular name' , 'docdirect_core'),
				'search_items'      => esc_html__( 'Search Speciality' , 'docdirect_core'),
				'all_items'         => esc_html__( 'All Speciality' , 'docdirect_core'),
				'parent_item'       => esc_html__( 'Parent Speciality' , 'docdirect_core'),
				'parent_item_colon' => esc_html__( 'Parent Speciality:' , 'docdirect_core'),
				'edit_item'         => esc_html__( 'Edit Speciality' , 'docdirect_core'),
				'update_item'       => esc_html__( 'Update Speciality' , 'docdirect_core'),
				'add_new_item'      => esc_html__( 'Add New Speciality' , 'docdirect_core'),
				'new_item_name'     => esc_html__( 'New Speciality Name', 'docdirect_core' ),
				'menu_name'         => esc_html__( 'Specialities', 'docdirect_core' ),
			);
		
			$specialities_args = array(
				'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
				'labels'            => $specialities_labels,
				'show_ui'           => true,
				'show_admin_column' => false,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'specialities' ),
			);
			
			register_taxonomy( 'locations', array( 'directory_type' ), $args );
			register_taxonomy( 'specialities', array( 'directory_type' ), $specialities_args );
			  
		}
		
	}
	
  	new TG_DirectoryType();	
}