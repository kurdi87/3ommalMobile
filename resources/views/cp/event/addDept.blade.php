
                                         <div class="row" style="padding: 20px;">

                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('event_id')) has-error @endif">
                                                <span class="">Department Name</span>
                                                 {!! Form::text('event_id',isset($result->id)?$result->id:"0",['class'=>'hidden event_id txtinput-required']) !!}
                                                

                                                 {!! Form::select('department_id',$department,null,['class'=>'form-control dept txtinput-required select2' ,'id'=>'dept_id']) !!}
                                              
                                                @if ($errors->has('event_id'))
                                                    <span class="help-block error">{{ $errors->first('event_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                    


                                            <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('about_department')) has-error @endif">
                                                <span >About Department</span>

                                                 {!! Form::textarea('about_department',null,['class'=>'form-control  txtinput-required textarea','rows'=>'3']) !!}
                                                @if ($errors->has('about_department'))
                                                    <span class="help-block error">{{ $errors->first('about_department') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                          

                                

                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   