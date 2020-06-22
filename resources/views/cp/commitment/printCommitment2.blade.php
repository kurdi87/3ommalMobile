<html>
<head>

    <meta charset="utf-8"/>
    <title>Commitment Letter</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}"/>

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}"/>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style>



    </style>
</head>


<body>

<div class="container-fluid report-header">


    <div class="row">
        <div class="col-sm-12 text-center ">
            <div class="logo">
                <img src="{{asset("cp/images/".\App\Models\FinancePartyModel::find($commitment->finance_party)->image)}}"
                     class=""></div>
        </div>


        <div class="col-sm-12 text-left">

        </div>
    </div>

</div>
<div class="container report-body" dir="ltr">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h3><strong> <span class="titletext">Commitment Letter</span></strong></h3>
        </div>
    </div>
    <br>
    <br>

    <div class="row ">





        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-5"><strong>Pateint Name:</strong></div>
                <div class="col-sm-7">{{$patient->fname}} {{$patient->sname}} {{$patient->tname}} {{$patient->faname}}</div>



            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6"><strong>ID:</strong></div>
                <div class="col-sm-6">{{$patient->sid}}</div>



            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6"><strong>Date of Birth:</strong></div>
                <div class="col-sm-6">{{$patient->bod?date('d/m/Y', strtotime($patient->bod)):''}}</div>



            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-5"><strong>City :</strong></div>
                <div class="col-sm-7">{{ isset(\App\Models\CityModel::find($patient->city)->name)? \App\Models\CityModel::find($patient->city)->name :''}}</div>



            </div>
        </div>

    </div>

    @if($commitment->accident_id)
        <div class="clearfix space"></div>
        <div class="row">







            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong>Date of Accident:</strong></div>
                    <div class="col-sm-6">{{date('d/m/Y',strtotime(\App\Models\AccidentModel::find($commitment->accident_id)->accident_date))}}</div>



                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong>Accident Type:</strong></div>
                    <div class="col-sm-6">{{\App\Models\TypesModel::getTypeName(\App\Models\AccidentModel::find($commitment->accident_id)->type,0)}}</div>



                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong>Branch:</strong></div>
                    <div class="col-sm-6">{{\App\Models\AccidentModel::find($commitment->accident_id)->branch_name}}</div>



                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong>Claim No:</strong></div>
                    <div class="col-sm-6">{{ $commitment->claim_no}}</div>



                </div>
            </div>


        </div>
        <div class="row">


            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong>  Injury:</strong></div>
                    <div class="col-sm-6">{{\App\Models\TypesModel::getTypeName(\App\Models\AccidentPatientModel::where('accident_id',$commitment->accident_id)->where('patient_id',$commitment->patient_id)->get()->first()->injury,1)}}</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong>Accident Result:</strong></div>
                    <div class="col-sm-6">{{\App\Models\TypesModel::getTypeName(\App\Models\AccidentPatientModel::where('accident_id',$commitment->accident_id)->where('patient_id',$commitment->patient_id)->get()->first()->result,1)}}</div>



                </div>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
        </div>
    @endif

    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 ">
            <br><br>
            <span><h4 class="danger">We are committed to cover the cost of treatment for the mentioned Beneficiary limited to total amount of commitment
                        </h4></span>

            <br><br>

            <table class="table table-striped table-bordered   order-column" id="">
                <thead>
                </thead>
                </thead>
                <tbody>
                <tr>
                    <td>Coverage No</td>
                    <td>CL-{{$commitment->id}} </td>
                </tr>
                <tr>
                    <td>Refernce No</td>
                    <td>{{$reference}} </td>
                </tr>
                <tr>
                    <td>Service Date</td>
                    <td>
                        From: {{$commitment->service_date?date('d/m/Y', strtotime($commitment->service_date)):'         '}}
                        To: {{$commitment->service_date_to?date('d/m/Y', strtotime($commitment->service_date_to)):'      '}}

                    </td>
                </tr>


                <tr>
                    <td>Service Provider</td>
                    <td>{{\App\Models\RecipeModel::getHospitalName($commitment->hospital_id,0)}}</td>
                </tr>
                <tr>
                    <td>Servie Type</td>
                    <td>{{\App\Models\TypesModel::getTypeName($commitment->serviceType)}}</td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>{{\App\Models\DepartmentModel::getDepartmentName($commitment->department_id)}}</td>
                </tr>



                <tr>
                    <td><h4 class="danger">Maximum Coverage Amount</h4></td>
                    <td>
                        <h4 class="strong">{{($commitment->amount)?$commitment->amount.' '.\App\Models\TypesModel::getTypeName($commitment->currency):"Unlimited"}}</h4>
                    </td>
                </tr>


                </tbody>
            </table>
        </div>
    </div>
    <br>

    <div class="row {{count(\App\Models\CommitmentProcedureModel::getProcedureByCommitment($commitment->id) )>0?'':'hidden'}}">
        <div class="col-sm-10 col-sm-offset-1 ">

            <table class="table table-striped table-bordered table-hover  order-column" id="">
                <thead>
                <tr>
                    <td colspan="7">
                        <h4><strong>Procedures:</strong></h4></td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Cost</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Total</th>

                </tr>
                </thead>

                <tbody>
                @php
                    $count=0;
                    $total=0;
                @endphp
                @foreach(\App\Models\CommitmentProcedureModel::getProcedureByCommitment($commitment->id) as $r)
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

                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <td colspan="5" align="center">Total Cost For All</td>
                <td colspan="2">{{number_format($total)}}</td>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row {{count(\App\Models\CommitmentMedicationModel::getMedicationByCommitment($commitment->id))>0?'':'hidden'}}">
        <div class="col-sm-10 col-sm-offset-1 text-center ">

            <table class="table table-striped table-bordered table-hover  order-column" id="">
                <thead>
                <tr>
                    <td colspan="7">
                        <h4><strong>Treatments:</strong></h4></td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Treatment</th>
                    <th class="text-center">Cost</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Total</th>

                </tr>
                </thead>

                <tbody>
                @php
                    $count=0;
                    $total2=0;
                @endphp
                @foreach(\App\Models\CommitmentMedicationModel::getMedicationByCommitment($commitment->id) as $r)
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

                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <td colspan="5" align="center">Total Cost of Treatments</td>
                <td colspan="2">{{number_format($total2)}}</td>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<div class="bottomPage">
    <div class="container-fluid report-footer-top">
        <div class="clearfix space"></div>
        <div class="row">
            <div class="col-sm-12 text-left">
                <h4>Notes</h4>
            </div>
            <div class="col-sm-12">
                {{$commitment->notes}}
                <br><br>
                {{$commitment->other_notes}}
            </div>
        </div>
        <div class="clearfix space"></div>
        <div class="row " >
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-5"><strong>Coverage Date:</strong></div>
                    <div class="col-sm-7">{{$commitment->coverage_date?date('d/m/Y', strtotime($commitment->coverage_date)):''}}</div>



                </div>
            </div>

            <div class="col-sm-1  ">
                <strong> Signature: </strong>
            </div>
            <div class="col-sm-4  ">

                <img src="{{asset("cp/images/".\App\Models\FinancePartyModel::find($commitment->finance_party)->image)}}"
                     class="logo-2"></div>




        </div>

    </div>

    <div class="row space" >

        <div class="col-sm-8  text-left">
            <i class="glyphicon glyphicon-map-marker"></i> {{\App\Models\FinancePartyModel::find($commitment->finance_party)->address}}
        </div>
        <div class="col-sm-4 text-left">
            <div class="row">

                <div class="col-sm-12">
                    <i class="glyphicon glyphicon-phone"></i>{{\App\Models\FinancePartyModel::find($commitment->finance_party)->telephone}}
                </div>
                <div class="col-sm-12">
                    <i class="glyphicon glyphicon-envelope"></i> {{\App\Models\FinancePartyModel::find($commitment->finance_party)->email}}
                </div>

            </div>
        </div>



    </div>
</div>



</body>

</html>



