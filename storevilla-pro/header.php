<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Store_Villa
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php storevilla_html_tag_schema(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'storevillapro-preloader' ); ?>

<div id="page" class="hfeed site">

	<?php do_action( 'storevilla_before_header' ); ?>
	
	<?php
		$headerlayout = get_theme_mod('storevilla_pro_header_type','headerone');
		if($headerlayout == 'headerone'){
			get_template_part('header/header', 'one');
		}else if($headerlayout == 'headertwo'){
			get_template_part('header/header', 'two');
		}else if($headerlayout == 'headerthree'){
			get_template_part('header/header', 'three');
		}
		else{ get_template_part('header/header', 'one'); 
		}
	?>
		
	<?php do_action( 'storevilla_after_header' ); ?>

<div id="content" class="site-content">