/**
* JQUERY File Upload by Hayageek, configurations
* ref: https://github.com/hayageek/jquery-upload-file
*/

// variable needed, please add it on your first initial variables, for example see about__initial.js
// var allowedTypes = "pdf,doc,docx,ppt,pptx,xps,odt,xls,xlsx,wps,jpg,jpeg,gif,png"; // file types allowed to upload
// var path = $('input[name="upload_path"]').val(); // path to save it on the server
// var index = $('input[name="file_index"]').val() // untuk membuat file indexer
// var token_csrf = $('input[name="token_csrf]').val(); // token required by laravel
// var upload_url = $('input[name="upload_url"]').val(); // upload url path

$("#fileuploader").uploadFile({
    headers: {
        'X-CSRF-TOKEN': token_csrf // token csrf required by laravel
    },
    url: upload_url,
    allowedTypes: allowedTypes,
    dragdropWidth: "100%",
    fileName:"myfile",
    // formData: { // static form data, uploader will not fetch the new data on variables
    //     path: path,
    //     session_name: session_name,
    //     files: files,
    //     flag_upload_new: flag_upload_new
    // },
    dynamicFormData: function() // uploader will always check for the variables first and its change before prepare it send to the server
    {
        // data send to server
        var data ={ 
            path: path,
            index:index,
            //    files: files,// if using session, the json string, placed it right here
            //    flag_upload_new: flag_upload_new // flag if server needed to identify if this is the new upload task
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
        afterUpload(obj); // add this function, something like add notification or anything else
    },
    onError: function(files_jqxhr,status,errMsg,pd)
    {
        //files_jqxhr: list of files
        //status: error status
        //errMsg: error message
        afterError(files_jqxhr,status,errMsg,pd); // add this function, something like add notification or anything else
    }
});