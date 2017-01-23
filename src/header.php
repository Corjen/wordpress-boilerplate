<?php
/**
 * Header
 *
 * @package Example
 * @since 1.0.0
 */
$fontsLoadedClass = ( isset( $_COOKIE['fonts-loaded'] ) ? 'fonts-loaded' : '' );
?>
<!DOCTYPE html>
<html class="<?php echo $fontsLoadedClass ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title><?php echo wp_title(); ?></title>
    <?php wp_head() ?>
  </head>
  <body <?php body_class();?>>
