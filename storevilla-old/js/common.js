jQuery(document).ready(function ($) {

 /*WoocommerceAdd to cart fixed*/

$('body').on( 'click', '.items-count', function(){
 $('.button[name="update_cart"]').prop('disabled', false);
});

   
    /**
     * Stick menu
    */
   $(".main-navigation").sticky({topSpacing:0});
    /**
     * StoreVilla Pro Cart Scrollbar
    */
    $(window).on("load",function(){
        $(".product_list_widget").mCustomScrollbar({
            axis:"y", // horizontal scrollbar
            theme:"dark"
        });
    });
   
    /**
     * StoreVilla Pro ShortCodes Js
    */
    $('.sv_accordian:first').children('.sv_accordian_content').show();
    $('.sv_accordian:first').children('.sv_accordian_title').addClass('active');
    $('.sv_accordian_title').click(function(){
        if($(this).hasClass('active')){
        }
        else{
          $(this).parent('.sv_accordian').siblings().find('.sv_accordian_content').slideUp();
          $(this).next('.sv_accordian_content').slideToggle();
          $(this).parent('.sv_accordian').siblings().find('.sv_accordian_title').removeClass('active')
          $(this).toggleClass('active')
        }
    });

    $('.sv_toggle_title').click(function(){
      $(this).next('.sv_toggle_content').slideToggle();
      $(this).toggleClass('active')
    });


    $('.sv_tab_wrap').prepend('<div class="sv_tab_group clearfix"></div>');

    $('.sv_tab_wrap').each(function(){
        $(this).children('.sv_tab').find('.tab-title').prependTo($(this).find('.sv_tab_group'));
        $(this).children('.sv_tab').wrapAll( "<div class='sv_tab_content clearfix' />");
    });

    $('#page').each(function(){
        $(this).find('.sv_tab:first-child').show();
        $(this).find('.tab-title:first-child').addClass('active')
    });

    $('.sv_tab_group .tab-title').click(function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $(this).parent('.sv_tab_group ').next('.sv_tab_content').find('.sv_tab').hide();
        var sv_id = $(this).attr('id');
        $(this).parent('.sv_tab_group ').next('.sv_tab_content').find('.'+sv_id).show();
    });
    

    /* Wishlist count ajax update */
    jQuery( document ).ready( function($){
        jQuery('.svilla-search .close').appendTo('.overlay-search');
        $('body').on( 'added_to_wishlist', function(){
            $('.top-wishlist .count').load( yith_wcwl_plugin_ajax_web_url + ' .top-wishlist span', {action: 'yith_wcwl_update_single_product_list'} );
        });
    });

    /* Add Class Search icon in header layout three */

    $(".search-icon .fa-search").click(function () {
       $('.svilla-search').addClass("active");
    });

    // Remove class
    $(".close").click(function () {
       $('.svilla-search').removeClass("active");
    });

    /* Tabs Category Product Script */
    $('.svpro-tabs .svpro-tab-links a').on('click', function(e)  {
        e.preventDefault();
        $dis = $(this);
        var currentAttrValue = $(this).attr('href');

        $(this).parent('li').addClass('active').siblings().removeClass('active');

        //$(this).parents('.svpro-tabs').siblings('.sp-tabs-product-wrap .store-container').find('.svpro-tab-content').hide();
        //$(this).parents('.svpro-tabs').siblings('.sp-tabs-product-wrap .svpro-tab-content').find('.tabs-content-wrap').hide();

        if($(this).parents('.svpro-tabs').siblings('.svpro-tab-content').find('.'+currentAttrValue).length > 0){
            $(this).parents('.svpro-tabs').siblings('.svpro-tab-content').find('.tabs-product-area').hide();
            $(this).parents('.svpro-tabs').siblings('.svpro-tab-content').find('.'+currentAttrValue).show();

        }else{
            var product_num = $(this).parents('ul').attr('data-id');
            //$dis.parents('.svpro-tabs').siblings('.sp-tabs-product-wrap .svpro-tab-content').find('.tabs-content-wrap').hide();
            $dis.parents('.svpro-tabs').siblings('.svpro-tab-content').find('.sv-preloader').show();
            $.ajax({
                url : storevilla_pro_ajax_script.ajaxurl,
                
                data:{
                        action : 'storevilla_tabs_ajax_action',
                        category_slug:currentAttrValue,
                        product_num  : product_num
                    },
                type:'post',
                 success: function(res){                                        
                        $dis.parents('.svpro-tabs').siblings('.svpro-tab-content').append(res);
                        storevilla_cat_tabs('.'+currentAttrValue);
                        $dis.parents('.svpro-tabs').siblings('.svpro-tab-content').find('.tabs-product-area').hide();
                        $dis.parents('.svpro-tabs').siblings('.svpro-tab-content').find('.'+currentAttrValue).show();
                        $('.sv-preloader').hide();
                    }
            });
        }

    }); 
    
    /* Tabs Category Products */
    function storevilla_cat_tabs($slider_class){
       
        $($slider_class).each(function(){
        
        var slideCount = 4;
        if($(this).parents().hasClass('homepage-main-widget')){
            slideCount = 3;
        }

            var Id = $(this).attr('data-slug');
            var NewId = Id;
            var target = '.'+Id+' .tabs-product';

            NewId = $(target).lightSlider({
                item:slideCount,
                pager:false,
                loop:true,
                speed:600,
                controls:true,
                onSliderLoad: function() {
                    $(target).removeClass('cS-hidden');
                },
                prevHtml: '<i class="fa fa-angle-left"></i>',
                nextHtml : '<i class="fa fa-angle-right"></i>',
                responsive : [
                    {
                        breakpoint:800,
                        settings: {
                            item:2,
                            slideMove:1,
                            slideMargin:6,
                          }
                    },
                    {
                        breakpoint:480,
                        settings: {
                            item:1,
                            slideMove:1,
                          }
                    }
                ]
            });

        });
    }
    
    $('.widget_storevilla_cat_tabs_products_area').each(function(){
        var first_active_tab_content = $(this).find('.svpro-tab-content .tabs-product-area:first').attr('data-slug');
        if(first_active_tab_content){
        storevilla_cat_tabs('.' + first_active_tab_content);
        }
    });
    
    /* Vertical Tabs Category Product Script */

    $('.vertical-tab-links li').first('li').addClass('active');

    $('.vertical-tabs .vertical-tab-links a').on('click', function(e)  {               
        var verticalcurrentAttrValue = $(this).attr('href');
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        $dis = $(this);  
        $(this).parents('.vertical-tabs').siblings('.vertical-tabs-wrap .svpor-vertical-wrap').find('.svpro-vertical-tabs').hide();
        e.preventDefault();            
            // Ajax Function
            $(this).parents('.vertical-tabs').siblings('.svpor-vertical-wrap').find('.sv-preloader').show();
            //$('.sv-preloader').show();
            $.ajax({
                url : storevilla_pro_ajax_script.ajaxurl,                
                data:{
                        action : 'storevilla_vertical_tabs_ajax_action',
                        category_slug:verticalcurrentAttrValue
                    },
                type:'post',
                 success: function(res){
                        $dis.parents('.vertical-tabs').siblings('.vertical-tabs-wrap .svpor-vertical-wrap').find('.svpro-vertical-tabs').show();                                      
                        $('.svpro-vertical-tabs').html(res);
                        $('.sv-preloader').hide();
                    }
            });
    });

    /* Browse Category Menu in header layout two Toggle */   
    $(".browse-category-wrap").click(function () {
       //$(this).toggleClass("on");
       $(".categorylist").slideToggle();
    });

   /* Main Menu Responsive Toggle */   
    $(".menu-toggle").click(function () {
       $(this).toggleClass("on");
       $("#primary-menu").slideToggle();
    });

    /* Main Menu Responsive Toggle */   
    $(".topmenutoggle").click(function () {
        $(this).toggleClass("on");
        $(".top-navigation").slideToggle();
    });

    /**
     * Mobile menu
    */
    jQuery('ul#primary-menu').superfish({
        delay:       1000,                            // one second delay on mouseout
        animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
        speed:       'fast',                          // faster animation speed
        autoArrows:  false                            // disable generation of arrow mark-up
    });

    jQuery('.top-navigation > .menu').superfish({
        delay:       1000,                            // one second delay on mouseout
        animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
        speed:       'fast',                          // faster animation speed
        autoArrows:  false                            // disable generation of arrow mark-up
    });

    /* Top Header Offter Ticker */ 
    $(".offter-ticker").lightSlider({
        loop:true,
        vertical: true,
        pager:false,
        auto:true,
        speed: 600,
        pause: 3000,
        enableDrag:false,
        verticalHeight:25,
        item:1,
        onSliderLoad: function() {
            $('.offter-ticker').removeClass('cS-hidden');
        }
    });

   /* Preloader */
    $(".storevilla-preloader").fadeOut("slow");   


   /* Mani Banner Slider */
    $('.store-gallery').lightSlider({
        adaptiveHeight:false,
        item:1,
        slideMargin:0,
        loop:true,
        pager:true,
        auto:true,
        speed: 1500,
        pause: 4200,
        onSliderLoad: function() {
            $('#store-gallery').removeClass('cS-hidden');
        }
    });
    
    /* Testimonial Slider */
    $('.testimonial-area').lightSlider({
        adaptiveHeight:true,
        item:1,
        slideMargin:0,
        loop:true,
        pager:false,
        auto:true,
        controls:true,
        speed: 1500,
        pause: 6000,        
        onSliderLoad: function() {
            $('.testimonial-area').removeClass('cS-hidden');
        }
    });
    
    /* Brands Logo Slider */
    $('.brands-logo').lightSlider({
        adaptiveHeight:false,
        item:5,
        slideMargin:0,
        loop:true,
        pager:false,
        auto:true,
        speed: 3500,
        pause: 4200,
        controls:false,
        onSliderLoad: function() {
            $('.brands-logo').removeClass('cS-hidden');
        },
        responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:3,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:2,
                        slideMove:1,
                      }
                }
            ]
    });
    

    /* For HomePage Main Section with Sidebar and blog layout two*/
    $('.widget_storevilla_blog_widget_area').each(function(){
        var slideCount = 3;
        if($(this).parent().hasClass('homepage-main-widget')){
            slideCount = 3;
        }
        var Id = $(this).attr('id');
        var NewId = Id;

        var target = '#'+Id+" .blog-slide";

        var NewId = $(target).lightSlider({
            item:slideCount,
            pager:false,
            loop:true,
            speed:600,
            slideMargin:0,
            enableDrag:true,
            onSliderLoad: function() {
                $(target).removeClass('cS-hidden');
            },
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:2,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:580,
                    settings: {
                        item:1,
                        slideMove:1,
                      }
                }
            ]
        });

    });

    
    /* For HomePage Main Section with Sidebar and Team Member too*/
    $('.widget_storevilla_team_widget_area').each(function(){
        var slideCount = 4;
        if($(this).parent().hasClass('homepage-main-widget')){
            slideCount = 3;
        }
        var Id = $(this).attr('id');
        var NewId = Id;

        var target = '#'+Id+" .team-area";

        var NewId = $(target).lightSlider({
            item:slideCount,
            pager:false,
            loop:true,
            speed:600,
            slideMargin:0,
            enableDrag:true,
            onSliderLoad: function() {
                $(target).removeClass('cS-hidden');
            },
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:2,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:1,
                        slideMove:1,
                      }
                }
            ]
        });

    });   

    

    /* For HomePage Main Section with Sidebar and blog layout two*/
    $('.widget_storevilla_blog_widget_area').each(function(){
        var slideCount = 3;
        if($(this).parent().hasClass('homepage-main-widget')){
            slideCount = 3;
        }
        var Id = $(this).attr('id');
        var NewId = Id;

        var target = '#'+Id+" .blog-slide-three";

        var NewId = $(target).lightSlider({
            item:slideCount,
            pager:false,
            loop:true,
            speed:600,
            slideMargin:0,
            enableDrag:true,
            onSliderLoad: function() {
                $(target).removeClass('cS-hidden');
            },
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:2,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:1,
                        slideMove:1,
                      }
                }
            ]
        });

    });
    
    /* For HomePage Main Section with Sidebar and Only Category */
    $('.widget_storevilla_cat_widget_area').each(function(){
       
        var slideCount = 4;
        if($(this).parent().hasClass('homepage-main-widget')){
            slideCount = 3;
        }

        var Id = $(this).attr('id');
        var NewId = Id; 
        var target = '#'+Id+" .category-slider";

        NewId = $(target).lightSlider({
            item:slideCount,
            pager:false,
            loop: true,
            speed:600,
            controls:false,
            onSliderLoad: function() {
                $(target).removeClass('cS-hidden');
            },
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:2,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:1,
                        slideMove:1,
                      }
                }
            ]
        });

        $('#'+Id+' .villa-lSPrev').click(function(){
            NewId.goToPrevSlide(); 
        });
        $('#'+Id+' .villa-lSNext').click(function(){
            NewId.goToNextSlide(); 
        });

    }); 

    /* For HomePage Main Section with Sidebar and Only Latest Product */
    $('.widget_storevilla_latest_product_cat_widget_area').each(function(){
       
        var slideCount = 4;
        if($(this).parent().hasClass('homepage-main-widget')){
            slideCount = 3;
        }

        var Id = $(this).attr('id');
        var NewId = Id;

        var target = '#'+Id+" .latest-product-slider";


        var NewId = $(target).lightSlider({
            item:slideCount,
            pager:false,
            loop:true,
            speed:600,
            controls:false,
            enableDrag:false,
            onSliderLoad: function() {
                $(target).removeClass('cS-hidden');
            },
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:2,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:1,
                        slideMove:1,
                      }
                }
            ]
        });

        $('#'+Id+' .villa-lSPrev').click(function(){
            NewId.goToPrevSlide(); 
        });
        $('#'+Id+' .villa-lSNext').click(function(){
            NewId.goToNextSlide(); 
        });

    });


    /* For HomePage Main Section with Sidebar and Only Product Latest,Features,On Salse, Up Salse Product */
    $('.widget_storevilla_product_widget_area').each(function(){
        
        var slideCount = 4;
        if($(this).parent().hasClass('homepage-main-widget')){
            slideCount = 3;
        }

        var Id = $(this).attr('id');
        var NewId = Id;

        var target = '#'+Id+" .store-product";

        var NewId = $(target).lightSlider({
            item:slideCount,
            pager:false,
            loop:true,
            speed:600,
            controls:false,
            enableDrag:false,
            onSliderLoad: function() {
                $(target).removeClass('cS-hidden');
            },
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:2,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:1,
                        slideMove:1,
                      }
                }
            ]
        });

        $('#'+Id+' .villa-lSPrev').click(function(){
            NewId.goToPrevSlide(); 
        });
        $('#'+Id+' .villa-lSNext').click(function(){
            NewId.goToNextSlide(); 
        });

    });


    /* For HomePage Main Section with Sidebar and Category features image with related category product */
    $('.widget_storevilla_cat_with_product_widget_area').each(function(){
        var slideCount = 3;
        if($(this).parent().hasClass('homepage-main-widget')){
            slideCount = 2;
        }

        var Id = $(this).attr('id');
        var NewId = Id;

        var target = '#'+Id+" .cat-with-product";

        var NewId = $(target).lightSlider({
            item:slideCount,
            pager:false,
            loop:true,
            speed:600,
            enableDrag:false,
            onSliderLoad: function() {
                $(target).removeClass('cS-hidden');
            },
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:2,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:1,
                        slideMove:1,
                      }
                }
            ]
        });

    });
       
    
     /* Product Single Page Thumbinal Images */
    
    $(".storevilla-thumbnails").lightSlider({
        item:3,
        loop:true,
        pager:false,
        speed:600,
    });
    
    
    // ScrollUp
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > 1000) {
			jQuery('.scrollup').fadeIn();
		} else {
			jQuery('.scrollup').fadeOut();
		}
	});

	jQuery('.scrollup').click(function() {
		jQuery("html, body").animate({
			scrollTop: 0
		}, 2000);
		return false;
	});
    
    jQuery('.store-promo-wrap').each(function(){
        var dis = $(this);
        $(window).resize(function(){
          var imageDataHeight = dis.height();
          var imageDataWidth = dis.width();
            imageProportions = 240/374;
            imageProportionsHeight = parseInt(imageDataWidth*imageProportions, 10);
            dis.find('.sv-promo-area').height(imageProportionsHeight);         
        }).resize();

    });
    
});
