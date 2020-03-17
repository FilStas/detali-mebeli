<?php
/**
 ** Adds storevilla_testimonial_widget widget.
**/
add_action('widgets_init', 'storevilla_testimonial_widget');
function storevilla_testimonial_widget() {
    register_widget('storevilla_testimonial_widget_area');
}

class storevilla_testimonial_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'storevilla_testimonial_widget_area', 'SV: Testimonial Widget Section', array(
            'description' => __('A widget that shows client testimonial posts', 'storevilla-pro')
        ));
    }
    
    private function widget_fields() {
        
        $args = array(
          'type'       => 'post',
          'child_of'   => 0,
          'orderby'    => 'name',
          'order'      => 'ASC',
          'hide_empty' => 1,
          'taxonomy'   => 'category',
        );
        $categories = get_categories( $args );
        $cat_lists = array();
        foreach( $categories as $category ) {
            $cat_lists[$category->term_id] = $category->name;
        }

        $fields = array( 
            
            'storevilla_testimonial_top_title' => array(
                'storevilla_widgets_name' => 'storevilla_testimonial_top_title',
                'storevilla_widgets_title' => __('Testimonial Top Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            ),
            
            'storevilla_testimonial_main_title' => array(
                'storevilla_widgets_name' => 'storevilla_testimonial_main_title',
                'storevilla_widgets_title' => __('Testimonial Main Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            ),

            'storevilla_testimonial_testimonial_number_post' => array(
                'storevilla_widgets_name' => 'storevilla_testimonial_testimonial_number_post',
                'storevilla_widgets_title' => __('Enter the Display Number of Testimonials', 'storevilla-pro'),
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
        $testimonial_top_title     = $instance['storevilla_testimonial_top_title'];
        $testimonial_main_title    = $instance['storevilla_testimonial_main_title'];
        $testimonial_number_post     = $instance['storevilla_testimonial_testimonial_number_post'];

    
        $testimonial_cat_id = array();
        if(!empty($testimonial_category_list)){
            $testimonial_cat_id = array_keys($testimonial_category_list);
        }      

        $testimonial_posts = new WP_Query( array(
            'post_type'           => 'testimonials',
            'posts_per_page'      => $testimonial_number_post
        ));

        echo $before_widget; 
    ?>

        <div class="testimonial-outer-container">
            
            <div class="store-container">
                
                <div class="block-title">
                    <?php if( !empty( $testimonial_top_title ) ) { ?><span><?php echo esc_attr( $testimonial_top_title ); ?></span> <?php } ?>
                    <?php if( !empty( $testimonial_main_title ) ) { ?><h2><?php echo esc_attr( $testimonial_main_title ); ?></h2> <?php } ?>
                </div>
                
                <ul id="testimonial-area" class="testimonial-area cS-hidden">
                    
                    <?php 
                        if( $testimonial_posts->have_posts() ) : while( $testimonial_posts->have_posts() ) : $testimonial_posts->the_post(); 
                        $author_position = get_post_meta(get_the_ID(), 'author_position', true);
                    ?>
                        
                        <li class="testimonial-preview-item <?php echo esc_attr( $class ); ?>">
                            
                            <?php 
                            	if( has_post_thumbnail() ){ 
                            	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', true);

                            ?>                            
                                <div class="entry-thumb">
                                    <img alt="" title="<?php the_title( ); ?>" src="<?php echo esc_url( $image[0] ); ?>">
                                </div>                                 
                            <?php } ?>
                           
                            
                            <div class="testimonial-preview-info">
                                <div class="testimonial-preview_desc">
                                    <?php the_excerpt() ?>
                                </div>
                                <h2><?php the_title(); ?></h2>
                                <?php if(!empty( $author_position )) { ?><strong class="designation"><?php echo $author_position; ?></strong><?php } ?>
                            </div>
                            
                        </li>
                        
                    <?php endwhile; endif; wp_reset_postdata(); ?>

                </ul>
        
            </div>

        </div><!-- End Latest Blog -->

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