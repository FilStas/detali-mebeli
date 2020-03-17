<header id="masthead" class="site-header" role="banner" <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . '); background-size:cover;"'; } ?>>
	<?php
		/**
		 * @see  storevilla_pro_skip_links() - 0
		 * @see  storevilla_top_header() - 10
		 * @see  storevilla_button_header() - 20
		 * @see  storevilla_primary_navigation() - 30
		**/			
		do_action( 'storevilla_header' ); 
	?>
</header><!-- #masthead -->