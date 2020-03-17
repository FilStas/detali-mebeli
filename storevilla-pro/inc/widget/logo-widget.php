<?php
/**
 ** Adds storevilla_brand_logo widget.
**/
add_action('widgets_init', 'storevilla_brand_logo');
function storevilla_brand_logo() {
    register_widget('storevilla_brand_logo_area');
}

class storevilla_brand_logo_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'storevilla_brand_logo_area', 'SV: Brands Logo Area', array(
            'description' => __('A widget that promote your busincess brands logo', 'storevilla-pro')
        ));
    }
    
    private function widget_fields() {        
        
        $fields = array( 
            
            'storevilla_brands_logo_top_title' => array(
                'storevilla_widgets_name' => 'storevilla_brands_logo_top_title',
                'storevilla_widgets_title' => __('Top Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            ),
            
            'storevilla_brands_logo_main_title' => array(
                'storevilla_widgets_name' => 'storevilla_brands_logo_main_title',
                'storevilla_widgets_title' => __('Main Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            )

        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        $brand_top_title  = $instance['storevilla_brands_logo_top_title'];
        $brand_main_title = $instance['storevilla_brands_logo_main_title'];

        echo $before_widget; 
    ?>
    
      <div class="brand-logo-wrap">
        <div class="store-container">
          <div class="block-title">
              <?php if( !empty( $brand_top_title ) ) { ?><span><?php echo esc_attr( $brand_top_title ); ?></span> <?php } ?>
              <?php if( !empty( $brand_main_title ) ) { ?><h2><?php echo esc_attr( $brand_main_title ); ?></h2> <?php } ?>
          </div>
          <ul id="brands-logo" class="brands-logo cS-hidden">
            <?php
              $all_brands_logo = get_theme_mod('storevilla_brands_logo');
              if(!empty( $all_brands_logo )) {
              $brands_logo = json_decode( $all_brands_logo );
              foreach($brands_logo as $logo){ 
            ?>
              <li>
                <a href="<?php echo esc_url( $logo->link ); ?>" target="_blank">
                  <img src="<?php echo esc_url( $logo->image_url ); ?>" />
                </a>
              </li>            
            <?php } } ?>
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