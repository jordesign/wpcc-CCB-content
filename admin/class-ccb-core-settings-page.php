<?php
/**
 * Everything related to the plugin settings pages
 *
 * @link       http://jaredcobb.com/ccb-core
 * @since      0.9.0
 *
 * @package    CCB_Core
 * @subpackage CCB_Core/admin
 */

/**
 * Object to manage the plugin settings pages
 *
 * @package    CCB_Core
 * @subpackage CCB_Core/admin
 * @author     Jared Cobb <wordpress@jaredcobb.com>
 */
class CCB_Core_Settings_Page extends CCB_Core_Plugin {

	/**
	 * The key for the page in the settings array
	 *
	 * @since    0.9.0
	 * @access   protected
	 * @var      string    $section_id
	 */
	protected $page_id;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @access    public
	 * @since     0.9.0
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
	 * @since     0.9.0
	 * @return    void
	 */
	public function render_page() {
		if ( ! current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.', $this->plugin_name ) );
		}
		
			$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'ccb_api';
		?>

		<h1>CCB Content Settings</h1>

		<div class="wrap <?php echo $this->plugin_settings_name . '-wrapper ' . $this->page_id; ?>">
			<h2 class="nav-tab-wrapper">
			    <a href="edit.php?post_type=card&page=ccb-content&tab=ccb_api" class="nav-tab <?php echo $active_tab == 'ccb_api' ? 'nav-tab-active' : ''; ?>">API Settings</a>
			    <a href="edit.php?post_type=card&page=ccb-content&tab=ccb_groups" class="nav-tab <?php echo $active_tab == 'ccb_groups' ? 'nav-tab-active' : ''; ?>">Groups</a>
			    <a href="edit.php?post_type=card&page=ccb-content&tab=ccb_events" class="nav-tab <?php echo $active_tab == 'ccb_events' ? 'nav-tab-active' : ''; ?>">Events</a>
			    <a href="edit.php?post_type=card&page=ccb-content&tab=ccb_sync" class="nav-tab <?php echo $active_tab == 'ccb_sync' ? 'nav-tab-active' : ''; ?>">Sync</a>
			    <a href="edit.php?post_type=card&page=ccb-content&tab=ccb_about" class="nav-tab <?php echo $active_tab == 'ccb_about' ? 'nav-tab-active' : ''; ?>">About</a>
			</h2>

			<form action="options.php" method="post">

				<?php //API Settings Tab
				if( $active_tab == 'ccb_api' ) {
					settings_fields( $this->plugin_settings_name . '_ccb_api' );
					do_settings_sections( $this->plugin_settings_name . '_ccb_api' );
				}

				//Group Settings & list Tab
				if( $active_tab == 'ccb_groups' ) {
					settings_fields( $this->plugin_settings_name . '_ccb_groups' );
					do_settings_sections( $this->plugin_settings_name . '_ccb_groups' );
 
 					$settings = get_option( $this->plugin_settings_name );
					$this->subdomain = $settings['subdomain']; ?>

					<h2>Synced Groups (by area):</h2>

					<?php 

					$terms = get_terms( array(
						    'taxonomy' => 'group_areas',
						    'hide_empty' => true,
						) );

						

						foreach( $terms as $term){

							

							$ctc_groups_query = new WP_Query( array (
				                    'post_type' => 'ccb-content-groups', 
				                    'posts_per_page' => -1 , 
				                    'tax_query' => array(
					                    array(
					                        'taxonomy' => 'group_areas',
					                        'field' => 'slug',
					                        'terms' => $term->slug,
					                    )
					                )
				                ) );

							// If there are posts in our list - do this    
					            if ( $ctc_groups_query->have_posts() ) : ?>
					            	<?php echo '<h4>' . $term->name . '</h4>'; ?>
					                <table class="wp-list-table widefat fixed striped posts" style="margin-bottom: 40px;">
					                	<thead>
									<tr>
										<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://localhost/wpChurchHub/wp-admin/edit.php?post_type=ccb-content-groups&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th>
										
										<th scope="col" id="taxonomy-group_type" class="manage-column column-taxonomy-group_areas">Type</th>
										<td></td>
										
									</tr>
									</thead>

					                <?php // Loop through the posts
					                while ( $ctc_groups_query->have_posts() ) : $ctc_groups_query->the_post(); ?>

					                	<tr>
										
										<td><strong>
											<a class="row-title" aria-label="<?php echo get_the_title(get_the_ID()); ?>"><?php echo get_the_title(get_the_ID()); ?></a>

										</strong>
										</td>
										<td>
											<?php if (has_term('','group_types')){
					                				the_terms(get_the_ID(), 'group_types', '', ', ');
					                			} ?>
					                		</td>

					                		<?php $groupID = get_post_meta(get_the_id(), 'group_id');
					                		 ?>

										<td class="editButton alignright">
											<a href="#" class="button previewButton">View Group Details</a>
					                			<a href="<?php echo 'http://' . $this->subdomain . '.ccbchurch.com/group_detail.php?group_id=' . $groupID[0]; ?>"class="button" target="_blank">Edit in CCB</a>

					                			<div class="ccbOverlay">
												<div class="ccbOverlayContent ccb_group">
													<?php the_post_thumbnail('medium'); ?>
													<h3><?php the_title(); ?></h3>
													<?php the_excerpt(); ?>
													<p><strong>Area:</strong> <?php if (has_term('','group_areas')){
							                				the_terms(get_the_ID(), 'group_areas', '', ', ');
							                			} ?></p>
													<p><strong>Type:</strong> <?php if (has_term('','group_types')){
							                				the_terms(get_the_ID(), 'group_types', '', ', ');
							                			} ?></p>
							                			<p><strong>Day(s):</strong> <?php if (has_term('','group_days')){
							                				the_terms(get_the_ID(), 'group_days', '', ', ');
							                			} ?></p>
							                			<p><strong>Time(s):</strong> <?php if (has_term('','group_times')){
							                				the_terms(get_the_ID(), 'group_times', '', ', ');
							                			} ?></p>
							                			<p><strong>Department:</strong> <?php if (has_term('','group_departments')){
							                				the_terms(get_the_ID(), 'group_departments', '', ', ');
							                			} ?></p>

							                			<h4>Address</h4>
							                			<p>
							                				<?php if ($lineOne = get_post_meta(get_the_ID(), 'address_line_1', true)){
							                						echo $lineOne . '<br>';
							                				} ?>
							                				<?php if ($lineTwo = get_post_meta(get_the_ID(), 'address_line_2', true)){
							                						echo $lineTwo ;
							                				} ?>
							                			</p>

							                			<h4>Leader</h4>
							                			<p>
							                				<?php if ($leader = get_post_meta(get_the_ID(), 'leader_full_name', true)){
							                						echo $leader . '<br>';
							                				} ?>
							                				<?php if ($leaderEmail = get_post_meta(get_the_ID(), 'leader_email', true)){
							                						echo $leaderEmail;
							                				} ?>
							                			</p>
													<a href="#" class="closeButton">Close</a>

												</div>
					                			</div>
					                		</td>
										
					                	</tr>

					          <?php endwhile;

					          echo '</table>';

					          else:

					          endif;

						}
			            
			          //query for groups without location
			          $ctc_groups_query = new WP_Query( array (
				                    'post_type' => 'ccb-content-groups', 
				                    'posts_per_page' => -1 , 
				                    'tax_query' => array(
					                    array(
					                        'taxonomy' => 'group_areas',
					                        'terms'    => get_terms( 'group_areas', [ 'fields' => 'ids'  ] ),
            								'operator' => 'NOT IN'
					                    )
					                )
				                ) );

							// If there are posts in our list - do this    
					            if ( $ctc_groups_query->have_posts() ) : ?>
					            	<?php echo '<h4>No location set:</h4>'; ?>
					                <table class="wp-list-table widefat fixed striped posts" style="margin-bottom: 40px;">
					                	<thead>
									<tr>
										<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://localhost/wpChurchHub/wp-admin/edit.php?post_type=ccb-content-groups&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th>
										
										<th scope="col" id="taxonomy-group_type" class="manage-column column-taxonomy-group_areas">Type</th>
										<td></td>
										
									</tr>
									</thead>

					                <?php // Loop through the posts
					                while ( $ctc_groups_query->have_posts() ) : $ctc_groups_query->the_post(); ?>

					                	<tr>
										
										<td><strong>
											<a class="row-title" aria-label="<?php echo get_the_title(get_the_ID()); ?>"><?php echo get_the_title(get_the_ID()); ?></a>

										</strong>
										</td>
										<td>
											<?php if (has_term('','group_types')){
					                				the_terms(get_the_ID(), 'group_types', '', ', ');
					                			} ?>
					                		</td>

										<td class="editButton alignright">
											<a href="#" class="button previewButton">View Group Details</a>
					                			<a href="<?php echo 'http://' . $this->subdomain . '.ccbchurch.com/group_detail.php?group_id=' . $groupID[0]; ?>"class="button" target="_blank">Edit in CCB</a>


					                			<div class="ccbOverlay">
												<div class="ccbOverlayContent ccb_group">
													<?php the_post_thumbnail('medium'); ?>
													<h3><?php the_title(); ?></h3>
													<?php the_excerpt(); ?>
													<p><strong>Area:</strong> <?php if (has_term('','group_areas')){
							                				the_terms(get_the_ID(), 'group_areas', '', ', ');
							                			} ?></p>
													<p><strong>Type:</strong> <?php if (has_term('','group_types')){
							                				the_terms(get_the_ID(), 'group_types', '', ', ');
							                			} ?></p>
							                			<p><strong>Day(s):</strong> <?php if (has_term('','group_days')){
							                				the_terms(get_the_ID(), 'group_days', '', ', ');
							                			} ?></p>
							                			<p><strong>Time(s):</strong> <?php if (has_term('','group_times')){
							                				the_terms(get_the_ID(), 'group_times', '', ', ');
							                			} ?></p>
							                			<p><strong>Department:</strong> <?php if (has_term('','group_departments')){
							                				the_terms(get_the_ID(), 'group_departments', '', ', ');
							                			} ?></p>

							                			<h4>Address</h4>
							                			<p>
							                				<?php if ($lineOne = get_post_meta(get_the_ID(), 'address_line_1', true)){
							                						echo $lineOne . '<br>';
							                				} ?>
							                				<?php if ($lineTwo = get_post_meta(get_the_ID(), 'address_line_2', true)){
							                						echo $lineTwo ;
							                				} ?>
							                			</p>

							                			<h4>Leader</h4>
							                			<p>
							                				<?php if ($leader = get_post_meta(get_the_ID(), 'leader_full_name', true)){
							                						echo $leader . '<br>';
							                				} ?>
							                				<?php if ($leaderEmail = get_post_meta(get_the_ID(), 'leader_email', true)){
							                						echo $leaderEmail;
							                				} ?>
							                			</p>

													<a href="#" class="closeButton">Close</a>
												</div>
					                			</div>
					                		</td>
										
					                	</tr>

					          <?php endwhile;

					          echo '</table>';

					          else:

					          endif;  	


				 }

				//Event Settings & list Tab
				if( $active_tab == 'ccb_events' ) {
					settings_fields( $this->plugin_settings_name . '_ccb_calendar' );
					do_settings_sections( $this->plugin_settings_name . '_ccb_calendar' );
					$settings = get_option( $this->plugin_settings_name );
					$this->subdomain = $settings['subdomain'];

					$today = date('d M, y');
					$ctc_events_query = new WP_Query( array (
				                    'post_type' => 'ccb-content-calendar', 
				                    'posts_per_page' => -1 , 
							    'orderby' => 'meta_value',
    								'meta_key' => 'calendar_date', 
							    'order' => 'ASC',

				                ) ); ?>

					<table class="wp-list-table widefat fixed striped posts" style="margin-bottom: 40px;">
					                	<thead>
									<tr>
										<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://localhost/wpChurchHub/wp-admin/edit.php?post_type=ccb-content-groups&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th>
										
										<th scope="col" id="taxonomy-date" class="manage-column column-taxonomy-group_areas">Date</th>
										<th scope="col" id="taxonomy-grouping" class="manage-column column-taxonomy-group_areas">Grouping</th>
										<td></td>
										
									</tr>
									</thead>

					                <?php // Loop through the posts
					                while ( $ctc_events_query->have_posts() ) : $ctc_events_query->the_post(); ?>

					                	<tr>
										
										<td><strong>
											<a class="row-title" aria-label="<?php echo get_the_title(get_the_ID()); ?>"><?php echo get_the_title(get_the_ID()); ?></a>

										</strong>
										</td>
										<td>
											<?php if ($event_date = get_post_meta(get_the_ID(), 'calendar_date', true)){
							                						echo $event_date;
							                				} ?>
					                		</td>

					                		<td>
					                			<?php if (has_term('','calendar_grouping_name')){
					                				the_terms(get_the_ID(), 'calendar_grouping_name', '', ', ');
					                			} ?>
					                		</td>

					                		<?php $eventID = get_post_meta(get_the_id(), 'event_id');
					                		 ?>

										<td class="editButton alignright">
											<a href="#" class="button previewButton">View Event Details</a>
					                			<a href="<?php echo 'http://' . $this->subdomain . '.ccbchurch.com/event_detail.php?event_id=' . $eventID[0]; ?>"class="button" target="_blank">Edit in CCB</a>

					                			<div class="ccbOverlay">
												<div class="ccbOverlayContent ccb_group">
													<?php the_post_thumbnail('medium'); ?>
													<h3><?php the_title(); ?></h3>
													<?php the_excerpt(); ?>

													<?php if ($eventDate = get_post_meta(get_the_ID(), 'calendar_date', true)){
							                				echo '<p><strong>Date: </strong>' . $eventDate . '</p>';
							                			} ?>

							                			<?php $eventStartTime = get_post_meta(get_the_ID(), 'calendar_start_time', true);

							                				$eventEndTime = get_post_meta(get_the_ID(), 'calendar_end_time', true);

							                				if ($eventStartTime || $eventEndTime ){
								                				echo '<p><strong>Time: </strong>';

								                				if($eventStartTime){
								                					echo date( 'g:ia',strtotime($eventStartTime) );
								                				}
								                				if ($eventStartTime && $eventEndTime){
								                					echo ' - ';
								                				} 
								                				if($eventEndTime){
								                					echo date( 'g:ia',strtotime($eventEndTime) );
								                				} 
								                				echo '</p>';
								                			} ?>

								                		<?php if ($eventLocation = get_post_meta(get_the_ID(), 'calendar_location', true)){
							                				echo '<p><strong>Location: </strong>' . $eventLocation . '</p>';
							                			} ?>


													<p><strong>Event Type:</strong> <?php if (has_term('','calender_event_type')){
							                				the_terms(get_the_ID(), 'calendar_event_type', '', ', ');
							                			} ?></p>
													<p><strong>Group Name:</strong> <?php if (has_term('','calendar_group_name')){
							                				the_terms(get_the_ID(), 'calendar_group_name', '', ', ');
							                			} ?></p>
							                			<p><strong>Grouping Name:</strong> <?php if (has_term('','calendar_grouping_name')){
							                				the_terms(get_the_ID(), 'calendar_grouping_name', '', ', ');
							                			} ?></p>
							                			

							     

							                			<h4>Leader</h4>
							                			<p>
							                				<?php if ($leader = get_post_meta(get_the_ID(), 'calendar_leader', true)){
							                						echo $leader . '<br>';
							                				} ?>
							                				<?php if ($leaderEmail = get_post_meta(get_the_ID(), 'calendar_leader_email', true)){
							                						echo $leaderEmail;
							                				} ?>
							                				<?php if ($leaderPhone = get_post_meta(get_the_ID(), 'calendar_leader_phone', true)){
							                						echo $leaderPhone;
							                				} ?>
							                			</p>
													<a href="#" class="closeButton">Close</a>

												</div>
					                			</div>
					                		</td>
										
					                	</tr>

					          <?php endwhile;

					          echo '</table>';

				}

				//CCB Sync Tab
				if( $active_tab == 'ccb_sync' ) {
					settings_fields( $this->plugin_settings_name . '_ccb_sync' );
					do_settings_sections( $this->plugin_settings_name . '_ccb_sync' );
				}

				//About Tab
				if( $active_tab == 'ccb_about' ) {
					settings_fields( $this->plugin_settings_name . '_ccb_about' );
					do_settings_sections( $this->plugin_settings_name . '_ccb_about' );
				}

			

				
				if ( $this->page_id != $this->plugin_settings_name . 'ccb_about' ) {
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
