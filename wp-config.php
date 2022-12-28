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
define( 'DB_NAME', 'amit' );

/** Database username */
define( 'DB_USER', '' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', '' );

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
define( 'AUTH_KEY',         'OJpjl1}*YTIU`5$T[!j~]s!>yTsvkY;HjK:7~{`+CL^um;#?EB+r;*o(1 .]b-uA' );
define( 'SECURE_AUTH_KEY',  'zZ:*r[.h`-0/D$NY5#$En#LTL*394#x{%d8hR]bsnQ u}R7-pvN4*NhC@i39}8EP' );
define( 'LOGGED_IN_KEY',    '@MtbDaM}GUGnB]d5*+M?x_ILfMfjO~!s_NWuVuwP/YBvG),q!Hvt|C*3!JvZ=8%+' );
define( 'NONCE_KEY',        'd`wV8f1z!E t8%))~.cOAJ0KFqMpIW{(,[pBIwjwku8i2B,WgHOG&VJ=!>]+wONs' );
define( 'AUTH_SALT',        'vTca*~vxd5qt%8JV]O-HVRMSAV$7(i<.J5bd[Y#1~e``S5T:O66}:x:DX9R0W7,O' );
define( 'SECURE_AUTH_SALT', 'jzv&e/inw-^_C&4QAu>AGnl%u-<,S{+Op9@ueXL<kux*1wNbbwPME!v~ou}>6|Qr' );
define( 'LOGGED_IN_SALT',   '#RBgncu8(26b(ZlPhr#q4Ex,$nFS-]YU}z6IPa-Q_vRjpsVOI?J`@l66>hObHY3/' );
define( 'NONCE_SALT',       'XDmlL1<W+}Ze=EaeKpPqrxa|}[,4@a|;iG8V;8|>zp}Sr0cnkmvctxkeKlus@Xxa' );

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
