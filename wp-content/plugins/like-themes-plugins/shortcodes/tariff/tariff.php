<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_tariff_params' ) ) {

	function like_vc_tariff_params() {

		$fields = array(

			array(
				"param_name" => "layout",
				"heading" => esc_html__("Layout", 'like-themes-plugins'),
				"admin_label" => true,
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Gradient Makeup', 'like-themes-plugins') 	=> 'gradient',
				),
				"type" => "dropdown"
			),
/*			
			array(
				"param_name" => "image",
				"heading" => esc_html__("Image", 'like-themes-plugins'),
				"type" => "attach_image"
			),
*/			
			array(
				"param_name" => "header",
				"heading" => esc_html__("Header", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "text",
				"heading" => esc_html__("Description", 'like-themes-plugins'),
				"description"	=>	esc_html__("To set yes prefix use {+}, to set no prefix use {-}", 'like-themes-plugins'),				
		
				"type" => "textarea"
			),
			array(
				"param_name" => "price",
				"heading" => esc_html__("Price", 'like-themes-plugins'),
				"description"	=>	esc_html__("Use brackets to set units as postfix (for ex: {{ /unit }} )", 'like-themes-plugins'),
				"type" => "textfield"
			),			
			array(
				"param_name" => "btn_href",
				"heading" => esc_html__("Button Link", 'like-themes-plugins'),
				"value"	=>	'#',
				"type" => "textfield"
			),				
			array(
				"param_name" => "btn_header",
				"heading" => esc_html__("Button Header", 'like-themes-plugins'),
				"type" => "textfield"
			),
			array(
				"param_name" => "vip",
				"heading" => esc_html__("Vip", 'like-themes-plugins'),
				"description"	=>	esc_html__("Will be marked", 'like-themes-plugins'),
				"admin_label" => true,						
				"type" => "checkbox"
			),			
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_tariff' ) ) {

	function like_sc_tariff($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_header', $atts, array_merge( array(

			'layout'		=> 'default',
			'image'		=> '',
			'header' 	=> '',
			'text' 		=> '',
			'price' 	=> '',
			'btn_header' 	=> '',
			'btn_href' 	=> '',
			'vip' 	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		if (!empty($atts['header']) || !empty($atts['image'])) {

			return like_sc_output('tariff', $atts, $content);
		}
			else {

			return false;
		}
	}

	if (like_vc_inited()) add_shortcode("like_sc_tariff", "like_sc_tariff");
}


// Adding shortcode to VC
if (!function_exists('like_vc_tariff_add')) {

	function like_vc_tariff_add() {
		
		vc_map( array(
			"base" => "like_sc_tariff",
			"name" 	=> esc_html__("Tariff", 'like-themes-plugins'),
			"description" => esc_html__("Tariff Single Block", 'like-themes-plugins'),
			"class" => "like_sc_tariff",
			"icon"	=>	likeGetPluginUrl('/shortcodes/tariff/tariff.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_tariff_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_tariff_add', 30);
}


