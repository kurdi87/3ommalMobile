
                                         <div class="row" style="padding: 20px; direction: rtl">

                                             <div class="col-md-12">
                                                 <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                     <span class="lblinput">Item Name - المقدار</span>

                                                     {!! Form::text('id',isset($stat->id)?$stat->id:"0",['class'=>'hidden']) !!}

                                                     {!! Form::textarea('name',isset($stat->name)?$stat->id:"0",['class'=>'form-control txtinput-required textarea']) !!}

                                                     @if ($errors->has('name'))
                                                         <span class="help-block error">{{ $errors->first('name') }}</span>
                                                     @endif
                                                 </div>
                                             </div>

                                          <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('stat')) has-error @endif">
                                                <span class="">الكمية - Qty</span>
                                                 {!! Form::text('stat',$stat->stat,['class'=>'form-control  number-required ']) !!}
                                                @if ($errors->has('stat'))
                                                    <span class="help-block error">{{ $errors->first('stat') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                           <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('icon')) has-error @endif">
                                                <span class="">icon</span>
                                              
                                                 {!! Form::select('icon',$icon,$stat->icon,['class'=>'form-control  txtinput']) !!}
                                                <p></p>
                                                @if ($errors->has('icon'))
                                                    <span class="help-block error">{{ $errors->first('icon') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   