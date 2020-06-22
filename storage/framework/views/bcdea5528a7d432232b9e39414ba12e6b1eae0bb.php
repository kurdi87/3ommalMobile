<?php $__env->startSection('css'); ?>
	<link href="cp/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script src="cp/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/fuelux/js/spinner.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/js/settings.js" type="text/javascript"></script>
    <script src="cp/js/checkbox_log.js" type="text/javascript"></script>
    <script src="cp/js/validation.js" type="text/javascript"></script>
    <?php if(isset($success)): ?>
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '<?php echo e($success); ?>', 'Done');
            });

        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
        <div class="col-md-12">
            <div class="settings-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-green-madison bold uppercase settings-ptitle">Settings</span>
                                </div>
                                <ul id="tabs-settings" class="nav nav-tabs">
                                    <li class="active" role="tab">
                                        <a href="#tab_1_1" data-toggle="tab">General Settings</a>
                                    </li>
                                    <li role="tab">
                                        <a href="#tab_1_2" data-toggle="tab">Social Network</a>
                                    </li>
                                    <li role="tab" class="">
                                        <a href="#tab_1_3 " data-toggle="tab">اعدادات شبكات التواصل الاجتماعي</a>
                                    </li>
                                    <li role="tab" class="">
                                        <a href="#tab_1_4" data-toggle="tab">اعدادات المحتوى</a>
                                    </li>
                                    <li role="tab" class="">
                                        <a href="#tab_1_6" data-toggle="tab">اعدادات المشاركة</a>
                                    </li>
                                    <li role="tab" >
                                        <a href="#tab_1_5" data-toggle="tab">اعدادات الـ SEO</a>
                                    </li>
                                    <li role="tab" class=""
                                        <a href="#tab_1_7" data-toggle="tab">اعدادات التسجيل</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <?php echo Form::open(['action'=>'Admin\SettingController@update','class'=>'form-validation']); ?>

                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="input-wcheckbox-rg ">
                                                <div class="form-group">
                                                    <div class="switch-inline">
                                                        <span>حالة النظام</span>
                                                        <div>
                                                            <input name="is_open" value="1" type="checkbox" class="make-switch systemclose-checkbox" <?php echo e($siteSetting["is_open"]==1?"checked":""); ?> data-on-color="primary" data-off-color="info">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-closemsg-rg collapse">
                                                    <div class="form-group input-wlbl">
                                                        <span class="lblinput">اغلاق</span>
                                                        <textarea name="close_message" class="form-control input-closemsg"><?php echo e($siteSetting["close_message"]); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-wcheckbox-rg ">
                                                <div class="form-group">
                                                    <div class="switch-inline">
                                                        <span>اظهار الاشعارات</span>
                                                        <div>
                                                            <input name="show_notification" value="1" type="checkbox" class="make-switch systemnotify-checkbox" <?php echo e($siteSetting["show_notification"]==1?"checked":""); ?> data-on-color="primary" data-off-color="info">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-notifymsg-rg collapse">
                                                    <div class="form-group input-wlbl">
                                                        <span class="lblinput">رسالة الاشعارات باللغة الانجليوية</span>
                                                        <textarea name="message_notification_en" class="form-control input-notifymsg"><?php echo e($siteSetting["message_notification_en"]); ?></textarea>
                                                    </div>

                                                    <div class="form-group input-wlbl">
                                                        <span class="lblinput">رسالة الاشعار باللغة العربية</span>
                                                        <textarea name="message_notification_ar" class="form-control input-notifymsg"><?php echo e($siteSetting["message_notification_ar"]); ?></textarea>
                                                    </div>
                                                    <div class="form-group input-wlbl">
                                                        <span class="lblinput">تاريخ الاشعار</span>
                                                        <input data-date-format="yyyy-mm-dd" name="date_notification" value="<?php echo e($siteSetting["date_notification"]); ?>" type="text" class="form-control date-picker input-notifymsg" readonly="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">How it works 1</span>
                                                <textarea name="how_it_woks1" class="form-control input-notifymsg"><?php echo e($siteSetting["how_it_woks1"]); ?></textarea>
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">How it works 2</span>
                                                <textarea name="how_it_woks2" class="form-control input-notifymsg"><?php echo e($siteSetting["how_it_woks2"]); ?></textarea>
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">How it works 3</span>
                                                <textarea name="how_it_woks3" class="form-control input-notifymsg"><?php echo e($siteSetting["how_it_woks3"]); ?></textarea>
                                            </div>
                                            <div class="form-group ">
                                                <div class="switch-inline">
                                                    <span>القائمة البريدية</span>
                                                    <div>
                                                        <input name="news_letter" value="1" type="checkbox" class="make-switch" <?php echo e($siteSetting["news_letter"]==1?"checked":""); ?> data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group  input-wlbl">
                                                <span class="lblinput">عدد الصور في السلايدر</span>
                                                <input name="slider_images" value="<?php echo e($siteSetting["slider_images"]); ?>" type="text" id="touchspin_3" class="form-control txtinput-filter-number" placeholder="" />
                                            </div>
                                        </div><!-- tab_1_1 -->
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_2">
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Facebook</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-facebook"></i>
                                                    </span>
                                                    <span class="input-group-addon">
                                                        <span>https://www.facebook.com/</span>
                                                    </span>
                                                    <input name="facebook" value="<?php echo e($siteSetting["facebook"]); ?>" type="text" class="form-control" placeholder="" />
                                                </div>
                                            </div><!-- form group -->
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Twitter</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-twitter"></i>
                                                    </span>
                                                    <span class="input-group-addon">
                                                        <span>https://twitter.com/</span>
                                                    </span>
                                                    <input name="twitter" value="<?php echo e($siteSetting["twitter"]); ?>" type="text" class="form-control" placeholder="" />
                                                </div>
                                            </div><!-- form group -->
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Youtube</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-youtube"></i>
                                                    </span>
                                                    <span class="input-group-addon">
                                                        <span>https://www.youtube.com/</span>
                                                    </span>
                                                    <input name="youtube" value="<?php echo e($siteSetting["youtube"]); ?>" type="text" class="form-control" placeholder="" />
                                                </div>
                                            </div><!-- form group -->
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Instagram</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-instagram"></i>
                                                    </span>
                                                    <span class="input-group-addon">
                                                        <span>https://www.instagram.com/</span>
                                                    </span>
                                                    <input name="instagram" value="<?php echo e($siteSetting["instagram"]); ?>" type="text" class="form-control" placeholder="" />
                                                </div>
                                            </div><!-- form group -->
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Phone Number</span>
                                                <input name="phone" value="<?php echo e($siteSetting["phone"]); ?>" type="text" class="form-control" placeholder="" />
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Phone Number</span>
                                                <input name="email" value="<?php echo e($siteSetting["email"]); ?>" type="text" class="form-control" placeholder="" />
                                            </div>
                                        </div><!-- tab_1_2 -->
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_3">
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>تسجيل جديد أو تسجيل الدخول بواسطة شبكات التواصل الاجتماعي</span>
                                                    <div>
                                                        <input name="sign_social" <?php echo e($siteSetting["sign_social"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_4">
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>اضافة مدونة</span>
                                                    <div>
                                                        <input name="add_blog" <?php echo e($siteSetting["add_blog"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>اضافة تعليق</span>
                                                    <div>
                                                        <input name="add_comment" <?php echo e($siteSetting["add_comment"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>اعجاب</span>
                                                    <div>
                                                        <input name="like" <?php echo e($siteSetting["like"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>حجز</span>
                                                    <div>
                                                        <input name="booking" <?php echo e($siteSetting["booking"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>اضافة رد</span>
                                                    <div>
                                                        <input name="add_reply" <?php echo e($siteSetting["add_reply"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_6">
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>facebook</span>
                                                    <div>
                                                        <input name="facebook_share" <?php echo e($siteSetting["facebook_share"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>twitter</span>
                                                    <div>
                                                        <input name="twitter_share" <?php echo e($siteSetting["twitter_share"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="switch-inline">
                                                    <span>google+</span>
                                                    <div>
                                                        <input name="google_share" <?php echo e($siteSetting["google_share"]==1?"checked":""); ?> type="checkbox" class="make-switch" data-on-color="primary" data-off-color="info">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_5">
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Google Analytics</span>
                                                <input name="google_code" value="<?php echo e($siteSetting["google_code"]); ?>" type="text" class="form-control" placeholder="" />
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Meta Description</span>
                                                <textarea name="meta_description" class="form-control"><?php echo e($siteSetting["meta_description"]); ?></textarea>
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <label class="control-label">Tags</label>
                                                <input name="tags" value="<?php echo e($siteSetting["tags"]); ?>" type="text" class="form-control" data-role="tagsinput" placeholder="Tags" />
                                            </div>
                                        </div><!-- tab_1_3 -->
                                        <div class="tab-pane" id="tab_1_7">
                                            <div class="row permissions-row settingschecks-row">
                                                <?php foreach($actions as $action): ?>
                                                        <div class="col-md-4">
                                                            <div class="portlet box box-permissions green">
                                                                <div class="portlet-title">
                                                                    <div class="caption caption-wcheckbox">
                                                                        <label class="checkbox-inline parent-check">
                                                                            <input type="checkbox" class="mycheckbox pcheckbox" />
                                                                            <span class="checkbox-style"><i class="fa fa-check"></i></span>
                                                                            <i class="fa fa-user"></i><span class="label-checkbox"><?php echo e($action->Action_GroupName); ?></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="tools">
                                                                        <a href="javascript:;" class="collapse mycollapse"></a>
                                                                    </div>
                                                                </div>

                                                                <div class="portlet-body collapse-body form">
                                                                    <div class="horizontal-form">
                                                                        <div class="form-body">
                                                                            <div class="permissions-checks">
                                                                                <ul>
                                                                                    <?php if($action->routesLog && isset($action->routesLog[0])): ?>
                                                                                        <li>
                                                                                            <label class="checkbox-inline">
                                                                                                <input name="route[<?php echo e($action->Action_ID); ?>]" type="checkbox" <?php echo e($action->routesLog[0]->ActRoute_IsLogging?"checked":""); ?> class="mycheckbox ccheckbox" />
                                                                                                <span class="checkbox-style"><i class="fa fa-check"></i></span>
                                                                                                <span class="label-checkbox"><?php echo e($action->Action_Name); ?></span>
                                                                                            </label>

                                                                                            <label class="checkbox-inline check-more display-none">
                                                                                                <input name="detail[<?php echo e($action->Action_ID); ?>]" type="checkbox" <?php echo e($action->routesLog[0]->ActRoute_IsLoggingDetails?"checked":""); ?> class="mycheckbox" />
                                                                                                <span class="checkbox-style"><i class="fa fa-check"></i></span>
                                                                                                <span class="label-checkbox">Log Details</span>
                                                                                            </label>
                                                                                        </li>
                                                                                    <?php endif; ?>
                                                                                    
                                                                                    <?php foreach($action->actions as $subAction): ?>
                                                                                        <?php if($subAction->routesLog && isset($subAction->routesLog[0])): ?>
                                                                                            <li>
                                                                                                <label class="checkbox-inline">
                                                                                                    <input name="route[<?php echo e($subAction->Action_ID); ?>]" type="checkbox" <?php echo e($subAction->routesLog[0]->ActRoute_IsLogging?"checked":""); ?> class="mycheckbox ccheckbox" />
                                                                                                    <span class="checkbox-style"><i class="fa fa-check"></i></span>
                                                                                                    <span class="label-checkbox"><?php echo e($subAction->Action_Name); ?></span>
                                                                                                </label>

                                                                                                <label class="checkbox-inline check-more display-none">
                                                                                                    <input name="detail[<?php echo e($subAction->Action_ID); ?>]" type="checkbox" <?php echo e($subAction->routesLog[0]->ActRoute_IsLoggingDetails?"checked":""); ?> class="mycheckbox" />
                                                                                                    <span class="checkbox-style"><i class="fa fa-check"></i></span>
                                                                                                    <span class="label-checkbox">Log Details</span>
                                                                                                </label>
                                                                                            </li>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </ul>
                                                                            </div><!-- permissions checks -->
                                                                        </div><!--form body-->
                                                                    </div><!-- END FORM-->
                                                                </div><!--portlet form-->
                                                            </div><!--portlet box-->
                                                        </div><!-- col md 4 -->
                                                <?php endforeach; ?>
                                            </div><!-- row -->
                                        </div>
                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn green"> حفظ التعديلات </button>
                                        </div>
                                    </div>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END settings CONTENT -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>