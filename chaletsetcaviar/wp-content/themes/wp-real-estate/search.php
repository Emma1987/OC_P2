<?php
/**
 * The template for displaying search results pages.
 *
 * @package wpre
 */

get_header(); ?>

	<div id="primary" class="content-area <?php apply_filters('wpre_primary-width','wpre_primary_class') ?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wp-real-estate' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				  */
				do_action('wpre_blog_layout'); 
				?>

			<?php endwhile; ?>

			<?php wpre_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
