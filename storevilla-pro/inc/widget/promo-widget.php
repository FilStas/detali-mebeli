<?php
/**
 ** Adds storevilla_promo_pages widget.
**/
add_action('widgets_init', 'storevilla_promo_pages');
function storevilla_promo_pages() {
    register_widget('storevilla_promo_pages_area');
}

class storevilla_promo_pages_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'storevilla_promo_pages_area', 'SV: Full Promo Widget Section', array(
            'description' => __('A widget that promote you busincess visual way', 'storevilla-pro')
        ));
    }
    
    private function widget_fields() {
             
        
        $fields = array( 

            // Promo one Area

            'storevilla_full_promo_bg_image' => array(
                'storevilla_widgets_name' => 'storevilla_full_promo_bg_image',
                'storevilla_widgets_title' => __(' Full Promo Background Image', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'upload',
            ),            
           
            'storevilla_full_promo_title' => array(
                'storevilla_widgets_name' => 'storevilla_full_promo_title',
                'storevilla_widgets_title' => __('Enter Full Promo Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            ),
            
            'storevilla_full_promo_desc' => array(
                'storevilla_widgets_name' => 'storevilla_full_promo_desc',
                'storevilla_widgets_title' => __('Enter Very Short Full Promo Description', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'textarea',
                'storevilla_widgets_row' => 3,
            ),            
                       
            'storevilla_full_promo_button_link' => array(
                'storevilla_widgets_name' => 'storevilla_full_promo_button_link',
                'storevilla_widgets_title' => __('Full Promo Button Link', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'url',
            ),

            'storevilla_full_promo_button_text' => array(
                'storevilla_widgets_name' => 'storevilla_full_promo_button_text',
                'storevilla_widgets_title' => __('Full Promo Button Text', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'text',
            )

        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);

        $full_promo_bg             = $instance['storevilla_full_promo_bg_image'];        
        $full_promo_title          = $instance['storevilla_full_promo_title'];
        $full_promo_desc           = $instance['storevilla_full_promo_desc'];
        $full_promo_button_link    = $instance['storevilla_full_promo_button_link'];
        $full_promo_text           = $instance['storevilla_full_promo_button_text'];

        echo $before_widget; 
    ?>
        <div class="full-promo-seciont clearfix">
            
            <div class="store-container clearfix" >
           
                <div class="full-promo-area" <?php if(!empty( $full_promo_bg )) { ?> style="background-image:url(<?php echo esc_url( $full_promo_bg ); ?>); background-size:cover;" <?php } ?>>

                    <div class="full-text-wrap">
                        <?php if(!empty( $full_promo_title )) { ?><h2><?php echo esc_attr( $full_promo_title ); ?></h2><?php } ?>
                        <?php if(!empty( $full_promo_desc )) { ?><span><?php echo esc_attr( $full_promo_desc ); ?></span><?php } ?>
                        <?php if(!empty( $full_promo_text )) { ?>
                            <a href="<?php echo esc_url($full_promo_button_link ); ?>">
                                <button><?php echo esc_attr( $full_promo_text ); ?></button>
                            </a>
                        <?php } ?>
                    </div>

                </div> 
                             
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