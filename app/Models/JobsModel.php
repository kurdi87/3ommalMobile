<?php

namespace App\Models;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

class JobsModel extends SuperModel
{

    protected $table = 'jobs';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];
    
    public static function getJobsList(Array $filters = [],$speciality=0,$company=0,$active=-1,$status=0,$type=0)
{

    $result = self::select(["jobs.*","optimum_types.type as type_name","optimum_status.status as status_name"])
        ->leftJoin('optimum_types', 'jobs.type', '=', 'optimum_types.id')
        ->leftJoin('system_user_customer', 'system_user_customer.SysUsr_ID', '=', 'jobs.user_id')
        ->leftJoin('optimum_status', 'jobs.status', '=', 'optimum_status.id');


    if (isset($filters['key']) && $filters['key']) {
        $result = $result->where('jobs_text', 'like', "%" . $filters['key'] . "%");
    }
    $result = $result->whereNull('jobs.deleted_at');

    if($speciality!=0)
    $result = $result->wherein('jobs.speciality_id',$speciality);
    if($company!=0)
        $result = $result->wherein('jobs.user_id',$company);
    if($status!=0)
        $result = $result->where('jobs.status',$status);
    if($active>=0)
        $result = $result->where('jobs.sactive',$active);
    if($type!=0)
        $result = $result->where('jobs.type',$type);
    return $result;
}
    public static function getJobs()
    {

        $result = ['0' => 'Select Jobs..'] + self::select('*')
                ->where ('jobs.active',1)->lists('job_title','id')->toArray();;
        return $result;
    }
    public static function countByType($type)
    {
        return self::select('*')->where('active',1)->where('type',$type)->count();
    }
    public static function getJobsByUser($search,$id)
    {


        $result = self::select('*')->where('user_id',$id)
        ->leftJoin('system_user_customer', 'system_user_customer.SysUsr_ID', '=', 'jobs.user_id');
        if (isset($search) && $search != "0" && $search != "") {
            $result = $result->where(function ($query) use ($search) {
                $query->where(DB::raw("REPLACE(jobs.keywords, ' ', '')"), 'like', '%' . str_replace(' ', '', $search) . '%')
                    ->orwhere(DB::raw("REPLACE(system_user_customer.company_name, ' ', '')"), 'like', '%' . str_replace(' ', '', $search) . '%')
                    ->orwhere(DB::raw("REPLACE(jobs.job_title, ' ', '')"), 'like', '%' . str_replace(' ', '', $search) . '%');
            });

        }
        $result = $result->where('jobs.active', 1)->take(50)->get()->all();
        return $result;
    }
    public static function getJobsByUser2($search,$id)
    {


        $result = self::select('*')->where('user_id',$id)
            ->leftJoin('system_user_customer', 'system_user_customer.SysUsr_ID', '=', 'jobs.user_id');
        if (isset($search) && $search != "0" && $search != "") {
            $result = $result->where(function ($query) use ($search) {
                $query->where(DB::raw("REPLACE(jobs.keywords, ' ', '')"), 'like', '%' . str_replace(' ', '', $search) . '%')
                    ->orwhere(DB::raw("REPLACE(system_user_customer.company_name, ' ', '')"), 'like', '%' . str_replace(' ', '', $search) . '%')
                    ->orwhere(DB::raw("REPLACE(jobs.job_title, ' ', '')"), 'like', '%' . str_replace(' ', '', $search) . '%');
            });

        }
        $result = $result->where('jobs.active', 1)->take(10)->get()->all();
        return $result;
    }





    public static function getMainJobs($city=0)
    {
        return self::select(["jobs.*"])->where('active',1)->take(8)->orderBy(DB::raw('RAND()'))->get()->all();
    }
    public static function relatedJob($id=0)
    {
        $result=self::select(["jobs.*"])->where('active',1)->where('jobs.id','<>',$id);
        $keys=explode(',',self::find($id)->sepciality_id);
        foreach($keys as $key){
            $result = $result->where(function ($query) use ($key,$result) {
                $query->where('jobs.speciality_id', 'like', '%,'.$key.'%')->orwhere('jobs.speciality_id', 'like', '%,'.$key.',%')
                    ->orwhere('jobs.speciality_id', 'like', '%'.$key.',%');

            });
        }
        return $result->take(10)->orderBy(DB::raw('RAND()'))->get()->all();


    }

    public static function getJobsSearch($search,$offset,$limit,$order=1,$city,$type=0,$speciality,$company)
    {

        $result = self::select(["jobs.*","optimum_types.type as type_name","optimum_status.status as status_name"])
            ->leftJoin('optimum_types', 'jobs.type', '=', 'optimum_types.id')
            ->leftJoin('system_user_customer', 'system_user_customer.SysUsr_ID', '=', 'jobs.user_id')
            ->leftJoin('optimum_status', 'jobs.status', '=', 'optimum_status.id')

            ->where('jobs.active',1);

        if($company!=0)
            $result = $result->where('jobs.user_id',$company);
       if($type!=[0])
           $result->wherein('jobs.type',$type);

        if($speciality!=0)
            if(isset($speciality)  && $speciality!="0"&&$speciality!="") {
                $result = $result->where(function ($query) use ($speciality) {
                    $query->where('jobs.speciality_id', 'like', '%,'.$speciality.'%')->orwhere('jobs.speciality_id', 'like', '%,'.$speciality.',%')
                        ->orwhere('jobs.speciality_id', 'like', '%'.$speciality.',%');

                });
            }


        if($city!=0)
            $result = $result->where('jobs.city',$city);



        if(isset($search)  && $search!="0"&&$search!="") {
            $result = $result->where(function ($query) use ($search) {
                $query->where(DB::raw("REPLACE(jobs.keywords, ' ', '')"), 'like', '%'. str_replace(' ','',$search) .'%')
                    ->orwhere(DB::raw("REPLACE(system_user_customer.company_name, ' ', '')"), 'like', '%' . str_replace(' ','',$search) . '%');
            });
        }

        
        $result=$result->groupby('jobs.id');
        if($order!="0")
        $result=$result->orderby($order);
        return $result->paginate(10, $columns = ['*'], 'page', $offset );
    }



}
