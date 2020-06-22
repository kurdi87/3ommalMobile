<script>
    jQuery(document).ready(function () {
        $('.emailselect').select2({
            placeholder: 'Select Email',
            dropdownParent: $('#modal-email')
        });
    });

</script>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">To - إلى:</div>
            <div class="col-md-10">
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
            <div class="col-md-2">CC - نسخة:</div>
            <div class="col-md-10">
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
            <div class="col-md-2">Subject - عنوان:</div>
            <div class="col-md-10">
                <div class="form-group input-wlbl  @if ($errors->has('subject')) has-error @endif">
                    <input type="hidden" name="vacation_id" value="{{$vacation_email->id}}">
                    {!! Form::text('subject','Vacation letter',['class'=>'form-control']) !!}

                    @if ($errors->has('subject'))
                        <span class="help-block error">{{ $errors->first('subject') }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <div class="col-md-2">With Logo - مع لوجو:</div>
            <div class="col-md-10">
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
            <div class="col-md-2">Text - نص :</div>
            <div class="col-md-10">
                <div class="form-group input-wlbl  @if ($errors->has('content')) has-error @endif">
                    {!! Form::textarea('content','VACATION Letter',['class'=>'form-control textarea']) !!}
                    @if ($errors->has('content'))
                        <span class="help-block error">{{ $errors->first('content') }}</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
