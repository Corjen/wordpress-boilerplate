<?php
/**
 * Development config
 *
 * @package WordPress
 * @subpackage Example
 * @since 1.0.0
 */

$http_host = 'http://example.dev';

define('WP_SITEURL', $http_host . '/wordpress');
define('WP_HOME',    $http_host );
define('WP_CONTENT_URL', $http_host . '/wp-content');

// ** MySQL settings ** //
define('DB_NAME', 'example_develop');
define('DB_USER', 'dev');
define('DB_PASSWORD', 'dev');
define('DB_HOST', 'localhost');

/* Debug */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3WG|mR |vStwg>kA(lC|DUDKgI]vWae}0r7%CXz@9TW|$>|Isw!s-/-zQs=__<r#');
define('SECURE_AUTH_KEY',  '}3_ii+(j$KU4r }41b0]7ntb1qZ,#q}T7qx-<t#V5X5g(#y_>4+T%J+nx yY)5au');
define('LOGGED_IN_KEY',    '#K_I%2s47BbHp.R1~F{#Y[x;7YCI_kD9e>% -Q+ax|It DX-1VjB6skJySl2Am9@');
define('NONCE_KEY',        '*k%K45}0i0DO)bQ8+,ZxXI6NZy$q[rIRUq}[=`eo8eU9c;s2BrX4<B43cFQsbh5!');
define('AUTH_SALT',        '0F@@%Vhb!zcC}]Y?SMv6C:+M2qMF}[2GU-_.u~! l?%N|);kqMRR-8[9$gGdP@Es');
define('SECURE_AUTH_SALT', 'g15jffy|xT+JAP-:;zycY{i-jFwrFjNI8AluS+&~pbqWLPmzlp|+j5gR,F uF|e@');
define('LOGGED_IN_SALT',   '2Jp;:(j8H;Mi 13J`q-q9QDRM$-nB}aVWAeE(RUBa6<Oi[$O}~l!2+0:._Ka`M4M');
define('NONCE_SALT',       '*k%K45}0i0DO)bQ8+,ZxXI6NZy$q[rIRUq}[=`eo8eU9c;s2BrX4<B43cFQsbh5!');
