




<div class="row padding-15-all">





    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
            <span class="">Status</span>
            {!! Form::text('revenue_id',$revenue->id,['class'=>'hidden revenue_id']) !!}
            {!! Form::select('status',$revenue_status,isset($revenue->status)?$revenue->status:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('status'))
                <span class="help-block error">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>





</div>

