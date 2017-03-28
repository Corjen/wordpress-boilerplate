<?php
/**
 * Settings
 *
 * @package Example
 * @version 1.0.0
 */

namespace Example\Lib;

class Settings {

  public function __construct() {
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueueAssets' ) );
  }

  /**
   * Enqueue CSS & JS assets
   */
  public function enqueueAssets() {
    wp_enqueue_script( 'polyfill', 'https://cdn.polyfill.io/v2/polyfill.min.js', '', array(), true );

    /* If we're in the development enviroment, load the unhashed css and webpack bundle */
    if ( WP_ENV === 'dev' ) {
      $ip = json_decode( file_get_contents( get_stylesheet_directory() . '/ip.json' ) );
      wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css' );
      wp_enqueue_script( 'main', '//' . $ip->ip . ':8080/bundle.js', '', array(), true );
    } else {
      /* Read css assets and load file */
      $assets = (array) json_decode( file_get_contents( get_stylesheet_directory() . '/css/css-assets.json' ) );
      wp_enqueue_style( 'main', $assets['main.scss'] );
      /* Read webpack assets file & load them in the footer */
      $webpackAssetsLocation = get_stylesheet_directory() . '/js/webpack-assets.json';
      if ( ! file_exists( $webpackAssetsLocation ) ) {
        echo "Can't find webpack-assets.json";
      } else {
        $webpackAssets = json_decode( file_get_contents( $webpackAssetsLocation ), true );
        wp_enqueue_script( 'vendors-js', get_stylesheet_directory_uri() . '/js' . $webpackAssets['vendors']['js'], array(), '', true );
        wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js' . $webpackAssets['main']['js'], array(), '', true );
      }
    }
  }

}
