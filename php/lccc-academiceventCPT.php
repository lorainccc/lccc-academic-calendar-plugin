<?php 
// Register Custom Post Type
add_action( 'init', 'register_cpt_lccc_academicevent' );

function register_cpt_lccc_academicevent() {

	$labels = array(
		'name' => __( 'LCCC Academic Events', 'lccc_academicevent' ),
		'singular_name' => __( 'LCCC Academic Event', 'lccc_academicevent' ),
		'add_new' => __( 'Add New', 'lccc_academicevent' ),
		'add_new_item' => __( 'Add New Academic Event', 'lccc_announcement' ),
		'edit_item' => __( 'Edit Academic Event', 'lccc_academicevent' ),
		'new_item' => __( 'New Academic Event', 'lccc_academicevent' ),
		'view_item' => __( 'View Academic Event', 'lccc_academicevent' ),
		'search_items' => __( 'Search Academic Events', 'lccc_announcement' ),
		'not_found' => __( 'No Academic Events Found', 'lccc_announcement' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'lccc_announcement' ),
		'parent_item_colon' => __( 'Parent Item', 'lccc_academicevent' ),
		'menu_name' => __( 'LCCC Academic Events', 'lccc_academicevent' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'This is the post type created for the displaying the announcements of the Lorain County Community College',
		'supports' => array( 'title', 'editor','thumbnail','revisions' ),
		'taxonomies' => array( 'category' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_rest' => true,
  'rest_base'  => 'lccc_academicevent',
  'rest_controller_class' => 'WP_REST_Posts_Controller',
		'menu_icon' => 'dashicons-megaphone',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'lccc_academicevent', $args );
}
function academic_register_taxonomies() {
	$taxonomies = array(
		array(
			'slug'         => 'event_categories',
			'single_name'  => 'Event Category',
			'plural_name'  => 'Event Categoies',
			'post_type'    => 'lccc_academicevent',
			'hierarchical' => true,
			'rewrite'      => array( 'slug' => 'event-categories' ),
		),
	
	);
	foreach( $taxonomies as $taxonomy ) {
		$labels = array(
			'name' => $taxonomy['plural_name'],
			'singular_name' => $taxonomy['single_name'],
			'search_items' =>  'Search ' . $taxonomy['plural_name'],
			'all_items' => 'All ' . $taxonomy['plural_name'],
			'parent_item' => 'Parent ' . $taxonomy['single_name'],
			'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
			'edit_item' => 'Edit ' . $taxonomy['single_name'],
			'update_item' => 'Update ' . $taxonomy['single_name'],
			'add_new_item' => 'Add New ' . $taxonomy['single_name'],
			'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
			'menu_name' => $taxonomy['plural_name']
		);
		
		$rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
		$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;
	
		register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
			'hierarchical' => $hierarchical,
			 'show_tagcloud' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'rewrite' => $rewrite,
		));
	}
	
}
add_action( 'init', 'academic_register_taxonomies' );

?>