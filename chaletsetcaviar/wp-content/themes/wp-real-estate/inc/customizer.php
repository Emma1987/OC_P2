<?php
/**
 * wpre Theme Customizer
 *
 * @package wpre
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wpre_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';



    //Logo Settings
    $wp_customize->get_section( 'title_tagline' )->title = __( 'Title, Tagline & Logo', 'wp-real-estate' );

    $wp_customize->add_setting( 'wpre_logo_resize' , array(
        'default'     => 100,
        'sanitize_callback' => 'wpre_sanitize_positive_number',
    ) );
    $wp_customize->add_control(
        'wpre_logo_resize',
        array(
            'label' => __('Resize & Adjust Logo','wp-real-estate'),
            'section' => 'title_tagline',
            'settings' => 'wpre_logo_resize',
            'priority' => 6,
            'type' => 'range',
            'active_callback' => 'wpre_logo_enabled',
            'input_attrs' => array(
                'min'   => 30,
                'max'   => 200,
                'step'  => 5,
            ),
        )
    );

    function wpre_logo_enabled($control) {
        $option = $control->manager->get_setting('custom_logo');
        return $option->value() == true;
    }

    //Replace Header Text Color with, separate colors for Title and Description
    $wp_customize->get_setting('header_textcolor')->default = '#000';
    $wp_customize->get_control('header_textcolor')->label =  __('Site Title Color','wp-real-estate');

    $wp_customize->add_setting('wpre_header_desccolor', array(
        'default'     => '#777777',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'wpre_header_desccolor', array(
            'label' => __('Site Tagline Color','wp-real-estate'),
            'section' => 'colors',
            'settings' => 'wpre_header_desccolor',
            'type' => 'color'
        ) )
    );

    $wp_customize->add_panel(
        'wpre_header_settings',
        array(
            'title'     => __('Header Settings','wp-real-estate'),
            'priority'  => 34,
        )
    );

    $wp_customize->add_section(
        'wpre_header_content',
        array(
            'title'     => __('Header Content','wp-real-estate'),
            'panel' => 'wpre_header_settings',
            'priority'  => 5,
        )
    );

    $wp_customize->add_setting(
        'wpre_hinfo_enable',
        array( 'sanitize_callback' => 'wpre_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'wpre_hinfo_enable', array(
            'settings' => 'wpre_hinfo_enable',
            'label'    => __( 'Enable Header Content', 'wp-real-estate' ),
            'section'  => 'wpre_header_content',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'wpre_header_content_page',
        array( 'sanitize_callback' => 'absint' )
    );

    $wp_customize->add_control(
        'wpre_header_content_page', array(
            'settings' => 'wpre_header_content_page',
            'label'    => __( 'Fetch Content from Page','wp-real-estate' ),
            'description'    => __( 'The Page you Select Must have only <br/>- Short Title (1-2 Words) <br />- 1-2 Lines of Content.','wp-real-estate' ),
            'section'  => 'wpre_header_content',
            'type'     => 'dropdown-pages',
            'allow_addition' => true,
        )
    );

    $wp_customize->add_setting(
        'wpre_header_btn',
        array( 'default'=> __('Learn More','wp-real-estate'), 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'wpre_header_btn', array(
            'settings' => 'wpre_header_btn',
            'label'    => __( 'Button Text','wp-real-estate' ),
            'description'    => __( 'Enter the text for the Call to Action Button. e.g. Learn More, Buy Now, Sign Up, etc.','wp-real-estate' ),
            'section'  => 'wpre_header_content',
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'wpre_header_url',
        array( 'sanitize_callback' => 'esc_url_raw' )
    );

    $wp_customize->add_control(
        'wpre_header_url', array(
            'settings' => 'wpre_header_url',
            'label'    => __( 'Button URL','wp-real-estate' ),
            'description'    => __( 'Enter URL to link the Learn More button to some other page or external url. Leave Blank to link to the page selected above. ','wp-real-estate' ),
            'section'  => 'wpre_header_content',
            'type'     => 'url',
        )
    );

    //Add the Header Image section to Header Settings for uniformity
    $wp_customize->get_section('header_image')->panel = 'wpre_header_settings';



    //FEATURED Pages
    $wp_customize->add_section(
        'wpre_a_fpages_boxes',
        array(
            'title'     => __('Featured Pages','wp-real-estate'),
            'priority'  => 35,
        )
    );

    $wp_customize->add_setting(
        'wpre_fpages_enable',
        array( 'sanitize_callback' => 'wpre_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'wpre_fpages_enable', array(
            'settings' => 'wpre_fpages_enable',
            'label'    => __( 'Enable this section', 'wp-real-estate' ),
            'description'    => __( 'Show one or two of your Featured Content. This can be used to display a information about an Agent, or the company itself. The Featured Pages you choose below, must have a Featured Image, Title & Content. Content Should be less than 150 words for best results.', 'wp-real-estate' ),
            'section'  => 'wpre_a_fpages_boxes',
            'type'     => 'checkbox',
        )
    );

    for( $i = 1; $i <= 2; $i++ ) :

        $wp_customize->add_setting(
            'wpre_fpages_page_'.$i,
            array( 'sanitize_callback' => 'absint' )
        );

        $wp_customize->add_control(
            'wpre_fpages_page_'.$i, array(
                'settings' => 'wpre_fpages_page_'.$i,
                'label'    => __( 'Page ','wp-real-estate' ).$i,
                'description'    => __( 'Leave Blank to use only one Page','wp-real-estate' ),
                'section'  => 'wpre_a_fpages_boxes',
                'type'     => 'dropdown-pages',
                'allow_addition' => true,
            )
        );

        $wp_customize->add_setting(
            'wpre_fpages_page_url_'.$i,
            array( 'sanitize_callback' => 'esc_url_raw' )
        );

        $wp_customize->add_control(
            'wpre_fpages_page_url_'.$i, array(
                'settings' => 'wpre_fpages_page_url_'.$i,
                'label'    => __( 'Custom URL ','wp-real-estate' ).$i,
                'description'    => __( 'Enter URL to link the Learn More button to some other page. Leave Blank to link to the page selected above or any external url. ','wp-real-estate' ),
                'section'  => 'wpre_a_fpages_boxes',
                'type'     => 'url',
            )
        );

    endfor;

//    $wp_customize->add_setting(
//        'wpre_fpages_page2_url',
//        array( 'sanitize_callback' => 'esc_url_raw' )
//    );
//
//    $wp_customize->add_control(
//        'wpre_fpages_page2_url', array(
//            'settings' => 'wpre_fpages_page2_url',
//            'label'    => __( 'Custom URL','wp-real-estate' ),
//            'description'    => __( 'Enter URL to link the Learn More button to some other page or external URL. Leave Blank to link to the page selected above. ','wp-real-estate' ),
//            'section'  => 'wpre_a_fpages_boxes',
//            'type'     => 'url',
//        )
//    );


    //FEATURED Posts (inherited from featured-news in css)
    $wp_customize->add_section(
        'wpre_a_fn_boxes',
        array(
            'title'     => __('Featured Posts (Boxes)','wp-real-estate'),
            'priority'  => 35,
        )
    );

    //Change title if user has real estate plugin active.
    //This is done to make things more sensible for the user.
    if (function_exists('property_detail'))
        $wp_customize->get_section('wpre_a_fn_boxes')->title = __('Featured Listings (Boxes)','wp-real-estate');

    $wp_customize->add_setting(
        'wpre_fn_enable',
        array( 'sanitize_callback' => 'wpre_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'wpre_fn_enable', array(
            'settings' => 'wpre_fn_enable',
            'label'    => __( 'Enable this section', 'wp-real-estate' ),
            'description'    => __( 'Show your Top 4 Posts from the selected category.', 'wp-real-estate' ),
            'section'  => 'wpre_a_fn_boxes',
            'type'     => 'checkbox',
        )
    );


    $wp_customize->add_setting(
        'wpre_fn_title',
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'wpre_fn_title', array(
            'settings' => 'wpre_fn_title',
            'label'    => __( 'Title','wp-real-estate' ),
            'description'    => __( 'Leave Blank to disable','wp-real-estate' ),
            'section'  => 'wpre_a_fn_boxes',
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'wpre_fn_cat',
        array( 'sanitize_callback' => 'wpre_sanitize_category' )
    );

    $wp_customize->add_control(
        new Wpre_WP_Customize_Category_Control(
            $wp_customize,
            'wpre_fn_cat',
            array(
                'label'    => __('Posts Category.','wp-real-estate'),
                'settings' => 'wpre_fn_cat',
                'section'  => 'wpre_a_fn_boxes'
            )
        )
    );

    //FEATURED Posts (inherited from featured-news in css)
    $wp_customize->add_section(
        'wpre_a_fe_boxes',
        array(
            'title'     => __('Featured Posts (3x3 Grid)','wp-real-estate'),
            'priority'  => 35,
        )
    );

    //Change title if user has real estate plugin active.
    //This is done to make things more sensible for the user.
    if (function_exists('property_detail'))
        $wp_customize->get_section('wpre_a_fe_boxes')->title = __('Featured Listings (3x3 Grid)','wp-real-estate');

    $wp_customize->add_setting(
        'wpre_fe_enable',
        array( 'sanitize_callback' => 'wpre_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'wpre_fe_enable', array(
            'settings' => 'wpre_fe_enable',
            'label'    => __( 'Enable this section', 'wp-real-estate' ),
            'description'    => __( 'Show your Top 4 Posts from the selected category.', 'wp-real-estate' ),
            'section'  => 'wpre_a_fe_boxes',
            'type'     => 'checkbox',
        )
    );


    $wp_customize->add_setting(
        'wpre_fe_title',
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'wpre_fe_title', array(
            'settings' => 'wpre_fe_title',
            'label'    => __( 'Title','wp-real-estate' ),
            'description'    => __( 'Leave Blank to disable','wp-real-estate' ),
            'section'  => 'wpre_a_fe_boxes',
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'wpre_fe_cat',
        array( 'sanitize_callback' => 'wpre_sanitize_category' )
    );

    $wp_customize->add_control(
        new Wpre_WP_Customize_Category_Control(
            $wp_customize,
            'wpre_fe_cat',
            array(
                'label'    => __('Posts Category.','wp-real-estate'),
                'settings' => 'wpre_fe_cat',
                'section'  => 'wpre_a_fe_boxes'
            )
        )
    );

    // Layout and Design
    $wp_customize->add_panel( 'wpre_design_panel', array(
        'priority'       => 40,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Design & Layout','wp-real-estate'),
    ) );

    $wp_customize->add_section(
        'wpre_design_options',
        array(
            'title'     => __('Blog Layout','wp-real-estate'),
            'priority'  => 0,
            'panel'     => 'wpre_design_panel'
        )
    );


    $wp_customize->add_setting(
        'wpre_blog_layout',
        array( 'sanitize_callback' => 'wpre_sanitize_blog_layout' )
    );

    function wpre_sanitize_blog_layout( $input ) {
        if ( in_array($input, array('grid','wp-real-estate') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'wpre_blog_layout',array(
            'label' => __('Select Layout','wp-real-estate'),
            'settings' => 'wpre_blog_layout',
            'section'  => 'wpre_design_options',
            'type' => 'select',
            'choices' => array(
                'grid' => __('Standard Blog Layout','wp-real-estate'),
                'wp-real-estate' => __('WP Real Estate Theme Layout','wp-real-estate'),
            )
        )
    );

    $wp_customize->add_section(
        'wpre_sidebar_options',
        array(
            'title'     => __('Sidebar Layout','wp-real-estate'),
            'priority'  => 0,
            'panel'     => 'wpre_design_panel'
        )
    );

    $wp_customize->add_setting(
        'wpre_disable_sidebar',
        array( 'sanitize_callback' => 'wpre_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'wpre_disable_sidebar', array(
            'settings' => 'wpre_disable_sidebar',
            'label'    => __( 'Disable Sidebar Everywhere.','wp-real-estate' ),
            'section'  => 'wpre_sidebar_options',
            'type'     => 'checkbox',
            'default'  => false
        )
    );

    $wp_customize->add_setting(
        'wpre_disable_sidebar_home',
        array( 'sanitize_callback' => 'wpre_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'wpre_disable_sidebar_home', array(
            'settings' => 'wpre_disable_sidebar_home',
            'label'    => __( 'Disable Sidebar on Home/Blog.','wp-real-estate' ),
            'section'  => 'wpre_sidebar_options',
            'type'     => 'checkbox',
            'active_callback' => 'wpre_show_sidebar_options',
            'default'  => false
        )
    );

    $wp_customize->add_setting(
        'wpre_disable_sidebar_front',
        array( 'sanitize_callback' => 'wpre_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'wpre_disable_sidebar_front', array(
            'settings' => 'wpre_disable_sidebar_front',
            'label'    => __( 'Disable Sidebar on Front Page.','wp-real-estate' ),
            'section'  => 'wpre_sidebar_options',
            'type'     => 'checkbox',
            'active_callback' => 'wpre_show_sidebar_options',
            'default'  => false
        )
    );


    $wp_customize->add_setting(
        'wpre_sidebar_width',
        array(
            'default' => 4,
            'sanitize_callback' => 'wpre_sanitize_positive_number' )
    );

    $wp_customize->add_control(
        'wpre_sidebar_width', array(
            'settings' => 'wpre_sidebar_width',
            'label'    => __( 'Sidebar Width','wp-real-estate' ),
            'description' => __('Min: 25%, Default: 33%, Max: 40%','wp-real-estate'),
            'section'  => 'wpre_sidebar_options',
            'type'     => 'range',
            'active_callback' => 'wpre_show_sidebar_options',
            'input_attrs' => array(
                'min'   => 3,
                'max'   => 5,
                'step'  => 1,
                'class' => 'sidebar-width-range',
                'style' => 'color: #0a0',
            ),
        )
    );

    /* Active Callback Function */
    function wpre_show_sidebar_options($control) {

        $option = $control->manager->get_setting('wpre_disable_sidebar');
        return $option->value() == false ;

    }

    function wpre_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

    $wp_customize-> add_section(
        'wpre_custom_footer',
        array(
            'title'			=> __('Custom Footer Text','wp-real-estate'),
            'description'	=> __('Enter your Own Copyright Text.','wp-real-estate'),
            'priority'		=> 11,
            'panel'			=> 'wpre_design_panel'
        )
    );

    $wp_customize->add_setting(
        'wpre_footer_text',
        array(
            'default'		=> '',
            'sanitize_callback'	=> 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'wpre_footer_text',
        array(
            'section' => 'wpre_custom_footer',
            'settings' => 'wpre_footer_text',
            'type' => 'text'
        )
    );


    //Select the Default Theme Skin
    $wp_customize->add_section(
        'wpre_skin_options',
        array(
            'title'     => __('Choose Skin','wp-real-estate'),
            'priority'  => 39,
        )
    );

    $wp_customize->add_setting(
        'wpre_skin',
        array(
            'default'=> 'default',
            'sanitize_callback' => 'wpre_sanitize_skin'
        )
    );

    $skins = array( 'default' => __('Default(red)','wp-real-estate'),
        'orange' =>  __('Orange','wp-real-estate'),
        'green' => __('Green','wp-real-estate'),
    );

    $wp_customize->add_control(
        'wpre_skin',array(
            'settings' => 'wpre_skin',
            'section'  => 'wpre_skin_options',
            'type' => 'select',
            'choices' => $skins,
        )
    );

    function wpre_sanitize_skin( $input ) {
        if ( in_array($input, array('default','orange','brown','green','grayscale') ) )
            return $input;
        else
            return '';
    }


    //Fonts
    $wp_customize->add_section(
        'wpre_typo_options',
        array(
            'title'     => __('Google Web Fonts','wp-real-estate'),
            'priority'  => 41,
            'description' => __('Defaults: Lato, Open Sans.','wp-real-estate')
        )
    );

    $font_array = array('Source Serif Pro','Montserrat','Open Sans','Droid Sans','Droid Serif','Roboto');
    $fonts = array_combine($font_array, $font_array);

    $wp_customize->add_setting(
        'wpre_title_font',
        array(
            'default'=> 'Montserrat',
            'sanitize_callback' => 'wpre_sanitize_gfont'
        )
    );

    function wpre_sanitize_gfont( $input ) {
        if ( in_array($input, array('Source Serif Pro','Montserrat','Open Sans','Droid Sans','Droid Serif','Roboto') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'wpre_title_font',array(
            'label' => __('Primary Font','wp-real-estate'),
            'settings' => 'wpre_title_font',
            'section'  => 'wpre_typo_options',
            'type' => 'select',
            'choices' => $fonts,
        )
    );

    $wp_customize->add_setting(
        'wpre_body_font',
        array(	'default'=> 'Source Serif Pro',
            'sanitize_callback' => 'wpre_sanitize_gfont' )
    );

    $wp_customize->add_control(
        'wpre_body_font',array(
            'label' => __('Secondary Font','wp-real-estate'),
            'settings' => 'wpre_body_font',
            'section'  => 'wpre_typo_options',
            'type' => 'select',
            'choices' => $fonts
        )
    );

    // Social Icons
    $wp_customize->add_section('wpre_social_section', array(
        'title' => __('Social Icons','wp-real-estate'),
        'priority' => 44 ,
    ));

    $social_networks = array( //Redefinied in Sanitization Function.
        'none' => __('-','wp-real-estate'),
        'facebook' => __('Facebook','wp-real-estate'),
        'twitter' => __('Twitter','wp-real-estate'),
        'google-plus' => __('Google Plus','wp-real-estate'),
        'instagram' => __('Instagram','wp-real-estate'),
        'rss' => __('RSS Feeds','wp-real-estate'),
        'vine' => __('Vine','wp-real-estate'),
        'vimeo-square' => __('Vimeo','wp-real-estate'),
        'youtube' => __('Youtube','wp-real-estate'),
        'flickr' => __('Flickr','wp-real-estate'),
    );

    $social_count = count($social_networks);

    for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :

        $wp_customize->add_setting(
            'wpre_social_'.$x, array(
            'sanitize_callback' => 'wpre_sanitize_social',
            'default' => 'none'
        ));

        $wp_customize->add_control( 'wpre_social_'.$x, array(
            'settings' => 'wpre_social_'.$x,
            'label' => __('Icon ','wp-real-estate').$x,
            'section' => 'wpre_social_section',
            'type' => 'select',
            'choices' => $social_networks,
        ));

        $wp_customize->add_setting(
            'wpre_social_url'.$x, array(
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control( 'wpre_social_url'.$x, array(
            'settings' => 'wpre_social_url'.$x,
            'description' => __('Icon ','wp-real-estate').$x.__(' Url','wp-real-estate'),
            'section' => 'wpre_social_section',
            'type' => 'url',
            'choices' => $social_networks,
        ));

    endfor;

    function wpre_sanitize_social( $input ) {
        $social_networks = array(
            'none' ,
            'facebook',
            'twitter',
            'google-plus',
            'instagram',
            'rss',
            'vine',
            'vimeo-square',
            'youtube',
            'flickr'
        );
        if ( in_array($input, $social_networks) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_section(
        'wpre_sec_upgrade',
        array(
            'title'     => __('WP Real Estate - Help & Support','wp-real-estate'),
            'priority'  => 10,
        )
    );

    $wp_customize->add_setting(
        'wpre_upgrade',
        array( 'sanitize_callback' => 'esc_textarea' )
    );

    $wp_customize->add_control(
        new Wpre_WP_Customize_Upgrade_Control(
            $wp_customize,
            'wpre_upgrade',
            array(
                'label' => __('Recommended Plugin','wp-real-estate'),
                'description' => __('WP Real Estate is a powerful Real Estate Theme to list properties and make them searchable. But to Add that functionality this theme requires the WP Property Listings Plugin. Download & Install the WP Property Listings Plugin from WordPress.org Below. </br><br/>
	            <a target="_blank" href="https://wordpress.org/plugins/wp-property-listings/">WP Property Listings</a>
	            <br/> <br/>
	            <strong>Help & Support</strong><br/>
	            WP Real Estate is our first Real Estate theme, and We would do anything to make it a great theme. Please Visit <a href="https://inkhive.com/product/wp-real-estate/" target="_blank">WP Real Estate</a> on InkHive & Contact us for any issues, bug reports or Feature Requests.','wp-real-estate'),
                'section' => 'wpre_sec_upgrade',
                'settings' => 'wpre_upgrade',
            )
        )
    );


    /* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
    function wpre_sanitize_checkbox( $input ) {
        if ( $input == 1 ) {
            return 1;
        } else {
            return '';
        }
    }

    function wpre_sanitize_positive_number( $input ) {
        if ( ($input >= 0) && is_numeric($input) )
            return $input;
        else
            return '';
    }

    function wpre_sanitize_category( $input ) {
        if ( term_exists(get_cat_name( $input ), 'category') )
            return $input;
        else
            return '';
    }

    function wpre_sanitize_product_category( $input ) {
        if ( get_term( $input, 'product_cat' ) )
            return $input;
        else
            return '';
    }


}
add_action( 'customize_register', 'wpre_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wpre_customize_preview_js() {
    wp_enqueue_script( 'wpre_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'wpre_customize_preview_js' );
