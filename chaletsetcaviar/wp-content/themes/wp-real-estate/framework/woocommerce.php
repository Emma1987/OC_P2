<?php
/*
** WooCommerce Compatibility File for WP Real Estate Theme
** Created by Rohit Tripathi, Rohitink.com (c) 2015
** @package wpre
*/

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'wpre_dequeue_woocommerce_styles' );
function wpre_dequeue_woocommerce_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

//Custom Hooking for Product Loop Page Items.
function wpre_before_wc_title() {
	echo "<div class='product-desc'>";
}
add_action('woocommerce_before_shop_loop_item_title', 'wpre_before_wc_title', 15);

function wpre_after_wc_title() {
	echo "</div>";
}
add_action('woocommerce_after_shop_loop_item_title', 'wpre_after_wc_title');

/**
 * Remove the "shop" title on the main shop page
*/
function wpre_woo_hide_page_title() {
	return false;
}
add_filter( 'woocommerce_show_page_title' , 'wpre_woo_hide_page_title' );

/**
 * Change the Breadcrumb
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wpre_change_breadcrumb_delimiter' );
function wpre_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>>'
	$defaults['delimiter'] = ' <i class="fa fa-angle-right"></i> ';
	return $defaults;
}

/*
 * WooCommerce Output Wrappers for for Single Product(single-product.php) and Product Archives(archive-product.php)
 */
add_action('woocommerce_before_main_content', 'wpre_single_custom_header', 1 );

function wpre_single_custom_header() {
    if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <div class="header-title col-md-12">
            <span><?php woocommerce_page_title(); ?></span>
        </div>
    <?php endif; ?>

    <div id="primary-mono" class="content-area <?php do_action('wpre_primary-width') ?>">
        <main id="main" class="site-main" role="main">
    <?php
}

add_action( 'woocommerce_after_main_content', 'wpre_single_custom_footer', 50 );

function wpre_single_custom_footer() {
    echo "</main></div>";
}


/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
add_filter( 'woocommerce_output_related_products_args', 'wpre_change_related_products_count' );

function wpre_change_related_products_count( $args ) {
     $args['posts_per_page'] = 3;
     $args['columns'] = 3;

     return $args;
}

//Product Gallery Size 
function wpre_gallery_four_columns(  ){
    return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'wpre_gallery_four_columns');

// Change number or products per row to 3
add_filter('loop_shop_columns', 'wpre_loop_columns');
if (!function_exists('wpre_loop_columns')) {
	function wpre_loop_columns() {
		return 3; // 3 products per row
	}
}