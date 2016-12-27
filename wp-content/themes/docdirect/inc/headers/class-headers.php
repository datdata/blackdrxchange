<?php
/**
 *@Class headers
 *@return html
 */
if (!class_exists('docdirect_headers')) {

    class docdirect_headers {

        function __construct() {
            add_action('docdirect_init_headers', array(&$this, 'docdirect_init_headers'));
			add_action('docdirect_prepare_headers', array(&$this, 'docdirect_prepare_header'));
        }

        /**
         * @Init Header
         * @return {}
         */
        public function docdirect_init_headers() {
			$post_name	= docdirect_get_post_name();
			if(function_exists('fw_get_db_settings_option')){
				$maintenance = fw_get_db_settings_option('maintenance');
				$preloader = fw_get_db_settings_option('preloader');
			} else {
				$maintenance = '';
				$preloader = '';
			}
			
			
			if ( isset($maintenance) && $maintenance == 'disable' ){
				if( isset( $preloader ) && $preloader === 'enable' ){?>
				 <div class="preloader-outer">
					  <div class="pin"></div>
					  <div class="pulse"></div>
				 </div>
			<?php }}?>
			<?php get_template_part('template-parts/template','comingsoon'); ?>
            <div id="wrapper" class="tg-haslayout">
                <header id="header" class="tg-haslayout tg-inner-header">
                     <?php do_action('docdirect_prepare_headers');?>
                </header>
                <?php do_action('docdirect_prepare_subheaders');?>
             <main id="main" class="tg-page-wrapper tg-haslayout">
            <?php
		}
		
	    /**
         * @Prepare Header Data
         * @return {}
         */
        public function docdirect_prepare_header() {
            global $post, $woocommerce;

			$main_logo		= '';
			$shoping_cart	= '';
			$lang			= '';
			$res_table_title	= '';
			$res_link			= '';
			
            if (function_exists('fw_get_db_settings_option')) {
				$main_logo = fw_get_db_settings_option('main_logo');
				$inner_logo = fw_get_db_settings_option('inner_logo');
				$shoping_cart = fw_get_db_settings_option('shoping_cart');
				$lang = fw_get_db_settings_option('lang');
				$registration = fw_get_db_settings_option('registration');
            }
			
			//fw_print($menu_type);
            ob_start();
			
				
			if (isset($main_logo['url']) && !empty($main_logo['url'])) {
				$logo = $main_logo['url'];
			} else {
				$logo = get_template_directory_uri() . '/images/logo.png';
			}
			
			?>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="tg-navigationarea">
                            <strong class="logo"><?php $this->docdirect_prepare_logo($logo,'','');?></strong>
                            <nav id="tg-nav" class="tg-nav">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                        <span class="sr-only"><?php esc_html_e('Toggle navigation','docdirect');?></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="tg-navigation">
                                    <?php $this->docdirect_prepare_navigation('main-menu', '', '', '0'); ?>
                                </div>
                            </nav>
                            <div class="doc-menu">
								<?php $this->docdirect_prepare_registration();?>
                            </div>
                            
                        </div>
					</div>
				</div>
			</div>
			<?php

            echo ob_get_clean();
        }
		
		/**
         * @Main Logo
         * @return {}
         */
        public function docdirect_prepare_registration() {
			global $current_user, $wp_roles,$userdata,$post;
			
			$enable_resgistration = '';
			$enable_login = '';
			
			if (function_exists('fw_get_db_settings_option')) {
				$enable_resgistration = fw_get_db_settings_option('registration');
				$enable_login = fw_get_db_settings_option('enable_login');
			}
			ob_start();
			$dir_obj	= new DocDirect_Scripts();
			
			if( $enable_login === 'enable' || $enable_resgistration === 'enable' ) {
			?>
			<ul class="tg-login-logout">
				<?php if( is_user_logged_in() ) {
						$user_identity	= $current_user->ID;
						$avatar = apply_filters(
							'docdirect_get_user_avatar_filter',
							 docdirect_get_user_avatar(array('width'=>150,'height'=>150), $user_identity) //size width,height
						);
						
						$first_name   		   = get_user_meta( $user_identity, 'first_name', true);
						$last_name   		    = get_user_meta( $user_identity, 'last_name', true);
						$display_name   		 = get_user_meta( $user_identity, 'display_name', true);
						
						if( !empty( $first_name ) ){
							$username	= $first_name;
						} else if( !empty( $last_name ) ){
							$username	= $last_name;
						} else{
							$username	= $display_name;
						}
					?>
					<li class="session-user-info"><a href="javascript:;"><span class="s-user"><?php echo esc_attr( $username );?></span><img alt="<?php esc_html_e('Welcome','docdirect');?>" src="<?php echo esc_url( $avatar );?>"></a><?php $dir_obj->docdirect_profile_menu('menu');?></li>
					<?php } else {?>
                    <li class="session-user-info">
                        <a href="javascript:;" data-toggle="modal" data-target=".tg-user-modal"><span class="s-user"><?php esc_html_e('Login/Register','docdirect');?></span><img alt="<?php esc_html_e('Login','docdirect');?>" src="<?php echo get_template_directory_uri() . '/images/singin_icon.png';?>"></a>
                        <span><a href="javascript:;" data-toggle="modal" data-target=".tg-user-modal"></a></span>
                     </li>
				<?php }?>
			</ul>
			<?php 
			}
			echo ob_get_clean();
		}
		
		/**
         * @Woo
         * @return {}
         */
        public function docdirect_shoping_cart($enable_woo='') {
			ob_start();
			global $woocommerce;
			?>
			<?php if (function_exists('is_woocommerce') && $enable_woo === 'enable') { ?>
				<div class="tg-minicart">
					<span class="cart-contents">
						<a id="tg-minicart-button" href="javascript:;">
							<i class="fa fa-cart-plus"></i>
							<span class="tg-badge"><?php echo intval($woocommerce->cart->cart_contents_count); ?></span>
						</a>
					</span>
					<div class="tg-minicart-box">
						<div class="widget_shopping_cart_content"></div>
					</div>
				</div>
			<?php } ?> 
			<?php 
			echo ob_get_clean();
		}
		
		/**
         * @Main Logo
         * @return {}
         */
        public function docdirect_prepare_logo($logo_url='',$image_classes='',$link_classes='') {
			ob_start();
			?>
			<a class="<?php echo esc_attr( $link_classes );?>" href="<?php echo esc_url(home_url('/')); ?>"><img class="<?php echo esc_attr( $image_classes );?>" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>"></a>
			<?php 
			echo ob_get_clean();
		}
		
        /**
         * @Main Navigation
         * @return {}
         */
        public static function docdirect_prepare_navigation($location = '', $id = 'menus', $class = '', $depth = '0') {

		   if ( has_nav_menu($location) ) {
                $defaults = array(
                    'theme_location' => "$location",
                    'menu' => '',
                    'container' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_class' => "$class",
                    'menu_id' => "$id",
                    'echo' => false,
                    'fallback_cb' => 'wp_page_menu',
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => "$depth",
                    //'walker' => new Doctor Directory_Menu_Walker
				);
                echo do_shortcode(wp_nav_menu($defaults));
            } else {
                $defaults = array(
                    'theme_location' => "",
                    'menu' => '',
                    'container' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_class' => "$class",
                    'menu_id' => "$id",
                    'echo' => false,
                    'fallback_cb' => 'wp_page_menu',
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => "$depth",
                    'walker' => '');
                echo do_shortcode(wp_nav_menu($defaults));
            }
        }

    }

    new docdirect_headers();
}