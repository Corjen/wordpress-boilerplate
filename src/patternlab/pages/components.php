<?php
/**
 * Patternlab components page
 */
$components = glob( get_stylesheet_directory() . '/patternlab/components/*.php' );

if ( ! empty( $components ) ) {
  foreach ( $components as $component ) {
    include $component;
  }
}
?>
