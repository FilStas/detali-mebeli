<?php

/**
 ** Store Villa Field Functional file
 * @package Store_Villa
**/
function storevilla_widgets_show_widget_field($instance = '', $widget_field = '', $storevilla_field_value = '') {
   
    //list category list in array
    $storevilla_category_list[0] = array(
        'value' => 0,
        'label' => 'Select Categories'
    );
    $storevilla_posts = get_categories();
    foreach ($storevilla_posts as $storevilla_post) :
        $storevilla_category_list[$storevilla_post->term_id] = array(
            'value' => $storevilla_post->term_id,
            'label' => $storevilla_post->name
        );
    endforeach;
    
    
    // Store Posts in array
    $storevilla_pagelist[0] = array(
        'value' => 0,
        'label' => 'Select Pages'
    );
    $arg = array('posts_per_page' => -1);
    $storevilla_pages = get_pages($arg);
    foreach ($storevilla_pages as $storevilla_page) :
        $storevilla_pagelist[$storevilla_page->ID] = array(
            'value' => $storevilla_page->ID,
            'label' => $storevilla_page->post_title
        );
    endforeach;

    extract($widget_field);

    switch ($storevilla_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?> :</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" type="text" value="<?php echo esc_attr($storevilla_field_value) ; ?>" />

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        //title
        case 'title' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?> :</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" type="text" value="<?php echo esc_attr($storevilla_field_value) ; ?>" />
                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'group_start' :
            ?>
            <div class="storevilla-main-group" id="ap-font-awesome-list <?php echo $instance->get_field_id(($storevilla_widgets_name)); ?>">
                <div class="storevilla-main-group-heading" style="font-size: 15px;  font-weight: bold;  padding-top: 12px;"><?php echo $storevilla_widgets_title ; ?><span class="toogle-arrow"></span></div>
                <div class="storevilla-main-group-wrap">

            <?php
            break;

            case 'group_end':
            ?></div>
            </div><?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?> :</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" type="text" value="<?php echo $storevilla_field_value; ?>" />

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?> :</label>
                <textarea class="widefat" rows="<?php echo $storevilla_widgets_row; ?>" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>"><?php echo $storevilla_field_value; ?></textarea>
            </p>
            <?php
            break;

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $storevilla_field_value); ?>/>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?></label>

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo $storevilla_widgets_title;
                echo '<br />';
                foreach ($storevilla_widgets_field_options as $storevilla_option_name => $storevilla_option_title) {
                    ?>
                    <input id="<?php echo $instance->get_field_id($storevilla_option_name); ?>" name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" type="radio" value="<?php echo $storevilla_option_name; ?>" <?php checked($storevilla_option_name, $storevilla_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($storevilla_option_name); ?>"><?php echo $storevilla_option_title; ?></label>
                    <br />
                <?php } ?>

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?> :</label>
                <select name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" class="widefat">
                    <?php foreach ($storevilla_widgets_field_options as $storevilla_option_name => $storevilla_option_title) { ?>
                        <option value="<?php echo $storevilla_option_name; ?>" id="<?php echo $instance->get_field_id($storevilla_option_name); ?>" <?php selected($storevilla_option_name, $storevilla_field_value); ?>><?php echo $storevilla_option_title; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;
        
        // Select pages fields
        case 'selectpage' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?>:</label>
                <select name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" class="widefat">
                    <?php foreach ($storevilla_pagelist as $storevilla_page) { ?>
                        <option value="<?php echo $storevilla_page['value']; ?>" id="<?php echo $instance->get_field_id($storevilla_page['label']); ?>" <?php selected($storevilla_page['value'], $storevilla_field_value); ?>><?php echo $storevilla_page['label']; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?> :</label><br />
                <input name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" type="number" step="4" min="4" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" value="<?php echo $storevilla_field_value; ?>" class="widefat" />

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;        

        // Select category field
        case 'select_category' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?> :</label>
                <select name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" class="widefat">
                    <?php foreach ($storevilla_category_list as $storevilla_single_post) { ?>
                        <option value="<?php echo $storevilla_single_post['value']; ?>" id="<?php echo $instance->get_field_id($storevilla_single_post['label']); ?>" <?php selected($storevilla_single_post['value'], $storevilla_field_value); ?>><?php echo $storevilla_single_post['label']; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($storevilla_widgets_description)) { ?>
                    <br />
                    <small><?php echo $storevilla_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        //Multi checkboxes
        case 'multicheckboxes' :
            
            if( isset( $storevilla_mulicheckbox_title ) ) { ?>
                <label><?php echo esc_attr( $storevilla_mulicheckbox_title ); ?>:</label>
            <?php }
            echo '<div class="storevilla-multiplecat">';
                foreach ( $storevilla_widgets_field_options as $storevilla_option_name => $storevilla_option_title) {
                    if( isset( $storevilla_field_value[$storevilla_option_name] ) ) {
                        $storevilla_field_value[$storevilla_option_name] = 1;
                    }else{
                        $storevilla_field_value[$storevilla_option_name] = 0;
                    }                
                ?>
                    <p>
                        <input id="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>" name="<?php echo $instance->get_field_name($storevilla_widgets_name).'['.$storevilla_option_name.']'; ?>" type="checkbox" value="1" <?php checked('1', $storevilla_field_value[$storevilla_option_name]); ?>/>
                        <label for="<?php echo $instance->get_field_id($storevilla_option_name); ?>"><?php echo $storevilla_option_title; ?></label>
                    </p>
                <?php
                    }
            echo '</div>';
                if (isset($storevilla_widgets_description)) {
            ?>
                    <small><em><?php echo $storevilla_widgets_description; ?></em></small>
            <?php
                }
            
        break;

        case 'color' :
           ?>
           <p>
               <label for="<?php echo $instance->get_field_id($storevilla_widgets_name); ?>"><?php echo $storevilla_widgets_title; ?>:</label><br />
               <input type="text" class="sv-widget-color" name="<?php echo $instance->get_field_name($storevilla_widgets_name); ?>" value="<?php echo $storevilla_field_value; ?>" />
           </p>            
           <script type="text/javascript">
                jQuery(document).ready(function($){
                   // Call Color Picker in Widget Area
                    $('.sv-widget-color').wpColorPicker();                    
                });
           </script>
           <?php
           break;

        case 'upload' :

            $output = '';
            $id = $instance->get_field_id($storevilla_widgets_name);
            $class = '';
            $int = '';
            $value = $storevilla_field_value;
            $name = $instance->get_field_name($storevilla_widgets_name);

            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option section widget-upload">';
            $output .= '<label for="'.$instance->get_field_id($storevilla_widgets_name).'">'.$storevilla_widgets_title.'</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . __('No file chosen', 'storevilla-pro') . '" />' . "\n";
            
            if (function_exists('wp_enqueue_media')) {
                if (( $value == '')) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button-wdgt button" type="button" value="' . __('Upload', 'storevilla-pro') . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . __('Remove', 'storevilla-pro') . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'storevilla-pro') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";
            if ($value != '') {
                $remove = '<a class="remove-image">Remove</a>';
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $value . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }
                    $output .= '';
                    $title = __('View File', 'storevilla-pro');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;
    }
}

function storevilla_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    if ($storevilla_widgets_field_type == 'number') {

        return absint($new_field_value);

    } elseif ($storevilla_widgets_field_type == 'textarea') {
        
        if (!isset($storevilla_widgets_allowed_tags)) {
            $storevilla_widgets_allowed_tags = '<p><strong><em><a>';
        }

        return strip_tags($new_field_value, $storevilla_widgets_allowed_tags);
    } 
    elseif ($storevilla_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    }
    elseif ($storevilla_widgets_field_type == 'title') {
        return wp_kses_post($new_field_value);
    }
    elseif ($storevilla_widgets_field_type == 'multicheckboxes') {
        return wp_kses_post($new_field_value);
    }
    else {
        return strip_tags($new_field_value);
    }
}


/**
** Enqueue scripts for file uploader
**/
if ( ! function_exists( 'storevilla_media_scripts' ) ) {
    function storevilla_media_scripts($hook) {
        if (function_exists('wp_enqueue_media'))
          wp_enqueue_media();
          wp_register_script('storevilla-media-uploader', get_template_directory_uri() . '/js/storevilla-init-admin.js', array( 'jquery', 'customize-controls' ), 1.0);
          wp_enqueue_script('storevilla-media-uploader');
          wp_localize_script('storevilla-media-uploader', 'storevilla_l10n', array(
              'upload' => __('Upload', 'storevilla-pro'),
              'remove' => __('Remove', 'storevilla-pro')
          ));
        wp_enqueue_style( 'storevilla-style-admin', get_template_directory_uri() . '/css/storevilla-admin.css');   
        
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );
       
    }
}
add_action('admin_enqueue_scripts', 'storevilla_media_scripts');