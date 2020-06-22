@if($type=='create')
Hello {{$employee_name}},
<br>
This to  inform you that an vacation has been created to you
<br>
<ul style="list-style: unset">
    <li>Type:{{$vacation_type}}</li>
<li>From Date:{{$from_date}}</li>
    <li>To Date:{{$to_date}}</li>

</ul>
<br>

Good Day..
@elseif($type=='update')
    Hello {{$employee_name}},
    <br>
    This to  inform your vacation has been update to:
    <br>
    <ul style="list-style: unset">
        <li>Type:{{$vacation_type}}</li>
        <li>From Date:{{$from_date}}</li>
        <li>To Date:{{$to_date}}</li>

    </ul>
    <br>

    Good Day..

    @elseif($type=='reminder')
        Hello {{$employee_name}},
        <br>
        This is Reminder to  inform you that an vacation has been created to you
        <br>
        <ul style="list-style: unset">
            <li>Type:{{$vacation_type}}</li>
            <li>From Date:{{$from_date}}</li>
            <li>To Date:{{$to_date}}</li>

        </ul>
        <br>
        Good Day..
    @endif