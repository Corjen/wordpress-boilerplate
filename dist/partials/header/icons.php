<?php
/**
 * Load icons.svg
 *
 * @package Example
 * @since 1.0.0
 */

$iconsPath = get_stylesheet_directory() . '/img/icons.svg';
if ( ! file_exists( $iconsPath ) ) {
  if ( WP_DEBUG ) {
    trigger_error( "Can't find icons.svg", E_USER_NOTICE );
  }
} else {
  include $iconsPath;
}

?>
