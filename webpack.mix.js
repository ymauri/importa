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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/client.js', 'public/js')
    .js('resources/js/product.js', 'public/js')
    .js('resources/js/order.js', 'public/js')
    .js('resources/js/modal-products.js', 'public/js')
    .js('resources/js/shipping.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
