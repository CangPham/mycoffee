<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode
 */

$args = get_query_var('like_sc_block_icon');

if ( !empty($atts['header_type']) ) $tag = 'h'.$atts['header_type']; else $tag = 'h4';

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

if ($atts['layout'] == 'header') {

	echo '<a href="'.esc_url($atts['href']).'" class="image-header ' . esc_attr( $class ) .'" '.$id.'>';

		if ( empty($atts['header'])) {

			$item['header'] = '';
		}

		if ( !empty($atts['image']) ) {

			$image = like_get_attachment_img_url( $atts['image'] );
			$image_tag = '<div class="photo"><img src="' . esc_url($image[0]) . '" class="image" alt="'.esc_attr($atts['header']).'"></div>';
		}

		echo $image_tag . '<'. esc_attr($tag) .' class="header"> ' . esc_html( $atts['header'] )  .  ' </'. esc_attr($tag) .'> ';

	echo '</a>';
}
	else
if ($atts['layout'] == 'scroll') {

	$image = like_get_attachment_img_url( $atts['image'] );
	if ( !empty($atts['height']) ) $height = 'max-height: '.like_vc_get_metric($atts['height']).'; '; else $height = '';

	echo '<a href="'.esc_url($atts['href']).'" target="_blank" class="image-preview ' . esc_attr( $class ) .'" '.$id.' style="'. esc_attr($height) .'">';
	echo '<img src="'.esc_url($image[0]).'" />';
	echo '</a>';
}
	else
if ($atts['layout'] == 'video') {

	$image = like_get_attachment_img_url( $atts['image'] );

	echo '<a href="'.esc_url($atts['href']).'" class="swipebox image-video ' . esc_attr( $class ) .'" '.$id.'>';
	echo '<img src="' . esc_url($image[0]) . '" class="image" alt="'.esc_attr($atts['header']).'">';
	echo '</a>';
}

