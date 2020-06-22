<html>
<head>

    <meta charset="utf-8"/>
    <title> Payment Form Report</title>


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
            <span class="titletext"> Payment</span>
        </div>
        <div class="col-sm-4 text-right">
            Date: {{date('Y-m-d', strtotime($payment->created_at))}}

        </div>
    </div>

</div>
<div class="container report-body">

    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Payment SN:</strong></div>

                <div class="col-sm-8"> Payemnt-{{$payment->id}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Payment Date:</strong></div>

                <div class="col-sm-8">  {{date('Y-m-d', strtotime($payment->created_at))}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Finance Party: </strong></div>

                <div class="col-sm-8">{{\App\Models\FinancePartyModel::getFianancePartyName($payment->finance_party)}} </div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Service provider: </strong></div>

                <div class="col-sm-8"> {{\App\Models\TypesModel::getTypeName($payment->service_provider)}}</div>
            </div>
        </div>
    </div>


    <div class="clearfix space"></div>
    <div class="row ">


        <div class="col-sm-4 col-sm-offset-2 ">
            <div class="row">
                <div class="col-sm-3"><h3><strong>Type:</strong></h3></div>

                <div class="col-sm-9"><h3
                            class="danger"> {{\App\Models\TypesModel::getTypeName($payment->type)}} </h3></div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-3"><h3><strong>Amount:</strong></h3></div>

                <div class="col-sm-9"><h3
                            class="danger">{{"  ".$payment->amount.' '.\App\Models\TypesModel::getTypeName($payment->currency)}} </h3>
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

</div>


<div class="container-fluid myreport-footer-top">
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-2">
            <h4> Notes</h4>
        </div>
        <div class="col-sm-10">
            {{$payment->notes}}
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row " style="padding-top: 20px; padding-bottom: 20px">
        <div class="col-sm-6  ">
            <strong> Name: Tarek O. Tamimi </strong>
        </div>
        <div class="col-sm-6 padding-15-all  ">
            <strong> Signature: </strong>
        </div>
        <div class="col-sm-6"></div>
        <div class="col-sm-6 padding-15-all  ">
            <strong> Date: </strong>{{date('Y-m-d')}}
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row  ">


        <div class="col-sm-12  ">
            <strong> *This Payment Produced By Optimum Solution CRM for Medical Case Management:</strong>
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



