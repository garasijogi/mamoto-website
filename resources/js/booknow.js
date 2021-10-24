/* ------------------------------ dependencies ------------------------------ */
// jquery validate from booknow.blade

/* -------------------------------- variables ------------------------------- */
// data
const books_packages = JSON.parse($('input[name="books_packages"]').val());
const contactWa = JSON.parse($('input[name="contact_wa"]').val());
let urlWa;
// trigger
const formBookNow = $('#formBookNow');
const kisaranBudgetDropdown = $('select[name="kisaran_budget"]');
const pilihPaketDropdown = $('select[name="pilih_paket"]');
const submitBooking = $('button[type="submit"]');
// text
let kisaranBudgetText = kisaranBudgetDropdown.children($('option[value=""]')).text(); // select text on child element
let phoneNumberInvalidMessage = "Please enter a valid phone number";


/* ------------------------ document on load function ----------------------- */
$(function () {
	getProducts();

    $(".datepicker").datepicker({
        format: "dd MM yyyy",
        autoclose: true,
        clearBtn: true,
        orientation: 'bottom',
        startDate: new Date(),
        todayHighlight: true,
        zIndexOffset: 1000,
    })
});

/* --------------------------------- triggers ------------------------------- */
pilihPaketDropdown.on('change', function(e) {
	getProducts();
});
// validation
formBookNow.validate({
	rules: {
		name: {
			required: true
		},
		phone: {
			required: true,
            number: true
		},
		email: {
			required: true,
            email: true
		},
        pilih_paket: {
            required: true
        },
        kisaran_budget: {
            required: true
        },
        booking_date: {
            required: true
        },
        location: {
            required: true
        },
	},
    messages: {
        phone: {
            number: phoneNumberInvalidMessage
        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    invalidHandler: function(form, validator) {
        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top - 300
        }, 1000);
    },
    submitHandler: function(form) {
        // ambil semua data form
        let formData = {
            name: form.name.value,
            phone: form.phone.value,
            email: form.email.value,
            pilih_paket: form.pilih_paket.value,
            kisaran_budget: form.kisaran_budget.value,
            booking_date: form.booking_date.value,
            location: form.location.value,
            note: form.note.value,
        };

        // buat template message
        let msgBookNow = `Hai Mamoto, saya ingin memesan jasa foto untuk acara saya.

Berikut data diri saya,
Nama: *${formData.name}*
Telepon: ${formData.phone}
E-mail: ${formData.email}
Pilihan Paket: ${formData.pilih_paket}
Kisaran Budget: ${formData.kisaran_budget}
Tanggal _Booking_: ${formData.booking_date}
Lokasi: ${formData.location}

`;
        // tambah note jika ada
        if(form.note === null || form.note === undefined || form.note === "") {
            // nothing
        } else {
            msgBookNow = msgBookNow + `Catatan Tambahan:
${formData.note}`;
        }
        // encode URL
        msgBookNow = encodeURI(msgBookNow);
        // susun url
        urlWa = contactWa.link + contactWa.contact + `/?text=${msgBookNow}`;
        window.location.href = urlWa; // arahkan ke URL

        return false;

    }
});

/* -------------------------------- functions ------------------------------- */

const getProducts = function getProducts() {
	let choosenPaket = pilihPaketDropdown.val();
	let choosenDetailPaket;
	books_packages.forEach((value, index) => {
		const { id, budgets } = value;
		if (id === choosenPaket) {
			return choosenDetailPaket = JSON.parse(budgets);
		}
	});

	// hapus semua options lalu tambahkan satu option default dan select option tersebut
	kisaranBudgetDropdown.find('option')
	.remove()
	.end()
	.append(`<option value="" >${kisaranBudgetText}</option>`)
	.val('');

	if (choosenDetailPaket === undefined || choosenDetailPaket === null || choosenDetailPaket === "") {
		kisaranBudgetDropdown.prop('disabled', true);
	} else {
		kisaranBudgetDropdown.prop('disabled', false);

		// masukkan data choosenDetailPaket ke estimate budget dropdown
		choosenDetailPaket.forEach((value, index) => {
			let el = numberWithDots(value.price) + "K" + " - " + value.name;
			kisaranBudgetDropdown.append(`<option value="${el}" >${el}</option>`);
		});
	}
};

const numberWithDots = (x) => {
	var parts = x.toString();
	parts = parts.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	return parts;
}
