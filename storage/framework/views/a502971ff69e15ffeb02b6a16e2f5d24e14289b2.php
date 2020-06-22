<?php 
    use Carbon\Carbon;
 ?>




<?php $__env->startSection('css'); ?>
    <style>
        .fc-day-grid-event:hover {

            display: inherit !important;
            background-color: green;
            z-index: 1000;

        }
    </style>
    <base href="<?php echo e(URL::asset('/')); ?>"></base>
    <meta charset="utf-8"/>
    <title><?php echo e(isset($title) ? $title : "Shaheya | Control Panel"); ?></title>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" media="all" type="text/css"/>

    <link href="cp/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" media="all" type="text/css"/>

    <link href="cp/assets/global/plugins/nouislider/nouislider.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/nouislider/nouislider.pips.css" rel="stylesheet" type="text/css" /
    <link href="cp/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/css/components-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="cp/assets/global/css/plugins-rtl.min.css" rel="stylesheet" type="text/css" />


    <link href="cp/css/flaticon.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/flaticon.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/font-awesome.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/font-awesome.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
    <script src="cp/js/main.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="cp/assets/pages/scripts/dashboard.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="cp/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="cp/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="cp/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="cp/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('#clickmewow').click(function () {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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






                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>