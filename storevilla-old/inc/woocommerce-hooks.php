<?php
################################################
## Start WooCommerce Function Area            ##
################################################

/**
 * Query WooCommerce activation
 * @since  1.0.0
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function is_woocommerce_activated() {
        return class_exists( 'woocommerce' ) ? true : false;
    }
}


/**
 * Header Type to Shopping Cart function 
**/
if ( is_woocommerce_activated() ) {
    
    /**
     *  Cart function area for header one
    */
    if ( ! function_exists( 'storevilla_pro_shopping_cart_header_one' ) ) {
       function storevilla_pro_shopping_cart_header_one(){ ?>
            <a class="cart-contentsone" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'storevilla-pro' ); ?>">
               <div class="count">
                   <i class="fa  fa-shopping-basket"></i>
                   <span class="cart-count"><?php echo wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) ); ?></span>
               </div>                                      
           </a>
       <?php
       }
    }

    if ( ! function_exists( 'storevilla_pro_cart_header_one_link_fragment' ) ) {

        function storevilla_pro_cart_header_one_link_fragment( $fragments ) {
            global $woocommerce;
            ob_start();
            storevilla_pro_shopping_cart_header_one();
            $fragments['a.cart-contentsone'] = ob_get_clean();
            return $fragments;
        }
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'storevilla_pro_cart_header_one_link_fragment' );

    /**
     *  Cart function area for header Two
    */
    if ( ! function_exists( 'storevilla_pro_shopping_cart_header_two' ) ) {
       function storevilla_pro_shopping_cart_header_two(){ ?>
           <a class="cart-contentstwo" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
               <div class="header-icon">
                   <i class="fa fa-shopping-bag"></i>
               </div>
               <div class="text-holder">
                   <span class="name-text"><?php _e('Shopping Cart','storevilla-pro'); ?></span>
                   <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storevilla-pro' ), WC()->cart->get_cart_contents_count() ) );?></span>
               </div>
           </a>
       <?php
       }
    }

    if ( ! function_exists( 'storevilla_pro_cart_header_two_link_fragment' ) ) {

        function storevilla_pro_cart_header_two_link_fragment( $fragments ) {
            global $woocommerce;
            ob_start();
            storevilla_pro_shopping_cart_header_two();
            $fragments['a.cart-contentstwo'] = ob_get_clean();
            return $fragments;
        }
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'storevilla_pro_cart_header_two_link_fragment' );


    /**
     *  Cart function area for header three
    */
    if ( ! function_exists( 'storevilla_pro_shopping_cart_header_three' ) ) {
       function storevilla_pro_shopping_cart_header_three(){ ?>
            <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'storevilla-pro' ); ?>">
               <div class="count">
                   <i class="fa  fa-shopping-basket"></i>
                   <span class="cart-count"><?php echo wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) ); ?></span>
                   <span><?php _e('My Cart','storevilla-pro'); ?></span>
               </div>                                      
           </a>
       <?php
       }
    }

    if ( ! function_exists( 'storevilla_pro_cart_header_three_link_fragment' ) ) {

        function storevilla_pro_cart_header_three_link_fragment( $fragments ) {
            global $woocommerce;
            ob_start();
            storevilla_pro_shopping_cart_header_three();
            $fragments['a.cart-contents'] = ob_get_clean();
            return $fragments;
        }
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'storevilla_pro_cart_header_three_link_fragment' );
    



}

/**
 * Storevilla Woocommerce Query
*/
if ( is_woocommerce_activated() ) {
    
    function storevilla_woocommerce_query($product_type, $product_category, $product_number){
    
        $product_args       =   '';
        
        global $product_label_custom;
    
        if($product_type == 'category'){
            $product_args = array(
                'post_type' => 'product',
                'tax_query' => array(
                    array('taxonomy'  => 'product_cat',
                     'field'     => 'id', 
                     'terms'     => $product_category                                                                 
                    )
                ),
                'posts_per_page' => $product_number
            );
        }
        
        elseif($product_type == 'latest_product'){
            $product_label_custom = __('New', 'storevilla-pro');
            $product_args = array(
                'post_type' => 'product',
                'posts_per_page' => $product_number
            );
        }
        
        elseif($product_type == 'feature_product'){

            $product_args = array(
                'post_type'        => 'product',   
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'  => 'date',
                'order'    => 'desc',
                'posts_per_page'   => $product_number,
                'tax_query'  => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN',
                    )
                )
            );
        }
    
        elseif($product_type == 'upsell_product'){
            $product_args = array(
                'post_type'         => 'product',
                'posts_per_page'    => 10,
                'meta_key'          => 'total_sales',
                'orderby'           => 'meta_value_num',
                'posts_per_page'    => $product_number
            );
        }
    
        elseif($product_type == 'on_sale'){
            $product_args = array(
            'post_type'      => 'product',
            'posts_per_page'    => $product_number,
            'meta_query'     => array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ));
        }
        
        return $product_args;
    }

    function storevilla_pro_product_list_woocommerce_query($product_type, $product_category, $product_number){
    
        $product_args       =   '';
        
        global $product_label_custom;
    
        if($product_type == 'category'){
            $product_args = array(
                'post_type' => 'product',
                'tax_query' => array(
                    array('taxonomy'  => 'product_cat',
                     'field'     => 'id', 
                     'terms'     => $product_category                                                                 
                    )
                ),
                'posts_per_page' => $product_number
            );
        }
        
        elseif($product_type == 'latest_product'){
            $product_label_custom = __('New', 'storevilla-pro');
            $product_args = array(
                'post_type' => 'product',                
                'posts_per_page' => $product_number
            );
        }
        
        elseif($product_type == 'feature_product'){
            $product_args = array(
                'post_type'        => 'product',  
                'tax_query'  => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN',
                    )
                ),
                'posts_per_page'   => $product_number   
            );
        }
    
        elseif($product_type == 'upsell_product'){
            $product_args = array(
                'post_type'         => 'product',
                'posts_per_page'    => 10,
                'meta_key'          => 'total_sales',
                'orderby'           => 'meta_value_num',
                'posts_per_page'    => $product_number
            );
        }
    
        elseif($product_type == 'on_sale'){
            $product_args = array(
            'post_type'      => 'product',
            'posts_per_page'    => $product_number,
            'meta_query'     => array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ));
        }
        
        return $product_args;
    }
}


/**
 * Advance WooCommerce Product Search With Category
**/
if(!function_exists ('storevilla_product_search')){
    
    function storevilla_product_search(){
        
        if ( is_woocommerce_activated() ) {
            
            $args = array(
                'number'     => '',
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => true
            );
            $product_categories = get_terms( 'product_cat', $args ); 
            $categories_show = '<option value="">'.__('All Categories','storevilla-pro').'</option>';
            $check = '';
            if(is_search()){
                if(isset($_GET['term']) && $_GET['term']!=''){
                    $check = $_GET['term']; 
                }
            }
            $checked = '';
            $allcat = __('All Categories','storevilla-pro');
            $categories_show .= '<optgroup class="sv-advance-search" label="'.$allcat.'">';
            foreach($product_categories as $category){
                if(isset($category->slug)){
                    if(trim($category->slug) == trim($check)){
                        $checked = 'selected="selected"';
                    }
                    $categories_show  .= '<option '.$checked.' value="'.$category->slug.'">'.$category->name.'</option>';
                    $checked = '';
                }
            }
            $categories_show .= '</optgroup>';
            $form = '<form role="search" method="get" id="searchform"  action="' . esc_url( home_url( '/'  ) ) . '">
                         <div class="sv_search_wrap">
                            <select class="sv_search_product false" name="term">'.$categories_show.'</select>
                         </div>
                         <div class="sv_search_form">
                             <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' .__('search entire store here','storevilla-pro'). '" />
                             <button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
                             <input type="hidden" name="post_type" value="product" />
                             <input type="hidden" name="taxonomy" value="product_cat" />
                         </div>
                    </form>';           
            return $form;
        }        
    }
}

################################################
## End WooCommerce Function Area              ##
################################################



/**
 * WooCommerce Action and filter ADD and REMOVE Section 
**/


function storevilla_pro_woocommerce_breadcrumb(){
  do_action( 'breadcrumb-woocommerce' );
}
add_action( 'woocommerce_before_main_content','storevilla_pro_woocommerce_breadcrumb', 9 );

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
function storevilla_pro_woocommerce_template_loop_product_thumbnail(){ ?>
    <div class="item-img">          
        
        <?php global $post, $product; if ( $product->is_on_sale() ) : 
            echo apply_filters( 'woocommerce_sale_flash', '<div class="new-label new-top-right">' . __( 'Sale!', 'storevilla-pro' ) . '</div>', $post, $product ); ?>
        <?php endif; ?>
        <?php
            global $product_label_custom;
            if ($product_label_custom != ''){
                echo '<div class="new-label new-top-left">'.$product_label_custom.'</div>';
            }
        ?>
        <a class="product-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <?php echo woocommerce_get_product_thumbnail(); ?>
        </a>
        <?php woocommerce_template_loop_add_to_cart(); ?>
            <div class="box-hover">
              <ul class="add-to-links">
                <li><?php if(function_exists( 'storevilla_pro_quickview' )) { storevilla_pro_quickview(); } ?></li>
                <li><?php if(function_exists( 'storevilla_pro_wishlist_products' )) { storevilla_pro_wishlist_products(); } ?></li>
                <!-- <li><?php //if(function_exists( 'add_compare_link' )) { add_compare_link(); } ?></li> -->
              </ul>
            </div>      
    </div>
<?php 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'storevilla_pro_woocommerce_template_loop_product_thumbnail', 10 );


/** 
 * Product Block Title Area 
*/
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
function storevilla_pro_woocommerce_template_loop_product_title(){
    global $product;
    if( is_home() || is_front_page() ) {    
        $term = wp_get_post_terms(get_the_ID(),'product_cat',array('fields'=>'ids'));
        if(!empty( $term[0] )) {
            $procut_cat = get_term_by( 'id', $term[0], 'product_cat' );
            $category_link = get_term_link( $term[0],'product_cat' ); 
        } 
    }
 ?>
    <div class="block-item-title">
        <?php  if(!empty( $term[0] )) { ?>
            <span>
                <a href="<?php esc_url( $category_link ); ?>">
                    <?php  echo esc_attr( $procut_cat->name ); ?>
                </a>
            </span>
        <?php } ?>
        <h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </div>
<?php }
add_action( 'woocommerce_shop_loop_item_title', 'storevilla_pro_woocommerce_template_loop_product_title', 10 );


/* Product Add to Cart and View Details */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
function storevilla_pro_woocommerce_template_loop_add_to_cart(){ ?>
    <div class="product-button-wrap clearfix">
        
        <?php woocommerce_template_loop_add_to_cart(); ?>
        
        <a class="villa-details" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <?php _e('View Details','storevilla-pro'); ?>
        </a>
        
    </div>
<?php 
}
add_action( 'woocommerce_after_shop_loop_item_title' ,'storevilla_pro_woocommerce_template_loop_add_to_cart', 11 );


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
function storevilla_pro_woocommerce_template_loop_price(){ ?>
    <div class="product-price-wrap">
        <?php woocommerce_template_loop_price(); ?>        
    </div>
<?php
}
add_action( 'woocommerce_after_shop_loop_item_title' ,'storevilla_pro_woocommerce_template_loop_price', 12 );

function storevilla_pro_woocommerce_template_loop_quick_info(){ ?>
    <ul class="add-to-links">
        <li><?php if(function_exists( 'storevilla_pro_quickview' )) { storevilla_pro_quickview(); } ?></li>       
        <li><?php if(function_exists( 'storevilla_pro_wishlist_products' )) { storevilla_pro_wishlist_products(); } ?></li>
    </ul>
<?php
}
add_action( 'woocommerce_after_shop_loop_item' ,'storevilla_pro_woocommerce_template_loop_quick_info', 11 );


/**
 * Woo Commerce Number of row filter Function
**/
add_filter('loop_shop_columns', 'storevilla_loop_columns');
if (!function_exists('storevilla_loop_columns')) {
    function storevilla_loop_columns() {
        if(get_theme_mod('storevilla_woocommerce_product_row','3')){
            $xr = get_theme_mod('storevilla_woocommerce_product_row','3');
        } else {
            $xr = 3;
        }
        return $xr;
    }
}

add_action( 'body_class', 'storevilla_woo_body_class');
if (!function_exists('storevilla_woo_body_class')) {
    function storevilla_woo_body_class( $class ) {
           $class[] = 'columns-'.storevilla_loop_columns();
           return $class;
    }
}

/**
 * Woo Commerce Number of Columns filter Function
**/
$column = get_theme_mod('storevilla_woocommerce_display_product_number','12');
add_filter( 'loop_shop_per_page','storevilla_loop_shop_per_page', 20 );

function storevilla_loop_shop_per_page($cols){

    return 12;
}


/**
 * Woo Commerce Add Content Primary Div Function
**/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('storevilla_pro_woocommerce_output_content_wrapper')) {
    function storevilla_pro_woocommerce_output_content_wrapper(){ ?>
        <div class="store-container clearfix">
            <div class="store-container-inner clearfix">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
    <?php   }
}
add_action( 'woocommerce_before_main_content', 'storevilla_pro_woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
if (!function_exists('storevilla_pro_woocommerce_output_content_wrapper_end')) {
    function storevilla_pro_woocommerce_output_content_wrapper_end(){ ?>
                    </main><!-- #main -->
                </div><!-- #primary -->
                <?php  get_sidebar('woocommerce'); ?>
            </div>
        </div>
    <?php   }
}
add_action( 'woocommerce_after_main_content', 'storevilla_pro_woocommerce_output_content_wrapper_end', 10 );


/**
 * Remove WooCommerce Default Sidebar
**/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
function storevilla_pro_woocommerce_get_sidebar(){
    get_sidebar('woocommerce');
}
//add_action( 'woocommerce_sidebar', 'storevilla_pro_woocommerce_get_sidebar', 10);


/**
 * Change the Breadcrumb Arrow Function
**/
add_filter( 'woocommerce_breadcrumb_defaults', 'storevilla_pro_change_breadcrumb_delimiter' );
function storevilla_pro_change_breadcrumb_delimiter( $defaults ) {
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}

/**
 * Woo Commerce Social Share
**/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 55 );
function storevilla_pro_woocommerce_template_single_sharing() { ?>
        <div class="storevilla-social">
            <?php
            if ( ! function_exists( 'is_plugin_active' ) )
                require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
                if ( is_plugin_active( 'accesspress-social-share/accesspress-social-share.php' ) ) {
                    echo do_shortcode("[apss-share share_text='Share this']");
                }
            ?>
        </div>

<?php }
add_action( 'woocommerce_single_product_summary', 'storevilla_pro_woocommerce_template_single_sharing', 50 );

/**
 * Woo Commerce Related product
**/
//add_filter( 'woocommerce_output_related_products_args', 'storevilla_pro_related_products_args' );
function storevilla_pro_related_products_args( $args ) {
    $args['posts_per_page']     = 6;
    $args['columns']            = 3;
    return $args;
}

/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
if (!function_exists('storevilla_pro_related_product_title_text_strings')) {
    function storevilla_pro_related_product_title_text_strings( $translated_text, $text, $domain ) {
        switch ( $translated_text ) {
            case 'Related Products' :
                $translated_text = get_theme_mod( 'storevilla_woocommerce_product_page_related_title', 'RELATED PRODUCTS' );;
                break;
        }
        return $translated_text;
    }
}
add_filter( 'gettext', 'storevilla_pro_related_product_title_text_strings', 20, 3 );