const webpack = require('webpack')
const path = require('path')
const devIp = require('dev-ip')()
const config = require('./gulpconfig')
const host = devIp[0] || 'localhost'

module.exports = {
  entry: './src/js/main.js',
  // entry: [
  //   'webpack/hot/dev-server',
  //   'webpack-dev-server/client?http://' + host + ':8080/',
  //   'src/js/main.js'
  // ],
  output: {
    path: path.resolve(__dirname, config.webpackPublicPath),
    filename: 'bundle.js',
    publicPath: path.resolve(__dirname, config.webpackPublicPath)
  },
  devtool: 'source-map',
  module: {
    rules: [
      {
        test: /\.js?$/,
        use: ['babel-loader'],
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
    contentBase: path.resolve(__dirname, config.webpackPublicPath),
    historyApiFallback: true,
    hot: true,
    host: host,
    proxy: {
      '*': 'http://localhost:3000'
    }
  }
}
