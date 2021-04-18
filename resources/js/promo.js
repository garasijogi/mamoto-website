window.$ = require('jquery');
import 'bootstrap/dist/js/bootstrap.bundle';

// element classes
const btn_booking    = '.promo-btn';
const promo_moreInfo = '.promo-moreInfo';
const promo_cards    = '.promo-cards';
const promo_showImg = '.promo-showImage';

// element selectors
const modalPromo   = $('#showPromo');
const modalPromo_title = $('#showPromoLabel');
const modalPromo_btn = $('#showPromoImg');
const modalPromo_post = $('#promoPost');
const overlay = $('.overlay-promo-modal');
const promo_noPromo = $('.promo-noPromo');
const row_promo     = $('.row-promo');
const spinner       = $('.promo-spinner');

// input values
const image_default = $('input[name="image_default"]').val();
const token_csrf  = $('input[name="token_csrf"]').val();
const url_get     = $('input[name="url_get"]').val();
const url_getOnce = $('input[name="url_getOnce"]').val();

// toggles and variables
let toggle_scroll = true;
let toggle_previousNull = false;
let url_next;

row_promo.on('click',btn_booking , function(e){
  let link = $(this).data('link');
  window.location.href = link;
});
// link more info
row_promo.on('click', promo_moreInfo, function () {
  let id = $(this).parents(promo_cards).data('id');
  overlay.show();
  modalPromo.modal('show');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': token_csrf
    },
    url: url_getOnce,
    data: {
      id: id
    },
    method: 'POST',
    complete: function(){
      overlay.fadeOut();
    }, 
    success: function(data){
      modalPromo_title.text(data.name);
      modalPromo_btn.data('link', data.link);
      modalPromo_post.text(data.post);
    },
    error: function(){
      console.log('error, please contact website admin.')
    }
  })
});
// image viewer
row_promo.on('click', promo_showImg, function(){
  let imgSrc = $(this).attr('data-imgSrc');
  let imgTitle = $(this).attr('data-imgTitle');
  console.log(imgSrc);
  console.log(imgTitle);
  showImage(imgSrc, imgTitle);
});
// close modal action
modalPromo.on('hidden.bs.modal', function (event) {
  modalPromo_title.text('Promo');
  modalPromo_btn.data('link', '#');
  modalPromo_post.text('Keterangan');
})


// document on load function
$(function () {
  getPromo();
});

// AJAX handler
const getPromo = (url=url_get) => {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': token_csrf
    },
    url: url,
    method: 'GET',
    beforeSend: function(){
      toggle_scroll = false;
    },
    success: function(data){
      url_next = data.next_page_url
      if (url_next == null || url_next == undefined || url_next == "") {
        spinner.hide();
      } else {
        toggle_scroll = true;
      }
      // cek apa datanya ada
      if (data.data == [] || data.data == "" || data.data == null || data.data == undefined) {
        promo_noPromo.show();
        toggle_previousNull = true; // nyalakan flag
      } else {
        // apabila data ada tapi sebelumnya datanya belum ada
        if (toggle_previousNull == true) {
          promo_noPromo.hide();
          toggle_previousNull = false; // matikan flag
        }
        $.each(data.data, function (index, value) {
          row_promo.append('<div class="col-lg-4 promo-cards mb-5" data-id="' + value.id + '"><div class="promo-img-container"><div class="promo-img promo-showImage" data-imgSrc="' + value.photo + '" data-imgTitle="' + value.name + '" style="background-image:url(' + value.photo + ');"></div></div><div><div class="text-center"><h3 class="promo-title">' + value.name + ' </h3></div><p class="promo-description">' + value.post + '</p><div class="mb-0 text-secondary text-promo-period">Periode Promo<span class="promo-period"><br>' + value.period_start + ' - ' + value.period_end + '</span></div><p><a class="promo-moreInfo" href="javascript:void(0)">more info</a></p><div class="d-flex justify-content-center"><div class="promo-btn" data-link="' + value.link +'">Book Now</div></div></div></div>');
        });
      }
    },
    error: function(){
      console.log('error');
    }
  })
}

// scroll modal listener
$(window).on("scroll", function () {
  if (url_next == null || url_next == undefined || url_next == "") {
    // nothing
  } else {
    if (toggle_scroll) {
      var scrollHeight = Math.floor($('html').height());
      var scrollPosition = Math.floor($(window).height() + $(window).scrollTop());
      if (scrollPosition >= scrollHeight) {
        getPromo(url_next);
      }
    }
  }
});