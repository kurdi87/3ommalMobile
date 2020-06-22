




<div class="row padding-15-all">





    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
            <span class="">Status</span>
            {!! Form::text('payment_id',$payment->id,['class'=>'hidden payment_id']) !!}
            {!! Form::select('status',$payment_status,isset($payment->status)?$payment->status:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('status'))
                <span class="help-block error">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>





</div>

