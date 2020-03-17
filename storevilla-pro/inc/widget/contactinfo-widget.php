<?php
/**
 ** Adds storevilla_contact_info widget.
**/
add_action('widgets_init', 'storevilla_contact_info');
function storevilla_contact_info() {
    register_widget('storevilla_contact_info_area');
}

class storevilla_contact_info_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'storevilla_contact_info_area', 'SV: Quick Contact Info', array(
            'description' => __('A widget that shows quick contact information', 'storevilla-pro')
        ));
    }
    
    private function widget_fields() {        
        
        $fields = array( 
            
            'storevilla_quick_contact_title' => array(
                'storevilla_widgets_name' => 'storevilla_quick_contact_title',
                'storevilla_widgets_title' => __('Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            ),
            'storevilla_quick_address' => array(
                'storevilla_widgets_name' => 'storevilla_quick_address',
                'storevilla_widgets_title' => __('Contact Address', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'textarea',
                'storevilla_widgets_row' => '3'
            ),
            'storevilla_quick_phone' => array(
                'storevilla_widgets_name' => 'storevilla_quick_phone',
                'storevilla_widgets_title' => __('Contact Number', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'text',
            ),
            'storevilla_quick_email' => array(
                'storevilla_widgets_name' => 'storevilla_quick_email',
                'storevilla_widgets_title' => __('Contact Email Address', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'text',
            )                   
        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        $title           = $instance['storevilla_quick_contact_title'];
        $contact_address = $instance['storevilla_quick_address'];
        $contact_number  = $instance['storevilla_quick_phone'];
        $contact_email   = $instance['storevilla_quick_email'];        
        
        echo $before_widget; 

        if(!empty($title)) {
          echo '<h4>'.$title.'</h4>';
        }
    ?>
      <ul class="contacts-info">
        <?php if(!empty( $contact_address )) { ?>
          <li>
          <span><i class="fa fa-map-marker"></i></span> <p><?php echo $contact_address; ?></p>
          </li>
        <?php }  if(!empty( $contact_number )) { ?>
          <li class="phone-footer">
            <span><i class="fa fa-mobile"></i></span> <p><?php echo esc_attr( $contact_number ); ?></p>
          </li>
        <?php }  if(!empty( $contact_email )) { ?>
          <li class="email-footer">
            <span><i class="fa fa-envelope"></i></span> <a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_attr( $contact_email ); ?></a>
          </li>
        <?php } ?>
      </ul>
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