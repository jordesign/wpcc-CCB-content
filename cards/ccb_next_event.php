<?php

  /******* Filter the card content ******/
  function wpccb_next_event_card($card_content) {
    if( get_field('ccb_card_type', get_the_ID()) === 'ccb_next_event'){

        $card_content ='<div class="wpccNextEvent">';

        //Set up which content to show
        $extraInformation = get_field( 'ccb_next_event_card_event_information_to_display');
        $cardColor = get_post_meta(get_the_ID(),'wpcc_color',true);

        //Set up Query args
        $args = array (
            'post_type' => 'ccb-content-calendar', 
            'posts_per_page' => 1 , 
            'orderby' => 'meta_value',
            'meta_key' => 'calendar_date', 
            'order' => 'ASC',
        );
       
        $ctc_events_query = new WP_Query( $args );


        while ( $ctc_events_query->have_posts() ) : $ctc_events_query->the_post();

            $event_id = get_the_ID();
            $event_date = get_post_meta($event_id, 'calendar_date', true);

            
            $card_content .='<div class="wpccSingleEvent">';

                

                //Event Title and Details
                $card_content .= '<div class="wpccEventTitle">';
                    //Event Date
                    $card_content .= '<div class="wpccEventDate dateCard">';
                        $card_content .= '<span class="eventMonth">' . date('M' ,strtotime($event_date)) . '</span> ';
                        $card_content .= '<span class="eventDay">' . date('d' ,strtotime($event_date)) . '</span>';

                    $card_content .= '</div>';
                    $card_content .= '<h1 style="color:' .  $cardColor . ';">' . get_the_title() . '</h1>';

                

                    //Event Meta
                    $card_content .= '<p class="eventMeta">';
                        
                        if ($eventTime = get_post_meta($event_id, 'calendar_start_time', true) ){

                            $card_content .= '<span class="eventMetaTime"><i class="fa fa-clock-o"></i>&nbsp;' . date("g:i a", strtotime("$eventTime")) . '</span>';

                        }

                        if ($eventMetaLocation = get_post_meta($event_id, 'calendar_location', true) ){

                            $card_content .= '<span class="eventLocation"><i class="fa fa-map-marker"></i>&nbsp;' . $eventMetaLocation . '</span>';

                        }

                    $card_content .= '</p></div>';

                    $card_content .= '<div class="eventBody">' . get_the_content($event_id) . '</div>';

                        if (!empty($extraInformation) ){
                            $card_content .= '<div class="eventExtraInfo singleEventExtraInfo">';
                            $card_content .= '<h3>Further Information</h3>';



                            if (has_term('','calender_event_type' && in_array('event_type', $extraInformation ))){
                                $card_content .= '<p><strong>Event Type:</strong> ';

                                $groupName = wp_get_post_terms(get_the_ID(), 'calendar_event_type', '', ', ');
                                foreach($groupName as $term_single) {
                                    $card_content .= $term_single->name; //do something here
                                }


                                $card_content .= '</p>';
                            }

                            if (has_term('','calendar_group_name') && in_array('group_name', $extraInformation )){
                                $card_content .= '<p><strong>Group Name:</strong> ';

                                $groupName = wp_get_post_terms($event_id, 'calendar_group_name', '', ', ');
                                foreach($groupName as $term_single) {
                                    $card_content .= $term_single->name; //do something here
                                } 

                                $card_content .= '</p>';
                            }

                            if (has_term('','calendar_grouping_name') && in_array('grouping_name', $extraInformation )){
                                $card_content .= '<p><strong>Grouping Name:</strong> ';

                                $groupingNames = wp_get_post_terms($event_id, 'calendar_grouping_name', '', ', ');
                                foreach($groupingNames as $term_single) {
                                    $card_content .= $term_single->name; //do something here
                                }

                                $card_content .= '</p>';
                            }

                            if ($leader = get_post_meta($event_id, 'calendar_leader', true) ){
                                if(in_array('leader_name', $extraInformation )){
                                $card_content .= '<h3>Leader</h3><p><strong>' . $leader . '</strong></p>';

                                if (in_array('leader_contact', $extraInformation )){

                                    if ($leaderEmail = get_post_meta($event_id, 'calendar_leader_email', true) ){
                                            $card_content .= '<p>' .  $leaderEmail . '</p>';
                                    }

                                    if ($leaderPhone = get_post_meta($event_id, 'calendar_leader_phone', true) ){
                                            $card_content .= '<p>' .  $leaderPhone . '</p>';
                                    }
                                }

                            } }
                        
                        }

                    $card_content .= '</p>';

                    if( in_array('view_link', $extraInformation ) ){
                    $eventID = get_post_meta(get_the_id(), 'event_id');
                    $settings = get_option( 'ccb_core_settings' );
                    $card_content .= '<a href="http://' . $settings['subdomain'] . '.ccbchurch.com//w_calendar.php#events/' . $eventID[0] . '/occurrence/1900010100:00:00" target="_blank" class="button">View on CCB</a>';
                }

                $card_content .= '</div>';

                

            $card_content .='</div>';

        endwhile;
        wp_reset_query();

        //Close the 'wpccEventList DIV'
        $card_content .= '</div>';
       
        return $card_content;

    }else{
        return $card_content;
    }

    
  }

  add_filter('wpcc_card_content', 'wpccb_next_event_card');


  /****** Filter the card title on single card ******/
add_filter('wpcc_card_title', 'wpccb_next_event_title');
function wpccb_next_event_title($card_title) {
    if( get_field('ccb_card_type', get_the_ID()) === 'ccb_next_event'){

             return '';
        
    }else{
        return $card_title;
    }
    
}

  /****** Filter the card title on single card ******/
add_filter('wpcc_card_subtitle', 'wpccb_next_event_subtitle');
function wpccb_next_event_subtitle($card_title) {
    if( get_field('ccb_card_type', get_the_ID()) === 'ccb_next_event'){

             return '';
        
    }else{
        return $card_title;
    }
    
}


  /****** Filter the card subtitle on single card ******/
add_filter('wpcc_archive_card_subtitle', 'wpccb_archive_next_event_subtitle');
add_filter('wpcc_card_seo_description', 'wpccb_archive_next_event_subtitle');
function wpccb_archive_next_event_subtitle($card_subtitle) {
    if( get_field('ccb_card_type', get_the_ID()) === 'ccb_next_event'){

            //Set up Query args
            $args = array (
                'post_type' => 'ccb-content-calendar', 
                'numberposts' => 1 , 
                'orderby' => 'meta_value',
                'meta_key' => 'calendar_date', 
                'order' => 'ASC',
            );

            $eventList = get_posts($args);

            //print_r($eventList);

            if($eventList){
                $nextEvent = $eventList[0];
                $nextEventID = $nextEvent->ID;
                $card_subtitle = date( get_option('date_format'), strtotime(get_post_meta($nextEventID, 'calendar_date', true) ) ); 
            }
      
    }

    return $card_subtitle;
    
}


/****** Filter the card title and subtitle on archive view ******/
add_filter('wpcc_archive_card_title', 'wpccb_archive_next_event_title', 10, 1);
add_filter('wpcc_card_seo_title', 'wpccb_archive_next_event_title', 10, 1);
function wpccb_archive_next_event_title($card_title) {
    if( get_field('ccb_card_type', get_the_ID()) === 'ccb_next_event'){

            //Set up Query args
            $args = array (
                'post_type' => 'ccb-content-calendar', 
                'numberposts' => 1 , 
                'orderby' => 'meta_value',
                'meta_key' => 'calendar_date', 
                'order' => 'ASC',
            );

            $eventList = get_posts($args);

            //print_r($eventList);

            if($eventList){
                $nextEvent = $eventList[0];
                $nextEventID = $nextEvent->ID;
                $card_title = get_the_title($nextEventID); 
            }
        
    }

    return $card_title;
    
}
