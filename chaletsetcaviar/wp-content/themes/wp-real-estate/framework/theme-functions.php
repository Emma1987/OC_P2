<?php
/*
 * @package wpre, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */
 
 
class Wpre_Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<br /><span class="menu-desc">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

class Wpre_Menu_With_Icon extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

/*
 * Pagination Function. Implements core paginate_links function.
 */
function wpre_pagination() {
	the_posts_pagination( array( 'mid_size' => 2 ) );
}

/*
** Customizer Controls 
*/
if (class_exists('WP_Customize_Control')) {
	class Wpre_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'wp-real-estate' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
} 

if ( class_exists('WP_Customize_Control') && class_exists('woocommerce') ) {
	class Wpre_WP_Customize_Product_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'wp-real-estate' ),
                    'option_none_value' => '0',
                    'taxonomy'          => 'product_cat',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}    
if (class_exists('WP_Customize_Control')) {
	class Wpre_WP_Customize_Upgrade_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
             printf(
                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $this->description
            );
        }
    }
}

/*
** Function to Automatically Display the Thumbnails, and placeholder if no thumbnail available.
*/
add_filter( 'post_thumbnail_html', 'wpre_new_thumb_sizes', 10, 4 );
function wpre_new_thumb_sizes( $html, $id, $thumb_id, $size ) {
        // Check to see if we are on a singular view.
        if ( ! is_singular() ) :
                // let's check to see if the post has a featured image.
                if ( ! get_post_thumbnail_id( $id ) ) {
                        // if we don't have one, create a fallback for just the wpre-pop-thumb thumbnails.
                        if ( 'wpre-pop-thumb' == $size || 'wpre-thumb' == $size ) {
                                return  '<img src="' . get_template_directory_uri() . '/assets/images/placeholder2.jpg" />';
                        }
                        if ( 'wpre-sq-thumb' == $size ) {
                                return  '<img src="' . get_template_directory_uri() . '/assets/images/placeholder-sq.jpg" />';
                        }
                        // simple message if there is no thumbnail at all.                        
                        return '<h2>'.__('I do not have an image','wp-real-estate').'</h2>';
                }
        endif;
        // return our set featured image.
        return wp_get_attachment_image( $thumb_id, $size );
}

/*
** Function to Use the Property search page, when the Property Search is used.
*/
function wpre_search_tmpl( $template ) {
  if( isset($_REQUEST['search']) == 'property' ) {
        require(get_template_directory().'/property-search-results.php');
        die();
    }
  return $template;
}
add_action('init', 'wpre_search_tmpl');


/*
** Function to Trim the length of Excerpt and More
*/
function wpre_excerpt_length( $length ) {
	return 56;
}
add_filter( 'excerpt_length', 'wpre_excerpt_length', 999 );

function wpre_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'wpre_excerpt_more' );


/*
** Function to check if Sidebar is enabled on Current Page 
*/
function wpre_load_sidebar() {
	$load_sidebar = true;
	if ( get_theme_mod('wpre_disable_sidebar') ) :
		$load_sidebar = false;
	elseif( get_theme_mod('wpre_disable_sidebar_home') && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('wpre_disable_sidebar_front') && is_front_page() ) :
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}

/*
**	Determining Sidebar and Primary Width
*/
function wpre_primary_class() {
	$sw = esc_html( get_theme_mod('wpre_sidebar_width',4) );
	$class = "col-md-".(12-$sw);
	
	if ( !wpre_load_sidebar_child() ) 
		$class = "col-md-12";
	
	echo $class;
}
add_filter('wpre_primary-width', 'wpre_primary_class');

function wpre_secondary_class() {
	$sw = esc_html( get_theme_mod('wpre_sidebar_width',4) );
	$class = "col-md-".$sw;
	
	echo $class;
}
add_filter('wpre_secondary-width', 'wpre_secondary_class');


/*
**	Helper Function to Convert Colors
*/
function wpre_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
function wpre_fade($color, $val) {
	return "rgba(".wpre_hex2rgb($color).",". $val.")";
}


/*
** Function to Get Theme Layout 
*/
function wpre_get_blog_layout(){
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('wpre_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('wpre_blog_layout') );
	else :
		get_template_part( $ldir ,'wp-real-estate');	
	endif;	
}
add_action('wpre_blog_layout', 'wpre_get_blog_layout');

/*
** Function to Set Main Class 
*/
function wpre_get_main_class(){
	
	$layout = get_theme_mod('wpre_blog_layout');
	if (strpos($layout,'wp-real-estate') !== false) {
	    	echo 'wpre-main';
	}		
}
add_filter('wpre_main-class', 'wpre_get_main_class');

/*
** Load WooCommerce Compatibility FIle
*/
if ( class_exists('woocommerce') ) :
	require get_template_directory() . '/framework/woocommerce.php';
endif;



/*
** Load Plugin Recommender
*/
require get_template_directory() . '/framework/recommended-plugins/customizer-notify.php';