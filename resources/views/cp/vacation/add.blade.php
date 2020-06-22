@extends('cp.layout.layout')

@section('css')

@stop
@section('js')
    <script src="cp/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
            type="text/javascript"></script>
    <script src="cp/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="cp/js/date-custom.js" type="text/javascript"></script>
    <script src="cp/js/checkbox.js" type="text/javascript"></script>
    <script src="cp/js/myselect2.js" type="text/javascript"></script>
    <script src="cp/js/validation.js" type="text/javascript"></script>
    <script src="cp/js/usersForm.js" type="text/javascript"></script>
    <script src="cp/js/vacationForm.js" type="text/javascript"></script>

    @if(isset(app()->request->error))
        <script>
            jQuery(document).ready(function () {

                toasterMessage('error', 'Balance is exceeded', 'Error Message');
            });

        </script>

    @endif

    @if($errors->has())
        <script>
            jQuery(document).ready(function () {
                toasterMessage('error', 'Errors number : {{ $errors->first() }}', 'Pleach ceheck errors');
            });

        </script>
    @endif

    @if(app()->request->cont=="1")
        <script>
            jQuery(document).ready(function () {
                toasterMessage('success', 'Please continue with all information', 'Success Message');
            });

        </script>
    @endif
    @if(isset($status))
        <script>
            jQuery(document).ready(function () {
                toasterMessage('{{$status}}', '{{$message}}');
            });

        </script>

    @endif
@stop

@section('content')
    <div class="form-package">
        {!! Form::open(['action'=>'Admin\VacationController@store','class'=>'form-validation form-datavalidation']) !!}
        @include('cp.vacation.form')
        {!! Form::close() !!}
    </div>
@stop