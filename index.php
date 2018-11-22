<?php
get_header(); 
if ( have_posts() ):
	while ( have_posts() ) : the_post();
?>
		
<div id="content" class="site-content">
	<div id="primary" class="content-area">
	    <main id="main" class="site-main" role="main">
	        <section class="other-pages">
	            <div class="container">
	                <header class="entry-header heading">
	                	<?php the_title('<h2 class="entry-title">','</h2>'); ?>
	                </header>
					<?php 
						if(has_post_thumbnail()) {
					  		the_post_thumbnail();
						}
						the_content();
					?>
	            </div>
	        </section>
        </main>
    </div>
</div>

<?php 
	endwhile;
endif;
get_footer (); 