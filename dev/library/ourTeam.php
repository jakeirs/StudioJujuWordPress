<?php
//----------------------------------------------
//----------register and label team post type
//----------------------------------------------
$team_labels = array(
	'name' => __('Our Team', 'juju'),
	'singular_name' => __('Our Team', 'juju'),
	'add_new' => __('Add New', 'juju'),
	'add_new_item' => __("Add New Team Member"),
	'edit_item' => __("Edit Team Member"),
	'new_item' => __("New Team Member"),
	'view_item' => __("View Team Member"),
	'search_items' => __("Search Team Member"),
	'not_found' =>  __('No galleries found'),
	'not_found_in_trash' => __('No galleries found in Trash'), 
	'parent_item_colon' => ''
		
);
$team_args = array(
	'labels' => $team_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'capability_type' => 'post',
	'supports' => array('title', 'excerpt', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-universal-access' 
); 
register_post_type('team', $team_args);

add_action('manage_posts_custom_column', 'juju_team_custom_columns');
add_filter('manage_edit-team_columns', 'juju_add_new_team_columns');
 
function juju_add_new_team_columns( $columns ){
	$columns = array(
		'cb'				=>		'<input type="checkbox">',
		'juju_team_post_thumb'	=>		'Portrait',
		'title'				=>		'Name',
		'author'			=>		'Author',
		'date'				=>		'Date'
		
	);
	return $columns;
}
 
function juju_team_custom_columns( $column ){
	global $post;
	
	switch ($column) {
		case 'juju_team_post_thumb' : echo the_post_thumbnail('admin-list-thumb'); break;
		case 'description' : the_excerpt(); break;
	}
}
 
//add thumbnail images to column
add_filter('manage_posts_columns', 'juju_team_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'juju_team_add_post_thumbnail_column', 5);
add_filter('manage_custom_post_columns', 'juju_team_add_post_thumbnail_column', 5);
 
// Add the column
function juju_team_add_post_thumbnail_column($cols){
	$cols['juju_team_post_thumb'] = __('Portrait');
	return $cols;
}
 
function juju_team_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'juju_team_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'admin-list-thumb' );
      else
        echo 'Not supported in this theme';
      break;
  }
}
