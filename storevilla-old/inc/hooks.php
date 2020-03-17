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
 * Themes required Plugins Install Section
**/

if ( ! function_exists( 'storevilla_pro_root_register_required_plugins' ) ) :
	
	function storevilla_pro_root_register_required_plugins() {

	    $plugins = array(
	    	
	        array(
	            'name' => 'WooCommerce',
	            'slug' => 'woocommerce',
	            'required' => false,
	        ),

	        array(
	            'name' => 'YITH WooCommerce Quick View',
	            'slug' => 'yith-woocommerce-quick-view',
	            'required' => false,
	        ),

	         array(
	            'name' => 'YITH WooCommerce Compare',
	            'slug' => 'yith-woocommerce-compare',
	            'required' => false,
	        ),

	        array(
	            'name' => 'YITH WooCommerce Wishlist',
	            'slug' => 'yith-woocommerce-wishlist',
	            'required' => false,
	        ),

	        array(
				'name' => 'WooCommerce Grid / List toggle',
				'slug' => 'woocommerce-grid-list-toggle',
				'required' => false,
			),

	        array(
	            'name' => 'AccessPress Instagram Feed',
	            'slug' => 'accesspress-instagram-feed',
	            'required' => false,
	        ),
	        
	        array(
	            'name' => 'AccessPress Twitter Feed',
	            'slug' => 'accesspress-twitter-feed',
	            'required' => false,
	        ),

	        array(
	            'name' => 'AccessPress Social Icons',
	            'slug' => 'accesspress-social-icons',
	            'required' => false,
	        ),

	        array(
	            'name' => 'AccessPress Social Share',
	            'slug' => 'accesspress-social-share',
	            'required' => false,
	        ),

	        array(
	            'name' => 'Ultimate Form Builder Lite',
	            'slug' => 'ultimate-form-builder-lite',
	            'required' => false,
	        ),

	        array(
	            'name' => 'WP Popup Banner Plugin',
	            'slug' => 'wp-popup-banners',
	            'required' => false,
	        ),
	        array(
	            'name'               => 'revslider', // The plugin name.
	            'slug'               => 'revslider', 
	            'source'             => get_template_directory_uri() . '/inc/plugins/revslider.zip', // The plugin source.
	            'required'           => true,
	            'version'            => '',
	            'force_activation'   => false,
	            'force_deactivation' => false,
	            'external_url'       => '', 
	            'is_callable'        => '',
	        )
	    );

	    $config = array(
	        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
	        'default_path' => '', // Default absolute path to pre-packaged plugins.
	        'menu' => 'tgmpa-install-plugins', // Menu slug.
	        'parent_slug' => 'themes.php', // Parent menu slug.
	        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
	        'has_notices' => true, // Show admin notices or not.
	        'dismissable' => true, // If false, a user cannot dismiss the nag message.
	        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
	        'is_automatic' => true, // Automatically activate plugins after installation or not.
	        'message' => '', // Message to output right before the plugins table.
	        'strings' => array(
	            'page_title' => __('Install Required Plugins', 'storevilla-pro'),
	            'menu_title' => __('Install Plugins', 'storevilla-pro'),
	            'installing' => __('Installing Plugin: %s', 'storevilla-pro'), // %s = plugin name.
	            'oops' => __('Something went wrong with the plugin API.', 'storevilla-pro'),
	            'notice_can_install_required' => _n_noop(
	                    'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_can_install_recommended' => _n_noop(
	                    'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_cannot_install' => _n_noop(
	                    'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_ask_to_update' => _n_noop(
	                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_ask_to_update_maybe' => _n_noop(
	                    'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_cannot_update' => _n_noop(
	                    'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_can_activate_required' => _n_noop(
	                    'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_can_activate_recommended' => _n_noop(
	                    'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'notice_cannot_activate' => _n_noop(
	                    'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'storevilla-pro'
	            ), // %1$s = plugin name(s).
	            'install_link' => _n_noop(
	                    'Begin installing plugin', 'Begin installing plugins', 'storevilla-pro'
	            ),
	            'update_link' => _n_noop(
	                    'Begin updating plugin', 'Begin updating plugins', 'storevilla-pro'
	            ),
	            'activate_link' => _n_noop(
	                    'Begin activating plugin', 'Begin activating plugins', 'storevilla-pro'
	            ),
	            'return' => __('Return to Required Plugins Installer', 'storevilla-pro'),
	            'plugin_activated' => __('Plugin activated successfully.', 'storevilla-pro'),
	            'activated_successfully' => __('The following plugin was activated successfully:', 'storevilla-pro'),
	            'plugin_already_active' => __('No action taken. Plugin %1$s was already active.', 'storevilla-pro'), // %1$s = plugin name(s).
	            'plugin_needs_higher_version' => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'storevilla-pro'), // %1$s = plugin name(s).
	            'complete' => __('All plugins installed and activated successfully. %1$s', 'storevilla-pro'), // %s = dashboard link.
	            'contact_admin' => __('Please contact the administrator of this site for help.', 'storevilla-pro'),
	            'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	        )
	    );
	    tgmpa($plugins, $config);
	}

add_action('tgmpa_register', 'storevilla_pro_root_register_required_plugins');

endif;


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