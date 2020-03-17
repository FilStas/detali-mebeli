<?php

/**
 ** Load storevilla widget main file section.
**/
require $storevilla_por_widget_fields_file_path = storevilla_pro_file_directory('/inc/widget/widget-fields.php');

/**
 ** Load storevilla testimonial widget area.
**/
require $storevilla_por_testimonial_file_path = storevilla_pro_file_directory('/inc/widget/testimonial-widget.php');

/**
 ** Load storevilla blog widget area.
**/
require $storevilla_por_blog_file_path = storevilla_pro_file_directory('/inc/widget/blog-widget.php');

/**
 ** Load storevilla contact info widget area.
**/
require $storevilla_por_contactinfo_file_path = storevilla_pro_file_directory('/inc/widget/contactinfo-widget.php');

/**
 ** Load storevilla About info widget area.
**/
require $storevilla_por_aboutinfo_file_path = storevilla_pro_file_directory('/inc/widget/aboutinfo-widget.php');

/**
 ** Load storevilla promo widget area.
**/
require $storevilla_por_promo_file_path = storevilla_pro_file_directory('/inc/widget/promo-widget.php');

/**
 ** Load storevilla brand logo widget area.
**/
require $storevilla_por_logo_file_path = storevilla_pro_file_directory('/inc/widget/logo-widget.php');

/**
 ** Load storevilla Team Member widget area.
*/
require $storevilla_por_logo_file_path = storevilla_pro_file_directory('/inc/widget/team-widget.php');

//if ( is_woocommerce_activated() ) {
	/**
	 ** Load storevilla pro all WooCommerce Compitable widget area.
	*/
	require $storevilla_por_storevilla_file_path = storevilla_pro_file_directory('/inc/widget/storevilla-widget.php');
//}