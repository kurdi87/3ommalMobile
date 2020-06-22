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
                    <a href="{{ config('app.cp_route_name') }}/job"
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
                                <i class="fa fa-money"></i>طلب مستحقات نهاية الخدمة
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">الأسم</span>
                                                    <a href="{{ config('app.cp_route_name') }}/user/edit/{{$result->user_id}}"
                                                       target="_blank">{{ \App\Models\SystemUserModel::find($result->user_id)->SysUsr_FullName}}</a>
                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('email')) has-error @endif">
                                                    <span class="">البريد الالكتروني</span>
                                                    {!! Form::text('email',\App\Models\SystemUserModel::find($result->user_id)->SysUsr_Email,['class'=>'form-control    ','readonly ']) !!}
                                                    @if ($errors->has('email'))
                                                        <span class="help-block error">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('sid')) has-error @endif">
                                                    <span class="">رقم الهوية</span>
                                                    {!! Form::text('sid',\App\Models\SystemUserModel::find($result->user_id)->sid,['class'=>'form-control    ','readonly ']) !!}
                                                    @if ($errors->has('sid'))
                                                        <span class="help-block error">{{ $errors->first('sid') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                    <span class="">الجوال</span>
                                                    {!! Form::text('telephone',\App\Models\SystemUserModel::find($result->user_id)->SysUsr_Mobile,['class'=>'form-control  txtinput  ','readonly ']) !!}
                                                    @if ($errors->has('telephone'))
                                                        <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="clearfix">
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">مقابلة</span>
                                                    @if($result->job_interview==1)
                                                        <button type="button" class="btn btn-success">نعم</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا </button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">مجال العمل</span>
                                                    @if($result->work_fields)
                                                        <button type="button" class="btn btn-success">{{$result->work_fields}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">نوع الهوية</span>
                                                    @if($result->id_type)
                                                        <button type="button" class="btn btn-success">{{$result->id_type}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">بطاقة ممغنطة</span>
                                                    @if($result->magnetic_card)
                                                        <button type="button" class="btn btn-success">{{$result->magnetic_card}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class=""> تاريخ العمل في الخط الأخضر</span>
                                                    @if($result->year_work)
                                                        <button type="button" class="btn btn-success">{{$result->year_work}}-{{$result->month_work}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">الراتب الشهري</span>
                                                    @if($result->amount_of_the_monthly_salary)
                                                        <button type="button" class="btn btn-success">{{$result->amount_of_the_monthly_salary}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">عمل في الخط الأخضر</span>
                                                    @if($result->worked_inside_green_line)
                                                        <button type="button" class="btn btn-success">{{$result->worked_inside_green_line}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">هل تمتلك قسيمة راتب</span>
                                                    @if($result->getting_a_salary_slip)
                                                        <button type="button" class="btn btn-success">{{$result->getting_a_salary_slip}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">إصابة عمل</span>
                                                    @if($result->previous_work_accident)
                                                        <button type="button" class="btn btn-success">{{$result->previous_work_accident}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">مستحقات الخدمة</span>
                                                    @if($result->end_of_service_benefits)
                                                        <button type="button" class="btn btn-success">{{$result->end_of_service_benefits}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class="">مقدار المستحقات</span>
                                                    @if($result->monthly_salary_amount_you_were_getting)
                                                        <button type="button" class="btn btn-success">{{$result->monthly_salary_amount_you_were_getting}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class=""> كورس سلامة</span>
                                                    @if($result->taken_a_public_safety_course)
                                                        <button type="button" class="btn btn-success">{{$result->taken_a_public_safety_course}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class=""> اللغة العبرية</span>
                                                    @if($result->speak_hebrew)
                                                        <button type="button" class="btn btn-success">{{$result->speak_hebrew}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class=""> سنوات الخدمة</span>
                                                    @if($result->years_of_experience)
                                                        <button type="button" class="btn btn-success">{{$result->years_of_experience}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                    <span class=""> المستوى الأكاديمي </span>
                                                    @if($result->level_of_your_academic)
                                                        <button type="button" class="btn btn-success">{{$result->level_of_your_academic}}</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif

                                                    @if ($errors->has('name'))
                                                        <span class="help-block error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>










                                            <div class="clearfix">
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('adminAction')) has-error @endif">
                                                    <span class="">Admin Action</span>
                                                    {!! Form::select('adminAction',$adminAction,$result->status,['class'=>'form-control  txtinput']) !!}
                                                    @if ($errors->has('adminAction'))
                                                        <span class="help-block error">{{ $errors->first('adminAction') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('admin_notes')) has-error @endif">
                                                    <span class="">ملاحظات الأدمن</span>
                                                    {!! Form::textarea('admin_notes',null,['class'=>'form-control textarea txtinput ']) !!}
                                                    @if ($errors->has('admin_notes'))
                                                        <span class="help-block error">{{ $errors->first('admin_notes') }}</span>
                                                    @endif
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
    <!--tabbable line-->
</div>
<!-- col md 12 -->
</div>

    