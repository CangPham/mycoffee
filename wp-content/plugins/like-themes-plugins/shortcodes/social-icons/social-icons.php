<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_social_icons_params' ) ) {

	function like_vc_social_icons_params() {

		$fields = array(

			array(
				"param_name" => "type",
				"heading" => esc_html__("List type", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('List with icons and text on right side', 'like-themes-plugins') 		=> 'icons-list',
					esc_html__('Large icons inline list', 'like-themes-plugins') 	=> 'icons-inline-large',
					esc_html__('Small icons inline list', 'like-themes-plugins') 	=> 'icons-inline-small',
				),
				"type" => "dropdown"
			),	
			array(
				"param_name" => "style",
				"heading" => esc_html__("Icon style", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Transparent', 'like-themes-plugins') 	=> 'default',
					esc_html__('Square', 'like-themes-plugins') 		=> 'square',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "weight",
				"heading" => esc_html__("Font Weight", 'like-themes-plugins'),
				"std" => "bold",
				"value" => array(
					esc_html__('Normal', 'like-themes-plugins') 	=> 'default',
					esc_html__('Bold', 'like-themes-plugins') 		=> 'bold',
				),
				"type" => "dropdown"
			),					
			array(
				"param_name" => "size",
				"heading" => esc_html__("Font Size", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Small', 'like-themes-plugins')		=> 'small',
				),
				"type" => "dropdown"
			),					
			array(
				"param_name" => "align",
				"heading" => esc_html__("Item align", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Left', 'like-themes-plugins') 		=> 'default',
					esc_html__('Center', 'like-themes-plugins') 		=> 'center',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "target",
				"heading" => esc_html__("Target", 'like-themes-plugins'),
				"std" => "self",
				"value" => array(
					esc_html__('Self', 'like-themes-plugins') 	=> 'self',
					esc_html__('New Tab', 'like-themes-plugins') 		=> 'blank',
				),
				"type" => "dropdown"
			),					
			array(
				'type' => 'param_group',
				'param_name' => 'icons',
				'heading' => esc_html__( 'Icons', 'like-themes-plugins' ),
				"description" => wp_kses_data( __("Select icons, specify title and/or description for each item", 'like-themes-plugins') ),
				'value' => urlencode( json_encode( array(
					array(
						'header' => '',
						'size' => 'default',
						'href' => '',
						'icon_fontawesome' => 'empty',
					),
				) ) ),
				'params' => array(
					array(
						'param_name' => 'header',
						'heading' => esc_html__( 'Header', 'like-themes-plugins' ),
						'type' => 'textfield',
						'admin_label' => true,
					),
					array(
						"param_name" => "size",
						"heading" => esc_html__("Icon size", 'like-themes-plugins'),
						"std" => "default",
						"value" => array(
							esc_html__('Default', 'like-themes-plugins') 		=> 'default',
							esc_html__('Large', 'like-themes-plugins') 		=> 'large',
						),
						"type" => "dropdown"
					),
						
					array(
						'param_name' => 'href',
						'heading' => esc_html__( 'Href', 'like-themes-plugins' ),
						'type' => 'textfield',
						'description' => esc_html__( 'URL to list item', 'like-themes-plugins' ),
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
				),
			),
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_social_icons' ) ) {

	function like_sc_social_icons($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_header', $atts, array_merge( array(

			'type'		=> '',
			'align'		=> '',			
			'style'		=> '',			
			'weight'	=> 'bold',			
			'target'	=> '',			
			'size'		=> '',			
			'icons' 	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		$atts['icons'] = json_decode ( urldecode( $atts['icons'] ), true );

		if (!empty($atts['icons'])) {

			return like_sc_output('social-icons', $atts, $content);
		}
			else {

			return false;
		}
	}

	if (like_vc_inited()) add_shortcode("like_sc_social_icons", "like_sc_social_icons");
}


// Adding shortcode to VC
if (!function_exists('like_vc_social_icons_add')) {

	function like_vc_social_icons_add() {
		
		vc_map( array(
			"base" => "like_sc_social_icons",
			"name" 	=> esc_html__("Social Icons", 'like-themes-plugins'),
			"description" => esc_html__("Social Icons", 'like-themes-plugins'),
			"class" => "like_sc_icons",
			"icon"	=>	likeGetPluginUrl('/shortcodes/social-icons/social-icons.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_social_icons_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_social_icons_add', 30);
}


