/**
 * Images
 */
const gulp = require('gulp')
const config = require('../gulpconfig.js')
const plugins = require('gulp-load-plugins')({ camelize: true })

gulp.task('jpg-build', () => {
  return gulp.src(config.src.jpg)
    .pipe(gulp.dest(config.build + '/img'))
})

gulp.task('svg-build', () => {
  return gulp.src(config.src.svg)
    .pipe(gulp.dest(config.build + '/img'))
})

gulp.task('png-build', () => {
  return gulp.src(config.src.png)
    .pipe(plugins.imagemin())
    .pipe(gulp.dest(config.build + '/img'))
})

gulp.task('jpg-build-production', () => {
  return gulp.src(config.src.jpg)
    .pipe(plugins.imagemin())
    .pipe(gulp.dest(config.dist + '/img'))
})

gulp.task('svg-build-production', () => {
  return gulp.src(config.src.svg)
    .pipe(plugins.imagemin({
      use: [plugins.svgo()]
    }))
    .pipe(gulp.dest(config.dist + '/img'))
})

gulp.task('png-build-production', () => {
  return gulp.src(config.src.png)
    .pipe(plugins.imagemin())
    .pipe(gulp.dest(config.dist + '/img'))
})

gulp.task('images-build', ['jpg-build', 'png-build', 'svg-build'])
gulp.task('images-build-production', ['jpg-build-production', 'png-build-production', 'svg-build-production'])
