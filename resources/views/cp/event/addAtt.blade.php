

                                         <div class="row" style="padding: 20px;">

                                          
                                      
                                        
                                  
                                            
                                          <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                <span class="lblinput">Title</span>
                                                 {!! Form::text('event_id',isset($result->id)?$result->id:"0",['class'=>'hidden event_id txtinput-required']) !!}

                                                 {!! Form::text('title',null,['class'=>'form-control  txtinput-required  ']) !!}
                                                @if ($errors->has('title'))
                                                    <span class="help-block error">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                             <div class="col-md-6">
                                                 <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                     <span class="lblinput">Attachment Type</span>

                                                     {!! Form::select('type',$att_type,null,['class'=>'form-control txtinput-required txtinput']) !!}
                                                     @if ($errors->has('type'))
                                                         <span class="help-block error">{{ $errors->first('type') }}</span>
                                                     @endif
                                                 </div>
                                             </div>
                                        
                                           <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('information')) has-error @endif">
                                                <span class="lblinput">Inforamtion</span>
                                                 {!! Form::textarea('information',null,['class'=>'form-control  txtinput-required','rows'=>'3']) !!}
                                                @if ($errors->has('information'))
                                                    <span class="help-block error">{{ $errors->first('information') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                                         <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('icon')) has-error @endif">
                                                 <span class=" ">Event  Attachment </span>
                                                 <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>

                                     <div class="profile-userpic">
                                     
                                     
            <div class="upload-event-att">
               
                 {!! Form::text('name','1.jpg',['class'=>'hidden from-control  icon ']) !!}
               
                <input type="file" name="image" class="  upload-event-att" id="0" accept="*/*" />

            </div>
              
        </div>
    </div></div>

                                          

                                
                                      
                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   