<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcodes Init
 * https://codex.wordpress.org/Shortcode_API 
 */

if ( !function_exists('likethemes_sc_init') ) {

	function likethemes_sc_init() {

		$shortcodes_array = array(

			'alert'			=>	true,
			'block-icon'	=>	true,			
			'blog'			=>	true,
			'button'		=>	true,
			'contact_form_7'=>	true,				
			'countup'		=>	true,
			'empty_space'	=>	true,
			'google_maps'	=>	true,
			'header'		=>	true,
			'image-header'	=>	true,
			'menu'			=>	true,
			'products'		=>	true,
//			'services'		=>	true,			
			'social-icons'	=>	true,
			'sliders'		=>	true,
			'tariff'		=>	true,
			'testimonials'	=>	true,
			'zoom_slider'	=>	true,			
		);

		foreach ($shortcodes_array as $item => $enabled) {

			$sc_include = likeGetLocalPath( '/shortcodes/' . $item . '/' . $item . '.php' );
			if ( $enabled AND file_exists( $sc_include ) ) {

				include_once $sc_include;
			}
		}
	}
}
add_action( 'after_setup_theme', 'likethemes_sc_init', 100 );

/**
 * Default fields for all shortcodes
 */
if ( !function_exists( 'like_vc_default_params' ) ) {

	function like_vc_default_params() {

		$group = esc_html__('Attributes', 'like-themes-plugins');

		$fields = array(

			'id' => array(
				'type'			=> 'textfield',
				'heading' 		=> esc_html__("Element ID", 'like-themes-plugins'),
				'param_name' 	=> "id",
				'admin_label' 	=> true,
				'group'			=> $group,
			),
			'class' => array(
				'type'			=> 'textfield',
				'heading' 		=> esc_html__("Extra class name", 'like-themes-plugins'),
				'param_name' 	=> "class",
				'admin_label'	=> true,
				'group'			=> $group,
			),
			'css' => array(
				'param_name' 	=> 'css',
				'heading' 		=> esc_html__( 'CSS box', 'like-themes-plugins' ),
				'group' 		=> esc_html__( 'Design Options', 'like-themes-plugins' ),
				'type' 			=> 'css_editor'
			)
		);

		apply_filters( 'like_vc_default_params', $fields );

		return $fields;
	}
}

/**
 * Adding VC params
 */
if ( !function_exists( 'like_vc_add_params' ) ) {

	function like_vc_add_params() {

		global $like_cfg;

		if ( !isset($like_cfg['sections']) ) return false;

		$colors = array (

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Background Color", 'like-themes-plugins'),
				"description" => esc_html__("Set Background Color from Theme Default Colors", 'like-themes-plugins'),
				"param_name" => "bg_color_select",
				"std"	=>	"transparent",
				"group" => esc_html__('Settings', 'like-themes-plugins'),
				"value" => array_merge(
					array(
						esc_html__( "Transparent" , 'like-themes-plugins') => "transparent",
					),
					@$like_cfg['background']
				),				
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Background Overlay", 'like-themes-plugins'),
				"description" => esc_html__("Background overlay effect", 'like-themes-plugins'),
				"param_name" => "bg_overlay",
				"std"	=>	"none",
				"group" => esc_html__('Settings', 'like-themes-plugins'),
				"value" => array_merge(
					array(
						esc_html__( "None", 'like-themes-plugins' ) => "none"
					),
					@$like_cfg['overlay']
				),				
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Background Position", 'like-themes-plugins'),
				"description" => esc_html__("Background repeat will be disabled", 'like-themes-plugins'),
				"param_name" => "bg_pos",
				"std"	=>	"default",
				"group" => esc_html__('Settings', 'like-themes-plugins'),
				"value" => 
					array(
						esc_html__( "Default", 'like-themes-plugins' ) => "default",

						esc_html__( "Top-left", 'like-themes-plugins' ) => "left-top",
						esc_html__( "Top-center", 'like-themes-plugins' ) => "center-top",
						esc_html__( "Top-right", 'like-themes-plugins' ) => "right-top",						

						esc_html__( "Center-left", 'like-themes-plugins' ) => "left-center",
						esc_html__( "Center-center", 'like-themes-plugins' ) => "center-center",
						esc_html__( "Center-right", 'like-themes-plugins' ) => "right-center",						

						esc_html__( "Bottom-left", 'like-themes-plugins' ) => "left-bottom",
						esc_html__( "Bottom-center", 'like-themes-plugins' ) => "center-bottom",
						esc_html__( "Bottom-right", 'like-themes-plugins' ) => "right-bottom",
					),
			),			
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Border Box Shadow", 'like-themes-plugins'),
				"description" => esc_html__("Section with Shadow border", 'like-themes-plugins'),
				"param_name" => "border_shadow",
				"std"	=>	"none",
				"group" => esc_html__('Settings', 'like-themes-plugins'),
				"value" => array(
					esc_html__( "None", 'like-themes-plugins' ) => "none",
					esc_html__( "Shadowed", 'like-themes-plugins' ) => "shadow",
				),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Text Align", 'like-themes-plugins'),
				"description" => esc_html__("Row Text Align", 'like-themes-plugins'),
				"param_name" => "text_align",
				"std"	=>	"default",
				"group" => esc_html__('Settings', 'like-themes-plugins'),
				"value" => array(
					esc_html__( "Default", 'like-themes-plugins' ) => "default",
					esc_html__( "Center", 'like-themes-plugins' ) => "center",
					esc_html__( "Right", 'like-themes-plugins' ) => "right",
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading' 		=> esc_html__("Background Hover Parallax", 'like-themes-plugins'),
				"description" => esc_html__("Set strength", 'like-themes-plugins'),
				'std' 			=> "0",
				'param_name' 	=> "bg_parallax",
				"group" => esc_html__('Settings', 'like-themes-plugins'),
				"value" => array(
					esc_html__( "Disabled", 'like-themes-plugins' ) => "disbled",
					esc_html__( "Static Background", 'like-themes-plugins' ) => "static",
				),				
			),			
		);

		foreach ($colors as $param) {

			vc_add_param("vc_section", $param);
			vc_add_param("vc_row", $param);
			vc_add_param("vc_row_inner", $param);
			vc_add_param("vc_column", $param);
			vc_add_param("vc_column_inner", $param);
		}

		$section_class = array( 
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Like Theme Section Class", 'like-themes-plugins'),
				"description" => esc_html__("Used to style unique theme blocks", 'like-themes-plugins'),
				"param_name" => "theme_section",
				"std"	=>	"none",
				"value" => array_merge(
					array(
						esc_html__( "None", 'like-themes-plugins' ) => "none"
					),
					$like_cfg['sections']
				),
			),
		);

		foreach ($section_class as $param) {

			vc_add_param("vc_section", $param);
			vc_add_param("vc_row", $param);
			vc_add_param("vc_row_inner", $param);
			vc_add_param("vc_column", $param);
			vc_add_param("vc_column_inner", $param);		
		}	
	

		$img_class = array( 
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Shadow", 'like-themes-plugins'),
				"description" => esc_html__("Used to style unique theme blocks", 'like-themes-plugins'),
				"param_name" => "img_shadow",
				"std"	=>	"none",
				"value" => 
					array(
						esc_html__( "None", 'like-themes-plugins' ) => "none",
						esc_html__( "Single Gray", 'like-themes-plugins' ) => "single-gray",
						esc_html__( "Gradient", 'like-themes-plugins' ) => "gradient"
					),
			),
		);

		foreach ($img_class as $param) {	

			vc_add_param("vc_single_image", $param);
		}

	}

}
if ( !function_exists( 'ltx_vc_scrollreveal_params' ) ) {
	function ltx_vc_scrollreveal_params() {

		$fields = array(
			array(
				"param_name" => "scrollreveal_type",
				"heading" => esc_html__("Animation", 'lt-ext'),
				"group" => esc_html__('ScrollReveal', 'lt-ext'),					
				"std" => "disabled",
				"value" => array(
					esc_html__('Disabled', 'lt-ext') 			=> 'disabled',
					esc_html__('Zoom In', 'lt-ext') 			=> 'zoom_in',
					esc_html__('Fade In', 'lt-ext') 			=> 'fade_in',
					esc_html__('Slide From Left', 'lt-ext') 	=> 'slide_from_left',
					esc_html__('Slide From Right', 'lt-ext') 	=> 'slide_from_right',
					esc_html__('Slide From Top', 'lt-ext') 		=> 'slide_from_top',
					esc_html__('Slide From Bottom', 'lt-ext') 	=> 'slide_from_bottom',
				),
				"type" => "dropdown"
			),
			array(
				"param_name" => "scrollreveal_elements",
				"heading" => esc_html__("Elements", 'lt-ext'),
				"description" => esc_html__("Select elemets to animate", 'lt-ext'),
				"group" => esc_html__('ScrollReveal', 'lt-ext'),					
				"std" => "block",
				"value" => array(
					esc_html__('Single Block', 'lt-ext') 			=> 'block',
					esc_html__('Every Article/Item', 'lt-ext') 		=> 'items',
					esc_html__('Every Paragraph/Image/Button', 'lt-ext') 	=> 'text_el',
					esc_html__('Every List Element', 'lt-ext') 		=> 'list_el',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "scrollreveal_delay",
				"heading" => esc_html__("Delay", 'lt-ext'),
				"description" => esc_html__("Start Delay", 'lt-ext'),
				"group" => esc_html__('ScrollReveal', 'lt-ext'),					
				"std" => "200",
				"value" => array(
					esc_html__('No Delay', 'lt-ext') 		=> '0',
					esc_html__('Quick Delay (200ms)', 'lt-ext') 			=> '200',
					esc_html__('Long Delay (500ms)', 'lt-ext') 		=> '500',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "scrollreveal_duration",
				"heading" => esc_html__("Duration", 'lt-ext'),
				"description" => esc_html__("How long one element animation goes", 'lt-ext'),
				"group" => esc_html__('ScrollReveal', 'lt-ext'),					
				"std" => "300",
				"value" => array(
					esc_html__('Very Fast (150ms)', 'lt-ext') 		=> '150',
					esc_html__('Fast (300ms)', 'lt-ext') 			=> '300',
					esc_html__('Moderate (500ms)', 'lt-ext') 		=> '500',
					esc_html__('Long (800ms)', 'lt-ext') 			=> '800',
					esc_html__('Extra Long (1200ms)', 'lt-ext') 	=> '1200',
				),
				"type" => "dropdown"
			),		
			array(
				"param_name" => "scrollreveal_sequences_delay",
				"heading" => esc_html__("Sequences Delay", 'lt-ext'),
				"description" => esc_html__("Delay between elements in one section", 'lt-ext'),
				"group" => esc_html__('ScrollReveal', 'lt-ext'),					
				"std" => "100",
				"value" => array(
					esc_html__('No Delay (all at once)', 'lt-ext') 		=> '0',
					esc_html__('Quick  (100ms)', 'lt-ext') 			=> '100',
					esc_html__('Moderate (200ms)', 'lt-ext') 			=> '200',
					esc_html__('Long  (300ms)', 'lt-ext') 		=> '300',
					esc_html__('Extra Long (500ms)', 'lt-ext') 		=> '500',
				),
				"type" => "dropdown"
			),		
		);

		return $fields;
	}
}

if ( !function_exists( 'ltx_vc_add_scrollreveal' ) ) {
	function ltx_vc_add_scrollreveal() {

		$params = ltx_vc_scrollreveal_params();

		foreach ($params as $param) {

			vc_add_param("vc_section", $param);
			vc_add_param("vc_row", $param);
			vc_add_param("vc_row_inner", $param);
			vc_add_param("vc_column", $param);
			vc_add_param("vc_column_inner", $param);		
		}	
	}
}

/**
 * Adding new class names to existing VC Shortcodes
 */
if ( !function_exists( 'like_vc_add_element_class' ) ) {

	function like_vc_add_element_class($class = '', $tag, $atts) {

		if ( in_array( $tag, array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner') ) ) {

			if ( !empty($atts['bg_tone']) AND $atts['bg_tone'] != 'default' ) $class .= esc_attr( ' bg-tone-'.$atts['bg_tone'] );
			if ( !empty($atts['bg_color_select']) AND $atts['bg_color_select'] != 'transparent' ) $class .= esc_attr( ' bg-color-'.$atts['bg_color_select'] );
			if ( !empty($atts['bg_pos']) AND $atts['bg_pos'] != 'default' ) $class .= esc_attr( ' bg-pos-'.$atts['bg_pos'] );			
			if ( !empty($atts['bg_overlay']) AND $atts['bg_overlay'] != 'none' ) $class .= esc_attr( ' bg-overlay-'.$atts['bg_overlay'] );
			if ( !empty($atts['border_shadow']) AND $atts['border_shadow'] != 'none' ) $class .= esc_attr( ' border_shadow ' );

			if ( !empty($atts['theme_section']) AND $atts['theme_section'] != 'none' ) $class .= esc_attr( ' '.$atts['theme_section'] );
			if ( !empty($atts['text_align']) AND $atts['text_align'] != 'default' ) $class .= esc_attr( ' text-align-'.$atts['text_align'] );

			if ( !empty($atts['bg_parallax']) AND $atts['bg_parallax'] != 'disbled' ) $class .= esc_attr( ' bg-parallax bg-parallax-'.$atts['bg_parallax'] );

			/* Scroll Reveal */
			if ( !empty($atts['scrollreveal_type']) AND $atts['scrollreveal_type'] != 'disabled' ) {

				$class .= esc_attr( ' ltx-sr ltx-sr-effect-'.$atts['scrollreveal_type'] ).' '.
						  esc_attr( ' ltx-sr-id-'.mt_rand().' ').
						  esc_attr( ' ltx-sr-el-'.$atts['scrollreveal_elements'] ).' '.
						  esc_attr( ' ltx-sr-delay-'.$atts['scrollreveal_delay'] ).' '.
						  esc_attr( ' ltx-sr-duration-'.$atts['scrollreveal_duration'] ).' '.
						  esc_attr( ' ltx-sr-sequences-'.$atts['scrollreveal_sequences_delay'] );
			}			
		}

		if ( in_array( $tag, array('vc_single_image') ) ) {

			if ( !empty($atts['img_shadow']) AND $atts['img_shadow'] != 'none' ) $class .= esc_attr( ' img-shadow-'.$atts['img_shadow'] );
		}

		if ( in_array( $tag, array('contact-form-7') ) ) {

			if ( !empty($atts['form_style']) ) $class .= esc_attr( ' form-style-'.$atts['form_style'] );			
			if ( !empty($atts['form_padding']) ) $class .= esc_attr( ' form-padding-'.$atts['form_padding'] );

		}


		return $class;
	}
}

if ( like_vc_inited() ) {

	vc_set_default_editor_post_types(

		array('page', 'sections', 'sliders', 'team')
	);

	add_action( 'after_setup_theme', 'like_vc_add_params', 5 );
	add_action( 'after_setup_theme', 'ltx_vc_add_scrollreveal', 5 );
	
	add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,	'like_vc_add_element_class', 10, 3 );	
}

/**
 * Parsing shortcodes attributing
 */
if (!function_exists('like_sc_atts_parse')) {

	function like_sc_atts_parse($sc, $atts, $default = array()) {

		if (!empty($atts)) {
			
			foreach ($atts as &$item) {

				$item = str_replace(array('{{', '}}'), array('<span>', '</span>'), $item);
				$item = str_replace(array('{+}'), array('<span class="ul-yes fa fa-check"></span>'), $item);
				$item = str_replace(array('{-}'), array('<span class="ul-no fa fa-close"></span>'), $item);
			}
		}
		unset($item);

		if ( !empty($atts['css']) ) {

			$atts['class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $atts['class'] . ' ' . vc_shortcode_custom_css_class( $atts['css'], ' ' ), $sc, $atts);
			$atts['css'] = '';
		}

		if ( empty($atts['css']) ) {

			$atts['id'] = $sc . '_' . mt_rand();
		}
	

		$atts = like_html_decode(shortcode_atts(apply_filters('like_sc_atts', $default, $sc), $atts));

 		return apply_filters('like_sc_atts', $atts, $sc);
	}
}

/**
 * Adding shortcode output
 */
if ( !function_exists( 'like_sc_output' ) ) {

	function like_sc_output($sc, $atts, $content = null) {	

		if ( !empty($content) ) $atts['content'] = do_shortcode($content);

		set_query_var('like_sc_' . $sc, $atts);

		$path = likeGetLocalPath('/shortcodes/'.$sc.'/view.php');
		ob_start();
		if (file_exists($path)) include $path;
		$out = ob_get_contents();
		ob_end_clean();

		return $out;
	}
}

if (!function_exists('like_html_decode')) {
	function like_html_decode($string) {
		if ( is_array($string) && count($string) > 0 ) {
			foreach ($string as $key => &$value) {
				if (is_string($value)) {

					$value = htmlspecialchars_decode($value, ENT_QUOTES);
				}
			}
		}
		return $string;
	}
}




/**
 * WP Contact Form 7 Image Select Tag
 */
add_action( 'wpcf7_init', 'like_add_shortcode_car_select' );
function like_add_shortcode_car_select() {
    wpcf7_add_form_tag( 'car_select', 'like_car_select_shortcode_handler' );
}
 
function like_car_select_shortcode_handler( $tag ) {

	$out = '';

	if ( function_exists( 'fw_get_db_settings_option' ) ) {

		$cars = fw_get_db_settings_option( 'cars' );

		if ( !empty($cars) ) {

			$out = '<div class="menu-types">';
			foreach ($cars as $key => $item) {

				$class = '';
				if ( !empty($item['vip']) ) $class .= 'red';
				if ( $key == 0 ) $class .= ' active';

				$out .= '<a href="#" data-value="'. esc_html($item['text']) .'" class="car-select-'. esc_attr( $key ).' '. esc_attr( $class ).'">'. esc_html($item['text']) .'</a>';
			}
			$out .= '<input type="hidden" class="type-value" value="'. esc_html($item['text']) .'"></div>';
		}
	} 

    return $out;
}

