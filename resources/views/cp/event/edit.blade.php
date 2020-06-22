@extends('cp.layout.layout')

@section('css')
    <!--
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
    <link href="cp/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>-->
@stop
@section('js')

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
    <script src="cp/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-form-tools.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="cp/js/date-custom.js" type="text/javascript"></script>
    <script src="cp/js/my_js.js" type="text/javascript"></script>
    <script src="cp/js/checkbox.js" type="text/javascript"></script>
    <script src="cp/js/myselect2.js" type="text/javascript"></script>
    <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/usersForm.js" type="text/javascript"></script>
    <script src="cp/js/eventForm.js" type="text/javascript"></script>
    <script src="cp/js/eventDepartment.js" type="text/javascript"></script>
    <script src="cp/js/eventProcedure.js" type="text/javascript"></script>
    <script src="cp/js/eventAtt.js" type="text/javascript"></script>

    @if($errors->has())
        <script>
            jQuery(document).ready(function () {
                toasterMessage('error', 'The Number of Errors: {{ sizeof($errors->all()) }}', 'Check Errors Below');
            });


        </script>
    @endif
    @if(app()->request->cont=="1")
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', 'Please continue with all information', 'Success Message');
            });

        </script>
    @endif

    @if(isset($success))
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '{{ $success }}', 'Success Message');
            });

        </script>
    @endif
@stop

@section('content')
    <div class="form-package">
    {!! Form::model($result,['action'=>['Admin\EventController@update',$result->id],'class'=>'form-validation form-datavalidation']) !!}
    @include('cp.event.form')
    {!! Form::close() !!}


    <!--Add Department-->
        <div class="row hidden">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">

                            <div class="btn-group">

                            </div>


                            <a title="Add Department" data-modal="modal-deptadd"
                               class="deptmodal btn btn-circle btn-icon-only btn-default tooltip-one-info" data-id=""
                               href="#">
                                <i class="fa fa-plus"> </i>
                            </a> Click Here To Add Department
                        </div>
                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="mydatatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>

                                <th>Status</th>

                                <th class="tblaction-rg tblaction-three-rg">Delete</th>
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


        <div class="modal fade" id="modal-deptadd" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Department</h4>
                    </div>
                    {!! Form::open(["id"=>"addDept","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">

                        @include('cp.event.addDept')

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

        <div class="modal fade" id="modal-deptEdit" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit Department</h4>
                    </div>
                    {!! Form::open(["id"=>"editDept","class"=>"form-validation "]) !!}
                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>


        <!--Add Procedure-->
        <div class="row">

            <div class="col-md-12">
                <div class="portlet box default">
                    <div class="portlet-title ">
                        <div class="caption">
                            Invoice Information
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>

                        </div>
                    </div>


                    <div class="portlet-body padding-15-all">

                        <div class="row">


                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet green box bordered" id="p1">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">

                                            <div class="btn-group">

                                            </div>


                                            <a title="Add Procedure" data-modal="modal-proadd"
                                               class="promodal btn btn-circle btn-icon-only btn-default tooltip-one-info"
                                               data-id=""
                                               href="#">
                                                <i class="fa fa-plus"> </i>
                                            </a> Procedures

                                        </div>
                                    </div>
                                    <div class="portlet-body">


                                        <!-- tblactions region -->

                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                               id="mydatatable1">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Service Code</th>
                                                <th>Cost</th>
                                                <th>Qty</th>
                                                <th>Total cost NIS</th>
                                                <th>Status</th>

                                                <th class="tblaction-rg tblaction-three-rg">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="4"><h4 class="text text-danger">Total Cost:</h4></th>
                                                <th></th>
                                            </tr>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-proadd" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Procedure</h4>
                    </div>
                    {!! Form::open(["id"=>"addPro","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">

                        @include('cp.event.addPro')

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

        <div class="modal fade" id="modal-proEdit" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit Procedure</h4>
                    </div>
                    {!! Form::open(["id"=>"editPro","class"=>"form-validation "]) !!}
                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>


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
                            </a> Click Here To Add Atts
                        </div>
                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="mydatatable3">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Source</th>
                                <th>Inforamtion</th>

                                <th class="tblaction-rg tblaction-three-rg">Delete</th>
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

        <div class="modal fade" id="modal-attadd" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Attd</h4>
                    </div>
                    {!! Form::open(["id"=>"addAtt","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">

                        @include('cp.event.addAtt')

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

        <div class="modal fade" id="modal-attEdit" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit att</h4>
                    </div>
                    {!! Form::open(["id"=>"editAtt","class"=>"form-validation "]) !!}
                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

    </div>









@stop