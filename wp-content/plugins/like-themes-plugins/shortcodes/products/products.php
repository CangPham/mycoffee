<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_products_params' ) ) {

	function like_vc_products_params() {

		$cats = likeGetProductsCats();
		$cat = array();
		foreach ($cats as $catId => $item) {

			if ( !empty($item['name']) )  {

				@$cat[$item['name']] = $catId;
			}
		}

		$fields = array(
			array(
				"param_name" => "layout",
				"heading" => esc_html__("Layout", 'like-themes-plugins'),
				"std" => "default",
				"value" => array(
					esc_html__('Slider with Filter at Top', 'like-themes-plugins') 	=> 'default',
//					esc_html__('Simple Products', 'like-themes-plugins') 	=> 'simple',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "limit",
				"heading" => esc_html__("Total Products in Category", 'like-themes-plugins'),
				"std"	=>	"8",				
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "per_slide",
				"heading" => esc_html__("Products per Slide", 'like-themes-plugins'),
				"description" => esc_html__("If empty or null - no slider will be active", 'like-themes-plugins'),
				"std"	=>	"4",
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				"param_name" => "category_filter",
				"heading" => esc_html__("Categories Filter", 'like-themes-plugins'),
				"value" => array_merge(array(esc_html__('All Parent', 'like-themes-plugins') => 0), $cat),
				"type" => "dropdown"
			),			
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_products' ) ) {

	function like_sc_products($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_services', $atts, array_merge( array(

			'ids' 			=> '',
			'limit' 		=> '',
			'layout' 		=> 'default',	
			'category_filter' 		=> '0',	
			'per_slide' 	=> '',
			'autoplay' 		=> '0',


			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		if ( like_is_wc('wc_active') ) return like_sc_output('products', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_products", "like_sc_products");
}


// Adding shortcode to VC
if (!function_exists('like_vc_products_add')) {

	function like_vc_products_add() {
		
		vc_map( array(
			"base" => "like_sc_products",
			"name" 	=> esc_html__("Products", 'like-themes-plugins'),
			"description" => esc_html__("Products Customized List", 'like-themes-plugins'),
			"class" => "like_sc_products",
			"icon"	=>	likeGetPluginUrl('/shortcodes/products/products.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_products_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_products_add', 30);
}


