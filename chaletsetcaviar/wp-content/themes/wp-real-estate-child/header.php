<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package wpre
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wp-real-estate' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			
			<div class="site-branding col-md-12 col-sm-12">
				<?php if ( has_custom_logo()) : ?>
				<div id="site-logo">
					<?php the_custom_logo(); ?>
				</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>
			
			
			<nav id="site-navigation" class="main-navigation col-md-12 col-sm-12 title-font" role="navigation">
					<?php $walker = new Wpre_menu_with_Icon;
						if (!has_nav_menu('primary')) :
							$walker = '';
						endif;
					wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
					
					<div class="social-icons">
						<?php get_template_part('social', 'fa'); ?>	 
					</div>
			</nav><!-- #site-navigation -->
			
			
		</div>
	</header><!-- #masthead -->	
	
	<?php if (function_exists('property_detail')) : //Check if Plugin active
                if(is_front_page() || ( isset($_GET['search']))):
		            get_template_part( 'property', 'searchform' );
	        endif;
		endif; ?>

		
	<?php if (has_header_image() & is_front_page()) : ?>
	<div id="header-image" class="container">
		<img src="<?php header_image(); ?>" width="100%">
		
		<?php if (get_theme_mod('wpre_hinfo_enable')) : 
			$pageid = get_theme_mod('wpre_header_content_page'); ?>
			<div class="header-information">
				<div class="header-info-inner">
					<div class="line1 title-font"><?php echo get_the_title($pageid); ?></div>
					<div class="line2"><?php $i = get_post($pageid); echo nl2br($i->post_content); ?></div>
					<a href="<?php echo (get_theme_mod('wpre_header_url')) ? esc_url(get_theme_mod('wpre_header_url')) : esc_url(get_the_permalink($pageid)) ?>" class="learnmore title-font"><?php echo esc_html(get_theme_mod('wpre_header_btn',__('Learn More','wp-real-estate'))); ?></a>
				</div>
			</div>	
		<?php endif; ?>
		
	</div>
	<?php endif; ?>
	
	<?php get_template_part('featured', 'pages'); ?>
		
	<?php get_template_part('featured', 'estates'); ?>
			
	<?php get_template_part('featured', 'listings'); ?>
	
	<div class="mega-container">
		
	
		<div id="content" class="site-content container">