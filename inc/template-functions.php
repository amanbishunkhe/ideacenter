<?php
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/*================================================
=            Image Template Functions            =
================================================*/

/**
 * Returns the url of image
 * @param  [array] $param 
 * @return string
 */
function rws_image_src( $param ) {

    if( !is_array( $param ) ) {
        return;
    }
    if ( empty ( $param['size'] ) ){

        $param['size']  = 'full' ;
    }
    $image = wp_get_attachment_image_src( $param['id'], $param['size'] );
    
    return $image[0];
}

/*=====  End of Image Template Functions  ======*/

/*=======================================
=            Content Excerpt Length            =
=======================================*/

/**
 * Returns the desired excerpt
 * @param  integer $length 
 * @param  [object]  $post_object
 * @return string
 */
function rws_excerpt( $length = 40, $post_object = null ) {
    global $post;
    if( is_null( $post_object ) ) {
        $post_object = $post;
    }
    $length      = absint( $length );
    
    if( $length < 1 ) {
        $length      = 40;
    }
    
    $content     = strip_shortcodes( $post_object->post_content );

    $excerpt     = trim( wp_trim_words( $content, $length, '...' ) );
    
    return $excerpt;
}

/*=====  End of Content Excerpt Length  ======*/

/**
 * 
 * @param  [string] $text  
 * @param  [int] $limit 
 * @return [string]   
 */
function rws_limit_words( $text, $limit ) {
    $word_arr = explode(" ", $text);

    if (count($word_arr) > $limit) {
        $words = implode(" ", array_slice($word_arr , 0, $limit) ) . ' ...';
        return $words;
    }

    return $text;
}

/**
 * Add new item to admin bar
 * @param  $wp_admin_bar
 * @return void
 */
/*function rws_add_nodes( $wp_admin_bar ) {
    $args = array('id' => 'themeoptions', 'title' => 'Goto Theme Options', 'href' => admin_url( 'themes.php?page=rws-framework' ), 'meta' => array('title' => 'Goto Theme Options Dashboard'));
    $wp_admin_bar->add_node( $args );
}
add_action( 'admin_bar_menu', 'rws_add_nodes', 999 );*/


/**
 * Get youtube source from post content.
 */
function rws_youtube_video_src() {
    global $post;
    
    preg_match_all('/(http|https).*(yout).*/i', $post->post_content, $matches);
    $url = isset($matches[0][0]) ? $matches[0][0]: '';
    
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match); 
    $id = isset($match[1]) ? $match[1]: '';
    //var_dump($id);

    //return 'https://www.youtube.com/watch?v='.$id;
    return 'https://www.youtube.com/embed/'.$id;    
}


/**
 * Exclude p tag to wrap around shortcode
 * @param   $content 
 * @return string
 */
function rws_shortcode_exclude_autop( $content ) {   

    $array = array (
        '<p>['          => '[', 
        ']</p>'         => ']', 
        ']<br />'       => ']',
        ']<br>'         => ']',
        '<p>&nbsp;</p>' => '',
        '<p></p>'       => '',
        '<p></div>'     => '</div>',
        '</h2></p>'     => '</h2>',
        '></p>'         => '>',
        '</a></p>'      => '</a></p>',
        '<p><a'         => '<p><a',
        '<p><'          => '<',
        );

    $content = strtr( $content, $array );

    return $content;
}
// remove_filter( 'the_content', 'wpautop' );
// add_filter( 'the_content', 'wpautop', 99 );
//add_filter( 'the_content', 'rws_shortcode_exclude_autop', 100 );


//created breadcrum function
if( ! function_exists( 'rws_simple_breadcrumb' ) ) :
    /**
     * Simple breadcrumb
     * Source: https://gist.github.com/melissacabral/4032941
     */
    function rws_simple_breadcrumb( $args = array() ){
        $args = wp_parse_args( (array) $args, array(
            //'separator' =>  '&gt;',
            'separator' =>  '',
        ) );

        /* === OPTIONS === */
        //$text['home']     = get_bloginfo( 'name' ); // text for the 'Home' link
        $text['home']     = 'Home'; // text for the 'Home' link
        $text['category'] = __( 'Archive for <em>%s</em>', 'bizlight' ); // text for a category page
        $text['tax']      = __( 'Archive for <em>%s</em>', 'bizlight' ); // text for a taxonomy page
        $text['search']   = __( 'Search results for: <em>%s</em>', 'bizlight' ); // text for a search results page
        $text['tag']      = __( 'Posts tagged <em>%s</em>', 'bizlight' ); // text for a tag page
        $text['author']   = __( 'View all posts by <em>%s</em>', 'bizlight' ); // text for an author page
        $text['404']      = __( 'Error 404', 'bizlight' ); // text for the 404 page

        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter   = ' ' . $args['separator'] . ' '; // delimiter between crumbs
        $before      = '<li class="current">'; // tag before the current crumb
        $after       = '</li>'; // tag after the current crumb
        /* === END OF OPTIONS === */

        global $post;
        $homeLink   = esc_url( home_url( '/' ) );
        $linkBefore = '<li typeof="v:Breadcrumb">';
        $linkAfter  = '</li>';
        $linkAttr   = ' rel="v:url" property="v:title"';
        $link       = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

        if (is_home() || is_front_page()) {

            if ($showOnHome == 1) echo '<ol class="breadcrumb"><li><a href="' . $homeLink . '">' . $text['home'] . '</a></li></div>';

        } else {

            echo '<ol class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

            if ( is_category() ) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) {
                    $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo $cats;
                }
                echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

            } elseif( is_tax('alumni_class') ){
                /*$thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) {
                    $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo $cats;
                }*/

                echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;

            }elseif ( is_search() ) {
                echo $before . sprintf($text['search'], get_search_query()) . $after;

            } elseif ( is_day() ) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
                echo $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {
                echo $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    /*echo '<pre>';
                        print_r($post_type);
                    echo '</pre>';*/
                    printf($link, $homeLink . '/' . $slug['slug'] . 's/', $post_type->labels->name);

                    /* added for custom taxonomy for ideacenter starts */
                    if( get_post_type() == 'alumni' ) {
                        $term_alumni = get_the_terms( $post, 'alumni_class' );
                        if ( !empty( $term_alumni ) ){
                            foreach ( $term_alumni as $key => $value ) {
                                echo '<li><a href="' . get_term_link( $value->term_id ) . '">' . $value->name . '</a></li>';
                            }
                        }
                    }
                    /* addition custom taxonomu for ideacenter Ends */

                    if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo  $cats;
                    if ($showCurrent == 1) echo $before . get_the_title() . $after;
                }


            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
                printf($link, get_permalink($parent), $parent->post_title);
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif ( is_page() && !$post->post_parent ) {
                if ($showCurrent == 1) echo $before . get_the_title() . $after;

            } elseif ( is_page() && $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif ( is_tag() ) {
                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . sprintf($text['author'], $userdata->display_name) . $after;

            } elseif ( is_404() ) {
                echo $before . $text['404'] . $after;
            } 
            /* addition of the URL */
            elseif( is_single( "alumni" ) ) {
                echo "here we are";
            } /* added last condition for custom */

            /* if ( get_query_var('paged') ) {
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo __( 'Page', 'bizlight' ) . ' ' . get_query_var('paged');
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
            } */

            echo '</ol>';
        }
    } // end rws_simple_breadcrumb()
endif;



if ( ! function_exists( 'ideacenter_form_sanitize' ) ) :    
   function ideacenter_form_sanitize( $input ) {
    return  $input;
    }
endif;

