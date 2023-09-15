<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Social Icons Shortcode
 */

$args = get_query_var('like_sc_countup');

echo '<div class="row">';
	foreach ( $atts['list'] as $k => $item ) {

		echo '
			<div class="col-md-3 col-sm-6 col-ms-6 center-flex">
				<div class=" countUp-item matchHeight">
					<span class="header-xlg  color-main countUp" id="'.esc_attr( $args['id'].'-'.$k ).'">'.esc_html($item['number']).'</span>
					<h4 class="white">'.esc_html($item['header']).'</h4>
					<div class="descr white">'.esc_html($item['descr']).'</div>
				</div>
			</div>';
	}
echo '</div>';

