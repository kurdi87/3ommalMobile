<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit" class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info" title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/category" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i> التصنيفات
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                         <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                <span class="">الاسم</span>
                                                 {!! Form::text('name',null,['class'=>'form-control  txtinput-required ']) !!}
                                                @if ($errors->has('name'))
                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                             <div class="col-md-6">
                                                 <div class="form-group input-wlbl  @if ($errors->has('name_en')) has-error @endif">
                                                     <span class="">Name En</span>
                                                     {!! Form::text('name_en',null,['class'=>'form-control ']) !!}
                                                     @if ($errors->has('name_en'))
                                                         <span class="help-block error">{{ $errors->first('name_en') }}</span>
                                                     @endif
                                                 </div>
                                             </div>
                                        <div class="col-md-12">
                                            <div class="form-group input-wlbl  @if ($errors->has('about_category')) has-error @endif">
                                                <span class="">عن التصنيف</span>
                                                
                                                 {!! Form::textarea('about_category',null,['class'=>'form-control  category textarea ']) !!}
                                                @if ($errors->has('about_category'))
                                                    <span class="help-block error">{{ $errors->first('about_category') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                             <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('cost_from')) has-error @endif">
                                                <span class="">Cost from</span>
                                                 {!! Form::text('cost_from',null,['class'=>'form-control  txtinput-number-required txtmin']) !!}
                                                @if ($errors->has('cost_from'))
                                                    <span class="help-block error">{{ $errors->first('cost_from') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                             <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('cost_to')) has-error @endif">
                                                <span class="">Cost To</span>
                                                 {!! Form::text('cost_to',null,['class'=>'form-control   txtinput-number-required txtmax']) !!}
                                                @if ($errors->has('cost_to'))
                                                    <span class="help-block error">{{ $errors->first('cost_to') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  @if ($errors->has('d_order')) has-error @endif">
                                                <span class=""> الترتيب</span>
                                                 {!! Form::text('d_order',null,['class'=>'form-control  txtinput-number-required', 'type'=>'number']) !!}
                                                @if ($errors->has('d_order'))
                                                    <span class="help-block error">{{ $errors->first('d_order') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="form-group input-wlbl  @if ($errors->has('lang')) has-error @endif">
                                                <span class="">Language</span>
                                                 {!! Form::select('lang',$languages,2,['class'=>'form-control  txtinput']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block error">{{ $errors->first('id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                           <div class="col-md-6 hidden" >
                                            <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                <span class="">Type</span>
                                                 {!! Form::select('type',$type,null,['class'=>'form-control  txtinput']) !!}
                                                @if ($errors->has('type'))
                                                    <span class="help-block error">{{ $errors->first('type') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                             <div class="col-md-6 hidden">
                                                 <div class="form-group input-wlbl  @if ($errors->has('isroot')) has-error @endif">
                                                     <span class="">هل هي أصل</span>

                                                     {{ Form::checkbox('isroot', 1, null, ['class' => 'field hidden']) }}


                                                     @if ($errors->has('type'))
                                                         <span class="help-block error">{{ $errors->first('isroot') }}</span>
                                                     @endif
                                                 </div>
                                             </div>



                                             <div class="col-md-6 ">
                                                 <div class="form-group input-wlbl  @if ($errors->has('parent_id')) has-error @endif">
                                                     <span class="">Parent ID </span>
                                                     {!! Form::select('parent_id',$categorys,null,['class'=>'form-control select2 txtinput']) !!}

                                                     @if ($errors->has('parent_id'))
                                                         <span class="help-block error">{{ $errors->first('parent_id') }}</span>
                                                     @endif
                                                 </div>
                                             </div>
                                             <div class="col-md-6 hidden">
                                                 <div class="form-group input-wlbl  @if ($errors->has('disease_id')) has-error @endif">
                                                     <span class="">Disease</span>
                                                     {!! Form::select('disease_id',$disease,null,['class'=>'form-control select2 txtinput']) !!}

                                                     @if ($errors->has('disease_id'))
                                                         <span class="help-block error">{{ $errors->first('disease_id') }}</span>
                                                     @endif
                                                 </div>
                                             </div>

                                             <div class="col-md-12 ">
                                                 <div class="form-group input-wlbl  @if ($errors->has('isroot')) has-error @endif">
                                                     <span class="">Is Parent</span>

                                                     {{ Form::checkbox('isroot', 1, null, ['class' => 'field']) }}

                                                     @if ($errors->has('type'))
                                                         <span class="help-block error">{{ $errors->first('isroot') }}</span>
                                                     @endif
                                                 </div>
                                             </div>
                                             <div class="col-md-12">
                                                 <div class="form-group input-wlbl  @if ($errors->has('source')) has-error @endif">
                                                     <span class="">Source</span>
                                                     {!! Form::text('source',null,['class'=>'form-control  ']) !!}
                                                     @if ($errors->has('source'))
                                                         <span class="help-block error">{{ $errors->first('source') }}</span>
                                                     @endif
                                                 </div>
                                             </div>



                                         </div>

                                        <!--span-->
                                    </div>
                           
                                        <!--span-->
                                    </div>
                                    <!--row-->
                                </div>
                                <!--form body-->
                            </div>
                            <!-- END FORM-->
                        </div>
                        <!--portlet form-->
                    </div>
                    <!--portlet box-->

                </div>
                <!--tab pane-->
            </div>
            <!--tab content-->
        </div>
        <!--tabbable line-->
    </div>
    <!-- col md 12 -->
</div>

    