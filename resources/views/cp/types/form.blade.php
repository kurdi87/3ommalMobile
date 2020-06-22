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
                    <a href="{{ config('app.cp_route_name') }}/types"
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                    <span class="lblinput">Type</span>
                                                    {!! Form::text('type',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('type'))
                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('type_ar')) has-error @endif">
                                                    <span class="lblinput">Type Ar</span>
                                                    {!! Form::text('type_ar',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('type_ar'))
                                                        <span class="help-block error">{{ $errors->first('type_ar') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('module')) has-error @endif">
                                                    <span class=""></span>

                                                    {!! Form::text('module',null,['class'=>'form-control hidden txtinput-required ',"id"=>"moduleN"]) !!}

                                                    {!! Form::select('modules',$modules,null,['class'=>'form-control select2  module ','style'=>"width: 100%","id"=>"module" ]) !!}

                                                    @if ($errors->has('module'))
                                                        <span class="help-block error">{{ $errors->first('module') }}</span>
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

    