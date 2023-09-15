<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_widget
 * @var string $after_widget
 */

echo wp_kses_post( $before_widget );
	
	if ( function_exists( 'fw_get_db_settings_option' ) ) {


		// Setting different color scheme for page
		if ( function_exists( 'FW' ) ) {

			$coffeeking_color_schemes = array();
			$coffeeking_color_schemes_ = fw_get_db_settings_option( 'items' );
			foreach ($coffeeking_color_schemes_ as $v) {

				$coffeeking_color_schemes[$v['slug']] = $v;
			}			
		}

		$coffeeking_current_scheme =  apply_filters ('coffeeking_current_scheme', array());
		if ($coffeeking_current_scheme == 'default') $coffeeking_current_scheme = 1;

		if ( !empty($coffeeking_current_scheme) AND $coffeeking_current_scheme != 'default' ) {

			if ( function_exists( 'FW' ) ) {

				$coffeeking_logo = $coffeeking_color_schemes[$coffeeking_current_scheme]['logo_footer'];
				if ( empty($coffeeking_logo) ) $coffeeking_logo = $coffeeking_color_schemes[$coffeeking_current_scheme]['logo'];
			}
		}
		
		if ( empty($coffeeking_logo) ) $coffeeking_logo = fw_get_db_settings_option( 'logo_footer' );
		if ( empty($coffeeking_logo) ) $coffeeking_logo = fw_get_db_settings_option( 'logo' );
		
		if ( ! empty( $coffeeking_logo ) ) {

			echo wp_get_attachment_image( $coffeeking_logo['attachment_id'], 'coffeeking-big' );
		}
	}


echo wp_kses_post( $after_widget ) ?>
