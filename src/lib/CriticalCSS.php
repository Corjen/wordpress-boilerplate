<?php
/**
 * Critical CSS
 *
 * @package Example
 * @since 1.0.0
 */

namespace Example\Lib;

class CriticalCSS {

  /**
   * CSS assets path
   * @var string
   */
  public $cssAssetsPath = '';

  /**
   * Path to critical CSS file
   * @var string
   */
  public $criticalCSSPath = '';

  /**
   * Current cssh hash
   * @var string
   */
  public $cssHash = '';

  /**
   * Path to production css
   * @var string
   */
  public $prodCSSpath = '';

  public function __construct() {
    if ( WP_ENV === 'dev' ) {
      // Load regular CSS in development enviroments
      add_action( 'wp_enqueue_scripts', array( $this, 'enqueueDevCSS' ) );
    } else {
      $assets = (array) json_decode( file_get_contents( get_stylesheet_directory() . '/css/css-assets.json' ) );
      $this->cssHash = $assets['main.scss'];
      $this->prodCSSpath = get_stylesheet_directory_uri() . '/css/' . $this->cssHash;
      $this->criticalCSSPath = get_stylesheet_directory() . '/css/home.css';

      add_action( 'wp_head', array( $this, 'checkIfCriticalCSSShouldLoad' ), 2 );
    }
  }

  public function checkIfCriticalCSSShouldLoad () {
    if ( ! is_front_page() ) {
      $this->enqueueProdCSS();
      $this->setCookie( $this->cssHash );
    } else {
      if ( isset( $_COOKIE['css-loaded'] ) && $_COOKIE['css-loaded'] === $this->cssHash ) {
        $this->enqueueProdCSS();
      } else {
        $this->setCookie( $this->cssHash );
        $this->loadCriticalCSS();
        add_action( 'wp_footer', array( $this, 'loadCSSInFooter' ) );
      }
    }
  }

  public function loadCSSInFooter() {
    $this->enqueueProdCSS();
  }

  public function setCookie( $cssHash ) {
    setcookie( 'css-loaded', $cssHash );
  }

  public function enqueueDevCSS() {
    wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css', array(), '', 'screen' );
  }

  public function enqueueProdCSS() {
    wp_enqueue_style( 'main', $this->prodCSSpath, array(), '', 'screen' );
  }

  public function loadCriticalCSS () {
    echo '<style>' . file_get_contents( $this->criticalCSSPath ) . '</style>';
  }
}
?>
