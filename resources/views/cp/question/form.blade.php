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
                    <a href="{{ config('app.cp_route_name') }}/question"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Question
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('question_text')) has-error @endif">
                                                    <span class="">Question - السؤال</span>
                                                    {!! Form::textarea('question_text',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('question_text'))
                                                        <span class="help-block error">{{ $errors->first('question_text') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('question_text_ar')) has-error @endif">
                                                    <span class="">Question Ar - السؤال بالعربي</span>
                                                    {!! Form::textarea('question_text_ar',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('question_text_ar'))
                                                        <span class="help-block error">{{ $errors->first('question_text_ar') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('question_order')) has-error @endif">
                                                    <span class="">Order - الترتيب</span>
                                                    {!! Form::text('question_order',null,['class'=>'form-control  txtinput-filter-number ']) !!}
                                                    @if ($errors->has('question_order'))
                                                        <span class="help-block error">{{ $errors->first('question_order') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
                                                    <span class="">Status - الحالة</span>
                                                    {!! Form::select('status',$status,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('status'))
                                                        <span class="help-block error">{{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                    <span class="">Type - النوع</span>
                                                    {!! Form::select('type',$type,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('type'))
                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group input-wlbl  @if ($errors->has('speciality')) has-error @endif">
                                                    <span class="">Speciality - التخصص</span>
                                                    {!! Form::select('speciality[]',$speciality,$speciality_id,['class'=>'form-control  select2', "multiple"=>"multiple","data-placeholder"=>"Speciality-التخصص"]) !!}
                                                    @if ($errors->has('speciality'))
                                                        <span class="help-block error">{{ $errors->first('speciality') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group input-wlbl  @if ($errors->has('question_required')) has-error @endif">
                                                    <span class="">Required - يجب الإدخال</span>
                                                    {!! Form::checkbox('question_required',0,isset($result)?$result->question_required:null, array('class'=>'make-switch',"data-on-color"=>"primary","data-off-color"=>"info")) !!}

                                                    @if ($errors->has('question_required'))
                                                        <span class="help-block error">{{ $errors->first('question_required') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="switch-inline">
                                                    <span>active - فعال</span>

                                                    <div>
                                                        {!! Form::checkbox('active',1,isset($result)?$result->active:null, array('class'=>'make-switch',"data-on-color"=>"primary","data-off-color"=>"info")) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                    <span class="">Notes -  الملاحظات</span>
                                                    {!! Form::textarea('notes',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('notes'))
                                                        <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                    @endif
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

    