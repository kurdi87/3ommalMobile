<script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>
<script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
        type="text/javascript"></script>

<script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>


<div class="row padding-15-all">


    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
            <span class="">Status</span>
            {!! Form::text('referral_id',$referral->id,['class'=>'hidden referral_id']) !!}
            {!! Form::select('status',$referral_status,isset($referral->status)?$referral->status:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('status'))
                <span class="help-block error">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2 ">
        <div class="form-group input-wlbl @if ($errors->has('next_referral')) has-error @endif">
            <span class="">Send Date</span>

            <div class="input-group input-large  date date-picker"
                 data-date-format="yyyy-mm-dd"
                 data-date-viewmode="years">
                {!! Form::text('send_date',isset($referral->send_date)? date('Y-m-d', strtotime($referral->send_date)):'',['class'=>'form-control']) !!}
                <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
            </div>
            @if ($errors->has('next_referral'))
                <span class="help-block error">{{ $errors->first('next_date') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('send_to')) has-error @endif">
            <span class="">TO</span>

            {!! Form::select('send_to',$send_to,isset($referral->send_to)?$referral->send_to:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('send_to'))
                <span class="help-block error">{{ $errors->first('send_to') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('send_note')) has-error @endif">
            <span class="">Note</span>
            {!! Form::textarea('send_note',isset($referral->send_note)?$referral->send_note:'',['class'=>'form-control','rows'=>'3']) !!}
            @if ($errors->has('send_note'))
                <span class="help-block error">{{ $errors->first('send_note') }}</span>
            @endif
        </div>
    </div>


</div>

