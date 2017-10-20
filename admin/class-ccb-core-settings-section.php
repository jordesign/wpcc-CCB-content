<?php
/**
 * Everything related to the plugin settings sections
 *
 * @link       http://jaredcobb.com/ccb-core
 * @since      0.9.0
 *
 * @package    CCB_Core
 * @subpackage CCB_Core/admin
 */

/**
 * Object to manage the plugin settings sections
 *
 * @package    CCB_Core
 * @subpackage CCB_Core/admin
 * @author     Jared Cobb <wordpress@jaredcobb.com>
 */
class CCB_Core_Settings_Section extends CCB_Core_Plugin {

	/**
	 * The key for the section in the settings array
	 *
	 * @since    0.9.0
	 * @access   protected
	 * @var      string    $section_id
	 */
	protected $section_id;

	/**
	 * An array of field sections and their settings
	 *
	 * @since    0.9.0
	 * @access   protected
	 * @var      array    $section
	 */
	protected $section;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @access    public
	 * @since     0.9.0
	 * @return    void
	 */
	public function __construct( $section_id, $section ) {

		parent::__construct();

		$this->section_id = $section_id;
		$this->section = $section;

	}

	/**
	 * Render the About page content
	 *
	 * This unfortunately also renders a fake hidden credentials section that can
	 * be removed when Google decides to let Chrome behave.
	 *
	 * @access    public
	 * @since     0.9.0
	 * @return    void
	 */
	public function render_section_about() {

		// if the user has set their subdomain, use it for the url to w_group_list.php
		$settings = get_option( $this->plugin_settings_name );
		if ( isset( $settings['subdomain'] ) && ! empty( $settings['subdomain'] ) ) {
			$w_group_list = "<a href=\"https://{$settings['subdomain']}.ccbchurch.com/w_group_list.php\" target=\"_blank\">https://{$settings['subdomain']}.ccbchurch.com/w_group_list.php</a>";
		}
		else {
			$w_group_list = 'https://[yoursite].ccbchurch.com/w_group_list.php';
		}

		// this unfortunately includes a dirty hack to prevent chrome from autopopulating username/password
		// so this will inject a fake login panel because chrome ignores autocomplete="off"
		echo <<<HTML

			<span style="display:none;visibility:hidden"><input name="username" readonly /><input type="password" name="password" readonly /></span>

			<p>
				We need to write some content for this :)
			</p>

			<h4>Why Use This Plugin?</h4>

			
HTML;
	}

	/**
	 * Render the other section titles
	 *
	 * @access    public
	 * @since     0.9.0
	 * @return    void
	 */
	public function render_section() {
		if ( $this->section_id == 'about' ) {
			echo $this->render_section_about();
		}
	}

}
