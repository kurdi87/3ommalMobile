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
                    <a href="{{ config('app.cp_route_name') }}/salary"
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
                                                <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                    <span class="">الجوال</span>
                                                    {!! Form::text('telephone',\App\Models\SystemUserModel::find($result->user_id)->SysUsr_Mobile,['class'=>'form-control  txtinput  ','readonly ']) !!}
                                                    @if ($errors->has('telephone'))
                                                        <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('message')) has-error @endif">
                                                    <span class="">الملاحظات</span>
                                                    {!! Form::textarea('message',$result->notes,['class'=>'form-control    ','readonly ']) !!}
                                                    @if ($errors->has('message'))
                                                        <span class="help-block error">{{ $errors->first('message') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('message')) has-error @endif">
                                                    <span class="">هل تمتلك قسيمة تلوش لفترة الاسترجاع</span>

                                                    @if($result->salary_paper==1)
                                                        <button type="button" class="btn btn-success">نعم</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif
                                                    @if ($errors->has('message'))
                                                        <span class="help-block error">{{ $errors->first('message') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('message')) has-error @endif">
                                                    <span class="">هل حصلت على تلوش بنفس الشهر الذي حدثت به الإصابة</span>

                                                    @if($result->salary_paper_month==1)
                                                        <button type="button" class="btn btn-success">نعم</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    @endif
                                                    @if ($errors->has('message'))
                                                        <span class="help-block error">{{ $errors->first('message') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl @if ($errors->has('salary_amount')) has-error @endif">
                                                    <span class=""> مبلغ قسيمة الراتب (تلوش) خلال فترة العمل </span>

                                                    <div class="input-group">
                                                        {!! Form::text('salary_amount',$result->salary_amount,['class'=>'form-control  txtinput-number','readonly']) !!}

                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                   NIS
                                                                </button>
                                                            </span>
                                                    </div>


                                                    @if ($errors->has('salary_amount'))
                                                        <span class="help-block error">{{ $errors->first('salary_amount') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('message')) has-error @endif">
                                                    <span class="">تاريخ العمل</span>
                                                    <div class="input-group input-xlarge date-picker input-daterange select2-wlbl selectrole-rg"
                                                         data-date="2018/01/01" data-date-format="yyyy/mm/dd">
                                                        <input type="text" id="from" class="form-control " name="from"
                                                               value="{{Date("Y-m-d",strtotime($result->start_work_date))}}"
                                                               placeholder="Date form">
                                                        <span class="input-group-addon"> إلى </span>
                                                        <input type="text" id="to" class="form-control" name="to"
                                                               value="{{Date("Y-m-d",strtotime($result->end_work_date))}}"
                                                               placeholder="Date to">
                                                    </div>
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

    