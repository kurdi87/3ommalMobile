<script>
    jQuery(document).ready(function () {
        $('.emailselect').select2({
            placeholder: 'Select Email',
            dropdownParent: $('#modal-email')
        });
    });

</script>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <div class="col-md-1">To -الى:</div>
            <div class="col-md-11">
                <div class="form-group input-wlbl  @if ($errors->has('address_book')) has-error @endif">
                    <select id="To" name="address_book[]" class="form-control select2 emailselect" multiple=""
                            style="width: 100%">
                        <option></option>
                        <optgroup label="Address Book">
                            @foreach($address_book as $c)
                                <option value="{{$c->email}}">{{$c->name}} <span class="text text-danger">(Email:{{$c->email}})</span>
                                </option>
                            @endforeach
                        </optgroup>


                    </select>

                    @if ($errors->has('address_book'))
                        <span class="help-block error">{{ $errors->first('address_book') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <div class="col-md-1">CC:</div>
            <div class="col-md-11">
                <div class="form-group input-wlbl  @if ($errors->has('employee')) has-error @endif">
                    <select id="To" name="employee[]" class="form-control select2 emailselect" multiple=""
                            style="width: 100%">
                        <option></option>
                        <optgroup label="Employees">
                            @foreach($employee as $c)
                                <option value="{{$c->email}}">{{$c->name}} <span class="text text-danger">(Email:{{$c->email}})</span>
                                </option>
                            @endforeach
                        </optgroup>


                    </select>
                    @if ($errors->has('employee'))
                        <span class="help-block error">{{ $errors->first('employee') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <div class="col-md-1">Subject:</div>
            <div class="col-md-11">
                <div class="form-group input-wlbl  @if ($errors->has('subject')) has-error @endif">
                    <input type="hidden" name="gop_id" value="{{$gop_email->id}}">
                    {!! Form::text('subject','Gop letter',['class'=>'form-control']) !!}

                    @if ($errors->has('subject'))
                        <span class="help-block error">{{ $errors->first('subject') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <div class="col-md-1">With Logo:</div>
            <div class="col-md-11">
                <div class="form-group input-wlbl  @if ($errors->has('with_logo')) has-error @endif">
                    {!! Form::checkbox('with_logo')!!}
                    @if ($errors->has('with_logo'))
                        <span class="help-block error">{{ $errors->first('with_logo') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <div class="col-md-1">Text:</div>
            <div class="col-md-11">
                <div class="form-group input-wlbl  @if ($errors->has('content')) has-error @endif">
                    {!! Form::textarea('content','GOP Letter',['class'=>'form-control textarea']) !!}
                    @if ($errors->has('content'))
                        <span class="help-block error">{{ $errors->first('content') }}</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
