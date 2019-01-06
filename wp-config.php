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

//define('DB_NAME', 'qavamico_wpdb');
define('DB_NAME', 'qavami_01');



/** MySQL database username */

//define('DB_USER', 'qavamico_wpusr');
define('DB_USER', 'root');



/** MySQL database password */

define('DB_PASSWORD', '');
//define('DB_PASSWORD', 'wl7vSmBdy');



/** MySQL hostname */

define('DB_HOST', 'localhost');



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

define('AUTH_KEY',         ';o^Sq&Q?z[wwD}Z,h!JCSbRkl<eJzqd_U<0?m31)DMsSS:T?JzN9EPE4uNS|DK8]');

define('SECURE_AUTH_KEY',  '1c04WUOmqEN2.H`&=H=u RY#?;_|B{CT$f2~6VZ/^_Cj_/sv#Zmz#[??tQ6L{L14');

define('LOGGED_IN_KEY',    '0J,ULN.,)3o$zz,oOdKvpONb8tcx*5 GD{Nr!zdA?^Wh|jwIzGypC~>!a#le2~$J');

define('NONCE_KEY',        '|T7;BIi,d~*v`Q~p*?M)QL:CrRg5|SNp_G]a@cl63ihTYSpb$qa([j$BJ&R(+R=`');

define('AUTH_SALT',        'pN+Mp(]c9f#fVo/{?5.{Oa^LFT`,sp!0WN5PB-0?W3N`@)qJ 2=:_L*ue4Ci975|');

define('SECURE_AUTH_SALT', '#C&H`U z16G*M.AOL+@{*Tu=<_e9+H(IcKcm`(%#2lt@3L3D RgBnM41x.rU~Wf(');

define('LOGGED_IN_SALT',   't-hFD+Nuip[6N}62yQWMpKga1QNp,p#=0HbP^)t3M*q^o9QN-zJM76@`uj$RBdLz');

define('NONCE_SALT',       'K`}s&lrlV:t-@/J^Dr:u}CjY*~~i-r/e9&x)xeHutQ3|[bjNc<{Eq&^iT}!k9nM7');



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

define('FTP_SSL', false);
ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
//define('WP_DEBUG', false);
//define('WP_DEBUG_LOG', true);
//define('WP_DEBUG_DISPLAY', false);
// define('FTP_SSL', false);
// ini_set('log_errors','On');
// ini_set('display_errors','Off');
// ini_set('error_reporting', E_ALL );
// define('WP_DEBUG', false);
// define('WP_DEBUG_LOG', true);
// define('WP_DEBUG_DISPLAY', false);