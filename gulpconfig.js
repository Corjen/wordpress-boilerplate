/**
 * Gulp configuration
 */

var config = {
  'build': 'public/wp-content/themes/example',
  'webpackPublicPath': 'public/wp-content/themes/example/js',
  'proxy': 'http://localhost:7200/',
  'dist': 'dist',
  src: {
    php: 'src/**/*.php',
    scss: 'src/scss/**/*.scss',
    twig: 'src/**/*.twig',
    js: 'src/js/**/*.js',
    icons: 'src/icons/*.svg',
    svg: 'src/img/**/*.svg',
    png: 'src/img/**/*.png',
    jpg: 'src/img/**/*.jpg',
    fonts: 'src/fonts/*'
  }
}

module.exports = config
