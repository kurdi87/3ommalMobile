<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;
use App\Models\SettingModel;
use App\Models\NotificationModel;
use App\Models\Device;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Zend\Diactoros\Response;

#API access key from Google API's Console // Specialist
//define( 'API_ACCESS_KEY_Specialist', 'AIzaSyDVElXvpgInvYllua3kvzkHC_YiBL1iGrY');

#API access key from Google API's Console // Patient
//define( 'API_ACCESS_KEY_Patient', 'AIzaSyD_vKG3N6nsVa6XRx6Zi4K7FwF0szq27ZU');

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $data = [];

    protected $user;
    public function __construct()
    {

        self::$data['page-not-found-view'] = 'site.404';
        self::$data['locale'] = App::getLocale();
        self::$data['cp_route_name'] =config('app.cp_route_name');
        self::$data['user_route_name'] =config('app.user_route_name');
        //$contact = App\Models\ContactModel::where("id", "1")->get();
        //self::$data["contact"] = $contact->first();
       /* self::$data["siteSetting"]= App\Models\SettingModel::lists("value","name")->toArray();
        self::$data["mainCompany"]= App\Models\SystemUserCustomerModel::where('SysUsr_Status', 5)->take('5')->orderBy(DB::raw('RAND()'))->get();
        self::$data['mainSpecialities']=App\Models\SpecialityModel::where('speciality.active',1)->take('5')->orderBy(DB::raw('RAND()'))->get();

        if (auth('web2')->user())
        {
            self::$data['saved_job'] =App\Models\JobSaveModel::where('active',1)->where('user_id',auth('web2')->user()->SysUsr_ID)->lists('job_id')->toArray();
            self::$data['applied_job'] =App\Models\JobApplicationModel::where('active',1)->where('user_id',auth('web2')->user()->SysUsr_ID)->lists('job_id')->toArray();
        }*/

    }

    public function pushNot($user,$title,$body, $notification=NULL,$api_access_key=NULL)
    {
        $result = array();
        if($user)
        {
            $devices = Device::select('fcm')->where('SysUsr_ID',$user->SysUsr_ID)->get();
            foreach($devices as $key=>$device)
            {
                //$registrationIds[$key] = $device->fcm;

                $result[$key]= $this->sendPush($device->fcm,$title,$body,$notification, $api_access_key);

            }
        }

        #Echo Result Of FireBase Server
        return $result;
    }


    private function sendPush($token,$title,$body, $notification=NULL, $api_access_key=NULL){
        if($notification)
        {
            $notification = NotificationModel::        with('source')->
            with('destination')->
            with('requests')->
            with('type')->
            find($notification->id);
        }


        $msg = array
        (
            "title"    => $title,  //'Title Of Notification',
            "body"     => $body, //'Body  Of Notification',
            "icon" => "icon.png",
            "click_action" => "http://api.tabibfind.com/api/documentation",
            "notification" => $notification
            //'icon'    => 'myicon',//Default Icon
            //'sound' => 'mySound' //Default sound
        );

        $data = array("to" => $token,
            "data" => $msg);
        $data_string = json_encode($data);
        //return $data_string;
        $headers = array
        (
            'Authorization: key=' . ( ($api_access_key) ? $api_access_key : API_ACCESS_KEY),
            'Content-Type: application/json'
        );
        //return $api_access_key;
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        //curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, /*json_encode( $fields )*/ $data_string );
        $result = curl_exec($ch );
        curl_close( $ch );
        #Echo Result Of FireBase Server

        return json_decode($result);
    }



}
