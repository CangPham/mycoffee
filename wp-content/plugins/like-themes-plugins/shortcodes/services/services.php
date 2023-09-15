<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_services_params' ) ) {

	function like_vc_services_params() {

		$fields = array(
/*			
			array(
				"param_name" => "ids",
				"heading" => esc_html__("Filter IDs", 'like-themes-plugins'),
				"description" => esc_html__("Enter IDs to show, separated by comma", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "textfield"
			),
*/			
			array(
				"param_name" => "limit",
				"heading" => esc_html__("Total Services", 'like-themes-plugins'),
				"description" => esc_html__("Number of services to show", 'like-themes-plugins'),
				"std"	=>	"6",				
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "per_slide",
				"heading" => esc_html__("Services per Slide", 'like-themes-plugins'),
				"description" => esc_html__("If empty or null - no slider will be active", 'like-themes-plugins'),
				"std"	=>	"3",
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "autoplay",
				"heading" => esc_html__("Slider Autoplay, ms", 'like-themes-plugins'),
				"description" => esc_html__("If empty or null - disabled", 'like-themes-plugins'),
				"std"	=>	"0",
				"admin_label" => true,
				"type" => "textfield"
			),						
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_services' ) ) {

	function like_sc_services($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_services', $atts, array_merge( array(

			'ids' 			=> '',
			'limit' 		=> '',
			'per_slide' 	=> '',
			'autoplay' 		=> '0',


			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('services', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_services", "like_sc_services");
}


// Adding shortcode to VC
if (!function_exists('like_vc_services_add')) {

	function like_vc_services_add() {
		
		vc_map( array(
			"base" => "like_sc_services",
			"name" 	=> esc_html__("Services", 'like-themes-plugins'),
			"description" => esc_html__("Services Posts slider", 'like-themes-plugins'),
			"class" => "like_sc_services",
//			"icon"	=>	likeGetPluginUrl('/shortcodes/header/icon.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_services_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_services_add', 30);
}


