<?php namespace App\Http\Controllers\Admin;

use App\Models\AccidentModel;
use App\Models\AccidentPatientInvoiceModel;
use App\Models\AccidentPatientModel;
use App\Models\AdmissionModel;
use App\Models\AdmissionProcessModel;
use App\Models\AppointmentModel;
use App\Models\BeneficiaryModel;
use App\Models\CardModel;
use App\Models\CaseMangerModel;
use App\Models\EmployeeModel;
use App\Models\EventModel;
use App\Models\ExceptionModel;
use App\Models\GopModel;
use App\Models\InvoiceModel;
use App\Models\InvoiceProcessModel;
use App\Models\LeadModel;
use App\Models\PatientModel;
use App\Models\Request_to_callModel;
use App\Models\RoleModel;
use App\Models\SystemUserModel;
use App\Models\TypesModel;
use Illuminate\Http\Request;

class DashboardController extends SuperAdminController
{
    public function __construct()
    {
        try {
            parent::__construct();
            parent::$data['active_menu'] = "dashboard";
            parent::$data["role"] = \Auth::user("admin")->role;

            parent::$data["user_id"] = \Auth::user("admin")->SysUsr_ID;


            //var_dump(parent::$data); exit;
        } catch (\Exception $e) {
            redirect(parent::$data['cp_route_name'] . '/login');
        }
    }

    public function getIndex(Request $request)
    {

        /*$year =  isset($request->year)?$request->year:date('Y');
        $user_id = isset($request->SysUsr_ID) ? $request->SysUsr_ID : \Auth::user("admin")->SysUsr_ID;
        $role = SystemUserModel::find($user_id)->role;
        parent::$data["role"] = $role;
        parent::$data["year"] = $year;
        parent::$data["user_id"] = $user_id;
        parent::$data["User"] = SystemUserModel::find($user_id);
        parent::$data["Users"] = SystemUserModel::getUsers();
        parent::$data["newEvent"] = EventModel::CountEvent(1, $user_id);
        parent::$data["PICAccidentPatient"] =AccidentPatientModel::getPatientByFP(9,$year);//pic
        parent::$data["leadsMedi"] = LeadModel::CountLeads(0, 1);
        parent::$data["leadsTf"] = LeadModel::CountLeads(0, 2);
        parent::$data["leadsCRM"] = LeadModel::CountLeads();
        parent::$data["coordinators"] = EmployeeModel::wherein('type', ['62', '60', '61'])->where('active', 1)->get();
        parent::$data["processingInvoice"] = InvoiceModel::CountInvoice(15, $user_id);
        parent::$data["processingGop"] = GopModel::CountGop(15, $user_id, 0);
        parent::$data["processingGopSent"] = GopModel::CountGop(29, $user_id, 0);
        parent::$data["processingGopP"] = GopModel::CountGop(15, $user_id, 108);
        parent::$data["processingGopNP"] = GopModel::CountGop(15, $user_id, 109);
        parent::$data["newAppointment"] = AppointmentModel::CountAppointment(15, $user_id);
        parent::$data["newlead"] = LeadModel::CountLeads(15);
        parent::$data["newAdmisison"] = AdmissionModel::CountAdmission(7, $user_id) + AdmissionModel::CountAdmission(4, $user_id);
        parent::$data["request_to_call"] = Request_to_callModel::CountRequest_to_calls(1, $user_id) + Request_to_callModel::CountRequest_to_calls(8, $user_id);
        parent::$data["dischargeAdmisison"] = AdmissionModel::CountAdmission(14, $user_id);
        parent::$data["ReferralNotSent"] = EventModel::CountReferralNotSent();
        parent::$data["AdmissionProcess"] = AdmissionProcessModel::getAdmissionEvent($role);
        parent::$data["InvoiceProcess"] = InvoiceProcessModel::orderBy('id', 'desc')->get()->take(20);

        parent::$data["benficiary"] = BeneficiaryModel::CountAll();
        parent::$data["activeBenificiary"] = BeneficiaryModel::CountAll(0,1,0,0);
        parent::$data["notActiveBenificiary"] = BeneficiaryModel::CountAll()- parent::$data["activeBenificiary"];
        parent::$data["ChronBenificiary"] = BeneficiaryModel::CountAll(0,0,1,0);
        parent::$data["NonChronBenificiary"] = BeneficiaryModel::CountAll()- BeneficiaryModel::CountAll(0,0,1,0);
        parent::$data["cards"] = CardModel::countCard(0,$user_id);
        parent::$data["cardsIssued"] = CardModel::countCard(0,$user_id,'1');
        parent::$data["cardsNotIssued"] = CardModel::countCard(0,$user_id)-CardModel::countCard(0,$user_id,'1');
        parent::$data["cardsIDilverd"] = CardModel::countCard(0,$user_id,'0',1);
        parent::$data["cardsNotDilverd"] = CardModel::countCard(0,$user_id)-CardModel::countCard(0,$user_id,0,1);
        parent::$data["exceptions"] = ExceptionModel::countException(0,$user_id);
        parent::$data["exceptionsWaitng"] = ExceptionModel::countException(1,$user_id);
        parent::$data["exceptionsApproved"] = ExceptionModel::countException(25,$user_id);
        parent::$data["exceptionsNotApproved"] = ExceptionModel::countException(26,$user_id);
        parent::$data["d"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,0,0,0,0));
        parent::$data["dNorth"] = (InvoiceModel::getAnnualDischarged($year, $user_id,160,0,0,0,0));
        parent::$data["dSouth"] = (InvoiceModel::getAnnualDischarged($year, $user_id,161,0,0,0,0));
        parent::$data["dMiddle"] = (InvoiceModel::getAnnualDischarged($year, $user_id,162,0,0,0,0));
        parent::$data["dAge20"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,0,20,0,0));
        parent::$data["dAge35"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,21,25,0,0));
        parent::$data["dAge25"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,26,35,0,0));
        parent::$data["dAge50"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,36,50,0,0));
        parent::$data["dAge60"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,51,60,0,0));
        parent::$data["dAge60Plus"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,61,0,0,0));

        try {
            try {
                parent::$data["processingInvoicePercentage"] = number_format(InvoiceModel::CountInvoice(15, $user_id) * 100 / InvoiceModel::CountInvoice(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["processingInvoicePercentage"] = "NAN";
            }
            try {
                parent::$data["auditInvoicePercentage"] = number_format(InvoiceModel::CountInvoice(18, $user_id) * 100 / InvoiceModel::CountInvoice(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["auditInvoicePercentage"] = "NAN";
            }
            try {
                parent::$data["reviseInvoicePercentage"] = number_format(InvoiceModel::CountInvoice(19, $user_id) * 100 / InvoiceModel::CountInvoice(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["reviseInvoicePercentage"] = "NAN";
            }
            try {
                parent::$data["waitingAdmissionPercentage"] = number_format((AdmissionModel::CountAdmission(4, $user_id) - AdmissionModel::CountAdmission(5, $user_id)) * 100 / AdmissionModel::CountAdmission(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["waitingAdmissionPercentage"] = "NAN";
            }
            try {
                parent::$data["waitingAssignAdmissionPercentage"] = number_format(AdmissionModel::CountAdmission(7, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["waitingAssignAdmissionPercentage"] = "NAN";
            }
            try {
                parent::$data["dischargeAdmissionPercentage"] = number_format(AdmissionModel::CountAdmission(14, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));

            } catch (\Exception $ex) {
                parent::$data["dischargeAdmissionPercentage"] = "NAN";
            }
            try {

                parent::$data["visitedAdmissionPercentage"] = number_format(AdmissionModel::CountAdmission(5, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["visitedAdmissionPercentage"] = "NAN";
            }

            try {
                parent::$data["invoiceAdmissionPercentage"] = number_format(AdmissionModel::CountAdmission(10, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["invoiceAdmissionPercentage"] = "NAN";
            }

            try {
                parent::$data["hospitalAdmission"] = AdmissionModel::hospitalAdmission($user_id);

            } catch (\Exception $ex) {
                parent::$data["hospitalAdmission"] = "NAN";
            }
            try {
                parent::$data["FPAdmission"] = AdmissionModel::FPAdmission($user_id);
            } catch (\Exception $ex) {
                parent::$data["FPAdmission"] = "NAN";
            }

//           parent::$data["MOH"] = number_format(AdmissionModel::countAdmissionFP(3, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
//           parent::$data["MIC"] = number_format(AdmissionModel::countAdmissionFP(8, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
//           parent::$data["PIC"] = number_format(AdmissionModel::countAdmissionFP(9, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
//           //parent::$data["AIC"]= number_format(AdmissionModel::countAdmissionFP(7)*100/AdmissionModel::CountAdmission(),0);
//           parent::$data["GIC"] = number_format(AdmissionModel::countAdmissionFP(14, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
//           parent::$data["NAT"] = number_format(AdmissionModel::countAdmissionFP(16, $user_id) * 100 / AdmissionModel::CountAdmission(0, $user_id));
//           parent::$data["OtherFP"] = number_format(100 - (parent::$data["MIC"] + parent::$data["GIC"] + parent::$data["MOH"] + parent::$data["PIC"] + parent::$data["NAT"]));

            try {
                parent::$data["day3"] = number_format(AdmissionModel::countAdmissionDays(3, $user_id) * 100 / AdmissionModel::countAdmissionDays(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["day3"] = "NAN";
            }
            try {
                parent::$data["day7"] = number_format(AdmissionModel::countAdmissionDays(7, $user_id) * 100 / AdmissionModel::countAdmissionDays(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["day7"] = "NAN";
            }
            try {
                parent::$data["day14"] = number_format(AdmissionModel::countAdmissionDays(14, $user_id) * 100 / AdmissionModel::countAdmissionDays(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["day14"] = "NAN";

            }
            try {
                parent::$data["day30"] = number_format(AdmissionModel::countAdmissionDays(30, $user_id) * 100 / AdmissionModel::countAdmissionDays(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["day30"] = "NAN";

            }
            try {
                parent::$data["day60"] = number_format(AdmissionModel::countAdmissionDays(60, $user_id) * 100 / AdmissionModel::countAdmissionDays(0, $user_id));
            } catch (\Exception $ex) {
                parent::$data["day60"] = "NAN";
            }
            try {
                parent::$data["otherDay"] = number_format(100 - (parent::$data["day3"] + parent::$data["day7"] + parent::$data["day14"] + parent::$data["day30"] + parent::$data["day60"]));
            } catch (\Exception $ex) {

                parent::$data["otherDay"] = "NAN";

            }
            try {

                parent::$data["perDay"] = number_format(AdmissionModel::countAdmissionServiceType(30, $user_id) * 100 / AdmissionModel::countAdmissionServiceType(0, $user_id));
            } catch (\Exception $ex) {

                parent::$data["perDay"] = "NAN";

            }
            try {
                parent::$data["AccidentpatientInv"] = (float)(AccidentPatientInvoiceModel::getInvoicesByPatientAccedentType($year,$user_id,0,0));
            } catch (\Exception $ex) {
                parent::$data["AccidentpatientInv"] = "NAN";
            }
            try {
                parent::$data["drg"] = number_format(AdmissionModel::countAdmissionServiceType(32, $user_id) * 100 / AdmissionModel::countAdmissionServiceType(0, $user_id));
            } catch (\Exception $ex) {

                parent::$data["drg"] = "NAN";

            }
            try {
                parent::$data["rehabilitation"] = number_format(AdmissionModel::countAdmissionServiceType(31, $user_id) * 100 / AdmissionModel::countAdmissionServiceType(0, $user_id));
            }
            catch (\Exception $ex) {

                parent::$data["rehabilitation"] = "NAN";

            }
            try {
                parent::$data["otherServ"] = number_format(100 - (parent::$data["perDay"] + parent::$data["rehabilitation"] + parent::$data["drg"]));
            } catch (\Exception $ex) {

                parent::$data["otherServ"] = "NAN";

            }

            try {
                parent::$data["accident"] = (float)(count(AccidentModel::getAccidents(0,0,$year,$user_id)->get()));
            } catch (\Exception $ex) {
                parent::$data["accident"] = $ex->getMessage();
            }

            try {
                parent::$data["injured"] = (AccidentPatientModel::getPatientByAccidentYear($year,$user_id));
            } catch (\Exception $ex) {
                parent::$data["injured"] = $ex->getMessage();
            }

            try {
                parent::$data["AccidentInpatient"] = (float)(AccidentPatientInvoiceModel::getInvoicesByPatientAccedentType($year,$user_id,68));
            } catch (\Exception $ex) {
                parent::$data["AccidentInpatient"] = "NAN";
            }

            try {
                parent::$data["AccidentOutpatient"] = (float)(AccidentPatientInvoiceModel::getInvoicesByPatientAccedentType($year,$user_id,69));
            } catch (\Exception $ex) {
                parent::$data["AccidentOutpatient"] = "NAN";
            }

            try {
                parent::$data["accidentMiddle"] = (float)(count(AccidentModel::getAccidents(0,0,$year,$user_id,"162")->get()));
            } catch (\Exception $ex) {
                parent::$data["accidentMiddle"] = "NAN";
            }

            try {
                parent::$data["accidentSouth"] = (float)(count(AccidentModel::getAccidents(0,0,$year,$user_id,"161")->get()));
            } catch (\Exception $ex) {
                parent::$data["accidentSouth"] = $ex->getMessage();
            }
            try {
                parent::$data["accidentNorth"] = (float)(count(AccidentModel::getAccidents(0,0,$year,$user_id,"160")->get()));
            } catch (\Exception $ex) {
                parent::$data["accidentNorth"] = "NAN";
            }
            try {
                parent::$data["injuredMiddle"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"162"));
            } catch (\Exception $ex) {
                parent::$data["injuredMiddle"] = "NAN";
            }
            try {
                parent::$data["injuredSouth"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"161"));
            } catch (\Exception $ex) {
                parent::$data["injuredSouth"] = "NAN";
            }
            try {
                parent::$data["injuredNorth"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"160"));
            } catch (\Exception $ex) {
                parent::$data["injuredNroth"] = "NAN";
            }

            try {
                parent::$data["workAccident"] = (float)(count(AccidentModel::getAccidents(0,154,$year,$user_id)->get()));
            } catch (\Exception $ex) {
                parent::$data["workAccident"] = "NAN";
            }
            try {
                parent::$data["carAccident"] = (float)(count(AccidentModel::getAccidents(0,156,$year,$user_id)->get()));
            } catch (\Exception $ex) {
                parent::$data["carAccident"] = "NAN";
            }

            try {
                parent::$data["AccidentMale"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,"1"));
            } catch (\Exception $ex) {
                parent::$data["AccidentMale"] = "NAN";
            }
            try {
                parent::$data["AccidentFeMale"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,"2"));
            } catch (\Exception $ex) {
                parent::$data["AccidentFeMale"] = "NAN";
            }

            try {
                parent::$data["AccidentAge20"] = AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,20);
            } catch (\Exception $ex) {
                parent::$data["AccidentAge20"] = $ex->getMessage();
            }
            try {
                parent::$data["AccidentAge25"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,21,25));
            } catch (\Exception $ex) {
                parent::$data["AccidentAge25"] = "NAN";
            }
            try {
                parent::$data["AccidentAge35"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,26,35));
            } catch (\Exception $ex) {
                parent::$data["AccidentAge35"] = "NAN";
            }
            try {
                parent::$data["AccidentAge50"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,36,50));
            } catch (\Exception $ex) {
                parent::$data["AccidentAge50"] = "NAN";
            }
            try {
                parent::$data["AccidentAge60"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,51,60));
            } catch (\Exception $ex) {
                parent::$data["AccidentAge60"] = "NAN";
            }
            try {
                parent::$data["AccidentAge60Plus"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,61,180));
            } catch (\Exception $ex) {
                parent::$data["AccidentAge60Plus"] = "NAN";
            }


            try {
                parent::$data["AccidentPatientType1"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,155));
            } catch (\Exception $ex) {
                parent::$data["AccidentPatientType1"] = "NAN";
            }
            try {
                parent::$data["AccidentPatientType2"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,157));
            } catch (\Exception $ex) {
                parent::$data["AccidentPatientType2"] = "NAN";
            }
            try {
                parent::$data["AccidentPatientType3"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,158));
            } catch (\Exception $ex) {
                parent::$data["AccidentPatientType3"] = "NAN";
            }
            try {
                parent::$data["AccidentPatientType4"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,159));
            } catch (\Exception $ex) {
                parent::$data["AccidentPatientType4"] = "NAN";
            }















            parent::$data["title"] = "Dashboard";
            parent::$data["subtitle"] = "";
            parent::$data["breadcrumbs"] = ["" => ""];
            parent::$data["isDashboard"] = true;

            if ($request->ajax()) {
                return response(["status" => true, "data" => view('cp.dashboard', parent::$data)->render()], 200);
            }


            return view('cp.dashboard', parent::$data);
        } catch (\Exception $ex) {
            return view('cp.dashboardempty', parent::$data);
        }*/
        return view('cp.dashboard', parent::$data);
    }

    public function getIndexF(Request $request)
    {/*
        $year =  isset($request->year)?$request->year:date('Y');
        parent::$data['active_menuPlus'] = "Finance Statistics";
        parent::$data['active_menu'] = "Statistics";
        $user_id = isset($request->SysUsr_ID) ? $request->SysUsr_ID : \Auth::user("admin")->SysUsr_ID;
        $role = SystemUserModel::find($user_id)->role;
        parent::$data["role"] = $role;
        parent::$data["user_id"] = $user_id;
        parent::$data["User"] = SystemUserModel::find($user_id);
        parent::$data["Users"] = SystemUserModel::getUsers();

        parent::$data["year"] = $year;
        try {
            parent::$data["revenue"] = number_format(AdmissionModel::getAnnual($year, $user_id)->first()->admitted + InvoiceModel::getAnnualDischarged($year, $user_id,0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["revenue"] = "NaN";
        }


        try {
                   parent::$data["d"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,0,0,0,1));
            parent::$data["dNorth"] = (InvoiceModel::getAnnualDischarged($year, $user_id,160,0,0,0,1));
            parent::$data["dSouth"] = (InvoiceModel::getAnnualDischarged($year, $user_id,161,0,0,0,1));
            parent::$data["dMiddle"] = (InvoiceModel::getAnnualDischarged($year, $user_id,162,0,0,0,1));
            parent::$data["dAge20"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,0,20,0,1));
            parent::$data["dAge35"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,21,25,0,1));
            parent::$data["dAge25"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,26,35,0,1));
            parent::$data["dAge50"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,36,50,0,1));
            parent::$data["dAge60"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,51,60,0,1));
            parent::$data["dAge60Plus"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,61,0,0,1));



        } catch (\Exception $ex) {
            parent::$data["discharged"] = "NaN";
        }
        try {
            parent::$data["Inpatient"] = number_format(InvoiceModel::countAdmissionInPatient($user_id, $year)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["Inpatient"] = "NaN";
        }

        try {
            parent::$data["Outpatient"] = number_format(InvoiceModel::countAdmissionOutPatient($user_id, $year)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["Outpatient"] = "NaN";
        }
        try {
            parent::$data["commission"] = number_format(InvoiceModel::getAnnual($year, $user_id)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["commission"] = "NaN";
        }


        try {
            parent::$data["Gaza"] = number_format(InvoiceModel::countAdmissionProv($user_id, 116, $year)->first()->cost);
            parent::$data["Gaza2"] = number_format(InvoiceModel::countAdmissionProv($user_id, 116, $year)->first()->count);
        } catch (\Exception $ex) {
            parent::$data["Gaza"] =  "NaN";
            parent::$data["Gaza2"] = "NaN";
        }
        try {
            parent::$data["Westbank"] = number_format(InvoiceModel::countAdmissionProv($user_id, 117, $year)->first()->cost);
            parent::$data["Westbank2"] = number_format(InvoiceModel::countAdmissionProv($user_id, 117, $year)->first()->count);
        } catch (\Exception $ex) {
            parent::$data["Westbank"] =  "NaN";
            parent::$data["Westbank2"] =  "NaN";
        }


        try {
            parent::$data["paid_commission"] = number_format(InvoiceModel::getAnnualCommision($year)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["paid_commission"] = "NaN";
        }
        try {
            parent::$data["paid_commission2"] = number_format(InvoiceModel::getAnnualCommisionReferral($year)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["paid_commission2"] = "NaN";
        }
        try {
            parent::$data["paid_commission3"] = number_format(InvoiceModel::getAnnualCommisionReferral2($year)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["paid_commission3"] = "NaN";
        }
        try {
            parent::$data["paidFP"] = number_format(InvoiceModel::getAnnualPaidFP($year, 1, $user_id)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["paidFP"] = "NaN";
        }

        try {
            parent::$data["notPaidFP"] = number_format(InvoiceModel::getAnnualPaidFP($year, 0, $user_id)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["notPaidFP"] = "NaN";
        }


        try {
            parent::$data["accident"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,0,1)));
        } catch (\Exception $ex) {
            parent::$data["accident"] = $ex->getMessage();
        }

        try {
            parent::$data["injured"] = (AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injured"] = $ex->getMessage();
        }

        try {
            parent::$data["AccidentInpatient"] = (float)(AccidentPatientInvoiceModel::getInvoicesByPatientAccedentType($year,$user_id,68,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentInpatient"] = "NAN";
        }

        try {
            parent::$data["AccidentOutpatient"] = (float)(AccidentPatientInvoiceModel::getInvoicesByPatientAccedentType($year,$user_id,69,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentOutpatient"] = "NAN";
        }



        try {
            parent::$data["accidentMiddle"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,"162",1)));
        } catch (\Exception $ex) {
            parent::$data["accidentMiddle"] = "NAN";
        }

        try {
            parent::$data["accidentSouth"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,"161",1)));
        } catch (\Exception $ex) {
            parent::$data["accidentSouth"] = $ex->getMessage();
        }
        try {
            parent::$data["accidentNorth"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,"160",1)));
        } catch (\Exception $ex) {
            parent::$data["accidentNorth"] = "NAN";
        }
        try {
            parent::$data["injuredMiddle"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"162",0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injuredMiddle"] = "NAN";
        }
        try {
            parent::$data["injuredSouth"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"161",0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injuredSouth"] = "NAN";
        }
        try {
            parent::$data["injuredNorth"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"160",0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injuredNorth"] = "NAN";
        }

        try {
            parent::$data["workAccident"] = (float)((AccidentModel::getAccidents(0,154,$year,$user_id,0,1)));
        } catch (\Exception $ex) {
            parent::$data["workAccident"] = "NAN";
        }
        try {
            parent::$data["carAccident"] = (float)((AccidentModel::getAccidents(0,156,$year,$user_id,0,1)));
        } catch (\Exception $ex) {
            parent::$data["carAccident"] = "NAN";
        }

        try {
            parent::$data["AccidentMale"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,"1",0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentMale"] = "NAN";
        }
        try {
            parent::$data["AccidentFeMale"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,"2",0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentFeMale"] = "NAN";
        }

        try {
            parent::$data["AccidentAge20"] = AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,20,0,1);
        } catch (\Exception $ex) {
            parent::$data["AccidentAge20"] = $ex->getMessage();
        }
        try {
            parent::$data["AccidentAge25"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,21,25,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge25"] = "NAN";
        }
        try {
            parent::$data["AccidentAge35"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,26,35,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge35"] = "NAN";
        }
        try {
            parent::$data["AccidentAge50"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,36,50,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge50"] = "NAN";
        }
        try {
            parent::$data["AccidentAge60"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,51,60,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge60"] = "NAN";
        }
        try {
            parent::$data["AccidentAge60Plus"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,61,180,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge60Plus"] = "NAN";
        }


        try {
            parent::$data["AccidentPatientType1"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,155,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType1"] = "NAN";
        }
        try {
            parent::$data["AccidentPatientType2"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,157,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType2"] = "NAN";
        }
        try {
            parent::$data["AccidentPatientType3"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,158,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType3"] = "NAN";
        }
        try {
            parent::$data["AccidentPatientType4"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,159,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType4"] = "NAN";
        }




        parent::$data["InvoiceProcess"] = InvoiceProcessModel::orderBy('id', 'desc')->get()->take(20);


        parent::$data["title"] = "Finance Dashboard";
        parent::$data["subtitle"] = "";
        parent::$data["breadcrumbs"] = ["Dashboard" => " Finance"];


        return view('cp.fdashboard', parent::$data);*/
    }

    public function chron(Request $request)
    {
        parent::$data['active_menuPlus'] = "Chronic Statistics";
        parent::$data['active_menu'] = "Statistics";
        return view('cp.chronboard', parent::$data);
    }

    public function getStat(Request $request)
    {/*
        parent::$data['active_menu'] = "Finance";

        $user_id = isset($request->user_id) ? $request->user_id : \Auth::user("admin")->SysUsr_ID;
        $role = SystemUserModel::find($user_id)->role;
        parent::$data["role"] = $role;
        parent::$data["user_id"] = $user_id;



        $year = $request->year2;
        parent::$data["year"] = $year;
        try {
            parent::$data["d"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,0,0,0,1));
            parent::$data["dNorth"] = (InvoiceModel::getAnnualDischarged($year, $user_id,160,0,0,0,1));
            parent::$data["dSouth"] = (InvoiceModel::getAnnualDischarged($year, $user_id,161,0,0,0,1));
            parent::$data["dMiddle"] = (InvoiceModel::getAnnualDischarged($year, $user_id,162,0,0,0,1));
            parent::$data["dAge20"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,0,20,0,1));
            parent::$data["dAge35"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,21,25,0,1));
            parent::$data["dAge25"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,26,35,0,1));
            parent::$data["dAge50"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,36,50,0,1));
            parent::$data["dAge60"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,51,60,0,1));
            parent::$data["dAge60Plus"] = (InvoiceModel::getAnnualDischarged($year, $user_id,0,61,0,0,1));



        } catch (\Exception $ex) {
            parent::$data["discharged"] = "NaN";
        }
        try {
            parent::$data["revenue2"] = number_format(AdmissionModel::getAnnual($year, $user_id)->first()->admitted + InvoiceModel::getAnnualDischarged($year, $user_id,0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["revenue2"] = "NaN";
        }
        try {
            parent::$data["discharged2"] = number_format(InvoiceModel::getAnnualDischarged($year, $user_id,0,0,0,0,1
            ));
        } catch (\Exception $ex) {
            parent::$data["discharged2"] = "NaN";
        }
        try {
            parent::$data["commission2"] = number_format(InvoiceModel::getAnnual($year)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["commission2"] = "NaN";
        }
        try {
            parent::$data["paid_commission2"] = number_format(InvoiceModel::getAnnualCommision($year)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["paid_commission2"] = "NaN";
        }
        try {
            parent::$data["paid_commission3"] = number_format(InvoiceModel::getAnnualCommisionReferral($year)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["paid_commission3"] = "NaN";
        }
        try {
            parent::$data["paid_commission4"] = number_format(InvoiceModel::getAnnualCommisionReferral2($year)->first()->commission);
        } catch (\Exception $ex) {
            parent::$data["paid_commission4"] = "NaN";
        }
        try {
            parent::$data["paidFP"] = number_format(InvoiceModel::getAnnualPaidFP($year, 1, $user_id)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["paidFP"] = "NaN";
        }

        try {
            parent::$data["notPaidFP"] = number_format(InvoiceModel::getAnnualPaidFP($year, 0, $user_id)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["notPaidFP"] = "NaN";
        }


        try {
            parent::$data["Inpatient"] = number_format(InvoiceModel::countAdmissionInPatient($user_id, $year)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["Inpatient"] = "NaN";
        }

        try {
            parent::$data["Inpatient"] = number_format(InvoiceModel::countAdmissionInPatient($user_id, $year)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["Inpatient"] = "NaN";
        }

        try {
            parent::$data["Outpatient"] = number_format(InvoiceModel::countAdmissionOutPatient($user_id, $year)->first()->cost);
        } catch (\Exception $ex) {
            parent::$data["Outpatient"] = "NaN";
        }


        try {
            parent::$data["Gaza"] = number_format(InvoiceModel::countAdmissionProv($user_id, 161, $year)->first()->cost);
            parent::$data["Gaza2"] = number_format(InvoiceModel::countAdmissionProv($user_id, 161, $year)->first()->count);
        } catch (\Exception $ex) {
            parent::$data["Gaza"] = "NaN";
            parent::$data["Gaza2"] = "NaN";
        }
        try {
            parent::$data["Westbank"] = number_format(InvoiceModel::countAdmissionProv($user_id, 160, $year)->first()->cost);
            parent::$data["Westbank2"] = number_format(InvoiceModel::countAdmissionProv($user_id, 160, $year)->first()->count);
        } catch (\Exception $ex) {
            parent::$data["Westbank"] = "NaN";
            parent::$data["Westbank2"] = "NaN";
        }
        try {
            parent::$data["accident"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,0,1)));
        } catch (\Exception $ex) {
            parent::$data["accident"] = $ex->getMessage();
        }

        try {
            parent::$data["injured"] = (AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injured"] = $ex->getMessage();
        }
        try {
            parent::$data["AccidentInpatient"] = (float)(AccidentPatientInvoiceModel::getInvoicesByPatientAccedentType($year,$user_id,68,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentInpatient"] = "NAN";
        }

        try {
            parent::$data["AccidentOutpatient"] = (float)(AccidentPatientInvoiceModel::getInvoicesByPatientAccedentType($year,$user_id,69,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentOutpatient"] = "NAN";
        }

        try {
            parent::$data["accidentMiddle"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,"162",1)));
        } catch (\Exception $ex) {
            parent::$data["accidentMiddle"] = "NAN";
        }

        try {
            parent::$data["accidentSouth"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,"161",1)));
        } catch (\Exception $ex) {
            parent::$data["accidentSouth"] = $ex->getMessage();
        }
        try {
            parent::$data["accidentNorth"] = (float)((AccidentModel::getAccidents(0,0,$year,$user_id,"160",1)));
        } catch (\Exception $ex) {
            parent::$data["accidentNorth"] = "NAN";
        }
        try {
            parent::$data["injuredMiddle"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"162",0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injuredMiddle"] = "NAN";
        }
        try {
            parent::$data["injuredSouth"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"161",0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injuredSouth"] = "NAN";
        }
        try {
            parent::$data["injuredNorth"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,"160",0,0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["injuredNorth"] = "NAN";
        }

        try {
            parent::$data["workAccident"] = (float)((AccidentModel::getAccidents(0,154,$year,$user_id,0,1)));
        } catch (\Exception $ex) {
            parent::$data["workAccident"] = "NAN";
        }
        try {
            parent::$data["carAccident"] = (float)((AccidentModel::getAccidents(0,156,$year,$user_id,0,1)));
        } catch (\Exception $ex) {
            parent::$data["carAccident"] = "NAN";
        }

        try {
            parent::$data["AccidentMale"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,"1",0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentMale"] = "NAN";
        }
        try {
            parent::$data["AccidentFeMale"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,"2",0,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentFeMale"] = "NAN";
        }

        try {
            parent::$data["AccidentAge20"] = AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,20,0,1);
        } catch (\Exception $ex) {
            parent::$data["AccidentAge20"] = $ex->getMessage();
        }
        try {
            parent::$data["AccidentAge25"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,21,25,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge25"] = "NAN";
        }
        try {
            parent::$data["AccidentAge35"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,26,35,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge35"] = "NAN";
        }
        try {
            parent::$data["AccidentAge50"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,36,50,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge50"] = "NAN";
        }
        try {
            parent::$data["AccidentAge60"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,51,60,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge60"] = "NAN";
        }
        try {
            parent::$data["AccidentAge60Plus"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,60,0,0,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentAge60Plus"] = "NAN";
        }


        try {
            parent::$data["AccidentPatientType1"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,155,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType1"] = "NAN";
        }
        try {
            parent::$data["AccidentPatientType2"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,157,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType2"] = "NAN";
        }
        try {
            parent::$data["AccidentPatientType3"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,158,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType3"] = "NAN";
        }
        try {
            parent::$data["AccidentPatientType4"] = (float)(AccidentPatientModel::getPatientByAccidentYear($year,$user_id,0,0,0,0,159,1));
        } catch (\Exception $ex) {
            parent::$data["AccidentPatientType4"] = "NAN";
        }






        return view('cp.dashboardstat', parent::$data);*/
    }
}
