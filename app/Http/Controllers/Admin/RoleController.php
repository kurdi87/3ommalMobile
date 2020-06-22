<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use yajra\Datatables\Datatables;
use App\Models\SystemLookupModel;
use App\Models\SystemUserModel;
use App\Models\SystemUserRoleModel;
use App\Models\ActionModel;
use App\Http\Requests\RoleRequest;

class RoleController extends SuperAdminController
{
    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menu'] = 'role_view';
        parent::$data["breadcrumbs"]=["لوحة التحكم"=>parent::$data['cp_route_name'],"الصلاحيات"=>parent::$data['cp_route_name']."/role"];
    }

    public function index()
    {

        try {
            parent::$data['roleStatus'] = SystemLookupModel::getLookeupByKey("ROLE_STATUS");
            parent::$data['roles'] = RoleModel::where("Role_Status", SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE"))->get();
        }
        catch (\Exception $e) {
            $e->getMessage();
        }

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");
        parent::$data['title'] = "ادارة الصلاحيات";
        parent::$data["breadcrumbs"]["عرض"]="";
        return view('cp.roles.rolesList', parent::$data);
    }

    public function get(Request $request)
    {
        // echo self::$data["allowedActions"];
        $columns = \Input::input('columns');
        $created_at = isset($columns[4]['search']['value']) ? $columns[4]['search']['value'] : '';
        $filter = [];
        if ($created_at) {
            $created_at = explode('|', $created_at);
            $filter['from'] = isset($created_at[0]) ? $created_at[0] : '';
            $filter['to'] = isset($created_at[1]) ? $created_at[1] : '';
        }

        $roles = RoleModel::getRolesList($filter);

        $table= Datatables::of($roles)
            ->editColumn('status', function ($data) use($request) {
                if($request->input("export"))
                    return $data->status;
                return '<span class="label label-sm ' . (trim($data->SysLkp_HTMLID) == "ROLE_STATUS_ACTIVE" ? "label-success" : "label-danger") . '">' . $data->status . '</span>';
            })
            ->editColumn('userCounter', function ($data) use($request) {
                if($request->input("export"))
                    return $data->userCounter;
                return '<span class="nousers">' . $data->userCounter . '</span>';
            })
            ->editColumn('Role_Name', function ($data) use($request) {
                if($request->input("export"))
                    return $data->Role_Name;

                    return '<a data-id="' . $data->Role_ID . '" class="roletxt" href="'.parent::$data['cp_route_name'].'/role/edit/' . $data->Role_ID . '">' . $data->Role_Name . '</a>';


            })
            ->editColumn('created_at', function ($data) {
                return ($data->created_at) ? date_format(date_create($data->created_at), 'Y-m-d') : "";
            })
            ->editColumn('Role_ID', function ($data) {
                return '';
            });

        if(!$request->input("export") && $request->ajax()){
            $table->addColumn('action', function ($data) {
                $result = '<div class="actions tbl-sm-actions">';

                    $result .= '<a title="Edit Role" class="btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered" href="'.parent::$data['cp_route_name'].'/role/edit/' . $data->Role_ID . '">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>';


                    $result .= '<a title="' . ((trim($data->SysLkp_HTMLID) == "ROLE_STATUS_ACTIVE") ? "Deactivate" : "Activate") . '" href="'.parent::$data['cp_route_name'].'/role/changeStatus/' . $data->Role_ID . '" class="btn btn-circle btn-icon-only btn-default btn-ustatus tooltip-one-info ' . ((trim($data->SysLkp_HTMLID) == "ROLE_STATUS_ACTIVE") ? "ustatus-inactive" : "ustatus-active") . ' tooltip-one-info tooltipstered" href="javascript:;">
                                                        <i class="fa fa-' . ((trim($data->SysLkp_HTMLID) == "ROLE_STATUS_ACTIVE") ? "square-o" : "check-square") . '"></i>
                                                    </a>';

                return $result;
            });
        }

        $table=$table->make(true);

        if ($request->ajax())
            return $table;
        if($request->input("export")){
            $table=json_decode(json_encode($table->getData()),true);
            $aliases=["Role_Name"=>"الصلاحية","status"=>"الحالة","userCounter"=>"عدد الميتخدمين","created_at"=>"تاريخ الانشاء","SysUsr_FullName"=>"مدخل البيانات"];
            $type=$request->input("export");
            if(!in_array($type, ["xlsx","csv","pdf"]))
                $type="csv";

            $this->exportFile("Roles Report",$this->formatAliases($table,$aliases),$type,true);
        }

        redirect(parent::$data['cp_route_name'].'/role');
    }

    public function changeStatus($id)
    {
        if (\Request::ajax()) {
            $role = RoleModel::find($id);
            if (!$role) {
                return response(["status" => false, "message" => "هذه الصلاحية غير موجودة"], 200);
            }

            if (SystemLookupModel::getKeyById($role->Role_Status) == "ROLE_STATUS_INACTIVE") {
                $oldValue=$role->toArray(); //log
                $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE");
                $role->save();
                $newValue=$role->toArray();// log
                $log=$this->logAction($role->Role_ID,parent::$data["adminUser"]->SysUsr_ID,\Request::ip(),parent::$data["actionRouteName"],$role->getTableName(),$role->Role_Name,$role->getPrimaryKey(),compareTwoArray($oldValue,$newValue,$role->getPrimaryKey()));// log
                return response(["status" => true, "message" => "تم تفعيل الصلاحية بنجاح"], 200);
            } else {
                return $this->deactivateRole($role, \Request::input("isDeactivate"), \Request::input("isMove"), \Request::input("newRole"), $role->users->count() < 1 ? true : false);
            }
        } else {
            return redirect(parent::$data['cp_route_name']."/role");
        }
    }

    private function deactivateRole($role, $isDeactivate, $isMove, $newRole, $updateAnyWay = false)
    {
        $newRoleObject = RoleModel::find($newRole);
        $oldValue=$role->toArray(); //log
        if ($updateAnyWay) {
            $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_INACTIVE");
            $role->save();
            $message="تم تعطيل الصلاحية بنجاح";
            $type="";
        } elseif ($isDeactivate == "true") {
            $users = SystemUserRoleModel::where("UsrRol_RoleID", $role->Role_ID)->lists("UsrRol_SystemUserID")->toArray();
            SystemUserModel::whereIn("SysUsr_ID", $users)->update(["SysUsr_Status" => SystemLookupModel::getIdByKey("SYSTEM_USER_STATUS_DEACTIVE")]);
            $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_INACTIVE");
            $role->save();
            $message="تم تعطيل الصلاحية بنجاح وتعطيل جميع المستخدمين التابعين لها";
            $type="deactive";
        } elseif ($isMove == "true" && $newRoleObject) {
            foreach ($role->users()->get() as $user) {
                $user->actions()->detach();
                $user->actions()->attach($newRoleObject->actions()->lists("Action_ID")->toArray());
            }
            SystemUserRoleModel::where("UsrRol_RoleID", $role->Role_ID)->update(["UsrRol_RoleID" => $newRoleObject->Role_ID]);
            $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_INACTIVE");
            $role->save();
            $message="تم تعطيل الصلاحية بنجاح ونقل جميع المستخدمين التابعين لها الى " . $newRoleObject->Role_Name;
            $type="move";

        } else {
            return response(["status" => false, "message" => "أحد المدخلات مفقود"], 200);
        }

        $newValue=$role->toArray();// log
        $log=$this->logAction($role->Role_ID,parent::$data["adminUser"]->SysUsr_ID,\Request::ip(),parent::$data["actionRouteName"],$role->getTableName(),$role->Role_Name,$role->getPrimaryKey(),compareTwoArray($oldValue,$newValue,$role->getPrimaryKey()));// log
        return response(["status" => true, "type" => $type, "message" => $message], 200);
    }

    public function create()
    {
        parent::$data['title'] = "اضافة صلاحية جديدة";
        parent::$data['creator'] = \Auth::user("admin")->SysUsr_FullName;
        parent::$data['created_at'] = date("Y-m-d");
        parent::$data['actions'] = ActionModel::with("actions")->where("Action_IsActive", 1)->where("Action_PredecesorActionID", NULL)->orderBy("Action_MenuOrder", "asc")->get();
        parent::$data['roleActions'] = [];
        parent::$data['isRole'] = true;

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"]["اضافة"]="";
        return view('cp.roles.add', parent::$data);
    }

    public function store(RoleRequest $request)
    {
        $role = new RoleModel();
        $role->Role_Name = $request->input('Role_Name');
        $role->Role_CreatedBy = \Auth::user("admin")->SysUsr_ID;
        if ($request->input("Role_Status") == 1) {
            $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE");
        } else {
            $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_INACTIVE");
        }

        $role->save();
        //$this->logAction($role->Role_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$role->getTableName(),$role->Role_Name,$role->getPrimaryKey()); // log
        $this->logAction($role->Role_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$role->getTableName(),$role->Role_Name,$role->getPrimaryKey()); // log
        // for saving actions
        $actions = $request->input("action");
        if ($actions && is_array($actions)) {
            $role->actions()->attach($actions);
        }

        $message = "تم اضافة صلاحية بنجاح";
        $status = "success";
        if ($request->input("quick") == 1) {
            return $role;
        } elseif (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/role/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/role")->with($status, $message);
    }

    public function edit($id)
    {
        $role = RoleModel::with(["user", "actions"])->find($id);
        if (!$role)
            return redirect(parent::$data['cp_route_name']."/role");

        parent::$data['title'] = "تعديل صلاحية";
        parent::$data['creator'] = $role->user->SysUsr_FullName;
        parent::$data['created_at'] = date_format(date_create($role->created_at), 'Y-m-d');
        parent::$data['actions'] = ActionModel::with("actions")->where("Action_IsActive", 1)->where("Action_PredecesorActionID", NULL)->orderBy("Action_MenuOrder", "asc")->get();

        if ($role->Role_Status == SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE")) {
            $role->Role_Status = 1;
        } else {
            $role->Role_Status = 0;
        }
        parent::$data['result'] = $role;
        parent::$data['roleActions'] = $role->actions->lists("Action_ID")->toArray();
        parent::$data['isRole'] = true;

        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["breadcrumbs"]["تعديل"]="";
        return view('cp.roles.edit', parent::$data);
    }

    public function update(RoleRequest $request, $id)
    {
        $role = RoleModel::with(["user", "actions"])->find($id);
        if (!$role)
            return redirect(parent::$data['cp_route_name']."/role");

        $oldValue=$role->toArray();
        $role->Role_Name = $request->input('Role_Name');
        if ($request->input("Role_Status") == 1) {
            $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_ACTIVE");
        } else {
            $role->Role_Status = SystemLookupModel::getIdByKey("ROLE_STATUS_INACTIVE");
        }

        $role->save();
        $newValue=$role->toArray();
        $this->logAction($role->Role_ID,parent::$data["adminUser"]->SysUsr_ID,$request->ip(),parent::$data["actionRouteName"],$role->getTableName(),$role->Role_Name,$role->getPrimaryKey(),compareTwoArray($oldValue,$newValue,$role->getPrimaryKey())); // log
        // for saving actions
        $actions = $request->input("action");
        $current = $role->actions()->lists('Action_ID')->toArray();
        if ($actions && is_array($actions)) {
            $attach = array_diff($actions, $current);
            $deattach = array_diff($current, $actions);
            if (count($deattach) > 0)
                $role->actions()->detach($deattach);
            $role->actions()->attach($attach);
        } else {
            $role->actions()->detach($current);
        }

        $message = "تم تحديث الصلاحية بنجاح";
        $status = "success";

        if (isset($_POST["save_new"]))
            return redirect(parent::$data['cp_route_name']."/role/create")->with($status, $message);
        else
            return redirect(parent::$data['cp_route_name']."/role")->with($status, $message);
    }

    public function usersCount($id)
    {
        if (\Request::ajax()) {
            $role = RoleModel::find($id);
            if (!$role) {
                return response(['status' => false, "message" => "هذه الصلاحية غير موجودة"], 200);
            }

            return response(["status" => true, "usersCount" => $role->users()->count()], 200);
        } else {
            return redirect(parent::$data['cp_route_name']."/role");
        }
    }
}
