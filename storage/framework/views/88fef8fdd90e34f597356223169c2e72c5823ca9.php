<html lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>3ommal Website</title>
    <meta name="description" content=""/>
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
    <link rel="mask-icon" href="./images/logo/mask-icon.svg" color="#0e60ba"/>
    <meta name="theme-color" content="#0e60ba"/>
    <link rel="stylesheet" href="./css/style.css" type="text/css"/>
    <link rel="stylesheet" href="./toastr-master/build/toastr.min.css">
    <link href="./nprogress-master/nprogress.css" rel="stylesheet"/>
    <style>
        .input-confirm {
            font-size: 180%; }

    </style>


</head>
<body class="login-page">
<div class="main circles-bg">
    <div class="container">
        <div class="login">
            <div class="logo"></div>
            <h1>دليلك للوظائف داخل الخط الأخضر</h1>
            <form class="ajaxForm myform" id="myform" action="<?php echo e(config('app.user_route_name')); ?>/create"
                  method="post">
                <div class="box-container">
                    <div class="box-content">
                        <h2 class="text-blue">أدخل رقم هاتفك المحمول لتسجل الآن</h2>
                        <div>
                            <input id="phone" name="SysUsr_Mobile" type="tel" class="input-tel"/>
                        </div>
                        <a href="#" class="btn btn-primary submit">إرسال كود التسجيل</a>
                    </div>
                </div>
            </form>
            <a class="btn btn-gray m-t-50" href="index">تخطي التسجيل</a>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modal-view">
            <div class="modal-dialog" role="document" id="modal-view">
                <div class="modal-content">
                    <div class="box-container">
                        <div>
                            <button
                                    type="button"
                                    class="close icon modal-view"
                                    aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="ajaxForm myform" id="myform" action="<?php echo e(config('app.user_route_name')); ?>/verify"
                              method="post">
                            <div class="box-content text-center">
                                <p class="text-gray-dark m-b-20"><b>من فضلك أدخل الكود</b></p>
                                <p class="text-silver text-lighter">
                                    تم إرسال رسالة إلى رقم هاتفك ، يرجى إدخال الكود في الخانات
                                    التالية
                                </p>
                                <div class="m-b-20">
                                    <input type="hidden" id="user_id" name="user_id" value="0"/>
                                    <input type="text" name="verification_key" class="input-confirm" maxlength="6"/>
                                </div>
                                <a class="btn btn-primary submit w-50-perc m-t-20" href="#">تأكيد</a>

                            </div>
                        </form>
                        <div class="box-content text-center">
                            <form class="ajaxForm myform" id="myform"
                                  action="<?php echo e(config('app.user_route_name')); ?>/sendCode"
                                  method="post">
                                <input type="hidden" id="user_id2" name="user_id2" value="0"/>
                                <a class="btn btn-n-bg w-50-perc text-silver modal-message-view submit"
                                >أرسل الكود مرة أخرى</a
                                >
                            </form>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="modal-message">
                            تم إعادة إرسال الكود
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop"></div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/js/vendors/jquery.form.js"></script>
<script src="./js/vendors/intlTellInput/intlTelInput.js"></script>
<script src="./js/site.js"></script>
<script src="./nprogress-master/nprogress.js"></script>
<script src="./toastr-master/build/toastr.min.js"></script>


<?php /*
<script src="https://www.google.com/recaptcha/api.js?render=6Ld1XJ8UAAAAAGFf5cCX8ojzy3jECbA6A3gQ_pJW"></script>
 <script>
   grecaptcha.ready(function () {
     grecaptcha.execute('', {action: 'homepage'});
   });
 </script>


    */ ?>

<script>

    $(document).ready(function () {
        jQuery(document).on('click', '.submit', function () {

            jQuery(this).parents('.myform').submit();


        });
    });

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
                if (json.modal == true) {

                    $(".modal").toggleClass('show');

                }
                if (json.close == true) {

                    $(".modal").toggleClass('show');

                }
                if (json.user > 0) {

                    $('#user_id').attr('value', json.user)
                    $('#user_id2').attr('value', json.user)
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


</body>
</html>
