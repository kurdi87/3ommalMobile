<html>
<head>

    <meta charset="utf-8"/>
    <title>تقرير تدقيق</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css") }}" />

    <link rel="stylesheet" href="{{ asset("cp/css/report-rtl.css") }}" />






</head>
<body dir="rtl">
<div class="container-fluid report-header">


    <div class="pbutton">
        <button type="button" class="btn btn-success" onclick="window.print();">
            Print
        </button>
        <a href="/{{ config('app.cp_route_name') }}/invoice/SubmitprintInvoice/{{$invoice->id}}"
           type="button" class="btn btn-primary">
            Sumbit To Attachment
        </a>
        <br><br>
    </div>
                <div class="row">

                    <div class="col-sm-6 text-left ">
                        <div class="logo">



                            <img src="{{asset("cp/images/logo-1.png")}}"></div>
                    </div>

                    <div class="col-sm-2 text-left">
                        <h3><span class="titletext">تقرير تدقيق</span></h3>
                    </div>
                    <div class="col-sm-2 text-center">
                        رقم المرجع: {{isset($ref)?$ref:'Invoice-' . $invoice->id . '-1'}}
                    </div>
                    <div class="col-sm-2 text-right">
                        التاريخ: {{date('d/m/Y', strtotime($invoice->invoice_date))}}
                    </div>
                </div>

</div>
<div class="container report-body">
    <div class="clearfix"><br></div>
    <div class="row ">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>اسم المريض:</strong></div>

                <div class="col-sm-8 ">{{$patient->fname_ar}} {{$patient->sname_ar}} {{$patient->tname_ar}} {{$patient->faname_ar}} </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-4"><strong>رقم الهوية :</strong></div>

                <div class="col-sm-6 text-left">{{$patient->sid}}</div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="row">
                <div class="col-sm-6"><strong>تاريخ الميلاد:</strong></div>

                <div class="col-sm-6">{{date('d/m/Y', strtotime($patient->bod))}}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6"><strong>المدينة :</strong></div>

                <div class="col-sm-6">{{ isset(\App\Models\CityModel::find($patient->city)->name_ar)? \App\Models\CityModel::find($patient->city)->name_ar :''}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6 "><strong>شركة التأمين:</strong></div>
                <div class="col-sm-6">{{\App\Models\FinancePartyModel::getFianancePartyName($event->finance_party,2)}}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6 "><strong>الفرع المسؤول:</strong></div>
                <div class="col-sm-6">{{isset($accident)?$accident->branch_name:''}}</div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6"><strong>نوع الحادث:</strong></div>

                <div class="col-sm-6">{{isset($accident)?\App\Models\TypesModel::getTypeName($accident->type,2):''}}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6"><strong>تاريخ الحادث:</strong></div>
                <div class="col-sm-6">{{isset($accident)?date('d/m/Y',strtotime($accident->accident_date)):''}}</div>

            </div>
        </div>

        <div class="clearfix "><br><br></div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong> رقم الإدعاء:</strong></div>
                    <div class="col-sm-6">{{isset($accident)?$accident->claim_no:''}}</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-6"><strong> طبيعة الإصابة:</strong></div>
                    <div class="col-sm-6">{{isset($accident_patient)?\App\Models\TypesModel::getTypeName($accident_patient->injury,2):''}}</div>
                </div>
            </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-6"><strong> نتائج الحادث:</strong></div>
                <div class="col-sm-6">{{isset($accident_patient)?\App\Models\TypesModel::getTypeName($accident_patient->result,2):''}}</div>
            </div>
        </div>

    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>المستشفى:</strong></div>

                <div class="col-sm-8">{{\App\Models\RecipeModel::getHospitalName($admission->hospital_id,2)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>القسم:</strong></div>
                <div class="col-sm-8">{{\App\Models\DepartmentModel::getDepartmentName($admission->department_id,2)}}</div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-4"><strong>نوع الخدمة:</strong></div>

                <div class="col-sm-8">{{\App\Models\TypesModel::getTypeName($event->service_type,2)}}</div>
            </div>
        </div>
</div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-5"><strong>تاريخ الدخول:</strong></div>

                <div class="col-sm-7">{{date('d/m/Y', strtotime($admission->admission_date))}}</div>
            </div>
        </div>


        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-5"><strong>تاريخ الخروج:</strong></div>

                <div class="col-sm-7">{{date('d/m/Y', strtotime($admission->discharge_date))}}</div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-4"><strong>تاريخ الفاتورة:</strong></div>

                <div class="col-sm-8">{{date('d/m/Y', strtotime($invoice->invoice_date))}}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-4"><strong> رقم الفاتورة:</strong></div>

                <div class="col-sm-8">{{$invoice->invoice_no}}</div>
            </div>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-5"><strong>شهر الفاتورة:</strong></div>

                <div class="col-sm-7">{{$invoice_month[$invoice->invoice_month]}} - {{$invoice->invoice_year}} </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-6"><h4><strong>المبلغ النهائي المدقق :</strong></h4></div>

                <div class="col-sm-6"><h4>{{number_format($invoice->approved_cost,2)}} NIS<h4></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-6"><span><strong>نسبة الخصم بعد التدقيق :</strong></span></div>

                <div class="col-sm-6"><span>{{number_format(100-(($invoice->approved_cost/$invoice->total_cost)*100),0)}} %<h4></div>
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
                <div class="col-sm-12 ">
                    <table class="table table-striped table-bordered table-hover  order-column" id="">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الكود</th>
                            <th>الوصف</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>المجموع</th>
                            <th>الخصم الفني</th>
                            <th>الخصم التعاقدي</th>
                            <th>المبلغ بعد الخصم</th>
                            <th>ملاحظات</th>
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
                                $dis=(($r->perc=="1")?($r->cost*$r->discount)*$r->qty/100: $r->discount);
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
                                <td></td>
                                <td>{{$r->qty * $r->cost-$dis}}</td>

                                <td>{{$r->about_procedure}}<br>{{$r->other_notes}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot class="hidden">
                        <td colspan="2" align="center"><strong>خصم خاص(NIS)</strong></td>
                        <td colspan="6"><strong>{{$invoice->perc?($invoice->discount*$grand_total/100)."    (".$invoice->discount.")%":$invoice->discount." (". number_format(($invoice->discount/$total)*100,0)."%)" }}</strong></td>
                        </tfoot>
                        <tfoot>
                        <td colspan="5" align="center">  <strong>المجموع(NIS)</strong> </td>
                        <td colspan="1"><strong>{{number_format($total,1)}}</strong></td>
                        <td colspan="1"><strong>{{number_format($total_discount,1)}}</strong></td>
                        <td colspan="1"><strong>{{$invoice->perc?($invoice->discount*$grand_total/100)."    (".$invoice->discount.")%":$invoice->discount." (". number_format(($invoice->discount/$total)*100,0)."%)" }}</strong></td>
                        <td colspan="1"><strong>{{number_format($invoice->approved_cost,2)}} </strong></td>

                        </tfoot>


                    </table>
                </div>
            </div>
</div>
<div class="container-fluid myreport-footer-top">
    <div class="clearfix space"></div>
    <div class="row">
        <div class="col-sm-2">
            <h4>ملاحظات المدقق</h4>
        </div>
        <div class="col-sm-10">
          {{$invoice->notes}}
            <br><br>
            {{$invoice->other_notes}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">

        </div>
        <div class="col-sm-4  ">
            <strong> التوقيع: </strong>
        </div>
    </div>
    <div class="clearfix space"></div>
    <div class="row  ">


        <div class="col-sm-12  ">
           <strong> *هذه الفاتورة بعد التدقيق:</strong>
        </div>
        <div class="col-sm-12  ">
            <strong> الموظف: </strong>{{ \Auth::user("admin")->SysUsr_FullName}}
        </div>
        <div class="col-sm-12  ">
            <strong> التاريخ: </strong>{{date('d/m/Y')}}
        </div>
    </div>
            <div class="row myreport-footer ">

                <div class="col-sm-12  ">

                    <div class="row">
                        <div class="col-sm-8  text-left">
                            <i class="glyphicon glyphicon-map-marker"></i> رام الله, شارع جمال عبدالناصر, الطابق الأرضي بالقرب من المدرسة الأنجليزية </div>

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



