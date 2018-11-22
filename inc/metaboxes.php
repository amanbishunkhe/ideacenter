<?php
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
function rws_common_metabox_section( $post_type )
{
	$common = array(
        'name'   => 'page_banner_section',
        'title'  => ucwords( $post_type ).' Banner',
        'fields' => array(
                    /*array(
                        'type'          => 'notice',
                        'class'         => 'info',
                        'content'       => __( 'Banner Single Image or Banner Slider. Need to enable the option to view the option. When one option is enabled, other option is disabled.' ),
                    ),*/
                    array(
                        'id'            => 'banner_image_enable',
                        'type'          => 'switcher',
                        'title'         => __('Banner Image Enable'),
                        //'dependency'    => array('banner_slider_enable', '!=', 'true'),
                    ),
                    array(
                        'id'            => 'banner_image',
                        'type'          => 'image',
                        'title'         => __('Banner Image'),
                        'dependency'    => array('banner_image_enable', '==', 'true'),
                    ),

                    /*array(
                        'id'            => 'banner_slider_enable',
                        'type'          => 'switcher',
                        'title'         => __('Banner Slider Enable'),
                        'dependency'    => array('banner_image_enable', '!=', 'true'),
                    ),*/
                    // slider repeater groups
                    /*array(
                        'id'                => 'slider_images',
                        'type'              => 'group',
                        'title'             => __('Add Slider Images'),
                        'button_title'      => __('Add Slider Images'),
                        'accordion_title'   => __('Add Slider Details with Image'),
                        'fields'            => array(
                            
                            array(
                                'id'        => 'slider_img',
                                'type'      => 'image',
                                'title'     => __('Slider Image'),
                            ),
                            array(
                                'id'         => 'slider_desc',
                                'type'       => 'textarea',
                                'title'      => __('Slider Description'),
                                'attributes' => array(
                                    'placeholder' => 'Slider Description',
                                ),
                            ),
                            array(
                                'id'         => 'banner_video_enable',
                                'type'       => 'switcher',
                                'title'      => __('Banner Video Enable'),
                            ),
                            array(
                                'type'      => 'notice',
                                'class'     => 'info',
                                'content'   => __( 'Slider Image Will be used as video poster.' ),
                                'dependency' => array('banner_video_enable', '==', 'true'),
                            ),
                            array(
                                'id'         => 'slider_video_webm',
                                'type'       => 'text',
                                'title'      => __('Slider Video webm source'),
                                'dependency' => array('banner_video_enable', '==', 'true'),
                            ),
                            array(
                                'id'         => 'slider_video_mp4',
                                'type'       => 'text',
                                'title'      => __('Slider Video mp4 source'),
                                'dependency' => array('banner_video_enable', '==', 'true'),
                            ),
                            array(
                                'id'        => 'slider_button_enable',
                                'type'      => 'switcher',
                                'title'     => __('Slider Button Enable'),
                            ),
                            array(
                                'id'        => 'slider_button_label',
                                'type'      => 'text',
                                'title'     => __('Slider Button Label'),
                                'dependency' => array('slider_button_enable', '==', 'true'),
                            ),
                            array(
                                'id'        => 'slider_button_url',
                                'type'      => 'text',
                                'title'     => __('Slider Button URL'),
                                'dependency' => array('slider_button_enable', '==', 'true'),
                            ),

                        ),
                        'dependency'      => array('banner_slider_enable', '==', 'true'),
                    ),*/ // end of slider repeater groups

                ),
);

return $common;
}

function rws_common_meta( $post_type )
{
    if($post_type == 'page' || $post_type == 'post') {
        $options = array(
        	'id'        => 'common_heading',
        	'title'     => 'Common '.ucwords( $post_type ).' Options',
        	'post_type' => $post_type,
        	'context'   => 'normal',
        	'priority'  => 'high',
        	'sections'  => array(
              rws_common_metabox_section( $post_type ),
          ),
        );
        $options['sections'][]  = array(
            'id'        => 'rws_page_heading',
            'name'      => 'rws_page_heading',
            'title'     => ucwords( $post_type ).' Heading Block',
            'fields'    => array(
                array(
                    'id'            => 'banner_heading_enable',
                    'type'          => 'switcher',
                    'title'         => __('Banner Image Enable'),
                ),
                array(
                    'id'            => 'rws_page_title',
                    'type'          => 'text',
                    'title'         => ucwords( $post_type ).' Title',
                    'dependency'    => array('banner_heading_enable', '==', 'true'),
                ),
                array(
                    'id'            => 'rws_page_sub_title',
                    'type'          => 'text',
                    'title'         => ucwords( $post_type ).' Second Title',
                    'dependency'    => array('banner_heading_enable', '==', 'true'),
                ),
                array(
                    'id'            => 'rws_page_subtitle',
                    'type'          => 'textarea',
                    'title'         => ucwords( $post_type ).' Subtitle',
                    'dependency'    => array('banner_heading_enable', '==', 'true'),
                ),
                array(
                    'id'            => 'rws_banner_btn_enable',
                    'type'          => 'switcher',
                    'title'         => 'Banner Button Enable',
                    'dependency'    => array('banner_heading_enable', '==', 'true'),
                ),
                array(
                    'id'            => 'rws_banner_btn_label',
                    'type'          => 'text',
                    'title'         => 'Button Label',
                    'dependency'    => array('rws_banner_btn_enable', '==', 'true'),
                ),
                array(
                    'id'            => 'rws_banner_btn_url',
                    'type'          => 'text',
                    'title'         => 'Button URL',
                    'dependency'    => array('rws_banner_btn_enable', '==', 'true'),
                ),

            )
        ); 
    }

    return $options;
}

/**
 *
 * @return array
 */
function rws_metaboxes()
{

    $options[] = array();

    $options[]      = rws_common_meta ( 'page' );
    $options[]      = rws_common_meta ( 'post' );

    //==============  for homepage starts ========================//
    $options[]   = array(
        'id'            => 'rws_homepage_section',
        'title'         => 'Other Content Homepage',
        'post_type'     => 'page',
        'context'       => 'normal',
        'priority'      => 'high',
        'sections'      => array(

            /**
             *  Home Page Venue Section Starts
             */
            array(
                'name'  => 'homepage_our_student',
                'title' => 'Venue',
                'fields'=> array(
                    array(
                        'id'            => 'rws_venue_enable',
                        'type'          => 'switcher',
                        'title'         => 'Venue Enable',
                    ),
                    array(
                      'id'              => 'venue_group_1',
                      'type'            => 'group',
                      'title'           => 'Venue Field',
                      'button_title'    => 'Add New Venue',
                      'accordion_title' => 'Add New Venue',
                      'dependency'      => array('rws_venue_enable', '==','true'),                     
                      'fields'          =>array(

                        array(
                            'id'            => 'venue_title',
                            'type'          => 'text',
                            'title'         => 'Venue title',                           
                        ),
                        array(
                            'id'            => 'venue_image',
                            'type'          => 'image',
                            'title'         => 'Image',
                        ),
                        array(
                            'id'            => 'venue_desc',
                            'type'          => 'textarea',
                            'title'         => 'Description',
                        ),
                    ),   
                  ),
                )   // end fields
            ),
            /**
             *  Home Page Venue Section Ends
             */

           /**
            * Home Page Event Starts
            */
            array(
                'name'              => 'Event',
                'title'             => 'Event Section',
                'fields'            => array(
                    array(
                        'id'            => 'rws_event_enable',
                        'type'          => 'switcher',
                        'title'         => 'Event Enable',
                    ),

                    array(
                        'id'            => 'event_top_title',
                        'type'          => 'text',
                        'title'         => 'Event Title',
                        'dependency'    => array('rws_event_enable', '==','true'),
                    ),
                    
                    array(
                        'id'                => 'event_list',
                        'type'              => 'group',
                        'title'             => 'Event List',
                        'button_title'      => 'Add New Event',
                        'accordion_title'   => 'Add New Event',
                        'dependency'        => array('rws_event_enable', '==','true'),
                        'fields'            => array(
                            array(
                                'id'        => 'event_title',
                                'type'      => 'text',
                                'title'     => 'Event Title',
                            ),
                            
                            array(
                                'id'        => 'event_desc',
                                'type'      => 'textarea',
                                'title'     => 'Event Description',
                            ),
                        ), 
                    ), // end of event section groups

                    array(
                        'id'            => 'event_image',
                        'type'          => 'image',
                        'title'         => 'Event Image',
                        'dependency'    => array('rws_event_enable', '==','true'),
                    ),


                ) //field ends
            ),
           /**
            * Home Page Event Ends
            */

            /**
             * Home Page Sponsor Event Starts
             */
            array(
                'name'             => 'homepage_event_sponsors',
                'title'            => 'Event Sponsor Section',
                'fields'           => array(
                    array(
                        'id'            => 'rws_event_sponsor_enable',
                        'type'          => 'switcher',
                        'title'         => 'Event Sponsor Enable',
                    ),

                    array(
                        'id'            => 'background_sponsor_image',
                        'type'          => 'image',
                        'title'         => 'Background Image',
                    ),

                    array(
                        'id'            => 'event_sponsor_title',
                        'type'          => 'text',
                        'title'         => 'Event Sponsor Title',
                        'dependency'    => array('rws_event_sponsor_enable', '==','true'),
                    ),

                    array(
                        'id'                => 'event_sponsors_images',
                        'type'              => 'group',
                        'title'             => 'Event Sponsors Images',
                        'button_title'      => 'Add New Sponsor Image',
                        'accordion_title'   => 'Add New Image',
                        'dependency'        => array('rws_event_sponsor_enable', '==','true'),
                        'fields'            => array(

                            array(
                                'id'            => 'event_sponsor_image',
                                'type'          => 'image',
                                'title'         => 'Sponsor Image',
                            ),
                        ), 
                    ), // end of page section groups
                )// field Ends
            ),
           /**
            * Home Page Sponsor Event Ends
            */

            /**
             * Home Page Contact Section Starts
             */
            array(
                'name'                  => 'homepage_contact_form',
                'title'                 => 'Contact Form Section',
                'fields'                =>array(
                    array(
                        'id'            => 'rws_contact_enable',
                        'type'          => 'switcher',
                        'title'         => 'Contact Form Enable',
                    ),

                    array(
                        'id'            => 'rws_contact_title',
                        'type'          => 'text',
                        'title'         => 'Event Contact Title',
                        'dependency'    => array('rws_contact_enable', '==','true'),
                    ),

                    array(
                          'id'            => 'rws_contact_1',
                          'type'          => 'textarea',
                          'title'         => 'Contact Form Code',
                          'dependency'    => array('rws_contact_enable', '==','true'),
                          'sanitize'      => 'html',
                          'attributes'    => array(
                                                'style'    => 'width: 100%;'
                                              ),
                          //'desc'          => 'Create a form in Contact Form 7 or Salesforce then use shortcode here.',
                        ),

                ),
            ),
            /**
             * Home Page Contact Section Ends
             */
            
            /**
             * Home Page Key Speaker Selection
             */
            array(
                'name'                  => 'homepage_custom_post_type_selection',
                'title'                 => 'Key Speaker Selection',
                'fields'                => array(
                    array(
                        'id'            => 'rws_post_type_selection_enable',
                        'type'          => 'switcher',
                        'title'         => 'Post Selection Enable',
                    ),
                    array(
                        'id'            => 'keynote_speaker_list_id',
                        'type'          => 'select',
                        'title'         => 'Select Keynote Speaker',
                        'options'       => 'posts',
                        // query_args is option for all
                        'query_args'    => array(
                                    'post_type'   => 'keynote_speaker',
                                    'sort_order'  => 'ASC',
                                    'sort_column' => 'post_title',
                                  ),
                        'dependency'        => array('rws_post_type_selection_enable', '==', 'true'),
                    ),

                  
                ),
            ),

            /**
             * End of key Speaker Selection
             */

    ),//end section
);
    //============== metabox for homepage ends =============================/

return $options;
}

add_action('cs_metabox_options', 'rws_metaboxes');