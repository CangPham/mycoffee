<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_header_params' ) ) {

	function like_vc_header_params() {

		$fields = array(

			array(
				"param_name" => "type",
				"heading" => esc_html__("Header Type", 'like-themes-plugins'),
				"std" => "h2",
				"value" => array(
					esc_html__('Heading 1', 'like-themes-plugins') => 'h1',
					esc_html__('Heading 2', 'like-themes-plugins') => 'h2',
					esc_html__('Heading 3', 'like-themes-plugins') => 'h3',
					esc_html__('Heading 4', 'like-themes-plugins') => 'h4',
					esc_html__('Heading 5', 'like-themes-plugins') => 'h5',
					esc_html__('Heading 6', 'like-themes-plugins') => 'h6'
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "subtype",
				"heading" => esc_html__("SubHeader Type", 'like-themes-plugins'),
				"std" => "h5",
				"value" => array(
					esc_html__('Heading 4', 'like-themes-plugins') => 'h4',
					esc_html__('Heading 5', 'like-themes-plugins') => 'h5',
					esc_html__('Heading 6', 'like-themes-plugins') => 'h6'
				),
				"type" => "dropdown"
			),			
			array(
				"param_name" => "header",
				"heading" => esc_html__("Header", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "subheader",
				"heading" => esc_html__("Subheader", 'like-themes-plugins'),
				"admin_label" => true,				
				"description" => esc_html__("Subheader will be shown in different color or on second line", 'like-themes-plugins'),
				"type" => "textfield"
			),
			array(
				"param_name" => "color",
				"heading" => esc_html__("Header Color", 'like-themes-plugins'),
				"description" => esc_html__("Heading color can depend on styling.", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Main Color', 'like-themes-plugins') 	=> 'main',
					esc_html__('Second Color', 'like-themes-plugins') 	=> 'second',
					esc_html__('White', 'like-themes-plugins') 		=> 'white',					
					esc_html__('Black', 'like-themes-plugins') 		=> 'black',
					esc_html__('Gray', 'like-themes-plugins') 			=> 'gray',
					esc_html__('Gradient', 'like-themes-plugins') 		=> 'gradient',
				),
				"type" => "dropdown"
			),	
			array(
				"param_name" => "subcolor",
				"heading" => esc_html__("SubHeader Color", 'like-themes-plugins'),
				"description" => esc_html__("Heading color can depend on styling.", 'like-themes-plugins'),
				"std" => "main",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Main Color', 'like-themes-plugins') 	=> 'main',
					esc_html__('Second Color', 'like-themes-plugins') 	=> 'second',
					esc_html__('White', 'like-themes-plugins') 		=> 'white',					
					esc_html__('Black', 'like-themes-plugins') 		=> 'black',
					esc_html__('Gray', 'like-themes-plugins') 		=> 'gray',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "size",
				"heading" => esc_html__("Header Size", 'like-themes-plugins'),
				"description" => esc_html__("Larger Heading can be used for transforming H2 into H1 sized tag etc.", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Smaller', 'like-themes-plugins') 	=> 'small',
					esc_html__('Larger', 'like-themes-plugins') 	=> 'large',
					esc_html__('Extra Larger', 'like-themes-plugins') 	=> 'xl',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "style",
				"heading" => esc_html__("Header Special", 'like-themes-plugins'),
				"description" => esc_html__("Special styling", 'like-themes-plugins'),
				"std" => "head-subheader",
				"admin_label" => true,				
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 					=> 'head-subheader',
					esc_html__('Simple Header', 'like-themes-plugins') 					=> 'default',
					esc_html__('Inline', 'like-themes-plugins') 					=> 'inline',
					esc_html__('Line on right side', 'like-themes-plugins')		=> 'line-right',
					esc_html__('Shadow', 'like-themes-plugins') 					=> 'shadow',
					/*
					esc_html__('Multi-line', 'like-themes-plugins') 				=> 'multiline',
					esc_html__('Inline, subheader Larger', 'like-themes-plugins') 	=> 'spanned',
					esc_html__('Subheader as top background at th top', 'like-themes-plugins') 	=> 'subheader-bg',
					esc_html__('Rounded background', 'like-themes-plugins') 		=> 'header-rounded',
					*/
					esc_html__('Subheader as inset background', 'like-themes-plugins') => 'subheader-bg-inner',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "transform",
				"heading" => esc_html__("Transform", 'like-themes-plugins'),
				"std" => "header-up",
				"admin_label" => true,				
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 							=> 'default',
					esc_html__('Header Uppercase', 'like-themes-plugins') 					=> 'header-up',
					esc_html__('Header and Subheader Uppercase', 'like-themes-plugins') 	=> 'all-up',
				),
				"type" => "dropdown"
			),				
			array(
				"param_name" => "align",
				"heading" => esc_html__("Alignment", 'like-themes-plugins'),
				"description" => esc_html__("Horizontal Aligment of Header", 'like-themes-plugins'),
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
				"param_name" => "text",
				"heading" => esc_html__("Text", 'like-themes-plugins'),
				"description" => esc_html__("Text Under Header", 'like-themes-plugins'),
				"admin_label" => true,					
				"type" => "textarea"
			),		
			array(
				"param_name" => "text_bg",
				"heading" => esc_html__("Text as background", 'like-themes-plugins'),
				"description" => esc_html__("Text will be used as watermark background", 'like-themes-plugins'),
				"type" => "checkbox"
			),		

			array(
				'param_name' => 'icon_fontawesome',
				'heading' => esc_html__( 'Icon Fontawesome', 'like-themes-plugins' ),
				'description' => esc_html__("Icon will be showed before header or as background", 'like-themes-plugins'),				
				'type' => 'iconpicker',
				'admin_label' => true,
				'group' => esc_html__( 'Icon', 'like-themes-plugins' ),
				'value' => '',
				'settings' => array(
					'emptyIcon' => true,
					'type' => 'fontawesome'

				),
			),
			array(
				"param_name" => "image",
				"heading" => esc_html__("Icon Image", 'like-themes-plugins'),
				'group' => esc_html__( 'Icon', 'like-themes-plugins' ),
				"type" => "attach_image"
			),			
			array(
				"param_name" => "icon_type",
				"heading" => esc_html__("Icon Type", 'like-themes-plugins'),
				"std" => "hidden",
				'group' => esc_html__( 'Icon', 'like-themes-plugins' ),
				"value" => array(
					esc_html__('Hidden', 'like-themes-plugins') => 'hidden',					
					esc_html__('Before Header', 'like-themes-plugins') => 'default',
					esc_html__('After Header', 'like-themes-plugins') => 'after',
					esc_html__('As Background', 'like-themes-plugins') => 'bg',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "size_px",
				"heading" => esc_html__("Custom Size Desktop", 'like-themes-plugins'),
				'group' => esc_html__( 'Custom', 'like-themes-plugins' ),
				"type" => "textfield"
			),
			array(
				"param_name" => "size_px_mobile",
				"heading" => esc_html__("Custom Size Mobile", 'like-themes-plugins'),
				'group' => esc_html__( 'Custom', 'like-themes-plugins' ),
				"type" => "textfield"
			),			
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Yes theme default font family?', 'like-themes-plugins' ),
				'param_name' => 'use_theme_fonts',
				'std'	=>	'yes',
				'value' => array( esc_html__( 'Yes', 'like-themes-plugins' ) => 'yes' ),
				'description' => esc_html__( 'Yes font family from the theme.', 'like-themes-plugins' ),
				'group' => esc_html__( 'Custom', 'like-themes-plugins' ),
				'dependency' => array(
					'element' => 'use_custom_fonts',
					'value' => array( 'yes' ),
				),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts',
				'value' => '',
				// Not recommended, this will override 'settings'. 'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900 bold italic:900:italic'),
				'settings' => array(
					'fields' => array(
						// Default font style. Name:weight:style, example: "800 bold regular:800:normal"
						'font_family_description' => esc_html__( 'Select font family.', 'like-themes-plugins' ),
						'font_style_description' => esc_html__( 'Select font styling.', 'like-themes-plugins' ),
					),
				),
				'group' => esc_html__( 'Custom', 'like-themes-plugins' ),
				'dependency' => array(
					'element' => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),

		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_header' ) ) {

	function like_sc_header($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_header', $atts, array_merge( array(

			'size'			=> 'default',
			'bg'			=> 'light',
			'type'			=> 'h2',
			'subtype'			=> 'h4',
			'header' 		=> '',
			'subheader' 	=> '',
			'size_px' 	=> '',
			'size_px_mobile' 	=> '',
			'transform' 	=> 'header-up',
			'use_theme_fonts' 	=> '',
			'google_fonts' 		=> '',
			'style' 	=> 'head-subheader',
			'color' 	=> '',
			'subcolor' 	=> '',					
			'text' 		=> '',
			'text_bg' 		=> '',
			'image'		=>	'',
			'icon_fontawesome' 	=> '',
			'icon_type' 		=> 'default',
			'align' 	=> 'left',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		if ( !empty($atts['header']) ) {

			return like_sc_output('header', $atts, $content);
		}
			else {

			return false;
		}
	}

	if (like_vc_inited()) add_shortcode("like_sc_header", "like_sc_header");
}


// Adding shortcode to VC
if (!function_exists('like_vc_header_add')) {

	function like_vc_header_add() {
		
		vc_map( array(
			"base" => "like_sc_header",
			"name" 	=> esc_html__("Header", 'like-themes-plugins'),
			"description" => esc_html__("Custom Header", 'like-themes-plugins'),
			"class" => "like_sc_header",
			"icon"	=>	likeGetPluginUrl('/shortcodes/header/header.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_header_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_header_add', 30);
}


