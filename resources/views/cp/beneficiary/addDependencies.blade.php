<div class="row" style="padding: 20px;">


    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('sid')) has-error @endif">
            <span class="">Document No - رقم الهوية</span>
            {!! Form::text('sid',null,['class'=>'form-control txtinput-required ']) !!}
            @if ($errors->has('sid'))
                <span class="help-block error">{{ $errors->first('sid') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="row border border-green border-margin-5">
            {!! Form::text('beneficiary_id',isset($result->id)?$result->id:"0",['class'=>'hidden beneficiary_id txtinput-required']) !!}
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
                    <span class="">Second Name* - الاسم الأب</span>
                    {!! Form::text('sname',null,['class'=>'form-control    ']) !!}
                    @if ($errors->has('sname'))
                        <span class="help-block error">{{ $errors->first('sname') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group input-wlbl  @if ($errors->has('tname')) has-error @endif">
                    <span class="">Third Name*- اسم الجد</span>
                    {!! Form::text('tname',null,['class'=>'form-control   ']) !!}
                    @if ($errors->has('tname'))
                        <span class="help-block error">{{ $errors->first('tname') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group input-wlbl  @if ($errors->has('faname')) has-error @endif">
                    <span class="">Last  Name* - العائلة</span>
                    {!! Form::text('faname',null,['class'=>'form-control txtinput-required   ']) !!}
                    @if ($errors->has('faname'))
                        <span class="help-block error">{{ $errors->first('faname') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group input-wlbl  @if ($errors->has('fname_ar')) has-error @endif">
                    <span class="">First Name_ar* - الاسم الاول عربي</span>
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
                    <span class="">Last Name_ar* العائلة عربي</span>
                    {!! Form::text('faname_ar',null,['class'=>'form-control txtinput-required arabic  ']) !!}
                    @if ($errors->has('faname_ar'))
                        <span class="help-block error">{{ $errors->first('faname_ar') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('address')) has-error @endif">
            <span class="lblinput">Address</span>


            {!! Form::text('address - العنوان',null,['class'=>'form-control  txtinput-required  ']) !!}
            @if ($errors->has('address'))
                <span class="help-block error">{{ $errors->first('address') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('relation')) has-error @endif">
            <span class="lblinput">Relation -  العلاقة</span>

            {!! Form::select('relation',$relation,null,['class'=>'form-control txtinput-required txtinput']) !!}
            @if ($errors->has('relation'))
                <span class="help-block error">{{ $errors->first('relation') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl @if ($errors->has('bod')) has-error @endif">
            <span class="">Date of Birth - تاريخ الميلاد</span>

            <div class="input-group input-medium  date date-picker"
                 data-date-format="yyyy-mm-dd"
                 data-date-viewmode="years">
                {!! Form::text('bod',null,['class'=>'form-control']) !!}
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
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('work')) has-error @endif">
            <span class="">Work - العمل</span>
            {!! Form::text('work',null,['class'=>'form-control    ']) !!}
            @if ($errors->has('work'))
                <span class="help-block error">{{ $errors->first('work') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('chronic_disease')) has-error @endif">
            <span class="">Chronic Disease -امراض مزمنة</span>
            {!! Form::select('chronic_disease',$chronic_disease,null,['class'=>'form-control select2  txtinput']) !!}
            @if ($errors->has('chronic_disease'))
                <span class="help-block error">{{ $errors->first('chronic_disease') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('active_disease')) has-error @endif">
            <span class="">Active Disease -أمراض حالية</span>
            {!! Form::select('active_disease',$active_disease,null,['class'=>'form-control select2  txtinput']) !!}
            @if ($errors->has('active_disease '))
                <span class="help-block error">{{ $errors->first('active_disease') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6 ">
        <div class="form-group input-wlbl  @if ($errors->has('activate')) has-error @endif">
            <span class="">Activate -تفعيل</span>
            {!! Form::checkbox('activate')!!}

            @if ($errors->has('activate'))
                <span class="help-block error">{{ $errors->first('activate') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group input-wlbl @if ($errors->has('active_date')) has-error @endif">
            <span class="">Activate Date - تاريخ التفعيل</span>

            <div class="input-group input-medium  date date-picker"
                 data-date-format="yyyy-mm-dd"
                 data-date-viewmode="years">
                {!! Form::text('active_date',null,['class'=>'form-control']) !!}
                <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
            </div>
            @if ($errors->has('active_date'))
                <span class="help-block error">{{ $errors->first('active_date') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('card_no')) has-error @endif">
            <span class="">Card No - رقم الكرت</span>
            {!! Form::text('card_no',null,['class'=>'form-control    ']) !!}
            @if ($errors->has('card_no'))
                <span class="help-block error">{{ $errors->first('card_no') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('payment_type')) has-error @endif">
            <span class=""> Payment Type - نوع الدفع</span>
            {!! Form::select('payment_type',$payment_type,null,['class'=>'form-control select2  txtinput']) !!}
            @if ($errors->has('payment_type'))
                <span class="help-block error">{{ $errors->first('payment_type') }}</span>
            @endif
        </div>
    </div>



    <div class="col-md-12 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('icon')) has-error @endif">
            <span class=" ">Beneficiary  Attachment -مرفقات </span>
            <div class=" uploading alert alert-default hidden text-center"><span
                        class="glyphicon glyphicon-cloud-upload">Uploading....</span>
            </div>

            <div class="profile-userpic">


                <div class="upload-beneficiary-att">

                    {!! Form::text('fff','1.jpg',['class'=>'hidden from-control  icon ']) !!}

                    <input type="file" name="image" class="  upload-beneficiary-att" id="0" accept="*/*"/>

                </div>

            </div>
        </div>
    </div>


</div>

                                           
                                              
                                    
                                   