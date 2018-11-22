<?php

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function rws_keynote_speaker_posttype() {

    $labels = array(
        'name'                => __( 'Keynote Speakers', 'rws-aep' ),
        'singular_name'       => __( 'Keynote Speaker', 'rws-aep' ),
        'add_new'             => _x( 'Add New Keynote Speaker', 'rws-aep', 'rws-aep' ),
        'add_new_item'        => __( 'Add New Keynote Speaker', 'rws-aep' ),
        'edit_item'           => __( 'Edit Keynote Speaker', 'rws-aep' ),
        'new_item'            => __( 'New Keynote Speaker', 'rws-aep' ),
        'view_item'           => __( 'View Keynote Speaker', 'rws-aep' ),
        'search_items'        => __( 'Search Keynote Speaker', 'rws-aep' ),
        'not_found'           => __( 'No Keynote Speaker found', 'rws-aep' ),
        'not_found_in_trash'  => __( 'No Keynote Speakers found in Trash', 'rws-aep' ),
        'parent_item_colon'   => __( 'Parent Keynote Speaker:', 'rws-aep' ),
        'menu_name'           => __( 'Keynote Speakers', 'rws-aep' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'Custom Post Type Created for Our Mentors',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-id',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => false, //set false to remove View btn
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'post-formats')
    );

    register_post_type( 'keynote_speaker', $args );
}

add_action( 'init', 'rws_keynote_speaker_posttype' );


add_filter('manage_keynote_speaker_posts_columns', 'rws_head_only_keynote_speaker');
add_action('manage_keynote_speaker_posts_custom_column', 'rws_content_only_keynote_speaker', 10, 2);
 
//adding column in the listing of the our mentors
function rws_head_only_keynote_speaker($defaults) {
    $defaults['featured_image'] = 'Mentor Image';
    return $defaults;
}
function rws_content_only_keynote_speaker($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
            echo "<img src='".$post_thumbnail_img[0]."' width='80'/>";
        }
    }
}

// set metaboxes
function rws_keynote_speaker_metabox_options( $options ) {
    $options[]    = array(
        'id'        => 'keynote_speaker_id',
        'title'     => 'Keynote Speaker Others Details',
        'post_type' => 'keynote_speaker',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'  => 'general',
                //'title' => 'General',
                //'icon'  => 'fa fa-cog',
                'fields' => array(

                    array(
                        'id'            => 'keynote_speaker_name',
                        'type'          => 'text',
                        'title'         => 'Keynote Speaker Name',                           
                    ),
                    array(
                        'id'            => 'keynote_speaker_designation',
                        'type'          => 'text',
                        'title'         => 'Keynote Speaker Designation'                           
                    ),
                    array(
                        'id'            => 'keynote_speaker_twitter',
                        'type'          => 'text',
                        'title'         => 'Keynote Speaker Twitter URL',
                        'add_title'     => 'Keynote Speaker Twitter ',
                    ),
                    array(
                        'id'            => 'keynote_speaker_linkendin_id',
                        'type'          => 'text',
                        'title'         => 'Keynote Speaker linkedin URL',
                        'add_title'     => 'Keynote Speaker linkedin',
                    ),
                     array(
                        'id'            => 'keynote_speaker_facebook',
                        'type'          => 'text',
                        'title'         => 'Keynote Speaker Facebook URL',
                        'add_title'     => 'Keynote Speaker Facebook',
                    ),
                   
                ), // END fields
            ), // END section
        ), // END sections
    ); // END $options
    return $options;
}
add_filter( 'cs_metabox_options', 'rws_keynote_speaker_metabox_options' );
