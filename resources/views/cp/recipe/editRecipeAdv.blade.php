
<div class="row" style="padding: 20px; direction: rtl">
    <div class="col-md-12">

        {!! Form::text('id',isset($adv->id)?$adv->id:"0",['class'=>'hidden']) !!}

        <div class="col-md-12">
            <div class="form-group input-wlbl  @if ($errors->has('adv')) has-error @endif">




                {!! Form::text('adv',$adv->adv,['class'=>'form-control']) !!}

                @if ($errors->has('adv'))
                    <span class="help-block error">{{ $errors->first('adv') }}</span>
                @endif
            </div>
        </div>


    

    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('adv_order')) has-error @endif">
            <span class="">Adv Order</span>
            {!! Form::text('adv_order',$adv->adv_order,['class'=>'form-control  number-required ']) !!}
            @if ($errors->has('adv_order'))
                <span class="help-block error">{{ $errors->first('adv_order') }}</span>
            @endif
        </div>
    </div>

        <div class="col-md-6 hidden">
            <div class="form-group input-wlbl  @if ($errors->has('adv_time')) has-error @endif">
                <span class="">Step Time- وقت </span>
                <div class="input-group">
                    {!! Form::text('adv_time',$adv->adv_time,['class'=>'form-control  txtinput-number-required  ',"type"=>"number"]) !!}
                    <span class="input-group-addon" id="basic-addon2">دقيقة</span>
                </div>
                @if ($errors->has('adv_time'))
                    <span class="help-block error">{{ $errors->first('adv_time') }}</span>
                @endif
            </div>
        </div>
    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('icon')) has-error @endif">
            <span class="">Step  Image - صورة الوصفة</span>
            <div class=" uploading alert alert-default hidden text-center"><span
                        class="glyphicon glyphicon-cloud-upload">Uploading....</span></div>
            <div class="profile-userpic">
                <div class="upload-recipe-photo"
                     style="{{ isset($adv->icon)?"background-image:url(img/recipe/gallery/".$adv->icon.")":"background-image:url(img/recipe/gallery/1.png"}}">
                    <span class="glyphicon glyphicon-cloud-upload"></span>
                    {!! Form::text('icon','1.png',['class'=>'form-control hidden icon ']) !!}
                    <input type="file" name="image"  module ="adv" class="avatar-file upload-recipe-photo"
                           id="{{ isset($adv->id)?$adv->id:0 }}"" accept="image/*" />
                </div>

            </div>
        </div>
    </div>
                                             

</div>

                                           
                                              
                                    
                                   