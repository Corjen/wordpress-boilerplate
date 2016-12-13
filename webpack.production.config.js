const webpack = require('webpack')
const path = require('path')
const AssetsPlugin = require('assets-webpack-plugin')

module.exports = {
  entry: {
    main: [
      path.resolve(__dirname, 'src/js/main.js')
    ],
    vendors: []
  },
  output: {
    path: path.resolve(__dirname, 'dist/js'),
    filename: '/main.[hash].js'
  },
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
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        screw_ie8: true,
        warnings: false
      }
    }),
    new webpack.DefinePlugin({
      'process.env': {
        'NODE_ENV': JSON.stringify('production')
      }
    }),
    new webpack.optimize.CommonsChunkPlugin('vendors', '/vendors.[hash].js'),
    new AssetsPlugin({path: path.resolve(__dirname, 'dist/js')})
  ]
}
