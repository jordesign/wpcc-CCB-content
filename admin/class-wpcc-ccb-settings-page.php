<?php
/**
 * Everything related to the plugin settings pages
 *
 * @link       http://jaredcobb.com/wppc-ccb
 * @since      1.0
 *
 * @package    WPPC_CCB
 * @subpackage WPPC_CCB/admin
 */

/**
 * Object to manage the plugin settings pages
 *
 * @package    WPPC_CCB
 * @subpackage WPPC_CCB/admin
 * @author     WP Church Team <jordan@diakon.io>
 */
class WPPC_CCB_Settings_Page extends WPPC_CCB_Plugin {

	/**
	 * The key for the page in the settings array
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      string    $section_id
	 */
	protected $page_id;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @access    public
	 * @since     1.0
	 * @return    void
	 */
	public function __construct( $page_id ) {

		parent::__construct();

		$this->page_id = $page_id;

	}

	/**
	 * Render the settings page template (used for all pages)
	 *
	 * @access    public
	 * @since     1.0
	 * @return    void
	 */
	public function render_page() {
		if ( ! current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.', $this->plugin_name ) );
		}
		?>

		<div class="wrap <?php echo $this->plugin_settings_name . '-wrapper ' . $this->page_id; ?>">
			<h2><?php echo $this->plugin_display_name; ?></h2>
			<?php settings_errors(); ?>
			<form action="options.php" method="post">

				<?php settings_fields( $this->page_id ); ?>
				<?php do_settings_sections( $this->page_id ); ?>

				<?php
				if ( $this->page_id != 'WPPC_CCB_settings' ) {
					?>
					<p class="submit">
						<input name="submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
					</p>
					<?php
				}
				?>
			</form>
		</div>

		<?php
	}

}
