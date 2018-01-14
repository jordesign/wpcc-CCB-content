<?php



  /******* Filter the card link to trigger the popup ******/
  function wpccb_coming_events($card_content) {
    if( get_field('ccb_card_type', get_the_ID()) === 'ccb_event_list'){

        $card_content .='<div class="wpccEventList">';

        //Check how long we should show events for
        $eventListDuration = get_post_meta(get_the_ID(), 'ccb_upcoming_events_card_ccb_upcoming_events_duration');

        //Define the number of seconds in a day
        $day = 86400;

        $addDays = $eventListDuration[0] * $day;

        //This is the date we should show up until
        $futureDate = time() + $addDays;

        //Set up which content to show
        $extraInformation = get_field( 'ccb_upcoming_events_card_event_information_to_display');

        //Check for filtering of query
        $groupingType = get_post_meta(get_the_ID(), 'ccb_upcoming_events_card_ccb_upcoming_events_group_type');
        //print_r($groupingType);
            if ( $groupingType[0] == '' ){
                $groupingType = 'all';
            }

        $eventType = get_post_meta(get_the_ID(), 'ccb_upcoming_events_card_ccb_upcoming_events_event_type');
            if ( $eventType[0] == '' ){
                $eventType = 'all';
            }

        //Set up Query args
        $args = array (
            'post_type' => 'ccb-content-calendar', 
            'posts_per_page' => -1 , 
            'orderby' => 'meta_value',
            'meta_key' => 'calendar_date', 
            'order' => 'ASC',
            'tax_query' => array(
                
                
                array(
                    'taxonomy' => 'calendar_grouping_name',
                    'field'    => 'term_id',
                    'terms'    => $groupingType[0],
                    
                ),

                array(
                    'taxonomy' => 'calendar_event_type',
                    'field'    => 'term_id',
                    'terms'    => $eventType[0],
                    
                ),
            ),
        );
       
        $ctc_events_query = new WP_Query( $args );


        while ( $ctc_events_query->have_posts() ) : $ctc_events_query->the_post();

            $event_date = get_post_meta(get_the_ID(), 'calendar_date', true);

            //If this is beyond our future date - we stop
            if ( $futureDate <  strtotime($event_date) ){
                break;
            }

            
            $card_content .='<div class="wpccUpcomingEvent">';

                //Event Date
                $card_content .= '<div class="wpccEventDate dateCard">';
                    $card_content .= '<span class="eventMonth">' . date('M' ,strtotime($event_date)) . '</span> ';
                    $card_content .= '<span class="eventDay">' . date('d' ,strtotime($event_date)) . '</span>';

                $card_content .= '</div>';

                //Event Title and Details
                $card_content .= '<div class="wpccEventTitle">';
                    $card_content .= '<h4>' . get_the_title() . '</h4>';

                

                    //Event Meta
                    $card_content .= '<p class="eventMeta">';
                        
                        if ($eventTime = get_post_meta(get_the_ID(), 'calendar_start_time', true) ){

                            $card_content .= '<span class="eventMetaTime"><i class="fa fa-clock-o"></i>&nbsp;' . date("g:i a", strtotime("$eventTime")) . '</span>';

                        }

                        if ($eventMetaLocation = get_post_meta(get_the_ID(), 'calendar_location', true) ){

                            $card_content .= '<span class="eventLocation"><i class="fa fa-map-marker"></i>&nbsp;' . $eventMetaLocation . '</span>';

                        }

                        if (!empty($extraInformation) ){
                            $card_content .= '<a class="eventMore" href="#"><i class="fa fa-chevron-circle-down"></i>&nbsp;More Information</a>';
                        }
                    $card_content .= '</p>';

                        if (!empty($extraInformation) ){
                            $card_content .= '<div class="eventExtraInfo">';

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

                                $groupName = wp_get_post_terms(get_the_ID(), 'calendar_group_name', '', ', ');
                                foreach($groupName as $term_single) {
                                    $card_content .= $term_single->name; //do something here
                                } 

                                $card_content .= '</p>';
                            }

                            if (has_term('','calendar_grouping_name') && in_array('grouping_name', $extraInformation )){
                                $card_content .= '<p><strong>Grouping Name:</strong> ';

                                $groupingNames = wp_get_post_terms(get_the_ID(), 'calendar_grouping_name', '', ', ');
                                foreach($groupingNames as $term_single) {
                                    $card_content .= $term_single->name; //do something here
                                }

                                $card_content .= '</p>';
                            }

                            if ($leader = get_post_meta(get_the_ID(), 'calendar_leader', true) ){
                                if(in_array('leader_name', $extraInformation )){
                                $card_content .= '<h5>Leader</h5><p><strong>' . $leader . '</strong></p>';

                                if (in_array('leader_contact', $extraInformation )){

                                    if ($leaderEmail = get_post_meta(get_the_ID(), 'calendar_leader_email', true) ){
                                            $card_content .= '<p>' .  $leaderEmail . '</p>';
                                    }

                                    if ($leaderPhone = get_post_meta(get_the_ID(), 'calendar_leader_phone', true) ){
                                            $card_content .= '<p>' .  $leaderPhone . '</p>';
                                    }
                                }

                            } }
                        }


                    $card_content .= '</p>';

                $card_content .= '</div></div>';

                if( in_array('view_link', $extraInformation ) ){
                    $eventID = get_post_meta(get_the_id(), 'event_id');
                    $settings = get_option( 'ccb_core_settings' );
                    $card_content .= '<a href="http://' . $settings['subdomain'] . '.ccbchurch.com//w_calendar.php#events/' . $eventID[0] . '/" target="_blank" class="button">View on CCB</a>';
                }

            $card_content .='</div>';

        endwhile;



    }

    //Close the 'wpccEventList DIV'
    $card_content .= '</div>';
   
    return $card_content;
  }

  add_filter('wpcc_card_content', 'wpccb_coming_events');
