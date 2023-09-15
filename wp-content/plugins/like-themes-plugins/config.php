<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * TaxiPark Config
 */

$like_cfg = array(

	'path'	=> plugin_dir_path(__DIR__),
	'base' 	=> plugin_basename(__DIR__),
	'url'	=> plugin_dir_url(__FILE__),

	'like_sections'	=> array(),
);


add_action( 'after_setup_theme', 'like_vc_config', 4 );
function like_vc_config() {

	global $like_cfg;

    $value = array();
    $value = apply_filters( 'like_get_vc_config', $value );

    $like_cfg = array_merge($like_cfg, $value);

    return $value;
}


add_action( 'plugins_loaded', 'like_load_plugin_textdomain' );
function like_load_plugin_textdomain() {
	load_plugin_textdomain( 'like-themes-plugins', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

add_action( 'widgets_init', 'ltx_action_widgets_init' );
if ( !function_exists('ltx_action_widgets_init')) {

	function ltx_action_widgets_init() {

		$paths = array();

		/**
		 * Widgets list
		 */
		$parent_widgets = array(
			'icons',
			'logo',
		);
		$parent_path = LTX_PLUGIN_DIR . 'widgets' ;

		/**
		 * Generating widgets include array
		 */
		$items = array();
		if ( !empty( $parent_widgets ) ) {

			foreach ( $parent_widgets as $item ) {

				$items[] = array( 'path' => $parent_path . '/' . $item , 'name' => $item );
			}
		}

		$included_widgets = array();
		if ( !empty( $items ) ) {

			foreach ( $items as $item ) {

				if ( isset( $included_widgets[ $item['name'] ] ) ) {
					// this happens when a widget in child theme wants to overwrite the widget from parent theme
					continue;
				} else {
					$included_widgets[ $item['name'] ] = true;
				}

				include_once ( $item['path'] . '/class-widget-' . $item['name'] . '.php' );

				$widget_class = 'coffeeking_Widget_' . ltx_widget_classname( $item['name'] );
				if ( class_exists( $widget_class ) ) {

					register_widget( $widget_class );
				}
			}
		}
	}

	function ltx_widget_classname( $widget_name ) {
		
		$class_name = explode( '-', $widget_name );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}	
}
