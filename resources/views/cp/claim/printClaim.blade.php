<html>
<head>

    <meta charset="utf-8"/>
    <title>Claim  Report</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}"/>

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}"/>
    <style>
        .bold {
            font-weight: bold;
            margin: auto;
        }
        html, body {

            margin-bottom: -100px !important;
            padding: 15px !important;
            overflow: hidden;
            transform: scale(1) !important;

        }

        @media print {
            .bold {
                font-weight: bold;
                margin: auto;
            }
            html, body {

                margin-bottom: -100px !important;
                padding: 30px !important;
                overflow: hidden;
                transform: scale(1) !important;

            }


        }

    </style>

</head>
<body>
<div class="container-fluid report-header">


    <div class="row">
        <div class="col-sm-4 text-left ">
            <div class="logo">


                <img src="{{asset("cp/images/logo-1.png")}}"></div>
        </div>

        <div class="col-sm-4 text-center">
            <span class="titletext">Claim #{{$claim->id}} </span>
        </div>
        <div class="col-sm-4 text-right">
            Date: {{date('d/m/Y', strtotime($claim->created_at))}}

        </div>
    </div>

</div>
<div class="container report-body">

    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Claim SN:</strong></div>

                <div class="col-sm-8"> Claim-{{$claim->id}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Claim Date:</strong></div>

                <div class="col-sm-8">  {{date('d/m/Y', strtotime($claim->created_at))}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Finance Party: </strong></div>

                <div class="col-sm-8">{{\App\Models\FinancePartyModel::getFianancePartyName($claim->finance_party)}} </div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Patient Name:</strong></div>

                <div class="col-sm-8">{{$patient->fname}} {{$patient->faname}} </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Patient ID :</strong></div>

                <div class="col-sm-8">{{$patient->sid}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Date of Birth:</strong></div>

                <div class="col-sm-8">{{date('d/m/Y', strtotime($patient->bod))}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>City :</strong></div>

                <div class="col-sm-8">{{ isset(\App\Models\CityModel::find($patient->city)->name_en)? \App\Models\CityModel::find($patient->city)->name_en :''}}</div>
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
    <div class="row ">
        <div class="col-sm-4 col-sm-offset-2 ">
            <div class="row">
                <div class="col-sm-3"><strong>Service:</strong></div>

                <div class="col-sm-9"> {{\App\Models\TypesModel::getTypeName($claim->serviceType)}} </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-3"><strong>Amount:</strong></div>

                <div class="col-sm-9">{{"  ".$claim->amount.' '.\App\Models\TypesModel::getTypeName($claim->currency)}}
                </div>
            </div>
        </div>

    </div>


</div>
<div class="row">
    <div class="clearfix">
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1 ">
        <span><h3 class="danger">Claim for events: </h3></span>
        <table class="table table-striped table-bordered table-hover  order-column" id="">

            <thead>
            <tr>

                <th>ID</th>

                <th>Hospital</th>
                <th>Admission Date</th>
                <th>Discharge Date</th>
                <th>Cost NIS</th>

            </tr>
            </thead>
            <tbody>


            @foreach($event as $i)

                <tr>

                    <td>
                        {{$i->id}}
                    </td>
                    <td>

                        {{$i->hospital}}

                    </td>
                    <td> {{date('d/m/Y', strtotime($i->admission_date))}}</td>
                    <td> {{date('d/m/Y', strtotime($i->discharge_date))}}</td>
                    <td>{{$i->approved_cost}}</td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>


<div class="container-fluid myreport-footer-top">
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-2">
            <h4> Notes</h4>
        </div>
        <div class="col-sm-10">
            {{$claim->notes}}
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row " style="padding-top: 20px; padding-bottom: 20px">
        <div class="col-sm-6  ">
            <strong> Name: Tarek O. Tamimi </strong>
        </div>
        <div class="col-sm-6 padding-15-all text-center  ">
            <strong> Signature: </strong>
        </div>
        <div class="col-sm-6"></div>

    </div>
    <div class="clearfix space"></div>
    <div class="row  ">


        <div class="col-sm-12  ">
            <strong> *This Claim Produced By Optimum Solutions CRM for Medical Case Management:</strong>
        </div>
        <div class="col-sm-12  ">
            <strong> User: </strong>{{ \Auth::user("admin")->SysUsr_FullName}}
        </div>
        <div class="col-sm-12  ">
            <strong> Date: </strong>{{date('d/m/Y')}}
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



