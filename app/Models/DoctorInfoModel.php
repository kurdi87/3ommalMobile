<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DoctorInfoModel extends SuperModel
{

    protected $table = 'doctor_info';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];



       public static function getDoctors($search,$offset,$limit,$order,$departmant,$lang,$disease,$country,$speciality=0)
    {


        $country= CountryModel::getCountryID($country);
        $result = self::select('doctor_info.id as id','country','doctor_info.name as name','rate','speciality','doctor_info.d_image as icon','doctor_info.cv as cv','department','recipe','title','hospital_id')
          // ->leftJoin('doctor_dieseas', 'doctor_info.id', '=', 'doctor_dieseas.doctor_id')
           // ->leftJoin('speciality_dieseas', 'speciality_dieseas.id', '=', 'doctor_dieseas.dieseas_id')
            ->leftJoin('doctor_speciality', 'doctor_info.id', '=', 'doctor_speciality.doctor_id')
            ->leftJoin('speciality', 'speciality.id', '=', 'doctor_speciality.speciality_id')
            ->where('doctor_info.active',1);



        if(isset($departmant)&&$departmant!="0"&&$departmant!="") {
            $result = $result->where(function ($query) use ($departmant) {
                $a = explode(",", $departmant);
                for ($i = 0; $i < count($a); $i++) {
                    if ($i == 0)
                        $query->where('doctor_info.speciality',$a[$i] );
                    else
                        $query = $query->orwhere('doctor_info.speciality', $a[$i]);
                }
                $query->orwhere('doctor_info.department',$departmant);
            });
        }


/*
        if(isset($recipe)&&$recipe!="0"&&$recipe!="") {
            $result = $result->where(function ($query) use ($recipe) {
                $a = explode(",", $recipe);
                for ($i = 0; $i < count($a); $i++) {
                    if ($i == 0)
                        $query->where('doctor_info.recipe',$a[$i] );
                    else
                        $query = $query->orwhere('doctor_info.recipe', $a[$i]);
                }
            });
        }*/
        if(isset($search)  && $search!="-1" && $search!="0") {
            $result = $result->where(function ($query) use ($search){
                $query->where('doctor_info.keywords', 'like', '%' . $search . '%')
                    ->orwhere('doctor_info.name', 'like', '%' . $search . '%')
                    ->orwhere('doctor_info.title', 'like', '%' . $search . '%')
                    ->orwhere('speciality.special', 'like', '%' . $search . '%')
                    ->orwhere('doctor_info.recipe', 'like', '%' . $search . '%')
                    ->orwhere('doctor_info.speciality', 'like', '%' . $search . '%');
                  //  ->orwhere('speciality_dieseas.name','like','%' .$search.'%'  );

            });
        }
        if(isset($country)   && $country!="-1" && $country!="0" &&$country!="") {
            $result = $result->where(function ($query) use ($country){
                $query->where('country', $country);

            });
        }


        $result = $result->groupby('doctor_info.id')->orderby($order,'asc');

        return $result->paginate(10, $columns = ['*'], 'page', $offset );


    }



    public static function getDoctorsByDept($department,$hospital=0)
    {

        $result = self::select('doctor_info.*')

            ->where('doctor_info.active',1)

        ->where('department',$department);
        if($hospital>0)
        {
            $result=$result->where('hospital_id',$hospital);
        }


        return $result;


    }
    public static function getDoctorName($id)
    {
        try {
            if($id==0)
                5/0;
            $result = self::select('*')
                ->where('id', $id)->get()->first()->name;
            return $result;
        } catch (\Exception $ex) {
            return 'NA';
        }
    }
    public static function getDoctorHospital($id)
    {
        try {
            if($id==0)
                5/0;
            $result = self::select('*')
                ->where('id', $id)->get()->first()->hospital;
            return $result;
        } catch (\Exception $ex) {
            return 'NA';
        }
    }




}
