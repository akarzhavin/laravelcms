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
// mix.copyDirectory(['node_modules/admin-lte/bootstrap'], 'public/vendor/admin-lte/bootstrap');
// mix.copyDirectory(['node_modules/admin-lte/dist'], 'public/vendor/admin-lte/dist');
// mix.copyDirectory(['node_modules/admin-lte/plugins'], 'public/vendor/admin-lte/plugins');
mix.copy(['node_modules/jquery/dist/jquery.js', 'node_modules/jquery/dist/jquery.min.js'], 'public/vendor/jquery');
mix.copy(['node_modules/animate.css/animate.css', 'node_modules/animate.css/animate.min.css'], 'public/vendor/animate-css');
mix.copy(['node_modules/@zeitiger/elevatezoom/jquery.*.js'], 'public/vendor/elevatezoom');
mix.copy(['node_modules/device.js/dist/*'], 'public/vendor/device-js');
mix.copy(['node_modules/flexslider/*.css', 'node_modules/flexslider/*.js'], 'public/vendor/flexslider');
mix.copy(['node_modules/jquery-plugin-viewport-checker/dist/*'], 'public/vendor/viewport-checker');
mix.copy(['node_modules/jquery.stellar/jquery.stellar.js'], 'public/vendor/jquery-stellar');

//mix.webpackConfig({
//    resolve: {
//        modules: [
//            path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js')
//        ]
//    }
//});


