<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/**
 * Ref sidebar.php
 */
function wpre_load_sidebar_child() {
	$load_sidebar = true;
	if ( get_theme_mod('wpre_disable_sidebar') ) :
		$load_sidebar = false;
	elseif( get_theme_mod('wpre_disable_sidebar_home') && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('wpre_disable_sidebar_front') && ( is_front_page() || is_page() || is_category() ) ) :
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Ref content-grid.php
 */
function wpre_posted_on_child() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Ajouté le %s', 'post date', 'wp-real-estate' ),
		$time_string
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * Prints HTML with meta information for the current post-date/time.
 * Ref content-single.php
 */
function wpre_posted_on_date_child() {
	//OPtimized for Property Lists on Single Posts 
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Ajouté le %s', 'post date', 'wp-real-estate' ),
		$time_string
	);
	
	echo '<span class="posted-on">' . $posted_on . '</span>';
}




