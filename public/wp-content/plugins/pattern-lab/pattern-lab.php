<?php
/*
Plugin Name: Wordpress Pattern Lab
Description: A plugin to create a pattern lab
Version: 1.0
Author: Corjen Moll
Author URI: http://example.com/
*/

/**
 * Copyright (c) 9-2016 . All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

add_action( 'wp_enqueue_scripts', 'pl_enqueue_scripts' );

function pl_enqueue_scripts () {
    wp_enqueue_style( 'wpl-navigation-css', plugin_dir_url( __FILE__ ) . '/assets/styleguide-navigation.css' );
    wp_enqueue_script( 'wpl-navigation-js', plugin_dir_url( __FILE__ ) . 'assets/styleguide-navigation.js', array(), '1.0', true );
}

function displayPatternLab () {
  include plugin_dir_path( __FILE__ ) . 'shared/navigation.php';

  // Parse URL even when pretty permalinks are enabled
  $page = $_GET['pattern-page'] ?? '1-components';
  if ( file_exists( get_template_directory() . '/patternlab/pages/' . $page . '.php' ) ) {
    include get_template_directory() . '/patternlab/pages/' . $page . '.php';
  } else {
    echo "Can't find patternlab page";
  }
}
