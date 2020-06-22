
jQuery(document).ready(function () {
    var flaguploading = false;

    function upload_filer() {
        $('#fine-uploader-gallery').fineUploader({
            template: 'qq-template-gallery',
            //element: $("#gallery-list"),
            listElement: $("#gallery-list"),
            //fileTemplate: 'qq-filetemplate-gallery',
            request: {
                endpoint: 'en/upload/gallery',
                params: {
                    '_token': $('input[name="_token"]').val(),
                    //'csrf_name': '_token',
                    //'csrf_xname': 'XSRF-TOKEN',
                },
            },
            thumbnails: {
                placeholders: {
                    waitingPath: 'cp/js/plugins/fineuploader/placeholders/waiting-generic.png',
                    notAvailablePath: 'cp/js/plugins/fineuploader/placeholders/not_available-generic.png'
                }
            },
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
                sizeLimit: 20971520
            },
            //folders: true,
            chunking: {
                enabled: true,
                partSize: 1000000,
                concurrent: {
                    enabled: true
                },
                success: {
                    endpoint: "http://dcetest.com/new_attar/includes/fineuploader/endpoint.php?done=true"
                }
            },
            resume: {
                enabled: true
            },
            //autoUpload: false
        }).on('progress', function (event, id, name, responseJSON) {
            flaguploading = true;
        }).on('totalProgress', function (event, totalUploadedBytes, totalBytes) {
          if (totalUploadedBytes < totalBytes) {
            progress = Math.round(totalUploadedBytes /
              totalBytes * 100) + '%';
            $('.tot_bar').css('width',progress);
          }
        }).on('cancel', function (event, id, name, responseJSON) {
            flaguploading = false;
        }).on('complete', function (event, id, name, responseJSON) {
            jQuery('.gallery-item[qq-file-id='+id+']').find('.hdnfile').val(responseJSON.file_name);
            jQuery('.gallery-item[qq-file-id='+id+']').find('.cover-img>.radiocheckbox').val(responseJSON.file_name);
        }).on('allComplete', function (event, id, name, responseJSON) {
            $('.tot_bar').css('width','0');
            flaguploading = false;
        }).on('uploadChunkSuccess', function (event, id, chunkData, responseJSON) {
            jQuery('.gallery-item[qq-file-id='+id+']').find('.hdnfile').val(responseJSON.file_name);
            jQuery('.gallery-item[qq-file-id='+id+']').find('.cover-img>.radiocheckbox').val(responseJSON.file_name);
        });
    }
    window.upload_filer = upload_filer;
    upload_filer();

    function check_uploading()
    {
        return flaguploading;
    }
    window.check_uploading = check_uploading;
    
});