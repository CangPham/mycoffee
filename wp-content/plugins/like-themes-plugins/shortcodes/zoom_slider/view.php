<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Zoom Slider Shortcode
 */

$args = get_query_var('like_sc_zoom_slider');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$class .= ' zoom-'. esc_attr($atts['zoom']);
$class .= ' zoom-color-'. esc_attr($atts['color']);
$class .= ' zoom-align-'. esc_attr($atts['align']);
$class .= ' zoom-style-'. esc_attr($atts['style']);
$class .= ' overlay-'. esc_attr($atts['overlay']);
$class .= ' bullets-'. esc_attr($atts['bullets']);


if (!empty($atts['bullets']) AND $atts['bullets'] === true ) $atts['bullets'] = true;

if ($atts['zoom'] == 'out' OR $atts['zoom'] == 'fade') {

	$init_zoom = '1.0';
}
	else {

	$init_zoom = '1.2';
}

if ( !empty( $args['images'] ) ) {

	$json = array();
	foreach ( explode(',', $args['images']) as $item ) {

		$image = like_get_attachment_img_url( $item );
		$json[] = $image[0];
	}

	$json = json_encode( $json );
}
	else {

	$json = '';
}

if ( !empty( $args['images2'] ) ) {

	$json2 = array();
	foreach ( explode(',', $args['images2']) as $item ) {

		$image = like_get_attachment_img_url( $item );
		$json2[] = $image[0];
	}

	$json2 = json_encode( $json2 );
}
	else {

	$json2 = '';
}

$allowed = wp_kses_allowed_html( 'post' ) + array(

	'a'	=>	array('href' => array(), 'data-value' => array(), 'class' => array(), 'title' => array(), 'style' => array(), 'value' => array()),
	'input'	=>	array('type' => array(), 'placeholder' => array(), 'value' => array(), 'name' => array(), 'class' => array()),
);


$content = do_shortcode( $content );
echo '<div class="slider-zoom '. esc_attr( $class ) .'"'. $id .' data-zs-prev="'. esc_attr( $args['arrow_left'] ) .'" data-zs-next="'. esc_attr( $args['arrow_right'] ) .'" data-zs-overlay="'. esc_attr( $args['overlay'] ) .'" data-zs-initzoom="'. esc_attr( $init_zoom ) .'" data-zs-speed="20000" data-zs-interval="4500" data-zs-switchSpeed="7000" data-zs-arrows="'.esc_attr($atts['arrows']).'" data-zs-bullets="'.esc_attr($atts['bullets']).'" data-zs-src=\''. filter_var( $json, FILTER_SANITIZE_SPECIAL_CHARS ) .'\' data-zs-src2=\''. filter_var( $json2, FILTER_SANITIZE_SPECIAL_CHARS ) .'\'>
	<div class="container">
		<div class="slider-inner">
			'. do_shortcode( $content ) .'
		</div>
	</div>
</div>';


