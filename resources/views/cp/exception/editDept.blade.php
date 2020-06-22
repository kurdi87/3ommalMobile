    <script>
      jQuery(document).ready(function () {
    $('.textareaDept').wysihtml5();
  });
    </script>
                                         <div class="row" style="padding: 20px;">
                                          <div class="col-md-12">

                                               {!! Form::text('id',isset($hosDept->id)?$hosDept->id:"0",['class'=>'hidden']) !!}
                                           
                                                <p>Department ( <span class="danger">{{$deptName}}</span> )</p>
                                                 
                                               
                                            </div>
                                     

                                    
                                              <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('keywords')) has-error @endif">
                                                <span class="">Keywords </span>
                                                <div class="alert alert-danger" role="alert">
                                                  <strong>Format Must Be</strong> #Keyword1;  #Keyword2; ...etc 
                                                </div>
                                                 {!! Form::textarea('keywords',$hosDept->keywords,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('keywords'))
                                                    <span class="help-block error">{{ $errors->first('keywords') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                            <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('about_department')) has-error @endif">
                                                <span >About Department</span>
                                                 {!! Form::textarea('about_department',$hosDept->about_department,['class'=>'textareaDept  form-control  txtinput-required  ']) !!}
                                                  <p></p>
                                                @if ($errors->has('about_department'))
                                                    <span class="help-block error">{{ $errors->first('about_department') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                          

                                
                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('head_id')) has-error @endif">
                                                <span class="">Head</span>
                                                


                                                 {!! Form::select('head_id',$doctor,$hosDept->head_id,['class'=>'form-control  txtinput']) !!}
                                                <p></p>
                                                @if ($errors->has('head_id'))
                                                    <span class="help-block error">{{ $errors->first('head_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   