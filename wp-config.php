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
define( 'DB_NAME', 'construction' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'u|LW}PUE=aWw$n*@7/xV-*s{{jyM20d?yuN~@y-U*%A(.S}.)e1ZsNsNpXB9/.ME' );
define( 'SECURE_AUTH_KEY',  'V7M SL~k2amCJ6b)sc0FfDaje#ss5O`_snqhcAba$dD69Fa^eHFYS*!D4QZ =B=?' );
define( 'LOGGED_IN_KEY',    'TOY@hG(!0lv-8u3 s%?ysaP$n =1f*Sdh-FCbU*=J~6mr~A2K3,>L2Gv;b=y+CVF' );
define( 'NONCE_KEY',        '{@Lb,q^M52sfo<2>#EH8rDz{;&=31I~.E(u`iYlBF<%{8Yr6 0BS%b10Z35Jw)x`' );
define( 'AUTH_SALT',        'mxoOnB,d=9M+(HYbQFr9S7|*D)-@q8$VLC5/bIefWAdl?=iqt^GEu9iO4e 0!I;x' );
define( 'SECURE_AUTH_SALT', ')?;ZpeWcSG&f.XwmAllfA&t;ZPeiN#k^4pM:3J{X80JB`[cnW&{Y.mDK|vz!Om/r' );
define( 'LOGGED_IN_SALT',   'X>D#,dw<8(j_9tFWU<9=+4=(;{H`a1k0asDkG*=9>r0C_;>b~4qu(CNq&H/[]arI' );
define( 'NONCE_SALT',       'y0Ce07cm]xvg-^gpX2:r}%8m464]Q}^*P%`D gTH&~V Ij}8c$U+KnI3^V{+9sKK' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
