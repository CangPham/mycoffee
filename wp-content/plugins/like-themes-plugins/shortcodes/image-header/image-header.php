<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_image_header_params' ) ) {

	function like_vc_image_header_params() {

		$fields = array(

			array(
				"param_name" => "image",
				"heading" => esc_html__("Background Image", 'like-themes-plugins'),
				"type" => "attach_image"
			),
			array(
				"param_name" => "header_type",
				"heading" => esc_html__("Header Type", 'like-themes-plugins'),
				"std" => "4",
				"value" => array(
					esc_html__('Heading 1', 'like-themes-plugins') => '1',
					esc_html__('Heading 2', 'like-themes-plugins') => '2',
					esc_html__('Heading 3', 'like-themes-plugins') => '3',
					esc_html__('Heading 4', 'like-themes-plugins') => '4',
					esc_html__('Heading 5', 'like-themes-plugins') => '5',
					esc_html__('Heading 6', 'like-themes-plugins') => '6'
				),
				'dependency' => array(
					'element' => 'layout',
					'value' => array( 'header' ),
				),				
				"type" => "dropdown"
			),		
			array(
				'param_name' => 'header',
				'heading' => esc_html__( 'Header', 'like-themes-plugins' ),
				'dependency' => array(
					'element' => 'layout',
					'value' => array( 'header' ),
				),						
				'type' => 'textfield',
			),	
			array(
				'param_name' => 'href',
				'std'	=> '#',
				'heading' => esc_html__( 'Href', 'like-themes-plugins' ),
				'type' => 'textfield',
			),
			array(
				'param_name' => 'height',
				'std'	=> '800px',
				'heading' => esc_html__( 'Block Height', 'like-themes-plugins' ),
				'type' => 'textfield',
				'dependency' => array(
					'element' => 'layout',
					'value' => array( 'scroll' ),
				),							
			),								
			array(
				'param_name' => 'layout',
				'heading' => esc_html__( 'Layout', 'like-themes-plugins' ),
				"std" => "header",
				"value" => array(
					esc_html__('Background Image with Header', 'like-themes-plugins') => 'header',
					esc_html__('Background Image with Hover Scroll', 'like-themes-plugins') => 'scroll',
					esc_html__('Background Image with Popup Video', 'like-themes-plugins') => 'video',
				),				
				'type' => 'dropdown',
			),				
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_image_header' ) ) {

	function like_sc_image_header($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_header', $atts, array_merge( array(

			'header_type'	=>  '4',
			'header'	=>  '',
			'height'	=>  '',
			'layout'	=>  'header',
			'href'	=>  '',
			'image'			=>	'',
			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('image-header', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_image_header", "like_sc_image_header");
}


// Adding shortcode to VC
if (!function_exists('like_vc_image_header_add')) {

	function like_vc_image_header_add() {
		
		vc_map( array(
			"base" => "like_sc_image_header",
			"name" 	=> esc_html__("Image Preview Special", 'like-themes-plugins'),
			"description" => esc_html__("Special Background Image", 'like-themes-plugins'),
			"class" => "like_sc_image_header",
			"icon"	=>	"icon-wpb-single-image",
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_image_header_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_image_header_add', 30);
}


