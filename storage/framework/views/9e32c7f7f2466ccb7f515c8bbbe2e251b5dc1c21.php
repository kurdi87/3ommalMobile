<?php $__env->startSection('css'); ?>
    <link href="cp/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="cp/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/holder.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/ui-general.min.js" type="text/javascript"></script>
    <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/users.js" type="text/javascript"></script>
    <?php if(isset($success)): ?>
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '<?php echo e($success); ?>', 'Success Message');
            });

        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Users</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet box green package-form-rg">
                        <div class="portlet-title myptitle">
                            <div class="caption">
                                <i class="fa fa-search"></i>Search
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="expand mycollapse"></a>
                                <!-- <a href="javascript:;" class="remove"> </a> -->
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form" style="display:none;">
                            <!-- BEGIN FORM-->
                            <form action="#" class="horizontal-form search-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Name</span>
                                                <input data-column="1" type="text" class="form-control searchable" placeholder="" value=""/>
                                            </div>
                                        </div>
                                        <!--/span-->
                                      
                                        <!--span-->
                                       
                                        <!--span-->
                                    </div>
                                    <!--/row-->
                             
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-wlbldate">
                                                <span class="lbldate">Date of Creation</span>

                                                <div class="form-group input-wlbl">
                                                    <span class="lblinput">From</span>

                                                    <div class="input-group inputdate-wicon">
                                                        <input data-date-format="yyyy-mm-dd" id="from" type="text" class="form-control date-picker inputdateclear" placeholder="" readonly="" value=""/>
                                                        <i class="fa fa-close cleardate display-none"></i>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- input wlbldate -->
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">To</span>

                                                <div class="input-group inputdate-wicon">
                                                    <input data-date-format="yyyy-mm-dd" id="to" type="text" class="form-control date-picker inputdateclear" placeholder="" readonly="" value=""/>
                                                    <i class="fa fa-close cleardate display-none"></i> 
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col md 4 -->
                                        <div class="col-md-4 clearfix">
                                            <div class="btn-search-reset">
                                                <button type="button" class="btn green btn-submit-search">Search</button>
                                                <button type="button" class="btn default btn-reset">Empty</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>

                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">

                                    <div class="btn-group">
                                        <a href="<?php echo e(config('app.cp_route_name')); ?>/user/create" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="New User">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>

                               
                            </div>
                         
                        </div>
                    </div>

                    <div class="tblactions-region">

                    </div>
                    <!-- tblactions region -->

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="mydatatable">
                        <thead>
                        <tr>
                            <th><input type="checkbox" class="checkboxes checkbox-parent"/></th>
                            <th>Name</th>
                           
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Date</th>
                            <th>Created by</th>
                            <th class="tblaction-rg tblaction-three-rg" >Edit</th>
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

    <?php if(in_array(3,$allowedActions)): ?>
        <div class="modal fade" id="modal-changepassword" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Change password</h4>
                    </div>
                    <?php echo Form::open(["id"=>"form-changePassword","class"=>"form-validation"]); ?>

                    <div class="modal-body">
                        <h3 class="txtadminname"></h3>

                        <div class="form-group input-wlbl">
                            <span class="lblinput">Password</span>
                            <input name="password" type="password" class="form-control txtinput-required" placeholder="Password"/>
                        </div>
                        <div class="form-group input-wlbl">
                            <span class="lblinput">Retype Password</span>
                            <input data-minlength="6" data-related="password" name="password_confirmation" type="password" class="form-control txtinput-required txtinput-minlength txtinput-related" placeholder="Confirm Password"/>
                        </div>
                        <div class="switch-inline hidden"> <!-- if you need too enable login by email -->
                            <span>Eamil</span>

                            <div>
                                <input name="sendEmail" id="switchsend" value="1" type="checkbox" class="make-switch" checked data-on-color="primary" data-off-color="info">
                                <input class="id" type="hidden" name="id" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>