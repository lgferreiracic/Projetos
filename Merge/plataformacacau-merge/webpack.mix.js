const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js");

mix.sass("resources/sass/app.scss", "public/css")
	.sass("resources/sass/login.scss", "public/css/login.css")
	.sass("resources/sass/admin.scss", "public/css/admin.css");

mix.copyDirectory("resources/fonts", "public/fonts");
