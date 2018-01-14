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
    'ccb_group_list' => 'Group List',
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

}