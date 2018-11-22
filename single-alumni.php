<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package RWS_ideacenter
 */

get_header(); 

$alumni_meta 		= get_post_meta( get_the_id (), 'alumni_meta', true );

$alumni_school 		= $alumni_meta['alumni_school'];
$alumni_social_links 	= $alumni_meta['alumni_social_link'];
?>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="archive-page-section">
                <div class="container">
            		<?php rws_simple_breadcrumb();?>
                	<div class="row single-student-profile">
						<?php
						while ( have_posts() ) : the_post();
						?>
							<?php if(has_post_thumbnail()) { ?>
								<div class="col-sm-4">
									<?php if( get_the_post_thumbnail_url( get_the_ID(), 'current-class' ) ){ ?>
						  			<?php the_post_thumbnail(); ?>
						  			<?php }else{ ?>
											<img src="<?php echo get_template_directory_uri();  ?>/images/no-image.jpg" alt="">
						  			<?php } ?>
								</div>
							<?php } ?>
							<div class="col-sm-8">
								<header class="entry-header">
									<?php
										the_title( '<h3 class="entry-title">', '</h3>' );
									?>
									<?php if( !empty( $alumni_school )): ?>
										<h4 class="school-name">School Name : <span><?php echo $alumni_school; ?></span></h4>
									<?php endif; ?>
									<?php if( !empty( $alumni_social_links )): ?>
										<div class="menu-social-link-container">
											<ul id="menu-social-link" class="menu">
												<?php foreach ($alumni_social_links as $key => $value): 

												?>
													<li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18"><a href="<?php echo esc_url( $value['alumni_social_link_url'] );?>"> &nbsp; </a></li>
												<?php endforeach; ?>
										</ul></div>
									<?php endif; ?>

								</header><!-- .entry-header -->
								<div class="entry-content">
									<?php
										the_content( sprintf(
											wp_kses(
												/* translators: %s: Name of current post. Only visible to screen readers */
												__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rws-ideacenter' ),
												array(
													'span' => array(
														'class' => array(),
													),
												)
											),
											get_the_title()
										) );

										wp_link_pages( array(
											'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rws-ideacenter' ),
											'after'  => '</div>',
										) );
									?>
								</div><!-- .entry-content -->
							</div>
						<?php endwhile; // End of the loop. ?>					
					</div>
				</div>

			</section>

		</main>
	</div>
</div>
<?php
get_footer();