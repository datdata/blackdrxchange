<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://themographics.com
 * @since             1.0
 * @package           DocDirect
 *
 * @wordpress-plugin
 * Plugin Name:       DocDirect Core
 * Plugin URI:        http://themographics.com
 * Description:       This plugin is used for creating custom post types and other functionality for DocDirect Theme
 * Version:           1.8
 * Author:            Themographics
 * Author URI:        http://themeforest.net/user/themographics
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       docdirect_core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
if( !function_exists( 'activate_docdirect_core' ) ) {
	function activate_docdirect_core() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
		DocDirect_Activator::activate();
	}
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
if( !function_exists( 'deactivate_docdirect_core' ) ) {
	function deactivate_docdirect_core() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
		DocDirect_Deactivator::deactivate();
	}
}

register_activation_hook( __FILE__, 'activate_docdirect_core' );
register_deactivation_hook( __FILE__, 'deactivate_docdirect_core' );

/**
 * Plugin configuration file,
 * It include getter & setter for global settings
 */
require plugin_dir_path( __FILE__ ) . 'config.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-docdirect-core.php';

//Include Files
require_once( 'core/class-core.php' );
require_once( 'core/class-functions.php' );
require_once( 'import-users/class-import-user.php' );
require_once( 'import-users/class-readcsv.php' );
require_once( 'hooks/hooks.php');
require_once( 'shortcodes/class-slider.php');
require_once( 'shortcodes/class-registration.php');
require_once( 'libraries/recaptchalib/recaptchalib.php');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0
 */
if( !function_exists( 'run_DocDirect_Core' ) ) {
	function run_DocDirect_Core() {
		$plugin = new DocDirect_Core();
	}
	run_DocDirect_Core();
}
