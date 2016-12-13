const webpack = require('webpack')
const path = require('path')
const devIp = require('dev-ip')()
const config = require('./gulpconfig')
const host = devIp[0] || 'localhost'

module.exports = {
  entry: {
    app: [
      path.resolve(__dirname, 'src/js/main.js'),
      'webpack/hot/dev-server',
      'webpack-dev-server/client?http://' + host + ':8080/'
    ]
  },
  output: {
    app: {
      path: path.resolve(__dirname, config.webpackPublicPath),
      filename: 'bundle.js',
      publicPath: path.resolve(__dirname, config.webpackPublicPath)
    }
  },
  devtool: 'source-map',
  module: {
    loaders: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel',
        query: {
          presets: ['es2015']
        }
      }
    ]
  },
  plugins: [
    new webpack.HotModuleReplacementPlugin(),
    new webpack.NoErrorsPlugin()
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
