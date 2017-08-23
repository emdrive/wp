<?php

// create a new taxonomy
function new_taxonomy() {
	
	$labels = array(
		'name' => _x( 'Genres', 'taxonomy general name' ),
		'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Genres' ),
		'all_items' => __( 'All Genres' ),
		'parent_item' => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item' => __( 'Edit Genre' ), 
		'update_item' => __( 'Update Genre' ),
		'add_new_item' => __( 'Add New Genre' ),
		'new_item_name' => __( 'New Genre Name' ),
		'menu_name' => __( 'Genre' ),
	);

	register_taxonomy(
		'name_1', //The name of the taxonomy. Name must not contain capital letters or spaces. 
		array('post', 'post_type_name'),
		array(
			'labels' => $labels,
			'show_tagcloud' => false,
			'sort' => true,
			'rewrite' => array('slug' => 'catalogue'),
			'hierarchical' => true // Tags Style or Categories Style
			//'args' => array( 'orderby' => 'term_order' )
		)
	);

}
add_action( 'init', 'new_taxonomy' );

// Unregister Taxonomy
function unregister_taxonomy1(){
	global $wp_taxonomies;

	$taxonomy_1 = 'category';
	if ( taxonomy_exists( $taxonomy_1))
		unset( $wp_taxonomies[$taxonomy_1]);
	$taxonomy_2 = 'post_tag';
	if ( taxonomy_exists( $taxonomy_2))
		unset( $wp_taxonomies[$taxonomy_2]);
		
}
//add_action( 'init', 'unregister_taxonomy');

