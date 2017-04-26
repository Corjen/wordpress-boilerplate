<?php
/**
 * AdressSettingsPage
 *
 * @package Example
 * @since 1.0.0
 */

namespace Example\Lib;
use Cuisine\Wrappers\SettingsPage;
use Cuisine\Wrappers\Field;

class AdressSettingsPage {
  public function __construct() {
    $args = array(
      'menu_title'    => 'Adresgegevens'
    );
    $fields = array(
      Field::text( 'phone', 'Telefoonunummer' ),
      Field::text( 'email', 'E-mail adres' ),
      Field::text( 'adress', 'Adress' ),
      Field::text( 'postal', 'Postcode' ),
      Field::text( 'city', 'Plaats' ),
    );

    SettingsPage::make(
      'Adresgegevens',
      'adress'
    )->set( $fields );
  }
}
