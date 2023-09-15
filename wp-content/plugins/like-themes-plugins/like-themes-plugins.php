<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/*
Plugin Name: Like-Themes Plugins
Description: Requied plugins for CoffeeKing WordPress Themes
Version: 1.7.3
Author: Like-Themes
Email: support@like-themes.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/

define( 'LTX_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
define( 'LTX_PLUGIN_URL', plugins_url( "", __FILE__ ) . '/' );

register_activation_hook( __FILE__, 'ltx_plugin_activated' );

require_once dirname( __FILE__ ) . '/config.php';

require_once dirname( __FILE__ ) . '/inc/functions.php';

require_once dirname( __FILE__ ) . '/shortcodes/shortcodes.php';

require_once dirname( __FILE__ ) . '/post_types/post_types.php';

