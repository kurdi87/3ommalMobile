<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\ActionRouteModel;
use App\Models\ActionModel;

class SettingController extends SuperAdminController
{

    public function __construct()
    {
        parent::__construct();
        parent::$data['active_menu'] = 'edit_setting';
        parent::$data["breadcrumbs"]=["Control Panel"=>parent::$data['cp_route_name'],"Settings"=>""];
    }

    public function index()
    {
        if (\Session::has("success"))
            parent::$data["success"] = \Session::get("success");

        parent::$data["siteSetting"]= SettingModel::lists("value","name")->toArray();
        //parent::$data["logSetting"]=ActionRouteModel::getRouteLogs();
        parent::$data['actions'] = ActionModel::actionsForLog();
        parent::$data['title'] = "الاعدادات";
        return view('cp.setting.form', parent::$data);
    }

    public function update(Request $request)
    {
        $this->updateSetting($request);
        $routes=$request->input("route");
        $details=$request->input("detail");


        return redirect(parent::$data['cp_route_name']."/setting")->with("success","Updated successfully");
    }

    private function updateSetting($request){
        $data['is_open']=$request->input("is_open")?1:0;
        $data['close_message']=$request->input("close_message");
        $data['news_letter']=$request->input("news_letter")?1:0;
        $data['slider_images']=$request->input("slider_images")>0?$request->input("slider_images"):4;
        $data['facebook']=$request->input("facebook");
        $data['twitter']=$request->input("twitter");
        $data['youtube']=$request->input("youtube");
        $data['instagram']=$request->input("instagram");
        $data['sign_social']=$request->input("sign_social")?1:0;
        $data['add_blog']=$request->input("add_blog")?1:0;
        $data['add_comment']=$request->input("add_comment")?1:0;
        $data['like']=$request->input("like")?1:0;
        $data['booking']=$request->input("booking")?1:0;
        $data['add_reply']=$request->input("add_reply")?1:0;
        $data['facebook_share']=$request->input("facebook_share")?1:0;
        $data['twitter_share']=$request->input("twitter_share")?1:0;
        $data['google_share']=$request->input("google_share")?1:0;
        $data['google_code']=$request->input("google_code");
        $data['meta_description']=$request->input("meta_description");
        $data['tags']=$request->input("tags");
        $data['phone']=$request->input("phone");
        $data['email']=$request->input("email");
        $data['how_it_woks1']=$request->input("how_it_woks1");
        $data['how_it_woks2']=$request->input("how_it_woks2");
        $data['how_it_woks3']=$request->input("how_it_woks3");

        $data['show_notification']=$request->input("show_notification")?1:0;
        $data['message_notification_en']=$request->input("message_notification_en");
        $data['message_notification_ar']=$request->input("message_notification_ar");
        $data['date_notification']=strtotime($request->input("date_notification"))?$request->input("date_notification"):date("Y-m-d");
        $this->updateAllInputs($data);
    }

    private function updateAllInputs($data){
        $sett=new SettingModel;
        $log=$this->logAction(0,parent::$data["adminUser"]->SysUsr_ID,\Request::ip(),parent::$data["actionRouteName"],$sett->getTableName(),"",$sett->getPrimaryKey());// log
        foreach ($data as $key => $value) {
            $sett=SettingModel::where("name",$key)->first();
            $oldValue=[$sett->name.""=>$sett->value];
            if($oldValue!=$value)
                $sett->update(["value"=>$value]);
            $newValue=[$sett->name.""=>$sett->value];
            $this->logActionDetails($log,$sett->getTableName(),compareTwoArray($oldValue,$newValue,$sett->getPrimaryKey()));// log
        }
    }
}
