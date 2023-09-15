<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Button Shortcode
 */

$args = get_query_var('like_sc_button');

$attrAlign = $attr = '';
if ( !empty($args['size']) AND $args['size'] != 'default' ) $attr .= ' btn-'.$args['size'];
if ( !empty($args['color']) ) $attr .= ' btn-'.$args['color'];
if ( !empty($args['transform']) ) { $attr .= ' transform-'.$args['transform']; }
if ( !empty($args['color_text']) ) $attr .= ' color-text-'.$args['color_text'];
if ( !empty($args['color_hover']) ) $attr .= ' color-hover-'.$args['color_hover'];

if ( !empty($args['shadow']) AND $args['shadow'] != 'default' ) $attr .= ' btn-'.$args['shadow'];
if ( !empty($args['wide']) AND $args['wide'] != 'default') $attr .= ' btn-'.$args['wide'];

if ( !empty($args['align']) AND $args['align'] != 'default' ) { $attrAlign .= ' align-'.$args['align']; $attr .= ' align-'.$args['align']; }
if ( !empty($args['inline']) AND $args['inline'] != 'default' ) { $attrAlign .= ' btn-wrap-'.$args['inline']; }

if ( !empty($args['class']) ) $attr .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$target = '';
if ( $args['target'] == 'blank') {

	$target = ' target="_blank" ';
}

echo '<div class="btn-wrap'. esc_attr( $attrAlign ) .'"><a href="'. esc_url($args['href']) .'" '.$target.' class="btn '. esc_attr( $attr ) .'"'.$id.'>';
	echo esc_html( $args['header'] );
echo '</a></div>';

