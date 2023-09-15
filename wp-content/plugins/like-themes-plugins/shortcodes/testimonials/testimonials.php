<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_testimonials_params' ) ) {

	function like_vc_testimonials_params() {

		$cats = likeGetTestimonailsCats();
		$cat = array();
		foreach ($cats as $catId => $item) {

			$cat[$item['name']] = $catId;
		}

		$fields = array(

			array(
				"param_name" => "cat",
				"heading" => esc_html__("Category", 'like-themes-plugins'),
				"value" => array_merge(array(esc_html__('--', 'like-themes-plugins') => 0), $cat),
				"type" => "dropdown"
			),		
/*
			array(
				"param_name" => "layout",
				"heading" => esc_html__("Layout and Style", 'like-themes-plugins'),
				"std" => "col1",
				"value" => array(
					esc_html__('Full Column with Quote', 'like-themes-plugins') 		=> 'col1-quote',
				),
				"type" => "dropdown"
			),
*/			
			array(
				"param_name" => "name",
				"heading" => esc_html__("Name", 'like-themes-plugins'),
				"std" => "visible",
				"value" => array(
					esc_html__('Visible', 'like-themes-plugins') 		=> 'visible',
					esc_html__('Hidden', 'like-themes-plugins') 		=> 'hidden',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "photo",
				"heading" => esc_html__("Photo", 'like-themes-plugins'),
				"std" => "visible",
				"value" => array(
					esc_html__('Visible', 'like-themes-plugins') 		=> 'visible',
					esc_html__('Hidden', 'like-themes-plugins') 		=> 'hidden',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "limit",
				"heading" => esc_html__("Limit", 'like-themes-plugins'),
				"std" => "5",
				"type" => "textfield"
			),					
/*			
			array(
				"param_name" => "background",
				"heading" => esc_html__("Background", 'like-themes-plugins'),
				"std" => "transparent",
				"value" => array(
					esc_html__('Transparent', 'like-themes-plugins') 	=> 'transparent',
					esc_html__('White', 'like-themes-plugins') 		=> 'white',
				),
				"type" => "dropdown"
			),					
			array(
				"param_name" => "arrows",
				"heading" => esc_html__("Arrows Style", 'like-themes-plugins'),
				"std" => "gray",
				"value" => array(
					esc_html__('Gray', 'like-themes-plugins') 			=> 'gray',
					esc_html__('Transparent', 'like-themes-plugins') 	=> 'transparent',
					esc_html__('As Text', 'like-themes-plugins') 		=> 'text',
				),
				"type" => "dropdown"
			),				
			array(
				"param_name" => "font_weight",
				"heading" => esc_html__("Text style", 'like-themes-plugins'),
				"std" => "bold",
				"value" => array(
					esc_html__('Bold', 'like-themes-plugins') 			=> 'bold',
					esc_html__('Normal', 'like-themes-plugins') 		=> 'normal',
				),
				"type" => "dropdown"
			),						
*/			

			array(
				"param_name" => "autoplay",
				"heading" => esc_html__("Autoplay", 'like-themes-plugins'),
				"description" => esc_html__("Enter timeout in ms (0 - disabled)", 'like-themes-plugins'),
				"std" => "4000",
				"type" => "textfield"
			),					
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_testimonials' ) ) {

	function like_sc_testimonials($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_testimonials', $atts, array_merge( array(

			'layout'		=> '',
			'limit'			=> '',
			'cat'			=> '',
			'name'			=> '',
			'font_weight'	=> 'bold',
			'background'	=> '',
			'arrows'	=> '',
			'photo'			=> '',
			'autoplay'		=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);


		return like_sc_output('testimonials', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_testimonials", "like_sc_testimonials");
}


// Adding shortcode to VC
if (!function_exists('like_vc_testimonials_add')) {

	function like_vc_testimonials_add() {
		
		vc_map( array(
			"base" => "like_sc_testimonials",
			"name" 	=> esc_html__("Testimonials", 'like-themes-plugins'),
			"description" => esc_html__("Testimonials Slider", 'like-themes-plugins'),
			"class" => "like_sc_testimonials",
			"icon"	=>	likeGetPluginUrl('/shortcodes/testimonials/testimonials.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_testimonials_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_testimonials_add', 30);
}


