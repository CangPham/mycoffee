<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_block_icon_params' ) ) {

	function like_vc_block_icon_params() {

		$fields = array(

			array(
				"param_name" => "type",
				"heading" => esc_html__("List type", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Icon to Left, Header and Text to Right', 'like-themes-plugins') 	=> 'icon-ht-right',
					esc_html__('Icon to Right, Header and Text to Left', 'like-themes-plugins') 	=> 'icon-ht-left',
					esc_html__('Icon to Left, Header Right', 'like-themes-plugins') 			=> 'icon-h-right',
					esc_html__('Icon to Top', 'like-themes-plugins') 							=> 'icon-top',
				),
				"type" => "dropdown"
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
				"type" => "dropdown"
			),						
			array(
				"param_name" => "rounded",
				"heading" => esc_html__("Background Type", 'like-themes-plugins'),
				"std" => "i-square",
				"value" => array(
					esc_html__('Transparent', 'like-themes-plugins') 		=> 'i-transparent',
					esc_html__('Square', 'like-themes-plugins') 		=> 'i-square',
					esc_html__('Circle', 'like-themes-plugins') 		=> 'i-circle',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "bg",
				"heading" => esc_html__("Background", 'like-themes-plugins'),
				"std" => "bg-main",
				"value" => array(
					esc_html__('Main Color', 'like-themes-plugins') 		=> 'bg-main',
					esc_html__('Second Color', 'like-themes-plugins') 		=> 'bg-second',
					esc_html__('Gray', 'like-themes-plugins') 				=> 'bg-gray',
					esc_html__('Transparent', 'like-themes-plugins')		=> 'bg-transparent',
				),
				"type" => "dropdown"
			),	

			array(
				"param_name" => "layout",
				"heading" => esc_html__("Layout", 'like-themes-plugins'),
				"std" => "layout-cols3",
				"value" => array(
					esc_html__('Six Columns', 'like-themes-plugins') 		=> 'layout-cols6',
					esc_html__('Four Columns', 'like-themes-plugins') 		=> 'layout-cols4',
					esc_html__('Three Columns', 'like-themes-plugins') 	=> 'layout-cols3',
					esc_html__('One Column', 'like-themes-plugins') 		=> 'layout-col1',
					esc_html__('Inline', 'like-themes-plugins') 			=> 'layout-inline',
				),
				"type" => "dropdown"
			),	
			array(
				"param_name" => "align",
				"heading" => esc_html__("Alignment", 'like-themes-plugins'),
				"description" => esc_html__("Horizontal Aligment", 'like-themes-plugins'),
				"std" => "center",
				"value" => array(
					esc_html__('Left', 'like-themes-plugins') => 'left',
					esc_html__('Center', 'like-themes-plugins') => 'center',
					esc_html__('Right', 'like-themes-plugins') => 'right'
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
						'param_name' => 'descr',
						'heading' => esc_html__( 'Description', 'like-themes-plugins' ),
						'type' => 'textarea',
						'admin_label' => false,
					),					
/*					
					array(
						"param_name" => "fill",
						"heading" => esc_html__("Background", 'like-themes-plugins'),
						"std" => "default",
						"value" => array(
							esc_html__('Filled', 'like-themes-plugins') 		=> 'default',
							esc_html__('Transparent', 'like-themes-plugins') 		=> 'large',
						),
						"type" => "dropdown"
					),			
					
*/													
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
					array(
						"param_name" => "icon_image",
						"heading" => esc_html__("Or Icon Image", 'like-themes-plugins'),
						"type" => "attach_image"
					),						
					array(
						'param_name' => 'icon_text',
						'heading' => esc_html__( 'Or Icon Text', 'like-themes-plugins' ),
						'type' => 'textfield',
						'description' => esc_html__( 'Text Header as Icon', 'like-themes-plugins' ),
					),										
				),
			),
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_block_icon' ) ) {

	function like_sc_block_icon($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_block_icon', $atts, array_merge( array(

			'type'			=>  '',
			'header_type'	=>  '4',
			'rounded'		=>  'i-square',
			'bg'			=>	'',
			'align'			=>	'center',
			'layout'		=>	'layout-cols3',
			'icons' 		=>  '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		$atts['icons'] = json_decode ( urldecode( $atts['icons'] ), true );

		if (!empty($atts['icons'])) {

			return like_sc_output('block-icon', $atts, $content);
		}
			else {

			return false;
		}
	}

	if (like_vc_inited()) add_shortcode("like_sc_block_icon", "like_sc_block_icon");
}


// Adding shortcode to VC
if (!function_exists('like_vc_block_icon_add')) {

	function like_vc_block_icon_add() {
		
		vc_map( array(
			"base" => "like_sc_block_icon",
			"name" 	=> esc_html__("Block with Icons", 'like-themes-plugins'),
			"description" => esc_html__("Text Blocks with Icons", 'like-themes-plugins'),
			"class" => "like_sc_block_icon",
			"icon"	=>	likeGetPluginUrl('/shortcodes/block-icon/block-icon.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_block_icon_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_block_icon_add', 30);
}


