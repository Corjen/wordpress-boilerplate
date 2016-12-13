/**
 * Icons
 */
const gulp = require('gulp')
const config = require('../gulpconfig.js')
const plugins = require('gulp-load-plugins')({ camelize: true })

gulp.task('icons-build', () => {
  return gulp.src(config.src.icons)
    .pipe(plugins.plumber({}))
    .pipe(plugins.svgmin())
    .pipe(plugins.svgstore({
      inlineSvg: true,
      cleanup: true
    }))
    .pipe(plugins.cheerio(function ($) {
      $('svg').attr('style', 'display:none')
    }))
    .pipe(gulp.dest(config.build + '/img/'))
})

gulp.task('icons-build-production', () => {
  return gulp.src(config.src.icons)
    .pipe(plugins.plumber({}))
    .pipe(plugins.svgmin())
    .pipe(plugins.svgstore({
      inlineSvg: true,
      cleanup: true
    }))
    .pipe(plugins.cheerio(function ($) {
      $('svg').attr('style', 'display:none')
    }))
    .pipe(gulp.dest(config.dist + '/img/'))
})
