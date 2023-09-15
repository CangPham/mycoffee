<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Testimonials Shortcode
 */

$args = get_query_var('like_sc_blog');

$query_args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => $args['limit'],
);

if ( !empty($args['ids']) ) $query_args['post__in'] = explode(',', esc_attr($args['ids']));
	else
if ( !empty($args['cat']) ) $query_args['category__and'] = esc_attr($args['cat']);

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	$class = 'layout-'.esc_attr($atts['layout']);

	echo '<div class="blog blog-sc row '.esc_attr($class).'">';

	$x = 0;
	while ( $query->have_posts() ):

		$query->the_post();
		$x++;
?>
	<div class="col-lg-4 col-md-4 col-sm-6<?php if ($x == 3) echo ' hidden-sm hidden-ms hidden-xs'; ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'matchHeight' ); ?>>
			<?php if ($args['thumb'] != 'hidden'): ?>
		    <a href="<?php the_permalink(); ?>" class="photo <?php echo esc_attr('img-'.$args['thumb']) ?>">
		        <?php echo the_post_thumbnail(); ?>    
		    </a><?php endif; ?>
		    <div class="description">

		        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
		        <div class="text text-page margin-bottom-0">
					<?php
						if ( !empty( $args['excerpt']) ) {

						    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
							echo '<div class="post_content entry-content">'. coffeeking_cut_text( $excerpt, $args['excerpt'] ) .'</div>';		
						}
							else {

							add_filter( 'the_content', 'coffeeking_excerpt' );
							the_content();
						}

						if ( !empty($atts['readmore']) ) {

							if ($atts['readmore_style'] == 'btn') {

								echo '<a href="'.esc_url( get_the_permalink() ) .'" class="btn btn-xxs btn-shadow btn-second">'. esc_html( $atts['readmore'] ) .'</a>';
							}
								else {

								echo '<a href="'.esc_url( get_the_permalink() ) .'" class="more">'. esc_html( $atts['readmore'] ) .'</a>';
							}
						}
					?>
		        </div>
			    <a href="<?php esc_url( the_permalink() ); ?>" class="blog-info">
					<?php

						echo '<span class="date-day">'.get_the_date('d').'</span><span class="date-my">'.get_the_date('F').'<br>'.get_the_date('Y').'</span>';

		            	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			                echo '<ul>';
							if ( function_exists( 'pvc_post_views' ) ) {

								echo '<li class="icon-fav">
									<span class="fa fa-eye"></span> '.esc_html( strip_tags( pvc_post_views(get_the_ID(), false) ) ) .'
								</li>';
							}
		                    
		                    	echo '<li class="icon-comments"><span class="fa fa-commenting"></span> '. get_comments_number( '0', '1', '%' ) .'</li>';
			                echo '</ul>';
		                }
					?>	
			    </a>
		    </div>	   	    
		</article>
	</div>
<?php
	endwhile;

	echo '</div>';

	wp_reset_postdata();
}

