<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );

/**
  * Custom post types
  */
function like_add_custom_post_types() {

	$cpt = array(

		'testimonials' 	=> true,
		'sliders' 		=> true,
		'sections' 		=> true,
		'events' 		=> true,
		'menu' 			=> true,
		'gallery' 		=> true,
		'team' 			=> true,
		'faq' 			=> true,
	);

	foreach ($cpt as $item => $enabled) {

		$cpt_include = likeGetLocalPath( '/post_types/' . $item . '/' . $item . '.php' );
		if ( $enabled AND file_exists( $cpt_include ) ) {

			include_once $cpt_include;
		}
	}	
}
add_action( 'after_setup_theme', 'like_add_custom_post_types' );


function like_rewrite_flush() {
    like_add_custom_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'like_rewrite_flush' );

