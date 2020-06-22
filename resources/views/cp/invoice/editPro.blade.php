<script>
    jQuery(document).ready(function () {
        $('.textareaPro').wysihtml5();
    });
    $('.other_notes').select2({
        placeholder: 'Select an option',
    });
</script>
<div class="row " style="padding: 20px;">
    <div class="col-md-12">

        {!! Form::text('id',isset($procedure->id)?$procedure->id:"0",['class'=>'hidden']) !!}

        <p>Procedure: ( <span class="danger">{{$procedureName}}</span> )</p>


    </div>


    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('qty')) has-error @endif">
            <span>Qty</span>
            {!! Form::text('qty',$procedure->qty,['class'=>'form-control qty txtinput-number-required  ','type'=>'number','id'=>'qty']) !!}
            @if ($errors->has('qty'))
                <span class="help-block error">{{ $errors->first('qty') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('exchange')) has-error @endif">
            <span>Exchange </span>
            {!! Form::text('exchange',($procedure->exchange>0)?$procedure->exchange:3.5,['class'=>'form-control exchange txtinput-number-required  ']) !!}
            @if ($errors->has('exchange'))
                <span class="help-block error">{{ $errors->first('exchange') }}</span>
            @endif
        </div>
    </div> <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('cost')) has-error @endif">
            <span>Cost ILS</span>
            {!! Form::text('cost',$procedure->cost,['class'=>'form-control cost  txtinput-number-required  ']) !!}
            @if ($errors->has('cost'))
                <span class="help-block error">{{ $errors->first('cost') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costdolar')) has-error @endif">
            <span class="text-success">Total Cost $</span>
            {!! Form::text('costdolar',$procedure->costnis/(($procedure->exchange>0)?$procedure->exchange:3.5),['class'=>'form-control dolar   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costdolar'))
                <span class="help-block error">{{ $errors->first('costdolar') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costnis')) has-error @endif">
            <span class="text-success">Total Cost ILS</span>
            {!! Form::text('costnis',$procedure->costnis,['class'=>'form-control nis   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costnis'))
                <span class="help-block error">{{ $errors->first('costnis') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group input-wlbl  @if ($errors->has('discount')) has-error @endif">
            <span class="text-success">Discount  ILS</span>
            {!! Form::text('discount',$procedure->discount,['class'=>'form-control    txtinput-number-required  ','']) !!}
            @if ($errors->has('discount'))
                <span class="help-block error">{{ $errors->first('discount') }}</span>

            @endif
            <span class="help-block warning">if percentage % please between 1% to 100%</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group input-wlbl  @if ($errors->has('perc')) has-error @endif">

            <span class="text-success">Discount Percentage</span>
            <input name="perc" type="checkbox" value="1" {{$procedure->perc=="1"?"checked":""}}>
            @if ($errors->has('perc'))
                <span class="help-block error">{{ $errors->first('perc') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('other_notes_procedure')) has-error @endif">
            <span class="">Comments -التعليقات</span>

            {!! Form::select('other_notes_procedure[]',$other_notes_procedure,isset($procedure->other_notes)?explode(",",$procedure->other_notes):null,['class'=>'form-control select2 other_notes','multiple'=>'multiple','placehoder'=>'select Comments']) !!}
            @if ($errors->has('other_notes_procedure'))
                <span class="help-block error">{{ $errors->first('other_notes_procedure') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('about_procedure')) has-error @endif">
            <span>About Procedure</span>

            {!! Form::textarea('about_procedure',$procedure->about_procedure,['class'=>'form-control  txtinput-required textarea','rows'=>'2']) !!}
            @if ($errors->has('about_procedure'))
                <span class="help-block error">{{ $errors->first('about_procedure') }}</span>
            @endif
        </div>
    </div>

</div>

                                           
                                              
                                    
                                   