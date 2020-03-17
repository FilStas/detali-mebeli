<?php
/**
* Welcome Page Initiation
*/

include get_template_directory() . '/welcome/welcome.php';

/** Plugins **/
$plugins = array(
	/* Companion Plugins */
	'companion_plugins' => array(
	),

	/* Displays on Required Plugins tab */
	'req_plugins' => array(
		'free_plug' => array(
			'woocommerce' => array(
				'slug'      => 'woocommerce',
				'filename' 	=> 'woocommerce.php',
				'class' 	=> 'WooCommerce',
			),
			'yith-woocommerce-compare' => array(
				'slug'      => 'yith-woocommerce-compare',
				'filename' 	=> 'init.php',
				'class' 	=> 'YITH_Woocompare',
			),
			'yith-woocommerce-quick-view' => array(
				'slug'      => 'yith-woocommerce-quick-view',
				'filename' 	=> 'yith-woocommerce-quick-view.php',
				'class' 	=> 'YITH_WCQV',
			),
			'yith-woocommerce-wishlist' => array(
				'slug'      => 'yith-woocommerce-wishlist',
				'filename' 	=> 'yith-woocommerce-wishlist.php',
				'class' 	=> 'YITH_WCWL',
			),
		),
		'pro_plug' => array(
			'revslider' 	=> array(
				'slug' 		=> 'revslider',
				'name' 		=> esc_html__('Revolution Slider ', 'storevilla-pro'),
				'version' 	=> esc_html__( '5.4.6', 'storevilla-pro' ),
				'author' 	=> 'ThemePunch',
				'filename' 	=>'revslider.php',
				'host_type' => 'remote',
				'location' 	=> 'https://accesspressthemes.com/plugin-repo/revslider/revslider.zip',
				'screenshot' => 'https://accesspressthemes.com/plugin-repo/revslider/screen.png',
				'class' 	=> 'RevSliderFront',
				'info' => esc_html__('Slider Revolution 6 is a new way to build rich & dynamic content for your websites. With our powerful visual editor, you can create modern designs in no time, and with no coding experience required.', 'storevilla-pro'),
			)
		)
	),

	/* Displays on Import Demo section */
	'required_plugins' => array( //test
		'access-demo-importer' => array(
			'slug' 		=> 'access-demo-importer',
			'name' 		=> esc_html__('Access Demo Importer', 'storevilla-pro'),
			'filename' 	=>'access-demo-importer.php',
			'host_type' => 'wordpress',
			'class' 	=> 'Access_Demo_Importer',
			'info' 		=> esc_html__('Access Demo Importer adds the feature to Import the Demo Conent with a single click.', 'storevilla-pro'),
		),
	),

	'recommended_plugins' => array (

		'free_plugins' => array(

			'accesspress-social-share' => array(
				'slug'      => 'accesspress-social-share',
				'filename' 	=> 'accesspress-social-share.php',
				'class' 	=> 'APSS_Class',
				'info' 		=> esc_html__('Social booster for your site! A FREE plugin with premium features.', 'storevilla-pro'),
			),

			'accesspress-social-icons' => array(
				'slug'      => 'accesspress-social-icons',
				'filename' 	=> 'accesspress-social-icons.php',
				'class' 	=> 'APS_Class',
				'info' 		=> esc_html__('Connect your website visitors to your social community in an easy way! Link up your social media profiles via great looking social buttons.', 'storevilla-pro'),
			),

			'accesspress-twitter-feed' => array(
				'slug'      => 'accesspress-twitter-feed',
				'filename' 	=> 'accesspress-twitter-feed.php',
				'class' 	=> 'APTF_Class',
				'info' 		=> esc_html__('Showcase your Tweets (Twitter Feeds) right on the site.', 'storevilla-pro'),
			),
			'accesspress-instagram-feed' => array(
				'slug'      => 'accesspress-instagram-feed',
				'filename' 	=> 'accesspress-instagram-feed.php',
				'class' 	=> 'APIF_Class',
				'info' 		=> esc_html__('Showcase your Instagram Feeds right on the site.', 'storevilla-pro'),
			),
		),

		// Pro Plugins
		'pro_plugins' => array(

			'woo-product-grid-list-design' 	=> array(
				'slug' 		=> 'woo-product-grid-list-design',
				'name' 		=> esc_html__('WOO Product Grid/List Design- Responsive Products Showcase Extension for Woocommerce', 'storevilla-pro'),
				'version' 	=> esc_html__( '1.0.3', 'storevilla-pro' ),
				'author' 	=> 'AccessPress Themes',
				'filename' 	=> 'woo-product-grid-list-design.php',
				'host_type' => 'remote',
				'link' 		=> 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fwoo-product-gridlist-design-responsive-products-showcase-extension-for-woocommerce%2F23167226',
				'screenshot' => 'https://accesspressthemes.com/plugin-repo/woo-product-grid/woo-product-grid.jpg',
				'class' 	=> 'WOPGLD_Class',
				'info' 		=> esc_html__('Design your WooCommerce shop like never before! A complete package for your Woo shop designer.', 'storevilla-pro'),
			),

			'woo-badge-designer' => array(
				'slug' 			=> 'woo-badge-designer',
				'name'         	=> esc_html__('Woo Badge Designer - WooCommerce Product Badge Designer WordPress Plugin', 'storevilla-pro'),
				'version' 		=> esc_html__('1.0.1', 'storevilla-pro'),
				'author' 		=> 'AccessPress Themes',
				'filename' 		=> 'woo-badge-designer.php',
				'host_type' 	=> 'remote',
				'link' 			=> 'https://1.envato.market/LyK3o',
				'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/woo-badge-designer/woo-badge-designer.jpg',
				'class' 		=> 'WOPGLD_Class',
				'info' 			=> esc_html__('Add some attractive badges on your product listing and single page and increase your sales upto 55%.', 'storevilla-pro'),
			),

			'wp-admin-white-label-login' => array(
				'slug' 			=> 'wp-admin-white-label-login',
				'name'      	=> esc_html__('WP Admin White Label Login - WordPress Plugin For Advanced Customizable Login page', 'storevilla-pro'),
				'version' 		=> esc_html__('1.3.5', 'storevilla-pro'),
				'author' 		=> 'AccessPress Themes',
				'filename' 		=> 'wp-admin-white-label-login.php',
				'host_type' 	=> 'remote',
				'link' 		=> 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fwp-admin-white-label-login-wordpress-plugin-for-advanced-customizable-login-page%2F23127723',
				'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/wp-admin-white-label-login/wp-admin-white-label-login.jpg',
				'class' 		=> 'WP_Admin_White_Label_Login',
				'info' 		=> esc_html__('Make your default wp-admin screen look like a non WP one! Choose from some great ready to use template designs and many features to boost your WordPress backend.', 'storevilla-pro'),
			),

			'easy-side-tab-pro' => array(
				'slug' 			=> 'easy-side-tab-pro',
				'name'      	=> esc_html__('Easy Side Tab Pro - Responsive Floating Tab Plugin For Wordpress', 'storevilla-pro'),
				'version' 		=> esc_html__('1.0.6', 'storevilla-pro'),
				'author' 		=> 'AccessPress Themes',
				'filename' 		=> 'easy-side-tab-pro.php',
				'host_type' 	=> 'remote',
				'link' 			=> 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Feasy-side-tab-pro-responsive-floating-tab-plugin-for-wordpress%2F22296723',
				'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/easy-side-tab-pro/easy-side-tab.jpg',
				'class' 		=> 'ESTP_Class',
				'info' 		=> esc_html__('Place some great designed floating tabs on your site for quick links. Increase accessibility of your site.', 'storevilla-pro'),
			),

			'everest-timeline' => array(
				'slug' 			=> 'everest-timeline',
				'name'         	=> esc_html__('Everest Timeline - Responsive WordPress Timeline Plugin', 'storevilla-pro'),
				'version' 		=> esc_html__('2.0.2', 'storevilla-pro'),
				'author' 		=> 'AccessPress Themes',
				'filename' 		=> 'everest-timeline.php',
				'host_type' 	=> 'remote',
				'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/everest-timeline/everest-timeline.jpg',
				'class' 		=> 'APMM_Class_Pro',
				'link'			=>'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Feverest-timeline-responsive-wordpress-timeline-plugin%2F20922265',
				'info' 		=> esc_html__('A perfect timeline maker! If you\'re planning to make one go for it!', 'storevilla-pro'),
			),
		)
	) //rec
);
$strings = array(
// Welcome Page General Texts
	'welcome_menu_text' => esc_html__( "Theme Setup", 'storevilla-pro' ),
	'theme_short_description' => esc_html__( 'StoreVilla Pro is a modern feature-rich responsive eCommerce WordPress theme built with the best level of WooCommerce integration along with and its extensions. The theme provides you an unlimited customization possibilities, powerful support, top-notch beautiful design, and loads of awesome features. It is a complete WordPress template for creating an online shop/ store of any kind like fashion and clothing store, tech items store, interior store, medical shops, grocery store etc. It is fully based on live WordPress Customizer which makes your task a lot easier. It features ultimate eCommerce options, unlimited color options, advanced typography, unlimited slider settings - inbuilt slider and Slider Revolution premium plugin support, one click demo import, 15+ custom widgets etc. It is fully mobile-responsive, retina ready, SEO optimized, multilingual theme that is an ideal choice for anyone and everyone.', 'storevilla-pro' ),

// Plugin Action Texts
	'install_n_activate' 	=> esc_html__('Install and Activate', 'storevilla-pro'),
	'deactivate' 			=> esc_html__('Deactivate', 'storevilla-pro'),
	'activate' 				=> esc_html__('Activate', 'storevilla-pro'),

// Getting Started Section
	'doc_heading' 		=> esc_html__('Step 1 - Documentation', 'storevilla-pro'),
	'doc_description' 	=> esc_html__('Read the Documentation and follow the instructions to manage the site , it helps you to set up the theme more easily and quickly. The Documentation is very easy with its pictorial  and well managed listed instructions. ', 'storevilla-pro'),
	'doc_read_now' 		=> esc_html__( 'Read Now', 'storevilla-pro' ),
	'cus_heading' 		=> esc_html__('Step 2 - Customizer Panel', 'storevilla-pro'),
	'cus_description' 	=> esc_html__('Using the customizer panel you can easily customize every aspect of the theme.', 'storevilla-pro'),
	'cus_read_now' 		=> esc_html__( 'Go to Customizer Panels', 'storevilla-pro' ),

// Recommended Plugins Section
	'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'storevilla-pro' ),
	'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'storevilla-pro' ),



// Demo Actions
	'activate_btn' 		=> esc_html__('Activate', 'storevilla-pro'),
	'installed_btn' 	=> esc_html__('Activated', 'storevilla-pro'),
	'demo_installing' 	=> esc_html__('Installing Demo', 'storevilla-pro'),
	'demo_installed' 	=> esc_html__('Demo Installed', 'storevilla-pro'),
	'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'storevilla-pro'),

// Actions Required
	'req_plugin_info' => esc_html__('All these required plugins will be installed and activated while importing demo. Or you can choose to install and activate them manually. If you\'re not importing any of the demos, you must install and activate these plugins manually.', 'storevilla-pro' ),
	'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'storevilla-pro' ),
	'customize_theme_btn' 	=> esc_html__( 'Customize Theme', 'storevilla-pro' ),
	'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'storevilla-pro' ),
	'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'storevilla-pro' ),
);

/**
* Initiating Welcome Page
*/
$my_theme_wc_page = new AccessPress_StorePro_Demo_Welcome( $plugins, $strings );