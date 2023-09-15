<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'coffeeking' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'bWl3%4hRiIV[aN%*Gi[qEDJAVn=2jWf~6hK:VZ$IkGEdsy1p*|b?n?2ZDN3S9}Ls' );
define( 'SECURE_AUTH_KEY',  'CjaxKR5S+^eG}e]:+TM+g xg@7K;F=`;Y{?5&0,*C.1ogbCg$r7pVs9.9B7-o=6&' );
define( 'LOGGED_IN_KEY',    '+cKC((g>Hx~HF+p :+xfR7Mn{^s`(zqS,Q<aTbVy|jl7{e$QLGq(!~;|&^2G;|M[' );
define( 'NONCE_KEY',        '-`$*O-Jg|zHP&x=J82qFW0xX&hE(XqiyfIjnJ&iYpV`+g,K.-rO-29)n&R 6e#^w' );
define( 'AUTH_SALT',        'qSf5<k(sEO|Lzit.C:P(2`YC^$VY7&TP@aJ|9@@@]QEowt([Rf?YL$+(ju|7]pXU' );
define( 'SECURE_AUTH_SALT', ']4 _7eM`_^Ur56xX06Avm(=$M/+(bzZ-bBD8[MzhR>rRZ+_+<mPSYkyU)91B6U1c' );
define( 'LOGGED_IN_SALT',   '5k|5`*b8!3GX5$QQD[>I#n7$2.]QD@c~>FRbR4Z./tD^|yN3&^^Bcle]_Pixz<][' );
define( 'NONCE_SALT',       'JN3QHb7FDA,[SnW9lZ9k+$bk{f{|oAsPu5V}f|&O63h_2~7whdrKzkTGOkNN3z{t' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
