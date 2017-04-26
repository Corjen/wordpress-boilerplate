<?php
/**
 * SocialSettingsPage
 *
 * @package Example
 * @since 1.0.0
 */

namespace Example\Lib;
use Cuisine\Wrappers\SettingsPage;
use Cuisine\Wrappers\Field;

class SocialSettingsPage {
  public function __construct() {
    $args = array(
      'menu_title'    => 'Social media'
    );
    $fields = array(
      Field::text( 'facebook', 'Facebook' ),
      Field::text( 'instagram', 'Instagram' ),
      Field::text( 'pinterest', 'Pinterest' ),
      Field::text( 'twitter', 'Twitter' ),
    );

    SettingsPage::make(
      'Social media',
      'social'
    )->set( $fields );
  }
}
