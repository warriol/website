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
define('DB_NAME', 'wilsonar_blog');

/** MySQL database username */
define('DB_USER', 'root'); // 'wilsonar_blog');

/** MySQL database password */
define('DB_PASSWORD', ''); // '(SSA52)Np0');

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
define('AUTH_KEY',         'm6cv5bvzudsizhzpse0yn4hiyqxjydr2acoegrereagques9jvdjt7walul8cimx');
define('SECURE_AUTH_KEY',  'ervndeio3tgddbojqptefskrycstwz9hwbvjuil4thqjkiiiilurdnm3jjmhh9ia');
define('LOGGED_IN_KEY',    'dje4g3sazuk0oyowdgug7pd1htlel37esvnae7j9czolrdnzus7kp27bchozig6r');
define('NONCE_KEY',        'emuc4xfb1ztilglqmhrd2kwjv8siyyetgeoahe7jgmnkzzbaehmiqvmwdkxpfvph');
define('AUTH_SALT',        'azxx3lumnitkiabo3nguybesvf79zccvzkv2j5k7ta8ryavdv80veqa4kx5bncii');
define('SECURE_AUTH_SALT', 'jsnyybny2saoww7d7slxxitonqalc2uf7erl4oy5ltypelnpeg9osmbhtomdxsft');
define('LOGGED_IN_SALT',   'lbjuehczvbpkr53txn5geg1fkntqc6prpfoestxspprgxq20dcf2do4p8isrjmhu');
define('NONCE_SALT',       'dft1huzcit51swhqhylr0hv86vpvbmnnwy8iohjevewg5dps5bunvgz8q2cqxql2');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'blog_';

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
