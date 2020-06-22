<?php $__env->startSection('css'); ?>
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="cp/js/date-custom.js" type="text/javascript"></script>
    <script src="cp/js/checkbox.js" type="text/javascript"></script>
    <script src="cp/js/myselect2.js" type="text/javascript"></script>
     <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/usersForm.js" type="text/javascript"></script>

     
    <?php if($errors->has()): ?>
        <script>
            jQuery(document).ready(function () {
                  toasterMessage('error', 'Errors number : <?php echo e($errors->first()); ?>', 'Pleach ceheck errors');
            });

        </script>
    <?php endif; ?>

    <?php if(isset($success)): ?>
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '<?php echo e($success); ?>', 'Done successfully');
            });

        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="form-package">
        <?php echo Form::open(['action'=>'Admin\CategoryController@store','class'=>'form-validation form-datavalidation']); ?>

        <?php echo $__env->make('cp.category.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>