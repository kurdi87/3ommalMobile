<html>

<head>

    <meta charset="utf-8"/>
    <title>مطالبة مالية</title>


    <link rel="stylesheet" href="{{ asset("cp/assets/global/plugins/bootstrap/css/bootstrap.min.css") }}"/>

    <link rel="stylesheet" href="{{ asset("cp/css/report.css") }}"/>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style>
        .bold {
            font-weight: bold;
            margin: auto;
        }
        html, body {

            margin-bottom: -100px !important;
            padding: 0 !important;
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
                padding: 30 !important;
                overflow: hidden;
                transform: scale(1) !important;

            }


        }

    </style>
</head>


<body dir="rtl">

<div class="container-fluid report-header">


    <div class="row">
        <div class="pbutton">
            <button type="button" class="btn btn-success" onclick="window.print();">
                Print
            </button>
            <a href="/{{ config('app.cp_route_name') }}/claim/SubmitprintClaim/{{$claim->id}}"
               type="button" class="btn btn-primary">
                Sumbit To Attachment
            </a>

            <br><br>
        </div>
        <div class="col-sm-6 text-left ">
            <div class="logo">


                <img src="{{asset("cp/images/logo-1.png")}}"></div>
        </div>
        <div class="col-sm-2 text-left">

        </div>
        <div class="col-sm-2 text-center">

        </div>
        <div class="col-sm-2 text-right">

        </div>


    </div>

</div>
<div class="container report-body" dir="rtl">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h3><strong> <span class="titletext">مطالبة مالية # {{$claim->id}}</span></strong></h3>
        </div>
    </div>
    <br>
    <br>

    <div class="row ">
        <div class="col-sm-12">
            <h4><strong> السادة/ {{\App\Models\FinancePartyModel::find($claim->finance_party)->name_ar}}</strong></h4>
        </div>
        <br><br>
        <div class="col-sm-12  ">
            <h4><strong> *نرجو من حضرتكم تسديد مبلغ بدل الخدمات المذكورة ادناه</strong></h4>
        </div>

        <br><br>
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-hover  order-column">
                <tr>
                    <td colspan="8"><h4><strong>تفاصيل المصاب والحادث</strong></h4></td>
                </tr>
                <tr>
                    <td width="17%" class="bold">أسم المريض:</td>
                    <td width="16%">{{$patient->fname_ar}} {{$patient->sname_ar}}  {{$patient->faname_ar}}</td>
                    <td width="17%" class="bold">رقم الهوية:</td>
                    <td width="16.3%">{{$patient->sid}}</td>
                    <td width="16%" class="bold">تاريخ الميلاد:</td>
                    <td width="17.3%">{{$patient->bod?date('d/m/Y', strtotime($patient->bod)):''}}</td>

                </tr>


                <tr>
                    <td width="17%" class="bold">المدينة:</td>
                    <td width="16%">{{\App\Models\CityModel::getCityName($patient->city,2)}}</td>
                    <td width="16" class="bold">شركة التأمين:</td>
                    <td width="17.3">{{\App\Models\FinancePartyModel::find($claim->finance_party)->name_ar}}</td>


                    @if(isset($claim->accident_id) &&$claim->accident_id>0)
                        <td width="17%" class="bold">تاريخ الحادث:</td>
                        <td width="16.3%">{{date('d/m/Y',strtotime(\App\Models\AccidentModel::find($claim->accident_id)->accident_date))}}</td>

                    @else
                        <td width="17%" class="bold">تاريخ الحادث:</td>
                        <td width="16.3%">{{date('d/m/Y',strtotime($claim->accident_date))}}</td>


                    @endif


                </tr>
                @if($claim->accident_id>0)
                    <tr>
                        <td width="17%" class="bold">الفرع المسؤول:</td>
                        <td width="16%">{{\App\Models\AccidentModel::find($claim->accident_id)->branch_name}}</td>
                        <td width="16%" class="bold">نوع الحادث :</td>
                        <td width="17.3%">{{\App\Models\TypesModel::getTypeName(\App\Models\AccidentModel::find($claim->accident_id)->type,2)}}</td>
                        <td width="17" class="bold">رقم الادعاء:</td>
                        <td width="16">{{\App\Models\AccidentModel::find($claim->accident_id)->claim_no}}</td>


                    </tr>
                @else
                    <tr>
                        <td width="17%" class="bold">الفرع المسؤول:</td>
                        <td width="16%">{{$claim->branch_name}}</td>
                        <td width="16%" class="bold">نوع الحادث :</td>
                        <td width="17.3%">{{\App\Models\TypesModel::getTypeName($claim->accident_type,2)}}</td>
                        <td width="17" class="bold">رقم الادعاء:</td>
                        <td width="16">{{$claim->claim_no}}</td>


                    </tr>


                @endif
                @if($claim->invoice_id>0)
                    @php
                        $invoice = \App\Models\InvoiceModel::find($claim->invoice_id);
                        $admission= \App\Models\AdmissionModel::find($invoice->admission_id);
                        $event= \App\Models\EventModel::find($admission->event_id);
                    @endphp
                    <tr>
                        <td width="17%" class="bold">المستشفى:</td>
                        <td width="16%">{{\App\Models\RecipeModel::getHospitalName($admission->hospital_id,2)}}</td>
                        <td width="16%" class="bold">نوع الخدمة :</td>
                        <td width="17.3%">{{\App\Models\TypesModel::getTypeName($event->service_type,2)}}</td>
                        <td width="17" class="bold">تاريخ الخدمة:</td>
                        <td width="16">{{date('d/m/Y', strtotime($admission->admission_date))}}</td>
                    </tr>

                    <tr>
                        <td width="17%" class="bold">تاريخ الفاتورة:</td>
                        <td width="16%">{{date('d/m/Y', strtotime($invoice->invoice_date))}}</td>
                        <td width="16%" class="bold"> رقم الفاتورة: </td>
                        <td width="17.3%">{{$invoice->invoice_no}}</td>
                        <td width="17" class="bold">شهر الفاتورة:</td>
                        <td width="16">{{$invoice_month[$invoice->invoice_month]}} - {{$invoice->invoice_year}} </td>
                    </tr>
                    @endif


            </table>
        </div>


    </div>


    <div class="row ">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 ">
            <table class="table table-striped table-bordered table-hover  order-column">

                <tr>
                    <td class="bold"> نوع الخدمة المقدمة من شركة Optimum Solutions</td>
                    <td class="bold">العدد</td>
                    <td class="bold">التكلفة</td>
                    <td class="bold">المجموع</td>
                </tr>
                <tr>
                    <td> {{\App\Models\TypesModel::getTypeName($claim->serviceType,2)}} </td>
                    <td>{{$claim->qty}}</td>
                    <td>{{$claim->amount}}</td>
                    <td>{{$claim->amount*$claim->qty}} {{($claim->currency)?\App\Models\TypesModel::getTypeName($claim->currency):'NIS'}}</td>

                </tr>


            </table>
        </div>
        <div class="col-sm-2"></div>
    </div>


</div>

<div class="bottomPage">
    <div class="container-fluid report-footer-top">
        <div class="clearfix space"></div>

        @if(strlen($claim->notes)>1)
            <div class="row">
                <div class="col-sm-12">
                    <h4>ملاحظة</h4>
                </div>
                <div class="col-sm-12">
                    {{$claim->notes}}
                </div>
            </div>
        @endif



            <div class="col-sm-4  ">

                <img src="{{asset("cp/images/logo-1.png")}}"
                     class="logo-2"></div>
            <div class="col-sm-1  ">
                <strong> التوقيع: </strong>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-7">{{date('d/m/Y',strtotime($claim->claim_date))}}</div>
                    <div class="col-sm-5"><strong>تايخ إصدار المطالبة:</strong></div>


                </div>
            </div>


        </div>

    </div>

    <div class="row space ">

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
                    <i class="glyphicon glyphicon-map-marker"></i> رام الله, شارع جمال عبدالناصر, الطابق الأرضي بالقرب
                    من المدرسة الأنجليزية
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



