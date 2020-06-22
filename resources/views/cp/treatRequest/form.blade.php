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
                    <a href="{{ config('app.cp_route_name') }}/treatRequest" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>treatRequest 
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
                                                <span class="">Name</span>
                                                 {!! Form::text('name',null,['class'=>'form-control  txtinput-required ','readonly ']) !!}
                                                @if ($errors->has('name'))
                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                              
                                          <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('email')) has-error @endif">
                                                <span class="">Email</span>
                                                 {!! Form::text('email',null,['class'=>'form-control  txtinput-required  ','readonly ']) !!}
                                                @if ($errors->has('email'))
                                                    <span class="help-block error">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                            <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                <span class="">Telephone</span>
                                                 {!! Form::text('telephone',null,['class'=>'form-control  txtinput  ','readonly ']) !!}
                                                @if ($errors->has('telephone'))
                                                    <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                              <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('message')) has-error @endif">
                                                <span class="">Message</span>
                                                 {!! Form::textarea('message',null,['class'=>'form-control  txtinput-required  ','readonly ']) !!}
                                                @if ($errors->has('message'))
                                                    <span class="help-block error">{{ $errors->first('message') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('country_code')) has-error @endif">
                                                <span class="">Country</span>
                                                 {!! Form::text('country_code',null,['class'=>'form-control  txtinput   ','readonly ']) !!}
                                                @if ($errors->has('country_code'))
                                                    <span class="help-block error">{{ $errors->first('country_code') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('subject')) has-error @endif">
                                                <span class="">Subject</span>
                                                 {!! Form::text('subject',null,['class'=>'form-control  txtinput   ','readonly ']) !!}
                                                @if ($errors->has('subject'))
                                                    <span class="help-block error">{{ $errors->first('subject') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('adminAction')) has-error @endif">
                                                <span class="">Admin Action</span>
                                                 {!! Form::select('adminAction',$adminAction,null,['class'=>'form-control  txtinput']) !!}
                                                @if ($errors->has('adminAction'))
                                                    <span class="help-block error">{{ $errors->first('adminAction') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                <span class="">Notes</span>
                                                 {!! Form::textarea('notes',null,['class'=>'form-control textarea txtinput ']) !!}
                                                @if ($errors->has('notes'))
                                                    <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                               <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('hospital')) has-error @endif">
                                                <span class="">Hospital</span>
                                                 {!! Form::text('recipe',null,['class'=>'form-control  txtinput  ','readonly ']) !!}
                                                @if ($errors->has('hospital'))
                                                    <span class="help-block error">{{ $errors->first('recipe') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                               <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('doctor')) has-error @endif">
                                                <span class="">Doctor</span>
                                                 {!! Form::text('doctor',null,['class'=>'form-control  txtinput  ','readonly ']) !!}
                                                @if ($errors->has('doctor'))
                                                    <span class="help-block error">{{ $errors->first('doctor') }}</span>
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

    