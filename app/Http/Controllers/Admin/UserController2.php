<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\RoleModel;
use App\Models\SystemUserModel;
use App\Models\SystemUserRoleModel;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\SystemLookupModel;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\ActionModel;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Admin\RoleController;
use App\Models\LangModel;

class UserController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menu'] = "Users";
        parent::$data["breadcrumbs"]=["Control Panel"=>parent::$data['cp_route_name'],"Users"=>parent::$data['cp_route_name']."/user"];
        //var_dump(parent::$data); exit;
    }

    public function index()
    {
        try {
            parent::$data['userStatus'] = SystemLookupModel::getLookeupByKey("SYSTEM_USER_STATUS");
            parent::$data['roles'] = RoleModel::all();
            parent::$data['lang'] = new LangModel;

            parent::$data['moveRole'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        }
        catch (\Exception $e) {
            $e->getMessage();
        }

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        parent::$data['title'] =  "Manage Users";
        parent::$data["breadcrumbs"]["Users"]="";
        return view('cp.users.usersList', parent::$data);
    }

    public function get(Request $request)
    {
        $columns = \Input::input('columns');
        $created_at = isset($columns[7]['search']['value']) ? $columns[7]['search']['value'] : '';
        $filter = [];
        if ($created_at) {
            $created_at = explode('|', $created_at);
            $filter['from'] = isset($created_at[0]) ? $created_at[0] : '';
            $filter['to'] = isset($created_at[1]) ? $created_at[1] : '';
        }

        $key = isset($columns[1]['search']['value']) ? $columns[1]['search']['value'] : '';
        if ($key) {
            $filter['key'] = $key;
        }

        $users = SystemUserModel::getUsersList($filter);
        $table= Datatables::of($users)
            ->editColumn('status', function ($data) use($request) {
                if($request->input("export"))
                    return $data->status;
                return '<span class="label label-sm ' . (trim($data->SysLkp_HTMLID) == "SYSTEM_USER_STATUS_ACTIVE" ? "label-success" : "label-danger") . '">' . $data->status . '</span>';
            })
            ->editColumn('SysUsr_FullName', function ($data) use($request) {
                if($request->input("export"))
                    return $data->SysUsr_FullName;
                if (in_array(6, self::$data["allowedActions"])) {
                    return '<a class="userid" data-id="' . $data->SysUsr_ID . '" href="'.parent::$data['cp_route_name'].'/user/edit/' . $data->SysUsr_ID . '">' . $data->SysUsr_FullName . '</a>';
                } else {
                    return '<a class="userid" data-id="' . $data->SysUsr_ID . '">' . $data->SysUsr_FullName . '</a>';
                }
            })
            ->editColumn('SysUsr_Email', function ($data) use($request) {
                if($request->input("export"))
                    return $data->SysUsr_Email;
                return '<span class="tdemail popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="' . $data->SysUsr_Email . '">' . $data->SysUsr_Email . '</span>';
            })
            ->editColumn('Role_Name', function ($data) use($request) {
                if($request->input("export"))
                    return $data->Role_Name;
                return '<span class="roleName">' . $data->Role_Name . '</span>';
            })
            ->editColumn('created_at', function ($data) {
                return ($data->created_at) ? date_format(date_create($data->created_at), 'Y-m-d') : "";
            })
            ->editColumn('SysUsr_ID', function ($data) use($request) {
                return '<input name="id[]" type="checkbox" value="' . $data->SysUsr_ID . '" class="checkboxes" />';
            });

        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('action', function ($data) {
                $result = '<div class="actions tbl-sm-actions tblactions-four">';
                $result .= '<a data-original-title="Log Information" data-content="Last Login: ' . $data->SysUsr_LastLoginDate . '&lt;br&gt; Last IP: ' . $data->SysUsr_LastIPAddress . '" data-placement="top" data-trigger="hover" data-html="true" data-container="body" class="btn btn-circle btn-icon-only btn-default popovers" href="javascript:;">
                                                        <i class="fa fa-copy"></i>
                                                    </a>';

                if (in_array(6, self::$data["allowedActions"])) {
                    $result .= '<a title="Edit user" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="'.parent::$data['cp_route_name'].'/user/edit/' . $data->SysUsr_ID . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';
                }

                if (in_array(2, self::$data["allowedActions"])) {
                    $result .= '<a title="' . ((trim($data->SysLkp_HTMLID) == "SYSTEM_USER_STATUS_ACTIVE") ? "Deactivate" : "Activate") . '" href="'.parent::$data['cp_route_name'].'/user/changeStatus" class="btn btn-circle btn-icon-only btn-default btn-ustatus ' . ((trim($data->SysLkp_HTMLID) == "SYSTEM_USER_STATUS_ACTIVE") ? "ustatus-inactive" : "ustatus-active") . ' tooltip-one-info tooltipstered" href="javascript:;">
                                                        <i class="fa fa-' . ((trim($data->SysLkp_HTMLID) == "SYSTEM_USER_STATUS_ACTIVE") ? "square-o" : "check-square") . '"></i>
                                                    </a>';
                }
                if (in_array(3, self::$data["allowedActions"])) {
                    $result .= '<a title="Change Password" data-modal="modal-changepassword" class="btn btn-circle btn-icon-only btn-default tooltip-one-info umodal tooltipstered" href="'.parent::$data['cp_route_name'].'/user/changePassword/' . $data->SysUsr_ID . '">
                                                        <i class="fa fa-key"></i>
                                                    </a>';
                }

                return $result;
            });
        }

        $table=$table->make(true);

        if ($request->ajax())
            return $table;
        if($request->input("export")){
            $table=json_decode(json_encode($table->getData()),true);
            $aliases=["SysUsr_FullName"=>"Name","Role_Name"=>"Role Name","SysUsr_UserName"=>" User Name","status"=>"Status","SysUsr_Email"=>"Email","SysUsr_Mobile"=>"Mobile Number","created_at"=>"created_at","created_by"=>"Created By"];
            $type=$request->input("export");
            if(!in_array($type, ["xlsx","csv","pdf"]))
                $type="csv";

            $this->exportFile("System Users Report",$this->formatAliases($table,$aliases),$type,true);
        }
        redirect(parent::$data['cp_route_name'].'/users');
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");

            if (!$ids || is_array($ids)) {
                redirect('/'.parent::$data['cp_route_name'].'/user');
            }

            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $status = $request->input("status");
            if ($status == "SYSTEM_USER_STATUS_ACTIVE") {
                SystemUserModel::whereIn("SysUsr_ID", $ids)->update(["SysUsr_Status" => SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE")]);
                $message = "Done successfully";
            } else {
                SystemUserModel::whereIn("SysUsr_ID", $ids)->update(["SysUsr_Status" => SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_DEACTIVE")]);
                $message = "Done successfully";
            }

            $user=new SystemUserModel();
            $this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$user->getTableName(),"Users",$user->getPrimaryKey()); // log
            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/user');
        }
    }

    public function changeStatusAll(Request $request)
    {
        $ids = $request->input("id");
        if ($key = array_search(1, $ids) !== false) {
            unset($ids[$key]);
        }
        $status = $request->input("status");
        $existStatus = ["SYSTEM_USER_STATUS_ACTIVE", "SYSTEM_USER_STATUS_DEACTIVE"];
        if (\Request::ajax() && $ids && is_array($ids) && in_array($status, $existStatus)) {
            SystemUserModel::whereIn("SysUsr_ID", $ids)->update(["SysUsr_Status", SystemLookupModel::getIdByKey($status)]);

            return response(['status' => true, 'message' => "Done successfully"], 200);
        } else {
            redirect(parent::$data['cp_route_name'].'/user');
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if ($request->input("id") == 1) {
            return redirect(parent::$data['cp_route_name']."/user");
        }
        $user = SystemUserModel::find($request->input("id"));
        $user->SysUsr_Password = bcrypt($request->input("password"));
        $user->save();
        /*$this->logAction($user->SysUsr_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$user->getTableName(),$user->SysUsr_FullName,$user->getPrimaryKey()); // log

        if ($request->input("sendEmail") == 1) {
            $subject = "Your New Password";
            $bodyPath = "site.email.password";
            $data = ['customer_password' => $request->input("password")];
            $data["facebookLink"]=parent::$data["facebookLink"];
            $data["twitterLink"]=parent::$data["twitterLink"];
            $data["instagramLink"]=parent::$data["instagramLink"];
            $data["youtubeLink"]=parent::$data["youtubeLink"];
            $toMail = $user->SysUsr_Email;
            $toName = $user->SysUsr_FullName;
            $cc = "";

            $this->sendEmail($subject, $bodyPath, $data, $toMail, $toName, $cc);
        }*/

        if ($request->ajax())
            return response(["status" => true, "message" =>"Done"], 200);
    }

    public function changeRole(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->input("id");
            if ($key = array_search(1, $ids) !== false) {
                unset($ids[$key]);
            }
            $roleid = $request->input("roleid");
            $role = RoleModel::find($roleid);

            if (!$ids || !$role) {
                redirect('/'.parent::$data['cp_route_name'].'/user');
            }


            SystemUserRoleModel::whereIn("UsrRol_SystemUserID", $ids)->update(["UsrRol_RoleID" => $role->Role_ID]);
            foreach ($ids as $id) {
                $user = SystemUserModel::find($id);
                if ($user) {
                    $user->actions()->detach();
                    $user->actions()->attach($role->actions()->lists("Action_ID")->toArray());
                    $this->logAction($user->SysUsr_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$user->getTableName(),$user->SysUsr_FullName,$user->getPrimaryKey()); // log
                }
            }
            $message = "Done";

            return response(['status' => true, 'message' => $message], 200);
        } else {
            redirect('./'.parent::$data['cp_route_name'].'/user');
        }
    }

    public function actionRole($id)
    {
        if (\Request::ajax()) {
            $role = RoleModel::find($id);
            if (!$role)
                return response(["status" => false, "message" => "Error"], 200);

            return response(["status" => true, "result" => $role->actions()->lists("Action_ID")->toArray()], 200);
        } else {
            return redirect(parent::$data['cp_route_name']."/user");
        }
    }

    public function create()
    {
        parent::$data['title'] = LangModel::getLabelByKey("Add User","en");
        parent::$data['src'] = "cp/images/avatar-img.jpg";
        parent::$data['roles'] = ['' => ''] + RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->lists("Role_Name", "Role_ID")->toArray();
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['lastLogin'] = '-----------';
        parent::$data['lastIP'] = '-----------';
        parent::$data['roleActions'] = [];
        parent::$data['actions'] = ActionModel::with("actions")->where("Action_IsActive", 1)->where("Action_PredecesorActionID", NULL)->orderBy("Action_MenuOrder", "asc")->get();
        parent::$data['roleActionsDefault'] = [];

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["result"] = new SystemUserModel;
        parent::$data["status"]=true;

        parent::$data['lang'] = new LangModel;

        parent::$data["isProfile"] = false;
        parent::$data["breadcrumbs"][LangModel::getLabelByKey("Add","en")]="";
        return view('cp.users.add', parent::$data);
    }

    public function store(UserRequest $request)
    {
        $roleid = $request->input("roleid");
        $tmp = RoleModel::find($request->input("roleid"));
        if (!$tmp) {
            $role = new RoleController;
            $roleRequest = new Requests\RoleRequest();
            $roleRequest->merge($request->all());
            $roleRequest->merge(["Role_Name" => $request->input("roleid"), "Role_Status" => 1, "quick" => 1]);
            $newRole = $role->store($roleRequest);
            $roleid = $newRole->Role_ID;
        }

        $user = new SystemUserModel();
        $user->SysUsr_UserName = $request->input("SysUsr_UserName");
        $user->SysUsr_Password = bcrypt($request->input("password"));
        $user->SysUsr_Email = $request->input("SysUsr_Email");
        $user->SysUsr_firstName = $request->input("SysUsr_firstName");
        $user->SysUsr_lastName = $request->input("SysUsr_lastName");
        
        $user->SysUsr_DoB = $request->input("SysUsr_DoB");
        $user->SysUsr_Mobile = $request->input("SysUsr_Mobile");
        $user->SysUsr_CreatedBy = \Auth::user("admin")->SysUsr_ID;
        $user->SysUsr_FullName = $user->SysUsr_firstName." ".$user->SysUsr_lastName;
        if ($request->input("SysUsr_Status") == 1)
            $user->SysUsr_Status = SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE");
        else
            $user->SysUsr_Status = SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_DEACTIVE");

        if ($request->hasFile("SysUsr_ThumbImage")) {
            $user->SysUsr_ThumbImage = $this->upload($request->file("SysUsr_ThumbImage"), "users");
        }
        $user->save();

        $user->roles()->attach($roleid, ["UsrRol_IsCustomized" => ($request->input("UsrRol_IsCustomized") == "Yes") ? 1 : 0]);

        if ($request->input("action")) {
            $user->actions()->attach($request->input("action"));
        }

        $this->logAction($user->SysUsr_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$user->getTableName(),$user->SysUsr_FullName,$user->getPrimaryKey()); // log

        if($request->ajax()){
            return response(["status"=>true,"message"=>"Done"],200);
        }

        if (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/user/create")->with("success", "Done successfully");

        return redirect(parent::$data['cp_route_name']."/user")->with("success", "Done successfully");
    }

    public function edit($id, $isProfile = false)
    {
        /*if ($id == 1 && !$isProfile) {
            return redirect(parent::$data['cp_route_name']."/user");
        }*/
        if ($isProfile) {
            return redirect(parent::$data['cp_route_name']."/user");
        }
        $user = SystemUserModel::find($id);
        if (!$user)
            return redirect(parent::$data['cp_route_name']."/user");
        parent::$data['title'] = "Edit user";
        parent::$data['src'] = "cp/images/avatar-img.jpg";
        if ($user->SysUsr_ThumbImage)
            parent::$data['src'] = "uploads/users/" . $user->SysUsr_ThumbImage;
        parent::$data['roles'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->lists("Role_Name", "Role_ID");
        parent::$data['creator'] = isset($user->user->SysUsr_FullName) ? $user->user->SysUsr_FullName : "--------";
        parent::$data['lastLogin'] = '-----------';
         parent::$data['lang'] = new LangModel;

        if (strtotime($user->SysUsr_LastLoginDate)){
            parent::$data['lastLogin'] = $user->SysUsr_LastLoginDate;
        }

        if (strtotime($user->SysUsr_DoB)>0)
            $user->SysUsr_DoB = date_format(date_create($user->SysUsr_DoB), 'Y-m-d');
        else
            $user->SysUsr_DoB = "";

        parent::$data['lastIP'] = '-----------';
        if ($user->SysUsr_LastIPAddress)
            parent::$data['lastIP'] = $user->SysUsr_LastIPAddress;

        parent::$data['roleActions'] = $user->actions->lists("Action_ID")->toArray();

        parent::$data['actions'] = ActionModel::with("actions")->where("Action_IsActive", 1)->where("Action_PredecesorActionID", NULL)->orderBy("Action_MenuOrder", "asc")->get();

        $user->roleid = isset($user->roles[0]) ? $user->roles[0]->Role_ID : "";
        $user->UsrRol_IsCustomized = "No";

        if (isset($user->roles[0])) {
            parent::$data['roleActionsDefault'] = $user->roles[0]->actions->lists("Action_ID")->toArray();
            $tmp = SystemUserRoleModel::where("UsrRol_SystemUserID", $user->SysUsr_ID)->where("UsrRol_RoleID", $user->roleid)->first();
            if ($tmp && $tmp->UsrRol_IsCustomized == 1)
                $user->UsrRol_IsCustomized = "Yes";
            else
                $user->UsrRol_IsCustomized = "No";
        }
        parent::$data["result"] = $user;
        parent::$data["user"] = $user;

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        if (\Session::has("error"))
            parent::$data["error"] = \Session::get("error");

        if (\Session::has("tab2"))
            parent::$data["tab2"] = \Session::get("tab2");

        parent::$data["isProfile"] = $isProfile;
        parent::$data["status"]=$user->SysUsr_Status == SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE")?true:false;
        parent::$data["breadcrumbs"]["Edit"]="";

        if($isProfile){
            unset(parent::$data["breadcrumbs"]["Edit"]);
            parent::$data["breadcrumbs"]["User Setting"]="";
            return view('cp.users.profileEdit', parent::$data);
        }
        return view('cp.users.edit', parent::$data);
    }

    public function upload($file){
         $path = public_path('uploads'); // upload directory
          //$file = \Input::file('choose-file');
         //var_dump($file); exit;
          $ext = $file->guessClientExtension();
          $message = '';
          $filename = time() . str_random(25) . '.' . $ext;
          $uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR . "users", $filename);

          if ($uploadSuccess) {
              $user=SystemUserModel::find(\Auth::user("admin")->SysUsr_ID);
              return $user->SysUsr_ThumbImage=$filename;
              //$user->save();
              //return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
          } else {
            return NULL;
              //return response(array('status' => 2, 'message' => $message));
          }
    }

    public function update(UserRequest $request, $id, $isProfile = false)
    {
        
        /*if ($id == 1 && !$isProfile) {
            return redirect(parent::$data['cp_route_name']."/user");
        }*/
        if ( $isProfile) {
            return redirect(parent::$data['cp_route_name']."/user");
        }
        $user = SystemUserModel::find($id);
        if (!$user)
            return redirect(parent::$data['cp_route_name']."/user");

        $oldValue=$user->toArray();
        if (!$isProfile) {
            $roleid = $request->input("roleid");
            $tmp = RoleModel::find($request->input("roleid"));
            if (!$tmp) {
                $role = new RoleController;
                $roleRequest = new Requests\RoleRequest();
                $roleRequest->merge($request->all());
                $roleRequest->merge(["Role_Name" => $request->input("roleid"), "Role_Status" => 1, "quick" => 1]);
                $newRole = $role->store($roleRequest);
                $roleid = $newRole->Role_ID;
            }
        }


        $user->SysUsr_UserName = $request->input("SysUsr_UserName");
        if ($request->input("password")) {
            $user->SysUsr_Password = bcrypt($request->input("password"));
        }

        $user->SysUsr_Email = $request->input("SysUsr_Email");
        $user->SysUsr_firstName = $request->input("SysUsr_firstName");
        $user->SysUsr_lastName = $request->input("SysUsr_lastName");
        $user->SysUsr_FullName = $user->SysUsr_firstName." ".$user->SysUsr_lastName;
        $user->SysUsr_DoB = $request->input("SysUsr_DoB");
        $user->SysUsr_Mobile = $request->input("SysUsr_Mobile");

        if (!$isProfile) {
            if ($request->input("SysUsr_Status") == 1)
                $user->SysUsr_Status = SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_ACTIVE");
            else
                $user->SysUsr_Status = SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_DEACTIVE");
        }

        if ($request->hasFile("SysUsr_ThumbImage")) {
            $user->SysUsr_ThumbImage = $this->upload($request->file("SysUsr_ThumbImage"), "users");
        }

        $user->save();
        $newValue=$user->toArray();
        $this->logAction($user->SysUsr_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$user->getTableName(),$user->SysUsr_FullName,$user->getPrimaryKey(),compareTwoArray($oldValue,$newValue,$user->getPrimaryKey())); // log
        if (!$isProfile) {
            $user->roles()->detach();
            $user->roles()->attach($roleid, ["UsrRol_IsCustomized" => ($request->input("UsrRol_IsCustomized") == "Yes") ? 1 : 0]);

            if ($request->input("action")) {
                // for saving actions
                $actions = $request->input("action");
                $current = $user->actions()->lists('Action_ID')->toArray();

                if ($actions && is_array($actions)) {

                    $attach = array_diff($actions, $current);
                    $deattach = array_diff($current, $actions);
                    if (count($deattach) > 0)
                        $user->actions()->detach($deattach);
                    $user->actions()->attach($attach);
                } else {
                    $user->actions()->detach($current);
                }
            }
        }

        if($request->ajax()){
            return response(["status"=>true,"message"=>"Done successfully"],200);
        }

        if($isProfile);
            return redirect(parent::$data['cp_route_name']."/profile/edit")->with("success", "Done");

        if (isset($_POST["save_new"]) && !$isProfile);
            return redirect(parent::$data['cp_route_name']."/user/create")->with("success", "Done");

        //return redirect(parent::$data['cp_route_name']."/user")->with("success", "User updated successfully");
    }

    public function profile()
    {
        return $this->edit(\Auth::user("admin")->SysUsr_ID, true);
    }

    public function profileOverview(){
        parent::$data["title"]="Personal File";
        parent::$data["breadcrumbs"]["Personal File"]="";
        $user=\Auth::user("admin");

        parent::$data['src'] = "cp/images/avatar-img.jpg";
        if ($user->SysUsr_ThumbImage)
            parent::$data['src'] = "uploads/users/" . $user->SysUsr_ThumbImage;

        parent::$data['creator'] = isset($user->user->SysUsr_FullName) ? $user->user->SysUsr_FullName : "--------";
        parent::$data['lastLogin'] = '-----------';

        if (strtotime($user->SysUsr_LastLoginDate)){
            parent::$data['lastLogin'] = $user->SysUsr_LastLoginDate;
        }

        if (strtotime($user->SysUsr_DoB)>0)
            $user->SysUsr_DoB = date_format(date_create($user->SysUsr_DoB), 'Y-m-d');
        else
            $user->SysUsr_DoB = "";

        parent::$data['lastIP'] = '-----------';
        if ($user->SysUsr_LastIPAddress)
            parent::$data['lastIP'] = $user->SysUsr_LastIPAddress;

        parent::$data["user"]=$user;
        parent::$data["activeProfileTab"]=true;
        return view("cp.users.profileOver",parent::$data);
    }

    public function updateProfile(UserRequest $request)
    {
        return $this->update($request, \Auth::user("admin")->SysUsr_ID, true);
    }

    public function validateInput(Request $request,$user_id=0){

        if($request->ajax()){
            $rules = [
                "SysUsr_UserName"=>"unique:System_User,SysUsr_UserName," . $user_id . ',SysUsr_ID',
                "SysUsr_Email"=>"unique:System_User,SysUsr_Email," . $user_id . ',SysUsr_ID',
            ];

            $messages = [
                'SysUsr_Email.unique' => 'email!',
                'SysUsr_UserName.unique' => 'Not Available user Name!',
                ];

            $val=\Validator::make($request->all(),$rules,$messages);
            if($val->fails()){
                return response(["status"=>false,"message"=>$val->messages()],200);
            }

            return response(["status"=>true],200);
        }

        return redirect(parent::$data['cp_route_name']."/user");
    }

    public function updatePasswordProfile(Request $request){
        $oldPassword=$request->input("oldPassword");
        $newPassword=$request->input("password");
        $confirmPassword=$request->input("confirm_password");
        $user=\Auth::user("admin");

        if(\Hash::check($oldPassword, $user->SysUsr_Password) && $newPassword && $newPassword==$confirmPassword){
            $user->SysUsr_Password=bcrypt($newPassword);
            $user->save();
            $this->logAction($user->SysUsr_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$user->getTableName(),$user->SysUsr_FullName,$user->getPrimaryKey()); // log
            return redirect(parent::$data['cp_route_name']."/profile/edit")->with("success","Done");
        }

        return redirect(parent::$data['cp_route_name']."/profile/edit")->with("error","Please Check Details")->with("tab2","active");
    }

}
