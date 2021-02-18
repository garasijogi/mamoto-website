// place for variables
const btnPromo_add = $('.btn-promo-add'); // btn for showing add modal
const btnPromo_remove = $('.btn-promo-remove'); // btn for removing all promos

// input variables
const input_image = $('input[name="photo"]');

// cropper variables
var cropper;
const image_promo = $('.rr-promo-add-image');
const image_promo_container = $('.image-promo-container');
const image_cropper = document.getElementById('cropper');
const image_cropper_btn = $('.image-cropper-btn');
const image_cropper_btn_cancel = $('.image-cropper-btn-cancel');
const image_cropper_btn_zoomIn = $('#cropperZoomIn');
const image_cropper_btn_zoomOut = $('#cropperZoomOut');
const image_cropper_btn_rotateLeft = $('#cropperRotateLeft');
const image_cropper_btn_rotateRight = $('#cropperRotateRight');
const image_cropper_btn_modeDrag = $('#cropperModeDrag');
const image_cropper_btn_modeCrop = $('#cropperModeCrop');
const image_cropper_container = $('.image-cropper-container');
const image_input = $('#inputImage');
const image_spinner_src = $('input[name="spinner"]').val();

// form
const formAddPromo = $('#formAddPromo');

// image default
const image_default = $('input[name="image_default"]').val();

// modals
const modal_addPromo = $('#modal_addPromo');

// url variables
const url_formAdd = $('input[name="url_formAdd"]').val();

// token csrf untuk ajax request
const token_csrf = $('input[name="token_csrf"]').val();