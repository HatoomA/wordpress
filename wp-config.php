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


define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_cc4k');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD',  'yoghurtmyzip^periris');

/** MySQL hostname */
define('DB_HOST', 'cc4kdb.cv4boepk78mh.us-west-2.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://127.0.0.1:81/');
define('WP_SITEURL','http://127.0.0.1:81/');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n;qPv/qRW69k`/LVqv2-;m|4D;6g3Oti *F#za-(Ky5:QWD#Fx.g$Z`Bs{x(t`<L');
define('SECURE_AUTH_KEY',  '^atxx,CwxQE]2*7aos$Ui@|gFeAr- Yh4ThN[w@1bi1L6~).911 #mI.:QA:~E(j');
define('LOGGED_IN_KEY',    'bb.%8B=kU)AMZ{3RU8U;Aq$dturVy!{)=>v]sqemg1AWEF}wzIS86-8=&yz{K!OU');
define('NONCE_KEY',        '~PL[TEnpTE8YWEpiU.UwR-7/4p7-|T5TZ`sV|%wNb&T[e.sN]F]7hs5IPZX-xwZ+');
define('AUTH_SALT',        '~-Lsg5s~{,bwFT,{+Pyz]F;02V|6dB*O23L W$F:yBNXe-zK[`=BHn$!-gHLzjU_');
define('SECURE_AUTH_SALT', ' <i?=@NF]NA<@ce$NWyi +6}a4.@D42@H)|jVLh}W59?7e=[H<S-Q}Zjix8vyM*>');
define('LOGGED_IN_SALT',   '8W0p!iO,)uE${_Q%O-~]|._*Ji leZb)q*UV7M|M2/sv4HT#Rts?n-u{(>%K]`k-');
define('NONCE_SALT',       '/BXI*jPjLw2-q90LVDdYNV|Ei1+|>~nZgi+M||BWsU/L(TF#h[E=vp/fPS,V3-$2');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
