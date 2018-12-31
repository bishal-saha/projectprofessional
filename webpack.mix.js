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

mix.js('resources/js/app.frontend.js', 'public/frontend/js')
    .js('resources/js/app.backend.js', 'public/backend/js')
    .sass('resources/sass/app.frontend.scss', 'public/frontend/css')
    .sass('resources/sass/app.backend.scss', 'public/backend/css');
