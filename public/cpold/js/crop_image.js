
jQuery(document).ready(function(){
		if((jQuery('#cropped_view').attr('data-img')) == 'edit'){
		
			jQuery(".edit_crop_btns").css("display","block");}
		/* crop image */
		jQuery(document).on('click','.preview-crop,.preview',function(){
		jQuery('.overlay-crop-img').slideToggle("slow");
			});
		jQuery(document).on('click','.preview_exist_image',function(){
				var myValue=jQuery('#cropped_view').attr('src');
				angular.element('#myctrl').scope().anyFunc2(myValue);
				jQuery('.overlay-crop-img').slideToggle("slow");
	});
});
angular.module('app', ['ngImgCrop'])
  .controller('Ctrl', function($scope) {
		$scope.myImage='';
		$scope.myCroppedImage='';
		$scope.cropType="square";
		$scope.setArea=function(value){
          $scope.cropType=value;};
	$scope.anyFunc2 = function (myfile) {
		var xhr = new XMLHttpRequest(),
        fileReader = new FileReader();
		xhr.open("GET", myfile, true);
		xhr.responseType = "blob";
		xhr.addEventListener("load", function () {
			if (xhr.status === 200) {
				fileReader.onload = function (e) {
					$scope.$apply(function($scope){
					$scope.myImage=e.target.result;		  		
						});
				};
				fileReader.readAsDataURL(xhr.response);
			}
		},false);
		xhr.send();
	};
    var handleFileSelect=function(evt) {
		jQuery(".edit_crop_btns").css("display","none");
      var file=evt.currentTarget.files[0];
	  console.log(file);
      var reader = new FileReader();
      reader.onload = function (evt) {
        $scope.$apply(function($scope){
          $scope.myImage=evt.target.result;
        });
      };
     reader.readAsDataURL(file);
    };
	
    angular.element(document.querySelector('#crop_image_base')).on('change',handleFileSelect);
  });
			  
			