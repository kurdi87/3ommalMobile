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
                    <a href="{{ config('app.cp_route_name') }}/vacation"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    @if (isset($result->id))
                        <a href="{{ config('app.cp_route_name') }}/vacation/VacationPrint/{{$result->id}}"
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
                                <i class="icon-globe"></i>Request for Vacation - طلب إجازة
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
                                                        Employee Information - معلومات الموظف
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body  padding-15-all">
                                                    <div class="row">
                                                        @if(!isset($employee->id))
                                                            <div class="col-md-12 ">
                                                                <div class="form-group">
                                                                    <label for="single"
                                                                           class="control-label">Employee - الموظف</label>
                                                                    <select id="employee_id" name="employee_id"
                                                                            class="form-control select2 employee" {{(isset($employee->id)? 'readonly':Null)}}>
                                                                        <option></option>
                                                                        <optgroup label="Employees">
                                                                            @foreach($employees as $p)
                                                                                <option {{(isset($employee->id) && ($employee->id==$p->id)?'selected':Null)}} value="{{$p->id}}">{{$p->name." ID (".$p->empno.")"}}</option>
                                                                            @endforeach
                                                                        </optgroup>


                                                                    </select>
                                                                </div>
                                                            </div>

                                                        @else
                                                            {!! Form::text('employee_id',$employee->id,['class'=>'form-control hidden ']) !!}
                                                        @endif

                                                        <div class="col-md-6">
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Emp Name -  الاسم </span>
                                                                        <p>{{isset($employee->name)?$employee->name:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Emp No - رقم الموظف</span>
                                                                        <p>{{isset($employee->empno)?$employee->empno:Null}}</p>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">Department - القسم</span>
                                                                        <p>{{isset($employee->department_id)?\App\Models\Hr_departmentModel::getHr_departmentName($employee->department_id):Null}}</p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group input-wlbl ">
                                                                        <span class="">ID - الهوية </span>
                                                                        <p>{{isset($employee->sid)?$employee->sid:Null}}</p>
                                                                        {!! Form::text('vacation_id',isset($vacation_id)?$vacation_id:0,['class'=>'form-control hidden ']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Date of Birth - تاريخ الميلاد</span>
                                                                                <p>{{  isset($employee->bod)? date('Y-m-d', strtotime($employee->bod)):Null}}</p>

                                                                            </div>


                                                                        </div>


                                                                        <div class="col-md-6">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Job Title - العنوان</span>
                                                                                <p>{{isset($employee->title)?$employee->tilte:Null}}</p>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Sick Balance - رصيد الإجازات المرضية</span>
                                                                                <p class="strong ">{{isset($employee->sick)?$employee->sick:Null}}</p>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group input-wlbl ">
                                                                                <span class="">Leave Balance -رصيد الإجازات السنوية</span>
                                                                                <p class="strong">{{isset($employee->leaves)?$employee->leaves:Null}}</p>

                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group input-wlbl  @if ($errors->has('image')) has-error @endif">
                                                                        <span class=""> Image - صورة</span>
                                                                        <div class="profile-userpic">
                                                                            <div class="upload-admission-img"
                                                                                 style="{{ isset($employee->image)?"background-image:url(img/employee/".$employee->image.")":""}}">
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
                                        <div class="vacationInfo {{isset($employee->id)?Null:'hidden'}}">
                                            <div class="col-md-12">
                                                <div class="portlet box red ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Vacation Information - معلومات
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">
                                                        <div class="row">

                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                                    <span class="">Type - النوع</span>
                                                                    {!! Form::select('type',$types,null,['class'=>'form-control   txtinput select2']) !!}
                                                                    @if ($errors->has('type'))
                                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="input-group input-xxlarge date-picker input-daterange"
                                                                     data-date="2018/01/01"
                                                                     data-date-format="yyyy/mm/dd">
                                                                    {!! Form::text('from_date',isset($result->from_date)? date('Y-m-d',strtotime($result->from_date)):Null,['class'=>'form-control',"placeholder"=>"Date form"]) !!}

                                                                    <span class="input-group-addon"> to </span>
                                                                    {!! Form::text('to_date',isset($result->to_date)? date('Y-m-d',strtotime($result->to_date)):Null,['class'=>'form-control',"placeholder"=>"Date to"]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="form-group input-wlbl  @if ($errors->has('reason')) has-error @endif">
                                                                    <span class="">Reason - السبب</span>

                                                                    {!! Form::text('reason',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('reason'))
                                                                        <span class="help-block error">{{ $errors->first('reason') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="form-group input-wlbl  @if ($errors->has('address')) has-error @endif">
                                                                    <span class="">Address -  العنوان</span>

                                                                    {!! Form::text('address',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('address'))
                                                                        <span class="help-block error">{{ $errors->first('address') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="form-group input-wlbl  @if ($errors->has('contact_no')) has-error @endif">
                                                                    <span class="">Contact No - رقم التواصل</span>

                                                                    {!! Form::text('contact_no',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('contact_no'))
                                                                        <span class="help-block error">{{ $errors->first('contact_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="form-group input-wlbl  @if ($errors->has('comment')) has-error @endif">
                                                                    <span class="">Notes -ملاحظات</span>

                                                                    {!! Form::textarea('comment',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('comment'))
                                                                        <span class="help-block error">{{ $errors->first('comment') }}</span>
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



    