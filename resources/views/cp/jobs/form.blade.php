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
                    <a href="{{ config('app.cp_route_name') }}/jobs"
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
                                <i class="icon-globe"></i>Jobs
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('job_title')) has-error @endif">
                                                    <span class="">Jobs - العمل </span>
                                                    {!! Form::text('job_title',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('job_title'))
                                                        <span class="help-block error">{{ $errors->first('job_title') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('job_title_ar')) has-error @endif">
                                                    <span class="">Jobs Ar - العمل  بالعربي</span>
                                                    {!! Form::text('job_title_ar',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('job_title_ar'))
                                                        <span class="help-block error">{{ $errors->first('job_title_ar') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('job_desc')) has-error @endif">
                                                    <span class="">Jobs Description - وصف العمل</span>
                                                    {!! Form::textarea('job_desc',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('job_desc'))
                                                        <span class="help-block error">{{ $errors->first('job_desc') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('job_desc_ar')) has-error @endif">
                                                    <span class="">Jobs Description Ar -  وصف العمل عربي</span>
                                                    {!! Form::textarea('job_desc_ar',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('job_desc_ar'))
                                                        <span class="help-block error">{{ $errors->first('job_desc_ar') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('keywords')) has-error @endif">
                                                    <span class="">keywords - كلمات دالة</span>
                                                    {!! Form::textarea('keywords',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('keywords'))
                                                        <span class="help-block error">{{ $errors->first('keywords') }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('user_id')) has-error @endif">
                                                    <span class="">الشركة - Company</span>
                                                    {!! Form::select('user_id',$company,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('user_id'))
                                                        <span class="help-block error">{{ $errors->first('user_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('job_order')) has-error @endif">
                                                    <span class="">Order - الترتيب</span>
                                                    {!! Form::text('job_order',null,['class'=>'form-control  txtinput-filter-number ']) !!}
                                                    @if ($errors->has('job_order'))
                                                        <span class="help-block error">{{ $errors->first('job_order') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('rank')) has-error @endif">
                                                    <span class="">Rank - التقييم</span>
                                                    {!! Form::text('rank',null,['class'=>'form-control  txtinput-filter-number ']) !!}
                                                    @if ($errors->has('rank'))
                                                        <span class="help-block error">{{ $errors->first('rank') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('position')) has-error @endif">
                                                    <span class="">Positions - عدد المطلوب</span>
                                                    {!! Form::text('position',null,['class'=>'form-control  txtinput-filter-number ','type'=>'number']) !!}
                                                    @if ($errors->has('position'))
                                                        <span class="help-block error">{{ $errors->first('position') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('views')) has-error @endif">
                                                    <span class="">Views - المشاهدات</span>
                                                    {!! Form::text('views',null,['class'=>'form-control  txtinput-filter-number ']) !!}
                                                    @if ($errors->has('views'))
                                                        <span class="help-block error">{{ $errors->first('views') }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
                                                    <span class="">Status - الحالة</span>
                                                    {!! Form::select('status',$status,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('status'))
                                                        <span class="help-block error">{{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('city')) has-error @endif">
                                                    <span class="">المدينة - City</span>
                                                    {!! Form::select('city',$city,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('city'))
                                                        <span class="help-block error">{{ $errors->first('city') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                    <span class="">Type - النوع</span>
                                                    {!! Form::select('type',$type,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('type'))
                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('experience_level')) has-error @endif">
                                                    <span class="">Experience Level - مستوى الخبرة</span>
                                                    {!! Form::select('experience_level',$experience_level,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('experience_level'))
                                                        <span class="help-block error">{{ $errors->first('experience_level') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('job_qualification')) has-error @endif">
                                                    <span class="">Qualification - المؤهلات</span>
                                                    {!! Form::select('job_qualification',$job_qualification,null,['class'=>'form-control txtinput select2']) !!}
                                                    @if ($errors->has('job_qualification'))
                                                        <span class="help-block error">{{ $errors->first('job_qualification') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('speciality')) has-error @endif">
                                                    <span class="">Speciality - التخصص</span>
                                                    {!! Form::select('speciality[]',$speciality,$speciality_id,['class'=>'form-control  select2', "multiple"=>"multiple","data-placeholder"=>"Speciality-التخصص"]) !!}
                                                    @if ($errors->has('speciality'))
                                                        <span class="help-block error">{{ $errors->first('speciality') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="input-group input-xlarge date-picker input-daterange select2-wlbl selectrole-rg"
                                                     data-date="2018/01/01" data-date-format="yyyy/mm/dd">

                                                    {!! Form::text('valid_from',null,['class'=>'form-control' ,'placeholder'=>"Valid form"]) !!}
                                                    <span class="input-group-addon"> to </span>
                                                    {!! Form::text('valid_to',null,['class'=>'form-control' ,'placeholder'=>"Valid To"]) !!}
                                                    @if ($errors->has('valid_from'))
                                                        <span class="help-block error">{{ $errors->first('valid_from') }}</span>
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

    