<?php
define( 'WP_CACHE', true );


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
define( 'DB_NAME', 'eseoghe_wp398' );

/** Database username */
define( 'DB_USER', 'eseoghe_wp398' );

/** Database password */
define( 'DB_PASSWORD', '[!(YrypgzS)s10!9' );

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
define( 'AUTH_KEY',         'mpozp99titqo65lcxsjof2demkpwujvxkm8cugjx086japousshowdenqlvdf9is' );
define( 'SECURE_AUTH_KEY',  'emks7bhcqmwo7mmjyvnecu4cozmcp6stim7rrzvcqrxejr06g6piiwp9hfvoflri' );
define( 'LOGGED_IN_KEY',    'c1fj1yasv0do7esc3enqc3rw8vi9v8zuc5zeln1xhxcciytdd9fz3amhurzdjrun' );
define( 'NONCE_KEY',        'yh1ckehxg3n4q8bzzqobfyl3tw78hmbzgribwvflkbw5aqsngzodzedig7getz8a' );
define( 'AUTH_SALT',        'yhrpklu4mrmhmzarv6ap3xy7qp3ipz68mpazfkdgnfo9xtaeeiu8krezgy7ltdhl' );
define( 'SECURE_AUTH_SALT', 'xce5u4s8yttzjieyi1qwd7rqq7l7mnmrkwhl7j6uj1mod9ykb3f2hscxwimc4ute' );
define( 'LOGGED_IN_SALT',   '3dbz69ccwfklvcctusg1pn6qkedyvpdddgpjy1vphondqrs7ghuilbnz5kxpktgr' );
define( 'NONCE_SALT',       'ohnzo3fi1kr6u4jdo5tkubktvcvqol0fexwneyw40zbml0ssvmmodo2pbhwrfxlr' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'vph_';

// define('WP_MEMORY_LIMIT', '256M');
define('WP_DEBUG', false);
// define('WP_DEBUG_LOG', true);
// define('WP_DEBUG_DISPLAY', false);


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
// define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
