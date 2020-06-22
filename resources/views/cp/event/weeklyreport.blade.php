<html>
<head>

    <meta charset="utf-8"/>
    <title>Event Weekly Report</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}"/>

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}"/>


</head>
<body>
<div class="container-fluid report-header">


    <div class="row">
        <div class="col-sm-4 text-left ">
            <div class="logo">


                <img src="{{asset("cp/images/logo-1.png")}}"></div>
        </div>

        <div class="col-sm-4 text-center">
            <span class="titletext">Event Weekly Report</span>
        </div>
        <div class="col-sm-4 text-right">
            Date: {{date('Y-m-d')}}

        </div>
    </div>

</div>
<div class="container report-body">
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-sm-2">
            <strong class="text-danger">Total:</strong> {{$events->count()}}

        </div>

    </div>
    <div class="clearfix space">
        <hr>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <table class="table border2 table-striped table-bordered table-hover  order-column">
                <th>
                <td>Event ID</td>
                <td>Patient</td>
                <td>Hospital</td>
                <td>Department</td>
                <td>Doctor</td>
                <td>Resident Doctor</td>
                <td>FP</td>
                <td>R. Agent</td>
                <td>Coverage Cost</td>
                <td>Coverage Type</td>
                <td>Service Type</td>
                <td>Employee</td>
                <td>Service Date</td>
                <td>Ref Type</td>
                <td>Event NO</td>
                <td>Subj. to commission</td>
                <td>Accident_id</td>
                <td>Att</td>

                </th>
                @php $count=1;

                @endphp

                @foreach ( $events as $a)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$a->patient_name}}<br>{{$a->sid}}</td>
                        <td>{{$a->id}}</td>
                        <td>{{$a->hospital}}</td>
                        <td>{{$a->department}}</td>
                        <td>{{\App\Models\DoctorInfoModel::getDoctorName($a->doctor_id)}}</td>
                        <td>{{\App\Models\DoctorInfoModel::getDoctorName($a->resident_doctor)}}</td>
                        <td>{{$a->finance_party_name}}</td>
                        <td>{{$a->referral_agent}}</td>

                        <td>{{$a->coverage_cost}}</td>
                        <td>{{\App\Models\TypesModel::getTypeName($a->coverage_type)}}</td>
                        <td>{{\App\Models\TypesModel::getTypeName($a->service_type)}}</td>
                        <td>{{$a->employee}}</td>
                        <td>{{date('Y-m-d',strtotime($a->coverage_date))}}</td>
                        <td>{{\App\Models\TypesModel::getTypeName($a->referral_type)}}</td>
                        <td>{{$a->event_no}}</td>
                        <td>{{ $a->comission?'Yes':'No'}}</td>
                        <td>{{$a->accident_id}}</td>
                        <td>{{ \App\Models\AttModel::getAtt(0, 0,$a->patient_id)}}</td>
                    </tr>
                    @php $count++; @endphp
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="row myreport-footer ">

    <div class="col-sm-12  ">

        <div class="row">
            <div class="col-sm-8  text-left">
                <i class="glyphicon glyphicon-map-marker"></i> Ramallah, Jamal Abd Alanse St. Ground Floor-Near
                Modern English School
            </div>

            <div class="col-sm-4 text-right">

                <div class="row">
                    <div class="col-sm-12">
                        <i class="glyphicon glyphicon-envelope"></i> info.opts@opts.expert
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>