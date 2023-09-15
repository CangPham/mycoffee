<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Testimonials Shortcode
 */

$args = get_query_var('like_sc_testimonials');

$query_args = array(
	'post_type' => 'testimonials',
	'post_status' => 'publish',
	'posts_per_page' => (int)($atts['limit']),
);

$class = 'layout-'.esc_attr($atts['layout']);
if ( !empty($args['background']) ) $class .= ' bg-'.$args['background'];
if ( !empty($args['arrows']) ) $class .= ' arrows-'.$args['arrows'];
if ( !empty($args['font_weight']) ) $class .= ' font-weight-'.$args['font_weight'];

$arrow_span_left = $arrow_span_right = '';
if ( !empty($args['arrows']) AND $args['arrows'] == 'text' ) {

	$arrow_span_left = esc_html__('prev', 'like-themes-plugins');
	$arrow_span_right = esc_html__('next', 'like-themes-plugins');
}

if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
			array(
	            'taxonomy'  => 'testimonials-category',
	            'field'     => 'if', 
	            'terms'     => array(esc_attr($args['cat'])),
			)
    );
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	if ($atts['layout'] == 'cols3') $cols = 3; else $cols = 1;

	echo '<div class="swiper-container testimonials-list testimonials-slider '.esc_attr($class).'  row" data-cols="'.esc_attr($cols).'" data-autoplay="'.esc_attr($atts['autoplay']).'">
			<div class="swiper-wrapper">';

	while ( $query->have_posts() ) {

		$query->the_post();
		$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');

		echo '
		<div class="swiper-slide">
			<article class="inner">
				<div class="text">';
					if ($atts['photo'] == 'visible' ) echo the_post_thumbnail();
					if ($atts['name'] == 'visible' ) {

						echo '<div class="name">'. get_the_title() .'</div>';
						if (!empty($subheader)) echo '<div class="subheader">'. wp_kses_post($subheader) .'</div>';
					}
					echo '<p>'. get_the_content() .'</p>
					<span class="fa fa-quote-right"></span>
				</div>
			</article>
		</div>';
	}

	echo '
		    </div>
			<div class="arrows">';
				echo '<a href="#" class="arrow-left fa fa-chevron-left"></a>
				<a href="#" class="arrow-right fa fa-chevron-right"></a>';
	echo '</div>
		</div>';

	wp_reset_postdata();
}

