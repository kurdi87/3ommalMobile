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
                    <a href="{{ config('app.cp_route_name') }}/employee"
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
                                <i class="icon-globe"></i>employee
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="portlet box yellow ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    Basic Information - المعلومات الأساسية
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>

                                            <div class="portlet-body collapse-body padding-15-all">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('h_image')) has-error @endif">
                                                            <span class=""> Image - صورة</span>
                                                            <div class="profile-userpic">
                                                                <div class="upload-employee-img"
                                                                     style="{{ isset($result->image)?"background-image:url(img/employee/".$result->image.")":""}}">
                                                                    <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                    {!! Form::text('image',null,['class'=>'form-control hidden icon ']) !!}
                                                                    <input type="file" name="image2"
                                                                           class="avatar-file upload-employee-img"
                                                                           id="{{ isset($result->id)?$result->id:0 }}"
                                                                           accept="image/"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                            <span class="">Full Name - الأسم كاملا</span>
                                                            {!! Form::text('name',null,['class'=>'form-control txtinput-required  ']) !!}
                                                            @if ($errors->has('name'))
                                                                <span class="help-block error">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group input-wlbl  @if ($errors->has('empono')) has-error @endif">
                                                            <span class="">Emp No رقم الهوية</span>
                                                            {!! Form::text('empno',null,['class'=>'form-control  ']) !!}
                                                            @if ($errors->has('empno'))
                                                                <span class="help-block error">{{ $errors->first('empno') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group input-wlbl  @if ($errors->has('sid')) has-error @endif">
                                                            <span class="">ID No -رقم الهوية</span>
                                                            {!! Form::text('sid',null,['class'=>'form-control txtinput-minlength ','data-minlength'=>'9']) !!}
                                                            @if ($errors->has('sid'))
                                                                <span class="help-block error">{{ $errors->first('sid') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl @if ($errors->has('employment_date')) has-error @endif">
                                                            <span class="">Employment Date - تاريخ التوظيف</span>

                                                            <div class="input-group input-large  date date-picker"
                                                                 data-date-format="yyyy-mm-dd"
                                                                 data-date-viewmode="years">
                                                                {!! Form::text('employment_date',isset($result->employment_date)? date('Y-m-d', strtotime($result->employment_date)):'',['class'=>'form-control']) !!}
                                                                <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                            </div>
                                                            @if ($errors->has('employment_date'))
                                                                <span class="help-block error">{{ $errors->first('employment_date') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl @if ($errors->has('bod')) has-error @endif">
                                                            <span class="">Date of Birth -  تاريخ الميلاد</span>

                                                            <div class="input-group input-large  date date-picker"
                                                                 data-date-format="yyyy-mm-dd"
                                                                 data-date-viewmode="years">
                                                                {!! Form::text('bod',isset($result->bod)? date('Y-m-d', strtotime($result->bod)):'',['class'=>'form-control']) !!}
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
                                                        <div class="form-group input-wlbl  @if ($errors->has('project')) has-error @endif">
                                                            <span class="">Project - المشروع</span>
                                                            {!! Form::select('project',$project,null,['class'=>'form-control select2 txtinput-required']) !!}
                                                            @if ($errors->has('project'))
                                                                <span class="help-block error">{{ $errors->first('project') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                            <span class="">Department - القسم</span>
                                                            {!! Form::select('department_id',$department,null,['class'=>'form-control select2 txtinput-required']) !!}
                                                            @if ($errors->has('department_id'))
                                                                <span class="help-block error">{{ $errors->first('department_id') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group input-wlbl  @if ($errors->has('job_title')) has-error @endif">
                                                            <span class="">Job Title -  العنوان الوظيفي</span>
                                                            {!! Form::text('job_title',null,['class'=>'form-control  ']) !!}
                                                            @if ($errors->has('job_title'))
                                                                <span class="help-block error">{{ $errors->first('job_title') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group input-wlbl  @if ($errors->has('manager')) has-error @endif">
                                                            <span class="">Is Manager? -مسؤول؟</span>

                                                            {!! Form::checkbox('manager')!!}
                                                            @if ($errors->has('manager'))
                                                                <span class="help-block error">{{ $errors->first('manager') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('employment_type')) has-error @endif">
                                                            <span class="">Employment Type - نوع الموظف</span>
                                                            {!! Form::select('employment_type',$employment_type,null,['class'=>'form-control  txtinput-required']) !!}
                                                            @if ($errors->has('employment_type'))
                                                                <span class="help-block error">{{ $errors->first('employment_type') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="clearfix">

                                                    </div>

                                                    <div class="col-md-4 ">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 control-label">Evaluation - التقييم</label>
                                                            <div class="col-md-9">
                                                                <div id="demo4" class="noUi-success"></div>
                                                                <div class="well margin-top-30 text-center">
                                                                    {!! Form::text('evaluation',null,['class'=>'form-control input-small input-inline','id'=>'demo4_input']) !!}

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl @if ($errors->has('salary')) has-error @endif">
                                                            <span class="">Salary - الراتب</span>

                                                            <div class="input-group">
                                                                {!! Form::text('salary',null,['class'=>'form-control txtinput-number  ']) !!}

                                                                <span class="input-group-btn btn-right">

                                                                         {!! Form::select('currency',$currences,null,['class'=>'btn green  dropdown-toggle']) !!}
                                                                        </span>
                                                            </div>


                                                            @if ($errors->has('salary'))
                                                                <span class="help-block error">{{ $errors->first('salary') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl @if ($errors->has('increment')) has-error @endif">
                                                            <span class="">Increment - الزيادة</span>

                                                            <div class="input-group">
                                                                {!! Form::text('increment',null,['class'=>'form-control txtinput-number  ']) !!}

                                                                <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    %
                                                                </button>
                                                            </span>
                                                            </div>


                                                            @if ($errors->has('increment'))
                                                                <span class="help-block error">{{ $errors->first('increment') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="clearfix">
                                                        <hr>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('leaves')) has-error @endif">
                                                            <span class="">Leaves -رصيد الإجازات السنوية</span>
                                                            {!! Form::text('leaves',null,['class'=>'form-control txtinput-required  ']) !!}
                                                            @if ($errors->has('leaves'))
                                                                <span class="help-block error">{{ $errors->first('leaves') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('sick')) has-error @endif">
                                                            <span class="">Sick Leaves -رصيد الإجازات المرضية</span>
                                                            {!! Form::text('sick',null,['class'=>'form-control txtinput-required  ']) !!}
                                                            @if ($errors->has('sick'))
                                                                <span class="help-block error">{{ $errors->first('sick') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                            <span class="">Title -  المسمى</span>
                                                            {!! Form::select('title',$titles,null,['class'=>'form-control  ']) !!}
                                                            @if ($errors->has('title'))
                                                                <span class="help-block error">{{ $errors->first('title') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('gender')) has-error @endif">
                                                            <span class="">Gender - الجنس</span>
                                                            {!! Form::select('gender',$gender,null,['class'=>'form-control  txtinput-required']) !!}
                                                            @if ($errors->has('gender'))
                                                                <span class="help-block error">{{ $errors->first('gender') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                            <span class="">Type - النوع</span>
                                                            {!! Form::select('type',$type,null,['class'=>'form-control  txtinput-required']) !!}
                                                            @if ($errors->has('type'))
                                                                <span class="help-block error">{{ $errors->first('type') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="portlet box green ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Bank Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group input-wlbl  @if ($errors->has('bank_name')) has-error @endif">
                                                                <span class="">Bank Name - اسم البنك</span>
                                                                {!! Form::text('bank_name',null,['class'=>'form-control txtinput-required  ']) !!}
                                                                @if ($errors->has('bank_name'))
                                                                    <span class="help-block error">{{ $errors->first('bank_name') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group input-wlbl  @if ($errors->has('bank_branch')) has-error @endif">
                                                                <span class="">Bank Branch - الفرع</span>
                                                                {!! Form::text('bank_branch',null,['class'=>'form-control txtinput-required  ']) !!}
                                                                @if ($errors->has('bank_branch'))
                                                                    <span class="help-block error">{{ $errors->first('bank_branch') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group input-wlbl  @if ($errors->has('bank_iban')) has-error @endif">
                                                                <span class="">Bank iban</span>
                                                                {!! Form::text('bank_iban',null,['class'=>'form-control txtinput-required  ']) !!}
                                                                @if ($errors->has('bank_iban'))
                                                                    <span class="help-block error">{{ $errors->first('bank_iban') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group input-wlbl  @if ($errors->has('bank_account')) has-error @endif">
                                                                <span class="">Bank account # رقم الحساب</span>
                                                                {!! Form::text('bank_account',null,['class'=>'form-control txtinput-required  ']) !!}
                                                                @if ($errors->has('bank_account'))
                                                                    <span class="help-block error">{{ $errors->first('bank_account') }}</span>
                                                                @endif
                                                            </div>
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
                                                                <span class="">Address - العنوان</span>
                                                                {!! Form::text('address',null,['class'=>'form-control txtinput-required  ']) !!}
                                                                @if ($errors->has('address'))
                                                                    <span class="help-block error">{{ $errors->first('address') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('country')) has-error @endif">
                                                                <span class="">Country - المدبنة</span>
                                                                {!! Form::select('country',$country,null,['class'=>'form-control txtinput-required select2 txtinput']) !!}
                                                                @if ($errors->has('country'))
                                                                    <span class="help-block error">{{ $errors->first('country') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('city')) has-error @endif">
                                                                <span class="">City - المدينة</span>
                                                                {!! Form::select('city',$city,null,['class'=>'form-control select2 txtinput']) !!}
                                                                @if ($errors->has('city'))
                                                                    <span class="help-block error">{{ $errors->first('city') }}</span>
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
                                                        Contact Information - معلومات التواصل
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                                <span class="">Telephone - رقم الهاتف</span>
                                                                {!! Form::text('telephone',null,['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('telephone'))
                                                                    <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('telephone2')) has-error @endif">
                                                                <span class="">Telephone2 - الهاتف 2</span>
                                                                {!! Form::text('telephone2',null,['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('telephone2'))
                                                                    <span class="help-block error">{{ $errors->first('telephone2') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('email')) has-error @endif">
                                                                <span class="">E-mail - الإيميل</span>
                                                                {!! Form::text('email',null,['class'=>'form-control .txtinput-email  ']) !!}
                                                                @if ($errors->has('email'))
                                                                    <span class="help-block error">{{ $errors->first('email') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('mobile')) has-error @endif">
                                                                <span class="">Mobile - الجوال</span>
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
                                        <div class="col-md-12">
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

                                                        <div class="col-md-4">
                                                            <div class="form-group input-wlbl  @if ($errors->has('hospital_id')) has-error @endif">
                                                                <span class="">Hospital - الميشفى</span>
                                                                {!! Form::select('hospital_id',$hospital,null,['class'=>'form-control select2  txtinput']) !!}
                                                                @if ($errors->has('hospital_id'))
                                                                    <span class="help-block error">{{ $errors->first('hospital_id') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group input-wlbl  @if ($errors->has('education')) has-error @endif">
                                                                <span class="">Education - التعليم</span>
                                                                {!! Form::select('education',$education,null,['class'=>'form-control  txtinput']) !!}
                                                                @if ($errors->has('education'))
                                                                    <span class="help-block error">{{ $errors->first('education') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group input-wlbl  @if ($errors->has('career')) has-error @endif">
                                                                <span class="">Career - المهنة</span>
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
                                                        User Information - معلومات المستخدم
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>

                                                    </div>
                                                </div>


                                                <div class="portlet-body  padding-15-all">

                                                    <div class="row">
                                                        <div class="{{ $result->SysUsr_ID?"col-md-4":"col-md-4 hidden" }}">
                                                            <div class="form-group input-wlbl @if ($errors->has('SysUsr_UserName')) has-error @endif">
                                                                <span class="">User Name: - اسم المستخدم</span>
                                                                {{(isset($result->SysUsr_ID)?$result->SysUsr_UserName:'')}}
                                                                @if ($errors->has('SysUsr_UserName'))
                                                                    <span class="help-block error">{{ $errors->first('SysUsr_UserName') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  password-strength strength-pass @if ($errors->has('password')) has-error @endif">
                                                                <span class="">Password - كلمة المرور</span>
                                                                {!! Form::password('password',['id'=>'password_strength','placeholder'=>'Passwords','class'=>'form-control myinput-password'.(isset($result->SysUsr_ID)?"":"txtinput-required ").' txtinput-minlength','data-minlength'=>'6',(isset($result->SysUsr_ID)?"":" ")]) !!}
                                                                @if ($errors->has('password'))
                                                                    <span class="help-block error">{{ $errors->first('password') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl @if ($errors->has('password_confirmation')) has-error @endif">
                                                                <span class="">Retype Password - الباسورد مرة أخرى</span>
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



    