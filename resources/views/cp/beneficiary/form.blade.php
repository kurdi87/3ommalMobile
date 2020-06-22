<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/beneficiary"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    @if (isset($result->id))
                        <a title="Creat Event"
                           class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered"
                           href="{{config('app.cp_route_name')}}/event/create?beneficiary_id={{$result->id}}">
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
                                <i class="icon-globe"></i>Beneficiary
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet box blue package-form-rg">
                                                <div class="portlet-title myptitle">
                                                    <div class="caption">
                                                        Basic Information - معلومات أساسية
                                                    </div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse">ff</a>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body  collapse-body padding-15-all"
                                                     id="collapseExample">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="row border border-green border-margin-5">

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('fname')) has-error @endif">
                                                                        <span class="">First Name* - الاسم الأول</span>
                                                                        {!! Form::text('fname',app('request')->input('name')? app('request')->input('name'):Null,['class'=>'form-control txtinput-required  ']) !!}
                                                                        @if ($errors->has('fname'))
                                                                            <span class="help-block error">{{ $errors->first('fname') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('sname')) has-error @endif">
                                                                        <span class="">Second Name* - اسم الأب</span>
                                                                        {!! Form::text('sname',null,['class'=>'form-control    ']) !!}
                                                                        @if ($errors->has('sname'))
                                                                            <span class="help-block error">{{ $errors->first('sname') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('tname')) has-error @endif">
                                                                        <span class="">Third Name* - اسم الجد</span>
                                                                        {!! Form::text('tname',null,['class'=>'form-control   ']) !!}
                                                                        @if ($errors->has('tname'))
                                                                            <span class="help-block error">{{ $errors->first('tname') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('faname')) has-error @endif">
                                                                        <span class="">Last  Name* العائلة</span>
                                                                        {!! Form::text('faname',null,['class'=>'form-control txtinput-required   ']) !!}
                                                                        @if ($errors->has('faname'))
                                                                            <span class="help-block error">{{ $errors->first('faname') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('fname_ar')) has-error @endif">
                                                                        <span class="">First Name_ar* - الاسم الأول عر بي</span>
                                                                        {!! Form::text('fname_ar',null,['class'=>'form-control arabic txtinput-required  ']) !!}
                                                                        @if ($errors->has('fname_ar'))
                                                                            <span class="help-block error">{{ $errors->first('fname_ar') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('sname_ar')) has-error @endif">
                                                                        <span class="">Sec. Name_ar* اسم الأب عربي </span>
                                                                        {!! Form::text('sname_ar',null,['class'=>'form-control arabic  ']) !!}
                                                                        @if ($errors->has('sname_ar'))
                                                                            <span class="help-block error">{{ $errors->first('sname_ar') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('tname_ar')) has-error @endif">
                                                                        <span class="">Third Name_ar* اسم الجد عربي</span>
                                                                        {!! Form::text('tname_ar',null,['class'=>'form-control arabic ']) !!}
                                                                        @if ($errors->has('tname_ar'))
                                                                            <span class="help-block error">{{ $errors->first('tname_ar') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('faname_ar')) has-error @endif">
                                                                        <span class="">Last Name_ar*العائلة عربي </span>
                                                                        {!! Form::text('faname_ar',null,['class'=>'form-control txtinput-required arabic  ']) !!}
                                                                        @if ($errors->has('faname_ar'))
                                                                            <span class="help-block error">{{ $errors->first('faname_ar') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('sid')) has-error @endif">
                                                                        <span class="">Document No - رقم الهوية</span>
                                                                        {!! Form::text('sid',null,['class'=>'form-control txtinput-required ']) !!}
                                                                        @if ($errors->has('sid'))
                                                                            <span class="help-block error">{{ $errors->first('sid') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('dtype')) has-error @endif">
                                                                        <span class="">Document Type* -نوع الهوية</span>
                                                                        {!! Form::select('dtype',$dtype,null,['class'=>'form-control select2 txtinput-required txtinput']) !!}
                                                                        @if ($errors->has('dtype'))
                                                                            <span class="help-block error">{{ $errors->first('dtype') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('file_no')) has-error @endif">
                                                                        <span class="">File Number - رقم الملف</span>
                                                                        {!! Form::text('file_no',null,['class'=>'form-control   ']) !!}
                                                                        @if ($errors->has('file_no'))
                                                                            <span class="help-block error">{{ $errors->first('file_no') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 hidden">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('lead_id')) has-error @endif">
                                                                        <span class="">Lead ID -رقم الدليل</span>
                                                                        {!! Form::text('lead_id',app('request')->input('lead_id')? app('request')->input('lead_id'):Null,['class'=>'form-control   ','readonly']) !!}
                                                                        @if ($errors->has('lead_id'))
                                                                            <span class="help-block error">{{ $errors->first('lead_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">


                                                        <div class="col-md-12">
                                                            <div class="row border border-green border-margin-5">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl @if ($errors->has('bod')) has-error @endif">
                                                                        <span class="">Date of Birth - تاريخ الميلاد</span>

                                                                        <div class="input-group input-medium  date date-picker"
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
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl @if ($errors->has('birth_place')) has-error @endif">
                                                                        <span class="">Birth Place - مكان الميلاد</span>

                                                                        {!! Form::select('birth_place',$country,1,['class'=>'form-control select2 txtinput-required  txtinput']) !!}
                                                                        @if ($errors->has('birth_place'))
                                                                            <span class="help-block error">{{ $errors->first('birth_place') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                                        <span class="">Title - العنوان</span>
                                                                        {!! Form::select('title',$titles,null,['class'=>'form-control select2  ']) !!}
                                                                        @if ($errors->has('title'))
                                                                            <span class="help-block error">{{ $errors->first('title') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('gender')) has-error @endif">
                                                                        <span class="">Gender*</span>
                                                                        {!! Form::select('gender',$gender,null,['class'=>'form-control  select2 txtinput-required']) !!}
                                                                        @if ($errors->has('gender'))
                                                                            <span class="help-block error">{{ $errors->first('gender') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>



                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('marital_status')) has-error @endif">
                                                                        <span class="">Marital Status - الحالة الاجتماعية</span>
                                                                        {!! Form::select('marital_status',$marital_status,null,['class'=>'form-control select2 txtinput']) !!}
                                                                        @if ($errors->has('marital_status'))
                                                                            <span class="help-block error">{{ $errors->first('marital_status') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('chronic_disease')) has-error @endif">
                                                                        <span class="">Chronic Disease - الأمراض المزمنة</span>
                                                                        {!! Form::select('chronic_disease',$chronic_disease,null,['class'=>'form-control select2  txtinput']) !!}
                                                                        @if ($errors->has('chronic_disease'))
                                                                            <span class="help-block error">{{ $errors->first('chronic_disease') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('active_disease')) has-error @endif">
                                                                        <span class="">Active Disease -  الأمراض الحالية</span>
                                                                        {!! Form::select('active_disease',$active_disease,null,['class'=>'form-control select2  txtinput']) !!}
                                                                        @if ($errors->has('active_disease '))
                                                                            <span class="help-block error">{{ $errors->first('active_disease') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('blood')) has-error @endif">
                                                                        <span class="">Blood Group - فصيلة الدم</span>
                                                                        {!! Form::select('blood',$blood,null,['class'=>'form-control select2  txtinput']) !!}
                                                                        @if ($errors->has('blood'))
                                                                            <span class="help-block error">{{ $errors->first('blood') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl @if ($errors->has('weight')) has-error @endif">
                                                                        <span class="">Weight - الوزن</span>

                                                                        <div class="input-group">
                                                                            {!! Form::text('weight',null,['class'=>'form-control weight txtinput-number  ']) !!}

                                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    Kg
                                                                </button>
                                                            </span>
                                                                        </div>


                                                                        @if ($errors->has('weight'))
                                                                            <span class="help-block error">{{ $errors->first('weight') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl @if ($errors->has('height')) has-error @endif">
                                                                        <span class="">Height - الطول</span>

                                                                        <div class="input-group">
                                                                            {!! Form::text('height',null,['class'=>'form-control height txtinput-number  ']) !!}

                                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                 cm
                                                                </button>
                                                            </span>
                                                                        </div>


                                                                        @if ($errors->has('height'))
                                                                            <span class="help-block error">{{ $errors->first('height') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('bmi')) has-error @endif">
                                                                        <span class="">bmi - نسبة الوزن والطول</span>
                                                                        {!! Form::text('bmi',null,['class'=>'form-control bmi  ', 'readonly'=>'readonly']) !!}
                                                                        @if ($errors->has('bmi'))
                                                                            <span class="help-block error">{{ $errors->first('bmi') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>


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
                                                        Address Information - العنوان
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('country')) has-error @endif">
                                                                <span class="">Country* - الدولة</span>
                                                                {!! Form::select('country',$country,app('request')->input('country')? app('request')->input('country'):1,['class'=>'form-control txtinput-required  select2 txtinput']) !!}
                                                                @if ($errors->has('country'))
                                                                    <span class="help-block error">{{ $errors->first('country') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('city')) has-error @endif">
                                                                <span class="">City - المدينة</span>
                                                                {!! Form::select('city',$city,null,['class'=>'form-control select2 txtinput txtinput-required ']) !!}
                                                                @if ($errors->has('city'))
                                                                    <span class="help-block error">{{ $errors->first('city') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('prov')) has-error @endif">
                                                                <span class="">Province - المحافظة</span>
                                                                {!! Form::select('prov',$prov,null,['class'=>'form-control  select2 txtinput-required  txtinput']) !!}
                                                                @if ($errors->has('prov'))
                                                                    <span class="help-block error">{{ $errors->first('prov') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('address')) has-error @endif">
                                                                <span class="">address - العنوان</span>
                                                                {!! Form::text('address',null,['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('address'))
                                                                    <span class="help-block error">{{ $errors->first('address') }}</span>
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
                                                        Contact Information - التواصل
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                                <span class="">Telephone - الهاتف</span>
                                                                {!! Form::text('telephone',app('request')->input('phone')? app('request')->input('phone'):Null,['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('telephone'))
                                                                    <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('email')) has-error @endif">
                                                                <span class="">E-mail - الإيميل</span>
                                                                {!! Form::text('email',app('request')->input('email')? app('request')->input('email'):Null,['class'=>'form-control .txtinput-email  ']) !!}
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

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('fax')) has-error @endif">
                                                                <span class="">Fax -  الفاكس</span>
                                                                {!! Form::text('fax',null,['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('fax'))
                                                                    <span class="help-block error">{{ $errors->first('fax') }}</span>
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
                                                        Partnership Information - معلومات العضوية
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class=""> </a>

                                                    </div>
                                                </div>


                                                <div class="portlet-body  padding-15-all">

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl  @if ($errors->has('policy_type')) has-error @endif">
                                                                <span class="">Policy_type - نوع الرخصة</span>
                                                                {!! Form::select('policy_type',$policy_type,null,['class'=>'form-control select2  txtinput']) !!}
                                                                @if ($errors->has('policy_type'))
                                                                    <span class="help-block error">{{ $errors->first('policy_type') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl @if ($errors->has('policy_start_date')) has-error @endif">
                                                                <span class="">Policy Start Date - تاريخ بداية الرخصة</span>

                                                                <div class="input-group input-medium  date date-picker"
                                                                     data-date-format="yyyy-mm-dd"
                                                                     data-date-viewmode="years">
                                                                    {!! Form::text('policy_start_date',isset($result->policy_start_date )? date('Y-m-d', strtotime($result->policy_start_date )):'',['class'=>'form-control']) !!}
                                                                    <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                                </div>
                                                                @if ($errors->has('policy_start_date'))
                                                                    <span class="help-block error">{{ $errors->first('policy_start_date') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl  @if ($errors->has('policy_insurance_number')) has-error @endif">
                                                                <span class="">Policy Insurance Number -رقم التأمين</span>
                                                                {!! Form::text('policy_insurance_number',null,['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('policy_insurance_number'))
                                                                    <span class="help-block error">{{ $errors->first('policy_insurance_number') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl  @if ($errors->has('part_type')) has-error @endif">
                                                                <span class="">Partnership Type</span>
                                                                {!! Form::select('part_type',$partType,null,['class'=>'form-control select2  txtinput']) !!}
                                                                @if ($errors->has('part_type'))
                                                                    <span class="help-block error">{{ $errors->first('part_type') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl  @if ($errors->has('payment_type')) has-error @endif">
                                                                <span class="">Payment_Type - نوع الدفع</span>
                                                                {!! Form::select('payment_type',$payment_type,null,['class'=>'form-control select2  txtinput']) !!}
                                                                @if ($errors->has('payment_type'))
                                                                    <span class="help-block error">{{ $errors->first('payment_type') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl   has-error ">
                                                                <span class="">Dependencies Number - عدد المرافقين</span>
                                                               <p>{{isset($result->id)?count(\App\Models\DependenciesModel::getIDependenciesByBeneficiary($result->id)):'0'}}</p>
                                                                @if ($errors->has('career'))
                                                                    <span class="help-block error">{{ $errors->first('career') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl  @if ($errors->has('lic_number')) has-error @endif">
                                                                <span class="">License Number - رقم الرخصة</span>
                                                                {!! Form::text('lic_number',null,['class'=>'form-control txtinput-filter-number   ']) !!}
                                                                @if ($errors->has('fax'))
                                                                    <span class="help-block error">{{ $errors->first('lic_number') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <span class="">License Date - ترايخ الرخصة</span>
                                                            <div class="input-group input-xlarge date-picker input-daterange"
                                                                 data-date="2018/01/01" data-date-format="yyyy/mm/dd">


                                                                {!! Form::text('lic_start_date',null,['class'=>'form-control','placeholder'=>"Date form"]) !!}
                                                                <span class="input-group-addon"> to </span>

                                                                {!! Form::text('lic_end_date',null,['class'=>'form-control','placeholder'=>"Date To"]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group input-wlbl @if ($errors->has('card_no')) has-error @endif">
                                                                <span class="">Card NO -رقم الكرت </span>

                                                                <div class="input-group">
                                                                    {!! Form::text('card_no',null,['class'=>'form-control txtinput-number  ']) !!}
                                                                </div>


                                                                @if ($errors->has('card_no'))
                                                                    <span class="help-block error">{{ $errors->first('card_no') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="form-group input-wlbl  @if ($errors->has('activate')) has-error @endif">
                                                                <span class="">Activated - تفيعل</span>
                                                                {!! Form::checkbox('activate')!!}

                                                                @if ($errors->has('activate'))
                                                                    <span class="help-block error">{{ $errors->first('activate') }}</span>
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



    