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

/*mix.js('resources/js/files.js', 'public/js').version();*/
/*mix.js('resources/js/dialog.js', 'public/js').version()
    .disableNotifications().webpackConfig({
    output: {
        library: 'Dialog',
        libraryTarget: 'umd',
        umdNamedDefine: true
    }
})*/
/*mix.js('resources/js/convertDocx.js', 'public/js').disableNotifications();*/
mix.js('resources/js/convertDocxEdit.js', 'public/js').disableNotifications().webpackConfig({ resolve: { fallback: { fs: false } } });

