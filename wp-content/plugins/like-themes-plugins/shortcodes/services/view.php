<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Testimonials Shortcode
 */

$args = get_query_var('like_sc_services');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$query_args = array(
	'post_type' => 'services',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	echo '<div class="services-sc '.esc_attr($class).'  row">';

	$item_class = '';
	if ( !empty($args['per_slide']) ) {

		echo '<div class="swiper-container services-slider" data-cols="'.esc_attr($args['per_slide']).'" data-autoplay="'.esc_attr($args['autoplay']).'">
			<div class="swiper-wrapper">';		

		$item_class = ' swiper-slide';
	}		

	while ( $query->have_posts() ):

		$query->the_post();
		$link = fw_get_db_post_option(get_The_ID(), 'link');
?>
	<div class="col-lg-4 col-md-4 col-sm-6 <?php echo esc_attr($item_class); ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'matchHeight' ); ?>>
		    <a href="<?php echo esc_url( $link ); ?>" class="photo">
		        <?php
		        	echo wp_get_attachment_image( get_post_thumbnail_id( get_The_ID()) , 'coffeeking-service' );
		        ?>
		    </a>
		    <div class="description">
		        <a href="<?php echo esc_url( $link ); ?>" class="header"><h5 class="color-second"><?php the_title(); ?></h5></a>
		        <div class="cut">
		        	<?php
		        		$cut = fw_get_db_post_option(get_The_ID(), 'cut');

		        		if ( !empty($cut)) {

		        			echo esc_html( $cut );
		        		}
		        			else {

							add_filter( 'the_content', 'coffeeking_excerpt' );
							the_content( esc_html__( 'Read more &rarr;', 'like-themes-plugins' ) );
	        			}
					?>
		        </div>   
		        <a href="<?php echo esc_url( $link ); ?>" class="btn btn-xs btn-default color-hover-second"><?php echo esc_html__( 'read more', 'like-themes-plugins' ); ?> </a>    
		    </div>	   	    
		</article>
	</div>
<?php
	endwhile;

	if ( !empty($args['per_slide']) ) {

		echo '</div>
		</div>
			<div class="arrows">
				<a href="#" class="arrow-left fa fa-chevron-left"></a>
				<a href="#" class="arrow-right fa fa-chevron-right"></a>
			</div>
			';
	}			

	echo '</div>';

	wp_reset_postdata();
}

