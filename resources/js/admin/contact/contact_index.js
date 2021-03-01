td_edit.on('click', function(){
  $(this).hide();
  $(this).siblings(class_inputGroup_contact).fadeIn();
});

btn_submit.on('click', function(){
  const el_p = $(this).parents(class_inputGroup_contact).siblings(class_edit);
  const el_input = $(this).parent().siblings(class_contactInput);
  const el_editor = $(this).parents(class_inputGroup_contact);

  let id = el_p.data('id');
  let value = el_input.val();

  saveContact(id, value, el_p, el_editor);
});

input_edit.on('keyup', function(e){
  if (e.key === 'Enter') {
    const el_p = $(this).parents(class_inputGroup_contact).siblings(class_edit);
    const el_editor = $(this).parents(class_inputGroup_contact);

    let id = el_p.data('id');
    let value = $(this).val();

    saveContact(id, value, el_p, el_editor);
  }
});

/* -------------------------------- function -------------------------------- */
const saveContact = (id, value, el_p, el_editor) => {
  // NOW buat ajax function untuk save ke database
  el_p.text(value);
  el_editor.hide();
  el_p.fadeIn();
}