jQuery(document).ready(function() {

  jQuery('#page_template').change(function() {
    //jQuery('#common_heading').hide();
    jQuery('#rws_homepage_section').hide();


    switch (jQuery(this).val()) {
      case 'templates/template-homepage.php':
      //jQuery('#common_heading').show();
      jQuery('#rws_homepage_section').show();      
      break;

      default:
      jQuery('#notice_section').show();
      break;
    }
  }).change();

});