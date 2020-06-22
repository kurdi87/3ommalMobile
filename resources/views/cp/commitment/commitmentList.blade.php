@extends('cp.layout.layout')

@section('css')

    <link href="cp/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
    <script src="cp/js/commitment.js" type="text/javascript"></script>
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
                        <span class="caption-subject bold uppercase">Commitment - نموذج تغطية مالية</span>
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
                                        <div class="col-md-3">
                                            <div class="form-group input-wlbl">

                                                <input data-column="1" type="text" class="form-control searchable"
                                                       placeholder="Name or ID or Claim# or Ref #  " value=""/>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="statusN" placeholder=""
                                                       value="{{ (app()->request->status?app()->request->status:0)}}"/>
                                                {!! Form::select('status', $status, (app()->request->status?app()->request->status:null),["class"=>"form-control ","id"=>"status"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('status') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="hospitalN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('hospital', $hospital, NULL,["class"=>"form-control select2 ","id"=>"hospital"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('hospital') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="finance_partyN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('finance_party', $finance_party, NULL,["class"=>"form-control select2 ","id"=>"finance_party"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('finance_party') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="regionN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('region', $region, NULL,["class"=>"form-control select2 ","id"=>"region"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('region'))
                                                    <span class="help-block error">{{ $errors->first('region') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="departmentN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('department', $department, NULL,["class"=>"form-control select2 ","id"=>"department"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('department'))
                                                    <span class="help-block error">{{ $errors->first('department') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="attachedN" placeholder=""
                                                       value="0"/>
                                                {!! Form::select('attached',$attached,null,['class'=>'form-control  ',"id"=>"attached"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('uploaded'))
                                                    <span class="help-block error">{{ $errors->first('attached') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="procedureN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('procedure', $procedure, NULL,["class"=>"form-control select2 ","id"=>"procedure"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('procedure'))
                                                    <span class="help-block error">{{ $errors->first('procedure') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="clearfix">

                                        </div>
                                        <div class="col-md-6">

                                            <div class="input-group input-xlarge date-picker input-daterange"
                                                 data-date="2018/01/01" data-date-format="yyyy/mm/dd">
                                                <input type="text" id="from" class="form-control" name="from"
                                                       placeholder="Date form">
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" id="to" class="form-control" name="to"
                                                       placeholder="Datre to">
                                            </div>


                                        </div>


                                        <div class="clearfix">

                                        </div>
                                        <div class="col-md-4">
                                            <!--span-->
                                            <div class="btn-search-reset">
                                                <button type="button" class="btn green btn-submit-search">Search
                                                </button>
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
                    @if(in_array($role,$create_edit) || in_array($role,$create))
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="btn-group">
                                        <a href="{{ config('app.cp_route_name') }}/commitment/create"
                                           class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                                           title="New Commitment - جديد">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>


                                </div>

                            </div>
                        </div>
                    @endif
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">


                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
                                        Commitment List - قائمة
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a class="exportData"
                                               data-href="{{ config('app.cp_route_name') }}/commitment/reprt?export=csv&amp;"
                                               href="{{ config('app.cp_route_name') }}/commitment/list?export=csv&amp;">
                                                <i class="fa fa-print"></i>Export To CSV
                                            </a>
                                        </li>
                                        <li>
                                            <a class="exportData"
                                               data-href="{{ config('app.cp_route_name') }}/commitment/list?export=xlsx&amp;"
                                               href="{{ config('app.cp_route_name') }}/commitment/list?export=xlsx&amp;">
                                                <i class="fa fa-file-excel-o"></i>Export To Excel
                                            </a>
                                        </li>
                                        <li>
                                            <a class="exportData"
                                               data-href="{{ config('app.cp_route_name') }}/commitment/list?export=pdf&amp;"
                                               href="{{ config('app.cp_route_name') }}/commitment/list?export=pdf&amp;">
                                                <i class="fa fa-file-pdf-o"></i> Export To PDF
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tblactions-region">

                    </div>


                    <!-- tblactions region -->

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="mydatatable">
                        <thead>
                        <tr>
                            <th>ID - رقم</th>
                            <th>Name - اسم المريض</th>
                            <th>Patient ID - رقم الهوية</th>
                            <th>Service Provider - مزود الخدمة</th>
                            <th>Department- القسم</th>
                            <th>Claim # - الإدعاء</th>
                            <th> Ref # - المرجع</th>
                            <th> Region # - المنطقة</th>
                            <th>Finance Party - التأمين</th>
                            <th>amount - التكلفة</th>
                            <th>Est Amount - التكلفة التقديرية</th>
                            <th>Commitment Date - تاريخ</th>
                            <th>Procedures Codes - ألإجراءات</th>
                            <th> Accident id</th>
                            <th> Accident Type - نوع الحادث</th>

                            <th> Event id </th>
                            <th> Admission id </th>

                            <th>Status - الحالة</th>

                            <th class="tblaction-rg tblaction-three-rg">Edit - تعديل</th>
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
    <div class="modal fade" id="modal-process" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Commitment Process History - تاريخ</h4>
                </div>

                <div class="modal-body" id="div1">


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                </div>

                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--tabbable line-->
    </div>

    <div class="modal fade" id="modal-cstatus" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add Status</h4>
                </div>
                {!! Form::open(["id"=>"addCstatus","method"=>"post","class"=>"form-validation "]) !!}
                <div class="modal-body-cstatus" id="div1">


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

    <div class="modal fade" id="modal-view-cstatus" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Cstatus Report</h4>
                </div>

                <div class="modal-body-viewcstatus" id="div1">


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                </div>

                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--tabbable line-->
    </div>
    <div class="modal fade" id="modal-email" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            {!! Form::open(['action'=>'Admin\CommitmentController@sendEmail','class'=>'form-validation form-datavalidation','id'=>'emailForm']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Send as Email</h4>
                </div>

                <div class="modal-body" id="div1">


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" id="sendEmail" class="btn green">Send</button>
                </div>

                <!-- /.modal-content -->
            </div>
        {!! Form::close() !!}
        <!-- /.modal-dialog -->
        </div>
        <!--tabbable line-->
    </div>






@stop