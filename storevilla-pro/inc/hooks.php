<?php

/**
 * Header action Area
 */

/**
 * Header
 * @see  storevilla_pro_skip_links() - 0
 * @see  storevilla_top_header() - 10
 * @see storevilla_top_nav (filter for top header navigation)
 * @see  storevilla_button_header() - 20
 * @see  storevilla_primary_navigation() - 30
 */
add_action( 'storevilla_header', 'storevilla_pro_skip_links', 	  0 );
add_action( 'storevilla_header', 'storevilla_top_header', 10 );
add_action( 'storevilla_header', 'storevilla_button_header', 20 );
add_action( 'storevilla_header', 'storevilla_primary_navigation', 30 );


/**
 * Footer action Area
**/
 
/**
* Header
* @see  storevilla_pro_footer_widgets()
* @see  storevilla_pro_credit()
* @see  storevilla_pro_payment_logo()
*/
 
add_action( 'storevilla_footer', 'storevilla_pro_footer_widgets', 10 );
add_action( 'storevilla_footer', 'storevilla_pro_credit', 20 );
add_action( 'storevilla_footer', 'storevilla_pro_payment_logo', 40 );



/**
 * Main HomePage Section Function Area
**/
 
/**
* Header
* @see  storevilla_main_slider()
* @see  storevilla_main_widget()
* @see  storevilla_breand_logo()
* @see  storevilla_service_area()
*/
 
add_action( 'storevilla_homepage', 'storevilla_main_slider', 10 );
add_action( 'storevilla_homepage', 'storevilla_main_widget', 20 );
add_action( 'storevilla_homepage', 'storevilla_service_area', 40 );

/**
  * Dynamic Custom CSS Function Area
**/

if ( ! function_exists( 'storevilla_pro_custom_stylesheet' ) ) {

	function storevilla_pro_custom_stylesheet(){ ?>
			<style type="text/css">
				<?php

					/**
					 * Typography frontend section
					**/						
						/* === <p> === */
						$p_font_family = get_theme_mod( 'p_font_family');
						$p_font_stylefull = get_theme_mod( 'p_font_style','normal');
						if(!empty($p_font_stylefull)) {
							$p_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$p_font_stylefull);
							if(isset($p_font_style_weight[1])){
								$p_font_style = $p_font_style_weight[1];
							}else{
								$p_font_style = 'normal';
							} 

							if(isset($p_font_style_weight[0])){
								$p_font_weight = $p_font_style_weight[0]; 
							}else{
								$p_font_weight = 400;
							}
						}
						$p_text_decoration = get_theme_mod( 'p_text_decoration');
						$p_text_transform = get_theme_mod( 'p_text_transform');
						$p_font_size = get_theme_mod( 'p_font_size');
						$p_line_height = get_theme_mod( 'p_line_height');
						$p_color = get_theme_mod( 'p_color');
							
					$theme_colors = " body.svilla  p{
							 		font-family : ".$p_font_family .";
							 		font-style : ".$p_font_style .";
							 		font-weight : ".$p_font_weight .";
							 		text-decoration : ".$p_text_decoration .";
							 		text-transform : ".$p_text_transform .";
							 		font-size : ".$p_font_size ."px;
							 		line-height : ".$p_line_height .";
							 		color : ".$p_color .";
								}\n";


						/* === <h1> === */
						$h1_font_family = get_theme_mod( 'h1_font_family');
						$h1_font_stylefull = get_theme_mod( 'h1_font_style','400/normal');
						if(!empty($h1_font_stylefull)) {
							$h1_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$h1_font_stylefull);
							if(isset($h1_font_style_weight[1])){
								$h1_font_style = $h1_font_style_weight[1];
							}else{
								$h1_font_style = 'normal';
							} 

							if(isset($h1_font_style_weight[0])){
								$h1_font_weight = $h1_font_style_weight[0]; 
							}else{
								$h1_font_weight = 400;
							}
						}
						$h1_text_decoration = get_theme_mod( 'h1_text_decoration');
						$h1_text_transform = get_theme_mod( 'h1_text_transform');
						$h1_font_size = get_theme_mod( 'h1_font_size');
						$h1_line_height = get_theme_mod( 'h1_line_height');
						$h1_color = get_theme_mod( 'h1_color');
							
					$theme_colors .= " body.svilla  h1 {
							 		font-family : ".$h1_font_family .";
							 		font-style : ".$h1_font_style .";	
							 		font-weight : ".$h1_font_weight .";
							 		text-decoration : ".$h1_text_decoration .";
							 		text-transform : ".$h1_text_transform .";
							 		font-size : ".$h1_font_size ."px;
							 		line-height : ".$h1_line_height .";
							 		color : ".$h1_color .";
								}\n";

						/* === <h2> === */
						$h2_font_family = get_theme_mod( 'h2_font_family');
						$h2_font_stylefull = get_theme_mod( 'h2_font_style','400/normal');
						if(!empty($h2_font_stylefull)) {
							$h2_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$h2_font_stylefull);
							if(isset($h2_font_style_weight[1])){
								$h2_font_style = $h2_font_style_weight[1];
							}else{
								$h2_font_style = 'normal';
							} 

							if(isset($h2_font_style_weight[0])){
								$h2_font_weight = $h2_font_style_weight[0]; 
							}else{
								$h2_font_weight = 400;
							}
						}
						$h2_text_decoration = get_theme_mod( 'h2_text_decoration');
						$h2_text_transform = get_theme_mod( 'h2_text_transform');
						$h2_font_size = get_theme_mod( 'h2_font_size');
						$h2_line_height = get_theme_mod( 'h2_line_height');
						$h2_color = get_theme_mod( 'h2_color');
							
					$theme_colors .= " body.svilla  h2 {
							 		font-family : ".$h2_font_family .";	
							 		font-style : ".$h2_font_style .";	
							 		font-weight : ".$h2_font_weight .";
							 		text-decoration : ".$h2_text_decoration .";
							 		text-transform : ".$h2_text_transform .";
							 		font-size : ".$h2_font_size ."px;
							 		line-height : ".$h2_line_height .";
							 		color : ".$h2_color .";
								}\n";

						/* === <h3> === */
						$h3_font_family = get_theme_mod( 'h3_font_family');
						$h3_font_stylefull = get_theme_mod( 'h3_font_style','400/normal');
						if(!empty($h3_font_stylefull)) {
							$h3_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$h3_font_stylefull);
							if(isset($h3_font_style_weight[1])){
								$h3_font_style = $h3_font_style_weight[1];
							}else{
								$h3_font_style = 'normal';
							} 

							if(isset($h3_font_style_weight[0])){
								$h3_font_weight = $h3_font_style_weight[0]; 
							}else{
								$h3_font_weight = 400;
							}
						}
						$h3_text_decoration = get_theme_mod( 'h3_text_decoration');
						$h3_text_transform = get_theme_mod( 'h3_text_transform');
						$h3_font_size = get_theme_mod( 'h3_font_size');
						$h3_line_height = get_theme_mod( 'h3_line_height');
						$h3_color = get_theme_mod( 'h3_color');
							
					$theme_colors .= " body.svilla  h3 {
							 		font-family : ".$h3_font_family .";	
							 		font-style : ".$h3_font_style .";	
							 		font-weight : ".$h3_font_weight .";
							 		text-decoration : ".$h3_text_decoration ."
							 		text-transform : ".$h3_text_transform .";
							 		font-size : ".$h3_font_size ."px;
							 		line-height : ".$h3_line_height .";
							 		color : ".$h3_color .";
								}\n";

						/* === <h4> === */
						$h4_font_family = get_theme_mod( 'h4_font_family');
						$h4_font_stylefull = get_theme_mod( 'h4_font_style','400/normal');
						if(!empty($h4_font_stylefull)) {
							$h4_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$h4_font_stylefull);
							if(isset($h4_font_style_weight[1])){
								$h4_font_style = $h4_font_style_weight[1];
							}else{
								$h4_font_style = 'normal';
							} 

							if(isset($h4_font_style_weight[0])){
								$h4_font_weight = $h4_font_style_weight[0]; 
							}else{
								$h4_font_weight = 400;
							}
						}
						$h4_text_decoration = get_theme_mod( 'h4_text_decoration');
						$h4_text_transform = get_theme_mod( 'h4_text_transform');
						$h4_font_size = get_theme_mod( 'h4_font_size');
						$h4_line_height = get_theme_mod( 'h4_line_height');
						$h4_color = get_theme_mod( 'h4_color');
							
					$theme_colors .= " body.svilla  h4 {
							 		font-family : ".$h4_font_family .";	
							 		font-style : ".$h4_font_style .";	
							 		font-weight : ".$h4_font_weight .";
							 		text-decoration : ".$h4_text_decoration .";
							 		text-transform : ".$h4_text_transform .";
							 		font-size : ".$h4_font_size ."px;
							 		line-height : ".$h4_line_height .";
							 		color : ".$h4_color .";
								}\n";

						/* === <h5> === */
						$h5_font_family = get_theme_mod( 'h5_font_family');
						$h5_font_stylefull = get_theme_mod( 'h5_font_style','400/normal');
						if(!empty($h5_font_stylefull)) {
							$h5_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$h5_font_stylefull);
							if(isset($h5_font_style_weight[1])){
								$h5_font_style = $h5_font_style_weight[1];
							}else{
								$h5_font_style = 'normal';
							} 

							if(isset($h5_font_style_weight[0])){
								$h5_font_weight = $h5_font_style_weight[0]; 
							}else{
								$h5_font_weight = 400;
							}
						}
						$h5_text_decoration = get_theme_mod( 'h5_text_decoration');
						$h5_text_transform = get_theme_mod( 'h5_text_transform');
						$h5_font_size = get_theme_mod( 'h5_font_size');
						$h5_line_height = get_theme_mod( 'h5_line_height');
						$h5_color = get_theme_mod( 'h5_color');
							
					$theme_colors .= " body.svilla  h5 {
							 		font-family : ".$h5_font_family .";	
							 		font-style : ".$h5_font_style .";	
							 		font-weight : ".$h5_font_weight .";
							 		text-decoration : ".$h5_text_decoration .";
							 		text-transform : ".$h5_text_transform .";
							 		font-size : ".$h5_font_size ."px;
							 		line-height : ".$h5_line_height .";
							 		color : ".$h5_color .";
								}\n";

						/* === <h5> === */
						$h6_font_family = get_theme_mod( 'h6_font_family');
						$h6_font_stylefull = get_theme_mod( 'h6_font_style','400/normal');
						if(!empty($h6_font_stylefull)) {
							$h6_font_style_weight = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$h6_font_stylefull);
							if(isset($h6_font_style_weight[1])){
								$h6_font_style = $h6_font_style_weight[1];
							}else{
								$h6_font_style = 'normal';
							} 

							if(isset($h6_font_style_weight[0])){
								$h6_font_weight = $h6_font_style_weight[0]; 
							}else{
								$h6_font_weight = 400;
							}
						}
						$h6_text_decoration = get_theme_mod( 'h6_text_decoration');
						$h6_text_transform = get_theme_mod( 'h6_text_transform');
						$h6_font_size = get_theme_mod( 'h6_font_size');
						$h6_line_height = get_theme_mod( 'h6_line_height');
						$h6_color = get_theme_mod( 'h6_color');
							
					$theme_colors .= " body.svilla  h6 {
							 		font-family : ".$h6_font_family .";	
							 		font-style : ".$h6_font_style .";	
							 		font-weight : ".$h6_font_weight .";
							 		text-decoration : ".$h6_text_decoration .";
							 		text-transform : ".$h6_text_transform .";
							 		font-size : ".$h6_font_size ."px;
							 		line-height : ".$h6_line_height .";
							 		color : ".$h6_color .";
								}\n";				    		
					
					echo $theme_colors
				?>
			</style>
		<?php 
	}
}
add_action('wp_head','storevilla_pro_custom_stylesheet');



if ( ! function_exists( 'storevilla_pro_pre_loader' ) ) {
	function storevilla_pro_pre_loader(){
		$preloader = esc_attr( get_theme_mod( 'storevilla_preloader_options', 1 ) ); ?>
		<?php if($preloader != 1) : ?>
		  <div class="storevilla-preloader"></div>
		<?php endif;
	}
}
add_action( 'storevillapro-preloader', 'storevilla_pro_pre_loader' );