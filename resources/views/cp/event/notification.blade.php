@if($type=='create')
Hello {{$coordinator}},
<br>
This to  inform you that an Event for {{$patient_name}} has been created to you
<br>
<ul style="list-style: unset">
    <li>Hospital:{{$hospital}}</li>
<li>Department:{{$department}}</li>
    <li>Department:{{$doctor}}</li>
    <li>Service Date:{{$adate}}</li>


</ul>
<br>
To manage click <a href="crm.medibooking.org/crm/event/edit/{{$id}}">here</a>
<br>
Good Day..
@elseif($type=='update')
    Hello {{$coordinator}},
    <br>
    This to  inform you event for {{$patient_name}} has been update to:
    <br>
    <ul style="list-style: unset">
        <li>Hospital:{{$hospital}}</li>
        <li>Department:{{$department}}</li>
        <li>Doctor:{{$doctor}}</li>
        <li>Service Date:{{$adate}}</li>


    </ul>
    <br>
    To manage click <a href="crm.medibooking.org/crm/event/edit/{{$id}}">here</a>
    <br>

    Good Day..



    @endif