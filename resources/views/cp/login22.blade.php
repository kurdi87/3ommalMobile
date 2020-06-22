<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <base href="{{ URL::asset('/') }}"></base>
    <meta charset="utf-8"/>
    <title>Login to Control Panel | TabibFind Solutions</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="cp/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="cp/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="cp/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="cp/assets/pages/css/login.min.css" rel="stylesheet" type="text/css"/>
    <link href="cp/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="cp/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="cp/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="cp/favicon.ico"/>
</head>
<!-- END HEAD -->

<body class=" login">
<div class="menu-toggler sidebar-toggler"></div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
    <a>
        <img src="cp/images/login-logo.png" alt=""/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    {!! Form::open(['action'=>'Admin\LoginController@check','class'=>'login-form']) !!}
    <h3 class="form-title font-green">Login to CRM</h3>

    <div class="alert alert-danger {{ (isset($error))?"":"display-hide" }}">
        <button class="close" data-close="alert"></button>
        <span> {{ $error or "Enter any username and password. " }}</span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        {!! Form::text('SysUsr_UserName',null,['dir'=>'ltr','class'=>'form-control form-control-solid placeholder-no-fix','autocomplete'=>'off','placeholder'=>'User Name']) !!}
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        {!! Form::password('SysUsr_Password',['dir'=>'ltr','class'=>'form-control form-control-solid placeholder-no-fix','autocomplete'=>'off','placeholder'=>'Password']) !!}
    </div>
    <div class="form-actions">
    </div>
    <div class="create-account">
        <p>
            <button type="submit" class="btn green uppercase">Login</button>
        </p>
    </div>
    {!! Form::close() !!}
            <!-- END LOGIN FORM -->
</div>
<div class="copyright"> Optimum Solutions CRM © 2018</div>
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="cp/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="cp/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="cp/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="cp/assets/pages/scripts/login.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>