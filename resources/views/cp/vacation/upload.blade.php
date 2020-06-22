<!DOCTYPE HTML>
<!--
/*
 * jQuery File Upload Plugin Basic Vacation
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
-->
<html lang="en">
<head>
<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

<title>jQuery File Upload Vacation - Basic version</title>

<!-- Bootstrap styles -->
<style type="text/css">
.progress
{
    width:50%;
}
.ftable
{
    width:70%;
}
    

</style>

<!-- Generic page styles -->
<link rel="stylesheet" href="cp/css/style.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="cp/css/jquery.fileupload.css">
</head>
<body>

<div class="container">
    <h1>Upload Image for Healine: ({{$event->title}})</h1>
   
  
    <br>
    
    <br>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple="" >
        
    </span>
    <input id="id" type="text" value="{{$event->id}}" name="id" class="eventid hidden" >
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
   <div class="ftable">
    <table class="table table"  >
    
        <tr class="template-download fade in">
        <td>
            <span class="preview">
                
                    <a href="{{ asset('img/blog') }}/{{$event->h_image}}" title="{{$event->title}}" download="{{ asset('img/blog') }}/{{$event->h_image}}" data-gallery=""><img src="{{ asset('img/blog') }}/{{$event->h_image}}"></a>
                
            </span>
        </td>
        <td>
            <p class="name">
                
                    <a href="{{$event->h_image}}" title="{{$event->title}}" download="{{$event->h_image}}" data-gallery="" >  {{$event->title}} </a>
                
            </p>
            
        </td>
        <td>
        <p>
            
            </p>
        </td>
        <td>
            
                <button class="btn btn-danger delete" data-type="DELETE" value= "{{$event->id}}">
                    <i class=""></i>
                    <span>Delete</span>
                </button>
             
            
        </td>
    </tr>
   
    </table>
</div>
 
    <br>
 
</div>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="cp/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="cp/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="cp/js/jquery.fileupload.js"></script>

<script>
$(function () {
   
    'use strict';
    
    // Change this to the location of your server-side upload handler:
     var id=document.getElementById("id").value;
    var url =  'optimum/event/upload/'+id;
    var url2 =  'optimum/event/delUpload/'+id;
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );

            

     $('.modal-body-attach').load('optimum/event/attachImage/'+id);
  
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

 $('.delete').on('click', function () {

     $.ajax({
        url: url2
    
    });
      $('.modal-body-attach').load('optimum/event/attachImage/'+id); 
       

});


});
</script>
</body>
</html>
