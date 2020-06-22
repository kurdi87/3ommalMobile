<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\DB;

class SystemUserModel extends SuperModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'system_user';
    protected $primaryKey = 'SysUsr_ID';
    protected $fillable = ['SysUsr_FullName','SysUsr_Mobile','SysUsr_DoB', 'SysUsr_UserName', 'SysUsr_Password','is_verified','verification_key','city','address','social_status', 'SysUsr_Email','address','gender','sid','sid_type'];


    public function user()
    {
        // dd(DB::getQueryLog());
        return $this->belongsTo($this->model("SystemUserModel"), "SysUsr_CreatedBy");
    }

    public function roles()
    {
        return $this->belongsToMany($this->model("RoleModel"), "systemuser_role", "UsrRol_SystemUserID", "UsrRol_RoleID");
    }

    public function actions()
    {
        return $this->belongsToMany($this->model("ActionModel"), "systemuser_action", "UsrAct_SystemUserID", "UsrAct_ActionID");
    }

    public static function getUsers()
    {
        $result = self::where('SysUsr_Status', 5);

        return $result->get();

    }

    public static function getUserFullName($userid)
    {
        if ($userid == "" || $userid == "0")
            return "";
        else
            return self::where('SysUsr_ID', $userid)->get()->first()->SysUsr_FullName;
    }

    public static function getUserName($userid)
    {
        if ($userid == "" || $userid == "0")
            return "";
        else
            return self::where('SysUsr_ID', $userid)->get()->first()->SysUsr_UserName;
    }

    public function getAuthPassword()
    {
        return $this->SysUsr_Password;
    }

    public static function getUsersArray($role)
    {
        $result = self::select('*')->where('SysUsr_Status',5);
        if ($role > 15) {
            $result = $result->where('role', $role)->lists('SysUsr_FullName', 'SysUsr_ID')->toArray();
        } else {
            $result = $result->lists('SysUsr_FullName', 'SysUsr_ID')->toArray();;
        }
        return $result;


    }

    public static function getUsersList(Array $filters = [])
    {
        $result = self::select(["system_user.*", "role.Role_Name", "role.Role_ID", "sys_status.SysLkp_HTMLID", "st.SysLkpLang_Text as status", "su.SysUsr_FullName as created_by"])
            ->leftJoin('system_user as su', 'su.SysUsr_ID', '=', 'system_user.SysUsr_CreatedBy')
            ->leftJoin('systemuser_role', 'systemuser_role.UsrRol_SystemUserID', '=', 'system_user.SysUsr_ID')
            ->leftJoin('role', 'role.Role_ID', '=', 'systemuser_role.UsrRol_RoleID')
            ->leftJoin('system_lookup as sys_status', 'sys_status.SysLkp_ID', '=', 'system_user.SysUsr_Status')
            ->leftJoin('systemlookup_language as st', function ($join) {
                $join->on('st.SysLkpLang_SystemLookupID', '=', 'sys_status.SysLkp_ID')
                    ->where("st.SysLkpLang_Type", "=", "EN");
            });

        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('system_user.SysUsr_UserName', 'like', "%" . $filters['key'] . "%")
                ->orWhere('system_user.SysUsr_FullName', 'like', "%" . $filters['key'] . "%");
        }

        if (isset($filters['from']) && $filters['from']) {
            $result = $result->where('system_user.created_at', '>=', $filters['from']);
        }

        if (isset($filters['to']) && $filters['to']) {
            $result = $result->where(\DB::raw('DATE_FORMAT(system_user.created_at, "%Y-%m-%d")'), '<=', $filters['to']);
        }

        //$result = $result->where("system_user.SysUsr_ID", "!=", 1);

        return $result;
    }

    public function canDo($route)
    {
        foreach ($this->actions()->with("routes")->get() as $action) {
            if (in_array($route, $action->routes->lists("ActRoute_RouteName")->toArray()))
                return true;
        }

        return false;
    }

    public function getUserActions()
    {
        return self::with(["actions" => function ($q) {
            $q->where("Action_PredecesorActionID", "<", 1)->where("Action_IsMenuItem", 1)->where("Action_IsActive", 1)->orderBy("Action_MenuOrder", "asc");
        }, "actions.actions" => function ($q) {
            $q->where("Action_IsMenuItem", 1)->where("Action_IsActive", 1)->orderBy("Action_MenuOrder", "asc");
        }, "actions.routes"])->where("SysUsr_ID", $this->SysUsr_ID)->first();
    }

    public function getAllowedActions()
    {
        return self::with(["actions" => function ($q) {
            $q->select(["Action_ID", "Action_Name"]);
        }])->where("SysUsr_ID", $this->SysUsr_ID)->lists("Action_ID")->toArray();
    }

    public static function updateLoginInfo($SysUsr_ID, $SysUsr_LastLoginDate, $SysUsr_LastIPAddress)
    {
        return self::where('SysUsr_ID', $SysUsr_ID)
            ->update([
                'SysUsr_LastLoginDate' => $SysUsr_LastLoginDate,
                'SysUsr_LastIPAddress' => $SysUsr_LastIPAddress
            ]);
    }
}
