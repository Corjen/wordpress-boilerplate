<?php
/**
 * Production config
 *
 * @package WordPress
 * @subpackage Example
 * @since 1.0.0
 */

$http_host = 'https://example.com';

define('WP_SITEURL', $http_host . '/wordpress');
define('WP_HOME',    $http_host );
define('WP_CONTENT_URL', $http_host . '/wp-content');

// ** MySQL settings ** //
define('DB_NAME', 'database_name_here');
define('DB_USER', 'username_here');
define('DB_PASSWORD', 'password_here');
define('DB_HOST', 'localhost');

/* DEBUG */
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AZnN1]m&|r~<F|,Y#^(JyU34}QTZ6v%9^@#<-XWG;cAV]-6+ aIZ K>afi2|`0w}');
define('SECURE_AUTH_KEY',  ':e]{l/.H)=YpCs47SWnxBguG`D;QZcP`uno(Z9^JwK+UY/J+OR$>%#y`oE3YAR]r');
define('LOGGED_IN_KEY',    'WD[vzv7%vu[VdO|U-=89bSa*@jQv8eutB_&)aA|Ks&N pn@r|-BeSgE^Xr- / MK');
define('NONCE_KEY',        '65Ec[vi{>aGJ@Uikp&8_91O,K-0x|^LZ}ev=|_:^HmWgP22|9p@-@)Qs[*%*GoxG');
define('AUTH_SALT',        'g6y/;f-2_zrm5O/k|H79?6?nHdRc(r77I._Eu141n4voD1;wXI83ayCV$Ou^})Hr');
define('SECURE_AUTH_SALT', 'Y>1jG>q}T[V=@/;a|y<<d a@g-/,#P1`>I3$U5+A)*z/#(l^6WuP5xE6D>~za@}[');
define('LOGGED_IN_SALT',   '#:ywE|O%O}rx;yt!:Ca<zM]qaw*rG @AZ72DR p||Z]U0b@?)~k| &U%^dX%)gP-');
define('NONCE_SALT',       '<nehq,E&{-.oimR@WIA[3+t]XzHNWzI<`0x-FCkpV`Yr8$C<=%I|L+|ftR;QQWpH');
