<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================

$settings           = array(
  'menu_title'      => 'Theme Options',
  //'menu_type'       => 'add_theme_page', old version of codestar
  'menu_type'       => 'theme', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'rws-framework',
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'framework_title' => 'PC Framework <small>by Priemer Consulting</small>',
);


// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// a option section for options overview  -
// ----------------------------------------
$options[]      = array(
  'name'        => 'general',
  'title'       => 'General',
  'icon'        => 'fa fa-cog',

  // begin: fields
  'fields'      => array(

    array(
      'id'        => 'site_favicon',
      'type'      => 'image',
      'title'     => 'Favicon',
    ),

    array(
      'id'        => 'site_logo',
      'type'      => 'image',
      'title'     => 'Logo',
    ),

    array(
      'id'         => 'site_copyright',
      'type'       => 'text',
      'title'      => 'Copyright',
      'attributes' => array(
        'style'    => 'width: 100%;'
      ),      
    ),

  ), // end: fields
);


$options[]      = array(
  'name'        => 'social',
  'title'       => 'Social',
  'icon'        => 'fa fa-user-plus',

  // begin: fields
  'fields'      => array(

    array(
      'id'              => 'social_links',
      'type'            => 'group',
      'title'           => 'Social Links',
      'button_title'    => 'Add New',
      'accordion_title' => 'Add New Link',
      'fields'          => array(

        array(
          'id'          => 'site_s_name',
          'type'        => 'text',
          'title'       => 'Social Network Name',
        ),        

        array(
          'id'          => 'site_s_links',
          'type'        => 'text',
          'title'       => 'Social Network Link',
        ),
        array(
          'id'          => 'site_s_class',
          'type'        => 'text',
          'title'       => 'Social Network Class',
        ),

      ),
      'default'                     => array(
        array(
          'site_s_name'            => 'Facebook',         
         
        ),
        array(
          'site_s_name'            => 'Twitter',
         
        ),
      )
    ),

    

  ), // end: fields
);

// ------------------------------
// a option section with tabs   -
// ------------------------------
$options[]   = array(
  'name'     => 'home_options',
  'title'    => 'Home',
  'icon'     => 'fa fa-home',
  'sections' => array(

    // -----------------------------
    // begin: text options         -
    // -----------------------------
    array(
      'name'      => 'text_options',
      'title'     => 'Text',
      'icon'      => 'fa fa-angle-right',

      // begin: fields
      'fields'    => array(

        // begin: a field
        array(
          'id'    => 'unique_text_1',
          'type'  => 'text',
          'title' => 'Text Field',
        ),
        // end: a field        

        array(
          'id'            => 'unique_text_5',
          'type'          => 'text',
          'title'         => 'Text Field with Placeholder',
          'attributes'    => array(
            'placeholder' => 'do stuff...'
          )
        ),
        
      ), // end: fields

    ), // end: text options

    // -----------------------------
    // begin: textarea options     -
    // -----------------------------
    array(
      'name'      => 'textarea_options',
      'title'     => 'Textarea',
      'icon'      => 'fa fa-angle-right',
      'fields'    => array(

        array(
          'id'    => 'unique_textarea_1',
          'type'  => 'textarea',
          'title' => 'Simple Textarea',
        ),

        array(
          'id'        => 'unique_textarea_1_1',
          'type'      => 'textarea',
          'title'     => 'Textarea with Shortcoder',
          'shortcode' => true,
        ),        
      ),

    ), // end: textarea options

  )
);



$options[]      = array(
  'name'        => 'footer',
  'title'       => 'Footer',
  'icon'        => 'fa fa-th',

  // begin: fields
  'fields'      => array(

    array(
      'id'              => 'footer_widgets',
      'type'            => 'group',
      'title'           => 'Footer Widgets',
      'button_title'    => 'Add New',
      'accordion_title' => 'Add New Link',
      'fields'          => array(

        array(
          'id'          => 'widget_col_name',
          'type'        => 'text',
          'title'       => 'Widget Name',
        ),        

        array(
          'id'          => 'widget_col_content',
          'type'        => 'textarea',
          'title'       => 'Widget Content',
        ),
        array(
          'id'          => 'widget_col_class',
          'type'        => 'text',
          'title'       => 'Widget Class',
        ),

      ),
      'default'                     => array(
        array(
          'widget_col_name'            => 'Column 1',         
         
        ),
        array(
          'widget_col_name'            => 'Column 2',
         
        ),
      )
    ),

    

  ), // end: fields
);

CSFramework::instance( $settings, $options );