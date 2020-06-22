<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <base href="<?php echo e(URL::asset('/')); ?>"></base>
    <meta charset="utf-8"/>
    <title><?php echo e(isset($title) ? $title : "HiTechJobs | Control Panel"); ?></title>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" media="all" type="text/css"/>

    <link href="cp/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all" type="text/css"/>
     <link href="cp/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" media="all" type="text/css"/>

    <link href="cp/assets/global/plugins/nouislider/nouislider.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/nouislider/nouislider.pips.css" rel="stylesheet" type="text/css" /
    <link href="cp/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />


    <link href="cp/css/flaticon.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/flaticon.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/font-awesome.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/font-awesome.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo $__env->yieldContent('css'); ?>

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="cp/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" media="all" type="text/css"/>
    <link href="cp/assets/global/css/plugins.min.css" rel="stylesheet" media="all" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="cp/assets/layouts/layout/css/layout.min.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="cp/assets/layouts/layout/css/themes/grey.min.css" rel="stylesheet" type="text/css" id="style_color"/>
    <!-- <link href="cp/assets/layouts/layout/css/custom.min.css" rel="stylesheet" media="all" type="text/css"/> -->
    <link href="cp/css/custom.css" rel="stylesheet" media="all" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="cp/favicon.png"/>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-container-bg-solid">
<?php echo $__env->make('cp.layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="clearfix"></div>
<div class="page-container">
    <?php echo $__env->make('cp.layout.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <?php echo $__env->make('cp.layout.theme', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(isset($breadcrumbs)): ?>
                <?php echo $__env->make('cp.layout.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if(isset($title)): ?>
                <h3 class="page-title"><?php echo e($title); ?>

                    <?php if(isset($subtitle)): ?>
                        <small><?php echo e($subtitle); ?></small>
                    <?php endif; ?>
                </h3>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('cp.layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!--[if lt IE 9]>
<script src="cp/global/plugins/respond.min.js"></script>
<script src="cp/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="cp/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="cp/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="cp/js/plugins/tooltipster/jquery.tooltipster.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="cp/assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
<script src="cp/assets/global/scripts/app.js" type="text/javascript"></script>
<script src="cp/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="cp/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="cp/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="cp/js/plugins/jquery.mobile.custom.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

<script src="cp/assets/pages/scripts/ui-confirmations.min.js" type="text/javascript"></script>
<script src="cp/js/select2.full.min.js" type="text/javascript"></script>
<script src="cp/js/components-select2.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/nouislider/wNumb.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/nouislider/nouislider.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="cp/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="cp/assets/pages/scripts/components-nouisliders.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="cp/assets/global/scripts/app.min.js" type="text/javascript"></script>




<!-- END CORE PLUGINS -->
<?php echo $__env->yieldContent('js'); ?>

<script src="cp/js/main.js" type="text/javascript"></script>
<script src="cp/js/my_js.js" type="text/javascript"></script>



<?php echo $__env->yieldContent('custom-js'); ?>



</body>

</html>