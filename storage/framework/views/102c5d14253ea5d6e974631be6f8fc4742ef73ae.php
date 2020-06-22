<?php $__env->startSection('content'); ?>

    <div class="site-container">

        <form class="ajaxForm form myform" id="myform" action="/<?php echo e(config('app.user_route_name')); ?>/createRefund"
              method="post">
            <div class="form-group">
                <label>هل تملك قسيمة راتب (تلوش) لفترة الاسترجاع؟</label>
                <div class="multi-input">
                    <div class="ck-button">
                        <label>
                            <input type="radio" name="salary_paper" value="1" /><span>نعم</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input type="radio" name="salary_paper" value="0" /><span>لا</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>مبلغ قسيمة الراتب (تلوش) خلال فترة العمل </label>
                <input
                        type="number"
                        name="salary_amount"
                        class="form-control"
                        placeholder="أدخل المبلغ هنا"
                        pattern="\d*"

                />
            </div>
            <div class="form-group">
                <label>سنوات العمل لفترة الاسترجاع</label>
                <div class="multi-input">
                    <div class="label-between">من</div>
                    <div class="input-with-icon">
                        <input type="date" name="start_work_date" class="form-control myDate text-right" />
                    </div>
                    <div class="label-between">إلى</div>
                    <div class="input-with-icon">
                        <input type="date" name="end_work_date" class="form-control myDate2 text-right" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>هل حصلت على تلوش بنفس الشهر الذي حدثت به الإصابة</label>
                <div class="multi-input">
                    <div class="ck-button">
                        <label>
                            <input type="radio" name="salary_paper_month" value="1" /><span>نعم</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input type="radio" name="salary_paper_month" value="0" /><span>لا</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">


                <label>ارفاق قسيمة الراتب</label>
                <div class="upload-btn-wrapper">
                    <label class="btn"><i class="icon icon-upload"></i> اضغط هنا  قسيمة الراتب </label>
                    <input type="file" att_id="<?php echo e($user->SysUsr_ID); ?>" upload="salary" class="upload-request"
                           link="/<?php echo e(config('app.user_route_name')); ?>/uploadFile?module=salary&title=sid&att_id=<?php echo e($user->SysUsr_ID); ?>"
                           name="salary"/>
                </div>

                <div class="text-center">
                    <span class="uploading hidden" data-spinner="1" style=""><img src="/img/load.gif"
                                                                                  style="height: 60px;width: auto;margin: auto;position: relative;display: block;"></span>
                    <a href="/uploads/<?php echo e(isset($sid_attach)?$sid_attach->name:''); ?>" target="_blank" id="salary" class="upload <?php echo e(isset($salary)?'':'hidden'); ?> rft2 text-left"
                       style=""><span>تم رفع الملف بنجاح إضغط هنا<i
                                    class="glyphicon glyphicon-check"></i></span> </a>
                </div>
            </div>

            <div class="form-footer text-center m-b-50">
                <a
                        class="btn btn-primary w-50-perc m-t-20 btn-md submit"
                        href="#"
                >حفظ البيانات
                </a
                >


            </div>
        </form>
    </div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="/js/vendors/select-field.js"></script>
    <script src="/js/vendors/input-file.js"></script>
    <script src="./js/modal.js"></script>
    <script>
        document.querySelector(".myDate").valueAsDate = new Date();
        document.querySelector(".myDate2").valueAsDate = new Date();

        $(document).ready(function () {
            jQuery(document).on('click', '.submit', function () {

                jQuery(this).parents('.myform').submit();


            });
            jQuery(document).on('change', '.upload-request', function () {


                jQuery(this).parents('.form-group').find('.uploading').removeClass('hidden');
                jQuery(this).parents('.form-group').find('.send').attr('disabled', 'disabled');

                var my_file = (jQuery(this)[0]).files[0];
                var my_button = jQuery(this);
                var id = jQuery(this).attr('id');
                var upload = jQuery(this).attr('upload');
                var link = jQuery(this).attr('link');

                var size = parseInt((jQuery(this)[0]).files[0].size);
                size = size / 1024;
                var file = jQuery(this).val();
                var extension = file.substr((file.lastIndexOf('.') + 1)).toLowerCase();
                var type = false;
                if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'doc' || extension == 'pdf' || extension == 'docx')
                    type = true;

                if (size <= 8096 && type == true) {
                    var fd = new FormData();
                    fd.append("choose-file", my_file);
                    jQuery.ajax({
                        url: link,
                        type: 'POST',
                        data: fd,
                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {
                            //    my_button.parent().append('<div class="loading-submit"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
                        },
                        success: function (data) {
                            //    my_button.parent().find('.loading-submit').remove();
                            if (data.status == 1) {
                                var src = "/uploads/" + data.file_name;
                                jQuery('#' + upload).removeClass('hidden');
                                jQuery('#' + upload).attr('href', src);

                                //document.getElementById('linky').text(data.file_name);

                                jQuery('#' + upload).parents('.text-center').find('.uploading').addClass('hidden');


                            } else {
                                var message = data.message;
                                ShowMessage("e:الرجاء التأكد من حجم الملف اقل من 4 ميجا صيغة المرفقات صورة أو pdf");
                                jQuery(this).parents('.form-group').find('.uploading').addClass('hidden');

                            }
                        }
                    });

                } else {
                    flag = true;
                    my_button.parent().find('.loading-submit').remove();
                    jQuery(this).val("");
                    var message = '';
                    if (size > 4096)
                        message = 'size is too big';
                    if (type == false)
                        message = 'format not accepted';
                    ShowMessage("e:الرجاء التأكد من حجم الملف اقل من 4 ميجا صيغة المرفقات صورة أو pdf");
                    jQuery(this).parents('.form-group').find('.uploading').addClass('hidden');

                    // jQuery('.form-body').find('.uploading').addClass('hidden');
                }


            });
        });
    </script>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .hidden {
            display: none;
        }
    </style>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('website.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>