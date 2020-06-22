
                                         <div class="row" style="padding: 20px;">
                                          <div class="col-md-12">

                                               {!! Form::text('id',isset($recipeDieaseas->id)?$recipeDieaseas->id:"0",['class'=>'hidden']) !!}
                                           

                                               
                                            </div>
                                     

                                    


                                            <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                <span >About Dieseas</span>
                                                 {!! Form::textarea('notes',$recipeDieaseas->notes,['class'=>'textareaDieaseas  form-control  txtinput-required  ']) !!}
                                                  <p></p>
                                                @if ($errors->has('notes'))
                                                    <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                          

                                

                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   