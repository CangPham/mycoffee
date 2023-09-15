<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_contact_form_7_params' ) ) {

	function like_vc_contact_form_7_params() {

		$contact_forms = array();

		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		if ( $cf7 ) {

			foreach ( $cf7 as $cform ) {

				$contact_forms[ $cform->post_title ] = $cform->ID;
			}
		}
			else {

			$contact_forms[ esc_html__( 'No contact forms found', 'like-themes-plugins' ) ] = 0;
		}

		$fields = array(

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select contact form', 'like-themes-plugins' ),
				'param_name' => 'form_id',
				'value' => $contact_forms,
				'save_always' => true,
				'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'like-themes-plugins' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Search title', 'like-themes-plugins' ),
				'param_name' => 'title',
				'admin_label' => true,
				'description' => esc_html__( 'Enter optional title to search if no ID selected or cannot find by ID.', 'like-themes-plugins' ),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Form Scheme", 'like-themes-plugins'),
				"param_name" => "form_style",
				"std"	=>	"default",
				"value" => array(
					esc_html__( "Default Colors", 'like-themes-plugins' ) => "default",
					esc_html__( "Secondary Color", 'like-themes-plugins' ) => "secondary",
				),
			),
	
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Form Padding", 'like-themes-plugins'),
				"param_name" => "form_padding",
				"std"	=>	"default",
				"value" => array(
					esc_html__( "Default", 'like-themes-plugins' ) => "default",
					esc_html__( "No Padding", 'like-themes-plugins' ) => "none",
				),
			),				
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Form Background", 'like-themes-plugins'),
				"param_name" => "form_bg",
				"std"	=>	"default",
				"value" => array(
					esc_html__( "Default", 'like-themes-plugins' ) => "default",
					esc_html__( "Transparent", 'like-themes-plugins' ) => "transparent",
				),
			),
			array(
				"param_name" => "wide",
				"heading" => esc_html__("Buttons Wide", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Default', 'like-themes-plugins') 	=> 'default',
					esc_html__('Wide', 'like-themes-plugins') 	=> 'wide',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "shadow",
				"heading" => esc_html__("Buttons Shadow", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Disabled', 'like-themes-plugins') 	=> 'default',
					esc_html__('Visible', 'like-themes-plugins') 	=> 'shadow',
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
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_contact_form_7' ) ) {

	function like_sc_contact_form_7($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_contact_form_7', $atts, array_merge( array(

			'form_style'	=> '',
			'form_padding' 	=> '',
			'form_bg' 		=> '',
			'form_id' 		=> '',
			'wide' 			=> '',
			'shadow' 		=> '',
			'transform' 	=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('contact_form_7', $atts, $content);

	}

	if (like_vc_inited()) add_shortcode("like_sc_contact_form_7", "like_sc_contact_form_7");
}


// Adding shortcode to VC
if (!function_exists('like_vc_contact_form_7_add')) {

	function like_vc_contact_form_7_add() {
		
		vc_map( array(
			"base" => "like_sc_contact_form_7",
			"name" 	=> esc_html__("Contact Form 7 Customized", 'like-themes-plugins'),
			"description" => esc_html__("Contact Form 7 Customized Block", 'like-themes-plugins'),
			"class" => "like_sc_contact_form_7",
			"icon"	=>	"icon-wpb-contactform7",
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_contact_form_7_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_contact_form_7_add', 30);
}


