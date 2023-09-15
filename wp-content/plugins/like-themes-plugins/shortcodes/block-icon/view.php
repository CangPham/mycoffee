<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Block Icons Shortcode
 */

$args = get_query_var('like_sc_block_icon');

if ( !empty($atts['header_type']) ) $tag = 'h'.$atts['header_type']; else $tag = 'h5';

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

if ($atts['layout'] == 'layout-cols4' OR $atts['layout'] == 'layout-cols6') $atts['layout'] .= ' row';


echo '<ul class="block-icon ' . esc_attr( $class ) .' ' . esc_attr($atts['type']).' align-' . esc_attr($atts['align']) . ' ' . esc_attr($atts['rounded']) . ' ' . esc_attr($atts['layout']) .'" '.$id.'>';
	foreach ( $atts['icons'] as $item ) {

		$li_class = '';

		if ($atts['layout'] == 'layout-cols4 row') $li_class .= ' col-lg-3 col-md-4 col-sm-6 col-ms-6 col-xs-12 matchHeight';
		if ($atts['layout'] == 'layout-cols6 row') $li_class .= ' col-md-2 col-sm-4 col-xs-6 matchHeight ';

		if ( empty($item['header'])) {

			$item['header'] = '';
		}

		if (!empty($item['icon_fontawesome'])) {

			$a_class = $item['icon_fontawesome'];
		}
			else
		if (!empty($item['icon_image'])) {

			$a_class = 'icon-image';
			$li_class .=  ' icon-image';
		}		
			else {

			$a_class = 'icon-text';
		}

		if ( !empty($atts['bg']) ) {

			$a_class .= ' '.esc_attr($atts['bg']);
		}

		$href_tag1 = $href_tag2 = '';
		$div_tag1 = $div_tag2 = '';
		$image_tag = '';

		if ($atts['type'] == 'icon-ht-right' OR $atts['type'] == 'icon-ht-left') {

			$div_tag1 = '<div class="block-right">';
			$div_tag2 = '</div>';
		}

		if (!empty($item['href'])) {

			$href_tag1 = '<a href="'. esc_url( $item['href'] ) .'" class="'. esc_attr( $a_class ) .'">';
			$href_tag2 = '</a>';
		}
			else {

			if (empty($item['icon_text'])) $item['icon_text'] = '';

			$href_tag1 = '<span class="'. esc_attr( $a_class ) . '">' . esc_html( $item['icon_text'] );
			$href_tag2 = '</span>';
		}

		if ( !empty($item['icon_image']) ) {

			$image = like_get_attachment_img_url( $item['icon_image'] );
			$image_tag = '<img src="' . $image[0] . '" class="icon-image" alt="'.esc_attr($item['header']).'">';
		}

		if ( !empty($item['header']) ) {

			$item['header'] = ' <'. esc_attr($tag) .'> ' . esc_html( $item['header'] )  .  ' </'. esc_attr($tag) .'> ';
		}

		if ( empty($item['descr'])) $item['descr'] = '';

		if ( !empty($li_class) ) $li_class = ' class="'.esc_attr($li_class).'"';

		echo '<li'.$li_class.'>' . $href_tag1 . $image_tag . $href_tag2 . $div_tag1 . $item['header'] . '<div class="descr">'. esc_html( $item['descr'] ) . $div_tag2 . '</div></li>';
	}

echo '</ul>';

