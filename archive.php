<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RWS_ideacenter
 */

get_header(); ?>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="archive-page-section">
                <div class="container">
					<?php
					// some comment here.
					if ( have_posts() ) : ?>
						<?php /* ?>
						<header class="page-header">
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->
						<?php */ ?>

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						//the_posts_navigation();
						
						?>

						  	<nav class="prev-next-posts">
							    <div class="next-posts-link">
							      	<?php echo get_previous_posts_link( 'Newer Articles' ); // display newer posts link ?>
							    </div>
							    <div class="prev-posts-link">
							      	<?php //echo get_next_posts_link( 'Older Articles', $most_recomended_query->max_num_pages ); // display older posts link ?>
							      	<?php echo get_next_posts_link( 'Older Articles' ); // display older posts link ?>
							    </div>
						 	</nav>

						<?php
						

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
				</div>
			</section>
		</main>
	</div>
</div>
<?php
get_footer();