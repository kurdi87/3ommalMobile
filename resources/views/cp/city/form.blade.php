<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/city"
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
                                <i class="icon-globe"></i>City
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('name_en')) has-error @endif">
                                                    <span class="">Name En</span>
                                                    {!! Form::text('name_en',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('name_en'))
                                                        <span class="help-block error">{{ $errors->first('name_en') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  @if ($errors->has('name_ar')) has-error @endif">
                                                    <span class="">Name Ar</span>
                                                    {!! Form::text('name_ar',null,['class'=>'form-control  txtinput-required ']) !!}
                                                    @if ($errors->has('name_ar'))
                                                        <span class="help-block error">{{ $errors->first('name_ar') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group input-wlbl  @if ($errors->has('country_id')) has-error @endif">
                                                    <span class="">Country</span>
                                                    {!! Form::select('country_id',$country,null,['class'=>'form-control  txtinput']) !!}
                                                    @if ($errors->has('country_id'))
                                                        <span class="help-block error">{{ $errors->first('country_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                    <span class="">Is Prov</span>
                                                    <input type="checkbox" value="{{isset($result->type)?$result->type:0}}" {{isset($result->type)&&$result->type==1?'checked':''}} id="type" name="type" id="type">
                                                    @if ($errors->has('type'))
                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('prov')) has-error @endif">
                                                    <span class="">Province*</span>
                                                    {!! Form::select('prov',$prov,null,['class'=>'form-control  select2 txtinput-required  txtinput']) !!}
                                                    @if ($errors->has('prov'))
                                                        <span class="help-block error">{{ $errors->first('prov') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  @if ($errors->has('region')) has-error @endif">
                                                    <span class="">Region</span>
                                                    {!! Form::select('region',$region,null,['class'=>'form-control  select2 txtinput-required  txtinput']) !!}
                                                    @if ($errors->has('region'))
                                                        <span class="help-block error">{{ $errors->first('region') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            





                                            <div class="col-md-3 hidden">
                                                <div class="form-group input-wlbl  @if ($errors->has('img')) has-error @endif">
                                                    <span class="">City Image</span>
                                                    <div class="profile-userpic">
                                                        <div class="upload-country-img"
                                                             style="{{ isset($result->img)?"background-image:url(img/country/".$result->img.")":"background-image:url(img/country/1.jpg"}}">
                                                            <span class="glyphicon glyphicon-cloud-upload"></span>
                                                            <span class="uploading hidden" data-spinner="1"
                                                                  style=""><img src="/img/load.gif"
                                                                                style="height: 60px;width: auto;margin: auto;position: relative;display: block;"></span>
                                                            {!! Form::text('img',null,['class'=>'form-control hidden icon ']) !!}
                                                            <input type="file" name="image"
                                                                   class="avatar-file upload-country-img"
                                                                   id="{{ isset($result->id)?$result->id:0 }}"
                                                                   accept="image/*"/>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>


            <!--tab pane-->
        </div>
        <!--tab content-->
    </div>


    <!--tabbable line-->
</div>


    