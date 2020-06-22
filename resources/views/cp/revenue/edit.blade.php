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
    <script src="cp/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/js/date-custom.js" type="text/javascript"></script>
     <script src="cp/js/my_js.js" type="text/javascript"></script>
    <script src="cp/js/checkbox.js" type="text/javascript"></script>
    <script src="cp/js/myselect2.js" type="text/javascript"></script>
     <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/usersForm.js" type="text/javascript"></script>
     <script src="cp/js/revenueForm.js" type="text/javascript"></script>

          <script src="cp/js/revenueAtt.js" type="text/javascript"></script>
    <script src="cp/js/revenueProcedure.js" type="text/javascript"></script>


    @if($errors->has())
        <script>
            jQuery(document).ready(function () {
                toasterMessage('error', 'The Number of Errors: {{ sizeof($errors->all()) }}', 'Check Errors Below');
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
        {!! Form::model($result,['action'=>['Admin\RevenueController@update',$result->id],'class'=>'form-validation form-datavalidation']) !!}
        @include('cp.revenue.form')
        {!! Form::close() !!}




        <!--Add Procedure-->











            <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">

                        <div class="btn-group">
                                        
                                    </div>


                         <a title="Add Atts" data-modal="modal-attadd" class="attmodal btn btn-circle btn-icon-only btn-default tooltip-one-info" data-id=""   href="#">
                                                   <i class="fa fa-plus"> </i>
                                                </a> Click Here To Add Atts To This revenue
                    </div>
                </div>
                <div class="portlet-body">

                    
                    <!-- tblactions region -->

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="mydatatable3">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Inforamtion</th>
                            
                            <th class="tblaction-rg tblaction-three-rg" >Delete</th>
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
                        <h4 class="modal-title">Add Attd</h4>
                    </div>   
                 {!! Form::open(["id"=>"addAtt","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">
      
                         @include('cp.revenue.addAtt')
     
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

        <div class="modal fade" id="modal-attEdit" tabindex="-1" role="basic" aria-hidden="true">
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