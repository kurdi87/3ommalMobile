      


                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>معلومات حساب المستخدم للشقة
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                          @if (!isset($result2))
                                    <div class="row">


                                        @if(!$result->SysUsr_ID)
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  password-strength strength-pass @if ($errors->has('password')) has-error @endif">
                                                    <span class="lblinput">{{ $lang->getLabelByKey('Password','ar') }}</span>
                                                    {!! Form::password('password',['id'=>'password_strength','placeholder'=>'Passwords','class'=>'form-control myinput-password'.(isset($result)?"":"txtinput-required").' txtinput-minlength','data-minlength'=>'6']) !!}
                                                    @if ($errors->has('password'))
                                                        <span class="help-block error">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl @if ($errors->has('password_confirmation')) has-error @endif">
                                                    <span class="lblinput">{{ $lang->getLabelByKey('Retype Password','ar') }}</span>
                                                    {!! Form::password('password_confirmation',['placeholder'=>'password','class'=>'form-control txtinput-related','data-related'=>'password']) !!}
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block error">{{ $errors->first('password_confirmation') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if(($result->SysUsr_ID && (in_array(3,$allowedActions)) || $isProfile))
                                            <div class="col-md-4">
                                                
                                            </div>
                                        @endif
                                    </div>



                            
                                @else
         <div class="row">
                                        <div class="{{ $result->SysUsr_ID?"col-md-4":"col-md-6" }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group input-wlbl @if ($errors->has('SysUsr_firstName')) has-error @endif">
                                                        <span class="lblinput">{{ $lang->getLabelByKey('First_Name','ar') }}</span>
                                                        {!! Form::text('SysUsr_firstName',$result2->SysUsr_firstName,['class'=>'form-control txtnotnumber txtinput-required']) !!}
                                                        @if ($errors->has('SysUsr_firstName'))
                                                            <span class="help-block error">{{ $errors->first('SysUsr_firstName') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group input-wlbl @if ($errors->has('SysUsr_lastName')) has-error @endif">
                                                        <span class="lblinput">{{ $lang->getLabelByKey('Last Name','ar') }}</span>
                                                        {!! Form::text('SysUsr_lastName',$result2->SysUsr_lastName,['class'=>'form-control txtnotnumber txtinput-required']) !!}
                                                        @if ($errors->has('SysUsr_lastName'))
                                                            <span class="help-block error">{{ $errors->first('SysUsr_lastName') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div><!-- row -->
                                        </div>

                                        <div class="{{ $result->SysUsr_ID?"col-md-4":"col-md-6" }}">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_UserName')) has-error @endif">
                                                <span class="lblinput">إسم المستخدم</span>
                                                {!! Form::text('SysUsr_UserName',$result2->SysUsr_UserName,['class'=>'form-control txtinput-required', 'readonly'=>'','data-validation'=>'cp-brand-buzz/user/validateInput/'.$result->SysUsr_ID]) !!}
                                                @if ($errors->has('SysUsr_UserName'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_UserName') }}</span>
                                                @endif
                                            </div>
                                        </div>

                             
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_DoB')) has-error @endif">
                                                <span class="lblinput">{{ $lang->getLabelByKey('Birthday','ar') }}</span>

                                                <div class="input-group">
                                                    {!! Form::text('SysUsr_DoB',$result2->SysUsr_DoB,['class'=>'form-control  datepicker-maxtoday','readonly'=>'','data-date-format'=>'yyyy-mm-dd']) !!}
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                @if ($errors->has('SysUsr_DoB'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_DoB') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_Email')) has-error @endif">
                                                <span class="lblinput">Email</span>
                                                {!! Form::text('SysUsr_Email',$result2->SysUsr_Email,['class'=>'form-control txtinput-required txtinput-email','data-validation'=> 'cp-brand-buzz/user/validateInput/'.$result->SysUsr_ID ]) !!}
                                                @if ($errors->has('SysUsr_Email'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_Email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_Mobile')) has-error @endif">
                                                <span class="lblinput">{{ $lang->getLabelByKey('Search','ar') }}</span>
                                                {!! Form::text('SysUsr_Mobile',$result2->SysUsr_Mobile,['class'=>'form-control txtinput-required txtinput-filter-number txtinput-minlength','data-minlength'=>'6','maxlength'=>'15' ]) !!}
                                                @if ($errors->has('SysUsr_Mobile'))
                                                    <span class="help-block error">{{ $errors->first('SysUsr_Mobile') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if(!$isProfile)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group select2-wlbl selectrole-rg">
                                                    <span class="lblselect">{{ $lang->getLabelByKey('Role','ar') }}</span>
                                                    {!! Form::select('roleid', $roles, $result2->roleid,["class"=>"form-control myselect select-required "]) !!}
                                                    <span class="help-block"></span>
                                                    @if ($errors->has('roleid'))
                                                        <span class="help-block error">{{ $errors->first('roleid') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="switch-inline">
                                                    <span>{{ $lang->getLabelByKey('Search','ar') }}</span>

                                                    <div>
                                                        {!! Form::checkbox('SysUsr_Status',1,$status, array('class'=>'make-switch',"data-on-color"=>"primary","data-off-color"=>"info")) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif



                                @endif


      
                                
                                </div>
                            </div>
                        </div>
                    </div>

