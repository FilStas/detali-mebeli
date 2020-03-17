<header id="masthead" class="site-header headerthree" role="banner" <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . '); background-size:cover;"'; } ?>>
	
	<?php storevilla_top_header (); ?>

	
		<div class="store-container">
			<div class="header-wrap clearfix">
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
					</div>
					<?php endif; ?>
				</div><!-- .site-branding -->
			</div>
				
			<?php storevilla_primary_navigation(); ?>

		</div>

</header><!-- #masthead -->