<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Menu Shortcode
 */

$args = get_query_var('like_sc_menu');

$query_args = array(
	'post_type' => 'menu',
	'post_status' => 'publish',
	'posts_per_page' => 100,	
);

if ( !empty($args['ids']) ) $query_args['post__in'] = explode(',', esc_attr($args['ids']));

$cats = likeGetMenuCats();
if ( !empty($atts['cat']) ) {

	$cats = $cats[$atts['cat']]['child'];
	$query_args['post_parent'] = array(esc_attr($args['cat']));
}

if ( empty($args['except']) ) $args['except'] = 70;

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	echo '<div class="menu menu-sc">';

	echo '<ul class="cats tabs-cats menu-filter">';

	foreach ($cats as $catId => $cat) {

		echo '<li><span class="cat btn btn-xs" data-filter="'.esc_attr($catId).'">'.esc_html($cat['name']).'</span></li>';
	}
	echo '</ul>';
	echo '<div class="items">';

	while ( $query->have_posts() ):

		$query->the_post();
		$price = fw_get_db_post_option(get_The_ID(), 'price');	

		$filter_cat = '';
		$item_cats = wp_get_post_terms( get_the_ID(), 'menu-category' );
		if ( $item_cats && !is_wp_error ( $item_cats ) ) {
			foreach ($item_cats as $cat) {

				$filter_cat .= ' filter-type-'.$cat->term_id;
			}
		}

?>
		<article class="<?php echo esc_attr($filter_cat); ?>">
			<h4 class="header"><?php the_title(); ?></h4>
			<h4 class="price"><?php echo esc_html($price); ?></h4>
			<div class="clearfix"></div>
			<p><?php echo coffeeking_cut_text( get_the_content(), $args['except']); ?></p>
		</article>
<?php
	endwhile;

	echo '</div>';
	echo '</div>';

	wp_reset_postdata();
}

