
<div class="row addoption" style="padding: 20px;">

    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('question_option_text_ar')) has-error @endif">
            <span>Option text  -الخيار </span>
            {!! Form::text('id',isset($question_option->id)?$question_option->id:"0",['class'=>'hidden']) !!}
            {!! Form::text('question_option_text',$question_option->question_option_text,['class'=>'form-control  txtinput-number-required  ']) !!}
            @if ($errors->has('question_option_text'))
                <span class="help-block error">{{ $errors->first('question_option_text') }}</span>
            @endif
        </div>
    </div>


   
    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('question_option_text_ar')) has-error @endif">
            <span>Option text ar - الخيار بالعربية</span>
            {!! Form::text('question_option_text_ar',$question_option->question_option_text_ar,['class'=>'form-control  txtinput-number-required  ']) !!}
            @if ($errors->has('question_option_text_ar'))
                <span class="help-block error">{{ $errors->first('question_option_text_ar') }}</span>
            @endif
        </div>
    </div> <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('option_rank')) has-error @endif">
            <span>Rank - التقييم</span>
            {!! Form::text('option_rank',$question_option->rank,['class'=>'form-control   txtinput-number-required  ']) !!}
            @if ($errors->has('option_rank'))
                <span class="help-block error">{{ $errors->first('option_rank') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group input-wlbl  @if ($errors->has('option_order')) has-error @endif">
            <span class="text-success">Order - الترتيب</span>
            {!! Form::text('option_order',$question_option->option_order,['class'=>'form-control    txtinput-number-required  ']) !!}
            @if ($errors->has('option_order'))
                <span class="help-block error">{{ $errors->first('option_order') }}</span>
            @endif
        </div>
    </div>





    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('about_procedure')) has-error @endif">
            <span>notes - ملاحظات</span>

            {!! Form::textarea('notes',$question_option->notes,['class'=>'form-control  txtinput-required textarea','rows'=>'2']) !!}
            @if ($errors->has('notes'))
                <span class="help-block error">{{ $errors->first('notes') }}</span>
            @endif
        </div>
    </div>

</div>

                                           
                                              
                                    
                                   