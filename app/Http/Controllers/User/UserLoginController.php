<?php namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerificationRequest;
use App\Models\Contact;
use App\Models\LoggingMastersModel;
use App\Models\PatientModel;
use App\Models\SystemLookupModel;
use App\Models\SystemUserModel;
use Config;
use Illuminate\Http\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class UserLoginController extends Controller
{

    public function __construct()
    {

        parent::__construct();


    }

    public function index()
    {
        $contact = Contact::where("active", "1")->get();
        if (!auth('')->user()) {
            if (\Session::has("error"))
                parent::$data["error"] = \Session::get("error");
            parent::$data["msg2"] = \Session::get("msg2");
            //var_dump(\Session::get("error")); exit;
            return view('user.login', parent::$data);


        } else {
            $user = auth('')->user();
            if ($user->role == 1)
                return redirect(parent::$data['cp_route_name'] . '/index');
            if ($user->role == 2)
                return redirect(parent::$data['user_route_name'] . '/index');
            else
                return redirect(parent::$data['user_route_name'] . "/logout");
        }
    }

    public function forget_password()
    {
        return view("user.forget_password", parent::$data);

    }

    public function resetPassword(Request $request)
    {
        if (!auth('')->user()) {
            $email = $request->input("email");
            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $user = SystemUserModel::where('SysUsr_Email', $email)->get()->first();
            if ($user) {
                $hashed_random_password = (substr(str_shuffle($data), 0, 7));
                $user->Pass_Reset = ($hashed_random_password);
                $user->save();
                $msg = $hashed_random_password;
                //try {

                //  try {


                $Data = [
                    "user" => $user


                ];
                Mail::send('website.emailReset', $Data, function ($message) use ($user) {
                    $message->from('website@tabibfind.ps');
                    $message->to($user->SysUsr_Email);
                    $message->bcc('it@medibooking.org', 'IT');

                    $message->subject('Tabibfind Reset Password');
                });

                //smsapi()->gateway('hotsms')->sendMessage("00970592413400", " you have Treatment Request from website form " . $request_treatment->name . "");

                //  } catch (\Exception $ex) {
                //     $message = "Done";
                //     $status = "success;; Error in mail";
                // }
                $message = "Password Reset Successfully";
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
                return redirect(parent::$data['user_route_name'] . "/login")->with("msg2", "الرجاء مراجعة بريدك لتغير كلمة المرور");
            } else {
                return redirect(parent::$data['user_route_name'] . "/login")->with("error", "تأكد من المعلومات المدخلة ");
            }
        }
        return redirect("index");


    }


    public function check(Request $request)
    {
        //var_dump($request); exit;
        if (!auth('')->user()) {
            $username = SystemUserModel::find($request->input("user"))->SysUsr_UserName;
            $password = $request->input("key");
            $status = SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE");
            $attempt = ['SysUsr_UserName' => $username, 'password' => $password, 'SysUsr_Status' => $status];

            if (!filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
                $attempt2 = ['SysUsr_Email' => $username, 'password' => $password, 'SysUsr_Status' => $status];
            }
            if (auth('')->attempt($attempt) || (isset($attempt2) && auth('')->attempt($attempt2))) {

                $SysUsr_ID = auth('')->user()->SysUsr_ID;
                $SysUsr_LastLoginDate = date('Y-m-d H:i:s');
                $SysUsr_LastIPAddress = $_SERVER["REMOTE_ADDR"];

                SystemUserModel::updateLoginInfo($SysUsr_ID, $SysUsr_LastLoginDate, $SysUsr_LastIPAddress);

                \Cookie::queue(\Cookie::forget('relogin'));
                $log = new LoggingMastersModel; // log


                $log->newMasterLog($SysUsr_ID, $SysUsr_ID, $request->ip(), "Login", "System_User", auth('')->user()->SysUsr_Email, "SysUsr_ID", $request->input("key"), "1"); // log
                $user = auth('')->user();

                $des= (\Cookie::get('category'))?"/job-application?category=".\Cookie::get('category'):'/index';
                return redirect($des);

            } else {
                $log = new LoggingMastersModel; //
                $log->newMasterLog($username, "0", $request->ip(), "Login", "System_User", "", "SysUsr_ID", $password, "0"); // log
                if (\Cookie::get('relogin'))
                    return redirect(parent::$data['user_route_name'] . "/relogin")->with("error", "تأكد من كلمة المرور");
                return redirect(parent::$data['user_route_name'] . "/login")->with("error", "تأكد من اسم المستخدم وكلمة المرور");
            }
        } else {
            $des= (\Cookie::get('category'))?"/job-application?category=".\Cookie::get('category'):'/index';
            return redirect($des);
        }
    }

    public function logout()
    {
        $log = new LoggingMastersModel; // log

        $log->newMasterLog(auth('')->user()->SysUsr_ID, auth('')->user()->SysUsr_ID, \Request::ip(), "Logout", "System_User", auth('')->user()->SysUsr_Email, "SysUsr_ID", "", "0"); // log
        auth('')->logout();
        return redirect('index');
    }

    public function lock()
    {
        $user = auth('')->user();
        \Cookie::queue("relogin", $user->SysUsr_ID, 99999);
        $log = new LoggingMastersModel; // log
        $log->newMasterLog($user->SysUsr_ID, $user->SysUsr_ID, \Request::ip(), "Lock", "System_User", $user->SysUsr_FullName, "SysUsr_ID", "", "0"); // log
        auth('')->user()->logout('admin');
        return redirect('index');
    }

    public function relogin()
    {
        if (!auth('')->user()->check('admin') && \Cookie::get('relogin')) {
            if (\Session::has("error"))
                parent::$data["error"] = \Session::get("error");

            parent::$data["user"] = SystemUserModel::find(\Cookie::get('relogin'));
            if (!parent::$data["user"])
                return redirect(parent::$data['user_route_name'] . "/login");
            return view("user.lock", parent::$data);
        } else {
            return redirect(parent::$data['user_route_name']);
        }
    }

    protected function sendCode(Request $request)
    {

        $data = '1234567890';
        $hashed_random_password = (substr(str_shuffle($data), 0, 6));
        $data = $request->all();
        $type = $request->type;
        try {
            $user = SystemUserModel::find($request->input('user_id2'));

            $user->update([
                'verification_key' => $hashed_random_password,
            ]);


            smsapi()->gateway('hotsms')->sendMessage($user->SysUsr_Mobile, " عمال: كود التفعيل هو " . $user->verification_key . "");

            //  } catch (\Exception $ex) {
            //     $message = "Done";
            //     $status = "success;; Error in mail";
            // }


            $message = "تم إرسال كود التفعيل";
            if ($user)
                return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => true, 'modal' => true, 'user' => $user->SysUsr_ID));
            else {
                $message = "هناك خطأ في البينات المدخلة";
                return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => true, 'modal' => true, 'modal' => 'modal'));
            }

        } catch (\Exception $ex) {
            $message = "هناك خطأ في البينات المدخلة";
            return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => true, 'modal' => true));
        }


    }

    protected function create(RegisterRequest $request)
    {

        $data = '1234567890';
        $hashed_random_password = (substr(str_shuffle($data), 0, 6));
        $data = $request->all();
        $type = $request->type;
        try {
            $user = SystemUserModel::where('SysUsr_UserName', $data['SysUsr_Mobile'])->get()->first();
            if ($user) {
                if ($user->is_verified == 1) {
                    $message = "المستخدم مسجل مسبقا استخدم كود التفعيل  المرسل غلى هاتفك للدخول إلى الحساب";
                    smsapi()->gateway('hotsms')->sendMessage($user->SysUsr_Mobile, " أهلا بك من جديد كود التفعيل " . $user->verification_key . "");
                    return \Response::json(array('status' => '1', 'msg' => "w:" . $message, 'close' => false, 'modal' => true, 'user' => $user->SysUsr_ID));
                }
            } else {


                $user = SystemUserModel::create([
                    'SysUsr_Mobile' => $data['SysUsr_Mobile'],
                    'SysUsr_UserName' => $data['SysUsr_Mobile'],
                    'SysUsr_CreatedBy' => 1,
                    'SysUsr_Password' => app('hash')->make($request->input('SysUsr_Mobile')),
                    'is_verified' => '0',
                    'verification_key' => $hashed_random_password,
                ]);
            }


            smsapi()->gateway('hotsms')->sendMessage($user->SysUsr_Mobile, " شكرا لكم للانضمام إلى عمال كود التفعيل هو " . $user->verification_key . "");

            //  } catch (\Exception $ex) {
            //     $message = "Done";
            //     $status = "success;; Error in mail";
            // }


            $message = "تم عمل الحساب الرجاء مراجعة الجوال";
            if ($user)
                return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'close' => false, 'modal' => true, 'user' => $user->SysUsr_ID));
            else {
                $message = "هناك خطأ في البينات المدخلة";
                return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => true, 'modal' => true, 'modal' => 'modal'));
            }

        } catch (\Exception $ex) {
            $message = "هناك خطأ في البينات المدخلة";
            return \Response::json(array('status' => '0', 'msg' => "e:" . $message, 'close' => true, 'modal' => true));
        }


    }

    protected function verify(VerificationRequest $request)
    {

        $verification_key = $request->input('verification_key');
        $user_id = $request->input('user_id');


        $user = SystemUserModel::where('verification_key', $verification_key)->where('SysUsr_ID', $user_id)->get()->first();
        if ($user) {
            $user->SysUsr_Status = 5;
            $user->is_verified = 1;
            $user->SysUsr_Password = bcrypt($verification_key);
            $user->save();
            $message = "لقد تم إنشاء الحساب أهلا بك";
            return \Response::json(array('status' => '1', 'msg' => "s:" . $message, 'redirect' => parent::$data['user_route_name'] . '/autologin?user=' . $user_id . "&key=" . $verification_key));

        } else {
            $message = "الرجاء إعادة المحاولة";
            return \Response::json(array('status' => '1', 'msg' => "e:" . $message, 'close' => false));
        }


    }

    protected function verifyPass(Request $request)
    {
        $pass_reset = $request->input('pass_reset');
        $email = $request->input('email');
        $user = SystemUserModel::where('Pass_Reset', $pass_reset)->where('SysUsr_Email', $email)->where('is_verified', 1)->where('SysUsr_Status', 5)->get()->first();
        if ($user) {

            return view("user.reset_password", parent::$data)->with('pass_reset', $pass_reset)->with('email', $email)->with("msg2", "Write New password");
        } else {
            return redirect(parent::$data['user_route_name'] . "/login")->with("error", "No account found");
        }
    }

    protected function newPass(PasswordRequest $request)
    {
        $validator = Validator::make(request()->all(), [
            'new_pass' => ['required', 'string', 'max:6'],
        ]);
        if ($validator->fails()) {
            return Error::JsonError(422, 422, 'Failed', 'البيانات غير صالحة', $validator->messages()->first());

        }
        $new_pass = $request->input('password');

        $user = auth()->user("user");
        if ($user) {
            $user->SysUsr_Password = bcrypt($new_pass);
            $user->save();

            if ($user) {
                $user->SysUsr_Password = bcrypt($new_pass);
                $user->save();
                return redirect(parent::$data['user_route_name'] . "/login")->with("msg2", "Write New password");
            } else {
                return redirect(parent::$data['user_route_name'] . "/login")->with("error", "No account found");
            }
        }


    }
}
