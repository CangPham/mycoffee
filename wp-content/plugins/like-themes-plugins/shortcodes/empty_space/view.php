<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * ES Shortcode
 */

$class = "";
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$height_lg = like_vc_get_metric($atts['height_lg']);
if ( $atts['height_sm'] === '' ) $height_sm = $height_lg; else $height_sm = like_vc_get_metric($atts['height_sm']);
if ( $atts['height_xs'] === '' ) $height_xs = $height_sm; else $height_xs = like_vc_get_metric($atts['height_xs']);

echo '<div class="es-resp'.esc_attr($class).'"'.$id.'>';
echo '	<div class="hidden-sm hidden-ms hidden-xs" style="height: '.esc_attr($height_lg).';"></div>';
echo '	<div class="hidden-xl hidden-lg hidden-md hidden-xs" style="height: '.esc_attr($height_sm).';"></div>';
echo '	<div class="visible-xs" style="height: '.esc_attr($height_xs).';"></div>';
echo '</div>';'.esc_attr($height_lg).';

