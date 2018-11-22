<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RWS_ideacenter
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('archive-post-content-list'); ?>>									
	<?php /* ?><a class="post-img" href="<?php the_permalink();?>">
        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID());;?>" alt="">
    </a><?php */ ?>
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
