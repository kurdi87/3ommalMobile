<script>
    jQuery(document).ready(function () {
        $('.textareaMed').wysihtml5();
    });
</script>
<div class="row addmed" style="padding: 20px;">
    <div class="col-md-12">


        {!! Form::text('id',isset($medication->id)?$medication->id:"0",['class'=>'hidden']) !!}

        <p>Medication: ( <span class="danger">{{$medicationName}}</span> )</p>


    </div>


    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('qty')) has-error @endif">
            <span>Qty - الكمية</span>
            {!! Form::text('qty',$medication->qty,['class'=>'form-control mqty txtinput-number-required  ','type'=>'number','id'=>'qty']) !!}
            @if ($errors->has('qty'))
                <span class="help-block error">{{ $errors->first('qty') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('exchange')) has-error @endif">
            <span>Exchange - العلملة </span>
            {!! Form::text('exchange',$medication->exchange,['class'=>'form-control mexchange txtinput-number-required  ']) !!}
            @if ($errors->has('exchange'))
                <span class="help-block error">{{ $errors->first('exchange') }}</span>
            @endif
        </div>
    </div> <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('cost')) has-error @endif">
            <span>Cost ILS</span>
            {!! Form::text('cost',$medication->cost,['class'=>'form-control mcost  txtinput-number-required  ']) !!}
            @if ($errors->has('cost'))
                <span class="help-block error">{{ $errors->first('cost') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costdolar')) has-error @endif">
            <span class="text-success">Total Cost $</span>
            {!! Form::text('costdolar',$medication->costnis/$medication->exchange,['class'=>'form-control dolar   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costdolar'))
                <span class="help-block error">{{ $errors->first('costdolar') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costnis')) has-error @endif">
            <span class="text-success">Total Cost ILS -إجمالي التكلفة شيقل</span>
            {!! Form::text('costnis',$medication->costnis,['class'=>'form-control mnis   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costnis'))
                <span class="help-block error">{{ $errors->first('costnis') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('about_medication')) has-error @endif">
            <span>About Medication - عن العالج</span>

            {!! Form::textarea('about_medication',$medication->about_medication,['class'=>'form-control  txtinput-required textarea','rows'=>'2']) !!}
            @if ($errors->has('about_medication'))
                <span class="help-block error">{{ $errors->first('about_medication') }}</span>
            @endif
        </div>
    </div>

</div>

                                           
                                              
                                    
                                   