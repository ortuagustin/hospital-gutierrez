let mix = require('laravel-mix');

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

mix.js([
      'resources/assets/js/app.js',
      'resources/assets/js/auth.js',
      'resources/assets/js/charts.js'
    ], 'public/js/app.js')

   .styles([
      'resources/assets/css/app.css',
      'resources/assets/css/animate.css'
    ], 'public/css/app.css');
