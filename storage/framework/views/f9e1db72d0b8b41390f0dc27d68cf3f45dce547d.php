<?php $__env->startSection('js'); ?>
    <script src="cp/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/js/date-custom.js" type="text/javascript"></script>
    <script src="cp/js/my_js.js" type="text/javascript"></script>
    <script src="cp/js/checkbox.js" type="text/javascript"></script>
    <script src="cp/js/myselect2.js" type="text/javascript"></script>
    <script src="cp/js/validation.js" type="text/javascript"></script>

    <script src="cp/js/jobAtt.js" type="text/javascript"></script>
    <?php if($errors->has()): ?>
        <script>
            jQuery(document).ready(function () {
                toasterMessage('error', 'The Number of Errors: <?php echo e(sizeof($errors->all())); ?>', 'Check Errors Below');
            });


        </script>
    <?php endif; ?>

    <?php if(isset($success)): ?>
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '<?php echo e($success); ?>', 'Success Message');
            });

        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="form-package">
        <?php echo Form::model($result,['action'=>['Admin\JobController@update',$result->id],'class'=>'form-validation form-datavalidation']); ?>

        <?php echo $__env->make('cp.job.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Form::close(); ?>

        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">

                            <div class="btn-group">

                            </div>


                            <a title="Add Atts" data-modal="modal-attadd"
                               class="attmodal btn btn-circle btn-icon-only btn-default tooltip-one-info" data-id=""
                               href="#">
                                <i class="fa fa-plus"> </i>
                            </a> إضافة مرفقات
                        </div>
                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="mydatatable3">
                            <thead>
                            <tr>
                                <th> الرقم</th>
                                <th> الإسم</th>
                                <th> النوع</th>
                                <th> العنوان</th>
                                <th>تاريخ الرفع</th>
                                <th> معلومات</th>

                                <th class="tblaction-rg tblaction-three-rg">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <div class="modal fade" id="modal-attadd" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">  إضافة</h4>
                    </div>
                    <?php echo Form::open(["id"=>"addAtt","class"=>"form-validation "]); ?>

                    <div class="modal-body-attach" id="div1">

                        <?php echo $__env->make('cp.job.addAtt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal"> إغلاق</button>
                        <button type="submit" class="btn green"> حفظ</button>
                    </div>
                <?php echo Form::close(); ?>

                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>
        <div class="modal fade" id="modal-attEdit" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">تعديل المرفق</h4>
                    </div>
                    <?php echo Form::open(["id"=>"editAtt","class"=>"form-validation "]); ?>

                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal"> إغلاق</button>
                        <button type="submit" class="btn green">حفظ</button>
                    </div>
                <?php echo Form::close(); ?>

                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>