td_edit.on('click', function(){
  $(this).hide();
  $(this).siblings(class_inputGroup_contact).fadeIn();
});

btn_submit.on('click', function(){
  const el_p = $(this).parents(class_inputGroup_contact).siblings(class_edit);
  const el_input = $(this).parent().siblings(class_contactInput);
  const el_editor = $(this).parents(class_inputGroup_contact);

  let id = el_p.data('id');
  let input_name = el_input.data('input');
  let value = el_input.val();

  if(value == "" || value == null){
    Toast.fire({ icon: 'error', title: 'Kontak tidak boleh kosong.' });
  } else {
    saveContact(id, input_name, value, el_p, el_editor);
  }
});

input_edit.on('keyup', function(e){
  if (e.key === 'Enter') {
    const el_p = $(this).parents(class_inputGroup_contact).siblings(class_edit);
    const el_editor = $(this).parents(class_inputGroup_contact);

    let id = el_p.data('id');
    let input_name = $(this).data('input');
    let value = $(this).val();

    if(value == "" || value == null){
      Toast.fire({ icon: 'error', title: 'Tidak boleh kosong.' });
    } else {
      saveContact(id, input_name, value, el_p, el_editor);
    }
  }
});

/* -------------------------------- function -------------------------------- */
// untuk menyimpan data ke database
const saveContact = (id, input_name, value, el_p, el_editor) => {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': token_csrf
    },
    url: url_save,
    data: {
      id: id,
      input_name: input_name,
      value: value,
    },
    method: 'POST',
    beforeSend: function(){
      el_p.parent().append('<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>');
      el_editor.hide();
    },
    complete: function(){
      el_p.siblings('.spinner-grow').remove();
      el_p.fadeIn();
    },
    success: function(){
      el_p.text(value);
      Toast.fire({ icon: 'success', title: 'Perubahan berhasil disimpan' });
    },
    error: function(e){
      Toast.fire({ icon: 'error', title: 'Something went wrong!' });
    }
  })
}