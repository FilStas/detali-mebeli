<?php
/**
 * let's create the function for Testimonial Custom Post Type
**/
function storevilla_pro_testimonial() { 
	register_post_type( 'testimonials', 		
		array( 'labels' => 
				array(
				'name' => __( 'Testimonial', 'storevilla-pro' ),
				'singular_name' => __( 'Testimonial', 'storevilla-pro' ), 
				'all_items' => __( 'All Testimonial', 'storevilla-pro' ), 
				'add_new' => __( 'Add New', 'storevilla-pro' ), 
				'add_new_item' => __( 'Add New Testimonial', 'storevilla-pro' ), 
				'edit' => __( 'Edit Testimonial', 'storevilla-pro' ), 
				'edit_item' => __( 'Edit', 'storevilla-pro' ), 
				'new_item' => __( 'New Post Testimonial', 'storevilla-pro' ), 
				'view_item' => __( 'View Testimonial', 'storevilla-pro' ), 
				'search_items' => __( 'Search Testimonial', 'storevilla-pro' ),
				'not_found' =>  __( 'Nothing found in the Database.', 'storevilla-pro' ), 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'storevilla-pro' ), 
				'parent_item_colon' => ''
				), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 4,
			'menu_icon' => 'dashicons-businessman',
			'rewrite'	=> array( 'slug' => 'testimonial', 'with_front' => false ), 
			'has_archive' => 'testimonial',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt','comments')
		) 
	); 
}
add_action( 'init', 'storevilla_pro_testimonial');


/**
 * Testimonial Screen Layout
*/
add_filter("manage_edit-testimonials_columns", "testimonial_edit_columns");
function testimonial_edit_columns($columns){
  $columns = array(
    "cb" => "<input type='checkbox' />",
    "thum1" =>'Thumbnail',
    "title" => "Title",
    "author_position" => "Author Position",
    "date" => "Date",
  ); 
  return $columns;
}
add_action("manage_posts_custom_column",  "testimonial_custom_columns");
function testimonial_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "thum1":
      the_post_thumbnail( array(50, 50) );
      break;
    case "author_position":
      	echo $author_position = get_post_meta($post->ID, 'author_position', true);
      break;
  }
}


/**
 * let's create the function for Our Team Member Custom Post Type
**/
function storevilla_pro_our_team_member() { 
	register_post_type( 'team', 		
		array( 'labels' => 
				array(
				'name' => __( 'Team Member', 'storevilla-pro' ),
				'singular_name' => __( 'Our Team Member', 'storevilla-pro' ), 
				'all_items' => __( 'All Team Member', 'storevilla-pro' ), 
				'add_new' => __( 'Add New', 'storevilla-pro' ), 
				'add_new_item' => __( 'Add New Team Member', 'storevilla-pro' ), 
				'edit' => __( 'Edit Team Member', 'storevilla-pro' ), 
				'edit_item' => __( 'Edit', 'storevilla-pro' ), 
				'new_item' => __( 'New Post Team Member', 'storevilla-pro' ), 
				'view_item' => __( 'View Team Member', 'storevilla-pro' ), 
				'search_items' => __( 'Search Team Member', 'storevilla-pro' ),
				'not_found' =>  __( 'Nothing found in the Database.', 'storevilla-pro' ), 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'storevilla-pro' ), 
				'parent_item_colon' => ''
				), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 4,
			'menu_icon' => 'dashicons-groups',
			'rewrite'	=> array( 'slug' => 'team', 'with_front' => false ), 
			'has_archive' => 'team',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt','comments')
		) 
	); 
}
add_action( 'init', 'storevilla_pro_our_team_member');


/** 
 * Our Team Member Screen Layout
*/
add_filter("manage_edit-team_columns", "team_edit_columns");
function team_edit_columns($columns){
  $columns = array(
    "cb" => "<input type='checkbox' />",
    "thum" =>'Thumbnail',
    "title" => "Title",
    "name" => "Name",
    "position" => "Position",
    "date" => "Date",
  ); 
  return $columns;
}

add_action("manage_posts_custom_column",  "team_custom_columns");
function team_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "thum":
      the_post_thumbnail( array(50, 50) );
      break;
    case "name":
      	echo $name = get_post_meta($post->ID, 'team_member_name', true);
      break;
    case "position":
      	echo $position = get_post_meta($post->ID, 'team_member_position', true);
      break;
  }
}