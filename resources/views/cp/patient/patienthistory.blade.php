@php
    use Carbon\Carbon;
    use App\Models\AdmissionModel;
@endphp


@extends('cp.layout.layout')

@section('css')
    <style>
        .fc-day-grid-event:hover {

            display: inherit !important;
            background-color: green;
            z-index: 1000;

        }
    </style>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="cp/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="cp/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="cp/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="cp/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="cp/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- Remember to include jQuery :) -->


@stop

@section('js')
    <!-- END QUICK NAV -->
    <!--[if lt IE 9]>
    <script src="cp/assets/global/plugins/respond.min.js"></script>
    <script src="cp/assets/global/plugins/excanvas.min.js"></script>
    <script src="cp/assets/global/plugins/ie8.fix.min.js"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="cp/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="cp/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="cp/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="cp/assets/pages/scripts/dashboard.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("chart_2", am4charts.XYChart);

        chart.exporting.menu = new am4core.ExportMenu();
        chart.numberFormatter.numberFormat = "#.0a";

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "invoice_year";
        categoryAxis.renderer.minGridDistance = 1;

        /* Create value axis */
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var columnSeries = chart.series.push(new am4charts.ColumnSeries());
        columnSeries.name = "Amount";
        columnSeries.dataFields.valueY = "cost";
        columnSeries.dataFields.categoryX = "invoice_year";
        columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Amount in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"
        columnSeries.tooltip.label.textAlign = "left";
        chart.dataSource.url = "crm/invoice/getYear?user_id={{\Auth::user("admin")->SysUsr_ID}}&patient_id={{$patient->id}}";
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
        columnSeries.name = "Amount";
        columnSeries.dataFields.valueY = "cost";
        columnSeries.dataFields.categoryX = "month_name";
        columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Amount in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"
        columnSeries.tooltip.label.textAlign = "left";
        var d = new Date();
        var n = d.getFullYear();
        chart.dataSource.url = "crm/invoice/getMonth?year=" + n + "&user_id={{Auth::user("admin")->SysUsr_ID}}&patient_id={{$patient->id}}"
    </script>
    <script>
        am4core.ready(function () {
            var chart = am4core.create("chart_3_2", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
            chart.legend = new am4charts.Legend();
            var n = d.getFullYear();
            chart.dataSource.url = "crm/admission/getMonthHospital?year=" + n + "&user_id={{Auth::user("admin")->SysUsr_ID}}&patient_id={{$patient->id}}";
            chart.innerRadius = 50;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "discharged";
            series.dataFields.category = "hospitalName";




        });
        am4core.ready(function () {
            var chart = am4core.create("chart_3_1", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
            chart.legend = new am4charts.Legend();
            var n = d.getFullYear();
            chart.dataSource.url = "crm/admission/getDepartmentDischarged?year=" + n + "&user_id={{Auth::user("admin")->SysUsr_ID}}&patient_id={{$patient->id}}";
            chart.innerRadius = 50;
            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "discharged";
            series.dataFields.category = "departmentName";




        });

    </script>
    <script>
        $('#year').change(function () {
            var year = document.getElementById("year").value;
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
            columnSeries.name = "Amount";
            columnSeries.dataFields.valueY = "cost";
            columnSeries.dataFields.categoryX = "month_name";
            columnSeries.columns.template.tooltipText = "[#fff font-size: 15px] Amount in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/]"
            columnSeries.tooltip.label.textAlign = "left";


            var d = new Date();
            var n = d.getFullYear();
            chart.dataSource.url = "crm/invoice/getMonth?year=" + year + "&user_id={{Auth::user("admin")->SysUsr_ID}}&patient_id={{$patient->id}}"
            //chart.dataSource.parser = am4core.JSONParser;


        });
    </script>






    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('#clickmewow').click(function () {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">

                        <span class="caption-subject">Pateint History for <span
                                    class="bold uppercase"> {{$patient->fname." ".$patient->faname }}</span> </span>
                    </div>

                    <div class="clearfix">
                        <hr>
                    </div>

                    <div class="caption font-dark">

                        <span class="caption-subject  ">Pateint ID: <span
                                    class="bold uppercase">{{$patient->sid }} </span></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="crm/event">
                                <div class="visual">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($events)}}">0</span>
                                    </div>
                                    <div class="desc"> Events</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 red" href="crm/referral">
                                <div class="visual">
                                    <i class="fa fa-external-link"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($referrals)}}">0</span>
                                    </div>
                                    <div class="desc"> Referral Forms</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 yellow" href="crm/appointment">
                                <div class="visual">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($appointments)}}">0</span>
                                    </div>
                                    <div class="desc"> Appointment</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="crm/admission">
                                <div class="visual">
                                    <i class="fa fa-space-shuttle"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($admissions)}}">0</span>
                                    </div>
                                    <div class="desc">Admissions</div>
                                </div>
                            </a>
                        </div>

                    </div>
                    <div class="clearfix">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 black" href="crm/invoice">
                                <div class="visual">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($invoices)}}">0</span>
                                    </div>
                                    <div class="desc"> Invoices</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 bg-red-flamingo bg-font-red-flamingo"
                               href="crm/request_to_call">
                                <div class="visual">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($request_to_call)}}">0</span>
                                    </div>
                                    <div class="desc"> Request To Call</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue"
                               href="crm/claim">
                                <div class="visual">
                                    <i class="fa fa-check "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($claims)}}">0</span>
                                    </div>
                                    <div class="desc">Claims</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green"
                               href="crm/commitment">
                                <div class="visual">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($commitments)}}">0</span>
                                    </div>
                                    <div class="desc">Commitment Letter</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 yellow"
                               href="crm/gop">
                                <div class="visual">
                                    <i class="fa fa-thumbs-o-up"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{count($gops)}}">0</span>
                                    </div>
                                    <div class="desc">Request For GOP</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green"
                               href="crm/invoice">
                                <div class="visual">
                                    <i class="fa fa-thumbs-o-up"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$revenue}}">0</span>
                                    </div>
                                    <div class="desc">Treatment Cost</div>
                                </div>
                            </a>
                        </div>


                    </div>
                    <div class="clearfix">
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-social-dribbble font-purple-soft"></i>
                                        <span class="caption-subject font-purple-soft bold uppercase">View History</span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> Events </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> Referral Forms </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> Appointment </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_4" data-toggle="tab"> Admissions </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_5" data-toggle="tab"> Invoices </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_6" data-toggle="tab"> Request to call </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_7" data-toggle="tab"> Claim </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_8" data-toggle="tab"> Commitment Letter </a>
                                        </li>


                                        <li>
                                            <a href="#tab_1_9" data-toggle="tab"> Request fro GOP </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_10" data-toggle="tab"> Accidents  </a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_1">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>


                                                    <th>Hospital</th>
                                                    <th>Department</th>
                                                    <th>Finance Party</th>
                                                    <th>Coverage Date</th>
                                                    <th>Created By</th>
                                                    <th>Status</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($events as $e)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/event/eventprint/{{$e->id}}"
                                                               data-target="#ajax" data-toggle="modal">{{$e->id}}</a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/event/edit/{{$e->id}}">
                                                                {{$e->hospital}}
                                                            </a>
                                                        </td>
                                                        <td>{{$e->department}}</td>
                                                        <td>{{$e->finance_party_name}}</td>
                                                        <td> {{date('Y-m-d', strtotime($e->coverage_date))}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($e->create_user)}}</td>
                                                        <td>{{$e->astatus}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_2">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>


                                                    <th>Hospital</th>
                                                    <th>Department</th>
                                                    <th>Coverage No</th>
                                                    <th>Coverage Date</th>
                                                    <th>Created By</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($referrals as $e)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/event/referralForm/{{$e->id}}"
                                                               data-target="#ajax" data-toggle="modal">{{$e->id}}</a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/event/edit/{{$e->id}}?type=3">
                                                                {{$e->hospital}}
                                                            </a>
                                                        </td>
                                                        <td>{{$e->department}}</td>
                                                        <td>{{$e->coverage_no}}</td>
                                                        <td> {{date('Y-m-d', strtotime($e->coverage_date))}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($e->create_user)}}</td>
                                                        <td>{{$e->astatus}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade" id="tab_1_3">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="mydatatable">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Hospital</th>
                                                    <th>Department</th>
                                                    <th>Doctor</th>
                                                    <th>Appointment Date</th>
                                                    <th>Created By</th>

                                                    <th>Action</th>
                                                    <th>Status</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($appointments as $a)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/appointment/edit/{{$a->id}}"
                                                               target="_blank">{{$a->id}}</a></td>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/appointment/edit/{{$a->id}}">
                                                                {{$a->hospital}}
                                                            </a>
                                                        </td>
                                                        <td>{{$a->department}}</td>
                                                        <td>{{$a->doctor}}</td>
                                                        <td> {{date('Y-m-d', strtotime($a->adate))}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($a->create_user)}}</td>
                                                        <td> {{\App\Models\TypesModel::getTypeName($a->action)}}</td>
                                                        <td> {{$a->astatus}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="tab_1_4">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Hospital</th>
                                                    <th>Department</th>
                                                    <th>Discharge Date</th>
                                                    <th>Case Manager</th>
                                                    <th>Created By</th>

                                                    <th>Status</th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($admissions as $a)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/admission/admissionprint/{{$a->id}}"
                                                               data-target="#ajax" data-toggle="modal">{{$a->id}}</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/admission/edit/{{$a->id}}">
                                                                {{$a->hospital}}
                                                            </a>
                                                        </td>
                                                        <td>{{$a->department}}</td>
                                                        <td> {{date('Y-m-d', strtotime($a->discharge_date))}}</td>
                                                        <td>{{  ($a->case_manager==0?"Not Assign":\App\Models\EmployeeModel::find($a->case_manager)->name)}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($a->create_user)}}</td>
                                                        <td>{{$a->astatus}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="tab_1_5">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>

                                                    <th>Hospital</th>
                                                    <th>Department</th>
                                                    <th>Discharge Date</th>
                                                    <th>Cost NIS</th>
                                                    <th>Amount of Comission</th>
                                                    <th>Subject to Comm.</th>
                                                    <th>Agent</th>
                                                    <th>Created By</th>
                                                    <th>Status</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($invoices as $i)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/invoice/invoiceForm/{{$i->id}}"
                                                               data-target="#ajax" data-toggle="modal">{{$i->id}}</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/invoice/edit/{{$i->id}}">
                                                                {{$i->hospital}}
                                                            </a>
                                                        </td>
                                                        <td>{{$i->department}}</td>
                                                        <td> {{date('Y-m-d', strtotime($i->discharge_date))}}</td>
                                                        <td>{{$i->approved_cost}}</td>

                                                        <td>{{($i->commission_perc*$i->approved_cost/100)}}</td>
                                                        <td>{{($i->commission==1)?'YES':'NO'}}</td>

                                                        <td>{{$i->referral_agent}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($i->create_user)}}</td>
                                                        <td>{{$i->astatus}}</td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="tab_1_6">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Hospital</th>
                                                    <th>Department</th>
                                                    <th>Doctor</th>
                                                    <th>phone</th>
                                                    <th>email</th>
                                                    <th>Created By</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($request_to_call as $i)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/request_to_call/edit/{{$i->id}}"
                                                               target="_blank">{{$i->id}}</a></td>

                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/request_to_call/edit/{{$i->id}}">
                                                                {{$i->hospital}}
                                                            </a>
                                                        </td>
                                                        <td>{{$i->department}}</td>
                                                        <td>{{$i->doctor}}</td>
                                                        <td>{{$i->phone}}</td>
                                                        <td>{{$i->email}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($i->create_user)}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>


                                        <div class="tab-pane fade" id="tab_1_7">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Patient ID</th>
                                                    <th>Finance Party</th>
                                                    <th>Amount</th>
                                                    <th>Created By</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($claims as $i)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/claim/edit/{{$i->id}}"
                                                               target="_blank">{{$i->id}}</a></td>

                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/claim/edit/{{$i->id}}">
                                                                {{$i->patient_name}}
                                                            </a>
                                                        </td>
                                                        <td>{{$i->sid}}</td>
                                                        <td>{{$i->finance_party_name}}</td>
                                                        <td>{{$i->amount}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($i->create_user)}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="tab_1_8">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Patient ID</th>
                                                    <th>Finance Party</th>
                                                    <th>Amount</th>
                                                    <th>Service Provider</th>
                                                    <th>Date</th>
                                                    <th>Created By</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($commitments as $i)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/commitment/edit/{{$i->id}}"
                                                               target="_blank">{{$i->id}}</a></td>

                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/commitment/edit/{{$i->id}}">
                                                                {{$i->patient_name}}
                                                            </a>
                                                        </td>
                                                        <td>{{$i->sid}}</td>
                                                        <td>{{$i->finance_party_name}}</td>
                                                        <td>{{$i->amount}}</td>
                                                        <td>{{$i->hospital}}</td>
                                                        <td>{{date('Y-m-d', strtotime($i->service_date))}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($i->create_user)}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="tab_1_9">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Patient ID</th>
                                                    <th>Service Provider</th>
                                                    <th>Department</th>
                                                    <th>Doctor</th>
                                                    <th>Date</th>
                                                    <th>Total Cost</th>
                                                    <th>Approved Cost</th>
                                                    <th>Created By</th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($gops as $i)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/gop/edit/{{$i->id}}"
                                                               target="_blank">{{$i->id}}</a></td>

                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/gop/edit/{{$i->id}}">
                                                                {{$i->patient_name}}
                                                            </a>
                                                        </td>
                                                        <td>{{$i->sid}}</td>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/hospital/edit/{{$i->hospital_id}}">
                                                                {{$i->hospital}}
                                                            </a>
                                                        </td>
                                                        <td>{{$i->department}}</td>
                                                        <td>{{$i->doctor}}</td>
                                                        <td>{{date('Y-m-d', strtotime($i->coverage_date))}}</td>
                                                        <td>{{$i->total_cost}}</td>
                                                        <td>{{$i->approved_cost}}</td>
                                                        <td>{{\App\Models\SystemUserModel::getUserFullName($i->create_user)}}</td>


                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="tab_1_10">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Service Provider</th>
                                                    <th>Type</th>
                                                    <th>Claim-No</th>
                                                    <th>Date</th>
                                                    <th>City</th>
                                                    <th>Created By</th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($accident as $i)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ config('app.cp_route_name') }}/accident/edit/{{$i->id}}"
                                                               target="_blank">{{$i->id}}</a></td>



                                                        <td>{{\App\Models\FinancePartyModel::getFianancePartyName($i->finance_party)}}</td>
                                                        <td>{{\App\Models\TypesModel::getTypeName($i->type)}}</td>
                                                        <td>{{$i->claim_no}}</td>
                                                        <td>{{date('Y-m-d', strtotime($i->accident_date))}}</td>

                                                        <td>{{\App\Models\CityModel::getCityName($i->city)}}</td>
                                                        <td>{{$i->employee_name}}</td>


                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>




                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


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
                        <span class="caption-subject bold uppercase font-yellow-haze">Annual Patient Treatment Cost</span>
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
                        <span class="caption-subject bold uppercase font-yellow-haze">Monthly Patient treatment</span>
                        <select id="year" class="form-control select2" name="year"
                                tabindex="-1" aria-hidden="true">
                            <option value="0">Select Year</option>
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
        <div class="clearfix"></div>
        <div class="col-md-6">
            <!-- BEGIN CHART PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-haze"></i>
                        <span class="caption-subject bold uppercase font-red-haze">Discharged By Hospital</span>

                    </div>
                    <div class="tools">


                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_3_2" class="chart"></div>
                </div>
            </div>
            <!-- END CHART PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN CHART PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-haze"></i>
                        <span class="caption-subject bold uppercase font-red-haze">Discharged By Department</span>

                    </div>
                    <div class="tools">


                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="chart_3_1" class="chart"></div>
                </div>
            </div>
            <!-- END CHART PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Patient</span>
                        <span class="caption-helper">Discharge By Medication Type</span>
                    </div>

                </div>
                <div class="portlet-body">

                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                            <tr class="uppercase">
                                <th> SN</th>
                                <th> Service Type</th>
                                <th> Number</th>
                                <th> Percentage %</th>
                                <th> Cost</th>
                                <th> Percentage %</th>

                            </tr>
                            </thead>
                            @php $i=0;
                            $user_id=\Auth::user("admin")->SysUsr_ID;
                            @endphp
                            @foreach(\App\Models\TypesModel::getAllTypes('serv_type') as $service_type)
                                @php $i++@endphp
                                <tr>
                                    <td class="fit">
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$service_type->type}}
                                    </td>
                                    <td> {{number_format(\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,$service_type->id,0,$patient->id))}} </td>


                                    <td class="bold theme-font ">

                                        @if(\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,0,0,$patient->id)>0)
                                            {{number_format(\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,$service_type->id,0,$patient->id)*100/\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,0,0,$patient->id),2)}}
                                            %
                                    </td>
                                    @endif

                                    <td>
                                        <span class="">{{number_format(\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,$service_type->id,1,$patient->id))}}</span>
                                    </td>
                                    <td>
                                        @if(\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,0,1,$patient->id)>0)
                                            <span class="bold theme-font">{{number_format(\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,$service_type->id,1,$patient->id)*100/\App\Models\InvoiceModel::getAnnualDischarged(0, $user_id,0,0,0,0,1,$patient->id),2)}}%</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Top Medication</span>

                    </div>

                </div>
                <div class="portlet-body">

                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                            <tr class="uppercase">
                                <th> SN</th>
                                <th> Medication</th>
                                <th> Cost$</th>
                                <th> Percentage %</th>


                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Acamol</td>
                                <td>200</td>
                                <td><strong>50</strong></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Omeprazol</td>
                                <td>200</td>
                                <td><strong>50</strong></td>
                            </tr>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="ajax" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-xl">

            <div class="modal-content">
                <div class="modal-body">
                    <img src="cp/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                    <span> &nbsp;&nbsp;Loading... </span>
                </div>
            </div>

        </div>
    </div>



@stop