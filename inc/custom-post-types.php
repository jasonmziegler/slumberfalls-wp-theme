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

/**
 * Register Instructors Custom Post Type
 */
function slumber_falls_register_instructor_cpt() {
	$labels = array(
		'name'                  => _x( 'Instructors', 'Post type general name', 'slumber-falls' ),
		'singular_name'         => _x( 'Instructor', 'Post type singular name', 'slumber-falls' ),
		'menu_name'             => _x( 'Instructors', 'Admin Menu text', 'slumber-falls' ),
		'name_admin_bar'        => _x( 'Instructor', 'Add New on Toolbar', 'slumber-falls' ),
		'add_new'               => __( 'Add New', 'slumber-falls' ),
		'add_new_item'          => __( 'Add New Instructor', 'slumber-falls' ),
		'new_item'              => __( 'New Instructor', 'slumber-falls' ),
		'edit_item'             => __( 'Edit Instructor', 'slumber-falls' ),
		'view_item'             => __( 'View Instructor', 'slumber-falls' ),
		'all_items'             => __( 'All Instructors', 'slumber-falls' ),
		'search_items'          => __( 'Search Instructors', 'slumber-falls' ),
		'parent_item_colon'     => __( 'Parent Instructors:', 'slumber-falls' ),
		'not_found'             => __( 'No instructors found.', 'slumber-falls' ),
		'not_found_in_trash'    => __( 'No instructors found in Trash.', 'slumber-falls' ),
		'featured_image'        => _x( 'Instructor Headshot', 'Overrides the "Featured Image"', 'slumber-falls' ),
		'set_featured_image'    => _x( 'Set instructor headshot', 'Overrides "Set featured image"', 'slumber-falls' ),
		'remove_featured_image' => _x( 'Remove instructor headshot', 'Overrides "Remove featured image"', 'slumber-falls' ),
		'use_featured_image'    => _x( 'Use as instructor headshot', 'Overrides "Use as featured image"', 'slumber-falls' ),
		'archives'              => _x( 'Instructor archives', 'The post type archive label', 'slumber-falls' ),
		'insert_into_item'      => _x( 'Insert into instructor', 'Overrides "Insert into post"', 'slumber-falls' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this instructor', 'Overrides "Uploaded to this post"', 'slumber-falls' ),
		'filter_items_list'     => _x( 'Filter instructors list', 'Screen reader text', 'slumber-falls' ),
		'items_list_navigation' => _x( 'Instructors list navigation', 'Screen reader text', 'slumber-falls' ),
		'items_list'            => _x( 'Instructors list', 'Screen reader text', 'slumber-falls' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'instructors' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'instructor', $args );
}
add_action( 'init', 'slumber_falls_register_instructor_cpt' );

/**
 * Register Activities Custom Post Type
 */
function slumber_falls_register_activity_cpt() {
	$labels = array(
		'name'                  => _x( 'Activities', 'Post type general name', 'slumber-falls' ),
		'singular_name'         => _x( 'Activity', 'Post type singular name', 'slumber-falls' ),
		'menu_name'             => _x( 'Activities', 'Admin Menu text', 'slumber-falls' ),
		'name_admin_bar'        => _x( 'Activity', 'Add New on Toolbar', 'slumber-falls' ),
		'add_new'               => __( 'Add New', 'slumber-falls' ),
		'add_new_item'          => __( 'Add New Activity', 'slumber-falls' ),
		'new_item'              => __( 'New Activity', 'slumber-falls' ),
		'edit_item'             => __( 'Edit Activity', 'slumber-falls' ),
		'view_item'             => __( 'View Activity', 'slumber-falls' ),
		'all_items'             => __( 'All Activities', 'slumber-falls' ),
		'search_items'          => __( 'Search Activities', 'slumber-falls' ),
		'parent_item_colon'     => __( 'Parent Activities:', 'slumber-falls' ),
		'not_found'             => __( 'No activities found.', 'slumber-falls' ),
		'not_found_in_trash'    => __( 'No activities found in Trash.', 'slumber-falls' ),
		'featured_image'        => _x( 'Activity Photo', 'Overrides the "Featured Image"', 'slumber-falls' ),
		'set_featured_image'    => _x( 'Set activity photo', 'Overrides "Set featured image"', 'slumber-falls' ),
		'remove_featured_image' => _x( 'Remove activity photo', 'Overrides "Remove featured image"', 'slumber-falls' ),
		'use_featured_image'    => _x( 'Use as activity photo', 'Overrides "Use as featured image"', 'slumber-falls' ),
		'archives'              => _x( 'Activity archives', 'The post type archive label', 'slumber-falls' ),
		'insert_into_item'      => _x( 'Insert into activity', 'Overrides "Insert into post"', 'slumber-falls' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this activity', 'Overrides "Uploaded to this post"', 'slumber-falls' ),
		'filter_items_list'     => _x( 'Filter activities list', 'Screen reader text', 'slumber-falls' ),
		'items_list_navigation' => _x( 'Activities list navigation', 'Screen reader text', 'slumber-falls' ),
		'items_list'            => _x( 'Activities list', 'Screen reader text', 'slumber-falls' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'activities' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-chart-area',
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'activity', $args );
}
add_action( 'init', 'slumber_falls_register_activity_cpt' );

/**
 * Register Locations Custom Post Type
 */
function slumber_falls_register_location_cpt() {
	$labels = array(
		'name'                  => _x( 'Locations', 'Post type general name', 'slumber-falls' ),
		'singular_name'         => _x( 'Location', 'Post type singular name', 'slumber-falls' ),
		'menu_name'             => _x( 'Locations', 'Admin Menu text', 'slumber-falls' ),
		'name_admin_bar'        => _x( 'Location', 'Add New on Toolbar', 'slumber-falls' ),
		'add_new'               => __( 'Add New', 'slumber-falls' ),
		'add_new_item'          => __( 'Add New Location', 'slumber-falls' ),
		'new_item'              => __( 'New Location', 'slumber-falls' ),
		'edit_item'             => __( 'Edit Location', 'slumber-falls' ),
		'view_item'             => __( 'View Location', 'slumber-falls' ),
		'all_items'             => __( 'All Locations', 'slumber-falls' ),
		'search_items'          => __( 'Search Locations', 'slumber-falls' ),
		'parent_item_colon'     => __( 'Parent Locations:', 'slumber-falls' ),
		'not_found'             => __( 'No locations found.', 'slumber-falls' ),
		'not_found_in_trash'    => __( 'No locations found in Trash.', 'slumber-falls' ),
		'featured_image'        => _x( 'Location Photo', 'Overrides the "Featured Image"', 'slumber-falls' ),
		'set_featured_image'    => _x( 'Set location photo', 'Overrides "Set featured image"', 'slumber-falls' ),
		'remove_featured_image' => _x( 'Remove location photo', 'Overrides "Remove featured image"', 'slumber-falls' ),
		'use_featured_image'    => _x( 'Use as location photo', 'Overrides "Use as featured image"', 'slumber-falls' ),
		'archives'              => _x( 'Location archives', 'The post type archive label', 'slumber-falls' ),
		'insert_into_item'      => _x( 'Insert into location', 'Overrides "Insert into post"', 'slumber-falls' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this location', 'Overrides "Uploaded to this post"', 'slumber-falls' ),
		'filter_items_list'     => _x( 'Filter locations list', 'Screen reader text', 'slumber-falls' ),
		'items_list_navigation' => _x( 'Locations list navigation', 'Screen reader text', 'slumber-falls' ),
		'items_list'            => _x( 'Locations list', 'Screen reader text', 'slumber-falls' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'locations' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 8,
		'menu_icon'          => 'dashicons-location-alt',
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'location', $args );
}
add_action( 'init', 'slumber_falls_register_location_cpt' );

/**
 * Register FAQs Custom Post Type
 */
function slumber_falls_register_faq_cpt() {
	$labels = array(
		'name'                  => _x( 'FAQs', 'Post type general name', 'slumber-falls' ),
		'singular_name'         => _x( 'FAQ', 'Post type singular name', 'slumber-falls' ),
		'menu_name'             => _x( 'FAQs', 'Admin Menu text', 'slumber-falls' ),
		'name_admin_bar'        => _x( 'FAQ', 'Add New on Toolbar', 'slumber-falls' ),
		'add_new'               => __( 'Add New', 'slumber-falls' ),
		'add_new_item'          => __( 'Add New FAQ', 'slumber-falls' ),
		'new_item'              => __( 'New FAQ', 'slumber-falls' ),
		'edit_item'             => __( 'Edit FAQ', 'slumber-falls' ),
		'view_item'             => __( 'View FAQ', 'slumber-falls' ),
		'all_items'             => __( 'All FAQs', 'slumber-falls' ),
		'search_items'          => __( 'Search FAQs', 'slumber-falls' ),
		'parent_item_colon'     => __( 'Parent FAQs:', 'slumber-falls' ),
		'not_found'             => __( 'No FAQs found.', 'slumber-falls' ),
		'not_found_in_trash'    => __( 'No FAQs found in Trash.', 'slumber-falls' ),
		'archives'              => _x( 'FAQ archives', 'The post type archive label', 'slumber-falls' ),
		'insert_into_item'      => _x( 'Insert into FAQ', 'Overrides "Insert into post"', 'slumber-falls' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this FAQ', 'Overrides "Uploaded to this post"', 'slumber-falls' ),
		'filter_items_list'     => _x( 'Filter FAQs list', 'Screen reader text', 'slumber-falls' ),
		'items_list_navigation' => _x( 'FAQs list navigation', 'Screen reader text', 'slumber-falls' ),
		'items_list'            => _x( 'FAQs list', 'Screen reader text', 'slumber-falls' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'faqs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 9,
		'menu_icon'          => 'dashicons-editor-help',
		'supports'           => array( 'title', 'editor' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'faq', $args );
}
add_action( 'init', 'slumber_falls_register_faq_cpt' );

/**
 * Register Testimonials Custom Post Type
 */
function slumber_falls_register_testimonial_cpt() {
	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post type general name', 'slumber-falls' ),
		'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'slumber-falls' ),
		'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'slumber-falls' ),
		'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'slumber-falls' ),
		'add_new'               => __( 'Add New', 'slumber-falls' ),
		'add_new_item'          => __( 'Add New Testimonial', 'slumber-falls' ),
		'new_item'              => __( 'New Testimonial', 'slumber-falls' ),
		'edit_item'             => __( 'Edit Testimonial', 'slumber-falls' ),
		'view_item'             => __( 'View Testimonial', 'slumber-falls' ),
		'all_items'             => __( 'All Testimonials', 'slumber-falls' ),
		'search_items'          => __( 'Search Testimonials', 'slumber-falls' ),
		'not_found'             => __( 'No testimonials found.', 'slumber-falls' ),
		'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'slumber-falls' ),
		'featured_image'        => _x( 'Testimonial Photo', 'Overrides the "Featured Image"', 'slumber-falls' ),
		'set_featured_image'    => _x( 'Set testimonial photo', 'Overrides "Set featured image"', 'slumber-falls' ),
		'remove_featured_image' => _x( 'Remove testimonial photo', 'Overrides "Remove featured image"', 'slumber-falls' ),
		'use_featured_image'    => _x( 'Use as testimonial photo', 'Overrides "Use as featured image"', 'slumber-falls' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false, // Not publicly browsable.
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'capability_type'    => 'post',
		'has_archive'        => false, // No public archive page.
		'hierarchical'       => false,
		'menu_position'      => 10,
		'menu_icon'          => 'dashicons-star-filled',
		'supports'           => array( 'editor', 'thumbnail' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'slumber_falls_register_testimonial_cpt' );

/**
 * Register Facilities Custom Post Type
 */
function slumber_falls_register_facility_cpt() {
	$labels = array(
		'name'                  => _x( 'Facilities', 'Post type general name', 'slumber-falls' ),
		'singular_name'         => _x( 'Facility', 'Post type singular name', 'slumber-falls' ),
		'menu_name'             => _x( 'Facilities', 'Admin Menu text', 'slumber-falls' ),
		'name_admin_bar'        => _x( 'Facility', 'Add New on Toolbar', 'slumber-falls' ),
		'add_new'               => __( 'Add New', 'slumber-falls' ),
		'add_new_item'          => __( 'Add New Facility', 'slumber-falls' ),
		'new_item'              => __( 'New Facility', 'slumber-falls' ),
		'edit_item'             => __( 'Edit Facility', 'slumber-falls' ),
		'view_item'             => __( 'View Facility', 'slumber-falls' ),
		'all_items'             => __( 'All Facilities', 'slumber-falls' ),
		'search_items'          => __( 'Search Facilities', 'slumber-falls' ),
		'parent_item_colon'     => __( 'Parent Facilities:', 'slumber-falls' ),
		'not_found'             => __( 'No facilities found.', 'slumber-falls' ),
		'not_found_in_trash'    => __( 'No facilities found in Trash.', 'slumber-falls' ),
		'featured_image'        => _x( 'Facility Photo', 'Overrides the "Featured Image"', 'slumber-falls' ),
		'set_featured_image'    => _x( 'Set facility photo', 'Overrides "Set featured image"', 'slumber-falls' ),
		'remove_featured_image' => _x( 'Remove facility photo', 'Overrides "Remove featured image"', 'slumber-falls' ),
		'use_featured_image'    => _x( 'Use as facility photo', 'Overrides "Use as featured image"', 'slumber-falls' ),
		'archives'              => _x( 'Facility archives', 'The post type archive label', 'slumber-falls' ),
		'insert_into_item'      => _x( 'Insert into facility', 'Overrides "Insert into post"', 'slumber-falls' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this facility', 'Overrides "Uploaded to this post"', 'slumber-falls' ),
		'filter_items_list'     => _x( 'Filter facilities list', 'Screen reader text', 'slumber-falls' ),
		'items_list_navigation' => _x( 'Facilities list navigation', 'Screen reader text', 'slumber-falls' ),
		'items_list'            => _x( 'Facilities list', 'Screen reader text', 'slumber-falls' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'facilities' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 11,
		'menu_icon'          => 'dashicons-building',
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'facility', $args );
}
add_action( 'init', 'slumber_falls_register_facility_cpt' );
