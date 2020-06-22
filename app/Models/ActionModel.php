<?php

namespace App\Models;

class ActionModel extends SuperModel
{
    protected $table = 'action';
    protected $primaryKey = 'Action_ID';
    public $timestamps = false;

    public function actions()
    {
        return $this->hasMany($this->model("ActionModel"), "Action_PredecesorActionID");
    }

    public function countActions()
    {
        return $this->hasOne($this->model("ActionModel"), "Action_PredecesorActionID")
            ->select(["Action_ID", "Action_PredecesorActionID", \DB::raw("count(*) as actionsNo")])
            ->where("Action_IsMenuItem", 1)->where("Action_IsActive", 1)->orderBy("Action_MenuOrder", "asc")
            ->groupBy("Action_PredecesorActionID");
    }

    public function actionsMenu()
    {
        $o= $this->hasMany($this->model("ActionModel"), "Action_PredecesorActionID");
        return $o;
    }

    public function routes()
    {
        $o= $this->hasMany($this->model("ActionRouteModel"), "ActRoute_ActionID");
        return $o;
    }

    public function routesLog()
    {
        return $this->hasMany($this->model("ActionRouteModel"), "ActRoute_ActionID")->where("ActRoute_IsLogging",1);
    }

    public function route()
    {
        $o= $this->hasOne($this->model("ActionRouteModel"), "ActRoute_ActionID")->orderBy("ActRoute_ID","asc")->limit(1);
        return $o;
    }

    public function users()
    {
        return $this->belongsToMany($this->model("SystemUserModel"), "systemuser_action", "UsrAct_SystemUserID", "UsrAct_ActionID");
    }

    public static function getMenu($user_id)
    {
        $o = self::with(["routes","actionsMenu.routes", "actionsMenu" => function ($q) {
         $q-> where("Action_IsMenuItem", 1)
                -> where("Action_IsActive", 1)
                 -> orderBy("Action_MenuOrder", "asc");
           }, "users" => function ($q) use ($user_id) {
              $q->where("SysUsr_ID", $user_id);
          }])
             // ->where("Action_PredecesorActionID", 0)
               ->where("Action_IsMenuItem", 1)
              ->where("Action_IsActive", 1)
               ->orderBy("Action_MenuOrder", "asc")
              ->get();
       
        return $o;
    }

    public static function actionsForLog(){
        return self::with(["actions.routesLog","routesLog"])
            ->where(function($q){
            //    $q->orHas("routesLog")->orHas("actions.routesLog");
            })
            ->where("Action_IsActive", 1)
            ->where("Action_PredecesorActionID", NULL)
            ->orderBy("Action_MenuOrder", "asc")
            ->get();
    }
}
