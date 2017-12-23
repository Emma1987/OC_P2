<?php
/**
 * @package WP Real Estate
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-3 col-xs-12 estates'); ?>>
		<div class="featured-thumb">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('wpre-sq-thumb'); ?></a>
			<div class="out-thumb">
			<?php if ( function_exists('property_post_meta') ) : 
				property_post_meta( 'archive-layout' );	
			endif; ?>
			<h2 class="entry-header">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2><!-- .entry-header -->	
			</div>
		</div><!--.featured-thumb-->							
</article><!-- #post-## -->