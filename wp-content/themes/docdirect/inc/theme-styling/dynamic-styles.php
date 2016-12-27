<?php
if (function_exists('fw_get_db_settings_option')) {
    $theme_type = fw_get_db_settings_option('theme_type');
    $theme_color = fw_get_db_settings_option('theme_color');
    $body_background_color = fw_get_db_settings_option('background_color');
    $enable_typo = fw_get_db_settings_option('enable_typo');
    $background = fw_get_db_settings_option('background');
    $custom_css = fw_get_db_settings_option('custom_css');
    $body_font = fw_get_db_settings_option('body_font');
    $h1_font = fw_get_db_settings_option('h1_font');
    $h2_font = fw_get_db_settings_option('h2_font');
    $h3_font = fw_get_db_settings_option('h3_font');
    $h4_font = fw_get_db_settings_option('h4_font');
    $h5_font = fw_get_db_settings_option('h5_font');
    $h6_font = fw_get_db_settings_option('h6_font');
}
?>

<style>

    <?php echo (isset($custom_css)) ? $custom_css : ''; ?>

    <?php if (isset($enable_typo) && $enable_typo == 'on') { ?>
        body,p,ul,li {
            font-size:<?php echo (isset($body_font['size'])) ? $body_font['size'] : '100%'; ?>px;
            font-family:<?php echo (isset($body_font['family'])) ? $body_font['family'] : 'Lato'; ?>;
            font-style:<?php echo (isset($body_font['style'])) ? $body_font['style'] : ''; ?>;
            color:<?php echo (isset($body_font['color'])) ? $body_font['color'] : '#000'; ?>;
        }
        h1{
            font-size:<?php echo (isset($h1_font['size'])) ? $h1_font['size'] : ''; ?>px;
            font-family:<?php echo (isset($h1_font['family'])) ? $h1_font['family'] : ''; ?>;
            font-style:<?php echo (isset($h1_font['style'])) ? $h1_font['style'] : ''; ?>;
            color:<?php echo (isset($h1_font['color'])) ? $h1_font['color'] : ''; ?>;
        }
        h2{
            font-size:<?php echo (isset($h2_font['size'])) ? $h2_font['size'] : ''; ?>px;
            font-family:<?php echo (isset($h2_font['family'])) ? $h2_font['family'] : ''; ?>;
            font-style:<?php echo (isset($h2_font['style'])) ? $h2_font['style'] : ''; ?>;
            color:<?php echo (isset($h2_font['color'])) ? $h2_font['color'] : ''; ?>;
        }
        h3{font-size:<?php echo (isset($h3_font['size'])) ? $h3_font['size'] : ''; ?>px;
           font-family:<?php echo (isset($h3_font['family'])) ? $h3_font['family'] : ''; ?>;
           font-style:<?php echo (isset($h3_font['style'])) ? $h3_font['style'] : ''; ?>;
           color:<?php echo (isset($h3_font['color'])) ? $h3_font['color'] : ''; ?>;
        }
        h4{font-size:<?php echo (isset($h4_font['size'])) ? $h4_font['size'] : 'Lato'; ?>px;
           font-family:<?php echo (isset($h4_font['family'])) ? $h4_font['family'] : 'Lato'; ?>;
           font-style:<?php echo (isset($h4_font['style'])) ? $h4_font['style'] : 'Lato'; ?>;
           color:<?php echo (isset($h4_font['color'])) ? $h4_font['color'] : 'Lato'; ?>;
        }
        h5{font-size:<?php echo (isset($h5_font['size'])) ? $h5_font['size'] : 'Lato'; ?>px;
           font-family:<?php echo (isset($h5_font['family'])) ? $h5_font['family'] : 'Lato'; ?>;
           font-style:<?php echo (isset($h5_font['style'])) ? $h5_font['style'] : 'Lato'; ?>;
           color:<?php echo (isset($h5_font['color'])) ? $h5_font['color'] : 'Lato'; ?>;
        }
        h6{font-size:<?php echo (isset($h6_font['size'])) ? $h6_font['size'] : 'Lato'; ?>px;
           font-family:<?php echo (isset($h6_font['family'])) ? $h6_font['family'] : 'Lato'; ?>;
           font-style:<?php echo (isset($h6_font['style'])) ? $h6_font['style'] : 'Lato'; ?>;
           color:<?php echo (isset($h6_font['color'])) ? $h6_font['color'] : 'Lato'; ?>;
        }	
    <?php } ?>
    <?php if (isset($theme_type) && $theme_type === 'custom') { ?>

        /* =============================================
                                        new color css 
                ============================================= */
        <?php if (isset($body_background_color) && $body_background_color != '') { ?>
            body{background-color:<?php echo esc_attr($body_background_color); ?> !important;}
        <?php } ?>

        /*Body Text Color End*/
        <?php if (isset($theme_color) && $theme_color != '') { ?>
				.tg-btn:after,
				.tg-tabs-nav li input[type="radio"]:checked + label .tg-category-name:after,
				.tg-tabs-nav li label:hover .tg-category-name:after,
				.tg-tabs-nav li label:before,
				.tg-searchform .form-group button[type="submit"],
				.navbar-header .navbar-toggle,
				.tg-listing-views li.active a,
				.tg-listing-views li a:hover,
				.tg-listsorttype ul li a:hover,
				#comming-countdown li:last-child,
				.tg-pagination ul li a:hover,
				.tg-pagination ul li:first-child a:hover,
				.tg-pagination ul li:last-child a:hover,
				.tg-pagination ul li:first-child:after,
				.tg-pagination ul li:last-child:before,
				.tg-pagination ul li.active a,
				.tg-packages:hover,
				.tg-widget ul li a:hover i,
				.tg-reactivate .tg-btn,
				.tg-widget.tg-widget-accordions .panel.active .tg-panel-heading:after,
				.tg-widget.tg-widget-accordions .tg-panel-heading:hover:after,
				.tg-mapmarker-content .tg-heading-border:after,
				.tg-on-off .candlestick-wrapper .candlestick-bg .candlestick-toggle,
				.tg-table-hover .tg-edit,
				.tg-schedule-slider .owl-controls.clickable .owl-next:hover,
				.tg-schedule-slider .owl-controls.clickable .owl-prev:hover,
				.specialities-list ul li .tg-checkbox input[type="checkbox"]:checked + label,
				.specialities-list ul li .tg-checkbox input[type="radio"] + label,
				#confirmBox h1,
				#confirmBox .button:after,
				.geodistance_range .ui-slider-range,
				.tg-packageswidth .tg-checkbox input[type=checkbox]:checked + label,
				.tg-packageswidth .tg-checkbox input[type=radio]:checked + label,
				.pin,
				.tg-on-off i,	
				.tg-radiobox input[type="radio"]:checked + label,
				.tg-topbar .tg-login-logout,
				.tg-topbar .tg-login-logout:after,
				.tg-searcharea-v2 .tg-searchform select,
				.tg-features-listing > li:hover > .tg-main-features .tg-feature-head,
				.tg-featuredtags .tg-featured,
				.tg-btn-list:hover,
				.tg-homeslidertwo .tg-searcharea-v2 .tg-searchform .tg-btn,
				.tg-topbar .tg-login-logout:before,
				.tg-catagory a:hover,
				.tg-iosstylcheckbox input[type=checkbox]:checked + label,
				.tg-iosstylcheckbox label:before,
				.tg-navdocappointment li.active a:before,
				.tg-navdocappointment li:hover a:before,
				.tg-appointmenttime .tg-dayname,
				.tg-appointmenttime .tg-doctimeslot.tg-available .tg-box:hover,
				.tg-featureverified li.tg-featuresicon a,
				.tg-skillbar
				{background:<?php echo esc_attr($theme_color); ?>;}
				
				.make-appointment-btn{background:<?php echo esc_attr($theme_color); ?> !important;}
				.tg-banner-holder .tg-searcharea-v2 .tg-searchform .tg-btn,
				.chosen-container-multi .chosen-choices li.search-choice:hover{
					border-color:<?php echo esc_attr($theme_color); ?> !important;
					background:<?php echo esc_attr($theme_color); ?> !important;
				}
				
				.tg-on-off input:checked+label{box-shadow: inset 0 0 0 20px <?php echo esc_attr($theme_color); ?> !important;;}
				
				/*Theme Text Color*/
				a,
				p a,
				p a:hover,
				a:hover,
				a:focus,
				a:active,
				.tg-breadcrumb li a:hover,
				body h1,
				body h2,
				body h3,
				body h4,
				body h5,
				body h6,
				h1 a,
				h2 a,
				h3 a,
				h4 a,
				h5 a,
				h6 a,
				p a,
				.tg-nav ul li a:hover,
				.tg-tabs-nav li label:hover i,
				.tg-tabs-nav li input[type="radio"]:checked + label i,
				.form-searchdoctors h1 em,
				.tg-healthcareonthego ul li:after,
				.tg-findbycategory ul li:hover a,
				.tg-findbycategory ul li:hover:after,
				.tg-findbycategory ul li:last-child a,
				.tg-post .tg-description blockquote:before,
				.tg-post .tg-description blockquote:after,
				.tg-metadata li a:hover,
				.tg-info i,
				.tg-docinfo .tg-stars i,
				.tg-img-hover a,
				.tg-widget ul li .tg-docinfo a:hover,
				.tg-widget ul li a:hover,
				.tg-widget ul li:hover:after,
				.tg-docprofile-content h3 a:hover,
				.tg-contactus .tg-search-categories a:hover,
				.tg-tab-widget .tab-content .tg-stars i,
				.tg-ratingbox .tg-stars i,
				.tg-packages .tg-stars i,
				.tg-packages:hover .tg-featuredicon em,
				.tg-otherphotos h3 a:hover,
				.tg-addfield button:hover i,
				.tg-addfield button:hover span,
				.tg-post-detail .tg-post .tg-tags .tg-tag li a:hover,
				.tg-blog-grid .tg-post .tg-contentbox h3 a:hover,
				.tg-reviewcontet .comment-head h3 a:hover,
				.tg-support h3 a:hover,
				.tg-reviewcontet .comment-head .tg-stars i,
				.tg-widget ul li time,
				.tg-nav .navbar-collapse ul li a:hover,
				.tg-doceducation .tg-findbycategory ul li:hover a,
				.tg-login-logout li a:hover,
				.tg-packageswidth .tg-checkbox input[type=radio]:checked + label .tg-featuredicon em,
				.usercontactinfo .tg-doccontactinfo li:last-child a,
				.tg-userschedule ul li:hover span,
				.tg-userschedule ul li.current a span,
				.tg-userschedule ul li.current a em,
				.tg-userschedule ul li:hover em,
				.tg-userschedule ul li:hover span,
				.tg-userschedule a:hover span:after,
				.tg-userschedule li.current a span:after,
				.tg-login-logout li ul > li > a:hover,
				.tg-login-logout li ul > li > a:hover i,
				.tg-reviewhead .tg-reviewheadleft h3:hover a,
				.tg-averagerating em	
				{ color: <?php echo esc_attr($theme_color); ?>;}
				
				.tg-doctor-detail2 .tg-findbycategory ul li a:hover,
				.tg-stars.star-rating span:before,
				.docdirect-menu li.active a,
				.tg-sub-featured li:hover a span,
				.tg-sub-featured li:hover a em,
				.tg-listbox .tg-listdata h4 a:hover,
				.tg-homeslidertwo.owl-theme .owl-prev:hover i,
				.tg-homeslidertwo.owl-theme .owl-next:hover i,
				.tg-counter i,
				.tg-counter .timer,
				.tg-usercontactinfo .tg-doccontactinfo li:last-child a
				{color: <?php echo esc_attr($theme_color); ?> !important;}
			

				.tg-btn,
				.tg-nav ul li ul,
				.tg-theme-heading .tg-roundbox,
				.tg-threecolumn,
				.tg-show,
				.tg-searchform .form-group .tg-btn.tg-advance-search:hover,
				.tg-listsorttype ul li a:hover,
				.tg-featuredicon,
				.tg-tab-widget ul.tg-nav-tabs li.active a,
				.tg-tab-widget ul.tg-nav-tabs li a:hover,
				#confirmBox .button,
				.tg-packages:hover,
				.tg-form-modal .tg-radiobox input[type="radio"]:checked + label,
				.tg-pagination ul li a:hover,
				.geodistance_range .ui-slider-handle,
				.tg-nav-v2 > div > ul > li a:hover,
				.tg-nav-v2 > div > ul > li.active a,
				.tg-mapmarker figure,
				.tg-appointmenttime .tg-doctimeslot .tg-box, 
				.tg-appointmenttime .tg-doctimeslot.tg-available .tg-box:hover
				{border-color:<?php echo esc_attr($theme_color); ?>;}
				
				.geodistance_range .ui-slider-handle{border-color:<?php echo esc_attr($theme_color); ?> !important;}
				
				.tg-map-marker .tg-docimg .tg-show,
				.tg-docimg .tg-uploadimg{border-bottom-color: <?php echo esc_attr($theme_color); ?>;}
				.tg-login-logout li ul, 
				.tg-nav ul,
				.tg-login-logout li ul{border-top-color: <?php echo esc_attr($theme_color); ?> !important;}
				
				.pulse:after{
				  -webkit-box-shadow: 0 0 1px 2px <?php echo esc_attr($theme_color); ?>;
    			  box-shadow: 0 0 1px 2px <?php echo esc_attr($theme_color); ?>;
				}
			
        <?php } ?>
    <?php } ?>
</style>

