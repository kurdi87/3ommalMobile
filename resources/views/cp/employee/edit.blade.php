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
    <script src="cp/js/employeeForm.js" type="text/javascript"></script>

    <script src="cp/js/employeeAtt.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("chart_2", am4charts.XYChart);

        chart.exporting.menu = new am4core.ExportMenu();
        chart.numberFormatter.numberFormat = "#.0a";

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "month_name";
        categoryAxis.renderer.minGridDistance = 1;

        /* Create value axis */
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var columnSeries = chart.series.push(new am4charts.ColumnSeries());
        columnSeries.name = "Working Hour";
        columnSeries.dataFields.valueY = "whour";
        columnSeries.dataFields.categoryX = "month_name";

        columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Working Hour in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"

        columnSeries.tooltip.label.textAlign = "left";

        var columnSeries = chart.series.push(new am4charts.ColumnSeries());
        columnSeries.name = "Extra Working Hour";
        columnSeries.dataFields.valueY = "xwhour";
        columnSeries.dataFields.categoryX = "month_name";

        columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Extra Working Hour in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"

        columnSeries.tooltip.label.textAlign = "left";


        var d = new Date();
        var n = d.getFullYear();
        chart.dataSource.url = "crm/employeePayment/getMonthPayment?year=" + n + "&emp_id={{$result->id}}";
        //chart.dataSource.parser = am4core.JSONParser;


        // end am4core.ready()
    </script>
    <script>
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("chart_3", am4charts.XYChart);

        chart.exporting.menu = new am4core.ExportMenu();
        chart.numberFormatter.numberFormat = "#.0a";

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "month_name";
        categoryAxis.renderer.minGridDistance = 1;

        /* Create value axis */
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var columnSeries = chart.series.push(new am4charts.ColumnSeries());
        columnSeries.name = "Payment";
        columnSeries.dataFields.valueY = "amount";
        columnSeries.dataFields.categoryX = "month_name";
        var x = "";

        columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Payment({payment_type}) in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"

        columnSeries.tooltip.label.textAlign = "left";




        var d = new Date();
        var n = d.getFullYear();
        chart.dataSource.url = "crm/employeePayment/getMonthPayment?year=" + n + "&emp_id={{$result->id}}";
        //chart.dataSource.parser = am4core.JSONParser;


        // end am4core.ready()
    </script>
    <script>
        $('#year').change(function () {
            var year = document.getElementById("year").value;
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create("chart_2", am4charts.XYChart);

            chart.exporting.menu = new am4core.ExportMenu();
            chart.numberFormatter.numberFormat = "#.0a";

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "month_name";
            categoryAxis.renderer.minGridDistance = 1;

            /* Create value axis */
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            /* Create series */
            var columnSeries = chart.series.push(new am4charts.ColumnSeries());
            columnSeries.name = "Working Hour";
            columnSeries.dataFields.valueY = "whour";
            columnSeries.dataFields.categoryX = "month_name";

            columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Working Hour in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"

            columnSeries.tooltip.label.textAlign = "left";

            var columnSeries = chart.series.push(new am4charts.ColumnSeries());
            columnSeries.name = "Extra Working Hour";
            columnSeries.dataFields.valueY = "xwhour";
            columnSeries.dataFields.categoryX = "month_name";

            columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Extra Working Hour in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"

            columnSeries.tooltip.label.textAlign = "left";


            var d = new Date();
            var n = d.getFullYear();
            chart.dataSource.url = "crm/employeePayment/getMonthPayment?year=" + year + "&emp_id={{$result->id}}";
            //chart.dataSource.parser = am4core.JSONParser;



        });
    </script>
    <script>
        $('#year2').change(function () {
            var year = document.getElementById("year2").value;
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create("chart_3", am4charts.XYChart);

            chart.exporting.menu = new am4core.ExportMenu();
            chart.numberFormatter.numberFormat = "#.0a";

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "month_name";
            categoryAxis.renderer.minGridDistance = 1;

            /* Create value axis */
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            /* Create series */
            var columnSeries = chart.series.push(new am4charts.ColumnSeries());
            columnSeries.name = "Payment";
            columnSeries.dataFields.valueY = "amount";
            columnSeries.dataFields.categoryX = "month_name";
            var x = "";

            columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Payment({payment_type}) in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"

            columnSeries.tooltip.label.textAlign = "left";




            var d = new Date();
            var n = d.getFullYear();
            chart.dataSource.url = "crm/employeePayment/getMonthPayment?year=" + year + "&emp_id={{$result->id}}";



        });
    </script>

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
        {!! Form::model($result,['action'=>['Admin\EmployeeController@update',$result->id],'class'=>'form-validation form-datavalidation']) !!}
        @include('cp.employee.form')
        {!! Form::close() !!}
    </div>
    


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
                            </a> Click Here To Add Atts To This employee - مرفقات
                        </div>
                    </div>
                    <div class="portlet-body">


                        <!-- tblactions region -->

                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="mydatatable3">
                            <thead>
                            <tr>
                                <th>ID - رقم </th>
                                <th>Name - اسم</th>
                                <th>Type - نوع</th>
                                <th>Title -  عنوان</th>
                                <th>Inforamtion - معلومات</th>

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
    <div class="row">
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-yellow-haze"></i>
                        <span class="caption-subject bold uppercase font-yellow-haze">Employee Working Hours</span>
                        <select id="year" class="form-control select2" name="year"
                                tabindex="-1" aria-hidden="true">
                            <option value="0">Select Year - السنة</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019" selected="selected">2019</option>
                            <option value="2020">2020</option>
                            <option value="2012">2021</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                    <div class="tools">


                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_2" class="chart" style="height: 500px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-yellow-haze"></i>
                        <span class="caption-subject bold uppercase font-yellow-haze">EmployeePayments</span>
                        <select id="year2" class="form-control select2" name="year"
                                tabindex="-1" aria-hidden="true">
                            <option value="0">Select Year - السنة</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019" selected="selected">2019</option>
                            <option value="2020">2020</option>
                            <option value="2012">2021</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                    <div class="tools">


                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_3" class="chart" style="height: 500px;"></div>
                </div>
            </div>
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

                        @include('cp.employee.addAtt')

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

@stop