
                                         <div class="row addpro" style="padding: 20px;">
                                             <div class="col-md-12">
                                                 <a title="Add New Dieseas" data-toggle="modal"   data-modal="modal-ndieseasadd"
                                                    class="ndieseasmodal btn btn-circle btn-icon-only btn-default tooltip-one-info" data-id=""
                                                    href="#">
                                                     <i class="fa fa-plus"> </i>
                                                 </a> Click Here To Add New Dieseas
                                             </div>

                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('recipe_id')) has-error @endif">
                                                <span class="lblinput"></span>
                                                 {!! Form::text('recipe_id',isset($result->id)?$result->id:"0",['class'=>'hidden recipe_id txtinput-required']) !!}
                                                


                                                <select id="dieseas_id" name="dieseas_id" class="form-control select2 dieseas_id " style="width: 100%">
                                                    <option></option>
                                                    <optgroup label=" Name">
                                                        @foreach($dieseas as $c)
                                                            <option value="{{$c->id}}">{{$c->name}} <span class="text text-danger">(Type:{{\App\Models\TypesModel::getTypeName($c->type)}})</span>
                                                            </option>
                                                        @endforeach
                                                    </optgroup>


                                                </select>
                                              
                                                @if ($errors->has('recipe_id'))
                                                    <span class="help-block error">{{ $errors->first('recipe_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        



                                            <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                <span >Dieseas Name</span>

                                                 {!! Form::textarea('notes',null,['class'=>'form-control  txtinput-required textarea','rows'=>'15']) !!}
                                                @if ($errors->has('notes'))
                                                    <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                @endif
                                            </div>

                                        
                                        
                                         
                                           


                                            </div>
                                         </div>

                                           
                                              
                                    
                                   