<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Menu
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_menu_params' ) ) {

	function like_vc_menu_params() {

		$categories = json_decode(json_encode(likeGetMenuCats()), TRUE);

		$cat = array();
		foreach ($categories as $term_id => $item) {

			$cat[$item['name']] = $term_id;
		}

		$fields = array(	

			array(
				"param_name" => "cat",
				"heading" => esc_html__("Category", 'like-themes-plugins'),
				"value" => array_merge(array(esc_html__('--', 'like-themes-plugins') => 0), $cat),
				"type" => "dropdown"
			),				
			array(
				"param_name" => "except",
				"heading" => esc_html__("Except size", 'like-themes-plugins'),
				"value" => 70,
				"type" => "textfield"
			),			
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_menu' ) ) {

	function like_sc_menu($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_menu', $atts, array_merge( array(

			'cat'			=> '',
			'except'			=> 70,

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('menu', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_menu", "like_sc_menu");
}


// Adding shortcode to VC
if (!function_exists('like_vc_menu_add')) {

	function like_vc_menu_add() {
		
		vc_map( array(
			"base" => "like_sc_menu",
			"name" 	=> esc_html__("Menu", 'like-themes-plugins'),
			"description" => esc_html__("Menu items", 'like-themes-plugins'),
			"class" => "like_sc_menu",
			"icon"	=>	likeGetPluginUrl('/shortcodes/menu/menu.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_menu_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_menu_add', 30);
}


