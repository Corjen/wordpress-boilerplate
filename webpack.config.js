const webpack = require('webpack')
const path = require('path')
const config = require('./gulpconfig')
const AssetsPlugin = require('assets-webpack-plugin')
const publicPath = path.resolve(__dirname, config.webpackPublicPath)

module.exports = {
  entry: ['./src/js/main.js'],
  output: {
    filename: 'bundle.js',
    publicPath: '/',
    path: publicPath
  },
  devtool: 'eval-source-map',
  module: {
    rules: [
      {
        test: /\.js?$/,
        use: ['babel-loader'],
        exclude: /node_modules/
      }
    ]
  }
}
