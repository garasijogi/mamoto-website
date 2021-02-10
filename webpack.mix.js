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

/* -------------------------------------------------------------------------- */
/*                               master section                               */
/* -------------------------------------------------------------------------- */
mix.sass('resources/sass/app.scss', 'public/css'); // master app styles
mix.js('resources/js/app.js', 'public/js'); // master app scripts

/* --------------------------- admin script mixer --------------------------- */
mix.scripts([
    'resources/js/admin/swal_toast.js', // toast using sweet alert2
], 'public/js/admin/_admin.js')


/* -------------------------------------------------------------------------- */
/*                                   plugin                                   */
/* -------------------------------------------------------------------------- */
/**
 * place custom plugin script that cannot be covered by npm right here
 */

/* ------------------------ summernote custom script ------------------------ */
/**
 * This summernote custom script added responsive to video and image
 */
mix.copy('resources/js/admin/_plugins/summernote-custom/summernote-bs4.js', 'public/vendor/summernote/summernote-bs4.js');
mix.copy('resources/js/admin/_plugins/summernote-gallery/summernote-gallery.min.js', 'public/js/admin/summernote-gallery/summernote-gallery.min.js');

/* ------------------------------ other plugin ------------------------------ */
mix.copy('resources/js/admin/_plugins/jquery-file-upload', 'public/js/admin/jquery-file-upload'); // jquery file upload

/* -------------------------------------------------------------------------- */
/*                                module script                               */
/* -------------------------------------------------------------------------- */
/**
 * add your module scripts right here, please sort it by A-Z
 */

/* --------------------------- about script mixer --------------------------- */
// admin styles
mix.styles(
    [
        'resources/css/admin/about.css',
        'resources/css/admin/imageViewer.css',
    ],
    'public/css/admin/about.css'
);
// public site styles
mix.styles('resources/css/about.css', 'public/css/about.css');
mix.scripts(
    [
        "resources/js/admin/about/about__initial.js",
        "resources/js/admin/about/about_summernote.js",
        "resources/js/admin/about/about_gallery.js",
        "resources/js/admin/about/about_upload.js",
        "resources/js/admin/jquery-fileUpload.js",
        "resources/js/admin/modal-imageViewer.js"
    ],
    "public/js/admin/about.js"
);
