const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.webpackConfig({
 	module: {
 		rules: [
	 		{
	 			test: /\.jsx?$/,
	 			exclude: /node_modules(?!\/foundation-sites)|bower_components/,
	 			use: [
		 			{
		 				loader: 'babel-loader',
		 				options: Config.babel(),
		 			},
	 			],
	 		},
	 	],
 	},
 });

mix.js('resources/js/app.js', 'public/js')
   .babel('public/js/app.js', 'public/js/app.es5.js')
   .sass('resources/sass/app.scss', 'public/css');
