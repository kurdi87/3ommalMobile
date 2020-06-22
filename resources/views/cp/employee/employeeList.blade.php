@extends('cp.layout.layout')

@section('css')
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
    <script src="cp/js/employee.js" type="text/javascript"></script>
    @if(isset($success))
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '{{ $success }}', 'Success Message');
            });

        </script>
    @endif
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Employees- الموظفين</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet box blue package-form-rg">
                        <div class="portlet-title myptitle">
                            <div class="caption">
                                <i class="fa fa-search"></i>Search - بحث
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
                                                <span class="lblinput">Name - اسم</span>
                                                <input data-column="1" type="text" class="form-control searchable" placeholder="" value=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="typeN" placeholder="" value="0" class="filter"/>
                                                {!! Form::select('type', $type, NULL,["class"=>"form-control select2 ","id"=>"type"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('type'))
                                                    <span class="help-block error">{{ $errors->first('type') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="departmentN" placeholder="" value="0" class="filter"/>
                                                {!! Form::select('department', $department, NULL,["class"=>"form-control select2 ","id"=>"department"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('department'))
                                                    <span class="help-block error">{{ $errors->first('department') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="managerN" placeholder="" value="0" class="filter"/>
                                                {!! Form::select('manager', $manager, NULL,["class"=>"form-control select2 ","id"=>"manager"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('manager'))
                                                    <span class="help-block error">{{ $errors->first('manager') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        



                                        <!--/span-->
                                      
                                        <!--span-->
                                        <div class="col-md-4 clearfix">
                                            <div class="btn-search-reset">
                                                <button type="button" class="btn green btn-submit-search">Search</button>
                                                <button type="button" class="btn default btn-reset">Empty</button>
                                            </div>
                                        </div>
                                       
                                        <!--span-->
                                    </div>
                                
                                    
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    @if(in_array($role,$create_edit))
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">

                                    <div class="btn-group">
                                        <a href="{{ config('app.cp_route_name') }}/employee/create" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="New employee">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>

                            </div>
                         
                        </div>
                    </div>
                    @endif

                    <div class="tblactions-region">

                    </div>
                    <!-- tblactions region -->

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="mydatatable">
                        <thead>
                        <tr>
                            <th>ID - رقم</th>
                            <th>Name - الأسم</th>
                            <th>Mobile - الجوال</th>
                            <th>Email -  الإيميل</th>
                            <th>User name -  اسم المستخدم</th>
                            <th>Type -  النوع</th>
                            <th>Department -  القسم</th>
                            <th>Status - الحالة</th>
                            
                            <th class="tblaction-rg tblaction-three-rg" >Edit - تعديل</th>
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

   
@stop