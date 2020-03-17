<?php
/**
 ** Adds storevilla_team_widget widget.
**/
add_action('widgets_init', 'storevilla_team_widget');
function storevilla_team_widget() {
    register_widget('storevilla_team_widget_area');
}

class storevilla_team_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'storevilla_team_widget_area', 'SV: Team Member Widget', array(
            'description' => __('A widget that shows client team member', 'storevilla-pro')
        ));
    }
    
    private function widget_fields() {
        
        $fields = array( 
            
            'storevilla_team_number_post' => array(
                'storevilla_widgets_name' => 'storevilla_team_number_post',
                'storevilla_widgets_title' => __('Enter the Display Number of Team', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'number',
            ),

            'storevilla_team_display_order' => array(
                'storevilla_widgets_name' => 'storevilla_team_display_order',
                'storevilla_widgets_title' => __('Display Order', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'select',
                'storevilla_widgets_field_options' => array(
                        'ASC' => 'Ascending Order', 
                        'DESC' => 'Descending Order'
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
        $team_number_post     = $instance['storevilla_team_number_post'];
        $team_display_order = $instance['storevilla_team_display_order'];
       
        $team_posts = new WP_Query( array(
            'post_type'           => 'team',
            'posts_per_page'      => $team_number_post,
            'order'               => $team_display_order,
        ));

        echo $before_widget; 
    ?>

        <div class="team-outer-container">
            
            <div class="store-container">                
                  
                <ul id="team-area" class="team-area cS-hidden">
                    
                    <?php 
                        if( $team_posts->have_posts() ) : while( $team_posts->have_posts() ) : $team_posts->the_post(); 
                        $author_position = get_post_meta(get_the_ID(), 'author_position', true);

                        $team_member_name = esc_attr(get_post_meta( get_the_ID(), 'team_member_name', true ));
                        $team_member_position = esc_attr(get_post_meta( get_the_ID(), 'team_member_position', true ));
                        $team_member_email = get_post_meta( get_the_ID(), 'team_member_email', true );
                        $team_member_weblink = esc_url(get_post_meta( get_the_ID(), 'team_member_weblink', true )); 
                        $team_member_facebook = esc_url(get_post_meta( get_the_ID(), 'team_member_facebook', true )); 
                        $team_member_twitter = esc_url(get_post_meta( get_the_ID(), 'team_member_twitter', true )); 
                        $team_member_googleplus = esc_url(get_post_meta( get_the_ID(), 'team_member_googleplus', true )); 
                        $team_member_linkedin = esc_url(get_post_meta( get_the_ID(), 'team_member_linkedin', true )); 
                        $team_member_instagram = esc_url(get_post_meta( get_the_ID(), 'team_member_instagram', true ));
                    ?>
                        
                        <div class="team-grid-item grid-item format-standard">
                            <?php 
                                if( has_post_thumbnail() ){ 
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'storevilla-team', true);
                            ?>                            
                                <div class="media-box">
                                    <img alt="" title="<?php the_title( ); ?>" src="<?php echo esc_url( $image[0] ); ?>">
                                </div>                                 
                            <?php } ?>
                            
                            <div class="grid-item-inner">
                                <?php if(!empty( $team_member_name) ) { ?><h4><?php echo $team_member_name; ?></h4><?php } ?>
                                <?php if(!empty( $team_member_position) ) { ?><span class="meta-data"><?php echo $team_member_position; ?></span><?php } ?>
                                <?php if(!empty( $team_member_email) ) { ?><a href="mailto:<?php echo $team_member_email; ?>" class="basic-link pull-right"><?php _e('Email','storevilla-pro'); ?> <i class="icon icon-arrow-right"></i></a><?php } ?>
                                <ul class="social-icons">
                                    <?php if(!empty( $team_member_facebook) ) { ?><li><a href="<?php echo $team_member_facebook; ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
                                    <?php if(!empty( $team_member_twitter) ) { ?><li><a href="<?php echo $team_member_twitter; ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
                                    <?php if(!empty( $team_member_googleplus) ) { ?><li><a href="<?php echo $team_member_googleplus; ?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                                    <?php if(!empty( $team_member_linkedin) ) { ?><li><a href="<?php echo $team_member_linkedin; ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                                    <?php if(!empty( $team_member_instagram) ) { ?><li><a href="<?php echo $team_member_instagram; ?>"><i class="fa fa-instagram"></i></a></li><?php } ?>
                                    <?php if(!empty( $team_member_weblink) ) { ?><li><a href="<?php echo $team_member_weblink; ?>"><i class="fa fa-link"></i></a></li><?php } ?>
                                </ul>
                            </div>

                        </div>
                        
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