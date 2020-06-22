<html>
<head>

    <meta charset="utf-8"/>
    <title>Vacation  Report</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}"/>

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}"/>


</head>
<body>

<div class="container-fluid report-header header">


    <div class="row">
        <div class="col-sm-4 text-left ">
            <div class="logo">


                <img src="{{asset("cp/images/logo-1.png")}}"></div>
        </div>

        <div class="col-sm-4 text-center">
            <span class="titletext"> Vacation Report</span>
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
                <div class="col-sm-4"><strong>Employee Name:</strong></div>

                <div class="col-sm-8">{{$employee->name}} </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong> Empno:</strong></div>

                <div class="col-sm-8">{{$employee->empno}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Date of Birth:</strong></div>

                <div class="col-sm-4">{{date('d/m/Y', strtotime($employee->bod))}}</div>
                <div class="col-sm-2"><strong>Age:</strong></div>

                <div class="col-sm-2">{{$age}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-3"><strong>Department:</strong></div>

                <div class="col-sm-9">{{isset($employee->department_id)?\App\Models\Hr_departmentModel::getHr_departmentName($employee->department_id):Null}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4 "><strong>Title:</strong></div>

                <div class="col-sm-8">{{isset($employee->job_title)?$employee->job_title:Null}}</div>
            </div>
        </div>

    </div>
    <div class="clearfix space"></div>

    <div class="row">


        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>From Date:</strong></div>

                <div class="col-sm-8">{{date('d/m/Y', strtotime($vacation->from_date))}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>To Date:</strong></div>

                <div class="col-sm-8">{{date('d/m/Y', strtotime($vacation->to_date))}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Days:</strong></div>

                <div class="col-sm-8">{{$vacation->days}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Leaves Balance:</strong></div>

                <div class="col-sm-8">{{$employee->leaves}}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>Sick balance:</strong></div>

                <div class="col-sm-8">{{$employee->sick}}</div>
            </div>
        </div>

    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <h4 class="text-left"><strong>Type:</strong></h4>
        </div>
        <div class="col-sm-8">
            {{\App\Models\TypesModel::getTypeName($vacation->type)}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <h4 class="text-left"><strong>Reason:</strong></h4>
        </div>
        <div class="col-sm-8">
            {{$vacation->reason}}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <h4 class="text-left"><strong>Address:</strong></h4>
        </div>
        <div class="col-sm-8">
            {{$vacation->address}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <h4 class="text-left"><strong>Contact No:</strong></h4>
        </div>
        <div class="col-sm-8">
            {{$vacation->contact_no}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <h4 class="text-left"><strong>Comments:</strong></h4>
        </div>
        <div class="col-sm-8">
            {{$vacation->comment}}
        </div>
    </div>


    <div class="row">
        <div class="clearfix">
            <hr>
        </div>

    </div>

</div>
<div class="container-fluid myreport-footer-top footer ">


    <div class="clearfix space"></div>
    <div class="row  ">


        <div class="col-sm-12  ">
            <strong> *This Vacation Produced By Optimum Solution CRM for Medical Case Management:</strong>
        </div>
        <div class="col-sm-12  ">
            <strong> User: </strong>{{ \Auth::user("admin")->SysUsr_FullName}}
        </div>
        <div class="col-sm-12  ">
            <strong> Date: </strong>{{date('d/m/Y')}}
        </div>
        <div id="pageFooter" class="col-sm-12  "><strong> Page: </strong></div>
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



