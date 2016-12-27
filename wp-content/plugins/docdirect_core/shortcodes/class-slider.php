<?php
/**
 * File Type: Slider
 */
if( ! class_exists('SC_Slider') ) {
	
	class SC_Slider {

		public function __construct() {
			add_shortcode('themographics_slider', array(&$this,'shortCodeCallBack' ) );
		}
		
		
		/**
		 * return Slider Data
		 *
		 */
        
		public function shortCodeCallBack( $args, $content = '' ) {
		   if( isset( $args['id'] ) && !empty( $args['id'] ) ){
				if(function_exists('fw_get_db_settings_option')) {
					 $this->tg_prepare_docdirect_v1($args['id']); 	
				} else{
					esc_html_e('Oops! No data Found.','docdirect_core');
				}
		   }
        }
		
		/**
		 * @Carousel Slider
		 * @return {HTML}
		 **/
		public function tg_prepare_docdirect_v1($id=''){
			 
			 $custom_classes	= fw_get_db_post_option($id, 'custom_classes', true);
			 $margin_top 		= fw_get_db_post_option($id, 'margin_top', true);
			 $margin_bottom 	= fw_get_db_post_option($id, 'margin_bottom', true);
			 $auto				= fw_get_db_post_option($id, 'auto', true);
			 $pagination		= fw_get_db_post_option($id, 'pagination', true);
			 $s1_slides			= fw_get_db_post_option($id, 'carousel_slides', true);

			$autoPlay	= 'true';
			 if( isset( $auto ) && $auto == 'disable' ) {
			 	 $autoPlay	= 'false';
			 }
			 
			 $navigation	= 'true';
			 if( isset( $pagination ) && $pagination == 'disable' ) {
			 	 $navigation	= 'false';
			 }

			 $flag	= fw_unique_increment();
			 $css	= array();
			 if( isset( $margin_top ) && !empty(  $margin_top ) ){
			 	$css[]	= 'margin-top:'.$margin_top.'px;';
			 }
			 
			 if( isset( $margin_bottom ) && !empty(  $margin_bottom ) ){
			 	$css[]	= 'margin-bottom:'.$margin_bottom.'px;';
			 }

			 $flag	= fw_unique_increment();

		     if( isset( $s1_slides ) && is_array( $s1_slides ) && !empty( $s1_slides ) ){
				 docdirect_init_owl_script();//OWL Carousel Init
			  ?>
			  <div class="system-banner  <?php echo ( $custom_classes );?>" style="<?php echo implode(' ', $css );?>">
				  <div id="tg-home-slider" class="tg-home-slider tg-haslayout">
					  <?php 
						$counter	= 0;
						foreach( $s1_slides  as $key => $value ) {
						$counter++;
							$slide_banner		=  $value['slide_banner'];
							$slide_title		=  $value['slide_title'];
							$button_title		=  $value['button_title'];
							$button_link		=  $value['button_link'];
							$description		=  $value['description'];
							$active	=  $counter == 1 ? 'active' : '';
							?>
											
							<div class="item">
								<div class="container">
									<div class="row">
										<div class="col-lg-10 col-lg-offset-1 col-xs-12">
											<div class="row">
												<?php if( isset( $value['slide_banner']['url'] ) && !empty( $value['slide_banner']['url'] ) ) {?>
													<div class="col-sm-5 col-xs-5 tg-verticalmiddle">
														<img class="floating" src="<?php echo esc_url( $value['slide_banner']['url'] );?>" alt="<?php echo esc_attr( $slide_title );?>">
													</div>
												<?php }?>
												<div class="col-sm-7 col-xs-7 tg-verticalmiddle tg-sliderwidth">
													<?php if( isset( $slide_title ) && !empty( $slide_title ) ) {?>
														<div class="tg-heading-border">
															<h1><?php echo force_balance_tags( $slide_title );?></h1>
														</div>
													<?php }?>
													<?php if( isset( $description ) && !empty( $description ) ) {?>
													<div class="tg-description">
														<p><?php echo do_shortcode( $description );?></p>
													</div>
													<?php }?>
													<?php if( isset( $button_title ) && !empty( $button_title ) ) {?>
														<a class="tg-btn active" href="<?php echo esc_url( $value['button_link'] );?>"><?php echo esc_attr( $button_title );?></a>
													<?php }?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						 <?php }?>
				 	</div>
					<script>
						jQuery(document).ready(function(e) {
							 jQuery("#tg-home-slider").owlCarousel({
								autoPlay: <?php echo esc_js( $autoPlay );?>,
								slideSpeed: 300,
								paginationSpeed: 400,
								singleItem: true,
								pagination: <?php echo esc_js( $navigation );?>,
								navigation: true,
								navigationText: [
									"<i class='tg-prev icon-direction196'></i>",
									"<i class='tg-next icon-pointer45'></i>"
								]
							});
						});
					</script>
				</div>
						 
			  
			  <?php
			 }
		}
	}
	
  	new SC_Slider();	
}