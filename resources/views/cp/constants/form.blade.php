@extends('cp.layout.layout')

@section('css')<!--
	<link href="cp/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />-->
@stop

@section('js')
    <!--
	<script src="cp/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/fuelux/js/spinner.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>-->
    <script src="cp/js/settings.js" type="text/javascript"></script>
    <script src="cp/js/checkbox_log.js" type="text/javascript"></script>
    <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/ConstantForm.js" type="text/javascript"></script>
    @if(isset($success))
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '{{ $success }}', 'Success');
            });

        </script>
    @endif
@stop

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="settings-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase settings-ptitle">Constants</span>
                                </div>
                                <ul id="tabs-settings" class="nav nav-tabs">
                                    <li class="active" role="tab">
                                        <a href="#tab_1_1" data-toggle="tab">General Constants</a>
                                    </li>
                                    <li role="tab">
                                        <a href="#tab_1_2" data-toggle="tab">Social Network</a>
                                    </li>
                                    <li role="tab">
                                        <a href="#tab_1_3" data-toggle="tab">About us</a>
                                    </li>

                                    <li role="tab">
                                        <a href="#tab_1_5" data-toggle="tab">Advanteges</a>
                                    </li>
                                    <li role="tab">
                                        <a href="#tab_1_6" data-toggle="tab">History</a>
                                    </li>

                                    <li role="tab">
                                        <a href="#tab_1_4" data-toggle="tab">Map</a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="portlet-body">
                                 {!! Form::model($result,['action'=>['Admin\ConstantsController@update',$result->id],'class'=>'form-validation form-datavalidation']) !!}
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">

                                            <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('address')) has-error @endif">
                                                <span class="lblinput">Address</span>
                                                 {!! Form::text('address',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('address'))
                                                    <span class="help-block error">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                          <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('telephone1')) has-error @endif">
                                                <span class="lblinput">Telephone1</span>
                                                 {!! Form::text('telephone1',null,['class'=>'form-control  txtinput-required']) !!}
                                                @if ($errors->has('telephone1'))
                                                    <span class="help-block error">{{ $errors->first('telephone1') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('telephone2')) has-error @endif">
                                                <span class="lblinput">Telephone2</span>
                                                 {!! Form::text('telephone2',null,['class'=>'form-control  txtinput-required']) !!}
                                                @if ($errors->has('telephone2'))
                                                    <span class="help-block error">{{ $errors->first('telephone2') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                             <div class="form-group input-wlbl  @if ($errors->has('email1')) has-error @endif">
                                                <span class="lblinput">Email1</span>
                                                 {!! Form::text('email1',null,['class'=>'form-control  txtinput-required txtinput-email']) !!}
                                                @if ($errors->has('email1'))
                                                    <span class="help-block error">{{ $errors->first('email1') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                         <div class="col-md-6">
                                             <div class="form-group input-wlbl  @if ($errors->has('email2')) has-error @endif">
                                                <span class="lblinput">Email2</span>
                                                 {!! Form::text('email2',null,['class'=>'form-control  txtinput-required txtinput-email']) !!}
                                                @if ($errors->has('email2'))
                                                    <span class="help-block error">{{ $errors->first('email2') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                            <div class="col-md-6">
                                             <div class="form-group input-wlbl  @if ($errors->has('fax2')) has-error @endif">
                                                <span class="lblinput">Fax1</span>
                                                 {!! Form::text('fax2',null,['class'=>'form-control  txtinput-required']) !!}
                                                @if ($errors->has('fax2'))
                                                    <span class="help-block error">{{ $errors->first('fax2') }}</span>
                                                @endif
                                            </div>
                                        </div>

                            
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('DeviderStatment')) has-error @endif">
                                                        <span class="lblinput">Devider Statement</span>
                                                        {!! Form::textarea('DeviderStatment',null,['class'=>'textarea form-control  txtinput-required ']) !!}
                                                        @if ($errors->has('DeviderStatment'))
                                                            <span class="help-block error">{{ $errors->first('DeviderStatment') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('ExperienceDoctorStatment')) has-error @endif">
                                                        <span class="lblinput">Experience Doctor Statement</span>
                                                        {!! Form::textarea('ExperienceDoctorStatment',null,['class'=>'textarea form-control  txtinput-required ']) !!}
                                                        @if ($errors->has('ExperienceDoctorStatment'))
                                                            <span class="help-block error">{{ $errors->first('ExperienceDoctorStatment') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('howworkStatement1')) has-error @endif">
                                                        <span class="lblinput">How does it  work statement 1</span>
                                                        {!! Form::textarea('howworkStatement1',null,['class'=>'textarea form-control  txtinput-required ']) !!}
                                                        @if ($errors->has('howworkStatement1'))
                                                            <span class="help-block error">{{ $errors->first('howworkStatement1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('howworkStatement2')) has-error @endif">
                                                        <span class="lblinput">How does it  work statement 2</span>
                                                        {!! Form::textarea('howworkStatement1',null,['class'=>'textarea form-control  txtinput-required ']) !!}
                                                        @if ($errors->has('howworkStatement1'))
                                                            <span class="help-block error">{{ $errors->first('howworkStatement1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('howworkStatement3')) has-error @endif">
                                                        <span class="lblinput">How does it  work statement 3</span>
                                                        {!! Form::textarea('howworkStatement3',null,['class'=>'textarea form-control  txtinput-required ']) !!}
                                                        @if ($errors->has('howworkStatement3'))
                                                            <span class="help-block error">{{ $errors->first('howworkStatement3') }}</span>
                                                        @endif
                                                    </div>
                                                </div>






                                            </div>
                                             
                                            </div>

                                            
                                        <div class="tab-pane" id="tab_1_2">
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Facebook</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-facebook"></i>
                                                    </span>
                                                    
                                                   {!! Form::text('facebook',null,['class'=>'form-control  txtinput-required']) !!}
                                                </div>
                                            </div><!-- form group -->
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Twitter</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-twitter"></i>
                                                    </span>
                                                 
                                                    {!! Form::text('twitter',null,['class'=>'form-control  txtinput-required']) !!}
                                                </div>
                                            </div><!-- form group -->
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Youtube</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-google"></i>
                                                    </span>
                                                 
                                                    {!! Form::text('googleplus',null,['class'=>'form-control  txtinput-required']) !!}
                                                    
                                                </div>
                                            </div><!-- form group -->
                                            <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Instagram</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-instagram"></i>
                                                    </span>
                                                  
                                                    {!! Form::text('instagram',null,['class'=>'form-control  txtinput-required']) !!}
                                                </div>
                                            </div>
                                             <div class="form-group input-wlbl">
                                                <!-- <span class="lblinput">Instagram</span> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-linkedin"></i>
                                                    </span>
                                                   
                                                    {!! Form::text('linkedin',null,['class'=>'form-control  txtinput-required']) !!}
                                                </div>
                                            </div>

                                            <!-- form group -->
                                           
                                        </div><!-- tab_1_2 -->
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_3">
                                           
                                            <div class="row">
                                        <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('about_us')) has-error @endif">
                                                        <span class="lblinput">ماذا عن طبيب فايند</span>
                                                        {!! Form::textarea('about_us',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('about_us'))
                                                            <span class="help-block error">{{ $errors->first('about_us') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group input-wlbl  @if ($errors->has('ceo_sign')) has-error @endif">
                                                        <span class="lblinput">CEO Sign</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img"  imagetype="2" style="{{ isset($result->ceo_sign)?"background-image:url(img/constant/".$result->ceo_sign.")":"background-image:url(img/hospital/1.jpg"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('ceo_sign','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="2" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div></div>

                                                <div class="col-md-6">
                                                    <div class="form-group input-wlbl  @if ($errors->has('ceo_image')) has-error @endif">
                                                        <span class="lblinput">CEO Image</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img" imagetype="1" style="{{ isset($result->ceo_image)?"background-image:url(img/constant/".$result->ceo_image.")":"background-image:url(img/hospital/1.jpg"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('ceo_image','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="1" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div></div>

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('mission')) has-error @endif">
                                                        <span class="lblinput">Mission</span>
                                                        {!! Form::textarea('mission',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('mission'))
                                                            <span class="help-block error">{{ $errors->first('mission') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('vision')) has-error @endif">
                                                        <span class="lblinput">Vision</span>
                                                        {!! Form::textarea('vision',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('vision'))
                                                            <span class="help-block error">{{ $errors->first('vision') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('values')) has-error @endif">
                                                        <span class="lblinput">Values</span>
                                                        {!! Form::textarea('values',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('values'))
                                                            <span class="help-block error">{{ $errors->first('values') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('ourcompany')) has-error @endif">
                                                        <span class="lblinput">Our Company</span>
                                                        {!! Form::textarea('ourcompany',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('ourcompany'))
                                                            <span class="help-block error">{{ $errors->first('ourcompany') }}</span>
                                                        @endif
                                                    </div>
                                                </div>






                                            </div>

                                        </div>
                                        <div class="tab-pane" id="tab_1_4">
                                            <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('maplink')) has-error @endif">
                                                <span class="lblinput">Map Link</span>

                                                 {!! Form::textarea('maplink',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('maplink'))
                                                    <span class="help-block error">{{ $errors->first('maplink') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                        <div class="tab-pane" id="tab_1_5">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advantage1')) has-error @endif">
                                                        <span class="lblinput">Advateges1</span>
                                                        {!! Form::textarea('advantage1',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('advantage1'))
                                                            <span class="help-block error">{{ $errors->first('advantage1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('advicon1')) has-error @endif">
                                                    <span class="lblinput">adv1 image</span>
                                                    <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                    <div class="profile-userpic">
                                                        <div class="upload-constant-img"  imagetype="3" style="{{ isset($result->advicon1)?"background-image:url(img/constant/".$result->advicon1.")":"recipe"}}">
                                                            <span class="glyphicon glyphicon-cloud-upload"></span>
                                                            {!! Form::text('advicon1','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                            <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="3" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                        </div>

                                                    </div>
                                                </div>
                                                </div>

                                                

                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advantage2')) has-error @endif">
                                                        <span class="lblinput">Advateges2</span>
                                                        {!! Form::textarea('advantage2',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('advantage2'))
                                                            <span class="help-block error">{{ $errors->first('advantage2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('advicon2')) has-error @endif">
                                                    <span class="lblinput">adv2 image</span>
                                                    <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                    <div class="profile-userpic">
                                                        <div class="upload-constant-img"  imagetype="4" style="{{ isset($result->advicon2)?"background-image:url(img/constant/".$result->advicon2.")":"background-image:url(img/hospital/1.jpg"}}">
                                                            <span class="glyphicon glyphicon-cloud-upload"></span>
                                                            {!! Form::text('advicon2','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                            <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="4" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advantage3')) has-error @endif">
                                                        <span class="lblinput">Advateges3</span>
                                                        {!! Form::textarea('advantage3',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('advantage3'))
                                                            <span class="help-block error">{{ $errors->first('advantage3') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('advicon3')) has-error @endif">
                                                    <span class="lblinput">adv3 image</span>
                                                    <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                    <div class="profile-userpic">
                                                        <div class="upload-constant-img"  imagetype="5" style="{{ isset($result->advicon3)?"background-image:url(img/constant/".$result->advicon3.")":"background-image:url(img/hospital/1.jpg"}}">
                                                            <span class="glyphicon glyphicon-cloud-upload"></span>
                                                            {!! Form::text('advicon1','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                            <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="5" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>





                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advantage4')) has-error @endif">
                                                        <span class="lblinput">Advateges4</span>
                                                        {!! Form::textarea('advantage4',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('advantage4'))
                                                            <span class="help-block error">{{ $errors->first('advantage4') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advicom4')) has-error @endif">
                                                        <span class="lblinput">adv4 image</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img"  imagetype="9" style="{{ isset($result->advicon4)?"background-image:url(img/constant/".$result->advicon4.")":"recipe"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('advicon1','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="9" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advantage5')) has-error @endif">
                                                        <span class="lblinput">Advateges5</span>
                                                        {!! Form::textarea('advantage5',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('advantage5'))
                                                            <span class="help-block error">{{ $errors->first('advantage5') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advicom5')) has-error @endif">
                                                        <span class="lblinput">adv5 image</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img"  imagetype="10" style="{{ isset($result->advicon5)?"background-image:url(img/constant/".$result->advicon5.")":"background-image:url(img/hospital/1.jpg"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('advicon1','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="10" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advantage6')) has-error @endif">
                                                        <span class="lblinput">Advateges6</span>
                                                        {!! Form::textarea('advantage6',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('advantage6'))
                                                            <span class="help-block error">{{ $errors->first('advantage6') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('advicon6')) has-error @endif">
                                                        <span class="lblinput">adv6 image</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img"  imagetype="11" style="{{ isset($result->advicon6)?"background-image:url(img/constant/".$result->advicon6.")":"background-image:url(img/hospital/1.jpg"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('advicon1','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="11" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                 
                                        <div class="tab-pane" id="tab_1_6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('history1')) has-error @endif">
                                                        <span class="lblinput">History1</span>
                                                        {!! Form::textarea('history1',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('history1'))
                                                            <span class="help-block error">{{ $errors->first('history1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('historyicon1')) has-error @endif">
                                                        <span class="lblinput">history1 image</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img"  imagetype="7" style="{{ isset($result->historyicon1)?"background-image:url(img/constant/".$result->historyicon1.")":"background-image:url(img/hospital/1.jpg"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('historyicon1','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="6" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('history2')) has-error @endif">
                                                        <span class="lblinput">History2</span>
                                                        {!! Form::textarea('history2',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('history2'))
                                                            <span class="help-block error">{{ $errors->first('history2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('historyicon2')) has-error @endif">
                                                        <span class="lblinput">history2 image</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img"  imagetype="7" style="{{ isset($result->historyicon2)?"background-image:url(img/constant/".$result->historyicon2.")":"background-image:url(img/hospital/1.jpg"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('historyicon2','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="7" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="form-group input-wlbl  @if ($errors->has('history3')) has-error @endif">
                                                        <span class="lblinput">History3</span>
                                                        {!! Form::textarea('history3',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                        @if ($errors->has('history3'))
                                                            <span class="help-block error">{{ $errors->first('history3') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('historyicon3')) has-error @endif">
                                                        <span class="lblinput">history3 image</span>
                                                        <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-constant-img"  imagetype="8" style="{{ isset($result->historyicon3)?"background-image:url(img/constant/".$result->historyicon3.")":"background-image:url(img/hospital/1.jpg"}}">
                                                                <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                {!! Form::text('historyicon1','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image" class="avatar-file upload-constant-img" imagetype="8" id="{{ isset($result->id)?$result->id:0 }}" accept="image/*" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                       
                                      
                                      
                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn green">Save</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END settings CONTENT -->
        </div>
    </div>
@stop