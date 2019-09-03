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

mix
    .js('resources/js/app.js', 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css/app.css')
    .copy('resources/images/favicon.png', 'public/images/favicon.png')
    .copy('resources/images/maharlika-full-logo-white.png', 'public/images/logo-full-white.png')
    .copy('resources/images/maharlika-full-logo-white.png', 'public/images/logo-full-white2x.png')
    .copy('resources/images/maharlika-full-logo-colored.png', 'public/images/logo.png')
    .copy('resources/images/maharlika-full-logo-colored.png', 'public/images/logo2x.png')
    .copy('resources/images/maharlika-logo-white.png', 'public/images/maharlika-logo-white.png');

if (mix.inProduction()) {
    mix.version();
}
