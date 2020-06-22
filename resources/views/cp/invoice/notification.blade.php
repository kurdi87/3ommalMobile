@if($type=='create')
Hello Sir,
<br>
This to  inform you that an invoice has been created
<br>
<ul style="list-style: unset">
    <li>Patient:{{$patient}}</li>
    <li>Hospital:{{$hospital}}</li>
<li>Department:{{$department}}</li>
    <li>Date:{{$idate}}</li>



</ul>
<br>
To manage click <a href="crm.medibooking.org/crm/invoice/edit/{{$id}}">here</a>
<br>
Good Day..
@elseif($type=='update')
    Hello Sir,
    <br>
    This to  inform you that an invoice has been updated
    <br>
    <ul style="list-style: unset">
        <li>Patient:{{$patient}}</li>
        <li>Hospital:{{$hospital}}</li>
        <li>Department:{{$department}}</li>
        <li>Date:{{$idate}}</li>

    </ul>
    <br>
    To manage click <a href="crm.medibooking.org/crm/invoice/edit/{{$id}}">here</a>
    <br>
    Good Day..



    @endif