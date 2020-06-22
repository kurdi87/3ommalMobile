<?php

namespace App\Models;

class TreatrequestModel extends SuperModel
{

    protected $table = 'request';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

       
     public static function getTreatrequestList(Array $filters = [])
    {
    	$result = self::select(["request.*", "requestsubject.name_en as name_en", "system_user.SysUsr_firstName as UserName","recipe.name as recipe","doctor.name as doctor","request_status.name_en as admin_status"])

            ->leftJoin('requestsubject', 'request.subject', '=', 'requestsubject.id') 
            ->leftJoin('recipe', 'recipe.id', '=', 'request.hospital_id')
            ->leftJoin('doctor', 'doctor.id', '=', 'request.doctor_id')
            ->leftJoin('system_user', 'system_user.SysUsr_ID', '=', 'request.userid') 
             ->leftJoin('request_status', 'request_status.id', '=', 'request.status') 
             ->where('request.active',1) 
             ->orderby('request.id','desc') 
             ->orderby('request.status','asc')   
              ;  

        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('request.name', 'like', "%" . $filters['key'] . "%");     
        }

        return $result;
    }

    public static function getTreatrequest($id)
    {
        $result = $result = self::select(["request.*", "requestsubject.name_en as name_en", "system_user.SysUsr_firstName as UserName","recipe.name as recipe","doctor.name as doctor","request_status.name_en as admin_status"])

            ->leftJoin('requestsubject', 'request.subject', '=', 'requestsubject.id') 
            ->leftJoin('recipe', 'recipe.id', '=', 'request.hospital_id')
            ->leftJoin('doctor', 'doctor.id', '=', 'request.doctor_id')
            ->leftJoin('system_user', 'system_user.SysUsr_ID', '=', 'request.userid') 
             ->leftJoin('request_status', 'request_status.id', '=', 'request.status')  ;     

            $result = $result->where('request.id', $id)->get()->first();     
        

        return $result;
    }


}
