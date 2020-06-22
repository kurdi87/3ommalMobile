                                     <div class="row" style="padding: 20px; direction: rtl">
                                         <div class="col-xs=12 text-center">
                                             <h3><label class="label label-warning">الرجاء وضع المقادير على شكل نقاط</label></h3>



                                         </div>

                                           <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                
                                                 {!! Form::text('recipe_id',isset($result->id)?$result->id:"0",['class'=>'hidden recipe_id']) !!}

                                                {!! Form::textarea('name',null,['class'=>'form-control textarea txtinput-required ']) !!}
                                              
                                                @if ($errors->has('name'))
                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                      
                                        
                                  
                                            
                                          <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('stat')) has-error @endif">
                                                <span class=""> Qty - الكمية</span>
                                                 {!! Form::text('stat',0,['class'=>'form-control  txtinput-number-required  ']) !!}
                                                @if ($errors->has('stat'))
                                                    <span class="help-block error">{{ $errors->first('stat') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                          

                                
                                           <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('icon')) has-error @endif">
                                                <span class="">icon</span>
                                                


                                                 {!! Form::select('icon',$icon,1,['class'=>'form-control  txtinput']) !!}
                                                <p></p>
                                                @if ($errors->has('icon'))
                                                    <span class="help-block error">{{ $errors->first('icon') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   