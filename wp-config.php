<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp497');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'nilesh');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '93_u2+n;d!9T 1UO`,s 7C*rCtrwhw8$0Kpw<~wM5Y7|$E&5)H8q[B!h;.I1q`a}');
define('SECURE_AUTH_KEY',  '=:g[#/NSYHD7-]??{}Xa9fmNZ9q?$N.OZq-^Ui5F(%(h-D}E<g:2GW6wF%J|{[WH');
define('LOGGED_IN_KEY',    'Z,O-LDP~[yoCyx(lu~Hj_TDu os5Ls/HvwK)97gPo?AiJ?T4O:u{&y8N>{Mk5R/a');
define('NONCE_KEY',        'ygk5:TO&Kt9;1_G5&<U!ss^j:y14ogY YG2{OI5sm!H=5s7G1~<KQ8#{`%B1sIFO');
define('AUTH_SALT',        'M4( lITu~Ltxk)Mrd-AJy/Z?x#XLg;,[lEgx1[FRj6I6_H~!K<bWa+Dg.sI)4tTN');
define('SECURE_AUTH_SALT', '-;uxhex,,;F9?.JMbn,Ise&]uWmse{K v{[#_Ck/w8XqVwjBuRfs/6gMLpQI#Ak?');
define('LOGGED_IN_SALT',   ',OuvX;TTH&?`]4H^+SSbbO*m3Au!{{EJrZ1}O{jqg!Y&[TM>:6{66dm:A-nL #o<');
define('NONCE_SALT',       'x|8$oV[l-ocEzvfS<!R)&Urk3KbXvwO?Q0C )-E/%$RV*N7v.29wxZGjkDG1tu>m');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wptest_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
