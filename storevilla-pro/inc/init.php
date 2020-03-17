<?php

if( !function_exists('storevilla_pro_file_directory') ){

    function storevilla_pro_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Implement the Custom Header feature.
*/
require $storevilla_por_custom_header_file_path = storevilla_pro_file_directory('inc/core/custom-header.php');

/**
 * Custom template tags for this theme.
*/
require $storevilla_por_template_tag_file_path = storevilla_pro_file_directory('inc/core/template-tags.php');

/**
 * Custom functions that act independently of the theme templates.
*/
require $storevilla_por_extras_file_path = storevilla_pro_file_directory('inc/core/extras.php');

/**
 * Load Jetpack compatibility file.
*/
require $storevilla_por_jetpack_file_path = storevilla_pro_file_directory('inc/core/jetpack.php');

/**
 * Customizer additions.
*/
require $storevilla_por_customizer_file_path = storevilla_pro_file_directory('inc/customizer/customizer.php');


/**
 ** Load storevilla repeater fields.
*/
require $storevilla_por_repeater_file_path = storevilla_pro_file_directory('inc/customizer/class-repeater.php');

/**
 ** Load Hooks fields.
*/
require $storevilla_por_hooks_file_path = storevilla_pro_file_directory('inc/hooks.php');

/**
 ** Load woocommerce hooks fields.
*/
require $storevilla_por_woocommerce_hooks_file_path = storevilla_pro_file_directory('inc/woocommerce-hooks.php');

/**
 ** Load all widget fields.
*/
require $storevilla_por_widget_file_path = storevilla_pro_file_directory('inc/widget/widget-init.php');

/**
 * Themes required Plugins Install Section
*/
require $storevilla_por_shortcodes_php_file_path = storevilla_pro_file_directory('inc/storevillapro-shortcodes.php');

/**
 * Typography function
**/
require $storevilla_por_typography_php_file_path = storevilla_pro_file_directory('inc/typography/typography.php');

/**
 * Typography function
**/
require $storevilla_por_custom_post_type_php_file_path = storevilla_pro_file_directory('inc/storevilla-custom-post-type.php');


/**
 * Load dynamic style function file
**/
require $storevilla_por_custom_post_type_php_file_path = storevilla_pro_file_directory('inc/dynamic-css.php');