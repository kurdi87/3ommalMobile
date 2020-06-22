@if($type=='create')
Hello {{$patient_name}},
<br>
This to  inform you that an gop has been created to you
<br>
<ul style="list-style: unset">
    <li>Hospital:{{$hospital}}</li>
<li>Department:{{$department}}</li>
    <li>Department:{{$doctor}}</li>
    <li>Date:{{$adate}}</li>
    <li>Time:{{$atime}}</li>
    <li>Fee:{{$fee}} NIS</li>

</ul>
<br>

Good Day..
@elseif($type=='update')
    Hello {{$patient_name}},
    <br>
    This to  inform your gop has been update to:
    <br>
    <ul style="list-style: unset">
        <li>Hospital:{{$hospital}}</li>
        <li>Department:{{$department}}</li>
        <li>Doctor:{{$doctor}}</li>
        <li>Date:{{$coverage_date}}</li>

    </ul>
    <br>

    Good Day..

    @elseif($type=='reminder')
        Hello {{$patient_name}},
        <br>
        This is Reminder to  inform you that an gop has been created to you
        <br>
        <ul style="list-style: unset">
            <li>Hospital:{{$hospital}}</li>
            <li>Department:{{$department}}</li>
            <li>Department:{{$doctor}}</li>
            <li>Date:{{$coverage_date}}</li>

        </ul>
        <br>
        Good Day..


@elseif($type=='status')
    Hello {{$finance_party}},
    <br>
    This is inform you that GOP # {{$ID}} Status has been changed to {{$status}}
    <br>
    <ul style="list-style: unset">
        <li>Hospital:{{$hospital}}</li>
        <li>Department:{{$department}}</li>
        <li>Department:{{$doctor}}</li>
        <li>Date:{{$coverage_date}}</li>

    </ul>
    <br>
    Good Day..

@elseif($type=='upload')
    Hello {{$finance_party}},
    <br>
    This is inform you that GOP # {{$ID}} Has new upload
    <br>
    <ul style="list-style: unset">
        <li>Hospital:{{$hospital}}</li>
        <li>Department:{{$department}}</li>
        <li>Department:{{$doctor}}</li>
        <li>Date:{{$coverage_date}}</li>

    </ul>
    <br>
    Good Day..
@endif