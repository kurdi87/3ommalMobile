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
                    <a href="{{ config('app.cp_route_name')}}{{($type==0||$isreferralevent==1)?'/event':'/event/viewR' }}"
                       class="btn btn-circle btnب-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    @if(isset($result) && $type=="3")
                        <a title="Print Referral Form "
                           class=" btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered"
                           href="{{ config('app.cp_route_name')}}/event/referralForm/{{$result->id}}" target="_blank">
                            <i class="fa fa-print"></i>
                        </a>
                    @endif
                    <a href="javascript:;"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info print" title="print">
                        <i class="fa fa-print"></i>
                    </a>
                    @if(isset($result))
                        <a title="Create Admission"
                           class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered"
                           href="{{ config('app.cp_route_name')}}/admission/create?event_id={{$result->id}}">
                            <i class="fa fa-space-shuttle"></i>
                        </a>
                    @endif

                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>{{($type==0||$isreferralevent==1)?'Event ':'Referral '}}
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
                                                        Patient Information
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
                                                                       class="control-label">Patient</label>
                                                                <select id="patient_id" name="patient_id"
                                                                        class="form-control select2 patient{{$type}}" {{(isset($patient->id)? 'readonly':Null)}}>
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
                                                                        <span class="">Document No</span>
                                                                        <p>{{isset($patient->sid)?$patient->sid:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Document Type</span>
                                                                        <p>{{isset($patient->dtype)?\App\Models\TypesModel::getTypeName($patient->dtype):Null}}</p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">File Number</span>
                                                                        <p>{{isset($patient->file_no)?$patient->file_no:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">First Name</span>
                                                                        <p>{{isset($patient->fname)?$patient->fname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name</span>
                                                                        <p>{{isset($patient->sname)?$patient->sname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name</span>
                                                                        <p>{{isset($patient->faname)?$patient->faname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        {!! Form::text('appointment_id',isset($appointment_id)?$appointment_id:0,['class'=>'form-control hidden ']) !!}
                                                                        {!! Form::text('accident_id',isset($accident_id)?$accident_id:0,['class'=>'form-control hidden ']) !!}
                                                                        {!! Form::text('accident_patient_id',isset($accident_patient)?$accident_patient->id:0,['class'=>'form-control hidden ']) !!}

                                                                        {!! Form::text('gop_id',isset($gop_id)?$gop_id:0,['class'=>'form-control hidden ']) !!}
                                                                        {!! Form::text('exception_id',isset($exception_id)?$exception_id:0,['class'=>'form-control hidden ']) !!}
                                                                        <span class="">First Name Ar</span>
                                                                        <p>{{isset($patient->fname_ar)?$patient->fname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name Ar</span>
                                                                        <p>{{isset($patient->sname)?$patient->sname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name Ar</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name Ar</span>
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
                                                                                <span class="">Date of Birth</span>
                                                                                <p>{{  isset($patient->bod)? date('Y-m-d', strtotime($patient->bod)):Null}}</p>

                                                                            </div>


                                                                        </div>
                                                                        <div class="col-md-6 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Place of Birth</span>
                                                                                <p>{{isset($patient->birth_place)? \App\Models\CountryModel::getCountryname($patient->bodplace) :Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Title</span>
                                                                                <p>{{isset($patient->title)?\App\Models\TypesModel::getTypeName($patient->tilte):Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Gender</span>
                                                                                <p>{{isset($patient->gender)?\App\Models\TypesModel::getTypeName($patient->gender):Null}}</p>

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Blood</span>
                                                                                <p>{{isset($patient->blood)?\App\Models\TypesModel::getTypeName($patient->blood):Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 hidden">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('image')) has-error @endif">
                                                                        <span class=""> Image</span>
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

                                            <div class="EventInfo {{isset($patient->id)?Null:'hidden'}}">
                                                <div class="col-md-12">
                                                    <div class="portlet box red ">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                Hospital Information
                                                            </div>
                                                            @php
                                                                if(isset($appointment_id) && $appointment_id!=0)
                                                             $appointment= \App\Models\AppointmentModel::find($appointment_id);
                                                                  if(isset($gop_id) && $gop_id!=0)
                                                             $appointment= \App\Models\GopModel::find($gop_id);
                                                             if(isset($exception_id) && $exception_id!=0)
                                                             $appointment= \App\Models\ExceptionModel::find($exception_id);
                                                             if(isset($accident_patient))
                                                             $appointment=$accident_patient ;

                                                            @endphp
                                                            <div class="tools">
                                                                <a href="javascript:;" class="collapse"> </a>
                                                            </div>
                                                        </div>

                                                        <div class="portlet-body collapse-body padding-15-all">
                                                            <div class="row">

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('hospital_id')) has-error @endif">
                                                                        <span class="">Hospital</span>
                                                                        {!! Form::select('hospital_id',$hospital,isset($appointment)?$appointment->hospital_id:null,['class'=>'form-control  select2  txtinput']) !!}
                                                                        @if ($errors->has('hospital_id'))
                                                                            <span class="help-block error">{{ $errors->first('hospital_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                                        <span class="">Department</span>
                                                                        {!! Form::select('department_id',$department,isset($appointment)?$appointment->department_id:null,['class'=>'form-control select2  txtinput']) !!}
                                                                        @if ($errors->has('department_id'))
                                                                            <span class="help-block error">{{ $errors->first('department_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('doctor_id')) has-error @endif">
                                                                        <span class="">Specialist </span>
                                                                        {!! Form::select('doctor_id',$doctor,isset($appointment)?$appointment->doctor_id:null,['class'=>'form-control txtinput select2']) !!}
                                                                        @if ($errors->has('doctor_id'))
                                                                            <span class="help-block error">{{ $errors->first('doctor_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('resident_doctor')) has-error @endif">
                                                                        <span class="">Resident Doctor </span>
                                                                        {!! Form::select('resident_doctor',$doctor,isset($appointment)?$appointment->doctor_id:null,['class'=>'form-control txtinput select2']) !!}
                                                                        @if ($errors->has('resident_doctor'))
                                                                            <span class="help-block error">{{ $errors->first('resident_doctor') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @if (isset($accident_id)&&$accident_id>0)
                                                                    @php
                                                                        $accident_patient=  \App\Models\AccidentPatientModel::where('accident_id',$accident_id)->where('patient_id',$patient->id)->where('active',1)->get()->first()
                                                                    @endphp
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('injury')) has-error @endif">
                                                                        <span class="">Injury Type - طبيعة الإصابة</span>

                                                                        {!! Form::select('injury',$injury,$accident_patient->injury,['class'=>'form-control select2 patientchoose   txtinput  ']) !!}
                                                                        @if ($errors->has('injury'))
                                                                            <span class="help-block error">{{ $errors->first('injury') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('result')) has-error @endif">
                                                                        <span class=""> Accident Result - نتائج الحادث  </span>
                                                                        {!! Form::select('result',$aresult,$accident_patient->result,['class'=>'form-control  txtinput  ']) !!}
                                                                        @if ($errors->has('status'))
                                                                            <span class="help-block error">{{ $errors->first('result') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @endif



                                                                @if ( isset($appointment_id) && $appointment_id!=0)
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">

                                                                            <span class="">Appointment ID</span>
                                                                            {!! Form::text('appointment_id',isset($appointment_id)?$appointment_id:0,['class'=>'form-control',"readonly"]) !!}

                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(in_array($role,$create_edit))
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl  @if ($errors->has('isreferralevent')) has-error @endif">
                                                                            <span class="">Referral and Event</span>

                                                                            {!! Form::checkbox('isreferralevent')!!}
                                                                            @if ($errors->has('isreferralevent'))
                                                                                <span class="help-block error">{{ $errors->first('isreferralevent') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="portlet box green ">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                Coverage Information
                                                            </div>
                                                            <div class="tools">
                                                                <a href="javascript:;" class="collapse"> </a>
                                                            </div>
                                                        </div>

                                                        <div class="portlet-body collapse-body padding-15-all">

                                                            <div class="row">
                                                                <div class="col-md-3 {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('coverage_no')) has-error @endif">
                                                                        <span class="">Coverage No</span>

                                                                        {!! Form::text('type',isset($type)?$type:0,['class'=>'form-control hidden ']) !!}
                                                                        {!! Form::text('coverage_no',null,['class'=>'form-control']) !!}
                                                                        @if ($errors->has('coverage_no'))
                                                                            <span class="help-block error">{{ $errors->first('coverage_no') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3  ">
                                                                    <div class="form-group">
                                                                        <label for="single" class="control-label">Financing
                                                                            Party</label>
                                                                        <select id="finance_party"
                                                                                name="finance_party"
                                                                                class="form-control select2 ">
                                                                            <option></option>
                                                                            <optgroup label="Financing Party">
                                                                                @foreach($finance_party as $c)
                                                                                    <option {{(isset($result->finance_party) && ($result->finance_party==$c->id)?'selected':(isset($appointment)&&$appointment->finance_party==$c->id ?'selected':null))}}  value="{{$c->id}}">{{$c->name}}</option>
                                                                                @endforeach
                                                                            </optgroup>


                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @if(in_array($role,$create_edit))
                                                                    <div class="col-md-3  ">
                                                                        <div class="form-group">
                                                                            <label for="single" class="control-label">Referral
                                                                                Agent</label>
                                                                            <select id="agent" name="agent"
                                                                                    class="form-control select2 ">
                                                                                <option></option>
                                                                                <optgroup label="Referral Agent">
                                                                                    @foreach($agent as $c)
                                                                                        <option {{(isset($result->agent) && ($result->agent==$c->id)?'selected':(isset($appointment)&&$appointment->agent==$c->id ?'selected':null))}} value="{{$c->id}}">{{$c->name}}</option>
                                                                                    @endforeach
                                                                                </optgroup>


                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-3 {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('coverage_type')) has-error @endif">
                                                                        <span class="">Coverage Type</span>
                                                                        {!! Form::select('coverage_type',$coverageType,null,['class'=>'form-control  txtinput']) !!}
                                                                        @if ($errors->has('coverage_type'))
                                                                            <span class="help-block error">{{ $errors->first('coverage_type') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('coverage_cost')) has-error @endif">
                                                                        <span class="">{{($type==0||$isreferralevent==1)?'Coverage Cost':'Cost of Treatment'}}</span>
                                                                        {!! Form::text('coverage_cost',isset($appointment)?$appointment->approved_cost:null,['class'=>'form-control']) !!}
                                                                        @if ($errors->has('coverage_cost'))
                                                                            <span class="help-block error">{{ $errors->first('coverage_cost') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <div class="form-group input-wlbl @if ($errors->has('coverage_date')) has-error @endif">
                                                                        <span class="">Service Date</span>

                                                                        <div class="input-group input-medium  date date-picker"
                                                                             data-date-format="yyyy-mm-dd"
                                                                             data-date-viewmode="years">
                                                                            {!! Form::text('coverage_date',isset($appointment)?$appointment->coverage_date:(isset($result->coverage_date)? date('Y-m-d', strtotime($result->coverage_date)):Null),['class'=>'form-control']) !!}
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
                                                                <div class="col-md-3 hidden {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('insurance_no')) has-error @endif">
                                                                        <span class="">Insurance No</span>
                                                                        {!! Form::text('insurance_no',null,['class'=>'form-control']) !!}
                                                                        @if ($errors->has('insurance_no'))
                                                                            <span class="help-block error">{{ $errors->first('insurance_no') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 hidden {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('insurance_status')) has-error @endif">
                                                                        <span class="">Insurance Status</span>

                                                                        {!! Form::select('insurance_status',$insurance_status,null,['class'=>'form-control txtinput']) !!}
                                                                        @if ($errors->has('insurance_status'))
                                                                            <span class="help-block error">{{ $errors->first('insurance_status') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3  hidden {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('insurance_type')) has-error @endif">
                                                                        <span class="">Insurance Type</span>

                                                                        {!! Form::select('insurance_type',$insurance_type,null,['class'=>'form-control  txtinput']) !!}
                                                                        @if ($errors->has('insurance_type'))
                                                                            <span class="help-block error">{{ $errors->first('insurance_type') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 hidden {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('insurance_cov')) has-error @endif">
                                                                        <span class="">insurance Percenatge %</span>
                                                                        {!! Form::text('insurance_cov',null,['class'=>'form-control']) !!}
                                                                        @if ($errors->has('insurance_cov'))
                                                                            <span class="help-block error">{{ $errors->first('insurance_cov') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-3 hidden {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl @if ($errors->has('insurance_date')) has-error @endif">
                                                                        <span class="">Insurance Date</span>

                                                                        <div class="input-group input-large date-picker input-daterange"
                                                                             data-date="10/11/2012"
                                                                             data-date-format="yyyy/mm/dd">
                                                                            {!! Form::text('insurance_date',isset($result->insurance_date)? date('Y-m-d', strtotime($result->insurance_date)):Null,['class'=>'form-control']) !!}
                                                                            <span class="input-group-addon"> to </span>
                                                                        {!! Form::text('insurance_exdate',isset($result->insurance_exdate)? date('Y-m-d', strtotime($result->insurance_exdate)):Null,['class'=>'form-control']) !!}
                                                                        <!-- /input-group -->

                                                                        </div>
                                                                        @if ($errors->has('insurance_date'))
                                                                            <span class="help-block error">{{ $errors->first('insurance_date') }}</span>
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
                                                                {{($type==0||$isreferralevent==1)?'Event Information':'Referral Information'}}
                                                            </div>
                                                            <div class="tools">
                                                                <a href="javascript:;" class="collapse"> </a>

                                                            </div>
                                                        </div>


                                                        <div class="portlet-body  padding-15-all">

                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('referral_type')) has-error @endif">
                                                                        <span class="">Referral Type</span>

                                                                        {!! Form::select('referral_type',$referral_type,null,['class'=>'form-control txtinput']) !!}
                                                                        @if ($errors->has('referral_type'))
                                                                            <span class="help-block error">{{ $errors->first('referral_type') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('service_type')) has-error @endif">
                                                                        <span class="">Service Type</span>

                                                                        {!! Form::select('service_type',$service_type,null,['class'=>'form-control  txtinput']) !!}
                                                                        @if ($errors->has('service_type'))
                                                                            <span class="help-block error">{{ $errors->first('service_type') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('referral_hospital')) has-error @endif">
                                                                        <span class="">Referring Hospital </span>

                                                                        {!! Form::select('referral_hospital',$hospital,null,['class'=>'form-control   select2']) !!}
                                                                        @if ($errors->has('referral_hospital'))
                                                                            <span class="help-block error">{{ $errors->first('referral_hospital') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('treat_doctor')) has-error @endif">
                                                                        <span class="">Treating Doctor</span>

                                                                        {!! Form::select('treat_doctor',$doctor,null,['class'=>'form-control   select2']) !!}
                                                                        @if ($errors->has('treat_doctor'))
                                                                            <span class="help-block error">{{ $errors->first('treat_doctor') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @if(in_array($role,[1]))
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="single"
                                                                                   class="control-label ">Employee</label>
                                                                            {!! Form::select('employee',$employee,null,['class'=>'form-control  txtinput','id'=>'emplyee']) !!}
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-3 hidden">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Employee</span>
                                                                            {!! Form::text('employee',(isset($result->employee)&&$result->employee!=0)?($result->employee):\App\Models\EmployeeModel::getEmployeeFormUser(\Auth::user("admin")->SysUsr_ID)->id,['class'=>'form-control  txtinput hidden','id'=>'emplyee']) !!}

                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(in_array($role,$create_edit))
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl  @if ($errors->has('comission')) has-error @endif">
                                                                            <span class="">Subject to Comission</span>

                                                                            {!! Form::checkbox('comission')!!}
                                                                            @if ($errors->has('comission'))
                                                                                <span class="help-block error">{{ $errors->first('comission') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-3 {{($type==0||$isreferralevent==1)?' ':'hidden '}}">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('event_no')) has-error @endif">
                                                                        <span class="">Event No</span>
                                                                        {!! Form::text('event_no',null,['class'=>'form-control']) !!}
                                                                        @if ($errors->has('event_no'))
                                                                            <span class="help-block error">{{ $errors->first('event_no') }}</span>
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


</div>
