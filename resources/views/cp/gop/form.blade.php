@php
    if(isset($appointment_id) && $appointment_id!=0)
    $appointment= \App\Models\AppointmentModel::find($appointment_id);
    if(isset($exception_id) && $exception_id!=0)
    $appointment= \App\Models\ExceptionModel::find($exception_id);

@endphp
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" data-toggle="confirmation" data-popout="true"
                            class="btn btn-circle btn-icon-only btn-default"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" data-toggle="confirmation" data-popout="true" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew "
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/gop"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    @if (isset($result->id))
                        <a href="{{ config('app.cp_route_name') }}/gop/GopPrint/{{$result->id}}"
                           class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                            <i class="fa fa-print"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Request for GOP -طلب ضمانة دفع
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet box yellow  ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Patient Information - معلومات المريض
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body  padding-15-all">
                                                    <div class="row">
                                                        <div class="col-md-12  {{(isset($patient->id)? 'hidden':Null)}}">
                                                            <div class="form-group">
                                                                <label for="single"
                                                                       class="control-label">Patient - المريض</label>
                                                                <select id="patient_id" name="patient_id"
                                                                        class="form-control select2 patient" {{(isset($patient->id)? 'readonly':Null)}}>
                                                                    <option></option>
                                                                    <optgroup label="Patients">
                                                                        @foreach($patients as $p)
                                                                            <option {{(isset($patient->id) && ($patient->id==$p->id)?'selected':Null)}} value="{{$p->id}}">{{$p->fname." ".$p->faname."ID (".$p->sid.")"}}</option>
                                                                        @endforeach
                                                                    </optgroup>


                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">


                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Document No - رقم المف</span>
                                                                        <p>{{isset($patient->sid)?$patient->sid:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Document Type -  نوع الملف</span>
                                                                        <p>{{isset($patient->dtype)?\App\Models\TypesModel::getTypeName($patient->dtype):Null}}</p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">File Number- رقم الملف </span>
                                                                        <p>{{isset($patient->file_no)?$patient->file_no:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">First Name -  الإسم الأول</span>
                                                                        -
                                                                        <p>{{isset($patient->fname)?$patient->fname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name - الإسم الثاني</span>
                                                                        <p>{{isset($patient->sname)?$patient->sname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name - الإسم الثالث</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name - الإسم الأخير</span>
                                                                        <p>{{isset($patient->faname)?$patient->faname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        {!! Form::text('gop_id',isset($gop_id)?$gop_id:0,['class'=>'form-control hidden ']) !!}
                                                                        <span class="">First Name Ar - الإسم الأول</span>
                                                                        <p>{{isset($patient->fname_ar)?$patient->fname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name Ar-  الاسم الثاني </span>
                                                                        <p>{{isset($patient->sname)?$patient->sname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name Ar- الإسم الثالث</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name Ar- اسم العائلة</span>
                                                                        <p>{{isset($patient->faname)?$patient->faname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Date of Birth - تاريهح الميلاد</span>
                                                                                <p>{{  isset($patient->bod)? date('Y-m-d', strtotime($patient->bod)):Null}}</p>

                                                                            </div>


                                                                        </div>
                                                                        <div class="col-md-6 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Place of Birth - مكان الميلاد</span>
                                                                                <p>{{isset($patient->birth_place)? \App\Models\CountryModel::getCountryname($patient->bodplace) :Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Title - المسمى</span>
                                                                                <p>{{isset($patient->title)?\App\Models\TypesModel::getTypeName($patient->tilte):Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Gender - الجنس</span>
                                                                                <p>{{isset($patient->gender)?\App\Models\TypesModel::getTypeName($patient->gender):Null}}</p>

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Blood - فصيلة الدم</span>
                                                                                <p>{{isset($patient->blood)?\App\Models\TypesModel::getTypeName($patient->blood):Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 hidden">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('image')) has-error @endif">
                                                                        <span class=""> Image - الصورة</span>
                                                                        <div class="profile-userpic">
                                                                            <div class="upload-admission-img"
                                                                                 style="{{ isset($patient->image)?"background-image:url(img/patient/".$patient->image.")":""}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">


                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="gopInfo {{isset($patient->id)?Null:'hidden'}}">
                                            <div class="col-md-12">
                                                <div class="portlet box red ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Hospital Information - المشفى
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('hospital_id')) has-error @endif">
                                                                    <span class="">Hospital - المستشفى</span>
                                                                    {!! Form::select('hospital_id',$hospital,isset($appointment)?$appointment->hospital_id:null,['class'=>'form-control   txtinput select2']) !!}
                                                                    @if ($errors->has('hospital_id'))
                                                                        <span class="help-block error">{{ $errors->first('hospital_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('doctor_id')) has-error @endif">
                                                                    <span class="">Doctor - الطبيب</span>
                                                                    {!! Form::text('appointment_id',isset($appointment_id)?$appointment_id:0,['class'=>' hidden form-control',"readonly"]) !!}
                                                                    {!! Form::text('exception_id',isset($exception_id)?$exception_id:0,['class'=>' hidden form-control',"readonly"]) !!}
                                                                    {!! Form::select('doctor_id',$doctor,isset($appointment)?$appointment->doctor_id:null,['class'=>'form-control txtinput select2']) !!}
                                                                    @if ($errors->has('doctor_id'))
                                                                        <span class="help-block error">{{ $errors->first('doctor_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                                    <span class="">Department - القسم</span>
                                                                    {!! Form::select('department_id',$department,isset($appointment)?$appointment->department_id:null,['class'=>'form-control  txtinput select2']) !!}
                                                                    @if ($errors->has('department_id'))
                                                                        <span class="help-block error">{{ $errors->first('department_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="portlet box green ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Request for GOP Information - معلومات الضمانة
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">

                                                        <div class="row">


                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="single" class="control-label">Financing
                                                                        Party - التأمين</label>
                                                                    <select id="finance_party" name="finance_party"
                                                                            class="form-control select2 ">
                                                                        <option></option>
                                                                        <optgroup label="Financing Party">
                                                                            @foreach($finance_party as $c)
                                                                                <option {{((isset($result->finance_party) && ($result->finance_party==$c->id ))||(isset($appointment)&&$appointment->finance_party==$c->id))?'selected':Null}} value="{{$c->id}}">{{$c->name}}</option>
                                                                            @endforeach
                                                                        </optgroup>


                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 {{in_array($role,$spu)? 'hidden':''}}">
                                                                <div class="form-group">
                                                                    <label for="single" class="control-label">
                                                                        Referral Agent - العميل</label>
                                                                    <select id="agent" name="agent"
                                                                            class="form-control select2 ">
                                                                        <option></option>
                                                                        <optgroup label="Referral Agent">
                                                                            @foreach($agent as $c)
                                                                                <option {{((isset($result->agent) && ($result->agent==$c->id ))||(isset($appointment)&&$appointment->agent==$c->id))?'selected':Null}} value="{{$c->id}}">{{$c->name}}</option>
                                                                            @endforeach
                                                                        </optgroup>


                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl @if ($errors->has('coverage_date')) has-error @endif">
                                                                    <span class="">Service date - تاريخ الخدمة</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('coverage_date',isset($result->coverage_date)? date('Y-m-d', strtotime($result->coverage_date)):Null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                                    </div>
                                                                    @if ($errors->has('coverage_date'))
                                                                        <span class="help-block error">{{ $errors->first('coverage_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ( isset($result->appointment_id) && $result->appointment_id!=0)
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">

                                                                        <span class="">Appointment ID - الموعد</span>
                                                                        {!! Form::text('xx',isset($result->appointment_id)?$result->appointment_id:0,['class'=>'form-control',"readonly"]) !!}

                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ( isset($result->exception_id) && $result->exception_id!=0)
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">

                                                                        <span class="">Exception ID - الحالة </span>
                                                                        {!! Form::text('yy',isset($result->exception_id)?$result->exception_id:0,['class'=>'form-control',"readonly"]) !!}

                                                                    </div>
                                                                </div>
                                                            @endif


                                                            <div class="clearfix">
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-3 ">
                                                                <div class="form-group input-wlbl @if ($errors->has('action_date')) has-error @endif">
                                                                    <span class="">Request Date - تاريخ الطلب</span>
                                                                    <p class="">{{isset($result)?date('Y-m-d H:i:s',strtotime($result->action_date)):date('Y-m-d H:i:s')}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                                    <span class="">Request Type - نوع الطلب</span>
                                                                    {!! Form::select('type',$types,null,['class'=>'form-control   txtinput select2']) !!}
                                                                    @if ($errors->has('type'))
                                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                <hr>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl @if ($errors->has('approved_cost')) has-error @endif">
                                                                    <span class="">Approved Cost- التكلفة التقديرية</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('approved_cost',null,['class'=>'form-control txtinput-number  ']) !!}

                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-sheqel"></i>
                                                                </button>
                                                            </span>
                                                                    </div>


                                                                    @if ($errors->has('approved_cost'))
                                                                        <span class="help-block error">{{ $errors->first('approved_cost') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl @if ($errors->has('total_cost')) has-error @endif">
                                                                    <span class="">Total Cost - التلكلفة الإجمالية</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('total_cost',null,['class'=>'form-control txtinput-number amount']) !!}

                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-sheqel"></i>
                                                                </button>
                                                            </span>
                                                                    </div>


                                                                    @if ($errors->has('total_cost'))
                                                                        <span class="help-block error">{{ $errors->first('total_cost') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            @if(in_array($role,[1]))
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="single"
                                                                               class="control-label ">Employee -
                                                                            الموظف</label>
                                                                        {!! Form::select('employee',$employee,null,['class'=>'form-control  txtinput','id'=>'emplyee']) !!}
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-md-3 hidden">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Employee - الموظف</span>
                                                                        {!! Form::text('employee',(isset($result->employee)&&$result->employee!=0)?($result->employee):\App\Models\EmployeeModel::getEmployeeFormUser(\Auth::user("admin")->SysUsr_ID)->id,['class'=>'form-control  txtinput hidden','id'=>'emplyee']) !!}

                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('serviceType')) has-error @endif">
                                                                    <span class="">Service Type</span>
                                                                    {!! Form::select('serviceType',$services,null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('speciality_id'))
                                                                        <span class="help-block error">{{ $errors->first('serviceType') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                                    <span class="">Notes - ملاحظات</span>

                                                                    {!! Form::textarea('notes',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('notes'))
                                                                        <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                                    @endif
                                                                </div>
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



    