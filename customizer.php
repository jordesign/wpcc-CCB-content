<?php

/**
* CCb Customizer settings
*/
function wpcc_ccb_new_customizer_settings($wp_customize) {



/** **** **** *** *** *** *** *** *.
/**   Add Section for CCB   */
$wp_customize->add_section('wpcc_ccb', array(
'title' => 'CCB Content',
'description' => '',
'priority' => 130,
'panel' => 'WP_Church_Center',
));


/** **** **** *** *** *** *** *** *.
/**   Add Settings and Controls for 'CCB Content'   */

//Heading for the Menu section
function wpcc_customizer_ccbEvents_title(){
  printf( '<h2 style="margin: 0px 0 10px; padding-top: 35px; color:#333; font-size:16px;clear:both;">%s</h2>', __( 'CCB Events', 'wpcc' ) );
}
add_action( 'customize_render_control_wpcc_ccb_date_format', 'wpcc_customizer_ccbEvents_title');

//Add Control for Icon Style
 $wp_customize->add_setting( 'wpcc_ccb_date_format', array(
  'capability' => 'manage_options',
  'sanitize_callback' => 'wpcc_sanitize_select',
  'type' => 'option',
  'default' => 'wp_default',
) );

$wp_customize->add_control( 'wpcc_ccb_date_format', array(
  'type' => 'select',
  'section' => 'wpcc_ccb', // Add a default or your own section
  'label' => __( 'Date Format' ),
  'choices' => array(
    'wp_default' => __( 'Same as rest of site' ),
    'F j, Y' => __( 'October 25, 2017' ),
    'Y-m-d' => __( '2017-10-25' ),
    'm/d/Y' => __( '10/25/2017' ),
    'd/m/Y' => __( '25/10/2017' ),
  ),

) );

}

add_action('customize_register', 'wpcc_ccb_new_customizer_settings');