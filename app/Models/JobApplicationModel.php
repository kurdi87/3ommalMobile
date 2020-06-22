<?php

namespace App\Models;

class JobApplicationModel extends SuperModel
{
    protected $table = 'job_application';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['job_interview','work_fields','work_special','id_type','magnetic_card','worked_inside_green_line','year_work','month_work','amount_of_the_monthly_salary', 'getting_a_salary_slip','previous_work_accident','end_of_service_benefits','monthly_salary_amount_you_were_getting','taken_a_public_safety_course','speak_hebrew','years_of_experience','level_of_your_academic'];

    public static function getJobList(Array $filters = [],$user_id=0, $status = 0, $category = 0, $fp = 0, $region=0, $role = 0, $from = 0, $to = 0, $employee = 0, $city = 0, $hospital = 0, $validity = 0, $uploaded = 0)

    {

        $result = self::select('job_application.*','optimum_status.status as admin_status','system_user.SysUsr_FullName as name','system_user.city as city','system_user.SysUsr_Email as email','system_user.SysUsr_Mobile as telephone','system_user.sid as sid','SysUsr_DoB', 'SysUsr_UserName','is_verified','verification_key','city','social_status','address','gender','sid_type')
            ->leftJoin('optimum_types', 'job_application.type', '=', 'optimum_types.id')
            ->leftJoin('system_user', 'system_user.SysUsr_ID', '=', 'job_application.user_id')
            ->leftJoin('optimum_status', 'job_application.status', '=', 'optimum_status.id');

        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('system_user.SysUsr_FullName', 'like', "%" . $filters['key'] . "%");
        }


        if ($status != 0) {
            $result->where('job_application.status', $status);
        }

        if ($category ) {
            $result->where('job_application.work_fields', $category);
        }


        if ($city != 0) {
            $result->where('system_user.city', $city);
        }




        if ($from != 0) {
            $result->where('job_application.created_at', ">=", $from);
        }
        if ($to != 0) {
            $result->where('job_application.created_at', "<=", $to);
        }
        if ($user_id != 0) {
            $result->where('job_application.user_id', $user_id);
        }


        return $result;
    }

}
