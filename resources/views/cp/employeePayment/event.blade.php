[
@php $i=0; @endphp
@foreach ($employeePayment as $a)

    {
    "title":"employeePayment: {{$a->patient_name}} in {{$a->hospital}} By Doctor {{$a->doctor}}",
    "start": "{{ date('Y-m-d', strtotime($a->adate))}} {{ date('h:i:s', strtotime($a->atime) )}}",
"url":"{{ config('app.cp_route_name') }}/employeePayment/edit/{{$a->id}}"

    }
    @php $i++ @endphp
    @if($i<count($employeePayment))
        ,

    @endif

@endforeach


@if(count($admission)>0 && count($employeePayment)>0)
    ,
    @php $i=0; @endphp
@endif
    @foreach ($admission as $a)

        {
        "title":"Discharge: {{$a->patient_name}} in {{$a->hospital}}",
        "start": "{{ date('Y-m-d', strtotime($a->expected_dis_date))}}",
        "url":"{{ config('app.cp_route_name') }}/admission/edit/{{$a->id}}",
        "color":"purple"
        }
        @php $i++ @endphp
        @if($i<count($admission))
            ,
        @endif

    @endforeach




]