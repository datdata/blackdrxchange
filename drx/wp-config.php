<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'levellb_wp1');

/** MySQL database username */
define('DB_USER', 'levellb_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'V&e6U[p0nms2Du^N18[98..7');

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
define('AUTH_KEY',         'Y&f=0O7]ml~;rHK?u~~M3-Z@W;*NY=U%8xR=A0T%z!ms8ji)`)Q@qKaT5(G<sHb=');
define('SECURE_AUTH_KEY',  'm?p;F*Am:J2duHvFls{@XiX5@{+A`mebS4z3}{X~3>bN&?U*B9qg<d4A(Hth~qn:');
define('LOGGED_IN_KEY',    'rzg) ;`$(29.T(UL+ur1%0kwMN9<[p=_|E n>;MH%Wk]H|A+_:J44S^a1.Hvgb4.');
define('NONCE_KEY',        'HTv10JF$sF#cz^n3gg>gS]WtF8iOWwk{sDxj|iEz %y?Fm }F1!cVv/#3cU{Y0j/');
define('AUTH_SALT',        'E(4XKnFO!)s.@rQ)M1T{&}hBgx3|u**:}hT)g$!kvrSA#g,l?h3wz1jLxS6qQnB$');
define('SECURE_AUTH_SALT', 'g[$nC?g/U [19.#G.m`~Q#!At@!^Rfw0LMd0_MPA$u{o2G)^DE`x/E/%t!WH!Nco');
define('LOGGED_IN_SALT',   ' kR#olP_({+/5_4{xuT+!2dx+_^frY^* !%%j;YxJ U,vj+4#O{=]{3y];T(oDy(');
define('NONCE_SALT',       'Y~9AmAVU-8<>qI;aiC7Hm-J<uf}=k~}/BxR1x})4~vX6nM6kA_XZ(~l3#P{gKE3t');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp2_';

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
