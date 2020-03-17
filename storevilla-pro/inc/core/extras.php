<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Store_Villa
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function storevilla_pro_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }
  
  if(is_singular(array( 'post','page' ))){
        global $post;
        $post_sidebar = get_post_meta($post->ID, 'storevilla_page_layouts', true);
        if(!$post_sidebar){
            $post_sidebar = 'rightsidebar';
        }
        $classes[] = $post_sidebar;
    }

    if ( is_woocommerce_activated() ) {
        
        if( is_product_category() || is_shop() ) {
            $woo_page_layout = get_theme_mod( 'storevilla_woocommerce_products_page_layout','rightsidebar' );
            if(!$woo_page_layout){
                $woo_page_layout = 'rightsidebar';
            }
            $classes[] = $woo_page_layout;
        }

        if( is_singular('product') ) {
            $woo_page_layout = get_theme_mod( 'storevilla_woocommerce_single_products_page_layout','rightsidebar' );
            if(!$woo_page_layout){
                $woo_page_layout = 'rightsidebar';
            }
            $classes[] = $woo_page_layout;
        }
    }

    $web_layout = get_theme_mod( 'storevilla_web_page_layout_options', 'disable' );
    if($web_layout == 'enable'){
        $classes[] = 'boxlayout';
    }else{
        $classes[] = 'fulllayout';
    }


  return $classes;
}
add_filter( 'body_class', 'storevilla_pro_body_classes' );

/**
 * Schema type
 * @return string schema itemprop type
 * @since  1.0.0
 */
function storevilla_html_tag_schema() {
    $schema     = 'http://schema.org/';
    $type       = 'WebPage';

    // Is single post
    if ( is_singular( 'post' ) ) {
        $type   = 'Article';
    }

    // Is author page
    elseif ( is_author() ) {
        $type   = 'ProfilePage';
    }

    // Is search results page
    elseif ( is_search() ) {
        $type   = 'SearchResultsPage';
    }

    echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}

/**
 * Store_Villa payment logo section
**/

if ( ! function_exists( 'storevilla_pro_payment_logo' ) ) {
  
    function storevilla_pro_payment_logo() { 
      $payment_logo_one = esc_url( get_theme_mod('paymentlogo_image_one') );
      $payment_logo_two = esc_url( get_theme_mod('paymentlogo_image_two') );
      $payment_logo_three = esc_url( get_theme_mod('paymentlogo_image_three') );
      $payment_logo_four = esc_url( get_theme_mod('paymentlogo_image_four') );
      $payment_logo_five = esc_url( get_theme_mod('paymentlogo_image_five') );
      $payment_logo_six = esc_url( get_theme_mod('paymentlogo_image_six') );
    ?>
      <div class="payment-accept">
        <?php if(!empty($payment_logo_one)) { ?>
            <img src="<?php echo esc_url($payment_logo_one)?>" alt="" />
        <?php } ?>
        <?php if(!empty($payment_logo_two)) { ?>
            <img src="<?php echo esc_url($payment_logo_two)?>" alt="" />
        <?php } ?>
        <?php if(!empty($payment_logo_three)) { ?>
            <img src="<?php echo esc_url($payment_logo_three)?>" alt="" />
        <?php } ?>
        <?php if(!empty($payment_logo_four)) { ?>
            <img src="<?php echo esc_url($payment_logo_four)?>" alt="" />
        <?php } ?>
        <?php if(!empty($payment_logo_five)) { ?>
            <img src="<?php echo esc_url($payment_logo_five)?>" alt="" />
        <?php } ?>
        <?php if(!empty($payment_logo_six)) { ?>
            <img src="<?php echo esc_url($payment_logo_six)?>" alt="" />
        <?php } ?>
      </div>
    <?php
  } 
}

/**
 * Store Villa Header Promo Function Area 
**/
 
if ( ! function_exists( 'storevilla_promo_area' ) ) {
  
    function storevilla_promo_area() {
        
        $header_promo = esc_attr( get_theme_mod( 'storevilla_main_header_promo_area', 'enable' ) );
        
        $promo_one_image = esc_url( get_theme_mod( 'storevilla_promo_area_one_image' ) );
        $promo_one_title = get_theme_mod( 'storevilla_promo_area_one_title' );
        $promo_one_desc = esc_textarea( get_theme_mod( 'storevilla_promo_area_one_desc' ) );
        $promo_one_link = esc_url( get_theme_mod( 'storevilla_promo_area_one_link' ) );
        
        $promo_two_image = esc_url( get_theme_mod( 'storevilla_promo_area_two_image' ) );
        $promo_two_title = get_theme_mod( 'storevilla_promo_area_two_title' );
        $promo_two_desc = esc_textarea( get_theme_mod( 'storevilla_promo_area_two_desc' ) );
        $promo_two_link = esc_url( get_theme_mod( 'storevilla_promo_area_two_link' ) );

        $promo_three_image = esc_url( get_theme_mod( 'storevilla_promo_area_three_image' ) );
        $promo_three_title = get_theme_mod( 'storevilla_promo_area_three_title' );
        $promo_three_desc = esc_textarea( get_theme_mod( 'storevilla_promo_area_three_desc' ) );
        $promo_three_link = esc_url( get_theme_mod( 'storevilla_promo_area_three_link' ) );

    ?>
        <div class="banner-header-promo clearfix">
            <div class="store-promo-wrap">
                <a href="<?php echo $promo_one_link; ?>"/>
                    <div class="sv-promo-area promo-one" <?php if(!empty( $promo_one_image )) { ?> style="background-image:url(<?php echo $promo_one_image; ?>);"<?php } ?>>
                        <div class="promo-wrapper">
                            <?php if(!empty( $promo_one_title ) ) { ?><h2><?php echo $promo_one_title; ?></h2><?php } ?>
                            <?php if(!empty( $promo_one_desc ) ) { ?><p><?php echo $promo_one_desc; ?></p><?php } ?>
                        </div>
                    </div>
                </a>
            </div>

            <div class="store-promo-wrap">
                <a href="<?php echo $promo_two_link; ?>"/>
                    <div class="sv-promo-area" <?php if(!empty( $promo_two_image )) { ?> style="background-image:url(<?php echo $promo_two_image; ?>);"<?php } ?>>
                        <div class="promo-wrapper">
                            <?php if(!empty( $promo_two_title ) ) { ?><h2><?php echo $promo_two_title; ?></h2><?php } ?>
                            <?php if(!empty( $promo_two_desc ) ) { ?><p><?php echo $promo_two_desc; ?></p><?php } ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
                $slider_layout = get_theme_mod( 'storevilla_pro_banner_type_layout','promobanner' );
                if($slider_layout == 'fullbanner'){
            ?>
            <div class="store-promo-wrap">
                <a href="<?php echo $promo_three_link; ?>"/>
                    <div class="sv-promo-area" <?php if(!empty( $promo_three_image )) { ?> style="background-image:url(<?php echo $promo_three_image; ?>);"<?php } ?>>
                        <div class="promo-wrapper">
                            <?php if(!empty( $promo_three_title ) ) { ?><h2><?php echo $promo_three_title; ?></h2><?php } ?>
                            <?php if(!empty( $promo_three_desc ) ) { ?><p><?php echo $promo_three_desc; ?></p><?php } ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    <?php
    }
}

/**
 * Store Villa Service section
**/
if ( ! function_exists( 'storevilla_pro_service_section' ) ) {
    
  function storevilla_pro_service_section() {  

        $services_icon_one = esc_attr( get_theme_mod( 'storevilla_services_icon_one', 'fa fa-truck' ) );
        $service_title_one = esc_attr( get_theme_mod( 'storevilla_service_title_one','FREE SHIPPING WORLDWIDE' ) );
        $service_desc_one = esc_attr( get_theme_mod( 'storevilla_service_desc_one' ) );

        $services_icon_two = esc_attr( get_theme_mod( 'storevilla_services_icon_two', 'fa fa-headphones' ) );
        $service_title_two = esc_attr( get_theme_mod( 'storevilla_service_title_two', '24X7 CUSTOMER SUPPORT' ) );
        $service_desc_two = esc_attr( get_theme_mod( 'storevilla_service_desc_two' ) );

        $services_icon_three = esc_attr( get_theme_mod( 'storevilla_services_icon_three', 'fa fa-dollar' ) );
        $service_title_three = esc_attr( get_theme_mod( 'storevilla_service_title_three', 'MONEY BACK GUARANTEE' ) );
        $service_desc_three = esc_attr( get_theme_mod( 'storevilla_service_desc_three' ) );
       
        $service_area = esc_attr( get_theme_mod( 'storevilla_services_area_settings','enable' ) );

    if(!empty( $service_area ) && $service_area == 'enable') {
      ?>
      
        <div class="our-features-box clearfix">
        
            <div class="store-container">
             
                <div class="feature-box">
                  <span><i class="<?php if(!empty( $services_icon_one )) { echo $services_icon_one; } ?>">&nbsp;</i></span>
                  <div class="content">
                    <?php if(!empty( $service_title_one )) { ?>
                    <h3><?php echo $service_title_one; ?></h3>
                    <?php }  if(!empty( $service_desc_one )) { ?>
                    <p><?php echo $service_desc_one; ?></p>
                    <?php } ?>
                  </div>
                </div>

                <div class="feature-box">
                  <span><i class="<?php if(!empty( $services_icon_two )) { echo $services_icon_two; } ?>">&nbsp;</i></span>
                  <div class="content">
                    <?php if(!empty( $service_title_two )) { ?>
                    <h3><?php echo $service_title_two; ?></h3>
                    <?php }  if(!empty( $service_desc_two )) { ?>
                    <p><?php echo $service_desc_two; ?></p>
                    <?php } ?>
                  </div>
                </div>

                <div class="feature-box">
                  <span><i class="<?php if(!empty( $services_icon_three )) { echo $services_icon_three; } ?>">&nbsp;</i></span>
                  <div class="content">
                    <?php if(!empty( $service_title_three )) { ?>
                    <h3><?php echo $service_title_three; ?></h3>
                    <?php }  if(!empty( $service_desc_three )) { ?>
                    <p><?php echo $service_desc_three; ?></p>
                    <?php } ?>
                  </div>
                </div>
          
            </div>

        </div>
    <?php  }
    
    }
}

/**
 * Page and Post Page Display Layout Metabox function
**/ 
add_action('add_meta_boxes', 'storevilla_metabox_section');
if ( ! function_exists( 'storevilla_metabox_section' ) ) {
  
    function storevilla_metabox_section(){   
        add_meta_box('storevilla_display_layout', 
                __( 'Display Layout Options', 'storevilla-pro' ), 
                'storevilla_display_layout_callback', 
                array('page','post'), 
                'normal', 
                'high'
        );

        add_meta_box(
                 'storevilla_pro_testimonial',
                 __( 'Testimonial Details', 'storevilla-pro' ),
                 'storevilla_pro_testimonial_settings',
                 'testimonials',
                 'normal',
                 'high'
        );

        add_meta_box(
                     'storevilla_pro_team_member',
                     __( 'Our Team Member Details', 'storevilla-pro' ),
                     'storevilla_pro_team_member_settings',
                     'team',
                     'normal',
                     'high'
        );
    }
}

$storevilla_page_layouts =array(

    'leftsidebar' => array(
        'value'     => 'leftsidebar',
        'label'     => __( 'Left Sidebar', 'storevilla-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png',
    ),
    'rightsidebar' => array(
        'value'     => 'rightsidebar',
        'label'     => __( 'Right Sidebar(Default)', 'storevilla-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png',
    ),
     'nosidebar' => array(
        'value'     => 'nosidebar',
        'label'     => __( 'Full width', 'storevilla-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png',
    ),
    'bothsidebar' => array(
        'value'     => 'bothsidebar',
        'label'     => __( 'Both Sidebar', 'storevilla-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/both-sidebar.png',
    )
);

/**
 * Function for Page layout meta box
**/
if ( ! function_exists( 'storevilla_display_layout_callback' ) ) {
    function storevilla_display_layout_callback(){
        global $post, $storevilla_page_layouts;
        wp_nonce_field( basename( __FILE__ ), 'storevilla_settings_nonce' );
    ?>
        <table class="form-table">
            <tr>
              <td>            
                <?php
                  $i = 0;  
                  foreach ($storevilla_page_layouts as $field) {  
                  $storevilla_page_metalayouts = get_post_meta( $post->ID, 'storevilla_page_layouts', true ); 
                ?>            
                  <div class="radio-image-wrapper slidercat" id="slider-<?php echo $i; ?>" style="float:left; margin-right:30px;">
                    <label class="description">
                        <span>
                          <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </span></br>
                        <input type="radio" name="storevilla_page_layouts" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], 
                            $storevilla_page_metalayouts ); if(empty($storevilla_page_metalayouts) && $field['value']=='rightsidebar'){ echo "checked='checked'";  } ?>/>
                         <?php echo $field['label']; ?>
                    </label>
                  </div>
                <?php  $i++; }  ?>
              </td>
            </tr>            
        </table>
    <?php
    }
}

/**
 * Save the custom metabox data
**/
if ( ! function_exists( 'storevilla_save_page_settings' ) ) {
    function storevilla_save_page_settings( $post_id ) { 
        global $storevilla_page_layouts, $post; 
        if ( !isset( $_POST[ 'storevilla_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'storevilla_settings_nonce' ], basename( __FILE__ ) ) )
            return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
            return;        
        if ('page' == $_POST['post_type']) {  
            if (!current_user_can( 'edit_page', $post_id ) )  
                return $post_id;  
        } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
                return $post_id;  
        }    
        foreach ($storevilla_page_layouts as $field) {  
            $old = get_post_meta( $post_id, 'storevilla_page_layouts', true); 
            $new = sanitize_text_field($_POST['storevilla_page_layouts']);
            if ($new && $new != $old) {  
                update_post_meta($post_id, 'storevilla_page_layouts', $new);  
            } elseif ('' == $new && $old) {  
                delete_post_meta($post_id,'storevilla_page_layouts', $old);  
            } 
         } 
    }
}
add_action('save_post', 'storevilla_save_page_settings');


/**
 * Function for testimonial meta box
*/

if ( ! function_exists( 'storevilla_pro_testimonial_settings' ) ) {
  function storevilla_pro_testimonial_settings() {
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'storevilla_pro_testimonial_settings_nonce' );
      $author_position = esc_attr(get_post_meta( $post->ID, 'author_position', true ));
      ?>
      <p>
          <label class="custom_label" for="author_position">Position</label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" size="70" name="author_position" id="author_position" value="<?php echo $author_position; ?>" />
      </p>
      
      <?php    
  }
}
/**
 * Save the custom testimonial metabox data
 */

if ( ! function_exists( 'storevilla_pro_testmonial_save' ) ) {
  function storevilla_pro_testmonial_save( $post_id ) { 
      global $post;
      if ( !isset( $_POST[ 'storevilla_pro_testimonial_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'storevilla_pro_testimonial_settings_nonce' ], basename( __FILE__ ) ) )
          return;

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
          return;
          
      if ('post' == $_POST['post_type']) {  
          if (!current_user_can( 'edit_page', $post_id ) )  
              return $post_id;  
      } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
              return $post_id;  
      }  
            
      //Execute this saving function
      $old = get_post_meta( $post_id, 'author_position', true); 
      $new = sanitize_text_field($_POST['author_position']);
      if ($new && $new != $old) {  
          update_post_meta($post_id, 'author_position', $new);  
      } elseif ('' == $new && $old) {  
          delete_post_meta($post_id,'author_position', $old);  
      }
  }
}
add_action('save_post', 'storevilla_pro_testmonial_save');



/**
 * Function for team meta box
*/
if ( ! function_exists( 'storevilla_pro_team_member_settings' ) ) {
  function storevilla_pro_team_member_settings(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'storevilla_pro_team_member_settings_nonce' );
      $team_member_name = esc_attr(get_post_meta( $post->ID, 'team_member_name', true ));
      $team_member_position = esc_attr(get_post_meta( $post->ID, 'team_member_position', true ));
      $team_member_email = esc_attr(get_post_meta( $post->ID, 'team_member_email', true ));
      $team_member_weblink = esc_url(get_post_meta( $post->ID, 'team_member_weblink', true )); 
      $team_member_facebook = esc_url(get_post_meta( $post->ID, 'team_member_facebook', true )); 
      $team_member_twitter = esc_url(get_post_meta( $post->ID, 'team_member_twitter', true )); 
      $team_member_googleplus = esc_url(get_post_meta( $post->ID, 'team_member_googleplus', true )); 
      $team_member_linkedin = esc_url(get_post_meta( $post->ID, 'team_member_linkedin', true )); 
      $team_member_instagram = esc_url(get_post_meta( $post->ID, 'team_member_instagram', true )); 
      ?>
      <p>
          <label class="custom_label" for="team_member_name"><?php _e('Team Member Name','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_name" id="team_member_name" value="<?php echo $team_member_name; ?>" />
      </p>

      <p>
          <label class="custom_label" for="team_member_position"><?php _e('Team Member Position','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_position" id="team_member_position" value="<?php echo $team_member_position; ?>" />
      </p>
     

      <p>
          <label class="custom_label" for="team_member_email"><?php _e('Team Member Email','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_email" id="team_member_email" value="<?php echo $team_member_email; ?>" />
      </p>

      <p>
          <label class="custom_label" for="team_member_weblink"><?php _e('Team Member Web Link','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_weblink" id="team_member_weblink" value="<?php echo $team_member_weblink; ?>" />
      </p>

      <p>
          <label class="custom_label" for="team_member_facebook"><?php _e('Facebook Url','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_facebook" id="team_member_facebook" value="<?php echo $team_member_facebook; ?>" />
      </p>

      <p>
          <label class="custom_label" for="team_member_twitter"><?php _e('Twitter Url','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_twitter" id="team_member_twitter" value="<?php echo $team_member_twitter; ?>" />
      </p>

      <p>
          <label class="custom_label" for="team_member_googleplus"><?php _e('Google Plus Url','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_googleplus" id="team_member_googleplus" value="<?php echo $team_member_googleplus; ?>" />
      </p>

      <p>
          <label class="custom_label" for="team_member_linkedin"><?php _e('Linkedin Url','storevilla-pro'); ?></label>
          <span class="custom_logo_span"> : </span>
          <input class="custom_logo_input" type="text" name="team_member_linkedin" id="team_member_linkedin" value="<?php echo $team_member_linkedin; ?>" />
      </p>
      
      <?php    
  }
}

/**
 * Save the custom testimonial metabox data
 */
if ( ! function_exists( 'storevilla_pro_team_member_save' ) ) {
  function storevilla_pro_team_member_save( $post_id ) { 
      global $post;
      if ( !isset( $_POST[ 'storevilla_pro_team_member_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'storevilla_pro_team_member_settings_nonce' ], basename( __FILE__ ) ) )
          return;
      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
          return;
          
      if ('post' == $_POST['post_type']) {  
          if (!current_user_can( 'edit_page', $post_id ) )  
              return $post_id;  
      } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
              return $post_id;  
      }  
            
      //Execute this saving function
      $old = get_post_meta( $post_id, 'team_member_name', true); 
      $new = sanitize_text_field($_POST['team_member_name']);
      if ($new && $new != $old) {  
          update_post_meta($post_id, 'team_member_name', $new);  
      } elseif ('' == $new && $old) {  
          delete_post_meta($post_id,'team_member_name', $old);  
      } 
      
      $old_audio = get_post_meta( $post_id, 'team_member_position', true); 
      $new_audio = sanitize_text_field($_POST['team_member_position']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_position', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_position', $old_audio);  
      }


      $old_audio = get_post_meta( $post_id, 'team_member_email', true); 
      $new_audio = sanitize_text_field($_POST['team_member_email']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_email', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_email', $old_audio);  
      }


      $old_audio = get_post_meta( $post_id, 'team_member_weblink', true); 
      $new_audio = sanitize_text_field($_POST['team_member_weblink']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_weblink', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_weblink', $old_audio);  
      }

      $old_audio = get_post_meta( $post_id, 'team_member_facebook', true); 
      $new_audio = sanitize_text_field($_POST['team_member_facebook']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_facebook', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_facebook', $old_audio);  
      }

      $old_audio = get_post_meta( $post_id, 'team_member_twitter', true); 
      $new_audio = sanitize_text_field($_POST['team_member_twitter']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_twitter', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_twitter', $old_audio);  
      }

      $old_audio = get_post_meta( $post_id, 'team_member_googleplus', true); 
      $new_audio = sanitize_text_field($_POST['team_member_googleplus']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_googleplus', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_googleplus', $old_audio);  
      }

      $old_audio = get_post_meta( $post_id, 'team_member_linkedin', true); 
      $new_audio = sanitize_text_field($_POST['team_member_linkedin']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_linkedin', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_linkedin', $old_audio);  
      }

      $old_audio = get_post_meta( $post_id, 'team_member_instagram', true); 
      $new_audio = sanitize_text_field($_POST['team_member_instagram']);
      if ($new_audio && $new_audio != $old_audio) {  
          update_post_meta($post_id, 'team_member_instagram', $new_audio);  
      } elseif ('' == $new_audio && $old_audio) {  
          delete_post_meta($post_id,'team_member_instagram', $old_audio);  
      }
  }
}
add_action('save_post', 'storevilla_pro_team_member_save');


/* Custom Customizer Class */

if(class_exists( 'WP_Customize_control')) {
    
    class Storevilla_Image_Radio_Control extends WP_Customize_Control {
        public $type = 'radioimage';
        public function render_content() {
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div id="input_<?php echo $this->id; ?>" class="image">
                <?php foreach ( $this->choices as $value => $label ) : ?>                
                        <label for="<?php echo $this->id . $value; ?>">
                            <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                            <img src="<?php echo esc_html( $label ); ?>"/>
                        </label>
                <?php endforeach; ?>
            </div>
            <?php 
        }
    }

    /** 
     * Site Preloader 
    */
    class WP_Customize_Preloader_Control extends WP_Customize_Control {  

        public function render_content() {

            $preloaders = array(
                'default',
                'coffee',
                'grid',
                'horizon',
                'list',
                'rhombus',
                'setting',
                'square',
                'text'
            );
            
            if ( empty( $preloaders ) )
            return;            
        ?>
            <label>
                <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif;
                if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php endif; ?>
                
                <div class="cmizer-preloader-container">    
                    <?php foreach($preloaders as $preloader) : ?>
                        <span class="cmizer-preloader <?php if($preloader == $this->value()){ echo "active"; } ?>" preloader="<?php echo $preloader; ?>">
                            <img src="<?php echo get_template_directory_uri().'/images/preloader/'.$preloader.'.gif'; ?>" />
                        </span>
                    <?php endforeach; ?>                        
                </div>
                <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }
}

/**
 * Limit word function 
**/ 
if ( ! function_exists( 'storevilla_pro_word_count' ) ) {
    
    function storevilla_pro_word_count($string, $limit) {
        $stringtags = strip_tags($string);
        $stringtags = strip_shortcodes($stringtags);
        $words = explode(' ', $stringtags);
        return implode(' ', array_slice($words, 0, $limit));
    }
}

/**
 * The Excerpt [...] remove function
**/
function storevilla_pro_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'storevilla_pro_excerpt_more');


function get_google_font_variants(){
    
    $fotography_font_list = get_option( 'fotography_google_font','' ); 

    $font_family = $_REQUEST['font_family']; 
    $font_array = fotography_search_key($fotography_font_list,'family', $font_family);

    $variants_array = $font_array['0']['variants'] ;
    $options_array = "";
    foreach ($variants_array  as $key=>$variants ) {
        $options_array .= '<option value="'.$key.'">'.$variants.'</option>';
    }

    if(!empty($options_array)){
        echo $options_array;
    }else{
        echo $options_array = '';
    }
    die();
}
add_action("wp_ajax_get_google_font_variants", "get_google_font_variants");

function fotography_search_key($array, $key, $value){
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }
        foreach ($array as $subarray) {
            $results = array_merge($results, fotography_search_key($subarray, $key, $value));
        }
    }
    return $results;
}


/**
 * Display live priview function
**/

if ( ! function_exists( 'storevilla_store_typhography' ) ) {

    function storevilla_store_typhography(){

        $p_font_family = get_theme_mod( 'p_font_family');
        $p_font_style = get_theme_mod( 'p_font_style');
        $p_font_family_str = str_replace( ' ', '+', $p_font_family );
        $p_typography =  $p_font_family_str.':'.$p_font_style;

        $h1_font_family = get_theme_mod( 'h1_font_family');
        $h1_font_style = get_theme_mod( 'h1_font_style');
        $h1_font_family_str = str_replace( ' ', '+', $h1_font_family );
        $h1_typography =  $h1_font_family_str.':'.$h1_font_style;

        $h2_font_family = get_theme_mod( 'h2_font_family');
        $h2_font_style = get_theme_mod( 'h2_font_style');
        $h2_font_family_str = str_replace( ' ', '+', $h2_font_family );
        $h2_typography =  $h2_font_family_str.':'.$h2_font_style;

        $h3_font_family = get_theme_mod( 'h3_font_family');
        $h3_font_style = get_theme_mod( 'h3_font_style');
        $h3_font_family_str = str_replace( ' ', '+', $h3_font_family );
        $h3_typography =  $h3_font_family_str.':'.$h3_font_style;

        $h4_font_family = get_theme_mod( 'h4_font_family');
        $h4_font_style = get_theme_mod( 'h4_font_style');
        $h4_font_family_str = str_replace( ' ', '+', $h4_font_family );
        $h4_typography =  $h4_font_family_str.':'.$h4_font_style;


        $h5_font_family = get_theme_mod( 'h5_font_family');
        $h5_font_style = get_theme_mod( 'h5_font_style');
        $h5_font_family_str = str_replace( ' ', '+', $h5_font_family );
        $h5_typography =  $h5_font_family_str.':'.$h5_font_style;


        $h6_font_family = get_theme_mod( 'h6_font_family');
        $h6_font_style = get_theme_mod( 'h6_font_style');
        $h6_font_family_str = str_replace( ' ', '+', $h6_font_family );
        $h6_typography =  $h6_font_family_str.':'.$h6_font_style;
        

        $all_fonts = array( $p_typography, $h1_typography, $h2_typography, $h3_typography, $h4_typography, $h5_typography, $h6_typography );

            $font_family = array();            
            $font_weight_array = array();
            foreach($all_fonts as $fonts){
                $each_font = explode(':',$fonts);
                $font_family[] = $each_font[0];         
                if(!isset($font_weight_array[$each_font[0]]) ){
                    $font_weight_array[$each_font[0]][] = $each_font[1];
                }else{
                    if(!in_array($each_font[1],$font_weight_array[$each_font[0]])){
                        $font_weight_array[$each_font[0]][] = $each_font[1];
                    }
                }
            }
            $final_font_array = array();
            foreach($font_weight_array as $font => $font_weight){
                if(!empty($font)) {
                    $font_weight_str = implode(',',$font_weight);
                    if($font_weight_str != ''){
                    $each_font_string = $font.':'.$font_weight_str;
                    }else{
                        $each_font_string = $font;
                    }
                    $final_font_array[] = $each_font_string;
                }
            }

            $final_font_string = implode("|",$final_font_array);            

        $query_args = array(
            'family' => $final_font_string,
        );
        wp_enqueue_style('storevilla-typhography-font', add_query_arg($query_args, "//fonts.googleapis.com/css"));
    }
  add_action('wp_enqueue_scripts','storevilla_store_typhography');
}


/**
 ** Storevilla Pro Breadcrumbs Function 
**/

if (!function_exists('storevilla_pro_breadcrumbs')) {
  function storevilla_pro_breadcrumbs() {
      global $post;
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '>';      
        $home = __('Home', 'storevilla-pro'); // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        $homeLink = home_url();
        if (is_home() || is_front_page()) {

          if ($showOnHome == 1)
            echo '<div id="storevilla-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div></div>';
        } else {
          echo '<div id="storevilla-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        if (is_category()) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0)
            echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
          echo $before . __('Archive by category','storevilla-pro').' "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
          echo $before . __('Search results for','storevilla-pro'). '"' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
          echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
          if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1)
              echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          } else {
            $cat = get_the_category();
            $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            if ($showCurrent == 0)
              $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
            echo $cats;
            if ($showCurrent == 1)
              echo $before . get_the_title() . $after;
          }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
          $post_type = get_post_type_object(get_post_type());
          echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID);
          $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1)
            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
          if ($showCurrent == 1)
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
          $parent_id = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs) - 1)
              echo ' ' . $delimiter . ' ';
          }
          if ($showCurrent == 1)
            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } elseif (is_tag()) {
          echo $before . __('Posts tagged','storevilla-pro').' "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
          global $author;
          $userdata = get_userdata($author);
          echo $before . __('Articles posted by ','storevilla-pro'). $userdata->display_name . $after;
        } elseif (is_404()) {
          echo $before . 'Error 404' . $after;
        }

        if (get_query_var('paged')) {
          if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
              echo __('Page', 'storevilla-pro') . ' ' . get_query_var('paged');
              if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ')';
      }
      echo '</div>';
    }
  }
}

/**
 * Preloader Frontend Section area
**/

function storevilla_dynamic_preloader() {
    $preloader = esc_attr(get_theme_mod( 'storevilla_preloader', 'default' ));    
    if( isset( $preloader ) && $preloader != '' ) {
    ?>
        <style>
            .no-js #loader { display: none; }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .storevilla-preloader {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999999;
                background: url('<?php echo get_template_directory_uri()."/images/preloader/".$preloader.".gif"; ?>') center no-repeat #fff;
            }
        </style>
    <?php
    }
}
add_action( 'wp_head', 'storevilla_dynamic_preloader');

/**
 * Get the Rgba color function area
**/

if ( ! function_exists( 'svpro_hex2rgba' ) ) {
    function svpro_hex2rgba($color, $opacity = false) { 
        $default = 'rgb(0,0,0)'; 
        if(empty($color))
            return $default;  
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }
        $rgb =  array_map('hexdec', $hex);
        
        if($opacity){
                if(abs($opacity) > 1)
                    $opacity = 1.0;
                    $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
        }
        return $output;
    }
}


/**
 * Tabs Category Products Ajax Function
**/
if ( ! function_exists( 'storevilla_tabs_ajax_action' ) ) {
    function storevilla_tabs_ajax_action() {
            $cat_slug    = $_POST['category_slug'];
            $product_num = $_POST['product_num'];
            ob_start();
        ?>
        <div class="tabs-product-area <?php echo esc_attr( $cat_slug ); ?>" data-slug="<?php echo esc_attr( $cat_slug ); ?>">
           
            <ul class="tabs-product cS-hidden">                            
                <?php 
                    $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'slug', 
                                'terms'     => $cat_slug                                                                 
                            )),
                        'posts_per_page' => $product_num
                    );
                    $query = new WP_Query($product_args);

                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                ?>
                    <?php wc_get_template_part( 'content', 'product' ); ?>
                    
                <?php } } wp_reset_query(); ?>
            </ul>

        </div>
        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo $sv_html;
        die();
    }
}
add_action( 'wp_ajax_storevilla_tabs_ajax_action', 'storevilla_tabs_ajax_action' );
add_action( 'wp_ajax_nopriv_storevilla_tabs_ajax_action', 'storevilla_tabs_ajax_action' );


/**
 * Vertical Tabs Category Products Ajax Function
**/
if ( ! function_exists( 'storevilla_vertical_tabs_ajax_action' ) ) {
    function storevilla_vertical_tabs_ajax_action() {
            $cat_slug    = $_POST['category_slug'];
            ob_start();
        ?>

        <div class="tabs-product-area">

            <ul class="vertical-tabs-product">                            
                <?php 
                    $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'slug', 
                                'terms'     => $cat_slug                                                                 
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
                   
                <?php } } wp_reset_query(); ?>
            </ul>

        </div>

        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo $sv_html;
        die();
    }
}
add_action( 'wp_ajax_storevilla_vertical_tabs_ajax_action', 'storevilla_vertical_tabs_ajax_action' );
add_action( 'wp_ajax_nopriv_storevilla_vertical_tabs_ajax_action', 'storevilla_vertical_tabs_ajax_action' );


/**
 * WooCommerce Archive Page Breadcrumb Funciton Area
**/

if ( ! function_exists( 'storevilla_pro_breadcrumb_woocommerce' ) ) {
    
  function storevilla_pro_breadcrumb_woocommerce() {
    $breadcrumb_options = get_theme_mod('breadcrumb_options', 'enable');
    $breadcrumb_archive_image = get_theme_mod('breadcrumb_archive_image');
    if($breadcrumb_archive_image){
        $bread_archive = $breadcrumb_archive_image;
    }else{
      $breadcrumb_archive_image = 'http://demo.accesspressthemes.com/fashstore-pro/wp-content/uploads/2016/02/reporter-heesoo-jung-703547_1280.jpg';
    }

    if($breadcrumb_options == 'enable') { ?>
        <div class="page_header_wrap" style="background:url('<?php echo $breadcrumb_archive_image; ?>') no-repeat center; background-size: cover; background-attachment:fixed;">
            <div class="store-container">
                <header class="entry-header">
                    <?php if(is_product()) {
                            the_title( '<h1 class="entry-title">', '</h1>' ); 
                        }else{
                            the_archive_title( '<h1 class="entry-title">', '</h1>' );
                        }
                    ?>                   
                </header><!-- .entry-header -->
                <?php woocommerce_breadcrumb() ?>
            </div>
        </div>
<?php }
    }
}
add_action( 'breadcrumb-woocommerce', 'storevilla_pro_breadcrumb_woocommerce' );


/**
 ** StoreVilla Pro Breadcrumb Function Area
**/

if ( ! function_exists( 'storevilla_pro_breadcrumb_page' ) ) {
    
  function storevilla_pro_breadcrumb_page() {
    $breadcrumb_options_page = get_theme_mod('breadcrumb_options_page', 'enable');
    $breadcrumb_page_image = get_theme_mod('breadcrumb_page_image');
    if($breadcrumb_page_image){
        $bread_archive = $breadcrumb_page_image;
    }else{
      $breadcrumb_page_image = 'http://demo.accesspressthemes.com/fashstore-pro/wp-content/uploads/2016/02/reporter-heesoo-jung-703547_1280.jpg';
    }

    if($breadcrumb_options_page == 'enable') { ?>
        <div class="page_header_wrap" style="background:url('<?php echo $breadcrumb_page_image; ?>') no-repeat center; background-size: cover; background-attachment:fixed;">
            <div class="store-container">
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->
                <?php storevilla_pro_breadcrumbs() ?>
            </div>
        </div>
<?php }
    }
}
add_action( 'breadcrumb-page', 'storevilla_pro_breadcrumb_page' );


if ( ! function_exists( 'storevilla_pro_breadcrumb_post' ) ) {
    
  function storevilla_pro_breadcrumb_post() {
    $breadcrumb_options_post = get_theme_mod('breadcrumb_options_post', 'enable');
    $breadcrumb_post_image = get_theme_mod('breadcrumb_post_image');
    if($breadcrumb_post_image){
        $bread_archive = $breadcrumb_post_image;
    }else{
      $breadcrumb_post_image = 'http://demo.accesspressthemes.com/fashstore-pro/wp-content/uploads/2016/02/reporter-heesoo-jung-703547_1280.jpg';
    }

    if($breadcrumb_options_post == 'enable') { ?>
        <div class="page_header_wrap" style="background:url('<?php echo $breadcrumb_post_image; ?>') no-repeat center; background-size: cover; background-attachment:fixed;">
            <div class="store-container">
                <header class="entry-header">
                    <?php if(is_single()) {
                            the_title( '<h1 class="entry-title">', '</h1>' ); 
                        }else{
                            the_archive_title( '<h1 class="entry-title">', '</h1>' );
                        }
                    ?>
                </header><!-- .entry-header -->
                <?php storevilla_pro_breadcrumbs() ?>
            </div>
        </div>
<?php }
    }
}
add_action( 'breadcrumb-post', 'storevilla_pro_breadcrumb_post' );