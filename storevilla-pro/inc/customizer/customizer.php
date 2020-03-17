<?php
/**
 * Store Villa Theme Customizer.
 *
 * @package Store_Villa
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function storevilla_customize_register( $wp_customize ) {

    // Preloader Enable/Disable
    $wp_customize->add_section( 'storevilla_per_loader_settings', array(
        'title' => __( 'Preloader Settings', 'storevilla-pro' ),
        'priority' => 2,
    ));

    $wp_customize->add_setting( 'storevilla_preloader_options', array( 
      'sanitize_callback' => 'storevilla_checkbox_sanitize' 
    ));

    $wp_customize->add_control( 'storevilla_preloader_options', array(
        'type' => 'checkbox',
        'label' => __( 'Check to Disable Preloader', 'storevilla-pro' ),
        'section' => 'storevilla_per_loader_settings',
        'settings' => 'storevilla_preloader_options',
    ));

    // Preloader Select Image Options
    $wp_customize->add_setting( 'storevilla_preloader' , array( 
      'default' => 'default', 
      'sanitize_callback' => 'storevilla_sanitize_text'
    ));

    $wp_customize->add_control( new WP_Customize_Preloader_Control( $wp_customize, 'storevilla_preloader', array(
      'label'      => __( 'Preloader', 'storevilla-pro' ),
      'section'    => 'storevilla_per_loader_settings',
      'settings'   => 'storevilla_preloader',
    )));


    $wp_customize->add_panel( 'general_settings', array(
        'priority'         =>      '3',
        'capability'       =>      'edit_theme_options',
        'theme_supports'   =>      '',
        'title'            =>      __( 'General Settings', 'storevilla-pro' ),
        'description'      =>      __( 'This allows to edit the header', 'storevilla-pro' ),
    ));

    $wp_customize->get_section('title_tagline')->panel = 'general_settings';
    $wp_customize->get_section('header_image')->panel = 'general_settings';
    $wp_customize->get_section('background_image')->panel = 'general_settings';
    $wp_customize->get_section('static_front_page')->panel = 'general_settings';

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->get_section('colors')->title = __( 'Themes Colors', 'storevilla-pro' );

    $wp_customize->add_setting('storevilla_pro_primary_color', array(
        'default' => '#0091d5',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',        
    ));

    $wp_customize->add_control('storevilla_pro_primary_color', array(
        'type'     => 'color',
        'label'    => __('Primary Colors', 'storevilla-pro'),
        'section'  => 'colors',
        'setting'  => 'storevilla_pro_primary_color',
        'priority' =>  '1',   
    ));

    $wp_customize->add_setting('storevilla_pro_secondary_color', array(
        'default' => '#dd1f26',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',        
    ));

    $wp_customize->add_control('storevilla_pro_secondary_color', array(
        'type'     => 'color',
        'label'    => __('Secondary Colors', 'storevilla-pro'),
        'section'  => 'colors',
        'setting'  => 'storevilla_pro_secondary_color',
        'priority' =>  '1',   
    ));


    $wp_customize->add_panel( 'header_settings', array(
        'priority'         =>      '4',
        'capability'       =>      'edit_theme_options',
        'theme_supports'   =>      '',
        'title'            =>      __( 'Header Settings', 'storevilla-pro' ),
        'description'      =>      __( 'This allows to edit the header', 'storevilla-pro' ),
    ));


    $wp_customize->add_section( 'storevilla_header_options', array(
		'title'           =>      __('Top Header Options', 'storevilla-pro'),
		'priority'        =>      '111',
        'panel'           => 'header_settings'
    ));

    $wp_customize->add_setting('storevilla_top_header', array(
        'default' => 'enable',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
	));

	$wp_customize->add_control('storevilla_top_header', array(
		'type' => 'radio',
		'label' => __('Enable / Disable Top Header', 'storevilla-pro'),
		'section' => 'storevilla_header_options',
		'settings' => 'storevilla_top_header',
		'choices' => array(
         'enable' => __('Enable', 'storevilla-pro'),
         'disable' => __('Disable', 'storevilla-pro')
        )
	));


    $wp_customize->add_section( 'storevilla_pro_header_type_area', array(
        'title'           =>      __('Header Type Layout', 'storevilla-pro'),
        'priority'        =>      '111',
        'panel'           =>      'header_settings'
    ));

    $wp_customize->add_setting('storevilla_pro_header_type',  array(
        'default' =>  'headerone',
        'sanitize_callback' => 'storevilla_top_header_layout_sanitize'
    ));

    $wp_customize->add_control('storevilla_pro_header_type', array(
        'section'       => 'storevilla_pro_header_type_area',
        'label'         =>  __('Header Types', 'storevilla-pro'),
        'type'          =>  'radio',
        'choices' => array(        
            'headerone'   => __('Header One', 'storevilla-pro'),
            'headertwo'   => __('Header Two', 'storevilla-pro'),
            'headerthree' => __('Header Three', 'storevilla-pro'),
        )
    ));


    $wp_customize->add_section( 'storevilla_web_page_layout', array(
        'title'           =>      __('Web Page Layout Options', 'storevilla-pro'),
        'priority'        =>      '111',
        'panel'           =>      'general_settings'
    ));

    $wp_customize->add_setting('storevilla_web_page_layout_options', array(
        'default' => 'disable',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
    ));

    $wp_customize->add_control('storevilla_web_page_layout_options', array(
        'type' => 'radio',
        'label' => __('Enable / Disable Top Header', 'storevilla-pro'),
        'section' => 'storevilla_web_page_layout',
        'settings' => 'storevilla_web_page_layout_options',
        'choices' => array(
         'enable' => __('Box Layout', 'storevilla-pro'),
         'disable' => __('Full Width Layout', 'storevilla-pro')
        )
    ));
	
	
	$wp_customize->add_setting('storevilla_top_left_options',  array(
        'default' =>  'nav',
        'sanitize_callback' => 'storevilla_top_header_sanitize'
    ));
    
    $wp_customize->add_control('storevilla_top_left_options', array(
        'section'       => 'storevilla_header_options',
        'label'         =>  __('Top Header Options', 'storevilla-pro'),
        'type'          =>  'radio',
        'choices' => array(        
            'nav'       => __('Top Navigation', 'storevilla-pro'),
            'quickinfo' => __('Quick Info', 'storevilla-pro'),
            'offerticker' => __('Offer Ticker', 'storevilla-pro'),
        )
    ));

// Offer Ticker
    $wp_customize->add_setting('storevilla_offer_ticker_title', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_offer_ticker_title',array(
        'type' => 'text',
        'label' => __('Offer Ticker Title', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_offer_ticker_title',
        'active_callback' => 'storevilla_top_header_offerticker_optons',
    ));

    $wp_customize->add_setting( 'storevilla_offer_ticker_desc', array(
      'sanitize_callback' => 'storevilla_sanitize_text',
      'default' => '',
      'transport' => 'postMessage'
    ));

    $wp_customize->add_control( new Storevilla_Pro_General_Repeater( $wp_customize, 'storevilla_offer_ticker_desc', array(
      'label'   => esc_html__('Main Slider Section','storevilla-pro'),
      'active_callback' => 'storevilla_top_header_offerticker_optons',
      'section' => 'storevilla_header_options',
          'text_control' => true,
    )));
    
    
    $wp_customize->add_setting('storevilla_email_icon', array(
        'default' => 'fa fa-envelope',
        'sanitize_callback' => 'storevilla_text_sanitize', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_email_icon',array(
        'type' => 'text',
        'description' => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'storevilla-pro' ), 'fa fa-truck','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
        'label' => __('Email Icon', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_email_icon',
        'active_callback' => 'storevilla_top_header_optons',
    ));
	
	$wp_customize->add_setting('storevilla_email_title', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_email_title',array(
        'type' => 'text',
        'label' => __('Email Address', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_email_title',
        'active_callback' => 'storevilla_top_header_optons',
    ));
    
    
    $wp_customize->add_setting('storevilla_phone_icon', array(
        'default' => 'fa fa-phone',
        'sanitize_callback' => 'storevilla_text_sanitize', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_phone_icon',array(
        'type' => 'text',
        'description' => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'storevilla-pro' ), 'fa fa-truck','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
        'label' => __('Phone Icon', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_phone_icon',
        'active_callback' => 'storevilla_top_header_optons',
    ));
	
	$wp_customize->add_setting('storevilla_phone_number', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_phone_number',array(
        'type' => 'text',
        'label' => __('Phone Number', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_phone_number',
        'active_callback' => 'storevilla_top_header_optons',
    ));
    
    
    $wp_customize->add_setting('storevilla_address_icon', array(
        'default' => 'fa fa-map-marker',
        'sanitize_callback' => 'storevilla_text_sanitize', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_address_icon',array(
        'type' => 'text',
        'description' => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'storevilla-pro' ), 'fa fa-truck','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
        'label' => __('Address Icon', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_address_icon',
        'active_callback' => 'storevilla_top_header_optons',
    ));
	
	$wp_customize->add_setting('storevilla_map_address', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_map_address',array(
        'type' => 'text',
        'label' => __('Address', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_map_address',
        'active_callback' => 'storevilla_top_header_optons',
    ));
    
    
    
    $wp_customize->add_setting('storevilla_shop_open_icon', array(
        'default' => 'fa fa-clock-o',
        'sanitize_callback' => 'storevilla_text_sanitize', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_shop_open_icon',array(
        'type' => 'text',
        'description' => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'storevilla-pro' ), 'fa fa-truck','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
        'label' => __('Shop Open Time Icon', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_shop_open_icon',
        'active_callback' => 'storevilla_top_header_optons',
    ));
	
	$wp_customize->add_setting('storevilla_shop_open_time', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_shop_open_time',array(
        'type' => 'text',
        'label' => __('Shop Opening Time', 'storevilla-pro'),
        'section' => 'storevilla_header_options',
        'setting' => 'storevilla_shop_open_time',
        'active_callback' => 'storevilla_top_header_optons',
    ));



    $wp_customize->add_panel('breadcrumb_setting', array(
        'priority'   =>      '80',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Breadcrumb Settings', 'storevilla-pro' ),
        'description' => __( 'This allows to upload breadcrumb background image', 'storevilla-pro' ),
    ));

        $wp_customize->add_section('woo_archive_page', array(
            'title'   => __('WooCommerce Breadcrumb Area', 'storevilla-pro'),
            'priority'=> '2',
            'panel'   => 'breadcrumb_setting', 
        )); 

        $wp_customize->add_setting('breadcrumb_options', array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
        ));

        $wp_customize->add_control('breadcrumb_options', array(
            'type' => 'radio',
            'label' => __('Enable/Disable Breadcrumb', 'storevilla-pro'),
            'section' => 'woo_archive_page',
            'settings' => 'breadcrumb_options',
            'choices' => array(
             'enable' => __('Enable', 'storevilla-pro'),
             'disable' => __('Disable', 'storevilla-pro')
            )
        ));

        $wp_customize->add_setting('breadcrumb_archive_image', array(
            'default' =>      '',
            'sanitize_callback' => 'esc_url_raw',
            //'transport' => 'postMessage'
        ));

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'breadcrumb_archive_image', array(
            'section'  => 'woo_archive_page',
            'label'    => __('Upload Background Image', 'storevilla-pro'),
            'type'     => 'image',
            'description' => __('Uplaod Breadcrumb Background Image, Breadcrumb Background Image Size of 2000 &#215; 156 Pixels.','storevilla-pro')
        )));


        $wp_customize->add_section('breadcrumb_page_options', array(
            'title'   => __('Breadcrumb Page Options', 'storevilla-pro'),
            'priority'=> '6',
            'panel'   => 'breadcrumb_setting', 
        ));

        $wp_customize->add_setting('breadcrumb_options_page', array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
        ));

        $wp_customize->add_control('breadcrumb_options_page', array(
            'type' => 'radio',
            'label' => __('Enable/Disable Breadcrumb', 'storevilla-pro'),
            'section' => 'breadcrumb_page_options',
            'settings' => 'breadcrumb_options_page',
            'choices' => array(
             'enable' => __('Enable', 'storevilla-pro'),
             'disable' => __('Disable', 'storevilla-pro')
            )
        ));

        $wp_customize->add_setting('breadcrumb_page_image', array(
            'default' =>      '',
            'sanitize_callback' => 'esc_url_raw',
            //'transport' => 'postMessage'
        ));

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'breadcrumb_page_image', array(
            'section'  => 'breadcrumb_page_options',
            'label'    => __('Upload Background Image', 'storevilla-pro'),
            'type'     => 'image',
            'description' => __('Uplaod Breadcrumb Background Image, Breadcrumb Background Image Size of 2000 &#215; 156 Pixels.','storevilla-pro')
        )));


        $wp_customize->add_section('breadcrumb_post_options', array(
            'title'   => __('Breadcrumb Post Options', 'storevilla-pro'),
            'priority'=> '6',
            'panel'   => 'breadcrumb_setting', 
        ));

        $wp_customize->add_setting('breadcrumb_options_post', array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
        ));

        $wp_customize->add_control('breadcrumb_options_post', array(
            'type' => 'radio',
            'label' => __('Enable/Disable Breadcrumb', 'storevilla-pro'),
            'section' => 'breadcrumb_post_options',
            'settings' => 'breadcrumb_options_post',
            'choices' => array(
             'enable' => __('Enable', 'storevilla-pro'),
             'disable' => __('Disable', 'storevilla-pro')
            )
        ));

        $wp_customize->add_setting('breadcrumb_post_image', array(
            'default' =>      '',
            'sanitize_callback' => 'esc_url_raw',
            //'transport' => 'postMessage'
        ));

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'breadcrumb_post_image', array(
            'section'  => 'breadcrumb_post_options',
            'label'    => __('Upload Background Image', 'storevilla-pro'),
            'type'     => 'image',
            'description' => __('Uplaod Breadcrumb Background Image, Breadcrumb Background Image Size of 2000 &#215; 156 Pixels.','storevilla-pro')
        )));
	

$wp_customize->add_panel('storevilla_main_banner_settings_options', array(
  'capabitity' => 'edit_theme_options',
  'description' => __('Mange all banner and promo settings', 'storevilla-pro'),
  'priority'        =>      '26',
  'title' => __('Main Banner Settings', 'storevilla-pro')
));
    
    $wp_customize->add_section( 'storevilla_setting_area', array(
        'title'           =>      __('Banner Settings Area', 'storevilla-pro'),
        'priority'        =>      '111',
        'panel'           => 'storevilla_main_banner_settings_options'
    ));

    $wp_customize->add_setting('storevilla_main_banner_settings', array(
        'default' => 'enable',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
    ));

    $wp_customize->add_control('storevilla_main_banner_settings', array(
        'type' => 'radio',
        'label' => __('Enable / Disable Main Banner Area', 'storevilla-pro'),
        'section' => 'storevilla_setting_area',
        'settings' => 'storevilla_main_banner_settings',
        'choices' => array(
         'enable' => __('Enable', 'storevilla-pro'),
         'disable' => __('Disable', 'storevilla-pro')
        )
    ));

    $wp_customize->add_setting('storevilla_pro_homepage_slider_type_options', array(
      'default' => 'normal',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_slider_type_sanitize'  //done
    ));

    $wp_customize->add_control('storevilla_pro_homepage_slider_type_options', array(
        'type' => 'radio',
        'label' => __('Choose Slider Type', 'storevilla-pro'),
        'section' => 'storevilla_setting_area',
        'setting' => 'storevilla_pro_homepage_slider_type_options',
        'choices' => array(
             'normal' => __('Normal Slider', 'storevilla-pro'),
             'revolution' => __('Revolution Slider', 'storevilla-pro'),
            )
    ));

    $wp_customize->add_setting('storevilla_pro_slider_revolution', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_textarea'
    ));

    $wp_customize->add_control('storevilla_pro_slider_revolution', array(
        'section'    =>      'storevilla_setting_area',
        'label'      =>      __('Revolution Slider Shortcode', 'storevilla-pro'),
        'type'       =>      'textarea',
        'description'=> __('Enter the Revolution Slider Plugins Shortcode Example ([rev_slider yourslidername])','storevilla-pro'),
        'active_callback' => 'storevilla_pro_slider_type',     
    ));

    $wp_customize->add_setting('storevilla_pro_banner_type_layout', array(
      'default' => 'promobanner',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_banner_type_sanitize'  //done
    ));

    $imagepath =  get_template_directory_uri() . '/images/';
    $wp_customize->add_control(new Storevilla_Image_Radio_Control($wp_customize, 'storevilla_pro_banner_type_layout', array(
      'type' => 'radio',
      'label' => __('Banner Slider Layout', 'storevilla-pro'),
      'section' => 'storevilla_setting_area',
      'settings' => 'storevilla_pro_banner_type_layout',
      'choices' => array( 
              'fullbanner' => $imagepath.'fullbanner.jpg',  
              'bannerright' => $imagepath.'bannerright.jpg', 
            )
    )));

	
	$wp_customize->add_section( 'storevilla_main_banner_area', array(
		'title'           =>      __('Main Banner Section Area', 'storevilla-pro'),
		'priority'        =>      '111',
        'panel'           => 'storevilla_main_banner_settings_options'
    ));
	
	$wp_customize->add_setting( 'storevilla_main_banner_slider', array(
      'sanitize_callback' => 'storevilla_sanitize_text',
      'default' => '',
      'transport' => 'postMessage'
    ));

    $wp_customize->add_control( new Storevilla_Pro_General_Repeater( $wp_customize, 'storevilla_main_banner_slider', array(
      'label'   => esc_html__('Main Slider Section','storevilla-pro'),
      'section' => 'storevilla_main_banner_area',
      'description' => __('Upload Slider Image With Slider Title, Description, Link & Button Text','storevilla-pro'),
          'image_control' => true,
          'title_control' => true,               
          'text_control' => true,
          'link_control' => true,
          'subtitle_control' => true
    )));	
	
	$wp_customize->add_section( 'storevilla_main_header_promo_area', array(
		'title'           =>      __('Banner sidebar Promo Area', 'storevilla-pro'),
		'priority'        =>      '112',
        'panel'           =>      'storevilla_main_banner_settings_options'
    ));

    $wp_customize->add_setting('storevilla_main_header_promo_settings', array(
        'default' => 'enable',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
	));

	$wp_customize->add_control('storevilla_main_header_promo_settings', array(
		'type' => 'radio',
		'label' => __('Enable / Disable Main Banner Promo Area', 'storevilla-pro'),
		'section' => 'storevilla_main_header_promo_area',
		'settings' => 'storevilla_main_header_promo_settings',
		'choices' => array(
         'enable' => __('Enable', 'storevilla-pro'),
         'disable' => __('Disable', 'storevilla-pro')
        )
	));
	
	
	$wp_customize->add_setting( 'storevilla_promo_area_one_image', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw' // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'storevilla_promo_area_one_image', array(
        'section'       =>      'storevilla_main_header_promo_area',
        'label'         =>      __('Upload Promo One Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));
    
    $wp_customize->add_setting('storevilla_promo_area_one_title', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_one_title',array(
        'type' => 'text',
        'label' => __('Promo One Title', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_one_title',
    ));

    $wp_customize->add_setting('storevilla_promo_area_one_desc', array(
        'default' => '',
       	'sanitize_callback' => 'esc_textarea', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_one_desc',array(
        'type' => 'textarea',
        'label' => __('Promo One Short Description', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_one_desc',
    ));
    
    
    $wp_customize->add_setting('storevilla_promo_area_one_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_one_link',array(
        'type' => 'text',
        'label' => __('Promo One Link', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_one_link',
    ));
    
    $wp_customize->add_setting( 'storevilla_promo_area_two_image', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw' // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'storevilla_promo_area_two_image', array(
        'section'       =>      'storevilla_main_header_promo_area',
        'label'         =>      __('Upload Promo Two Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));
    
    
    $wp_customize->add_setting('storevilla_promo_area_two_title', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_two_title',array(
        'type' => 'text',
        'label' => __('Promo Two Title', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_two_title',
    ));

    $wp_customize->add_setting('storevilla_promo_area_two_desc', array(
        'default' => '',
       	'sanitize_callback' => 'esc_textarea', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_two_desc',array(
        'type' => 'textarea',
        'label' => __('Promo Two Short Description', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_two_desc',
    ));
    
    
    $wp_customize->add_setting('storevilla_promo_area_two_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_two_link',array(
        'type' => 'text',
        'label' => __('Promo Two Link', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_two_link',
    ));

    // Promo Three

    $wp_customize->add_setting( 'storevilla_promo_area_three_image', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw' // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'storevilla_promo_area_three_image', array(
        'section'       =>      'storevilla_main_header_promo_area',
        'label'         =>      __('Upload Promo Three Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));
    
    
    $wp_customize->add_setting('storevilla_promo_area_three_title', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_three_title',array(
        'type' => 'text',
        'label' => __('Promo Three Title', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_three_title',
    ));

    $wp_customize->add_setting('storevilla_promo_area_three_desc', array(
        'default' => '',
        'sanitize_callback' => 'esc_textarea', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_three_desc',array(
        'type' => 'textarea',
        'label' => __('Promo Three Short Description', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_two_desc',
    ));
    
    
    $wp_customize->add_setting('storevilla_promo_area_three_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_promo_area_three_link',array(
        'type' => 'text',
        'label' => __('Promo Three Link', 'storevilla-pro'),
        'section' => 'storevilla_main_header_promo_area',
        'setting' => 'storevilla_promo_area_three_link',
    ));

	
	$imagepath =  get_template_directory_uri() . '/images/';

    // Start of the WooCommerce Design Options
    $wp_customize->add_panel('storevilla_woocommerce_design_options', array(
      'capabitity' => 'edit_theme_options',
      'description' => __('Mange products and singel product page settings', 'storevilla-pro'),
      'priority' => 113,
      'title' => __('WooCommerce Products Area', 'storevilla-pro')
    ));

     
    // site archive layout setting
    $wp_customize->add_section('storevilla_woocommerce_products_settings', array(
      'priority' => 2,
      'title' => __('Products Pages Settings', 'storevilla-pro'),
      'panel' => 'storevilla_woocommerce_design_options'
    ));

    $wp_customize->add_setting('storevilla_woocommerce_products_page_layout', array(
      'default' => 'rightsidebar',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_radio_sanitize_layout'  //done
    ));

    $wp_customize->add_control(new Storevilla_Image_Radio_Control($wp_customize, 'storevilla_woocommerce_products_page_layout', array(
      'type' => 'radio',
      'label' => __('Select Products pages Layout', 'storevilla-pro'),
      'section' => 'storevilla_woocommerce_products_settings',
      'settings' => 'storevilla_woocommerce_products_page_layout',
      'choices' => array( 
              'leftsidebar' => $imagepath.'left-sidebar.png',  
              'rightsidebar' => $imagepath.'right-sidebar.png',
              'nosidebar' => $imagepath.'no-sidebar.png', 
            )
    )));

    $wp_customize->add_setting('storevilla_woocommerce_product_row', array(
      'default' => '3',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_radio_sanitize_layout_row'  //done
    ));

    $wp_customize->add_control('storevilla_woocommerce_product_row', array(
      'type' => 'select',
      'label' => __('Select Products Pages Row', 'storevilla-pro'),
      'section' => 'storevilla_woocommerce_products_settings',
      'settings' => 'storevilla_woocommerce_product_row',
      'choices' => array( 
              '2' => '2',  
              '3' => '3', 
              '4' => '4',
    )));

    $wp_customize->add_setting('storevilla_woocommerce_display_product_number', array(
      'default' => 12,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_number_sanitize'  // done
    ));

    $wp_customize->add_control('storevilla_woocommerce_display_product_number', array(
      'type' => 'number',
      'label' => __('Enter Products Display Per Page', 'storevilla-pro'),
      'section' => 'storevilla_woocommerce_products_settings',
      'settings' => 'storevilla_woocommerce_display_product_number'
    ));

    

    // WooCommerce Singel Product Page Settings
    $wp_customize->add_section('storevilla_woocommerce_single_products_page_settings', array(
      'priority' => 2,
      'title' => __('Single Products Page Settings', 'storevilla-pro'),
      'panel' => 'storevilla_woocommerce_design_options'
    ));

    $wp_customize->add_setting('storevilla_woocommerce_single_products_page_layout', array(
      'default' => 'rightsidebar',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_radio_sanitize_layout'  //done
    ));

    $wp_customize->add_control(new Storevilla_Image_Radio_Control($wp_customize, 'storevilla_woocommerce_single_products_page_layout', array(
      'type' => 'radio',
      'label' => __('Select Single Products Page Layout', 'storevilla-pro'),
      'section' => 'storevilla_woocommerce_single_products_page_settings',
      'settings' => 'storevilla_woocommerce_single_products_page_layout',
      'choices' => array( 
              'leftsidebar' => $imagepath.'left-sidebar.png',  
              'rightsidebar' => $imagepath.'right-sidebar.png',
              'nosidebar' => $imagepath.'no-sidebar.png', 
            )
    )));
    
    $wp_customize->add_setting('storevilla_woocommerce_singel_product_page_upsell_title', array(
      'default' => 'Up Sell Products',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_text_sanitize'  // done
    ));

    $wp_customize->add_control('storevilla_woocommerce_singel_product_page_upsell_title', array(
      'type' => 'text',
      'label' => __('Enter Up Sell Title', 'storevilla-pro'),
      'section' => 'storevilla_woocommerce_single_products_page_settings',
      'settings' => 'storevilla_woocommerce_singel_product_page_upsell_title'
    ));


    $wp_customize->add_setting('storevilla_woocommerce_product_page_related_title', array(
      'default' => 'Related Products',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'storevilla_text_sanitize'  // done
    ));

    $wp_customize->add_control('storevilla_woocommerce_product_page_related_title', array(
      'type' => 'text',
      'label' => __('Enter Related Products Title', 'storevilla-pro'),
      'section' => 'storevilla_woocommerce_single_products_page_settings',
      'settings' => 'storevilla_woocommerce_product_page_related_title'
    ));
    
    
    
    $wp_customize->add_section( 'storevilla_brands_logo_area', array(
		'title'           =>      __('Brands Logo Section Area', 'storevilla-pro'),
		'priority'        =>      '114',
    ));   
    
	
	$wp_customize->add_setting( 'storevilla_brands_logo', array(
      'sanitize_callback' => 'storevilla_sanitize_text',
      'default' => '',
      'transport' => 'postMessage'
    ));

    $wp_customize->add_control( new Storevilla_Pro_General_Repeater( $wp_customize, 'storevilla_brands_logo', array(
      'label'   => esc_html__('Our Brands Logo Area','storevilla-pro'),
      'section' => 'storevilla_brands_logo_area',
      'description' => __('Upload Your Brands Logo Here','storevilla-pro'),
          'image_control' => true,
          'link_control' => true,
    )));

    $wp_customize->add_section('storevilla_pro_css_section', array(
        'priority' => 118,
        'title' => __('Custom CSS Section', 'storevilla-pro'),
    ));

    $wp_customize->add_setting( 'storevilla_css_section', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control('storevilla_css_section', array(
        'type' => 'textarea',
        'label' => __('Custom CSS', 'storevilla-pro'),
        'section' => 'storevilla_pro_css_section',
        'setting' => 'storevilla_css_section',
    ));


    $wp_customize->add_panel( 'footer_settings', array(
        'priority'         =>      119,
        'capability'       =>      'edit_theme_options',
        'theme_supports'   =>      '',
        'title'            =>      __( 'Footer Settings', 'storevilla-pro' ),
        'description'      =>      __( 'This allows to edit the header', 'storevilla-pro' ),
    ));
    
	
	// Services Area 
	$wp_customize->add_section( 'storevilla_services_area', array(
		'title'           =>      __('Services Section Area', 'storevilla-pro'),
		'priority'        =>      '115',
        'panel'           =>      'footer_settings'
    ));

    $wp_customize->add_setting('storevilla_services_area_settings', array(
        'default' => 'enable',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'storevilla_radio_enable_disable_sanitize'  //done
	));

	$wp_customize->add_control('storevilla_services_area_settings', array(
		'type' => 'radio',
		'label' => __('Options Enable/Disable Service Area', 'storevilla-pro'),
		'section' => 'storevilla_services_area',
		'settings' => 'storevilla_services_area_settings',
		'choices' => array(
         'enable' => __('Enable', 'storevilla-pro'),
         'disable' => __('Disable', 'storevilla-pro')
        )
	));

	 // Services Area One
	$wp_customize->add_setting('storevilla_services_icon_one', array(
        'default' => 'fa fa-truck',
        'sanitize_callback' => 'storevilla_text_sanitize', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_services_icon_one',array(
        'type' => 'text',
        'description' => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'storevilla-pro' ), 'fa fa-truck','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
        'label' => __('Service Icon One', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_services_icon_one',
    ));
	
	$wp_customize->add_setting('storevilla_service_title_one', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_service_title_one',array(
        'type' => 'text',
        'label' => __('Service One Title', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_service_title_one',
    ));

    $wp_customize->add_setting('storevilla_service_desc_one', array(
        'default' => '',
       	'sanitize_callback' => 'esc_textarea', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_service_desc_one',array(
        'type' => 'textarea',
        'label' => __('Service Area Very Short Description', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_service_desc_one',
    ));

    // Services Area Two
    $wp_customize->add_setting('storevilla_services_icon_two', array(
        'default' => 'fa fa-headphones',
        'sanitize_callback' => 'storevilla_text_sanitize', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_services_icon_two',array(
        'type' => 'text',
        'description' => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'storevilla-pro' ), 'fa fa-headphones','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
       'label' => __('Service Icon Two', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_services_icon_two',
    ));
	
	$wp_customize->add_setting('storevilla_service_title_two', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // Done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_service_title_two',array(
        'type' => 'text',
        'label' => __('Service Two Title', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_service_title_two',
    ));

    $wp_customize->add_setting('storevilla_service_desc_two', array(
        'default' => '',
       	'sanitize_callback' => 'esc_textarea',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_service_desc_two',array(
        'type' => 'textarea',
        'label' => __('Service Area Very Short Description', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_service_desc_two',
    ));

    // Services Area Three
    $wp_customize->add_setting('storevilla_services_icon_three', array(
        'default' => 'fa fa-dollar',
        'sanitize_callback' => 'storevilla_text_sanitize', // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_services_icon_three',array(
        'type' => 'text',
        'description' => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'storevilla-pro' ), 'fa fa-dollar','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
        'label' => __('Service Icon Three', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_services_icon_three',
    ));
	
	$wp_customize->add_setting('storevilla_service_title_three', array(
        'default' => '',
        'sanitize_callback' => 'storevilla_text_sanitize',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_service_title_three',array(
        'type' => 'text',
        'label' => __('Service Three Title', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_service_title_three',
    ));

    $wp_customize->add_setting('storevilla_service_desc_three', array(
        'default' => '',
       	'sanitize_callback' => 'esc_textarea',  // done
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('storevilla_service_desc_three',array(
        'type' => 'textarea',
        'label' => __('Service Area Very Short Description', 'storevilla-pro'),
        'section' => 'storevilla_services_area',
        'setting' => 'storevilla_service_desc_three',
    ));
    
    
	
	$wp_customize->add_section( 'storevilla_copyright', array(
		'title'           =>      __('Copyright Message Section', 'storevilla-pro'),
		'priority'        =>      '116',
        'panel'           =>      'footer_settings'
    ));

    $wp_customize->add_setting('storevilla_footer_copyright', array(
         'default' => '',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_kses_post'  //done
    ));

	$wp_customize->add_control('storevilla_footer_copyright', array(
	 'type' => 'textarea',
	 'label' => __('Copyright', 'storevilla-pro'),
	 'section' => 'storevilla_copyright',
	 'settings' => 'storevilla_footer_copyright'
	));

	// Payment Logo Section    
    $wp_customize->add_section( 'paymentlogo_images', array(
		'title'           =>      __('Payment Logo Section', 'storevilla-pro'),
		'priority'        =>      '117',
        'panel'           =>      'footer_settings'
    ));
    
    $wp_customize->add_setting( 'paymentlogo_image_one', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw' // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paymentlogo_image_one', array(
        'section'       =>      'paymentlogo_images',
        'label'         =>      __('Upload Payment Logo Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));

    $wp_customize->add_setting( 'paymentlogo_image_two', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw'  // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paymentlogo_image_two', array(
        'section'       =>      'paymentlogo_images',
        'label'         =>      __('Upload Payment Logo Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));

    $wp_customize->add_setting( 'paymentlogo_image_three', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw'  // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paymentlogo_image_three', array(
        'section'       =>      'paymentlogo_images',
        'label'         =>      __('Upload Payment Logo Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));

    $wp_customize->add_setting( 'paymentlogo_image_four', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw'   // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paymentlogo_image_four', array(
        'section'       =>      'paymentlogo_images',
        'label'         =>      __('Upload Payment Logo Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));

    $wp_customize->add_setting( 'paymentlogo_image_five', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw'   // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paymentlogo_image_five', array(
        'section'       =>      'paymentlogo_images',
        'label'         =>      __('Upload Payment Logo Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));

    $wp_customize->add_setting( 'paymentlogo_image_six', array(
        'default'       =>      '',
        'sanitize_callback' => 'esc_url_raw'  // done
    ));
   
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paymentlogo_image_six', array(
        'section'       =>      'paymentlogo_images',
        'label'         =>      __('Upload Payment Logo Image', 'storevilla-pro'),
        'type'          =>      'image',
    )));


    function storevilla_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return 0;
      }
    }

    function storevilla_radio_enable_disable_sanitize($input) {
       $valid_keys = array(
         'enable' => __('Enable', 'storevilla-pro'),
         'disable' => __('Disable', 'storevilla-pro')
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }
    }
    
    function storevilla_top_header_sanitize($input) {
       $valid_keys = array(
         'nav' => __('Top Navigation', 'storevilla-pro'),
         'quickinfo'     => __('Quick Info', 'storevilla-pro'),
         'offerticker' => __('Offer Ticker', 'storevilla-pro'),
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }
    }


    function storevilla_top_header_layout_sanitize($input) {
       $valid_keys = array(
            'headerone'   => __('Header One', 'storevilla-pro'),
            'headertwo'   => __('Header Two', 'storevilla-pro'),
            'headerthree' => __('Header Three', 'storevilla-pro'),
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }
    }
       

    function storevilla_text_sanitize( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

    function storevilla_radio_sanitize_layout($input) {
        $imagepath =  get_template_directory_uri() . '/images/';
        $valid_keys = array(
         'leftsidebar' => $imagepath.'left-sidebar.png',  
         'rightsidebar' => $imagepath.'right-sidebar.png',
         'nosidebar' => $imagepath.'no-sidebar.png',
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
        } else {
         return '';
        }
    }

    function storevilla_banner_type_sanitize($input) {
        $imagepath =  get_template_directory_uri() . '/images/';
        $valid_keys = array(
            'fullbanner' => $imagepath.'left-sidebar.png',  
            'bannerright' => $imagepath.'right-sidebar.png',
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
        } else {
         return '';
        }
    }     

    function storevilla_slider_type_sanitize($input) {
        $valid_keys = array(
         'normal' => __('Normal Slider', 'storevilla-pro'),
         'revolution' => __('Revolution Slider', 'storevilla-pro')
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
        } else {
         return '';
        }
    }   

    function storevilla_radio_sanitize_layout_row($input) {
      $valid_keys = array(
          '2' => '2',  
          '3' => '3', 
          '4' => '4',
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
    }

    function storevilla_number_sanitize( $int ) {
        return absint( $int );
    }
    
    function storevilla_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    
    
    function storevilla_top_header_optons(){
     $header_optons = get_theme_mod('storevilla_top_left_options');
       if( $header_optons == 'quickinfo') {
          return true;
       }
     return false;
    }

    function storevilla_top_header_offerticker_optons(){
     $header_optons = get_theme_mod('storevilla_top_left_options');
       if( $header_optons == 'offerticker') {
          return true;
       }
     return false;
    }
    

    function storevilla_floatval( $input ) {
         $output = floatval($input);
          return $output;
    }

    function storevilla_pro_slider_type(){
      $slider_type = get_theme_mod('storevilla_pro_homepage_slider_type_options');
        if( $slider_type == 'revolution') {
          return true;
        }
      return false;
    }
    
}
add_action( 'customize_register', 'storevilla_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
**/
function storevilla_customize_preview_js() {
	wp_enqueue_script( 'storevilla_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'storevilla_customize_preview_js' );
