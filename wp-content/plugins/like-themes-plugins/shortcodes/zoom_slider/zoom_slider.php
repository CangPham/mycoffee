<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_zoom_slider_params' ) ) {

	function like_vc_zoom_slider_params() {

		$fields = array(

			array(
				"param_name" => "zoom",
				"heading" => esc_html__("Zoom Effect", 'like-themes-plugins'),
				"std" => "default",
				"admin_label" => true,
				"value" => array(
					esc_html__('Zoom In', 'like-themes-plugins') 	=> 'default',
					esc_html__('Zoom Out', 'like-themes-plugins') 	=> 'out',
					esc_html__('Fade Only', 'like-themes-plugins') 	=> 'fade',
				),
				"type" => "dropdown"
			),			
			array(
				"param_name" => "style",
				"heading" => esc_html__("Content Style", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 			=> 'default',
					esc_html__('Large ', 'like-themes-plugins') 	=> 'large',
					esc_html__('Extra Large', 'like-themes-plugins') 	=> 'xlarge',
				),
				"type" => "dropdown"
			),	

			array(
				"param_name" => "arrows",
				"heading" => esc_html__("Navigations arrows", 'like-themes-plugins'),
				"std" => "false",
				"group"	=>	esc_html__('Arrows', 'like-themes-plugins'),
				"value" => array(
					esc_html__('Hidden', 'like-themes-plugins') 	=> 'false',
					esc_html__('Visible', 'like-themes-plugins') 	=> 'true',
				),
				"type" => "dropdown"
			),				
			array(
				"param_name" => "arrow_left",
				"heading" => esc_html__("Arrow left", 'like-themes-plugins'),
				"std" => "prev",
				"group"	=>	esc_html__('Arrows', 'like-themes-plugins'),
				"type" => "textfield"
			),	
			array(
				"param_name" => "arrow_right",
				"heading" => esc_html__("Arrow right", 'like-themes-plugins'),
				"std" => "next",
				"group"	=>	esc_html__('Arrows', 'like-themes-plugins'),
				"type" => "textfield"
			),				

			array(
				"param_name" => "bullets",
				"heading" => esc_html__("Navigations Bullets", 'like-themes-plugins'),
				"std" => "false",
				"value" => array(
					esc_html__('Hidden', 'like-themes-plugins') 	=> 'false',
					esc_html__('Bottom', 'like-themes-plugins') 	=> 'true',
					esc_html__('Right', 'like-themes-plugins') 	=> 'right',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "color",
				"heading" => esc_html__("Content Color", 'like-themes-plugins'),
				"std" => "white",
				"value" => array(
					esc_html__('White', 'like-themes-plugins') 	=> 'white',
					esc_html__('Black', 'like-themes-plugins') 	=> 'black',
				),
				"type" => "dropdown"
			),					
			array(
				"param_name" => "align",
				"heading" => esc_html__("Content Align", 'like-themes-plugins'),
				"std" => "center",
				"value" => array(
					esc_html__('Center', 'like-themes-plugins') 	=> 'center',
					esc_html__('Left', 'like-themes-plugins') 		=> 'left',
					esc_html__('Right', 'like-themes-plugins') 	=> 'right',
				),
				"type" => "dropdown"
			),	
			array(
				"param_name" => "overlay",
				"heading" => esc_html__("Overlay", 'like-themes-plugins'),
				"std" => "plain",
				"value" => array(
					esc_html__('Black Overlay', 'like-themes-plugins') 	=> 'plain',
					esc_html__('Gray Overlay', 'like-themes-plugins') 	=> 'gray',
					esc_html__('Disabled', 'like-themes-plugins') 		=> 'false',
				),
				"type" => "dropdown"
			),	
			array(
				"param_name" => "images",
				"heading" => esc_html__("Layer 1 Background Images", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "attach_images"
			),		
			array(
				"param_name" => "images2",
				"heading" => esc_html__("Layer 2 Background Image", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "attach_image"
			),						
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_zoom_slider' ) ) {

	function like_sc_zoom_slider($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_zoom_slider', $atts, array_merge( array(

			'zoom'		=> '',
			'style'		=> 'default',
			'color'		=> 'white',
			'align'		=> 'align',
			'arrows' 	=> 'false',
			'arrow_left' 	=> '',
			'arrow_right' 	=> '',
			'bullets' 	=> 'false',
			'overlay' 	=> 'plain',			
			'images' 	=> '',
			'images2' 	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('zoom_slider', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_zoom_slider", "like_sc_zoom_slider");
}


// Adding shortcode to VC
if (!function_exists('like_vc_zoom_slider_add')) {

	function like_vc_zoom_slider_add() {
		
		vc_map( array(
			"base" => "like_sc_zoom_slider",
			"name" 	=> esc_html__("Zoom Slider", 'like-themes-plugins'),
			"description" => esc_html__("Background changing with Ken Burns effect", 'like-themes-plugins'),
			"class" => "like_sc_zoom_slider",
			"icon"	=>	likeGetPluginUrl('/shortcodes/zoom_slider/zoom_slider.png'),
			"is_container" => true,
			"js_view" => 'VcColumnView',
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_zoom_slider_params(),
				like_vc_default_params()
			),
		) );

		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_Like_Sc_zoom_slider extends WPBakeryShortCodesContainer {
		    }
		}
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_zoom_slider_add', 30);
}


