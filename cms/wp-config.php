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

if (stristr($_SERVER['SERVER_NAME'], 'magnolia')) {

	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'wp_freedomnow');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'root');

} else if (stristr($_SERVER['SERVER_NAME'], 'punkbit')) {

	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'wp_freedomnow');

	/** MySQL database username */
	define('DB_USER', 'wp_freedomnow');

	/** MySQL database password */
	define('DB_PASSWORD', '');

}

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
define('AUTH_KEY',         '#,Rg-K<$,kXXxq7F=9]datBBPWl9r=Y9O>DsEw%(C<pn]Fv2x+::3^7|sS^W|cJA');
define('SECURE_AUTH_KEY',  'ejQ)(#A0asV`>rga{~F0Hx[s&5!;mMP>?57-VFadgaFPjJMHQneucX5]>o+$K@2R');
define('LOGGED_IN_KEY',    'UcAw+zK+_Iy*`@hA@?| nyB71n@eXi{q@L`/FmKR{T)CdhppRj^1o#Xy-Na;a-^v');
define('NONCE_KEY',        'DZwWZnAy3x$w}7OG=:&*;Mz?d|j%H_}xI-EeN6-/K!]@s|(BI+87waJo1hW27i(Q');
define('AUTH_SALT',        'XvCj%r#$FofU]|S.H~;C9.UEpL<0]}2-b&pgq!;9<3o8Ix;l5y)&Bnj,gtkUxQ3X');
define('SECURE_AUTH_SALT', 'CD;G?7sWx5;Vu%CD|P^RZ}|KuwxX2o21&>8](lA]LK;s.nT^9O|(af!][]-F1,Mr');
define('LOGGED_IN_SALT',   'ZhJaxQ+t&O1piah8b~y)6SO!@ev?29AkEp:es]Dc&/@hUuOXqH,i].(POn.Gki%U');
define('NONCE_SALT',       '4Nzy?CT>Ytv{k6Ys4]4K|~-bNv!B|tj{4JWq4~4&sKt[?oh$Emtac~,Ez+u$6AdR');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
