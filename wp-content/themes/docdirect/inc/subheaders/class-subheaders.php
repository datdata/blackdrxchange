<?php
/**
 * @Class subheaders
 *
 */
if( !class_exists( 'docdirect_subheaders' ) ){
	class docdirect_subheaders{
		
		function __construct(){
			add_action('docdirect_prepare_subheaders',array(&$this,'docdirect_prepare_subheaders'));
		}
		
		/**
		 * @prepare subheaders
		 * @return {}
		 */
		public function docdirect_prepare_subheaders($post_id='') {
			global $post;
			
			if (class_exists('woocommerce')) {
				if( is_shop() ) {
					$page_id = woocommerce_get_page_id( 'shop' );
				} else{
					$page_id = get_the_ID();
				}
			} else{
				if( is_home() ){
					$page_id = '';
				} else{
					$page_id = get_the_ID();
				}
			}
			
			if( is_author() ){
				return false;
			}
			
			if( is_404() || is_archive() || is_search() || is_category() || is_tag() ) {
				$this->docdirect_prepare_custom_subheader('');
			} else {
				if(function_exists('fw_get_db_settings_option')){
					if( is_home() ){
						$this->docdirect_prepare_custom_subheader($page_id);
					} else{
						$enable_subheader 		= fw_get_db_post_option($page_id, 'enable_subheader', true);
						$subheader_type 		= fw_get_db_post_option($page_id, 'subheader_type', true);
	
						if( isset( $enable_subheader ) && $enable_subheader == '1' ) { 
							$enable_subheader	= 'enable';
						}
						
						if( isset( $enable_subheader ) && $enable_subheader === 'enable') {
							if(  isset( $subheader_type['gadget'] ) && $subheader_type['gadget'] === 'tg_slider' && !empty( $subheader_type['tg_slider']['sub_shortcode'] )){
								echo '<div class="docdirect-system-banner">';
								echo do_shortcode( '[themographics_slider id="'.$subheader_type['tg_slider']['sub_shortcode'].'"]' );
								echo '</div>';
							} else if(  isset( $subheader_type['gadget'] ) && $subheader_type['gadget'] === 'rev_slider' && !empty( $subheader_type['rev_slider']['rev_slider'] )){
								echo '<div class="docdirect-system-banner">';
								echo do_shortcode( '[rev_slider '.$subheader_type['rev_slider']['rev_slider'].']' );
								echo '</div>';
							}else if(  isset( $subheader_type['gadget'] ) && $subheader_type['gadget'] === 'custom_shortcode' && !empty( $subheader_type['custom_shortcode']['custom_shortcode'] )){
								echo '<div class="docdirect-system-banner">';
								echo do_shortcode( $subheader_type['custom_shortcode']['custom_shortcode'] );
								echo '</div>';
							} else{
								$this->docdirect_prepare_custom_subheader($page_id);
							}
						}
					}
				} else{
					$this->docdirect_prepare_custom_subheader($page_id);
				} 
			}
		}

		/**
		 * @prepare Custom Subheader
		 * @return {}
		 */
		 public function docdirect_prepare_custom_subheader($page_id='') {
			global $post;
			
			if( is_404() || is_archive() || is_search() || is_category() || is_tag() ) {
			
				if(function_exists('fw_get_db_settings_option')){
					$sub_header_bg 			= fw_get_db_settings_option('sub_header_bg', '#f7f7f7');
					$subheader_bg_image 	= fw_get_db_settings_option('subheader_bg_image', get_template_directory_uri().'/images/subheader.jpg');
					$enable_breadcrumbs 	= fw_get_db_settings_option('enable_breadcrumbs', '');
				}else{
					$sub_header_bg 			= '#f7f7f7';
					$subheader_bg_image 	= '';
					$enable_breadcrumbs 	= '';
				}
				
				$background_image	= '';
				$bg_color		= '';
				
				if( isset( $subheader_bg_image['url'] ) && !empty( $subheader_bg_image['url'] ) ) {
					$background_image	= 'data-image-src="'.$subheader_bg_image['url'].'"';
				} else if( isset( $subheader_bg_image ) && !empty( $subheader_bg_image ) ) {
					$background_image	= 'data-image-src="'.$subheader_bg_image.'"';
				}
				
				if( isset( $sub_header_bg ) && !empty( $sub_header_bg ) ) {
					$bg_color	= 'style="background:'.$sub_header_bg.'"';
				}
				
				if( is_404() ) {
                                        
					if(function_exists('fw_get_db_settings_option')){
						$title = fw_get_db_settings_option('404_heading', '404');
					}else{
						$title = esc_html__('404', 'docdirect');
					}
							
				} elseif (class_exists('woocommerce')) {
					if( is_shop() ) {
						$page_id = woocommerce_get_page_id( 'shop' );
						$title	= get_the_title( $page_id );
					} elseif( is_product_category() ) {
						$obj 	= get_queried_object();
						$title	= $obj->name;
					} else{
						$title	= get_the_title( $page_id );
					}
				}else if( is_archive()) {
					if(function_exists('fw_get_db_settings_option')){
						$title 	= fw_get_db_settings_option('archives_heading', 'Archives');
					}else{
						$title = esc_html__('Archive', 'docdirect');
					}
					
				} else if( is_search()) {
				
					if(function_exists('fw_get_db_settings_option')){
						$title 	= fw_get_db_settings_option('search_heading', 'Search');
					}else{
					
						$title = esc_html__('Search', 'docdirect');
					}	
				}	
					
			} else{
					if (class_exists('woocommerce')) {
						if( is_shop() ) {
							$page_id = woocommerce_get_page_id( 'shop' );
						} else{
							$page_id = get_the_ID();
						}
					} else{
						if( is_home() ){
							$page_id = '';
						} else{
							$page_id = get_the_ID();
						}
						
					}
					
					$subheader_type	= '';
					
					if(function_exists('fw_get_db_settings_option')){	
						$subheader_type 		= fw_get_db_post_option($page_id, 'subheader_type', true);
					
						if(  isset( $subheader_type['gadget'] ) && ( $subheader_type['gadget'] === 'custom' ) ){
							$sub_header_bg 			= $subheader_type['custom']['enable_breadcrumbs'];
							$subheader_bg_image 	= $subheader_type['custom']['subheader_bg_image'];
							$enable_breadcrumbs 	= $subheader_type['custom']['enable_breadcrumbs'];
						} else {
							$sub_header_bg 			= fw_get_db_settings_option('sub_header_bg', '#f7f7f7');
							$subheader_bg_image 	= fw_get_db_settings_option('subheader_bg_image', get_template_directory_uri().'/images/subheader.jpg');
							$enable_breadcrumbs 	= fw_get_db_settings_option('enable_breadcrumbs', '');
						}
					}else{
						$sub_header_bg 			= '#f7f7f7';
						$subheader_bg_image 	= '';
						$enable_breadcrumbs 	= '';
					}
					
					$background_image	= '';
					$bg_color			= '';
					if( isset( $subheader_bg_image['url'] ) && !empty( $subheader_bg_image['url'] ) ) {
						$background_image	= 'data-image-src="'.$subheader_bg_image['url'].'"';
					} 
					
					if( isset( $sub_header_bg ) && !empty( $sub_header_bg ) ) {
						$bg_color	= 'style="background:'.$sub_header_bg.'"';
					}
					
					if( is_home() ){
						$title = esc_html__('Home', 'docdirect');
					} else{
						$title	= get_the_title( $page_id );
					}
					
			}
			?>
			<div id="tg-innerbanner" class="tg-innerbanner tg-bglight tg-haslayout">
				<div class="tg-pagebar tg-haslayout">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<h1><?php echo  esc_attr( $title );?></h1>
								<?php
									if( isset( $enable_breadcrumbs ) && $enable_breadcrumbs === 'enable' ) {
										if( function_exists('fw_ext_breadcrumbs') ) { fw_ext_breadcrumbs(''); }
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
			
		}
	}
	
	new docdirect_subheaders();
}