const gulp = require('gulp')
const penthouse = require('penthouse')
const uglifycss = require('uglifycss')
const fs = require('fs')
const jsonfile = require('jsonfile')
const config = require('../gulpconfig')

gulp.task('critical', ['scss-build-production'], () => {
  jsonfile.readFile('./dist/css/css-assets.json', (err, obj) => {
    if (err) { throw err }
    penthouse({
      url: config.proxy,
      css: './dist/css/' + obj['main.scss'],
      width: 1500,
      height: 2200
    }, (err, criticalCSS) => {
      if (err) {
        console.log(err)
        throw err
      }
      fs.writeFileSync('./dist/css/critical.css', uglifycss.processString(criticalCSS))
    })
  })
})
