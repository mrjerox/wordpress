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
define('DB_NAME', 'wordpress');

/** Database username */
define('DB_USER', 'db_admin');

/** Database password */
define('DB_PASSWORD', '040200');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'X7.wfoiG3*Cv~hDhdGb]7l3$QW[Fc1h9_LhbY%,28O?--v`4UO-;:?PHZF~R&-;n');
define('SECURE_AUTH_KEY',  '@}i]W2TK%pCvW+d{A066:PSuv>jarfpk;6.CDZg:/%m9h5I;X<K~glliHx2>od5,');
define('LOGGED_IN_KEY',    ' }|u0N>sW>p& Hik:((lI ]D#~g-[`pKU=y[r>4bgB#P2UaQ-QjF>mOa_7Al4Pq:');
define('NONCE_KEY',        '-`R9s=Q2O0?O)`lCsf_zJ}yUgovKQkTxP;3M%H~zAw_}(3JeAEc$?0pa?B4]f?BP');
define('AUTH_SALT',        'e4/,WNU/PdX/_g }IXoYZvjvN@0;8]%(.$,OID@ju@ug<LmeRwjqjOZ[[6/@6HO*');
define('SECURE_AUTH_SALT', '^79EkLDb!-1N:9CZ @7(jVeBeAFHhek]^?pRtfO_v.FYT;PXe;Fqo[j],3!Nkx$@');
define('LOGGED_IN_SALT',   'pwmQYN=qKjvuk=lF[u%Vo5zJV =xv9ylm3O2|~-Rm(@bB%SiZ1`b%kDG;Yc#_Qb3');
define('NONCE_SALT',       '^azsL8EM&Z%S%3iGT;XPI)ww2#?qA^VvPou=bS_.U*#DMkzG%0)t,h<[>4ja:Xz9');

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */
define('FS_METHOD', 'direct');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
