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
mix.js([
    'resources/js/admin/_admin.js',
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
mix.copy('resources/js/admin/_plugins/summernote', 'public/vendor/summernote'); // copy all summernote package files
mix.copy('resources/js/admin/_plugins/summernote-custom/summernote-bs4.min.js', 'public/vendor/summernote/summernote-bs4.min.js'); // copy customized summernote javascript
mix.copy('resources/js/admin/_plugins/summernote-gallery/summernote-gallery.min.js', 'public/js/admin/summernote-gallery/summernote-gallery.min.js');

/* ------------------------------ other plugin ------------------------------ */
mix.copy('resources/js/admin/_plugins/jquery-file-upload', 'public/js/admin/jquery-file-upload'); // jquery file upload
mix.copy('./node_modules/jquery-validation/dist/jquery.validate.min.js', 'public/js/admin/jquery-validate/');
mix.copy('./node_modules/jquery-validation/dist/additional-methods.min.js', 'public/js/admin/jquery-validate/');

/* -------------------------------------------------------------------------- */
/*                                module script                               */
/* -------------------------------------------------------------------------- */
/**
 * add your module scripts right here, please sort it by A-Z
 */

/* -------------------------- rr styles and scripts ------------------------- */
mix.styles('resources/css/rr.css', 'public/css/rr.css');

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
mix.scripts(
    [
        "resources/js/admin/about/about__initial.js",
        // "resources/js/admin/about/about__plugins.js",
        'resources/js/admin/swal_toast.js', // toast using sweet alert2
        "resources/js/admin/about/about_summernote.js",
        "resources/js/admin/about/about_gallery.js",
        "resources/js/admin/about/about_upload.js",
        "resources/js/admin/jquery-fileUpload.js",
        "resources/js/admin/modal-imageViewer.js"
    ],
    "public/js/admin/about.js"
);

/* -------------------------- contact scripts mixer ------------------------- */
mix.styles('resources/css/contact.css', 'public/css/contact.css'); // userpage css
mix.js('resources/js/admin/contact/contact__plugins.js', 'public/js/admin/contact_plugins.js');
mix.scripts(
    [
        'resources/js/admin/contact/contact__initial.js',
        'resources/js/admin/swal_toast.js', // toast using sweet alert2
        'resources/js/admin/contact/contact_index.js',
    ],
    'public/js/admin/contact.js'
);

/* --------------------------- promo scripts mixer -------------------------- */
mix.styles(
    [
        'resources/css/admin/promo.css',
        'resources/css/admin/imageViewer.css',
    ],
    'public/css/admin/promo.css'
);
mix.styles([
        'resources/css/promo.css',
        'resources/css/admin/imageViewer.css'
    ], 
    'public/css/promo.css'
);
mix.js('resources/js/promo.js', 'public/js/promo.js'); // script untuk di userpage
mix.scripts([
        'public/js/promo.js',
        "resources/js/admin/modal-imageViewer.js",
    ],
    'public/js/promo.js'
)
mix.scripts(
    [
        'resources/js/admin/promo/promo__initial.js',
        'resources/js/admin/swal_toast.js', // toast using sweet alert2
        'resources/js/admin/promo/promo_index.js',
    ],
    'public/js/admin/promo.js'
);
mix.js('./resources/js/admin/promo/promo__plugins.js', './public/js/admin/promo_plugins.js');
// mix.copy('node_modules/cropperjs/dist/cropper.min.css', './public/js/admin/cropperjs/cropper.min.css');
// mix.copy('node_modules/cropperjs/dist/cropper.min.css', './public/js/admin/cropperjs/cropper.min.css');