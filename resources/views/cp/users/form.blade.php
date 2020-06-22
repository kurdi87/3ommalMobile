<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/user"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Details
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="{{ $result->SysUsr_ID?"col-md-4":"col-md-6" }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group input-wlbl @if ($errors->has('SysUsr_firstName')) has-error @endif">
                                                        <span class="">First Name </span>
                                                        {!! Form::text('SysUsr_ID',null,['class'=>'form-control  hidden']) !!}
                                                        {!! Form::text('SysUsr_firstName',null,['class'=>'form-control txtnotnumber txtinput-required']) !!}
                                                        @if ($errors->has('SysUsr_firstName'))
                                                            <span class="help-block error">{{ $errors->first('SysUsr_firstName') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group input-wlbl @if ($errors->has('SysUsr_lastName')) has-error @endif">
                                                        <span class="">Last Name</span>
                                                        {!! Form::text('SysUsr_lastName',null,['class'=>'form-control txtnotnumber txtinput-required']) !!}
                                                        @if ($errors->has('SysUsr_lastName'))
                                                            <span class="help-block error">{{ $errors->first('SysUsr_lastName') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div><!-- row -->
                                        </div>

                                        <div class="{{ $result->SysUsr_ID?"col-md-4":"col-md-6" }}">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_UserName')) has-error @endif">
                                                <span class="">User Name</span>
                                                {!! Form::text('SysUsr_UserName',null,['class'=>'form-control txtinput-required','data-validation'=>'/hitechjobs/user/validateInput/'.$result->SysUsr_ID]) !!}
                                                @if ($errors->has('SysUsr_UserName'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_UserName') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl  password-strength strength-pass @if ($errors->has('password')) has-error @endif">
                                                <span class="">Password</span>
                                                {!! Form::password('password',['id'=>'password_strength','placeholder'=>'Passwords','class'=>'form-control myinput-password'.(isset($result)?"":"txtinput-required").' txtinput-minlength','data-minlength'=>'6']) !!}
                                                @if ($errors->has('password'))
                                                    <span class="help-block error">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl @if ($errors->has('password_confirmation')) has-error @endif">
                                                <span class="">Retype Password</span>
                                                {!! Form::password('password_confirmation',['placeholder'=>'password','class'=>'form-control txtinput-related','data-related'=>'password']) !!}
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block error">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        @if(($result->SysUsr_ID && (in_array(3,$allowedActions)) || $isProfile))
                                            <div class="col-md-4">

                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_DoB')) has-error @endif">
                                                <span class="">Birth Date</span>

                                                <div class="input-group">
                                                    {!! Form::text('SysUsr_DoB',null,['class'=>'form-control  datepicker','readonly'=>'','data-date-format'=>'yyyy-mm-dd']) !!}
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                </div>
                                                @if ($errors->has('SysUsr_DoB'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_DoB') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_Email')) has-error @endif">
                                                <span class="">Email</span>
                                                {!! Form::text('SysUsr_Email',null,['class'=>'form-control txtinput-required txtinput-email','data-validation'=> 'hitechjobs/user/validateInput/'.$result->SysUsr_ID ]) !!}
                                                @if ($errors->has('SysUsr_Email'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_Email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_Mobile')) has-error @endif">
                                                <span class="">Mobile</span>
                                                {!! Form::text('SysUsr_Mobile',null,['class'=>'form-control txtinput-required txtinput-filter-number txtinput-minlength','data-minlength'=>'6','maxlength'=>'15' ]) !!}
                                                @if ($errors->has('SysUsr_Mobile'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_Mobile') }}</span>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group select2-wlbl selectrole-rg">
                                                <span class="">Role</span>
                                                {!! Form::select('role', $roles, NULL,["class"=>"form-control myselect select-required "]) !!}
                                                <span class="help-block"></span>
                                                @if ($errors->has('role'))
                                                    <span class="help-block error">{{ $errors->first('role') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl @if ($errors->has('branch')) has-error @endif">
                                                <span class="">Branch</span>
                                                {!! Form::text('branch',null,['class'=>'form-control ']) !!}
                                                @if ($errors->has('SysUsr_lastName'))
                                                    <span class="help-block error">{{ $errors->first('branch') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="switch-inline">
                                                <span>الحالة</span>

                                                <div>
                                                    {!! Form::checkbox('SysUsr_Status',1,$status, array('class'=>'make-switch',"data-on-color"=>"primary","data-off-color"=>"info")) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                @if ($errors->has('action'))
                                    <span class="help-block error">{{ $errors->first('action') }}</span>
                                @endif

                                @if(!$isProfile)
                                    @include("cp.parts.roles.permission")
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
