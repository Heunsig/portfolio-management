const path = require('path')
const isProduction = process.env.ENV === 'production' ? true : false

module.exports = {
  mode: process.env.ENV,
  entry: './resources/assets/admin/js/client-api/index.js',
  devtool: 'inline-source-map',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'public/assets/client-api')
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|vender)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      }
    ]
  }
}