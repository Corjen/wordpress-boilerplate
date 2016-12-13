<?php
/**
 * Settings
 *
 * @package WordPress
 * @subpackage Example
 * @version 1.0.0
 */

namespace Example\Lib;

class Settings {

  /**
   * The local url where the webpack bundle can be found
   * @var string
   */
  var $webpackLocal = '//10.22.10.104:8080';

  public function __construct() {
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueueAssets' ) );
  }

  /**
   * Enqueue CSS & JS assets
   */
  public function enqueueAssets() {
    /* If we're in the development enviroment, load the unhashed css and webpack bundle */
    if ( WP_ENV === 'dev' ) {
      wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css' );
      wp_enqueue_script( 'main', $this->webpackLocal . '/bundle.js' );
    } else {

      /* Read css json file & load it*/
      $cssAssetsLocation = get_stylesheet_directory() . '/css/css-assets.json';
      if ( ! file_exists( $cssAssetsLocation ) ) {
        echo "Can't find css-assets.json";
      } else {
        $cssAssets = json_decode( file_get_contents( $cssAssetsLocation ), true );
        wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/' . $cssAssets['main.scss'] );
      }

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
