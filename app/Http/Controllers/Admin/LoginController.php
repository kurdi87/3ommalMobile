<?php namespace App\Http\Controllers\Admin;


      use Illuminate\Http\Request;

      use Auth;
      use Hash;

      use App\Models\SystemUserModel;
      use App\Models\SystemLookupModel;

      use App\Http\Requests;
      use App\Http\Controllers\Controller;
      use App\Models\LoggingMastersModel;
      use Illuminate\Foundation\Auth\ThrottlesLogins;
      use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

      class LoginController extends Controller
      {
       /*
         public function __construct()
          {
              parent::__construct();
              parent::$data['active_menu'] = 'login';
              var_dump(parent::$data); exit;
          }
*/
          public function index()
          {
            // echo Hash::make('123');
            /*
            $password = '123';
            $hashedPassword = Hash::make($password);
            echo $hashedPassword; // $2y$10$jSAr/RwmjhwioDlJErOk9OQEO7huLz9O6Iuf/udyGbHPiTNuB3Iuy
            //echo '<br>Hello';
            exit;
               */  
         if (!Auth::check()) {
                  if (\Session::has("error"))
                      parent::$data["error"] = \Session::get("error");
                  //var_dump(\Session::get("error")); exit;
                  return view("cp.login", parent::$data);
              } else {
                  return redirect(parent::$data['cp_route_name']);
              }
          }

          public function check(Request $request)
          {
              //var_dump($request); exit;
              if (!Auth::check()){
                  $username = $request->input("SysUsr_UserName");
                  $password = $request->input("SysUsr_Password");
                  $status = SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE");
                  $attempt = ['SysUsr_UserName' => $username, 'password' => $password, 'SysUsr_Status' => $status];
                 
                  if (!filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
                      $attempt2 = ['SysUsr_Email' => $username, 'password' => $password, 'SysUsr_Status' => $status];
                  }
                  if (Auth::attempt($attempt) || (isset($attempt2) && Auth::attempt($attempt2))) {

                      $SysUsr_ID = Auth::user()->SysUsr_ID;
                      $SysUsr_LastLoginDate = date('Y-m-d H:i:s');
                      $SysUsr_LastIPAddress = $_SERVER["REMOTE_ADDR"];
                       
                      SystemUserModel::updateLoginInfo($SysUsr_ID, $SysUsr_LastLoginDate, $SysUsr_LastIPAddress);

                      \Cookie::queue(\Cookie::forget('relogin'));
                      $log=new LoggingMastersModel; // log


                      $log->newMasterLog($SysUsr_ID,$SysUsr_ID,$request->ip(),"Login","System_User",\Auth::user()->SysUsr_FullName,"SysUsr_ID",$request->input("SysUsr_Password"),"1"); // log
                      return redirect()->intended(parent::$data['cp_route_name']);
                  } else {
                        $log=new LoggingMastersModel; // 
                    $log->newMasterLog( $username,"0",$request->ip(),"Login","System_User","","SysUsr_ID", $password,"0"); // log
                      if(\Cookie::get('relogin'))
                          return redirect(parent::$data['cp_route_name']."/relogin")->with("error", "Check your password");
                      return redirect(parent::$data['cp_route_name']."/login")->with("error", "Check your username and password");
                  }
              }
              else {
                //var_dump(parent::$data['cp_route_name']); exit;
                  return redirect(parent::$data['cp_route_name']);
              }
          }

          public function logout()
          {
              $log=new LoggingMastersModel; // log
              $log->newMasterLog(\Auth::user("admin")->SysUsr_ID,\Auth::user("admin")->SysUsr_ID,\Request::ip(),"Logout","System_User",\Auth::user("admin")->SysUsr_FullName,"SysUsr_ID","","0"); // log
              Auth::logout();
              return redirect(parent::$data['cp_route_name']."/login");
          }

          public function lock()
          {
              $user=\Auth::user("admin");
              \Cookie::queue("relogin", $user->SysUsr_ID, 99999);
              $log=new LoggingMastersModel; // log
              $log->newMasterLog($user->SysUsr_ID,$user->SysUsr_ID,\Request::ip(),"Lock","System_User",$user->SysUsr_FullName,"SysUsr_ID","","0"); // log
              Auth::logout('admin');
              return redirect(parent::$data['cp_route_name']."/relogin");
          }

          public function relogin()
          {
              if (!Auth::check('admin') && \Cookie::get('relogin')) {
                  if (\Session::has("error"))
                      parent::$data["error"] = \Session::get("error");

                  parent::$data["user"]=SystemUserModel::find(\Cookie::get('relogin'));
                  if(!parent::$data["user"])
                      return redirect(parent::$data['cp_route_name']."/login");
                  return view("cp.lock", parent::$data);
              } else {
                  return redirect(parent::$data['cp_route_name']);
              }
          }
      }
