<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Social Icons Shortcode
 */

$args = get_query_var('like_sc_social_icons');

$class = '';
if ( $atts['type'] == 'icons-list' ) $class = 'social-icons-list';
if ( $atts['type'] == 'icons-inline-large' ) $class = 'social-big';
if ( $atts['type'] == 'icons-inline-small' ) $class = 'social-small';

$class_el = '';
if ( !empty($atts['class']) ) $class .= ' '. esc_attr($atts['class']);
if ( !empty($atts['id']) ) $id = ' id="'. esc_attr($atts['id']). '"'; else $id = '';

if ($atts['style'] != 'default') $class_el .= 'icon-style-'.$atts['style'];

if ($atts['style'] != 'default') $class .= ' icon-style-'.$atts['style'];
if ($atts['weight'] != 'default') $class .= ' icon-weight-'.$atts['weight'];
if ($atts['size'] != 'default') $class .= ' icon-size-'.$atts['size'];

$target_escaped = '';
if ( !empty($atts['target']) AND $atts['target'] == 'blank' ) {

	$target_escaped = ' target="_blank" ';
}

echo '<div class="align-'. esc_attr($atts['align']) .' '. esc_attr( $class_el ) .'"><ul class="'. esc_attr($class) .'"'. $id .'>';
	foreach ( $atts['icons'] as $item ) {

		$li_class = '';
		if ($item['size'] == 'large') $li_class = 'large';

		if ( $atts['type'] == 'icons-list' ) {

			if (empty($item['text'])) $item['text'] = '';

			if ( empty( $item['href'] ) ) {

				echo '<li class="'. esc_attr($li_class) .'"><span class="'. esc_attr( $item['icon_fontawesome'] ) .'"></span><span class="head">'. esc_html( $item['header'] ) .'</span></li>';
			}
				else {

				echo '<li class="'. esc_attr($li_class) .'"><a href="'. esc_url( $item['href'] ) .'" '.$target_escaped.'><span class="'. esc_attr( $item['icon_fontawesome'] ) .'"></span><span class="head">'. esc_html( $item['header'] ) .'</span></a></li>';
			}
		}
			else {

			if (empty($item['href'])) $item['href'] = '#';

			echo '<li><a href="'. esc_url( $item['href'] ) .'" class="'. esc_attr( $item['icon_fontawesome'] ) .'" '.$target_escaped.'></a></li>';
		}	
	}
echo '</ul></div>';

