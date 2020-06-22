
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
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="info-datarow">
                                            <div class="info-datacell">
                                                <span>First Name</span>
                                                <p>{{ ucfirst($user->firstName) }}</p>
                                            </div>
                                            <div class="info-datacell">
                                                <span>Last name</span>
                                                <p>{{ ucfirst($user->lastName) }}</p>
                                            </div>
                                        </div>
                                        <div class="info-datarow">
                                            <div class="info-datacell">
                                                <span>User Name</span>
                                                <p>{{ $user->SysUsr_UserName }}</p>
                                            </div>
                                            <div class="info-datacell">
                                                <span>Date of Birth</span>
                                                <p>{{ $user->SysUsr_DoB }}</p>
                                            </div>
                                        </div>
                                        <div class="info-datarow">
                                            <div class="info-datacell">
                                                <span>Email</span>
                                                <p>{{ $user->SysUsr_Email }}</p>
                                            </div>
                                            <div class="info-datacell">
                                                <span>Mobile</span>
                                                <p>{{ $user->SysUsr_Mobile }}</p>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="info-datarow">
                                            <div class="info-datacell">
                                                <span>Last Login</span>
                                                <p>{{ $lastLogin }}</p>
                                            </div>
                                            <div class="info-datacell">
                                                <span>IP</span>
                                                <p>{{ $lastIP }}</p>
                                            </div>
                                        </div>
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