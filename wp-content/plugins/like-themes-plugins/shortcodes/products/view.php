<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Products Shortcode
 */

$args = get_query_var('like_sc_products');

$query_args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'post_per_page' => 100,
);

if ( $args['layout'] == 'default') {

	$cats = likeGetProductsCats();
	if ( !empty($atts['category_filter']) AND !empty($cats[$atts['category_filter']]['child']) ) {

		$cats = $cats[$atts['category_filter']]['child'];

		$post_ids = array();

		if ( !empty($cats) )
	    foreach ( $cats as $cid => $cat ) {

	        $post_ids = array_merge( $post_ids, get_posts( array( 
		            'posts_per_page' => 16,
		            'post_type' => 'product',
		            'fields' => 'ids',
		            'tax_query' => array( array( 'taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $cid, ))
		            )
	        	)
	        );

	    	$term_children = get_term_children( $cid, 'product_cat' );
	        if ( !empty($term_children) ) {

	        	foreach ( $term_children as $tid => $term ) {

			        $post_ids = array_merge( $post_ids, get_posts( array( 
				            'posts_per_page' => 16,
				            'post_type' => 'product',
				            'fields' => 'ids',
				            'tax_query' => array( array( 'taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $term, ))
				            )
			        	)
			        );
	        	}
	        }
	    }

	    $query_args['post__in'] = $post_ids;
	}
		else {

		$cats_hide = true;
		unset($cats);

		if ( !empty($atts['category_filter']) ){

			$query_args['tax_query'] = 	array(
					array(
			            'taxonomy'  => 'product_cat',
			            'field'     => 'if', 
			            'terms'     => $atts['category_filter'],
					),
				    array(
				        'taxonomy' => 'product_visibility',
				        'field'    => 'name',
				        'terms'    => 'exclude-from-catalog',
				        'operator' => 'NOT IN',
				    ),			
		    );

//			$query_args['post__in'] = $atts['category_filter'];

//			print_r($query_args);
		}
	}


    if ( !function_exists('ltx_pre_get_posts')) {

		function ltx_pre_get_posts( $query ) {

			$query->set( 'posts_per_page', -1 );
		}
	
		add_action( 'pre_get_posts', 'ltx_pre_get_posts' );    
    }
}
	else
if ( $args['layout'] == 'simple' ) {

	$query_args['tax_query'] = 	array(
			array(
	            'taxonomy'  => 'product_cat',
	            'field'     => 'if', 
	            'terms'     => array(esc_attr($args['category_filter'])),
			)
    );

	$query_args['posts_per_page'] = (int)($args['limit']);

}

$query = new WP_Query( $query_args );

$currency = get_woocommerce_currency_symbol();

if ( $query->have_posts() ) {


	if ( $args['layout'] == 'default') {

		echo '<div class="woocommerce"><div class="products products-sc products-sc-default">';
/*
		if ( !empty($cats_hide) ) {

			echo '<ul class="cats tabs-cats slider-filter" style="display: none;">';
		}
			else {

			echo '<ul class="cats tabs-cats slider-filter">';
		}
*/
		if ( !empty($cats) ) {

			echo '<ul class="cats tabs-cats slider-filter">';

			foreach ($cats as $cat) {

				echo '<li><span class="cat" data-filter="'.esc_attr($cat['id']).'">'.esc_html($cat['name']).'</span></li>';
			}
			echo '</ul>';
		}

		echo '<div class="items">
			<div class="row">
		';

		$item_class = '';
		if ( !empty($args['per_slide']) ) {

			echo '<div class="swiper-container slider-filter-container products-slider" data-cols="'.esc_attr($args['per_slide']).'" data-autoplay="0">
				<div class="swiper-wrapper">';		

			$item_class = ' swiper-slide';
		}		

		$filter_limit = array();

		while ( $query->have_posts() ):

			$query->the_post();
		?>

		<?php

		$cont = false;

		$filter_cat = '';
		$product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
		if ( $product_cats && !is_wp_error ( $product_cats ) ) {


			foreach ($product_cats as $cat) {

				$parentCat = smart_category_top_parent_id($cat->term_id);
				if ( !empty($filter_limit[$cat->term_id]) AND (@$filter_limit[$cat->term_id] > 4 OR @$filter_limit[$parentCat] > 4) ) {

					$cont = true;
				}
			}

			foreach ($product_cats as $cat) {

					$parentCat = smart_category_top_parent_id($cat->term_id);
					$filter_cat .= ' filter-type-'.$cat->term_id;
					if ( !empty($filter_limit[$cat->term_id]) ) {

						@$filter_limit[$cat->term_id]++;
					}

					if ( $parentCat != $cat->term_id ) {

						$filter_cat .= ' filter-type-'.$parentCat;
						if ( !empty($filter_limit[$cat->term_id]) ) {

							@$filter_limit[$parentCat]++;
						}
					}
//				}
			}
		}	

		if ( !empty($cont)) {

			//echo $parentCat;
			continue;
		}

		?>	
		<?php
			$product = $item = wc_get_product( get_the_ID() );
		?>
		<div class="col-lg-3 col-md-4 col-sm-6 <?php echo esc_attr($item_class); ?> filter-item item <?php echo esc_attr($filter_cat); ?>">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'matchHeight' ); ?>>
				<?php if ( $item->is_on_sale() ) echo '<span class="onsale">'.esc_html__('Sale', 'like-themes-plugins').'</span>'; ?>
			    <a href="<?php the_permalink(); ?>" class="photo">
			        <?php
				        echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'shop_catalog', false  );
			        ?>  
			    </a>
			    <div class="description">
			        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h5><?php the_title(); ?></h5></a>
			        <?php
					    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
						echo '<div class="post_content entry-content">'. coffeeking_cut_text( $excerpt, 50 ) .'</div>';			


		        		echo '<h4 class="price color-main">'.$item->get_price_html().'</h4>';


						/**
						 * Getting correct WC button
						 */
						ob_start();
						do_action( 'woocommerce_after_shop_loop_item' );
						$button = str_replace(array('</div>', 'btn-xs btn-transparent color-main', 'btn', 'add_to_cart_button'), array('', 'btn-main', 'btn btn-xs', 'add_to_cart_button btn-xs button'), ob_get_clean());
						echo ($button);

/*
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
							sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s button btn btn-default color-hover-black btn-xs transform-lowercase add_to_cart_button"><i class="fa fa-shopping-cart" aria-hidden="true"></i>%s</a>',
								esc_url( $product->add_to_cart_url() ),
								esc_attr( isset( $quantity ) ? $quantity : 1 ),
								esc_attr( $product->get_id() ),
								esc_attr( $product->get_sku() ),
								$product->is_type( 'simple' ) ? 'ajax_add_to_cart' : '',
								esc_html( $product->add_to_cart_text() )
							),
						$product );
*/						
			        ?>  
			    </div>	   	    
			</article>
		</div>

		<?php
		endwhile;

		if ( !empty($args['per_slide']) ) {

			echo '</div>
				<div class="arrows">
					<a href="#" class="arrow-left fa fa-chevron-left"></a>
					<a href="#" class="arrow-right fa fa-chevron-right"></a>
				</div>			
			</div>

				';
		}			

		echo '
			</div>
		</div>
		</div>
		</div>';
	}
		else 
	if ( $args['layout'] == 'simple') {

		if ( $query->post_count == 2) $col_class = 'col-lg-6 col-md-6 col-sm-6 '; else $col_class = 'col-lg-4 col-md-4 col-sm-6 ';

		$item_class = '';
		echo '<div class="woocommerce"><div class="products products-sc products-sc-simple row posts-'.esc_attr($query->post_count).'">';

			while ( $query->have_posts() ):

				$query->the_post();

				if ( isset($single_cat->term_id) ) $current_cat = $single_cat->term_id;
				if ( empty($current_cat) ) $current_cat = '';

			?>

			<div class="<?php echo esc_attr($col_class); ?> item filter-type-<?php echo esc_attr($current_cat); ?> <?php echo esc_attr($item_class); ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'matchHeight' ); ?>>
				    <a href="<?php the_permalink(); ?>" class="photo">
				        <?php

					        echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'full', false  );
				        	
				        ?>
				    </a>
				    <div class="description">
				        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h5><?php the_title(); ?></h5></a>
				        <?php
				        	$item = wc_get_product( get_the_ID() );

			        		echo '<h4 class="price color-main">'.$item->get_price_html().'</h4>';

			        		echo '<div class="row btns">
			        				<div class="col-lg-6">
			        				<a rel="nofollow" href="?add-to-cart='.get_the_ID().'" data-quantity="1" data-product_id="'.get_the_ID().'" class="btn btn-default btn-xs color-text-black product_type_simple add_to_cart_button ajax_add_to_cart ">'.esc_html__("Add to cart", 'like-themes-plugins').'</a>
			        				</div>
			        				<div class="col-lg-6">
			        				<a rel="nofollow" href="'.esc_url( get_the_permalink() ).'" class="btn color-text-white color-hover-black btn-second btn-xs">'.esc_html__("Conditions", 'like-themes-plugins').'</a>
			        				</div>
			        			</div>';
				        ?>  
				    </div>	   	    
				</article>
			</div>
		<?php
		endwhile;

		echo '</div></div>';		
	}
	

	wp_reset_postdata();
}

remove_action( 'pre_get_posts', 'ltx_pre_get_posts' );    


