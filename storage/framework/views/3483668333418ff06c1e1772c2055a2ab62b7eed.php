<?php $__env->startSection('content'); ?>


    <div class="site-container">
        <form class="form ajaxForm myform" id="myform" action="/<?php echo e(config('app.user_route_name')); ?>/updateProfile"
              method="post">
            <div class="form-group">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <label>الاسم رباعي</label>
                <input type="text" name="SysUsr_FullName" class="form-control" value="<?php echo e($user->SysUsr_FullName); ?>"
                       placeholder="الاسم رباعي"/>
            </div>
            <div class="form-group">
                <label>رقم الهوية</label>
                <input
                        type="number"
                        name="sid"
                        value="<?php echo e($user->sid); ?>"
                        class="form-control"
                        placeholder="أدخل رقم الهوية هنا"
                        pattern="\d*"
                />
            </div>
            <div class="form-group">
                <label>نوع الهوية</label>
                <div class="multi-input">
                    <div class="ck-button">
                        <label>
                            <input type="radio" name="sid_type" <?php echo e($user->sid_type==1?'checked':''); ?> value="1"/><span>فلسطينية</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input type="radio" name="sid_type" <?php echo e($user->sid_type==2?'checked':''); ?> value="2"/><span>اسرائيلية</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>تاريخ الميلاد</label>
                <div class="input-with-icon">
                    <input name="SysUsr_DoB"
                           type="date"
                           value="<?php echo e($user->SysUsr_DoB?Date('Y-m-d',strtotime($user->SysUsr_DoB)):''); ?>"
                           class="form-control myDate"
                    />
                    <i class="icon icon-date"></i>
                </div>
            </div>
            <div class="form-group">
                <label>الجنس</label>
                <div class="multi-input">
                    <div class="ck-button">
                        <label>
                            <input type="radio" <?php echo e($user->gender=='m'?'checked':''); ?> name="gender"
                                   value="m"/><span>ذكر</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input type="radio" <?php echo e($user->gender=='f'?'checked':''); ?> name="gender"
                                   value="f"/><span>انثى</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>الحالة الاجتماعية</label>
                <div class="multi-input">
                    <div class="ck-button">
                        <label>
                            <input type="radio" <?php echo e($user->social_status==1?'checked':''); ?> name="social_status"
                                   value="1"/><span>اعزب</span>
                        </label>
                    </div>
                    <div class="ck-button">
                        <label>
                            <input type="radio" <?php echo e($user->social_status==2?'checked':''); ?> name="social_status"
                                   value="2"/><span>متزوج</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>المدينه</label>
                <div class="custom-select">
                    <select name="city">
                        <option value="0">اختر المدينة</option>
                        <?php foreach($city as $c): ?>
                            <option value="<?php echo e($c->id); ?>" <?php echo e($c->id==$user->city?'selected':''); ?>> <?php echo e($c->name_ar); ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>العنوان</label>
                <input
                        name="address"
                        type="text"
                        value="<?php echo e($user->address); ?>"
                        class="form-control"
                        placeholder="أدخل العنوان هنا"
                />
            </div>
            <div class="form-group">
                <label>رقم الهاتف المحمول</label>
                <input
                        type="SysUsr_Mobile"
                        value="<?php echo e($user->SysUsr_Mobile); ?>"

                        class="form-control"
                        placeholder="أدخل رقم الهاتف المحمول هنا"
                />
            </div>
            <div class="form-group">


                <label>ارفاق الهوية</label>
                <div class="upload-btn-wrapper">
                    <label class="btn"><i class="icon icon-upload"></i> اضغط هنا لإرفاق الهوية </label>
                    <input type="file" att_id="<?php echo e($user->SysUsr_ID); ?>" upload="sid_attach" class="upload-request"
                           link="/<?php echo e(config('app.user_route_name')); ?>/uploadFile?module=sid_attach&title=sid&att_id=<?php echo e($user->SysUsr_ID); ?>"
                    name="sid_attach"/>
                </div>

                <div class="text-center">
                    <span class="uploading hidden" data-spinner="1" style=""><img src="/img/load.gif"
                                                                                  style="height: 60px;width: auto;margin: auto;position: relative;display: block;"></span>
                    <a href="/uploads/<?php echo e(isset($sid_attach)?$sid_attach->name:''); ?>" target="_blank" id="sid_attach" class="upload <?php echo e(isset($sid_attach)?'':'hidden'); ?> rft2 text-left"
                       style=""><span>تم رفع الملف بنجاح إضغط هنا<i
                                    class="glyphicon glyphicon-check"></i></span> </a>
                </div>
            </div>
            <div class="form-group">

                <label>ارفاق البطاقة الممغنطة</label>
                <div class="upload-btn-wrapper">
                    <label class="btn"><i class="icon icon-upload"></i> اضغط هنا لإرفاق البطاقة </label>
                    <input type="file" att_id="<?php echo e($user->SysUsr_ID); ?>"  upload="card_attach" name="card_attach" class="upload-request"
                           link="/<?php echo e(config('app.user_route_name')); ?>/uploadFile?module=card_attach&title=card&att_id=<?php echo e($user->SysUsr_ID); ?>"/>
                </div>
                <div class="text-center">
                            <span class="uploading hidden" data-spinner="1" style=""><img src="/img/load.gif"
                                                                                          style="height: 60px;width: auto;margin: auto;position: relative;display: block;"></span>
                    <a href="/uploads/<?php echo e(isset($sid_attach)?$sid_attach->name:''); ?>" target="_blank" id="card_attach" class="upload <?php echo e(isset($sid_attach)?'':'hidden'); ?> rft2 text-left"
                       style=""><span>تم رفع الملف بنجاح إضغط هنا<i
                                    class="glyphicon glyphicon-check"></i></span> </a>
                </div>
            </div>

            <div class="form-footer text-center m-b-50">
                <a class="btn btn-primary w-50-perc m-t-20 btn-md submit" href="#">حفظ الملف الشخصي</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="/js/vendors/select-field.js"></script>
    <script src="/js/vendors/input-file.js"></script>

    <script>



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
                                jQuery('#'+upload).removeClass('hidden');
                                jQuery('#'+upload).attr('href', src);

                                //document.getElementById('linky').text(data.file_name);

                                jQuery('#'+upload).parents('.text-center').find('.uploading').addClass('hidden');


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