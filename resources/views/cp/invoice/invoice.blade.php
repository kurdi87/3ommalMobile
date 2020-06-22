<html>
<head>

    <meta charset="utf-8"/>
    <title>Invoice Form Report</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}" />

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}" />






</head>
<body>
<div class="container-fluid report-header">


                <div class="row">
                    <div class="col-sm-6 text-left ">
                        <div class="logo">



                            <img src="{{asset("cp/images/logo-1.png")}}"></div>
                    </div>

                    <div class="col-sm-2 text-left">
                        <span class="titletext">Invoice</span>
                    </div>
                    <div class="col-sm-2 text-center">
                        Reference No: {{isset($ref)?$ref:'Invoice-' . $invoice->id . '-1'}}
                    </div>
                    <div class="col-sm-2 text-right">
                        Date: {{date('Y-m-d', strtotime($invoice->invoice_date))}}
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
                <div class="col-sm-4"><strong>Birth of Date:</strong></div>

                <div class="col-sm-8">{{date('Y-m-d', strtotime($patient->bod))}}</div>
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
                <div class="col-sm-4 "><strong>Finance Party:</strong></div>

                <div class="col-sm-8">{{\App\Models\FinancePartyModel::getFianancePartyName($event->finance_party)}}</div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Claim Number:</strong></div>

                <div class="col-sm-8">{{$patient->dno}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Hospital:</strong></div>

                <div class="col-sm-8">{{\App\Models\RecipeModel::getHospitalName($admission->hospital_id)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Department:</strong></div>

                <div class="col-sm-8">{{\App\Models\DepartmentModel::getDepartmentName($admission->department_id)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Service Type:</strong></div>

                <div class="col-sm-8">{{\App\Models\TypesModel::getTypeName($event->service_type)}}</div>
            </div>
        </div>
</div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-5"><strong>Admission Date:</strong></div>

                <div class="col-sm-7">{{date('Y-m-d', strtotime($admission->admission_date))}}</div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-5"><strong>Discharge Date:</strong></div>

                <div class="col-sm-7">{{date('Y-m-d', strtotime($admission->discharge_date))}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Invoice Date:</strong></div>

                <div class="col-sm-8">{{date('Y-m-d', strtotime($invoice->invoice_date))}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-5"><strong>Month Of Invoice:</strong></div>

                <div class="col-sm-7">{{$invoice_month[$invoice->invoice_month]}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-5"><h4><strong>Appoved Cost:</strong></h4></div>

                <div class="col-sm-7"><h4>{{$invoice->approved_cost}}(NIS)<h4></div>
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
                    <table class="table table-striped table-bordered table-hover  order-column" id="">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Description Of Procedure</th>
                            <th>Price(NIS)</th>
                            <th>Quantity</th>
                            <th>Total(NIS)</th>
                            <th>Discount(NIS)</th>
                            <th>Grand Total(NIS)</th>
                            <th>Note</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php
                            $count=0;
                            $total=0;
                            $grand_total=0;
                            $total_discount=0
                        @endphp
                        @foreach(\App\Models\InvoiceProcedureModel::getProcedureByInvoice($invoice->id) as $r)
                            @php
                                $count++;
                                $dis=(($r->perc=="1")?$r->cost*$r->discount/100: $r->discount);
                                $total=$total+($r->qty * $r->cost);
                                $total_discount=$total_discount+$dis;
                                 $grand_total=$grand_total+($r->qty * $r->cost)-$dis;
                            @endphp
                            <tr>
                                <td>{{$count}} </td>
                                <td>{{$r->serviceCode}} </td>
                                <td>{{$r->name}}</td>
                                <td>{{$r->cost}}</td>
                                <td>{{$r->qty}}</td>
                                <td>{{$r->qty * $r->cost}}</td>
                                <td>{{$dis}}</td>
                                <td>{{$r->qty * $r->cost-$r->discount}}</td>
                                <td>{{$r->about_procedure}}<br>{{$r->other_notes}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <td colspan="2" align="center"><strong>Special Discount(NIS)</strong></td>
                        <td colspan="2"><strong>{{$invoice->perc?($invoice->discount*$grand_total/100):$invoice->discount}}</strong></td>
                        <td colspan="2"><strong>Approved Cost(NIS)</strong></td>

                        <td colspan="3"><strong>{{$invoice->approved_cost}}</strong></td>
                        </tfoot>
                        <tfoot>
                        <td colspan="5" align="center">Total(NIS)</td>
                        <td colspan="1">{{$grand_total}}</td>
                        <td colspan="1">{{$total_discount}}</td>

                        <td colspan="1">{{$total}}</td>
                        </tfoot>


                    </table>
                </div>
            </div>
</div>
<div class="container-fluid myreport-footer-top">
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-2">
            <h4>Audit Notes</h4>
        </div>
        <div class="col-sm-10">
          {{$invoice->notes}}
            <br><br>
            {{$invoice->other_notes}}
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row  ">


        <div class="col-sm-12  ">
           <strong> *This Invoice Produced By Optimum Solution CRM for Medical Case Management:</strong>
        </div>
        <div class="col-sm-12  ">
            <strong> User: </strong>{{ \Auth::user("admin")->SysUsr_FullName}}
        </div>
        <div class="col-sm-12  ">
            <strong> Date: </strong>{{date('Y-m-d')}}
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>



