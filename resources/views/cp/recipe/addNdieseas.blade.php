<div class="row" style="padding: 20px;">


    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('name')) has-error @endif">
            <span>Dieseas Name</span>

            {!! Form::text('name',null,['class'=>'form-control  txtinput-required ']) !!}
            @if ($errors->has('name'))
                <span class="help-block error">{{ $errors->first('name') }}</span>
            @endif
        </div>


    </div>
</div>

                                           
                                              
                                    
                                   