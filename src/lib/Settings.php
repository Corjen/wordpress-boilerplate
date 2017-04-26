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
    add_action( 'after_setup_theme',  array( $this, 'afterSetupTheme' ) );

    // Move Yoast SEO down
    add_filter( 'wpseo_metabox_prio', function () {
      return 'low';
    } );

    // Remove editor from posts and pages
    add_action( 'init', function () {
      remove_post_type_support( 'page', 'editor' );
      remove_post_type_support( 'post', 'editor' );
    }, 10);

    add_action( 'init', array( $this, 'sidebars' ));
    add_action( 'widgets_init', array( $this, 'cleanupWidgets' ));
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
      wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/' . $assets['main.scss'] );
      /* Read webpack assets file & load them in the footer */
      $webpackAssetsLocation = get_stylesheet_directory() . '/js/webpack-assets.json';
      if ( ! file_exists( $webpackAssetsLocation ) ) {
        echo "Can't find webpack-assets.json";
      } else {
        $webpackAssets = json_decode( file_get_contents( $webpackAssetsLocation ), true );
        wp_enqueue_script( 'vendors-js', get_stylesheet_directory_uri() . '/js/' . $webpackAssets['vendors']['js'], array(), '', true );
        wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/' . $webpackAssets['main']['js'], array(), '', true );
      }
    }
  }

  public function afterSetupTheme () {
    // Theme support
    add_theme_support( 'post-thumbnails' );
    // Menus
    register_nav_menu( 'main-nav', 'Hoofdmenu' );

    // Images sizes
    add_image_size( 'x-small', 10, 10, false );
  }

  public function sidebars() {
    $sidebars = array();
    foreach ( $sidebars as $sidebar ) {
      register_sidebar( $sidebar );
    }
  }

  public function cleanupWidgets () {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
  }

}
