<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit" class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info" title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/menu" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Menus 
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                         <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                <span class="lblinput">Title</span>
                                                 {!! Form::text('title',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('title'))
                                                    <span class="help-block error">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                          <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('action')) has-error @endif">
                                                <span class="lblinput">action</span>
                                                 {!! Form::text('action',null,['class'=>'form-control  txtinput-required']) !!}
                                                @if ($errors->has('action'))
                                                    <span class="help-block error">{{ $errors->first('action') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('m_order')) has-error @endif">
                                                <span class="lblinput">order</span>
                                                 {!! Form::text('m_order',null,['class'=>'form-control  txtinput-required txtinput-number-required']) !!}
                                                @if ($errors->has('m_order'))
                                                    <span class="help-block error">{{ $errors->first('m_order') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('lang')) has-error @endif">
                                                <span class="lblinput">Language</span>
                                                 {!! Form::select('lang',$languages,null,['class'=>'form-control  txtinput']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block error">{{ $errors->first('id') }}</span>
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

    