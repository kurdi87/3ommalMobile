

                                         <div class="row" style="padding: 20px;">

                                          
                                      
                                        
                                  
                                            
                                          <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                <span class="">Title - العنوان</span>
                                                 {!! Form::text('id',isset($att->id)?$att->id:"0",['class'=>'hidden injury_id txtinput-required']) !!}
                                                {!! Form::text('name',$att->name,['class'=>'hidden from-control  icon ']) !!}
                                                 {!! Form::text('title',$att->title,['class'=>'form-control  txtinput-required  ']) !!}
                                                @if ($errors->has('title'))
                                                    <span class="help-block error">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                             <div class="col-md-6">
                                                 <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                     <span class="">Attachment Type - النوع</span>

                                                     {!! Form::select('type',$att_type,$att->type,['class'=>'form-control txtinput-required txtinput']) !!}
                                                     @if ($errors->has('type'))
                                                         <span class="help-block error">{{ $errors->first('type') }}</span>
                                                     @endif
                                                 </div>
                                             </div>
                                        
                                           <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('information')) has-error @endif">
                                                <span class="">Inforamtion - المعلومات</span>
                                                 {!! Form::textarea('information',$att->information,['class'=>'form-control  txtinput-required  ']) !!}
                                                @if ($errors->has('information'))
                                                    <span class="help-block error">{{ $errors->first('information') }}</span>
                                                @endif
                                            </div>
                                        </div>



                                          

                                
                                      
                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   