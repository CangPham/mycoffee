<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode empty_space
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_empty_space_params' ) ) {

	function like_vc_empty_space_params() {

		$fields = array(

			array(
				'param_name' => 'height_lg',
				'heading' => esc_html__( 'Height Desktop', 'like-themes-plugins' ),
				'type' => 'textfield',
				"std"	=>	"64px",
				'admin_label' => true,
			),
			array(
				'param_name' => 'height_sm',
				'heading' => esc_html__( 'Height Tablet', 'like-themes-plugins' ),
				"description" => esc_html__("By default inherit from larger", 'like-themes-plugins'),				
				'type' => 'textfield',
				"std"	=>	"",
				'admin_label' => true,
			),
			array(
				'param_name' => 'height_xs',
				'heading' => esc_html__( 'Height Mobile', 'like-themes-plugins' ),
				"description" => esc_html__("By default inherit from larger", 'like-themes-plugins'),				
				'type' => 'textfield',
				"std"	=>	"",
				'admin_label' => true,
			),						
		);

		return $fields;

	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_empty_space' ) ) {

	function like_sc_empty_space($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_header', $atts, array_merge( array(

			'height_lg'		=> '',
			'height_sm'		=> '',			
			'height_xs' 	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('empty_space', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_empty_space", "like_sc_empty_space");
}


// Adding shortcode to VC
if (!function_exists('like_vc_empty_space_add')) {

	function like_vc_empty_space_add() {
		
		vc_map( array(
			"base" => "like_sc_empty_space",
			"name" 	=> esc_html__("Empty Space Responsive", 'like-themes-plugins'),
			"description" => esc_html__("Advanced Empty Space", 'like-themes-plugins'),
			"class" => "like_sc_empty_space",
			'icon' => 'icon-wpb-ui-empty_space',
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_empty_space_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_empty_space_add', 30);
}


