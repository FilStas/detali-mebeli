<?php

if ( is_woocommerce_activated() ) {

    // StoreVill Pro New Section 

    /**
     ** Adds storevilla_cat_tabs_products widget.
    **/
    add_action('widgets_init', 'storevilla_cat_tabs_products');
    function storevilla_cat_tabs_products() {
        register_widget('storevilla_cat_tabs_products_area');
    }
    
    class storevilla_cat_tabs_products_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_cat_tabs_products_area', 'SV: Woo Category Tabs Products', array(
                'description' => __('A widget that shows WooCommerce category in tabs format', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {
    
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
    
    
            $fields = array( 
                
                'storevilla_select_category' => array(
                    'storevilla_widgets_name' => 'storevilla_select_category',
                    'storevilla_mulicheckbox_title' => __('Select Category Tabs', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'multicheckboxes',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),

                'storevilla_pro_number_products' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_number_products',
                    'storevilla_widgets_title' => __('Enter the Number Products Display', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                ),

                'storevilla_pro_tabs_style' => array(
                'storevilla_widgets_name' => 'storevilla_pro_tabs_style',
                'storevilla_widgets_title' => __('Select Tabs Layout Style', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'select',
                'storevilla_widgets_field_options' => array(
                        'tab-styleone' => 'Style One', 
                        'tab-styletwo' => 'Style Two',
                        'tab-stylethree' => 'Style Three'
                    )
                ) 
                
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/  
            $storevilla_catid = $instance['storevilla_select_category'];
            if(!empty( $storevilla_catid )){
                $first_cat_id =  key( $storevilla_catid );
                $first_cat_slug = get_term_by( 'id', $first_cat_id , 'product_cat' );
                $first_cat_slug = $first_cat_slug->slug;
            }
            $sv_pronum = $instance['storevilla_pro_number_products'];
            $tabs_style = $instance['storevilla_pro_tabs_style'];
            $GLOBALS["storevilla_pro_tabs_style"] = $tabs_style;        
            echo $before_widget; 
        ?>

        
            <div class="sp-tabs-product-wrap <?php echo esc_attr( $tabs_style ); ?>">
                <div class="store-container">
                    
                    <div class="svpro-tabs">

                        <ul class="svpro-tab-links" data-id="<?php echo intval( $sv_pronum ); ?>">
                            <?php
                                if(!empty($storevilla_catid)){
                                    $count = 1;
                                    foreach ($storevilla_catid as $key => $storecat_id) {
                                        $term = get_term_by( 'id', $key, 'product_cat');
                                    if(!empty( $term )){
                                    ?>
                                        <li <?php if($count == 1){ ?>class="active"<?php } ?> >
                                            <a href="<?php echo esc_attr( $term->slug ); ?>">
                                                <?php echo esc_attr( $term->name ); ?>
                                            </a>
                                        </li>
                                    <?php } $count++; 
                                    }
                                }
                            ?>
                        </ul>

                    </div>

                    <div class="svpro-tab-content">

                        <div class="sv-preloader" style="display:none;">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/preloader/grid.gif">
                        </div>
                        
                        <div class="tabs-product-area <?php echo $first_cat_slug; ?>" data-slug="<?php echo $first_cat_slug; ?>">

                            <ul class="tabs-product cS-hidden">                            
                                <?php 
                                    $product_args = array(
                                        'post_type' => 'product',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'product_cat',
                                                'field'     => 'term_id', 
                                                'terms'     => $first_cat_id                                                                 
                                            )),
                                        'posts_per_page' => $sv_pronum
                                    );
                                    $query = new WP_Query($product_args);

                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                    <?php wc_get_template_part( 'content', 'product' ); ?>
                                    
                                <?php } } wp_reset_postdata(); ?>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>

        
            
    
        <?php echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }


    /**
     ** Adds storevilla_cat_vertical_tabs_products widget.
    **/
    add_action('widgets_init', 'storevilla_cat_vertical_tabs_products');
    function storevilla_cat_vertical_tabs_products() {
        register_widget('storevilla_cat_vertical_tabs_products_area');
    }
    
    class storevilla_cat_vertical_tabs_products_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_cat_vertical_tabs_products_area', 'SV: Woo Category Tabs Vertical', array(
                'description' => __('A widget that shows WooCommerce category products in vertical tabs format', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {
    
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
    
    
            $fields = array( 
                
                'storevilla_pro_vertical_tabs_title' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_vertical_tabs_title',
                    'storevilla_widgets_title' => __('Enter Vertical Tabs Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),

                'storevilla_select_vertical_category' => array(
                    'storevilla_widgets_name' => 'storevilla_select_vertical_category',
                    'storevilla_mulicheckbox_title' => __('Select Category Tabs', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'multicheckboxes',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),

                'storevilla_pro_vertical_tabs_promo' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_vertical_tabs_promo',
                    'storevilla_widgets_title' => __('Upload Vertical Tabs Promo Image', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'upload',
                ),
                
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/ 
            $title = $instance['storevilla_pro_vertical_tabs_title'];

            $storevilla_catid = $instance['storevilla_select_vertical_category'];
            if(!empty( $storevilla_catid )) {
                $first_cat_id =  key( $storevilla_catid );
            }        
            $vertical_tabs_promo = $instance['storevilla_pro_vertical_tabs_promo'];  

            echo $before_widget; 
        ?>

        
            <div class="store-container">
                <div class="vertical-tabs-wrap clearfix">
                    <div class="tab-wrapper clearfix">
                        <div class="vertical-tabs">
                            <div class="block-title">
                                <?php if( !empty( $title ) ) { ?><span><?php echo esc_attr( $title ); ?></span> <?php } ?>
                             </div>
                            <ul class="vertical-tab-links">
                                <?php
                                    if(!empty($storevilla_catid)){
                                        foreach ($storevilla_catid as $key => $storecat_id) {
                                            $term = get_term_by( 'id', $key, 'product_cat');
                                        ?>
                                            <li><a href="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_attr( $term->name ); ?></a></li>
                                        <?php
                                        }
                                    }
                                ?>
                            </ul>       
                        </div>
                        <div class="svpor-vertical-wrap">

                            <div class="sv-preloader" style="display:none;">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/preloader/grid.gif">
                            </div>

                            <div class="svpro-vertical-tabs">

                                <div class="tabs-product-area">

                                    <ul class="vertical-tabs-product">                            
                                        <?php 
                                            $product_args = array(
                                                'post_type' => 'product',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy'  => 'product_cat',
                                                        'field'     => 'term_id', 
                                                        'terms'     => $first_cat_id                                                                 
                                                    )),
                                                'posts_per_page' => 6
                                            );
                                            $query = new WP_Query($product_args);

                                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                        ?>
                                            <li <?php post_class(); ?>>
                                                <div class="item-img">
                                                    <a class="product-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                                        <?php woocommerce_template_loop_product_thumbnail(); ?>
                                                    </a>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><?php woocommerce_template_loop_add_to_cart(); ?></li>
                                                            <li><?php if(function_exists( 'storevilla_pro_quickview' )) { storevilla_pro_quickview(); } ?></li>
                                                            <li><?php if(function_exists( 'storevilla_pro_wishlist_products' )) { storevilla_pro_wishlist_products(); } ?></li>                                                    
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="block-item-title">
                                                    <h3>
                                                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h3>
                                                </div>
                                                <div class="product-price-wrap">
                                                    <?php woocommerce_template_loop_price(); ?>
                                                </div>
                                            </li>
                                           
                                        <?php } } wp_reset_postdata(); ?>
                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>    
                    <div class="vertical-promo">
                        <img src="<?php echo esc_url( $vertical_tabs_promo ); ?>" alt="">
                    </div>
                </div>
            </div>

        
            
    
        <?php echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }


    /**
     ** Adds storevilla_pro_prouct_list_widget widget.
    **/
    add_action('widgets_init', 'storevilla_pro_prouct_list_widget');
    function storevilla_pro_prouct_list_widget() {
        register_widget('storevilla_pro_prouct_list_widget_area');
    }
    
    class storevilla_pro_prouct_list_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_pro_prouct_list_widget_area', 'SV: Woo Products List', array(
                'description' => __('A widget that shows WooCommerce products.', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {            

            $prod_type = array(
                'category' => __('Category', 'storevilla-pro'),
                'latest_product' => __('Latest Product', 'storevilla-pro'),
                'upsell_product' => __('UpSell Product', 'storevilla-pro'),
                'feature_product' => __('Feature Product', 'storevilla-pro'),
                'on_sale' => __('On Sale Product', 'storevilla-pro'),
            );
            
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              $woocommerce_categories[''] = 'Select Product Category';
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
              
    
            $fields = array( 
                               
                'storevilla_pro_product_list_title' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_product_list_title',
                    'storevilla_widgets_title' => __('Product List Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_pro_product_list_type' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_product_list_type',
                    'storevilla_widgets_title' => __('Select Product Type', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $prod_type
                ),
                
                'storevilla_pro_product_list_category' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_product_list_category',
                    'storevilla_widgets_title' => __('Select Product Category', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),
                
                'storevilla_pro_product_list_number' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_product_list_number',
                    'storevilla_widgets_title' => __('Enter Number of Products List', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                ),

                /*'storevilla_pro_product_list_column' => array(
                'storevilla_widgets_name' => 'storevilla_pro_product_list_column',
                'storevilla_widgets_title' => __('Select Column Number', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'select',
                'storevilla_widgets_field_options' => array(
                        'svpro-columnone' => 'Column One', 
                        'svpro-columntwo' => 'Column Two',
                        'svpro-columnthree' => 'Column Three',
                        'svpro-columnfour' => 'Column Four'
                    )
                )  */                             
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/  
            $main_title = esc_attr( $instance['storevilla_pro_product_list_title'] );
            $product_type = esc_attr( $instance['storevilla_pro_product_list_type'] );
            $product_category = intval( $instance['storevilla_pro_product_list_category'] );
            $product_number = intval( $instance['storevilla_pro_product_list_number'] );
            //$column_number = esc_attr( $instance['storevilla_pro_product_list_column'] );

    
            $product_args = storevilla_pro_product_list_woocommerce_query($product_type, $product_category, $product_number);
            
            echo $before_widget; 
        ?>
        
            <div class="sp-productlist-wrap <?php //echo $column_number; ?>">
    
                    <div class="store-container">

                        <div id="product-list" class="product-list-area clearfix">
                            
                            <div class="block-title-wrap clearfix">
                            
                                <div class="block-title">
                                    <?php if( !empty( $main_title ) ) { ?><span><?php echo esc_attr( $main_title ); ?></span> <?php } ?>
                                </div>
  
                            </div>
                            
                            <ul class="all-product-list">
                                <?php                         
                                    $query = new WP_Query($product_args);
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                    <li <?php post_class(); ?>>
                                        <div class="item-img">
                                            <a class="product-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                                <?php woocommerce_template_loop_product_thumbnail(); ?>
                                            </a>
                                        </div>
                                        <div class="text-wrapper">
                                            <div class="block-item-title">
                                                <?php
                                                    global $product;
                                                    if( is_home() || is_front_page() ) {    
                                                        $term = wp_get_post_terms(get_the_ID(),'product_cat',array('fields'=>'ids'));
                                                        if(!empty( $term[0] )) {
                                                            $procut_cat = get_term_by( 'id', $term[0], 'product_cat' );
                                                            $category_link = get_term_link( $term[0],'product_cat' ); 
                                                        } 
                                                    }
                                                ?>
                                                <span>
                                                    <a href="<?php esc_url( $category_link ); ?>">
                                                        <?php  echo esc_attr( $procut_cat->name ); ?>
                                                    </a>
                                                </span>
                                                <h3>
                                                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="product-price-wrap">
                                                <?php woocommerce_template_loop_price(); ?>
                                            </div>
                                            <div class="add-cart-list">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                        </div>
                                    </li>
                                    
                                <?php } } wp_reset_postdata(); ?>                    
                            </ul>
                          
                        </div>
                    </div>
    
            </div><!-- End Product Slider --> 
    
        <?php         
            echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }


    /**
     ** Adds storevilla_pro_offer_deal_widget widget.
    **/
    add_action('widgets_init', 'storevilla_pro_offer_deal_widget');
    function storevilla_pro_offer_deal_widget() {
        register_widget('storevilla_pro_offer_deal_widget_area');
    }
    
    class storevilla_pro_offer_deal_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_pro_offer_deal_widget_area', 'SV: Woo Special Offer Deal', array(
                'description' => __('A widget that shows offter products.', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {            

            $params = array(
                'post_type'      => 'product',
                'posts_per_page' => 5,
                'meta_query'     => array(                        
                        array( // Simple products type
                            'key'           => '_sale_price_dates_to',
                            'value'         => 0,
                            'compare'       => '>',
                            'type'          => 'numeric'
                        )
                    )
             
            );
            $all_product = get_posts( $params );            
            $offter_deal = array();
            $offter_deal[''] = 'Select Special Offter Deal';
            foreach ($all_product as $key => $value) {
                $offter_deal[$value->ID] = $value->post_title;
            }

            $fields = array(
                
                'storevilla_pro_offer_deal_product' => array(
                    'storevilla_widgets_name' => 'storevilla_pro_offer_deal_product',
                    'storevilla_widgets_title' => __('Select Offer Product', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $offter_deal
                )                           
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/  
            $offer_deal       = esc_attr( $instance['storevilla_pro_offer_deal_product'] );   
            if( !empty( $offer_deal )){       
            $product_args = array(
                'post_type'      => 'product',
                'p' => $offer_deal        
            ); 
            
            echo $before_widget; 
        ?>
        
            <div class="sp-productlist-wrap clearfix">
    
                <div class="store-container">
                        
                    <div class="special-offter-deal">
                        <?php                         
                            $query = new WP_Query($product_args);
                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                            <div <?php post_class(); ?>>
                                
                                <div class="offer-product-wrap">
                                    
                                    <div class="item-img">
                                        <a class="product-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                            <?php woocommerce_template_loop_product_thumbnail(); ?>
                                        </a>
                                    </div>

                                      <?php 
                                          $product_id = get_the_ID();
                                          $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                          $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                          $date = date_create($sale_price_dates_to);
                                          $new_date = date_format($date,"Y/m/d H:i");
                                      if(!empty($sale_price_dates_to)) { if(!empty($price_sale)) {
                                      ?>
                                      <div class="fl-pcountdown-cnt">          
                                          <ul class="fl-style1 fl-medium fl-countdown fl-countdown-pub countdown_<?php echo $product_id; ?>">
                                              <li><div class="time-clock"><i class="fa fa fa-clock-o"></i></div></li>
                                              <li><span class="days">00</span><p class="days_text"><?php _e('Days','storevilla-pro'); ?></p></li>
                                              <li><span class="hours">00</span><p class="hours_text"><?php _e('Hours','storevilla-pro'); ?></p></li>
                                              <li><span class="minutes">00</span><p class="minutes_text"><?php _e('Mins','storevilla-pro'); ?></p></li>
                                              <li><span class="seconds">00</span><p class="seconds_text"><?php _e('Secs','storevilla-pro'); ?></p></li>
                                          </ul>
                                      </div>
                                      <script type="text/javascript">
                                          jQuery(document).ready(function($) {
                                            jQuery(".countdown_<?php echo $product_id; ?>").countdown({
                                                date: "<?php echo $new_date; ?>",
                                                offset: -8,
                                                day: "Day",
                                                days: "Days"
                                            }, function () {
                                            //  alert("Done!");
                                            });
                                          });
                                      </script>
                                    <?php } } ?>

                                </div>

                                <div class="offer-product-info-wrap">
                                    
                                    <div class="block-item-title">
                                        <?php
                                        //global $product;
                                        $term = wp_get_post_terms(get_the_ID(),'product_cat',array('fields'=>'ids'));
                                        if(!empty( $term[0] )) {
                                            $product_category = get_term_by( 'id', $term[0], 'product_cat' );
                                            $category_link = get_term_link( $term[0],'product_cat' ); 
                                        }

                                        if(!empty( $term[0] )) {
                                        ?>
                                        <span class="mini-title">
                                            <a href="<?php esc_url( $category_link ); ?>">
                                                <?php  echo esc_attr( $product_category->name ); ?>
                                            </a>
                                        </span>
                                        <?php } ?>

                                        <h3>
                                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>

                                    <div class="offer-deal">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="product-button-wrap clearfix">
            
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                        
                                        <a class="villa-details" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                            <?php _e('View Details','storevilla-pro'); ?>
                                        </a>
                                        
                                    </div>

                                    <div class="offer-wrap">
                                        <?php woocommerce_template_loop_price(); ?>        
                                    </div>

                                    <div class="offer-deal-links">
                                        <ul>
                                            <li><?php if(function_exists( 'storevilla_pro_quickview' )) { storevilla_pro_quickview(); } ?></li>       
                                            <li><?php if(function_exists( 'storevilla_pro_wishlist_products' )) { storevilla_pro_wishlist_products(); } ?></li>    
                                        </ul>
                                    </div>

                                </div>

                            </div>
                            
                        <?php } } wp_reset_postdata(); ?>                    
                    </div>
                
                </div>
            
            </div>
    
        <?php         
            echo $after_widget;
        }
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    } 


    // StoreVilla Pro Section End
    
    
    /**
     ** Adds storevilla_latest_product_cat_widget widget.
    **/
    add_action('widgets_init', 'storevilla_latest_product_cat_widget');
    function storevilla_latest_product_cat_widget() {
        register_widget('storevilla_latest_product_cat_widget_area');
    }
    
    class storevilla_latest_product_cat_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_latest_product_cat_widget_area', 'SV: Woo Latest Category Product', array(
                'description' => __('A widget that shows WooCommerce category latest product.', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {
            
    
            $prod_type = array(
                'category' => __('Category', 'storevilla-pro'),
                'latest_product' => __('Latest Product', 'storevilla-pro'),
                'feature_product' => __('Feature Product', 'storevilla-pro'),
            );
            
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              $woocommerce_categories[''] = 'Select Product Category';
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
              
    
            $fields = array( 
                
                'storevilla_top_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_top_product_title',
                    'storevilla_widgets_title' => __('Top Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_main_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_main_product_title',
                    'storevilla_widgets_title' => __('Product Main Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_product_type' => array(
                    'storevilla_widgets_name' => 'storevilla_product_type',
                    'storevilla_widgets_title' => __('Select Product Type', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $prod_type
                ),
                
                'storevilla_woo_category' => array(
                    'storevilla_widgets_name' => 'storevilla_woo_category',
                    'storevilla_widgets_title' => __('Select Product Category', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),
                
                'storevilla_product_number' => array(
                    'storevilla_widgets_name' => 'storevilla_product_number',
                    'storevilla_widgets_title' => __('Enter Number of Products Show', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                )

            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/  
            $top_title = esc_attr( $instance['storevilla_top_product_title'] );
            $main_title = esc_attr( $instance['storevilla_main_product_title'] );
            $product_type = esc_attr( $instance['storevilla_product_type'] );
            $product_category = intval( $instance['storevilla_woo_category'] );
            $product_number = intval( $instance['storevilla_product_number'] );            
    
            $product_args = storevilla_woocommerce_query($product_type, $product_category, $product_number);
            
            echo $before_widget; 
        ?>
        
            <div class="sp-producttype-wrap">
    
                    <div class="store-container">

                        <div id="product-slider" class="product-slide-area">
                            
                            <div class="block-title-wrap clearfix">
                            
                                <div class="block-title">
                                    <?php if( !empty( $top_title ) ) { ?><span><?php echo esc_attr( $top_title ); ?></span> <?php } ?>
                                    <?php if( !empty( $main_title ) ) { ?><h2><?php echo esc_attr( $main_title ); ?></h2> <?php } ?>
                                </div>


                                <div class="StoreVillaAction">
                                    <div class="villa-lSPrev"></div>
                                    <div class="villa-lSNext"></div>
                                </div>

                            </div>
                            
                            <ul class="latest-product-slider cS-hidden">
                                <?php                         
                                    $query = new WP_Query($product_args);
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                    <?php wc_get_template_part( 'content', 'product' ); ?>
                                    
                                <?php } } wp_reset_postdata(); ?>                    
                            </ul>
                          
                        </div>
                    </div>
    
            </div><!-- End Product Slider --> 
    
        <?php         
            echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }    
    
    
    /**
     ** Adds storevilla_cat_with_product_widget widget.
    **/
    add_action('widgets_init', 'storevilla_cat_with_product_widget');
    function storevilla_cat_with_product_widget() {
        register_widget('storevilla_cat_with_product_widget_area');
    }
    
    class storevilla_cat_with_product_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_cat_with_product_widget_area', 'SV: Woo Category With Product', array(
                'description' => __('A widget that shows woocommerce category feature image with selected category products', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {
            
              $prod_type = array(
                'right_align' => __('Right Align Category Image', 'storevilla-pro'),
                'left_align' => __('Left Align Category Image', 'storevilla-pro'),
              );
    
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              $woocommerce_categories[''] = 'Select Product Category';
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
    
            $fields = array( 
                
                'storevilla_cat_main_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_cat_main_product_title',
                    'storevilla_widgets_title' => __('Product Category Main Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_cat_image_aligment' => array(
                    'storevilla_widgets_name' => 'storevilla_cat_image_aligment',
                    'storevilla_widgets_title' => __('Select Display Style (Image Alignment)', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $prod_type
                ),
                
                'storevilla_woo_category' => array(
                    'storevilla_widgets_name' => 'storevilla_woo_category',
                    'storevilla_widgets_title' => __('Select Product Category', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),
                
                'storevilla_cat_product_number' => array(
                    'storevilla_widgets_name' => 'storevilla_cat_product_number',
                    'storevilla_widgets_title' => __('Enter Number of Products Show', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                ),

                'storevilla_cat_product_info' => array(
                    'storevilla_widgets_name' => 'storevilla_cat_product_info',
                    'storevilla_widgets_title' => __('Checked to Display Category Info', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'checkbox',
                )                               
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            /**
            ** wp query for first block
            **/
            $main_title = esc_attr( $instance['storevilla_cat_main_product_title'] ); 
            $cat_aligment = esc_attr( $instance['storevilla_cat_image_aligment'] );
            $product_category = intval( $instance['storevilla_woo_category'] );
            $product_number = intval( $instance['storevilla_cat_product_number'] );
            $cat_product_info = intval( $instance['storevilla_cat_product_info'] );
    
            if(!empty( $product_category )){
              $cat_id = get_term($product_category,'product_cat');
              if ( ! empty( $cat_id ) && ! is_wp_error( $cat_id ) ){
                  $category_id = $cat_id->term_id;
                  $category_link = get_term_link( $category_id, 'product_cat' );
              }
            }
            else{
              $category_link = get_permalink( wc_get_page_id( 'shop' ) );
            } 
    
            echo $before_widget; 
        ?>
    
            <div class="categor-products">

                <div class="store-container">
                    
                    <div id="category-product-slider" class="product-cat-slide clearfix <?php echo $cat_aligment; ?>">
                        
                        <div class="home-block-inner">                                                
                            <?php 
                                $taxonomy = 'product_cat';                                
                                $terms = term_description( $product_category, $taxonomy );
                                $terms_name = get_term( $product_category, $taxonomy );
                            ?>
                                
                            <div class="block-title">
                                <?php if( !empty( $main_title ) ) { ?><span><?php echo esc_attr( $main_title ); ?></span> <?php } ?>
                                <h2><?php if(!empty( $terms_name )) { echo esc_attr( $terms_name->name); } ?></h2>
                            </div>

                            <div class="cat-block-wrap <?php if($cat_product_info == 1){ ?>catblockwrap<?php } ?>">
                                <?php 
                                    $thumbnail_id = get_term_meta($product_category, 'thumbnail_id', true);
                                    if (!empty($thumbnail_id)) {
                                      $image = wp_get_attachment_image_src($thumbnail_id, 'storevilla-cat-image');
                                      echo '<a href="' .esc_url($category_link). '" class="store-overlay" style="background-image:url('.esc_url($image[0]).');">
                                      </a>';
                                    } else{ 
                                        $no_image = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=275%C3%97370&w=275&h=370';
                                ?>
                                    <a href="<?php echo esc_url($category_link); ?>" class="store-overlay" style="background-image:url(<?php echo esc_url($no_image); ?>);">
                                    </a>
                                <?php } ?>                            
                                <?php if($cat_product_info == 1){ ?>   
                                    <div class="block-title-desc">
                                        <?php echo $terms; ?>
                                        <a href="<?php echo esc_url($category_link); ?>" class="view-bnt"><?php _e('View All','storevilla-pro'); ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                            
                        </div>
                        
                        <ul class="cat-with-product cS-hidden">
                            
                            <?php 
                                $product_args = array(
                                    'post_type' => 'product',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy'  => 'product_cat',
                                            'field'     => 'id', 
                                            'terms'     => $product_category                                                                 
                                        )),
                                    'posts_per_page' => $product_number
                                );
                                $query = new WP_Query($product_args);

                                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                                
                            <?php } } wp_reset_postdata(); ?>  
                            
                        </ul>
                        
                    </div>

                </div>
 
            </div><!-- End Bestsell Slider --> 
    
        <?php         
            echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }


    /**
     ** Adds storevilla_cat_widget widget.
    **/
    add_action('widgets_init', 'storevilla_cat_widget');
    function storevilla_cat_widget() {
        register_widget('storevilla_cat_widget_area');
    }
    
    class storevilla_cat_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_cat_widget_area', 'SV: Woo Category Section', array(
                'description' => __('A widget that shows WooCommerce category', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {
    
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
    
    
            $fields = array( 
                
                'storevilla_top_cat_bg_image' => array(
                    'storevilla_widgets_name' => 'storevilla_top_cat_bg_image',
                    'storevilla_widgets_title' => __('Category Full Background Image', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'upload',
                ),

              /*  'storevilla_top_cat_bg_color' => array(
                    'storevilla_widgets_name' => 'storevilla_top_cat_bg_color',
                    'storevilla_widgets_title' => __('Full Background Color', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'color',
                ),*/

                'storevilla_top_cat_title' => array(
                    'storevilla_widgets_name' => 'storevilla_top_cat_title',
                    'storevilla_widgets_title' => __('Category Top Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                'storevilla_main_cat_title' => array(
                    'storevilla_widgets_name' => 'storevilla_main_cat_title',
                    'storevilla_widgets_title' => __('Category Main Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_select_category' => array(
                    'storevilla_widgets_name' => 'storevilla_select_category',
                    'storevilla_mulicheckbox_title' => __('Select Category', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'multicheckboxes',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),
                
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/  
            $top_title = esc_attr( $instance['storevilla_top_cat_title'] ); 
            $main_title = esc_textarea( $instance['storevilla_main_cat_title'] );
            $store_villa_cat_id = $instance['storevilla_select_category'];
            $cat_bg_image = $instance['storevilla_top_cat_bg_image'];
            
            echo $before_widget; 
            $cat_bg_class = '';
            $bg_style = '';
            if(!empty( $cat_bg_image )) { 
                $bg_style = 'style="background-image:url('.esc_url( $cat_bg_image ) .'); background-size: cover;"';
                $cat_bg_class = 'no-bg-image';
            }
        ?>
            <div class="category-area <?php echo esc_attr( $cat_bg_class ); ?>" <?php echo $bg_style; ?>>
               
                <div class="store-container">
                   
                    <div class="block-title-wrap clearfix">
                        
                        <div class="block-title">
                            <?php if( !empty( $top_title ) ) { ?><span><?php echo esc_attr( $top_title ); ?></span> <?php } ?>
                            <?php if( !empty( $main_title ) ) { ?><h2><?php echo esc_attr( $main_title ); ?></h2> <?php } ?>
                        </div>

                        <div class="StoreVillaAction">
                            <div class="villa-lSPrev"></div>
                            <div class="villa-lSNext"></div>
                        </div>

                    </div>
                    
                    <ul class="category-slider cS-hidden">
                        <?php
                            $count = 0; 
                            if(!empty($store_villa_cat_id)){
                                
                                foreach ($store_villa_cat_id as $key => $store_cat_id) {          
                                    $thumbnail_id = get_term_meta( $key, 'thumbnail_id', true );
                                    $images = wp_get_attachment_url( $thumbnail_id );
                                    $image = wp_get_attachment_image_src($thumbnail_id, 'storevilla-cat-image', true);
                                    $term = get_term_by( 'id', $key, 'product_cat');
                                if ( $term && ! is_wp_error( $term ) ) {
                                    $term_link = get_term_link($term);
                                    $term_name = $term->name;
                                if ( $term->count > 0 ) 
                                    $sub_count =  apply_filters( 'woocommerce_subcategory_count_html', ' ' . $term->count . ' '.__('Products','storevilla-pro').'', $term);
                                }else{
                                    $term_link = '#';
                                    $term_name = __('Category','storevilla-pro');
                                    $sub_count = '0 '.__('Product','storevilla-pro');
                                }
                                
                            $no_img = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=275%C3%97370&w=275&h=370';
                        ?>
                            <li>
                                <div class="item-img">
                                    <a href="<?php echo esc_url($term_link); ?>">
                                        <?php  
                                            if ( $images ) {
                                              echo '<img class="absolute category-image" src="' . $image[0] . '" />';
                                            } else{
                                              echo '<img class="absolute category-image" src="' . $no_img . '" />';
                                            }
                                        ?>
                                        <div class="sv_category_count">
                                            <h3 class="sv-header-title"><?php echo esc_attr($term_name); ?></h3>
                                            <p class="sv-count"><?php echo $sub_count;  ?></p>
                                        </div>
                                    </a>            
                                </div>         
                            </li>
                        <?php } }  ?>
                    </ul>
                </div>

            </div>
    
        <?php         
            echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }
    
    
    /**
     ** Adds storevilla_product_widget widget.
    **/
    add_action('widgets_init', 'storevilla_product_widget');
    function storevilla_product_widget() {
        register_widget('storevilla_product_widget_area');
    }
    
    class storevilla_product_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_product_widget_area', 'SV: Woo Product Section', array(
                'description' => __('A widget that shows WooCommerce all type product (Latest, Feature, On Sale, Up Sale).', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {
            
    
            $prod_type = array(
                'latest_product' => __('Latest Product', 'storevilla-pro'),
                'upsell_product' => __('UpSell Product', 'storevilla-pro'),
                'feature_product' => __('Feature Product', 'storevilla-pro'),
                'on_sale' => __('On Sale Product', 'storevilla-pro'),
            );
    
            $fields = array( 
                
                'storevilla_top_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_top_product_title',
                    'storevilla_widgets_title' => __('Top Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_main_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_main_product_title',
                    'storevilla_widgets_title' => __('Product Main Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_product_type' => array(
                    'storevilla_widgets_name' => 'storevilla_product_type',
                    'storevilla_widgets_title' => __('Select Product Type', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $prod_type
                ),
                
                'storevilla_product_number' => array(
                    'storevilla_widgets_name' => 'storevilla_product_number',
                    'storevilla_widgets_title' => __('Enter Number of Products Show', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                ),                                 
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/  
            $top_title = esc_attr( $instance['storevilla_top_product_title'] );
            $main_title = esc_attr( $instance['storevilla_main_product_title'] );
            $product_type = esc_attr( $instance['storevilla_product_type'] );
            $product_number = intval( $instance['storevilla_product_number'] );
    
            $product_args       =   '';
            
            global $product_label_custom;
            
            if($product_type == 'latest_product'){
                $product_label_custom = __('New', 'storevilla-pro');
                $product_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => $product_number
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
    
            elseif($product_type == 'feature_product'){
                $tax_query[] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
                $product_args = array(
                    'post_type'        => 'product',   
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => 1,
                    'orderby'  => 'date',
                    'order'    => 'desc',
                    'posts_per_page'   => $product_number,
                    'tax_query'           => $tax_query,
                );
            }
    
            elseif($product_type == 'on_sale'){
                $product_args = array(
                'post_type'      => 'product',
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
            
            echo $before_widget; 
        ?>
        
            <div class="sp-producttype-wrap">
                
                <div class="store-container">
                      
                    <div id="product-slider" class="product-slide-area">
                        
                        <div class="block-title-wrap clearfix">
                            
                            <div class="block-title">
                                <?php if( !empty( $top_title ) ) { ?><span><?php echo esc_attr( $top_title ); ?></span> <?php } ?>
                                <?php if( !empty( $main_title ) ) { ?><h2><?php echo esc_attr( $main_title ); ?></h2> <?php } ?>
                            </div>

                            <div class="StoreVillaAction">
                                <div class="villa-lSPrev"></div>
                                <div class="villa-lSNext"></div>
                            </div>

                        </div>
                        
                        <ul class="store-product cS-hidden">
                            <?php                         
                                $query = new WP_Query($product_args);
                                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                                
                            <?php } } wp_reset_postdata(); ?>                    
                        </ul>
                      
                    </div>

                </div>
    
            </div><!-- End Product Slider --> 
    
        <?php         
            echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }    
    
    
    /**
     ** Adds storevilla_column_product_widget widget.
    **/
    add_action('widgets_init', 'storevilla_column_product_widget');
    function storevilla_column_product_widget() {
        register_widget('storevilla_column_product_widget_area');
    }
    
    class storevilla_column_product_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        **/
        public function __construct() {
            parent::__construct(
                'storevilla_column_product_widget_area', 'SV: Woo Product Column', array(
                'description' => __('A widget that shows WooCommerce all type product (Latest, Feature, On Sale, Up Sale) in column view.', 'storevilla-pro')
            ));
        }
        
        private function widget_fields() {
            
    
            $prod_type = array(
                'latest_product' => __('Latest Product', 'storevilla-pro'),
                'category' => __('Category', 'storevilla-pro'),
                'upsell_product' => __('UpSell Product', 'storevilla-pro'),
                'feature_product' => __('Feature Product', 'storevilla-pro'),
                'on_sale' => __('On Sale Product', 'storevilla-pro'),
            );
            
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              $woocommerce_categories[''] = 'Select Product Category';
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
    
            $fields = array(
                
                // Column One Area
                
                'banner_start_group_left_one' => array(
                    'storevilla_widgets_name' => 'banner_start_group_left_one',
                    'storevilla_widgets_title' => __('Product Column One', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'group_start',
                ),
                
                'storevilla_column_one_display' => array(
                    'storevilla_widgets_name' => 'storevilla_column_one_display',
                    'storevilla_widgets_title' => __('Checked to Display One Column', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'checkbox',
                ),
                
                'storevilla_column_one_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_column_one_product_title',
                    'storevilla_widgets_title' => __('Column One Main Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_column_one_product_type' => array(
                    'storevilla_widgets_name' => 'storevilla_column_one_product_type',
                    'storevilla_widgets_title' => __('Select Product Type', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $prod_type
                ),
                
                'storevilla_column_one_category' => array(
                    'storevilla_widgets_name' => 'storevilla_column_one_category',
                    'storevilla_widgets_title' => __('Select Product Category', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),
                
                'storevilla_column_one_product_number' => array(
                    'storevilla_widgets_name' => 'storevilla_column_one_product_number',
                    'storevilla_widgets_title' => __('Enter Number of Products Show', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                ),
                
                'banner_end_group_left_one' => array(
                    'storevilla_widgets_name' => 'banner_end_group_left_one',
                    'storevilla_widgets_field_type' => 'group_end',
                ),
                
                // Column Two Area
                'banner_start_group_left_two' => array(
                    'storevilla_widgets_name' => 'banner_start_group_left_two',
                    'storevilla_widgets_title' => __('Product Column Two', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'group_start',
                ),
                
                
                'storevilla_column_two_display' => array(
                    'storevilla_widgets_name' => 'storevilla_column_two_display',
                    'storevilla_widgets_title' => __('Checked to Display Two Column', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'checkbox',
                ),
            
                'storevilla_column_two_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_column_two_product_title',
                    'storevilla_widgets_title' => __('Column Two Main Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_column_two_product_type' => array(
                    'storevilla_widgets_name' => 'storevilla_column_two_product_type',
                    'storevilla_widgets_title' => __('Select Product Type', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $prod_type
                ),
                
                'storevilla_column_two_category' => array(
                    'storevilla_widgets_name' => 'storevilla_column_two_category',
                    'storevilla_widgets_title' => __('Select Product Category', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),
                
                'storevilla_column_two_product_number' => array(
                    'storevilla_widgets_name' => 'storevilla_column_two_product_number',
                    'storevilla_widgets_title' => __('Enter Number of Products Show', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                ),
                
                'banner_end_group_left_two' => array(
                    'storevilla_widgets_name' => 'banner_end_group_left_two',
                    'storevilla_widgets_field_type' => 'group_end',
                ),
                
                // Column Three Area
                
                'banner_start_group_left_three' => array(
                    'storevilla_widgets_name' => 'banner_start_group_left_three',
                    'storevilla_widgets_title' => __('Product Column Three', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'group_start',
                ),
                
                
                'storevilla_column_three_display' => array(
                    'storevilla_widgets_name' => 'storevilla_column_three_display',
                    'storevilla_widgets_title' => __('Checked to Display Three Column', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'checkbox',
                ),
            
                'storevilla_column_three_product_title' => array(
                    'storevilla_widgets_name' => 'storevilla_column_three_product_title',
                    'storevilla_widgets_title' => __('Column Three Main Title', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'title',
                ),
                
                'storevilla_column_three_product_type' => array(
                    'storevilla_widgets_name' => 'storevilla_column_three_product_type',
                    'storevilla_widgets_title' => __('Select Product Type', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $prod_type
                ),
                
                'storevilla_column_three_category' => array(
                    'storevilla_widgets_name' => 'storevilla_column_three_category',
                    'storevilla_widgets_title' => __('Select Product Category', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'select',
                    'storevilla_widgets_field_options' => $woocommerce_categories
                ),
                
                
                'storevilla_column_three_product_number' => array(
                    'storevilla_widgets_name' => 'storevilla_column_three_product_number',
                    'storevilla_widgets_title' => __('Enter Number of Products Show', 'storevilla-pro'),
                    'storevilla_widgets_field_type' => 'number',
                ),
                
                'banner_end_group_left_three' => array(
                    'storevilla_widgets_name' => 'banner_end_group_left_three',
                    'storevilla_widgets_field_type' => 'group_end',
                ),
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
            ** wp query for first block
            **/  
            
            // Column Area One
            
            $col_one_display           = $instance['storevilla_column_one_display'];
            $col_one_title             = esc_attr( $instance['storevilla_column_one_product_title'] );
            $col_one_product_type      = esc_attr( $instance['storevilla_column_one_product_type'] );
            $col_one_product_category  = intval( $instance['storevilla_column_one_category'] );
            $col_one_product_number    = intval( $instance['storevilla_column_one_product_number'] );
            
            $product_args_one = storevilla_woocommerce_query($col_one_product_type, $col_one_product_category, $col_one_product_number);
            
            // Column Area Two
            
            $col_two_display           = $instance['storevilla_column_two_display'];
            $col_two_title             = esc_attr( $instance['storevilla_column_two_product_title'] );
            $col_two_product_type      = esc_attr( $instance['storevilla_column_two_product_type'] );
            $col_two_product_category  = intval( $instance['storevilla_column_two_category'] );
            $col_two_product_number    = intval( $instance['storevilla_column_two_product_number'] );
            
            $product_args_two = storevilla_woocommerce_query($col_two_product_type, $col_two_product_category, $col_two_product_number);
            
            // Column Area Three
            
            $col_three_display           = $instance['storevilla_column_three_display'];
            $col_three_title             = esc_attr( $instance['storevilla_column_three_product_title'] );
            $col_three_product_type      = esc_attr( $instance['storevilla_column_three_product_type'] );
            $col_three_product_category  = intval( $instance['storevilla_column_three_category'] );
            $col_three_product_number    = intval( $instance['storevilla_column_three_product_number'] );
            
            $product_args_three = storevilla_woocommerce_query($col_three_product_type, $col_three_product_category, $col_three_product_number);
            
            echo $before_widget; 
        ?>
        
            <div class="column-wrap clearfix">

                <div class="store-container">
                    <div class="col-wrap clearfix">
                        <?php if(!empty( $col_one_display ) && $col_one_display == 1 ){ ?> 
                            <div id="col-product-area-one" class="col-product-area-one">
            
                                <div class="block-title">
                                    <?php if( !empty( $col_one_title ) ) { ?><h2><?php echo esc_attr( $col_one_title ); ?></h2> <?php } ?>
                                </div>
                                
                                <div class="col-slider-items">
                                    <?php                         
                                        $query = new WP_Query($product_args_one);
                                        
                                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                    ?>
                                        <?php wc_get_template_part( 'content', 'product' ); ?>
                                        
                                    <?php } } wp_reset_postdata(); ?>                    
                                </div>
                              
                            </div>
                        <?php } ?>
                        
                        <?php if(!empty( $col_two_display ) && $col_two_display == 1 ){ ?> 
                            <div id="col-product-area-one" class="col-product-area-one">
            
                                <div class="block-title">
                                    <?php if( !empty( $col_two_title ) ) { ?><h2><?php echo esc_attr( $col_two_title ); ?></h2> <?php } ?>
                                </div>
                                
                                <div class="col-slider-items">
                                    <?php                         
                                        $query = new WP_Query($product_args_two);
                                        
                                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                    ?>
                                        <?php wc_get_template_part( 'content', 'product' ); ?>
                                        
                                    <?php } } wp_reset_postdata(); ?>                    
                                </div>
                              
                            </div>
                        <?php } ?>
                        
                        <?php if(!empty( $col_three_display ) && $col_three_display == 1 ){ ?> 
                            <div id="col-product-area-one" class="col-product-area-one">
            
                                <div class="block-title">
                                    <?php if( !empty( $col_three_title ) ) { ?><h2><?php echo esc_attr( $col_three_title ); ?></h2> <?php } ?>
                                </div>
                                
                                <div class="col-slider-items">
                                    <?php                         
                                        $query = new WP_Query($product_args_three);
                                        
                                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                    ?>
                                        <?php wc_get_template_part( 'content', 'product' ); ?>
                                        
                                    <?php } } wp_reset_postdata(); ?>                    
                                </div>
                              
                            </div>
                        <?php } ?>
                    
                    </div>
                </div>    
    
            </div><!-- End Product Slider --> 
    
        <?php         
            echo $after_widget;
        }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$storevilla_widgets_name] = storevilla_widgets_updated_field_value($widget_field, $new_instance[$storevilla_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? $instance[$storevilla_widgets_name] : '';
                storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
            }
        }
    }
    
}