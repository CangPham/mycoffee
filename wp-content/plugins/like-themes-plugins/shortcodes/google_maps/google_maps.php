<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_google_maps_params' ) ) {

	function like_vc_google_maps_params() {

		$fields = array(

			array(
				"param_name" => "style",
				"heading" => esc_html__("Style", 'like-themes-plugins'),
				"std" => "default",
				"admin_label" => true,
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 		=> 'default',
					esc_html__('Yellow', 'like-themes-plugins') 		=> 'yellow',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "lat",
				"heading" => esc_html__("Latitude", 'like-themes-plugins'),
				"type" => "textfield"
			),
			array(
				"param_name" => "lng",
				"heading" => esc_html__("Longitude", 'like-themes-plugins'),
				"type" => "textfield"
			),
			array(
				"param_name" => "zoom",
				"heading" => esc_html__("Zoom", 'like-themes-plugins'),
				"type" => "textfield"
			),					
			array(
				"param_name" => "width",
				"heading" => esc_html__("Width", 'like-themes-plugins'),
				"type" => "textfield"
			),
			array(
				"param_name" => "height",
				"heading" => esc_html__("Height", 'like-themes-plugins'),
				"type" => "textfield"
			),		

		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_google_maps' ) ) {

	function like_sc_google_maps($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_google_maps', $atts, array_merge( array(

			'style'		=> 'default',
			'zoom'		=> '11',
			'lat'		=> '',
			'lng'		=> '',
			'width'		=> '100%',
			'height'	=> '200px',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		if (!empty($atts['lat']) AND !empty($atts['lng'])) {

			return like_sc_output('google_maps', $atts, $content);
		}
			else {

			return false;
		}
	}

	if (like_vc_inited()) add_shortcode("like_sc_google_maps", "like_sc_google_maps");
}


// Adding shortcode to VC
if (!function_exists('like_vc_google_maps_add')) {

	function like_vc_google_maps_add() {
		
		vc_map( array(
			"base" => "like_sc_google_maps",
			"name" 	=> esc_html__("Google Maps Styled", 'like-themes-plugins'),
			"description" => esc_html__("Google_maps", 'like-themes-plugins'),
			"class" => "like_sc_google_maps",
			"icon"	=>	likeGetPluginUrl('/shortcodes/google_maps/google_maps.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_google_maps_params(),
				like_vc_default_params()
			),
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_google_maps_add', 30);
}


