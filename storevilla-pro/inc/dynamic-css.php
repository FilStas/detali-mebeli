<?php
/**
 * Dynamic css
*/
if ( ! function_exists( 'storevilla_pro_dynamic_css' ) ) {

    function storevilla_pro_dynamic_css() {
       
        /*Color options */       
        $theme_color = get_theme_mod('storevilla_pro_primary_color','#0091d5');
        $theme_sec_color = get_theme_mod('storevilla_pro_secondary_color','#dd1f26');
        //$sv_rgba_bg_color = svpro_hex2rgba($fg_theme_color,0.85);

        $storevilla_colors = '';

        /*background*/         
            $storevilla_colors .= ".header-wrap .search-cart-wrap .advance-search .sv_search_form #searchsubmit,
            .top-header-regin ul li span.cart-count,
            .site-content .slider-wrapper .lSPager.lSpg li:hover a,
            .site-content .slider-wrapper .lSPager.lSpg li.active a,
            .widget_storevilla_cat_widget_area .category-slider li .item-img a:hover .sv_category_count,
            .item-img .new-label.new-top-left,
            .product-button-wrap a.button, 
            .product-button-wrap a.added_to_cart,
            .widget_storevilla_cat_with_product_widget_area .block-title-desc a.view-bnt:hover,
            .lSSlideOuter .lSPager.lSpg > li:hover a, 
            .lSSlideOuter .lSPager.lSpg > li.active a,
            .widget_storevilla_aboutus_info_area ul li a:hover,
            .widget_storevilla_contact_info_area ul li span:hover,
            .woocommerce nav.woocommerce-pagination ul li a:focus, 
            .woocommerce nav.woocommerce-pagination ul li a:hover, 
            .woocommerce nav.woocommerce-pagination ul li span.current,
            .widget_search form input[type=submit], 
            .widget_product_search form input[type=submit], 
            .no-results.not-found .search-form .search-submit,
            .woocommerce #respond input#submit,
            .woocommerce button.button, 
            .woocommerce input.button,
            .yith-woocompare-widget .compare.button,
            .yith-woocompare-widget a.clear-all:hover,
            .widget_tag_cloud .tagcloud a:hover, 
            .widget_product_tag_cloud .tagcloud a:hover,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active, 
            .woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
            .woocommerce #respond input#submit.alt, 
            .woocommerce a.button.alt, 
            .woocommerce button.button.alt, 
            .woocommerce input.button.alt,
            .quantity button,
            .woocommerce #respond input#submit.alt.disabled, 
            .woocommerce #respond input#submit.alt.disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled, 
            .woocommerce #respond input#submit.alt:disabled:hover, 
            .woocommerce #respond input#submit.alt[disabled]:disabled, 
            .woocommerce #respond input#submit.alt[disabled]:disabled:hover, 
            .woocommerce a.button.alt.disabled, 
            .woocommerce a.button.alt.disabled:hover, 
            .woocommerce a.button.alt:disabled, 
            .woocommerce a.button.alt:disabled:hover, 
            .woocommerce a.button.alt[disabled]:disabled, 
            .woocommerce a.button.alt[disabled]:disabled:hover, 
            .woocommerce button.button.alt.disabled, 
            .woocommerce button.button.alt.disabled:hover, 
            .woocommerce button.button.alt:disabled, 
            .woocommerce button.button.alt:disabled:hover, 
            .woocommerce button.button.alt[disabled]:disabled, 
            .woocommerce button.button.alt[disabled]:disabled:hover, 
            .woocommerce input.button.alt.disabled,
            .woocommerce input.button.alt.disabled:hover, 
            .woocommerce input.button.alt:disabled, 
            .woocommerce input.button.alt:disabled:hover, 
            .woocommerce input.button.alt[disabled]:disabled, 
            .woocommerce input.button.alt[disabled]:disabled:hover,
            .quantity button,
            .woocommerce #respond input#submit.alt:hover,
            .woocommerce input.button.alt:hover,
            .main-navigation,
            .headertwo .header-wrap .cart-contentstwo .header-icon,
            .widget_storevilla_cat_vertical_tabs_products_area .vertical-tabs ul.vertical-tab-links li.active a, 
            .widget_storevilla_cat_vertical_tabs_products_area .vertical-tabs ul.vertical-tab-links li:hover a,
            .widget_storevilla_promo_pages_area .full-promo-area .full-text-wrap a button,
            .blog_stylethree .column span.time,
            .tab-styletwo .svpro-tabs ul.svpro-tab-links li.active a:before,
            .tab-styletwo .svpro-tabs ul.svpro-tab-links li a:before,
            .tab-styletwo .svpro-tab-content ul.tabs-product li .item-img a.add_to_cart_button:hover,
            .tab-stylethree .svpro-tabs ul.svpro-tab-links li.active:before, 
            .tab-stylethree .svpro-tabs ul.svpro-tab-links li:hover:before,
            .tab-stylethree .lSAction a,
            .tab-stylethree .svpro-tab-content ul.tabs-product li .item-img .box-hover ul.add-to-links li a.link-quickview:before, 
            .tab-stylethree .svpro-tab-content ul.tabs-product li .item-img .box-hover ul.add-to-links li a.link-wishlist:before,
            .widget_storevilla_pro_prouct_list_widget_area .product-list-area ul.all-product-list li .text-wrapper .add-cart-list a:hover,
            .sv_call_to_action a.sv_call_to_action_button,
            .bttn,
            .sv-team .sv-member-message .social-shortcode a:hover,
            .sv-client-message .social-shortcode a:hover,
            .sv_toggle.open .sv_toggle_title, 
            .sv_toggle_title.active,
            .sv_toggle_title:hover,
            .horizontal .sv_tab_group .tab-title.active:before, 
            .horizontal .sv_tab_group .tab-title:hover:before,
            .vertical .sv_tab_group .tab-title.active,
            .headerthree .top-header .top-header-regin a.cart-contents,
            section.widget_storevilla_pro_offer_deal_widget_area .offer-product-wrap .fl-pcountdown-cnt,
            .main-navigation ul ul,
            .woocommerce-cart table.cart .quantity button:hover,
            .comments-area .reply a,
            .woocommerce .gridlist-toggle a:hover, 
            .woocommerce .gridlist-toggle a.active,
            .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
            .mCS-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
            .site-header-cart .woocommerce a.button.wc-forward,
            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            .comments-area .form-submit .submit,
            .woocommerce-MyAccount-navigation ul li.is-active a,
            .woocommerce-MyAccount-navigation ul li:hover a{

                background-color: $theme_color;

            }\n";

           

            $storevilla_colors .= " @media (max-width: 768px){
            .main-navigation ul li a {
                color: $theme_color !important;
            } }\n";

            $storevilla_colors .= " @media (max-width: 680px){
            .tab-styleone .svpro-tabs ul.svpro-tab-links li.active a, 
            .tab-styleone .svpro-tabs ul.svpro-tab-links li:hover a {
                background-color: $theme_color !important;
            } }\n";


            

            $storevilla_colors .= " .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{

                background: ".svpro_hex2rgba($theme_color,0.7)." !important;

            }\n";

            

            $storevilla_colors .= ".widget_storevilla_promo_pages_area .promo-area a:hover button, 
            .widget_storevilla_blog_widget_area .blog-preview a.blog-preview-btn:hover, 
            .widget_storevilla_blog_widget_area .large-blog-preview a.blog-preview-btn:hover{

                background: $theme_color none repeat scroll 0 0;

            }\n";

            $storevilla_colors .= ".calendar_wrap caption{

                background: none repeat scroll 0 0 $theme_color;

            }\n";


            $storevilla_colors .= " .top-header .sv-offter-ticker-wrap .sp-offter-tag,
            .sv-dropcaps.fg-square{

                background: $theme_color none repeat scroll 0 0;

            }\n";
            

            $storevilla_colors .= " .top-header .sv-offter-ticker-wrap .sp-offter-tag:before{

                border-color: transparent transparent transparent $theme_color;

            }\n";

        // Opacity Background 

            $storevilla_colors .= " .tab-styletwo .svpro-tab-content ul.tabs-product li .item-img a.add_to_cart_button, 
            .tab-styletwo .svpro-tab-content ul.tabs-product li .item-img a.added_to_cart, 
            .tab-styletwo .svpro-tab-content ul.tabs-product li .item-img a.product_type_grouped,
            .tab-stylethree .svpro-tab-content ul.tabs-product li .item-img .box-hover ul.add-to-links li a.link-quickview:hover:before, 
            .tab-stylethree .svpro-tab-content ul.tabs-product li .item-img .box-hover ul.add-to-links li a.link-wishlist:hover:before,
            .header-wrap .search-cart-wrap .advance-search .sv_search_form #searchsubmit:hover, 
            .normal-search .search-form .search-submit:hover,
            .headerthree .main-navigation .search-icon .svilla-search.active .overlay-search .close:hover{

                background: ".svpro_hex2rgba($theme_color,0.6).";

            }\n";                             

        /* Color */
            $storevilla_colors .= " .header-wrap .site-branding h1.site-title a,
                .header-wrap .site-branding .sv-logo-wrap,
                .top-header .top-header-regin ul li a:hover,
                .top-header .top-navigation ul li a:hover,
                .main-widget-wrap .block-title span, .block-title span,
                .widget_storevilla_latest_product_cat_widget_area .latest-product-slider li .block-item-title h3 a:hover, 
                .widget_storevilla_product_widget_area .store-product li .block-item-title h3 a:hover, 
                .widget_storevilla_cat_with_product_widget_area .cat-with-product li .block-item-title h3 a:hover, 
                .woocommerce ul.products li.product .block-item-title h3 a:hover,
                .widget_storevilla_latest_product_cat_widget_area .latest-product-slider li .block-item-title span a:hover, 
                .widget_storevilla_product_widget_area .store-product li .block-item-title span a:hover, 
                .widget_storevilla_cat_with_product_widget_area .cat-with-product li .block-item-title span a:hover,
                ul.add-to-links li a:hover,
                ul.add-to-links li a:hover,
                .widget_storevilla_column_product_widget_area .column-wrap .col-wrap .block-title h2,
                .our-features-box .feature-box span,
                .widget_nav_menu ul li a:hover, 
                .widget_pages ul li a:hover, 
                .widget_recent_entries ul li a:hover, 
                .widget_meta ul li a:hover, 
                .widget_archive ul li a:hover, 
                .widget_categories ul li a:hover,
                .widget_recent_comments ul li .comment-author-link a,
                a.scrollup:hover,
                h3.widget-title, 
                h3.comment-reply-title, 
                .comments-area h2.comments-title,
                .woocommerce .woocommerce-breadcrumb a:hover,
                .woocommerce .star-rating span::before,
                .single-product .compare.button:hover, 
                .single-product .entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .single-product .product_meta .posted_in a:hover,
                .woocommerce-tabs.wc-tabs-wrapper h2,
                .woocommerce .woocommerce-tabs p.stars a,
                .single-product .yith-wcwl-wishlistexistsbrowse.show .feedback,
                td a,
                .widget-area .widget_storevilla_contact_info_area h4,
                .woocommerce div.product form.cart .group_table td.label a,
                .woocommerce .woocommerce-info:before,
                .woocommerce-info a.showcoupon,
                .widget_storevilla_blog_widget_area .blog-preview .blog-preview-info h2 a:hover, 
                .widget_storevilla_blog_widget_area .large-blog-preview .blog-preview-info h2 a:hover,
                .headertwo .header-wrap .cart-contentstwo:hover .header-icon,
                .widget_shopping_cart .mini_cart_item .quantity,
                .top-header ul.store-quickinfo li a:hover,
                .widget_storevilla_cat_vertical_tabs_products_area .svpor-vertical-wrap ul.vertical-tabs-product > li .block-item-title a:hover,
                .widget_storevilla_promo_pages_area .full-promo-area .full-text-wrap h2,
                .tab-styleone .svpro-tabs ul.svpro-tab-links li.active a,
                .tab-styleone .svpro-tabs ul.svpro-tab-links li:hover a,
                .tab-styleone .svpro-tab-content ul.tabs-product li .block-item-title h3 a:hover, 
                .tab-styleone .svpro-tab-content ul.tabs-product li .block-item-title span a:hover,
                .blog_stylethree .column span.time:hover,
                .blog_stylethree .blog-inner .column h2 a:hover,
                .blog_stylethree .column .blog-info span.readmore a,
                .tab-styletwo .svpro-tab-content ul.tabs-product li .block-item-title h3 a:hover, 
                .tab-styletwo .svpro-tab-content ul.tabs-product li .block-item-title span a:hover,
                .tab-stylethree .svpro-tab-content ul.tabs-product li .block-item-title h3 a:hover, 
                .tab-stylethree .svpro-tab-content ul.tabs-product li .block-item-title span a:hover,
                .blog-outer-container.blog_styletwo .blog-column .blog-info .meta-wrap span a:hover, 
                .blog-outer-container.blog_styletwo .blog-column .blog-info h2 a:hover,
                .blog-outer-container.blog_styletwo .blog-column .blog-info span.readmore a,
                .widget_storevilla_pro_prouct_list_widget_area .product-list-area ul.all-product-list li .text-wrapper .block-item-title h3 a:hover,
                section.widget_storevilla_pro_offer_deal_widget_area .offer-product-info-wrap .offer-deal-links ul li a.link-quickview:hover, 
                section.widget_storevilla_pro_offer_deal_widget_area .offer-product-info-wrap .offer-deal-links ul li a.add_to_wishlist:hover,
                .widget_nav_menu ul li a:hover, .widget_pages ul li a:hover, 
                .widget_recent_entries ul li a:hover, 
                .widget_meta ul li a:hover, 
                .widget_archive ul li a:hover, 
                .widget_categories ul li a:hover, 
                .widget_product_categories ul li a:hover, 
                .widget_recent_comments ul li:hover, 
                .widget_recent_comments ul li:hover:before, 
                .widget_nav_menu ul li a:hover:before, 
                .widget_pages ul li a:hover:before, 
                .widget_recent_entries ul li a:hover:before, 
                .widget_meta ul li a:hover:before, 
                .widget_archive ul li a:hover:before, 
                .widget_categories ul li a:hover:before, 
                .site-footer .widget_recent_comments ul li a:hover:before, 
                .widget_product_categories ul li a:hover:before,
                .site-footer .site-info a:hover,
                .widget_products ul li span.product-title:hover, 
                .woocommerce ul.cart_list li a:hover, 
                .woocommerce ul.product_list_widget li a:hover,
                .single-product .product_meta span a,
                .widget_recent_comments ul li a,
                .quantity button:hover,
                table.wishlist_table .product-name a:hover, 
                table.wishlist_table .product-name a.button:hover,
                #content .page_header_wrap #storevilla-breadcrumb a:hover, 
                .woocommerce .woocommerce-breadcrumb a:hover,
                .sv_call_to_action a.sv_call_to_action_button:hover,
                .bttn:hover,
                .sv_toggle_title:before,
                .headerthree .main-navigation ul li.current-menu-item > a, 
                .headerthree .main-navigation ul li a:hover,
                .headerthree .main-navigation li.menu-item-has-children > a:hover:before,
                .widget_search form input[type=submit]:hover, 
                .widget_product_search form input[type=submit]:hover, 
                .no-results.not-found .search-form .search-submit:hover,
                .headertwo .header-wrap .cart-contentstwo:hover .text-holder .name-text,
                .widget_storevilla_testimonial_widget_area .testimonial-area .testimonial-preview-info p:before,
                .team-outer-container .grid-item-inner ul.social-icons li:hover a,
                .woocommerce-checkout-payment li.wc_payment_method.payment_method_paypal a.about_paypal,
                .storevilla-blog h3 a:hover,
                .blog-meta li a:hover,
                .post-navigation .nav-links .nav-previous a:hover, 
                .post-navigation .nav-links .nav-next a:hover,
                .woocommerce .gridlist-toggle a,
                .woocommerce .woocommerce-message::before,
                .main-navigation li.menu-item-has-children ul li:hover a:hover:before,
                .storevilla-blog .sv-post-content .category-name span a:hover,
                .storevilla-blog .sv-post-foot a:hover, 
                .storevilla-blog .sv-post-content a.sv-btn-countinuereading:hover,
                .yith-woocompare-widget .compare.button:hover,
                .woocommerce nav.woocommerce-pagination ul li a, 
                .woocommerce nav.woocommerce-pagination ul li span,
                .headerthree .top-header .top-header-regin ul li a:hover,
                .headerthree .main-navigation ul ul li a:hover,
                .top-header .top-navigation ul ul li:hover a,
                .headerthree .top-header-regin .site-header-cart > li a span.bigcounter:hover,
                .site-header-cart .woocommerce a.button.wc-forward:hover, 
                .site-header-cart .woocommerce a.button.checkout:hover,
                .headerthree .top-header .top-header-regin ul li a:hover, 
                .site-header-cart .woocommerce a.button.wc-forward:hover:before,
                .widget_storevilla_pro_prouct_list_widget_area .block-item-title span a:hover,
                .top-header .top-header-regin ul li a:hover, 
                .top-header-regin .count .fa.fa-shopping-basket:hover,
                .widget_storevilla_pro_offer_deal_widget_area .mini-title a:hover,
                .widget_storevilla_column_product_widget_area .column-wrap .col-product-area-one .block-item-title span a:hover,
                .widget_storevilla_column_product_widget_area .column-wrap .col-product-area-one .block-item-title h3 a:hover,
                .woocommerce a.button.alt:hover,
                .main-navigation ul ul li.current-menu-item a, 
                .main-navigation ul ul li a:hover,
                .comments-area .reply a:hover,
                .logged-in-as a,
                .comments-area .form-submit .submit:hover,
                .woocommerce #respond input#submit.alt:hover, .woocommerce input.button.alt:hover,
                .woocommerce-MyAccount-navigation ul li a,
                .woocommerce-MyAccount-content a,
                .site-branding h1.site-title a,
                .woocommerce button.button.alt:hover,
                .woocommerce #review_form #respond .form-submit input:hover,                
                .woocommerce-error:before {

                    color: $theme_color;

                }\n";

                $storevilla_colors .= ".woocommerce .shop_table input[type='submit']:hover{

                    color: $theme_color !important;

                }\n";

        /*border*/
            $storevilla_colors .= ".product-button-wrap a.button, 
            .product-button-wrap a.added_to_cart,
            .widget_storevilla_promo_pages_area .promo-area a:hover button, 
            .widget_storevilla_blog_widget_area .blog-preview a.blog-preview-btn:hover, 
            .widget_storevilla_blog_widget_area .large-blog-preview a.blog-preview-btn:hover,
            .widget_storevilla_cat_with_product_widget_area .block-title-desc a.view-bnt:hover,
            .widget_storevilla_contact_info_area ul li span:hover,
            .woocommerce nav.woocommerce-pagination ul, 
            .woocommerce nav.woocommerce-pagination ul li,
            .product-button-wrap a, 
            .woocommerce #respond input#submit,
            .woocommerce button.button, 
            .woocommerce input.button,
            .yith-woocompare-widget .compare.button,
            .yith-woocompare-widget a.clear-all:hover,
            .widget_tag_cloud .tagcloud a:hover, 
            .widget_product_tag_cloud .tagcloud a:hover,
            .woocommerce div.product .woocommerce-tabs .panel.entry-content.wc-tab,
            .woocommerce div.product form.cart div.quantity,
            .quantity button, .quantity .input-text.text,
            .woocommerce .woocommerce-info,
            .headertwo .header-wrap .cart-contentstwo .header-icon,
            .widget_storevilla_promo_pages_area .full-promo-area .full-text-wrap a button,
            .blog_stylethree .column span.time,
            .widget_storevilla_pro_prouct_list_widget_area .product-list-area ul.all-product-list li .text-wrapper .add-cart-list a:hover,
            .sv_call_to_action a.sv_call_to_action_button,
            .sv_call_to_action,
            .bttn,
            .sv-team .sv-member-message .social-shortcode a:hover,
            .sv-client-message .social-shortcode a:hover,
            .sv_toggle_title,
            .sv_toggle_content,
            .horizontal .sv_tab_group .tab-title:before,
            .horizontal .sv_tab_content,
            .vertical .sv_tab_group .tab-title,
            .vertical .sv_tab_content,
            .headerthree .main-navigation ul ul,
            .headerthree .main-navigation ul ul ul,
            .widget_search form input[type=submit], 
            .widget_product_search form input[type=submit], 
            .no-results.not-found .search-form .search-submit,
            .widget_search form input[type=submit]:hover, 
            .widget_product_search form input[type=submit]:hover, 
            .no-results.not-found .search-form .search-submit:hover,
            .woocommerce .gridlist-toggle a:hover, 
            .woocommerce .gridlist-toggle a.active,
            .woocommerce .gridlist-toggle a,
            .woocommerce .woocommerce-message,
            .site-header-cart .woocommerce a.button.wc-forward,
            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            .widget-area .widget_storevilla_contact_info_area .contacts-info li span:hover,
            .comments-area .reply a,
            .comments-area .form-submit .submit,
            .woocommerce-MyAccount-navigation ul li a,
            .woocommerce-MyAccount-content,
            .woocommerce-error{

                border-color: $theme_color;

            }\n";

            $storevilla_colors .= ".item-img .new-label.new-top-left:before{

                border-color: transparent transparent transparent $theme_color;

            }\n";

            $storevilla_colors .= ".headerthree .top-header .top-header-regin a.cart-contents:before{

                border-color: $theme_color transparent transparent transparent;

            }\n";

            $storevilla_colors .= ".headerthree .main-navigation ul ul:before{

                border-color: transparent transparent $theme_color transparent;

            }\n";

            $storevilla_colors .= ".headerthree .main-navigation ul ul ul:before{

                border-color: transparent $theme_color transparent transparent;

            }\n"; 
            

        /* Secondary Themes Background Color */

            $storevilla_colors .= ".product-button-wrap a.villa-details,
            .item-img .new-label.new-top-right, 
            .woocommerce span.onsale,
            .top-header-regin ul li span.cart-count:hover,
            .headerthree .main-navigation .search-icon .svilla-search.active .overlay-search .close,
            .headerthree .main-navigation .search-icon .svilla-search.active .overlay-search .sv_search_form button[type=submit],
            .tab-styletwo .svpro-tab-content ul.tabs-product li .item-img a.added_to_cart:hover, 
            .tab-styletwo .svpro-tab-content ul.tabs-product li .item-img a.product_type_grouped:hover,
            .site-header-cart .woocommerce a.button.checkout{

                background-color: ".$theme_sec_color.";

            }\n";

            $storevilla_colors .= ".product-button-wrap a.villa-details,
            .site-header-cart .woocommerce a.button.checkout{

                border-color: ".$theme_sec_color.";

            }\n";

            $storevilla_colors .= ".item-img .new-label.new-top-right:before, 
            .woocommerce span.onsale:before{

                border-color: transparent transparent transparent ".$theme_sec_color.";

            }\n";


            $storevilla_colors .= ".woocommerce a.remove:hover,
            .widget_shopping_cart .cart_list.product_list_widget li.empty,
            .site-header-cart .woocommerce a.button.wc-forward.checkout:hover:before, 
            .site-header-cart .woocommerce a.button.wc-forward.checkout:hover{

                color: ".$theme_sec_color." !important;

            }\n";
        
        
        /*custom css*/
            $storevilla_pro_custom_css = wp_strip_all_tags ( get_theme_mod('storevilla_css_section') );
            if ( ! empty( $storevilla_pro_custom_css ) ) {
                $storevilla_colors .= $storevilla_pro_custom_css;
            }
            wp_add_inline_style( 'storevilla-style', $storevilla_colors );

    }
}
add_action( 'wp_enqueue_scripts', 'storevilla_pro_dynamic_css', 99 );