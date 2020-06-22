@php
    use Carbon\Carbon;
    use App\Models\AdmissionModel;
@endphp


@extends('cp.layout.layout')

@section('css')
    <style>

        #chart_1 {
            width: 100%;
            height: 500px;
        }

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
    <link href="cp/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="cp/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="cp/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="cp/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css"/>
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
    <script src="cp/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="cp/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="cp/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="cp/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>








@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">

                        <span class="caption-subject bold uppercase">Dashboard</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        @if(in_array($role,array_merge ($admin,$coordinator,$fp )) )
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="crm/event">
                                    <div class="visual">
                                        <i class="fa fa-ambulance"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$newEvent}}">0</span>
                                        </div>
                                        <div class="desc"> New Events</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if(in_array($role,array_merge ($admin,$coordinator,$fp )) )
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="crm/invoice">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$processingInvoice}}">0</span>
                                        </div>
                                        <div class="desc"> Processing Invoices</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if(in_array($role,array_merge ($admin,$coordinator )) )
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 yellow" href="crm/appointment">
                                    <div class="visual">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$newAppointment}}">0</span>
                                        </div>
                                        <div class="desc"> Processing Appointment</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if(in_array($role,array_merge ($admin,$coordinator )) )
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 purple" href="crm/appointment">
                                    <div class="visual">
                                        <i class="fa fa-hand-o-up"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$newlead}}">0</span></div>
                                        <div class="desc"> Processing Leads</div>
                                    </div>
                                </a>
                            </div>

                        @endif

                    </div>
                    <div class="clearfix">
                        <hr>
                    </div>
                    <div class="row">
                        @if(in_array($role,array_merge ($admin,$coordinator,$fp )))
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 purple" href="crm/admission">
                                    <div class="visual">
                                        <i class="fa fa-male"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$dischargeAdmisison}}"></span>
                                        </div>
                                        <div class="desc"> Discharges</div>
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
                                            <span data-counter="counterup" data-value="{{$newAdmisison}}">0</span>
                                        </div>
                                        <div class="desc"> New Admissions</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 black" href="crm/request_to_call">
                                    <div class="visual">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$request_to_call}}">0</span>
                                        </div>
                                        <div class="desc">Requests to Call</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 yellow-mint" href="crm/event/viewR">
                                    <div class="visual">
                                        <i class="fa fa-external-link"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$ReferralNotSent}}">0</span>
                                        </div>
                                        <div class="desc">Referral not send</div>
                                    </div>
                                </a>
                            </div>

                        @endif
                    </div>
                    <div class="clearfix">
                        <hr>
                    </div>
                    <div class="row">
                        @if(in_array($role,array_merge ($admin,$coordinator,$fp )))
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="crm/lead">
                                    <div class="visual">
                                        <i class="fa fa-hand-o-up"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$leadsCRM}}"></span>
                                        </div>
                                        <div class="desc"> Leads CRM</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="crm/lead">
                                    <div class="visual">
                                        <i class="fa fa-hand-o-up"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$leadsMedi}}"></span>
                                        </div>
                                        <div class="desc"> Leads Medibooking</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 yellow" href="crm/lead">
                                    <div class="visual">
                                        <i class="fa fa-hand-o-up"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$leadsTf}}"></span>
                                        </div>
                                        <div class="desc"> Leads Tabibfind</div>
                                    </div>
                                </a>
                            </div>




                        @endif
                    </div>
                    @if(in_array($role,array_merge ($admin,$coordinator )))
                        <div class="clearfix">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bubble font-dark hide"></i>
                                            <span class="caption-subject font-hide bold uppercase">Coordinators</span>
                                        </div>

                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">

                                            @foreach($coordinators as $c)
                                                @if($c->user_id==$user_id || $role=="1")
                                                    <div class="col-md-4">
                                                        <!--begin: widget 1-1 -->
                                                        <div class="mt-widget-1">

                                                            <div class="mt-img">
                                                                @if($c->gender=="1")
                                                                    <img src="{{isset(\App\Models\SystemUserModel::find($c->user_id)->SysUsr_ThumbImage)?"uploads/users/".\App\Models\SystemUserModel::find($c->user_id)->SysUsr_ThumbImage:"cp/images/avatar-img.jpg"}}" class="img-avatr">
                                                            </div>
                                                            @else
                                                                <img src="{{isset(\App\Models\SystemUserModel::find($c->user_id)->SysUsr_ThumbImage)?"uploads/users/".\App\Models\SystemUserModel::find($c->user_id)->SysUsr_ThumbImage:"cp/images/avatar-img-female.png"}}" class="img-avatr">
                                                        </div>
                                                        @endif

                                                        <div class="mt-body">
                                                            <h3 class="mt-username">{{$c->name}}</h3>
                                                            <div class="mt-stats">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="crm/event" class="btn font-red">
                                                                        <i class="fa fa-ambulance"></i>{{\App\Models\EventModel::countEventByCoordinator($c->id)}}
                                                                    </a>
                                                                    <a href="crm/admission" class="btn font-green">
                                                                        <i class="fa fa-space-shuttle"></i> {{\App\Models\AdmissionModel::countAdmissioByCoordinator($c->id)}}
                                                                    </a>
                                                                    <a href="crm/appointment" class="btn font-yellow">
                                                                        <i class="fa fa-calendar"></i> {{\App\Models\AppointmentModel::countByCoordinator($c->id)}}
                                                                    </a>
                                                                    <a href="crm/lead" class="btn font-blue">
                                                                        <i class="fa fa-hand-o-up"></i> {{\App\Models\LeadModel::countByCoordinator($c->id)}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endif
                                            <!--end: widget 1-1 -->
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->

                <div class="row">

                    @if(in_array($role,array_merge ($admin,$coordinator )) )
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Admission</span>
                                    </div>
                                    <div class="actions hidden">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce"
                                                     data-percent="{{$waitingAdmissionPercentage}}">
                                                    <span>{{$waitingAdmissionPercentage}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> Waiting Visit
                                                    ({{\App\Models\AdmissionModel::countAdmission(4)-\App\Models\AdmissionModel::countAdmission(5)}}
                                                    )

                                                </a>
                                            </div>
                                        </div>


                                        <div class="margin-bottom-10 visible-sm"></div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce"
                                                     data-percent="{{$dischargeAdmissionPercentage}}">
                                                    <span>{{$dischargeAdmissionPercentage}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> Discharge
                                                    ({{\App\Models\AdmissionModel::countAdmission(14)}})

                                                </a>
                                            </div>
                                        </div>

                                        <div class="margin-bottom-10 visible-sm"></div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce"
                                                     data-percent="{{$visitedAdmissionPercentage}}">
                                                    <span>{{$visitedAdmissionPercentage}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> Visited Admissions
                                                    ({{\App\Models\AdmissionModel::countAdmission(5)}})

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(in_array($role,array_merge ($admin,$coordinator,$fp )) )
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Admission By Hospitals </span>
                                    </div>
                                    <div class="actions hidden">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        @php $percentage=0;
                                        $count = 0;
                                        @endphp
                                        @foreach($hospitalAdmission as $h)
                                            <div class="col-md-4">
                                                <div class="easy-pie-chart">
                                                    <div class="number transactions"
                                                         data-percent="{{(\App\Models\AdmissionModel::countAdmissionHospital(0, $user_id) == 0) ? 0 : number_format(\App\Models\AdmissionModel::countAdmissionHospital($h->id, $user_id) * 100 / \App\Models\AdmissionModel::countAdmissionHospital(0, $user_id), 0)}}">
                                                        <span>{{(\App\Models\AdmissionModel::countAdmissionHospital(0, $user_id) == 0) ? 0 : number_format(\App\Models\AdmissionModel::countAdmissionHospital($h->id, $user_id) * 100 / \App\Models\AdmissionModel::countAdmissionHospital(0, $user_id), 0)}}</span>%
                                                    </div>
                                                    <a class="title"
                                                       href="crm/admission"> {{\App\Models\RecipeModel::getHospitalName($h->id)}}
                                                        ({{\App\Models\AdmissionModel::countAdmissionHospital($h->id,$user_id)}}
                                                        )

                                                    </a>
                                                </div>
                                            </div>
                                            @php
                                                $percentage+=(\App\Models\AdmissionModel::countAdmissionHospital(0, $user_id) == 0) ? 0 : number_format(\App\Models\AdmissionModel::countAdmissionHospital($h->id, $user_id) * 100 / \App\Models\AdmissionModel::countAdmissionHospital(0, $user_id), 0);
                                                $count+=\App\Models\AdmissionModel::countAdmissionHospital($h->id,$user_id);
                                            @endphp
                                            <div class="margin-bottom-10 visible-sm"></div>
                                        @endforeach


                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{100-$percentage}}">
                                                    <span>{{(100-$percentage>0)?100-$percentage:0}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission">
                                                    Others({{\App\Models\AdmissionModel::countAdmissionHospital(0,$user_id)-$count}}
                                                    )

                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(in_array($role,$admin) )
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-cursor font-dark hide"></i>
                                            <span class="caption-subject font-dark bold uppercase">Admission By Financial Party</span>
                                        </div>
                                        <div class="actions hidden">
                                            <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                                <i class="fa fa-repeat"></i> Reload </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            @php $percentage=0;
                                        $count = 0;
                                            @endphp
                                            @foreach($FPAdmission as $h)
                                                <div class="col-md-4">
                                                    <div class="easy-pie-chart">
                                                        <div class="number transactions"
                                                             data-percent="{{(\App\Models\AdmissionModel::countAdmissionFP(0, $user_id) == 0) ? 0 : number_format(\App\Models\AdmissionModel::countAdmissionFP($h->id, $user_id) * 100 / \App\Models\AdmissionModel::countAdmissionFP(0, $user_id), 0)}}">
                                                            <span>{{(\App\Models\AdmissionModel::countAdmissionFP(0, $user_id) == 0) ? 0 : number_format(\App\Models\AdmissionModel::countAdmissionFP($h->id, $user_id) * 100 / \App\Models\AdmissionModel::countAdmissionFP(0, $user_id), 0)}}</span>%
                                                        </div>
                                                        <a class="title"
                                                           href="crm/admission"> {{\App\Models\FinancePartyModel::getFianancePartyName($h->id)}}
                                                            ({{\App\Models\AdmissionModel::countAdmissionFP($h->id,$user_id)}}
                                                            )

                                                        </a>
                                                    </div>
                                                </div>
                                                @php
                                                    $percentage+=(\App\Models\AdmissionModel::countAdmissionFP(0, $user_id) == 0) ? 0 : number_format(\App\Models\AdmissionModel::countAdmissionFP($h->id, $user_id) * 100 / \App\Models\AdmissionModel::countAdmissionFP(0, $user_id), 0);
                                                    $count+=\App\Models\AdmissionModel::countAdmissionFP($h->id,$user_id);
                                                @endphp
                                                <div class="margin-bottom-10 visible-sm"></div>
                                            @endforeach


                                            <div class="col-md-4">
                                                <div class="easy-pie-chart">
                                                    <div class="number transactions" data-percent="{{100-$percentage}}">
                                                        <span>{{(100-$percentage>0)?100-$percentage:0}}</span>%
                                                    </div>
                                                    <a class="title" href="crm/admission">
                                                        Others({{\App\Models\AdmissionModel::countAdmissionHospital(0,$user_id)-$count}}
                                                        )

                                                    </a>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>



                    @endif
                    @if(in_array($role,array_merge ($admin,$coordinator )) )
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Admission By Date </span>
                                    </div>
                                    <div class="actions hidden">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$day3}}">
                                                    <span>{{$day3}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> 3 Day
                                                    ({{\App\Models\AdmissionModel::countAdmissionDays(3)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"></div>


                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$day7}}">
                                                    <span>{{$day7}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> 4-7 Days
                                                    ({{\App\Models\AdmissionModel::countAdmissionDays(7)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"></div>

                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$day14}}">
                                                    <span>{{$day14}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> 7-14 Days
                                                    ({{\App\Models\AdmissionModel::countAdmissionDays(14)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"></div>

                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$day14}}">
                                                    <span>{{$day30}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission">14-30 Days
                                                    ({{\App\Models\AdmissionModel::countAdmissionDays(30)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$day60}}">
                                                    <span>{{$day60}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission">30-60 Days
                                                    ({{\App\Models\AdmissionModel::countAdmissionDays(60)}})

                                                </a>
                                            </div>
                                        </div>

                                        <div class="margin-bottom-10 visible-sm"></div>


                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$otherDay}}">
                                                    <span>{{$otherDay}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> More Than 60 Days
                                                    ({{\App\Models\AdmissionModel::countAdmissionDays(0)}})

                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(in_array($role,array_merge ($admin,$coordinator )) )
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Admission By Service Type </span>
                                    </div>
                                    <div class="actions hidden">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$perDay}}">
                                                    <span>{{$perDay}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> Admission per Day
                                                    ({{\App\Models\AdmissionModel::countAdmissionServiceType(30)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"></div>


                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$drg}}">
                                                    <span>{{$drg}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> Admission per DRG
                                                    ({{\App\Models\AdmissionModel::countAdmissionServiceType(32)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$rehabilitation}}">
                                                    <span>{{$rehabilitation}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission"> Admission per Rehabilitation
                                                    ({{\App\Models\AdmissionModel::countAdmissionServiceType(31)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"></div>

                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="{{$otherServ}}">
                                                    <span>{{$otherServ}}</span>%
                                                </div>
                                                <a class="title" href="crm/admission">Other
                                                    ({{\App\Models\AdmissionModel::countAdmissionServiceType()-(AdmissionModel::countAdmissionServiceType(30)+AdmissionModel::countAdmissionServiceType(31)+AdmissionModel::countAdmissionServiceType(32))}}
                                                    )

                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if(in_array($role,$admin) )
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Invoices </span>
                                    </div>
                                    <div class="actions hidden">
                                        <a href="javascript:;"
                                           class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number visits"
                                                     data-percent="{{$processingInvoicePercentage}}">
                                                    <span>{{$processingInvoicePercentage}}</span>%
                                                </div>
                                                <a class="title" href="crm/invoice"> Process
                                                    ({{\App\Models\InvoiceModel::countInvoice(15)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"></div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number visits"
                                                     data-percent="{{$auditInvoicePercentage}}">
                                                    <span>{{$auditInvoicePercentage}}</span>%
                                                </div>
                                                <a class="title" href="crm/invoice"> Audit
                                                    ({{\App\Models\InvoiceModel::countInvoice(18)}})

                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"></div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce"
                                                     data-percent="{{$reviseInvoicePercentage}}">
                                                    <span>{{$reviseInvoicePercentage}}</span>%
                                                </div>
                                                <a class="title" href="crm/invoice">Revise
                                                    ({{\App\Models\InvoiceModel::countInvoice(19)}})

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
                <div class="clearfix">
                    <hr>
                </div>
                @if(in_array($role,array_merge ($admin,$coordinator )) )
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light calendar bordered">
                                <div class="portlet-title ">
                                    <div class="caption">
                                        <i class="icon-calendar font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Appointments</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                    <div class="clearfix">
                        <hr>
                    </div>
                @endif
                @if(in_array($role,array_merge ($admin,$coordinator )) )
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Recent Admission</span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height: 300px;" data-always-visible="1"
                                         data-rail-visible="0">
                                        <ul class="feeds">
                                            @foreach($AdmissionProcess as $a)
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-check"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"><span
                                                                            class="label label-sm label-success ">{{\App\Models\SystemUserModel::getUserFullName($a->action_emp)}}
                                                            :</span> {{\App\Models\AdmissionActionModel::getActionDesc($a->action_id)}}
                                                                    <a href="crm/admission/edit/{{$a->admission_id}}"> <span
                                                                                class="label label-sm label-warning "> Admission ID: {{$a->admission_id}}
                                                                <i class="fa fa-mouse-pointer"></i>
                                                        </span> </a>
                                                                    for {{\App\Models\AdmissionModel::getAdmissionPatient($a->admission_id)}}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">@php
                                                            $created = new Carbon($a->create_date);
                                                            $now = Carbon::now();
                                                            $difference = ($created->diff($now)->days < 1)
                                                            ? 'today'
                                                            : $created->diffForHumans($now);@endphp
                                                        <div class="date">{{$difference}}</div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix">
                        <hr>
                    </div>
                @endif


            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    </div>



@stop