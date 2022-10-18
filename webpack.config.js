const webpackConfigOld = require('@nextcloud/webpack-vue-config')

module.exports = {
	...webpackConfigOld,
	entry: {
		/*
		 * Since an app can produce multiple scripts you can define the entrypoints.
		 * The resulting scripts will be created in the js/ directory
		 *
		 * src/main.ts => js/app_id-main.js
		 */
		main: "./src/main.ts"
	},
	devtool: "source-map",
	resolve: {
		extensions: ["", ".webpack.js", ".web.js", ".ts", ".tsx", ".js", ".vue"],
	},
	module: {
		rules: [
			{
				test: /\.tsx?$/,
				loader: 'ts-loader',
				exclude: /node_modules/,
				options: {
					appendTsSuffixTo: [/\.vue$/],
				},
			},
			{ test: /\.js$/, loader: "source-map-loader" },
			{ test: /\.vue$/, loader: 'vue-loader' },
			{
				test: /\.css$/,
				use: [
					'style-loader',
					{ loader: 'css-loader', options: { importLoaders: 1 } },
					'postcss-loader'
				]
			},
		],
	},
}
