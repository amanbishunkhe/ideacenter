<?php
get_header();
?>	
<div id="content" class="site-content">
	<div id="primary" class="content-area">
	    <main id="main" class="site-main" role="main">
	        <section class="error-404">
	            <div class="container">
	                <header class="entry-header heading">
	                	<h2 class="entry-title">Page Not Found</h2>
	                </header>
					<div class="entry-content">
	                	<p>404 <span>Error</span></p>
	            	</div>
	            	<div class="page-wrapper">
	            	    <section class="container">
	            	        <?php /*?><h3 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rws-ideacenter' ); ?></h3>
	            			<p>
	            				<?php esc_html_e( 'It looks like nothing was found at this location. You can search for the cool stuff ? ', 'rigorous-themes' ); ?>
	            			</p><?php */ ?>
	            			<?php //get_search_form(); ?>	
	            		</section><!-- .error-404 -->
	            	</div>
	            </div>
	        </section>
        </main>
    </div>
</div>
<?php
get_footer (); 