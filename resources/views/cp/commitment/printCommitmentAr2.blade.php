<html>
<head>

    <meta charset="utf-8"/>
    <title>تغطية مالية</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}"/>

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}"/>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style>


    </style>
</head>


<body dir="rtl">

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
<div class="container report-body" dir="rtl">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h3><strong> <span class="titletext">تغطية مالية</span></strong></h3>
        </div>
    </div>
    <br>
    <br>

    <div class="row ">
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-7">{{ isset(\App\Models\CityModel::find($patient->city)->name_ar)? \App\Models\CityModel::find($patient->city)->name_ar :''}}</div>
                <div class="col-sm-5"><strong>المدينة :</strong></div>


            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6">{{$patient->bod?date('d/m/Y', strtotime($patient->bod)):''}}</div>
                <div class="col-sm-6"><strong>تاريخ الميلاد:</strong></div>


            </div>
        </div>


        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6">{{$patient->sid}}</div>
                <div class="col-sm-6"><strong>رقم الهوية:</strong></div>


            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-7">{{$patient->fname_ar}} {{$patient->sname_ar}} {{$patient->tname_ar}} {{$patient->faname_ar}}</div>
                <div class="col-sm-5"><strong>أسم المريض:</strong></div>


            </div>
        </div>


    </div>

    @if($commitment->accident_id!=0)
        <div class="clearfix space"></div>
        <div class="row">


            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6">{{$commitment->claim_no}}</div>
                    <div class="col-sm-6"><strong>رقم الادعاء:</strong></div>


                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6">{{\App\Models\AccidentModel::find($commitment->accident_id)->branch_name}}</div>
                    <div class="col-sm-6"><strong>الفرع المسؤل:</strong></div>


                </div>
            </div>

            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6">{{\App\Models\TypesModel::getTypeName(\App\Models\AccidentModel::find($commitment->accident_id)->type,2)}}</div>
                    <div class="col-sm-6"><strong>نوع الحادث:</strong></div>


                </div>
            </div>

            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6">{{date('d/m/Y',strtotime(\App\Models\AccidentModel::find($commitment->accident_id)->accident_date))}}</div>
                    <div class="col-sm-6"><strong>تاريخ الحادث:</strong></div>


                </div>
            </div>


        </div>
        <div class="clearfix space"></div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
            @if(isset(\App\Models\AccidentPatientModel::where('accident_id',$commitment->accident_id)->where('patient_id',$commitment->patient_id)->get()->first()->injury))
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-6">{{\App\Models\TypesModel::getTypeName(\App\Models\AccidentPatientModel::where('accident_id',$commitment->accident_id)->where('patient_id',$commitment->patient_id)->get()->first()->injury,2)}}</div>
                        <div class="col-sm-6"><strong> طبيعة الإصابة:</strong></div>


                    </div>
                </div>
            @endif
            @if(isset(\App\Models\AccidentPatientModel::where('accident_id',$commitment->accident_id)->where('patient_id',$commitment->patient_id)->get()->first()->result))
                <div class="col-sm-3">
                    <div class="row">

                        <div class="col-sm-6">{{\App\Models\TypesModel::getTypeName(\App\Models\AccidentPatientModel::where('accident_id',$commitment->accident_id)->where('patient_id',$commitment->patient_id)->get()->first()->result,2)}}</div>
                        <div class="col-sm-6"><strong>نتائج الحادث:</strong></div>


                    </div>
                </div>
            @endif

        </div>
    @endif

    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 ">
            <br><br>
            <span><h4 class="danger"><strong>
                            نحن نتعهد بتغطية جميع النفقات الطبية للحالة المرفقة كما هو موضح أدناه

                            </strong></h4></span>

            <br><br>

            <table class="table table-striped table-bordered   order-column" id="">
                <thead>
                </thead>
                </thead>
                <tbody>
                <tr>
                    <td>رقم التغطية</td>
                    <td>CL-{{$commitment->id}} </td>
                </tr>
                <tr>
                    <td>رقم المرجع</td>
                    <td>{{$reference}} </td>
                </tr>
                <tr>
                    <td>تاريخ تقديم الخدمة</td>
                    <td>
                        من: {{$commitment->service_date?date('d/m/Y', strtotime($commitment->service_date)):'         '}}
                        إلى: {{$commitment->service_date_to?date('d/m/Y', strtotime($commitment->service_date_to)):'      '}}

                    </td>
                </tr>


                <tr>
                    <td>متعهد الخدمة</td>
                    <td>{{\App\Models\RecipeModel::getHospitalName($commitment->hospital_id,2)}}</td>
                </tr>
                <tr>
                    <td>نوع الخدمة</td>
                    <td>{{\App\Models\TypesModel::getTypeName($commitment->serviceType,2)}}</td>
                </tr>
                <tr>
                    <td>القسم</td>
                    <td>{{\App\Models\DepartmentModel::getDepartmentName($commitment->department_id,2)}}</td>
                </tr>


                <tr>
                    <td><h4 class="danger">الحد الأعلى للتغطية</h4></td>
                    <td>
                        <h4 class="strong">{{($commitment->amount)?$commitment->amount.' '.(($commitment->currency)?\App\Models\TypesModel::getTypeName($commitment->currency):'NIS'):"غير محدد"}}</h4>
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
                        <h4><strong>الإجراءات الطبية:</strong></h4></td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">الرقم</th>
                    <th class="text-center">وصف الإجراء</th>
                    <th class="text-center">التكلفة</th>
                    <th class="text-center">الكمية</th>
                    <th class="text-center">المجموع</th>

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
                <td colspan="5" align="center">المجموع الكلي للإجراءات</td>
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
                        <h4><strong>الأدوية:</strong></h4></td>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">الرقم</th>
                    <th class="text-center">العلاج</th>
                    <th class="text-center">التكلفة</th>
                    <th class="text-center">الكمية</th>
                    <th class="text-center">المجموع</th>

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
                <td colspan="5" align="center">المجموع الكلي للعلاجات</td>
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
            <div class="col-sm-12">
                <h4>ملاحظة</h4>
            </div>
            <div class="col-sm-12">
                {{$commitment->notes}}
                <br><br>
                {{$commitment->other_notes}}
            </div>
        </div>
        <div class="clearfix space"></div>
        <div class="row ">


            <div class="col-sm-4  ">

                <img src="{{asset("cp/images/".\App\Models\FinancePartyModel::find($commitment->finance_party)->image)}}"
                     class="logo-2"></div>
            <div class="col-sm-1  ">
                <strong> التوقيع: </strong>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-7">{{$commitment->coverage_date?date('d/m/Y', strtotime($commitment->coverage_date)):''}}</div>
                    <div class="col-sm-5"><strong>تايخ إصدار التغطية:</strong></div>


                </div>
            </div>


        </div>

    </div>

    <div class="row space">


        <div class="col-sm-4 text-right">
            <div class="row">

                <div class="col-sm-12">
                    <i class="glyphicon glyphicon-phone"></i>{{\App\Models\FinancePartyModel::find($commitment->finance_party)->telephone}}
                </div>
                <div class="col-sm-12">
                    <i class="glyphicon glyphicon-envelope"></i> {{\App\Models\FinancePartyModel::find($commitment->finance_party)->email}}
                </div>

            </div>
        </div>
        <div class="col-sm-8  text-right">
            <i class="glyphicon glyphicon-map-marker"></i> {{\App\Models\FinancePartyModel::find($commitment->finance_party)->address}}
        </div>


    </div>
</div>


</body>

</html>



