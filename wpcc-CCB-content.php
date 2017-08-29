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
 * Description:       An addon plugin for WP Church Center that provides integration with your CCB account
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

/******* Add 'CCB Card' as an option  in the 'Card Type' field ******/
function wpcc_load_ccb_cards( $field ) {
             
    $field['choices'][ 'ccb' ] = 'CCB Content Card';
    return $field;   
}
add_filter('acf/load_field/name=wpcc_card_type', 'wpcc_load_ccb_cards');




/****** We use the CCB API plugin for our API stuff (with some adjustments) ********/
// parent class for entire plugin (name, version, other helpful properties and utility methods)
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ccb-core-plugin.php';

// code that runs during plugin activation
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ccb-core-activator.php';
register_activation_hook( __FILE__, array( 'CCB_Core_Activator', 'activate' ) );

// internationalization, dashboard-specific hooks, and public-facing site hooks.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ccb-core.php';

/**
 * Begin execution of the plugin.
 *
 * @since    0.9.0
 */
function run_ccb_core() {

	$plugin_basename = plugin_basename( __FILE__ );
	$plugin = new CCB_Core( $plugin_basename );
	$plugin->run();

}
run_ccb_core();