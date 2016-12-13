const gulp = require('gulp')

gulp.task('build-production', ['icons-build-production', 'images-build-production', 'scss-build-production', 'theme-build-production', 'critical'])
