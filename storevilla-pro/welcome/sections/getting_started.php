	<div class="theme-steps-list-wrap two-col">

		<div class="theme-steps col">
			<div class="step-1-right recommend-col">
				<h3><?php echo esc_html__('Links to Theme Options', 'storevilla-pro'); ?></h3>
				<div class="item-wrap">
					<?php
					$data    = array(
						array(
							'icon' => 'dashicons-format-gallery',
							'text' => __( 'Basic Settings', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-1' ), admin_url( 'themes.php' ) ),
						),
						array(
							'icon' => 'dashicons-admin-home',
							'text' => __( 'HomePage Settings', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-3' ), admin_url( 'themes.php' ) ),
						),
						array(
							'icon' => 'dashicons-external',
							'text' => __( 'Breadcrumb Settings', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-7' ), admin_url( 'themes.php' ) ),
						),
						array(
							'icon' => 'dashicons-update',
							'text' => __( 'Header Settings', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-2' ), admin_url( 'themes.php' ) ),
						),
						array(
							'icon' => 'dashicons-admin-appearance',
							'text' => __( 'Pricing Settings', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-5' ), admin_url( 'themes.php' ) ),
						),
						array(
							'icon' => 'dashicons-align-center',
							'text' => __( 'Slider Settings', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-6' ), admin_url( 'themes.php' ) ),
						),
						array(
							'icon' => 'dashicons-format-aside',
							'text' => __( 'Typography', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-4' ), admin_url( 'themes.php' ) ),
						),
						array(
							'icon' => 'dashicons-menu',
							'text' => __( 'Social Setting', 'storevilla-pro' ),
							'link' => add_query_arg( array( 'page' => 'theme_options#options-group-11' ), admin_url( 'themes.php' ) ),
						),
					); 
					foreach ( $data as $customizer_item ) {
						?>
						<div class="ti-customizer-item ">
							<i class="dashicons <?php echo esc_attr( $customizer_item['icon']); ?> "></i><a href="<?php echo esc_url( $customizer_item['link'] ); ?>"><?php echo wp_kses_post( $customizer_item['text'] ); ?></a>
						</div>
					<?php } ?>

				</div>
			</div>
			<div class="step-1-left">
				<h3><?php echo esc_html__('Step 1 - Checkout starter sites (Demos) ', 'storevilla-pro'); ?></h3>
				<p><?php printf(esc_html__('%1$s now comes with sites library with %2$s starter sites to pick from. You can check theme out and decide which one to start with. However you can decide not to use any one of them and start building your site from scratch.', 'storevilla-pro'),$this->theme_name,''); ?></p>
				<a class="nav-tab demo_import button" href="<?php echo esc_url(admin_url('/themes.php?page=welcome-page#demo_import')); ?>"><?php echo esc_html__('See Demos', 'storevilla-pro'); ?></a>
			</div>

		</div>

		<div class="theme-steps col">
			<h3><?php echo esc_html__('Step 2 - Import demo of your choice ', 'storevilla-pro'); ?></h3>
			<p><?php echo esc_html__('Once you chose one of the available starter sites (demos) - you can install it. Please be noted that once you install the demo, it will install all the required plugins too. It is not recommended to install demo on your existing content. A fresh WordPress installation would be required to install demo to replicate demo content exactly. ', 'storevilla-pro'); ?></p>
			<a class=" nav-tab demo_import button" href="<?php echo esc_url(admin_url('/themes.php?page=welcome-page#demo_import')); ?>"><?php echo esc_html__('Install Demo', 'storevilla-pro'); ?></a>
		</div>
		<div class="theme-steps col">
			<h3><?php echo esc_html__('Step 3 - Start editing the demo content and making your site! ', 'storevilla-pro'); ?></h3>
			<p><?php echo esc_html__('Once you install the demo, you can start editing the content, replacing images etc.', 'storevilla-pro'); ?></p>
		</div>
		<div class="theme-steps col">
			<h3><?php echo esc_html__('Step 4 - You \'re done! ', 'storevilla-pro'); ?></h3>
			<p><?php echo esc_html__('Go live with the website and get some rest', 'storevilla-pro'); ?></p>
		</div>
	</div>