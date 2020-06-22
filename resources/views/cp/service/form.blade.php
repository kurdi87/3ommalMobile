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
                    <a href="{{ config('app.cp_route_name') }}/service" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Service 
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
                                                <span class="lblinput">Name</span>
                                                 {!! Form::text('name',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('name'))
                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        

                                              <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('mini_note')) has-error @endif">
                                                <span class="lblinput">Mini Note</span>
                                                 {!! Form::textarea('mini_note',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('mini_note'))
                                                    <span class="help-block error">{{ $errors->first('mini_note') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                <span class="lblinput">Notes</span>
                                                 {!! Form::textarea('notes',null,['class'=>'form-control  txtinput-required textarea ']) !!}
                                                @if ($errors->has('notes'))
                                                    <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                             

                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('s_order')) has-error @endif">
                                                <span class="lblinput">order</span>
                                                 {!! Form::text('s_order',null,['class'=>'form-control  txtinput-required txtinput-number-required']) !!}
                                                @if ($errors->has('s_order'))
                                                    <span class="help-block error">{{ $errors->first('s_order') }}</span>
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
                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('icon')) has-error @endif">
                                                <span class="lblinput">Icon</span>
                                                 {!! Form::select('icon',$icon,null,['class'=>'form-control  txtinput icondepartment']) !!}

                                                 <p><span id="flaticon" class="flaticon iconsize {{ (isset($result->icon)?$result->icon:'')}}" ></span></p>
                                                @if ($errors->has('icon'))
                                                    <span class="help-block error">{{ $errors->first('icon') }}</span>
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

    