<?php
/*
 * Notifications in customize
 */
require get_template_directory() . '/ti-customizer-notify/class-themeisle-customizer-notify.php';

$config_customizer = array(
	'recommended_plugins'       => array(
		'wp-property-listings' => array(
			'recommended' => true,
			/* translators: s - ThemeIsle Companion */
			'description' => sprintf( esc_html__( 'If you want to take full advantage of the options this theme has to offer like ability to add Bathrooms, Rooms, Kitchen, etc to Listings then please install and activate %s. If you are not going to use this theme with on a Real Estate Site, you can simply dismiss this.', 'wp-real-estate' ), sprintf( '<strong>%s</strong>', 'WP Property Listings' ) ),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'wp-real-estate' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugins', 'wp-real-estate' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'wp-real-estate' ),
	'activate_button_label'     => esc_html__( 'Activate', 'wp-real-estate' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'wp-real-estate' ),
);
Themeisle_Customizer_Notify::init( apply_filters( 'ihbp_customizer_notify_array', $config_customizer ) );