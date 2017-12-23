<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function wpre_custom_css_mods() {
	
	$cssmods = "";
	
	if ( get_theme_mod('wpre_title_font') ) :
		$cssmods .= ".title-font, h1, h2, .section-title, .woocommerce ul.products li.product h3 { font-family: ".esc_html( get_theme_mod('wpre_title_font','Montserrat') )."; }";
	endif;
	
	if ( get_theme_mod('wpre_body_font') ) :
		$cssmods .= "body { font-family: ".esc_html( get_theme_mod('wpre_body_font','Source Serif Pro') )."; }";
	endif;
	
	if ( get_theme_mod('header_textcolor','#000') ) :
		$cssmods .= "#masthead h1.site-title a { color: ".esc_html( get_theme_mod('header_textcolor', '#000') )."; }";
	endif;
	
	
	if ( get_theme_mod('wpre_header_desccolor','#777777') ) :
		$cssmods .= ".site-description { color: ".esc_html( get_theme_mod('wpre_header_desccolor','#777777') )."; }";
	endif;
	//Check Jetpack is active
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) )
		$cssmods .= '.pagination { display: none; }';
	
	if ( get_theme_mod('wpre_hide_title_tagline') ) :
		$cssmods .= "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if ( !display_header_text() ) :
		$cssmods .= "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if ( get_theme_mod('wpre_logo_resize') ) :
		$val = esc_html( get_theme_mod('wpre_logo_resize') )/100;
		$cssmods .= "#masthead .custom-logo { transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif; 
		
	wp_add_inline_style('wpre-main-theme-style', $cssmods );	

}

add_action('wp_enqueue_scripts', 'wpre_custom_css_mods');