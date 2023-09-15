<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Button
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_button_params' ) ) {

	function like_vc_button_params() {

		$fields = array(

			array(
				"param_name" => "header",
				"heading" => esc_html__("Header", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "href",
				"heading" => esc_html__("URL", 'like-themes-plugins'),
				"type" => "textfield"
			),
			array(
				"param_name" => "size",
				"heading" => esc_html__("Size", 'like-themes-plugins'),
				"std" => "h2",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') => 'default',
					esc_html__('Large', 'like-themes-plugins') => 'lg',
					esc_html__('Small', 'like-themes-plugins') => 'xs',
					esc_html__('Extra Small', 'like-themes-plugins') => 'xxs',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "align",
				"heading" => esc_html__("Alignment", 'like-themes-plugins'),
				"description" => esc_html__("Horizontal Aligment", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') => 'default',
					esc_html__('Left', 'like-themes-plugins') => 'left',
					esc_html__('Center', 'like-themes-plugins') => 'center',
					esc_html__('Right', 'like-themes-plugins') => 'right'
				),
				"type" => "dropdown"
			),			
			array(
				"param_name" => "color",
				"heading" => esc_html__("Color style", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Main Color Filled', 'like-themes-plugins') 	=> 'default',
					esc_html__('Main Color Bordered', 'like-themes-plugins') 	=> 'default-bordered',					
					esc_html__('Secondary Color Filled', 'like-themes-plugins') 	=> 'second',
					esc_html__('Secondary Color Bordered', 'like-themes-plugins') 	=> 'second-bordered',			
					esc_html__('White color Filled', 'like-themes-plugins') 	=> 'white-filled',
					esc_html__('White color Bordered', 'like-themes-plugins') 	=> 'white-bordered',
					esc_html__('Black color Filled', 'like-themes-plugins') 	=> 'black-filled',
					esc_html__('Black color Bordered', 'like-themes-plugins') 	=> 'black-bordered',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "color_text",
				"heading" => esc_html__("Text Color", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('White', 'like-themes-plugins') 	=> 'white',
					esc_html__('Black', 'like-themes-plugins') 	=> 'black',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "color_hover",
				"heading" => esc_html__("Hover Background Color", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Main', 'like-themes-plugins') 		=> 'main',
					esc_html__('Second', 'like-themes-plugins') 	=> 'second',
					esc_html__('White', 'like-themes-plugins') 	=> 'white',
					esc_html__('Black', 'like-themes-plugins') 	=> 'black',
				),
				"type" => "dropdown"
			),			
			array(
				"param_name" => "wide",
				"heading" => esc_html__("Wide", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Wide', 'like-themes-plugins') 	=> 'wide',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "shadow",
				"heading" => esc_html__("Shadow", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Disabled', 'like-themes-plugins') 	=> 'default',
					esc_html__('Blured', 'like-themes-plugins') 	=> 'shadow',
					esc_html__('Plain white', 'like-themes-plugins') 	=> 'plain-white',
					esc_html__('Plain black', 'like-themes-plugins') 	=> 'plain-black',
				),
				"type" => "dropdown"
			),		

			array(
				"param_name" => "transform",
				"heading" => esc_html__("Text transform", 'like-themes-plugins'),
				"std" => "default",
				"admin_label" => true,				
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 		=> 'default',
					esc_html__('Uppercase', 'like-themes-plugins') 	=> 'uppercase',
					esc_html__('Lowercase', 'like-themes-plugins') 	=> 'lowercase',
				),
				"type" => "dropdown"
			),			

			array(
				"param_name" => "inline",
				"heading" => esc_html__("Position", 'like-themes-plugins'),
				"std" => "default",
				"admin_label" => true,				
				"value" => array(
					esc_html__('One in row', 'like-themes-plugins') 		=> 'default',
					esc_html__('Inline buttons', 'like-themes-plugins') 	=> 'inline',
				),
				"type" => "dropdown"
			),				
			array(
				"param_name" => "target",
				"heading" => esc_html__("Target", 'like-themes-plugins'),
				"std" => "self",
			
				"value" => array(
					esc_html__('Current window', 'like-themes-plugins') 		=> 'self',
					esc_html__('New window', 'like-themes-plugins') 	=> 'blank',
				),
				"type" => "dropdown"
			),								

		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_button' ) ) {

	function like_sc_button($atts, $content = null) {	
		
		$atts = like_sc_atts_parse('like_sc_button', $atts, array_merge( array(

			'size'		=> 'default',
			'color'		=> 'default',
			'color_text'		=> 'default',
			'color_hover'		=> 'default',
			'inline'	=> 'default',			
			'transform'	=> 'default',			
			'wide'		=> 'default',			
			'shadow'	=> 'default',			
			'header'	=> 'Button',
			'href' 		=> '#',
			'align' 	=> 'default',
			'target' 		=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('button', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_button", "like_sc_button");
}


// Adding shortcode to VC
if (!function_exists('like_vc_button_add')) {

	function like_vc_button_add() {
		
		vc_map( array(
			"base" => "like_sc_button",
			"name" 	=> esc_html__("Button", 'like-themes-plugins'),
			"description" => esc_html__("Custom Button", 'like-themes-plugins'),
			"class" => "like_sc_button",
			"icon"	=>	likeGetPluginUrl('/shortcodes/button/button.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_button_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_button_add', 30);
}


