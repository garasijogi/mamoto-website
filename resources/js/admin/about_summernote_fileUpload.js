var upload_url = $('input[name="upload_url"]').val();
var allowedTypes = "pdf,doc,docx,ppt,pptx,xps,odt,xls,xlsx,wps,jpg,jpeg,gif,png";

$("#fileuploader").uploadFile({
    headers: {
        'X-CSRF-TOKEN': token_csrf // this is from "about_summernote.js"
    },
   url: upload_url,
   allowedTypes: allowedTypes,
   dragdropWidth: "100%",
   fileName:"myfile",
   // formData: { 
   //     path: path,
   //     session_name: session_name,
   //     files: files,
   //     flag_upload_new: flag_upload_new
   // },
   dynamicFormData: function()
   {
       var data ={ 
           path: path,
           files: files,
           flag_upload_new: flag_upload_new
       }
       return data;
   },
   multiple: true,
   showStatusAfterSuccess: false,
   showProgress: true,
   sequentialCount:1,
   onLoad:function(obj)
   {
           // console.log(files);
   },
   onSubmit:function(files_jqxhr)
   {
       //files_jqxhr : List of files to be uploaded
       //return flase;   to stop upload
   },
   onSuccess:function(files_jqxhr,data,xhr,pd)
   {
       // if success uploaded file
       //files_jqxhr: list of files
       //data: response from server
       //xhr : jquer xhr object
   },
   afterUploadAll:function(obj)
   {
       //You can get data of the plugin using obj
       Swal.fire({
           icon: 'success',
           title: 'Completed',
           text: "The File was successfully uploaded",
       });
   },
   onError: function(files_jqxhr,status,errMsg,pd)
   {
       //files_jqxhr: list of files
       //status: error status
       //errMsg: error message
       Swal.fire({
           icon: 'error',
           title: 'Oops, Something went wrong!',
           text: errMsg,
       });
   }
});

function popup(){
    Swal.fire({
    icon: 'success',
    title: 'yaya',
    text: 'sjahdska'
    });
}