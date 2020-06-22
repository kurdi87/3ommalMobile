<div class="row addmed" style="padding: 20px;">

    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('medication')) has-error @endif">
            <span class="">Medication Name - اسم العلاج</span>

            {!! Form::text('gop_id',isset($result->id)?$result->id:"0",['class'=>'hidden gop_id form-control']) !!}

            <select id="hhh" name="medication" class="form-control select2 medicationchoose" style="width: 100%">
                <option></option>
                <optgroup label="Medication Name">
                    @foreach($medication as $c)
                        <option  cost="{{$c->cost}}" value="{{$c->id}}">{{$c->name}} <span class="text text-danger">( Code:{{$c->code}})</span>  <span class="text text-danger">( Qty/Box:{{$c->qty}})</span>  </option>
                    @endforeach
                </optgroup>


            </select>

            @if ($errors->has('medication'))
                <span class="help-block error">{{ $errors->first('medication') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('qty')) has-error @endif">
            <span>Qty - الكمية</span>
            {!! Form::text('qty',1,['class'=>'form-control mqty txtinput-number-required  ','type'=>'number','id'=>'qty']) !!}
            @if ($errors->has('qty'))
                <span class="help-block error">{{ $errors->first('qty') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('exchange')) has-error @endif">
            <span>Exchange - فارق العملة </span>
            {!! Form::text('exchange',3.5,['class'=>'form-control mexchange txtinput-number-required  ']) !!}
            @if ($errors->has('exchange'))
                <span class="help-block error">{{ $errors->first('exchange') }}</span>
            @endif
        </div>
    </div> <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('cost')) has-error @endif">
            <span>Cost ILS- التكلفة شيقل</span>
            {!! Form::text('cost',null,['class'=>'form-control mcost  txtinput-number-required  ']) !!}
            @if ($errors->has('cost'))
                <span class="help-block error">{{ $errors->first('cost') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costdolar')) has-error @endif">
            <span class="text-success">Total Cost $</span>
            {!! Form::text('costdolar',null,['class'=>'form-control mdolar   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costdolar'))
                <span class="help-block error">{{ $errors->first('costdolar') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('costnis')) has-error @endif">
            <span class="text-success">إجمالي التكلفة</span>
            {!! Form::text('costnis',null,['class'=>'form-control mnis   txtinput-number-required  ','readonly']) !!}
            @if ($errors->has('costnis'))
                <span class="help-block error">{{ $errors->first('costnis') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('about_medication')) has-error @endif">
            <span>About Medication</span>

            {!! Form::textarea('about_medication عن العلاج',null,['class'=>'form-control  txtinput-required textarea','rows'=>'2']) !!}
            @if ($errors->has('about_medication'))
                <span class="help-block error">{{ $errors->first('about_medication') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('medication_type')) has-error @endif">
            <span class="lblinput">Type - النوع</span>

            <input type="hidden" name="medication_type" value="1">


            <p></p>
            @if ($errors->has('medication_type'))
                <span class="help-block error">{{ $errors->first('medication_type') }}</span>
            @endif
        </div>
    </div>


</div>

                                           
                                              
                                    
                                   