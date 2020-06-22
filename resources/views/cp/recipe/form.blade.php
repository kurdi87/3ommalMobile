<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button people="save_new" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/recipe"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>Recipe - وصفة
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
                                                        <span class="">Name - الاسم</span>
                                                        {!! Form::text('name',null,['class'=>'form-control  text-required ']) !!}
                                                        @if ($errors->has('name'))
                                                            <span class="help-block error">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group input-wlbl  @if ($errors->has('people')) has-error @endif">
                                                        <span class="">people - الأشخاص</span>
                                                        {!! Form::text('people',null,['class'=>'form-control   ']) !!}
                                                        @if ($errors->has('people'))
                                                            <span class="help-block error">{{ $errors->first('people') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('recipe_time')) has-error @endif">
                                                        <span class=""> Time- وقت </span>
                                                        <div class="input-group">
                                                            {!! Form::text('recipe_time',null,['class'=>'form-control  txtinput-number-required  ',"type"=>"number"]) !!}
                                                            <span class="input-group-addon"
                                                                  id="basic-addon2">دقيقة</span>
                                                        </div>
                                                        @if ($errors->has('recipe_time'))
                                                            <span class="help-block error">{{ $errors->first('recipe_time') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group input-wlbl  @if ($errors->has('rate')) has-error @endif">
                                                        <span class="">Rate - التقييم</span>
                                                        {!! Form::text('rate',number_format((rand(45, 50))/10,1),['class'=>'form-control  number ']) !!}
                                                        @if ($errors->has('rate'))
                                                            <span class="help-block error">{{ $errors->first('rate') }}</span>
                                                        @endif
                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('web_address')) has-error @endif">
                                                        <span class="">Web Address - المصدر</span>
                                                        {!! Form::text('web_address',null,['class'=>'form-control   ']) !!}
                                                        @if ($errors->has('web_address'))
                                                            <span class="help-block error">{{ $errors->first('web_address') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">

                                                    <div class="form-group input-wlbl  @if ($errors->has('information')) has-error @endif">
                                                        <span class="">Short Description - وصف مختصر </span>

                                                        {!! Form::textarea('information',null,['class'=>'form-control   ']) !!}
                                                        @if ($errors->has('information'))
                                                            <span class="help-block error">{{ $errors->first('information') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 hidden">
                                                    <div class="form-group input-wlbl  @if ($errors->has('country')) has-error @endif">
                                                        <span class="hidden">الدولة </span>
                                                        {!! Form::select('country',$country,null,['class'=>'form-control select2  txtinput']) !!}
                                                        @if ($errors->has('id'))
                                                            <span class="help-block error">{{ $errors->first('id') }}</span>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('icon')) has-error @endif">
                                                        <span class="">Recipe  Image - الصورة الرئيسية</span>
                                                        <div class=" uploading alert alert-default hidden text-center"><span
                                                                    class="glyphicon glyphicon-cloud-upload">Uploading....</span>
                                                        </div>
                                                        <div class="profile-userpic">
                                                            <div class="upload-recipe-img"
                                                                 style="{{ isset($result->icon)?"background-image:url(img/recipe/".$result->icon.")":""}}">
                                                                {!! Form::text('icon','1.jpg',['class'=>'form-control hidden icon ']) !!}
                                                                <input type="file" name="image"
                                                                       class="avatar-file upload-recipe-img"
                                                                       id="{{ isset($result->id)?$result->id:0 }}"
                                                                       accept="image/*"/>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                        <span class="">Is Main - رئيسية</span>
                                                        {!! Form::select('ismain',$ismain,null,['class'=>'form-control  txtinput']) !!}
                                                        @if ($errors->has('type'))
                                                            <span class="help-block error">{{ $errors->first('ismain') }}</span>
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('city')) has-error @endif">
                                                <span class="">Country</span>
                                                {!! Form::text('city',null,['class'=>'form-control  number ']) !!}
                                                @if ($errors->has('city'))
                                                    <span class="help-block error">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('types')) has-error @endif">
                                                <span class="">Type - النوع</span>
                                                {!! Form::select('types',$types,isset($result->type)?$result->type:'',['class'=>'form-control  txtinput']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block error">{{ $errors->first('id') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('telephone')) has-error @endif">
                                                <span class="">Telephone</span>
                                                {!! Form::text('telephone',null,['class'=>'form-control   ']) !!}
                                                @if ($errors->has('telephone'))
                                                    <span class="help-block error">{{ $errors->first('telephone') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('fax')) has-error @endif">
                                                <span class="">Fax</span>
                                                {!! Form::text('fax',null,['class'=>'form-control  txtinput ']) !!}
                                                @if ($errors->has('fax'))
                                                    <span class="help-block error">{{ $errors->first('fax') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('map_address')) has-error @endif">
                                                <span class="">Google Map longitude, latitude </span>
                                                {!! Form::text('map_address',null,['class'=>'form-control   ']) !!}
                                                @if ($errors->has('map_address'))
                                                    <span class="help-block error">{{ $errors->first('map_address') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('map_link')) has-error @endif">
                                                <span class="">Map_Link</span>
                                                {!! Form::text('map_link',null,['class'=>'form-control   ']) !!}
                                                @if ($errors->has('map_link'))
                                                    <span class="help-block error">{{ $errors->first('map_link') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('facebook_address')) has-error @endif">
                                                <span class="">Facebook_address</span>
                                                {!! Form::text('facebook_address',null,['class'=>'form-control  txtinput ']) !!}
                                                @if ($errors->has('facebook_address'))
                                                    <span class="help-block error">{{ $errors->first('facebook_address') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('twitter_address')) has-error @endif">
                                                <span class="">Twitter_address</span>
                                                {!! Form::text('twitter_address',null,['class'=>'form-control  txtinput ']) !!}
                                                @if ($errors->has('twitter_address'))
                                                    <span class="help-block error">{{ $errors->first('twitter_address') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('insta_address')) has-error @endif">
                                                <span class="">Insta_address</span>
                                                {!! Form::text('insta_address',null,['class'=>'form-control  txtinput ']) !!}
                                                @if ($errors->has('insta_address'))
                                                    <span class="help-block error">{{ $errors->first('insta_address') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-12 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('overview')) has-error @endif">
                                                <span class="">Overview</span>
                                                {!! Form::textarea('overview',null,['class'=>'form-control textarea   ','rows'=>'20']) !!}
                                                @if ($errors->has('overview'))
                                                    <span class="help-block error">{{ $errors->first('overview') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  @if ($errors->has('lang')) has-error @endif">
                                                <span class="">Language</span>
                                                {!! Form::select('lang',$languages,1,['class'=>'form-control  txtinput']) !!}
                                                @if ($errors->has('id'))
                                                    <span class="help-block error">{{ $errors->first('id') }}</span>
                                                @endif
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


    <!-- col md 12 -->
</div>

    