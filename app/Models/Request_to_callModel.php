<?php

namespace App\Models;

class Request_to_callModel extends SuperModel
{

    protected $table = 'request_to_call';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];



    public static function getRequest_to_callList(Array $filters = [],$status=0,$employee=0,$finance_party=0,$role=0)
    {
       $result = self::select('request_to_call.*','recipe.name as recipe','doctor.name as doctor','department.name as department')
           ->leftJoin('patient', 'request_to_call.patient_id', '=', 'patient.id')
        ->leftJoin('recipe', 'request_to_call.hospital_id', '=', 'recipe.id')
           ->leftJoin('doctor', 'doctor.id', '=', 'request_to_call.doctor_id')
           ->leftJoin('department', 'request_to_call.department_id', '=', 'department.id');
           

        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('request_to_call.name', 'like', "%" . $filters['key'] . "%");
        }
        if ($status>0) {
            $result->where('request_to_call.status',$status);
        }
        if($role>=15)
        {
            $result = $result->where('request_to_call.role',$role);
        }
        if ($employee>0) {

            $result->where('request_to_call.employee',$employee);
        }
        if ($finance_party>0) {

            $result->where('request_to_call.finance_party',$finance_party);
        }
        return $result;
    }


    public static function getRequest_to_call($patient=0,$role=0)
    {
        $result = self::select('request_to_call.*','recipe.name as recipe','doctor.name as doctor','department.name as department')
            ->leftJoin('patient', 'request_to_call.patient_id', '=', 'patient.id')
            ->leftJoin('recipe', 'request_to_call.hospital_id', '=', 'recipe.id')
            ->leftJoin('doctor', 'doctor.id', '=', 'request_to_call.doctor_id')
            ->leftJoin('department', 'request_to_call.department_id', '=', 'department.id');


        if ($patient>0) {
            $result->where('request_to_call.patient_id',$patient);
        }
        if ($role >= 15) {
            $result = $result->where('request_to_call.role', $role);
        }

        return $result;
    }



    public static function CountRequest_to_calls($status=0,$user_id=0)
    {
        $result = self::select('request_to_call.*','recipe.name as recipe','doctor.name as doctor','department.name as department')

            ->leftJoin('recipe', 'request_to_call.hospital_id', '=', 'recipe.id')
            ->leftJoin('doctor', 'doctor.id', '=', 'request_to_call.doctor_id')
            ->leftJoin('patient', 'request_to_call.patient_id', '=', 'patient.id')
            ->leftJoin('department', 'request_to_call.department_id', '=', 'department.id');


        if ($status>0) {
            $result->where('request_to_call.status',$status);
        }
        if($user_id>0){
            $role = SystemUserModel::find($user_id)->role;
            if ($role >= 15) {
                $result = $result->where('request_to_call.role', $role);
            }
        }
        $result->where('request_to_call.active',1);
        return $result->count();
    }




}
