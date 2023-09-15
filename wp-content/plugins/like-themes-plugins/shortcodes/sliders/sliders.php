<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_sliders_params' ) ) {

	function like_vc_sliders_params() {

		$cats = likeGetSlidersCats();
		$cat = array();
		foreach ($cats as $catId => $item) {

			$cat[$item['name']] = $catId;
		}

		$fields = array(

			array(
				"param_name" => "category_filter",
				"heading" => esc_html__("Categories Filter", 'like-themes-plugins'),
				"value" => array_merge(array(esc_html__('All Parent', 'like-themes-plugins') => 0), $cat),
				"admin_label" => true,				
				"type" => "dropdown"
			),
			array(
				"param_name" => "image_status",
				"heading" => esc_html__("Featured Image Visibility", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Allways Visible', 'like-themes-plugins') 	=> 'visible',
					esc_html__('Desktop Only Visible', 'like-themes-plugins') 	=> 'desktop',
					esc_html__('Hidden', 'like-themes-plugins') 	=> 'hidden',
				),
				"type" => "dropdown"
			),				
			array(
				"param_name" => "arrows",
				"heading" => esc_html__("Arrows", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Enabled', 'like-themes-plugins') 	=> 'enabled',
					esc_html__('Disabled', 'like-themes-plugins') 	=> 'disabled',
				),
				"type" => "dropdown"
			),	
			array(
				"param_name" => "pagination",
				"heading" => esc_html__("Pagination", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Enabled', 'like-themes-plugins') 	=> 'enabled',
					esc_html__('Disabled', 'like-themes-plugins') 	=> 'disabled',
				),
				"type" => "dropdown"
			),	
			array(
				"param_name" => "effect",
				"heading" => esc_html__("Effect", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Fade', 'like-themes-plugins') 	=> 'fade',
					esc_html__('Slide', 'like-themes-plugins') 	=> 'slide',
				),
				"admin_label" => true,
				"type" => "dropdown"
			),	
			array(
				"param_name" => "autoplay",
				"heading" => esc_html__("Autoplay (ms)", 'like-themes-plugins'),
				"description" => esc_html__("0 - autoplay is disabled", 'like-themes-plugins'),
				"std"	=>	"4000",				
				"admin_label" => true,
				"type" => "textfield"
			),			
			array(
				"param_name" => "background",
				"heading" => esc_html__("Background", 'like-themes-plugins'),
				"description" => esc_html__("Will be used as background for all slides", 'like-themes-plugins'),
				"type" => "attach_image"
			),
			array(
				"param_name" => "background_status",
				"heading" => esc_html__("Common Background Visibility", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Allways Visible', 'like-themes-plugins') 	=> 'visible',
					esc_html__('Desktop Only Visible', 'like-themes-plugins') 	=> 'desktop',
					esc_html__('Hidden', 'like-themes-plugins') 	=> 'hidden',
				),
				"type" => "dropdown"
			),				
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_sliders' ) ) {

	function like_sc_sliders($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_sliders', $atts, array_merge( array(

			'arrows'			=> 'enabled',
			'pagination'		=> 'enabled',
			'effect'			=> 'flip',
			'image_status'		=> 'visible',
			'autoplay'		=> 0,
			'background'		=> '',
			'background_status'	=> 'hidden',
			'category_filter'	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);


		return like_sc_output('sliders', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_sliders", "like_sc_sliders");
}


// Adding shortcode to VC
if (!function_exists('like_vc_sliders_add')) {

	function like_vc_sliders_add() {
		
		vc_map( array(
			"base" => "like_sc_sliders",
			"name" 	=> esc_html__("Swiper Slider", 'like-themes-plugins'),
//			"description" => esc_html__("Sliders", 'like-themes-plugins'),
			"class" => "like_sc_sliders",
			"icon"	=>	likeGetPluginUrl('/shortcodes/sliders/swiper_slider.png'),
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			"params" => array_merge(
				like_vc_sliders_params(),
				like_vc_default_params()
			),
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_sliders_add', 30);
}


