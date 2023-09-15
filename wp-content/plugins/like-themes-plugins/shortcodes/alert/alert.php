<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_alert_params' ) ) {

	function like_vc_alert_params() {

		$fields = array(

			array(
				"param_name" => "type",
				"heading" => esc_html__("Type", 'like-themes-plugins'),
				"admin_label" => true,				
				"std" => "error",
				"value" => array(
					esc_html__('Error', 'like-themes-plugins') => 'error',
					esc_html__('Success', 'like-themes-plugins') => 'success',
					esc_html__('Important', 'like-themes-plugins') => 'important',
					esc_html__('Warning', 'like-themes-plugins') => 'warning',
				),
				"type" => "dropdown"
			),
			array(
				'param_name' => 'icon_fontawesome',
				'heading' => esc_html__( 'Icon', 'like-themes-plugins' ),
				'type' => 'iconpicker',
				'admin_label' => true,						
				'value' => '',
				'settings' => array(
					'emptyIcon' => true,
					'type' => 'fontawesome'

				),
			),			
			array(
				"param_name" => "header",
				"heading" => esc_html__("Header", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "text",
				"heading" => esc_html__("Description", 'like-themes-plugins'),
				"admin_label" => false,				
				"type" => "textarea"
			),

		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_alert' ) ) {

	function like_sc_alert($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_alert', $atts, array_merge( array(

			'type'		=> '',
			'header' 	=> '',
			'text' 		=> '',
			'icon_fontawesome' 	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('alert', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_alert", "like_sc_alert");
}


// Adding shortcode to VC
if (!function_exists('like_vc_alert_add')) {

	function like_vc_alert_add() {
		
		vc_map( array(
			"base" => "like_sc_alert",
			"name" 	=> esc_html__("Alert", 'like-themes-plugins'),
			"description" => esc_html__("Alert Block", 'like-themes-plugins'),
			"class" => "like_sc_alert",
			"icon"	=>	likeGetPluginUrl('/shortcodes/alert/alert.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_alert_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_alert_add', 30);
}


