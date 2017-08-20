<?php
//----------------------------------------------
//----------register and label gallery post type
//----------------------------------------------
function post_type_gallery() {

	$gallery_labels = array(
		'name' => __('Gallery', 'juju'),
		'singular_name' => __('Gallery', 'juju'),
		'add_new' => __('Add New', 'juju'),
		'add_new_item' => __("Add New Gallery"),
		'edit_item' => __("Edit Gallery"),
		'new_item' => __("New Gallery"),
		'view_item' => __("View Gallery"),
		'search_items' => __("Search Gallery"),
		'not_found' =>  __('No galleries found'),
		'not_found_in_trash' => __('No galleries found in Trash'), 
		'parent_item_colon' => ''
			
	);
	$gallery_args = array(
		'labels' => $gallery_labels,
		'public' => true,
		'publicly_queryable' => true,
		'rewrite' => array('slug' => 'gallery'),
		'show_ui' => true, 
		'query_var' => false,
		'rewrite' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'capability_type' => 'post',
		'supports' => array('title', 'excerpt', 'editor', 'thumbnail'),
		'menu_icon' => 'dashicons-format-image' 
	); 

	register_post_type('gallery', $gallery_args);

	   /* IMPORTANT: Only use once if you have too, see important note at the top of the page for details.  */
    // flush_rewrite_rules( false );
}

add_action('init', 'post_type_gallery');
