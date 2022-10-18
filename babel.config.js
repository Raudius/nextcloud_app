/*
 * eslint configuration file
 */

const babelConfig = require('@nextcloud/babel-config')
babelConfig
module.exports = {
	...babelConfig,
	presets: [
		"@babel/preset-typescript"
	]

}
