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
 * Description:       An addon plugin for WP Church Center that provides integration with your Church Community Builder account
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

define( 'wpccb_PLUGIN_PATH', dirname(__FILE__) );

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

// Settings in the Customizer
require_once plugin_dir_path( __FILE__ ) . 'customizer.php';

// ACF Fields
require_once plugin_dir_path( __FILE__ ) . 'fields.php';

//Load Filters for the new cards
// Coming Events
require_once plugin_dir_path( __FILE__ ) . 'cards/ccb_event_list.php';

// Next event
require_once plugin_dir_path( __FILE__ ) . 'cards/ccb_next_event.php';

// Specific event
require_once plugin_dir_path( __FILE__ ) . 'cards/ccb_specific_event.php';


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

//load stylesheet for CCB Cards
function wpccb_load_stylesheet() {
    // only enqueue on product-services page slug
    if ( get_post_type() == 'card' ) {
        wp_enqueue_style( 'wpccb-style', plugins_url( 'ccb_styles.css', __FILE__  ) );
        wp_enqueue_script( 'wpcc-scripts', plugins_url( 'ccb_script-min.js', __FILE__ ), array( 'jquery' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'wpccb_load_stylesheet' );

//Adding CSS inline style to an existing CSS stylesheet
function wpccb_add_inline_css() {

        //Get the Card's Colour Variable
    $cardColour = get_post_meta(get_the_ID(),'wpcc_color',true );
        //All the user input CSS settings as set in the plugin settings
        $wpccb_custom_css = "
            .wpccEventDate.dateCard .eventMonth,
            .cardInfo .wpccUpcomingEvent a.button {
                background: $cardColour;
            }
            .wpccEventDate.dateCard .eventDay {
                color: $cardColour;
            }
            .wpccEventTitle p i {
                 color: $cardColour;
            }
        ";
  //Add the above custom CSS via wp_add_inline_style
  wp_add_inline_style( 'wpccb-style', $wpccb_custom_css ); //Pass the variable into the main style sheet ID
}
add_action( 'wp_enqueue_scripts', 'wpccb_add_inline_css' ); //Enqueue the CSS style