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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if (isset($_ENV['DATABASE'])) {
  define( 'DB_NAME', $_ENV['DATABASE'] );
}

/** Database username */
if (isset($_ENV['USERNAME'])) {
  define( 'DB_USER', $_ENV['USERNAME'] );
}

/** Database password */
if (isset($_ENV['PASSWORD'])) {
  define( 'DB_PASSWORD', $_ENV['PASSWORD'] );
}

/** Database hostname */
if (isset($_ENV['HOST'])) {
  define( 'DB_HOST', $_ENV['HOST'] );
}

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '&j*Eo.~[vK8tw3{B]xC$rC5?X:XPt})Y4+)|#[8{6L4|T6<Xl`W/gnR$m(D|+m~>');
define('SECURE_AUTH_KEY',  '#~.Qpfnkw@9?[,L!otM5)2HZ<O#|j0a(MVN7fH/g,_{u^86}*0)^%z,5gLVRpK-:');
define('LOGGED_IN_KEY',    'pClV&]0xOg2x%Xv41f|h.8=6*jI/pUIq2Cy#o!:cfT8<.-*Gk8l0T=Szc^mVNl+h');
define('NONCE_KEY',        'Q$1fU6O(Bj]Bet#ogNJnQDt$924)k%&|556#V!!TAEbH]r!NB1PIJrf}^s6tv VT');
define('AUTH_SALT',        'W*uU|_PNJf0NE(1}58t?>]btIU&mKhs-fkz_>B=8y%Z+blTA},u$=>/Ayui>n[U&');
define('SECURE_AUTH_SALT', '-~;y=4*QnIwgA8|T>]z zJF Tw1n{+>@bVC[-&~jID9]Y k~M#v]J--A~-V;+|.I');
define('LOGGED_IN_SALT',   'C,Kzc8qt4yo5QD|3rag0Qkbpl|R(t]gZo;|?*/j<Cy!U;o20y{@sOH.RK|Fw8+3:');
define('NONCE_SALT',       '[O+1czW~W(-3I%p4OTe8VMLRf:D7<yk>]C}g[|+wN@;6*iuI`yr:=Ksd=@L)&-V ');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = isset($_ENV['TABLE_PREFIX']) ? $_ENV['TABLE_PREFIX'] : 'wp_';

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


/* Multisite */
define('WP_ALLOW_MULTISITE', true);
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'wpnewsag.vercel.app' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* Add any custom values between this line and the "stop editing" line. */

if (!isset($_ENV['SKIP_MYSQL_SSL'])) {
  define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL );
}

$_SERVER['HTTPS'] = 'on';

// Inject the true host.
$headers = getallheaders();
if (isset($headers['injectHost'])) {
  $_SERVER['HTTP_HOST'] = $headers['injectHost'];
}

// Optional S3 credentials for file storage.
if (isset($_ENV['S3_KEY_ID']) && isset($_ENV['S3_ACCESS_KEY'])) {
	define( 'AS3CF_SETTINGS', serialize( array(
        'provider' => 'aws',
        'access-key-id' => $_ENV['S3_KEY_ID'],
        'secret-access-key' => $_ENV['S3_ACCESS_KEY'],
) ) );
}

// Disable file modification because the changes won't be persisted.
define('DISALLOW_FILE_EDIT', true );
define('DISALLOW_FILE_MODS', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
