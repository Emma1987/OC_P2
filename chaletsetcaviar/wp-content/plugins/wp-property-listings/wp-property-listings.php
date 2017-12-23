<?php
/*
Plugin Name: WP Propery Listings
Description:  Adds Meta boxes to your existing posts to convert them from regular posts into a property listing. The Options added include No. of Bedrooms, Bathrooms, Rent or Sale Property and Cost. Originally Designed to Work with WP Real Estate WordPress Theme. 
Version: 1.0.1
Author: Rohit Tripathi
Author URI: http://rohitink.com
License: GPLv3


Naming of Functions:
- Functions to be used only by the plugin have the prefix wppl_
- Functions to be used by the theme also have the prefix property_

*/

if(!defined('WPPL_URL')){
	define('WPPL_URL', plugin_dir_url(__FILE__) );
}


//LOAD TEXTDOMAIN
add_action( 'plugins_loaded', 'wppl_textdomain' );
function wppl_textdomain() {
  load_plugin_textdomain( 'wp-property-listings', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

//Warn user if the current theme doesn't support the plugin
function wppl_admin_notice__error() {
	if (!get_theme_support('wp-property-listings')) :
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Your Theme Does not Support the WP Property Listings Plugin.', 'wp-property-listings' ); ?></p>
    </div>
    <?php
	endif; 
}
add_action( 'admin_notices', 'wppl_admin_notice__error' );

//Function to fetch all values.
function property_detail( $value ) {
	global $post;
	
	if ($value == 'currency') {
		$options = get_option( 'wppl_settings' );
		if (isset($options['wppl_currency'])) {
			return $options['wppl_currency'];
		} else {
			return ''; //Default Currency Value
		}
		
	}

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

//Create Meta Boxes for both posts types (post and property(added by themes))
function property_add_meta_box() {
	add_meta_box(
		'property-details',
		__( 'Propriétés', 'property' ),
		'property_html',
		'post',
		'side',
		'high'
	);
	add_meta_box(
		'property-details',
		__( 'Propriétés', 'property' ),
		'property_html',
		'property',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'property_add_meta_box' );

function property_html( $post) {
	wp_nonce_field( '_property_nonce', 'property_nonce' ); ?>

	<p><?php _e('Entrez les détails relatifs au bien.','wp-property-listings'); ?></p>

	<p>
		<label for="property_rooms"><?php _e( 'Pièces', 'property' ); ?></label><br>
		<select name="property_rooms" id="property_rooms">
			<option <?php echo (property_detail( 'property_rooms' ) === '-' ) ? 'selected' : '' ?>><?php _e('-','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '1' ) ? 'selected' : '' ?>><?php _e('1','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '2' ) ? 'selected' : '' ?>><?php _e('2','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '3' ) ? 'selected' : '' ?>><?php _e('3','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '4' ) ? 'selected' : '' ?>><?php _e('4','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '5' ) ? 'selected' : '' ?>><?php _e('5','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '6' ) ? 'selected' : '' ?>><?php _e('6','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '7' ) ? 'selected' : '' ?>><?php _e('7','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '8' ) ? 'selected' : '' ?>><?php _e('8','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '9' ) ? 'selected' : '' ?>><?php _e('9','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_rooms' ) === '10' ) ? 'selected' : '' ?>><?php _e('10','wp-property-listings'); ?></option>
		</select>
	</p>	<p>
		<label for="property_bedrooms"><?php _e( 'Chambres', 'property' ); ?></label><br>
		<select name="property_bedrooms" id="property_bedrooms">
			<option <?php echo (property_detail( 'property_bedrooms' ) === '-' ) ? 'selected' : '' ?>><?php _e('-','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '1' ) ? 'selected' : '' ?>><?php _e('1','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '2' ) ? 'selected' : '' ?>><?php _e('2','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '3' ) ? 'selected' : '' ?>><?php _e('3','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '4' ) ? 'selected' : '' ?>><?php _e('4','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '5' ) ? 'selected' : '' ?>><?php _e('5','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '6' ) ? 'selected' : '' ?>><?php _e('6','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '7' ) ? 'selected' : '' ?>><?php _e('7','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '8' ) ? 'selected' : '' ?>><?php _e('8','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '9' ) ? 'selected' : '' ?>><?php _e('9','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_bedrooms' ) === '10' ) ? 'selected' : '' ?>><?php _e('10','wp-property-listings'); ?></option>
		</select>
	</p>	<p>
		<label for="property_listing_type"><?php _e( 'Type d\'offre', 'property' ); ?></label><br>
		<select name="property_listing_type" id="property_listing_type">
			<option <?php echo (property_detail( 'property_listing_type' ) === '-' ) ? 'selected' : '' ?>><?php _e('-','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_listing_type' ) === 'Location' ) ? 'selected' : '' ?>><?php _e('Location','wp-property-listings'); ?></option>
			<option <?php echo (property_detail( 'property_listing_type' ) === 'Vente' ) ? 'selected' : '' ?>><?php _e('Vente','wp-property-listings'); ?></option>
		</select>
	</p>	<p>
		<label for="property_cost"><?php _e( 'Prix', 'property' ); ?></label><br>
		<input type="text" name="property_cost" id="property_cost" value="<?php echo property_detail( 'property_cost' ); ?>">
	</p><?php
}

function property_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['property_nonce'] ) || ! wp_verify_nonce( $_POST['property_nonce'], '_property_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['property_rooms'] ) )
		update_post_meta( $post_id, 'property_rooms', esc_attr( $_POST['property_rooms'] ) );
	if ( isset( $_POST['property_bedrooms'] ) )
		update_post_meta( $post_id, 'property_bedrooms', esc_attr( $_POST['property_bedrooms'] ) );
	if ( isset( $_POST['property_listing_type'] ) )
		update_post_meta( $post_id, 'property_listing_type', esc_attr( $_POST['property_listing_type'] ) );
	if ( isset( $_POST['property_cost'] ) )
		update_post_meta( $post_id, 'property_cost', esc_attr( $_POST['property_cost'] ) );
}
add_action( 'save_post', 'property_save' );

/*
	Function to Display all Property Values.
*/

function property_post_meta( $class, $type = 'icon' ){ ?>
	<?php if ($type == 'text') :
		$salerent = "<i class='fa fa-tags'></i> ".__('','wp-property-listings');
		$bedrooms = "<i class='fa fa-home'></i> ".__('Pièces ','wp-property-listings');
		$bathrooms = "<i class='fa fa-bed'></i>".__('Chambres ','wp-property-listings');
	else :
		$salerent = "<i class='fa fa-tags'></i>";
		$bedrooms = "<i class='fa fa-home'></i>";
		$bathrooms = "<i class='fa fa-bed'></i>";
	endif;	?>
	<div class="property-info <?php echo $class; ?>">
		<?php if ( (property_detail('property_listing_type')) &&  property_detail('property_listing_type') != '-' ) : ?>
			<span class="salerent"><?php echo $salerent.property_detail('property_listing_type'); ?></span>
		<?php endif; ?>	
		
		<?php if ( (property_detail('property_rooms')) &&  property_detail('property_rooms') != '-' ) : ?>
			<span class="bedrooms"><?php echo $bedrooms.property_detail('property_rooms'); ?></span>
		<?php endif; ?>	
		<?php if ( (property_detail('property_bedrooms')) &&  property_detail('property_bedrooms') != '-' ) : ?>
			<span class="bathrooms"><?php echo $bathrooms.property_detail('property_bedrooms'); ?></span>
		<?php endif; ?>	
		<?php if ( (property_detail('property_cost')) &&  property_detail('property_bathrooms') != '' ) : ?>
			<span class="cost"><?php echo property_detail('currency')." ".property_detail('property_cost'); ?></span>
		<?php endif; ?>
	</div>
<?php			
}


//
//Create the Plugin's Settings Page
//
add_action( 'admin_menu', 'wppl_add_admin_menu' );
add_action( 'admin_init', 'wppl_settings_init' );


function wppl_add_admin_menu(  ) { 
	add_options_page( 'WP Property Listings', 'WP Property Listings', 'manage_options', 'wp_property_listings', 'wppl_options_page' );
}


function wppl_settings_init(  ) { 

	register_setting( 'pluginPage', 'wppl_settings' );

	add_settings_section(
		'wppl_pluginPage_section', 
		__( 'Plugin Settings', 'wp-property-listings' ), 
		'wppl_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'wppl_currency', 
		__( 'Currency', 'wp-property-listings' ), 
		'wppl_currency_render', 
		'pluginPage', 
		'wppl_pluginPage_section' 
	);

}


function wppl_currency_render(  ) { 

	$options = get_option( 'wppl_settings' );
	?>
	<input type='text' placeholder="<?php _e('$, £, INR, USD, etc','wp-property-listings') ?>" name='wppl_settings[wppl_currency]' value='<?php echo $options['wppl_currency']; ?>'>
	<?php

}

function wppl_settings_section_callback(  ) { 

	echo __( 'Settings for the WP Property Listings Plugin.', 'wp-property-listings' );

}


function wppl_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2><?php _e('WP Property Listings','wp-property-listings') ?></h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}
