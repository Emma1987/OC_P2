<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpre
 */

get_header(); ?>

	<div id="primary" class="content-areas <?php apply_filters('wpre_primary-width','wpre_primary_class') ?>">
		<main id="main" class="site-main <?php apply_filters('wpre_main-class', 'wpre_get_main_class'); ?>" role="main">
		<?php if (is_home() ) : ?>
			<div class="col-md-12 index-title"><div class="section-title title-font"><?php _e('Latest Listings','wp-real-estate'); ?></div></div>
		<?php endif; ?>	
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 */
					do_action('wpre_blog_layout'); 
					
				?>

			<?php endwhile; ?>

			<?php wpre_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
