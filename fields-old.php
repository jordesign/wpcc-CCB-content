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
      'key' => 'field_59fa69b9f042d',
      'label' => 'Upcoming Events Card',
      '_name' => 'ccb_upcoming_events_card',
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
          'key' => 'field_59fa69f0f042e',
          'label' => 'Number of days to show',
          '_name' => 'ccb_upcoming_events_duration',
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
          'key' => 'field_59fa6adff042f',
          'label' => 'Filter by Grouping Type',
          '_name' => 'ccb_upcoming_events_group_type',
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
          'key' => 'field_59fa6b9477b34',
          'label' => 'Filter by Event Type',
          '_name' => 'ccb_upcoming_events_event_type',
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
        
      ),
    ) );

//Single Event Card
acf_add_local_field( array (
      'key' => 'ccb_single_event_card',
      'label' => 'Specific Event',
      '_name' => 'ccb_single_event_card',
      'type' => 'group',
      'value' => NULL,
      'instructions' => '',
      'required' => 1,
      'parent' => 'acf_card-content',
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
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'layout' => 'block',
      'sub_fields' => array (
        array (
          'key' => 'field_5a00de910ad07',
          'label' => 'Select Event',
          '_name' => 'select_event',
          'type' => 'post_object',
          'value' => NULL,
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array (
            0 => 'ccb-content-calendar',
          ),
          'taxonomy' => array (
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'return_format' => 'object',
          'ui' => 1,
        ),
        
      ),
    ) );

//Next Event Card
acf_add_local_field( array (
      'key' => 'ccb_next_event_card',
      'label' => 'Next Event',
      '_name' => 'ccb_next_event_card',
      'type' => 'group',
      'value' => NULL,
      'instructions' => '',
      'required' => 1,
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
          'key' => 'field_5a00df8f0ad08',
          'label' => 'Showing the Next Event',
          '_name' => '',
          'type' => 'message',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'message' => 'This card will automatically show the <em>next</em> CCB event that is going to occur',
          'new_lines' => 'wpautop',
          'esc_html' => 0,
        ),
        array (
          'key' => 'field_59fa6c6177b36',
          'label' => 'Event Information to Display',
          '_name' => 'event_information_to_display',
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
            'group_type' => 'Group Type',
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

//Group List
acf_add_local_field( array (
      'key' => 'ccb_list_group_card',
      'label' => 'Group List',
      '_name' => 'ccb_list_group_card',
      'type' => 'group',
      'value' => NULL,
      'instructions' => '',
      'required' => 1,
      'parent' => 'acf_card-content',
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_59fa684896a83',
            'operator' => '==',
            'value' => 'ccb_group_list',
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
          'key' => 'field_5a00df8f0ad08',
          'label' => 'Listing all Groups',
          '_name' => '',
          'type' => 'message',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'message' => 'This card will automatically show a list of all CCB groups',
          'new_lines' => 'wpautop',
          'esc_html' => 0,
        ),
        
      ),
    ) );

}