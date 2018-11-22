<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package RWS_ideacenter
 */

get_header(); 

$meta               = get_post_meta( get_the_id (), 'common_heading', true );
    /*echo "<pre>";
    print_r($meta);
    echo "</pre>";  */     

?>
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="archive-page-section">
                <div class="container">
					<?php
					while ( have_posts() ) : the_post();
					?>
						<header class="entry-header">
							<?php
								the_title( '<h1 class="entry-title">', '</h1>' );
							?>
						</header><!-- .entry-header -->					
						<?php /* ?>
						<div class="social-cat-container">
							<div class="social-content">
								<span>SHARE</span>
								<div class="inline-social-icon">
									<ul>
										<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="fa fa-facebook" target="_blank"></a></li>

										<li><a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" class="fa fa-twitter" target="_blank"></a></li>

										<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=&source=" class="fa fa-linkedin" target="_blank"></a></li>
									</ul>
								</div>
							</div>
							<div class="category-content">
								<?php echo get_the_category_list(); ?>
							</div>
						</div><?php */ ?>

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

						<?php //artisthub_record_views( get_the_ID() ); // Record post view ?>

				</div>

				<?php 
					/* $args = array(
						'fields'=>'ids'
						);
					$related_catId = wp_get_post_categories( get_the_ID(), $args );

					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'post_status' => 'publish',
						'category__in' => $related_catId,		
						'post__not_in'  =>array(get_the_ID())
					);
					$related_posts = new WP_Query($args);
					if ($related_posts->have_posts()): ?>
						<div class="single-related-post">
							<div class="container">
								<h2 class="entry-title related-article-title"><?php esc_html_e('Related Articles'); ?></h2>
								<div class="related-posts-list">
									<?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class('archive-post-content-list'); ?>>									
								        	<a class="post-img" href="<?php the_permalink();?>">
							                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID());;?>" alt="">
							                </a>
							                <?php 
							                	if( has_post_thumbnail() ){
							                		echo "<figure class='post-thumb-img'>";
							                		the_post_thumbnail('blog-list-thumb');	
							                		echo "</figure>";
							                	}
							                ?>
							                <div class="category-list">
												<?php echo get_the_category_list(', '); ?>
											</div>
											<?php
												the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
											?>
										</article><!-- #post-<?php the_ID(); ?> -->
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</div><!-- .related-posts-list -->
								<div class="view-all-btn">
									 <a href="<?php echo get_category_link( $related_catId[0] );?>">View All Articles</a>
								</div>
							</div>
						</div><!-- .single-related-post -->
					<?php endif; */?>

					<div class="container">
					<?php
						//get_template_part( 'template-parts/content', get_post_format() );
						//the_post_navigation();
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>
					</div>
					<?php endwhile; // End of the loop. ?>					

			</section>

		</main>
	</div>
</div>
<?php
get_footer();