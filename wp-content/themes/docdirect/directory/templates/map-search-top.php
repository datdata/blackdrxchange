<?php
/**
 * Map Search Postion Top
 * return html
 */

global $current_user, $wp_roles,$userdata,$post;
get_header();

$zip_code	= isset( $_GET['zip'] ) ? $_GET['zip'] : '';
$by_name	 = isset( $_GET['by_name'] ) ? $_GET['by_name'] : '';
$args = array('posts_per_page' => '-1', 
			   'post_type' => 'directory_type', 
			   'post_status' => 'publish',
			   'suppress_filters' => false
		);

$cust_query = get_posts($args);
docdirect_init_dir_map();//init Map
docdirect_enque_map_library();//init Map

$search_page_map 		 = fw_get_db_settings_option('search_page_map');
$dir_search_page = fw_get_db_settings_option('dir_search_page');
$dir_keywords 	= fw_get_db_settings_option('dir_keywords');
$dir_location 	= fw_get_db_settings_option('dir_location');
$language_search 	= fw_get_db_settings_option('language_search');
$dir_search_view = fw_get_db_settings_option('dir_search_view');
$dir_search_pagination = fw_get_db_settings_option('dir_search_pagination');
$dir_longitude 		= fw_get_db_settings_option('dir_longitude');
$dir_latitude 		 = fw_get_db_settings_option('dir_latitude');
$google_key 			  = fw_get_db_settings_option('google_key');
$zip_code_search 		 = fw_get_db_settings_option('zip_code_search');
$dir_longitude		= !empty( $dir_longitude ) ? $dir_longitude : '-0.1262362';
$dir_latitude		 = !empty( $dir_latitude ) ? $dir_latitude : '51.5001524';
	

$listing_view	= 'tg-list-view';
if( isset( $dir_search_view ) && $dir_search_view === 'grid' ){
	$listing_view	= 'tg-grid-view';
}

//Demo User Only 
if( isset( $_GET['view'] ) && $_GET['view'] === 'grid' ){
	$listing_view	= 'tg-grid-view';
}

$per_page	= isset( $dir_search_pagination ) && !empty( $dir_search_pagination ) ? $dir_search_pagination : 10;

if( isset( $dir_search_page[0] ) && !empty( $dir_search_page[0] ) ) {
	$search_page 	 = get_permalink((int)$dir_search_page[0]);
} else{
	$search_page 	 = '';
}

$order_by 	 = isset( $_GET['order'] ) ? $_GET['order'] : 'ASC';
$sort_by 	  = isset( $_GET['sort_by'] ) ? $_GET['sort_by'] : '';

$languages_array	= docdirect_prepare_languages();//Get Language Array

if( isset( $search_page_map ) && $search_page_map === 'enable' ){
?>
<div class="map-top">
    <div class="row tg-divheight">
        <div class="tg-mapbox">
            <div id="map_canvas" class="tg-location-map tg-haslayout"></div>
            <?php do_action('docdirect_map_controls');?>
            <div id="gmap-noresult"></div>
        </div>
    </div>
</div>
<?php }?>
<div class="container">
  <div class="row">
      <form class="form-refinesearch tg-haslayout">
      <div class="col-md-4 col-sm-12 col-xs-12 pull-left">
          <div class="tg-doctors-list tg-haslayout">
            <div class="tg-refinesearcharea">
              <div class="tg-heading-border tg-small">
                <h2><?php esc_html_e('refine search','docdirect');?></h2>
              </div>
              <fieldset>
                  <div class="row">
                    <?php if( isset( $dir_keywords ) && $dir_keywords === 'enable' ){?>
                    <div class="col-md-12 col-sm-6 col-xs-6">
                      <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo esc_attr( $by_name );?>" name="by_name" placeholder="<?php esc_html_e('Type Keyword...','docdirect');?>">
                      </div>
                    </div>
                    <?php }?>
                    <?php if( isset( $dir_location ) && $dir_location === 'enable' ){?>
                    <div class="col-md-12 col-sm-6 col-xs-6">
                      <div class="form-group">
                        <?php docdirect_locateme_snipt();?>
                        <script>
                            jQuery(document).ready(function(e) {
                                //init
                                jQuery.docdirect_init_map(<?php echo esc_js( $dir_latitude );?>,<?php echo esc_js( $dir_longitude );?>);
                            });
                        </script> 
                      </div>
                    </div>
                    <?php }?>
                    <?php if( !empty( $zip_code_search ) && $zip_code_search === 'enable' ){?>
                    <div class="col-md-12 col-sm-6 col-xs-6">
                      <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo esc_attr( $zip_code );?>" name="zip" placeholder="<?php esc_html_e('Search users by zip code','docdirect');?>">
                      </div>
                    </div>
                    <?php }?>
                    <?php if( !empty( $language_search ) && $language_search === 'enable' ){?>
                    <div class="col-md-12 col-sm-6 col-xs-6">
                        <div class="form-group"> 
                            <span class="select">
                                <select class="group language-selelct" name="language">
                                  <option value=""><?php esc_html_e('Select language','docdirect');?></option>
                                  <?php 
                                	if( isset( $languages_array ) && !empty( $languages_array ) ){
                                    
                                    foreach( $languages_array as $key=>$value ){
                                        $selected	= '';
                                        if( isset( $_GET['language'] ) && $_GET['language'] == $key ){
                                            $selected	= 'selected';
                                        }
                                        ?>
                                    <option <?php echo esc_attr( $selected );?> value="<?php echo esc_attr( $key );?>"><?php echo esc_attr( $value );?></option>
                                <?php }}?>
                                </select>
                            </span> 
                        </div>
                    </div>
                    <?php }?>
                    <div class="col-md-12 col-sm-6 col-xs-6">
                      <div class="form-group"> 
                        <span class="select">
                            <select class="directory_type" name="directory_type">
                              <option value=""><?php esc_html_e('Category','docdirect');?></option>
                              <?php
                                $parent_categories['categories']	= array();
								if( !empty( $_GET['directory_type'] ) ) {
									$first_category = docdirect_get_page_by_slug( $_GET['directory_type'], 'directory_type','id' );
								} else{
									$first_category = '';
								}
				
                                $json			= array();
                                $directories	 = '';
                                if( isset( $cust_query ) && !empty( $cust_query ) ) {
                                  $counter	= 0;
                                  
                                  foreach ($cust_query as $key => $dir) {
                                    $counter++;
                                    $title = get_the_title($dir->ID);
                                    $dir_icon = fw_get_db_post_option($dir->ID, 'dir_icon', true);
                                    $dir_map_marker = fw_get_db_post_option($dir->ID, 'dir_map_marker', true);
                                    if( empty( $dir_icon ) ){
                                        $dir_icon	= 'icon-Hospitalmedicalsignalofacrossinacircle';
                                    }
                                    //Prepare categories
                                    if( isset( $dir->ID ) ){
                                        $attached_specialities = get_post_meta( $dir->ID, 'attached_specialities', true );
                                        $subarray	= array();
                                        if( isset( $attached_specialities ) && !empty( $attached_specialities ) ){
                                            foreach( $attached_specialities as $key => $speciality ){
                                                if( !empty( $speciality ) ) {
                                                    $term_data	= get_term_by( 'id', $speciality, 'specialities');
                                                    if( !empty( $term_data ) ) {
                                                        $subarray[$term_data->slug] = $term_data->name;
                                                    }
                                                }
                                            }
                                        }
                                        
                                        $json[$dir->ID]	= $subarray;
                                    }
                                    
                                    
                                    $parent_categories['categories']	= $json;
                                    
                                    $selected	= '';
									
									if( !empty( $_GET['directory_type'] ) ) {
										$directory_check = docdirect_get_page_by_slug( $_GET['directory_type'], 'directory_type','id' );
									} else{
										$directory_check = '';
									}
								
                                    if( isset( $directory_check ) && $directory_check == $dir->ID ){
                                        $selected	= 'selected';
                                    }
                                    ?>
                                    <option <?php echo esc_attr( $selected );?> data-dir_name="<?php echo esc_attr( $title );?>" id="<?php echo intval( $dir->ID );?>" value="<?php echo esc_attr( $dir->post_name );?>"><?php echo esc_attr( ucwords( $title ) );?></option>
                                    <?php	
                                  }
                                }
                             ?>	
                            </select>
                        </span> 
                             <script>
                                jQuery(document).ready(function() {
                                    var Z_Editor = {};
                                    Z_Editor.elements = {};
                                    window.Z_Editor = Z_Editor;
                                    Z_Editor.elements = jQuery.parseJSON( '<?php echo addslashes(json_encode(  $parent_categories['categories']));?>' );
									
                                });
                            </script> 
                            <script type="text/template" id="tmpl-load-subcategories">
								<option value="">{{data['parent']}} - <?php esc_html_e('Specialities','docdirect');?></option>
								<#
									var _option	= '';
									if( !_.isEmpty(data['childrens']) ) {
										_.each( data['childrens'] , function(element, index, attr) { #>
											 <option value="{{index}}">{{element}}</option>
										<#	
										});
									}
								#>
							</script> 
                       </div>
                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-6">
                        <div class="form-group"> 
                            <span class="select">
                                <select class="group subcats" name="speciality">
                                  <option value=""><?php esc_html_e('Select Speciality','docdirect');?></option>
                                  <?php 
                                    if( isset( $first_category ) ){
                                        $attached_specialities = get_post_meta( $first_category, 'attached_specialities', true );
                                        if( isset( $attached_specialities ) && !empty( $attached_specialities ) ){
                                            $current_speciality	= isset( $_GET['speciality'] ) ? $_GET['speciality'] : '';
                                            foreach( $attached_specialities as $key => $speciality ){
                                                if( !empty( $speciality ) ) {
                                                    $term_data	= get_term_by( 'id', $speciality, 'specialities');
                                                    
                                                    $selected	= '';
                                                    if( $term_data->slug == $current_speciality ){
                                                        $selected	= 'selected';
                                                    }
                                                    
                                                    if( !empty( $term_data ) ) {?>
                                                        <option <?php echo esc_attr( $selected );?> value="<?php echo esc_attr( $term_data->slug );?>"><?php echo esc_attr( $term_data->name );?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </span> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <button type="submit" class="tg-btn pull-left"><?php esc_html_e('Search','docdirect');?></button>
                      <input type="hidden" name="view" value="<?php echo isset( $_GET['view'] ) ? $_GET['view'] : '';?>" />
                    </div>
					<div class="col-sm-6 col-xs-6">
                      <button type="reset" class="tg-btn tg-btn-reset pull-right"> <i class="fa fa-rotate-left"></i> <span><?php esc_html_e('Reset','docdirect');?></span> </button>
                    </div>
                  </div>
                </fieldset>
            </div>
          </div>
      </div>
      <div class="col-md-8 col-sm-12 col-xs-12 pull-right">
      	<div class="tg-doctors-list tg-haslayout">
        	<div class="tg-doclisthead">
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-6">
                  <div class="form-group"> 
                    <span class="select">
                        <select class="group sort_by" name="sort_by" id="sort_by">
                          <option value=""><?php esc_html_e('Sort By','docdirect');?></option>
                          <option value="recent" <?php echo isset( $_GET['sort_by'] ) && $_GET['sort_by'] == 'recent' ? 'selected' : '';?>><?php esc_html_e('Most recent','docdirect');?></option>
                          <option value="featured" <?php echo isset( $_GET['sort_by'] ) && $_GET['sort_by'] == 'featured' ? 'selected' : '';?>><?php esc_html_e('Featured','docdirect');?></option>
                          <option value="title" <?php echo isset( $_GET['sort_by'] ) && $_GET['sort_by'] == 'title' ? 'selected' : '';?>><?php esc_html_e('Alphabetical','docdirect');?></option>
                        </select>
                    </span> 
                   </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                  <div class="form-group"> 
                    <span class="select">
                        <select class="group order_by" name="order" id="order">
                          <option value="ASC" <?php echo isset( $_GET['order'] ) && $_GET['order'] == 'ASC' ? 'selected' : '';?>><?php esc_html_e('ASC','docdirect');?></option>
                          <option value="DESC" <?php echo isset( $_GET['order'] ) && $_GET['order'] == 'DESC' ? 'selected' : '';?>><?php esc_html_e('DESC','docdirect');?></option>
                        </select>
                    </span> 
                   </div>
                </div>
                <div class="col-md-6 col-sm-4 col-xs-12">
                  <ul class="tg-listing-views">
                    <li class="<?php echo isset( $dir_search_view ) && $dir_search_view === 'grid' ? 'active' : '';?>"><a href="javascript:;" class="grid"><i class="fa fa-th-large"></i></a></li>
                    <li class="<?php echo isset( $dir_search_view ) && $dir_search_view === 'list' ? 'active' : '';?>"><a href="javascript:;" class="list"><i class="fa fa-th-list"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
      	<div class="tg-view <?php echo sanitize_html_class( $listing_view );?>">
          <div class="row">
          	<?php
				global $paged;
				$limit = $per_page;
				if (empty($paged)) $paged = 1;
			    $offset = ($paged - 1) * $limit;
				
				$json	= array();
				$directories	= array();
				$meta_query_args = array();
				
				if( !empty( $_GET['directory_type'] ) ) {
					$directory_type = docdirect_get_page_by_slug( $_GET['directory_type'], 'directory_type','id' );
				} else{
					$directory_type = '';
				}
				
				$speciality 	 = isset( $_GET['speciality'] ) ? $_GET['speciality'] : '';
				$zip			= isset( $_GET['zip'] ) ? $_GET['zip'] : '';
				$location	   = isset( $_GET['location'] ) ? $_GET['location'] : '';
				$by_name		= isset( $_GET['by_name'] ) ? $_GET['by_name'] : '';
				$language	   = isset( $_GET['language'] ) ? $_GET['language'] : '';
				
				
				//Order
				$order	= 'DESC';
				if( isset( $_GET['order'] ) && !empty( $_GET['order'] ) ){
					$order	= $_GET['order'];
				}
				
				$sorting_order	= 'ID';
				if( $sort_by === 'recent' ){
					$sorting_order	= 'ID';
				} else if( $sort_by === 'recent' ){
					$sorting_order	= 'display_name';
				}
				
				$query_args	= array(
									'role'  => 'professional',
									'order' => $order,
									'orderby' => $sorting_order,
									//'number'    => $per_page,
									//'offset' => $offset,
								 );
				
				//Search By Keywords
				if( isset( $_GET['by_name'] ) && !empty( $_GET['by_name'] ) ){
					$s = sanitize_text_field($_GET['by_name']);
					//$query_args['search'] = $s;
					$search_args	= array(
											'search'         => '*'.esc_attr( $s ).'*',
											'search_columns' => array(
												'ID',
												'display_name',
												'user_login',
												'user_nicename',
												'user_email',
												'user_url',
											)
										);
					
					//$query_args	= array_merge( $query_args, $search_args );
					
					$meta_by_name = array('relation' => 'OR',);
					$meta_by_name[] = array(
											'key' 	   => 'first_name',
											'value' 	 => $s,
											'compare'   => 'LIKE',
										);
					
					$meta_by_name[] = array(
											'key' 	   => 'last_name',
											'value' 	 => $s,
											'compare'   => 'LIKE',
										);
					
					$meta_by_name[] = array(
											'key' 	   => 'nickname',
											'value' 	 => $s,
											'compare'   => 'LIKE',
										);
					
					$meta_by_name[] = array(
									'key' 	   => 'username',
									'value' 	 => $s,
									'compare'   => 'LIKE',
								);
								
					
					$meta_by_name[] = array(
									'key' 	   => 'description',
									'value' 	 => $s,
									'compare'   => 'LIKE',
								);
											
					if( !empty( $meta_by_name ) ) {
						$meta_query_args[]	= array_merge( $meta_by_name,$meta_query_args );
					}
					
				}

				//Search Featured
				if( $sort_by === 'featured' ){
					$query_args['meta_key']	  = 'user_featured';
					$query_args['orderby']	   = 'meta_value';	
				}	
				
				//Directory Type Search
				if( isset( $directory_type ) && !empty( $directory_type ) ){
					$meta_query_args[] = array(
											'key' 	   => 'directory_type',
											'value' 	 => $directory_type,
											'compare'   => '=',
										);
				}
				
				//Zip Search
				if( isset( $zip ) && !empty( $zip ) ){
					$meta_query_args[] = array(
											'key'     => 'zip',
											'value'   => $zip,
											'compare' => '='
										);
				}
				
				//Location Search
				if( isset( $location ) && !empty( $location ) ){
					$meta_query_args[] = array(
											'key'     => 'location',
											'value'   => $location,
											'compare' => '='
										);
				}
				
				//Language Search
				if( isset( $language ) && !empty( $language ) ){
					$meta_query_args[] = array(
											'key'     => 'languages',
											'value'   => $language,
											'compare' => 'LIKE'
										);
				}
				
				//Speciality Search
				if( isset( $speciality ) && !empty( $speciality ) ){
					$meta_query_args[] = array(
											'key'     => $speciality,
											'value'   => $speciality,
											'compare' => '='
										);
				}
				
				
				//Verify user
				$meta_query_args[] = array(
											'key'     => 'verify_user',
											'value'   => 'on',
											'compare' => '='
										);
										
				if( !empty( $meta_query_args ) ) {
					$query_relation = array('relation' => 'AND',);
					$meta_query_args	= array_merge( $query_relation,$meta_query_args );
					$query_args['meta_query'] = $meta_query_args;
				}
									
				//Radius Search
				if( (isset($_GET['geo_location']) && !empty($_GET['geo_location'])) ){
					
					$Latitude   = '';
					$Longitude  = '';
					$prepAddr   = '';
					$minLat	 = '';
					$maxLat	 = '';
					$minLong	= '';
					$maxLong	= '';
					
					if( isset( $_GET['geo_distance'] ) && !empty( $_GET['geo_distance'] ) ){
						$radius = $_GET['geo_distance'];
					} else{
						$radius = 300;
					}
				
					$address	 = sanitize_text_field($_GET['geo_location']);
					$prepAddr	= str_replace(' ','+',$address);
					
					$args = array(
						'timeout'     => 15,
						'headers' => array('Accept-Encoding' => ''),
						'sslverify' => false
					);
					
					/*if( isset( $google_key ) && !empty( $google_key ) ){
						$url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$google_key.'&address='.$prepAddr.'&sensor=true';
					} else{
						$url	 = 'http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false';
					}*/
					
					$url	 = 'http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false';
					$response   = wp_remote_get( $url, $args );
					$geocode	= wp_remote_retrieve_body($response);

					$output	  = json_decode($geocode);
					if( isset( $output->results ) && !empty( $output->results ) ) {
						$Latitude	= $output->results[0]->geometry->location->lat;
						$Longitude   = $output->results[0]->geometry->location->lng;

						if(isset($Latitude) && $Latitude <> '' && isset($Longitude) && $Longitude <> ''){
							$zcdRadius = new RadiusCheck($Latitude,$Longitude,$radius);
							$minLat  = $zcdRadius->MinLatitude();
							$maxLat  = $zcdRadius->MaxLatitude();
							$minLong = $zcdRadius->MinLongitude();
							$maxLong = $zcdRadius->MaxLongitude();
						}
						
						$meta_query_args = array(
							'relation' => 'AND',
							 array(
								'relation' => 'OR',
								array(
									'key' 		=> 'location',
									'value'   	  => str_replace('+',' ',$prepAddr),
									'compare' 	=> 'LIKE',
								),
								array(
									'relation' => 'AND',
									array(
										'key' 		=> 'latitude',
										'value'  	  => array($minLat, $maxLat),
										'compare' 	=> 'BETWEEN',
										'type'       => 'DECIMAL'
									),
									array(
										'key' 		=> 'longitude',
										'value'   	  => array($minLong, $maxLong),
										'compare' 	=> 'BETWEEN',
										'type'       => 'DECIMAL'
									)
								)
							),
						);
						
						if( isset( $query_args['meta_query'] ) && !empty( $query_args['meta_query'] ) ) {
							$meta_query	= array_merge($meta_query_args,$query_args['meta_query']);
						} else{
							$meta_query	= $meta_query_args;
						}

						$query_args['meta_query']	= $meta_query;
					}
				}

				$total_users = (int)count(get_users($query_args)); //Total Users
				
				$query_args['number']	= $limit;
				$query_args['offset']	= $offset;

				$user_query  = new WP_User_Query($query_args);
				
				if ( ! empty( $user_query->results ) ) {
					$directories['status']	= 'found';
					
					if( isset( $directory_type ) && !empty( $directory_type ) ) {
						$title = get_the_title($directory_type);
						$postdata = get_post($directory_type); 
						$slug 	 = $postdata->post_name;
					} else{
						$title = '';
						$slug = '';
					}

					foreach ( $user_query->results as $user ) {
						
						$latitude	   = get_user_meta( $user->ID, 'latitude', true);
						$longitude	  = get_user_meta( $user->ID, 'longitude', true);
						$directory_type = get_user_meta( $user->ID, 'directory_type', true);
						$dir_map_marker = fw_get_db_post_option($directory_type, 'dir_map_marker', true);
						$reviews_switch    = fw_get_db_post_option($directory_type, 'reviews', true);
						$featured_date  = get_user_meta($user->ID, 'user_featured', true);
						$current_date   = date('Y-m-d H:i:s');
						$avatar = apply_filters(
								'docdirect_get_user_avatar_filter',
								 docdirect_get_user_avatar(array('width'=>270,'height'=>270), $user->ID),
								 array('width'=>270,'height'=>270) //size width,height
							);
							
						$avatar_grid = apply_filters(
								'docdirect_get_user_avatar_filter',
								 docdirect_get_user_avatar(array('width'=>370,'height'=>200), $user->ID) ,
								 array('width'=>370,'height'=>200) //size width,height=
							);
							
						$privacy		= docdirect_get_privacy_settings($user->ID); //Privacy settin
						
						if( !empty( $latitude ) && !empty( $longitude ) ) {
							$directories_array['latitude']	 = $latitude;
							$directories_array['longitude']	= $longitude;
							$directories_array['fax']		  = $user->fax;
							$directories_array['description']  = $user->description;
							$directories_array['title']		= $user->display_name;
							$directories_array['name']	 	 = $user->first_name.' '.$user->last_name;
							$directories_array['email']	 	= $user->user_email;
							$directories_array['phone_number'] = $user->phone_number;
							$directories_array['address']	  = $user->address;
							$directories_array['group']		= $slug;
							$featured_string   = $featured_date;
							$current_string	= strtotime( $current_date );
							$review_data	= docdirect_get_everage_rating ( $user->ID );
							
							if( isset( $dir_map_marker['url'] ) && !empty( $dir_map_marker['url'] ) ){
								$directories_array['icon']	 = $dir_map_marker['url'];
							} else{
								$directories_array['icon']	 	   = get_template_directory_uri().'/images/map-marker.png';
							}
							
							$infoBox	= '<div class="tg-map-marker">';
							$infoBox	.= '<figure class="tg-docimg"><a class="userlink" href="'.get_author_posts_url($user->ID).'"><img src="'.esc_url( $avatar ).'" alt="'.esc_attr( $directories_array['name'] ).'"></a>';
							$infoBox	.= docdirect_get_wishlist_button($user->ID,false);
                
							if( isset( $featured_string ) && $featured_string > $current_string ){
								$infoBox	.= docdirect_get_featured_tag(false); 
							}
							
							$infoBox	.= docdirect_get_verified_tag(false,$user->ID);
							
							if( isset( $reviews_switch ) && $reviews_switch === 'enable' ){
								$infoBox	.= docdirect_get_rating_stars($review_data,'return');
							}
							
							$infoBox	.= '</figure>';
							
							$infoBox	.= '<div class="tg-mapmarker-content">';
							$infoBox	.= '<div class="tg-heading-border tg-small">';
							$infoBox	.= '<h3><a class="userlink" href="'.get_author_posts_url($user->ID).'">'.$directories_array['name'].'</a></h3>';
							$infoBox	.= '</div>';
							$infoBox	.= '<ul class="tg-info">';
							
							
							
							if( !empty( $directories_array['email'] ) 
								&&
								  !empty( $privacy['email'] )
								&& 
								  $privacy['email'] == 'on'
							) {
								$infoBox	.= '<li> <i class="fa fa-envelope"></i> <em><a href="mailto:'.$directories_array['email'].'?Subject=hello"  target="_top">'.$directories_array['email'].'</a></em> </li>';
							}
							
							if( !empty( $directories_array['phone_number'] ) 
								&&
								  !empty( $privacy['phone'] )
								&& 
								  $privacy['phone'] == 'on'
							) {
								$infoBox	.= '<li> <i class="fa fa-phone"></i> <em><a href="javascript:;">'.$directories_array['phone_number'].'</a></em> </li>';
							}
							
							if( !empty( $directories_array['address'] ) ) {
								$infoBox	.= '<li> <i class="fa fa-home"></i> <address>'.$directories_array['address'].'</address> </li>';
							}
							
							$infoBox	.= '</ul>';
							$infoBox	.= '</div>';
							$infoBox	.= '</div>';
							
							$directories_array['html']['content']	= $infoBox;
							$directories['users_list'][]	= $directories_array;

						?>
                            <article class="tg-doctor-profile user-<?php echo intval( $user->ID );?>">
                              <div class="tg-box">
                                <figure class="tg-docprofile-img">
                                    <a href="<?php echo get_author_posts_url($user->ID); ?>" class="list-avatar"><img src="<?php echo esc_attr( $avatar );?>" alt="<?php echo esc_attr( $directories_array['name'] );?>"></a>
                                    <a href="<?php echo get_author_posts_url($user->ID); ?>"  class="grid-avatar"><img src="<?php echo esc_attr( $avatar_grid );?>" alt="<?php echo esc_attr( $directories_array['name'] );?>"></a>
                                    
                                    <?php docdirect_get_wishlist_button($user->ID,true);?>
                                    <?php if( isset( $featured_string ) && $featured_string > $current_string ){?>
                                        <?php docdirect_get_featured_tag(true);?>
                                    <?php }?>
                                    <?php docdirect_get_verified_tag(true,$user->ID);?>
                                    <?php
									 if( isset( $reviews_switch ) && $reviews_switch === 'enable' ){
									 	docdirect_get_rating_stars($review_data,'echo');
									 }
									?>
                                </figure>
                                <div class="tg-docprofile-content">
                                  
                                  <div class="tg-heading-border tg-small">
                                    <h3><a href="<?php echo get_author_posts_url($user->ID); ?>"><?php echo esc_attr( $directories_array['name'] );?></a></h3>
                                  </div>
                                  <?php if( !empty( $directories_array['description'] ) ){?>
                                      <div class="tg-description">
                                        <p><?php echo substr($directories_array['description'], 0, 147);?></p>
                                      </div>
                                  <?php }?>
                                  <ul class="tg-doccontactinfo">
                                    <?php if( !empty( $directories_array['address'] ) ) {?>
                                        <li><i class="fa fa-map-marker"></i><address>
										<?php echo docdirect_prepare_address(35,$directories_array['address']);?></address></li>
                                    <?php }?>
                                    <?php if( !empty( $directories_array['phone_number'] ) 
											  &&
											  	!empty( $privacy['phone'] )
											  && 
											  	$privacy['phone'] == 'on'
										) {?>
                                        <li><i class="fa fa-phone"></i><span><?php echo esc_attr( $directories_array['phone_number'] );?></span></li>
                                    <?php }?>
                                    <?php if( !empty( $directories_array['email'] ) 
											  &&
											  	!empty( $privacy['email'] )
											  && 
											  	$privacy['email'] == 'on'
										) {?>
                                        <li><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo esc_attr( $directories_array['email']);?>?subject:<?php esc_html_e('Hello','docdirect');?>"><?php echo esc_attr( $directories_array['email']);?></a></li>
                                    <?php }?>
									<?php if( !empty( $directories_array['fax'] ) ) {?>
                                        <li><i class="fa fa-fax"></i><span><?php echo esc_attr( $directories_array['fax']);?></span></li>
                                    <?php }?>
                                    <?php if( !empty( $user->user_url ) ) {?>
                                    	<li><i class="fa fa-link"></i><a href="<?php echo esc_url( $user->user_url);?>"><?php echo esc_url( $user->user_url);?></a></li>
                                    <?php }?>
                                  </ul>
                                </div>
                              </div>
                            </article>
                    <?php }
					}
				 } else{?>
					<div class="col-xs-12"><?php DoctorDirectory_NotificationsHelper::informations(esc_html__('No Result Found.','docdirect'));?></div>
				<?php }?>
                <?php if( isset( $search_page_map ) && $search_page_map === 'enable' ){?>
				<script>
					jQuery(document).ready(function() {
						 /* Init Markers */
						docdirect_init_map_script(<?php echo json_encode( $directories );?>);
					});
				</script>
                <?php }?> 
          	</div>
            
        </div>
        <?php 
		//Pagination
		if( $total_users > $limit ) {?>
          <div class="tg-btnarea">
                <?php docdirect_prepare_pagination($total_users,$limit);?>
          </div>
        <?php }?>
      </div>
    </div>
   </form>
  </div>
</div>
	
<?php
get_footer();
