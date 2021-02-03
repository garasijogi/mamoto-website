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

mix.js('resources/js/app.js', 'public/js');

/* --------------------------- about script mixer --------------------------- */
mix.scripts([
        'resources/js/admin/about_summernote.js',
    ], 'public/js/admin/about.js');
/* --------------------------- admin script mixer --------------------------- */
mix.scripts([
        'resources/js/admin/swal_toast.js', // toast using sweet alert2
    ], 'public/js/admin/_admin.js')
/* ------------------------ summernote custom script ------------------------ */
/**
 * This summernote custom script added responsive to video and image
 */
mix.copy('resources/js/admin/summernote-custom/summernote-bs4.js', 'public/vendor/summernote/summernote-bs4.js')

mix.sass('resources/sass/app.scss', 'public/css');
