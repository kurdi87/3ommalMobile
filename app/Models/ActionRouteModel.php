<?php

namespace App\Models;

class ActionRouteModel extends SuperModel
{
    protected $table = 'action_route';
    protected $primaryKey = 'ActRoute_ID';
    protected $fillable = ['ActRoute_IsLogging', 'ActRoute_IsLoggingDetails'];
    public $timestamps = false;

    public function action()
    {
        return $this->belongsTo($this->model("ActionModel"), "ActRoute_ActionID");
    }

    public static function inList($route)
    {
        return self::where("ActRoute_RouteName", $route)->count();
    }

    public static function getRouteLogs(){
        return self::with("action")->where("ActRoute_canLogging",1)->orderBy("ActRoute_ActionID","asc")->get();
    }

}
