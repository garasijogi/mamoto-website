// this file contains variables listed to use for about javascripts
/* Summernote Intitialization and Validation */
var summernoteForm = $('#aboutForm');
var summernoteElement = $('#post');
var summernoteSaveButton = $('#saveAbout');
var about_url = $('input[name="about_url"]').val();
var token_csrf = $('input[name="token_csrf"]').val();

// variable initialization for file uploader
var upload_url = $('input[name="upload_url"]').val();
var allowedTypes = "pdf,doc,docx,ppt,pptx,xps,odt,xls,xlsx,wps,jpg,jpeg,gif,png";
var path = $('input[name="upload_path"]');