@if($type=='create')
Hello {{$patient_name}},
<br>
This to  inform you that an commitment has been created to you
<br>
<ul style="list-style: unset">
    <li>Service Provider:{{$hospital}}</li>
    <li>Date:{{$service_date}}</li>

    <li>amount:{{$amount}} NIS</li>

</ul>
<br>

Good Day..
@elseif($type=='update')
    Hello {{$patient_name}},
    <br>
    This to  inform your commitment has been update to:
    <br>
    <ul style="list-style: unset">
        <li>Service Provider:{{$hospital}}</li>
        <li>Date:{{$service_date}}</li>

        <li>amount:{{$amount}} NIS</li>

    </ul>
    <br>

    Good Day..
    @elseif($type=='completed')
        Hello ,
        <br>
        This to  inform your commitment has been completed to:
        <br>
        <ul style="list-style: unset">
            <li>Patient:{{$patient_name}}</li>
            <li>Service Provider:{{$hospital}}</li>
            <li>Date:{{$service_date}}</li>
            <li>amount:{{$amount}} NIS</li>
        </ul>
        <br>

        Good Day..
    @elseif($type=='reminder')
        Hello {{$patient_name}},
        <br>
        This is Reminder to  inform you that an commitment has been created to you
        <br>
        <ul style="list-style: unset">
            <li>Service Provider:{{$hospital}}</li>
            <li>Date:{{$service_date}}</li>

            <li>amount:{{$amount}} NIS</li>

        </ul>
        <br>
        Good Day..
    @endif