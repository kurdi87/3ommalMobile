<?php

namespace App\Models;

class RoleModel extends SuperModel
{
    protected $table = 'role';
    protected $primaryKey = 'Role_ID';

    public function actions()
    {
        return $this->belongsToMany($this->model("ActionModel"), "role_action", "RolAct_RoleID", "RolAct_ActionID");
    }

    public function users()
    {
        return $this->belongsToMany($this->model("SystemUserModel"), "SystemUser_Role", "UsrRol_RoleID", "UsrRol_SystemUserID");
    }

    public function user()
    {
        return $this->belongsTo($this->model("SystemUserModel"), "Role_CreatedBy");
    }
    public static function getFPRoles()
    {
        $result = self::select(["role.*"])->where('Role_ID','<',100)->where('Role_ID','>=',15)->lists( 'Role_ID')->toArray();
        return $result;
    }
        public static function getRolesList(Array $filters = [])
    { 
        $result = self::select(["role.*", "sys_status.SysLkp_HTMLID", "st.SysLkpLang_Text as status", "System_User.SysUsr_FullName",
            \DB::raw('(select count(UsrRol_SystemUserID) from SystemUser_Role where UsrRol_RoleID=role.Role_ID) as userCounter')])
            ->leftJoin('System_User', 'System_User.SysUsr_ID', '=', 'role.Role_CreatedBy')
            ->leftJoin('System_Lookup as sys_status', 'sys_status.SysLkp_ID', '=', 'role.Role_Status')
            ->leftJoin('SystemLookup_Language as st', function ($join) {
                $join->on('st.SysLkpLang_SystemLookupID', '=', 'sys_status.SysLkp_ID')
                    ->where("st.SysLkpLang_Type", "=", "EN");
            });

        if (isset($filters['from']) && $filters['from']) {
            $result = $result->where('role.created_at', '>=', $filters['from']);
        }

        if (isset($filters['to']) && $filters['to']) {
            $result = $result->where(\DB::raw('DATE_FORMAT(role.created_at, "%Y-%m-%d")'), '<=', $filters['to']);
        }

        $result = $result;

        return $result;
    }
}
