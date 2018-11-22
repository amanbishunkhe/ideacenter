	<?php 
		global $rws_options;

		//$cta_section_title 			  = $rws_options['cta_section_title'];
    $cta_section_footer_image     = $rws_options['footer_image'];
		//$cta_section_apply_enable 	  = $rws_options['cta_section_apply_enable'];
		///$cta_section_apply_label 	  = $rws_options['cta_section_apply_label'];
		//$cta_section_apply_link	 	  = $rws_options['cta_section_apply_link'];
		//$cta_section_donate_enable	  = $rws_options['cta_section_donate_enable'];
		//$cta_section_donate_label	  = $rws_options['cta_section_donate_label'];
		//$cta_section_donate_link	  = $rws_options['cta_section_donate_link'];
	?>
            <footer id="colophon" class="site-footer">
                <div class="container">
                    <div class="footer-wrapper">
                      <?php if( !empty( $cta_section_footer_image )):?>
                        <div class="footer-right">
                             <?php 
                                $site_logo_url  = rws_image_src ( array ( 'id' => $cta_section_footer_image, 'size' => 'full' ) );
                                ?>
                            <a href="#">
                                <img src="<?php echo $site_logo_url ?>" alt="">
                            </a>
                        </div>
                      <?php endif;?>
                        <div class="footer-left">
                          <p class="copyright org">
                            <a href="#">Copyright</a> &copy; <?php echo date('Y'); ?>  
                            <a href="#" class="org">University of Notre Dame</a>
                          </p>
                          <p class="contact-info adr">
                            <a href="#" class="site-link">IDEA Center</a>
                            <span class="address">
                                <span class="street-address">1400 E. Angela Blvd</span>,
                                <span class="locality">South Bend</span>, 
                                <span class="region" title="Indiana">IN</span> 
                                <span class="postal-code">46617</span> <span class="country-name">USA</span>
                            </span>
                            <span class="tel phone"><span class="type">Phone</span> 574-631-8825</span>
                          </p>
                          <p><a href="#">Accessibility Information</a></p>
                        </div>
                        
                    </div>
                    
                </div>
            </footer>
</div><!-- end #page -->
<?php wp_footer(); ?>
       <!--js Library  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</body>
</html>