<?php
/**
 ** Adds storevilla_blog_widget widget.
**/
add_action('widgets_init', 'storevilla_blog_widget');
function storevilla_blog_widget() {
    register_widget('storevilla_blog_widget_area');
}

class storevilla_blog_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'storevilla_blog_widget_area', 'SV: Blogs Widget Section', array(
            'description' => __('A widget that shows blogs posts', 'storevilla-pro')
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
            
            'storevilla_blogs_title' => array(
                'storevilla_widgets_name' => 'storevilla_blogs_title',
                'storevilla_widgets_title' => __('Blogs Top Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            ),
            
            'storevilla_blogs_top_title' => array(
                'storevilla_widgets_name' => 'storevilla_blogs_top_title',
                'storevilla_widgets_title' => __('Blogs Main Title', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'title',
            ),
           
            'blogs_category_list' => array(
              'storevilla_widgets_name' => 'blogs_category_list',
              'storevilla_mulicheckbox_title' => __('Select Blogs Category', 'storevilla-pro'),
              'storevilla_widgets_field_type' => 'multicheckboxes',
              'storevilla_widgets_field_options' => $cat_lists
            ),
            
            'blogs_posts_display_order' => array(
                'storevilla_widgets_name' => 'blogs_posts_display_order',
                'storevilla_widgets_title' => __('Display Posts Order', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'select',
                'storevilla_widgets_field_options' => array(
                        'ASC' => 'Accessing Order', 
                        'DESC' => 'Deaccessing Order'
                    )
            ),

            'storevilla_blogs_post_number' => array(
                'storevilla_widgets_name' => 'storevilla_blogs_post_number',
                'storevilla_widgets_title' => __('Enter Display Number of Posts', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'number',
            ),

            'blogs_display_layout_style' => array(
                'storevilla_widgets_name' => 'blogs_display_layout_style',
                'storevilla_widgets_title' => __('Select Blog Display Layout Style', 'storevilla-pro'),
                'storevilla_widgets_field_type' => 'select',
                'storevilla_widgets_field_options' => array(
                        'blog_styleone' => 'Style One', 
                        'blog_styletwo' => 'Style Two',
                        'blog_stylethree' => 'Style Three'
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
        $blog_top_title = $instance['storevilla_blogs_top_title'];
        $blog_main_title = $instance['storevilla_blogs_title'];
        $blogs_category_list       = $instance['blogs_category_list'];
        $blogs_posts_display_order = $instance['blogs_posts_display_order'];
        $post_number = $instance['storevilla_blogs_post_number'];
        $blogs_layout_style = $instance['blogs_display_layout_style'];

    
        $blogs_cat_id = array();
        if(!empty($blogs_category_list)){
            $blogs_cat_id = array_keys($blogs_category_list);
        }

        $blogs_posts = new WP_Query( array(
            'posts_per_page'      => $post_number,
            'post_type'           => 'post',
            'cat'                 => $blogs_cat_id,
            'order'               => $blogs_posts_display_order,
            'ignore_sticky_posts' => 1
        ));

        $total_count = $blogs_posts->post_count;

        echo $before_widget; 
    ?>
        <div class="storevilla-blog-wrap">

            <div class="store-container">

                <div class="blog-outer-container <?php if($blogs_layout_style == 'blog_styletwo'){ ?> blog_styletwo <?php } else if($blogs_layout_style == 'blog_stylethree'){ ?> blog_stylethree <?php } ?>">
                   
                    <div class="block-title">
                        <?php if( !empty( $blog_top_title ) ) { ?><span><?php echo esc_attr( $blog_top_title ); ?></span> <?php } ?>
                        <?php if( !empty( $blog_main_title ) ) { ?><h2><?php echo esc_attr( $blog_main_title ); ?></h2> <?php } ?>
                    </div>
                    
                    <div class="blog-inner clearfix">
                        <div class="blog-col-wrapper <?php if( $blogs_layout_style == 'blog_styletwo' ) { echo 'blog-slide cS-hidden'; } ?> <?php if( $blogs_layout_style == 'blog_stylethree' ) { echo 'blog-slide cS-hidden'; } ?>( )">

                            <?php 
                                $count = 1;
                                if( $blogs_posts->have_posts() ) : while( $blogs_posts->have_posts() ) : $blogs_posts->the_post();
                                $all_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'storevilla-blog-grid', true);
                                if($count <= 2 || $count == 4 || $count == 5){
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'storevilla-blog-grid', true);
                                }elseif($count == 3){
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large', true);
                                }

                                if($blogs_layout_style == 'blog_styleone') {
                            ?>
                            <?php 
                                if($count == 1 || $count == 4 ){
                                    echo '<div class="blog-preview">';
                                }
                                if($count == 3){
                                    echo '<div class="large-blog-preview">';
                                }
                            ?>
                            <div class="blog-preview-item">
                                
                                <?php if( has_post_thumbnail() ){ ?>
                                
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <img alt="" title="<?php the_title( ); ?>" src="<?php echo esc_url( $image[0] ); ?>">
                                        </a>
                                     </div>
                                     
                                <?php } ?>
                               
                                
                                <div class="blog-preview-info">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if( $count == 3 ) { ?>
                                        <div class="blog-preview_desc">
                                            <?php echo storevilla_pro_word_count( get_the_content(), 80); ?>
                                        </div>
                                    <?php } ?>
                                    <a class="blog-preview-btn" href="<?php the_permalink(); ?>"><?php _e('READ MORE','storevilla-pro'); ?></a>
                                </div>
                                
                            </div>
                            <?php 
                                if( $count == 2 || $count == 5 || $count == 3 || $count == $total_count ){
                                    echo '</div>';
                                }
                            } else if($blogs_layout_style == 'blog_styletwo'){
                            ?>
                                <div class="blog-column">                      
                                        
                                    <div class="blog-info">
                                        <div class="blog-inner-info">
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <div class="meta-wrap">
                                                <span class="comment"><?php comments_popup_link( '0 Comment', '1 Comment', '% Comments' ); ?></span>
                                                <span class="time"><?php the_time('j M, Y'); ?></span>
                                            </div>
                                            <?php echo storevilla_pro_word_count( get_the_content(), 10); ?>
                                            <span class="readmore">
                                                <a href="<?php the_permalink(); ?>"><?php _e('Read More','storevilla-pro'); ?></a>
                                            </span>
                                        </div>
                                    </div>

                                    <figure style="background-image: url(<?php echo esc_url( $all_image[0] ); ?>);"></figure>

                                </div>

                            <?php } else if($blogs_layout_style == 'blog_stylethree'){ ?>
                            
                            <div class="column">

                                <div class="blog-info">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                                    
                                    <?php echo storevilla_pro_word_count( get_the_content(), 10); ?>
                                    <span class="readmore">
                                        <a href="<?php the_permalink(); ?>"><?php _e('Read More','storevilla-pro'); ?></a>
                                    </span>
                                </div>

                                <figure style="background-image: url(<?php echo esc_url( $all_image[0] ); ?>);"></figure>
                                <span class="time">
                                    <span class="date"><?php the_time('j'); ?></span>
                                    <span class="month"><?php the_time('M'); ?></span>
                                </span>
                                
                            </div>

                        <?php } $count++; endwhile; endif; wp_reset_postdata(); ?>

                    </div>
            
                </div>

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