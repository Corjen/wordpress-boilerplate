/**
 * Copy theme files to build or dist folder
 */
const gulp = require('gulp')
const plugins = require('gulp-load-plugins')({ camelize: true })
const config = require('../gulpconfig.js')
const hash = require('gulp-hash')

gulp.task('scss-build', () => {
  return gulp.src(config.src.scss)
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.plumber({
      errorHandler: plugins.notify.onError({
        'message': 'Error: <%= error.message %>',
        'sound': false
      })
    }))
    .pipe(plugins.cssGlobbing({
      extensions: ['.scss']
    }))
    .pipe(plugins.sass())
    .pipe(plugins.autoprefixer('last 3 version'))
    .pipe(plugins.sourcemaps.write())
    .pipe(gulp.dest(config.build + '/css'))
    .pipe(plugins.notify({
      'message': 'Compiled main.css',
      'sound': false
    }))
})

gulp.task('scss-build-production', () => {
  return gulp.src('./src/scss/main.scss')
    .pipe(hash({
      hashLength: 10,
      template: '<%= name %>.<%= hash %><%= ext %>'
    }))
    .pipe(plugins.cssGlobbing({
      extensions: ['.scss']
    }))
    .pipe(plugins.sass())
    .pipe(plugins.autoprefixer('last 3 version'))
    .pipe(plugins.uglifycss())
    .pipe(gulp.dest(config.dist + '/css'))
    .pipe(plugins.hash.manifest('css-assets.json', false))
    .pipe(gulp.dest(config.dist + '/css'))
})
