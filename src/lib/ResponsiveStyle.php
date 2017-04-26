<?php
/**
 * ResponsiveStyle
 *
 * @package Example
 * @version 1.0.0
 */

namespace Example\Lib;

class ResponsiveStyle {

  public function __construct( $args ) {
    $defaults = array(
      'images' => array(
        'small' => array(
          'imageId' => 0,
          'size' => 'small'
          ),
        'medium' => array(
          'imageId' => 0,
          'size' => 'medium'
          ),
        'large' => array(
          'imageId' => 0,
          'size' => 'large'
          ),
        'xlarge' => array(
          'imageId' => 0,
          'size' => 'xlarge'
        )
      ),
      'containerId' => '',
    );

    $args = wp_parse_args( $args, $defaults );

    $breakpoints = array(
      'small' => 0,
      'medium' => '40em',
      'large' => '62.5em',
      'xlarge' => '90em',
    );

    $style = '<style>';
    foreach ( $args['images'] as $key => $item ) {
      if ( $item['imageId'] ) {
        $imageSrc = wp_get_attachment_image_src( $item['imageId'], $item['size'] );
        $breakpoint = $breakpoints[$key];
        if ( ! $breakpoint ) {
          $style .= '@media screen {';
        } else {
          $style .= '@media screen and (min-width: ' . $breakpoint . ') {';
        }
        $style .= '#' . $args['containerId'] . ' {
          background-image: url( ' . $imageSrc[0] . ' );
        } }';
      }
    }

    $style .= '</style>';
    echo preg_replace('/\s\s+/', '', $style );
  }
}
