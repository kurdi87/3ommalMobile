   <script>
      jQuery(document).ready(function () {
    $('.textareaCategory').wysihtml5();
  });
    </script>
                                         <div class="row addcategory" style="padding: 20px;">
                                          <div class="col-md-12">

                                               {!! Form::text('id',isset($category->id)?$category->id:"0",['class'=>'hidden']) !!}
                                           
                                                <p>Category - التصنيف: ( <span class="danger">{{$categoryName}}</span> )</p>
                                                 
                                               
                                            </div>
                                     

                                       <div class="col-md-12 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('about_category')) has-error @endif">
                                                <span >About Category - عن التصنيف</span>
                                                 {!! Form::textarea('about_category',$category->about_category,['class'=>'form-control  textareaCategory ']) !!}
                                                @if ($errors->has('about_category'))
                                                    <span class="help-block error">{{ $errors->first('about_category') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                          <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('fee')) has-error @endif">
                                                <span >Fee</span>
                                                 {!! Form::text('fee',$category->fee,['class'=>'form-control  ']) !!}
                                                @if ($errors->has('fee'))
                                                    <span class="help-block error">{{ $errors->first('fee') }}</span>
                                                @endif
                                            </div>
                                        </div>



                                            </div>

                                           
                                              
                                    
                                   