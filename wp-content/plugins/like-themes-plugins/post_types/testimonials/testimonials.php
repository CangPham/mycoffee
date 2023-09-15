<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
	Testimonials
*/ 
	
$labels = array(
	'name'               => esc_html__( 'Testimonials', 'like-themes-plugins' ),
	'singular_name'      => esc_html__( 'Testimonial', 'like-themes-plugins' ),
	'menu_name'          => esc_html__( 'Testimonials', 'like-themes-plugins' ),
	'name_admin_bar'     => esc_html__( 'Testimonial', 'like-themes-plugins' ),
	'add_new'            => esc_html__( 'Add New', 'like-themes-plugins' ),
	'add_new_item'       => esc_html__( 'Add New Testimonial', 'like-themes-plugins' ),
	'new_item'           => esc_html__( 'New Testimonial', 'like-themes-plugins' ),
	'edit_item'          => esc_html__( 'Edit Testimonial', 'like-themes-plugins' ),
	'view_item'          => esc_html__( 'View Testimonial', 'like-themes-plugins' ),
	'all_items'          => esc_html__( 'All Testimonials', 'like-themes-plugins' ),
	'search_items'       => esc_html__( 'Search Testimonials', 'like-themes-plugins' ),
	'parent_item_colon'  => esc_html__( 'Parent Testimonials:', 'like-themes-plugins' ),
	'not_found'          => esc_html__( 'No items found.', 'like-themes-plugins' ),
	'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'like-themes-plugins' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'menu_icon'			 => 'dashicons-format-status',	
	'query_var'          => true,
	'rewrite'            => false,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'thumbnail')
);

register_post_type( 'testimonials', $args );

$labels = array(
	'name'              => __( 'Categories', 'like-themes-plugins' ),
	'singular_name'     => __( 'Category', 'like-themes-plugins' ),
	'search_items'      => __( 'Search Categories', 'like-themes-plugins' ),
	'all_items'         => __( 'All Categories', 'like-themes-plugins' ),
	'parent_item'       => __( 'Parent Category', 'like-themes-plugins' ),
	'parent_item_colon' => __( 'Parent Category', 'like-themes-plugins' ) . ':',
	'edit_item'         => __( 'Edit Category', 'like-themes-plugins' ),
	'update_item'       => __( 'Update Category', 'like-themes-plugins' ),
	'add_new_item'      => __( 'Add New Category', 'like-themes-plugins' ),
	'new_item_name'     => __( 'New Category Name', 'like-themes-plugins' ),
	'menu_name'         => __( 'Category', 'like-themes-plugins' ),
);

$args = array(
	'hierarchical'      => true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
//		'rewrite'           => array( 'slug' => 'Category' ),
);

register_taxonomy( 'testimonials-category', array( 'testimonials' ), $args );