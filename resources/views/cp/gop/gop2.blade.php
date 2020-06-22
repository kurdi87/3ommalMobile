<html>
<head>

    <meta charset="utf-8"/>
    <title>GoP Form Report</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}"/>

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}"/>


</head>
<body>

<div class="container-fluid report-header header">


    <div class="row">
        <div class="col-sm-4 text-left ">
            <div class="logo">


            </div>
        </div>

        <div class="col-sm-4 text-center">
            <span class="titletext">Request for GoP</span>
        </div>
        <div class="col-sm-4 text-right">
            Print Date: {{date('d/m/Y')}}

        </div>
    </div>

</div>
<div class="container report-body">
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Patient Name:</strong></div>

                <div class="col-sm-8">{{$patient->fname}} {{$patient->faname}} </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-2"><strong> ID:</strong></div>

                <div class="col-sm-10">{{$patient->sid}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Date of Birth:</strong></div>

                <div class="col-sm-4">{{date('d/m/Y', strtotime($patient->bod))}}</div>
                <div class="col-sm-2"><strong>Age:</strong></div>

                <div class="col-sm-2">{{$age}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-3"><strong>City:</strong></div>

                <div class="col-sm-9">{{ isset(\App\Models\CityModel::find($patient->city)->name_en)? \App\Models\CityModel::find($patient->city)->name_en.' -'.\App\Models\CityModel::find($patient->prov)->name_en.'' :''}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4 "><strong>Finance Party:</strong></div>

                <div class="col-sm-8">{{\App\Models\FinancePartyModel::getFianancePartyName($gop->finance_party)}}</div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>File Number:</strong></div>

                <div class="col-sm-8">{{$patient->dno}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Hospital:</strong></div>

                <div class="col-sm-8">{{\App\Models\RecipeModel::getHospitalName($gop->hospital_id)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Department:</strong></div>

                <div class="col-sm-8">{{\App\Models\DepartmentModel::getDepartmentName($gop->department_id)}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Doctor:</strong></div>

                <div class="col-sm-8">{{\App\Models\DoctorInfoModel::getDoctorName($gop->doctor_id)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Service Type:</strong></div>

                <div class="col-sm-8">{{\App\Models\TypesModel::getTypeName($gop->serviceType)}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">


        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Service Date:</strong></div>

                <div class="col-sm-8">{{date('d/m/Y', strtotime($gop->action_date))}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><h4><strong>Total Cost:</strong></h4></div>

                <div class="col-sm-8"><h4 class="text-left">{{number_format($gop->total_cost)}} NIS</h4></div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>

    <div class="row">
        <div class="col-sm-4">
            <h4 class="text-left"><strong>Notes:</strong></h4>
        </div>
        <div class="col-sm-8">
            {{$gop->notes}}
        </div>
    </div>


    <div class="row">
        <div class="clearfix">
            <hr>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h4 class="text-left"><strong>Details:</strong></h4>
        </div>
    </div>
    <div class="row {{count(\App\Models\GopProcedureModel::getProcedureByGoP($gop->id) )>0?'':'hidden'}}">
        <div class="col-sm-10 col-sm-offset-1 ">
            <table class="table table-striped table-bordered table-hover  order-column" id="">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Description Of Procedure</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Note</th>
                </tr>
                </thead>

                <tbody>
                @php
                    $count=0;
                    $total=0;
                @endphp
                @foreach(\App\Models\GopProcedureModel::getProcedureByGoP($gop->id) as $r)
                    @php
                        $count++;
                        $total=$total+($r->qty * $r->cost);
                    @endphp
                    <tr>
                        <td>{{$count}} </td>
                        <td>{{$r->serviceCode}} </td>
                        <td>{{$r->name}}</td>
                        <td>{{number_format($r->cost)}}</td>
                        <td>{{$r->qty}}</td>
                        <td>{{number_format($r->qty * $r->cost)}}</td>
                        <td>{{$r->about_procedure}}</td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <td colspan="5" align="center">Grand Total For Procedures</td>
                <td>{{number_format($total)}}</td>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row {{count(\App\Models\GopMedicationModel::getMedicationByGop($gop->id))>0?'':'hidden'}}">
        <div class="col-sm-10 col-sm-offset-1 ">
            <table class="table table-striped table-bordered table-hover  order-column" id="">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Medication</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Note</th>
                </tr>
                </thead>

                <tbody>
                @php
                    $count=0;
                    $total2=0;
                @endphp
                @foreach(\App\Models\GopMedicationModel::getMedicationByGop($gop->id) as $r)
                    @php
                        $count++;
                        $total2=$total2+($r->qty * $r->cost);
                    @endphp
                    <tr>
                        <td>{{$count}} </td>
                        <td>{{$r->serviceCode}} </td>
                        <td>{{$r->name}}</td>
                        <td>{{number_format($r->cost)}}</td>
                        <td>{{$r->qty}}</td>
                        <td>{{number_format($r->qty * $r->cost)}}</td>
                        <td>{{$r->about_medication}}</td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <td colspan="5" align="center">Grand Total For Medications</td>
                <td>{{number_format($total2)}}</td>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<div class="container-fluid myreport-footer-top footer ">


    <div class="row  ">


        <div class="col-sm-12  ">
            <strong> </strong>
        </div>
        <div class="col-sm-12  ">

        </div>
        <div class="col-sm-12 ">

        </div>
        <div id="pageFooter" class="col-sm-12  "><strong> </strong></div>
    </div>
    <div class="row myreport-footer" style="width: 100% !important;">

    </div>
</div>

</body>
</html>



