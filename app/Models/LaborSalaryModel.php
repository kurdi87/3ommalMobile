<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class LaborSalaryModel extends SuperModel
{

    protected $table = 'labor_salary_request';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id',  'start_work_date', 'end_work_date', 'salary_paper', 'salary_amount', 'notes'];


    public static function getSalaryList(Array $filters = [],$user_id=0, $status = 0, $type = 0, $fp = 0, $region=0, $role = 0, $from = 0, $to = 0, $employee = 0, $city = 0, $hospital = 0, $validity = 0, $uploaded = 0)

    {

        $result = self::select('labor_salary_request.*','optimum_status.status as admin_status','system_user.SysUsr_FullName as name','system_user.city as city','system_user.SysUsr_Email as email','system_user.SysUsr_Mobile as telephone')
            ->leftJoin('optimum_types', 'labor_salary_request.type', '=', 'optimum_types.id')
            ->leftJoin('system_user', 'system_user.SysUsr_ID', '=', 'labor_salary_request.user_id')
            ->leftJoin('optimum_status', 'labor_salary_request.status', '=', 'optimum_status.id');

        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('system_user.SysUsr_FullName', 'like', "%" . $filters['key'] . "%");
        }


        if ($status != 0) {
            $result->where('labor_salary_request.status', $status);
        }
       
        if ($type != 0) {
            $result->where('labor_salary_request.type', $type);
        }
        
        
        if ($city != 0) {
            $result->where('system_user.city', $city);
        }




        if ($from != 0) {
            $result->where('labor_salary_request.created_at', ">=", $from);
        }
        if ($to != 0) {
            $result->where('labor_salary_request.created_at', "<=", $to);
        }
        if ($user_id != 0) {
            $result->where('labor_salary_request.user_id', $user_id);
        }


        return $result;
    }


}
