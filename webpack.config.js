const webpack = require('webpack')
const devIp = require('dev-ip')()
const config = require('./gulpconfig')
const host = devIp[0] || 'localhost'

console.log(config.webpackPublicPath)

module.exports = {
  entry: [
    './src/js/main.js'
  ],
  output: {
    filename: 'bundle.js',
    publicPath: '/'
  },
  devtool: 'source-map',
  module: {
    rules: [
      {
        test: /\.js?$/,
        use: [
          'babel-loader'
        ],
        exclude: /node_modules/
      }
    ]
  },
  plugins: [
    new webpack.HotModuleReplacementPlugin(),
    new webpack.NoEmitOnErrorsPlugin()
  ],
  devServer: {
    port: 8080,
    hot: true,
    host: host
  }
}
