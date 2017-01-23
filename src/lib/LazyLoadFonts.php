<?php
/**
 * Lazy Load Fonts
 *
 * @package Example
 * @since 1.0.0
 */
 namespace Example\Lib;

 class LazyLoadFonts {

   public function __construct() {
     // Test if cookie is set, if it is load font in head, else load in the footer
     if ( isset( $_COOKIE['fonts-loaded'] ) ) {
       add_action( 'wp_head', array( $this, 'loadInHead' ), 2 );
     } else {
       add_action( 'wp_footer', array( $this, 'loadInFooter' ), 2 );
       $this->setCookie();
     }
   }

   public function loadInHead() {
     $this->loadFont();
   }

   public function loadInFooter() {
     $this->loadFont();
   }

   private function loadFont() {
     wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:400,400italic,600,700', array(), '', 'all' );
   }

   private function setCookie() {
     setcookie( 'fonts-loaded', true );
   }
 }
