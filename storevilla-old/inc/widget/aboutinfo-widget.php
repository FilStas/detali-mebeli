<?php
/**
 ** Adds storevilla_aboutus_info widget.
**/
add_action('widgets_init', 'storevilla_aboutus_info');
function storevilla_aboutus_info() {
    register_widget('storevilla_aboutus_info_area');
}

class storevilla_aboutus_info_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'storevilla_aboutus_info_area', 'SV: About Us Information', array(
            'description' => __('A widget that shows About Us information', 'storevilla-pro')
        ));
    }
    
    private function widget_fields() {        
        
        $fields = array( 
            
            'storevilla_about_logo' => array(
                'storevilla_widgets_name' => 'storevilla_about_logo',
                'storevilla_widgets_title' => __('Upload Image', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'upload',
            ),
            
            'storevilla_about_short_desc' => array(
                'storevilla_widgets_name' => 'storevilla_about_short_desc',
                'storevilla_widgets_title' => __('Short Description', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'textarea',
                'storevilla_widgets_row' => '3'
            ),
            
            'storevilla_facebook_url' => array(
                'storevilla_widgets_name' => 'storevilla_facebook_url',
                'storevilla_widgets_title' => __('Facebook Url', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'url',
            ),
            
            'storevilla_twitter_url' => array(
                'storevilla_widgets_name' => 'storevilla_twitter_url',
                'storevilla_widgets_title' => __('Twitter Url', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'url',
            ),
            
            'storevilla_googleplus_url' => array(
                'storevilla_widgets_name' => 'storevilla_googleplus_url',
                'storevilla_widgets_title' => __('Google Plus Url', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'url',
            ),
            
            'storevilla_youtube_url' => array(
                'storevilla_widgets_name' => 'storevilla_youtube_url',
                'storevilla_widgets_title' => __('Youtube Url', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'url',
            ),
            
            'storevilla_linkedin_url' => array(
                'storevilla_widgets_name' => 'storevilla_linkedin_url',
                'storevilla_widgets_title' => __('Linkedin Url', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'url',
            ),
            
            'storevilla_pinterest_url' => array(
                'storevilla_widgets_name' => 'storevilla_pinterest_url',
                'storevilla_widgets_title' => __('Pinterest Url', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'url',
            ),
                            
        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        $logo            = $instance['storevilla_about_logo'];
        $shor_desc       = $instance['storevilla_about_short_desc'];
        $facebook     = $instance['storevilla_facebook_url'];
        $twitter      = $instance['storevilla_twitter_url'];
        $googleplus   = $instance['storevilla_googleplus_url'];
        $youtube      = $instance['storevilla_youtube_url'];
        $linkedin     = $instance['storevilla_linkedin_url'];
        $pinterest    = $instance['storevilla_pinterest_url'];                
       
        echo $before_widget; 
    ?>
    <div class="store-container">
      <div class="about-info clearfix">
        <?php if(!empty( $logo )) { ?>
          <div class="about-logo">
              <img src="<?php echo esc_url( $logo ); ?>" alt="" />
          </div>
        <?php }  if(!empty( $shor_desc )) { ?>
          <div class="about-desc">
            <?php echo esc_textarea( $shor_desc ); ?>
          </div>
        <?php } ?>
        
          <ul>
                <?php if(!empty( $facebook )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                  </li>
                <?php }  if(!empty( $twitter )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                  </li>
                 <?php }  if(!empty( $googleplus )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $googleplus ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                  </li>
                 <?php }  if(!empty( $youtube )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $youtube ); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                  </li>
                 <?php }  if(!empty( $linkedin )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                  </li>
                 <?php }  if(!empty( $pinterest )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
                  </li>
                <?php } ?>
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
            $storevilla_widgets_field_value = !empty($instance[$storevilla_widgets_name]) ? esc_attr($instance[$storevilla_widgets_name]) : '';
            storevilla_widgets_show_widget_field($this, $widget_field, $storevilla_widgets_field_value);
        }
    }
}