<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta name="description" content="New" />
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <meta name="keywords" content="New" />
        <meta name="author" content="New" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Entrepreneurship</title>

<?php wp_head(); ?>
    </head>

<body <?php body_class();?> >
<?php global $rws_options; ?>
<div class="loader"></div>
<div id="page" class="hfeed site">
            <header id="masthead" class="site-header header"  role="banner"> 
                <div class="hgroup-wrap">
                    <div class="container">
                        <div class="site-branding site-title">
                             <?php 
                                    $site_logo_id   = get_theme_mod( 'custom_logo' );
                                    $site_logo_url  = rws_image_src ( array ( 'id' => $site_logo_id, 'size' => 'full' ) );
                                ?>
                                <a href="<?php echo home_url(); ?>">
                                    <?php if($site_logo_id) { ?>
                                        <img src="<?php echo esc_url( $site_logo_url );?>" alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>" >
                                    <?php } else {
                                        echo '<h1>'.get_bloginfo('name').'</h1>';
                                    } ?>
                                </a>                            
                        </div>
                    </div>
                </div>
                <?php
                    global $rws_options;
                    $meta                   = get_post_meta( get_the_id (), 'common_heading', true );
                    // echo "<pre>";
                    // print_r($meta);
                    // echo "</pre>";
                    $banner_image_enable    = $meta['banner_image_enable'];
                    $banner_image_id        = $meta['banner_image'];
                    $banner_heading_enable  = $meta['banner_heading_enable'];
                    $page_title             = $meta['rws_page_title'];
                    $page_sub_title         = $meta['rws_page_sub_title'];
                    $page_subtitle          = $meta['rws_page_subtitle'];
                    $rws_banner_btn_enable  = $meta['rws_banner_btn_enable'];
                    $rws_banner_btn_label   = $meta['rws_banner_btn_label'];
                    $rws_banner_btn_url     = $meta['rws_banner_btn_url'];

                    if ( $banner_image_enable == 1 ): 
                    $banner_image_url   = rws_image_src ( array ( 'id' => $banner_image_id, 'size' => 'full' ) );
                ?>

                <section class="banner-section"  style="background-image: url('<?php echo $banner_image_url; ?>')">
                     
                    
                    <div class="container">
                        <div class="v-center banner-content-section">
                            <div class="highlight-banner-content">
                                <h3><?php echo $page_title;?></h3>
                                <span class="highlight1"></span>
                                <span class="highlight2"></span>
                                <span class="highlight3"></span>
                            </div>
                            <h2><?php echo $page_sub_title;?></h2>
                            <h3>1<?php echo $page_subtitle;?></h3>
                            <?php endif ; ?>
                            <?php  if ( $rws_banner_btn_enable == 1 ): ?>
                            <a href="<?php echo $rws_banner_btn_url;?>" class="box-button"><?php echo $rws_banner_btn_label ?> </a>
                             <?php endif ; ?>
                        </div>
                    </div>
                   
                </section>
                
                 <!-- ends for banner image -->
            </header><!-- #masthead -->
    
    <!-- //fetch value of cs as $rws_options['name_here']; -->