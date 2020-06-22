




<div class="row padding-15-all">





    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
            <span class="">Status</span>
            {!! Form::text('commitment_id',$commitment->id,['class'=>'hidden commitment_id']) !!}
            {!! Form::select('status',$commitment_status,isset($commitment->status)?$commitment->status:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('status'))
                <span class="help-block error">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>





</div>

