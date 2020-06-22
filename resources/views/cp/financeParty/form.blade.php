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
                    <a href="{{ config('app.cp_route_name') }}/financeParty"
                       class="btn btiman-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    @if (isset($result->id))
                        <a title="Creat Event"
                           class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered"
                           href="{{config('app.cp_route_name')}}/event/create?financeParty_id={{$result->id}}">
                            <i class="fa fa-ambulance"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>FinanceParty
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="portlet box default ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    Organisation Information
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>

                                            <div class="portlet-body collapse-body padding-15-all">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                            <span class="">Organisation Name*</span>
                                                            {!! Form::text('name',null,['class'=>'form-control txtinput-required  ']) !!}
                                                            @if ($errors->has('name'))
                                                                <span class="help-block error">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('name_ar')) has-error @endif">
                                                            <span class="">Organisation Name Ar</span>
                                                            {!! Form::text('name_ar',null,['class'=>'form-control txtinput-required  ']) !!}
                                                            @if ($errors->has('name_ar'))
                                                                <span class="help-block error">{{ $errors->first('name_ar') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('website')) has-error @endif">
                                                            <span class="">Website </span>
                                                            {!! Form::text('website',null,['class'=>'form-control txtinput-required  ']) !!}
                                                            @if ($errors->has('website'))
                                                                <span class="help-block error">{{ $errors->first('website') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>

                                        <div class="portlet box yellow ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    Representative Information
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>

                                            <div class="portlet-body collapse-body padding-15-all">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('h_image')) has-error @endif">
                                                            <span class=""> Image</span>
                                                            <div class="profile-userpic">
                                                                <div class="upload-financeParty-img"
                                                                     style="{{ isset($result->image)?"background-image:url(cp/images/".$result->image.")":""}}">
                                                                    <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                    {!! Form::text('image',null,['class'=>'form-control hidden icon ']) !!}
                                                                    <input type="file" name="image2"
                                                                           class="avatar-file upload-financeParty-img"
                                                                           id="{{ isset($result->id)?$result->id:0 }}"
                                                                           accept="image/*"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group input-wlbl  @if ($errors->has('rep_name')) has-error @endif">
                                                            <span class=""> Name</span>
                                                            {!! Form::text('rep_name',null,['class'=>'form-control txtinput-required  ']) !!}
                                                            @if ($errors->has('rep_name'))
                                                                <span class="help-block error">{{ $errors->first('rep_name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl @if ($errors->has('bod')) has-error @endif">
                                                            <span class="">Date of Birth</span>

                                                            <div class="input-group input-medium  date date-picker"
                                                                 data-date-format="yyyy-mm-dd"
                                                                 data-date-viewmode="years">
                                                                {!! Form::text('bod',isset($result->bod)? date('Y-m-d', strtotime($result->bod)):Null,['class'=>'form-control']) !!}
                                                                <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                            </div>
                                                            @if ($errors->has('bod'))
                                                                <span class="help-block error">{{ $errors->first('bod') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">


                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                            <span class="">Title</span>
                                                            {!! Form::select('title',$titles,null,['class'=>'form-control  ']) !!}
                                                            @if ($errors->has('title'))
                                                                <span class="help-block error">{{ $errors->first('title') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('gender')) has-error @endif">
                                                            <span class="">Gender*</span>
                                                            {!! Form::select('gender',$gender,null,['class'=>'form-control  txtinput-required']) !!}
                                                            @if ($errors->has('gender'))
                                                                <span class="help-block error">{{ $errors->first('gender') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="portlet box red ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Address Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group input-wlbl  @if ($errors->has('address')) has-error @endif">
                                                                <span class="">Address</span>
                                                                {!! Form::text('address',null,['class'=>'form-control txtinput-required  ']) !!}
                                                                @if ($errors->has('address'))
                                                                    <span class="help-block error">{{ $errors->first('address') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('country')) has-error @endif">
                                                                <span class="">Country*</span>
                                                                {!! Form::select('country',$country,null,['class'=>'form-control txtinput-required  txtinput']) !!}
                                                                @if ($errors->has('country'))
                                                                    <span class="help-block error">{{ $errors->first('country') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('city')) has-error @endif">
                                                                <span class="">City</span>
                                                                {!! Form::select('city',$city,null,['class'=>'form-control  txtinput']) !!}
                                                                @if ($errors->has('city'))
                                                                    <span class="help-block error">{{ $errors->first('city') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl  @if ($errors->has('lang')) has-error @endif">
                                                                <span class="lblinput">Language</span>
                                                                {!! Form::select('lang',$languages,null,['class'=>'form-control  txtinput']) !!}
                                                                @if ($errors->has('id'))
                                                                    <span class="help-block error">{{ $errors->first('id') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet box green ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Contact Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                                <span class="">Telephone</span>
                                                                {!! Form::text('telephone',null,['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('telephone'))
                                                                    <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('telephone2')) has-error @endif">
                                                                <span class="">Telephone2</span>
                                                                {!! Form::text('telephone2',null,['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('telephone2'))
                                                                    <span class="help-block error">{{ $errors->first('telephone2') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('email')) has-error @endif">
                                                                <span class="">E-mail</span>
                                                                {!! Form::text('email',null,['class'=>'form-control .txtinput-email  ']) !!}
                                                                @if ($errors->has('email'))
                                                                    <span class="help-block error">{{ $errors->first('email') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('mobile')) has-error @endif">
                                                                <span class="">Mobile</span>
                                                                {!! Form::text('mobile',null,['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('mobile'))
                                                                    <span class="help-block error">{{ $errors->first('mobile') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Other Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>

                                                    </div>
                                                </div>


                                                <div class="portlet-body  padding-15-all">

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('education')) has-error @endif">
                                                                <span class="">Education</span>
                                                                {!! Form::select('education',$education,null,['class'=>'form-control  txtinput']) !!}
                                                                @if ($errors->has('education'))
                                                                    <span class="help-block error">{{ $errors->first('education') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('career')) has-error @endif">
                                                                <span class="">Career</span>
                                                                {!! Form::select('career',$career,null,['class'=>'form-control  txtinput']) !!}
                                                                @if ($errors->has('career'))
                                                                    <span class="help-block error">{{ $errors->first('career') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        User Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>

                                                    </div>
                                                </div>


                                                <div class="portlet-body  padding-15-all">

                                                    <div class="row">
                                                        <div class="{{ $result->SysUsr_ID?"col-md-4":"col-md-6 hidden" }}">
                                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_UserName')) has-error @endif">
                                                                <span class="">User Name: </span>
                                                              {{(isset($result->SysUsr_ID)?$result->SysUsr_UserName:Null)}}
                                                                @if ($errors->has('SysUsr_UserName'))
                                                                    <span class="help-block error">{{ $errors->first('SysUsr_UserName') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
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
                                                                <div class="form-group input-wlbl  password-strength strength-pass @if ($errors->has('password')) has-error @endif">
                                                                    <span class="">Password</span>
                                                                    {!! Form::password('password',['id'=>'password_strength','placeholder'=>'Passwords','class'=>'form-control myinput-password'.(isset($result->SysUsr_ID)?"":"txtinput-required ").' txtinput-minlength','data-minlength'=>'6',(isset($result->SysUsr_ID)?"":" ")]) !!}
                                                                    @if ($errors->has('password'))
                                                                        <span class="help-block error">{{ $errors->first('password') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl @if ($errors->has('password_confirmation')) has-error @endif">
                                                                    <span class="">Retype Password</span>
                                                                    {!! Form::password('password_confirmation',['placeholder'=>'password','class'=>'form-control txtinput-related',(isset($result->SysUsr_ID)?"":" "),'data-related'=>'password']) !!}
                                                                    @if ($errors->has('password_confirmation'))
                                                                        <span class="help-block error">{{ $errors->first('password_confirmation') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    <!--span-->
                                </div>

                                <!--span-->
                            </div>
                            <!--row-->
                        </div>
                        <!--form body-->
                    </div>
                    <!-- END FORM-->
                </div>
                <!--portlet form-->
            </div>
            <!--portlet box-->

        </div>
        <!--tab pane-->
    </div>
    <!--tab content-->
</div>



    