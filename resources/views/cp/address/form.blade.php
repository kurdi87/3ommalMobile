<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/address"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>

                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Address
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="portlet box green package-form-rg">
                                            <div class="portlet-title myptitle">
                                                <div class="caption">
                                                    Basic Information
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse">ff</a>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="portlet-body  collapse-body padding-15-all"
                                                 id="collapseExample">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group input-wlbl  @if ($errors->has('h_image')) has-error @endif">
                                                            <span class=""> Image</span>
                                                            <div class="profile-userpic">
                                                                <div class="upload-address-img"
                                                                     style="{{ isset($result->image)?"background-image:url(img/address/".$result->image.")":""}}">
                                                                    <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                    {!! Form::text('image',null,['class'=>'form-control hidden icon ']) !!}
                                                                    <input type="file" name="image2"
                                                                           class="avatar-file upload-address-img"
                                                                           id="{{ isset($result->id)?$result->id:0 }}"
                                                                           accept="image/*"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                            <span class="">Name</span>
                                                            {!! Form::text('name',null,['class'=>'form-control   ']) !!}
                                                            @if ($errors->has('name'))
                                                                <span class="help-block error">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>




                                                <div class="row">
                                                    <div class="col-md-6  ">
                                                        <div class="form-group">
                                                            <label for="single" class="control-label">Contact Type</label>
                                                            {!! Form::select('type',$type,null,['class'=>'form-control select2  ']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('email')) has-error @endif">
                                                            <span class="">E-mail</span>
                                                            {!! Form::text('email',app('request')->input('email')? app('request')->input('email'):Null,['class'=>'form-control .txtinput-email  ']) !!}
                                                            @if ($errors->has('email'))
                                                                <span class="help-block error">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('mobile')) has-error @endif">
                                                            <span class="">Mobile</span>
                                                            {!! Form::text('mobile',null,['class'=>'form-control   ']) !!}
                                                            @if ($errors->has('mobile'))
                                                                <span class="help-block error">{{ $errors->first('mobile') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('fax')) has-error @endif">
                                                            <span class="">Fax</span>
                                                            {!! Form::text('fax',null,['class'=>'form-control   ']) !!}
                                                            @if ($errors->has('fax'))
                                                                <span class="help-block error">{{ $errors->first('fax') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                            <span class="">Telephone</span>
                                                            {!! Form::text('telephone',null,['class'=>'form-control   ']) !!}
                                                            @if ($errors->has('telephone'))
                                                                <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('prov')) has-error @endif">
                                                            <span class="">Province*</span>
                                                            {!! Form::select('prov',$prov,null,['class'=>'form-control  select2   txtinput']) !!}
                                                            @if ($errors->has('prov'))
                                                                <span class="help-block error">{{ $errors->first('prov') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('title_id')) has-error @endif">
                                                            <span class="">Title</span>
                                                            {!! Form::select('title_id',$titles,null,['class'=>'form-control select2  ']) !!}
                                                            @if ($errors->has('title_id'))
                                                                <span class="help-block error">{{ $errors->first('title_id') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('hospital_id')) has-error @endif">
                                                            <span class="">Facility</span>
                                                            {!! Form::select('hospital_id',$hospital,null,['class'=>'form-control select2  txtinput']) !!}
                                                            @if ($errors->has('hospital_id'))
                                                                <span class="help-block error">{{ $errors->first('hospital_id') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 hidden ">
                                                        <div class="form-group">
                                                            <label for="single" class="control-label">Financing Party</label>
                                                            <select id="finance_party" name="finance_party" class="form-control select2 " >
                                                                <option></option>
                                                                <optgroup label="Financing Party">
                                                                    @foreach($finance_party as $c)
                                                                        <option {{(isset($result->finance_party) && ($result->finance_party==$c->id)?'selected':Null)}} value="{{$c->id}}">{{$c->name}}</option>
                                                                    @endforeach
                                                                </optgroup>


                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                            <span class="">Department</span>
                                                            {!! Form::select('department_id',$department,null,['class'=>'form-control select2  txtinput']) !!}
                                                            @if ($errors->has('department_id'))
                                                                <span class="help-block error">{{ $errors->first('department_id') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('lang')) has-error @endif">
                                                            <span class="">Language</span>
                                                            {!! Form::select('lang',$languages,null,['class'=>'form-control select2  txtinput']) !!}
                                                            @if ($errors->has('lang'))
                                                                <span class="help-block error">{{ $errors->first('lang') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('speciality')) has-error @endif">
                                                            <span class="">Specility</span>
                                                            {!! Form::select('speciality',$speciality,null,['class'=>'form-control select2  txtinput']) !!}
                                                            @if ($errors->has('speciality'))
                                                                <span class="help-block error">{{ $errors->first('speciality') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group input-wlbl  @if ($errors->has('note')) has-error @endif">
                                                            <span class="">Note</span>
                                                            {!! Form::textarea('note',null,['class'=>'form-control   ']) !!}
                                                            @if ($errors->has('note'))
                                                                <span class="help-block error">{{ $errors->first('note') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>







                                                </div>

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



    