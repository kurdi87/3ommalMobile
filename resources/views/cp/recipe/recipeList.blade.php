@extends('cp.layout.layout')

@section('css')

@stop

@section('js')
    <script src="cp/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

    <script src="cp/js/recipe.js" type="text/javascript"></script>
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
                        <span class="caption-subject bold uppercase">Recipe - الوصفات</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet box blue package-form-rg">
                        <div class="portlet-title myptitle">
                            <div class="caption">
                                <i class="fa fa-search"></i>Search
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="expand mycollapse"></a>
                                <!-- <a href="javascript:;" class="remove"> </a> -->
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form" style="display: none">
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
                                        <div class="col-md-4 hidden">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="countryN" placeholder="" value="0" class="filter"/>
                                                {!! Form::select('country', $country, NULL,["class"=>"form-control select2 ","id"=>"country"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('country') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 hidden">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <input type="hidden" id="typeN" placeholder=""  value="0" class="filter"/>
                                                {!! Form::select('type', $type, NULL,["class"=>"form-control select2","id"=>"type"]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('type'))
                                                    <span class="help-block error">{{ $errors->first('type') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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

                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">

                                    <div class="btn-group">
                                        <a href="{{ config('app.cp_route_name') }}/recipe/create" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="New Recipe">
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
                                        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">recipe List - الوصفات
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a class="exportData" data-href="{{ config('app.cp_route_name') }}/recipe/reprt?export=csv&amp;" href="{{ config('app.cp_route_name') }}/recipe/list?export=csv&amp;">
                                                    <i class="fa fa-print"></i>Export To CSV
                                                </a>
                                            </li>
                                            <li>
                                                <a class="exportData" data-href="{{ config('app.cp_route_name') }}/recipe/list?export=xlsx&amp;" href="{{ config('app.cp_route_name') }}/recipe/list?export=xlsx&amp;">
                                                    <i class="fa fa-file-excel-o"></i>Export To Excel
                                                </a>
                                            </li>
                                            <li>
                                                <a class="exportData" data-href="{{ config('app.cp_route_name') }}/recipe/list?export=pdf&amp;" href="{{ config('app.cp_route_name') }}/recipe/list?export=pdf&amp;">
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

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="mydatatable">
                        <thead>
                        <tr>
                            <th>ID - رقم</th>
                            <th>Name - الاسم</th>
                            <th>Web Address  - المصدر</th>

                            <th>Main - رئيسي</th>
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