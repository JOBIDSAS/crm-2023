const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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
mix .js('resources/js/crm/crm.js', 'public/js')
    .sass('resources/sass/crm/crm.scss', 'public/css')

    .js('resources/js/web/calendar.js', 'public/js')
    .js('resources/js/web/confirm.js', 'public/js')
    .sass('resources/sass/web/web.scss', 'public/css')
    .purgeCss()
    .vue();