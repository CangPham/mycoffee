<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'like_vc_blog_params' ) ) {

	function like_vc_blog_params() {

		$categories = json_decode(json_encode(get_categories()), TRUE);
		$cat = array();
		foreach ($categories as $item) {

			$cat[$item['name']] = $item['term_id'];
		}

		$fields = array(	
			array(
				"param_name" => "ids",
				"heading" => esc_html__("Filter IDs", 'like-themes-plugins'),
				"description" => __("Enter IDs to show, separated by comma", 'like-themes-plugins'),
				"admin_label" => true,
				"type" => "textfield"
			),			
			array(
				"param_name" => "cat",
				"heading" => esc_html__("Category", 'like-themes-plugins'),
				"value" => array_merge(array(esc_html__('--', 'like-themes-plugins') => 0), $cat),
				"type" => "dropdown"
			),				
			array(
				"param_name" => "excerpt",
				"heading" => esc_html__("Custom Except Size", 'like-themes-plugins'),
				"value" => "",
				"description" => esc_html__("By default the global setting used", 'like-themes-plugins'),
				"type" => "textfield"
			),
			array(
				"param_name" => "limit",
				"heading" => esc_html__("Limit", 'like-themes-plugins'),
				"admin_label" => true,
				"value" => "3",
				"type" => "textfield"
			),				

		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_blog' ) ) {

	function like_sc_blog($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_blog', $atts, array_merge( array(

			'layout'		=> 'default',
			'date_style'		=> 'bold',
			'cat'			=> '',
			'readmore'		=> '',
			'readmore_style'		=> '',
			'thumb'			=> 'visible',
			'ids'			=> '',
			'cat'			=> '',
			'excerpt'		=> '',
			'limit'		=> 3,

			'all_posts'		=> '',

			), array_fill_keys(array_keys(like_vc_default_params()), null) )
		);

		return like_sc_output('blog', $atts, $content);
	}

	if (like_vc_inited()) add_shortcode("like_sc_blog", "like_sc_blog");
}


// Adding shortcode to VC
if (!function_exists('like_vc_blog_add')) {

	function like_vc_blog_add() {
		
		vc_map( array(
			"base" => "like_sc_blog",
			"name" 	=> esc_html__("Blog", 'like-themes-plugins'),
			"description" => esc_html__("Blog posts slider", 'like-themes-plugins'),
			"class" => "like_sc_blog",
			"icon"	=>	likeGetPluginUrl('/shortcodes/blog/blog.png'),
			"show_settings_on_create" => true,
			"category" => esc_html__('Like-Themes', 'like-themes-plugins'),
			'content_element' => true,
			"params" => array_merge(
				like_vc_blog_params(),
				like_vc_default_params()
			)
		) );
	}

	if (like_vc_inited()) add_action('vc_before_init', 'like_vc_blog_add', 30);
}


