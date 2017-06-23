<?php
/**
 * WP Church Center: CCB Addon
 *
 * @link              http://www.wpccb.com
 * @since             1.0
 * @package           WPPC_CCB
 *
 * @wordpress-plugin
 * Plugin Name:       WP Church Center: CCB Addon
 * Plugin URI:        http://www.wpchurch.center
 * Description:       An addon plugin for WP Church Center that provides integration with our CCB account
 * Version:           1.0
 * Author:            WP Church Team
 * Author URI:        http://wpchurch.team/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wppc-ccb
 * Domain Path:       /languages
 */

// do not allow direct access to this file
if ( ! defined( 'WPINC' ) ) {
	die;
}

// parent class for entire plugin (name, version, other helpful properties and utility methods)
require_once plugin_dir_path( __FILE__ ) . 'includes/class-wppc-ccb-plugin.php';

// code that runs during plugin activation
require_once plugin_dir_path( __FILE__ ) . 'includes/class-wppc-ccb-activator.php';
register_activation_hook( __FILE__, array( 'WPPC_CCB_Activator', 'activate' ) );

// internationalization, dashboard-specific hooks, and public-facing site hooks.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-wppc-ccb.php';

/**
 * Begin execution of the plugin.
 *
 * @since    1.0
 */
function run_WPPC_CCB() {

	$plugin_basename = plugin_basename( __FILE__ );
	$plugin = new WPPC_CCB( $plugin_basename );
	$plugin->run();

}
run_WPPC_CCB();
