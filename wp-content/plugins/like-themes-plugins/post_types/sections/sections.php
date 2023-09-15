<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
	Sections
*/ 
$labels = array(
	'name'               => esc_html__( 'Sections', 'like-themes-plugins' ),
	'singular_name'      => esc_html__( 'Section', 'like-themes-plugins' ),
	'menu_name'          => esc_html__( 'Sections', 'like-themes-plugins' ),
	'name_admin_bar'     => esc_html__( 'Sections', 'like-themes-plugins' ),
	'add_new'            => esc_html__( 'Add New', 'like-themes-plugins' ),
	'add_new_item'       => esc_html__( 'Add New Section', 'like-themes-plugins' ),
	'new_item'           => esc_html__( 'New Section', 'like-themes-plugins' ),
	'edit_item'          => esc_html__( 'Edit Section', 'like-themes-plugins' ),
	'view_item'          => esc_html__( 'View Section', 'like-themes-plugins' ),
	'all_items'          => esc_html__( 'All Section', 'like-themes-plugins' ),
	'search_items'       => esc_html__( 'Search Section', 'like-themes-plugins' ),
	'parent_item_colon'  => esc_html__( 'Parent Section:', 'like-themes-plugins' ),
	'not_found'          => esc_html__( 'No items found.', 'like-themes-plugins' ),
	'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'like-themes-plugins' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'menu_icon'			 => 'dashicons-tagcloud',	
	'query_var'          => true,
	'rewrite'            => false,
	'capability_type'    => 'post',
	'has_archive'        => false,
	'hierarchical'       => false,
	'menu_position'      => 21,
	'supports'			 => array( 'title', 'editor')
);

register_post_type( 'sections', $args );	
