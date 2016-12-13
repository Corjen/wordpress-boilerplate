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

$http_host     = ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '' );
$document_root = $_SERVER['DOCUMENT_ROOT'];

/* Use our own wp-content folder */
define( 'WP_CONTENT_DIR', $document_root . '/wp-content' );

/* Set ENV to development if loaded via WP_CLI */
define( 'WP_DEBUG', true );
if ( defined( 'WP_CLI' ) && WP_CLI ) {
  define( 'WP_ENV', 'dev' );
}


/* Set enviromental vars */
if ( $http_host === 'example.dev' ) {
  define('WP_ENV', 'dev');
} elseif ( $http_host === 'staging.example.com' ) {
  define('WP_ENV', 'stage');
} elseif ( $http_host === 'example.com' ) {
  define('WP_ENV', 'prod');
}

/* Load configuration based on WP_ENV */
switch ( WP_ENV ) {
  case 'dev':
    require __DIR__ . '/config/development.php';
    break;
  case 'stage':
    require __DIR__ . '/config/staging.php';
    break;
  default:
    require __DIR__ . '/config/production.php';
    break;
}

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/* Charset & Collate */
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );


/** Absolute path to the WordPress directory. */
if ( ! defined('ABSPATH') ) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
