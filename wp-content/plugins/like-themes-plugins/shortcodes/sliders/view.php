<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Sliders Shortcode
 */

$args = get_query_var('like_sc_sliders');

$id = $class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$query_args = array(
	'post_type' => 'sliders',
	'post_status' => 'publish',
	'posts_per_page' => 0,	
);

if ( !empty($args['category_filter']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'sliders-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['category_filter'])),
		)
    );
}

if ( !empty($atts['arrows']) AND $atts['arrows'] == 'enabled' ) $atts['arrows'] = true; else $atts['arrows'] = '';
if ( !empty($atts['pagination']) AND $atts['pagination'] == 'enabled' ) $atts['pagination'] = true; else $atts['pagination'] = '';

$query = new WP_Query( $query_args );
if ( $query->have_posts() ) {

	echo '<div class="'.esc_attr($class).'" '.$id.'>';
	echo '	<div class="slider-sc swiper-container" data-autoplay="'.esc_attr($atts['autoplay']).'" data-arrows="'.esc_attr($atts['arrows']).'" data-pagination="'.esc_attr($atts['pagination']).'" data-effect="'.esc_attr($atts['effect']).'">';
	echo '		<div class="swiper-wrapper">';

	while ( $query->have_posts() ) {

		$query->the_post();		

		echo '<div class="swiper-slide">';
		echo '<div class="container">';
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		if ( !empty($image) ) echo '<img src="' . $image[0] . '" class="slider-image" alt="'. esc_html(get_the_title()) .'">';

		if ( !empty($atts['background']) ) {

			$background = wp_get_attachment_image_src( $atts['background'], 'full' );
			if ( !empty($background) ) echo '<img src="' . $background[0] . '" class="slider-image-top" alt="'. esc_html(get_the_title()) .'">';		
		}
		
		echo do_shortcode(get_the_content());
		echo '</div>';
		echo '</div>';

	}

	echo '		</div>';
	if ( !empty($atts['arrows']) ) echo '<div class="swiper-arrows"><a href="#" class="arrow-left"><span class="fa fa-chevron-left "></span></a><a href="#" class="arrow-right"><span class="fa fa-chevron-right"></span></a></div>';
	if ( !empty($atts['pagination']) ) echo '<div class="swiper-pagination"></div>';
	echo '	</div>';		
	echo '</div>';	

}


