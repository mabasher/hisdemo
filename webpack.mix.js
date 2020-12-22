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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/template/css/bootstrap.min.css',
    'public/template/font-awesome/css/font-awesome.min.css',
    'public/template/plugins/cubeportfolio/css/cubeportfolio.min.css',
    'public/template/css/nivo-lightbox.css',
    'public/template/css/nivo-lightbox-theme/default/default.css',
    'public/template/css/owl.carousel.css',
    'public/template/css/owl.theme.css',
    'public/template/css/animate.css',
    'public/template/css/style.css',
    'public/template/color/default.css',
], 'public/css/template.css')
.scripts([
    'public/template/js/jquery.min.js',
    'public/template/js/bootstrap.min.js',
    'public/template/js/jquery.easing.min.js',
    'public/template/js/wow.min.js',
    'public/template/js/jquery.scrollTo.js',
    'public/template/js/jquery.appear.js',
    'public/template/js/stellar.js',
    'public/template/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js',
    'public/template/js/owl.carousel.min.js',
    'public/template/js/nivo-lightbox.min.js',
], 'public/js/template.js');
    // 'public/template/js/custom.js',
    // 'public/template/bodybg/bg1.css',

