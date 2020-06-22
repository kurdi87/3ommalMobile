<?php
/**
 * Created by PhpStorm.
 * User: MAZK
 * Date: 2020-05-14
 * Time: 14:29
 */
?>
<html lang="ar">
<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <title>{{isset($page_title)?$page_title:"عمال || طريقك نحو العمل"}}</title>

    <meta name="description" content="" />
    <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="./images/logo/logo-180x180.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="./images/logo/logo-32x32.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="./images/logo/logo-16x16.png"
    />
    <link rel="mask-icon" href="./images/logo/mask-icon.svg" color="#0e60ba" />
    <meta name="theme-color" content="#0e60ba" />
    <meta name="theme-color" content="#0e60ba" />
    <meta name="keywords" content="{{isset($keywords)?$keywords:"عمال || طريقك نحو العمل"}}">
    <meta name="description" content="{{isset($description)?$description:"عمال || طريقك نحو العمل"}}">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="https://3ommal.me/الصفحة_الرئيسية">
    <meta property="og:image" content="'.https://3ommal.me.'/logo.png">
    <meta property="og:site_name" content="عمال">
    <meta property="og:description" content="عمال || طريقك نحو العمل">
    <!-- /Facebook Card -->

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@3ommal">
    <meta name="twitter:title" content="عمال || طريقك نحو العمل">
    <meta name="twitter:description" content="عمال || طريقك نحو العمل">
    <meta name="twitter:image" content="'.https://3ommal.me.'/logo.png">

    <link rel="stylesheet" href="/css/style.css" type="text/css" />
    <link rel="stylesheet" href="/toastr-master/build/toastr.min.css">
    <link href="/nprogress-master/nprogress.css" rel="stylesheet"/>
    @yield('css')
    <style>
        .home-menu {
            position: relative;
            padding-top: 60px;
        }
        .inner-page {
            margin: 0 auto !important;
            margin-top: 20px !important;
        }
        .box-content p{
            font-weight: 500 !important;
        }
    </style>
</head>
<body  class>
<div class="main">
    @include('website.header')

    @yield('content')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/js/vendors/jquery.form.js"></script>

<script src="/nprogress-master/nprogress.js"></script>
<script src="/toastr-master/build/toastr.min.js"></script>
<script src="/js/vendors/slider.js"></script>
<script src="/js/vendors/menu-animation.js"></script>




{{--
<script src="https://www.google.com/recaptcha/api.js?render=6Ld1XJ8UAAAAAGFf5cCX8ojzy3jECbA6A3gQ_pJW"></script>
 <script>
   grecaptcha.ready(function () {
     grecaptcha.execute('', {action: 'homepage'});
   });
 </script>


    --}}
<script>

    $(function () {

        $(document).ajaxStart(function () {
            NProgress.start();
        });
        $(document).ajaxStop(function () {
            NProgress.done();
        });
        $(document).ajaxError(function () {
            NProgress.done();
        });
        /*  $(".ajaxForm").submit(function (event) {

            var recaptcha = $("#g-recaptcha-response").val();
            if (recaptcha === "") {
              event.preventDefault();
              ShowMessage("e: الرجاء تأكيد I am not robot");
            }
          });*/


        PageLoadMethod();
        NProgress.done();


    });

    function PageLoadMethod() {
        $(".ajaxForm").ajaxForm({
            success: function (json) {
                $(".modal").toggleClass('show');
                ShowMessage(json.msg);
                if (json.status == 1 && json.redirect == undefined) {
                    $(".ajaxForm").resetForm();
                    $(".ajaxForm").find(".form-control").first().focus();

                }

                if (json.redirect != undefined) {
                    setTimeout(function () {
                        window.location = json.redirect;
                    }, 1200);
                }
                if (json.close == true) {

                    $(".modal").toggleClass('show');

                }
            },
            beforeSubmit: function () {
                $(".ajaxForm :submit").prop("disabled", true);
            },
            error: function (jqXhr) {
                var msg = "Error:";
                if (jqXhr.status === 401) //redirect if not authenticated user.
                    msg = 'auth/login';
                if (jqXhr.status === 422) {
                    //process validation errors here.
                    var errors = jqXhr.responseJSON; //this will get the errors response data.
                    //show them somewhere in the markup
                    //e.g
                    errorsHtml = '<div class="alert"><ul>';

                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></di>';

                    msg = errorsHtml; //appending to a <div id="form-errors"></div> inside form
                } else {
                    var msg = "Error:";
                }

                $(".ajaxForm :submit").prop("disabled", false);
                ShowMessage("e:" + msg);





            }
        });
    }

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    function ShowMessage(msg) {
        var first2Letter = msg.substring(0, 2).toLowerCase();
        var msgClass = "info";
        if (first2Letter == "e:") {
            msgClass = "error";
            msg = msg.substring(2);
        } else if (first2Letter == "s:") {
            msgClass = "success";
            msg = msg.substring(2);
        } else if (first2Letter == "w:") {
            msgClass = "warning";
            msg = msg.substring(2);
        } else if (first2Letter == "i:") {
            msgClass = "info";
            msg = msg.substring(2);
        }
        toastr[msgClass](msg, "عمال:");
    }


</script>



@yield('js')
</body>
</html>


