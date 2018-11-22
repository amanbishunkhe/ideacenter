<?php 
/*
Template Name: Event Template
*/
get_header();
global $rws_options;

$homepage_meta			        = get_post_meta( get_the_id (), 'rws_homepage_section', true );

//veneue part
$venue_enable                   = $homepage_meta['rws_venue_enable'];
$venue_section                  = $homepage_meta['venue_group_1'];

//event part
$event_enable                   = $homepage_meta['rws_event_enable'];
$event_top_title                = $homepage_meta['event_top_title'];
$group_event_list               = $homepage_meta['event_list'];
$event_section_image_id         = $homepage_meta['event_image'];

//sponsor part
$sponsor_enable                 = $homepage_meta['rws_event_sponsor_enable'];
$sponsor_background_image_id    = $homepage_meta['background_sponsor_image'];
$sponsor_title                  = $homepage_meta['event_sponsor_title'];
$sponsors_images_id             = $homepage_meta['event_sponsors_images'];

//contact part
$contact_enable                 = $homepage_meta['rws_contact_enable'];
$contact_title                  = $homepage_meta['rws_contact_title'];
$contact_shotcode               = $homepage_meta['rws_contact_1'];



?>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if( 1 == $venue_enable ): ?>  
                <section class="event-date-section">
                    <div class="container">
                        <?php
                    // echo '<pre>';
                    // print_r($venue_section);
                    // echo '<pre>';
                        foreach ($venue_section as $venue_detail_list) {
                         $venue_title=$venue_detail_list['venue_title'];
                         $venue_image_id=$venue_detail_list['venue_image'];
                         $venue_description=$venue_detail_list['venue_desc'];
                         ?>
                         <div class="col-sm-4">
                            <div class="event-date-child">                            
                                <h3 class="entry-title"><?php echo ($venue_title) ? $venue_title : 'Date' ?></h3>
                                <?php
                                $image_src = rws_image_src ( array ( 'id' => $venue_image_id, 'size' => 'large' ) );
                                ?>
                                <figure class="featured-image">
                                    <img src="<?php echo $image_src;?>" alt="">
                                </figure>
                                <span><?php echo wpautop( $venue_description ); ?></span>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>
        <?php endif; ?>
        <!-- End of Venue Section -->

        <?php if( 1 == $event_enable ): ?>  
            <section class="event-information-section">
                <div class="container">
                    <h2 class="section-title"><?php echo ($event_top_title) ? $event_top_title : 'ABOUT EVENT' ?></h2>
                    <div class="event-information-wrapper">
                        <?php
                        foreach ($group_event_list as $value) {
                            $event_title=$value['event_title'];
                            $event_desc=$value['event_desc'];
                            ?>
                            <div class="event-information-text">
                                <h3><?php echo $event_title; ?></h3>
                                <p><?php echo $event_desc; ?> </p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="featured-image">
                        <?php
                        $event_image_src = rws_image_src ( array ( 'id' => $event_section_image_id, 'size' => 'large' ) );
                        ?>
                        <img src="<?php echo $event_image_src;?>" alt="">
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- End of Event Section -->

        <section class="testimonial-section">
            <div class="container">
                <?php
               //  $post_type_selected = $homepage_meta['rws_post_type_selection_enable'];
                $post_type_selected = $homepage_meta['keynote_speaker_list_id'];

                $keynote_speaker_args   =  array(
                    'p'                 => absint( $post_type_selected ),
                    'post_type'         => 'keynote_speaker',
                    'post_status'       => 'publish',
                    'posts_per_page'    => 1
                );

                $keynote_speaker_post_query = new WP_Query($keynote_speaker_args);

                if($keynote_speaker_post_query->have_posts())
                {
                    while($keynote_speaker_post_query->have_posts())
                    {
                        $keynote_speaker_post_query->the_post();
                        $title=get_the_title();
                        ?>
                        <div class="speaker">
                            <h2 class="entry-title"><?php echo ($title) ? $title : 'KEYNOTE SPEAKER' ?></h2>
                        </div>
                        <div class="testimonial-content-wrapper">
                            <div class="testimonial-image-wrap">
                                <div class="image-skew">                       
                                    <figure class="testimonial-image">
                                        <?php the_post_thumbnail( 'medium' );?>
                                    </figure>
                                </div>
                                <?php 
                                $keynote_speaker_meta_values = get_post_meta( get_the_id (), 'keynote_speaker_id', true );

                                if(isset($keynote_speaker_meta_values['keynote_speaker_name']))
                                {
                                   $keynote_speaker_name = $keynote_speaker_meta_values['keynote_speaker_name'];
                               }

                               if(isset($keynote_speaker_meta_values['keynote_speaker_designation']))
                               {
                                   $keynote_speaker_designation = $keynote_speaker_meta_values['keynote_speaker_designation'];
                               }

                               if(isset($keynote_speaker_meta_values['keynote_speaker_twitter']))
                               {
                                   $keynote_speaker_twitter = $keynote_speaker_meta_values['keynote_speaker_twitter'];
                               } 

                               if(isset($keynote_speaker_meta_values['keynote_speaker_linkendin_id']))
                               {
                                   $keynote_speaker_linkedin = $keynote_speaker_meta_values['keynote_speaker_linkendin_id'];
                               } 
                                if(isset($keynote_speaker_meta_values['keynote_speaker_facebook']))
                               {
                                   $keynote_speaker_facebook = $keynote_speaker_meta_values['keynote_speaker_facebook'];
                               }   
                               ?>
                               <div class="menu-social-link-container">
                                <ul class="menu"> 
                                    <?php if( !empty( $keynote_speaker_linkedin )): ?>                                          
                                    <li><a href="<?php echo $keynote_speaker_linkedin;?>" target="_blank"><?php echo $keynote_speaker_linkedin;?></a></li>                 
                                    <?php endif; ?>
                                    <?php if( !empty( $keynote_speaker_twitter )): ?> 
                                    <li><a href="<?php echo $keynote_speaker_twitter;?>"  target="_blank"><?php echo $keynote_speaker_twitter;?></a></li>
                                    <?php endif; ?>
                                    <?php if( !empty( $keynote_speaker_facebook )): ?> 
                                    <li><a href="<?php echo $keynote_speaker_facebook;?>"  target="_blank"><?php echo $keynote_speaker_facebook;?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="speaker-info">
                            <h3 class="author-name"><?php echo $keynote_speaker_name;?></h3>
                            <span class="designation"><?php echo $keynote_speaker_designation?></span>
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                    <?php                       
                }
                wp_reset_postdata();
            }

            ?>

        </div>
        </section>
        <!-- End of Keynote Speaker section-->

        <?php if( 1 == $sponsor_enable ): ?>  
        <?php
        $image_src = rws_image_src ( array ( 'id' => $sponsor_background_image_id, 'size' => 'large' ) );        
        ?>
        <section class="sponser-section" style="background-image: url('<?php echo $image_src; ?>')">
            <div class="container">
                <h2 class="section-title"><?php echo $sponsor_title;?></h2>
                <div id="" class="owl-carousel owl-theme sponser-slider">
                    <?php
                    foreach ($sponsors_images_id as  $value) {                        
                        $sponsor_image_id=$value['event_sponsor_image'];
                        $image_src = rws_image_src ( array ( 'id' => $sponsor_image_id, 'size' => 'large' ) );
                        ?>
                        <div class="sponser-logo">
                            <figure>
                                <img src="<?php echo $image_src;?>" alt="">
                            </figure>
                        </div>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
        </section>
        <?php endif; ?>
        <!-- End of Sponsor section -->

        <?php if( 1 == $contact_enable ): ?> 
            <section class="event-registration-section">
                <div class="container">                
                    <h2 class="section-title"><?php echo $contact_title ;?></h2>
                    <form>
                        <?php
                            echo  $contact_shotcode;
                        ?>
                    </form>
                </div>
            </section>
        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->
</div><!-- #content -->

<?php get_footer();