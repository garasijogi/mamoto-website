// buttons
const btnPromo_addPromo = $('.btn-promo-add'); // btn for showing add modal
const btnPromo_edit = '.btn-promo-edit'; // btn for edit promo
const btnPromo_remove = '.btn-promo-remove'; // btn for remove promo
const btnPromo_removeAll = $('.btn-promo-removeAll'); // btn for removing all promos
const btnPromo_submit = $('.btn-promo-submit');

// buttons content
const btnContent_add = '<i class="fa fa-plus-circle"></i>&#09;Tambahkan Promo';
const btnContent_edit = '<i class="fa fa-pencil-alt"></i>&#09;Edit Promo';

// containers
const container_promo_row = $('.promo-content');
const container_promo_contentNo = $('.container-promo-contentNo');
const container_promo_content = $('.container-promo-content');

// flags
let flag_previousRetrieveNull = false;

// input variables
const input_name = $('input[name="name"]');
const textarea_post = $('textarea[name="post"]');
const textarea_link = $('textarea[name="link"]');
const input_image = $('input[name="photo"]');
let edit_promo_id; // id promo container for editor
let edit_promo_originPhoto; // container original photo

// cropper variables
var cropper;
const image_promo = $('.rr-promo-add-image');
const image_promo_container = $('.image-promo-container');
const image_promo_stack = $('.rr-promo-add-image-stack');
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
const formPromo = $('#formPromo');

// image default
const image_default = $('input[name="image_default"]').val();

// modals
const modal_promo = $('#modal_promo');

// overlay
const overlay_promo_modal = $('.overlay-promo-modal');

// spinner
const spinner_promo = $('.promo-spinner');

// toggles
let toggle_form = 'add';

// token csrf untuk ajax request
const token_csrf = $('input[name="token_csrf"]').val();

// url variables
const url_formAdd = $('input[name="url_formAdd"]').val();
const url_formEdit = $('input[name="url_formEdit"]').val();
const url_get = $('input[name="url_get"]').val();
const url_getOnce = $('input[name="url_getOnce"]').val();
const url_remove = $('input[name="url_remove"]').val();
const url_removeAll = $('input[name="url_removeAll"]').val();
let url_next = "";

// ubah locale moment
// moment.lang('id');