/**
 * Copy theme files to build or dist folder
 */
const gulp = require('gulp')
const plugins = require('gulp-load-plugins')({ camelize: true })
const config = require('../gulpconfig.js')

/**
 * PHP files
 */
gulp.task('theme-php-build', () => {
  return gulp.src(config.src.php)
    .pipe(plugins.changed(config.build))
    .pipe(gulp.dest(config.build))
})
gulp.task('theme-php-build-production', () => {
  return gulp.src(config.src.php)
    .pipe(gulp.dest(config.dist))
})

/**
 * Style.css
 */
gulp.task('style-css-build', () => {
  return gulp.src('src/style.css')
    .pipe(plugins.changed(config.build))
    .pipe(gulp.dest(config.build))
})
gulp.task('style-css-build-production', () => {
  return gulp.src('src/style.css')
    .pipe(gulp.dest(config.dist))
})

/**
 * .Twig files
 */
gulp.task('theme-twig-build', () => {
  return gulp.src(config.src.twig)
    .pipe(plugins.changed(config.build))
    .pipe(gulp.dest(config.build))
})
gulp.task('theme-twig-build-production', () => {
  return gulp.src(config.src.twig)
    .pipe(gulp.dest(config.dist))
})

/**
 * Fonts
 */
gulp.task('theme-fonts-build', () => {
  return gulp.src(config.src.fonts)
   .pipe(plugins.changed(config.build))
   .pipe(gulp.dest(config.build + '/fonts/'))
})

gulp.task('theme-fonts-build-production', () => {
  return gulp.src(config.src.fonts)
    .pipe(plugins.changed(config.dist))
    .pipe(gulp.dest(config.dist + '/fonts'))
})

/**
 * JSON files
 */
gulp.task('theme-json-build', () => {
  return gulp.src('src/**/*.json')
    .pipe(plugins.changed(config.build))
    .pipe(gulp.dest(config.build))
})
gulp.task('theme-json-build-production', () => {
  return gulp.src('src/**/*.json')
    .pipe(gulp.dest(config.dist))
})

/**
 * Theme assets
 */
gulp.task('theme-assets-build', () => {
  return gulp.src(['src/lib/assets/**'])
    .pipe(gulp.dest(config.build + '/lib/assets'))
})
gulp.task('theme-assets-build-production', () => {
  return gulp.src(['src/lib/assets/**'])
    .pipe(gulp.dest(config.dist + '/lib/assets'))
})

gulp.task('theme-composer-build', () => {
  return gulp.src('src/vendor/**/*')
    .pipe(gulp.dest(config.build + '/vendor'))
})

gulp.task('theme-composer-build-production', () => {
  return gulp.src('src/vendor/**/*')
    .pipe(gulp.dest(config.dist + '/vendor'))
})

gulp.task('theme-build', [
  'theme-php-build',
  'style-css-build',
  'theme-json-build',
  'theme-twig-build',
  'theme-assets-build',
  'theme-composer-build',
  'theme-fonts-build'
])

gulp.task('theme-build-production', [
  'theme-php-build-production',
  'style-css-build-production',
  'theme-json-build-production',
  'theme-twig-build-production',
  'theme-assets-build-production',
  'theme-composer-build-production',
  'theme-fonts-build-production'
])
