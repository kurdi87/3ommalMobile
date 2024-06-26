@extends('cp.layout.layout')

@section('css')

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
    <script src="cp/js/category.js" type="text/javascript"></script>
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
                        <span class="caption-subject bold uppercase"> التصنيفات</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet box blue package-form-rg">
                        <div class="portlet-title myptitle">
                            <div class="caption">
                                <i class="fa fa-search"></i>بحث
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
                                                <input data-column="1" type="text"  class="form-control searchable"
                                                       placeholder="name" value=""/>
                                            </div>
                                        </div>




                                        <div class="col-md-3 ">
                                            <div class="form-group input-wlbl">
                                                <input type="hidden" id="parent_idN" placeholder=""  value="0" class="filter"/>
                                                {!! Form::select('parent_id',$categorys,null,['class'=>'form-control select2  txtinput',"id"=>"parent_id"]) !!}
                                            </div>
                                        </div>







                                        <div class="col-md-3 ">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="typeN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('type', $type, NULL,["class"=>"form-control select2","id"=>"type"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('type'))
                                                    <span class="help-block error">{{ $errors->first('type') }}</span>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="activeN" placeholder="" value="0"
                                                       class="filter"/>
                                                {!! Form::select('active', $active, NULL,["class"=>"form-control select2","id"=>"active"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('active'))
                                                    <span class="help-block error">{{ $errors->first('active') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12 ">
                                            <div class="form-group input-wlbl">
                                                <input type="hidden" id="sourceN" placeholder=""  value="0" class="filter"/>
                                                {!! Form::text('source',null,['class'=>'form-control   txtinput',"id"=>"source","placeholder"=>"Source"]) !!}
                                            </div>
                                        </div>

                                        
                                        <!--/span-->

                                        <!--span-->
                                        <div class="col-md-4 clearfix">
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

                                <div class="btn-group">
                                    <a href="{{ config('app.cp_route_name') }}/category/create"
                                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                                       title="New Category">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="tblactions-region">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">


                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right">
                                        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
                                          التصنيفات
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a class="exportData"
                                                   data-href="{{ config('app.cp_route_name') }}/category/reprt?export=csv&amp;"
                                                   href="{{ config('app.cp_route_name') }}/category/list?export=csv&amp;">
                                                    <i class="fa fa-print"></i>Export To CSV
                                                </a>
                                            </li>
                                            <li>
                                                <a class="exportData"
                                                   data-href="{{ config('app.cp_route_name') }}/category/list?export=xlsx&amp;"
                                                   href="{{ config('app.cp_route_name') }}/category/list?export=xlsx&amp;">
                                                    <i class="fa fa-file-excel-o"></i>Export To Excel
                                                </a>
                                            </li>
                                            <li>
                                                <a class="exportData"
                                                   data-href="{{ config('app.cp_route_name') }}/category/list?export=pdf&amp;"
                                                   href="{{ config('app.cp_route_name') }}/category/list?export=pdf&amp;">
                                                    <i class="fa fa-file-pdf-o"></i> Export To PDF
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- tblactions region -->

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="mydatatable">
                        <thead>
                        <tr>
                            <th> رقم</th>
                            <th> الاسم</th>
                            <th>Name En</th>
                            <th> الوصف</th>
                            <th>الأبناء</th>
                            <th>الأب</th>
                            <th>الحالة</th>

                            <th class="tblaction-rg tblaction-three-rg"> تعديل</th>
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