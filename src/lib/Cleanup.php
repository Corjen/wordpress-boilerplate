<?php
/**
 * Cleanup WP
 *
 * @package WordPresss
 * @subpackage Example
 * @since 1.0.0
 */

namespace Example\Lib;

class Cleanup {

  public function __construct() {
    add_action('init', array( $this, 'cleanupHead' ) );
    add_action('init', array( $this, 'disableEmojis' ) );

    add_filter( 'style_loader_src', array( $this, 'removeCSSJSVer' ), 10, 2 );
    add_filter( 'script_loader_src', array( $this, 'removeCSSJSVer' ), 10, 2 );
  }

  /**
   * Clean up head
   */
  public function cleanupHead() {

    // EditURI link
    remove_action( 'wp_head', 'rsd_link' );

    // Category feed links
    remove_action( 'wp_head', 'feed_links_extra', 3 );

    // Post and comment feed links
    remove_action( 'wp_head', 'feed_links', 2 );

    // Windows Live Writer
    remove_action( 'wp_head', 'wlwmanifest_link' );

    // Index link
    remove_action( 'wp_head', 'index_rel_link' );

    // Previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

    // Start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

    // Canonical
    remove_action('wp_head', 'rel_canonical', 10, 0 );

    // Shortlink
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

    // Links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

    // Wp version
    remove_action( 'wp_head', 'wp_generator' );

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
  }

  /**
   * Disable wp_emojicons
   */
  public function disableEmojis() {
    // All actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  }

  /**
   * Remove version parameters from assets
   */
  public function removeCSSJSVer( $src ) {
    if( strpos( $src, '?ver=' ) ) {
      $src = remove_query_arg( 'ver', $src );
    }
    return $src;
  }
}
?>
