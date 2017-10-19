const webpack = require('webpack')
const path = require('path')
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')
const AssetsPlugin = require('assets-webpack-plugin')

module.exports = {
  entry: {
    main: './src/js/main.js',
    vendors: ['raven-js']
  },
  output: {
    path: path.resolve(__dirname, 'dist/js'),
    filename: 'main.[chunkhash].js'
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
    // new UglifyJsPlugin({
    //   ie8: false,
    //   ecma: 8,
    //   sourceMap: true
    // }),
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production')
      }
    }),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendors',
      filename: '/vendors.[hash].js'
    }),
    new AssetsPlugin({ path: path.resolve(__dirname, 'dist/js') })
  ]
}
