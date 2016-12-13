/**
 * This task should run every time you start up the project
 */
const gulp = require('gulp')

gulp.task('init', ['theme-build', 'images-build', 'scss-build', 'icons-build'])
