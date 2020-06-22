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
    <link href="cp/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
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
    @if(!in_array($role,$spu))
        <script src="cp/js/invoice.js" type="text/javascript"></script>
    @else
        <script src="cp/js/invoicespu.js" type="text/javascript"></script>
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
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Invoice</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet box blue package-form-rg">
                        <div class="portlet-title myptitle">
                            <div class="caption">
                                <i class="fa fa-search"></i>Search
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="expand mycollapse "></a>
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

                                                <input data-column="1" type="text" class="form-control searchable"
                                                       placeholder="Name or Patient ID" value=""/>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="statusN" placeholder="" value="{{ (app()->request->status?app()->request->status:0)}}"
                                                       class="filter"/>
                                                {!! Form::select('status', $status, (app()->request->status?app()->request->status:null),["class"=>"form-control select2 ","id"=>"status"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('status') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="hospitalN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('hospital', $hospital, NULL,["class"=>"form-control select2 ","id"=>"hospital"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('recipe') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                                <input type="hidden" id="issubmitN" placeholder=""
                                                       value="{{ (app()->request->issubmit?app()->request->issubmit:null)}}"/>
                                                {!! Form::select('issubmit', $issubmit, (app()->request->issubmit?app()->request->issubmit:null),["class"=>" select2 form-control ","id"=>"issubmit"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('issubmit'))
                                                    <span class="help-block error">{{ $errors->first('issubmit') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="related_accidentN" placeholder=""
                                                       value="{{ (app()->request->related_accident?app()->request->related_accident:null)}}"/>
                                                {!! Form::select('related_accident', $related_accident, (app()->request->related_accident?app()->request->related_accident:null),["class"=>"select2 form-control ","id"=>"related_accident"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('related_accident'))
                                                    <span class="help-block error">{{ $errors->first('related_accident') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        


                                        <div class="col-md-4 {{in_array($role,$spu)?'hidden':''}}">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="agentN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('agent', $agent, NULL,["class"=>"form-control select2 ","id"=>"agent"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('agent'))
                                                    <span class="help-block error">{{ $errors->first('agent') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 {{in_array($role,$spu)?'hidden':''}}">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="commissionN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('commission', $commission, NULL,["class"=>"form-control select2 ","id"=>"commission"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('commission'))
                                                    <span class="help-block error">{{ $errors->first('commission') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 {{in_array($role,$spu)?'hidden':''}}">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="employeeN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('employee', $employee, NULL,["class"=>"form-control select2 ","id"=>"employee"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('employee') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 {{in_array($role,$spu)?'hidden':''}}">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="paidN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('paid', $paid, NULL,["class"=>"form-control select2 ","id"=>"paid"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('paid'))
                                                    <span class="help-block error">{{ $errors->first('paid') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 {{in_array($role,$spu)?'hidden':''}}">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="paid_finance_partyN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('paid_finance_party', $paid_finance_party, NULL,["class"=>"form-control select2 ","id"=>"paid_finance_party"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('paid_finance_party'))
                                                    <span class="help-block error">{{ $errors->first('paid_finance_party') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 {{in_array($role,$spu)?'hidden':''}}">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="paid_to_hosN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('paid_to_hos', $paid_to_hos, NULL,["class"=>"form-control select2 ","id"=>"paid_to_hos"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('paid_to_hos'))
                                                    <span class="help-block error">{{ $errors->first('paid_to_hos') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-4 {{in_array($role,$spu)?'hidden':''}}">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="rfp_to_hosN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('rfp_to_hos', $rfp_to_hos, NULL,["class"=>"form-control select2 ","id"=>"rfp_to_hos"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('rfp_to_hos'))
                                                    <span class="help-block error">{{ $errors->first('rfp_to_hos') }}</span>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="col-md-6">

                                            <div class="input-group input-xlarge date-picker input-daterange"
                                                 data-date="2018/01/01" data-date-format="yyyy/mm/dd">
                                                <input type="text" id="from" class="form-control" name="from"
                                                       placeholder="Month form">
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" id="to" class="form-control" name="to"
                                                       placeholder="Month to">
                                            </div>


                                        </div>

                                        <div class="col-md-6">

                                            <div class="input-group input-xlarge date-picker input-daterange"
                                                 data-date="2018/01/01" data-date-format="yyyy/mm/dd">
                                                <input type="text" id="fromF" class="form-control" name="fromF"
                                                       placeholder="Finance Month form">
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" id="toF" class="form-control" name="toF"
                                                       placeholder="Finance Month to">
                                            </div>


                                        </div>


                                        <!--span-->
                                        <div class="col-md-4">
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

                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">


                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
                                        invoice List
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a class="exportData"
                                               data-href="{{ config('app.cp_route_name') }}/invoice/list?export=csv&amp;"
                                               href="{{ config('app.cp_route_name') }}/invoice/list?export=csv&amp;">
                                                <i class="fa fa-print"></i>Export To CSV
                                            </a>
                                        </li>
                                        <li>
                                            <a class="exportData"
                                               data-href="{{ config('app.cp_route_name') }}/invoice/list?export=xlsx&amp;"
                                               href="{{ config('app.cp_route_name') }}/invoice/list?export=xlsx&amp;">
                                                <i class="fa fa-file-excel-o"></i>Export To Excel
                                            </a>
                                        </li>
                                        <li>
                                            <a class="exportData"
                                               data-href="{{ config('app.cp_route_name') }}/invoice/list?export=pdf&amp;"
                                               href="{{ config('app.cp_route_name') }}/invoice/list?export=pdf&amp;">
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
                    <h4 class="tableInfo"></h4>

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="mydatatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Patient ID</th>
                            <th>Event ID</th>
                            <th>Event No</th>
                            <th class="{{in_array($role,$spu)?'hidden':''}}">Invoice No</th>
                            <th>Finance Party</th>
                            <th>Admission</th>
                            <th>Claim</th>
                            <th>Hospital</th>
                            <th>Department</th>
                            <th>Month</th>
                            <th>Finance Month</th>
                            <th>Discharge Date</th>
                            <th>Cost NIS</th>
                            <th class="{{in_array($role,$spu)?'hidden':''}}">Amount of Comission</th>
                            <th class="{{in_array($role,$spu)?'hidden':''}}">Subject to Comm.</th>
                            <th class="{{in_array($role,$spu)?'hidden':''}}">RFP to Hos</th>
                            <th class="">Paid FP</th>
                            <th class="{{in_array($role,$spu)?'hidden':''}}">Agent</th>
                            <th class="{{in_array($role,$spu)?'hidden':''}}">Paid to Agent</th>
                            <th>Status</th>
                            <th class="">Edit</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        @if(in_array($role,$spu))
                        <tfoot>
                        <tr>
                            <th colspan="2"><h4
                                        class="text text-danger">
                                    Total Cost:</h4></th>
                            <th colspan="2"></th>

                        </tr>

                        </tfoot>

                        @else
                            <tfoot>
                            <tr>
                                <th colspan="2"><h4
                                            class="text text-danger">
                                        Total Cost:</h4></th>
                                <th colspan="2"></th>
                                <th colspan="2"><h4
                                            class="text text-warning">
                                        Total Commission:</h4></th>
                                <th colspan="3" ></th >
                                <th colspan="5"></th >
                            </tr>

                            </tfoot>
                        @endif
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
                    <h4 class="modal-title">Invoice Process History</h4>
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




@stop