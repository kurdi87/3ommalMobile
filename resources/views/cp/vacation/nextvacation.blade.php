




<div class="row padding-15-all">





    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
            <span class="">Status - الحالة</span>
            {!! Form::select('status',$vacation_status,isset($vacation->status)?$vacation->status:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('status'))
                <span class="help-block error">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>






    <div class="col-md-8 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
            <span class="lblinput">Notes - ملاحظات</span>

            {!! Form::text('vacation_id',$vacation->id,['class'=>'hidden vacation_id']) !!}
            <input name="token" type="hidden" value="{{ csrf_token() }}">
            {!! Form::textarea('notes',null,['class'=>'form-control  txtinput-required textarea' ,'rows'=>'3']) !!}

            @if ($errors->has('notes'))
                <span class="help-block error">{{ $errors->first('notes') }}</span>
            @endif
        </div>
    </div>





</div>

