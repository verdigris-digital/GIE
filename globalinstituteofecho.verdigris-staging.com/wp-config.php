<?php
define( 'WP_CACHE', false ); // Added by WP Rocket

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'globalinstituteofecho_ve');

/** MySQL database username */
define('DB_USER', 'globalinstituteo');

/** MySQL database password */
define('DB_PASSWORD', 'm77yYeG8');

/** MySQL hostname */
define('DB_HOST', 'mysql.globalinstituteofecho.verdigris-staging.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'L;#t+|85s1zFJ?Z!k#7)1MZhMq)d)yFs!NpB#Q3M5ZY36wUiZ:L*nuu8XHp0eHp)');
define('SECURE_AUTH_KEY',  '3ZP_"#|lj^cCb1ekN%0"IJnENd)?R@^hzY"Sfm@5cLN&d#i"Oa&2!oSBAWKb"Y!y');
define('LOGGED_IN_KEY',    '|__*E~9I(+ioJIkFZWW4l29uIG/+uPV%9w8!p5k5P1%zQB$%Z3s!pa`kLb!vD"RB');
define('NONCE_KEY',        'TYFjm5i8CaB^6%`"W9QJ`1&U+*q3X^l+BQl4U0nVXlsjeY2KSIBjc9z@?opJ^fMJ');
define('AUTH_SALT',        '?DJY)mHS1adGwP$4RE^N$ySyV/mEYP4+~QtqX/1E6BVDQMJwKwX_2v@IC?o%z2hW');
define('SECURE_AUTH_SALT', '1|@V1emiRkP0m3!z+/Ec2pUO*4rMwqaS$4GEjiEN|!mzlw59V5C;?;%W^9`UP$5L');
define('LOGGED_IN_SALT',   ';c5VL!mxBWK18P6pru0#mJ)GUk@s9p9s?(Pus:IO2/IhXGl3*@SrR3Ds2c/Be;5l');
define('NONCE_SALT',       'WE?Ysi+?/QTRoR1^fmM+`LkM:yDfW6ZfrYW$Vrb1A8VobvD(it/24s0_F4T79vGM');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_sakezn_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/**
 * Removing this could cause issues with your experience in the DreamHost panel
 */

if (isset($_SERVER['HTTP_HOST']) && preg_match("/^(.*)\.dream\.website$/", $_SERVER['HTTP_HOST'])) {
        $proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        define('WP_SITEURL', $proto . '://' . $_SERVER['HTTP_HOST']);
        define('WP_HOME',    $proto . '://' . $_SERVER['HTTP_HOST']);
        define('JETPACK_STAGING_MODE', true);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
