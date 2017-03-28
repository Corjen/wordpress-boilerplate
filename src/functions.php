<?php
/**
 * Functions - Include composer autoload, templates & widgets
 *
 * @package Example
 * @version 1.0.0
 */

namespace Example\Lib;

/* Load composer autoloader */
require 'vendor/autoload.php';

/* Ensure cuisine is always active */
$activePlugins = get_option( 'active_plugins' );
if ( ! in_array( 'cuisine/cuisine.php', $activePlugins ) ) {
  array_push( $activePlugins, 'cuisine/cuisine.php' );
  update_option( 'active_plugins', $activePlugins );
}

/**
 * Load classes
 */
new Cleanup();
new Settings();
new LazyLoadFonts();

if ( is_admin() ) {
  new AdminSettings();
}



?>
