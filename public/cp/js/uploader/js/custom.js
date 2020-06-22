$(document).ready(function () {

    //Example 1
    $('#filer_input').filer({
        showThumbs: true
    });
    var index;

    function indexfun(x) {
        if (x == "") {
            index = 0;
        }
        index = x;
        return index;
    }

    /*jQuery(document).on('click','.remove-img',function() {
        jQuery(this).parent().find('.jFiler-item-trash-action').click();
        return false; 
    });*/

    window.indexfun = indexfun;
    function upload_filer() {
        $("#filer_input2").filer({
            limit: null,
            maxSize: null,
            extensions: null,
            changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
            showThumbs: true,
            extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
            appendTo: '.gallery-list',
            theme: "dragdropbox",
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
                item: '<div class="col-md-4 gallery-item jFiler-item" data-imgname="{{fi-name}}" data-jfiler-index="{{fi-id}}">\
                    <div class="portlet box green">\
                        <div class="portlet-title gallery-title">\
                            <div class="caption">\
                                <i class="fa fa-info-circle"></i>Gallery Item</div>\
                            <div class="tools">\
                                <div class="cover-img tooltip-one-info" title="Cover Photo">\
                                    <input type="radio" value="{{fi-name}}" name="GallMed_IsHighlighted" data-objectname="GallMed_IsHighlighted" class="checkboxnostyle radiocheckbox" />\
                                    <i class="flaticon-picture110"></i>\
                                </div>\
                                <a href="javascript:;" class="remove-img2 remove-video" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>\
                            </div>\
                            <script>\
                                mytooltipster();\
							</script>\
                        </div>\
                        <div class="portlet-body form">\
                            <!-- BEGIN FORM-->\
                            <div class="horizontal-form">\
                                <div class="form-body">\
                                    <div class="gallery-rg">\
                                        <div class="gallery-img">\
                                            {{fi-image}}\
                                        </div>\
                                        <div class="form-group input-wlbl">\
                                            <span class="lblinput">Title</span>\
                                            <input type="text" id="gallery_item_title_{{fi-name}}" class="form-control" placeholder="" />\
                            				<input type="hidden" data-objectname="title" name="gallery_item[{{fi-name}}][title][en]" lang="en" />\
                            				<input type="hidden" data-objectname="title" name="gallery_item[{{fi-name}}][title][ar]" lang="ar" />\
                                        </div>\
                                        <div class="form-group input-wlbl">\
                                            <span class="lblinput">Description</span>\
                                            <textarea type="text" id="gallery_item_description_{{fi-name}}" class="form-control" placeholder=""></textarea>\
                            				<input type="hidden" data-objectname="description" name="gallery_item[{{fi-name}}][description][en]" lang="en" />\
                            				<input type="hidden" data-objectname="description" name="gallery_item[{{fi-name}}][description][ar]" lang="ar" />\
                                        </div>\
										<input type="hidden" class="abc" data-objectname="link" id="gallery_item_link_{{fi-name}}" name="gallery_item[{{fi-name}}][link]" value="" />\
										<input type="hidden" class="GallMed_ID" data-objectname="GallMed_ID" id="gallery_item_id_{{fi-name}}" name="gallery_item[{{fi-name}}][GallMed_ID]" value="" />\
										<input type="hidden" data-objectname="image" id="gallery_item_link_{{fi-name}}" name="gallery_item[{{fi-name}}][image]" value="" />\
										<input type="hidden" data-objectname="id" name="gallery_item[{{fi-name}}][id]" value="" />\
                                    </div><!-- gallery rg -->\
                                </div><!--form body-->\
                            </div><!-- END FORM-->\
                        </div><!--portlet form-->\
                    </div><!--portlet box-->\
                </div><!--span-->',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: false,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-items-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    //remove: '.remove-img'
                    //remove: '.jFiler-item-trash-action'
                }
            },
            dragDrop: {
                dragEnter: null,
                dragLeave: null,
                drop: null,
            },
            uploadFile: {
                /*url: "cp-attar/gallery/add-video-item",
                 data: { gallery_id : $('input[type="hidden"][id="Gall_ID"]').val() },
                 type: 'POST',
                 enctype: 'multipart/form-data',
                 beforeSend: function(){
                 },
                 success: function(data, el){
                 el.find('input[id^="gallery_item_link_"]').val(data.GallMed_Link);
                 el.find('input[type="radio"]').val(data.GallMed_ID);
                 el.find('input[id^="gallery_item_id_"]').val(data.GallMed_ID);
                 },
                 error: function(el){
                 var parent = el.find(".jFiler-jProgressBar").parent();
                 el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                 $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
                 });
                 },
                 statusCode: null,
                 onProgress: null,
                 onComplete: null*/
            },
            files: null,
            addMore: false,
            clipBoardPaste: true,
            excludeName: null,
            beforeRender: null,
            afterRender: null,
            beforeShow: null,
            beforeSelect: null,
            onSelect: null,
            afterShow: function (itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
                /*var files=listEl[0].files;
                 var reader  = new FileReader();
                 for(var i=0;i<files.length;++i) {
                 reader.readAsDataURL(files[i]); // read the local file

                 reader.onloadend = function () { // set image data as background of div
                 console.log('x');
                 }
                 }*/

                //console.log(listEl[0].files);
            },
            onRemove: function (itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
                var file = file.name;
                //$.post('./php/remove_file.php', {file: file});
                //$("#filer_input2").trigger("filer.remove", {id:id})
            },
            onEmpty: null,
            options: null,
            captions: {
                button: "Choose Files",
                feedback: "Choose files To Upload",
                feedback2: "files were chosen",
                drop: "Drop file here to Upload",
                removeConfirmation: "Are you sure you want to remove this file?",
                errors: {
                    filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                    filesType: "Only Images are allowed to be uploaded.",
                    filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                    filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
                }
            }
        });
    }

    window.upload_filer = upload_filer;

    //Example 2
    upload_filer();
});
