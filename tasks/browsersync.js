/**
 * Initialize browser sync
 */
const gulp = require('gulp')
const browserSync = require('browser-sync')
const config = require('../gulpconfig.js')

gulp.task('browsersync', () => {
  browserSync({
    files: [config.build + '/**/*'],
    notify: false,
    open: false,
    port: 3000,
    proxy: config.proxy,
    watchOptions: {
      debounceDelay: 2000
    }
  })
})
