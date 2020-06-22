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

                    <a href="{{ config('app.cp_route_name') }}/exception"
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
                                <i class="icon-globe">Exception</i>
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
                                                                        <span class="">Document No - رقم الهوية</span>
                                                                        <p>{{isset($patient->sid)?$patient->sid:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Document Type - نوع الهوية</span>
                                                                        <p>{{isset($patient->dtype)?\App\Models\TypesModel::getTypeName($patient->dtype):Null}}</p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">File Number - رقم الملف</span>
                                                                        <p>{{isset($patient->file_no)?$patient->file_no:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">First Name - الاسم الأول</span>
                                                                        <p>{{isset($patient->fname)?$patient->fname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name - اسم الأب</span>
                                                                        <p>{{isset($patient->sname)?$patient->sname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name - اسم الجد</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name - العائلة</span>
                                                                        <p>{{isset($patient->faname)?$patient->faname:Null}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        {!! Form::text('appointment_id',isset($appointment_id)?$appointment_id:0,['class'=>'form-control hidden ']) !!}
                                                                        {!! Form::text('gop_id',isset($gop_id)?$gop_id:0,['class'=>'form-control hidden ']) !!}
                                                                        <span class="">First Name Ar - الاسم الأول عربي</span>
                                                                        <p>{{isset($patient->fname_ar)?$patient->fname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Second Name Ar اسم الأب عربي</span>
                                                                        <p>{{isset($patient->sname)?$patient->sname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Third Name Ar اسم الجد عربي</span>
                                                                        <p>{{isset($patient->tname)?$patient->tname_ar:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Last Name Ar العائلة عربي </span>
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
                                                                                <span class="">Date of Birth - تاريخ الميلاد</span>
                                                                                <p>{{  isset($patient->bod)? date('Y-m-d', strtotime($patient->bod)):Null}}</p>

                                                                            </div>


                                                                        </div>
                                                                        <div class="col-md-6 hidden">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Place of Birth - مكان الميلاد</span>
                                                                                <p>{{isset($patient->birth_place)? \App\Models\CountryModel::getCountryname($patient->bodplace) :Null}}</p>

                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-4">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Gender - الجنس</span>
                                                                                <p>{{isset($patient->gender)?\App\Models\TypesModel::getTypeName($patient->gender):Null}}</p>

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
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

                                            <div class="ExceptionInfo {{isset($patient->id)?Null:'hidden'}}">
                                                <div class="col-md-12">
                                                    <div class="portlet box red ">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                Hospital Information -المستشفى
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
                                                                        {!! Form::select('hospital_id',$hospital,null,['class'=>'form-control txtinput-required select2  txtinput']) !!}
                                                                        @if ($errors->has('hospital_id'))
                                                                            <span class="help-block error">{{ $errors->first('hospital_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                                        <span class="">Department - القسم</span>
                                                                        {!! Form::select('department_id',$department,null,['class'=>'form-control select2  txtinput']) !!}
                                                                        @if ($errors->has('department_id'))
                                                                            <span class="help-block error">{{ $errors->first('department_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('doctor_id')) has-error @endif">
                                                                        <span class="">Doctor - الطبيب</span>
                                                                        {!! Form::select('doctor_id',$doctor,null,['class'=>'form-control txtinput select2']) !!}
                                                                        @if ($errors->has('doctor_id'))
                                                                            <span class="help-block error">{{ $errors->first('doctor_id') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('finance_party')) has-error @endif">
                                                                        <span class="">Approving Party - المسؤول</span>
                                                                        {!! Form::select('finance_party',$finance_party,null,['class'=>'form-control txtinput select2']) !!}
                                                                        @if ($errors->has('finance_party'))
                                                                            <span class="help-block error">{{ $errors->first('finance_party') }}</span>
                                                                        @endif
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
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl @if ($errors->has('coverage_cost')) has-error @endif">
                                                                        <span class=""> Cost - التكلفة</span>

                                                                        <div class="input-group">
                                                                            {!! Form::text('coverage_cost',null,['class'=>'form-control txtinput-number  amount']) !!}

                                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-sheqel"></i>
                                                                </button>
                                                            </span>
                                                                        </div>


                                                                        @if ($errors->has('coverage_cost'))
                                                                            <span class="help-block error">{{ $errors->first('coverage_cost') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
                                                                        <span class=""> Approval - حالة الموافقة</span>
                                                                        {!! Form::select('status',$status,null,['class'=>'form-control txtinput select2']) !!}
                                                                        @if ($errors->has('status'))
                                                                            <span class="help-block error">{{ $errors->first('status') }}</span>
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
    