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


    <div class="col-md-8 col-md-offset-2 ">
        <div class="form-group input-wlbl @if ($errors->has('action_date')) has-error @endif">
            <span class="">Action Date</span>

            <div class="input-group input-large  date date-picker"
                 data-date-format="yyyy-mm-dd"
                 data-date-viewmode="years">
                {!! Form::text('action_date',isset($gop->action_date)? date('Y-m-d', strtotime($gop->action_date)):'',['class'=>'form-control']) !!}
                <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
            </div>
            @if ($errors->has('action_date'))
                <span class="help-block error">{{ $errors->first('action_date') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-4 col-md-offset-2">
        <div class="form-group input-wlbl  @if ($errors->has('action')) has-error @endif">
            <span class="">Action - الحركة</span>
            {!! Form::text('gop_id',$gop->id,['class'=>'hidden gop_id']) !!}
            {!! Form::select('action',$gop_action,isset($gop->action)?$gop->action:'',['class'=>'form-control  txtinput']) !!}
            @if ($errors->has('action'))
                <span class="help-block error">{{ $errors->first('action') }}</span>
            @endif
        </div>
    </div>






</div>

