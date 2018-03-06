<?php

add_action( 'acf/init', 'wpcc_load_ccb_fields',20 );

function wpcc_load_ccb_fields() {

acf_add_local_field( array (
  'key' => 'field_59fa684896a83',
  'label' => 'CCB Content to show',
  '_name' => 'ccb_card_type',
  'name' => 'ccb_card_type',
  'type' => 'select',
  'value' => NULL,
  'instructions' => '',
  'required' => 1,
  'conditional_logic' => 0,
  'wrapper' => array (
    'width' => '',
    'class' => '',
    'id' => '',
  ),
  'choices' => array (
    'Select a Card Type' => 'Select a Card Type',
    'ccb_event_list' => 'Upcoming Events',
    'ccb_single_event' => 'Specific Event',
    'ccb_next_event' => 'Next Event',
    //'ccb_group_list' => 'Group List',
  ),
  'default_value' => array (
  ),
  'parent' => 'acf_card-content',
  'conditional_logic' => array (
          'status' => 1,
          'rules' => array (
            array (
              'field' => 'field_5994ca00ccd17',
              'operator' => '==',
              'value' => 'ccb',
            ),
          ),
          'allorany' => 'all',
        ),
  'allow_null' => 0,
  'multiple' => 0,
  'ui' => 1,
  'ajax' => 0,
  'return_format' => 'value',
  'placeholder' => '',
) );

//Upcoming Events Card
acf_add_local_field( array (
      'key' => 'ccb_upcoming_events_card',
      'label' => 'Upcoming Events Card',
      '_name' => 'ccb_upcoming_events_card',
      'name' => 'ccb_upcoming_events_card',
      'type' => 'group',
      'value' => NULL,
      'instructions' => '',
      'required' => 0,
      'parent' => 'acf_card-content',
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_59fa684896a83',
            'operator' => '==',
            'value' => 'ccb_event_list',
          ),
          array (
            'field' => 'field_5994ca00ccd17',
            'operator' => '==',
            'value' => 'ccb',
          ),
        ),
      ),
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'layout' => 'block',
      'sub_fields' => array (
        array (
          'key' => 'ccb_upcoming_events_duration',
          'label' => 'Number of days to show',
          '_name' => 'ccb_upcoming_events_duration',
          'name' => 'ccb_upcoming_events_duration',
          'type' => 'select',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            3 => '3 Days',
            7 => '1 week',
            14 => '2 Weeks',
            21 => '3 Weeks',
            31 => '1 Month',
          ),
          'default_value' => array (
            0 => 7,
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'return_format' => 'value',
          'placeholder' => '',
        ),
        array (
          'key' => 'ccb_upcoming_events_group_type',
          'label' => 'Filter by Grouping Type',
          '_name' => 'ccb_upcoming_events_group_type',
          'name' => 'ccb_upcoming_events_group_type',
          'type' => 'taxonomy',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'taxonomy' => 'calendar_grouping_name',
          'field_type' => 'multi_select',
          'allow_null' => 1,
          'add_term' => 0,
          'save_terms' => 0,
          'load_terms' => 0,
          'return_format' => 'id',
          'multiple' => 0,
        ),
        array (
          'key' => 'ccb_upcoming_events_event_type',
          'label' => 'Filter by Event Type',
          '_name' => 'ccb_upcoming_events_event_type',
          'name' => 'ccb_upcoming_events_event_type',
          'type' => 'taxonomy',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'taxonomy' => 'calendar_event_type',
          'field_type' => 'multi_select',
          'allow_null' => 1,
          'add_term' => 0,
          'save_terms' => 0,
          'load_terms' => 0,
          'return_format' => 'id',
          'multiple' => 0,
        ),
        array (
          'key' => 'event_information_to_display',
          'label' => 'Event Information to Display',
          '_name' => 'event_information_to_display',
          'name' => 'event_information_to_display',
          'type' => 'checkbox',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'event_type' => 'Event Type',
            'grouping_name' => 'Grouping Name',
            'group_name' => 'Group Name',
            'leader_name' => 'Leader Name',
            'leader_contact' => 'Leader Contact Details',
            'view_link' => '"View on CCB" Button',
          ),
          'allow_custom' => 0,
          'save_custom' => 0,
          'default_value' => array (
          ),
          'layout' => 'horizontal',
          'toggle' => 0,
          'return_format' => 'value',
        ),
        
      ),
) );


//Next Event Card
acf_add_local_field( array (
      'key' => 'ccb_next_event_card',
      'label' => 'Next Event Card',
      '_name' => 'ccb_next_event_card',
      'name' => 'ccb_next_event_card',
      'type' => 'group',
      'value' => NULL,
      'instructions' => '',
      'required' => 0,
      'parent' => 'acf_card-content',
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_59fa684896a83',
            'operator' => '==',
            'value' => 'ccb_next_event',
          ),
          array (
            'field' => 'field_5994ca00ccd17',
            'operator' => '==',
            'value' => 'ccb',
          ),
        ),
      ),
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'layout' => 'block',
      'sub_fields' => array (

        
    
        array (
          'key' => 'event_information_to_display',
          'label' => 'Event Information to Display',
          '_name' => 'event_information_to_display',
          'name' => 'event_information_to_display',
          'type' => 'checkbox',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'event_type' => 'Event Type',
            'grouping_name' => 'Grouping Name',
            'group_name' => 'Group Name',
            'leader_name' => 'Leader Name',
            'leader_contact' => 'Leader Contact Details',
            'view_link' => '"View on CCB" Button',
          ),
          'allow_custom' => 0,
          'save_custom' => 0,
          'default_value' => array (
          ),
          'layout' => 'horizontal',
          'toggle' => 0,
          'return_format' => 'value',
        ),
        
      ),
) );

//Next Event Card
acf_add_local_field_group(array(
  'key' => 'group_5a8e0e48f222a',
  'title' => 'test event select',
  'fields' => array(
    array(
      'key' => 'field_5a8e0e568b5f5',
      'label' => 'test',
      'name' => 'test',
      'type' => 'group',
      'parent' => 'acf_card-content',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_59fa684896a83',
            'operator' => '==',
            'value' => 'ccb_single_event',
          ),
          array (
            'field' => 'field_5994ca00ccd17',
            'operator' => '==',
            'value' => 'ccb',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'layout' => 'block',
      'sub_fields' => array(
        array(
          'key' => 'field_5a8e0e648b5f6', 
          'label' => 'Select Event',
          'name' => 'ccb_specific_event',
          'type' => 'relationship',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array(
            0 => 'ccb-content-calendar',
          ),
          'taxonomy' => array(
          ),
          'filters' => array(
            0 => 'search',
            1 => 'post_type',
            2 => 'taxonomy',
          ),
          'elements' => '',
          'min' => '1',
          'max' => '1',
          'return_format' => 'id',
        ),
        array(
          'key' => 'event_information_to_display',
          'label' => 'Event Information to Display',
          '_name' => 'event_information_to_display',
          'name' => 'event_information_to_display',
          'type' => 'checkbox',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            'event_type' => 'Event Type',
            'grouping_name' => 'Grouping Name',
            'group_name' => 'Group Name',
            'leader_name' => 'Leader Name',
            'leader_contact' => 'Leader Contact Details',
            'view_link' => '"View on CCB" Button',
          ),
          'allow_custom' => 0,
          'save_custom' => 0,
          'default_value' => array (
          ),
          'layout' => 'horizontal',
          'toggle' => 0,
          'return_format' => 'value',
        ),
        array(
          'key' => 'ccb_event_id',
          'label' => 'CCB Event ID',
          '_name' => 'ccb_event_id',
          'name' => 'ccb_event_id',
          'type' => 'text',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          
          'allow_custom' => 0,
          'save_custom' => 0,
          'default_value' => '',
        ),
      ),
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'card',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));



}

// Autosave the Event ID into the field of the card

function wpccb_save_eventID( $post_id, $post, $update ) {

    global $post; 
    if ($post->post_type != 'card'){
        return;
    }

    if ($ccb_event_post_id = get_post_meta($post_id, 'test_ccb_specific_event', true) ){ //This returns an array containing the WordPress/CBB event post ID

      $ccb_event_id = get_post_meta($ccb_event_post_id[0], 'event_id', true);
      $ccb_event_title = get_the_title($ccb_event_post_id[0]);
      $ccb_event_date = get_post_meta($ccb_event_post_id[0], 'calendar_date', true);

      // - Update the post's metadata.
      update_post_meta( $post_id, 'test_ccb_event_id', $ccb_event_id );
      update_post_meta( $post_id, 'ccb_event_date', $ccb_event_date );
      update_post_meta( $post_id, 'ccb_event_title', $ccb_event_title );
      update_post_meta( $post_id, 'ccb_original_wp_post_id', $ccb_event_post_id[0] );

    }

    

    


}
add_action( 'save_post', 'wpccb_save_eventID', 10, 3 );