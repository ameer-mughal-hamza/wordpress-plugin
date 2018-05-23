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
define('DB_NAME', 'demo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '?)8%[O>@RCNVm^<&aw~ kR&g(!8eC;1@fD6TxW</l@qG_I!^?Kku#&O?Yg+o[>_E');
define('SECURE_AUTH_KEY',  ';Fhx8tEpNtTy58L}=yKsqI?jY~[5lg]uXa7CNDA}jpZ~P:$L%b{B?{N/h!lLU{$C');
define('LOGGED_IN_KEY',    'X,+BjK8B/?U_L+v:d7k3<r`wg,U)P:0b>A}#[VoU7!Q5U6ExsYochgIg=ki4f1h=');
define('NONCE_KEY',        'f{MWELRs^;_e9byJyf0j/{# KF4>pf3]ua]2lq?SNP.bW+8i{3<V5Mj _y^NRRP{');
define('AUTH_SALT',        'XD>-r=/xLjR$6!cvw_4lyvw2gtb+$1{w1^w+JCTFKV|%T%D0~}|R&U1b=ApISeL@');
define('SECURE_AUTH_SALT', '4i?;(L nZH<;6l]O)dts#Nn$sD/5]a,LRwidpDq|,C,{P%pLU1v58&fBuUx&k`zk');
define('LOGGED_IN_SALT',   '`6zP]tfTrM<a7{P.W>COQhLk~H%A3Vn^HRcN~qODnus[|}=eg%-zstgdt/Wfm0U@');
define('NONCE_SALT',       'gE~&+QcrHs/_hZ4l^}9Z?#y#H}B{wypYbTHmrhQX50tck!>!i4qe$FoK(M)%d99)');

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
