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

mix.js('resources/assets/js/app.js', 'public/js');
mix.styles(['resources/assets/css/*.css', 'node_modules/element-ui/lib/theme-default/index.css'], 'public/css/all.css');
mix.js('resources/assets/js/main.js', 'public/js/main.js');
mix.browserSync('verdimar.laravel.cms');

mix.copyDirectory(['node_modules/bootstrap/dist/'], 'public/vendor/bootstrap');
mix.copyDirectory(['node_modules/font-awesome/'], 'public/vendor/font-awesome');

mix.styles([
    'node_modules/animate.css/animate.min.css',
    'node_modules/flexslider/flexslider.css',
], 'public/css/styles.css');


mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/device.js/dist/device.js',
    'node_modules/jquery-plugin-viewport-checker/dist/jquery.viewportchecker.min.js',
    'node_modules/flexslider/jquery.flexslider-min.js',
    'node_modules/jquery.stellar/jquery.stellar.js'
], 'public/vendor/all.js');

//mix.webpackConfig({
//    resolve: {
//        modules: [
//            path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js')
//        ]
//    }
//});


