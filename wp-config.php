<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbs12563718' );

/** Database username */
define( 'DB_USER', 'dbu1967626' );

/** Database password */
define( 'DB_PASSWORD', 'csci348csci348csci#$*' );

/** Database hostname */
define( 'DB_HOST', 'db5015198326.hosting-data.io' );

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
define( 'AUTH_KEY',         ']xW*_JzZwubT;HSYX%#0~pPT$y9lK)ko@v-zB<!h<rJ2->6`_Ta2_Pqz AhS,JY7' );
define( 'SECURE_AUTH_KEY',  '#?,Nk{`UJKF+Zj5 pu)DpG+Ci3%p~kcOiosTxv[j;H]1L/-MS,)< 4ByN7A+(;Qy' );
define( 'LOGGED_IN_KEY',    '$gc7YPP3xxx;oKvv5|34sy4s8zmZC).nVZdB.6%sPA>VlVwRiUNB15Ns%ncAoJ2w' );
define( 'NONCE_KEY',        'QktTUuSM2>@=g9?L`f[JkY{!;P}fZ*qxqE6GONo)$H8 E=DTUcT+kuayvEXjg|+S' );
define( 'AUTH_SALT',        'h 6[HKj%Nr?tf, CEeViVwl0[4E`!wjor*!|uqCMBQU|A[+:QH,dY7x35Soxgy}k' );
define( 'SECURE_AUTH_SALT', '5TZN(b)8GcXRn]g7e.;]Z!=T.%yDFN}L.<s3{+rn[](K:)XQb^11i?^Dy_ETA2Le' );
define( 'LOGGED_IN_SALT',   'SQ0NC{MjX4fW^_B}{e;Yn]vTGy]5o9mdp>n$j3l8}SEyyD&j|TSV6Sn}Pd)jt_a;' );
define( 'NONCE_SALT',       'vaks?xBdmyG^-3$h6U tD`J/!p?2&5v5j FB~zwRNo0Qiu3b<=qkZ8eqVay^<9i&' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
