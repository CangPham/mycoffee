<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_countup_params' ) ) {

	function like_vc_countup_params() {

		$fields = array(

			array(
				"param_name" => "type",
				"heading" => esc_html__("Section Style", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 		=> 'default',
				),
				"type" => "dropdown"
			),	

			array(
				'type' => 'param_group',
				'param_name' => 'list',
				'heading' => esc_html__( 'CountUp Items', 'like-themes-plugins' ),
				"description" => wp_kses_data( __("Each item can will be counted up to specified number", 'like-themes-plugins') ),
				'value' => 'header',
				'params' => array(
					array(
						'param_name' => 'number',
						'heading' => esc_html__( 'Number up to', 'like-themes-plugins' ),
						'type' => 'textfield',
						'admin_label' => true,
					),
					array(
						'param_name' => 'header',
						'heading' => esc_html__( 'Header', 'like-themes-plugins' ),
						'type' => 'textfield',
						'admin_label' => true,
					),
					array(
						'param_name' => 'descr',
						'heading' => esc_html__( 'Description', 'like-themes-plugins' ),
						'type' => 'textfield',
					),					
				),
			),
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_countup' ) ) {

	function like_sc_countup($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_header', $atts, array_merge( array(

			'type'		=> '',
			'align'		=> '',			
			'icons' 	=> '',
			'list' 	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		$atts['list'] = json_decode ( urldecode( $atts['list'] ), true );

		if (!empty($atts['list'])) {

			return like_sc_output('countup', $atts, $content);
		}
			else {

			return false;
		}
	}

	if (like_vc_inited()) add_shortcode("like_sc_countup", "like_sc_countup");
}


// Adding shortcode to VC
if (!function_exists('like_vc_countup_add')) {

	function like_vc_countup_add() {
		
		vc_map( array(
			"base" => "like_sc_countup",
			"name" 	=> esc_html__("CountUp", 'like-themes-plugins'),
			"description" => esc_html__("Section with CountUp Numbers", 'like-themes-plugins'),
			"class" => "like_sc_icons",
			"icon"	=>	likeGetPluginUrl('/shortcodes/countup/countup.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_countup_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_countup_add', 30);
}


