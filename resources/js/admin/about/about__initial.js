// this file contains variables listed to use for about javascripts
/* Summernote Intitialization and Validation */
var summernoteForm       = $('#aboutForm');
var summernoteElement    = $('#post');
var summernoteSaveButton = $('#saveAbout');
// url and token
var about_url  = $('input[name="about_url"]').val();
var token_csrf = $('input[name="token_csrf"]').val();
// selectors
var btn_showGallery = $('#showGallery');
var btn_showImage = $('.btn-image-view');
var btn_deleteImage = $('.btn-image-delete');
var gallery_content = $('.gallery-content');
var modal_gallery   = $('#modalGallery');
var modal_galleryPaginate = 1;
var icon_save = $('.saveIcon');

// variable initialization for file uploader
var allowedTypes    = "pdf,doc,docx,ppt,pptx,xps,odt,xls,xlsx,wps,jpg,jpeg,gif,png";
var index           = '/_gallery.json';                                               // untuk membuat file indexer
var path            = 'gallery/about';                                                // definisikan upload pathnya
var upload_url      = $('input[name="upload_url"]').val();
var url_getIndex    = $('input[name="url_getIndex"]').val();
var url_path        = $('input[name="url_path"]').val();