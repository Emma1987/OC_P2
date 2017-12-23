<?php
//	
// The Template to render the search form for properties, only when WP Property Listings Plugin is Active.
// This template will not be included when the plugin is not active.
//	
?>


<div id="property-search-form" class="container">
<div class="psf-inner">	
<form method="get" id="property-searchform" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <!-- PASSING THIS TO TRIGGER THE ADVANCED SEARCH RESULT PAGE FROM functions.php -->
    <input type="hidden" name="search" value="property">
    <fieldset>
    <input type="text" value="<?php echo (isset($_GET['name'])) ? $_GET['name'] : ''?>" placeholder="<?php _e( 'Property Name or Area', 'wp-real-estate' ); ?>" name="name" id="name" />
    </fieldset>
    
	<fieldset>
	<label for="listing_type" class=""><?php _e( 'For: ', 'wp-real-estate' ); ?></label>
    <select name="listing_type" id="listing_type">
        <option <?php echo (isset($_GET['listing_type']) && $_GET['listing_type'] == 'rent') ? 'selected' : ''?> value="rent"><?php _e( 'Rent', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['listing_type']) && $_GET['listing_type'] == 'sale') ? 'selected' : ''?> value="sale"><?php _e( 'Sale', 'wp-real-estate' ); ?></option>
    </select>
	</fieldset>
	
	<fieldset>
    <label for="bed" class=""><?php _e( 'Bedrooms (Min): ', 'wp-real-estate' ); ?></label>
    <select name="bed" id="bed">
        <option <?php echo (isset($_GET['bed']) && $_GET['bed'] == '1') ? 'selected' : ''?> value="1"><?php _e( '1', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bed']) && $_GET['bed'] == '2') ? 'selected' : ''?> value="2"><?php _e( '2', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bed']) && $_GET['bed'] == '3') ? 'selected' : ''?> value="3"><?php _e( '3', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bed']) && $_GET['bed'] == '4') ? 'selected' : ''?> value="4"><?php _e( '4', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bed']) && $_GET['bed'] == '5') ? 'selected' : ''?> value="5"><?php _e( '5', 'wp-real-estate' ); ?></option>
		<option <?php echo (isset($_GET['bed']) && $_GET['bed'] == '6') ? 'selected' : ''?> value="6"><?php _e( '6', 'wp-real-estate' ); ?></option>
    </select>
	</fieldset>
	
	<fieldset>
	<label for="bath" class=""><?php _e( 'Bathrooms (Min): ', 'wp-real-estate' ); ?></label>
    <select name="bath" id="bath">
        <option <?php echo (isset($_GET['bath']) && $_GET['bath'] == '1') ? 'selected' : ''?> value="1"><?php _e( '1', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bath']) && $_GET['bath'] == '2') ? 'selected' : ''?> value="2"><?php _e( '2', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bath']) && $_GET['bath'] == '3') ? 'selected' : ''?> value="3"><?php _e( '3', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bath']) && $_GET['bath'] == '4') ? 'selected' : ''?> value="4"><?php _e( '4', 'wp-real-estate' ); ?></option>
        <option <?php echo (isset($_GET['bath']) && $_GET['bath'] == '5') ? 'selected' : ''?> value="5"><?php _e( '5', 'wp-real-estate' ); ?></option>
		<option <?php echo (isset($_GET['bath']) && $_GET['bath'] == '6') ? 'selected' : ''?> value="6"><?php _e( '6', 'wp-real-estate' ); ?></option>
    </select>
	</fieldset>
    
    <fieldset>
    <label for="cost" class=""><?php _e( 'Cost (Max) : ', 'wp-real-estate' ); ?></label>
    <input type="number" step="0.1" value="<?php echo (isset($_GET['cost'])) ? $_GET['cost'] : ''?>" placeholder="<?php _e( '240000 (no symbols)', 'wp-real-estate' ); ?>" name="cost" id="cost" />
    </fieldset>
    
    <fieldset>
    <input type="submit" id="searchsubmit" value="Search" />
    </fieldset>
</form>
</div>
</div>