

jQuery(document).ready(function() {
    /*UploadImageGallery.init();*/
    var imgs_items = [];
    window.imgs_items = imgs_items;
    jQuery(document).on("click", ".remove-galleryimg",function() {
		var thisclick = jQuery(this);
		/*var img_name = thisclick.parents('.gallery-item').attr('data-imgname');
		imgs_items.pop(img_name);
		thisclick.parents('.gallery-item').remove();*/
		bootbox.confirm("Are you sure?", function(result) {
			if(result==true)
			{
				var img_name = thisclick.parents('.gallery-item').attr('data-imgname');
				imgs_items.pop(img_name);
				thisclick.parents('.gallery-item').remove();
			}
		});
	});

    function upload_filer() {

    	jQuery(document).on("click", ".upload-gallery-file",function() {
			/*var thisclick = jQuery(this);
			thisclick.parent().find('.upload-gallery-file').click();
			return false;*/
		});
    	
		jQuery(document).on("change",".upload-gallery-file" ,function() {
	    	var thisclick = jQuery(this);
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	 		for(var i=0;i<files.length;++i)
	 		{
		        if (/^image/.test(files[i].type)){ // only image file
		            var reader = new FileReader(); // instance of the FileReader
		            reader.readAsDataURL(files[i]); // read the local file
		 			var filename = "";
		 			reader.fileName = files[i].name;
		            reader.onloadend = function(readerEvt){ // set image data as background of div
		            	//var filename = readerEvt.target.fileName;
		            	var targetImage=this.result;
		            	filename = readerEvt.target.fileName;
		            	var html = '<div class="col-md-4 gallery-item" data-imgname="'+filename+'">\
				            <div class="portlet box green">\
				                <div class="portlet-title gallery-title">\
				                    <div class="caption">\
				                        <i class="fa fa-info-circle"></i>Gallery Item</div>\
				                    <div class="tools">\
				                        <div class="cover-img tooltip-one-info" title="Cover Photo">\
				                            <input type="radio" value="'+filename+'" name="GallMed_IsHighlighted" data-objectname="GallMed_IsHighlighted" class="checkboxnostyle radiocheckbox" />\
				                            <i class="flaticon-picture110"></i>\
				                        </div>\
				                        <a href="javascript:;" class="tooltip-one-info remove-galleryimg" title="Remove"><i class="fa fa-close"></i></a>\
				                    </div>\
				                </div>\
				                <div class="portlet-body form">\
				                    <!-- BEGIN FORM-->\
				                    <div class="horizontal-form">\
				                        <div class="form-body">\
				                            <div class="gallery-rg">\
				                                <div class="gallery-img">\
				                                    <img src="'+targetImage+'" />\
				                                    <input type="hidden" class="hdnfile" data-objectname="hdnfile" name="hdnfile[]"value="' + targetImage + '" />\
				                                </div>\
				                                <div class="form-group input-wlbl">\
				                                    <span class="lblinput">Title</span>\
				                                    <input type="text" id="gallery_item_title_'+filename+'" class="form-control" placeholder="" />\
				                    				<input type="hidden" data-objectname="title" name="gallery_item['+filename+'][title][en]" lang="en" />\
				                    				<input type="hidden" data-objectname="title" name="gallery_item['+filename+'][title][ar]" lang="ar" />\
				                                </div>\
				                                <div class="form-group input-wlbl">\
				                                    <span class="lblinput">Description</span>\
				                                    <textarea type="text" id="gallery_item_description_'+filename+'" class="form-control" placeholder=""></textarea>\
				                    				<input type="hidden" data-objectname="description" name="gallery_item['+filename+'][description][en]" lang="en" />\
				                    				<input type="hidden" data-objectname="description" name="gallery_item['+filename+'][description][ar]" lang="ar" />\
				                                </div>\
												<input type="hidden" class="abc" data-objectname="link" id="gallery_item_link_'+filename+'" name="gallery_item['+filename+'][link]" value="" />\
												<input type="hidden" class="GallMed_ID" data-objectname="GallMed_ID" id="gallery_item_id_'+filename+'" name="gallery_item['+filename+'][GallMed_ID]" value="" />\
												<input type="hidden" data-objectname="image" id="gallery_item_link_'+filename+'" name="gallery_item['+filename+'][image]" value="" />\
												<input type="hidden" data-objectname="id" name="gallery_item['+filename+'][id]" value="" />\
				                            </div><!-- gallery rg -->\
				                        </div><!--form body-->\
				                    </div><!-- END FORM-->\
				                </div><!--portlet form-->\
				            </div><!--portlet box-->\
				        </div><!--span-->';
			 			var found = jQuery.inArray(filename, imgs_items);
						if (found >= 0) {
						    imgs_items.splice(found, 1);
						} else {
						    imgs_items.push(filename);
						    jQuery('.gallery-list').prepend(html);
						}
						/*jQuery('.gallery-list').prepend(html);*/
		                mytooltipster();
		            }
		        }
		        else
		        {
		        	alert(filename+" Is Not Image");
		        }
	    	}
	    	thisclick.val('');
	    });
	}
	window.upload_filer = upload_filer;
    upload_filer();
});