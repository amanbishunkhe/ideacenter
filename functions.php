<?php
/* rws theme supports */
if(!function_exists( 'rws_theme_supports' ) ):

	function rws_theme_supports(){
		// for rss feeds in header
		add_theme_support( 'automatic-feed-links' );
		//generates the title tag
		add_theme_support( 'title-tag' );
		// support for the post thumbnails for posts and pages
		add_theme_support( 'post-thumbnails' );
		// menu for theme
		add_theme_support('menus');

		add_theme_support( 'custom-logo' );

		//registering the menus for the theme
		register_nav_menus( array(
			'primary' 			=> __( 'Primary Menu' ),
			'footer-links' 		=> __( 'Footer Links' ),
			) );

		/*=======================================
		=            thumbnail sizes            =
		=======================================*/
		add_image_size( 'investor-slides', 266, 97, true );
		add_image_size( 'our-culture', 425, 330, true );
		add_image_size( 'current-class', 310, 315, true );
		/* add_image_size( 'about-what-is-artisthub', 58, 57, true );
		add_image_size( 'learn-more-legendary-events', 140, 112, true );*/

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/* Global option for codestar */
		global $rws_options;
		// get all values from theme options
		$rws_options 	= cs_get_all_option();
		/* End of Global option */

	}
add_action( 'after_setup_theme','rws_theme_supports' );
endif;
/* End of rws theme supports */


/**
 * Enqueue styles and scripts
 * @return void
 */
function rws_enqueue_scripts(){
	global $rws_options;

	//adding google fonts
	$query_args = array(
		'family' => 'Montserrat:200,300,400,500,600,700,800,900|Oswald:300,400,500,600,700|Source+Sans+Pro:300,400,600,700,900',
		);
	//var_dump($query_args);
	
	wp_register_style( 'rws-google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array() , null );
    wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri().'/css/owl.carousel.css',array(), 'V2.2.0');
    wp_enqueue_style( 'owl-theme-css', get_template_directory_uri().'/css/owl.theme.css',array(), 'v2.2.0', 'all' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css',array(), 'v3.3.5', 'all' );
    wp_enqueue_style( 'meanmenu.css', get_template_directory_uri().'/css/meanmenu.css',array(), '1.0.0', 'all' );
	wp_enqueue_style( 'rws-style-css', get_stylesheet_uri(), array('rws-google_fonts'), '1.0.0', 'all' );
    wp_enqueue_style( 'responsive.css', get_template_directory_uri().'/css/responsive.css',array(), '1.0.0', 'all' );
    wp_enqueue_style( 'font-awesome.min.css', get_template_directory_uri().'/css/font-awesome.min.css',array(), '1.0.0', 'all' );


	//enqueing scripts
	wp_enqueue_script( 'meanmenu.js', get_template_directory_uri().'/js/jquery.meanmenu.js', array( 'jquery' ), '2.0.2', true );
	wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), 'v3.3.5', true );
	wp_enqueue_script( 'owl.carousel.js', get_template_directory_uri().'/js/owl.carousel.js', array( 'jquery' ), 'v2.2.1', true );
	//wp_enqueue_script( 'jquery-ui.js', '//code.jquery.com/ui/1.11.4/jquery-ui.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'rws-custom-js', get_template_directory_uri().'/js/custom.js', array( 'jquery', 'owl.carousel.js' ), '1.0.0', true );

	$site_title_bg_color 	= $rws_options['site_title_bg_color'];
	$site_title_text_color 	= $rws_options['site_title_text_color'];
	if ( !empty( $site_title_bg_color ) || !empty( $site_title_text_color ) ) {
		$custom_css = '.heading .entry-title,
		.highlight-title {
			background: '.$site_title_bg_color.';
			color: '.$site_title_text_color.';
		}';
	}
	wp_add_inline_style( 'rws-style-css', $custom_css );


}
add_action('wp_enqueue_scripts','rws_enqueue_scripts');
/* End of Enqueue styles and scripts */

//admin area scripts
function rws_admin_custom_scripts() {
	wp_enqueue_script( 'metaboxs-switch', get_template_directory_uri() . '/js/metaswitch.js', '', '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'rws_admin_custom_scripts' );

function rws_artisthub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rws_artisthub_content_width', 640 );
}
add_action( 'after_setup_theme', 'rws_artisthub_content_width', 0 );

/**
 * Register Widget
 */
add_action( 'widgets_init', 'rws_register_sidebars' );
function rws_register_sidebars() {
	//widget support for a footer
	for ($i=1; $i < 5; $i++) {
		register_sidebar(array(
			'name' => 'Footer Widget '.$i,
			'id' => 'footer-widget-'.$i,
			'description' => 'Widgets in this area will be shown on the Footer.',
		  	'before_widget' => '<aside id="%1$s" class="widget">',
		  	'after_widget'  => '</aside>',
		  	'before_title' => '<h2 class="widget-title">',
		  	'after_title' => '</h2>'
		));
	}
	//widget support for a right sidebar
	/*register_sidebar(array(
		'name' => 'Right SideBar',
	  	'id' => 'right-sidebar',
	  	'description' => 'Widgets in this area will be shown on the right-hand side.',
	  	'before_widget' => '<div id="%1$s" class="widget">',
	  	'after_widget'  => '<div class="clear"></div></div>',
	  	'before_title' => '<h3 class="widget-title column-title">',
	  	'after_title' => '</h3>'
	));*/
}

/* Other Dependencies */
require_once(get_template_directory().'/inc/init.php');

/* End of Other Dependencies */


function addNotificationMessage($message, $code=400){
	$_SESSION['error'][] = array($message, $code);
}

function getNotificationMessages($remove = true){
	$temp = $_SESSION['error'];
	if($remove){
		$_SESSION['error'] = array();
	}
	return $temp;
}

//for pagination
function rws_custom_pagination( $wp_query ){
    //global $wp_query;
    $pagination_posts = paginate_links (array('base' => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
            'total'         => $wp_query->max_num_pages,
            'mid_size'      => 2,
            'type'          => 'array',
            'prev_text'     => 'Previous',
            'next_text'     =>'Next'
    ) );
    if ( ! empty( $pagination_posts ) ) { ?>
        <div class="rws-pagination-holder">
            <ul class="pagination">
                <?php foreach ( $pagination_posts as  $key => $page_link ) { ?>
                    <li class="<?php if ( strpos( $page_link, 'current' ) !== false ) { echo 'active'; } ?>"><?php echo $page_link ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php }
}

//for pagination
function rws_ajax_pagination( $wp_query ){

	$current_url = $_POST['current_url'];

	$term_id = $wp_query->query['tax_query'][0]['terms'];
	/*$taxonomy = $wp_query->query['tax_query'][0]['taxonomy'];
	$term = get_term($term_id, $taxonomy);
	$term_link = get_term_link($term);*/

	$pattern = "/(?<=href=(\"|'))[^\"']+(?=(\"|'))/";

   //global $wp_query;
    $pagination_posts = paginate_links (array('base' => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
            'total'         => $wp_query->max_num_pages,
            'mid_size'      => 2,
            'type'          => 'array',
            'prev_text'     => 'Previous',
            'next_text'     =>'Next'
    ) );
    if ( ! empty( $pagination_posts ) ) { ?>
        <div class="rws-pagination-holder">
            <ul class="pagination">
                <?php foreach ( $pagination_posts as  $key => $page_link ) { ?>
                	<?php

                	$page_data = (array)new SimpleXMLElement($page_link);
                	$page_url='';
					if(isset($page_data['@attributes']['href'])){
						$page_url = $page_data['@attributes']['href'];
					}

					$query = array();
					if($page_url){
						$parts = parse_url($page_url);
						parse_str($parts['query'], $query);
					}

					if(isset($query['paged']) ){
						if($term_id){
							$pagination_url = $current_url.'page/'.$query['paged'].'/?class='.$term_id;
						}else{
							$pagination_url = $current_url.'page/'.$query['paged'];
						}
					}else{
						if($term_id){
							$pagination_url = $current_url.'?class='.$term_id;
						}else{
							$pagination_url = $current_url;
						}
					}

					if($page_url){
                		$page_link = preg_replace($pattern, $pagination_url, $page_link);
                	}
                	              	
                	?>
                    <li class="<?php if ( strpos( $page_link, 'current' ) !== false ) { echo 'active'; } ?>"><?php echo $page_link ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php }
}