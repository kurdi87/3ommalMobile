<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button module="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" module="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/lookUp"
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
                                <i class="icon-globe"></i>Modules
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">


                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('lookUp_key')) has-error @endif">
                                                    <span class=""></span>
                                                    <span class="">Key</span>
                                                    {!! Form::text('lookUp_key',null,['class'=>'form-control  txtinput-required ',"id"=>"lookUp_keyN"]) !!}



                                                    @if ($errors->has('lookUp_key'))
                                                        <span class="help-block error">{{ $errors->first('lookUp_key') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('lookUp')) has-error @endif">
                                                    <span class="">LookUp Value</span>
                                                    {!! Form::text('lookUp',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('lookUp'))
                                                        <span class="help-block error">{{ $errors->first('lookUp') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group input-wlbl  @if ($errors->has('lookUp_ar')) has-error @endif">
                                                    <span class="">LookUp Value Ar</span>
                                                    {!! Form::text('lookUp_ar',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('lookUp_ar'))
                                                        <span class="help-block error">{{ $errors->first('lookUp_ar') }}</span>
                                                    @endif
                                                </div>
                                            </div>



                                            <!--span-->


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

    