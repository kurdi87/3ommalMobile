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
                    <a href="{{ config('app.cp_route_name') }}/skill"
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
                                <i class="icon-globe"></i>Skill
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('skill')) has-error @endif">
                                                    <span class="lblinput">Name</span>
                                                    {!! Form::text('skill',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('skill'))
                                                        <span class="help-block error">{{ $errors->first('skill') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('skill_ar')) has-error @endif">
                                                    <span class="lblinput">Name Ar</span>
                                                    {!! Form::text('skill_ar',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('skill_ar'))
                                                        <span class="help-block error">{{ $errors->first('skill_ar') }}</span>
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

    