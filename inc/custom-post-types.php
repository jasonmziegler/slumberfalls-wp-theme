<?php
/**
 * Custom Post Types for Slumber Falls Theme
 *
 * @package Slumber_Falls
 */

/**
 * Register Camps Custom Post Type
 */
function slumber_falls_register_camp_cpt() {
	$labels = array(
		'name'                  => _x( 'Camps', 'Post type general name', 'slumber-falls' ),
		'singular_name'         => _x( 'Camp', 'Post type singular name', 'slumber-falls' ),
		'menu_name'             => _x( 'Camps', 'Admin Menu text', 'slumber-falls' ),
		'name_admin_bar'        => _x( 'Camp', 'Add New on Toolbar', 'slumber-falls' ),
		'add_new'               => __( 'Add New', 'slumber-falls' ),
		'add_new_item'          => __( 'Add New Camp', 'slumber-falls' ),
		'new_item'              => __( 'New Camp', 'slumber-falls' ),
		'edit_item'             => __( 'Edit Camp', 'slumber-falls' ),
		'view_item'             => __( 'View Camp', 'slumber-falls' ),
		'all_items'             => __( 'All Camps', 'slumber-falls' ),
		'search_items'          => __( 'Search Camps', 'slumber-falls' ),
		'parent_item_colon'     => __( 'Parent Camps:', 'slumber-falls' ),
		'not_found'             => __( 'No camps found.', 'slumber-falls' ),
		'not_found_in_trash'    => __( 'No camps found in Trash.', 'slumber-falls' ),
		'featured_image'        => _x( 'Camp Featured Image', 'Overrides the "Featured Image"', 'slumber-falls' ),
		'set_featured_image'    => _x( 'Set camp image', 'Overrides "Set featured image"', 'slumber-falls' ),
		'remove_featured_image' => _x( 'Remove camp image', 'Overrides "Remove featured image"', 'slumber-falls' ),
		'use_featured_image'    => _x( 'Use as camp image', 'Overrides "Use as featured image"', 'slumber-falls' ),
		'archives'              => _x( 'Camp archives', 'The post type archive label', 'slumber-falls' ),
		'insert_into_item'      => _x( 'Insert into camp', 'Overrides "Insert into post"', 'slumber-falls' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this camp', 'Overrides "Uploaded to this post"', 'slumber-falls' ),
		'filter_items_list'     => _x( 'Filter camps list', 'Screen reader text', 'slumber-falls' ),
		'items_list_navigation' => _x( 'Camps list navigation', 'Screen reader text', 'slumber-falls' ),
		'items_list'            => _x( 'Camps list', 'Screen reader text', 'slumber-falls' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'camps' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-calendar-alt',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'camp', $args );
}
add_action( 'init', 'slumber_falls_register_camp_cpt' );
