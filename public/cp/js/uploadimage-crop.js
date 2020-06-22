
var UploadImageCrop = function () {

	var handleImageUpload = function() {
		jQuery(".file-imgcrop").on("change", function() {
	    	var thisclick = jQuery(this);
	    	var html = '<span class="rem-imgicon rem-imgcrop"><i class="fa fa-close"></i></span>';
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	 
	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	                thisclick.parents(".upload-image-rg").css("background-image", "url("+this.result+")");
	                thisclick.parents('.upload-image-wcrop').find('.uploadimage-cropped').css("background-image", "url("+this.result+")");
	                thisclick.parents('.upload-image-wcrop').find('.hdn-imgcrop').val(this.result);
	                thisclick.parents('body').find('#image_crop').attr('src', this.result);
	                thisclick.parents('.upload-image-rg').find('.rem-imgcrop').remove();
	                thisclick.parents(".upload-image-rg").prepend(html);
	                thisclick.parents('.upload-image-rg').find('.help-block').remove();
	                thisclick.parents('.upload-image-rg').find('.crop-imgicon').removeClass('display-none');
	                jQuery('#modal_imgcrop').modal('show');
	                thisclick.parents('.uploadimage-crop-area').find('.help-block.error').remove();
	            }
	        }
	        else
	        {
	        	thisclick.val('');
	        	alert("Choose Just Image");
	        }
	    });
    };

    var handleRemoveImage = function() {
    	jQuery(document).on('click','.rem-imgcrop',function() {
    		var thisclick = jQuery(this);
			bootbox.confirm("Are you sure?", function(result) {
				if(result==true)
				{
					thisclick.parents(".upload-image-rg").find('.file-imgcrop').val('');
					thisclick.parents('.upload-image-wcrop').find('.hdn-imgcrop').val(this.result);
    				thisclick.parents(".upload-image-rg").removeAttr('style');
    				thisclick.parents('.upload-image-wcrop').find('.uploadimage-cropped').removeAttr('style');
    				thisclick.parents('.upload-image-rg').find('.crop-imgicon').addClass('display-none');
    				thisclick.remove();
    				Command: toastr["success"]("Article Main Image Removed!", "Success");
				}
			});
    	});
    };

    var handleOpenModalCrop = function() {
    	jQuery(document).on('click','.upload_imgcrop',function() {
    		jQuery('#modal_imgcrop').modal('show');
    	});
	};

	var handleCropLib = function() {
		window.addEventListener('DOMContentLoaded', function () {
		var image = document.getElementById('image_crop');
		var button_save = document.getElementById('btn_save_crop');
		var cropBoxData;
		var canvasData;
		var cropper;

		jQuery('#modal_imgcrop').on('shown.bs.modal', function () {
			cropper = new Cropper(image, {
				/*dragMode: 'move',
		        aspectRatio: 16 / 9,
		        autoCropArea: 0.65,
		        restore: false,
		        guides: false,
		        center: false,
		        highlight: false,
		        cropBoxMovable: false,
		        cropBoxResizable: false,*/
				//autoCropArea: 0.5,
				dragMode: 'move',
				cropBoxResizable: false,
				toggleDragModeOnDblclick: false,
				minContainerWidth: 580,
				minContainerHeight: 460,
				minCropBoxWidth: 540,
				minCropBoxHeight: 400,
				built: function () {
					// Strict mode: set crop box data first
					//cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					//alert(canvasData.width);
					cropper.zoom(0.5);
				}
			});
			jQuery(document).on('click','.btn-zoomin',function() {
				cropper.zoom(0.1);
			});
			jQuery(document).on('click','.btn-zoomout',function() {
				cropper.zoom(-0.1);
			});
			jQuery(document).on('click','.btn-rotateleft',function() {
				cropper.rotate(-45);
			});
			jQuery(document).on('click','.btn-rotateright',function() {
				cropper.rotate(45);
			});
			button_save.onclick = function () {
	          var croppedCanvas;
	          var roundedCanvas;
	          var roundedImage;
	          var img_cropped = document.getElementById('img_cropped');

	          // Crop
	          croppedCanvas = cropper.getCroppedCanvas();
	          var newcropped = croppedCanvas.toDataURL();

	          // Round
	          //roundedCanvas = getRoundedCanvas(croppedCanvas);

	          // Show
	          /*roundedImage = document.createElement('img');
	          roundedImage.src = roundedCanvas.toDataURL()
	          result.innerHTML = '';
	          result.appendChild(roundedImage);*/
	          jQuery('#img_cropped').css('background-image', 'url('+newcropped+')');
	          jQuery('#hdn_imgcrop').val(newcropped);
	          Command: toastr["success"]("Cropped Image Saved Successfully!", "Success");
	          jQuery('#modal_imgcrop').modal('hide');
	        };
		}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	};

	return {
		init: function () {
			handleImageUpload();
			handleRemoveImage();
			handleOpenModalCrop();
			handleCropLib();
        }
	};

}();

jQuery(document).ready(function() {
    UploadImageCrop.init();
});
