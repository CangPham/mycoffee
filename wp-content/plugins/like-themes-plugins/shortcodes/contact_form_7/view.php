<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Contact_Form_7 Shortcode
 */

$args = get_query_var('like_sc_contact_form_7');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';


echo '<div class="like-contact-form-7 transform-'.esc_attr($args['transform']).' form-bg-'.esc_attr($args['form_bg']).' form-style-'.esc_attr($args['form_style']).' form-btn-'.esc_attr($args['shadow']).' form-btn-'.esc_attr($args['wide']).' form-padding-'.esc_attr($args['form_padding']).' '. esc_attr( $class ) .'"'. $id . '>';

	
	echo do_shortcode('[contact-form-7 id="'.esc_attr($args['form_id']).'"]');
	
echo '</div>';


