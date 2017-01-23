<?php
/**
 * Lazy Load Fonts
 *
 * @package WordPresss
 * @package RebelDeuren
 * @since 1.0.0
 */
 namespace Example\Lib;

 class LazyLoadFonts {

   public function __construct() {
     if ( ! isset( $_COOKIE['fonts-loaded'] ) ) {
       $this->setCookie();
     }
   }

   private function setCookie() {
     setcookie( 'fonts-loaded', true );
   }
 }
