<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">

                <div class="actions">
                    @if(!(isset($result)&&$result->status==2))
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
                    @endif
                    <a href="{{ config('app.cp_route_name') }}/commitment"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    <a href="javascript:;"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info print" title="print">
                        <i class="fa fa-print"></i>
                    </a>
                </div>

            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Commitment - نموذج تغطية
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


                                                                <div class="col-md-4 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Document No - رقم الهوية</span>
                                                                        <p>{{isset($patient->sid)?$patient->sid:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Document Type - نوع التعريف</span>
                                                                        <p>{{isset($patient->dtype)?\App\Models\TypesModel::getTypeName($patient->dtype):Null}}</p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">File Number - رقم الملف</span>
                                                                        <p>{{isset($patient->file_no)?$patient->file_no:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">First Name  </span>
                                                                        <p>{{isset($patient->fname)?$patient->fname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name</span>
                                                                        <p>{{isset($patient->sname)?$patient->sname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name</span>
                                                                        <p>{{isset($patient->faname)?$patient->faname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        {!! Form::text('appointment_id',isset($appointment_id)?$appointment_id:0,['class'=>'form-control hidden ']) !!}
                                                                        <span class="">First Name Ar -الاسم الأول </span>
                                                                        <p>{{isset($patient->fname_ar)?$patient->fname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name Ar -الإسم الأب </span>
                                                                        <p>{{isset($patient->sname)?$patient->sname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name Ar - اسم الجد</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name Ar - العائلة</span>
                                                                        <p>{{isset($patient->faname)?$patient->faname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Date of Birth -تاريخ الميلاد </span>
                                                                                <p>{{  isset($patient->bod)? date('Y-m-d', strtotime($patient->bod)):Null}}</p>

                                                                            </div>


                                                                        </div>
                                                                        <div class="col-md-3 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Place of Birth - مكان الميلاد</span>
                                                                                <p>{{isset($patient->birth_place)? \App\Models\CountryModel::getCountryname($patient->bodplace) :Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3 col-xs-6 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Title - المسمى</span>
                                                                                <p>{{isset($patient->title)?\App\Models\TypesModel::getTypeName($patient->tilte):Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3 col-xs-6 ">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Gender - الجنس</span>
                                                                                <p>{{isset($patient->gender)?\App\Models\TypesModel::getTypeName($patient->gender):Null}}</p>

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4 col-xs-6 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Blood - الدم</span>
                                                                                <p>{{isset($patient->blood)?\App\Models\TypesModel::getTypeName($patient->blood):Null}}</p>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 hidden">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('image')) has-error @endif">
                                                                        <span class=""> Image - صورة شخصية</span>
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
                                        <div class="CommitmentInfo {{isset($patient->id)?Null:'hidden'}}">
                                            <div class="col-md-12">
                                                <div class="portlet box red ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Hospital Information - معلومات المستشفى
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">
                                                        <div class="row">

                                                            <div class="col-md-4 col-xs-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('hospital_id')) has-error @endif">
                                                                    <span class="">Service Provider - مزود الخدمة</span>
                                                                    {!! Form::select('hospital_id',$hospital,isset($accidentPatient)?$accidentPatient->hospital_id:null,['class'=>'form-control   txtinput select2']) !!}
                                                                    @if ($errors->has('hospital_id'))
                                                                        <span class="help-block error">{{ $errors->first('hospital_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-xs-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                                    <span class="">Department - القسم</span>
                                                                    {!! Form::select('department_id',$department,isset($appointment)?$appointment->department_id:null,['class'=>'form-control select2  txtinput']) !!}
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
                                                            Commitment Information - معلومات التغطية
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">

                                                        <div class="row">


                                                            <div class="col-md-4 col-xs-6">
                                                                <div class="form-group">
                                                                    <label for="single" class="control-label">Financing
                                                                        Party - التأمين</label>
                                                                    <select id="finance_party" name="finance_party"
                                                                            class="form-control select2 ">
                                                                        <option></option>
                                                                        <optgroup label="Financing Party">
                                                                            @foreach($finance_party as $c)
                                                                                <option {{(isset($result->finance_party) && ($result->finance_party==$c->id ||(isset($accident)&&$accident->finance_party==$c->id) )?'selected':Null)}} value="{{$c->id}}">{{$c->name}}</option>
                                                                            @endforeach
                                                                        </optgroup>


                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4 col-xs-6">
                                                                <div class="form-group input-wlbl @if ($errors->has('coverage_date')) has-error @endif">
                                                                    <span class="">Coverage Date - تاريخ إصدار التغطية</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('coverage_date',isset($result->coverage_date)? date('Y-m-d', strtotime($result->service_date)):Null,['class'=>'form-control']) !!}
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
                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl @if ($errors->has('service_date')) has-error @endif">
                                                                    <span class="">Service Date - تاريخ الخدمة</span>

                                                                    <div class="input-group input-large date-picker input-daterange"
                                                                         data-date="10/11/2012"
                                                                         data-date-format="yyyy/mm/dd">
                                                                        {!! Form::text('service_date',isset($result->service_date)? date('Y-m-d', strtotime($result->service_date)):Null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-addon"> إلى </span>
                                                                    {!! Form::text('service_date_to',isset($result->service_date_to)? date('Y-m-d', strtotime($result->service_date_to)):Null,['class'=>'form-control']) !!}
                                                                    <!-- /input-group -->

                                                                    </div>
                                                                    @if ($errors->has('service_date'))
                                                                        <span class="help-block error">{{ $errors->first('service_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>


                                                            <div class="col-md-4 col-xs-12">
                                                                <div class="form-group input-wlbl @if ($errors->has('amount')) has-error @endif">
                                                                    <span class="">Amount - الحد الأعلى للتغطية</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('amount',isset($accidentPatient)?$accidentPatient->estimated_cost:null,['class'=>'form-control txtinput-number amount ']) !!}

                                                                        <span class="input-group-btn btn-right">
                                                                         {!! Form::select('currency',$currences,isset($result->currency)?$result->currency:90,['class'=>'btn green  dropdown-toggle']) !!}
                                                                        </span>
                                                                    </div>


                                                                    @if ($errors->has('Amount'))
                                                                        <span class="help-block error">{{ $errors->first('Amount') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-xs-12">
                                                                <div class="form-group input-wlbl @if ($errors->has('est_amount')) has-error @endif">
                                                                    <span class="">Estimated Amount -  الحد الأعلى التقديري للتغطية</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('est_amount',isset($accidentPatient)?$accidentPatient->estimated_cost:null,['class'=>'form-control txtinput-number  ']) !!}

                                                                        <span class="input-group-btn btn-right">
                                                                         {!! Form::select('currency',$currences,isset($result->currency)?$result->currency:90,['class'=>'btn green  dropdown-toggle']) !!}
                                                                        </span>
                                                                    </div>


                                                                    @if ($errors->has('est_amount'))
                                                                        <span class="help-block error">{{ $errors->first('est_amount') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>




                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('serviceType')) has-error @endif">
                                                                    <span class="">Service Type - نوع الخدمة</span>
                                                                    {!! Form::select('serviceType',$services,null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('speciality_id'))
                                                                        <span class="help-block error">{{ $errors->first('serviceType') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('city_id')) has-error @endif">
                                                                    <span class=""> City of Accident - المدينة</span>
                                                                    {!! Form::select('city_id',$city,isset($accident)?$accident->city:null,['class'=>'form-control  select2 txtinput  ']) !!}
                                                                    @if ($errors->has('city_id'))
                                                                        <span class="help-block error">{{ $errors->first('city_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('is_paid')) has-error @endif">
                                                                    <span class="">is paied? - تم الدفع</span>
                                                                    {!! Form::checkbox('is_paid')!!}

                                                                    @if ($errors->has('is_paid'))
                                                                        <span class="help-block error">{{ $errors->first('is_paid') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('claim_no')) has-error @endif">
                                                                    <span class="">Claim No - رقم الادعاء</span>

                                                                    {!! Form::select('claim_no',$claim,isset($accident)?$accident->claim_no:null,['class'=>'form-control select2']) !!}

                                                                    @if ($errors->has('claim_no'))
                                                                        <span class="help-block error">{{ $errors->first('claim_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-12 {{isset($result)&&strlen($result->claim_no)>1?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('claim_no')) has-error @endif">
                                                                    <span class="">Acciden ID - رقم الحادث</span>


                                                                    {!! Form::select('accident_id',$accident_ids,isset($accident)?$accident->id:null,['class'=>'form-control ']) !!}
                                                                    @if ($errors->has('claim_no'))
                                                                        <span class="help-block error">{{ $errors->first('claim_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('other_notes')) has-error @endif">
                                                                    <span class="">Comments -التعليقات</span>

                                                                    {!! Form::select('other_notes[]',$other_notes,isset($result->other_notes)?explode(",",$result->other_notes):null,['class'=>'form-control select2','multiple'=>'multiple','placehoder'=>'select comment']) !!}
                                                                    @if ($errors->has('other_notes'))
                                                                        <span class="help-block error">{{ $errors->first('other_notes') }}</span>
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



    