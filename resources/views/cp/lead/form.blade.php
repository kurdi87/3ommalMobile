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
                    <a href="{{ config('app.cp_route_name') }}/lead"
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
                                <i class="icon-globe"></i>lead
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
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                                <span class="">Name</span>
                                                                {!! Form::text('name',null,['class'=>'form-control  txtinput ']) !!}
                                                                @if ($errors->has('name'))
                                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="form-group input-wlbl @if ($errors->has('service_date')) has-error @endif">
                                                                <span class="">lead Date</span>
                                                                <p>{{isset($result)?date('Y-M-d  H:i:s',strtotime($result->created_date)):''}}</p>

                                                            </div>
                                                        </div>
                                                        @if(isset($result))
                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                                    <span class="">Source</span>
                                                                    <span class="strong form-control">
                                                                @if ($result->type == "1")
                                                                            Medibooking
                                                                        @elseif ($result->type == "2")
                                                                            Tabibfind
                                                                        @else
                                                                            CRM
                                                                        @endif
                                                                </span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('phone')) has-error @endif">
                                                                <span class="">Phone</span>
                                                                {!! Form::text('phone',null,['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('phone'))
                                                                    <span class="help-block error">{{ $errors->first('phone') }}</span>
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
                                                            <div class="form-group input-wlbl @if ($errors->has('country')) has-error @endif">
                                                                <span class="">Country </span>

                                                                {!! Form::select('country',$country,null,['class'=>'form-control txtinput-required  txtinput']) !!}
                                                                @if ($errors->has('country'))
                                                                    <span class="help-block error">{{ $errors->first('country') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="LeadInfo ">
                                            <div class="col-md-12">
                                                <div class="portlet box red ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Hospital Information
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('hospital_id')) has-error @endif">
                                                                    <span class="">Hospital</span>
                                                                    {!! Form::select('hospital_id',$hospital,null,['class'=>'form-control  select2 txtinput']) !!}
                                                                    @if ($errors->has('hospital_id'))
                                                                        <span class="help-block error">{{ $errors->first('hospital_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('doctor_id')) has-error @endif">
                                                                    <span class="">Doctor</span>
                                                                    {!! Form::select('doctor_id',$doctor,null,['class'=>'form-control txtinput select2']) !!}
                                                                    @if ($errors->has('doctor_id'))
                                                                        <span class="help-block error">{{ $errors->first('doctor_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                                    <span class="">Department</span>
                                                                    {!! Form::select('department_id',$department,null,['class'=>'form-control select2  txtinput']) !!}
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
                                                            Lead Information
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">

                                                        <div class="row">


                                                            <div class="col-md-6  ">
                                                                <div class="form-group">
                                                                    <label for="single" class="control-label ">Coordinator</label>
                                                                    <select id="employee" name="employee"
                                                                            class="form-control select2 ">
                                                                        <option></option>
                                                                        <optgroup label="Coordinator">
                                                                            @foreach($employee as $c)
                                                                                <option {{(isset($result->case_manager) && ($result->case_manager==$c->id)?'selected':'')}} value="{{$c->id}}">{{$c->name}}</option>
                                                                            @endforeach
                                                                        </optgroup>


                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6  ">
                                                                <div class="form-group">
                                                                    <label for="single" class="control-label">Referral
                                                                        Agent</label>
                                                                    <select id="agent" name="agent"
                                                                            class="form-control select2 ">
                                                                        <option></option>
                                                                        <optgroup label="Referral Agent">
                                                                            @foreach($agent as $c)
                                                                                <option {{(isset($result->agent) && ($result->agent==$c->id)?'selected':Null)}} value="{{$c->id}}">{{$c->name}}</option>
                                                                            @endforeach
                                                                        </optgroup>


                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 ">
                                                                <div class="form-group input-wlbl @if ($errors->has('service_date')) has-error @endif">
                                                                    <span class="">Servce Date</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('service_date',null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                                    </div>
                                                                    @if ($errors->has('service_date'))
                                                                        <span class="help-block error">{{ $errors->first('service_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 ">
                                                                <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
                                                                    <span class="">Status</span>
                                                                    {!! Form::select('status',$lead_status,isset($result->status)?$result->status:'',['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('status'))
                                                                        <span class="help-block error">{{ $errors->first('status') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                                    <span class="">Request</span>
                                                                    @if(isset($result))
                                                                        <p>{!! $result->notes !!}</p>
                                                                    @else

                                                                        {!! Form::textarea('notes',null,['class'=>'form-control']) !!}
                                                                    @endif

                                                                    @if ($errors->has('notes'))
                                                                        <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('employee_notes')) has-error @endif">
                                                                    <span class="">Employee Notes</span>
                                                                    {!! Form::textarea('employee_notes',null,['class'=>'form-control']) !!}

                                                                    @if ($errors->has('employee_notes'))
                                                                        <span class="help-block error">{{ $errors->first('employee_notes') }}</span>
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



    