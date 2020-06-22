<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ar" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <base href="{{ url("public") }}" />
        <meta charset="utf-8" />
        <title>Control Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="cp/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="cp/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="cp/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="cp/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="cp/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="cp/assets/global/css/components-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="cp/assets/global/css/plugins-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="cp/assets/pages/css/lock-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="">
        <div class="page-lock">
            <div class="page-logo">
                <a><img src="" alt=""/> </a><!-- logo-->
            </div>
            <div class="page-body">
                <div class="lock-head">Closed </div>
                <div class="lock-body">
                    <div class="pull-left lock-avatar-block">
                        <img src="{{ url("uploads/users/".$user->SysUsr_ThumbImage) }}" class="lock-avatar"> 
                    </div>

                    {!! Form::open(['action'=>'Admin\LoginController@check','class'=>'lock-form pull-left']) !!}
                        <h4>{{ ucfirst($user->SysUsr_FullName) }}</h4>
                        <div class="form-group">
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="كلمة المرور" name="SysUsr_Password" />
                            @if(isset($error))
                                <span class="help-block error">{{ $error }}</span>
                            @endif
                            <input type="hidden" name="SysUsr_UserName" value="{{ $user->SysUsr_UserName }}">
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn red uppercase">Log in</button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="lock-bottom">
                    <a href="{{ config('app.cp_route_name') }}/login"> {{ ucfirst($user->SysUsr_FullName) }}؟</a>
                </div>
            </div>
            <div class="page-footer-custom"> 2016 © Tawfiq. </div>
        </div>
        <!--[if lt IE 9]>
<script src="cp/global/plugins/respond.min.js"></script>
<script src="cp/global/plugins/excanvas.min.js"></script> 
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
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="cp/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="cp/assets/pages/scripts/lock.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>