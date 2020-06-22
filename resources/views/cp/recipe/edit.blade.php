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
    <style>
        .portlet-title .add{
            width: 100%;
            background-color: #e4e6ed;
            height: 40px !important;
            font-size: 14px;
            padding-top: 10px !important;
            font-weight: bold;
        }
        span.select2-container:nth-child(2)
       {
           z-index: 50000;
       }
        .portlet-title .title{
          font-weight: bold;
            font-size: 18px;
        }
        #mydatatable2 > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(2)
        {
            width: 10% !important;
        }
        #mydatatable2_wrapper > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > table:nth-child(1) > thead:nth-child(1) > tr:nth-child(1) > th:nth-child(2)
        {
            width: 10% !important;
        }
        #mydatatable5 > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(3)
        {
            width: 10% !important;
        }
        #mydatatable5_wrapper > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > table:nth-child(1) > thead:nth-child(1) > tr:nth-child(1) > th:nth-child(3)
        {
            width: 10% !important;
        }
        #mydatatable5 > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(2)
        {
            width: 65% !important;
        }
        #mydatatable5_wrapper > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > table:nth-child(1) > thead:nth-child(1) > tr:nth-child(1) > th:nth-child(2)
        {
            width: 65% !important;
        }
        #mydatatable5 > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(4)
        {
            width: 5% !important;
        }
        #mydatatable5_wrapper > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > table:nth-child(1) > thead:nth-child(1) > tr:nth-child(1) > th:nth-child(4)
        {
            width: 5% !important;
        }
        #mydatatable5 > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(1)
        {
            width: 5% !important;
        }
        #mydatatable5_wrapper > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > table:nth-child(1) > thead:nth-child(1) > tr:nth-child(1) > th:nth-child(1)
        {
            width: 5% !important;
        }

    </style>
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
    <script src="cp/js/recipeForm.js" type="text/javascript"></script>
    <script src="cp/js/recipeDepartment.js" type="text/javascript"></script>
    <script src="cp/js/recipeCategory.js" type="text/javascript"></script>
    <script src="cp/js/recipeStat.js" type="text/javascript"></script>
    <script src="cp/js/recipeAdv.js" type="text/javascript"></script>
    <script src="cp/js/recipeDieseas.js" type="text/javascript"></script>
    <script src="cp/js/recipePhoto.js" type="text/javascript"></script>

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
    @if(isset($cont)&& $cont==1 )
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '{{ $cont }}', 'Success Continue all Fields');
            });

        </script>
    @endif
@stop

@section('content')
    <div class="form-package">
    {!! Form::model($result,['action'=>['Admin\RecipeController@update',$result->id],'class'=>'form-validation form-datavalidation']) !!}
    @include('cp.recipe.form')
    {!! Form::close() !!}


    <!--Add Department-->

        <!--Add Category-->
        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <p class="title">التصنيفات-Category </p>
                            <a title="Add Category" data-modal="modal-categoryadd"
                               class="add categorymodal btn  btn-large  tooltip-one-info" data-id=""
                               href="#">
                                <i class="fa fa-plus"> </i>
                            </a>
                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="mydatatable1">
                            <thead>
                            <tr>

                                <th>Name - اسم التصنيف</th>
                                <th>Parent - المصدر</th>


                                <th class="tblaction-rg tblaction-three-rg">Delete - حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="portlet-title">

                            <p class="title"> إضافة خطوات التحضير </p>
                            <a title="Add Adavnteges" data-modal="modal-advadd"
                               class=" add advmodal btn btn-large   tooltip-one-info" data-id=""
                               href="#">
                                <i class="fa fa-plus"> </i>
                            </a>

                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="mydatatable5">
                            <thead>
                            <tr>
                                <th> الترتيب</th>
                                <th> الخطوة</th>

                                <th> الوقت</th>
                                <th> الصور</th>
                                <th class="tblaction-rg tblaction-three-rg">Delete - حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="portlet-title">

                        <p class="title"> المقادير</p>
                            <a title="Add Statitistics" data-modal="modal-statadd"
                               class="statmodal btn btn-large add  tooltip-one-info" data-id=""
                               href="#">
                                <i class="fa fa-plus"> </i>
                            </a>

                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="mydatatable2">
                            <thead>
                            <tr>

                                <th >Name - المقدار</th>
                                <th >Delete - حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="portlet-title">
                        <p class="title"> صور</p>
                            <a title="Add Photos" data-modal="modal-photoadd"
                               class="photomodal btn btn-large add tooltip-one-info" data-id=""
                               href="#">
                                <i class="fa fa-plus"> </i>
                            </a>
                        
                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                               id="mydatatable3">
                            <thead>
                            <tr>
                                <th>ID - رقم</th>
                                <th>Name - اسم</th>
                                <th>Title - عنوان</th>


                                <th class="tblaction-rg tblaction-three-rg">Delete - حذف</th>
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

        <div class="modal fade" id="modal-categoryadd" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Category</h4>
                    </div>
                    {!! Form::open(["id"=>"addCategory","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">

                        @include('cp.recipe.addCategory')

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

        <div class="modal fade" id="modal-categoryEdit" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit Category</h4>
                    </div>
                    {!! Form::open(["id"=>"editCategory","class"=>"form-validation "]) !!}
                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>


        <!-- Addd Recipe Advateges -->



        <div class="modal fade" id="modal-advadd" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Step - إضافة خطوة</h4>
                    </div>
                    {!! Form::open(["id"=>"addAdv","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">

                        @include('cp.recipe.addRecipeAdv')

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

        <div class="modal fade" id="modal-advEdit" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit Advantege - تعديل الخطوة</h4>
                    </div>
                    {!! Form::open(["id"=>"editAdv","class"=>"form-validation "]) !!}
                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>







        <div class="modal fade" id="modal-statadd" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Item - إضافة مقدار </h4>
                    </div>
                    {!! Form::open(["id"=>"addStat","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">

                        @include('cp.recipe.addStat')

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

        <div class="modal fade" id="modal-statEdit" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit Item - وصف المقدار</h4>
                    </div>
                    {!! Form::open(["id"=>"editStat","class"=>"form-validation "]) !!}
                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>
        <!--Photos-->




        <div class="modal fade" id="modal-photoadd" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add Photo - اضف صورة</h4>
                    </div>
                    {!! Form::open(["id"=>"addPhoto","class"=>"form-validation "]) !!}
                    <div class="modal-body-attach" id="div1">

                        @include('cp.recipe.addPhoto')

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>

        <div class="modal fade" id="modal-photoEdit" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit photo</h4>
                    </div>
                    {!! Form::open(["id"=>"editPhoto","class"=>"form-validation "]) !!}
                    <div class="modal-body" id="div1">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close - إغلاق</button>
                        <button type="submit" class="btn green">Save - حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--tabbable line-->
        </div>














@stop