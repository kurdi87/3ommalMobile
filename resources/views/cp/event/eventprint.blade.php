<html>
<head>

    <meta charset="utf-8"/>
    <title>Event Report</title>


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
                        <span class="titletext">Event Report</span>
                    </div>
                    <div class="col-sm-4 text-right">
                        Date: {{date('d/m/Y')}}

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
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Hospital:</strong></div>

                <div class="col-sm-8">{{\App\Models\RecipeModel::getHospitalName($event->hospital_id)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Department:</strong></div>

                <div class="col-sm-8">{{\App\Models\DepartmentModel::getDepartmentName($event->department_id)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Service Type:</strong></div>

                <div class="col-sm-8">{{\App\Models\TypesModel::getTypeName($event->coverage_type)}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Service Date:</strong></div>

                <div class="col-sm-8">{{date('d/m/Y', strtotime($event->coverage_date))}}</div>
            </div>
        </div>
</div>
    <div class="clearfix space"></div>



    <div class="row">
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
                @foreach(\App\Models\EventProcedureModel::getProcedureByEvent($event->id) as $r)
                    @php
                        $count++;
                        $total=$total+($r->qty * $r->cost);
                    @endphp
                    <tr>
                        <td>{{$count}} </td>
                        <td>{{$r->serviceCode}} </td>
                        <td>{{$r->name}}</td>
                        <td>{{$r->cost}}</td>
                        <td>{{$r->qty}}</td>
                        <td>{{$r->qty * $r->cost}}</td>
                        <td>{{$r->about_procedure}}</td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <td colspan="5" align="center">Grand Total</td>
                <td>{{$total}}</td>
                </tfoot>
            </table>
        </div>
    </div>

    </div>
</div>
<div class="container-fluid myreport-footer-top">

    <div class="row  ">


        <div class="col-sm-12  ">
           <strong></strong>
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



