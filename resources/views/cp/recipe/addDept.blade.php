
                                         <div class="row addpro" style="padding: 20px;">

                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('recipe_id')) has-error @endif">
                                                <span class="lblinput">Department Name</span>
                                                 {!! Form::text('recipe_id',isset($result->id)?$result->id:"0",['class'=>'hidden recipe_id txtinput-required']) !!}
                                                

                                                 {!! Form::select('department_id',$department,1,['class'=>'form-control select2 deptdoct txtinput-required' ,'id'=>'dept_id']) !!}
                                              
                                                @if ($errors->has('recipe_id'))
                                                    <span class="help-block error">{{ $errors->first('recipe_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                    
                                              <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('keywords')) has-error @endif">
                                                <span class="">Keywords </span>
                                                   <div class="alert alert-danger" role="alert">
                                                  <strong>Format Must Be</strong> #Keyword1;  #Keyword2; ...etc 
                                                </div>
                                                 {!! Form::textarea('keywords',null,['class'=>'form-control  txtinput-required ','rows'=>'10']) !!}
                                                @if ($errors->has('keywords'))
                                                    <span class="help-block error">{{ $errors->first('keywords') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                            <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('about_department')) has-error @endif">
                                                <span >About Department</span>
                                                  <div class="alert alert-danger" role="alert">
                                                  <strong> Website Display</strong> Max 250 Character.
                                                </div>
                                                 {!! Form::textarea('about_department',null,['class'=>'form-control  txtinput-required textarea','rows'=>'15']) !!}
                                                @if ($errors->has('about_department'))
                                                    <span class="help-block error">{{ $errors->first('about_department') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                          

                                
                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('head_id')) has-error @endif">
                                                <span class="">Head</span>
                                                


                                                 {!! Form::select('head_id',$doctor,1,['class'=>'form-control  select2 dept txtinput']) !!}
                                                <p></p>
                                                @if ($errors->has('head_id'))
                                                    <span class="help-block error">{{ $errors->first('head_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   