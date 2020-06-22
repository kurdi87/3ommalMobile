<script>
    jQuery(document).ready(function () {
        $('.textareaPro').wysihtml5();
    });
</script>

<div class="row" style="padding: 20px;">

    <div class="col-md-6">
        <div class="form-group input-wlbls  @if ($errors->has('name')) has-error @endif">
            <span class="">Name - الاسم</span>
            {!! Form::text('category_id',isset($result->id)?$result->id:"0",['class'=>'hidden category_id']) !!}
            {!! Form::text('type',isset($result->type)?$result->type:"0",['class'=>'hidden ']) !!}
            {!! Form::text('lang',isset($result->lang)?$result->lang:"0",['class'=>'hidden']) !!}

            {!! Form::text('name',null,['class'=>'form-control  txtinput-required ']) !!}
            @if ($errors->has('name'))
                <span class="help-block error">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('name_en')) has-error @endif">
            <span class="">Name En</span>
            {!! Form::text('name_en',null,['class'=>'form-control  txtinput-required ']) !!}
            @if ($errors->has('name_en'))
                <span class="help-block error">{{ $errors->first('name_en') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('about_category')) has-error @endif">
            <span class="">About Category - عن </span>

            {!! Form::textarea('about_category',null,['class'=>'form-control  txtinput-required textarea ']) !!}
            @if ($errors->has('about_category'))
                <span class="help-block error">{{ $errors->first('about_category') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('cost_from')) has-error @endif">
            <span class="">Cost from</span>
            {!! Form::text('cost_from',null,['class'=>'form-control  txtinput-number-required txtmin']) !!}
            @if ($errors->has('cost_from'))
                <span class="help-block error">{{ $errors->first('cost_from') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('cost_to')) has-error @endif">
            <span class="">Cost To</span>
            {!! Form::text('cost_to',null,['class'=>'form-control   txtinput-number-required txtmax']) !!}
            @if ($errors->has('cost_to'))
                <span class="help-block error">{{ $errors->first('cost_to') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('d_order')) has-error @endif">
            <span class="">order</span>
            {!! Form::text('d_order',null,['class'=>'form-control  txtinput-required txtinput-number-required']) !!}
            @if ($errors->has('d_order'))
                <span class="help-block error">{{ $errors->first('d_order') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('parent_id')) has-error @endif">
            <span class="">Parent ID </span>
            {!! Form::text('parent_id',isset($result->id)?$result->id:"0",['class'=>'form-control   txtinput-required ']) !!}

            @if ($errors->has('type'))
                <span class="help-block error">{{ $errors->first('parent_id') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12 ">
        <div class="form-group input-wlbl  @if ($errors->has('isroot')) has-error @endif">
            <span class="">Is Root</span>

            {{ Form::checkbox('isroot', 1, null, ['class' => 'field']) }}

            @if ($errors->has('type'))
                <span class="help-block error">{{ $errors->first('isroot') }}</span>
            @endif
        </div>
    </div>


</div>
