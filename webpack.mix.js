const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');

mix.scripts([
    'resources/js/bundle.js',
    'resources/js/scripts.js'
], 'public/js/theme.js');

mix.styles([
    'resources/css/dashlite.css',
    'resources/css/theme.css',
], 'public/css/theme.css')

mix.copyDirectory('resources/fonts', 'public/fonts') 
mix.copyDirectory('resources/images', 'public/images')