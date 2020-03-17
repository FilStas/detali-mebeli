<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Store_Villa
 */

if ( ! function_exists( 'storevilla_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function storevilla_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'storevilla-pro' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'storevilla-pro' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'storevilla_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function storevilla_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'storevilla-pro' ) );
		if ( $categories_list && storevilla_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'storevilla-pro' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'storevilla-pro' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'storevilla-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'storevilla-pro' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'storevilla-pro' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function storevilla_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'storevilla_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'storevilla_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so storevilla_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so storevilla_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in storevilla_categorized_blog.
 */
function storevilla_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'storevilla_categories' );
}
add_action( 'edit_category', 'storevilla_category_transient_flusher' );
add_action( 'save_post',     'storevilla_category_transient_flusher' );


/**
 * StoreVilla Pro Custom Function Section.
**/
 
 
/**
 * Header Section Function Area
**/

if ( ! function_exists( 'storevilla_pro_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_pro_skip_links() {
		?>
			<a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'storevilla-pro' ); ?></a>
			<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'storevilla-pro' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'storevilla_top_header' ) ) {
	/**
	 * Display Top Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_top_header() {
		$top_header = get_theme_mod('storevilla_top_header','enable');
		$header_options = get_theme_mod('storevilla_top_left_options','nav');
		// Quick Info
			$emial_icon = esc_attr ( get_theme_mod('storevilla_email_icon') ) ;
			$email_address = esc_attr ( get_theme_mod('storevilla_email_title') );
			
			$phone_icon = esc_attr ( get_theme_mod('storevilla_phone_icon') );
			$phone_number = esc_attr ( get_theme_mod('storevilla_phone_number') );
			
			$map_address_iocn = esc_attr ( get_theme_mod('storevilla_address_icon') );
			$map_address = esc_attr ( get_theme_mod('storevilla_map_address') );
			
			$shop_open_icon = esc_attr ( get_theme_mod('storevilla_shop_open_icon') );
			$shop_open_time = esc_attr ( get_theme_mod('storevilla_shop_open_time') );
			
			// Offter Ticker

			$offter_title = esc_attr ( get_theme_mod('storevilla_offer_ticker_title','Offter') );
			
		if( !empty( $top_header ) && $top_header == 'enable' ) {
			?>
				<div class="top-header <?php echo $header_options; ?>">
					
					<div class="store-container clearfix">
						
						<?php  
							if( !empty( $header_options ) && $header_options == 'nav' ) { ?>
							<div class="topheadernav">
								<div class="topmenutoggle" aria-controls="primary-navigation">
									<span></span>
								</div>
								<nav class="top-navigation" role="navigation">									
									<?php  wp_nav_menu( array( 'theme_location'	=> 'topmenu', 'container' => '' ) ); ?> 
								</nav>
							</div>
							
							<?php }elseif(!empty( $header_options ) && $header_options == 'offerticker' ) { ?>

								<div class="sv-offter-ticker-wrap">
									<div class="sp-offter-tag">
										<span><?php echo $offter_title; ?></span>
									</div>
									<ul id="offter-ticker" class="offter-ticker cS-hidden">
										<?php
											$offter_desc = get_theme_mod('storevilla_offer_ticker_desc');
											if(!empty( $offter_desc )) {
											$offter_ticker = json_decode( $offter_desc );
											foreach($offter_ticker as $ticker){	
										?>
											<li><p><?php echo $ticker->text; ?></p></li>
										
										<?php } } ?>
									</ul>
								</div>

							<?php }else{ ?>
							<ul class="store-quickinfo">
									
								<?php if(!empty( $email_address )) { ?>
									
				                    <li>
				                    	<span class="<?php if(!empty( $emial_icon )) { echo $emial_icon; } ?>">&nbsp;</span>
				                    	<a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a>
				                    </li>
			                    <?php }  ?>
			                    
			                    <?php if(!empty( $phone_number )) { ?>
									
				                    <li>
				                    	<span class="<?php if(!empty( $phone_icon )) { echo $phone_icon; } ?>">&nbsp;</span>
				                   		<?php echo $phone_number; ?>
				                    </li>
			                    <?php }  ?>
			                    
			                    <?php if(!empty( $map_address )) { ?>
									
				                    <li>
				                    	<span class="<?php if(!empty( $map_address_iocn )) { echo $map_address_iocn; } ?>">&nbsp;</span>
				                    	<?php echo $map_address; ?>
				                    </li>
			                    <?php }  ?>
			                    
			                    <?php if(!empty( $shop_open_time )) { ?>
									
				                    <li>
				                    	<span class="<?php if(!empty( $shop_open_icon )) { echo $shop_open_icon; } ?>">&nbsp;</span>
				                    	<?php echo $shop_open_time; ?>
				                    </li>
			                    <?php }  ?>
			                    
							</ul>
			                  
						<?php
							}
						?>
						
						<!-- Top-navigation -->
						
						<div class="top-header-regin">						
								
	                		<ul class="site-header-cart menu">

    							<?php if (is_user_logged_in()) { ?>	
    							
    				                <li class="my_account_wrapper">
    									<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account','storevilla-pro');?>">
    										<?php _e('My Account','storevilla-pro'); ?>
    									</a>
    								</li>
    			
    								<li>
    				                    <a class="sv_logout" href="<?php echo wp_logout_url( home_url() ); ?>">
    				                        <?php _e(' Logout', 'storevilla-pro'); ?>
    				                    </a>
    			                    </li>
    			
    			                <?php } else { ?>
    			
    			                	<li>
    				                    <a class="sv_login" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
    				                        <?php _e('Login / Register', 'storevilla-pro'); ?>
    				                    </a>
    			                    </li>
    			                <?php }  ?>
	                			
				                    <li><?php if(function_exists( 'storevilla_pro_wishlist' )) { storevilla_pro_wishlist(); } ?></li>

					            <?php
									$headerlayout = get_theme_mod('storevilla_pro_header_type','headerone');
									if($headerlayout == 'headerone'){
									if ( is_woocommerce_activated() ) { 
					            ?>	                			
		                			<li>	                				
		                				<?php 
		                					storevilla_pro_shopping_cart_header_one();
		                					the_widget( 'WC_Widget_Cart', 'title=' ); 
		                				?>
		                			</li>

	                			<?php } } ?>

					            <?php
									if($headerlayout == 'headerthree'){
									if ( is_woocommerce_activated() ) { 
					            ?>	                			
			            			<li>	                				
			            				<?php 
			            					storevilla_pro_shopping_cart_header_three();
			            					the_widget( 'WC_Widget_Cart', 'title=' ); 
			            				?>
			            			</li>

			        			<?php } } ?>

	                			<?php
					            	if ( is_active_sidebar( 'header-1' ) ) { ?>
										<li>
											<div class="header-widget-region" role="complementary">
												<?php dynamic_sidebar( 'header-1' ); ?>
											</div>
										</li>
								<?php } ?>

	                		</ul>								
					          
						</div>
						
					</div>
					
				</div>
			<?php
		}
	}
}


if ( ! function_exists( 'storevilla_button_header' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_button_header() { ?>
		<div class="header-wrap clearfix">
			<div class="store-container">
				<div class="site-branding">
					<?php
						if ( function_exists( 'the_custom_logo' ) ) {
							the_custom_logo();
						}
					?>
					<div class="sv-logo-wrap">
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : 
						?>
						<p class="site-description"><?php echo $description; ?></p>
						<?php endif; ?>
					</div>
				</div><!-- .site-branding -->
				<div class="search-cart-wrap clearfix">
					<?php
				
					/**
					 * Display Product Search
					 * @since  1.0.0
					 * @uses  is_woocommerce_activated() check if WooCommerce is activated
					 * @return void
					 */
					 
					if ( is_woocommerce_activated() ) { ?>
						<div class="advance-search">
							<?php echo storevilla_product_search(); ?>
						</div>
					<?php } else{ ?>
						<div class="normal-search">
							<?php get_search_form(); ?>
						</div>
					<?php } ?>
				</div>
				<?php
					$headerlayout = get_theme_mod('storevilla_pro_header_type','headerone');
					if($headerlayout == 'headertwo'){					
				?>
					<div class="sv-shopping-cart">
						<?php if ( is_woocommerce_activated() ) { storevilla_pro_shopping_cart_header_two(); } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	
	<?php
	}
}


if ( ! function_exists( 'storevilla_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_primary_navigation() { ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="store-container clearfix">

				<?php 
					$headerlayout = get_theme_mod('storevilla_pro_header_type','layoutone');
					if($headerlayout == 'headertwo'){
						echo storevilla_pro_add_browse_categories_nav_menu_items();
					}
				?>

				<div class="menu-toggle" aria-controls="primary-navigation">
					<span></span>
				</div>			
		       
				<?php
					wp_nav_menu(
						array(
							'theme_location'	=> 'primary',
							'menu_id' => 'primary-menu',
							'container_class'	=> 'primary-navigation',
						)
					);
				?>
			</div>
		</nav><!-- #site-navigation -->
		<?php
	}
}


/**
 * Footer Section Function Area
**/

if ( ! function_exists( 'storevilla_pro_footer_widgets' ) ) {
	/**
	 * Display the theme quick info
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_pro_footer_widgets() {
		
			if ( is_active_sidebar( 'footer-4' ) ) {
				$widget_columns = apply_filters( 'storevilla_footer_widget_regions', 5 );
			} elseif ( is_active_sidebar( 'footer-3' ) ) {
				$widget_columns = apply_filters( 'storevilla_footer_widget_regions', 4 );
			} elseif ( is_active_sidebar( 'footer-2' ) ) {
				$widget_columns = apply_filters( 'storevilla_footer_widget_regions', 3 );
			} elseif ( is_active_sidebar( 'footer-1' ) ) {
				$widget_columns = apply_filters( 'storevilla_footer_widget_regions', 2 );
			} elseif ( is_active_sidebar( 'footer-1' ) ) {
				$widget_columns = apply_filters( 'storevilla_footer_widget_regions', 1 );
			} else {
				$widget_columns = apply_filters( 'storevilla_footer_widget_regions', 0 );
			}
	
			if ( $widget_columns > 0 ) : ?>
	
				<section class="footer-widgets col-<?php echo intval( $widget_columns ); ?> clearfix">
					
					<div class="top-footer-wrap">

						<div class="store-container">

							<?php $i = 0; while ( $i < $widget_columns ) : $i++; ?>
			
								<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
			
									<section class="block footer-widget-<?php echo intval( $i ); ?>">
							        	<?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
									</section>
			
						        <?php endif; ?>
			
							<?php endwhile; 

							if ( is_active_sidebar( 'quick-info' ) ) { ?>		
								<div class="footer-quick-info" role="complementary">				
									<?php dynamic_sidebar( 'quick-info' ); ?>				
								</div>			
							<?php } ?>

						</div>

					</div>
	
				</section><!-- .footer-widgets  -->
	
		<?php endif;
	}
}

 
if ( ! function_exists( 'storevilla_pro_credit' ) ) {
	/**
	 * Display the theme credit
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_pro_credit() {
		?>
		
		<div class="bottom-footer-wrap clearfix">

			<div class="store-container">

				<div class="site-info">
					<?php $copyright = get_theme_mod( 'storevilla_footer_copyright' ); if( !empty( $copyright ) ) { ?>
						<?php echo apply_filters( 'storevilla_copyright_text', $copyright ); ?>	
					<?php } else { ?>
						<?php echo esc_html( apply_filters( 'storevilla_copyright_text', $content = '&copy; ' . date( 'Y' ) . ' - ' . get_bloginfo( 'name' ) ) ); ?>
					<?php if ( apply_filters( 'storevilla_credit_link', true ) ) { 
						printf( __( '%1$s By %2$s', 'storevilla-pro' ), ' ', '<a href=" ' . esc_url('https://accesspressthemes.com/') . ' " alt="Premium WordPress Themes & Plugins by AccessPress Themes" title="Premium WordPress Themes & Plugins by AccessPress Themes" rel="designer" target="_blank">AccessPress Themes</a>' ); ?>
					<?php } } ?>
				</div><!-- .site-info -->
				
		<?php
	}
}


if ( ! function_exists( 'storevilla_pro_payment_logo_area' ) ) {
	/**
	 * Display the theme payment logo
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_pro_payment_logo_area() {
		?>
				<div class="site-payment-logo">
					<?php storevilla_pro_payment_logo(); ?>
				</div>

			</div>
			
		</div>
		<?php
	}
}




/**
 * Main HomePage Section Function Area
**/
 
if ( ! function_exists( 'storevilla_main_slider' ) ) {
	/**
	 * Display the banner slider
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_main_slider() {
		
			$slider_options = get_theme_mod( 'storevilla_main_banner_settings','enable' );
			$slider_layout = get_theme_mod( 'storevilla_pro_banner_type_layout','promobanner' );
			$slider_type = get_theme_mod( 'storevilla_pro_homepage_slider_type_options','normal' );
			$slider_promo = get_theme_mod( 'storevilla_main_header_promo_settings','enable' );
		?>
		<div class="store-villa-banner <?php if($slider_layout == 'fullbanner'){ echo $layout_class = 'full-width-banner'; } ?> clearfix">
			<div class="store-container">
				<?php  if(!empty( $slider_options ) && $slider_options == 'enable' ){ ?>
					<div class="slider-wrapper">
						<?php if($slider_type == 'normal'){ ?>
							<ul id="store-gallery" class="store-gallery cS-hidden">
								<?php
									$all_slider = get_theme_mod('storevilla_main_banner_slider');
									if(!empty( $all_slider )) {
									$banner_slider = json_decode( $all_slider );
									foreach($banner_slider as $slider){	
								?>
								<li class="banner-slider">
									<img src="<?php echo esc_url($slider->image_url); ?>" alt="<?php echo esc_attr($slider->title); ?>"/>
									<div class="banner-slider-info">
										<h2 class="caption-title"><?php echo $slider->title;?></h2>
										<div class="caption-content">
												<?php echo $slider->text; ?>
										</div>
										<?php if($slider->subtitle): ?>
											<a class="slider-button" href="<?php echo esc_url($slider->link); ?>"><?php echo esc_attr($slider->subtitle); ?></a>
										<?php endif; ?>
									</div>
								</li>
								<?php } } ?>
							</ul>
						<?php } elseif($slider_type == 'revolution') {
								echo do_shortcode( get_theme_mod( 'storevilla_pro_slider_revolution' ) );
						 	} 
						?>
					</div>
				<?php } ?>
				<?php if(!empty( $slider_promo ) && $slider_promo == 'enable' ){  storevilla_promo_area(); } ?>
			</div>
		</div>
		<?php }
}


if ( ! function_exists( 'storevilla_main_widget' ) ) {
	/**
	 * Display all product and category widget
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_main_widget() {
		?>
			
			<?php if ( is_active_sidebar( 'topwidgetarea' ) ) { ?>
				<div class="main-widget-wrap">
					<?php dynamic_sidebar( 'topwidgetarea' ); ?>
				</div>	
			<?php } ?>
			

			<div class="homepage-middle-wrap clearfix">
				<div class="store-container">
						
					<?php if ( is_active_sidebar( 'mainwidgetarea' ) ) {  ?>
						<div class="homepage-main-widget">
							<?php dynamic_sidebar( 'mainwidgetarea' );  ?>
						</div>	
					<?php } ?>

					<?php if ( is_active_sidebar( 'sidebarwidgetarea' ) ) {  ?>
						<div class="homepage-sidebar widget-area">
							<?php dynamic_sidebar( 'sidebarwidgetarea' ); ?>
						</div>	
					<?php }  ?>
				</div>
			</div>


			
			<?php  if ( is_active_sidebar( 'buttomwidgetarea' ) ) {  ?>
				<div class="main-widget-wrap">
					<?php dynamic_sidebar( 'buttomwidgetarea' );  ?>
				</div>	
			<?php } ?>
			
		<?php
	}
}

if ( ! function_exists( 'storevilla_service_area' ) ) {
	/**
	 * Display the brand logo
	 * @since  1.0.0
	 * @return void
	 */
	function storevilla_service_area() {
		 
		 storevilla_pro_service_section();
			
	}
}


/**
 *  Add the Link to Quick View Function
**/

if( defined( 'YITH_WCQV' ) ){
	function storevilla_pro_quickview(){
		global $product;
		$quick_view = YITH_WCQV_Frontend();
		remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
		$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
		echo '<a href="#" class="link-quickview yith-wcqv-button" data-product_id="' . get_the_ID() . '">' . $label . '</a>';
	}
}

/**
 ** Product Wishlist Button Function
**/
if (defined( 'YITH_WCWL' )) { 

	function storevilla_pro_wishlist_products() {      
	      global $product;
	      $url = add_query_arg( 'add_to_wishlist', get_the_ID() );
	      $id = get_the_ID();
	      $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?> 

		  	<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">
		        
		        <div class="yith-wcwl-add-button show" style="display:block">
		        	<a href="<?php echo esc_url( $url ); ?>" data-toggle="tooltip" data-placement="top" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" title="<?php _e( 'Add to Wishlist', 'storevilla-pro' ); ?>" class="add_to_wishlist link-wishlist">
		        		<?php _e( 'Add Wishlist', 'storevilla-pro' ); ?>
		        	</a>
		        	<img src="<?php echo get_template_directory_uri() . '/images/loading.gif'; ?>" class="ajax-loading" alt="loading" width="16" height="16">

		        </div>		      

		        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
		        	<a class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>"><?php _e( 'View Wishlist', 'storevilla-pro' ); ?></a>
		        </div>

		        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
		        	<a  class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>"><?php _e( 'Browse Wishlist', 'storevilla-pro' ); ?></a>
		        </div>

		        <div class="clear"></div>
		        <div class="yith-wcwl-wishlistaddresponse"></div>

		    </div>

	  	 <?php
	}

	/**
	 * Wishlist Header Count Ajax Function
	**/
	if ( ! function_exists( 'storevilla_pro_wishlist' ) ) {
	  	function storevilla_pro_wishlist() {
	  		if ( function_exists( 'YITH_WCWL' ) ) { 
	            $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>	            
	            <div class="top-wishlist text-right">
					<a href="<?php echo esc_url( $wishlist_url ); ?>" title="Wishlist" data-toggle="tooltip">
						<div class="count">
							<span class="badge bigcounter"><?php _e('Wishlist','storevilla-pro'); ?><?php echo " (" . yith_wcwl_count_products() . ") "; ?></span>
						</div>
					</a>
				</div>
	        <?php
	        }
	  	}
	 }
	add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'storevilla_pro_wishlist' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'storevilla_pro_wishlist' );
}

/**
 * Add Search icon with form in header layout three
**/
$headerlayout = get_theme_mod('storevilla_pro_header_type','layoutone');
if($headerlayout == 'headerthree'){
	if ( ! function_exists( 'storevilla_pro_add_search_icon_nav_menu_items' ) ) {
		function storevilla_pro_add_search_icon_nav_menu_items($items, $args) {
		    if( $args->theme_location == 'primary' ){
		  		$searchlink = '<div class="search-icon">
						   <i class="fa fa-search"></i>
						   <div class="svilla-search">
						       <div class="close">&#215;</div>
						    	<div class="overlay-search">'. storevilla_product_search() .'</div> 
						   </div><!-- .svilla-search -->
						</div>';
		  		$items = $items.$searchlink;		  		
		    }
		    return $items;		    
		}		
	}
}
//add_filter( 'wp_nav_menu_items', 'storevilla_pro_add_search_icon_nav_menu_items', 10, 2 );


/**
 * Add browse categories in header layout two
**/

if ( ! function_exists( 'storevilla_pro_add_browse_categories_nav_menu_items' ) ) {
	function storevilla_pro_add_browse_categories_nav_menu_items() {
    	$product_categories = get_terms( 'product_cat');
    	$count = count($product_categories);		    	

  		$browses = '<div class="browse-category-wrap">
					    <div class="browse-category">
					   		<i class="fa fa-bars"></i> '.__('Browse Categories','storevilla-pro').'
					    </div>
						<div class="categorylist">'; ?>
						  	<?php
						  		if ( is_woocommerce_activated() ) {
						  			$browses .= '<ul>';
							  		    foreach ( $product_categories as $product_category ) {
							  		        $browses .= '<li><a href="' . get_term_link( $product_category ) . '">' . $product_category->name . '</a></li>';
							  		    }
						  		    $browses .= '</ul>';
					  		   	}
						  	?>
			<?php $browses .= '</div>
				    </div>';
  		return $browses;
    }
}
