<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
	Gallery
*/ 
$labels = array(
	'name'               => esc_html__( 'Gallery', 'like-themes-plugins' ),
	'singular_name'      => esc_html__( 'Gallery', 'like-themes-plugins' ),
	'menu_name'          => esc_html__( 'Gallery', 'like-themes-plugins' ),
	'name_admin_bar'     => esc_html__( 'Gallery', 'like-themes-plugins' ),
	'add_new'            => esc_html__( 'Add New', 'like-themes-plugins' ),
	'add_new_item'       => esc_html__( 'Add New Gallery', 'like-themes-plugins' ),
	'new_item'           => esc_html__( 'New Gallery', 'like-themes-plugins' ),
	'edit_item'          => esc_html__( 'Edit Gallery', 'like-themes-plugins' ),
	'view_item'          => esc_html__( 'View Gallery', 'like-themes-plugins' ),
	'all_items'          => esc_html__( 'All Gallery', 'like-themes-plugins' ),
	'search_items'       => esc_html__( 'Search Gallery', 'like-themes-plugins' ),
	'parent_item_colon'  => esc_html__( 'Parent Gallery:', 'like-themes-plugins' ),
	'not_found'          => esc_html__( 'No items found.', 'like-themes-plugins' ),
	'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'like-themes-plugins' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'menu_icon'			 => 'dashicons-images-alt',	
	'query_var'          => true,
/*		'rewrite'            => array( 'slug' => 'gallery' ),*/
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'thumbnail')
);

register_post_type( 'gallery', $args );	
