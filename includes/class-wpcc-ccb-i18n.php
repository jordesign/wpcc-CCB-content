<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that its ready for translation.
 *
 * @link       http://jaredcobb.com/wppc-ccb
 * @since      1.0
 *
 * @package    WPPC_CCB
 * @subpackage WPPC_CCB/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that its ready for translation.
 *
 * @since      1.0
 * @package    WPPC_CCB
 * @subpackage WPPC_CCB/includes
 * @author     WP Church Team <jordan@diakon.io>
 */
class WPPC_CCB_i18n extends WPPC_CCB_Plugin {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->plugin_name,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
