<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * LikeThemes Plugins Functions
 */

include LTX_PLUGIN_DIR . 'inc/ltx-dashboard.php';
include LTX_PLUGIN_DIR . 'inc/update.php';
//include LTX_PLUGIN_DIR . 'inc/font-awesome-5.php';

// Get Local Path of include file
function likeGetLocalPath($file) {

	global $like_cfg;

	return $like_cfg['path'].$like_cfg['base'].$file;
}

// Get Plugin Url
function likeGetPluginUrl($file) {

	global $like_cfg;

	return $like_cfg['url'].$file;
}

// Get Visual Composer plugin status
if ( !function_exists( 'like_vc_inited' ) ) {

	function like_vc_inited() {
		
		return class_exists('Vc_Manager');
	}
}

// Generate img url
if (!function_exists('like_get_attachment_img_url')) {
	function like_get_attachment_img_url( $img, $size = 'full' ) {
		if ($img > 0) {

			return wp_get_attachment_image_src($img, 'full');
		}
	}
}

if (!function_exists('likeGetProductsCats')) {
	function likeGetProductsCats() {

		$taxonomy     = 'product_cat';
		$orderby      = 'name';  
		$show_count   = 0;
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';  
		$empty        = 0;

		$args = array(
		     'taxonomy'     => $taxonomy,
		     'orderby'      => $orderby,
		     'show_count'   => $show_count,
		     'pad_counts'   => $pad_counts,
		     'hierarchical' => $hierarchical,
		     'title_li'     => $title,
		     'hide_empty'   => $empty
		);

		$defaultCat = get_option( 'default_product_cat' );

		$cats = array();
		$all_categories = get_categories( $args );
		foreach ($all_categories as $cat) {

//			if ($cat->term_id == $defaultCat) continue;

			if ($cat->category_parent == 0) {

			    $cats[$cat->term_id] = array(

			    	'href' => get_term_link($cat->slug, 'product_cat'),
			    	'name' => $cat->name,
			    	'id' => $cat->term_id,
			    );
			}
				else {

			    $cats[$cat->category_parent]['child'][$cat->term_id] = array(

			    	'href' => get_term_link($cat->slug, 'product_cat'),
			    	'name' => $cat->name,
			    	'parent' => $cat->category_parent,
			    	'id' => $cat->term_id,
			    );		    
			}
		}	

		return $cats;
	}
}

if (!function_exists('likeGetSlidersCats')) {
	function likeGetSlidersCats() {

		$taxonomy     = 'sliders-category';
		$orderby      = 'name';  
		$show_count   = 0;
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';  
		$empty        = 0;

		$args = array(
		     'taxonomy'     => $taxonomy,
		     'orderby'      => $orderby,
		     'show_count'   => $show_count,
		     'pad_counts'   => $pad_counts,
		     'hierarchical' => $hierarchical,
		     'title_li'     => $title,
		     'hide_empty'   => $empty
		);

		$cats = array();
		$all_categories = get_terms( $args );
		foreach ($all_categories as $cat) {
			if ($cat->category_parent == 0) {
			    $category_id = $cat->term_id;       
			    $cats[$cat->term_id] = array(

			    	'href' => get_term_link($cat->slug, 'sliders-category'),
			    	'name' => $cat->name,
			    );
			}       
		}	

		return $cats;
	}
}

if (!function_exists('likeGetMenuCats')) {
	function likeGetMenuCats() {

		$taxonomy     = 'menu-category';
		$orderby      = 'name';  
		$show_count   = 0;
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';  
		$empty        = 0;

		$args = array(
		     'taxonomy'     => $taxonomy,
		     'orderby'      => $orderby,
		     'show_count'   => $show_count,
		     'pad_counts'   => $pad_counts,
		     'hierarchical' => $hierarchical,
		     'title_li'     => $title,
		     'hide_empty'   => $empty
		);

		$cats = array();
		$all_categories = get_terms( $args );
		foreach ($all_categories as $cat) {

			if ($cat->parent == 0) {

			    $cats[$cat->term_id]['href'] = get_term_link($cat->slug, 'menu-category');
			    $cats[$cat->term_id]['name'] = $cat->name;
			}
				else {

			    $cats[$cat->parent]['child'][$cat->term_id] = array(

			    	'href' => get_term_link($cat->slug, 'menu-category'),
			    	'name' => $cat->name,
			    );		    
			}   
		}	

		return $cats;
	}
}
if (!function_exists('likeGetTestimonailsCats')) {
	function likeGetTestimonailsCats() {

		$taxonomy     = 'testimonials-category';
		$orderby      = 'name';  
		$show_count   = 0;
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';  
		$empty        = 0;

		$args = array(
		     'taxonomy'     => $taxonomy,
		     'orderby'      => $orderby,
		     'show_count'   => $show_count,
		     'pad_counts'   => $pad_counts,
		     'hierarchical' => $hierarchical,
		     'title_li'     => $title,
		     'hide_empty'   => $empty
		);

		$cats = array();
		$all_categories = get_terms( $args );
		foreach ($all_categories as $cat) {
			if ($cat->category_parent == 0) {
			    $category_id = $cat->term_id;       
			    $cats[$cat->term_id] = array(

			    	'href' => get_term_link($cat->slug, 'testimonials-category'),
			    	'name' => $cat->name,
			    );
			}       
		}	

		return $cats;
	}
}


if ( !function_exists( 'like_is_wc' ) ) {
	/**
	 * Return true|false is woocommerce conditions.
	 *
	 * @param string $tag
	 * @param string|array $attr
	 *
	 * @return bool
	 */
	function like_is_wc($tag, $attr='') {
		if( !class_exists( 'woocommerce' ) ) return false;
		switch ($tag) {
			case 'wc_active':
		        return true;
			
		    case 'woocommerce':
		        if( function_exists( 'is_woocommerce' ) && is_woocommerce() ) return true;
				break;
		    case 'shop':
		        if( function_exists( 'is_shop' ) && is_shop() ) return true;
				break;
			case 'product_category':
		        if( function_exists( 'is_product_category' ) && is_product_category($attr) ) return true;
				break;
		    case 'product_tag':
		        if( function_exists( 'is_product_tag' ) && is_product_tag($attr) ) return true;
				break;
		    case 'product':
		    	if( function_exists( 'is_product' ) && is_product() ) return true;
				break;
		    case 'cart':
		        if( function_exists( 'is_cart' ) && is_cart() ) return true;
				break;
		    case 'checkout':
		        if( function_exists( 'is_checkout' ) && is_checkout() ) return true;
				break;
		    case 'account_page':
		        if( function_exists( 'is_account_page' ) && is_account_page() ) return true;
				break;
		    case 'wc_endpoint_url':
		        if( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url($attr) ) return true;
				break;
		    case 'ajax':
		        if( function_exists( 'is_ajax' ) && is_ajax() ) return true;
				break;
		}

		return false;
	}
}

function like_vc_get_metric($item) {

	$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
	// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
	$regexr = preg_match( $pattern, $item, $matches );
	$value = isset( $matches[1] ) ? (float) $matches[1] : (float) $item;
	$unit = isset( $matches[2] ) ? $matches[2] : 'px';

	return $value . $unit;
}



/**
 * Walker to add Navbar menu icons
 */
function coffeeking_walker_nav_menu_add_icons( $items, $args ) {

	global $user_ID;

	if ($args->theme_location != 'primary') return $items;

	if ( function_exists( 'FW' ) ) {

		$icons = fw_get_db_settings_option( 'social-icons' );
		$basket_icon = fw_get_db_settings_option( 'basket-icon' );

		if ( !empty($icons) ) {

			foreach ($icons as $item) {
/*
				$item['type'];
				$item['icon-type'];
				$item['visibility'];
*/				

				$li_class = ' hidden-md hidden-sm hidden-ms hidden-xs';
/*				
				if ( $item['visible'] == 'hidden' ) continue;
					else
				if ( $item['visible'] == 'mobile' ) $li_class .= ' hidden-md hidden-lg hidden-xl ';
					else
				if ( $item['visible'] == 'desktop' ) $li_class .= ' hidden-xs hidden-ms hidden-sm ';

*/
				$custom_icon = '';
				if ( $item['icon-type']['icon_radio'] == 'fa' AND !empty($item['icon-type']['fa']['icon_fa']) ) {

					$custom_icon = $item['icon-type']['fa']['icon_fa'];
				}

				if ( $item['type']['type_radio'] == 'search') {

					if ( empty( $custom_icon ) ) $custom_icon = 'fa-search';

					$items .= '
						<li class="ltx-fa-icon ltx-nav-search  '.esc_attr($li_class).'">
							<div id="top-search" class="top-search">
								<a href="#" id="top-search-ico" class="top-search-ico fa '. esc_attr($custom_icon) .'" aria-hidden="true"></a>
								<input placeholder="'.esc_html__( 'Search', 'like-themes-plugins' ).'" value="" type="text">
							</div>
						</li>';
				}

				if ( $item['type']['type_radio'] == 'basket' AND coffeeking_is_wc('wc_active')) {

					if ( empty( $custom_icon ) ) $custom_icon = 'fa-shopping-cart';

					$items .= '
						<li class="ltx-fa-icon ltx-nav-cart '.esc_attr($li_class).'">
							<div class="cart-navbar">
								<a href="'. wc_get_cart_url() .'" class="shop_table cart" title="'. esc_html__( 'View your shopping cart', 'like-themes-plugins' ). '">';

									if ( $item['type']['basket']['count'] == 'show' ) {

										$items .= '<span class="cart-contents header-cart-count count">'.WC()->cart->get_cart_contents_count().'</span>';
									}

									$items .= '<i class="fa '. esc_attr($custom_icon) .'" aria-hidden="true"></i>
								</a>
							</div>
						</li>';
				}

				if ( $item['type']['type_radio'] == 'profile' ) {

					if ( empty( $custom_icon ) ) $custom_icon = 'fa-user';

					$items .= '
						<li class="ltx-fa-icon ltx-nav-profile  menu-item-has-children '.esc_attr($li_class).'">
							<a href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ) .'" class="fa '. esc_attr($custom_icon) .'">
							</a>';

							$userInfo = get_userdata($user_ID);
							if ( $item['type']['profile']['logout'] == 'show' AND !empty($userInfo) ) {

								$items .= '<ul class="sub-menu">
									<li class="menu-item"><a href="'. wp_logout_url() .'"><span>'. esc_html__( 'Logout', 'like-themes-plugins' ). '</span></a></li>
								</ul>';
							}

						$items .= '</li>';
				}

				if ( $item['type']['type_radio'] == 'social' AND !empty($custom_icon)) {

					$items .= '
						<li class="ltx-fa-icon ltx-nav-social '.esc_attr($li_class).'">
							<a href="'. esc_url( $item['type']['social']['href'] ) .'" class="fa '. esc_attr($custom_icon) .'" target="_blank">
							</a>
						</li>';
				}	
			}
		}

		/* Code duplicate for older ltx-plugin support basket icon only  */
		if ( empty($icons) AND $basket_icon == 'visible') {

			$items .= '
				<li class="ltx-fa-icon ltx-nav-cart menu-item menu-item-type-custom menu-item-object-custom hidden-md hidden-sm hidden-ms hidden-xs">
					<div class="cart-navbar">
						<a href="'. wc_get_cart_url() .'" class="shop_table cart" title="'. esc_html__( 'View your shopping cart', 'like-themes-plugins' ). '">';
							$items .= '<span class="cart-contents header-cart-count count">'.WC()->cart->get_cart_contents_count().'</span>';
							$items .= '<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</a>
					</div>
				</li>';
		}
	}

	return $items;
}

$ltx_menus = get_nav_menu_locations();
add_filter( 'wp_nav_menu_items', 'coffeeking_walker_nav_menu_add_icons', 10, 2 );

/**
* Returns ID of top-level parent category, or current category if you are viewing a top-level
*
* @param    string      $catid      Category ID to be checked
* @return   string      $catParent  ID of top-level parent category
*/
if ( !function_exists('smart_category_top_parent_id')) {
	
	function smart_category_top_parent_id ($catid) {

		$catParent = null;

	    while ($catid) {

	        $cat = get_term( $catid, 'product_cat' );

	        if ( !empty( $cat->parent ) ) {

		        $catid = $cat->parent;
		        $catParent = $catid;
			}
				else {

				$catid = null;
			}
	    }
	    return $catParent;
	}
}

