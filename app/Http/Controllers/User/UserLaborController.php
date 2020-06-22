<?php namespace App\Http\Controllers\User;

use App;
use Config;
use Illuminate\Http\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


//use App\Models\RoleModel;

class UserLaborController extends SuperUserController
{
    public function __construct()
    {
        try {

            parent::__construct();
            parent::$data['user'] = auth()->user();

        } catch (\Exception $e) {
            redirect('/index');
        }

    }

    public function uploadFile(Request $request)
    {
        try {
            $path = public_path('uploads'); // upload directory
            $file = \Input::file('choose-file');
            $ext = $file->guessClientExtension();
            $message = '';
            $filename = time() . str_random(25) . '.' . $ext;
            $uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR, $filename);
            $att = new App\Models\AttModel();
            $att->att_id = $request->input('att_id');
            $att->user_id =  auth()->user()->SysUsr_ID;
            $att->type = $request->input('type');
            $att->module = $request->input('module');
            $att->name = 'api.3ommal.me/uploads/'. $filename;
            $att->information = $request->input('information');
            $att->title = $filename;

            $att->save();
            $message = "Done";
            $status = "success";


            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } catch (\Exception $e) {
            return response(array('status' => 2, 'message' => $message, 'filename' => $filename));
        }
    }

    public function getlang()
    {
        if (\Session::has('lang')) {

            if (\Session::get('lang') == 'en')
                $lang = 1;
            else if (\Session::get('lang') == 'ar')
                $lang = 2;
            else
                $lang = 3;
        } else
            $lang = 1;
        return $lang;
    }

    public function index()
    {
        $lang = $this->getlang();

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        if (parent::$data["role"] == 1)
            return redirect(parent::$data['cp_route_name'] . "/index");
        else if (parent::$data["role"] == 2)
            return view("user.dashboard", parent::$data);

        else
            return redirect("/index");


    }


    public function profile(Request $request)
    {
        $user = parent::$data['user'];
        if ($user) {
            parent::$data["city"] = App\Models\CountryModel::where('country_active', 1)->get();
            parent::$data["sid_attach"] = App\Models\AttModel::where('att_id', $user->SysUsr_ID)->where('module', 'sid_attach')->get()->first();
            parent::$data["card_attach"] = App\Models\AttModel::where('att_id', $user->SysUsr_ID)->where('module', 'card_attach')->get()->first();
            return view("website.user-profile", parent::$data);
        } else
            $message = "الرجاء تسجيل الدخول";
        return redirect("/register")->with("msg2", $message);
    }

    public function refund()
    {
        $user = parent::$data['user'];
        if ($user) {
            return view('website.refund', parent::$data);
        } else
            $message = "الرجاء تسجيل الدخول";
        return redirect("/register")->with("msg2", $message);
    }

    public function createRefund(App\Http\Requests\RefundRequest $request)
    {
        $user = parent::$data['user'];

        if (strlen($user->SysUsr_FullName) < 2) {
            return \Response::json(array('status' => '1', 'msg' => "w:" . "الرجاء تعبئة البينات الشخصية", 'close' => false, 'redirect' => "/" . parent::$data['user_route_name'] . "/profile"));
        }
        if (Date("Y-m-d", strtotime($request->end_work_date)) < Date("Y-m-d", strtotime($request->start_work_date))) {
            $message = "الرجاء إدخال تواريخ صحيحة";
            return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
        }

        $labaorslalryrequest = App\Models\LaborSalaryModel::create(request()->except('token'));


        $labaorslalryrequest->updated_at = date('Y-m-d');
        $labaorslalryrequest->user_id = $user->SysUsr_ID;

        $labaorslalryrequest->save();
        App\Models\RequestModel::create(["userid" => $user->SysUsr_ID, "request_id" => $labaorslalryrequest->id, "module" => "refund", "subject" => "طلب أسترجاع مستحقات نهاية الخدمة"]);
        $message = 'شكرا لك سنرد في اقرب وقت';

        if ($labaorslalryrequest)
            return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => false, 'redirect' => "/index"));
        else {
            $message = "الرجاء مراجعة المدخلات";
            return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
        }


    }

    public function jobApplication(Request $request)
    {
        $user = parent::$data['user'];
        if ($user) {

            if (!$user->SysUsr_FullName) {
                return \Response::json(array('status' => '1', 'msg' => "w:" . "الرجاء تعبئة البينات الشخصية", 'close' => false, 'redirect' => "/" . parent::$data['user_route_name'] . "/profile"));
            }
            if (Date("Y-m-d", strtotime($request->end_work_date)) < Date("Y-m-d", strtotime($request->start_work_date))) {
                $message = "الرجاء إدخال تواريخ صحيحة";
                return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
            }

            $jobApplication = App\Models\JobApplicationModel::create(request()->except('token'));


            $jobApplication->updated_at = date('Y-m-d');
            $jobApplication->user_id = $user->SysUsr_ID;

            $jobApplication->save();


            App\Models\RequestModel::create(["userid" => $user->SysUsr_ID, "request_id" => $jobApplication->id, "module" => "jobApplication", "subject" => "طلب عمل " .$jobApplication->work_fields." ". $jobApplication->work_special]);
            $message = 'شكرا لك سنرد في اقرب وقت';
            $Data = ["user" => $user, "jobApplication" => $jobApplication];
            Mail::send('website.send_JobEmail', $Data, function ($message) use ($user, $jobApplication) {
                $message->from('noreply@3ommal.me');
                $message->to('i.kteish@3ommal.me');
                //$message->cc($user->SysUsr_Email);
                $message->bcc('it@medibooking.org', 'IT');
                $message->subject('طلب عمل ' . $user->SysUsr_FullName);
            });

            if ($jobApplication)
                return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => false, 'redirect' => "/index"));
            else {
                $message = "الرجاء مراجعة المدخلات";
                return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
            }
        } else
            $message = "الرجاء تسجيل الدخول";
        return redirect("/register")->with("msg2", $message);


    }


    public function injury()
    {
        $user = parent::$data['user'];
        if ($user) {
            return view('website.injury', parent::$data);
        } else
            $message = "الرجاء تسجيل الدخول";
        return redirect("/register")->with("msg2", $message);
    }

    public function requests()
    {
        $user = parent::$data['user'];

        if ($user) {
            parent::$data["requests"] = App\Models\RequestModel::where('userid', $user->SysUsr_ID)->where('active', 1)->get();
            return view('website.requests', parent::$data);
        } else
            $message = "الرجاء تسجيل الدخول";
        return redirect("/register")->with("msg2", $message);
    }


    public function createInjury(App\Http\Requests\InjuryRequest $request)
    {
        $user = parent::$data['user'];

        if (strlen($user->SysUsr_FullName) < 2) {
            return \Response::json(array('status' => '1', 'msg' => "w:" . "الرجاء تعبئة البينات الشخصية", 'close' => false, 'redirect' => "/" . parent::$data['user_route_name'] . "/profile"));
        }
        if (Date("Y-m-d", strtotime($request->end_work_date)) < Date("Y-m-d", strtotime($request->start_work_date))) {
            $message = "الرجاء إدخال تواريخ صحيحة";
            return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
        }

        $labaorslalryrequest = App\Models\LaborInjuryModel::create(request()->except('token'));


        $labaorslalryrequest->updated_at = date('Y-m-d');
        $labaorslalryrequest->user_id = $user->SysUsr_ID;

        $labaorslalryrequest->save();
        App\Models\RequestModel::create(["userid" => $user->SysUsr_ID, "request_id" => $labaorslalryrequest->id, "module" => "injury", "subject" => "طلب إخبار إصابة عمل"]);
        $message = 'شكرا لك سنرد في اقرب وقت';

        if ($labaorslalryrequest)
            return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => false, 'redirect' => "/index"));
        else {
            $message = "الرجاء مراجعة المدخلات";
            return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
        }


    }


    public function sendEmail(Request $request)
    {
        $message = '';
        $candidate = App\Models\SystemUserCustomerModel::find($request->input('candidate_id'));

        $message = $request->input('message');
        if ($candidate) {
            $user = auth()->user("user");
            $application = App\Models\JobApplicationModel::find($request->input('application_id'));
            //try {

            //  try {


            $Data = ["user" => $user, "message" => $message, "candidate" => $candidate, "application" => $application];
            Mail::send('website.sendEmail', $Data, function ($message) use ($user, $candidate, $application) {
                $message->from('info@tabibfind.ps');
                $message->to($candidate->SysUsr_Email);
                $message->cc($user->SysUsr_Email);
                $message->bcc('it@medibooking.org', 'IT');

                $message->subject('Tabibfind Notification  ' . $user->doctor_name);
            });

//smsapi()->gateway('hotsms')->sendMessage("00970592413400", " you have Treatment Request from website form " . $request_treatment->name . "");

//  } catch (\Exception $ex) {
//     $message = "Done";
//     $status = "success;; Error in mail";
// }
            $message = "Message Sent Succssfully";
            if ($user)
                \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => false));
            else {
                $message = "Error";
                return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
            }

//  } catch (\Exception $ex) {
//     $message="Error";
//  return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
//  }
            return redirect(parent::$data['user_route_name'] . "/login")->with("msg2", $message);
        } else {
            return redirect(parent::$data['user_route_name'] . "/login")->with("error", $message);
        }
    }

    public function updateProfile(App\Http\Requests\ProfileRequest $request)
    {
        $user = auth()->user("user");
        $des = (\Cookie::get('category'))?"/job-application?category=".\Cookie::get('category'):'/index';

        $data = $request->all();


        $user->update(request()->except('token'));


        $message = "تم حفظ البينات بنجاح";
        if ($user)
            return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => false, 'redirect' =>$des));
        else {
            $message = "Error";
            return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => false));
        }

    }

}
