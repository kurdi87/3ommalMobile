[
@php $i=0; @endphp
@foreach ($claim as $a)

    {
    "title":"claim: {{$a->patient_name}} in {{$a->hospital}} By Doctor {{$a->doctor}}",
    "start": "{{ date('Y-m-d', strtotime($a->adate))}} {{ date('h:i:s', strtotime($a->atime) )}}",
"url":"{{ config('app.cp_route_name') }}/claim/edit/{{$a->id}}"

    }
    @php $i++ @endphp
    @if($i<count($claim))
        ,

    @endif

@endforeach


@if(count($admission)>0 && count($claim)>0)
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