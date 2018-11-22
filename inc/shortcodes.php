<?php
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/*===========================================
=            Empty Cs Shortcodes            =
===========================================*/
/**
 * @return array
 */
function rws_remove_shortcode_of_cs()
{
    // empty default shorcodes by CS
    $options = array();
    //addition of shortcodes as per theme requirement
    

    return $options;
}

add_action('cs_shortcode_options', 'rws_remove_shortcode_of_cs');

/*=====  End of Empty Cs Shortcodes  ======*/



if ( ! function_exists( 'rws_shortcode_content_two_images' ) ) :
/**
 * Define shortcode for Client Logos (content_two_images)
 *
 * @since Regalmark (2015) 1.0
 */
function rws_shortcode_content_two_images( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'image_left' 	=> '',
		'image_right' 	=> '',
	), $atts) );

	ob_start();
	?>
		<div class="content-two-images">
			<?php if( !empty( $image_left ) ) :
				$left_image_meta 	= wp_get_attachment_image_src( $image_left, 'full' );
			?>
				<div class="content-image-left">
					<img src="<?php echo esc_url( $left_image_meta[0] );?>">
				</div>
			<?php endif; 
			if( !empty( $image_right ) ) : 
				$right_image_meta 	= wp_get_attachment_image_src( $image_right, 'full' );
			?>
				<div class="content-image-right">
					<img src="<?php echo esc_url( $right_image_meta[0] );?>">
				</div>
			<?php endif; ?>
		</div>
	<?php 
	return ob_get_clean();
}
//add_shortcode( 'content_two_images', 'rws_shortcode_content_two_images' );
endif;



if ( ! function_exists( 'rws_cs_shortcode_options_content_two_image' ) ) :
/**
 * Add options for Client Logos in the shortcode generator
 *
 * @since Regalmark (2015) 1.0
 */
function rws_cs_shortcode_options_content_two_image( $options ) {
	$options[] = array(
		// 'title'      => 'Regalmark',
		'shortcodes' => array(
			array(
				'name'         => 'content_two_images',
				'title'        => 'Two Image',
				'fields'       => array(
					array(
						'id'      => 'image_left',
						'type'    => 'image',
						'title'   => 'Left Image',
					),
					array(
						'id'      => 'image_right',
						'type'    => 'image',
						'title'   => 'Right Image',
					),
				), // END fields
			), // END shortcode
		), // END shortcodes
	); // END options
	return $options;
}
//add_filter( 'cs_shortcode_options', 'rws_cs_shortcode_options_content_two_image' );
endif;