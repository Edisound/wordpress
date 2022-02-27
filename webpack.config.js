const path = require('path');
const webpack = require('webpack');

module.exports = {
    entry: './blocks/player/index.jsx',
    output: {
        path: path.resolve(__dirname, 'blocks/player'),
        filename: 'index.js'
    },
	resolve: {
		alias: {
			process: "process/browser"
		} 
	},
    module: {
        rules: [
            {
                test: /.jsx?$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
            }
        ]
    },
  plugins: [
      new webpack.ProvidePlugin({
             process: 'process/browser',
      }),
  ],
    mode: 'none'
}
