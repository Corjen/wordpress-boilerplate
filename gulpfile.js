/**
* Gulpfile
*
* @since 1.0.0
*/
const devIp = require('dev-ip')()
const host = devIp[0] || 'localhost'
const requireDir = require('require-dir')
const fs = require('fs')
requireDir('./tasks')

fs.writeFile('src/ip.json', JSON.stringify({
  ip: host
}), err => {
  if (err) throw err
})
