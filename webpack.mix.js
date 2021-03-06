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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/navbar_script.js', 'public/js')
    .js('resources/js/orders_dashboard_script.js', 'public/js')
    .js('resources/js/customers_dashboard_script.js', 'public/js')
    .js('resources/js/vehicles_dashboard_script.js', 'public/js')
    .js('resources/js/chat_script.js', 'public/js')
    .js('resources/js/chats_dashboard_script.js', 'public/js')
    .js('resources/js/update_vehicle_script.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
