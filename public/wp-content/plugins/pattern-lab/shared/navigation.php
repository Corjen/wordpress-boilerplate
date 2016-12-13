<?php
/**
 * Get all pages and put them in a navigation
 */

$pages = glob( get_stylesheet_directory() . '/patternlab/pages/*.php' );

function pathToMenuName( $path ) {
  $path = explode( '/', $path );
  $path = $path[count( $path ) - 1];
  $path = str_replace( '.php', '', $path );
  $path = substr( $path, 2 );
  $path = str_replace( '-', ' ', $path );
  $path = ucfirst( $path );
  return $path;
}

function pathToLink( $path ) {
  $path = explode( '/', $path );
  $path = $path[count( $path ) - 1];
  $path = str_replace( '.php', '', $path );
  return $path;
}
?>

<div class="styleguide-navigation js-styleguide-navigation">
  <a href="" class="styleguide-navigation-button js-open-styleguide-navigation">></a>
  <nav>
    <ul>
      <?php foreach ( $pages as $page ) : ?>
        <li><a href="<?php echo esc_url( add_query_arg( 'pattern-page', pathToLink( $page ) ) )?>"><?php echo pathToMenuName( $page ) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
</div>
