<script>
    jQuery(document).ready(function () {
        $('.textareaPro').wysihtml5();
    });
</script>
<div class="row addpro" style="padding: 20px;">
    <div class="col-md-12">

        {!! Form::text('id',isset($procedure->id)?$procedure->id:"0",['class'=>'hidden']) !!}

        <p>Procedure - إجراء : ( <span class="danger">{{$procedureName}}</span> )</p>


    </div>


    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('qty')) has-error @endif">
            <span>Qty - كمية</span>
            {!! Form::text('qty',$procedure->qty,['class'=>'form-control qty txtinput-number-required  ','type'=>'number','id'=>'qty']) !!}
            @if ($errors->has('qty'))
                <span class="help-block error">{{ $errors->first('qty') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('exchange')) has-error @endif">
            <span>Exchange -تحويل</span>
            {!! Form::text('exchange',$procedure->exchange,['class'=>'form-control exchange txtinput-number-required  ']) !!}
            @if ($errors->has('exchange'))
                <span class="help-block error">{{ $errors->first('exchange') }}</span>
            @endif
        </div>
    </div> <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('cost')) has-error @endif">
            <span>Cost ILS - التكلفة شيقل</span>
            {!! Form::text('cost',$procedure->cost,['class'=>'form-control cost  txtinput-number-required  ']) !!}
            @if ($errors->has('cost'))
                <span class="help-block error">{{ $errors->first('cost') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costdolar')) has-error @endif">
            <span class="text-success">Total Cost $ - دولار</span>
            {!! Form::text('costdolar',$procedure->costnis/$procedure->exchange,['class'=>'form-control dolar   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costdolar'))
                <span class="help-block error">{{ $errors->first('costdolar') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costnis')) has-error @endif">
            <span class="text-success">Total Cost ILS - مجموع التكلفة</span>
            {!! Form::text('costnis',$procedure->costnis,['class'=>'form-control nis   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costnis'))
                <span class="help-block error">{{ $errors->first('costnis') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('about_procedure')) has-error @endif">
            <span>About Procedure - عن التكلفة</span>

            {!! Form::textarea('about_procedure',$procedure->about_procedure,['class'=>'form-control  txtinput-required textarea','rows'=>'2']) !!}
            @if ($errors->has('about_procedure'))
                <span class="help-block error">{{ $errors->first('about_procedure') }}</span>
            @endif
        </div>
    </div>

</div>

                                           
                                              
                                    
                                   