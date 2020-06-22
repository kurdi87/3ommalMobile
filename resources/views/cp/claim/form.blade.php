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
                    <a href="{{ config('app.cp_route_name') }}/claim"
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
                                <i class="icon-globe"></i>claim
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
                                                                        {!! Form::text('invoice_id',isset($invoice_id)?$invoice_id:0,['class'=>'form-control hidden ']) !!}
                                                                        {!! Form::text('accident_id',isset($accident_id)?$accident_id:0,['class'=>'form-control hidden ']) !!}
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
                                        </div>
                                        <div class="claimInfo {{isset($patient->id)?Null:'hidden'}}">


                                            <div class="col-md-12">
                                                <div class="portlet box green ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            claim Information
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
                                                                        Party</label>
                                                                    <select id="finance_party" name="finance_party"
                                                                            class="form-control select2 finance_party">
                                                                        <option></option>
                                                                        <optgroup label="Financing Party">
                                                                            @foreach($finance_party as $c)
                                                                                <option {{((isset($result->finance_party) && ($result->finance_party==$c->id) || isset($finance_party_id)&&$finance_party_id==$c->id)?'selected':Null)}} value="{{$c->id}}">{{$c->name}}</option>
                                                                            @endforeach
                                                                        </optgroup>


                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 ">
                                                                <div class="form-group input-wlbl @if ($errors->has('claim_date')) has-error @endif">
                                                                    <span class="">Claim Date</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('claim_date',isset($result->claim_date)? date('Y-m-d', strtotime($result->claim_date)):date('Y-m-d'),['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                                </span>
                                                                    </div>
                                                                    @if ($errors->has('claim_date'))
                                                                        <span class="help-block error">{{ $errors->first('claim_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="clearfix"></div>
                                                            <div class="col-md-2">
                                                                <div class="form-group input-wlbl  @if ($errors->has('qty')) has-error @endif">
                                                                    <span class="">Qty</span>
                                                                    {!! Form::text('qty',null,['class'=>'form-control number  txtinput','type'=>'number']) !!}
                                                                    @if ($errors->has('qty'))
                                                                        <span class="help-block error">{{ $errors->first('qty') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl @if ($errors->has('amount')) has-error @endif">
                                                                    <span class="">Amount</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('amount',null,['class'=>'form-control txtinput-number  ']) !!}

                                                                        <span class="input-group-btn btn-right">
                                                                         {!! Form::select('currency',$currences,isset($result->currency)?$result->currency:90,['class'=>'btn green  dropdown-toggle']) !!}
                                                                        </span>
                                                                    </div>


                                                                    @if ($errors->has('Amount'))
                                                                        <span class="help-block error">{{ $errors->first('Amount') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('serviceType')) has-error @endif">
                                                                    <span class="">Service Type</span>
                                                                    {!! Form::select('serviceType',$services,null,['class'=>'form-control select2 txtinput']) !!}
                                                                    @if ($errors->has('speciality_id'))
                                                                        <span class="help-block error">{{ $errors->first('serviceType') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="clearfix">

                                                            </div>
                                                            <div class="col-md-3 hidden">
                                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                                    <span class="">Claim Type</span>
                                                                    {!! Form::select('type',$type,null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('type'))
                                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('beneficiary')) has-error @endif">
                                                                    <span class="">beneficiary</span>
                                                                    {!! Form::select('beneficiary',$beneficiary,null,['class'=>'form-control select2 txtinput']) !!}
                                                                    @if ($errors->has('beneficiary'))
                                                                        <span class="help-block error">{{ $errors->first('beneficiary') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 ">
                                                                <div class="form-group input-wlbl @if ($errors->has('pay_date')) has-error @endif">
                                                                    <span class="">Payment Date</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('pay_date',isset($result->pay_date)? date('Y-m-d', strtotime($result->pay_date)):null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                                    </div>
                                                                    @if ($errors->has('pay_date'))
                                                                        <span class="help-block error">{{ $errors->first('pay_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('is_paid')) has-error @endif">
                                                                    <span class="">is paied?</span>
                                                                    {!! Form::checkbox('is_paid')!!}

                                                                    @if ($errors->has('is_paid'))
                                                                        <span class="help-block error">{{ $errors->first('is_paid') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                <hr>
                                                            </div>
                                                            @if(in_array($role,[1]))
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="single"
                                                                               class="control-label ">Employee</label>
                                                                        {!! Form::select('employee',$employee,null,['class'=>'form-control select2 txtinput','id'=>'emplyee']) !!}
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
                                                            <div class="clearfix"></div>


                                                            <div class="clearfix"></div>
                                                            @php
                                                                if(isset($accident_id))
                                                                {
                                                                    $maccident=\App\Models\AccidentModel::find($accident_id);
                                                            }
                                                            @endphp
                                                            <div class="col-md-3 ">
                                                                <div class="form-group input-wlbl @if ($errors->has('accident_date')) has-error @endif">
                                                                    <span class="">Accident Date</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('accident_date',isset($maccident)? date('Y-m-d', strtotime($maccident->accident_date)):null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                                    </div>
                                                                    @if ($errors->has('accident_date'))
                                                                        <span class="help-block error">{{ $errors->first('accident_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('accident_type')) has-error @endif">
                                                                    <span class="">Accident Type</span>
                                                                    {!! Form::select('accident_type',$accident_type,isset($maccident)?$maccident->type:null ,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('type'))
                                                                        <span class="help-block error">{{ $errors->first('accident_type') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('branch_name')) has-error @endif">
                                                                    <span class="">Branch name</span>
                                                                    {!! Form::text('branch_name',isset($maccident)?$maccident->branch_name:null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('branch_name'))
                                                                        <span class="help-block error">{{ $errors->first('branch_name') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('claim_no')) has-error @endif">
                                                                    <span class="">Claim No</span>
                                                                    {!! Form::text('claim_no',isset($maccident)?$maccident->claim_no:null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('claim_no'))
                                                                        <span class="help-block error">{{ $errors->first('claim_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                                    <span class="">Notes</span>

                                                                    {!! Form::textarea('notes',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('notes'))
                                                                        <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <!-- END FORM-->
                                                        </div>
                                                        <!--portlet form-->
                                                    </div>
                                                    <!--portlet box-->
                                                </div>
                                                <!-- col md 4 -->

                                            </div>
                                        </div>

                                        <div class="claimevenitems  {{isset($patient->id)?Null:'hidden'}}">


                                            <div class="col-md-12">
                                                <div class="portlet box blue ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Events
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="events form-group input-wlbl ">

                                                                    <div class="">
                                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                                               id="">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Check</th>
                                                                                <th>ID</th>

                                                                                <th>Hospital</th>
                                                                                <th>Finance Party</th>
                                                                                <th>Discharge Date</th>
                                                                                <th>Cost NIS</th>
                                                                                <th>Amount of Comission</th>
                                                                                <th>Subject to Comm.</th>
                                                                                <th>Agent</th>
                                                                                <th>Status</th>

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>


                                                                            @foreach($events as $i)

                                                                                <tr class="{{$i->finance_party}} claimevent {{(isset($claim)&&$i->finance_party==$claim->finance_party)?'':'hidden'}}">
                                                                                    <td>
                                                                                        {!! Form::checkbox('event[]',$i->id,(!$errors->has() && in_array($i->id,$invoices))?true:null, array('class'=>'mycheckbox ccheckbox')) !!}
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="{{ config('app.cp_route_name') }}/invoice/invoiceForm/{{$i->id}}"
                                                                                           data-target="#ajax"
                                                                                           data-toggle="modal">{{$i->id}}</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="{{ config('app.cp_route_name') }}/invoice/edit/{{$i->id}}">
                                                                                            {{$i->hospital}}
                                                                                        </a>
                                                                                    </td>
                                                                                    <td>{{$i->finance_party_name}}</td>
                                                                                    <td> {{date('Y-m-d', strtotime($i->discharge_date))}}</td>
                                                                                    <td>{{$i->approved_cost}}</td>

                                                                                    <td>{{($i->commission_perc*$i->approved_cost/100)}}</td>
                                                                                    <td>{{($i->commission==1)?'YES':'NO'}}</td>

                                                                                    <td>{{$i->referral_agent}}</td>
                                                                                    <td>{{$i->astatus}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>


                                                                    <!-- permissions checks -->
                                                                </div>
                                                                <!--form body-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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




    