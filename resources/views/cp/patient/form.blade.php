@php


if(isset($dependencies))
$dep_ben=$dependencies;
else  if(isset($beneficiary))
$dep_ben=$beneficiary;
@endphp

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
                    <a href="{{ config('app.cp_route_name') }}/patient"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    @if (isset($result->id))
                        <a title="Creat Event"
                           class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered"
                           href="{{config('app.cp_route_name')}}/event/create?patient_id={{$result->id}}">
                            <i class="fa fa-ambulance"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Patient
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="portlet box blue package-form-rg">
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
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6 ">
                                                                <div class="form-group input-wlbl  @if ($errors->has('sid')) has-error @endif">
                                                                    <span class="">Document No</span>
                                                                    {!! Form::text('beneficiary_id',(isset($dep_ben)?$dep_ben->id:Null),['class'=>'form-control hidden ']) !!}
                                                                    {!! Form::text('sid',(isset($dep_ben)?$dep_ben->sid:Null),['class'=>'form-control txtinput-required ']) !!}
                                                                    @if ($errors->has('sid'))
                                                                        <span class="help-block error">{{ $errors->first('sid') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('dtype')) has-error @endif">
                                                                    <span class="">Document Type*</span>
                                                                    {!! Form::select('dtype',$dtype,(isset($beneficiary)?$beneficiary->dtype:Null),['class'=>'form-control select2 txtinput-required txtinput']) !!}
                                                                    @if ($errors->has('dtype'))
                                                                        <span class="help-block error">{{ $errors->first('dtype') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl  @if ($errors->has('file_no')) has-error @endif">
                                                                    <span class="">File Number</span>
                                                                    {!! Form::text('file_no',(isset($beneficiary)?$dep_ben->file_no:Null),['class'=>'form-control   ']) !!}
                                                                    @if ($errors->has('file_no'))
                                                                        <span class="help-block error">{{ $errors->first('file_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('lead_id')) has-error @endif">
                                                                    <span class="">Lead ID</span>
                                                                    {!! Form::text('lead_id',app('request')->input('lead_id')? app('request')->input('lead_id'):Null,['class'=>'form-control   ','readonly']) !!}
                                                                    @if ($errors->has('lead_id'))
                                                                        <span class="help-block error">{{ $errors->first('lead_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 ">
                                                                <div class="form-group input-wlbl  @if ($errors->has('created_at')) has-error @endif">
                                                                    <span class="bold">Created at</span>
                                                                    {!! Form::text('created_at',isset($result->created_at)?Date('Y-m-d',strtotime($result->created_at)):null,['class'=>'form-control','readonly']) !!}
                                                                    @if ($errors->has('created_at'))
                                                                        <span class="help-block error">{{ $errors->first('created_at') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 hidden">
                                                                <div class="form-group input-wlbl  @if ($errors->has('case_no')) has-error @endif">
                                                                    <span class="bold">Case No</span>
                                                                    {!! Form::text('case_no',app('request')->input('case_no')? app('request')->input('case_no'):Null,['class'=>'form-control   ']) !!}
                                                                    @if ($errors->has('case_no'))
                                                                        <span class="help-block error">{{ $errors->first('case_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group input-wlbl  @if ($errors->has('h_image')) has-error @endif">
                                                            <span class=""> Image</span>
                                                            <div class="profile-userpic">
                                                                <div class="upload-patient-img"
                                                                     style="{{ isset($result->image)?"background-image:url(img/patient/".$result->image.")":""}}">
                                                                    <span class="glyphicon glyphicon-cloud-upload"></span>
                                                                    {!! Form::text('image',null,['class'=>'form-control hidden icon ']) !!}
                                                                    <input type="file" name="image2"
                                                                           class="avatar-file upload-patient-img"
                                                                           id="{{ isset($result->id)?$result->id:0 }}"
                                                                           accept="image/*"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row border border-green border-margin-5">

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('fname')) has-error @endif">
                                                                    <span class="">First Name*</span>
                                                                    {!! Form::text('fname',(isset($dep_ben)?$dep_ben->fname:(app('request')->input('name')? app('request')->input('name'):Null)),['class'=>'form-control txtinput-required  ']) !!}
                                                                    @if ($errors->has('fname'))
                                                                        <span class="help-block error">{{ $errors->first('fname') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('sname')) has-error @endif">
                                                                    <span class="">Second Name*</span>
                                                                    {!! Form::text('sname',(isset($dep_ben)?$dep_ben->sname:Null),['class'=>'form-control    ']) !!}
                                                                    @if ($errors->has('sname'))
                                                                        <span class="help-block error">{{ $errors->first('sname') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('tname')) has-error @endif">
                                                                    <span class="">Third Name*</span>
                                                                    {!! Form::text('tname',(isset($dep_ben)?$dep_ben->tname:Null),['class'=>'form-control   ']) !!}
                                                                    @if ($errors->has('tname'))
                                                                        <span class="help-block error">{{ $errors->first('tname') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('faname')) has-error @endif">
                                                                    <span class="">Last  Name*</span>
                                                                    {!! Form::text('faname',(isset($dep_ben)?$dep_ben->faname:Null),['class'=>'form-control txtinput-required   ']) !!}
                                                                    @if ($errors->has('faname'))
                                                                        <span class="help-block error">{{ $errors->first('faname') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('fname_ar')) has-error @endif">
                                                                    <span class="">First Name_ar*</span>
                                                                    {!! Form::text('fname_ar',(isset($dep_ben)?$dep_ben->fname_ar:Null),['class'=>'form-control arabic txtinput-required  ']) !!}
                                                                    @if ($errors->has('fname_ar'))
                                                                        <span class="help-block error">{{ $errors->first('fname_ar') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('sname_ar')) has-error @endif">
                                                                    <span class="">Second Name_ar*</span>
                                                                    {!! Form::text('sname_ar',(isset($dep_ben)?$dep_ben->sname_ar:Null),['class'=>'form-control arabic  ']) !!}
                                                                    @if ($errors->has('sname_ar'))
                                                                        <span class="help-block error">{{ $errors->first('sname_ar') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('tname_ar')) has-error @endif">
                                                                    <span class="">Third Name_ar*</span>
                                                                    {!! Form::text('tname_ar',(isset($dep_ben)?$dep_ben->tname_ar:Null),['class'=>'form-control arabic ']) !!}
                                                                    @if ($errors->has('tname_ar'))
                                                                        <span class="help-block error">{{ $errors->first('tname_ar') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('faname_ar')) has-error @endif">
                                                                    <span class="">Last Name_ar*</span>
                                                                    {!! Form::text('faname_ar',(isset($dep_ben)?$dep_ben->faname_ar:Null),['class'=>'form-control txtinput-required arabic  ']) !!}
                                                                    @if ($errors->has('faname_ar'))
                                                                        <span class="help-block error">{{ $errors->first('faname_ar') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row border border-green border-margin-5">
                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl @if ($errors->has('bod')) has-error @endif">
                                                                    <span class="">Date of Birth</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('bod',(isset($dep_ben)?$dep_ben->bod:(isset($result->bod)? date('Y-m-d', strtotime($result->bod)):Null)),['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                                    </div>
                                                                    @if ($errors->has('bod'))
                                                                        <span class="help-block error">{{ $errors->first('bod') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group input-wlbl @if ($errors->has('birth_place')) has-error @endif">
                                                                    <span class="">Birth Place</span>

                                                                    {!! Form::select('birth_place',$country,(isset($beneficiary)?$beneficiary->birth_place:1),['class'=>'form-control select2 txtinput-required  txtinput']) !!}
                                                                    @if ($errors->has('birth_place'))
                                                                        <span class="help-block error">{{ $errors->first('birth_place') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group input-wlbl  @if ($errors->has('title')) has-error @endif">
                                                                    <span class="">Title</span>
                                                                    {!! Form::select('title',$titles,(isset($beneficiary)?$beneficiary->title:Null),['class'=>'form-control select2  ']) !!}
                                                                    @if ($errors->has('title'))
                                                                        <span class="help-block error">{{ $errors->first('title') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group input-wlbl  @if ($errors->has('gender')) has-error @endif">
                                                                    <span class="">Gender*</span>
                                                                    {!! Form::select('gender',$gender,(isset($beneficiary)?$beneficiary->gender:Null),['class'=>'form-control  select2 txtinput-required']) !!}
                                                                    @if ($errors->has('gender'))
                                                                        <span class="help-block error">{{ $errors->first('gender') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <div class="form-group input-wlbl  @if ($errors->has('blood')) has-error @endif">
                                                                    <span class="">Blood Group</span>
                                                                    {!! Form::select('blood',$blood,(isset($beneficiary)?$beneficiary->blood:Null),['class'=>'form-control select2  txtinput']) !!}
                                                                    @if ($errors->has('blood'))
                                                                        <span class="help-block error">{{ $errors->first('blood') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="portlet box red ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Address Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('country')) has-error @endif">
                                                                <span class="">Country*</span>
                                                                {!! Form::select('country',$country,(isset($beneficiary)?$beneficiary->blood:app('request')->input('country')? app('request')->input('country'):1),['class'=>'form-control txtinput-required  select2 txtinput']) !!}
                                                                @if ($errors->has('country'))
                                                                    <span class="help-block error">{{ $errors->first('country') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('city')) has-error @endif">
                                                                <span class="">City</span>
                                                                {!! Form::select('city',$city,(isset($beneficiary)?$beneficiary->city:Null),['class'=>'form-control select2 txtinput-required ']) !!}
                                                                @if ($errors->has('city'))
                                                                    <span class="help-block error">{{ $errors->first('city') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('geo')) has-error @endif">
                                                                <span class="">Geographical Location</span>
                                                                {!! Form::select('geo',$geo,null,['class'=>'form-control  select2 txtinput']) !!}
                                                                @if ($errors->has('geo'))
                                                                    <span class="help-block error">{{ $errors->first('geo') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('prov')) has-error @endif">
                                                                <span class="">Province*</span>
                                                                {!! Form::select('prov',$prov,(isset($beneficiary)?$beneficiary->prov:Null),['class'=>'form-control  select2 txtinput-required  txtinput']) !!}
                                                                @if ($errors->has('prov'))
                                                                    <span class="help-block error">{{ $errors->first('prov') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('street_1')) has-error @endif">
                                                                <span class="">Street_1*</span>
                                                                {!! Form::text('street_1',(isset($beneficiary)?$beneficiary->address:Null),['class'=>'form-control  txtinput ']) !!}
                                                                @if ($errors->has('street_1'))
                                                                    <span class="help-block error">{{ $errors->first('street_1') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('street_2')) has-error @endif">
                                                                <span class="">Street_2</span>
                                                                {!! Form::text('street_2',null,['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('street_2'))
                                                                    <span class="help-block error">{{ $errors->first('street_2') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet box green ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Contact Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body collapse-body padding-15-all">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('telephone1')) has-error @endif">
                                                                <span class="">Telephone</span>
                                                                {!! Form::text('telephone1',(isset($beneficiary)?$beneficiary->telephone:(app('request')->input('phone')? app('request')->input('phone'):Null)),['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('telephone1'))
                                                                    <span class="help-block error">{{ $errors->first('telephone1') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('stelephone')) has-error @endif">
                                                                <span class="">Sibling Telephone</span>
                                                                {!! Form::text('stelephone',app('request')->input('phone')? app('request')->input('phone'):Null,['class'=>'form-control','type'=>'telephone']) !!}
                                                                @if ($errors->has('stelephone'))
                                                                    <span class="help-block error">{{ $errors->first('stelephone') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('email')) has-error @endif">
                                                                <span class="">E-mail</span>
                                                                {!! Form::text('email',(isset($beneficiary)?$beneficiary->email:(app('request')->input('email')? app('request')->input('email'):Null)),['class'=>'form-control .txtinput-email  ']) !!}
                                                                @if ($errors->has('email'))
                                                                    <span class="help-block error">{{ $errors->first('email') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('mobile')) has-error @endif">
                                                                <span class="">Mobile</span>
                                                                {!! Form::text('mobile',(isset($beneficiary)?$beneficiary->mobile:Null),['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('mobile'))
                                                                    <span class="help-block error">{{ $errors->first('mobile') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('fax')) has-error @endif">
                                                                <span class="">Fax</span>
                                                                {!! Form::text('fax',(isset($beneficiary)?$beneficiary->fax:Null),['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('fax'))
                                                                    <span class="help-block error">{{ $errors->first('fax') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('home_tel')) has-error @endif">
                                                                <span class="">Home Tel</span>
                                                                {!! Form::text('home_tel',null,['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('home_tel'))
                                                                    <span class="help-block error">{{ $errors->first('home_tel') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('work_tel')) has-error @endif">
                                                                <span class="">Work Tel</span>
                                                                {!! Form::text('work_tel',null,['class'=>'form-control   ']) !!}
                                                                @if ($errors->has('work_tel'))
                                                                    <span class="help-block error">{{ $errors->first('work_tel') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        Other Information
                                                    </div>
                                                    <div class="tools">
                                                        <a href="" class=""> </a>

                                                    </div>
                                                </div>


                                                <div class="portlet-body  padding-15-all">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('religious')) has-error @endif">
                                                                <span class="">Religious</span>
                                                                {!! Form::select('religious',$geo,null,['class'=>'form-control select2  txtinput']) !!}
                                                                @if ($errors->has('religious'))
                                                                    <span class="help-block error">{{ $errors->first('religious') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('education')) has-error @endif">
                                                                <span class="">Education</span>
                                                                {!! Form::select('education',$education,null,['class'=>'form-control select2  txtinput']) !!}
                                                                @if ($errors->has('education'))
                                                                    <span class="help-block error">{{ $errors->first('education') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('career')) has-error @endif">
                                                                <span class="">Career</span>
                                                                {!! Form::select('career',$career,(isset($beneficiary)?$beneficiary->career:Null),['class'=>'form-control select2 txtinput']) !!}
                                                                @if ($errors->has('career'))
                                                                    <span class="help-block error">{{ $errors->first('career') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('marital_status')) has-error @endif">
                                                                <span class="">Marital Status</span>
                                                                {!! Form::select('marital_status',$marital_status,(isset($beneficiary)?$beneficiary->marital_status:Null),['class'=>'form-control select2 txtinput']) !!}
                                                                @if ($errors->has('marital_status'))
                                                                    <span class="help-block error">{{ $errors->first('marital_status') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group input-wlbl  @if ($errors->has('childrens')) has-error @endif">
                                                                <span class="">Childrens</span>
                                                                {!! Form::text('childrens',null,['class'=>'form-control txtinput-filter-number   ']) !!}
                                                                @if ($errors->has('fax'))
                                                                    <span class="help-block error">{{ $errors->first('childrens') }}</span>
                                                                @endif
                                                            </div>
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



    