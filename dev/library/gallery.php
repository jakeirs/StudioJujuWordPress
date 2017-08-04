<?php
//----------------------------------------------
//----------register and label gallery post type
//----------------------------------------------
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
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'capability_type' => 'post',
	'supports' => array('title', 'excerpt', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-format-image' 
); 
register_post_type('gallery', $gallery_args);

add_action('manage_posts_custom_column', 'juju_gallery_custom_columns');
add_filter('manage_edit-gallery_columns', 'juju_add_new_gallery_columns');
 
function juju_add_new_gallery_columns( $columns ){
	$columns = array(
		'cb'				=>		'<input type="checkbox">',
		'juju_gallery_post_thumb'	=>		'Thumbnail',
		'title'				=>		'Photo Title',
		'author'			=>		'Author',
		'date'				=>		'Date'
		
	);
	return $columns;
}
 
function juju_gallery_custom_columns( $column ){
	global $post;
	
	switch ($column) {
		case 'juju_gallery_post_thumb' : echo the_post_thumbnail('admin-list-thumb'); break;
		case 'description' : the_excerpt(); break;
	}
}
 
//add thumbnail images to column
add_filter('manage_posts_columns', 'juju_gallery_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'juju_gallery_add_post_thumbnail_column', 5);
add_filter('manage_custom_post_columns', 'juju_gallery_add_post_thumbnail_column', 5);
 
// Add the column
function juju_gallery_add_post_thumbnail_column($cols){
	$cols['juju_gallery_post_thumb'] = __('Thumbnail');
	return $cols;
}
 
function juju_gallery_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'juju_gallery_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'admin-list-thumb' );
      else
        echo 'Not supported in this theme';
      break;
  }
}
