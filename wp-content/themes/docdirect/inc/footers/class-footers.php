<?php
/**
 * @Class footers
 *
 */
if (!class_exists('docdirect_footers')) {

    class docdirect_footers {

        function __construct() {
            add_action('docdirect_prepare_footers', array(&$this, 'docdirect_prepare_footer'));
        }

        /**
         * @Prepare Top Strip
         * @return {}
         */
        public function docdirect_prepare_footer() {
			$footer_copyright		= '&copy;'.date('Y').esc_html__(' | All Rights Reserved ','docdirect').get_bloginfo();
			$enable_widget_area	= '';
			$enable_resgistration		= '';
			$enable_login		= '';
			
			if(function_exists('fw_get_db_settings_option')) {
				$enable_widget_area	= fw_get_db_settings_option('enable_widget_area', $default_value = null);
				$footer_copyright 	= fw_get_db_settings_option('footer_copyright', $default_value = null);
				$enable_resgistration = fw_get_db_settings_option('registration', $default_value = null);
				$enable_login = fw_get_db_settings_option('enable_login', $default_value = null);
			}
			?>
			</main>
			<footer id="footer" class="tg-haslayout">
				<?php if(isset( $enable_widget_area ) && $enable_widget_area ==='on' ) {?>
					<div class="tg-threecolumn">
						<div class="container">
							<div class="row">
								<?php if ( is_active_sidebar( 'footer-column-1' ) ) { ?>
									<div class="col-sm-4">
										<div class="tg-footercol"><?php dynamic_sidebar( 'footer-column-1' ); ?></div>
									</div>
								<?php } ?>
								<?php if ( is_active_sidebar( 'footer-column-2' ) ) { ?>
									<div class="col-sm-4">
										<div class="tg-footercol"><?php dynamic_sidebar( 'footer-column-2' ); ?></div>
									</div>
								<?php } ?>
								<?php if ( is_active_sidebar( 'footer-column-3' ) ) { ?>
									<div class="col-sm-4">
										<div class="tg-footercol"><?php dynamic_sidebar( 'footer-column-3' ); ?></div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php }?>
				<?php if(isset( $footer_copyright ) && $footer_copyright !='' ) {?>
				<div class="tg-footerbar tg-haslayout">
					<div class="tg-copyrights">
						<p><?php echo  force_balance_tags( $footer_copyright );?></p>
					</div>
				</div>
				<?php }?>
			</footer>
			<?php if( ( isset( $enable_login ) && $enable_login === 'enable' ) 
						||  ( isset( $enable_resgistration ) && $enable_resgistration === 'enable' ) 
				  ) {
				do_shortcode('[user_authentication]'); //Code Moved To due to plugin territory
 			}?>
		</div>
        <?php 
		}
		
    }

    new docdirect_footers();
}