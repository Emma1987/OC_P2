<?php
/**
 * @package WP Real Estate
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 grid wpre'); ?>>

		<div class="featured-thumb col-md-3 col-sm-4">
			<?php the_post_thumbnail('wpre-sq-thumb'); ?>		
		</div><!--.featured-thumb-->
			
		<div class="out-thumb col-md-9 col-sm-8">
			<header class="entry-header">
				<h1 class="entry-title title-font"><a class="hvr-underline-reveal" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<span class="entry-excerpt"><?php the_excerpt(); ?></span>
				<span class="readmore"><a href="<?php the_permalink() ?>"><?php _e('Read More','wp-real-estate'); ?></a></span>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->
							
</article><!-- #post-## -->