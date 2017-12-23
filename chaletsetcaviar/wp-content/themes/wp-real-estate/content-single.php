<?php
/**
 * @package wpre
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title title-font">', '</h1>' ); ?>
		
		<div class="entry-meta">
			<?php if ( function_exists('property_post_meta') ) :
				wpre_posted_on_date();	
			else :
				wpre_posted_on();
			endif; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div id="featured-image">
		<?php the_post_thumbnail('full'); ?>
	</div>
	
	<?php if ( function_exists('property_post_meta') ) :
		property_post_meta( 'property-meta-single','text' );	
	endif; ?>
				
			
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'wp-real-estate' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wpre_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
