<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
	Team
*/ 
$labels = array(
	'name'               => esc_html__( 'Team', 'like-themes-plugins' ),
	'singular_name'      => esc_html__( 'Team', 'like-themes-plugins' ),
	'menu_name'          => esc_html__( 'Team', 'like-themes-plugins' ),
	'name_admin_bar'     => esc_html__( 'Team', 'like-themes-plugins' ),
	'add_new'            => esc_html__( 'Add New', 'like-themes-plugins' ),
	'add_new_item'       => esc_html__( 'Add New Team', 'like-themes-plugins' ),
	'new_item'           => esc_html__( 'New Team', 'like-themes-plugins' ),
	'edit_item'          => esc_html__( 'Edit Team', 'like-themes-plugins' ),
	'view_item'          => esc_html__( 'View Team', 'like-themes-plugins' ),
	'all_items'          => esc_html__( 'All Team', 'like-themes-plugins' ),
	'search_items'       => esc_html__( 'Search Team', 'like-themes-plugins' ),
	'parent_item_colon'  => esc_html__( 'Parent Team:', 'like-themes-plugins' ),
	'not_found'          => esc_html__( 'No items found.', 'like-themes-plugins' ),
	'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'like-themes-plugins' )
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'menu_icon'			 => 'dashicons-admin-users',	
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'team' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'thumbnail')
);

register_post_type( 'team', $args );	
