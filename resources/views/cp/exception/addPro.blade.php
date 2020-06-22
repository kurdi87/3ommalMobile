<div class="row addpro" style="padding: 20px;">

    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('procedure')) has-error @endif">
            <span class="">Procedure Name - الإجراء</span>

            {!! Form::text('exception_id',isset($result->id)?$result->id:"0",['class'=>'hidden exception_id form-control']) !!}

            <select id="hh" name="procedure" class="form-control select2 procedurechoose" style="width: 100%">
                <option></option>
                <optgroup label="Procedure Name">
                    @foreach($procedure as $c)
                        <option  cost= "{{$c->priceA}}" value="{{$c->id}}">{{$c->name}} <span class="text text-danger">(Service Code:{{$c->serviceCode}})</span> </option>
                    @endforeach
                </optgroup>


            </select>

            @if ($errors->has('procedure'))
                <span class="help-block error">{{ $errors->first('procedure') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('qty')) has-error @endif">
            <span>Qty - الكمية</span>
            {!! Form::text('qty',1,['class'=>'form-control qty txtinput-number-required  ','type'=>'number','id'=>'qty']) !!}
            @if ($errors->has('qty'))
                <span class="help-block error">{{ $errors->first('qty') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('exchange')) has-error @endif">
            <span>Exchange - التحويل </span>
            {!! Form::text('exchange',3.5,['class'=>'form-control exchange txtinput-number-required  ']) !!}
            @if ($errors->has('exchange'))
                <span class="help-block error">{{ $errors->first('exchange') }}</span>
            @endif
        </div>
    </div> <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('cost')) has-error @endif">
            <span>Cost ILS - التكلفة بالشيقل</span>
            {!! Form::text('cost',null,['class'=>'form-control cost  txtinput-number-required  ']) !!}
            @if ($errors->has('cost'))
                <span class="help-block error">{{ $errors->first('cost') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costdolar')) has-error @endif">
            <span class="text-success">Total Cost $ - المجموع دولار</span>
            {!! Form::text('costdolar',null,['class'=>'form-control dolar   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costdolar'))
                <span class="help-block error">{{ $errors->first('costdolar') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costnis')) has-error @endif">
            <span class="text-success">Total Cost ILS - المجموع شيقل</span>
            {!! Form::text('costnis',null,['class'=>'form-control nis   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costnis'))
                <span class="help-block error">{{ $errors->first('costnis') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('about_procedure')) has-error @endif">
            <span>About Procedure</span>

            {!! Form::textarea('about_procedure',null,['class'=>'form-control  txtinput-required textarea','rows'=>'2']) !!}
            @if ($errors->has('about_procedure'))
                <span class="help-block error">{{ $errors->first('about_procedure') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('procedure_type')) has-error @endif">
            <span class="lblinput">Type - النوع</span>

            <input type="hidden" name="procedure_type" value="1">


            <p></p>
            @if ($errors->has('procedure_type'))
                <span class="help-block error">{{ $errors->first('procedure_type') }}</span>
            @endif
        </div>
    </div>


</div>

                                           
                                              
                                    
                                   