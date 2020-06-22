@extends('cp.layout.layout')

@section('css')

@stop
@section('js')

    <script src="cp/js/date-custom.js" type="text/javascript"></script>
    <script src="cp/js/checkbox.js" type="text/javascript"></script>
    <script src="cp/js/myselect2.js" type="text/javascript"></script>
     <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/usersForm.js" type="text/javascript"></script>

     
    @if($errors->has())
        <script>
            jQuery(document).ready(function () {
                  toasterMessage('error', 'Errors number : {{ $errors->first() }}', 'Pleach ceheck errors');
            });

        </script>
    @endif

    @if(isset($success))
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', '{{ $success }}', 'Done successfully');
            });

        </script>
    @endif
@stop

@section('content')
    <div class="form-package">
        {!! Form::open(['action'=>'Admin\ServiceController@store','class'=>'form-validation form-datavalidation']) !!}
        @include('cp.service.form')
        {!! Form::close() !!}
    </div>
@stop