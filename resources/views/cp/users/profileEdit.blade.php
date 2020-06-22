@extends('cp.layout.layout')

@section('css')
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-select/css/bootstrap-select-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/pages/css/profile-rtl.min.css" rel="stylesheet" type="text/css" />
@stop
@section('js')
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="cp/assets/global/scripts/app.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
    <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/date-custom.js" type="text/javascript"></script>
    @if($errors->has())
        <script>
            jQuery(document).ready(function () {
                toasterMessage('error', 'The Number of Errors: {{ sizeof($errors->all()) }}', 'Check Errors Below');
            });

        </script>
    @endif

    @if(isset($error))
        <script>
            jQuery(document).ready(function () {
                toasterMessage('error', '{{ $error }}', 'Check Errors Below');
                jQuery('#tabs-profile a').eq(1).tab('show');
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
    <div class="row">
        <div class="col-md-12">
            @include("cp.users.profilePart")

            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Personal information</span>
                                </div>
                                <ul id="tabs-profile" class="nav nav-tabs">
                                    <li class="{{app()->request->pass?'':'active'}}">
                                        <a href="#tab_1_1" data-toggle="tab">Information</a>
                                    </li>
                                    <li class="{{app()->request->pass?'active':''}}">
                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane {{app()->request->pass?'':'active'}} " id="tab_1_1">
                                        {!! Form::model($result,['action'=>["Admin\UsersController@updateProfile",$result->SysUsr_ID],'class'=>'form-validation form-datavalidation user-form', 'files' => true]) !!}
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_firstName')) has-error @endif">
                                                <span class="lblinput">First Name</span>
                                                {!! Form::text('SysUsr_firstName',null,['class'=>'form-control txtnotnumber txtinput-required']) !!}
                                                @if ($errors->has('SysUsr_firstName'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_firstName') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_lastName')) has-error @endif">
                                                <span class="lblinput">last name</span>
                                                {!! Form::text('SysUsr_lastName',null,['class'=>'form-control txtnotnumber txtinput-required']) !!}
                                                @if ($errors->has('SysUsr_lastName'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_lastName') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_UserName')) has-error @endif">
                                                <span class="lblinput">User Name</span>
                                                {!! Form::text('SysUsr_UserName',null,['class'=>'form-control txtinput-required','readonly'=>'','data-validation'=>'cp-brand-buzz/user/validateInput/'.$result->SysUsr_ID]) !!}
                                                @if ($errors->has('SysUsr_UserName'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_UserName') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_DoB')) has-error @endif">
                                                <span class="lblinput">Birth Date</span>
                                                <div class="input-group">
                                                    {!! Form::text('SysUsr_DoB',null,['class'=>'form-control  datepicker-maxtoday','readonly'=>'','data-date-format'=>'yyyy-mm-dd']) !!}
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                @if ($errors->has('SysUsr_DoB'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_DoB') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_Email')) has-error @endif">
                                                <span class="lblinput">Email</span>
                                                {!! Form::text('SysUsr_Email',null,['class'=>'form-control txtinput-required txtinput-email','data-validation'=>'cp-brand-buzz/user/validateInput/'.$result->SysUsr_ID]) !!}
                                                @if ($errors->has('SysUsr_Email'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_Email') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_Mobile')) has-error @endif">
                                                <span class="lblinput">Mobile</span>
                                                {!! Form::text('SysUsr_Mobile',null,['class'=>'form-control txtinput-required txtinput-filter-number txtinput-minlength','data-minlength'=>'6','maxlength'=>'15']) !!}
                                                @if ($errors->has('SysUsr_Mobile'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_Mobile') }}</span>
                                                @endif
                                            </div>

                                            <div class="margiv-top-10">
                                                <button type="submit" class="btn green"> Save </button>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>

                                    <div class="tab-pane {{app()->request->pass?'active':''}}" id="tab_1_3">
                                        {!! Form::model($result,['action'=>["Admin\UsersController@updatePasswordProfile",$result->SysUsr_ID],'class'=>'form-validation']) !!}
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Old Password</span>
                                                <input name="oldPassword" type="password" class="form-control txtinput-required" placeholder="" />
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Password</span>
                                                <input type="password" id="password_strength" name="password" class="form-control txtinput-required txtinput-minlength password-status myinput-password" data-minlength="6" placeholder="Password" />
                                            </div>
                                            <div class="form-group input-wlbl">
                                                <span class="lblinput">Retype Password</span>
                                                <input name="confirm_password" type="password" class="form-control txtinput-related" data-related="password" placeholder="Confirm Password" />
                                            </div>
                                            <div class="margin-top-10">
                                                <button type="submit" class="btn green"> Cahnge Password</button>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop