const token_csrf=$('input[name="token_csrf"]').val(),url_save=$('input[name="url_save"]').val(),class_contactInput=".input-edit",class_inputGroup_contact=".input-group-contact",class_edit=".contact-edit";className_edit="contact-edit";const btn_submit=$(".contact-submit"),input_edit=$(".input-edit"),td_edit=$(".contact-edit"),Toast=Swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:t=>{t.addEventListener("mouseenter",Swal.stopTimer),t.addEventListener("mouseleave",Swal.resumeTimer)}});td_edit.on("click",function(){$(this).hide(),$(this).siblings(".input-group-contact").fadeIn()}),btn_submit.on("click",function(){const t=$(this).parents(".input-group-contact").siblings(class_edit),n=$(this).parent().siblings(".input-edit"),i=$(this).parents(".input-group-contact");let e=t.data("id"),s=n.data("input"),a=n.val();""==a||null==a?Toast.fire({icon:"error",title:"Kontak tidak boleh kosong."}):saveContact(e,s,a,t,i)}),input_edit.on("keyup",function(t){if("Enter"===t.key){const t=$(this).parents(".input-group-contact").siblings(class_edit),n=$(this).parents(".input-group-contact");let i=t.data("id"),e=$(this).data("input"),s=$(this).val();""==s||null==s?Toast.fire({icon:"error",title:"Tidak boleh kosong."}):saveContact(i,e,s,t,n)}});const saveContact=(t,n,i,e,s)=>{$.ajax({headers:{"X-CSRF-TOKEN":token_csrf},url:url_save,data:{id:t,input_name:n,value:i},method:"POST",beforeSend:function(){e.parent().append('<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>'),s.hide()},complete:function(){e.siblings(".spinner-grow").remove(),e.fadeIn()},success:function(){e.text(i),Toast.fire({icon:"success",title:"Perubahan berhasil disimpan"})},error:function(t){Toast.fire({icon:"error",title:"Something went wrong!"})}})};
