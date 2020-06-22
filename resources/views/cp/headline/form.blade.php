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
                    <a href="{{ config('app.cp_route_name') }}/headline" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Headline 
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                         <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                <span class="lblinput">Title</span>
                                                 {!! Form::text('title',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('title'))
                                                    <span class="help-block error">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl @if ($errors->has('h_date')) has-error @endif">
                                                <span class="lblinput">Headline Date</span>

                                                <div class="input-group">
                                                    {!! Form::text('h_date',null,['class'=>'form-control  datepicker','readonly'=>'','data-date-format'=>'yyyy-mm-dd']) !!}
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                @if ($errors->has('h_date'))
                                                    <span class="help-block error">{{ $errors->first('h_date') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        

                                              <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('small_describtion')) has-error @endif">
                                                <span class="lblinput">Small Describtion</span>
                                                 {!! Form::textarea('small_describtion',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('small_describtion'))
                                                    <span class="help-block error">{{ $errors->first('small_describtion') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                           <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('describtion')) has-error @endif">
                                                <span class="lblinput">Describtion</span>
                                                 {!! Form::textarea('describtion',null,['class'=>'form-control textarea  txtinput-required txtinput-number-required']) !!}
                                                @if ($errors->has('describtion'))
                                                    <span class="help-block error">{{ $errors->first('describtion') }}</span>
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
                                           
                                        <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                <span class="lblinput">Is Main</span>
                                                 {!! Form::select('ismain',$ismain,null,['class'=>'form-control  txtinput']) !!}
                                                @if ($errors->has('type'))
                                                    <span class="help-block error">{{ $errors->first('ismain') }}</span>
                                                @endif
                                            </div>
                                        </div>

                        <div class="col-md-6">
                            <div class="form-group input-wlbl  @if ($errors->has('h_image')) has-error @endif">
                                    <span class="lblinput">Headline Image</span>
                                     <div class="profile-userpic">
                                         <div class="upload-headline-img" style="{{ isset($result->h_image)?"background-image:url(img/blog/".$result->h_image.")":"background-image:url(img/blog/1.jpg"}}">
                                             <span class="glyphicon glyphicon-cloud-upload"></span>
                                                {!! Form::text('h_image','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                 <input type="file" name="image" class="avatar-file upload-headline-img" id="{{ isset($result->id)?$result->id:0 }}"" accept="image/*" />
                                        </div>
              
                                    </div>
    
                            </div>              
                        </div>
                                        
                                        
                                        
                                         
                                           


                     </div>
                    </div>
                                    
                  </div>
                                   
                 </div>
                              
                </div>
                         
             </div>
                     
        </div>
                

    </div>


                <!--tab pane-->
     </div>
            <!--tab content-->
</div>



        <!--tabbable line-->
    </div>


    