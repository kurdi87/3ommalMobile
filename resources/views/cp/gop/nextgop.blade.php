




<div class="row padding-15-all">





    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
            <span class="">Status - الحالة</span>
            {!! Form::select('status',$gop_status,isset($gop->status)?$gop->status:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('status'))
                <span class="help-block error">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2 hidden">
        <div class="form-group input-wlbl @if ($errors->has('next_gop')) has-error @endif">
            <span class="">Next gop Date</span>

            <div class="input-group input-large  date date-picker"
                 data-date-format="yyyy-mm-dd"
                 data-date-viewmode="years" >
                {!! Form::text('next_gop',isset($result->next_gop)? date('Y-m-d', strtotime($result->next_gop)):'',['class'=>'form-control']) !!}
                <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
            </div>
            @if ($errors->has('next_gop'))
                <span class="help-block error">{{ $errors->first('next_gop') }}</span>
            @endif
        </div>
    </div>




    <div class="col-md-8 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
            <span class="lblinput">Notes</span>

            {!! Form::text('gop_id',$gop->id,['class'=>'hidden gop_id']) !!}
            <input name="token" type="hidden" value="{{ csrf_token() }}">
            {!! Form::textarea('notes',null,['class'=>'form-control  txtinput-required textarea' ,'rows'=>'3']) !!}

            @if ($errors->has('notes'))
                <span class="help-block error">{{ $errors->first('notes') }}</span>
            @endif
        </div>
    </div>





</div>

