<html>
<head>

    <meta charset="utf-8"/>
    <title>Referral Form Report</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}" />

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}" />






</head>
<body>
<div class="container-fluid report-header">


                <div class="row">
                    <div class="col-sm-4 text-left ">
                        <div class="logo">



                            <img src="{{asset("cp/images/logo-1.png")}}"></div>
                    </div>

                    <div class="col-sm-4 text-center">
                        <span class="titletext">Referral Lead Form</span>
                    </div>
                    <div class="col-sm-4 text-right">
                        Date: {{date('d/m/Y', strtotime($referral->coverage_date))}}

                    </div>
                </div>

</div>
<div class="container report-body">

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 ">
                    <table class="table table-striped table-bordered   order-column" id="">
                        <thead>
                        </thead>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Patient Name</td>
                            <td>{{$patient->fname}} {{$patient->faname}} </td>
                        </tr>
                        <tr>
                            <td>Patient ID</td>
                            <td>{{$patient->sid}} </td>
                        </tr>
                        <tr>
                            <td>Patient Age</td>
                            <td>{{
                             $age
                            }}</td>
                        </tr>
                        <tr>
                            <td>Covering Party</td>
                            <td>{{\App\Models\FinancePartyModel::getFianancePartyName($referral->finance_party)}}</td>
                        </tr>
                        <tr>
                            <td>Hospital Name</td>
                            <td>{{\App\Models\RecipeModel::getHospitalName($referral->hospital_id)}}</td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>{{\App\Models\DepartmentModel::getDepartmentName($referral->department_id)}}</td>
                        </tr>
                        <tr>
                            <td>Physician Name</td>
                            <td>{{\App\Models\DoctorInfoModel::getDoctorName($referral->doctor_id)}}</td>
                        </tr>
                        <tr>
                            <td>Referral Type</td>
                            <td>{{\App\Models\TypesModel::getTypeName($referral->referral_type)}}</td>
                        </tr>
                        <tr>
                            <td>Cost of treatment</td>
                            <td>{{$referral->coverage_cost}}</td>
                        </tr>
                        <tr>
                            <td>Service Date</td>
                            <td>{{date('d/m/Y', strtotime($referral->coverage_date))}}</td>
                        </tr>

                        <tr>
                            <td>Procedures</td>
                            <td>
                                <table class="table table-striped table-bordered table-hover  order-column" id="">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Description Of Procedure</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach(\App\Models\EventProcedureModel::getProcedureByEvent($referral->id) as $r)
                                        <tr>
                                            <td>{{$r->serviceCode}} </td>
                                            <td>{{$r->name}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>


                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
</div>
<div class="container-fluid myreport-footer-top">
    <div class="row  ">

        <div class="col-sm-12  ">
           <strong> *This Report is not considered as Guarantee of Payment (GOP)</strong>
        </div>
    </div>
            <div class="row myreport-footer ">

                <div class="col-sm-12  ">
                    <div class="row">
                        <div class="col-sm-8  text-left">
                            <i class="glyphicon glyphicon-map-marker"></i> Ramallah, Jamal Abd Alanse St. Ground Floor-Near Modern English School
                        </div>

                        <div class="col-sm-4 text-right">
                            <div class="row">
                                <div class="col-sm-12">
                                   <i class="glyphicon glyphicon-envelope"></i> info.opts@opts.expert
                                </div>
                                <div class="col-sm-12">
                                    <i class="glyphicon glyphicon-phone"></i>+970-2298-4900
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>



